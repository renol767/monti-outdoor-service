<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingService;
use Illuminate\Http\Request;

class LandingServiceController extends Controller
{
    public function index()
    {
        return redirect()->route('landing-customization');
    }

    public function create()
    {
        return view('admin.landing.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|array',
            'title.id' => 'required|string|max:255',
            'description' => 'required|array',
            'description.id' => 'required|string',
            'icon' => 'required|string', // SVG code or class
            'features' => 'nullable|array', // Features as array of locale strings
        ]);

        $data = $request->all();
        // features input will be an array ['id' => "A\nB", 'en' => "C\nD"], need to explode each
        if ($request->has('features') && is_array($request->features)) {
            $formattedFeatures = [];
            foreach ($request->features as $locale => $content) {
                if ($content) {
                    $formattedFeatures[$locale] = array_values(array_filter(array_map('trim', explode("\n", $content))));
                }
            }
            $data['features'] = $formattedFeatures;
        }

        LandingService::create($data);

        return redirect()->route('landing-customization')->with('success', 'Service created successfully.');
    }

    public function edit(LandingService $service)
    {
        return view('admin.landing.services.edit', compact('service'));
    }

    public function update(Request $request, LandingService $service)
    {
        $request->validate([
            'title' => 'required|array',
            'title.id' => 'required|string|max:255',
            'description' => 'required|array',
            'description.id' => 'required|string',
            'icon' => 'required|string',
            'features' => 'nullable|array',
        ]);

        $data = $request->all();
        if ($request->has('features') && is_array($request->features)) {
            $formattedFeatures = [];
            foreach ($request->features as $locale => $content) {
                if ($content) {
                    $formattedFeatures[$locale] = array_values(array_filter(array_map('trim', explode("\n", $content))));
                }
            }
            $data['features'] = $formattedFeatures;
        }

        $service->update($data);

        return redirect()->route('landing-customization')->with('success', 'Service updated successfully.');
    }

    public function destroy(LandingService $service)
    {
        $service->delete();
        return redirect()->route('landing-customization')->with('success', 'Service deleted successfully.');
    }
}
