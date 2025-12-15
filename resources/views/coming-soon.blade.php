<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coming Soon - Monti Outdoor Service</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #0f0f1e;
      color: #ffffff;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }

    /* Background Image */
    .background-image {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
    }

    .background-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }

    .background-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(26, 26, 46, 0.92) 0%, rgba(15, 15, 30, 0.95) 100%);
      z-index: 1;
    }

    /* Animated background particles */
    .particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 2;
    }

    .particle {
      position: absolute;
      background: rgba(233, 117, 67, 0.1);
      border-radius: 50%;
      animation: float 20s infinite;
    }

    .particle:nth-child(1) { width: 80px; height: 80px; left: 10%; animation-delay: 0s; }
    .particle:nth-child(2) { width: 120px; height: 120px; left: 20%; animation-delay: 2s; }
    .particle:nth-child(3) { width: 60px; height: 60px; left: 60%; animation-delay: 4s; }
    .particle:nth-child(4) { width: 100px; height: 100px; left: 80%; animation-delay: 6s; }
    .particle:nth-child(5) { width: 90px; height: 90px; left: 50%; animation-delay: 8s; }

    @keyframes float {
      0%, 100% {
        transform: translateY(0) rotate(0deg);
        opacity: 0;
      }
      10% {
        opacity: 0.3;
      }
      50% {
        transform: translateY(-100vh) rotate(360deg);
        opacity: 0.5;
      }
      100% {
        transform: translateY(-200vh) rotate(720deg);
        opacity: 0;
      }
    }

    .container {
      position: relative;
      z-index: 10;
      text-align: center;
      padding: 2rem;
      max-width: 800px;
      animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .logo {
      width: 120px;
      height: auto;
      margin: 0 auto 2rem;
      animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.05);
      }
    }

    .logo img {
      width: 100%;
      height: auto;
      filter: drop-shadow(0 4px 20px rgba(233, 117, 67, 0.4));
    }

    h1 {
      font-size: clamp(2.5rem, 8vw, 5rem);
      font-weight: 900;
      line-height: 1.1;
      margin-bottom: 1.5rem;
      background: linear-gradient(135deg, #e97543 0%, #ff9966 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      letter-spacing: -0.02em;
      animation: shine 3s ease-in-out infinite;
      background-size: 200% 200%;
    }

    @keyframes shine {
      0%, 100% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
    }

    .tagline {
      font-size: clamp(1.1rem, 3vw, 1.5rem);
      font-weight: 500;
      color: rgba(255, 255, 255, 0.85);
      margin-bottom: 1rem;
      line-height: 1.6;
      animation: fadeIn 1.5s ease-out 0.3s both;
    }

    .services-highlight {
      font-size: clamp(0.9rem, 2.5vw, 1.05rem);
      color: #e97543;
      font-weight: 600;
      margin-bottom: 1rem;
      animation: fadeIn 1.5s ease-out 0.5s both;
      letter-spacing: 0.05em;
    }

    .description {
      font-size: clamp(0.95rem, 2.5vw, 1.125rem);
      color: rgba(255, 255, 255, 0.6);
      margin-bottom: 3rem;
      line-height: 1.8;
      max-width: 650px;
      margin-left: auto;
      margin-right: auto;
      animation: fadeIn 1.5s ease-out 0.6s both;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    .cta-container {
      animation: fadeIn 1.5s ease-out 0.9s both;
    }

    .whatsapp-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      background: linear-gradient(135deg, #e97543 0%, #ff7f50 100%);
      color: #ffffff;
      padding: 1.25rem 2.5rem;
      font-size: 1.125rem;
      font-weight: 600;
      border-radius: 50px;
      text-decoration: none;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 10px 40px rgba(233, 117, 67, 0.3);
      position: relative;
      overflow: hidden;
    }

    .whatsapp-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s;
    }

    .whatsapp-btn:hover::before {
      left: 100%;
    }

    .whatsapp-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 15px 50px rgba(233, 117, 67, 0.5);
    }

    .whatsapp-btn:active {
      transform: translateY(0);
    }

    .whatsapp-icon {
      width: 28px;
      height: 28px;
      animation: wiggle 1s ease-in-out infinite;
    }

    @keyframes wiggle {
      0%, 100% {
        transform: rotate(0deg);
      }
      25% {
        transform: rotate(-10deg);
      }
      75% {
        transform: rotate(10deg);
      }
    }

    .status {
      margin-top: 4rem;
      padding-top: 3rem;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      animation: fadeIn 2s ease-out 1.2s both;
    }

    .status-text {
      font-size: 0.875rem;
      color: rgba(255, 255, 255, 0.4);
      text-transform: uppercase;
      letter-spacing: 0.15em;
      margin-bottom: 0.75rem;
    }

    .status-message {
      font-size: 1rem;
      color: rgba(255, 255, 255, 0.7);
      font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container {
        padding: 1.5rem;
      }

      .logo {
        width: 90px;
        margin-bottom: 1.5rem;
      }

      h1 {
        margin-bottom: 1rem;
      }

      .description {
        margin-bottom: 2rem;
      }

      .whatsapp-btn {
        padding: 1rem 2rem;
        font-size: 1rem;
      }

      .status {
        margin-top: 3rem;
        padding-top: 2rem;
      }
    }
  </style>
</head>
<body>
  <!-- Background Image -->
  <div class="background-image">
    <img src="{{ asset('storage/uploads/gallery/3ca9DYNsX2uLlt7clql8q2pdj29fSqK7K80oOio3.jpg') }}" alt="Mountain Adventure">
    <div class="background-overlay"></div>
  </div>

  <!-- Animated background particles -->
  <div class="particles">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
  </div>

  <div class="container">
    <!-- Logo -->
    <div class="logo">
      <img src="{{ asset('storage/uploads/landing/1765634242_cropped_image.png') }}" alt="Monti Outdoor Service">
    </div>

    <!-- Main Content -->
    <h1>Coming Soon</h1>
    
    <p class="tagline">
      Your Ultimate Adventure Partner
    </p>

    <p class="services-highlight">
      Mountain Trips • Island Trips • City Tour • International Adventures • MICE • Team Building
    </p>
    
    <p class="description">
      We're crafting an extraordinary platform for unforgettable experiences. From conquering Indonesia's majestic peaks to exploring international destinations, organizing corporate events, and building stronger teams through adventure.
    </p>

    <!-- CTA Button -->
    <div class="cta-container">
      <a href="https://wa.me/6281196969119?text=Hi%20Monti%20Outdoor%20Service!%20I%20want%20to%20know%20more%20about%20your%20upcoming%20adventure%20experiences." 
         target="_blank" 
         rel="noopener noreferrer" 
         class="whatsapp-btn">
        <svg class="whatsapp-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
        </svg>
        Get Details on WhatsApp
      </a>
    </div>

    <!-- Status -->
    <div class="status">
      <p class="status-text">Status</p>
      <p class="status-message">We're launching soon • Stay tuned for updates</p>
    </div>
  </div>
</body>
</html>
