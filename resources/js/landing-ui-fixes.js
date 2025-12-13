/**
 * Fixes for Landing Page UI Interactions
 */

document.addEventListener('DOMContentLoaded', function () {
    const mobileBtn = document.querySelector('.mobile-menu-btn');
    const nav = document.querySelector('.nav');
    const dropdowns = document.querySelectorAll('.dropdown');



    // Mobile Menu Toggle:
    // We rely on the NATIVE landing.js script to toggle the 'mobile-open' class.
    // We removed our custom toggle logic to prevent conflicts (double-toggling or state desync).
    // The "shrinking" issue was caused by us fighting the native script.
    // Now we just ensure the classes are correct.

    // Mobile Dropdown Toggle
    dropdowns.forEach(dropdown => {
        // Updated selector to find our new custom toggle class or the generic one
        const toggle = dropdown.querySelector('.dropdown-toggle, .custom-dropdown-toggle');
        if (toggle) {
            toggle.addEventListener('click', function (e) {
                // Only on mobile
                if (window.innerWidth <= 1023) {
                    e.preventDefault();
                    dropdown.classList.toggle('active');
                }
            });
        }
    });

    // Close menu when clicking a link
    const navLinks = document.querySelectorAll('.nav-link:not(.dropdown-toggle):not(.custom-dropdown-toggle), .dropdown-item');
    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            // Force clean up when a REAL link is clicked
            if (window.innerWidth <= 1023) {
                 // Clean up native class
                 if(nav) nav.classList.remove('mobile-open');
                 // Clean up active class (if present)
                 if(nav) nav.classList.remove('active');
                 
                 const btn = document.querySelector('.mobile-menu-btn');
                 if(btn) btn.classList.remove('active');
                 
                 document.body.style.overflow = '';
            }
        });
    // Handling Resize Glitch
    // If user resizes from mobile (open) to desktop, the active/mobile-open classes might persist.
    // We need to clean them up.
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1023) {
             if(nav) {
                 nav.classList.remove('mobile-open');
                 nav.classList.remove('active');
                 
                 // Clear any inline styles that might conflict with desktop CSS
                 nav.style.display = '';
                 nav.style.height = '';
             }
             const btn = document.querySelector('.mobile-menu-btn');
             if(btn) btn.classList.remove('active');
             
             document.body.style.overflow = '';
             
             // Also close dropdowns
             dropdowns.forEach(d => {
                 d.classList.remove('active');
                 const menu = d.querySelector('.dropdown-menu');
                 if(menu) menu.style.display = '';
             });
        }
    });

    });
});
