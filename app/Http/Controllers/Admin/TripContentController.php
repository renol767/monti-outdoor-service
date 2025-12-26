<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TripTemplate;
use App\Models\TripContent;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class TripContentController extends Controller
{
    /**
     * Get content for a specific tab (AJAX)
     */
    public function show(TripTemplate $trip, string $tabType)
    {
        $validTabs = ['overview', 'include_exclude', 'itinerary', 'terms'];
        
        if (!in_array($tabType, $validTabs)) {
            return response()->json(['error' => 'Invalid tab type'], 400);
        }

        $content = TripContent::where('trip_template_id', $trip->id)
            ->where('tab_type', $tabType)
            ->orderBy('version', 'desc')
            ->first();

        return response()->json([
            'content' => $content,
            'delta' => $content?->content_delta ?? [],
            'html' => $content?->content_html ?? '',
        ]);
    }

    /**
     * Save content for a tab (AJAX)
     */
    public function store(Request $request, TripTemplate $trip, string $tabType)
    {
        $validTabs = ['overview', 'include_exclude', 'itinerary', 'terms'];
        
        if (!in_array($tabType, $validTabs)) {
            return response()->json(['error' => 'Invalid tab type'], 400);
        }

        $request->validate([
            'content_delta' => 'required|array',
            'content_html' => 'nullable|string',
        ]);

        // Get existing content to increment version
        $existingContent = TripContent::where('trip_template_id', $trip->id)
            ->where('tab_type', $tabType)
            ->orderBy('version', 'desc')
            ->first();

        $newVersion = $existingContent ? $existingContent->version + 1 : 1;

        // If we want to keep history, create new version; otherwise update
        // For now, we'll update in place (no version history stored)
        $content = TripContent::updateOrCreate(
            [
                'trip_template_id' => $trip->id,
                'tab_type' => $tabType,
            ],
            [
                'content_delta' => $request->input('content_delta'),
                'content_html' => $request->input('content_html'),
                'version' => $newVersion,
                'updated_by' => auth()->id(),
            ]
        );

        AuditLog::log('update', 'trip_content', $content->id, null, [
            'tab_type' => $tabType,
            'version' => $newVersion,
        ]);

        return response()->json([
            'success' => true,
            'message' => ucfirst(str_replace('_', ' ', $tabType)) . ' saved successfully',
            'version' => $newVersion,
        ]);
    }

    /**
     * Get all tab contents for a trip
     */
    public function all(TripTemplate $trip)
    {
        $contents = TripContent::where('trip_template_id', $trip->id)
            ->orderBy('version', 'desc')
            ->get()
            ->keyBy('tab_type');

        return response()->json([
            'contents' => $contents,
        ]);
    }
}
