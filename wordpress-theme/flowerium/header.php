<?php
/**
 * Theme header.
 *
 * @package Flowerium
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class('flowerium-page'); ?>>
<?php wp_body_open(); ?>
<header class="site-header" data-header>
    <a class="logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php esc_attr_e('Flowerium на главную', 'flowerium'); ?>">
        <?php
        $custom_logo_id = get_theme_mod('custom_logo');
        if ($custom_logo_id) :
            echo wp_get_attachment_image($custom_logo_id, 'full', false, ['class' => 'custom-logo', 'alt' => get_bloginfo('name')]);
        else :
            ?>
            <span>✿</span><?php bloginfo('name'); ?>
        <?php endif; ?>
    </a>
    <button class="menu-toggle" type="button" aria-label="<?php esc_attr_e('Открыть меню', 'flowerium'); ?>" aria-expanded="false" data-menu-toggle>
        <span></span><span></span><span></span>
    </button>
    <nav class="main-nav" data-nav aria-label="<?php esc_attr_e('Главное меню', 'flowerium'); ?>">
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'container' => false,
            'fallback_cb' => 'flowerium_default_menu',
            'items_wrap' => '%3$s',
            'depth' => 1,
        ]);
        ?>
    </nav>
    <a class="header-phone" href="tel:<?php echo flowerium_phone_href(); ?>"><?php echo flowerium_phone(); ?></a>
</header>
