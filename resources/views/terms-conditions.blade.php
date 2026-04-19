<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Primary Meta Tags -->
  <title>Syarat & Ketentuan - Monti Outdoor Service</title>
  <meta name="title" content="Syarat & Ketentuan - Monti Outdoor Service">
  <meta name="description" content="Syarat dan ketentuan layanan Monti Outdoor Service. Baca selengkapnya sebelum melakukan pemesanan trip.">
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

    /* Terms & Conditions Page Styles */
    .tc-hero {
      position: relative;
      min-height: 40vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      padding: 120px 0 60px;
    }
    .tc-hero .hero-bg {
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, #151515 0%, #1e1e1e 100%);
    }
    .tc-hero .hero-content {
      position: relative;
      z-index: 10;
      text-align: center;
      max-width: 800px;
    }
    .tc-badge {
      display: inline-block;
      background: var(--color-primary);
      color: white;
      padding: 0.35rem 1rem;
      border-radius: 4px;
      font-size: 0.875rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }
    .tc-title {
      font-size: 2.5rem;
      font-weight: 900;
      color: #fbcaa5;
      margin-bottom: 0.5rem;
    }
    .tc-subtitle {
      color: rgba(251, 202, 165, 0.8);
      font-size: 1rem;
    }

    /* Main Content */
    .tc-content {
      background: #1e1e1e;
      padding: 4rem 0;
    }
    .tc-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 0 1rem;
    }
    .tc-container h2 {
      font-size: 1.75rem;
      font-weight: 800;
      color: #fbcaa5;
      margin-bottom: 2rem;
      padding-bottom: 1rem;
      border-bottom: 3px solid var(--color-primary);
    }
    .tc-container h3 {
      font-size: 1.25rem;
      font-weight: 700;
      color: #fbcaa5;
      margin-top: 2rem;
      margin-bottom: 1rem;
    }
    .tc-container p {
      color: rgba(251,202,165,0.85);
      line-height: 1.8;
      margin-bottom: 1rem;
    }
    .tc-container ul {
      padding-left: 1.5rem;
      margin-bottom: 1.5rem;
    }
    .tc-container li {
      color: rgba(251,202,165,0.85);
      line-height: 1.8;
      margin-bottom: 0.5rem;
    }
    .tc-container strong {
      color: #fbcaa5;
    }

    /* Back link */
    .tc-back {
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 1px solid rgba(251,202,165,0.2);
      text-align: center;
    }
    .tc-back a {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      color: var(--color-primary);
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }
    .tc-back a:hover {
      gap: 0.75rem;
    }

    /* T&C Image Gallery */
    .tc-images-gallery {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
    .tc-image-item {
      width: 100%;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .tc-image-item img {
      width: 100%;
      height: auto;
      display: block;
    }
    
    /* Empty State */
    .tc-empty-state {
      text-align: center;
      padding: 4rem 2rem;
      color: rgba(251,202,165,0.7);
    }
    .tc-empty-state svg {
      margin-bottom: 1.5rem;
      opacity: 0.5;
    }
    .tc-empty-state h3 {
      color: #fbcaa5;
      font-size: 1.5rem;
      margin-bottom: 0.5rem;
    }
    .tc-empty-state p {
      color: rgba(251,202,165,0.6);
    }

    @media (max-width: 768px) {
      .tc-title {
        font-size: 1.75rem;
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
          <!-- About Us -->
          <a href="{{ route('about-us') }}" class="nav-link">About Us</a>

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
              <a href="{{ route('open-trip') }}" class="dropdown-item">Private Trip</a>
              <a href="{{ route('open-trip') }}" class="dropdown-item">One Day Trip</a>
              <a href="{{ route('open-trip') }}" class="dropdown-item">Expedition Trip</a>
              <a href="{{ route('open-trip') }}" class="dropdown-item">International Trip</a>
              <a href="{{ route('open-trip') }}" class="dropdown-item">Custom Trip</a>
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
                  <a href="{{ route('user.invoice') }}" class="dropdown-item">My Invoice</a>
                  <a href="{{ route('user.transaction') }}" class="dropdown-item">My Transaction</a>
                  <a href="{{ route('user.wishlist') }}" class="dropdown-item">My Wishlist</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="dropdown-item" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; font-size: 15px; padding-top: 8px; padding-bottom: 8px;">Logout</button>
                </form>
              </div>
            </div>
          @else
            <a href="{{ route('login') }}" class="btn btn-primary">Book Now</a>
          @endauth
        </nav>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="tc-hero">
    <div class="hero-bg"></div>
    <div class="hero-content container">
      <span class="tc-badge">{{ __('general.legal') }}</span>
      <h1 class="tc-title">{{ __('general.terms_conditions_title') }}</h1>
      <p class="tc-subtitle">{{ __('general.terms_conditions_subtitle') }}</p>
    </div>
  </section>

  <!-- Main Content - Image Gallery -->
  <section class="tc-content">
    <div class="tc-container">
      @php 
          $tcImages = isset($settings['terms_conditions_images']) ? json_decode($settings['terms_conditions_images'], true) : [];
      @endphp
      
      @if(is_array($tcImages) && count($tcImages) > 0)
        <div class="tc-images-gallery">
          @foreach($tcImages as $index => $img)
            <div class="tc-image-item">
              @if(is_string($img))
                <img src="{{ asset($img) }}" alt="Terms & Conditions - Page {{ $index + 1 }}" loading="lazy">
              @elseif(is_array($img) && count($img) > 0 && is_string($img[0]))
                <img src="{{ asset($img[0]) }}" alt="Terms & Conditions - Page {{ $index + 1 }}" loading="lazy">
              @endif
            </div>
          @endforeach
        </div>
      @else
        <div class="tc-empty-state">
          <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14,2 14,8 20,8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10,9 9,9 8,9"></polyline>
          </svg>
          <h3>Terms & Conditions Belum Tersedia</h3>
          <p>Silakan hubungi Admin untuk informasi lebih lanjut.</p>
        </div>
      @endif

      <div class="tc-back">
        <a href="{{ route('open-trip') }}">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
          </svg>
          {{ __('general.back_to_open_trip') }}
        </a>
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
