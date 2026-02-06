<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TripTypeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TripTypeSectionController extends Controller
{
    /**
     * Display a listing of sections.
     */
    public function index(Request $request)
    {
        $category = $request->get('category', 'mountain');
        
        // Fetch standard sections (excluding hero)
        $sections = TripTypeSection::byCategory($category)
            ->where('slug', '!=', $category . '-hero')
            ->ordered()
            ->get();
            
        // Fetch hero section specifically
        $heroSection = TripTypeSection::byCategory($category)
            ->where('slug', $category . '-hero')
            ->first();
        
        $categories = TripTypeSection::categories();
        
        return view('admin.trip-types.index', compact('sections', 'heroSection', 'category', 'categories'));
    }

    /**
     * Update or Create the Hero Section
     */
    public function updateHero(Request $request)
    {
        $category = $request->input('category');
        $slug = $category . '-hero';
        
        $validated = $request->validate([
            'category' => 'required|string|in:mountain,outdoor,indoor',
            'title_id' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'subtitle_id' => 'nullable|string|max:255',
            'subtitle_en' => 'nullable|string|max:255',
            'hero_image' => 'nullable|image|max:10240', // 10MB max
        ]);

        // Find or create the hero section
        $section = TripTypeSection::firstOrNew([
            'slug' => $slug,
            'category' => $category
        ]);

        // If new, set defaults
        if (!$section->exists) {
            $section->sort_order = 0; // Top priority
            $section->is_active = true;
        }

        // Save translations
        $section->title = [
            'id' => $validated['title_id'],
            'en' => $validated['title_en'],
        ];
        
        $section->subtitle = [
            'id' => $validated['subtitle_id'] ?? '',
            'en' => $validated['subtitle_en'] ?? '',
        ];
        
        // Handle Image Upload (Standard File Upload from Cropper)
        if ($request->hasFile('hero_image')) {
            $file = $request->file('hero_image');
            $filename = $slug . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('trip-types', $filename, 'public');
            
            // Hero uses the first image slot
            $images = $section->images ?? [];
            $images[0] = 'storage/' . $path;
            $section->images = $images;
        }
        // Legacy: Handle Base64 (Keep for backward compatibility if needed)
        elseif ($request->filled('cropped_hero_image')) {
            $base64Image = $request->input('cropped_hero_image');
            
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $data = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, etc.
                
                if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                   $type = 'jpg'; // Default fallback
                }

                $data = base64_decode($data);
                if ($data !== false) {
                    $filename = $slug . '_' . time() . '.' . $type;
                    $path = 'trip-types/' . $filename;
                    
                    if (\Illuminate\Support\Facades\Storage::disk('public')->put($path, $data)) {
                         // Hero uses the first image slot
                        $images = $section->images ?? [];
                        $images[0] = 'storage/' . $path;
                        $section->images = $images;
                    }
                }
            }
        }

        $section->save();

        return redirect()
            ->route('admin.trip-types.index', ['category' => $category])
            ->with('success', 'Hero section updated successfully!');
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
        Log::info('TripTypeSection Update HIT:', $request->all());

        $validated = $request->validate([
            'title' => 'required', // can be string or array
            'subtitle' => 'nullable',
            'content_html' => 'nullable',
            'content_full' => 'nullable', // accept array or string
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
                        continue;
                    }
                    
                    // Generate filename
                    $filename = Str::slug($section->slug) . '_' . $i . '_' . time() . '.jpg';
                    $path = 'trip-types/' . $filename;
                    
                    // Store file
                    $stored = \Illuminate\Support\Facades\Storage::disk('public')->put($path, $decodedImage);
                    
                    if ($stored) {
                        $images[$i] = 'storage/' . $path;
                    }
                } catch (\Exception $e) {
                    // Silent fail or handle as needed
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
     * Upload image from Quill editor
     */
    public function uploadImage(Request $request)
    {
         $request->validate([
             'image' => 'required|image|max:51200', // 50MB
         ]);

         if ($request->hasFile('image')) {
             $path = $request->file('image')->store('trip-section-content-images', 'public');
             return response()->json(['url' => asset('storage/' . $path)]);
         }

         return response()->json(['error' => 'Upload failed'], 400);
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
