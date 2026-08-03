/**
 * Flowerium Theme Main JavaScript
 * 
 * @package Flowerium
 * @since 1.0.0
 */

(function() {
    'use strict';

    // Mobile Menu Toggle
    const menuToggle = document.querySelector('[data-menu-toggle]');
    const nav = document.querySelector('[data-nav]');
    
    if (menuToggle && nav) {
        menuToggle.addEventListener('click', () => {
            const isOpen = nav.classList.toggle('is-open');
            menuToggle.setAttribute('aria-expanded', String(isOpen));
            
            // Toggle aria-label
            if (isOpen) {
                menuToggle.setAttribute('aria-label', 'Закрыть меню');
            } else {
                menuToggle.setAttribute('aria-label', 'Открыть меню');
            }
        });
    }

    // Close mobile menu when clicking on a link
    const navLinks = document.querySelectorAll('[data-nav] a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (nav && nav.classList.contains('is-open')) {
                nav.classList.remove('is-open');
                if (menuToggle) {
                    menuToggle.setAttribute('aria-expanded', 'false');
                    menuToggle.setAttribute('aria-label', 'Открыть меню');
                }
            }
        });
    });

    // Header scroll effect
    const header = document.querySelector('[data-header]');
    let lastScrollTop = 0;
    
    if (header) {
        window.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            lastScrollTop = scrollTop;
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            if (href !== '#' && document.querySelector(href)) {
                e.preventDefault();
                const target = document.querySelector(href);
                const offsetTop = target.offsetTop - 100;
                
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Form handling (for non-WooCommerce forms)
    const forms = document.querySelectorAll('form:not(.woocommerce-form)');
    forms.forEach((form) => {
        form.addEventListener('submit', (event) => {
            // Only prevent default if it's not a WooCommerce form
            if (!form.classList.contains('woocommerce-form') && !form.closest('.woocommerce')) {
                event.preventDefault();
                
                // Show loading state
                const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
                if (submitButton) {
                    const originalText = submitButton.textContent;
                    submitButton.textContent = 'Отправка...';
                    submitButton.disabled = true;
                    
                    // Simulate form submission (replace with actual AJAX call)
                    setTimeout(() => {
                        form.reset();
                        submitButton.textContent = originalText;
                        submitButton.disabled = false;
                        alert('Спасибо! Заявка отправлена. Менеджер скоро свяжется с вами.');
                    }, 1000);
                }
            }
        });
    });

    // Product quantity buttons (if needed)
    const qtyButtons = document.querySelectorAll('.qty-btn');
    qtyButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const input = button.parentElement.querySelector('.qty');
            if (input) {
                const step = parseInt(input.step) || 1;
                const min = parseInt(input.min) || 0;
                let value = parseInt(input.value) || 0;
                
                if (button.classList.contains('plus')) {
                    value += step;
                } else if (button.classList.contains('minus') && value > min) {
                    value -= step;
                }
                
                input.value = value;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });
    });

    // Lazy loading for images (fallback for older browsers)
    if ('loading' in HTMLImageElement.prototype === false) {
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            img.src = img.dataset.src;
        });
    }

    // Add animation classes on scroll
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.product-card, .category-card, .steps article').forEach(el => {
        el.style.opacity = '0';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // Add CSS for fade-in animation
    const style = document.createElement('style');
    style.textContent = `
        .fade-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    `;
    document.head.appendChild(style);

})();
