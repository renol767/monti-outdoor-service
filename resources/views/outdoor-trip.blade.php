<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Primary Meta Tags -->
  <title>Outdoor Activity Trip - Wisata Alam & Petualangan | Monti Outdoor Service</title>
  <meta name="title" content="Outdoor Activity Trip - Wisata Alam & Petualangan | Monti Outdoor Service">
  <meta name="description" content="Layanan aktivitas outdoor: Cultural Trip, Island Trip, Camping, Team Building outdoor. Nikmati petualangan alam bersama tim profesional Monti Outdoor.">
  <meta name="keywords" content="outdoor activity, outdoor trip, wisata alam, island trip, camping, team building outdoor, cultural trip">
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
  <meta property="og:title" content="Outdoor Activity Trip - Wisata Alam & Petualangan">
  <meta property="og:description" content="Layanan aktivitas outdoor: Cultural, Island Trip, Camping, Team Building dengan tim profesional.">
  <meta property="og:image" content="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}">
  <meta property="og:locale" content="id_ID">
  <meta property="og:site_name" content="Monti Outdoor Service">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="{{ url()->current() }}">
  <meta property="twitter:title" content="Outdoor Activity Trip - Wisata Alam & Petualangan">
  <meta property="twitter:description" content="Layanan aktivitas outdoor: Cultural, Island Trip, Camping, Team Building dengan tim profesional.">
  <meta property="twitter:image" content="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}">

  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
  @vite(['resources/css/landing-ui-fixes.css'])
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    /* Hero Section */
    .mt-hero {
      position: relative;
      min-height: 50vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      padding: 120px 0 60px;
    }
    .mt-hero .hero-bg {
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
    }
    .mt-hero .hero-bg::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url("data:image/svg+xml,%3Csvg viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 80 L25 50 L50 70 L75 30 L100 60 L100 100 L0 100 Z' fill='rgba(255,255,255,0.03)'/%3E%3C/svg%3E") no-repeat bottom;
      background-size: cover;
    }
    .mt-hero .hero-content {
      position: relative;
      z-index: 10;
      text-align: center;
      max-width: 800px;
    }
    .mt-badge {
      display: inline-block;
      background: var(--color-primary);
      color: white;
      padding: 0.35rem 1rem;
      border-radius: 4px;
      font-size: 0.875rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }
    .mt-title {
      font-size: 3rem;
      font-weight: 900;
      color: #fff;
      margin-bottom: 0.75rem;
    }
    .mt-subtitle {
      color: rgba(255,255,255,0.8);
      font-size: 1.125rem;
      max-width: 600px;
      margin: 0 auto;
    }

    /* Trip Section Styles */
    .trip-section {
      padding: 5rem 0;
      scroll-margin-top: 100px;
    }
    .trip-section:nth-child(even) {
      background: #f8fafc;
    }
    .trip-section-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
      align-items: center;
    }
    .trip-section:nth-child(even) .trip-section-grid {
      direction: rtl;
    }
    .trip-section:nth-child(even) .trip-section-grid > * {
      direction: ltr;
    }

    /* Image Grid - 1 large, 1 medium, 2 small layout */
    .trip-images {
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-template-rows: 1fr 1fr;
      gap: 0.75rem;
      aspect-ratio: 1;
    }
    .trip-images .img-large {
      grid-row: 1 / 3;
      border-radius: 12px;
      overflow: hidden;
    }
    .trip-images .img-medium {
      border-radius: 12px;
      overflow: hidden;
    }
    .trip-images .img-small-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0.5rem;
    }
    .trip-images .img-small {
      border-radius: 8px;
      overflow: hidden;
    }
    .trip-images img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .trip-images .img-placeholder {
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      color: rgba(255,255,255,0.3);
      font-size: 2rem;
    }

    /* Content */
    .trip-content h2 {
      font-size: 2rem;
      font-weight: 800;
      color: #1f2937;
      margin-bottom: 0.5rem;
    }
    .trip-content .subtitle {
      color: var(--color-primary);
      font-weight: 600;
      font-size: 1rem;
      margin-bottom: 1.5rem;
    }
    .trip-content .description {
      color: #4b5563;
      line-height: 1.8;
    }
    .trip-content .description h3 {
      color: #1f2937;
      font-size: 1.125rem;
      font-weight: 700;
      margin-top: 1.5rem;
      margin-bottom: 0.75rem;
    }
    .trip-content .description ul {
      padding-left: 1.25rem;
    }
    .trip-content .description li {
      margin-bottom: 0.5rem;
    }
    .trip-content .btn-read-more {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      margin-top: 2rem;
      padding: 0.875rem 1.5rem;
      background: #1e293b;
      color: #fff;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s;
    }
    .trip-content .btn-read-more:hover {
      background: var(--color-primary);
      gap: 0.75rem;
    }

    /* CTA Section */
    .cta-section {
      background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
      padding: 4rem 0;
      text-align: center;
    }
    .cta-section h3 {
      color: #fff;
      font-size: 1.75rem;
      font-weight: 800;
      margin-bottom: 1rem;
    }
    .cta-section p {
      color: rgba(255,255,255,0.8);
      margin-bottom: 2rem;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
    }
    .cta-section .btn-contact {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 1rem 2rem;
      background: var(--color-primary);
      color: #fff;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s;
    }
    .cta-section .btn-contact:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(233, 117, 67, 0.3);
    }

    @media (max-width: 768px) {
      .mt-title {
        font-size: 2rem;
      }
      .trip-section-grid {
        grid-template-columns: 1fr;
      }
      .trip-section:nth-child(even) .trip-section-grid {
        direction: ltr;
      }
      .trip-images {
        max-width: 400px;
        margin: 0 auto;
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
          <a href="{{ route('about-us') }}" class="nav-link">About Us</a>
          <a href="{{ route('open-trip') }}" class="nav-link">Open Trip</a>
          
          <!-- Mountain Trip with submenu -->
          <div class="dropdown">
            <button class="custom-dropdown-toggle dropdown-toggle">
              Mountain Trip
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </button>
            <div class="dropdown-menu">
              <a href="{{ route('mountain-trip') }}#private-trip" class="dropdown-item">Private Trip</a>
              <a href="{{ route('mountain-trip') }}#one-day-trip" class="dropdown-item">One Day Trip</a>
              <a href="{{ route('mountain-trip') }}#expedition-trip" class="dropdown-item">Expedition Trip</a>
              <a href="{{ route('mountain-trip') }}#international-trip" class="dropdown-item">International Trip</a>
              <a href="{{ route('mountain-trip') }}#custom-trip" class="dropdown-item">Custom Trip</a>
            </div>
          </div>

          <!-- Outdoor Activity Trip -->
          <div class="dropdown">
            <button class="custom-dropdown-toggle dropdown-toggle active">
              Outdoor Activity Trip
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </button>
            <div class="dropdown-menu">
              @foreach($sections as $section)
              <a href="{{ route('outdoor-trip') }}#{{ $section->slug }}" class="dropdown-item">{{ $section->title }}</a>
              @endforeach
            </div>
          </div>

          <!-- Indoor Activity Trip -->
          <div class="dropdown">
            <button class="custom-dropdown-toggle dropdown-toggle">
              Indoor Activity Trip
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </button>
            <div class="dropdown-menu">
              <a href="{{ route('indoor-trip') }}#city-tour" class="dropdown-item">City Tour</a>
              <a href="{{ route('indoor-trip') }}#company-gathering" class="dropdown-item">Company Gathering</a>
              <a href="{{ route('indoor-trip') }}#outing-tour-travel" class="dropdown-item">Outing, Tour & Travel</a>
              <a href="{{ route('indoor-trip') }}#mice-organizer" class="dropdown-item">MICE Organizer</a>
              <a href="{{ route('indoor-trip') }}#indoor-team-building" class="dropdown-item">Indoor Team Building</a>
              <a href="{{ route('indoor-trip') }}#indoor-custom-trip" class="dropdown-item">Indoor Custom Trip</a>
            </div>
          </div>

          <a href="{{ route('landing') }}#contact" class="nav-link">Contact</a>
          <a href="{{ route('login') }}" class="btn btn-primary">Book Now</a>
        </nav>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="mt-hero">
    <div class="hero-bg"></div>
    <div class="hero-content container">
      <span class="mt-badge">Outdoor Activity Trip</span>
      <h1 class="mt-title">Aktivitas Outdoor</h1>
      <p class="mt-subtitle">Nikmati berbagai aktivitas outdoor seru bersama tim profesional kami. Dari wisata budaya hingga petualangan pulau eksotis.</p>
    </div>
  </section>

  <!-- Trip Sections -->
  @foreach($sections as $index => $section)
  <section class="trip-section" id="{{ $section->slug }}">
    <div class="container">
      <div class="trip-section-grid">
        <!-- Images - 1 large, 1 medium, 2 small layout -->
        <div class="trip-images">
          @php $images = $section->images ?? []; @endphp
          <!-- Large image (left, spans 2 rows) -->
          <div class="img-large">
            @if(isset($images[0]))
            <img src="{{ asset($images[0]) }}" alt="{{ $section->title }}">
            @else
            <div class="img-placeholder">🏔️</div>
            @endif
          </div>
          <!-- Medium image (top right) -->
          <div class="img-medium">
            @if(isset($images[1]))
            <img src="{{ asset($images[1]) }}" alt="{{ $section->title }}">
            @else
            <div class="img-placeholder">⛰️</div>
            @endif
          </div>
          <!-- 2 Small images (bottom right) -->
          <div class="img-small-container">
            <div class="img-small">
              @if(isset($images[2]))
              <img src="{{ asset($images[2]) }}" alt="{{ $section->title }}">
              @else
              <div class="img-placeholder">🌄</div>
              @endif
            </div>
            <div class="img-small">
              @if(isset($images[3]))
              <img src="{{ asset($images[3]) }}" alt="{{ $section->title }}">
              @else
              <div class="img-placeholder">🗻</div>
              @endif
            </div>
          </div>
        </div>

        <!-- Content -->
        <div class="trip-content">
          <h2>{{ $section->title }}</h2>
          @if($section->subtitle)
          <p class="subtitle">{{ $section->subtitle }}</p>
          @endif
          <div class="description">
            {!! $section->content_html !!}
          </div>
          <a href="{{ route('outdoor-trip.detail', $section->slug) }}" class="btn-read-more">
            Read More
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>
  @endforeach

  <!-- CTA Section -->
  <section class="cta-section">
    <div class="container">
      <h3>Siap Untuk Petualangan Outdoor?</h3>
      <p>Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik untuk aktivitas outdoor Anda.</p>
      <a href="https://wa.me/6281196969119" target="_blank" class="btn-contact">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        Chat via WhatsApp
      </a>
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
  
  <script>
    // Auto-scroll to section on page load
    document.addEventListener('DOMContentLoaded', function() {
      const hash = window.location.hash;
      if (hash) {
        const target = document.querySelector(hash);
        if (target) {
          setTimeout(() => {
            target.scrollIntoView({ behavior: 'smooth' });
          }, 100);
        }
      }
    });
  </script>
</body>
</html>
