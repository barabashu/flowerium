<?php
/**
 * Flowerium Shop Theme Functions
 * 
 * @package Flowerium_Shop
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function flowerium_shop_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(400, 300, true);
    add_image_size('product-thumb', 600, 450, true);
    add_image_size('hero-image', 1200, 600, true);
    add_image_size('category-thumb', 400, 300, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Главное меню', 'flowerium-shop'),
        'footer'  => __('Меню в подвале', 'flowerium-shop'),
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

    // WooCommerce support - REQUIRED for shop functionality
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // WooCommerce product catalog settings
    add_theme_support('wc-product-gallery-thumbnail-columns', 4);
}
add_action('after_setup_theme', 'flowerium_shop_setup');

/**
 * Set content width
 */
function flowerium_shop_content_width() {
    $GLOBALS['content_width'] = apply_filters('flowerium_shop_content_width', 1160);
}
add_action('after_setup_theme', 'flowerium_shop_content_width', 0);

/**
 * Register widget areas
 */
function flowerium_shop_widgets_init() {
    register_sidebar(array(
        'name'          => __('Боковая панель', 'flowerium-shop'),
        'id'            => 'sidebar-1',
        'description'   => __('Добавьте виджеты здесь для отображения в боковой панели.', 'flowerium-shop'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Виджеты в подвале', 'flowerium-shop'),
        'id'            => 'footer-widget',
        'description'   => __('Отображается в нижней части сайта.', 'flowerium-shop'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Боковая панель магазина', 'flowerium-shop'),
        'id'            => 'shop-sidebar',
        'description'   => __('Фильтры, категории и другие виджеты для магазина.', 'flowerium-shop'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'flowerium_shop_widgets_init');

/**
 * Enqueue scripts and styles
 */
function flowerium_shop_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'flowerium-shop-google-fonts',
        'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'flowerium-shop-style',
        get_stylesheet_uri(),
        array('flowerium-shop-google-fonts'),
        wp_get_theme()->get('Version')
    );

    // Theme JavaScript
    wp_enqueue_script(
        'flowerium-shop-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    // WooCommerce cart fragments refresh
    if (class_exists('WooCommerce')) {
        wp_enqueue_script('wc-cart-fragments');
        wp_enqueue_script('wc-add-to-cart-variation');
    }
}
add_action('wp_enqueue_scripts', 'flowerium_shop_scripts');

/**
 * Custom excerpt length
 */
function flowerium_shop_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'flowerium_shop_excerpt_length');

/**
 * Custom excerpt more
 */
function flowerium_shop_excerpt_more($more) {
    return '&hellip;';
}
add_filter('excerpt_more', 'flowerium_shop_excerpt_more');

/**
 * Add body classes for specific templates
 */
function flowerium_shop_body_classes($classes) {
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
add_filter('body_class', 'flowerium_shop_body_classes');

/**
 * WooCommerce: Change columns in product loop
 */
function flowerium_shop_loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'flowerium_shop_loop_columns');

/**
 * WooCommerce: Remove default WooCommerce wrapper
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Add custom WooCommerce wrapper
 */
function flowerium_shop_woocommerce_wrapper_before() {
    ?>
    <main id="primary" class="site-main">
        <div class="section">
    <?php
}
add_action('woocommerce_before_main_content', 'flowerium_shop_woocommerce_wrapper_before');

function flowerium_shop_woocommerce_wrapper_after() {
    ?>
        </div>
    </main>
    <?php
}
add_action('woocommerce_after_main_content', 'flowerium_shop_woocommerce_wrapper_after');

/**
 * Customize WooCommerce breadcrumb
 */
function flowerium_shop_woocommerce_breadcrumbs() {
    return array(
        'delimiter'   => ' &nbsp;/&nbsp; ',
        'wrap_before' => '<nav class="breadcrumb" aria-label="Хлебные крошки">',
        'wrap_after'  => '</nav>',
        'before'      => '<span class="breadcrumb-item">',
        'after'       => '</span>',
        'home'        => _x('Главная', 'breadcrumb', 'flowerium-shop'),
    );
}
add_filter('woocommerce_breadcrumb_defaults', 'flowerium_shop_woocommerce_breadcrumbs');

/**
 * WooCommerce: Update cart fragments for AJAX cart
 */
function flowerium_shop_cart_link_fragment($fragments) {
    ob_start();
    ?>
    <a class="header-cart" href="<?php echo esc_url(wc_get_cart_url()); ?>" aria-label="<?php _e('Корзина', 'flowerium-shop'); ?>">
        <span>🛒</span>
        <span class="header-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    </a>
    <?php
    $fragments['a.header-cart'] = ob_get_clean();
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'flowerium_shop_cart_link_fragment');

/**
 * WooCommerce: Custom add to cart button text
 */
function flowerium_shop_add_to_cart_text() {
    return __('В корзину', 'flowerium-shop');
}
add_filter('woocommerce_product_add_to_cart_text', 'flowerium_shop_add_to_cart_text');

/**
 * WooCommerce: Custom product thumbnail size
 */
function flowerium_shop_change_product_thumbnail_size() {
    return 'product-thumb';
}
add_filter('single_product_archive_thumbnail_size', 'flowerium_shop_change_product_thumbnail_size');

/**
 * Checkout fields customization
 */
function flowerium_shop_checkout_fields($fields) {
    // Add delivery date field
    $fields['order']['delivery_date'] = array(
        'label'       => __('Дата доставки', 'flowerium-shop'),
        'placeholder' => __('Выберите дату', 'flowerium-shop'),
        'required'    => false,
        'class'       => array('form-row-wide'),
        'clear'       => true,
        'type'        => 'date',
    );
    
    // Add delivery time field
    $fields['order']['delivery_time'] = array(
        'label'       => __('Время доставки', 'flowerium-shop'),
        'placeholder' => __('Удобное время', 'flowerium-shop'),
        'required'    => false,
        'class'       => array('form-row-wide'),
        'clear'       => true,
        'type'        => 'select',
        'options'     => array(
            'morning'    => __('Утро (9:00-12:00)', 'flowerium-shop'),
            'afternoon'  => __('День (12:00-17:00)', 'flowerium-shop'),
            'evening'    => __('Вечер (17:00-21:00)', 'flowerium-shop'),
        ),
    );
    
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'flowerium_shop_checkout_fields');

/**
 * Save delivery fields to order meta
 */
function flowerium_shop_save_delivery_fields($order_id) {
    if (!empty($_POST['delivery_date'])) {
        update_post_meta($order_id, 'delivery_date', sanitize_text_field($_POST['delivery_date']));
    }
    if (!empty($_POST['delivery_time'])) {
        update_post_meta($order_id, 'delivery_time', sanitize_text_field($_POST['delivery_time']));
    }
}
add_action('woocommerce_checkout_update_order_meta', 'flowerium_shop_save_delivery_fields');

/**
 * Display delivery info in admin order
 */
function flowerium_shop_display_delivery_info($order) {
    $delivery_date = get_post_meta($order->get_id(), 'delivery_date', true);
    $delivery_time = get_post_meta($order->get_id(), 'delivery_time', true);
    
    if ($delivery_date || $delivery_time) {
        echo '<p><strong>' . __('Доставка:', 'flowerium-shop') . '</strong> ';
        if ($delivery_date) {
            echo esc_html(date_i18n(get_option('date_format'), strtotime($delivery_date)));
        }
        if ($delivery_time) {
            $time_labels = array(
                'morning'   => __('Утро (9:00-12:00)', 'flowerium-shop'),
                'afternoon' => __('День (12:00-17:00)', 'flowerium-shop'),
                'evening'   => __('Вечер (17:00-21:00)', 'flowerium-shop'),
            );
            echo ' ' . ($time_labels[$delivery_time] ?? '');
        }
        echo '</p>';
    }
}
add_action('woocommerce_admin_order_data_after_shipping_address', 'flowerium_shop_display_delivery_info');

/**
 * Register custom menu walker
 */
class Flowerium_Shop_Nav_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="sub-menu">';
        return $output;
    }
}

/**
 * Theme options page
 */
function flowerium_shop_theme_options_menu() {
    add_theme_page(
        __('Настройки темы', 'flowerium-shop'),
        __('Настройки темы', 'flowerium-shop'),
        'manage_options',
        'flowerium-shop-options',
        'flowerium_shop_theme_options_page'
    );
}
add_action('admin_menu', 'flowerium_shop_theme_options_menu');

function flowerium_shop_theme_options_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p><?php _e('Добро пожаловать в настройки темы Flowerium Shop.', 'flowerium-shop'); ?></p>
        
        <h2><?php _e('Быстрые ссылки', 'flowerium-shop'); ?></h2>
        <ul>
            <li><a href="<?php echo admin_url('customize.php'); ?>"><?php _e('Настроить тему', 'flowerium-shop'); ?></a></li>
            <li><a href="<?php echo admin_url('edit.php?post_type=product'); ?>"><?php _e('Управление товарами', 'flowerium-shop'); ?></a></li>
            <li><a href="<?php echo admin_url('admin.php?page=wc-settings'); ?>"><?php _e('Настройки WooCommerce', 'flowerium-shop'); ?></a></li>
            <li><a href="<?php echo admin_url('widgets.php'); ?>"><?php _e('Управление виджетами', 'flowerium-shop'); ?></a></li>
            <li><a href="<?php echo admin_url('nav-menus.php'); ?>"><?php _e('Управление меню', 'flowerium-shop'); ?></a></li>
        </ul>
        
        <h2><?php _e('Контактная информация', 'flowerium-shop'); ?></h2>
        <p><?php _e('Для изменения телефона и email используйте:', 'flowerium-shop'); ?></p>
        <ul>
            <li><?php _e('Внешний вид → Настроить → Свойства сайта', 'flowerium-shop'); ?></li>
            <li><?php _e('Или установите плагин Contact Form 7 для форм', 'flowerium-shop'); ?></li>
        </ul>
    </div>
    <?php
}

/**
 * Initialize theme defaults on activation
 */
function flowerium_shop_activation() {
    // Set default options
    update_option('flowerium_shop_version', '1.0.0');
    
    // Flush rewrite rules
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'flowerium_shop_activation');

/**
 * Deactivation cleanup
 */
function flowerium_shop_deactivation() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'flowerium_shop_deactivation');
