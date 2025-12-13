<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingTrip;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LandingTripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // This is handled in LandingPageController@index mostly, 
        // but if we want a separate page we can use this.
        // For now, we will redirect back to the main customization page
        return redirect()->route('landing-customization');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.landing.trips.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|string',
            'duration' => 'required|string',
            'difficulty' => 'required|string',
            'category' => 'required|string',
            'image' => 'required|image|max:10240', // Max 10MB
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_popular'] = $request->has('is_popular');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/trips', 'public');
            $data['image'] = 'storage/' . $path;
        }

        LandingTrip::create($data);

        return redirect()->route('landing-customization')->with('success', 'Trip created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LandingTrip $trip)
    {
        return view('admin.landing.trips.edit', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LandingTrip $trip)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|string',
            'duration' => 'required|string',
            'difficulty' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|max:10240',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_popular'] = $request->has('is_popular');

        if ($request->hasFile('image')) {
            // Delete old image if it exists and is not a default asset
            if ($trip->image && file_exists(public_path($trip->image)) && strpos($trip->image, 'storage/') === 0) {
                 // Clean up old storage file if necessary, skipping for now to rely on unique names
            }
            
            $path = $request->file('image')->store('uploads/trips', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $trip->update($data);

        return redirect()->route('landing-customization')->with('success', 'Trip updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LandingTrip $trip)
    {
        $trip->delete();
        return redirect()->route('landing-customization')->with('success', 'Trip deleted successfully.');
    }
}
