<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch application language
     * 
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switch($locale)
    {
        // Validate locale
        $availableLocales = ['en', 'id'];
        
        if (!in_array($locale, $availableLocales)) {
            return redirect()->back()->with('error', 'Invalid language selection');
        }
        
        // Store locale in session
        Session::put('locale', $locale);
        
        // Set app locale for current request
        app()->setLocale($locale);
        
        return redirect()->back()->with('success', 'Language changed successfully');
    }
}
