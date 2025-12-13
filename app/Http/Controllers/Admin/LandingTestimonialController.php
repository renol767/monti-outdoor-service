<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingTestimonial;
use Illuminate\Http\Request;

class LandingTestimonialController extends Controller
{
    public function index()
    {
        return redirect()->route('landing-customization');
    }

    public function create()
    {
        return view('admin.landing.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'avatar' => 'required|string', // URL or path
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar_file' => 'nullable|image|max:10240', // Max 10MB
        ]);

        $data = $request->all();

        // If avatar is file
        if ($request->hasFile('avatar_file')) {
            $path = $request->file('avatar_file')->store('uploads/testimonials', 'public');
            $data['avatar'] = 'storage/' . $path;
        }

        LandingTestimonial::create($data);

        return redirect()->route('landing-customization')->with('success', 'Testimonial created successfully.');
    }

    public function edit(LandingTestimonial $testimonial)
    {
        return view('admin.landing.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, LandingTestimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'avatar' => 'nullable|string', 
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar_file' => 'nullable|image|max:10240',
        ]);

        $data = $request->all();

         if ($request->hasFile('avatar_file')) {
            $path = $request->file('avatar_file')->store('uploads/testimonials', 'public');
            $data['avatar'] = 'storage/' . $path;
        }

        $testimonial->update($data);

        return redirect()->route('landing-customization')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(LandingTestimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('landing-customization')->with('success', 'Testimonial deleted successfully.');
    }
}
