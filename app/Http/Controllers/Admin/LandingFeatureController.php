<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingFeature;
use Illuminate\Http\Request;

class LandingFeatureController extends Controller
{
    public function index()
    {
        return redirect()->route('landing-customization');
    }

    public function create()
    {
        return view('admin.landing.features.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string', // SVG code
        ]);

        LandingFeature::create($request->all());

        return redirect()->route('landing-customization')->with('success', 'Feature created successfully.');
    }

    public function edit(LandingFeature $feature)
    {
        return view('admin.landing.features.edit', compact('feature'));
    }

    public function update(Request $request, LandingFeature $feature)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string',
        ]);

        $feature->update($request->all());

        return redirect()->route('landing-customization')->with('success', 'Feature updated successfully.');
    }

    public function destroy(LandingFeature $feature)
    {
        $feature->delete();
        return redirect()->route('landing-customization')->with('success', 'Feature deleted successfully.');
    }
}
