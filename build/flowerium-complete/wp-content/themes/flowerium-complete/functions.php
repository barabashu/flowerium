<?php
/**
 * Flowerium Complete Theme Functions
 * 
 * @package Flowerium_Complete
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Constants
 */
define('FLOWERIUM_VERSION', '1.0.0');
define('FLOWERIUM_DIR', get_template_directory());
define('FLOWERIUM_URI', get_template_directory_uri());

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
    
    // Custom image sizes
    add_image_size('flowerium-product', 600, 600, true);
    add_image_size('flowerium-hero', 1920, 800, true);
    add_image_size('flowerium-thumbnail', 400, 300, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary'   => __('Главное меню', 'flowerium-complete'),
        'footer'    => __('Меню в подвале', 'flowerium-complete'),
        'mobile'    => __('Мобильное меню', 'flowerium-complete'),
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
        'height'      => 120,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add support for custom background
    add_theme_support('custom-background');

    // Add support for custom header
    add_theme_support('custom-header', array(
        'default-image' => '',
        'width'         => 1920,
        'height'        => 800,
        'flex-height'   => true,
        'flex-width'    => true,
    ));

    // Add support for WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Add support for Block Editor styles
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    // Custom editor color palette
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => __('Основной', 'flowerium-complete'),
            'slug'  => 'primary',
            'color' => '#d4a574',
        ),
        array(
            'name'  => __('Вторичный', 'flowerium-complete'),
            'slug'  => 'secondary',
            'color' => '#f8f5f2',
        ),
        array(
            'name'  => __('Текст', 'flowerium-complete'),
            'slug'  => 'text',
            'color' => '#2c2c2c',
        ),
        array(
            'name'  => __('Белый', 'flowerium-complete'),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
    ));
}
add_action('after_setup_theme', 'flowerium_setup');

/**
 * Enqueue scripts and styles
 */
