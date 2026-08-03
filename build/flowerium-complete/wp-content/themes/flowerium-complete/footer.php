    <!-- Footer -->
    <footer id="colophon" class="site-footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-widgets">
                    <!-- Widget Area 1 -->
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                    <?php else : ?>
                        <div class="footer-widget">
                            <h4><?php _e('О компании', 'flowerium-complete'); ?></h4>
                            <p><?php _e('Сеть цветочных магазинов Flowerium в Крыму. Свежие цветы, авторские букеты и безупречный сервис с доставкой по всему полуострову.', 'flowerium-complete'); ?></p>
                            <div class="social-links">
                                <?php if (flowerium_get_instagram()) : ?>
                                    <a href="<?php echo esc_url(flowerium_get_instagram()); ?>" class="social-link" target="_blank" rel="noopener">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (flowerium_get_vk()) : ?>
                                    <a href="<?php echo esc_url(flowerium_get_vk()); ?>" class="social-link" target="_blank" rel="noopener">
                                        <i class="fab fa-vk"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (flowerium_get_telegram()) : ?>
                                    <a href="<?php echo esc_url(flowerium_get_telegram()); ?>" class="social-link" target="_blank" rel="noopener">
                                        <i class="fab fa-telegram"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (flowerium_get_whatsapp()) : ?>
                                    <a href="https://wa.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', flowerium_get_whatsapp())); ?>" class="social-link" target="_blank" rel="noopener">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Widget Area 2 -->
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-2'); ?>
                        </div>
                    <?php else : ?>
                        <div class="footer-widget">
                            <h4><?php _e('Контакты', 'flowerium-complete'); ?></h4>
                            <ul class="contact-list">
                                <li>
                                    <i class="fas fa-phone"></i>
                                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', flowerium_get_phone())); ?>">
                                        <?php echo esc_html(flowerium_get_phone()); ?>
                                    </a>
                                </li>
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <a href="mailto:<?php echo esc_attr(flowerium_get_email()); ?>">
                                        <?php echo esc_html(flowerium_get_email()); ?>
                                    </a>
                                </li>
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?php echo esc_html(flowerium_get_address()); ?></span>
                                </li>
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <span><?php echo esc_html(flowerium_get_hours()); ?></span>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Widget Area 3 -->
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-3'); ?>
                        </div>
                    <?php else : ?>
                        <div class="footer-widget">
                            <h4><?php _e('Меню', 'flowerium-complete'); ?></h4>
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'footer',
                                'menu_class'     => 'footer-menu',
                                'container'      => false,
                                'fallback_cb'    => false,
                                'depth'          => 1,
                            ));
                            ?>
                        </div>
                    <?php endif; ?>

                    <!-- Widget Area 4 -->
                    <?php if (is_active_sidebar('footer-4')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-4'); ?>
                        </div>
                    <?php else : ?>
                        <div class="footer-widget">
                            <h4><?php _e('Информация', 'flowerium-complete'); ?></h4>
                            <ul class="info-list">
                                <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('delivery'))); ?>"><?php _e('Доставка и оплата', 'flowerium-complete'); ?></a></li>
                                <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy'))); ?>"><?php _e('Политика конфиденциальности', 'flowerium-complete'); ?></a></li>
                                <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('terms'))); ?>"><?php _e('Публичная оферта', 'flowerium-complete'); ?></a></li>
                                <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>"><?php _e('О нас', 'flowerium-complete'); ?></a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('Все права защищены.', 'flowerium-complete'); ?></p>
                <p style="font-size: 0.75rem; margin-top: 10px; opacity: 0.6;">
                    <?php _e('Работаем в городах: Симферополь, Ялта, Севастополь, Евпатория, Феодосия, Алушта', 'flowerium-complete'); ?>
                </p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<!-- Cart Modal -->
<div class="cart-modal-overlay" id="cart-modal-overlay">
    <div class="cart-modal" id="cart-modal">
        <div class="cart-modal-header">
            <h3><?php _e('Корзина', 'flowerium-complete'); ?></h3>
            <button class="cart-modal-close" data-cart-modal-close>&times;</button>
        </div>
        <div class="cart-modal-body" id="cart-modal-body">
            <!-- Cart items will be loaded here via AJAX -->
            <?php include FLOWERIUM_DIR . '/template-parts/cart-mini.php'; ?>
        </div>
        <div class="cart-modal-footer">
            <div class="cart-total">
                <span><?php _e('Итого:', 'flowerium-complete'); ?></span>
                <span id="cart-modal-total"><?php echo WC()->cart ? WC()->cart->get_cart_total() : '0 ₽'; ?></span>
            </div>
            <div class="cart-modal-actions">
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="btn btn-outline"><?php _e('Перейти в корзину', 'flowerium-complete'); ?></a>
                <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="btn btn-primary"><?php _e('Оформить заказ', 'flowerium-complete'); ?></a>
            </div>
        </div>
    </div>
</div>

<!-- Notification Container -->
<div id="notification-container"></div>

<?php wp_footer(); ?>

</body>
</html>
