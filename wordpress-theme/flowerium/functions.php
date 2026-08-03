<?php
/**
 * Flowerium theme functions.
 *
 * @package Flowerium
 */

if (!defined('ABSPATH')) {
    exit;
}

function flowerium_setup(): void
{
    load_theme_textdomain('flowerium', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height' => 80,
        'width' => 240,
        'flex-height' => true,
        'flex-width' => true,
    ]);
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('woocommerce');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    register_nav_menus([
        'primary' => __('Главное меню', 'flowerium'),
        'footer' => __('Меню в подвале', 'flowerium'),
    ]);
}
add_action('after_setup_theme', 'flowerium_setup');

function flowerium_assets(): void
{
    wp_enqueue_style('flowerium-fonts', 'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap', [], null);
    wp_enqueue_style('flowerium-theme', get_template_directory_uri() . '/assets/css/theme.css', [], '1.0.0');
    wp_enqueue_script('flowerium-theme', get_template_directory_uri() . '/assets/js/theme.js', [], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'flowerium_assets');

function flowerium_asset(string $path): string
{
    return esc_url(get_template_directory_uri() . '/assets/' . ltrim($path, '/'));
}

function flowerium_phone(): string
{
    return esc_html(get_theme_mod('flowerium_phone', '+7 999 000-00-00'));
}

function flowerium_phone_href(): string
{
    return esc_attr(get_theme_mod('flowerium_phone_href', '+79990000000'));
}

function flowerium_customize_register(WP_Customize_Manager $wp_customize): void
{
    $wp_customize->add_section('flowerium_contacts', [
        'title' => __('Контакты Flowerium', 'flowerium'),
        'priority' => 30,
    ]);

    $wp_customize->add_setting('flowerium_phone', [
        'default' => '+7 999 000-00-00',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('flowerium_phone', [
        'label' => __('Телефон в шапке', 'flowerium'),
        'section' => 'flowerium_contacts',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('flowerium_phone_href', [
        'default' => '+79990000000',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('flowerium_phone_href', [
        'label' => __('Телефон для ссылки tel:', 'flowerium'),
        'section' => 'flowerium_contacts',
        'type' => 'text',
    ]);
}
add_action('customize_register', 'flowerium_customize_register');

require get_template_directory() . '/inc/template-tags.php';
