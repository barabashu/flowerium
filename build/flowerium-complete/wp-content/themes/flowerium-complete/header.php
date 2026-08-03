<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php _e('Перейти к содержимому', 'flowerium-complete'); ?></a>

    <!-- Header Top -->
    <div class="header-top">
        <div class="container">
            <div class="header-contact">
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', flowerium_get_phone())); ?>">
                    <i class="fas fa-phone"></i>
                    <span><?php echo esc_html(flowerium_get_phone()); ?></span>
                </a>
                <a href="mailto:<?php echo esc_attr(flowerium_get_email()); ?>">
                    <i class="fas fa-envelope"></i>
                    <span><?php echo esc_html(flowerium_get_email()); ?></span>
                </a>
                <span><i class="fas fa-clock"></i> <?php echo esc_html(flowerium_get_hours()); ?></span>
            </div>
            <div class="header-meta">
                <span><i class="fas fa-map-marker-alt"></i> <?php echo esc_html(flowerium_get_address()); ?></span>
            </div>
        </div>
    </div>

    <!-- Header Main -->
    <header id="masthead" class="site-header">
        <div class="header-main">
            <div class="container">
                <!-- Logo -->
                <div class="site-logo">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <h1 style="font-family: var(--font-secondary); font-size: 2rem; color: var(--color-primary);">
                                <?php bloginfo('name'); ?>
                            </h1>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Primary Navigation -->
                <nav id="site-navigation" class="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'primary-menu-list',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ));
                    ?>
                </nav>

                <!-- Header Actions -->
                <div class="header-actions">
                    <!-- Cart Icon -->
                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-icon" data-cart-modal-toggle>
                        <i class="fas fa-shopping-bag"></i>
                        <span class="cart-count"><?php echo esc_html(WC()->cart ? WC()->cart->get_cart_contents_count() : 0); ?></span>
                    </a>
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="mobile-menu-toggle" aria-label="<?php esc_attr_e('Меню', 'flowerium-complete'); ?>">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </header>
