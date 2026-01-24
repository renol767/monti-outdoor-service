<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HeroSlideController extends Controller
{
    /**
     * Display all 5 hero slides
     */
    public function index()
    {
        $slides = HeroSlide::ordered()->get();
        return view('admin.hero-slides.index', compact('slides'));
    }

    /**
     * Show the form for editing the specified slide
     */
    public function edit(HeroSlide $slide)
    {
        return view('admin.hero-slides.edit', compact('slide'));
    }

    /**
     * Update the specified slide
     */
    public function update(Request $request, HeroSlide $slide)
    {
        Log::info('=== Hero Slide Update Started ===');
        Log::info('Slide ID: ' . $slide->id);
        Log::info('Request has file: ' . ($request->hasFile('background_image') ? 'YES' : 'NO'));
        Log::info('All request data: ', $request->except('background_image'));
        
        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');
            Log::info('File details:', [
                'original_name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
                'is_valid' => $file->isValid()
            ]);
        }
        
        try {
            $validated = $request->validate([
                'badge_text' => 'required|string|max:100',
                'title' => 'required|string|max:200',
                'subtitle' => 'required|string|max:500',
                'background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240', // 10MB
                'is_active' => 'nullable', // Checkbox sends 'on' or nothing
            ]);
            Log::info('Validation passed');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed:', $e->errors());
            throw $e;
        }

        // Handle image upload
        if ($request->hasFile('background_image')) {
            Log::info('Processing image upload...');
            
            // Delete old image if exists and not default
            if ($slide->background_image && $slide->background_image !== 'images/Annapurna Basecamp.jpg') {
                // Remove 'storage/' prefix before deleting from storage
                $oldPath = str_replace('storage/', '', $slide->background_image);
                Log::info('Deleting old image: ' . $oldPath);
                Storage::disk('public')->delete($oldPath);
            }

            // Store new image
            $path = $request->file('background_image')->store('hero-slides', 'public');
            Log::info('New image stored at: ' . $path);
            
            // Add 'storage/' prefix for asset() to work correctly
            $validated['background_image'] = 'storage/' . $path;
            Log::info('Image path to save in DB: ' . $validated['background_image']);
        }

        // Update is_active status
        $validated['is_active'] = $request->has('is_active');
        Log::info('Is active: ' . ($validated['is_active'] ? 'true' : 'false'));

        $slide->update($validated);
        Log::info('Slide updated successfully');
        Log::info('=== Hero Slide Update Completed ===');

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Hero slide updated successfully!');
    }

    /**
     * Toggle active status via AJAX
     */
    public function toggleActive(Request $request, HeroSlide $slide)
    {
        $slide->update([
            'is_active' => !$slide->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $slide->is_active,
            'message' => 'Slide status updated successfully'
        ]);
    }
}
