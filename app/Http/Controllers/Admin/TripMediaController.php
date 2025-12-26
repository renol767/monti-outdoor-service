<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TripTemplate;
use App\Models\TripMedia;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TripMediaController extends Controller
{
    /**
     * Get all media for a trip (AJAX)
     */
    public function index(TripTemplate $trip)
    {
        $media = TripMedia::where('trip_template_id', $trip->id)
            ->orderBy('media_type')
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'gallery' => $media->where('media_type', 'gallery')->values(),
            'tracking_map' => $media->where('media_type', 'tracking_map')->first(),
        ]);
    }

    /**
     * Upload media
     */
    public function store(Request $request, TripTemplate $trip)
    {
        $request->validate([
            'file' => 'required|image|max:10240', // Max 10MB
            'media_type' => 'required|in:gallery,tracking_map',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $mediaType = $request->input('media_type');

        // Store file
        $path = $request->file('file')->store('uploads/trips/' . $trip->id, 'public');
        $filePath = 'storage/' . $path;

        // For tracking map, remove existing one
        if ($mediaType === 'tracking_map') {
            $existing = TripMedia::where('trip_template_id', $trip->id)
                ->where('media_type', 'tracking_map')
                ->first();
            
            if ($existing) {
                // Remove old file
                if (strpos($existing->file_path, 'storage/') === 0) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $existing->file_path));
                }
                $existing->delete();
            }
        }

        // Get next sort order for gallery
        $sortOrder = 0;
        if ($mediaType === 'gallery') {
            $sortOrder = TripMedia::where('trip_template_id', $trip->id)
                ->where('media_type', 'gallery')
                ->max('sort_order') ?? 0;
            $sortOrder++;
        }

        $media = TripMedia::create([
            'trip_template_id' => $trip->id,
            'media_type' => $mediaType,
            'file_path' => $filePath,
            'alt_text' => $request->input('alt_text'),
            'is_cover' => $request->boolean('is_cover', false),
            'sort_order' => $sortOrder,
        ]);

        AuditLog::log('create', 'trip_media', $media->id, null, $media->toArray());

        return response()->json([
            'success' => true,
            'media' => $media,
            'message' => 'Image uploaded successfully',
        ]);
    }

    /**
     * Update media (alt text, cover, sort order)
     */
    public function update(Request $request, TripMedia $media)
    {
        $request->validate([
            'alt_text' => 'nullable|string|max:255',
            'is_cover' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // If setting as cover, unset other covers
        if ($request->boolean('is_cover')) {
            TripMedia::where('trip_template_id', $media->trip_template_id)
                ->where('media_type', 'gallery')
                ->where('id', '!=', $media->id)
                ->update(['is_cover' => false]);
        }

        $media->update($request->only(['alt_text', 'is_cover', 'sort_order']));

        return response()->json([
            'success' => true,
            'media' => $media->fresh(),
        ]);
    }

    /**
     * Reorder media (drag-drop)
     */
    public function reorder(Request $request, TripTemplate $trip)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:trip_media,id',
        ]);

        foreach ($request->input('order') as $index => $mediaId) {
            TripMedia::where('id', $mediaId)
                ->where('trip_template_id', $trip->id)
                ->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Delete media
     */
    public function destroy(TripMedia $media)
    {
        // Remove file
        if (strpos($media->file_path, 'storage/') === 0) {
            Storage::disk('public')->delete(str_replace('storage/', '', $media->file_path));
        }

        AuditLog::log('delete', 'trip_media', $media->id, $media->toArray(), null);

        $media->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image deleted',
        ]);
    }
}
