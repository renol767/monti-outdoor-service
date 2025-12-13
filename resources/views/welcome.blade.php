<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monti Outdoor Service - Mountain Trips & Adventure Tours</title>
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
  @vite(['resources/css/landing-ui-fixes.css'])
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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
          <a href="#home" class="nav-link">Home</a>
          
          <div class="dropdown">
            <button class="custom-dropdown-toggle dropdown-toggle">
              Mountain Trip
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </button>
            <div class="dropdown-menu">
              <a href="#trips" class="dropdown-item">Summit Expedition</a>
              <a href="#trips" class="dropdown-item">Open Trip</a>
              <a href="#trips" class="dropdown-item">Multi-Day Trek</a>
            </div>
          </div>

          <div class="dropdown">
            <button class="custom-dropdown-toggle dropdown-toggle">
              Outdoor Activity
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </button>
            <div class="dropdown-menu">
              <a href="#trips" class="dropdown-item">Island Exploration</a>
              <a href="#trips" class="dropdown-item">Wilderness Camping</a>
              <a href="#trips" class="dropdown-item">Team Building</a>
            </div>
          </div>

          <div class="dropdown">
            <button class="custom-dropdown-toggle dropdown-toggle">
              Indoor Activity
              <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                <path d="M4 6L8 10L12 6H4Z"/>
              </svg>
            </button>
            <div class="dropdown-menu">
              <a href="#trips" class="dropdown-item">Cultural City Tour</a>
              <a href="#trips" class="dropdown-item">Workshop & Training</a>
            </div>
          </div>

          <a href="#about" class="nav-link">About</a>
          <a href="#contact" class="nav-link">Contact</a>
          <a href="{{ route('login') }}" class="btn btn-primary">Book Now</a>
        </nav>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section id="home" class="hero">
    <div class="hero-bg">
      <!-- <img src="https://images.unsplash.com/photo-1680246638284-0a34ea41cc76?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb3VudGFpbiUyMGNhbXBpbmclMjBzdW5zZXQlMjB0cmVra2luZ3xlbnwxfHx8fDE3NjUxMjM3MDJ8MA&ixlib=rb-4.1.0&q=80&w=1080" alt="Mountain camping"> -->
      <!-- <img src="https://images.unsplash.com/photo-1680246638284-0a34ea41cc76?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb3VudGFpbiUyMGNhbXBpbmclMjBzdW5zZXQlMjB0cmVkkkingfHwxfHx8fDE3NjUxMjM3MDJ8MA&ixlib=rb-4.1.0&q=80&w=1080" alt="Mountain camping"> -->
      <img src="{{ asset($settings['hero_bg_image'] ?? 'images/Annapurna Basecamp.jpg') }}" width="1080" alt="Mountain camping" data-preview-key="hero_bg_image">
      <div class="hero-overlay"></div>
    </div>

    <div class="hero-content container">
      <div class="hero-badge fade-in" data-preview-key="hero_badge">{{ $settings['hero_badge'] ?? 'Your Adventure Starts Here' }}</div>
        <h1 class="hero-title fade-in" data-preview-key="hero_title">{{ $settings['hero_title'] ?? 'Discover the Unseen Beauty of Indonesia' }}</h1>
        <p class="hero-subtitle fade-in" data-preview-key="hero_subtitle">{{ $settings['hero_subtitle'] ?? 'Expert-guided mountain expeditions and outdoor adventures tailored for every explorer.' }}</p>
        <div class="hero-cta fade-in">
          <a href="#trips" class="btn btn-primary">Start Your Journey</a>
          <a href="#contact" class="btn btn-secondary">Contact Us</a>
        </div>
      <div class="scroll-indicator">
        <div class="scroll-mouse">
          <div class="scroll-wheel"></div>
        </div>
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
        @foreach($trips as $trip)
        <div class="trip-card animate-on-scroll">
          <div class="trip-image">
            <img src="{{ asset($trip->image) }}" width="1080" alt="{{ $trip->title }}">
            @if($trip->is_popular)
            <div class="trip-badge trip-badge-popular">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                <polyline points="17 6 23 6 23 12"/>
              </svg>
              Popular
            </div>
            @endif
            <div class="trip-category">{{ $trip->category }}</div>
          </div>
          <div class="trip-content">
            <h3 class="trip-title">{{ $trip->title }}</h3>
            <p class="trip-description">{{ $trip->description }}</p>
            <div class="trip-details">
              <div class="trip-detail">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"/>
                  <polyline points="12 6 12 12 16 14"/>
                </svg>
                <span>{{ $trip->duration }}</span>
              </div>
              <div class="trip-detail">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                  <circle cx="12" cy="10" r="3"/>
                </svg>
                <span>{{ $trip->difficulty }}</span>
              </div>
            </div>
            <div class="trip-footer">
              <span class="trip-price">{{ $trip->price }}</span>
              <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                Book Now
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <line x1="5" y1="12" x2="19" y2="12"/>
                  <polyline points="12 5 19 12 12 19"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      
      <div class="section-cta animate-on-scroll">
        <a href="#contact" class="btn btn-dark">
          Need a Custom Package?
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="5" y1="12" x2="19" y2="12"/>
            <polyline points="12 5 19 12 12 19"/>
          </svg>
        </a>
      </div>
    </div>
  </section>

  <!-- Services -->
  <section class="section bg-dark">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <h2 class="section-title text-white" data-preview-key="services_title">{{ $settings['services_title'] ?? 'Our Services' }}</h2>
        <p class="section-description text-light" data-preview-key="services_description">{{ $settings['services_description'] ?? 'Comprehensive outdoor and indoor adventure solutions tailored to your needs' }}</p>
      </div>

      <div class="services-grid">
        @foreach($services as $service)
        <div class="service-card animate-on-scroll">
          <div class="service-icon {{ $service->icon_bg_class }}">
            {!! $service->icon !!}
          </div>
          <h3 class="service-title">{{ $service->title }}</h3>
          <p class="service-description">{{ $service->description }}</p>
          <ul class="service-features">
            @if(is_array($service->features))
            @foreach($service->features as $feature)
            <li>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
              </svg>
              <span>{{ $feature }}</span>
            </li>
            @endforeach
            @endif
          </ul>
        </div>
        @endforeach
      </div>

      <div class="custom-package-cta animate-on-scroll">
        <h3 class="cta-title" data-preview-key="cta_title">{{ $settings['cta_title'] ?? 'Need a Custom Package?' }}</h3>
        <p class="cta-description" data-preview-key="cta_description">{{ $settings['cta_description'] ?? 'Every adventure is unique. Let us craft a personalized itinerary that matches your vision, budget, and schedule.' }}</p>
        <a href="#contact" class="btn btn-primary">Request Custom Quote</a>
      </div>
    </div>
  </section>

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

  <!-- Testimonials -->
  <section class="section bg-light">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <h2 class="section-title" data-preview-key="testimonials_title">{{ $settings['testimonials_title'] ?? 'What Adventurers Say' }}</h2>
        <p class="section-description" data-preview-key="testimonials_description">{{ $settings['testimonials_description'] ?? 'Real experiences from our community of explorers' }}</p>
      </div>

      <div class="testimonials-grid">
        @foreach($testimonials as $testimonial)
        <div class="testimonial-card animate-on-scroll">
          <div class="quote-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
              <path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/>
            </svg>
          </div>
          <div class="testimonial-header">
            <img src="{{ $testimonial->avatar }}" alt="Reviewer" class="testimonial-avatar">
            <div>
              <h4 class="testimonial-name">{{ $testimonial->name }}</h4>
              <p class="testimonial-role">{{ $testimonial->role }}</p>
            </div>
          </div>
          <div class="testimonial-rating">
            @for($i=0; $i < $testimonial->rating; $i++)
            <svg width="20" height="20" viewBox="0 0 24 24" fill="#e97543">
              <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
            </svg>
            @endfor
          </div>
          <p class="testimonial-text">{{ $testimonial->content }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- About -->
  <section id="about" class="section bg-white">
    <div class="container">
      <div class="about-grid">
        <div class="about-image animate-on-scroll">
          <img src="{{ asset($settings['about_image'] ?? 'images/Surya Kencana 2.jpg') }}" width="1080" alt="About Monti" data-preview-key="about_image">
          <div class="about-decoration"></div>
        </div>

        <div class="about-content animate-on-scroll">
          <h2 class="about-title" data-preview-key="about_title">{{ $settings['about_title'] ?? 'About Monti Outdoor Service' }}</h2>
          <div data-preview-key="about_text">{!! $settings['about_text'] !!}</div>

          <div class="values-grid">
            <div class="value-item">
              <div class="value-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
              </div>
              <div>
                <h4 class="value-title">Safety First</h4>
                <p class="value-description">Certified guides & protocols</p>
              </div>
            </div>

            <div class="value-item">
              <div class="value-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 2a10 10 0 0 1 7.38 16.75L12 22l-7.38-3.25A10 10 0 0 1 12 2z"/>
                </svg>
              </div>
              <div>
                <h4 class="value-title">Eco-Friendly</h4>
                <p class="value-description">Leave No Trace principles</p>
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
              <div>
                <h4 class="value-title">Community</h4>
                <p class="value-description">Supporting local communities</p>
              </div>
            </div>

            <div class="value-item">
              <div class="value-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
              </div>
              <div>
                <h4 class="value-title">Excellence</h4>
                <p class="value-description">Quality service & equipment</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Blog -->
  <section class="section bg-white">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <h2 class="section-title">Adventure Tips & Resources</h2>
        <p class="section-description">Guides, insights, and inspiration to help you prepare for your next journey</p>
      </div>

      <div class="blog-grid">
        <article class="blog-card animate-on-scroll">
          <div class="blog-image">
            <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?w=600" alt="Blog post">
            <div class="blog-category">Guide</div>
          </div>
          <div class="blog-content">
            <div class="blog-meta">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              <span>Dec 1, 2025</span>
            </div>
            <h3 class="blog-title">Essential Gear for Mountain Trekking</h3>
            <p class="blog-excerpt">Everything you need to pack for a safe and comfortable mountain adventure, from clothing to navigation tools.</p>
            <button class="blog-link">
              Read More
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </a>
          </div>
        </article>

        <article class="blog-card animate-on-scroll">
          <div class="blog-image">
            <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?w=600" alt="Blog post">
            <div class="blog-category">Tips</div>
          </div>
          <div class="blog-content">
            <div class="blog-meta">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              <span>Nov 28, 2025</span>
            </div>
            <h3 class="blog-title">Preparing for High Altitude Climbing</h3>
            <p class="blog-excerpt">Learn how to acclimatize properly and avoid altitude sickness during your summit expedition.</p>
            <button class="blog-link">
              Read More
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </a>
          </div>
        </article>

        <article class="blog-card animate-on-scroll">
          <div class="blog-image">
            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=600" alt="Blog post">
            <div class="blog-category">Story</div>
          </div>
          <div class="blog-content">
            <div class="blog-meta">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              <span>Nov 25, 2025</span>
            </div>
            <h3 class="blog-title">Indonesia's Most Beautiful Summit Views</h3>
            <p class="blog-excerpt">Explore the breathtaking panoramas from Indonesia's most iconic mountain peaks and plan your next climb.</p>
            <button class="blog-link">
              Read More
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

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-col">
          <div class="footer-logo">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: {{ isset($settings['global_footer_logo']) ? 'none' : 'block' }}">
              <path d="M16 2L4 14L8 18L16 10L24 18L28 14L16 2Z" fill="#e97543"/>
              <path d="M8 18L4 22V30H12V24H20V30H28V22L24 18L16 26L8 18Z" fill="#e97543"/>
            </svg>
            @if(isset($settings['global_footer_logo']))
              <img src="{{ asset($settings['global_footer_logo']) }}" alt="Monti Outdoor" width="32" height="32" data-preview-key="global_footer_logo">
            @endif
            <span>Monti Outdoor</span>
          </div>
          <p class="footer-description" data-preview-key="global_footer_text">{{ $settings['global_footer_text'] ?? 'Your trusted partner for outdoor adventures and mountain expeditions across Indonesia.' }}</p>
          <div class="footer-social">
            @if(isset($settings['social_facebook']))
            <a href="{{ $settings['social_facebook'] }}" class="social-link" aria-label="Facebook" data-preview-key="social_facebook" target="_blank">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
              </svg>
            </a>
            @endif
            @if(isset($settings['social_instagram']))
            <a href="{{ $settings['social_instagram'] }}" class="social-link" aria-label="Instagram" data-preview-key="social_instagram" target="_blank">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
              </svg>
            </a>
            @endif
            @if(isset($settings['social_twitter']))
            <a href="{{ $settings['social_twitter'] }}" class="social-link" aria-label="Twitter" data-preview-key="social_twitter" target="_blank">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
              </svg>
            </a>
            @endif
            @if(isset($settings['social_tiktok']))
            <a href="{{ $settings['social_tiktok'] }}" class="social-link" aria-label="TikTok" data-preview-key="social_tiktok" target="_blank">
              <!-- TikTok Icon -->
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
              </svg>
            </a>
            @endif
          </div>
        </div>

        <div class="footer-col">
          <h4 class="footer-heading">Quick Links</h4>
          <ul class="footer-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#trips">Trips & Packages</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4 class="footer-heading">Services</h4>
          <ul class="footer-links">
            <li><a href="#trips">Mountain Trip</a></li>
            <li><a href="#trips">Outdoor Activity</a></li>
            <li><a href="#trips">Indoor Activity</a></li>
            <li><a href="#contact">Custom Packages</a></li>
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
          <a href="#">Terms of Service</a>
        </div>
      </div>
    </div>
  </footer>

  <script src="{{ asset('js/landing.js') }}"></script>
  @vite(['resources/js/landing-preview.js', 'resources/js/landing-ui-fixes.js'])
</body>
</html>
