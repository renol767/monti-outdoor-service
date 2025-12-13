// Mobile Menu Toggle
const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const nav = document.querySelector('.nav');

if (mobileMenuBtn) {
  mobileMenuBtn.addEventListener('click', () => {
    mobileMenuBtn.classList.toggle('active');
    nav.classList.toggle('mobile-open');
  });
}

// Close mobile menu when clicking on a link
const navLinks = document.querySelectorAll('.nav-link, .dropdown-item');
navLinks.forEach(link => {
  link.addEventListener('click', () => {
    if (nav.classList.contains('mobile-open')) {
      mobileMenuBtn.classList.remove('active');
      nav.classList.remove('mobile-open');
    }
  });
});

// Sticky Header on Scroll
const header = document.getElementById('header');
let lastScroll = 0;

window.addEventListener('scroll', () => {
  const currentScroll = window.pageYOffset;
  
  if (currentScroll > 50) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
  
  lastScroll = currentScroll;
});

// Smooth Scroll for Anchor Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    const href = this.getAttribute('href');
    
    // Don't prevent default for empty anchors
    if (href === '#' || href === '') {
      return;
    }
    
    e.preventDefault();
    
    const target = document.querySelector(href);
    if (target) {
      const headerHeight = header.offsetHeight;
      const targetPosition = target.offsetTop - headerHeight;
      
      window.scrollTo({
        top: targetPosition,
        behavior: 'smooth'
      });
    }
  });
});

// Intersection Observer for Scroll Animations
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animated');
      // Optionally unobserve after animation
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

// Observe all elements with animate-on-scroll class
const animateElements = document.querySelectorAll('.animate-on-scroll');
animateElements.forEach(el => observer.observe(el));

// Contact Form Submission
const contactForm = document.getElementById('contactForm');
if (contactForm) {
  contactForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    // Get form data
    const formData = new FormData(contactForm);
    const data = {};
    formData.forEach((value, key) => {
      data[key] = value;
    });
    
    // In production, this would send to a backend
    console.log('Form submitted:', data);
    
    // Show success message
    alert('Thank you for your inquiry! We\'ll get back to you soon.');
    
    // Reset form
    contactForm.reset();
  });
}

// Newsletter Form Submission
const newsletterForm = document.getElementById('newsletterForm');
if (newsletterForm) {
  newsletterForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const emailInput = newsletterForm.querySelector('input[type="email"]');
    const email = emailInput.value;
    
    // In production, this would send to a backend
    console.log('Newsletter subscription:', email);
    
    // Show success message
    alert('Thanks for subscribing to our newsletter!');
    
    // Reset form
    newsletterForm.reset();
  });
}

// Dropdown Menu for Desktop
const dropdowns = document.querySelectorAll('.dropdown');

dropdowns.forEach(dropdown => {
  const toggle = dropdown.querySelector('.dropdown-toggle');
  const menu = dropdown.querySelector('.dropdown-menu');
  
  // For mobile, toggle on click
  if (toggle) {
    toggle.addEventListener('click', (e) => {
      if (window.innerWidth < 1024) {
        e.preventDefault();
        e.stopPropagation();
        
        // Close other dropdowns
        dropdowns.forEach(otherDropdown => {
          if (otherDropdown !== dropdown) {
            const otherMenu = otherDropdown.querySelector('.dropdown-menu');
            if (otherMenu) {
              otherMenu.style.display = 'none';
            }
          }
        });
        
        // Toggle current dropdown
        if (menu) {
          if (menu.style.display === 'block') {
            menu.style.display = 'none';
          } else {
            menu.style.display = 'block';
            menu.style.opacity = '1';
            menu.style.visibility = 'visible';
            menu.style.transform = 'translateY(0)';
            menu.style.position = 'static';
            menu.style.marginTop = '0.5rem';
          }
        }
      }
    });
  }
});

// Close dropdowns when clicking outside on mobile
document.addEventListener('click', (e) => {
  if (window.innerWidth < 1024) {
    if (!e.target.closest('.dropdown')) {
      dropdowns.forEach(dropdown => {
        const menu = dropdown.querySelector('.dropdown-menu');
        if (menu) {
          menu.style.display = 'none';
        }
      });
    }
  }
});

// Handle window resize
let resizeTimer;
window.addEventListener('resize', () => {
  clearTimeout(resizeTimer);
  resizeTimer = setTimeout(() => {
    // Reset dropdown styles on resize
    if (window.innerWidth >= 1024) {
      dropdowns.forEach(dropdown => {
        const menu = dropdown.querySelector('.dropdown-menu');
        if (menu) {
          menu.style.display = '';
          menu.style.opacity = '';
          menu.style.visibility = '';
          menu.style.transform = '';
          menu.style.position = '';
          menu.style.marginTop = '';
        }
      });
    }
  }, 250);
});

// Book Now Button Click Handler
const bookButtons = document.querySelectorAll('.trip-footer .btn');
bookButtons.forEach(button => {
  button.addEventListener('click', (e) => {
    e.preventDefault();
    
    // Get the trip title from the parent card
    const card = button.closest('.trip-card');
    const tripTitle = card ? card.querySelector('.trip-title').textContent : 'this trip';
    
    // Scroll to contact form
    const contactSection = document.getElementById('contact');
    if (contactSection) {
      const headerHeight = header.offsetHeight;
      const targetPosition = contactSection.offsetTop - headerHeight;
      
      window.scrollTo({
        top: targetPosition,
        behavior: 'smooth'
      });
      
      // Optionally pre-fill the form
      setTimeout(() => {
        const messageField = document.getElementById('message');
        if (messageField && messageField.value === '') {
          messageField.value = `I'm interested in booking ${tripTitle}. Please provide more information.`;
        }
      }, 500);
    }
  });
});

