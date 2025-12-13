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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string', // SVG code or class
            'features' => 'nullable|string', // Features as new-line separated string
        ]);

        $data = $request->all();
        // features input will be a string, we need to explode it to array for JSON casting
        if ($request->has('features')) {
            $data['features'] = array_filter(array_map('trim', explode("\n", $request->features)));
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string',
            'features' => 'nullable|string',
        ]);

        $data = $request->all();
        if ($request->has('features')) {
            $data['features'] = array_filter(array_map('trim', explode("\n", $request->features)));
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
