<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserDashboardController extends Controller
{
    /**
     * Show main user dashboard
     */
    public function index()
    {
        return view('user.dashboard');
    }

    /**
     * Show user profile edit form
     */
    public function profile()
    {
        return view('user.profile');
    }

    /**
     * Update user profile information
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:1000'],
            'emergency_name' => ['nullable', 'string', 'max:255'],
            'emergency_phone' => ['nullable', 'string', 'max:20'],
            'emergency_relation' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'], // 2MB Max
        ]);

        $data = $request->only([
            'name', 'email', 'phone', 'address', 
            'emergency_name', 'emergency_phone', 'emergency_relation'
        ]);

        // Handle Avatar Upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete(str_replace('storage/', '', $user->avatar));
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = 'storage/' . $path;
        }

        if ($data['email'] !== $user->email && $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail) {
            $data['email_verified_at'] = null;
        }

        $user->forceFill($data)->save();

        if (isset($data['email_verified_at']) && $data['email_verified_at'] === null) {
            $user->sendEmailVerificationNotification();
        }

        return redirect()->back()->with('status', 'profile-updated');
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', \Illuminate\Validation\Rules\Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()->with('status', 'password-updated');
    }
}
