<?php
/**
 * Flowerium Theme Functions
 * 
 * @package Flowerium
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function flowerium_setup() {
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
        'primary' => __('Primary Menu', 'flowerium'),
        'footer'  => __('Footer Menu', 'flowerium'),
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

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    // WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'flowerium_setup');

/**
 * Set content width
 */
function flowerium_content_width() {
    $GLOBALS['content_width'] = apply_filters('flowerium_content_width', 1160);
}
add_action('after_setup_theme', 'flowerium_content_width', 0);

/**
 * Register widget areas
 */
function flowerium_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'flowerium'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'flowerium'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'flowerium'),
        'id'            => 'footer-widget',
        'description'   => __('Appears in the footer section of the site.', 'flowerium'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Shop Sidebar', 'flowerium'),
        'id'            => 'shop-sidebar',
        'description'   => __('Add widgets here to appear in your shop sidebar (filters, categories, etc.).', 'flowerium'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'flowerium_widgets_init');

/**
 * Enqueue scripts and styles
 */
function flowerium_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'flowerium-google-fonts',
        'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'flowerium-style',
        get_stylesheet_uri(),
        array('flowerium-google-fonts'),
        wp_get_theme()->get('Version')
    );

    // Theme JavaScript
    wp_enqueue_script(
        'flowerium-main',
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
add_action('wp_enqueue_scripts', 'flowerium_scripts');

/**
 * Custom excerpt length
 */
function flowerium_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'flowerium_excerpt_length');

/**
 * Custom excerpt more
 */
function flowerium_excerpt_more($more) {
    return '&hellip;';
}
add_filter('excerpt_more', 'flowerium_excerpt_more');

/**
 * Add body classes for specific templates
 */
function flowerium_body_classes($classes) {
    // Add class if sidebar is active
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    }

    // Add class for shop pages
    if (class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product())) {
        $classes[] = 'flowerium-shop';
    }

    return $classes;
}
add_filter('body_class', 'flowerium_body_classes');

/**
 * WooCommerce: Change columns in product loop
 */
function flowerium_loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'flowerium_loop_columns');

/**
 * WooCommerce: Remove default WooCommerce wrapper
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Add custom WooCommerce wrapper
 */
function flowerium_woocommerce_wrapper_before() {
    ?>
    <main id="primary" class="site-main">
        <div class="section">
    <?php
}
add_action('woocommerce_before_main_content', 'flowerium_woocommerce_wrapper_before');

function flowerium_woocommerce_wrapper_after() {
    ?>
        </div>
    </main>
    <?php
}
add_action('woocommerce_after_main_content', 'flowerium_woocommerce_wrapper_after');

/**
 * Customize WooCommerce breadcrumb
 */
function flowerium_woocommerce_breadcrumbs() {
    return array(
        'delimiter'   => ' &nbsp;/&nbsp; ',
        'wrap_before' => '<nav class="breadcrumb" aria-label="Breadcrumb">',
        'wrap_after'  => '</nav>',
        'before'      => '<span class="breadcrumb-item">',
        'after'       => '</span>',
        'home'        => _x('Home', 'breadcrumb', 'flowerium'),
    );
}
add_filter('woocommerce_breadcrumb_defaults', 'flowerium_woocommerce_breadcrumbs');

/**
 * Add custom fields to products (for delivery date, time, etc.)
 */
function flowerium_add_delivery_fields_to_cart() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    // This would be extended with actual delivery date/time fields
    // For now, it's a placeholder for future customization
}
add_action('woocommerce_cart_updated', 'flowerium_add_delivery_fields_to_cart');

/**
 * Register custom menu walker for primary navigation
 */
class Flowerium_Nav_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="sub-menu">';
        return $output;
    }
}

/**
 * Theme options page (basic)
 */
function flowerium_theme_options_menu() {
    add_theme_page(
        __('Theme Options', 'flowerium'),
        __('Theme Options', 'flowerium'),
        'manage_options',
        'flowerium-options',
        'flowerium_theme_options_page'
    );
}
add_action('admin_menu', 'flowerium_theme_options_menu');

function flowerium_theme_options_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p><?php _e('Welcome to Flowerium theme settings.', 'flowerium'); ?></p>
        
        <h2><?php _e('Quick Links', 'flowerium'); ?></h2>
        <ul>
            <li><a href="<?php echo admin_url('customize.php'); ?>"><?php _e('Customize Theme', 'flowerium'); ?></a></li>
            <li><a href="<?php echo admin_url('edit.php?post_type=product'); ?>"><?php _e('Manage Products', 'flowerium'); ?></a></li>
            <li><a href="<?php echo admin_url('woocommerce'); ?>"><?php _e('WooCommerce Settings', 'flowerium'); ?></a></li>
            <li><a href="<?php echo admin_url('widgets.php'); ?>"><?php _e('Manage Widgets', 'flowerium'); ?></a></li>
            <li><a href="<?php echo admin_url('nav-menus.php'); ?>"><?php _e('Manage Menus', 'flowerium'); ?></a></li>
        </ul>
    </div>
    <?php
}

/**
 * Initialize theme defaults on activation
 */
function flowerium_activation() {
    // Set default options
    update_option('flowerium_version', '1.0.0');
    
    // Flush rewrite rules
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'flowerium_activation');

/**
 * Deactivation cleanup
 */
function flowerium_deactivation() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'flowerium_deactivation');
