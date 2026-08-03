<?php
/**
 * The header template
 *
 * @package Flowerium
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php _e('Skip to content', 'flowerium'); ?></a>

    <header class="site-header" data-header>
        <?php 
        // Custom Logo
        if (has_custom_logo()) {
            the_custom_logo();
        } else {
        ?>
            <a class="logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?>">
                <span>✿</span><?php bloginfo('name'); ?>
            </a>
        <?php } ?>

        <button class="menu-toggle" type="button" aria-label="<?php _e('Открыть меню', 'flowerium'); ?>" aria-expanded="false" data-menu-toggle>
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="main-nav" data-nav>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => '',
                'container'      => false,
                'depth'          => 2,
                'fallback_cb'    => 'flowerium_fallback_menu',
            ));
            ?>
        </nav>

        <?php 
        // Phone number from Customizer or default
        $phone = get_option('flowerium_phone', '+7 999 000-00-00');
        ?>
        <a class="header-phone" href="tel:<?php echo preg_replace('/[^0-9]/', '', $phone); ?>"><?php echo esc_html($phone); ?></a>

        <?php if (class_exists('WooCommerce')) : ?>
            <a class="header-cart" href="<?php echo wc_get_cart_url(); ?>" aria-label="<?php _e('Корзина', 'flowerium'); ?>">
                <span>🛒</span>
                <span class="header-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
            </a>
        <?php endif; ?>
    </header>
