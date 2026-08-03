<?php
/**
 * Flowerium Theme (Fixed) Functions
 * 
 * This theme is based on the existing HTML/CSS structure from the original project.
 * It maintains the original design while adding WordPress functionality.
 * 
 * @package Flowerium Theme
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function flowerium_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(400, 300, true);
    add_image_size('product-thumb', 600, 450, true);
    add_image_size('hero-image', 1200, 600, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'flowerium-theme'),
        'footer'  => __('Footer Menu', 'flowerium-theme'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add support for custom background
    add_theme_support('custom-background');

    // Add support for Block Editor styles
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    // WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'flowerium_theme_setup');

/**
 * Set content width
 */
function flowerium_theme_content_width() {
    $GLOBALS['content_width'] = apply_filters('flowerium_theme_content_width', 1160);
}
add_action('after_setup_theme', 'flowerium_theme_content_width', 0);

/**
 * Register widget areas
 */
function flowerium_theme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'flowerium-theme'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'flowerium-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'flowerium-theme'),
        'id'            => 'footer-widget',
        'description'   => __('Appears in the footer section of the site.', 'flowerium-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Shop Sidebar', 'flowerium-theme'),
        'id'            => 'shop-sidebar',
        'description'   => __('Add widgets here to appear in your shop sidebar (filters, categories, etc.).', 'flowerium-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'flowerium_theme_widgets_init');

/**
 * Enqueue scripts and styles
 */
function flowerium_theme_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'flowerium-theme-google-fonts',
        'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Main stylesheet - this imports the original styles.css
    wp_enqueue_style(
        'flowerium-theme-style',
        get_stylesheet_uri(),
        array('flowerium-theme-google-fonts'),
        wp_get_theme()->get('Version')
    );

    // Theme JavaScript
    wp_enqueue_script(
        'flowerium-theme-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'flowerium_theme_scripts');

/**
 * Fallback menu functions
 */
function flowerium_fallback_menu() {
    echo '<ul>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . __('Главная', 'flowerium-theme') . '</a></li>';
    
    // Try to get pages
    $pages = get_pages(array('number' => 5));
    foreach ($pages as $page) {
        echo '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($page->post_title) . '</a></li>';
    }
    
    echo '</ul>';
}

function flowerium_fallback_footer_menu() {
    flowerium_fallback_menu();
}

/**
 * Add body classes
 */
function flowerium_theme_body_classes($classes) {
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    }

    if (class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product())) {
        $classes[] = 'flowerium-shop';
    }

    return $classes;
}
add_filter('body_class', 'flowerium_theme_body_classes');

/**
 * WooCommerce: Change columns in product loop
 */
function flowerium_theme_loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'flowerium_theme_loop_columns');

/**
 * Custom excerpt length
 */
function flowerium_theme_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'flowerium_theme_excerpt_length');

/**
 * Custom excerpt more
 */
function flowerium_theme_excerpt_more($more) {
    return '&hellip;';
}
add_filter('excerpt_more', 'flowerium_theme_excerpt_more');

/**
 * Theme activation
 */
function flowerium_theme_activation() {
    update_option('flowerium_theme_version', '1.0.0');
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'flowerium_theme_activation');

/**
 * Theme deactivation
 */
function flowerium_theme_deactivation() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'flowerium_theme_deactivation');
