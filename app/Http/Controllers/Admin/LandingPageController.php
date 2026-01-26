<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandingSetting;
use App\Models\LandingFeature;
use App\Models\LandingTrip;
use App\Models\LandingService;
use App\Models\LandingGallery;
use App\Models\TripTemplate;

class LandingPageController extends Controller
{
    public function index()
    {
        $settings = LandingSetting::all()->keyBy('key');
        $features = LandingFeature::orderBy('order')->get();
        // $trips = LandingTrip::orderBy('order')->get(); // Old logic, can still keep for reference if needed or remove
        $trips = LandingTrip::orderBy('order')->get(); // Keeping it for now as view expects it, but we are moving to TripTemplate
        $services = LandingService::orderBy('order')->get();
        $gallery = LandingGallery::orderBy('order')->get();

        $openTrips = TripTemplate::all();

        return view('admin.landing.index', compact('settings', 'features', 'trips', 'services', 'gallery', 'openTrips'));
    }

    public function updateSettings(Request $request)
    {
        $inputs = $request->except(['_token']);

        // Handle Terms & Conditions Images (multiple upload)
        if ($request->hasFile('terms_conditions_images')) {
            $existingImages = [];
            $existingSetting = LandingSetting::where('key', 'terms_conditions_images')->first();
            if ($existingSetting && $existingSetting->value) {
                $existingImages = json_decode($existingSetting->value, true) ?: [];
            }

            foreach ($request->file('terms_conditions_images') as $file) {
                if ($file->getSize() > 10 * 1024 * 1024) {
                    continue; // Skip files larger than 10MB
                }
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/terms-conditions', $filename, 'public');
                $existingImages[] = 'storage/' . $path;
            }

            // Sanitization: Ensure all items are strings (flatten if necessary)
            $flatImages = [];
            array_walk_recursive($existingImages, function($a) use (&$flatImages) {
                if(is_string($a)) $flatImages[] = $a;
            });
            $existingImages = $flatImages;

            LandingSetting::updateOrCreate(
                ['key' => 'terms_conditions_images'],
                ['value' => json_encode($existingImages), 'type' => 'json']
            );
            unset($inputs['terms_conditions_images']);
        }

        // Handle T&C image deletion (By Index)
        if ($request->has('delete_tc_images_indices')) {
            $toDeleteIndices = $request->input('delete_tc_images_indices', []);
            $existingSetting = LandingSetting::where('key', 'terms_conditions_images')->first();
            if ($existingSetting && $existingSetting->value) {
                $existingImages = json_decode($existingSetting->value, true) ?: [];
                
                // Sort indices descending to avoid shifting issues when unsetting
                rsort($toDeleteIndices);

                foreach ($toDeleteIndices as $index) {
                    if (isset($existingImages[$index])) {
                        $imgPath = $existingImages[$index];
                        
                        // Try to extract string path if it's an array (corrupted)
                        if (is_array($imgPath)) {
                            $imgPath = isset($imgPath[0]) && is_string($imgPath[0]) ? $imgPath[0] : null;
                        }

                        // Remove from filesystem if it's a valid string path
                        if ($imgPath && is_string($imgPath)) {
                            $fullPath = public_path($imgPath);
                            if (file_exists($fullPath)) {
                                unlink($fullPath);
                            }
                        }

                        // Remove from array by index
                        unset($existingImages[$index]);
                    }
                }
                
                // Re-index array
                $existingImages = array_values($existingImages);

                LandingSetting::updateOrCreate(
                    ['key' => 'terms_conditions_images'],
                    ['value' => json_encode($existingImages), 'type' => 'json']
                );
            }
        }

        // Handle File Uploads (single files)
        foreach ($request->allFiles() as $key => $file) {
            if ($key === 'terms_conditions_images') continue; // Already handled above
            
            // Validate size (50MB)
            if ($file->getSize() > 50 * 1024 * 1024) {
                return redirect()->back()->with('error', "Image for '{$key}' exceeds the maximum allowed size of 50MB.");
            }

            $filename = time() . '_' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            if ($file->getMimeType() === 'image/png') {
                 $filename .= '.png';
            } else {
                 $filename .= '.' . $file->getClientOriginalExtension();
            }
            $path = $file->storeAs('uploads/landing', $filename, 'public');
            $value = 'storage/' . $path;

            LandingSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => 'image'] // Assume image for files
            );
            
            // Remove from inputs so we don't process it twice or overwrite with object
            unset($inputs[$key]); 
        }

        // Handle Remaining Text Inputs
        foreach ($inputs as $key => $value) {
            if ($value !== null) {
                LandingSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function updatePopularTrips(Request $request)
    {
        $selectedIds = $request->input('popular_trips', []);
        $orders = $request->input('popular_orders', []);

        if (count($selectedIds) > 6) {
            return back()->with('error', 'You can only select up to 6 popular trips.');
        }

        // Reset all trips popular status
        TripTemplate::query()->update(['is_popular' => false, 'popular_order' => null]);

        // Update selected trips
        if (!empty($selectedIds)) {
            foreach ($selectedIds as $id) {
                $order = isset($orders[$id]) ? (int)$orders[$id] : 0;
                TripTemplate::where('id', $id)->update([
                    'is_popular' => true,
                    'popular_order' => $order
                ]);
            }
        }

        return back()->with('success', 'Popular trips updated successfully.');
    }
}
