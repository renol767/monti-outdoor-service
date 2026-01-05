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
      background: linear-gradient(to bottom, rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.6));
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
      color: rgba(255, 255, 255, 0.9);
      font-size: 1.125rem;
      line-height: 1.8;
      font-style: italic;
    }

    /* Salam Kenal Section */
    .salam-section {
      background: #bab6a5;
      padding: 4rem 0;
    }
    .salam-title {
      font-size: 2.5rem;
      font-weight: 900;
      color: #1f2937;
      margin-bottom: 1.5rem;
    }
    .salam-content p {
      color: #4b5563;
      line-height: 1.9;
      margin-bottom: 1.5rem;
      font-size: 1rem;
    }
    .salam-content strong {
      color: #1f2937;
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
      grid-template-columns: 420px 1fr;
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
      gap: 1rem;
      flex-wrap: wrap;
      margin-top: 1.25rem;
      align-items: center;
      justify-content: center;
    }
    .partner-logos img {
      height: 55px;
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
      color: #1f2937;
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
      max-width: 900px;
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
      gap: 2rem;
      max-width: 1100px;
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
      width: 160px;
      height: 160px;
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
      font-size: 1.5rem;
      font-weight: 700;
      color: #000000;
      margin-bottom: 0.35rem;
    }
    .team-info h4 .nickname {
      color: #000000;
    }
    .team-info p {
      font-size: 1.125rem;
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
      color: #1e3a5f;
      font-style: italic;
    }
    .hashtag-sub {
      color: #6b7280;
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
            <button class="custom-dropdown-toggle dropdown-toggle">
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

          <!-- Indoor Activity Trip with submenu -->
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

          <!-- Contact -->
          <a href="{{ route('landing') }}#contact" class="nav-link">Contact</a>
          
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
      <span class="about-badge">Tentang Kami</span>
      <h1 class="about-title">MONTI Outdoor Service</h1>
      <p class="about-subtitle">
        Bagi Kami, ALAM adalah lebih dari sekedar profesi, GUNUNG adalah rumah, 
        serta kehangatan antara Anda dan Kami untuk menikmati waktu bersama adalah anugrah...
      </p>
    </div>
  </section>

  <!-- Salam Kenal Section -->
  <section class="salam-section">
    <div class="container">
      <h2 class="salam-title">Salam Kenal..!!</h2>
      <div class="salam-content">
        <p>
          <strong>Inilah Kami, MONTI Outdoor Service... Partner yang akan membawa petualangan dan perjalanan Anda 
          menjadi seru, menyenangkan dan berkesan...</strong>
        </p>
        <p>
          <strong>MONTI Outdoor Service dibentuk oleh sekelompok anak muda yang syarat akan pengalaman serta 
          memiliki jiwa petualang dan solidaritas yang luar biasa. Didirikan sejak Maret 2022 dengan 
          manajemen yang simpel dan professional, MONTI Outdoor Service dapat menjadi andalan Anda dalam 
          mengelola semua perjalanan dan petualangan yang aman, nyaman dan terjangkau.</strong>
        </p>
        <p>
          <strong>Dengan mengedepankan kepercayaan dan kekeluargaan, MONTI Outdoor Service memberikan servis 
          yang mewah dan eksklusif yang dapat disesuaikan dengan kemampuan dan kondisi Anda. 
          Kami akan memberikan kepada Anda bagaimana rasanya berdiri di puncak gunung tertinggi dan 
          membawa Anda kembali turun dengan aman.</strong>
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
            <span class="highlight">ALAM</span> seharusnya dapat dinikmati oleh siapapun, namun dengan berbagai 
            keterbatasan akhirnya membuat tidak semua orang bisa mendapatkannya. 
            <span class="highlight">Tetapi Kami,</span>.. akan memastikan siapapun dapat menikmati nya dengan cara 
            <span class="highlight">yang simpel dan elegan...</span>
          </p>
        </div>
        
        <!-- Company info below - 2 columns: logo left, text right -->
        <div class="company-section">
          <div class="company-grid">
            <div class="company-left">
              <img src="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}" alt="MONTI Logo" class="company-logo">
              <h3 class="company-name">PT. MONTI MENJELAJAH NEGERI</h3>
              <p class="company-subtitle">Anak Perusahaan dari</p>
              <img src="{{ asset('images/about-us/logo-mms.png') }}" alt="MMS" class="mms-logo-img">
              <p class="mms-name">PT. MONTI MEMBANGUN SINERGI</p>
              
              <!-- Partner logos below company logos -->
              <div class="partner-logos">
                <img src="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}" alt="Monti">
                <img src="{{ asset('images/about-us/logo-monti-homestay.png') }}" alt="Monti Homestay">
                <img src="{{ asset('images/about-us/logo-monti-kopi.png') }}" alt="Monti Kopi">
                <img src="{{ asset('images/about-us/logo-monti-studio.png') }}" alt="Monti Studio">
                <img src="{{ asset('images/about-us/logo-monti-wedding.png') }}" alt="Monti Wedding">
              </div>
            </div>
            
            <div class="company-right">
              <p>
                <strong>MONTI</strong> Outdoor Service berjalan dibawah naungan PT MONTI MENJELAJAH NEGERI, 
                yang merupakan anak perusahaan dari MONTI Group PT MONTI MEMBANGUN SINERGI 
                ( PT MMS ). MONTI Outdoor Service bersama dengan PT MMS berkantor di Jakarta 
                Selatan dan menjalani berbagai usaha yang "anak muda banget", diantara nya :
              </p>
              <ul class="company-list">
                <li>Usaha Cafe dan F & B - MONTI Kopi ( IG: <a href="https://instagram.com/montikopi.id" target="_blank">@montikopi.id</a> )</li>
                <li>Usaha Studio Pemotretan dan Fotografi - MONTI Studio ( IG: <a href="https://instagram.com/montistudio.id" target="_blank">@montistudio.id</a> )</li>
                <li>Usaha Wedding Organizer - MONTI Wedding ( IG: <a href="https://instagram.com/montiwedding" target="_blank">@montiwedding</a> )</li>
                <li>Usaha Akomodasi dan Penginapan - MONTI Homestay ( IG: <a href="https://instagram.com/monti.homestay" target="_blank">@monti.homestay</a> )</li>
                <li>Serta Usaha Trip & Travel Organizer - MONTI Outdoor Service ( IG: <a href="https://instagram.com/monti.outdoorservice" target="_blank">@monti.outdoorservice</a> )</li>
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
        <h2 class="team-title">TIM Kami</h2>
        <p class="team-intro">
          Dengan pengalaman yang sudah tidak diragukan lagi, Tim MONTI Outdoor Service tidak hanya akan 
          menjadi pengelola dan pemandu yang professional, tetapi juga menjelma menjadi teman sekaligus 
          keluarga yang menyenangkan, ceria dan penuh akan kehangatan.
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
            <p><strong><span class="role-primary">Owner PT MONTI MEMBANGUN SINERGI</span></strong></p>
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
          <div class="footer-social">
            @if(isset($settings['social_facebook']))
            <a href="{{ $settings['social_facebook'] }}" class="social-link" aria-label="Facebook" target="_blank">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            @endif
            @if(isset($settings['social_instagram']))
            <a href="{{ $settings['social_instagram'] }}" class="social-link" aria-label="Instagram" target="_blank">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
            @endif
            @if(isset($settings['social_twitter']))
            <a href="{{ $settings['social_twitter'] }}" class="social-link" aria-label="Twitter" target="_blank">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
            </a>
            @endif
            @if(isset($settings['social_tiktok']))
            <a href="{{ $settings['social_tiktok'] }}" class="social-link" aria-label="TikTok" target="_blank">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/></svg>
            </a>
            @endif
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
