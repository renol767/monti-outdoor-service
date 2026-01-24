<!-- Language Switcher Dropdown -->
<!-- Add this before the "Book Now" button in navbar -->

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

<!-- Translation Helper Examples -->

<!-- Navigation -->
{{ __('navigation.about_us') }}           <!-- About Us / Tentang Kami -->
{{ __('navigation.open_trip') }}          <!-- Open Trip -->
{{ __('navigation.mountain_trip') }}      <!-- Mountain Trip -->
{{ __('navigation.contact') }}            <!-- Contact / Kontak -->

<!-- General Actions -->
{{ __('general.book_now') }}              <!-- Book Now -->
{{ __('general.contact_us') }}            <!-- Contact Us / Hubungi Kami -->
{{ __('general.view_details') }}          <!-- View Details / Lihat Detail -->
{{ __('general.search') }}                <!-- Search / Cari -->

<!-- Trip Related -->
{{ __('trip.duration') }}                 <!-- Duration / Durasi -->
{{ __('trip.difficulty') }}               <!-- Difficulty / Tingkat Kesulitan -->
{{ __('trip.from_price') }}               <!-- From / Dari -->
{{ __('trip.per_person') }}               <!-- / person / / orang -->
{{ __('trip.pax_left') }}                 <!-- pax left / pax tersisa -->

<!-- Landing Page -->
{{ __('landing.start_journey') }}         <!-- Start Your Journey / Mulai Petualangan -->
{{ __('landing.why_choose_us') }}         <!-- Why Choose Monti / Mengapa Memilih Monti -->
{{ __('landing.popular_trips') }}         <!-- Popular Trips & Packages / Trip & Paket Populer -->
{{ __('landing.adventure_gallery') }}     <!-- Adventure Gallery / Galeri Petualangan -->
