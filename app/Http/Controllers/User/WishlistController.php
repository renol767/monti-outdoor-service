<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the user's wishlist.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Load the wishlists with the associated trip templates, including media for cover image
        $wishlists = $user->wishlists()
            ->with(['tripTemplate' => function($query) {
                // Ensure we get published trips only
                $query->where('status', 'published');
            }])
            ->latest()
            ->get();

        return view('user.wishlist', compact('wishlists'));
    }

    /**
     * Toggle a trip template in the user's wishlist.
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'trip_template_id' => 'required|exists:trip_templates,id',
        ]);

        $user = Auth::user();
        $tripId = $request->trip_template_id;

        $wishlist = Wishlist::where('user_id', $user->id)
            ->where('trip_template_id', $tripId)
            ->first();

        if ($wishlist) {
            // Already exists, remove it
            $wishlist->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Trip removed from wishlist'
            ]);
        } else {
            // Doesn't exist, add it
            Wishlist::create([
                'user_id' => $user->id,
                'trip_template_id' => $tripId,
            ]);
            return response()->json([
                'status' => 'added',
                'message' => 'Trip added to wishlist'
            ]);
        }
    }
}
