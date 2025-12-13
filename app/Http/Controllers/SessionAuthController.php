<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionAuthController extends Controller
{
    /**
     * Handle session-based login
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
    
    /**
     * Handle session logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}
