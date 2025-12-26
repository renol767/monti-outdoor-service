<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TripTemplate;
use App\Models\TripDeparture;
use App\Models\DepartureVariant;
use App\Models\DepartureAddon;
use App\Models\Addon;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TripDepartureController extends Controller
{
    /**
     * Store a new departure for a trip.
     */
    public function store(Request $request, TripTemplate $trip)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'capacity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $validated['trip_template_id'] = $trip->id;
        $validated['status'] = 'available';

        $departure = TripDeparture::create($validated);

        AuditLog::log('create', 'trip_departure', $departure->id, null, $departure->toArray());

        return back()->with('success', 'Departure added. Now add pricing variants.');
    }

    /**
     * Update a departure.
     */
    public function update(Request $request, TripDeparture $departure)
    {
        $oldValues = $departure->toArray();

        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'capacity' => 'required|integer|min:1',
            'status' => 'nullable|string|in:available,limited,sold_out,closed',
            'notes' => 'nullable|string',
            'discount_type' => 'nullable|string|in:fixed,percent',
            'discount_value' => 'nullable|integer|min:0',
            'discount_start_at' => 'nullable|date',
            'discount_end_at' => 'nullable|date|after_or_equal:discount_start_at',
        ]);

        $departure->update($validated);

        AuditLog::log('update', 'trip_departure', $departure->id, $oldValues, $departure->fresh()->toArray());

        return back()->with('success', 'Departure updated.');
    }

    /**
     * Delete a departure.
     */
    public function destroy(TripDeparture $departure)
    {
        // Check for orders
        if ($departure->orders()->exists()) {
            return back()->with('error', 'Cannot delete departure with orders. Close it instead.');
        }

        AuditLog::log('delete', 'trip_departure', $departure->id, $departure->toArray(), null);

        $departure->delete();

        return back()->with('success', 'Departure deleted.');
    }

    /**
     * Quick action: Mark as sold out
     */
    public function markSoldOut(TripDeparture $departure)
    {
        $departure->update(['status' => 'sold_out']);
        return back()->with('success', 'Departure marked as sold out.');
    }

    /**
     * Quick action: Close departure
     */
    public function close(TripDeparture $departure)
    {
        $departure->update(['status' => 'closed']);
        return back()->with('success', 'Departure closed.');
    }

    /**
     * Quick action: Update capacity and addon limits
     */
    public function updateCapacity(Request $request, TripDeparture $departure)
    {
        $validated = $request->validate([
            'capacity' => 'required|integer|min:1',
            'addon_max_qty' => 'nullable|array',
            'addon_max_qty.*' => 'nullable|integer|min:1',
        ]);

        $departure->update(['capacity' => $validated['capacity']]);
        
        // Update addon max quantities if provided
        if (!empty($validated['addon_max_qty'])) {
            foreach ($validated['addon_max_qty'] as $addonId => $maxQty) {
                DepartureAddon::where('id', $addonId)
                    ->where('departure_id', $departure->id)
                    ->update(['max_qty' => $maxQty ?: null]);
            }
        }
        
        return back()->with('success', 'Capacity and addon limits updated.');
    }

    /**
     * Duplicate departure to new dates
     */
    public function duplicate(Request $request, TripDeparture $departure)
    {
        $validated = $request->validate([
            'new_start_date' => 'required|date|after_or_equal:today',
            'new_end_date' => 'required|date|after_or_equal:new_start_date',
        ]);

        $newDeparture = $departure->replicate();
        $newDeparture->start_date = $validated['new_start_date'];
        $newDeparture->end_date = $validated['new_end_date'];
        $newDeparture->status = 'available';
        $newDeparture->booked_count = 0;
        $newDeparture->save();

        // Copy variants
        foreach ($departure->variants as $variant) {
            $newVariant = $variant->replicate();
            $newVariant->departure_id = $newDeparture->id;
            $newVariant->booked_count = 0;
            $newVariant->save();
        }

        // Copy addons
        foreach ($departure->addons as $addon) {
            $newAddon = $addon->replicate();
            $newAddon->departure_id = $newDeparture->id;
            $newAddon->save();
        }

        return back()->with('success', 'Departure duplicated with new dates.');
    }

    // ===== VARIANTS =====

    /**
     * Store a new variant for a departure.
     */
    public function storeVariant(Request $request, TripDeparture $departure)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|integer|min:1000',
            'quota' => 'nullable|integer|min:1',
            'discount_type' => 'nullable|string|in:fixed,percent',
            'discount_value' => 'nullable|integer|min:0',
            'discount_start_at' => 'nullable|date',
            'discount_end_at' => 'nullable|date|after_or_equal:discount_start_at',
        ]);

        $validated['departure_id'] = $departure->id;
        $validated['is_active'] = true;
        $validated['sort_order'] = $departure->variants()->count();

        DepartureVariant::create($validated);

        return back()->with('success', 'Variant added.');
    }

    /**
     * Update a variant.
     */
    public function updateVariant(Request $request, DepartureVariant $variant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|integer|min:1000',
            'quota' => 'nullable|integer|min:1',
            'is_active' => 'nullable|boolean',
            'discount_type' => 'nullable|string|in:fixed,percent',
            'discount_value' => 'nullable|integer|min:0',
            'discount_start_at' => 'nullable|date',
            'discount_end_at' => 'nullable|date|after_or_equal:discount_start_at',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $variant->update($validated);

        return back()->with('success', 'Variant updated.');
    }

    /**
     * Delete a variant.
     */
    public function destroyVariant(DepartureVariant $variant)
    {
        $variant->delete();
        return back()->with('success', 'Variant deleted.');
    }

    // ===== ADDONS =====

    /**
     * Assign an addon to a departure.
     */
    public function storeAddon(Request $request, TripDeparture $departure)
    {
        $validated = $request->validate([
            'addon_id' => 'required|exists:addons,id',
            'price' => 'required|integer|min:0',
            'max_qty' => 'nullable|integer|min:1',
        ]);

        // Check if already assigned
        if ($departure->addons()->where('addon_id', $validated['addon_id'])->exists()) {
            return back()->with('error', 'Addon already assigned to this departure.');
        }

        $validated['departure_id'] = $departure->id;
        $validated['is_active'] = true;

        DepartureAddon::create($validated);

        return back()->with('success', 'Addon assigned.');
    }

    /**
     * Update addon assignment.
     */
    public function updateAddon(Request $request, DepartureAddon $departureAddon)
    {
        $validated = $request->validate([
            'price' => 'required|integer|min:0',
            'max_qty' => 'nullable|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $departureAddon->update($validated);

        return back()->with('success', 'Addon updated.');
    }

    /**
     * Remove addon from departure.
     */
    public function destroyAddon(DepartureAddon $departureAddon)
    {
        $departureAddon->delete();
        return back()->with('success', 'Addon removed.');
    }
}