// Add loading animation for images
const images = document.querySelectorAll('img');
images.forEach(img => {
  img.addEventListener('load', () => {
    img.style.opacity = '1';
  });
  
  // Set initial opacity
  if (!img.complete) {
    img.style.opacity = '0';
    img.style.transition = 'opacity 0.3s ease';
  }
});

// Parallax effect for hero section (optional enhancement)
const hero = document.querySelector('.hero');
const heroContent = document.querySelector('.hero-content');

if (hero && heroContent) {
  window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const heroHeight = hero.offsetHeight;
    
    if (scrolled < heroHeight) {
      const parallaxSpeed = 0.5;
      heroContent.style.transform = `translateY(${scrolled * parallaxSpeed}px)`;
      heroContent.style.opacity = 1 - (scrolled / heroHeight) * 1.5;
    }
  });
}

// Add active state to navigation based on scroll position
const sections = document.querySelectorAll('section[id]');

function updateActiveNav() {
  const scrollY = window.pageYOffset;
  
  sections.forEach(section => {
    const sectionHeight = section.offsetHeight;
    const sectionTop = section.offsetTop - header.offsetHeight - 100;
    const sectionId = section.getAttribute('id');
    
    if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
      // Remove active class from all nav links
      navLinks.forEach(link => {
        link.classList.remove('active');
      });
      
      // Add active class to current nav link
      const currentLink = document.querySelector(`.nav-link[href="#${sectionId}"]`);
      if (currentLink) {
        currentLink.classList.add('active');
      }
    }
  });
}

// Throttle function for performance
function throttle(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// Apply throttle to scroll event
window.addEventListener('scroll', throttle(updateActiveNav, 100));

// Counter animation for statistics (if you add stats section)
function animateCounter(element, target, duration) {
  let start = 0;
  const increment = target / (duration / 16);
  
  const timer = setInterval(() => {
    start += increment;
    if (start >= target) {
      element.textContent = target;
      clearInterval(timer);
    } else {
      element.textContent = Math.floor(start);
    }
  }, 16);
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  console.log('Monti Outdoor Service website loaded successfully!');
  
  // Add fade-in animation to hero elements
  const heroElements = document.querySelectorAll('.hero .fade-in');
  heroElements.forEach((element, index) => {
    setTimeout(() => {
      element.style.opacity = '1';
      element.style.transform = 'translateY(0)';
    }, index * 200);
  });
});

// Handle external links
const externalLinks = document.querySelectorAll('a[target="_blank"]');
externalLinks.forEach(link => {
  link.addEventListener('click', (e) => {
    // Add any tracking or analytics here
    console.log('External link clicked:', link.href);
  });
});

// Lazy loading for images (modern browsers)
if ('loading' in HTMLImageElement.prototype) {
  const lazyImages = document.querySelectorAll('img[loading="lazy"]');
  lazyImages.forEach(img => {
    img.src = img.dataset.src || img.src;
  });
} else {
  // Fallback for older browsers
  const script = document.createElement('script');
  script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
  document.body.appendChild(script);
}

// Add custom cursor effect for interactive elements (optional)
const interactiveElements = document.querySelectorAll('a, button, .trip-card, .gallery-item');
interactiveElements.forEach(element => {
  element.style.cursor = 'pointer';
});

// Print friendly styles
window.addEventListener('beforeprint', () => {
  // Hide navigation and other non-essential elements
  header.style.display = 'none';
});

window.addEventListener('afterprint', () => {
  header.style.display = '';
});

// // Accessibility: Skip to main content
// const skipLink = document.createElement('a');
// skipLink.href = '#home';
// skipLink.textContent = 'Skip to main content';
// skipLink.className = 'skip-link';
// skipLink.style.cssText = `
//   position: absolute;
//   top: -40px;
//   left: 0;
//   background: var(--color-primary);
//   color: white;
//   padding: 8px;
//   text-decoration: none;
//   z-index: 10000;
// `;
// skipLink.addEventListener('focus', () => {
//   skipLink.style.top = '0';
// });
// skipLink.addEventListener('blur', () => {
//   skipLink.style.top = '-40px';
// });
// document.body.insertBefore(skipLink, document.body.firstChild);

// Error handling for images
images.forEach(img => {
  img.addEventListener('error', () => {
    img.src = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="400" height="300"%3E%3Crect fill="%23f1f5f9" width="400" height="300"/%3E%3Ctext fill="%2394a3b8" font-family="sans-serif" font-size="18" dy="150" dx="120"%3EImage not available%3C/text%3E%3C/svg%3E';
    img.alt = 'Image not available';
  });
});

// Performance monitoring
if ('performance' in window) {
  window.addEventListener('load', () => {
    setTimeout(() => {
      const perfData = window.performance.timing;
      const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
      console.log(`Page load time: ${pageLoadTime}ms`);
    }, 0);
  });
}
