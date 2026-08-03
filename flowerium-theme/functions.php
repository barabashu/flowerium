<?php
/**
 * Flowerium Theme Functions
 *
 * @package Flowerium
 */

// Prevent direct access
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

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');
    
    // Set custom thumbnail sizes
    add_image_size('flowerium-product', 600, 600, true);
    add_image_size('flowerium-hero', 1920, 800, true);
    add_image_size('flowerium-thumbnail', 400, 300, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'flowerium'),
        'footer'  => __('Footer Menu', 'flowerium'),
    ));

    // Switch default core markup for search form, comment form, and comments
    // to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add support for custom background
    add_theme_support('custom-background');

    // Add support for custom header
    add_theme_support('custom-header', array(
        'default-image'      => '',
        'default-text-color' => '000000',
        'width'              => 1920,
        'height'             => 400,
        'flex-width'         => true,
        'flex-height'        => true,
    ));

    // WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'flowerium_setup');

/**
 * Set the content width in pixels
 */
function flowerium_content_width() {
    $GLOBALS['content_width'] = apply_filters('flowerium_content_width', 1200);
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
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget 1', 'flowerium'),
        'id'            => 'footer-1',
        'description'   => __('Appears in the footer section 1.', 'flowerium'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget 2', 'flowerium'),
        'id'            => 'footer-2',
        'description'   => __('Appears in the footer section 2.', 'flowerium'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget 3', 'flowerium'),
        'id'            => 'footer-3',
        'description'   => __('Appears in the footer section 3.', 'flowerium'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'flowerium_widgets_init');

/**
 * Enqueue scripts and styles
 */
function flowerium_scripts() {
    // Main stylesheet
    wp_enqueue_style('flowerium-style', get_stylesheet_uri(), array(), '1.0.0');

    // Google Fonts (optional - you can customize)
    wp_enqueue_style('flowerium-google-fonts', 'https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;500;600;700&display=swap', array(), null);

    // Theme JavaScript
    wp_enqueue_script('flowerium-scripts', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);

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
    return '...';
}
add_filter('excerpt_more', 'flowerium_excerpt_more');

/**
 * Add custom body classes
 */
function flowerium_body_classes($classes) {
    // Add a class of group-blog to blogs with more than 1 published author
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    // Add a class of no-sidebar when there is no sidebar present
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'flowerium_body_classes');

/**
 * WooCommerce Customizations
 */

// Change number of products per page
add_filter('loop_shop_per_page', function($cols) {
    return 12;
});

// Change number of columns in product grid
add_filter('loop_shop_columns', function($columns) {
    return 4;
});

// Remove WooCommerce default styles (we use our own)
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// Custom add to cart button text
add_filter('woocommerce_product_add_to_cart_text', function($text) {
    return __('В корзину', 'flowerium');
});

// Custom cart link text
add_filter('woocommerce_add_to_cart_fragments', 'flowerium_cart_link_fragment');
function flowerium_cart_link_fragment($fragments) {
    ob_start();
    ?>
    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    <?php
    $fragments['.cart-count'] = ob_get_clean();
    return $fragments;
}

// Customize checkout fields
add_filter('woocommerce_checkout_fields', 'flowerium_custom_checkout_fields');
function flowerium_custom_checkout_fields($fields) {
    // Add delivery city dropdown
    $fields['billing']['billing_delivery_city'] = array(
        'type'     => 'select',
        'label'    => __('Город доставки', 'flowerium'),
        'options'  => array(
            'simferopol' => __('Симферополь', 'flowerium'),
            'yalta'      => __('Ялта', 'flowerium'),
            'sevastopol' => __('Севастополь', 'flowerium'),
            'evpatoria'  => __('Евпатория', 'flowerium'),
            'feodosia'   => __('Феодосия', 'flowerium'),
            'kerch'      => __('Керчь', 'flowerium'),
        ),
        'priority' => 15,
        'required' => true,
    );

    // Add delivery time
    $fields['order']['order_delivery_time'] = array(
        'type'     => 'select',
        'label'    => __('Время доставки', 'flowerium'),
        'options'  => array(
            'morning'    => __('Утро (9:00 - 12:00)', 'flowerium'),
            'afternoon'  => __('День (12:00 - 17:00)', 'flowerium'),
            'evening'    => __('Вечер (17:00 - 21:00)', 'flowerium'),
            'anytime'    => __('Любое время', 'flowerium'),
        ),
        'priority' => 10,
        'required' => true,
    );

    return $fields;
}

// Save custom checkout fields to order meta
add_action('woocommerce_checkout_update_order_meta', 'flowerium_save_custom_checkout_fields');
function flowerium_save_custom_checkout_fields($order_id) {
    if (!empty($_POST['billing_delivery_city'])) {
        update_post_meta($order_id, 'billing_delivery_city', sanitize_text_field($_POST['billing_delivery_city']));
    }
    if (!empty($_POST['order_delivery_time'])) {
        update_post_meta($order_id, 'order_delivery_time', sanitize_text_field($_POST['order_delivery_time']));
    }
}

// Display custom fields in order details
add_action('woocommerce_order_details_after_order_table', 'flowerium_display_order_delivery_info');
function flowerium_display_order_delivery_info($order) {
    $city = get_post_meta($order->get_id(), 'billing_delivery_city', true);
    $time = get_post_meta($order->get_id(), 'order_delivery_time', true);
    
    if ($city || $time) {
        echo '<h3>' . __('Информация о доставке', 'flowerium') . '</h3>';
        echo '<p><strong>' . __('Город:', 'flowerium') . '</strong> ' . esc_html($city) . '</p>';
        echo '<p><strong>' . __('Время:', 'flowerium') . '</strong> ' . esc_html($time) . '</p>';
    }
}

/**
 * Custom breadcrumb for WooCommerce
 */
add_filter('woocommerce_breadcrumb_defaults', 'flowerium_woocommerce_breadcrumbs');
function flowerium_woocommerce_breadcrumbs() {
    return array(
        'delimiter'   => ' &raquo; ',
        'wrap_before' => '<nav class="woocommerce-breadcrumb" aria-label="Хлебные крошки">',
        'wrap_after'  => '</nav>',
        'before'      => '<span class="breadcrumb-item">',
        'after'       => '</span>',
        'home'        => _x('Главная', 'breadcrumb', 'flowerium'),
    );
}

/**
 * Register custom post type for bouquets (optional)
 */
function flowerium_register_bouquet_post_type() {
    $labels = array(
        'name'               => __('Букеты', 'flowerium'),
        'singular_name'      => __('Букет', 'flowerium'),
        'menu_name'          => __('Букеты', 'flowerium'),
        'add_new'            => __('Добавить новый', 'flowerium'),
        'add_new_item'       => __('Добавить новый букет', 'flowerium'),
        'edit_item'          => __('Редактировать букет', 'flowerium'),
        'new_item'           => __('Новый букет', 'flowerium'),
        'view_item'          => __('Просмотреть букет', 'flowerium'),
        'search_items'       => __('Искать букеты', 'flowerium'),
        'not_found'          => __('Букеты не найдены', 'flowerium'),
        'not_found_in_trash' => __('В корзине букеты не найдены', 'flowerium'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'bouquets'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-florist',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('bouquet', $args);
}
// Uncomment to enable custom post type
// add_action('init', 'flowerium_register_bouquet_post_type');

/**
 * Add custom admin notice for WooCommerce setup
 */
add_action('admin_notices', 'flowerium_woocommerce_setup_notice');
function flowerium_woocommerce_setup_notice() {
    if (!class_exists('WooCommerce')) {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><?php _e('Для полноценной работы магазина необходимо установить и активировать плагин WooCommerce.', 'flowerium'); ?></p>
        </div>
        <?php
    }
}
