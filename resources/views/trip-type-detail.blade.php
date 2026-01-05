<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Primary Meta Tags -->
  <title>{{ $section->title }} - Monti Outdoor Service</title>
  <meta name="title" content="{{ $section->title }} - Monti Outdoor Service">
  <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($section->content_html ?? ''), 160) }}">
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
  <meta property="og:title" content="{{ $section->title }} - Monti Outdoor Service">
  <meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($section->content_html ?? ''), 160) }}">
  @php $sectionImages = $section->images ?? []; @endphp
  <meta property="og:image" content="{{ asset($sectionImages[0] ?? $settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}">
  <meta property="og:locale" content="id_ID">
  <meta property="og:site_name" content="Monti Outdoor Service">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="{{ url()->current() }}">
  <meta property="twitter:title" content="{{ $section->title }} - Monti Outdoor Service">
  <meta property="twitter:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($section->content_html ?? ''), 160) }}">
  <meta property="twitter:image" content="{{ asset($sectionImages[0] ?? $settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}">

  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
  @vite(['resources/css/landing-ui-fixes.css'])
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    /* Hero Section */
    .detail-hero {
      position: relative;
      padding: 120px 0 40px;
      background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
    }
    .detail-hero .breadcrumb {
      margin-bottom: 1rem;
    }
    .detail-hero .breadcrumb a {
      color: rgba(255,255,255,0.7);
      text-decoration: none;
    }
    .detail-hero .breadcrumb a:hover {
      color: #fff;
    }
    .detail-hero .breadcrumb span {
      color: rgba(255,255,255,0.5);
      margin: 0 0.5rem;
    }
    .detail-hero .breadcrumb-current {
      color: var(--color-primary);
    }
    .detail-hero h1 {
      font-size: 2.5rem;
      font-weight: 900;
      color: #fff;
      margin-bottom: 0.5rem;
    }
    .detail-hero .subtitle {
      color: rgba(255,255,255,0.8);
      font-size: 1.125rem;
    }

    /* Image Gallery */
    .detail-gallery {
      padding: 3rem 0;
      background: #f8fafc;
    }
    .gallery-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-template-rows: 1fr 1fr;
      gap: 1rem;
      max-width: 900px;
      margin: 0 auto;
      aspect-ratio: 16/10;
    }
    .gallery-grid .img-large {
      grid-row: 1 / 3;
      border-radius: 16px;
      overflow: hidden;
    }
    .gallery-grid .img-medium {
      border-radius: 16px;
      overflow: hidden;
    }
    .gallery-grid .img-small-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0.75rem;
    }
    .gallery-grid .img-small {
      border-radius: 12px;
      overflow: hidden;
    }
    .gallery-grid img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .gallery-grid .img-placeholder {
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      color: rgba(255,255,255,0.3);
      font-size: 3rem;
    }

    /* Article Content */
    .detail-content {
      padding: 4rem 0;
    }
    .detail-content .content-wrapper {
      max-width: 800px;
      margin: 0 auto;
    }
    .detail-content .article {
      font-size: 1.125rem;
      line-height: 1.9;
      color: #374151;
    }
    .detail-content .article h1,
    .detail-content .article h2,
    .detail-content .article h3 {
      color: #1f2937;
      margin-top: 2rem;
      margin-bottom: 1rem;
    }
    .detail-content .article h2 {
      font-size: 1.75rem;
      font-weight: 800;
    }
    .detail-content .article h3 {
      font-size: 1.375rem;
      font-weight: 700;
    }
    .detail-content .article ul,
    .detail-content .article ol {
      padding-left: 1.5rem;
      margin: 1.5rem 0;
    }
    .detail-content .article li {
      margin-bottom: 0.75rem;
    }
    .detail-content .article p {
      margin-bottom: 1.5rem;
    }
    .detail-content .article strong {
      color: #1f2937;
    }
    .detail-content .article a {
      color: var(--color-primary);
    }

    /* CTA Section */
    .detail-cta {
      background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
      padding: 4rem 0;
      text-align: center;
    }
    .detail-cta h3 {
      color: #fff;
      font-size: 2rem;
      font-weight: 800;
      margin-bottom: 1rem;
    }
    .detail-cta p {
      color: rgba(255,255,255,0.8);
      font-size: 1.125rem;
      margin-bottom: 2rem;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }
    .detail-cta .btn-whatsapp {
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      padding: 1rem 2.5rem;
      background: #25D366;
      color: #fff;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 600;
      font-size: 1.125rem;
      transition: all 0.3s;
    }
    .detail-cta .btn-whatsapp:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(37, 211, 102, 0.4);
    }
    .detail-cta .btn-whatsapp svg {
      width: 24px;
      height: 24px;
    }

    /* Back Link */
    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      color: #6b7280;
      text-decoration: none;
      margin-bottom: 2rem;
      font-weight: 500;
      transition: color 0.2s;
    }
    .back-link:hover {
      color: var(--color-primary);
    }

    @media (max-width: 768px) {
      .detail-hero h1 {
        font-size: 1.75rem;
      }
      .gallery-grid {
        grid-template-columns: 1fr;
        grid-template-rows: auto;
        aspect-ratio: auto;
      }
      .gallery-grid .img-large {
        grid-row: auto;
        aspect-ratio: 16/10;
      }
      .gallery-grid .img-medium {
        aspect-ratio: 16/9;
      }
      .gallery-grid .img-small {
        aspect-ratio: 1;
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
            <button class="custom-dropdown-toggle dropdown-toggle active">
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

          <!-- Outdoor Activity Trip -->
          <div class="dropdown">
            <button class="custom-dropdown-toggle dropdown-toggle">
              Outdoor Activity Trip
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </button>
            <div class="dropdown-menu">
              <a href="{{ route('outdoor-trip') }}#cultural-trip" class="dropdown-item">Cultural Trip</a>
              <a href="{{ route('outdoor-trip') }}#one-day-outdoor-trip" class="dropdown-item">One Day Trip</a>
              <a href="{{ route('outdoor-trip') }}#island-trip" class="dropdown-item">Island Trip</a>
              <a href="{{ route('outdoor-trip') }}#camping-trip" class="dropdown-item">Camping</a>
              <a href="{{ route('outdoor-trip') }}#outdoor-team-building" class="dropdown-item">Outdoor Team Building</a>
              <a href="{{ route('outdoor-trip') }}#outdoor-custom-trip" class="dropdown-item">Outdoor Custom Trip</a>
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
  <section class="detail-hero">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('landing') }}">Home</a>
        <span>›</span>
        <a href="{{ route('mountain-trip') }}">Mountain Trip</a>
        <span>›</span>
        <span class="breadcrumb-current">{{ $section->title }}</span>
      </div>
      <h1>{{ $section->title }}</h1>
      @if($section->subtitle)
      <p class="subtitle">{{ $section->subtitle }}</p>
      @endif
    </div>
  </section>

  <!-- Image Gallery -->
  <section class="detail-gallery">
    <div class="container">
      <div class="gallery-grid">
        @php $images = $section->images ?? []; @endphp
        
        <!-- Large image -->
        <div class="img-large">
          @if(isset($images[0]))
          <img src="{{ asset($images[0]) }}" alt="{{ $section->title }}">
          @else
          <div class="img-placeholder">🏔️</div>
          @endif
        </div>
        
        <!-- Medium image -->
        <div class="img-medium">
          @if(isset($images[1]))
          <img src="{{ asset($images[1]) }}" alt="{{ $section->title }}">
          @else
          <div class="img-placeholder">⛰️</div>
          @endif
        </div>
        
        <!-- 2 Small images -->
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
    </div>
  </section>

  <!-- Article Content -->
  <section class="detail-content">
    <div class="container">
      <div class="content-wrapper">
        <a href="{{ route('mountain-trip') }}#{{ $section->slug }}" class="back-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
          </svg>
          Kembali ke Mountain Trip
        </a>
        
        <article class="article">
          @if($section->content_full)
            {!! $section->content_full !!}
          @else
            {!! $section->content_html !!}
          @endif
        </article>
      </div>
    </div>
  </section>

  <!-- WhatsApp CTA Section -->
  <section class="detail-cta">
    <div class="container">
      <h3>Tertarik dengan {{ $section->title }}?</h3>
      <p>Hubungi tim kami sekarang untuk konsultasi gratis! Kami siap membantu merencanakan perjalanan impian Anda dengan penawaran terbaik.</p>
      @php
        $waMessage = "Halo Monti Outdoor!\n\n";
        $waMessage .= "Saya tertarik dengan layanan *{$section->title}* yang saya lihat di website.\n\n";
        $waMessage .= "Boleh minta informasi lebih lanjut mengenai:\n";
        $waMessage .= "- Jadwal keberangkatan\n";
        $waMessage .= "- Harga paket\n";
        $waMessage .= "- Fasilitas yang termasuk\n\n";
        $waMessage .= "Terima kasih.";
      @endphp
      <a href="https://wa.me/{{ $settings['global_whatsapp'] ?? '6281196969119' }}?text={{ urlencode($waMessage) }}" target="_blank" class="btn-whatsapp">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        Hubungi via WhatsApp
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
</body>
</html>
