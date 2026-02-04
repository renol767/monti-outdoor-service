<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Primary Meta Tags -->
  <title>{{ $trip->title }} - Monti Outdoor Service</title>
  <meta name="title" content="{{ $trip->title }} - Monti Outdoor Service">
  <meta name="description" content="{{ $trip->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($trip->description ?? ''), 160) }}">
  <meta name="author" content="Monti Outdoor Service">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="{{ url()->current() }}">
  
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
  <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
  <meta name="theme-color" content="#e97543">
  
  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="{{ $trip->title }} - Monti Outdoor Service">
  <meta property="og:description" content="{{ $trip->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($trip->description ?? ''), 160) }}">
  <meta property="og:image" content="{{ asset($trip->thumbnail ?? $settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}">
  <meta property="og:locale" content="id_ID">
  <meta property="og:site_name" content="Monti Outdoor Service">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="{{ url()->current() }}">
  <meta property="twitter:title" content="{{ $trip->title }} - Monti Outdoor Service">
  <meta property="twitter:description" content="{{ $trip->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($trip->description ?? ''), 160) }}">
  <meta property="twitter:image" content="{{ asset($trip->thumbnail ?? $settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}">

  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
  @vite(['resources/css/landing-ui-fixes.css'])
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <style>
    .product-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 2rem;
    }
    
    /* Trip Facts Grid */
    .trip-facts-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1.25rem;
      padding: 1.5rem;
      background: transparent;
    }
    @media (min-width: 768px) {
      .trip-facts-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }
    @media (min-width: 1024px) {
      .trip-facts-grid {
        grid-template-columns: repeat(5, 1fr);
      }
    }
    @media (min-width: 992px) {
      .product-grid {
        grid-template-columns: 60% 40%;
      }
    }
    .booking-panel {
      background: #1e1e1e; /* Dark background */
      border: 1px solid rgba(251, 202, 165, 0.1);
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.3);
      height: fit-content;
      position: sticky;
      top: 100px;
      color: #fbcaa5; /* Text color */
    }
    .content-image-limit {
      max-width: 80%;
      height: auto;
      max-height: 80vh;
      object-fit: contain;
      display: block;
      margin: 0 auto;
      border-radius: 8px;
    }
    @media (max-width: 768px) {
        .content-image-limit {
            max-width: 100%;
        }
    }
    .booking-panel h4 {
      color: #fbcaa5 !important;
    }
    .variant-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem;
      border: 2px solid rgba(255,255,255,0.1);
      border-radius: 8px;
      margin-bottom: 0.5rem;
      cursor: pointer;
      transition: all 0.2s;
      background: rgba(255,255,255,0.05);
      color: rgba(255,255,255,0.9);
    }
    .variant-item:hover, .variant-item.selected {
      border-color: #e97543;
      background: rgba(233, 117, 67, 0.1);
    }
    .variant-item:hover, .variant-item.selected {
      border-color: #e97543;
      background: rgba(233, 117, 67, 0.1);
    }
    
    /* Sticky Booking Panel Select */
    .select-dark {
        background-color: #1e1e1e;
        color: #fbcaa5;
        border: 2px solid rgba(251, 202, 165, 0.3);
        border-radius: 8px;
        padding: 0.75rem;
        width: 100%;
        cursor: pointer;
        appearance: none; /* remove default arrow */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23fbcaa5' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        font-size: 0.9rem;
    }
    .select-dark:focus {
        border-color: #e97543;
        outline: none;
    }

    /* 1 Top + 4 Bottom Layout */
    .gallery-stack {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }
    .gallery-stack-top {
        width: 100%;
        aspect-ratio: 16/9; /* or 4/3 as preferred */
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
    }
    .gallery-stack-bottom {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.75rem;
    }
    .gallery-stack-thumb {
        aspect-ratio: 1;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
    }
    .gallery-stack-thumb img, .gallery-stack-top img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .gallery-stack-thumb:hover img, .gallery-stack-top:hover img {
        transform: scale(1.05);
    }
    
    @media (max-width: 768px) {
        .gallery-stack-top {
            aspect-ratio: 4/3;
        }
    }
    .content-section {
      background: #1e1e1e; /* Dark background */
      border-radius: 12px;
      margin-top: 2rem;
      overflow: hidden;
      border: 1px solid rgba(251, 202, 165, 0.1);
    }
    .content-tabs {
      display: flex;
      border-bottom: 1px solid rgba(255,255,255,0.1);
      overflow-x: auto;
    }
    .content-tabs button {
      padding: 1rem 1.5rem;
      background: none;
      border: none;
      font-weight: 500;
      color: #9ca3af;
      cursor: pointer;
      white-space: nowrap;
      border-bottom: 3px solid transparent;
      transition: all 0.2s;
    }
    .content-tabs button:hover {
      color: var(--color-primary);
    }
    .content-tabs button.active {
      color: var(--color-primary);
      border-bottom-color: var(--color-primary);
    }
    .content-panel {
      padding: 1.5rem;
      display: none;
    }
    .content-panel.active {
      display: block;
    }
    .content-panel p, .content-panel ul, .content-panel ol, .content-panel li {
      color: #d1d5db; /* Lighter text */
      line-height: 1.8;
    }
    .content-panel ul, .content-panel ol {
      padding-left: 1.5rem;
      margin-bottom: 1rem;
    }
    .content-panel li {
      margin-bottom: 0.5rem;
    }
    .content-panel h1, .content-panel h2, .content-panel h3, .content-panel h4, .content-panel h5, .content-panel h6 {
      color: #f3f4f6; /* White headers */
      margin-top: 1.5rem;
      margin-bottom: 0.75rem;
    }
    .content-panel h1:first-child, .content-panel h2:first-child, .content-panel h3:first-child {
      margin-top: 0;
    }
    
    /* Hero Section */
    .trip-hero {
      position: relative;
      width: 100%;
      min-height: 100vh; /* Full viewport height */
      margin-top: 0; /* Start from top to show navbar transparency */
      margin-bottom: 0;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .trip-hero-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      z-index: 1;
    }
    .trip-hero-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: transparent;
      display: flex;
      flex-direction: column;
      align-items: center; /* Horiz Center */
      justify-content: center; /* Vert Center */
      text-align: center;
      padding: 3rem 1rem;
      z-index: 2;
    }
    .hero-badge {
      background: #e97543;
      color: white;
      padding: 0.5rem 1rem;
      font-weight: 600;
      display: inline-block;
      margin-bottom: 1rem;
      border-radius: 4px;
    }
    .hero-title {
      font-size: 3rem;
      font-weight: 800;
      color: white;
      text-transform: uppercase;
      margin: 0;
      line-height: 1.1;
      font-style: italic;
    }
    .hero-subtitle {
      font-size: 1.5rem;
      color: rgba(255,255,255,0.9);
      font-weight: 600;
      font-style: italic;
      margin-top: 0.5rem;
    }

    /* Transparent Navbar (like main page) */
    .header {
      background: transparent !important;
      backdrop-filter: none !important;
      box-shadow: none !important;
      transition: all 0.3s ease;
    }
    
    .header.scrolled {
      background: rgba(42, 42, 42, 0.95) !important;
      backdrop-filter: blur(10px) !important;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2) !important;
    }
    
    /* Fix Mobile Menu Background (dark like main page) */
    .nav.mobile-open {
      background: rgba(30, 30, 30, 0.95) !important;
      backdrop-filter: blur(10px) !important;
    }
    
    /* Fix Mobile Submenu - Dark background with light text */
    @media (max-width: 1023px) {
      .nav.mobile-open .dropdown-menu {
        background: rgba(21, 21, 21, 0.95) !important;
        backdrop-filter: blur(10px) !important;
        position: static !important;
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
        margin-top: 0.5rem !important;
        box-shadow: none !important;
      }
      
      .nav.mobile-open .dropdown-item {
        color: #fbcaa5 !important;
        padding: 0.75rem 1.5rem !important;
      }
      
      .nav.mobile-open .dropdown-item:hover {
        background: rgba(251, 202, 165, 0.15) !important;
        color: #e97543 !important;
      }
    }

    /* Modal Gallery */
    .modal-gallery-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.9);
      z-index: 9999;
      align-items: center;
      justify-content: center;
    }
    .modal-gallery-overlay.active {
      display: flex;
    }
    .gallery-modal-content {
      background: white;
      width: 90%;
      max-width: 1200px;
      height: 85vh;
      display: flex;
      border-radius: 12px;
      overflow: hidden;
      position: relative;
    }
    .gallery-main-view {
      flex: 1;
      background: #000;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }
    .gallery-main-img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }
    .gallery-sidebar {
      width: 320px;
      background: white;
      padding: 1.5rem;
      overflow-y: auto;
      border-left: 1px solid #e5e7eb;
      display: flex;
      flex-direction: column;
    }
    .gallery-sidebar-title {
      font-size: 1.1rem;
      font-weight: 700;
      margin-bottom: 1rem;
      color: #1f2937;
    }
    .gallery-grid-sidebar {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 0.75rem;
    }
    .sidebar-thumb {
      aspect-ratio: 1;
      border-radius: 6px;
      overflow: hidden;
      cursor: pointer;
      border: 2px solid transparent;
    }
    .sidebar-thumb.active {
      border-color: #e97543;
    }
    .sidebar-thumb img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .modal-close-btn {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: white;
      border: none;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      z-index: 100;
      box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    .nav-btn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(255,255,255,0.2);
      color: white;
      border: none;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background 0.3s;
    }
    .nav-btn:hover {
      background: rgba(255,255,255,0.4);
    }
    .prev-btn { left: 1rem; }
    .next-btn { right: 1rem; }
    
    @media (max-width: 768px) {
      .gallery-modal-content {
        flex-direction: column;
        height: 100%;
        width: 100%;
        border-radius: 0;
      }
      .gallery-sidebar {
        width: 100%;
        height: 150px;
        flex: none;
        flex-direction: row;
        gap: 1rem;
        padding: 1rem;
      }
      .gallery-grid-sidebar {
        display: flex;
        gap: 0.5rem;
        overflow-x: auto;
      }
      .sidebar-thumb {
        width: 80px;
        flex: none;
      }
      .trip-hero {
        height: 350px;
      }
      .hero-title {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>
  <!-- Header (same as Index) -->
  <header id="header" class="header">
    <div class="container">
      <div class="header-content">
        <div class="logo">
          <a href="{{ route('landing') }}">
            <img src="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}" alt="Logo" width="100">
          </a>
        </div>

        <button class="mobile-menu-btn" aria-label="Toggle menu">
          <span></span>
          <span></span>
          <span></span>
        </button>

        <nav class="nav">
          <!-- About Us - direct link -->
          <a href="{{ route('about-us') }}" class="nav-link">About Us</a>

          <!-- Open Trip - no submenu -->
          <a href="{{ route('open-trip') }}" class="nav-link">Open Trip</a>
          
          <!-- Mountain Trip with submenu -->
          <div class="dropdown">
            <a href="{{ route('mountain-trip') }}" class="custom-dropdown-toggle dropdown-toggle">
              Mountain Trip
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </a>
            <div class="dropdown-menu">
              <a href="{{ route('open-trip') }}" class="dropdown-item">Open Trip</a>
              <a href="{{ route('mountain-trip') }}#private-trip" class="dropdown-item">Private Trip</a>
              <a href="{{ route('mountain-trip') }}#one-day-trip" class="dropdown-item">One Day Trip</a>
              <a href="{{ route('mountain-trip') }}#expedition-trip" class="dropdown-item">Expedition Trip</a>
              <a href="{{ route('mountain-trip') }}#international-trip" class="dropdown-item">International Trip</a>
              <a href="{{ route('mountain-trip') }}#custom-trip" class="dropdown-item">Custom Trip</a>
            </div>
          </div>

          <!-- Outdoor Activity Trip with submenu -->
          <div class="dropdown">
            <a href="{{ route('outdoor-trip') }}" class="custom-dropdown-toggle dropdown-toggle">
              Outdoor Activity Trip
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </a>
            <div class="dropdown-menu">
              <a href="{{ route('outdoor-trip') }}#cultural-trip" class="dropdown-item">Cultural Trip</a>
              <a href="{{ route('outdoor-trip') }}#one-day-outdoor-trip" class="dropdown-item">One Day Trip</a>
              <a href="{{ route('outdoor-trip') }}#island-trip" class="dropdown-item">Island Trip</a>
              <a href="{{ route('outdoor-trip') }}#camping-trip" class="dropdown-item">Camping</a>
              <a href="{{ route('outdoor-trip') }}#outdoor-team-building" class="dropdown-item">Outdoor Team Building</a>
              <a href="{{ route('outdoor-trip') }}#outdoor-custom-trip" class="dropdown-item">Outdoor Custom Trip</a>
            </div>
          </div>

          <!-- Indoor Activity Trip with submenu -->
          <div class="dropdown">
            <a href="{{ route('indoor-trip') }}" class="custom-dropdown-toggle dropdown-toggle">
              Indoor Activity Trip
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </a>
            <div class="dropdown-menu">
              <a href="{{ route('indoor-trip') }}#city-tour" class="dropdown-item">City Tour</a>
              <a href="{{ route('indoor-trip') }}#company-gathering" class="dropdown-item">Company Gathering</a>
              <a href="{{ route('indoor-trip') }}#outing-tour-travel" class="dropdown-item">Outing, Tour & Travel</a>
              <a href="{{ route('indoor-trip') }}#mice-organizer" class="dropdown-item">MICE Organizer</a>
              <a href="{{ route('indoor-trip') }}#indoor-team-building" class="dropdown-item">Indoor Team Building</a>
              <a href="{{ route('indoor-trip') }}#indoor-custom-trip" class="dropdown-item">Indoor Custom Trip</a>
            </div>
          </div>

          <!-- Contact -->
          <a href="{{ route('landing') }}#contact" class="nav-link">Contact</a>
          
          <!-- Language Switcher -->
          <div class="dropdown">
            <a href="#" class="custom-dropdown-toggle dropdown-toggle" style="display: flex; align-items: center; gap: 0.5rem;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="2" y1="12" x2="22" y2="12"/>
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
              </svg>
              <span>{{ strtoupper(app()->getLocale()) }}</span>
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </a>
            <div class="dropdown-menu">
              <a href="{{ route('lang.switch', 'id') }}" class="dropdown-item {{ app()->getLocale() == 'id' ? 'active' : '' }}">
                🇮🇩 Indonesia
              </a>
              <a href="{{ route('lang.switch', 'en') }}" class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                🇬🇧 English
              </a>
            </div>
          </div>
          
          <a href="{{ route('login') }}" class="btn btn-primary">Book Now</a>
        </nav>
      </div>
    </div>
  </header>

  <!-- Breadcrumb removed from here -->

  <!-- Hero Section (New) -->
  @if($trip->thumbnail_landscape)
  <div class="trip-hero">
    <img src="{{ asset($trip->thumbnail_landscape) }}" alt="Hero Background" class="trip-hero-bg">
    <div class="trip-hero-overlay">
      <div class="container">
        <span class="hero-badge">Open Trip</span>
        <h1 class="hero-title">{{ $trip->title }}</h1>
        <p class="hero-subtitle">{{ $trip->destination }}</p>
      </div>
    </div>
  </div>
  @endif

  <!-- Breadcrumb (Moved Below Hero) -->
  <nav style="background: transparent; padding: 1rem 0; margin-top: {{ $trip->thumbnail_landscape ? '1rem' : '100px' }}; position: relative; z-index: 2;">
    <div class="container">
      <a href="{{ route('landing') }}" style="color: #fbcaa5; text-decoration: none;">Home</a>
      <span style="color: rgba(251, 202, 165, 0.5); margin: 0 0.5rem;">›</span>
      <a href="{{ route('open-trip') }}" style="color: #fbcaa5; text-decoration: none;">Open Trip</a>
      <span style="color: rgba(251, 202, 165, 0.5); margin: 0 0.5rem;">›</span>
      <span style="color: #fbcaa5; font-weight: 600;">{{ $trip->title }}</span>
    </div>
  </nav>

  <!-- Main Content: Image (60%) + Book Now (40%) -->
  <section style="padding: 2rem 0;">
    <div class="container">
      <div class="product-grid">
        <!-- LEFT: Image (60%) -->
        <!-- LEFT: Image Grid (Revised - 5 Images) -->
        <div>
           @php
               // Collect all images: Thumbnail (4:5) + Gallery
               $allImages = collect();
               if($trip->thumbnail) {
                   $allImages->push((object)['file_path' => $trip->thumbnail, 'id' => 'thumb', 'is_video' => false]);
               }
               foreach($gallery as $img) {
                   $allImages->push($img);
               }
           @endphp

           <div class="gallery-stack">
              <!-- Top Big Image with Badges -->
              @if(isset($allImages[0]))
              <div class="gallery-stack-top gallery-trigger" data-index="0">
                  <img src="{{ asset($allImages[0]->file_path) }}" alt="{{ $trip->title }}">
                  
                  <!-- Badges Overlay (Preserved) -->
                  <div style="position: absolute; bottom: 1rem; left: 1rem; display: flex; gap: 0.5rem; flex-wrap: wrap; z-index: 2;">
                    <span style="background: rgba(30, 30, 30, 0.9); color: white; padding: 0.5rem 1rem; border-radius: 4px; font-weight: 600; font-size: 0.875rem; border: 1px solid rgba(255,255,255,0.2);">
                      {{ $trip->duration_days }} DAY {{ $trip->duration_nights }} NIGHT
                    </span>
                    @if($nextDeparture)
                    <span style="background: rgba(245, 158, 11, 0.9); color: white; padding: 0.5rem 1rem; border-radius: 4px; font-weight: 600; font-size: 0.875rem;">
                      {{ $nextDeparture->start_date->format('M d') }}-{{ $nextDeparture->end_date->format('d, Y') }}
                    </span>
                    @endif
                  </div>
              </div>
              @endif
              
              <!-- Bottom Grid (4 Images) -->
              <div class="gallery-stack-bottom">
                  @foreach($allImages->skip(1)->take(4) as $index => $img)
                   <div class="gallery-stack-thumb gallery-trigger" data-index="{{ $index + 1 }}">
                       <img src="{{ asset($img->file_path) }}" alt="Gallery Image">
                       
                       <!-- If this is the 4th thumbnail (total index 4) and there are more images -->
                       @if($loop->last && $allImages->count() > 5)
                       <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.6); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                           +{{ $allImages->count() - 5 }} Foto
                       </div>
                       @endif
                   </div>
                  @endforeach
              </div>
           </div>
          
           <!-- Hidden data for JS -->
           <script>
               window.tripImages = @json($allImages->map(fn($img) => asset($img->file_path)));
           </script>
          
          <!-- Trip Title & Price -->
          <div style="margin-top: 1.5rem;">
            @if(!$nextDeparture || ($nextDeparture->capacity - $nextDeparture->booked_count) <= 0)
            <span style="color: #ef4444; font-size: 0.875rem; font-weight: 600;">(SOLD OUT)</span>
            @endif
            <h1 style="font-size: 1.75rem; font-weight: 700; color: #fbcaa5; margin: 0.25rem 0;">{{ $trip->title }}</h1>
            
            @if($nextDeparture && $nextDeparture->variants->isNotEmpty())
            @php 
              $minPrice = $nextDeparture->variants->min('base_price');
              $maxPrice = $nextDeparture->variants->max('base_price');
            @endphp
            <p style="font-size: 1.25rem; color: rgba(255,255,255,0.9); margin-top: 0.5rem;">
              <strong>Rp.{{ number_format($minPrice, 0, ',', '.') }}</strong>
              @if($minPrice != $maxPrice)
              - <strong>Rp.{{ number_format($maxPrice, 0, ',', '.') }}</strong>
              @endif
            </p>
            @endif
          </div>
        </div>
        
        <!-- RIGHT: Book Now Panel (40%) -->
        <div class="booking-panel">
          <!-- Status -->
          @if($nextDeparture && ($nextDeparture->capacity - $nextDeparture->booked_count) > 0)
          <span style="color: #10b981; font-weight: 600; display: block; margin-bottom: 1rem;">✓ Available</span>
          @else
          <span style="color: #ef4444; font-weight: 600; display: block; margin-bottom: 1rem;">Not Available</span>
          @endif
          
          <!-- Select Departure Date -->
          @if($departures->count() > 0)
          <h4 style="font-size: 0.875rem; color: #1f2937; margin-bottom: 0.75rem; font-weight: 600;">Select Departure Date</h4>
          <div style="margin-bottom: 1.5rem;">
            <select id="departureSelect" class="select-dark" onchange="window.location.href='{{ route('trip.detail', $trip->slug) }}?departure=' + this.value">
              @foreach($departures as $departure)
              <option value="{{ $departure->id }}" {{ ($nextDeparture && $nextDeparture->id == $departure->id) ? 'selected' : '' }}>
                {{ $departure->start_date->format('d M Y') }} - {{ $departure->end_date->format('d M Y') }}
                ({{ $departure->remaining_capacity }} slots left)
              </option>
              @endforeach
            </select>
          </div>
          @endif
          
          <!-- Select Variant -->
          @if($nextDeparture && $nextDeparture->variants->isNotEmpty())
          <h4 style="font-size: 0.875rem; color: #1f2937; margin-bottom: 0.75rem; font-weight: 600;">Select Variant</h4>
          <div style="margin-bottom: 1.5rem;">
            @foreach($nextDeparture->variants as $index => $variant)
            <div class="variant-item {{ $index === 0 ? 'selected' : '' }}" data-variant-id="{{ $variant->id }}">
              <span style="font-weight: 500;">{{ $variant->name }}</span>
              <span style="color: var(--color-primary); font-weight: 700;">Rp.{{ number_format($variant->base_price, 0, ',', '.') }}</span>
            </div>
            @endforeach
          </div>
          @endif
          
          <!-- Additional Items -->
          @if($nextDeparture && $nextDeparture->addons->isNotEmpty())
          <h4 style="font-size: 0.875rem; color: #1f2937; margin-bottom: 0.75rem; font-weight: 600;">Additional Items</h4>
          <div style="margin-bottom: 1.5rem;">
            @foreach($nextDeparture->addons as $addon)
            <label style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f3f4f6; cursor: pointer;">
              <span style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="addons[]" value="{{ $addon->id }}" style="width: 18px; height: 18px; accent-color: var(--color-primary);">
                <span>
                  {{ $addon->addon->name }}
                  @if($addon->max_qty)
                  <small style="color: #10b981; font-size: 0.75rem;">({{ $addon->max_qty }} left)</small>
                  @endif
                </span>
              </span>
              <span style="color: #6b7280;">Rp.{{ number_format($addon->price ?? $addon->addon->default_price, 0, ',', '.') }}</span>
            </label>
            @endforeach
          </div>
          @endif
          
          <!-- WhatsApp Button -->
          <a href="#" id="whatsappBookBtn"
             onclick="bookViaWhatsApp(event)"
             style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; width: 100%; padding: 1rem; background: #25D366; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; margin-bottom: 0.75rem;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            {{ __('general.contact_via_whatsapp') }}
          </a>
          
          <!-- Share Button -->
          <button onclick="navigator.share ? navigator.share({title: '{{ $trip->title }}', url: window.location.href}) : navigator.clipboard.writeText(window.location.href).then(() => alert('Link copied!'))" 
                  style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; width: 100%; padding: 1rem; background: white; color: #1f2937; border: 1px solid #e5e7eb; border-radius: 8px; font-weight: 500; cursor: pointer;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
            Share Product
          </button>
          
          <!-- PDF Download Button -->
          @if($trip->trip_itinerary_pdf)
          <div style="margin-top: 1rem;">
             <a href="{{ asset($trip->trip_itinerary_pdf) }}" download target="_blank"
                style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; width: 100%; padding: 1rem; background: #fbcaa5; color: #1e1e1e; text-decoration: none; border-radius: 8px; font-weight: 700; border: none; transition: all 0.2s;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Download Trip Detail
             </a>
          </div>
          @endif
      </div>
    </div>
  </section>

  <!-- Overview, Itinerary Tabs etc (100%) -->
  <section style="padding: 0 0 3rem;">
    <div class="container">
      <div class="content-section">
        <!-- Includes Icons -->
        @if($trip->includes && count($trip->includes) > 0)
        @php
          $includeIcons = [
            'guide' => ['icon' => 'user-check', 'label' => 'Guide'],
            'tour_leader' => ['icon' => 'flag', 'label' => 'Tour Leader'],
            'local_guide' => ['icon' => 'map-pin', 'label' => 'Local Guide'],
            'porters' => ['icon' => 'backpack', 'label' => 'Porters'],
            'hotel' => ['icon' => 'building', 'label' => 'Hotel'],
            'homestay' => ['icon' => 'home', 'label' => 'Homestay'],
            'lodge' => ['icon' => 'home-2', 'label' => 'Lodge'],
            'meals' => ['icon' => 'tools-kitchen-2', 'label' => 'Meals'],
            'campsite' => ['icon' => 'tent', 'label' => 'Campsite'],
            'transport' => ['icon' => 'bus', 'label' => 'Bus'],
            'transport_plane' => ['icon' => 'plane', 'label' => 'Pesawat'],
            'transport_ojek' => ['icon' => 'motorbike', 'label' => 'Ojek'],
            'transport_pickup' => ['icon' => 'truck', 'label' => 'Pickup'],
            'transport_jeep' => ['icon' => 'car', 'label' => 'Jeep'],
            'transport_ship' => ['icon' => 'speedboat', 'label' => 'Kapal'],
            'airport_transfer' => ['icon' => 'plane-arrival', 'label' => 'Transfer'],
            'permit' => ['icon' => 'ticket', 'label' => 'Permit'],
            'insurance' => ['icon' => 'shield-check', 'label' => 'Insurance'],
            'first_aid' => ['icon' => 'first-aid-kit', 'label' => 'First Aid'],
            'technical_gears' => ['icon' => 'tools', 'label' => 'Gears'],
            'snacks' => ['icon' => 'coffee', 'label' => 'Snack'],
            'souvenir' => ['icon' => 'gift', 'label' => 'Souvenir'],
            'documentation' => ['icon' => 'camera', 'label' => 'Doc'],
          ];
        @endphp
        <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; padding: 1.5rem; background: transparent; border-bottom: 1px solid rgba(255,255,255,0.1);">
          @foreach($trip->includes as $include)
          @if(isset($includeIcons[$include]))
          <div style="text-align: center; min-width: 60px;">
            <i class="ti ti-{{ $includeIcons[$include]['icon'] }}" style="font-size: 24px; color: var(--color-primary); margin-bottom: 0.25rem; display: block;"></i>
            <span style="font-size: 0.7rem; color: #d1d5db; display: block;">{{ $includeIcons[$include]['label'] }}</span>
          </div>
          @endif
          @endforeach
        </div>
        @endif


        
        <!-- Content Tabs -->
        <div class="content-tabs">
          <button class="active" data-tab="overview">Overview</button>
          <button data-tab="itinerary">Itinerary</button>
          <button data-tab="include_exclude">Include/Exclude</button>
          @if($trip->gearLists->isNotEmpty())
          <button data-tab="gear-list">Gear Lists</button>
          @endif
          @if($trackingMap)
          <button data-tab="map">Tracking Map</button>
          @endif
        </div>

        <!-- Content Panels -->
        <div class="content-panel active" id="panel-overview">
          @if(isset($contents['overview']))
          {!! $contents['overview']->content_html !!}
          @else
          <p style="color: #6b7280;">No overview available yet.</p>
          @endif
        </div>

        <div class="content-panel" id="panel-itinerary">
          @if(isset($contents['itinerary']))
          {!! $contents['itinerary']->content_html !!}
          @else
          <p style="color: #6b7280;">Itinerary will be added soon.</p>
          @endif
        </div>

        <div class="content-panel" id="panel-include_exclude">
          @if(isset($contents['include_exclude']))
          {!! $contents['include_exclude']->content_html !!}
          @else
          <p style="color: #6b7280;">Include/exclude details will be added soon.</p>
          @endif
        </div>

        <div class="content-panel" id="panel-gear-list">
          <div style="display: flex; flex-direction: column; gap: 1.5rem; align-items: center;">
            @foreach($trip->gearLists as $image)
            <div style="width: 100%; text-align: center;">
              <img src="{{ asset($image->file_path) }}" alt="Gear List" class="content-image-limit" onclick="window.open(this.src, '_blank')">
            </div>
            @endforeach
          </div>
        </div>

        <div class="content-panel" id="panel-map" style="text-align: center;">
          @if($trackingMap)
          <img src="{{ asset($trackingMap->file_path) }}" alt="Tracking Map" class="content-image-limit">
          @endif
        </div>
      </div>
      
      <!-- Trip Facts / Metrics (Bottom) -->
      @if($trip->trip_facts && (is_array($trip->trip_facts) && count($trip->trip_facts) > 0))
      <div class="content-section">
        @php
            $facts = $trip->trip_facts;
            $factConfig = [
                'grade' => ['label' => 'Grade', 'icon' => 'chart-bar'],
                'distance' => ['label' => 'Distance', 'icon' => 'ruler-2'],
                'max_altitude' => ['label' => 'Max Altitude', 'icon' => 'mountain'],
                'duration' => ['label' => 'Duration', 'icon' => 'clock'],
                'trekking_time' => ['label' => 'Trekking Time', 'icon' => 'walk'],
                'elevation_gain' => ['label' => 'Elevation Gain', 'icon' => 'trending-up'],
                'terrain' => ['label' => 'Terrain', 'icon' => 'shoe'],
                'trekking_day' => ['label' => 'Trekking Day', 'icon' => 'calendar'],
                'accommodation' => ['label' => 'Accomodation', 'icon' => 'building-cottage'],
                'destinations' => ['label' => 'Destinations', 'icon' => 'map-pin'],
                'climate' => ['label' => 'Climate', 'icon' => 'sun'],
            ];
            
            // Filter enabled facts
            $enabledFacts = [];
            foreach(array_keys($factConfig) as $key) {
                if(data_get($facts, $key.'.enabled')) {
                    $enabledFacts[] = $key;
                }
            }
        @endphp
        
        @if(count($enabledFacts) > 0)
        <div class="trip-facts-grid">
            @foreach($enabledFacts as $key)
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="color: var(--color-primary); min-width: 36px;">
                        <i class="ti ti-{{ $factConfig[$key]['icon'] ?? 'circle' }}" style="font-size: 24px;"></i>
                    </div>
                    <div>
                        <small style="color: #9ca3af; display: block; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                            {{ $factConfig[$key]['label'] }}
                        </small>
                        <span style="color: #fbcaa5; font-weight: 700; font-size: 1rem; line-height: 1.2;">
                            {{ data_get($facts, $key.'.value') }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
      </div>
      @endif
    </div>
  </section>

  <!-- Terms & Conditions Notice -->
  <section style="background: #1e1e1e; padding: 2rem 0; border-top: 1px solid rgba(251, 202, 165, 0.2);">
    <div class="container" style="text-align: center;">
      <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">
        {{ __('general.booking_agreement') }} 
        <a href="{{ route('terms-conditions') }}" style="color: var(--color-primary); font-weight: 600; text-decoration: underline;">{{ __('general.terms_conditions_title') }}</a>.
      </p>
    </div>
  </section>

  <!-- Footer (same as Index) -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-col">
          <div class="footer-logo">
            @if(isset($settings['global_footer_logo']))
              <img src="{{ asset($settings['global_footer_logo']) }}" alt="Monti Outdoor" width="32" height="32">
            @else
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 2L4 14L8 18L16 10L24 18L28 14L16 2Z" fill="#e97543"/>
              <path d="M8 18L4 22V30H12V24H20V30H28V22L24 18L16 26L8 18Z" fill="#e97543"/>
            </svg>
            @endif
            <span>:MONTI Outdoor Service</span>
          </div>
          <p class="footer-description">#ceritadialam<br>Your Trusted Travelling & Event Organizer Partner</p>
          <div class="footer-social" style="display: flex; gap: 1rem; margin-top: 1rem;">
            <a href="https://www.instagram.com/monti.outdoorservice/" class="social-link" aria-label="Instagram" target="_blank" style="color: rgba(255,255,255,0.7);">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
            </a>
            <a href="https://www.tiktok.com/@monti.outdoor.service" class="social-link" aria-label="TikTok" target="_blank" style="color: rgba(255,255,255,0.7);">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path></svg>
            </a>
            <a href="https://www.youtube.com/@montioutdoorservice" class="social-link" aria-label="YouTube" target="_blank" style="color: rgba(255,255,255,0.7);">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.33 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
            </a>
          </div>
        </div>

        <div class="footer-col">
          <h4 class="footer-heading">Quick Links</h4>
          <ul class="footer-links">
            <li><a href="{{ route('landing') }}">Home</a></li>
            <li><a href="{{ route('open-trip') }}">Open Trip</a></li>
            <li><a href="{{ route('landing') }}#about">About Us</a></li>
            <li><a href="{{ route('landing') }}#contact">Contact</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4 class="footer-heading">Services</h4>
          <ul class="footer-links">
            <li><a href="{{ route('open-trip') }}">Open Trip</a></li>
            <li><a href="{{ route('mountain-trip') }}">Mountain Trip</a></li>
            <li><a href="{{ route('outdoor-trip') }}">Outdoor Activity Trip</a></li>
            <li><a href="{{ route('indoor-trip') }}">Indoor Activity Trip</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4 class="footer-heading">Newsletter</h4>
          <p class="footer-newsletter-text">Subscribe to get adventure tips and special offers</p>
          <form class="footer-newsletter" id="newsletterForm">
            <input type="email" placeholder="Your email" class="newsletter-input" required>
            <button type="submit" class="newsletter-btn" aria-label="Subscribe">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="22" y1="2" x2="11" y2="13"/>
                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
              </svg>
            </button>
          </form>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2026 Monti Outdoor Service. All rights reserved.</p>
        <div class="footer-bottom-links">
          <a href="#">Privacy Policy</a>
          <a href="{{ route('terms-conditions') }}">Terms of Service</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Modal Gallery HTML -->
  <div id="galleryModalOverlay" class="modal-gallery-overlay">
    <div class="gallery-modal-content">
       <button class="modal-close-btn" onclick="closeGalleryModal()">&times;</button>
       
       <div class="gallery-main-view">
          <button class="nav-btn prev-btn" onclick="navGallery(-1)">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
          </button>
          
          <img id="modalMainImg" src="" class="gallery-main-img">
          
          <button class="nav-btn next-btn" onclick="navGallery(1)">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
          </button>
       </div>
       
       <div class="gallery-sidebar">
           <h3 class="gallery-sidebar-title">Trip Gallery</h3>
           <div class="gallery-grid-sidebar" id="modalThumbGrid">
               <!-- JS populated -->
           </div>
       </div>
    </div>
  </div>

  <script src="{{ asset('js/landing.js') }}"></script>
  @vite(['resources/js/landing-preview.js', 'resources/js/landing-ui-fixes.js'])
  
  <script>
    // --- Gallery Modal Logic ---
    let currentImgIndex = 0;
    const modalOverlay = document.getElementById('galleryModalOverlay');
    const modalMainImg = document.getElementById('modalMainImg');
    const modalThumbGrid = document.getElementById('modalThumbGrid');

    function openGalleryModal(index = 0) {
        currentImgIndex = index;
        modalOverlay.classList.add('active');
        document.body.style.overflow = 'hidden'; // prevent scrolling
        renderModal();
    }

    function closeGalleryModal() {
        modalOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    function renderModal() {
        // Set Main Image
        if (window.tripImages && window.tripImages[currentImgIndex]) {
            modalMainImg.src = window.tripImages[currentImgIndex];
        }

        // Render Sidebar Thumbs
        modalThumbGrid.innerHTML = '';
        if (window.tripImages) {
            window.tripImages.forEach((imgSrc, idx) => {
                const thumb = document.createElement('div');
                thumb.className = `sidebar-thumb ${idx === currentImgIndex ? 'active' : ''}`;
                thumb.onclick = () => {
                    currentImgIndex = idx;
                    renderModal();
                };
                
                const img = document.createElement('img');
                img.src = imgSrc;
                
                thumb.appendChild(img);
                modalThumbGrid.appendChild(thumb);
            });
        }
    }

    function navGallery(direction) {
        if (!window.tripImages) return;
        currentImgIndex += direction;
        
        // Loop
        if (currentImgIndex < 0) currentImgIndex = window.tripImages.length - 1;
        if (currentImgIndex >= window.tripImages.length) currentImgIndex = 0;
        
        renderModal();
    }

    // Attach Click Events to Page Gallery
    document.querySelectorAll('.gallery-trigger').forEach(el => {
        el.addEventListener('click', function() {
            const idx = parseInt(this.dataset.index);
            openGalleryModal(idx);
        });
    });

    // Close on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modalOverlay.classList.contains('active')) {
            closeGalleryModal();
        }
    });

    // --- End Gallery Logic ---

    // Tab switching
    document.querySelectorAll('.content-tabs button').forEach(btn => {
    // ... existing JS ...
      btn.addEventListener('click', function() {
        document.querySelectorAll('.content-tabs button').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.content-panel').forEach(p => p.classList.remove('active'));
        
        this.classList.add('active');
        document.getElementById('panel-' + this.dataset.tab).classList.add('active');
      });
    });

    // Variant selection
    document.querySelectorAll('.variant-item').forEach(item => {
      item.addEventListener('click', function() {
        document.querySelectorAll('.variant-item').forEach(i => i.classList.remove('selected'));
        this.classList.add('selected');
      });
    });

    // WhatsApp booking message
    function bookViaWhatsApp(event) {
      event.preventDefault();
      
      // Trip info
      const tripName = @json($trip->title);
      const departureDate = @json($nextDeparture ? $nextDeparture->start_date->format('d M Y') . ' - ' . $nextDeparture->end_date->format('d M Y') : 'Belum dipilih');
      
      // Get selected variant
      const selectedVariant = document.querySelector('.variant-item.selected');
      const variantName = selectedVariant ? selectedVariant.querySelector('span').textContent.trim() : 'Belum dipilih';
      
      // Get selected addons (extract just the addon name without "(X left)")
      const selectedAddons = [];
      document.querySelectorAll('input[name="addons[]"]:checked').forEach(checkbox => {
        const label = checkbox.closest('label');
        if (label) {
          const addonSpan = label.querySelector('span span span');
          if (addonSpan) {
            // Get only the text node (addon name), not the small element
            let addonName = '';
            addonSpan.childNodes.forEach(node => {
              if (node.nodeType === Node.TEXT_NODE) {
                addonName += node.textContent.trim();
              }
            });
            if (addonName) selectedAddons.push(addonName);
          }
        }
      });
      
      // Build message (no emojis)
      let message = `Halo, saya ingin booking trip:\n\n`;
      message += `*Trip:* ${tripName}\n`;
      message += `*Tanggal:* ${departureDate}\n`;
      message += `*Meeting Point:* ${variantName}\n`;
      
      if (selectedAddons.length > 0) {
        message += `*Add-on:* ${selectedAddons.join(', ')}\n`;
      }
      
      message += `\nMohon info lebih lanjut. Terima kasih!`;
      
      // Open WhatsApp
      const whatsappNumber = '6281196969119';
      const url = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
      window.open(url, '_blank');
    }
  </script>
</body>
</html>
