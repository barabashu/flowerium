<?php
/**
 * The footer template for Flowerium Theme (Fixed)
 *
 * @package Flowerium Theme
 * @since 1.0.0
 */
?>

    <footer class="site-footer">
        <div>
            <?php 
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
            ?>
                <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
                    <span>✿</span><?php bloginfo('name'); ?>
                </a>
            <?php } ?>
            <p><?php bloginfo('description'); ?></p>
        </div>
        
        <div>
            <h3><?php _e('Навигация', 'flowerium-theme'); ?></h3>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_class'     => '',
                'container'      => false,
                'depth'          => 1,
                'fallback_cb'    => 'flowerium_fallback_footer_menu',
            ));
            ?>
        </div>
        
        <div>
            <h3><?php _e('Связь', 'flowerium-theme'); ?></h3>
            <?php 
            $phone = get_option('flowerium_phone', '+7 999 000-00-00');
            $email = get_option('flowerium_email', 'hello@flowerium.crimea');
            ?>
            <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $phone); ?>"><?php echo esc_html($phone); ?></a>
            <a href="mailto:<?php echo antispambot($email); ?>"><?php echo antispambot($email); ?></a>
            
            <?php if (is_active_sidebar('footer-widget')) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar('footer-widget'); ?>
                </div>
            <?php endif; ?>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
