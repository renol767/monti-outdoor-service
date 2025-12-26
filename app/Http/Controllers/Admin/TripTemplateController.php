<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TripTemplate;
use App\Models\TripDeparture;
use App\Models\TripContent;
use App\Models\TripMedia;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TripTemplateController extends Controller
{
    /**
     * Display a listing of trip templates.
     */
    public function index(Request $request)
    {
        $query = TripTemplate::withCount(['departures', 'wishlists'])
            ->with(['departures' => function($q) {
                $q->where('start_date', '>=', now())
                  ->whereIn('status', ['available', 'limited'])
                  ->orderBy('start_date')
                  ->limit(1);
            }]);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('destination', 'like', "%{$request->search}%");
            });
        }

        $trips = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get available categories for filter
        $categories = TripTemplate::distinct()->pluck('category')->filter();

        return view('admin.trips.index', compact('trips', 'categories'));
    }

    /**
     * Show the form for creating a new trip template.
     */
    public function create()
    {
        return view('admin.trips.create');
    }

    /**
     * Store a newly created trip template.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'destination' => 'nullable|string|max:255',
            'category' => 'required|string|max:50',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'difficulty' => 'nullable|string|in:easy,moderate,hard,extreme',
            'thumbnail' => 'nullable|image|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $validated['status'] = 'draft';
        $validated['created_by'] = auth()->id();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('uploads/trips', 'public');
            $validated['thumbnail'] = 'storage/' . $path;
        }

        // Check slug uniqueness
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (TripTemplate::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter++;
        }

        $trip = TripTemplate::create($validated);

        // Log action
        AuditLog::log('create', 'trip_template', $trip->id, null, $trip->toArray());

        return redirect()
            ->route('admin.trip-management.edit', $trip)
            ->with('success', 'Trip template created! Now add content and departures.');
    }

    /**
     * Display the specified trip template.
     */
    public function show(TripTemplate $tripManagement)
    {
        return redirect()->route('admin.trip-management.edit', $tripManagement);
    }

    /**
     * Show the form for editing a trip template (main management page).
     */
    public function edit(TripTemplate $tripManagement)
    {
        $trip = $tripManagement;
        $trip->load([
            'departures' => function($q) {
                $q->orderBy('start_date');
            },
            'departures.variants',
            'departures.addons.addon',
            'contents',
            'media' => function($q) {
                $q->orderBy('sort_order');
            }
        ]);

        // Get content by tab type
        $contents = $trip->contents->keyBy('tab_type');

        return view('admin.trips.edit', compact('trip', 'contents'));
    }

    /**
     * Update the specified trip template.
     */
    public function update(Request $request, TripTemplate $tripManagement)
    {
        $trip = $tripManagement;
        $oldValues = $trip->toArray();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'destination' => 'nullable|string|max:255',
            'category' => 'required|string|max:50',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'difficulty' => 'nullable|string|in:easy,moderate,hard,extreme',
            'thumbnail' => 'nullable|image|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'nullable|string|in:draft,published,archived',
        ]);

        // Keep slug unless title changes significantly
        if (Str::slug($request->title) !== $trip->slug && $request->title !== $trip->title) {
            $newSlug = Str::slug($request->title);
            $originalSlug = $newSlug;
            $counter = 1;
            while (TripTemplate::where('slug', $newSlug)->where('id', '!=', $trip->id)->exists()) {
                $newSlug = $originalSlug . '-' . $counter++;
            }
            $validated['slug'] = $newSlug;
        }

        // Handle thumbnail upload (file or cropped base64)
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('uploads/trips', 'public');
            $validated['thumbnail'] = 'storage/' . $path;
        } elseif ($request->filled('thumbnail_cropped')) {
            // Handle base64 cropped thumbnail
            $base64 = $request->input('thumbnail_cropped');
            if (preg_match('/^data:image\/(\w+);base64,/', $base64, $matches)) {
                $imageData = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $base64));
                $filename = 'uploads/trips/thumbnail_' . time() . '_' . uniqid() . '.jpg';
                \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $imageData);
                $validated['thumbnail'] = 'storage/' . $filename;
            }
        }

        // Handle includes (array of amenities)
        $validated['includes'] = $request->input('includes', []);
        
        // Handle highlights (convert textarea lines to array)
        $highlightsText = $request->input('highlights', '');
        $validated['highlights'] = array_filter(array_map('trim', explode("\n", $highlightsText)));

        $trip->update($validated);

        // Log action
        AuditLog::log('update', 'trip_template', $trip->id, $oldValues, $trip->fresh()->toArray());

        return back()->with('success', 'Trip template updated successfully.');
    }

    /**
     * Remove the specified trip template.
     */
    public function destroy(TripTemplate $tripManagement)
    {
        $trip = $tripManagement;

        // Check if has orders
        $hasOrders = $trip->departures()->whereHas('orders')->exists();
        if ($hasOrders) {
            return back()->with('error', 'Cannot delete trip with existing orders. Archive it instead.');
        }

        AuditLog::log('delete', 'trip_template', $trip->id, $trip->toArray(), null);

        $trip->delete(); // Soft delete

        return redirect()
            ->route('admin.trip-management.index')
            ->with('success', 'Trip template deleted successfully.');
    }

    /**
     * Toggle publish status
     */
    public function togglePublish(TripTemplate $tripManagement)
    {
        $trip = $tripManagement;
        $oldStatus = $trip->status;

        if ($trip->status === 'published') {
            $trip->update(['status' => 'draft']);
            $message = 'Trip unpublished.';
        } else {
            // Validate before publishing
            $hasDepartures = $trip->departures()->exists();
            $hasVariants = $trip->departures()->whereHas('variants')->exists();

            if (!$hasDepartures || !$hasVariants) {
                return back()->with('error', 'Cannot publish: Trip must have at least one departure with variants.');
            }

            $trip->update(['status' => 'published']);
            $message = 'Trip published successfully!';
        }

        AuditLog::log('status_change', 'trip_template', $trip->id, 
            ['status' => $oldStatus], 
            ['status' => $trip->status]
        );

        return back()->with('success', $message);
    }

    /**
     * Duplicate a trip template
     */
    public function duplicate(TripTemplate $tripManagement)
    {
        $original = $tripManagement;

        DB::transaction(function() use ($original) {
            // Create copy
            $newTrip = $original->replicate();
            $newTrip->title = $original->title . ' (Copy)';
            $newTrip->slug = Str::slug($newTrip->title);
            $newTrip->status = 'draft';
            $newTrip->created_by = auth()->id();
            
            // Ensure unique slug
            $counter = 1;
            while (TripTemplate::where('slug', $newTrip->slug)->exists()) {
                $newTrip->slug = Str::slug($original->title . ' Copy ' . $counter++);
            }
            
            $newTrip->save();

            // Copy contents
            foreach ($original->contents as $content) {
                $newContent = $content->replicate();
                $newContent->trip_template_id = $newTrip->id;
                $newContent->save();
            }

            // Copy media references
            foreach ($original->media as $media) {
                $newMedia = $media->replicate();
                $newMedia->trip_template_id = $newTrip->id;
                $newMedia->save();
            }

            AuditLog::log('create', 'trip_template', $newTrip->id, null, ['duplicated_from' => $original->id]);
        });

        return redirect()
            ->route('admin.trip-management.index')
            ->with('success', 'Trip duplicated successfully! Find it as "' . $original->title . ' (Copy)"');
    }
}
