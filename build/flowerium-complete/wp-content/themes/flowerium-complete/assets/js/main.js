/**
 * Flowerium Complete Theme - Main JavaScript
 *
 * @package Flowerium_Complete
 * @version 1.0.0
 */

(function($) {
    'use strict';

    // Document ready
    $(document).ready(function() {
        
        /* ============================================
           Mobile Menu Toggle
           ============================================ */
        var $mobileMenuToggle = $('.mobile-menu-toggle');
        var $mainNavigation = $('#site-navigation');
        
        $mobileMenuToggle.on('click', function() {
            $mainNavigation.toggleClass('active');
            $(this).toggleClass('active');
            
            // Animate hamburger to X
            var spans = $(this).find('span');
            if ($(this).hasClass('active')) {
                spans.eq(0).css({
                    'transform': 'rotate(45deg) translate(5px, 5px)'
                });
                spans.eq(1).css({
                    'opacity': '0'
                });
                spans.eq(2).css({
                    'transform': 'rotate(-45deg) translate(7px, -6px)'
                });
            } else {
                spans.css({
                    'transform': 'none',
                    'opacity': '1'
                });
            }
        });
        
        // Close mobile menu on link click
        $mainNavigation.find('a').on('click', function() {
            $mainNavigation.removeClass('active');
            $mobileMenuToggle.removeClass('active');
            $mobileMenuToggle.find('span').css({
                'transform': 'none',
                'opacity': '1'
            });
        });
        
        /* ============================================
           Cart Modal
           ============================================ */
        var $cartModalOverlay = $('#cart-modal-overlay');
        var $cartModal = $('#cart-modal');
        var $cartModalClose = $('[data-cart-modal-close]');
        var $cartModalToggle = $('[data-cart-modal-toggle]');
        
        // Open cart modal
        $cartModalToggle.on('click', function(e) {
            e.preventDefault();
            openCartModal();
        });
        
        // Close cart modal
        $cartModalClose.on('click', function() {
            closeCartModal();
        });
        
        // Close on overlay click
        $cartModalOverlay.on('click', function(e) {
            if ($(e.target).is($cartModalOverlay)) {
                closeCartModal();
            }
        });
        
        // Close on ESC key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $cartModalOverlay.hasClass('active')) {
                closeCartModal();
            }
        });
        
        function openCartModal() {
            $cartModalOverlay.addClass('active');
            $('body').css('overflow', 'hidden');
        }
        
        function closeCartModal() {
            $cartModalOverlay.removeClass('active');
            $('body').css('overflow', '');
        }
        
        /* ============================================
           AJAX Add to Cart
           ============================================ */
        var $addToCartButtons = $('.product-add-to-cart');
        
        $addToCartButtons.on('click', function(e) {
            e.preventDefault();
            
            var $button = $(this);
            var productId = $button.data('product-id');
            
            if (!productId) return;
            
            // Disable button during request
            $button.prop('disabled', true).addClass('loading');
            
            $.ajax({
                type: 'POST',
                url: flowerium_ajax.ajax_url,
                data: {
                    action: 'flowerium_add_to_cart',
                    nonce: flowerium_ajax.nonce,
                    product_id: productId,
                    quantity: 1
                },
                beforeSend: function() {
                    $button.addClass('loading');
                },
                success: function(response) {
                    $button.removeClass('loading');
                    
                    if (response.success) {
                        // Update cart count
                        $('.cart-count').text(response.data.cart_count);
                        
                        // Update cart modal content
                        $('#cart-modal-body').html(response.data.cart_html);
                        $('#cart-modal-total').text(response.data.cart_total);
                        
                        // Show notification
                        showNotification(response.data.message, 'success');
                        
                        // Open cart modal after short delay
                        setTimeout(function() {
                            openCartModal();
                        }, 300);
                    } else {
                        showNotification(response.data.message || flowerium_ajax.add_to_cart_error, 'error');
                    }
                },
                error: function() {
                    showNotification(flowerium_ajax.add_to_cart_error || 'Произошла ошибка. Попробуйте еще раз.', 'error');
                },
                complete: function() {
                    $button.prop('disabled', false).removeClass('loading');
                }
            });
        });
        
        /* ============================================
           Smooth Scroll for Anchor Links
           ============================================ */
        $('a[href^="#"]').on('click', function(e) {
            var target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 800);
            }
        });
        
        /* ============================================
           Header Scroll Effect
           ============================================ */
        var $header = $('.site-header');
        var lastScrollTop = 0;
        
        $(window).on('scroll', function() {
            var scrollTop = $(window).scrollTop();
            
            if (scrollTop > 100) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }
            
            // Hide header on scroll down, show on scroll up
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                $header.addClass('hide');
            } else {
                $header.removeClass('hide');
            }
            
            lastScrollTop = scrollTop;
        });
        
        /* ============================================
           Animation on Scroll
           ============================================ */
        var $animatedElements = $('.fade-in-up');
        
        function checkAnimation() {
            $animatedElements.each(function() {
                var $element = $(this);
                var elementTop = $element.offset().top;
                var windowBottom = $(window).scrollTop() + $(window).height();
                
                if (elementTop < windowBottom - 50) {
                    $element.addClass('visible');
                }
            });
        }
        
        // Check on load and scroll
        $(window).on('load scroll', checkAnimation);
        checkAnimation();
        
        /* ============================================
           Delivery Date Picker - Min Date
           ============================================ */
        var $deliveryDateInput = $('#flowerium_delivery_date');
        
        if ($deliveryDateInput.length) {
            var today = new Date();
            var tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            
            var minDate = tomorrow.toISOString().split('T')[0];
            $deliveryDateInput.attr('min', minDate);
        }
        
        /* ============================================
           Form Validation Enhancement
           ============================================ */
        $('form.validate').on('submit', function(e) {
            var $form = $(this);
            var isValid = true;
            
            $form.find('[required]').each(function() {
                var $input = $(this);
                
                if (!$input.val()) {
                    isValid = false;
                    $input.addClass('error');
                } else {
                    $input.removeClass('error');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showNotification('Пожалуйста, заполните все обязательные поля', 'warning');
            }
        });
        
        /* ============================================
           Lazy Loading Images
           ============================================ */
        if ('loading' in HTMLImageElement.prototype) {
            $('img[data-src]').each(function() {
                var $img = $(this);
                $img.attr('src', $img.data('src'));
            });
        }
        
    }); // End document ready
    
    /* ============================================
       Notification System
       ============================================ */
    window.showNotification = function(message, type) {
        type = type || 'info';
        
        var icons = {
            success: 'fa-check-circle',
            error: 'fa-exclamation-circle',
            warning: 'fa-exclamation-triangle',
            info: 'fa-info-circle'
        };
        
        var titles = {
            success: 'Успешно',
            error: 'Ошибка',
            warning: 'Внимание',
            info: 'Информация'
        };
        
        var notificationHtml = `
            <div class="notification ${type}">
                <div class="notification-content">
                    <i class="fas ${icons[type]}"></i>
                    <div>
                        <div class="notification-title">${titles[type]}</div>
                        <div class="notification-message">${message}</div>
                    </div>
                </div>
                <button class="notification-close">&times;</button>
            </div>
        `;
        
        var $notification = $(notificationHtml);
        $('#notification-container').append($notification);
        
        // Show notification
        setTimeout(function() {
            $notification.addClass('show');
        }, 10);
        
        // Auto hide after 5 seconds
        var autoHideTimeout = setTimeout(function() {
            hideNotification($notification);
        }, 5000);
        
        // Close button
        $notification.find('.notification-close').on('click', function() {
            clearTimeout(autoHideTimeout);
            hideNotification($notification);
        });
        
        function hideNotification($notif) {
            $notif.removeClass('show');
            setTimeout(function() {
                $notif.remove();
            }, 300);
        }
    };
    
    /* ============================================
       WooCommerce Cart Fragments Refresh
       ============================================ */
    $(document.body).on('added_to_cart removed_from_cart updated_cart_totals', function() {
        // Update cart count in header
        $.ajax({
            url: flowerium_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'flowerium_get_cart_count'
            },
            success: function(response) {
                if (response.success) {
                    $('.cart-count').text(response.data.count);
                }
            }
        });
    });
    
})(jQuery);
