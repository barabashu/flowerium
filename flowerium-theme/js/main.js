/**
 * Main JavaScript for Flowerium Theme
 *
 * @package Flowerium
 */

(function($) {
    'use strict';

    // Mobile Menu Toggle
    $(document).ready(function() {
        const menuToggle = $('.mobile-menu-toggle');
        const mainNav = $('#site-navigation');

        if (menuToggle.length) {
            menuToggle.on('click', function() {
                const isExpanded = $(this).attr('aria-expanded') === 'true';
                $(this).attr('aria-expanded', !isExpanded);
                mainNav.slideToggle(300);
            });
        }

        // Smooth scroll for anchor links
        $('a[href^="#"]').on('click', function(e) {
            const targetId = $(this).attr('href');
            if (targetId !== '#' && $(targetId).length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $(targetId).offset().top - 100
                }, 800);
            }
        });

        // Add to cart animation
        $(document).on('added_to_cart', function(e, fragments, cart_hash, $button) {
            if ($button && $button.length) {
                $button.addClass('added');
                setTimeout(function() {
                    $button.removeClass('added');
                }, 2000);
            }
        });

        // Form validation enhancement
        $('form.woocommerce-checkout').on('submit', function() {
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true).addClass('loading');
        });

        // Cart page quantity update
        $(document).on('change', '.qty', function() {
            const form = $(this).closest('form');
            if (form.hasClass('cart')) {
                form.find('button[name="update_cart"]').trigger('click');
            }
        });

        // Product image hover effect
        $('.product img').on('mouseenter', function() {
            $(this).closest('.product').addClass('hovered');
        }).on('mouseleave', function() {
            $(this).closest('.product').removeClass('hovered');
        });

        // Header scroll effect
        let lastScrollTop = 0;
        const header = $('.site-header');

        $(window).on('scroll', function() {
            const scrollTop = $(window).scrollTop();

            if (scrollTop > lastScrollTop && scrollTop > 100) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }

            lastScrollTop = scrollTop;
        });

        // Lazy loading for images (if not using native lazy loading)
        if ('loading' in HTMLImageElement.prototype === false) {
            const images = document.querySelectorAll('img[data-src]');
            images.forEach(function(img) {
                img.src = img.dataset.src;
            });
        }

        // City selector for delivery (if exists on checkout)
        const citySelect = $('#billing_delivery_city');
        if (citySelect.length) {
            citySelect.on('change', function() {
                const selectedCity = $(this).val();
                // You can add custom logic here based on selected city
                console.log('Selected delivery city:', selectedCity);
            });
        }

        // Delivery time selector
        const timeSelect = $('#order_delivery_time');
        if (timeSelect.length) {
            timeSelect.on('change', function() {
                const selectedTime = $(this).val();
                console.log('Selected delivery time:', selectedTime);
            });
        }

        // Newsletter form handling (if exists)
        const newsletterForm = $('.newsletter-form');
        if (newsletterForm.length) {
            newsletterForm.on('submit', function(e) {
                e.preventDefault();
                const email = $(this).find('input[type="email"]').val();
                
                // Here you would typically send an AJAX request
                console.log('Newsletter subscription:', email);
                
                // Show success message
                $(this).html('<p class="success-message">Спасибо за подписку!</p>');
            });
        }

        // Back to top button (optional feature)
        const backToTop = $('<button class="back-to-top" aria-label="Наверх">&uarr;</button>');
        
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 500) {
                backToTop.fadeIn();
            } else {
                backToTop.fadeOut();
            }
        });

        backToTop.on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 600);
        });

        $('body').append(backToTop);

        // Initialize tooltips (if needed)
        $('[data-tooltip]').each(function() {
            const $this = $(this);
            const tooltipText = $this.data('tooltip');
            
            $this.on('mouseenter', function() {
                const tooltip = $('<span class="tooltip">' + tooltipText + '</span>');
                $('body').append(tooltip);
                
                const offset = $this.offset();
                tooltip.css({
                    top: offset.top - tooltip.outerHeight() - 10,
                    left: offset.left + ($this.outerWidth() / 2) - (tooltip.outerWidth() / 2)
                }).fadeIn(200);
            }).on('mouseleave', function() {
                $('.tooltip').remove();
            });
        });

        // Product gallery enhancements
        if ($('.woocommerce-product-gallery').length) {
            // Add zoom functionality if not already present
            $('.woocommerce-product-gallery__image').on('click', function() {
                const imageUrl = $(this).find('img').attr('src');
                // You could implement a lightbox here
                console.log('Gallery image clicked:', imageUrl);
            });
        }

        // Checkout form field focus effects
        $('.form-row input, .form-row select, .form-row textarea').on('focus', function() {
            $(this).closest('.form-row').addClass('focused');
        }).on('blur', function() {
            $(this).closest('.form-row').removeClass('focused');
        });

        // Auto-format phone number (optional)
        const phoneInput = $('#billing_phone');
        if (phoneInput.length) {
            phoneInput.on('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.length > 0) {
                    if (value.startsWith('7') || value.startsWith('8')) {
                        value = '+7 ' + value.substring(1);
                    } else {
                        value = '+7 ' + value;
                    }
                    
                    if (value.length > 4) {
                        value = value.substring(0, 4) + ' (' + value.substring(4);
                    }
                    if (value.length > 8) {
                        value = value.substring(0, 8) + ') ' + value.substring(8);
                    }
                    if (value.length > 13) {
                        value = value.substring(0, 13) + '-' + value.substring(13);
                    }
                    if (value.length > 16) {
                        value = value.substring(0, 16) + '-' + value.substring(16);
                    }
                    
                    this.value = value.substring(0, 19);
                }
            });
        }

        // Show/hide coupon form
        $('.showcoupon').on('click', function(e) {
            e.preventDefault();
            $('.checkout_coupon').slideToggle(300);
        });

        // Order notes toggle
        $('#order_comments').on('focus', function() {
            $(this).closest('.form-row').find('label').addClass('active');
        }).on('blur', function() {
            if (!$(this).val()) {
                $(this).closest('.form-row').find('label').removeClass('active');
            }
        });

    }); // End document ready

})(jQuery);
