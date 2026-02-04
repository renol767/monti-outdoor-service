<?php

namespace App\Http\Controllers\front_pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Landing extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];

    // Fetch Hero Sections
    $mountainHero = \App\Models\TripTypeSection::where('slug', 'mountain-hero')->first();
    $outdoorHero = \App\Models\TripTypeSection::where('slug', 'outdoor-hero')->first();
    $indoorHero = \App\Models\TripTypeSection::where('slug', 'indoor-hero')->first();

    return view('content.front-pages.landing-page', [
        'pageConfigs' => $pageConfigs,
        'mountainHero' => $mountainHero,
        'outdoorHero' => $outdoorHero,
        'indoorHero' => $indoorHero,
    ]);
  }
}
