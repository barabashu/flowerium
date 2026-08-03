/**
 * Flowerium Shop Theme JavaScript
 * 
 * @package Flowerium_Shop
 * @since 1.0.0
 */

(function() {
    'use strict';

    // Mobile menu toggle
    const menuToggle = document.querySelector('[data-menu-toggle]');
    const mainNav = document.querySelector('[data-nav]');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            mainNav.classList.toggle('is-open');
        });
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        if (menuToggle && mainNav && 
            !menuToggle.contains(event.target) && 
            !mainNav.contains(event.target)) {
            menuToggle.setAttribute('aria-expanded', 'false');
            mainNav.classList.remove('is-open');
        }
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && document.querySelector(href)) {
                e.preventDefault();
                document.querySelector(href).scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Header scroll effect
    const header = document.querySelector('[data-header]');
    let lastScroll = 0;

    if (header) {
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > lastScroll && currentScroll > 100) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }
            
            lastScroll = currentScroll;
        });
    }

    // Add to cart animation
    document.querySelectorAll('[data-product-id]').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!this.closest('form')) {
                e.preventDefault();
                
                // Visual feedback
                const originalText = this.textContent;
                this.textContent = '✓ Добавлено';
                this.disabled = true;
                
                setTimeout(() => {
                    this.textContent = originalText;
                    this.disabled = false;
                }, 1500);
            }
        });
    });

    // Form validation enhancement
    document.querySelectorAll('input[required], textarea[required], select[required]').forEach(field => {
        field.addEventListener('invalid', function(e) {
            e.preventDefault();
            this.classList.add('error');
            
            // Remove error class on input
            this.addEventListener('input', function() {
                this.classList.remove('error');
            }, { once: true });
        });
    });

    // Lazy loading images (if browser doesn't support native lazy loading)
    if ('loading' in HTMLImageElement.prototype === false) {
        const images = document.querySelectorAll('img[data-src]');
        
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }

    // Product gallery (simple implementation)
    const productGallery = document.querySelector('.product-gallery');
    if (productGallery) {
        const thumbnails = productGallery.querySelectorAll('.thumbnail');
        const mainImage = productGallery.querySelector('.main-image');
        
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                if (mainImage) {
                    mainImage.src = this.dataset.full;
                    
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });
    }

    // Quantity buttons for WooCommerce
    const qtyButtons = document.querySelectorAll('.quantity .qty-btn');
    qtyButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.qty');
            const step = parseInt(input.step) || 1;
            const min = parseInt(input.min) || 0;
            const max = parseInt(input.max) || Infinity;
            
            let value = parseInt(input.value) || min;
            
            if (this.classList.contains('plus')) {
                value += step;
            } else {
                value -= step;
            }
            
            if (value >= min && value <= max) {
                input.value = value;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });
    });

    // Notice auto-dismiss
    document.querySelectorAll('.woocommerce-message, .woocommerce-info, .woocommerce-error').forEach(notice => {
        setTimeout(() => {
            notice.style.transition = 'opacity 0.5s ease';
            notice.style.opacity = '0';
            setTimeout(() => notice.remove(), 500);
        }, 5000);
    });

})();
