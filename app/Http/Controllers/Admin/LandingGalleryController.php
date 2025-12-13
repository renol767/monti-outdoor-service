<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingGalleryController extends Controller
{
    public function index()
    {
        return redirect()->route('landing-customization');
    }

    public function create()
    {
        return view('admin.landing.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:10240', // Max 10MB
            'caption' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/gallery', 'public');
            $data['image'] = 'storage/' . $path;
        }

        LandingGallery::create($data);

        return redirect()->route('landing-customization')->with('success', 'Image added to gallery successfully.');
    }

    public function edit(LandingGallery $gallery)
    {
        return view('admin.landing.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, LandingGallery $gallery)
    {
        $request->validate([
            'image' => 'nullable|image|max:10240',
            'caption' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/gallery', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $gallery->update($data);

        return redirect()->route('landing-customization')->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(LandingGallery $gallery)
    {
        // Ideally delete the file too
        // Storage::disk('public')->delete(str_replace('storage/', '', $gallery->image));
        $gallery->delete();
        return redirect()->route('landing-customization')->with('success', 'Gallery image deleted successfully.');
    }
}
