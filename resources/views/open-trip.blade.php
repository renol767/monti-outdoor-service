<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Primary Meta Tags -->
  <title>Open Trip Indonesia - Jadwal & Harga Terbaru | Monti Outdoor Service</title>
  <meta name="title" content="Open Trip Indonesia - Jadwal & Harga Terbaru | Monti Outdoor Service">
  <meta name="description" content="Temukan jadwal Open Trip terbaru ke berbagai destinasi Indonesia. Pendakian gunung, wisata alam, island hopping dengan harga terjangkau dan guide profesional.">
  <meta name="keywords" content="open trip, jadwal open trip, harga open trip, pendakian gunung, wisata alam, island hopping, backpacker indonesia">
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
  <meta property="og:title" content="Open Trip Indonesia - Jadwal & Harga Terbaru">
  <meta property="og:description" content="Temukan jadwal Open Trip terbaru ke berbagai destinasi Indonesia dengan harga terjangkau dan guide profesional.">
  <meta property="og:image" content="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}">
  <meta property="og:locale" content="id_ID">
  <meta property="og:site_name" content="Monti Outdoor Service">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="{{ url()->current() }}">
  <meta property="twitter:title" content="Open Trip Indonesia - Jadwal & Harga Terbaru">
  <meta property="twitter:description" content="Temukan jadwal Open Trip terbaru ke berbagai destinasi Indonesia dengan harga terjangkau dan guide profesional.">
  <meta property="twitter:image" content="{{ asset($settings['global_logo'] ?? 'images/logo/Untitled-4.png') }}">

  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
  @vite(['resources/css/landing-ui-fixes.css'])
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
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

    /* Open Trip Page Specific Styles */
    .open-trip-hero {
      position: relative;
      min-height: 75vh;
      display: flex;
      align-items: center; /* Center vertically */
      justify-content: center; /* Center horizontally */
      overflow: hidden;
      padding-top: 100px;
      padding-bottom: 0;
    }

    @media (min-width: 768px) {
      .open-trip-hero {
        min-height: 80vh;
      }
    }

    .open-trip-hero .hero-bg {
      position: absolute;
      inset: 0;
    }

    .open-trip-hero .hero-bg img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .open-trip-hero .hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.1));
    }

    .open-trip-hero .hero-content {
      position: relative;
      z-index: 10;
      text-align: center;
      padding: 2rem;
      width: 100%;
      max-width: 600px;
    }

    .open-trip-badge {
      display: inline-block;
      background: var(--color-primary);
      color: white;
      padding: 0.35rem 1rem;
      border-radius: 4px;
      font-size: 0.85rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }

    .open-trip-hero .hero-tagline {
      color: #fff;
      font-size: 1.2rem;
      font-style: italic;
      line-height: 1.6;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
    }

    @media (min-width: 768px) {
      .open-trip-hero .hero-tagline {
        font-size: 1.4rem;
      }
    }

    /* Search Bar */
    .search-bar-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: var(--border-radius-xl);
      padding: 1rem;
      max-width: 900px;
      margin: 0 auto 2rem;
      box-shadow: var(--shadow-2xl);
    }

    .search-bar {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    @media (min-width: 768px) {
      .search-bar {
        flex-direction: row;
        align-items: center;
      }
    }

    .search-field {
      flex: 1;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1rem;
      border-right: none;
    }

    @media (min-width: 768px) {
      .search-field {
        border-right: 1px solid var(--color-slate-200);
      }
      
      .search-field:last-of-type {
        border-right: none;
      }
    }

    .search-field svg {
      color: var(--color-slate-400);
      flex-shrink: 0;
    }

    .search-field input,
    .search-field select {
      border: none;
      background: transparent;
      font-size: 0.95rem;
      color: var(--color-slate-700);
      width: 100%;
      outline: none;
    }

    .search-field input::placeholder {
      color: var(--color-slate-400);
    }

    .search-bar .btn-primary {
      padding: 0.875rem 2rem;
      white-space: nowrap;
    }

    /* Categories Section - Overlay on Hero */
    .categories-section {
      position: relative;
      z-index: 20;
      padding: 1.5rem 0;
      margin-top: -20px;
      text-align: center;
    }

    .categories-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--color-white);
      margin-bottom: 1rem;
      text-align: center;
    }

    /* Categories slider wrapper */
    .categories-slider-wrapper {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    /* Navigation arrows */
    .category-nav-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 32px;
      height: 32px;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      border: none;
      border-radius: 50%;
      cursor: pointer;
      color: var(--color-white);
      transition: var(--transition-fast);
      flex-shrink: 0;
    }

    .category-nav-btn:hover {
      background: rgba(255, 255, 255, 0.4);
    }

    .category-nav-btn svg {
      width: 16px;
      height: 16px;
    }

    /* Hide arrows on desktop */
    @media (min-width: 768px) {
      .category-nav-btn {
        display: none;
      }
    }

    .categories-tabs {
      display: flex;
      gap: 0.75rem;
      overflow-x: auto;
      padding-bottom: 0.5rem;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
      justify-content: flex-start;
      scroll-behavior: smooth;
    }

    /* On mobile, limit visible width */
    @media (max-width: 767px) {
      .categories-tabs {
        max-width: calc(100vw - 100px);
        justify-content: flex-start;
      }
    }

    /* On desktop, center all */
    @media (min-width: 768px) {
      .categories-tabs {
        justify-content: center;
      }
    }

    .categories-tabs::-webkit-scrollbar {
      display: none;
    }

    .category-tab {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.5rem;
      padding: 0.75rem 1rem;
      border-radius: var(--border-radius-lg);
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border: 2px solid transparent;
      cursor: pointer;
      transition: var(--transition-normal);
      white-space: normal;
      text-align: center;
      min-width: 80px;
      max-width: 100px;
    }

    @media (min-width: 768px) {
      .category-tab {
        padding: 1rem 1.25rem;
        min-width: 90px;
        max-width: none;
        white-space: nowrap;
      }
    }

    .category-tab:hover {
      background: rgba(255, 255, 255, 0.25);
    }

    .category-tab.active {
      background: var(--color-white);
      border-color: var(--color-primary);
      box-shadow: var(--shadow-lg);
    }

    .category-tab svg {
      width: 24px;
      height: 24px;
      color: var(--color-white);
    }

    .category-tab.active svg {
      color: var(--color-primary);
    }

    .category-tab span {
      font-size: 0.8rem;
      font-weight: 500;
      color: var(--color-white);
    }

    .category-tab.active span {
      color: var(--color-slate-900);
      font-weight: 600;
    }

    /* Content wrapper that overlaps hero - starts in the hero area */
    .content-wrapper {
      position: relative;
      z-index: 30;
      margin-top: -180px;
    }

    @media (min-width: 768px) {
      .content-wrapper {
        margin-top: -250px;
      }
    }

    /* Trips section - white background starts after some transparent area */
    .trips-section {
      padding: 0 0 4rem;
      background: transparent;
      position: relative;
    }

    .trips-section-header {
      padding-top: 1rem;
      padding-bottom: 1rem;
      background: transparent;
      margin-bottom: 0;
    }

    .trips-section-header .trips-section-title {
      margin: 0;
      padding: 0 1rem;
    }

    /* Cards grid - transparent so hero shows through */
    .trips-grid {
      background: transparent;
      padding: 0 0 2rem;
      position: relative;
    }

    @media (min-width: 1024px) {
      .trips-grid {
        grid-template-columns: repeat(4, 1fr) !important;
        gap: 1.5rem;
      }
    }

    /* Trip Cards Grid */

    .trips-section-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--color-white);
      margin-bottom: 1.5rem;
    }

    .open-trip-card {
      background: #2a2a2a;
      border-radius: var(--border-radius-xl);
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: var(--transition-normal);
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

    .open-trip-card .amenity-more {
      display: flex;
      align-items: center;
      font-size: 0.7rem;
      color: var(--color-primary);
      font-weight: 500;
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

    .open-trip-card .card-features {
      margin-bottom: 0.75rem;
      padding-left: 0;
      list-style: none;
    }

    .open-trip-card .card-features-label {
      font-size: 0.75rem;
      color: var(--color-primary);
      font-weight: 600;
      margin-bottom: 0.25rem;
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

    .open-trip-card .price-old {
      font-size: 0.8rem;
      color: rgba(255, 255, 255, 0.4);
      text-decoration: line-through;
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

    /* Price From Label */
    .open-trip-card .price-from {
      font-size: 0.75rem;
      color: rgba(255, 255, 255, 0.5);
      font-weight: 400;
    }

    /* Date & Pax Info Row */
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
      width: 14px;
      height: 14px;
      color: var(--color-primary);
    }

    /* Sort Dropdown */
    .sort-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 0;
      margin-bottom: 1rem;
    }

    .results-count {
      font-size: 0.9rem;
      color: var(--color-white);
    }

    .sort-dropdown {
      position: relative;
    }

    .sort-dropdown select {
      appearance: none;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: var(--border-radius-lg);
      padding: 0.5rem 2rem 0.5rem 1rem;
      font-size: 0.85rem;
      color: var(--color-white);
      cursor: pointer;
      min-width: 150px;
    }

    .sort-dropdown select option {
      background: var(--color-slate-800);
      color: var(--color-white);
    }

    .sort-dropdown::after {
      content: '';
      position: absolute;
      right: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      width: 0;
      height: 0;
      border-left: 5px solid transparent;
      border-right: 5px solid transparent;
      border-top: 5px solid var(--color-white);
      pointer-events: none;
    }

    /* Skeleton Loading */
    @keyframes skeleton-pulse {
      0% { background-position: -200% 0; }
      100% { background-position: 200% 0; }
    }

    .skeleton-card {
      background: var(--color-white);
      border-radius: var(--border-radius-xl);
      overflow: hidden;
      box-shadow: var(--shadow-md);
      border: 1px solid var(--color-slate-100);
    }

    .skeleton-image {
      height: 180px;
      margin: 0.75rem 0.75rem 0;
      border-radius: var(--border-radius-lg);
      background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
      background-size: 200% 100%;
      animation: skeleton-pulse 1.5s infinite;
    }

    .skeleton-content {
      padding: 1rem;
    }

    .skeleton-line {
      height: 14px;
      border-radius: 4px;
      background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
      background-size: 200% 100%;
      animation: skeleton-pulse 1.5s infinite;
      margin-bottom: 0.5rem;
    }

    .skeleton-line.title { width: 70%; height: 18px; }
    .skeleton-line.subtitle { width: 40%; }
    .skeleton-line.meta { width: 60%; }
    .skeleton-line.price { width: 50%; height: 20px; margin-top: 1rem; }

    /* Empty State Enhanced */
    .empty-state {
      text-align: center;
      padding: 4rem 2rem;
      background: #2a2a2a;
      border-radius: var(--border-radius-xl);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .empty-state svg {
      width: 80px;
      height: 80px;
      margin-bottom: 1.5rem;
      color: rgba(255, 255, 255, 0.2);
    }

    .empty-state h3 {
      font-size: 1.25rem;
      color: #fbcaa5;
      margin-bottom: 0.5rem;
    }

    .empty-state p {
      color: rgba(255, 255, 255, 0.7);
      margin-bottom: 1.5rem;
    }

    .empty-state .btn {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    /* Infinite Scroll Trigger */
    .load-more-trigger {
      height: 1px;
      width: 100%;
    }

    .loading-more {
      display: flex;
      justify-content: center;
      padding: 2rem;
    }

    .loading-spinner {
      width: 32px;
      height: 32px;
      border: 3px solid var(--color-slate-200);
      border-top-color: var(--color-primary);
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    .end-of-list {
      text-align: center;
      padding: 2rem;
      color: #000000; /* Dark for visibility on light bg */
      font-size: 0.9rem;
      font-style: italic;
    }

    /* Open Trip Description Section */
    .open-trip-description {
      background: #1e1e1e;
      padding: 4rem 0 16rem; /* Vastly increased padding to hold Sort Section + Overlay Gap */
    }

    .open-trip-description .section-title {
      font-size: 2.5rem;
      font-weight: 900;
      color: #fbcaa5;
      margin-bottom: 1.5rem;
      font-style: italic;
    }

    .open-trip-description .description-text {
      color: rgba(251, 202, 165, 0.85);
      font-size: 1rem;
      line-height: 1.8;
      font-style: italic;
      max-width: 900px;
    }

    .open-trip-description .description-text p {
      margin-bottom: 1.5rem;
    }

    .open-trip-description .description-text strong {
      color: #e97543;
      font-weight: 700;
    }

    /* Kategori Wrapper inside Open Trip Section */
    .kategori-wrapper {
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 1px solid rgba(251, 202, 165, 0.2);
      text-align: center;
    }

    .kategori-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #fbcaa5;
      margin-bottom: 1.5rem;
      letter-spacing: 0.05em;
    }

    .kategori-tabs-wrapper {
      display: flex;
      justify-content: center;
      gap: 0.75rem;
      flex-wrap: wrap;
    }

    .kategori-tab {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.5rem;
      padding: 1rem 1.25rem;
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid rgba(255, 255, 255, 0.15);
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s;
      min-width: 90px;
    }

    .kategori-tab:hover {
      border-color: #e97543;
      background: rgba(255, 255, 255, 0.15);
    }

    .kategori-tab.active {
      border-color: #e97543;
      background: rgba(233, 117, 67, 0.2);
    }

    .kategori-tab svg {
      width: 28px;
      height: 28px;
      color: rgba(251, 202, 165, 0.7);
    }

    .kategori-tab.active svg {
      color: #e97543;
    }

    .kategori-tab span {
      font-size: 0.75rem;
      font-weight: 500;
      color: rgba(251, 202, 165, 0.8);
    }

    .kategori-tab.active span {
      color: #fbcaa5;
      font-weight: 600;
    }

    /* Cards Overlay Wrapper */
    .cards-overlay-wrapper {
      background: #bab6a5;
      position: relative;
      z-index: 30;
      /* No negative margin on wrapper itself, let it sit naturally below */
    }

    /* Sort Dropdown */
    .sort-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 2rem 1rem 0; /* Added padding top/sides */
      max-width: 1200px;
      margin: 0 auto;
    }

    .cards-overlay-wrapper .trips-section {
      margin-top: -12rem; /* Keep pulling up */
      padding-top: 0;
    }

    @media (min-width: 768px) {
      .cards-overlay-wrapper .trips-section {
        margin-top: -14rem; /* More pull up on desktop */
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
          <!-- About Us - direct link -->
          <a href="{{ route('about-us') }}" class="nav-link">About Us</a>

          <!-- Open Trip - current page -->
          <a href="{{ route('open-trip') }}" class="nav-link" style="color: var(--color-primary); font-weight: 600;">Open Trip</a>
          
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
  <section class="open-trip-hero">
    <div class="hero-bg">
      <img src="{{ asset('images/open-trip-hero-new.jpg') }}" alt="Open Trip Hero">
      <div class="hero-overlay"></div>
    </div>
    <div class="hero-content container">
      <span class="open-trip-badge">Open Trip</span>
      <p class="hero-tagline">{!! __('content.hero.open_trip.tagline') !!}</p>
    </div>
  </section>


  <!-- Open Trip Description Section with Kategori -->
  <section class="open-trip-description">
    <div class="container">
      <h2 class="section-title">{{ __('content.hero.open_trip.title') }}</h2>
      <div class="description-text">
        <p>{{ __('content.hero.open_trip.description_1') }}</p>
        <p>{!! __('content.hero.open_trip.description_2') !!}</p>
      </div>
      
      <!-- Kategori Tabs inside Open Trip Section -->
      <div class="kategori-wrapper">
        <h3 class="kategori-title">{{ strtoupper(__('trip.trip_category')) }}</h3>
        <div class="kategori-tabs-wrapper">
          <button class="kategori-tab active" data-kategori="all">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
              <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
            </svg>
            <span>{{ __('trip.all_categories') }}</span>
          </button>
          <button class="kategori-tab" data-kategori="mountain">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M8 21l4-11 4 11"/><path d="M12 10l4-9 4 9"/>
            </svg>
            <span>{{ __('trip.mountain') }}</span>
          </button>
          <button class="kategori-tab" data-kategori="island">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3 17l2-4 3 2 4-6 4 6 3-2 2 4H3z"/><circle cx="12" cy="5" r="2"/>
            </svg>
            <span>{{ __('trip.outdoor') }}</span>
          </button>
          <button class="kategori-tab" data-kategori="city">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3 21h18M5 21V7l8-4v18M13 21V9l6 2v10"/>
              <path d="M9 9h1M9 13h1M9 17h1M17 13h1M17 17h1"/>
            </svg>
            <span>{{ __('trip.indoor') }}</span>
          </button>
          <button class="kategori-tab" data-kategori="oneday">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
            </svg>
            <span>1 Day Trip</span>
          </button>
          <button class="kategori-tab" data-kategori="international">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/>
              <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
            <span>International Trip</span>
          </button>
        </div>
      </div>

      <!-- Sort Section - Moved here -->
      <div class="sort-section">
        <span class="results-count" id="resultsCount">{{ $trips->count() }} {{ __('trip.trips_found') }}</span>
        <div class="sort-dropdown">
          <select id="sortSelect">
            <option value="newest">{{ __('general.sort_newest') }}</option>
            <option value="price-low">{{ __('general.sort_price_low_high') }}</option>
            <option value="price-high">{{ __('general.sort_price_high_low') }}</option>
          </select>
        </div>
      </div>
    </div>
  </section>

  <!-- Cards Section - Overlaps into Open Trip Section -->
  <div class="cards-overlay-wrapper">
    <!-- Trips Grid Section -->
    <section class="trips-section">
      <div class="container">
        <!-- Sort Section Moved Up -->


        <div class="trips-section-header">
          <h2 class="trips-section-title">Popular Open Trips</h2>
        </div>
        
        <!-- Cards grid that overlaps into hero -->
        <div class="trips-grid" id="tripsGrid">
        @foreach($trips as $trip)
        <a href="{{ route('trip.detail', $trip->slug) }}" class="open-trip-card-link" style="text-decoration: none; color: inherit;">
        <div class="open-trip-card" data-category="{{ strtolower(str_replace(' ', '', $trip->category)) }}" data-departures="{{ implode(',', $trip->departure_months ?? []) }}" data-title="{{ strtolower($trip->title) }}" data-timestamp="{{ $trip->created_at ? $trip->created_at->timestamp : 0 }}">
          <div class="card-image">
            <img src="{{ asset($trip->image) }}" alt="{{ $trip->title }}" loading="lazy">
            <button class="favorite-btn" aria-label="Add to favorites" data-trip-id="{{ $trip->id }}">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
              </svg>
            </button>
          </div>
          <div class="card-content">
            <div class="card-header">
              <h3 class="card-title">{{ $trip->title }}</h3>

            </div>
            <p class="card-duration">{{ $trip->duration }}</p>
            
            <!-- Date & Pax Info -->
            <div class="card-schedule">
              <div class="schedule-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                  <line x1="16" y1="2" x2="16" y2="6"/>
                  <line x1="8" y1="2" x2="8" y2="6"/>
                  <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                <span>{{ $trip->departure_date ?? '15 Jan 2026' }}</span>
              </div>
              <div class="schedule-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                  <circle cx="9" cy="7" r="4"/>
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                <span>{{ $trip->available_pax ?? '12' }} pax</span>
              </div>
            </div>
            
              <div class="card-amenities">
              @php
                $iconMap = [
                  'guide' => ['icon' => 'user-check', 'label' => 'Guide'],
                  'tour_leader' => ['icon' => 'flag', 'label' => 'Tour Leader'],
                  'local_guide' => ['icon' => 'map-pin', 'label' => 'Local Guide'],
                  'porters' => ['icon' => 'backpack', 'label' => 'Porters'],
                  'hotel' => ['icon' => 'building', 'label' => 'Hotel'],
                  'homestay' => ['icon' => 'home', 'label' => 'Homestay'],
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
                $tripIncludes = $trip->includes ?? [];
                $maxShow = 5;
                $totalIncludes = count($tripIncludes);
                $remaining = $totalIncludes - $maxShow;
              @endphp
              @foreach(array_slice($tripIncludes, 0, $maxShow) as $inc)
                @if(isset($iconMap[$inc]))
                <div class="amenity">
                  <i class="ti ti-{{ $iconMap[$inc]['icon'] }}" style="font-size: 16px; color: rgba(255, 255, 255, 0.6);"></i>
                  <span>{{ $iconMap[$inc]['label'] }}</span>
                </div>
                @endif
              @endforeach
              @if($remaining > 0)
                <span class="amenity-more">+{{ $remaining }}</span>
              @endif
              @if(empty($tripIncludes))
              <div class="amenity">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
                <span>{{ $trip->duration }}</span>
              </div>
              @endif
            </div>

            <div class="card-features-label">{{ __('trip.destination') }}:</div>
            <ul class="card-features">
              @if(!empty($trip->highlights))
                @foreach(array_slice($trip->highlights, 0, 4) as $highlight)
                <li>{{ is_array($highlight) ? implode(', ', \Illuminate\Support\Arr::flatten($highlight)) : $highlight }}</li>
                @endforeach
              @else
                <li>Expert guide included</li>
                <li>All meals included</li>
                <li>Equipment provided</li>
              @endif
            </ul>

            <div class="card-price">
              <span class="price-from">From</span>
              <span class="price-current">{{ $trip->price }}</span>
              <span class="price-unit">/ pax</span>
            </div>
          </div>
        </div>
        </a>
        @endforeach

        <!-- Skeleton Cards (hidden by default, shown during loading) -->
        <template id="skeletonCardTemplate">
          <div class="skeleton-card">
            <div class="skeleton-image"></div>
            <div class="skeleton-content">
              <div class="skeleton-line title"></div>
              <div class="skeleton-line subtitle"></div>
              <div class="skeleton-line meta"></div>
              <div class="skeleton-line meta"></div>
              <div class="skeleton-line price"></div>
            </div>
          </div>
        </template>

        @if($trips->isEmpty())
        <div class="empty-state" style="grid-column: 1 / -1;" id="emptyState">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M8 21l4-11 4 11"/>
            <path d="M12 10l4-9 4 9"/>
            <path d="M4 21h16"/>
          </svg>
          <h3>No trips found for this month</h3>
          <p>Try selecting a different month or browse all categories</p>
          <button class="btn btn-primary" onclick="resetFilters()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
            Browse All Trips
          </button>
        </div>
        @endif
        </div>

        <!-- Infinite Scroll Trigger -->
        <div class="load-more-trigger" id="loadMoreTrigger"></div>
        
        <!-- Loading More Indicator -->
        <div class="loading-more" id="loadingMore" style="display: none;">
          <div class="loading-spinner"></div>
        </div>
        
        <!-- End of List Message -->
        <div class="end-of-list" id="endOfList" style="display: none;">
          {{ __('general.all_trips_shown') }} 🏔️
        </div>
      </div>
    </section>
  </div><!-- End cards-overlay-wrapper -->

  <!-- Terms & Conditions Notice Section -->
  <section style="background: linear-gradient(135deg, #1e1e1e 0%, #151515 100%); padding: 3rem 0;">
    <div class="container" style="text-align: center;">
      <h3 style="color: #fff; font-size: 1.5rem; font-weight: 700; margin-bottom: 0.75rem;">{{ __('general.terms_conditions_title') }}</h3>
      <p style="color: rgba(255,255,255,0.8); margin-bottom: 1.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">
        {{ __('general.terms_conditions_desc') }}
      </p>
      <a href="{{ route('terms-conditions') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--color-primary); color: #fff; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
          <line x1="16" y1="13" x2="8" y2="13"></line>
          <line x1="16" y1="17" x2="8" y2="17"></line>
          <polyline points="10 9 9 9 8 9"></polyline>
        </svg>
        {{ __('general.read_terms_conditions') }}
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
          <h4 class="footer-heading">Contact</h4>
          <ul class="footer-links">
            <li>{{ $settings['contact_phone'] ?? '+62 812 3456 7890' }}</li>
            <li>{{ $settings['contact_email'] ?? 'hello@montioutdoor.com' }}</li>
            <li>{{ $settings['contact_address'] ?? 'Jakarta, Indonesia' }}</li>
          </ul>
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
    // Initialize month picker with next month as default
    document.addEventListener('DOMContentLoaded', function() {
      const monthPicker = document.getElementById('departureMonth');
      if (monthPicker) {
        const now = new Date();
        const nextMonth = new Date(now.getFullYear(), now.getMonth() + 1, 1);
        const year = nextMonth.getFullYear();
        const month = String(nextMonth.getMonth() + 1).padStart(2, '0');
        monthPicker.value = `${year}-${month}`;
        
        // Set min date to current month
        const currentYear = now.getFullYear();
        const currentMonth = String(now.getMonth() + 1).padStart(2, '0');
        monthPicker.min = `${currentYear}-${currentMonth}`;
      }
      
      // Search form handler
      const searchForm = document.querySelector('.search-bar');
      if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
          e.preventDefault();
          
          const searchText = searchForm.querySelector('input[type="text"]').value.toLowerCase().trim();
          const selectedMonth = monthPicker ? monthPicker.value : '';
          
          const allCards = document.querySelectorAll('.open-trip-card');
          let visibleCount = 0;
          
          allCards.forEach(card => {
            const cardTitle = card.dataset.title || '';
            const cardDepartures = card.dataset.departures || '';
            
            let matchesText = true;
            let matchesMonth = true;
            
            // Check text search
            if (searchText) {
              matchesText = cardTitle.includes(searchText);
            }
            
            // Check month filter
            if (selectedMonth) {
              matchesMonth = cardDepartures.split(',').includes(selectedMonth);
            }
            
            // Show/hide card
            const cardLink = card.closest('.open-trip-card-link');
            if (matchesText && matchesMonth) {
              if (cardLink) cardLink.style.display = 'block';
              card.style.display = 'block';
              visibleCount++;
            } else {
              if (cardLink) cardLink.style.display = 'none';
              card.style.display = 'none';
            }
          });
          
          // Update count
          document.getElementById('resultsCount').textContent = `${visibleCount} trips found`;
        });
      }

      // Category slider navigation
      const categoriesTabs = document.getElementById('categoriesTabs');
      const prevBtn = document.getElementById('categoryPrev');
      const nextBtn = document.getElementById('categoryNext');
      
      if (categoriesTabs && prevBtn && nextBtn) {
        const scrollAmount = 280; // Approximately 3 tabs width
        
        prevBtn.addEventListener('click', function() {
          categoriesTabs.scrollBy({
            left: -scrollAmount,
            behavior: 'smooth'
          });
        });
        
        nextBtn.addEventListener('click', function() {
          categoriesTabs.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
          });
        });
      }
    });

    // Category Tab Functionality
    document.querySelectorAll('.kategori-tab').forEach(tab => {
      tab.addEventListener('click', function() {
        // Remove active class from all tabs
        document.querySelectorAll('.kategori-tab').forEach(t => t.classList.remove('active'));
        
        // Add active class to clicked tab
        this.classList.add('active');
        
        // Filter trips based on category
        const category = this.dataset.kategori;
        const cards = document.querySelectorAll('.open-trip-card');
        let visibleCount = 0;
        
        cards.forEach(card => {
          const cardLink = card.closest('.open-trip-card-link');
          const cardCategory = card.dataset.category || '';
          
          if (category === 'all' || cardCategory.includes(category)) {
            card.style.display = 'block';
            if (cardLink) cardLink.style.display = 'block';
            visibleCount++;
          } else {
            card.style.display = 'none';
            if (cardLink) cardLink.style.display = 'none';
          }
        });
        
        // Update results count
        document.getElementById('resultsCount').textContent = `${visibleCount} trips found`;
      });
    });

    // Favorite button toggle with localStorage
    document.querySelectorAll('.favorite-btn').forEach(btn => {
      const tripId = btn.dataset.tripId;
      
      // Check if already favorited
      const favorites = JSON.parse(localStorage.getItem('tripFavorites') || '[]');
      if (favorites.includes(tripId)) {
        btn.classList.add('active');
      }
      
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        this.classList.toggle('active');
        
        // Save to localStorage
        const favorites = JSON.parse(localStorage.getItem('tripFavorites') || '[]');
        const tripId = this.dataset.tripId;
        
        if (this.classList.contains('active')) {
          if (!favorites.includes(tripId)) {
            favorites.push(tripId);
          }
        } else {
          const index = favorites.indexOf(tripId);
          if (index > -1) {
            favorites.splice(index, 1);
          }
        }
        
        localStorage.setItem('tripFavorites', JSON.stringify(favorites));
      });
    });

    // Sort functionality
    const sortSelect = document.getElementById('sortSelect');
    if (sortSelect) {
      sortSelect.addEventListener('change', function() {
        const sortValue = this.value;
        const grid = document.getElementById('tripsGrid');
        const cards = Array.from(grid.querySelectorAll('.open-trip-card'));
        
        // Show skeleton loading briefly
        showSkeletonLoading(3);
        
        setTimeout(() => {
          cards.sort((a, b) => {
            const priceA = parsePrice(a.querySelector('.price-current').textContent);
            const priceB = parsePrice(b.querySelector('.price-current').textContent);
            
            if (sortValue === 'price-low') {
              return priceA - priceB;
            } else if (sortValue === 'price-high') {
              return priceB - priceA;
            } else if (sortValue === 'newest') {
              // Sort by timestamp
              const timeA = parseInt(a.dataset.timestamp) || 0;
              const timeB = parseInt(b.dataset.timestamp) || 0;
              return timeB - timeA;
            }
            return 0;
          });
          
          // Remove skeletons and re-append sorted cards
          hideSkeletonLoading();
          cards.forEach(card => grid.appendChild(card));
        }, 500);
      });
    }

    // Parse price from string like "IDR 2,500,000" or "Rp 2.500.000"
    function parsePrice(priceStr) {
      return parseInt(priceStr.replace(/[^\d]/g, '')) || 0;
    }

    // Show skeleton loading
    function showSkeletonLoading(count = 3) {
      const grid = document.getElementById('tripsGrid');
      const template = document.getElementById('skeletonCardTemplate');
      
      if (!template) return;
      
      for (let i = 0; i < count; i++) {
        const skeleton = template.content.cloneNode(true);
        skeleton.firstElementChild.classList.add('skeleton-temp');
        grid.appendChild(skeleton);
      }
    }

    // Hide skeleton loading
    function hideSkeletonLoading() {
      document.querySelectorAll('.skeleton-temp').forEach(el => el.remove());
    }

    // Infinite Scroll with IntersectionObserver
    let currentPage = 1;
    let isLoading = false;
    let hasMoreData = true; // Set to false when no more data from API

    const loadMoreTrigger = document.getElementById('loadMoreTrigger');
    const loadingMore = document.getElementById('loadingMore');
    const endOfList = document.getElementById('endOfList');

    if (loadMoreTrigger) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting && !isLoading && hasMoreData) {
            loadMoreTrips();
          }
        });
      }, { 
        rootMargin: '200px',
        threshold: 0 
      });

      observer.observe(loadMoreTrigger);
    }

    async function loadMoreTrips() {
      if (isLoading || !hasMoreData) return;
      
      isLoading = true;
      loadingMore.style.display = 'flex';
      currentPage++;

      // Simulate API call - replace with actual API call
      try {
        // In production, replace this with actual API call:
        // const response = await fetch(`/api/trips?page=${currentPage}`);
        // const data = await response.json();
        
        // Simulated delay
        await new Promise(resolve => setTimeout(resolve, 1000));
        
        // For demo: no more data after page 2
        if (currentPage >= 2) {
          hasMoreData = false;
          loadingMore.style.display = 'none';
          endOfList.style.display = 'block';
        } else {
          // Would append new cards here from API response
          loadingMore.style.display = 'none';
        }
      } catch (error) {
        console.error('Error loading more trips:', error);
        loadingMore.style.display = 'none';
      }
      
      isLoading = false;
    }

    // Reset filters function
    function resetFilters() {
      // Reset category to "all"
      document.querySelectorAll('.kategori-tab').forEach(t => t.classList.remove('active'));
      document.querySelector('.kategori-tab[data-kategori="all"]').classList.add('active');
      
      // Show all cards
      document.querySelectorAll('.open-trip-card').forEach(card => {
        card.style.display = 'block';
      });
      
      // Reset month picker
      const monthPicker = document.getElementById('departureMonth');
      if (monthPicker) {
        monthPicker.value = '';
      }
      
      // Update count
      const cards = document.querySelectorAll('.open-trip-card');
      document.getElementById('resultsCount').textContent = `${cards.length} trips found`;
    }
  </script>
</body>
</html>
