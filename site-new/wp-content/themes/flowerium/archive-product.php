<?php
/**
 * The template for displaying product archives (shop, category, tag)
 *
 * @package Flowerium
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <div class="catalog-layout">
        <!-- Sidebar with Filters -->
        <aside class="filters">
            <h3><?php _e('Фильтры', 'flowerium'); ?></h3>
            
            <?php if (is_active_sidebar('shop-sidebar')) : ?>
                <?php dynamic_sidebar('shop-sidebar'); ?>
            <?php else : ?>
                <!-- Default WooCommerce filters -->
                <?php woocommerce_sidebar(); ?>
            <?php endif; ?>
        </aside>
        
        <!-- Product Grid -->
        <div class="products-section">
            <?php if (is_product_category()) : ?>
                <div class="page-hero">
                    <p class="eyebrow"><?php _e('Каталог', 'flowerium'); ?></p>
                    <h1><?php single_cat_title(); ?></h1>
                    <?php 
                    $category_description = category_description();
                    if (!empty($category_description)) {
                        echo '<div class="category-description">' . wp_kses_post($category_description) . '</div>';
                    }
                    ?>
                </div>
            <?php elseif (is_shop()) : ?>
                <div class="page-hero">
                    <p class="eyebrow"><?php _e('Каталог', 'flowerium'); ?></p>
                    <h1><?php _e('Все букеты и цветы', 'flowerium'); ?></h1>
                    <p><?php _e('Выбирайте свежие цветы с доставкой по Крыму', 'flowerium'); ?></p>
                </div>
            <?php endif; ?>
            
            <div class="section">
                <?php woocommerce_content(); ?>
            </div>
        </div>
    </div>

</main>

<?php
get_footer();