function flowerium_scripts() {
    // Google Fonts
    wp_enqueue_style('flowerium-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap', array(), null);
    
    // Main stylesheet
    wp_enqueue_style('flowerium-style', get_stylesheet_uri(), array(), FLOWERIUM_VERSION);
    
    // Font Awesome (CDN)
    wp_enqueue_style('flowerium-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    // Main JavaScript
    wp_enqueue_script('flowerium-main', FLOWERIUM_URI . '/assets/js/main.js', array('jquery'), FLOWERIUM_VERSION, true);
    
    // AJAX Cart JavaScript
    wp_enqueue_script('flowerium-cart', FLOWERIUM_URI . '/assets/js/cart-ajax.js', array('jquery', 'wc-cart-fragments'), FLOWERIUM_VERSION, true);
    
    // Localize script with AJAX URL
    wp_localize_script('flowerium-cart', 'flowerium_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('flowerium_cart_nonce'),
        'cart_url' => wc_get_cart_url(),
        'checkout_url' => wc_get_checkout_url(),
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'flowerium_scripts');

/**
 * Register widget areas
 */
function flowerium_widgets_init() {
    register_sidebar(array(
        'name'          => __('Боковая панель', 'flowerium-complete'),
        'id'            => 'sidebar-1',
        'description'   => __('Добавьте виджеты для отображения в боковой панели.', 'flowerium-complete'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Подвал - Колонка 1', 'flowerium-complete'),
        'id'            => 'footer-1',
        'description'   => __('Первая колонка в подвале.', 'flowerium-complete'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Подвал - Колонка 2', 'flowerium-complete'),
        'id'            => 'footer-2',
        'description'   => __('Вторая колонка в подвале.', 'flowerium-complete'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Подвал - Колонка 3', 'flowerium-complete'),
        'id'            => 'footer-3',
        'description'   => __('Третья колонка в подвале.', 'flowerium-complete'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Подвал - Колонка 4', 'flowerium-complete'),
        'id'            => 'footer-4',
        'description'   => __('Четвертая колонка в подвале.', 'flowerium-complete'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'flowerium_widgets_init');

/**
 * WooCommerce: Change number of products per page
 */
function flowerium_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'flowerium_products_per_page');

/**
 * WooCommerce: Change columns in product loop
 */
function flowerium_loop_columns() {
    return 4;
}
add_filter('loop_shop_columns', 'flowerium_loop_columns');

/**
 * WooCommerce: Remove default wrapper
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Add custom WooCommerce wrapper
 */
function flowerium_woocommerce_wrapper_before() {
    echo '<main id="primary" class="site-main">';
}
add_action('woocommerce_before_main_content', 'flowerium_woocommerce_wrapper_before');

function flowerium_woocommerce_wrapper_after() {
    echo '</main>';
}
add_action('woocommerce_after_main_content', 'flowerium_woocommerce_wrapper_after');

/**
 * AJAX: Add to cart
 */
function flowerium_ajax_add_to_cart() {
    check_ajax_referer('flowerium_cart_nonce', 'nonce');

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $variation_id = isset($_POST['variation_id']) ? absint($_POST['variation_id']) : 0;
    $variations = isset($_POST['variations']) ? $_POST['variations'] : array();

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variations)) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        
        ob_start();
        include FLOWERIUM_DIR . '/template-parts/cart-mini.php';
        $cart_html = ob_get_clean();

        wp_send_json_success(array(
            'message' => __('Товар добавлен в корзину', 'flowerium-complete'),
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_total' => WC()->cart->get_cart_total(),
            'cart_html' => $cart_html,
        ));
    } else {
        wp_send_json_error(array(
            'message' => __('Ошибка добавления товара', 'flowerium-complete'),
        ));
    }
}
add_action('wp_ajax_flowerium_add_to_cart', 'flowerium_ajax_add_to_cart');
add_action('wp_ajax_nopriv_flowerium_add_to_cart', 'flowerium_ajax_add_to_cart');

/**
 * AJAX: Update cart item quantity
 */
function flowerium_ajax_update_cart() {
    check_ajax_referer('flowerium_cart_nonce', 'nonce');

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = absint($_POST['quantity']);

    if ($quantity > 0) {
        WC()->cart->set_quantity($cart_item_key, $quantity);
        $message = __('Количество обновлено', 'flowerium-complete');
    } else {
        WC()->cart->remove_cart_item($cart_item_key);
        $message = __('Товар удален из корзины', 'flowerium-complete');
    }

    ob_start();
    include FLOWERIUM_DIR . '/template-parts/cart-mini.php';
    $cart_html = ob_get_clean();

    wp_send_json_success(array(
        'message' => $message,
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => WC()->cart->get_cart_total(),
        'cart_html' => $cart_html,
    ));
}
add_action('wp_ajax_flowerium_update_cart', 'flowerium_ajax_update_cart');
add_action('wp_ajax_nopriv_flowerium_update_cart', 'flowerium_ajax_update_cart');

/**
 * AJAX: Remove cart item
 */
function flowerium_ajax_remove_from_cart() {
    check_ajax_referer('flowerium_cart_nonce', 'nonce');

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);

    if (WC()->cart->remove_cart_item($cart_item_key)) {
        ob_start();
        include FLOWERIUM_DIR . '/template-parts/cart-mini.php';
        $cart_html = ob_get_clean();

        wp_send_json_success(array(
            'message' => __('Товар удален', 'flowerium-complete'),
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_total' => WC()->cart->get_cart_total(),
            'cart_html' => $cart_html,
        ));
    } else {
        wp_send_json_error(array(
            'message' => __('Ошибка удаления', 'flowerium-complete'),
        ));
    }
}
add_action('wp_ajax_flowerium_remove_from_cart', 'flowerium_ajax_remove_from_cart');
add_action('wp_ajax_nopriv_flowerium_remove_from_cart', 'flowerium_ajax_remove_from_cart');

/**
 * Customizer: Theme Options
 */
function flowerium_customize_register($wp_customize) {
    // Contact Settings Section
    $wp_customize->add_section('flowerium_contacts', array(
        'title'    => __('Контакты', 'flowerium-complete'),
        'priority' => 30,
    ));

    // Phone
    $wp_customize->add_setting('flowerium_phone', array(
        'default'           => '+7 (999) 000-00-00',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('flowerium_phone', array(
        'label'   => __('Телефон', 'flowerium-complete'),
        'section' => 'flowerium_contacts',
        'type'    => 'text',
    ));

    // Email
    $wp_customize->add_setting('flowerium_email', array(
        'default'           => 'info@flowerium.ru',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('flowerium_email', array(
        'label'   => __('Email', 'flowerium-complete'),
        'section' => 'flowerium_contacts',
        'type'    => 'email',
    ));

    // Address
    $wp_customize->add_setting('flowerium_address', array(
        'default'           => 'г. Симферополь, ул. Примерная, 1',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('flowerium_address', array(
        'label'   => __('Адрес', 'flowerium-complete'),
        'section' => 'flowerium_contacts',
        'type'    => 'textarea',
    ));

    // Working Hours
    $wp_customize->add_setting('flowerium_hours', array(
        'default'           => 'Ежедневно с 9:00 до 21:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('flowerium_hours', array(
        'label'   => __('Режим работы', 'flowerium-complete'),
        'section' => 'flowerium_contacts',
        'type'    => 'text',
    ));

    // Social Links Section
    $wp_customize->add_section('flowerium_social', array(
        'title'    => __('Социальные сети', 'flowerium-complete'),
        'priority' => 31,
    ));

    // Instagram
    $wp_customize->add_setting('flowerium_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('flowerium_instagram', array(
        'label'   => __('Instagram', 'flowerium-complete'),
        'section' => 'flowerium_social',
        'type'    => 'url',
    ));

    // VKontakte
    $wp_customize->add_setting('flowerium_vk', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('flowerium_vk', array(
        'label'   => __('ВКонтакте', 'flowerium-complete'),
        'section' => 'flowerium_social',
        'type'    => 'url',
    ));

    // Telegram
    $wp_customize->add_setting('flowerium_telegram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('flowerium_telegram', array(
        'label'   => __('Telegram', 'flowerium-complete'),
        'section' => 'flowerium_social',
        'type'    => 'url',
    ));

    // WhatsApp
    $wp_customize->add_setting('flowerium_whatsapp', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('flowerium_whatsapp', array(
        'label'   => __('WhatsApp номер', 'flowerium-complete'),
        'section' => 'flowerium_social',
        'type'    => 'text',
    ));
}
add_action('customize_register', 'flowerium_customize_register');

/**
 * Helper: Get contact info
 */
function flowerium_get_phone() {
    return get_theme_mod('flowerium_phone', '+7 (999) 000-00-00');
}

function flowerium_get_email() {
    return get_theme_mod('flowerium_email', 'info@flowerium.ru');
}

function flowerium_get_address() {
    return get_theme_mod('flowerium_address', 'г. Симферополь, ул. Примерная, 1');
}

function flowerium_get_hours() {
    return get_theme_mod('flowerium_hours', 'Ежедневно с 9:00 до 21:00');
}

function flowerium_get_instagram() {
    return get_theme_mod('flowerium_instagram', '');
}

function flowerium_get_vk() {
    return get_theme_mod('flowerium_vk', '');
}

function flowerium_get_telegram() {
    return get_theme_mod('flowerium_telegram', '');
}

function flowerium_get_whatsapp() {
    return get_theme_mod('flowerium_whatsapp', '');
}

/**
 * Add body classes
 */
function flowerium_body_classes($classes) {
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    if (is_front_page()) {
        $classes[] = 'front-page';
    }

    if (is_woocommerce()) {
        $classes[] = 'woocommerce-page';
    }

    return $classes;
}
add_filter('body_class', 'flowerium_body_classes');

/**
 * Add pingback header
 */
function flowerium_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'flowerium_pingback_header');

/**
 * Preload key resources
 */
function flowerium_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'flowerium_resource_hints', 10, 2);

/**
 * Excerpt length
 */
function flowerium_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'flowerium_excerpt_length');

/**
 * Excerpt more
 */
function flowerium_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'flowerium_excerpt_more');

/**
 * Custom excerpt for products
 */
function flowerium_product_short_description($limit = 15) {
    $description = get_the_excerpt();
    $words = explode(' ', $description, $limit + 1);
    if (count($words) > $limit) {
        array_pop($words);
        array_push($words, '…');
        $description = implode(' ', $words);
    }
    return $description;
}

/**
 * Delivery time slots for checkout
 */
function flowerium_delivery_time_slots() {
    $slots = array(
        'morning' => array(
            'label' => 'Утро (9:00 - 12:00)',
            'time'  => '09:00-12:00',
        ),
        'day' => array(
            'label' => 'День (12:00 - 16:00)',
            'time'  => '12:00-16:00',
        ),
        'evening' => array(
            'label' => 'Вечер (16:00 - 20:00)',
            'time'  => '16:00-20:00',
        ),
    );
    return apply_filters('flowerium_delivery_slots', $slots);
}

/**
 * Save delivery time to order meta
 */
function flowerium_checkout_field_save($order_id) {
    if (!empty($_POST['flowerium_delivery_date'])) {
        update_post_meta($order_id, '_flowerium_delivery_date', sanitize_text_field($_POST['flowerium_delivery_date']));
    }
    if (!empty($_POST['flowerium_delivery_time'])) {
        update_post_meta($order_id, '_flowerium_delivery_time', sanitize_text_field($_POST['flowerium_delivery_time']));
    }
}
add_action('woocommerce_checkout_update_order_meta', 'flowerium_checkout_field_save');

/**
 * Display delivery info in order details
 */
function flowerium_order_delivery_details($order) {
    $delivery_date = get_post_meta($order->get_id(), '_flowerium_delivery_date', true);
    $delivery_time = get_post_meta($order->get_id(), '_flowerium_delivery_time', true);
    
    if ($delivery_date || $delivery_time) {
        echo '<h3>' . __('Информация о доставке', 'flowerium-complete') . '</h3>';
        echo '<p><strong>' . __('Дата доставки:', 'flowerium-complete') . '</strong> ' . esc_html($delivery_date) . '</p>';
        if ($delivery_time) {
            $slots = flowerium_delivery_time_slots();
            $time_label = isset($slots[$delivery_time]) ? $slots[$delivery_time]['label'] : $delivery_time;
            echo '<p><strong>' . __('Время доставки:', 'flowerium-complete') . '</strong> ' . esc_html($time_label) . '</p>';
        }
    }
}
add_action('woocommerce_order_details_after_order_table', 'flowerium_order_delivery_details');

/**
 * Add delivery fields to checkout
 */
function flowerium_add_delivery_fields_to_checkout($fields) {
    $fields['order']['flowerium_delivery_date'] = array(
        'label'       => __('Дата доставки', 'flowerium-complete'),
        'placeholder' => _x('Выберите дату', 'placeholder', 'flowerium-complete'),
        'required'    => true,
        'class'       => array('form-row-wide'),
        'clear'       => true,
        'type'        => 'date',
        'min'         => date('Y-m-d', strtotime('+1 day')),
        'max'         => date('Y-m-d', strtotime('+30 days')),
    );

    $fields['order']['flowerium_delivery_time'] = array(
        'label'    => __('Время доставки', 'flowerium-complete'),
        'required' => true,
        'class'    => array('form-row-wide'),
        'clear'    => true,
        'type'     => 'select',
        'options'  => array(
            'morning' => 'Утро (9:00 - 12:00)',
            'day'     => 'День (12:00 - 16:00)',
            'evening' => 'Вечер (16:00 - 20:00)',
        ),
    );

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'flowerium_add_delivery_fields_to_checkout');

/**
 * Validate delivery fields
 */
function flowerium_validate_delivery_fields($fields, $errors) {
    if (empty($fields['flowerium_delivery_date'])) {
        $errors->add('validation', '<strong>' . __('Дата доставки', 'flowerium-complete') . '</strong> ' . __('обязательно для заполнения.', 'flowerium-complete'));
    }
    if (empty($fields['flowerium_delivery_time'])) {
        $errors->add('validation', '<strong>' . __('Время доставки', 'flowerium-complete') . '</strong> ' . __('обязательно для заполнения.', 'flowerium-complete'));
    }
    return $fields;
}
add_filter('woocommerce_after_checkout_validation', 'flowerium_validate_delivery_fields', 10, 2);

/**
 * Load text domain
 */
function flowerium_load_textdomain() {
    load_theme_textdomain('flowerium-complete', FLOWERIUM_DIR . '/languages');
}
add_action('after_setup_theme', 'flowerium_load_textdomain');
