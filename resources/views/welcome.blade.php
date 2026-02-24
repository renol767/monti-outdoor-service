<!DOCTYPE html>
<html lang="id">
@php
  // Get user wishlist IDs if logged in
  $userWishlistIds = auth()->check() ? auth()->user()->wishlists->pluck('trip_template_id')->toArray() : [];
@endphp
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Primary Meta Tags -->
  <title>Monti Outdoor Service - Open Trip, Mountain Trip & Adventure Tours Indonesia</title>
  <meta name="title" content="Monti Outdoor Service - Open Trip, Mountain Trip & Adventure Tours Indonesia">
  <meta name="description" content="Monti Outdoor Service adalah partner terpercaya untuk petualangan outdoor dan ekspedisi gunung di Indonesia. Open Trip, Private Trip, Team Building, dan Event Organizer profesional.">
  <meta name="keywords" content="open trip, mountain trip, pendakian gunung, tour travel, team building, event organizer, outdoor activity, monti outdoor, adventure tours indonesia">
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
  <meta property="og:title" content="Monti Outdoor Service - Open Trip, Mountain Trip & Adventure Tours Indonesia">
  <meta property="og:description" content="Partner terpercaya untuk petualangan outdoor dan ekspedisi gunung di Indonesia. Open Trip, Private Trip, Team Building, dan Event Organizer profesional.">
  <meta property="og:image" content="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}">
  <meta property="og:locale" content="id_ID">
  <meta property="og:site_name" content="Monti Outdoor Service">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="{{ url()->current() }}">
  <meta property="twitter:title" content="Monti Outdoor Service - Open Trip, Mountain Trip & Adventure Tours Indonesia">
  <meta property="twitter:description" content="Partner terpercaya untuk petualangan outdoor dan ekspedisi gunung di Indonesia. Open Trip, Private Trip, Team Building, dan Event Organizer profesional.">
  <meta property="twitter:image" content="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}">

  <!-- Structured Data - Organization -->
  <script type="application/ld+json">
  @php
  echo json_encode([
    "@context" => "https://schema.org",
    "@type" => "TravelAgency",
    "name" => "Monti Outdoor Service",
    "description" => "Partner terpercaya untuk petualangan outdoor dan ekspedisi gunung di Indonesia",
    "url" => url('/'),
    "logo" => asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png'),
    "telephone" => $settings['global_whatsapp'] ?? '+6281196969119',
    "address" => [
      "@type" => "PostalAddress",
      "addressCountry" => "ID"
    ],
    "sameAs" => array_filter([
      $settings['social_instagram'] ?? null,
      $settings['social_facebook'] ?? null,
      $settings['social_tiktok'] ?? null
    ]),
    "priceRange" => "$$",
    "openingHours" => "Mo-Su 08:00-21:00"
  ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
  @endphp
  </script>

  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
  <link rel="stylesheet" href="{{ asset('css/hero-slider.css') }}">
  @vite(['resources/css/landing-ui-fixes.css'])
  
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <style>
    /* Fix Mobile Menu Background (dark like main page) */
    .nav.mobile-open {
      background: rgba(30, 30, 30, 0.95) !important;
      backdrop-filter: blur(10px) !important;
      overflow-y: auto !important;
      max-height: 100dvh !important;
      padding-bottom: 10rem !important;
    }
    
    /* Fix Mobile Menu Text Color */
    @media (max-width: 1023px) {
      .nav.mobile-open .nav-link {
        color: #fbcaa5 !important;
      }
      
      .nav.mobile-open .dropdown-toggle {
        color: #fbcaa5 !important;
      }
      
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

    /* Open Trip Card CSS (Copied from open-trip.blade.php) */
    .open-trip-card {
      background: #2a2a2a;
      border-radius: var(--border-radius-xl);
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: var(--transition-normal);
      display: flex;
      flex-direction: column;
      height: 100%;
    }
    .open-trip-card:hover {
      box-shadow: 0 8px 40px rgba(0, 0, 0, 0.5);
      transform: translateY(-0.5rem);
    }
    .open-trip-card .card-image {
      position: relative;
      aspect-ratio: 4/5;
      overflow: hidden;
      border-radius: var(--border-radius-lg);
      margin: 0.75rem 0.75rem 0;
    }
    .open-trip-card .card-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
      border-radius: var(--border-radius-lg);
    }
    .open-trip-card:hover .card-image img {
      transform: scale(1.1);
    }
    .open-trip-card .favorite-btn {
      position: absolute;
      top: 0.75rem;
      right: 0.75rem;
      width: 36px;
      height: 36px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: var(--transition-fast);
      border: none;
    }
    .open-trip-card .favorite-btn:hover {
      background: var(--color-white);
      transform: scale(1.1);
    }
    .open-trip-card .favorite-btn svg {
      width: 20px;
      height: 20px;
      color: var(--color-slate-400);
    }
    .open-trip-card .favorite-btn.active svg {
      fill: var(--color-primary);
      color: var(--color-primary);
    }
    .open-trip-card .card-content {
      padding: 1rem;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }
    .open-trip-card .card-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 0.25rem;
    }
    .open-trip-card .card-title {
      font-size: 1rem;
      font-weight: 700;
      color: #fbcaa5;
      margin: 0;
    }
    .open-trip-card .card-duration {
      font-size: 0.8rem;
      color: rgba(255, 255, 255, 0.6);
      margin-bottom: 0.75rem;
    }
    .open-trip-card .card-amenities {
      display: flex;
      gap: 0.5rem;
      padding: 0.75rem 0;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      margin-bottom: 0.75rem;
      flex-wrap: wrap;
      align-items: center;
    }
    .open-trip-card .amenity {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.15rem;
    }
    .open-trip-card .amenity svg {
      width: 16px;
      height: 16px;
      color: rgba(255, 255, 255, 0.6);
    }
    .open-trip-card .amenity span {
      font-size: 0.65rem;
      color: rgba(255, 255, 255, 0.6);
    }
    .open-trip-card .amenity-more {
      font-size: 0.7rem; color: var(--color-primary); font-weight: 500;
    }
    .open-trip-card .card-features {
      margin-bottom: 0.75rem;
      padding-left: 0;
      list-style: none;
      flex-grow: 1;
    }
    .open-trip-card .card-features li {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.8rem;
      color: rgba(255, 255, 255, 0.8);
      margin-bottom: 0.2rem;
    }
    .open-trip-card .card-features li::before {
      content: '•';
      color: var(--color-primary);
      font-weight: bold;
    }
    .open-trip-card .card-price {
      display: flex;
      align-items: baseline;
      gap: 0.5rem;
    }
    .open-trip-card .price-current {
        font-size: 1.125rem;
        font-weight: 700;
        color: #fbcaa5;
    }
    .open-trip-card .price-unit {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.6);
    }
    .open-trip-card .price-from {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.5);
    }
    .open-trip-card .card-schedule {
      display: flex;
      justify-content: space-between;
      padding: 0.5rem 0;
      margin-bottom: 0.5rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    .open-trip-card .schedule-item {
      display: flex;
      align-items: center;
      gap: 0.35rem;
      font-size: 0.8rem;
      color: rgba(255, 255, 255, 0.7);
    }
    .open-trip-card .schedule-item svg {
      width: 14px; height: 14px; color: var(--color-primary);
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header id="header" class="header">
    <div class="container">
      <div class="header-content">
        <div class="logo">
          <img src="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}" alt="Logo" width="100" data-preview-key="global_logo">
          <!-- <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 2L4 14L8 18L16 10L24 18L28 14L16 2Z" fill="#e97543"/>
            <path d="M8 18L4 22V30H12V24H20V30H28V22L24 18L16 26L8 18Z" fill="#e97543"/>
          </svg>
          <span>Monti Outdoor</span> -->
        </div>

        <button class="mobile-menu-btn" aria-label="Toggle menu">
          <span></span>
          <span></span>
          <span></span>
        </button>

        <nav class="nav">
          <!-- About Us - direct link -->
          <a href="{{ route('about-us') }}" class="nav-link">{{ __('navigation.about_us') }}</a>

          <!-- Open Trip - no submenu -->
          <a href="{{ route('open-trip') }}" class="nav-link">{{ __('navigation.open_trip') }}</a>
          
          <!-- Mountain Trip with submenu -->
          <div class="dropdown">
            <a href="{{ route('mountain-trip') }}" class="custom-dropdown-toggle dropdown-toggle">
              {{ __('navigation.mountain_trip') }}
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </a>
            <div class="dropdown-menu">
              <a href="{{ route('open-trip') }}" class="dropdown-item">{{ __('navigation.open_trip') }}</a>
              <a href="{{ route('mountain-trip') }}#private-trip" class="dropdown-item">{{ __('navigation.private_trip') }}</a>
              <a href="{{ route('mountain-trip') }}#one-day-trip" class="dropdown-item">{{ __('navigation.one_day_trip') }}</a>
              <a href="{{ route('mountain-trip') }}#expedition-trip" class="dropdown-item">{{ __('navigation.expedition_trip') }}</a>
              <a href="{{ route('mountain-trip') }}#international-trip" class="dropdown-item">{{ __('navigation.international_trip') }}</a>
              <a href="{{ route('mountain-trip') }}#custom-trip" class="dropdown-item">{{ __('navigation.custom_trip') }}</a>
            </div>
          </div>

          <!-- Outdoor Activity Trip with submenu -->
          <div class="dropdown">
            <a href="{{ route('outdoor-trip') }}" class="custom-dropdown-toggle dropdown-toggle">
              {{ __('navigation.outdoor_activity_trip') }}
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </a>
            <div class="dropdown-menu">
              <a href="{{ route('outdoor-trip') }}#cultural-trip" class="dropdown-item">{{ __('navigation.cultural_trip') }}</a>
              <a href="{{ route('outdoor-trip') }}#one-day-outdoor-trip" class="dropdown-item">{{ __('navigation.one_day_trip') }}</a>
              <a href="{{ route('outdoor-trip') }}#island-trip" class="dropdown-item">{{ __('navigation.island_trip') }}</a>
              <a href="{{ route('outdoor-trip') }}#camping-trip" class="dropdown-item">{{ __('navigation.camping') }}</a>
              <a href="{{ route('outdoor-trip') }}#outdoor-team-building" class="dropdown-item">{{ __('navigation.outdoor_team_building') }}</a>
              <a href="{{ route('outdoor-trip') }}#outdoor-custom-trip" class="dropdown-item">{{ __('navigation.outdoor_custom_trip') }}</a>
            </div>
          </div>

          <!-- Indoor Activity Trip with submenu -->
          <div class="dropdown">
            <a href="{{ route('indoor-trip') }}" class="custom-dropdown-toggle dropdown-toggle">
              {{ __('navigation.indoor_activity_trip') }}
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </a>
            <div class="dropdown-menu">
              <a href="{{ route('indoor-trip') }}#city-tour" class="dropdown-item">{{ __('navigation.city_tour') }}</a>
              <a href="{{ route('indoor-trip') }}#company-gathering" class="dropdown-item">{{ __('navigation.company_gathering') }}</a>
              <a href="{{ route('indoor-trip') }}#outing-tour-travel" class="dropdown-item">{{ __('navigation.outing_tour_travel') }}</a>
              <a href="{{ route('indoor-trip') }}#mice-organizer" class="dropdown-item">{{ __('navigation.mice_organizer') }}</a>
              <a href="{{ route('indoor-trip') }}#indoor-team-building" class="dropdown-item">{{ __('navigation.indoor_team_building') }}</a>
              <a href="{{ route('indoor-trip') }}#indoor-custom-trip" class="dropdown-item">{{ __('navigation.indoor_custom_trip') }}</a>
            </div>
          </div>

          <!-- Contact -->
          <a href="#contact" class="nav-link">{{ __('navigation.contact') }}</a>
          
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
          
          @auth
            <div class="dropdown">
              <a href="#" class="btn btn-primary custom-dropdown-toggle dropdown-toggle" style="display: flex; align-items: center; gap: 0.5rem; color: #fff;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                  <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>{{ explode(' ', auth()->user()->name)[0] }}</span>
              </a>
              <div class="dropdown-menu">
                @if(auth()->user()->isAdmin())
                  <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Admin Dashboard</a>
                @else
                  <a href="{{ route('user.profile') }}" class="dropdown-item">My Profile</a>
                  <a href="#" class="dropdown-item">My Invoice</a>
                  <a href="#" class="dropdown-item">My Transaction</a>
                  <a href="{{ route('user.wishlist') }}" class="dropdown-item">My Wishlist</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="dropdown-item" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; font-size: 15px; padding-top: 8px; padding-bottom: 8px;">Logout</button>
                </form>
              </div>
            </div>
          @else
            <a href="{{ route('login') }}" class="btn btn-primary">Login / Register</a>
          @endauth
        </nav>
      </div>
    </div>
  </header>

  <!-- Hero Section with Slider -->
  <section id="home" class="hero hero-slider">
    @if($heroSlides->count() > 0)
    <div class="swiper heroSwiper">
      <div class="swiper-wrapper">
        @foreach($heroSlides as $slide)
        <div class="swiper-slide">
          <div class="hero-bg">
            <img src="{{ asset($slide->background_image) }}" width="1080" alt="{{ $slide->title }}">
            <div class="hero-overlay"></div>
          </div>

          <div class="hero-content container">
            <div class="hero-badge fade-in">{{ $slide->badge_text }}</div>
            <h1 class="hero-title fade-in">{{ $slide->title }}</h1>
            <p class="hero-subtitle fade-in">{{ $slide->subtitle }}</p>
            <div class="hero-cta fade-in">
              <a href="#trips" class="btn btn-primary">{{ __('landing.start_adventure') }}</a>
              <a href="#contact" class="btn btn-secondary">{{ __('general.contact_us') }}</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      
      <!-- Navigation Buttons -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      
      <!-- Pagination -->
      <div class="swiper-pagination"></div>
    </div>
    @else
    <!-- Fallback if no active slides -->
    <div class="hero-bg">
      <img src="{{ asset('images/Annapurna Basecamp.jpg') }}" width="1080" alt="Mountain camping">
      <div class="hero-overlay"></div>
    </div>
    <div class="hero-content container">
      <div class="hero-badge fade-in">Petualangan Anda Dimulai Di Sini</div>
      <h1 class="hero-title fade-in">Jelajahi Alam. Temukan Petualangan.</h1>
      <p class="hero-subtitle fade-in">Mountain Trip · Outdoor Adventure · Team Building · Custom Tour</p>
      <div class="hero-cta fade-in">
        <a href="#trips" class="btn btn-primary">{{ __('landing.start_adventure') }}</a>
        <a href="#contact" class="btn btn-secondary">{{ __('general.contact_us') }}</a>
      </div>
    </div>
    @endif
    
    <div class="scroll-indicator">
      <div class="scroll-mouse">
        <div class="scroll-wheel"></div>
      </div>
    </div>
  </section>

  <!-- Why Choose Monti -->
  <section class="section bg-white">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <h2 class="section-title" data-preview-key="why_choose_title">{{ $settings['why_choose_title'] ?? 'Why Choose Monti' }}</h2>
        <p class="section-description" data-preview-key="why_choose_description">{{ $settings['why_choose_description'] ?? 'We combine expertise, passion, and respect for nature to deliver unforgettable outdoor experiences' }}</p>
      </div>

      <div class="features-grid">
        @foreach($features as $feature)
        <div class="feature-card animate-on-scroll">
          <div class="feature-icon">
            {!! $feature->icon !!}
          </div>
          <h3 class="feature-title">{{ $feature->title }}</h3>
          <p class="feature-description">{{ $feature->description }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Popular Trips -->
  <section id="trips" class="section bg-light">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <h2 class="section-title" data-preview-key="trips_title">{{ $settings['trips_title'] ?? 'Popular Trips & Packages' }}</h2>
        <p class="section-description" data-preview-key="trips_description">{{ $settings['trips_description'] ?? 'Carefully curated adventures for every type of explorer. From mountain summits to island paradises.' }}</p>
      </div>

      <div class="trips-grid">
        @php
            $iconMap = [
                  'guide' => ['icon' => 'user-check', 'label' => 'Guide'],
                  'tour_leader' => ['icon' => 'flag', 'label' => 'Tour Leader'],
                  'local_guide' => ['icon' => 'map-pin', 'label' => 'Local Guide'],
                  'porters' => ['icon' => 'backpack', 'label' => 'Porters'],
                  'hotel' => ['icon' => 'building', 'label' => 'Hotel'],
                  'homestay' => ['icon' => 'home', 'label' => 'Dashboardstay'],
                  'lodge' => ['icon' => 'home-2', 'label' => 'Lodge'],
                  'meals' => ['icon' => 'tools-kitchen-2', 'label' => 'Meals'],
                  'campsite' => ['icon' => 'tent', 'label' => 'Campsite'],
                  'transport' => ['icon' => 'bus', 'label' => 'Transport'],
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
        @foreach($trips as $trip)
        <div class="open-trip-card position-relative">
          <div class="card-image">
            <a href="{{ route('trip.detail', $trip->slug) }}" class="d-block" style="text-decoration: none; color: inherit;">
              <img src="{{ $trip->thumbnail ? asset($trip->thumbnail) : asset('images/placeholder-trip.jpg') }}" alt="{{ $trip->title }}">
            </a>
            <!-- Favorite button -->
            <button class="favorite-btn {{ in_array($trip->id, $userWishlistIds) ? 'active' : '' }}" aria-label="Add to favorites" data-trip-id="{{ $trip->id }}" style="z-index: 10;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
              </svg>
            </button>
          </div>
          <a href="{{ route('trip.detail', $trip->slug) }}" style="text-decoration: none; color: inherit; display: block; flex-grow: 1;">
          <div class="card-content">
            <div class="card-header">
              <h3 class="card-title">{{ $trip->title }}</h3>
            </div>
            <p class="card-duration">{{ $trip->duration }}</p>
            
            <div class="card-schedule">
              <div class="schedule-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                  <line x1="16" y1="2" x2="16" y2="6"/>
                  <line x1="8" y1="2" x2="8" y2="6"/>
                  <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                <span>{{ $trip->next_departure ? $trip->next_departure->start_date->format('d M Y') : 'TBA' }}</span>
              </div>
              <div class="schedule-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                  <circle cx="9" cy="7" r="4"/>
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                <span>{{ $trip->next_departure ? ($trip->next_departure->capacity - $trip->next_departure->booked_count) . ' pax left' : 'Open' }}</span>
              </div>
            </div>
            
            <div class="card-amenities">
              @php
                $tripIncludes = $trip->includes ?? [];
                // Filter only includes that have icons in the map
                $validIncludes = array_filter($tripIncludes, function($inc) use ($iconMap) {
                    return isset($iconMap[$inc]);
                });
                
                $maxShow = 5;
                $totalValid = count($validIncludes);
                $remaining = $totalValid - $maxShow;
              @endphp
              
              @if($totalValid > 0)
                  @foreach(array_slice($validIncludes, 0, $maxShow) as $inc)
                    <div class="amenity">
                      <i class="ti ti-{{ $iconMap[$inc]['icon'] }}" style="font-size: 16px; color: rgba(255, 255, 255, 0.6);"></i>
                      <span>{{ $iconMap[$inc]['label'] }}</span>
                    </div>
                  @endforeach
                  
                  @if($remaining > 0)
                    <span class="amenity-more">+{{ $remaining }}</span>
                  @endif
              @else
                  <div class="amenity">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                    </svg>
                    <span>{{ $trip->duration }}</span>
                  </div>
              @endif
            </div>

            <div class="card-features-label" style="font-size: 0.75rem; color: var(--color-primary); font-weight: 600; margin-bottom: 0.25rem;">{{ __('trip.destination') }}:</div>
            <ul class="card-features">
              @if(!empty($trip->highlights))
                @foreach(array_slice($trip->highlights, 0, 4) as $highlight)
                <li>{{ is_array($highlight) ? implode(', ', \Illuminate\Support\Arr::flatten($highlight)) : $highlight }}</li>
                @endforeach
              @endif
            </ul>

            <div class="card-price">
              <span class="price-from">Dari</span>
              <span class="price-current">IDR {{ number_format($trip->from_price, 0, ',', '.') }}</span>
              <span class="price-unit">/ pax</span>
            </div>
          </div>
          </a>
        </div>
        @endforeach
      </div>
      
      <div class="section-cta animate-on-scroll">
        <a href="#contact" class="btn btn-dark">
          {{ __('landing.need_custom_package') }}</
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="5" y1="12" x2="19" y2="12"/>
            <polyline points="12 5 19 12 12 19"/>
          </svg>
        </a>
      </div>
    </div>
  </section>

  <!-- Quote Section -->
  <section class="quote-section">
    <div class="quote-container">
      <div class="quote-background">
        <img src="{{ asset($settings['quote_background_image'] ?? 'images/quote-bg.jpg') }}" alt="Quote Background" data-preview-key="quote_background_image">
        <div class="quote-overlay"></div>
      </div>
      <div class="quote-content">
        <div class="quote-mark animate-on-scroll">"</div>
        <blockquote class="quote-text animate-on-scroll" data-preview-key="quote_text">
          {{ $settings['quote_text'] ?? 'The mountains are calling, and I must go. Every peak conquered is a story written, every trail walked is a memory made.' }}
        </blockquote>
      </div>
    </div>
  </section>

  <style>
    .quote-section {
      position: relative;
      width: 100%;
      background: #000;
    }
    
    .quote-container {
      position: relative;
      width: 100%;
      padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
      overflow: hidden;
    }
    
    .quote-background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
    
    .quote-background img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      filter: grayscale(30%);
    }
    
    .quote-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to right, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1));
    }
    
    .quote-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100%;
      max-width: 1100px;
      text-align: center;
      z-index: 10;
      padding: 0 2rem;
      box-sizing: border-box;
    }
    
    .quote-mark {
      font-size: 60px;
      line-height: 1;
      color: #e97543;
      margin-bottom: 1rem;
      display: block;
      opacity: 0.9;
    }
    
    .quote-text {
      font-family: 'Inter', sans-serif;
      font-size: 3rem;
      line-height: 1.1;
      color: #fff;
      font-weight: 900;
      font-style: italic;
      text-transform: uppercase;
      margin: 0 auto;
      text-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
      max-width: 100%;
      word-wrap: break-word;
      letter-spacing: -1px;
    }
    
    /* Responsive Design */
    @media (max-width: 1024px) {
      .quote-text {
        font-size: 2.25rem;
      }
      .quote-content {
        padding: 0 4rem;
      }
    }

    @media (max-width: 768px) {
      .quote-container {
        padding-bottom: 75%; /* Taller on mobile for better text fit */
      }
      .quote-mark {
        font-size: 50px;
        margin-bottom: 0.5rem;
      }
      .quote-text {
        font-size: 1.5rem; /* Smaller font for mobile */
        line-height: 1.3;
      }
      .quote-content {
        padding: 0 1.5rem; /* More breathing room */
        width: 100%;
        max-width: 100%;
      }
    }
    
    @media (max-width: 480px) {
      .quote-container {
        padding-bottom: 100%; /* More vertical space on small phones */
      }
      .quote-text {
        font-size: 1.25rem;
      }
      .quote-content {
        padding: 0 1.5rem;
      }
    }
  </style>

  <!-- Gallery -->
  <section class="section bg-white">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <h2 class="section-title" data-preview-key="gallery_title">{{ $settings['gallery_title'] ?? 'Adventure Gallery' }}</h2>
        <p class="section-description" data-preview-key="gallery_description">{{ $settings['gallery_description'] ?? 'Moments captured from our journeys. Join us and create your own unforgettable memories.' }}</p>
      </div>

      <div class="gallery-grid animate-on-scroll">
        @foreach($gallery as $img)
        <div class="gallery-item">
          <img src="{{ asset($img->image) }}" alt="{{ $img->caption }}">
          <div class="gallery-overlay">
            <span class="gallery-caption">{{ $img->caption }}</span>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>



  <!-- About -->
  <section id="about" class="section bg-white text-white" style="background-color: #151515 !important;">
    <div class="container">
      @php $locale = app()->getLocale(); @endphp
      <div class="about-grid">
        <div class="about-image animate-on-scroll">
          <img src="{{ asset($settings['about_image'] ?? 'images/Surya Kencana 2.jpg') }}" width="1080" alt="About Monti" data-preview-key="about_image">
          <div class="about-decoration"></div>
        </div>

        <div class="about-content animate-on-scroll">
          <h2 class="about-title text-white" data-preview-key="about_title_{{ $locale }}">{{ $settings['about_title_' . $locale] ?? ($settings['about_title_en'] ?? ($locale == 'id' ? ($settings['about_title'] ?? 'Tentang Monti Outdoor Service') : ($settings['about_title'] ?? 'About Monti Outdoor Service'))) }}</h2>
          <div data-preview-key="about_text_{{ $locale }}" class="about-text-content">
            @php
              $rawText = $settings['about_text_' . $locale] ?? ($settings['about_text_en'] ?? ($settings['about_text'] ?? ''));
              // Remove existing p tags if any to avoid double wrapping, or just strip tags if we want pure text
              // But user might want bold keys. Let's strictly split by newline.
              $paragraphs = preg_split('/\r\n|\r|\n/', $rawText);
            @endphp
            @foreach($paragraphs as $paragraph)
              @if(trim($paragraph))
                <p class="about-text-paragraph">{!! $paragraph !!}</p>
              @endif
            @endforeach
          </div>
          
          <style>
            .about-text-content {
              color: rgba(255, 255, 255, 0.8) !important;
            }
            .about-text-paragraph {
              margin-bottom: 1.5rem;
              line-height: 1.75;
              font-size: 1.1rem;
              color: rgba(255, 255, 255, 0.8);
            }
          </style>

          <div class="values-grid">
            <div class="value-item">
              <div class="value-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
              </div>
              <div class="value-content">
                <h4 class="value-title text-white" data-preview-key="about_point_1_title_{{ $locale }}">{{ $settings['about_point_1_title_' . $locale] ?? ($settings['about_point_1_title_en'] ?? ($locale == 'id' ? 'Safety First' : 'Safety First')) }}</h4>
                <p class="value-description" style="color: rgba(255, 255, 255, 0.7);" data-preview-key="about_point_1_desc_{{ $locale }}">{{ $settings['about_point_1_desc_' . $locale] ?? ($settings['about_point_1_desc_en'] ?? ($locale == 'id' ? 'Pemandu & protokol bersertifikat' : 'Certified guides & protocols')) }}</p>
              </div>
            </div>

            <div class="value-item">
              <div class="value-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 2a10 10 0 0 1 7.38 16.75L12 22l-7.38-3.25A10 10 0 0 1 12 2z"/>
                </svg>
              </div>
              <div class="value-content">
                <h4 class="value-title text-white" data-preview-key="about_point_2_title_{{ $locale }}">{{ $settings['about_point_2_title_' . $locale] ?? ($settings['about_point_2_title_en'] ?? ($locale == 'id' ? 'Ramah Lingkungan' : 'Eco-Friendly')) }}</h4>
                <p class="value-description" style="color: rgba(255, 255, 255, 0.7);" data-preview-key="about_point_2_desc_{{ $locale }}">{{ $settings['about_point_2_desc_' . $locale] ?? ($settings['about_point_2_desc_en'] ?? ($locale == 'id' ? 'Prinsip Tanpa Jejak' : 'Leave No Trace principles')) }}</p>
              </div>
            </div>

            <div class="value-item">
              <div class="value-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                  <circle cx="9" cy="7" r="4"/>
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
              </div>
              <div class="value-content">
                <h4 class="value-title text-white" data-preview-key="about_point_3_title_{{ $locale }}">{{ $settings['about_point_3_title_' . $locale] ?? ($settings['about_point_3_title_en'] ?? ($locale == 'id' ? 'Komunitas' : 'Community')) }}</h4>
                <p class="value-description" style="color: rgba(255, 255, 255, 0.7);" data-preview-key="about_point_3_desc_{{ $locale }}">{{ $settings['about_point_3_desc_' . $locale] ?? ($settings['about_point_3_desc_en'] ?? ($locale == 'id' ? 'Mendukung komunitas lokal' : 'Supporting local communities')) }}</p>
              </div>
            </div>

            <div class="value-item">
              <div class="value-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
              </div>
              <div class="value-content">
                <h4 class="value-title text-white" data-preview-key="about_point_4_title_{{ $locale }}">{{ $settings['about_point_4_title_' . $locale] ?? ($settings['about_point_4_title_en'] ?? ($locale == 'id' ? 'Keunggulan' : 'Excellence')) }}</h4>
                <p class="value-description" style="color: rgba(255, 255, 255, 0.7);" data-preview-key="about_point_4_desc_{{ $locale }}">{{ $settings['about_point_4_desc_' . $locale] ?? ($settings['about_point_4_desc_en'] ?? ($locale == 'id' ? 'Layanan & peralatan berkualitas' : 'Quality service & equipment')) }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section bg-white">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <h2 class="section-title">Explore Our Adventures</h2>
        <p class="section-description">Choose your preferred way to explore nature and build connections.</p>
      </div>

      <div class="blog-grid">
        <!-- Mountain Trip -->
        <article class="blog-card animate-on-scroll">
          <div class="blog-image">
            <img src="{{ isset($mountainHero->images[0]) ? asset($mountainHero->images[0]) : asset('assets/img/front-pages/hero/mountain-hero.jpg') }}" alt="Mountain Trip" style="height: 240px; object-fit: cover;">
            <div class="blog-category">Mountain</div>
          </div>
          <div class="blog-content">
            <h3 class="blog-title">{{ $mountainHero->title ?? 'Mountain Trip' }}</h3>
            <p class="blog-excerpt">{{ $mountainHero->subtitle ?? 'Explore the majestic peaks of Indonesia. Available for Private, Open, and Expedition trips.' }}</p>
            <a href="{{ route('mountain-trip') }}" class="blog-link">
              Explore Mountain Trip
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </a>
          </div>
        </article>

        <!-- Outdoor Trip -->
        <article class="blog-card animate-on-scroll">
          <div class="blog-image">
            <img src="{{ isset($outdoorHero->images[0]) ? asset($outdoorHero->images[0]) : asset('assets/img/front-pages/hero/outdoor-hero.jpg') }}" alt="Outdoor Activity" style="height: 240px; object-fit: cover;">
            <div class="blog-category">Outdoor</div>
          </div>
          <div class="blog-content">
            <h3 class="blog-title">{{ $outdoorHero->title ?? 'Outdoor Activity Trip' }}</h3>
            <p class="blog-excerpt">{{ $outdoorHero->subtitle ?? 'Experience thrilling outdoor adventures. From Island Trips to Camping and Team Building.' }}</p>
            <a href="{{ route('outdoor-trip') }}" class="blog-link">
              Explore Outdoor Activity Trip
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </a>
          </div>
        </article>

        <!-- Indoor Trip -->
        <article class="blog-card animate-on-scroll">
          <div class="blog-image">
            <img src="{{ isset($indoorHero->images[0]) ? asset($indoorHero->images[0]) : asset('assets/img/front-pages/hero/indoor-hero.jpg') }}" alt="Indoor Activity" style="height: 240px; object-fit: cover;">
            <div class="blog-category">Indoor</div>
          </div>
          <div class="blog-content">
            <h3 class="blog-title">{{ $indoorHero->title ?? 'Indoor Activity Trip' }}</h3>
            <p class="blog-excerpt">{{ $indoorHero->subtitle ?? 'Exciting activities without going too far. City Tours, Gatherings, and MICE Organizer.' }}</p>
            <a href="{{ route('indoor-trip') }}" class="blog-link">
              Explore Indoor Activity Trip
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </a>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="section bg-light">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <h2 class="section-title">Get in Touch</h2>
        <p class="section-description">Ready to start your adventure? Contact us for bookings, custom packages, or any questions.</p>
      </div>

      <div class="contact-grid">
        <div class="contact-form-wrapper animate-on-scroll">
          <form class="contact-form" id="contactForm">
            <h3 class="form-title">Send Us a Message</h3>

            <div class="form-group">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" id="name" name="name" class="form-input" placeholder="Your name" required>
            </div>

            <div class="form-group">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" id="email" name="email" class="form-input" placeholder="your.email@example.com" required>
            </div>

            <div class="form-group">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="tel" id="phone" name="phone" class="form-input" placeholder="+62 812 3456 7890">
            </div>

            <div class="form-group">
              <label for="tripType" class="form-label">Type of Trip</label>
              <select id="tripType" name="tripType" class="form-input">
                <option value="">Select a trip type</option>
                <option value="mountain-open">Mountain Open Trip</option>
                <option value="mountain-expedition">Mountain Expedition</option>
                <option value="island">Island Trip</option>
                <option value="camping">Camping</option>
                <option value="team-building">Team Building</option>
                <option value="city-tour">City Tour</option>
                <option value="custom">Custom Package</option>
              </select>
            </div>

            <div class="form-group">
              <label for="message" class="form-label">Message</label>
              <textarea id="message" name="message" class="form-input" rows="5" placeholder="Tell us about your adventure plans..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-full">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="22" y1="2" x2="11" y2="13"/>
                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
              </svg>
              Send Message
            </a>
          </form>
        </div>

        <div class="contact-info-wrapper animate-on-scroll">
          <div class="contact-info-card">
            <h3 class="contact-info-title">Contact Information</h3>

            <div class="contact-info-item">
              <div class="contact-info-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
              </div>
              <div>
                <h4 class="contact-info-subtitle">Phone</h4>
                <p class="contact-info-text" data-preview-key="contact_phone">{{ $settings['contact_phone'] ?? '+62 812 3456 7890' }}</p>
              </div>
            </div>

            <div class="contact-info-item">
              <div class="contact-info-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                  <polyline points="22,6 12,13 2,6"/>
                </svg>
              </div>
              <div>
                <h4 class="contact-info-subtitle">Email</h4>
                <p class="contact-info-text" data-preview-key="contact_email">{{ $settings['contact_email'] ?? 'hello@montioutdoor.com' }}</p>
              </div>
            </div>

            <div class="contact-info-item">
              <div class="contact-info-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                  <circle cx="12" cy="10" r="3"/>
                </svg>
              </div>
              <div>
                <h4 class="contact-info-subtitle">Location</h4>
                <p class="contact-info-text" data-preview-key="contact_address">{{ $settings['contact_address'] ?? 'Jakarta, Indonesia' }}</p>
              </div>
            </div>
          </div>

          <div class="whatsapp-cta">
            <div class="whatsapp-header">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
              </svg>
              <h3 class="whatsapp-title">Quick WhatsApp Inquiry</h3>
            </div>
            <p class="whatsapp-text">Get instant responses to your questions. Chat with us on WhatsApp!</p>
            <a href="https://wa.me/6281234567890?text=Hi%20Monti%20Outdoor%20Service!%20I'm%20interested%20in%20learning%20more%20about%20your%20trips%20and%20packages." target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp">
              Chat on WhatsApp
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-col">
          <div class="footer-logo">
            @if(isset($settings['global_footer_logo']))
              <img src="{{ asset($settings['global_footer_logo']) }}" alt="Monti Outdoor" width="32" height="32" data-preview-key="global_footer_logo">
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
            <li><a href="#home">Dashboard</a></li>
            <li><a href="#trips">Trips & Packages</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#contact">Contact</a></li>
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
            </a>
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

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Favorite button toggle with Backend
        @auth
          const isUserLoggedIn = true;
        @else
          const isUserLoggedIn = false;
        @endauth
        
        document.querySelectorAll('.favorite-btn').forEach(btn => {
          btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (!isUserLoggedIn) {
                window.location.href = "{{ route('login') }}";
                return;
            }
            
            const tripId = this.dataset.tripId;
            const button = this;
            
            // Optimistic UI update
            this.classList.toggle('active');
            
            fetch('{{ route("user.wishlist.toggle") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    trip_template_id: tripId
                })
            })
            .then(response => {
                if(!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if(typeof toastr !== 'undefined') {
                    if(data.status === 'added') toastr.success(data.message);
                    if(data.status === 'removed') toastr.info(data.message);
                }
            })
            .catch(error => {
                console.error('Error toggling wishlist:', error);
                button.classList.toggle('active');
                if(typeof toastr !== 'undefined') {
                    toastr.error('Terjadi kesalahan saat menyimpan wishlist.');
                }
            });
          });
        });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  
  <script src="{{ asset('js/landing.js') }}"></script>
  @vite(['resources/js/landing-preview.js', 'resources/js/landing-ui-fixes.js'])
</body>
</html>
