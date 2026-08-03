    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <!-- Footer Widget 1 -->
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php else : ?>
                    <div class="footer-widget">
                        <h4><?php _e('О нас', 'flowerium'); ?></h4>
                        <p><?php _e('Цветочный магазин Flowerium - свежие цветы и авторские букеты с доставкой по всему Крыму.', 'flowerium'); ?></p>
                        <div class="cities-list">
                            <span>Симферополь</span>
                            <span>Ялта</span>
                            <span>Севастополь</span>
                            <span>Евпатория</span>
                            <span>Феодосия</span>
                            <span>Керчь</span>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Footer Widget 2 -->
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                <?php else : ?>
                    <div class="footer-widget">
                        <h4><?php _e('Контакты', 'flowerium'); ?></h4>
                        <p>
                            <strong><?php _e('Телефон:', 'flowerium'); ?></strong><br>
                            <a href="tel:+79780000000">+7 (978) 000-00-00</a>
                        </p>
                        <p>
                            <strong><?php _e('Email:', 'flowerium'); ?></strong><br>
                            <a href="mailto:info@flowerium-crimea.ru">info@flowerium-crimea.ru</a>
                        </p>
                        <p>
                            <strong><?php _e('Режим работы:', 'flowerium'); ?></strong><br>
                            <?php _e('Ежедневно с 8:00 до 21:00', 'flowerium'); ?>
                        </p>
                    </div>
                <?php endif; ?>

                <!-- Footer Widget 3 -->
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                <?php else : ?>
                    <div class="footer-widget">
                        <h4><?php _e('Меню', 'flowerium'); ?></h4>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'container'      => false,
                            'fallback_cb'    => false,
                            'depth'          => 1,
                        ));
                        ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('Все права защищены.', 'flowerium'); ?></p>
                <p><?php _e('Доставка цветов по Крыму: Симферополь, Ялта, Севастополь, Евпатория, Феодосия, Керчь', 'flowerium'); ?></p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
