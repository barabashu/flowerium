<?php
/**
 * The template for displaying WooCommerce shop page
 *
 * @package Flowerium_Shop
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <div class="page-hero">
        <h1><?php woocommerce_page_title(); ?></h1>
    </div>
    
    <div class="catalog-layout">
        <!-- Sidebar with filters -->
        <aside class="filters">
            <?php if (is_active_sidebar('shop-sidebar')) : ?>
                <?php dynamic_sidebar('shop-sidebar'); ?>
            <?php else : ?>
                <!-- Default filters -->
                <h3><?php _e('Фильтры', 'flowerium-shop'); ?></h3>
                
                <label>
                    <?php _e('Категория', 'flowerium-shop'); ?>
                    <?php wp_dropdown_categories(array(
                        'taxonomy'   => 'product_cat',
                        'hide_empty' => true,
                        'show_option_all' => __('Все категории', 'flowerium-shop'),
                        'orderby'    => 'name',
                        'selected'   => is_product_category() ? get_queried_object_id() : '',
                    )); ?>
                </label>
                
                <label>
                    <?php _e('Сортировка', 'flowerium-shop'); ?>
                    <select onchange="window.location.href=this.value;">
                        <option value="<?php echo esc_url(remove_query_arg('orderby')); ?>" <?php selected(empty($_GET['orderby']), true); ?>>
                            <?php _e('По популярности', 'flowerium-shop'); ?>
                        </option>
                        <option value="?orderby=price&order=asc" <?php selected($_GET['orderby'] ?? '', 'price'); ?>>
                            <?php _e('По цене (возрастание)', 'flowerium-shop'); ?>
                        </option>
                        <option value="?orderby=price&order=desc" <?php selected($_GET['orderby'] ?? '', 'price_desc'); ?>>
                            <?php _e('По цене (убывание)', 'flowerium-shop'); ?>
                        </option>
                        <option value="?orderby=date" <?php selected($_GET['orderby'] ?? '', 'date'); ?>>
                            <?php _e('По новизне', 'flowerium-shop'); ?>
                        </option>
                    </select>
                </label>
                
                <label class="checkbox">
                    <input type="checkbox" name="in_stock" value="1">
                    <?php _e('В наличии', 'flowerium-shop'); ?>
                </label>
            <?php endif; ?>
        </aside>
        
        <!-- Products grid -->
        <div class="products-section">
            <?php woocommerce_content(); ?>
        </div>
    </div>

</main>

<?php
get_footer();
