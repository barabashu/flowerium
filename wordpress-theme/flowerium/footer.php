<?php
/**
 * Theme footer.
 *
 * @package Flowerium
 */
?>
<footer class="site-footer">
    <div>
        <a class="logo" href="<?php echo esc_url(home_url('/')); ?>"><span>✿</span><?php bloginfo('name'); ?></a>
        <p><?php bloginfo('description'); ?></p>
    </div>
    <div>
        <h3><?php esc_html_e('Навигация', 'flowerium'); ?></h3>
        <?php
        wp_nav_menu([
            'theme_location' => 'footer',
            'container' => false,
            'fallback_cb' => 'flowerium_default_footer_menu',
            'items_wrap' => '%3$s',
            'depth' => 1,
        ]);
        ?>
    </div>
    <div>
        <h3><?php esc_html_e('Связь', 'flowerium'); ?></h3>
        <a href="tel:<?php echo flowerium_phone_href(); ?>"><?php echo flowerium_phone(); ?></a>
        <a href="mailto:hello@flowerium.example">hello@flowerium.example</a>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
