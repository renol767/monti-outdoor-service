<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TripTypeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TripTypeSectionController extends Controller
{
    /**
     * Display a listing of sections.
     */
    public function index(Request $request)
    {
        $category = $request->get('category', 'mountain');
        
        $sections = TripTypeSection::byCategory($category)
            ->ordered()
            ->get();
        
        $categories = TripTypeSection::categories();
        
        return view('admin.trip-types.index', compact('sections', 'category', 'categories'));
    }

    /**
     * Show the form for editing a section.
     */
    public function edit(TripTypeSection $section)
    {
        $categories = TripTypeSection::categories();
        return view('admin.trip-types.edit', compact('section', 'categories'));
    }

    /**
     * Update the specified section.
     */
    public function update(Request $request, TripTypeSection $section)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content_html' => 'nullable|string',
            'content_full' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Handle image uploads (both file and base64 cropped)
        $images = $section->images ?? [];
        
        for ($i = 0; $i < 4; $i++) {
            // Check for cropped base64 image first
            $croppedData = $request->input("cropped_image_$i");
            
            if ($croppedData && str_starts_with($croppedData, 'data:image')) {
                try {
                    // Decode base64
                    $parts = explode(',', $croppedData);
                    if (count($parts) < 2) continue;
                    
                    $imageData = $parts[1];
                    $decodedImage = base64_decode($imageData);
                    
                    if ($decodedImage === false) {
                        \Log::error("Failed to decode base64 for image $i");
                        continue;
                    }
                    
                    // Generate filename
                    $filename = Str::slug($section->slug) . '_' . $i . '_' . time() . '.jpg';
                    $path = 'trip-types/' . $filename;
                    
                    // Store file
                    $stored = \Illuminate\Support\Facades\Storage::disk('public')->put($path, $decodedImage);
                    
                    if ($stored) {
                        $images[$i] = 'storage/' . $path;
                        \Illuminate\Support\Facades\Log::info("Image $i saved to: $path");
                    } else {
                        \Illuminate\Support\Facades\Log::error("Failed to store image $i");
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error("Error saving cropped image $i: " . $e->getMessage());
                }
            }
            // Fallback to file upload
            elseif ($request->hasFile("image_$i")) {
                $file = $request->file("image_$i");
                $filename = Str::slug($section->slug) . '_' . $i . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('trip-types', $filename, 'public');
                $images[$i] = 'storage/' . $path;
            }
        }
        
        $validated['images'] = $images;
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? $section->sort_order;
        
        $section->update($validated);

        return redirect()
            ->route('admin.trip-types.index', ['category' => $section->category])
            ->with('success', 'Section updated successfully!');
    }

    /**
     * Store a new section.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|in:mountain,outdoor,indoor',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
        ]);

        $slug = Str::slug($validated['title']);
        
        // Ensure unique slug
        $originalSlug = $slug;
        $count = 1;
        while (TripTypeSection::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $maxOrder = TripTypeSection::byCategory($validated['category'])->max('sort_order') ?? 0;

        TripTypeSection::create([
            'category' => $validated['category'],
            'slug' => $slug,
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'sort_order' => $maxOrder + 1,
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.trip-types.index', ['category' => $validated['category']])
            ->with('success', 'Section created successfully!');
    }

    /**
     * Remove the specified section.
     */
    public function destroy(TripTypeSection $section)
    {
        $category = $section->category;
        $section->delete();

        return redirect()
            ->route('admin.trip-types.index', ['category' => $category])
            ->with('success', 'Section deleted successfully!');
    }
}
