<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Primary Meta Tags -->
  <title>Tentang Kami - Monti Outdoor Service | Tour & Travel Profesional</title>
  <meta name="title" content="Tentang Kami - Monti Outdoor Service | Tour & Travel Profesional">
  <meta name="description" content="Kenali lebih dekat Monti Outdoor Service - PT Monti Menjelajah Negeri & PT Monti Membangun Sinergi. Tim profesional dengan pengalaman bertahun-tahun di industri wisata dan adventure.">
  <meta name="keywords" content="monti outdoor, tentang kami, about us, tour travel, event organizer, mountain guide, tim profesional">
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
  <meta property="og:title" content="Tentang Kami - Monti Outdoor Service">
  <meta property="og:description" content="Kenali lebih dekat Monti Outdoor Service - tim profesional dengan pengalaman bertahun-tahun di industri wisata dan adventure.">
  <meta property="og:image" content="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}">
  <meta property="og:locale" content="id_ID">
  <meta property="og:site_name" content="Monti Outdoor Service">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="{{ url()->current() }}">
  <meta property="twitter:title" content="Tentang Kami - Monti Outdoor Service">
  <meta property="twitter:description" content="Kenali lebih dekat Monti Outdoor Service - tim profesional dengan pengalaman bertahun-tahun di industri wisata dan adventure.">
  <meta property="twitter:image" content="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}">

  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
  @vite(['resources/css/landing-ui-fixes.css'])
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    /* Fix Mobile Menu Background (dark like main page) */
    .nav.mobile-open {
      background: rgba(30, 30, 30, 0.95) !important;
      backdrop-filter: blur(10px) !important;
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

    /* About Hero */
    .about-hero {
      position: relative;
      min-height: 70vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      padding: 120px 0 60px;
    }
    .about-hero .hero-bg {
      position: absolute;
      inset: 0;
    }
    .about-hero .hero-bg img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: bottom;
    }
    .about-hero .hero-overlay {
      position: absolute;
      inset: 0;
      background: transparent;
    }
    .about-hero .hero-content {
      position: relative;
      z-index: 10;
      text-align: left;
      max-width: 800px;
    }
    .about-badge {
      display: inline-block;
      background: var(--color-primary);
      color: white;
      padding: 0.35rem 1rem;
      border-radius: 4px;
      font-size: 0.875rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }
    .about-title {
      font-size: 3rem;
      font-weight: 900;
      background: linear-gradient(135deg, #f59e0b, #ea580c);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 1rem;
      text-decoration: underline;
      text-decoration-color: #f59e0b;
      text-underline-offset: 8px;
    }
    .about-subtitle {
      color: rgba(251, 202, 165, 0.9);
      font-size: 1.125rem;
      line-height: 1.8;
      font-style: italic;
    }

    /* Salam Kenal Section */
    .salam-section {
      background: #1e1e1e;
      padding: 4rem 0;
    }
    .salam-title {
      font-size: 2.5rem;
      font-weight: 900;
      color: #fbcaa5;
      margin-bottom: 1.5rem;
    }
    .salam-content p {
      color: rgba(251,202,165,0.85);
      line-height: 1.9;
      margin-bottom: 1.5rem;
      font-size: 1rem;
    }
    .salam-content strong {
      color: #fbcaa5;
    }

    /* Quote Section - Match Reference Design */
    .quote-section {
      position: relative;
      min-height: auto;
      overflow: hidden;
      padding: 3.5rem 0 3rem;
    }
    .quote-section .quote-bg {
      position: absolute;
      inset: 0;
    }
    .quote-section .quote-bg img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }
    .quote-section .quote-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.6));
    }
    
    /* Main wrapper - vertical layout */
    .quote-company-wrapper {
      position: relative;
      z-index: 10;
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }
    
    /* Quote at top - full width, centered */
    .quote-content {
      padding: 0;
      text-align: center;
      max-width: 950px;
      margin: 0 auto;
    }
    .quote-text {
      color: #fbbf24;
      font-size: 1.5rem;
      font-weight: 500;
      line-height: 1.8;
      font-style: italic;
    }
    .quote-text .highlight {
      color: #fff;
      font-weight: 700;
    }

    /* Company Section - 2 columns below quote */
    .company-section {
      padding: 1.5rem 0 0;
    }
    .company-grid {
      display: grid;
      grid-template-columns: 480px 1fr;
      gap: 2rem;
      align-items: start;
      max-width: 1200px;
      margin: 0 auto;
    }
    @media (max-width: 768px) {
      .company-grid {
        grid-template-columns: 1fr;
        text-align: center;
      }
    }
    .company-left {
      text-align: center;
    }
    .company-logo {
      max-width: 90px;
      margin: 0 auto 0.5rem;
    }
    .company-name {
      color: #fbbf24;
      font-size: 1rem;
      font-weight: 700;
      margin-bottom: 0.25rem;
    }
    .company-subtitle {
      color: #9ca3af;
      font-size: 0.8rem;
      margin-bottom: 0.65rem;
    }
    .mms-logo-img {
      max-width: 100px !important;
      margin: 0 auto !important;
    }
    .mms-name {
      color: #9ca3af;
      font-size: 0.8rem;
      margin-top: 0.35rem;
    }
    .company-right p {
      color: #fff;
      font-size: 1.1rem;
      margin-bottom: 0.85rem;
      line-height: 1.75;
      text-align: left;
    }
    .company-right p strong {
      color: #fbbf24;
    }
    .company-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .company-list li {
      color: #d1d5db;
      font-size: 1rem;
      margin-bottom: 0.5rem;
      padding-left: 1.25rem;
      position: relative;
    }
    .company-list li::before {
      content: '–';
      color: var(--color-primary);
      position: absolute;
      left: 0;
    }
    .company-list a {
      color: #fbbf24;
      text-decoration: none;
    }
    .company-list a:hover {
      text-decoration: underline;
    }
    /* Partner logos - below company-left */
    .partner-logos {
      display: flex;
      gap: 0.5rem;
      flex-wrap: nowrap;
      margin-top: 1.25rem;
      align-items: center;
      justify-content: center;
    }
    .partner-logos img {
      height: 70px;
      max-width: 100%;
      object-fit: contain;
      opacity: 0.9;
      filter: grayscale(10%);
      transition: all 0.3s ease;
    }
    .partner-logos img:hover {
      opacity: 1;
      filter: grayscale(0%);
    }

    /* Team Section */
    .team-section {
      position: relative;
      padding: 4rem 0;
      overflow: hidden;
    }
    .team-section .team-bg {
      position: absolute;
      inset: 0;
      z-index: -1;
    }
    .team-section .team-bg img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: bottom;
      opacity: 1;
    }
    .team-header {
      text-align: center;
      margin-bottom: 3rem;
    }
    .team-title {
      font-size: 2.5rem;
      font-weight: 900;
      color: #000000;
      margin-bottom: 1rem;
      text-decoration: underline;
      text-decoration-color: var(--color-primary);
      text-underline-offset: 8px;
    }
    .team-intro {
      color: #000000;
      font-size: 1rem;
      max-width: 800px;
      margin: 0 auto;
      font-style: italic;
      line-height: 1.8;
    }
    .team-photo {
      width: 100%;
      margin: 0 auto 3rem;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }
    .team-photo img {
      width: 100%;
    }
    .team-grid {
      display: flex;
      flex-direction: column;
      gap: 3rem;
      width: 100%;
      margin: 0 auto;
    }
    .team-member {
      display: flex;
      align-items: center;
      gap: 2rem;
      padding: 1rem 0;
      background: transparent;
      border-radius: 0;
      box-shadow: none;
    }
    .team-member.reverse {
      flex-direction: row-reverse;
      text-align: right;
    }
    .team-avatar {
      width: 220px;
      height: 220px;
      border-radius: 50%;
      overflow: hidden;
      flex-shrink: 0;
      border: 4px solid var(--color-primary);
    }
    .team-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .team-info h4 {
      font-size: 2.25rem;
      font-weight: 700;
      color: #000000;
      margin-bottom: 0.5rem;
    }
    .team-info h4 .nickname {
      color: #000000;
    }
    .team-info p {
      font-size: 1.35rem;
      color: #000000;
      margin: 0;
      line-height: 1.5;
      font-weight: 600;
    }
    .team-info .role-primary {
      color: #000000;
      text-decoration: none;
    }

    /* Hashtag */
    .hashtag-section {
      text-align: center;
      padding: 3rem 0;
      margin-top: 5rem;
    }
    .hashtag-logo {
      max-width: 300px;
      margin: 0 auto 0.5rem;
    }
    .hashtag {
      font-size: 2rem;
      font-weight: 900;
      color: #fbcaa5;
      font-style: italic;
    }
    .hashtag-sub {
      color: rgba(251,202,165,0.7);
      font-size: 0.875rem;
    }

    @media (max-width: 768px) {
      .about-title {
        font-size: 2rem;
      }
      .quote-text {
        font-size: 1.125rem;
      }
      .team-title {
        font-size: 1.75rem;
      }
      
      /* Team Mobile Optimizations */
      .team-grid {
        gap: 2.5rem;
      }
      .team-member, 
      .team-member.reverse {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
        padding: 0 1rem;
      }
      .team-avatar {
        width: 180px;
        height: 180px;
        margin: 0 auto;
      }
      .team-info h4 {
        font-size: 1.75rem;
      }
      .team-info p {
        font-size: 1.15rem;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header id="header" class="header">
    <div class="container">
      <div class="header-content">
        <a href="{{ route('landing') }}" class="logo">
          <img src="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}" alt="Logo" width="100">
        </a>

        <button class="mobile-menu-btn" aria-label="Toggle menu">
          <span></span>
          <span></span>
          <span></span>
        </button>

        <nav class="nav">
          <!-- About Us - current page -->
          <a href="{{ route('about-us') }}" class="nav-link" style="color: var(--color-primary); font-weight: 600;">About Us</a>

          <!-- Open Trip -->
          <a href="{{ route('open-trip') }}" class="nav-link">Open Trip</a>
          
          <!-- Mountain Trip with submenu -->
          <div class="dropdown">
            <a href="{{ route('mountain-trip') }}" class="custom-dropdown-toggle dropdown-toggle">
              Mountain Trip
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </button>
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

  <!-- Hero Section -->
  <section class="about-hero">
    <div class="hero-bg">
      <img src="{{ asset('images/about-us/hero-hiking.jpg') }}" alt="Hiking Team">
      <div class="hero-overlay"></div>
    </div>
    <div class="hero-content container">
      <span class="about-badge">{{ __('about.hero.badge') }}</span>
      <h1 class="about-title">{{ __('about.hero.title') }}</h1>
      <p class="about-subtitle">
        {{ __('about.hero.subtitle') }}
      </p>
    </div>
  </section>

  <!-- Salam Kenal Section -->
  <section class="salam-section">
    <div class="container">
      <h2 class="salam-title">{{ __('about.intro.title') }}</h2>
      <div class="salam-content">
        <p>
          <strong>{{ __('about.intro.p1') }}</strong>
        </p>
        <p>
          <strong>{{ __('about.intro.p2') }}</strong>
        </p>
        <p>
          <strong>{{ __('about.intro.p3') }}</strong>
        </p>
      </div>
    </div>
  </section>

  <!-- Quote + Company Section (merged with same background) -->
  <section class="quote-section">
    <div class="quote-bg">
      <img src="{{ asset('images/about-us/quote-mountain.jpg') }}" alt="Mountain View">
      <div class="quote-overlay"></div>
    </div>
    
    <div class="container">
      <div class="quote-company-wrapper">
        <!-- Quote text at top - full width -->
        <div class="quote-content">
          <p class="quote-text">
            {!! __('about.quote.text') !!}
          </p>
        </div>
        
        <!-- Company info below - 2 columns: logo left, text right -->
        <div class="company-section">
          <div class="company-grid">
            <div class="company-left">
              <img src="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}" alt="MONTI Logo" class="company-logo">
              <h3 class="company-name">PT. MONTI MENJELAJAH NEGERI</h3>
              <p class="company-subtitle">{{ __('about.company.subtitle') }}</p>
              <img src="{{ asset('images/about-us/logo-mms.png') }}" alt="MMS" class="mms-logo-img">
              <p class="mms-name">PT. MONTI MEMBANGUN SINERGI</p>
              
              <!-- Partner logos below company logos -->
              <div class="partner-logos">
                <img src="{{ asset('images/about-us/partner-monti-outdoor-hd.png') }}" alt="Monti">
                <img src="{{ asset('images/about-us/partner-monti-homestay-hd.png') }}" alt="Monti Homestay">
                <img src="{{ asset('images/about-us/partner-monti-kopi-hd.png') }}" alt="Monti Kopi">
                <img src="{{ asset('images/about-us/partner-monti-studio-hd.png') }}" alt="Monti Studio">
                <img src="{{ asset('images/about-us/partner-monti-wedding-hd.png') }}" alt="Monti Wedding">
              </div>
            </div>
            
            <div class="company-right">
              <p>
                {!! __('about.company.description') !!}
              </p>
              <ul class="company-list">
                <li>{{ __('about.company.services.coffee') }} <span style="white-space: nowrap;">( IG: <a href="https://instagram.com/montikopi.id" target="_blank">@montikopi.id</a> )</span></li>
                <li>{{ __('about.company.services.studio') }} <span style="white-space: nowrap;">( IG: <a href="https://instagram.com/montistudio.id" target="_blank">@montistudio.id</a> )</span></li>
                <li>{{ __('about.company.services.wedding') }} <span style="white-space: nowrap;">( IG: <a href="https://instagram.com/montiwedding" target="_blank">@montiwedding</a> )</span></li>
                <li>{{ __('about.company.services.homestay') }} <span style="white-space: nowrap;">( IG: <a href="https://instagram.com/monti.homestay" target="_blank">@monti.homestay</a> )</span></li>
                <li>{{ __('about.company.services.trip') }} <span style="white-space: nowrap;">( IG: <a href="https://instagram.com/monti.outdoorservice" target="_blank">@monti.outdoorservice</a> )</span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Team Section -->
  <section class="team-section">
    <div class="team-bg">
      <img src="{{ asset('images/about-us/team-bg.jpg') }}" alt="Mountain Background">
    </div>
    <div class="container">
      <div class="team-header">
        <h2 class="team-title">{{ __('about.team.title') }}</h2>
        <p class="team-intro">
          {{ __('about.team.intro') }}
        </p>
      </div>

      <!-- Team Group Photo -->
      <div class="team-photo">
        <img src="{{ asset('images/about-us/team-photo.jpg') }}" alt="MONTI Outdoor Service Team">
      </div>

      <!-- Team Grid -->
      <div class="team-grid">
        <!-- Member 1 -->
        <div class="team-member">
          <div class="team-avatar">
            <img src="{{ asset('images/about-us/team-prabowo.png') }}" alt="Prabowo">
          </div>
          <div class="team-info">
            <h4>PRABOWO TRIPURYANTO</h4>
            <p><strong><span class="role-primary">{{ __('about.team.owner_role') }}</span></strong></p>
            <p><strong>Agrobussines</strong></p>
            <p><strong>Mountain Guide</strong></p>
          </div>
        </div>

        <!-- Member 2 -->
        <div class="team-member reverse">
          <div class="team-avatar">
            <img src="{{ asset('images/about-us/team-baim.png') }}" alt="Ali Ataya">
          </div>
          <div class="team-info">
            <h4>ALI ATAYA <span class="nickname">"BETAY"</span></h4>
            <p><strong><span class="role-primary">Operational</span></strong></p>
            <p><strong>Mountain Guide</strong></p>
            <p><strong>Tour Leader</strong></p>
          </div>
        </div>

        <!-- Member 3 -->
        <div class="team-member">
          <div class="team-avatar">
            <img src="{{ asset('images/about-us/team-lucky.png') }}" alt="Shuhaib">
          </div>
          <div class="team-info">
            <h4>SHUHAIB ZINDANI <span class="nickname">"KOJUN"</span></h4>
            <p><strong><span class="role-primary">Content Creator</span></strong></p>
            <p><strong>Mountain Guide</strong></p>
            <p><strong>Photographer</strong></p>
          </div>
        </div>

        <!-- Member 4 -->
        <div class="team-member reverse">
          <div class="team-avatar">
            <img src="{{ asset('images/about-us/team-akmal.png') }}" alt="Fitkri">
          </div>
          <div class="team-info">
            <h4>FITKRI ARYADI <span class="nickname">"BAKUL"</span></h4>
            <p><strong><span class="role-primary">Finance Manager</span></strong></p>
            <p><strong>Mountain Guide</strong></p>
            <p><strong>Chef</strong></p>
          </div>
        </div>

        <!-- Member 5 -->
        <div class="team-member">
          <div class="team-avatar">
            <img src="{{ asset('images/about-us/team-dinda.png') }}" alt="Alpian">
          </div>
          <div class="team-info">
            <h4>ALPIAN DWI SAPUTRA <span class="nickname">"BOKIR"</span></h4>
            <p><strong><span class="role-primary">Administrator</span></strong></p>
            <p><strong>Mountain Guide</strong></p>
            <p><strong>Extern Human Resource Coordinator</strong></p>
          </div>
        </div>

        <!-- Member 6 -->
        <div class="team-member reverse">
          <div class="team-avatar">
            <img src="{{ asset('images/about-us/team-ina.png') }}" alt="Muhammad">
          </div>
          <div class="team-info">
            <h4>MUHAMMAD MUHAJIRIN <span class="nickname">"BONTOT"</span></h4>
            <p><strong><span class="role-primary">Logistics & Inventory</span></strong></p>
            <p><strong>Mountain Guide</strong></p>
            <p><strong>Venue & Camp Coordinator</strong></p>
          </div>
        </div>

        <!-- Member 7 -->
        <div class="team-member">
          <div class="team-avatar">
            <img src="{{ asset('images/about-us/team-neng.png') }}" alt="M. Yayi">
          </div>
          <div class="team-info">
            <h4>M. YAYI AL KAHFI <span class="nickname">"NCANG"</span></h4>
            <p><strong><span class="role-primary">Logistics & Inventory</span></strong></p>
            <p><strong>Mountain Guide</strong></p>
          </div>
        </div>

        <!-- Member 8 -->
        <div class="team-member reverse">
          <div class="team-avatar">
            <img src="{{ asset('images/about-us/team-ikul.png') }}" alt="M. Iksan">
          </div>
          <div class="team-info">
            <h4>M. IKSAN ULUPUTTY <span class="nickname">"IKUL"</span></h4>
            <p><strong><span class="role-primary">Public Relations</span></strong></p>
            <p><strong>Mountain Guide</strong></p>
          </div>
        </div>
      </div>

      <!-- Hashtag -->
      <div class="hashtag-section">
        <img src="{{ asset('images/about-us/logo-cerita-di-alam.png') }}" alt="#ceritadialam" class="hashtag-logo">
        <!-- <p class="hashtag-sub">@monti.outdoorservice</p> -->
      </div>
    </div>
  </section>

  <!-- Footer -->
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
            <span>Monti Outdoor</span>
          </div>
          <p class="footer-description">{{ $settings['global_footer_text'] ?? 'Your trusted partner for outdoor adventures and mountain expeditions across Indonesia.' }}</p>
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
            <li><a href="{{ route('about-us') }}">About Us</a></li>
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

  <script src="{{ asset('js/landing.js') }}"></script>
  @vite(['resources/js/landing-preview.js', 'resources/js/landing-ui-fixes.js'])
</body>
</html>
