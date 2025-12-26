<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Addon;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    /**
     * Display a listing of addons.
     */
    public function index()
    {
        $addons = Addon::orderBy('name')->paginate(20);
        return view('admin.addons.index', compact('addons'));
    }

    /**
     * Store a newly created addon.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'default_price' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
        ]);

        $validated['is_active'] = true;

        Addon::create($validated);

        return back()->with('success', 'Addon created.');
    }

    /**
     * Update the specified addon.
     */
    public function update(Request $request, Addon $addon)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'default_price' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $addon->update($validated);

        return back()->with('success', 'Addon updated.');
    }

    /**
     * Remove the specified addon.
     */
    public function destroy(Addon $addon)
    {
        // Check if used in any departure
        if ($addon->departureAddons()->exists()) {
            return back()->with('error', 'Cannot delete addon in use. Deactivate it instead.');
        }

        $addon->delete();

        return back()->with('success', 'Addon deleted.');
    }
}
