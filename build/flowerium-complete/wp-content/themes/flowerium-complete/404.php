<?php
/**
 * The template for displaying 404 page
 *
 * @package Flowerium_Complete
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="error-404-page">
        <div class="container">
            <div class="error-content" style="text-align: center; padding: 80px 20px;">
                <h1 style="font-size: 8rem; color: var(--color-primary); margin-bottom: 20px;">404</h1>
                <h2><?php _e('Страница не найдена', 'flowerium-complete'); ?></h2>
                <p style="font-size: 1.25rem; max-width: 600px; margin: 0 auto 30px;">
                    <?php _e('К сожалению, страница, которую вы ищете, не существует или была перемещена.', 'flowerium-complete'); ?>
                </p>
                
                <div style="margin-top: 40px;">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                        <i class="fas fa-home"></i> <?php _e('На главную', 'flowerium-complete'); ?>
                    </a>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('catalog'))); ?>" class="btn btn-outline" style="margin-left: 10px;">
                        <i class="fas fa-shopping-bag"></i> <?php _e('В каталог', 'flowerium-complete'); ?>
                    </a>
                </div>
                
                <div style="margin-top: 60px; padding-top: 40px; border-top: 1px solid var(--color-border);">
                    <h3><?php _e('Популярные категории', 'flowerium-complete'); ?></h3>
                    
                    <?php
                    $args = array(
                        'taxonomy'   => 'product_cat',
                        'orderby'    => 'count',
                        'order'      => 'DESC',
                        'number'     => 4,
                        'hide_empty' => false,
                    );
                    
                    $product_categories = get_terms($args);
                    
                    if ($product_categories && !is_wp_error($product_categories)) :
                        echo '<div class="products-grid" style="margin-top: 30px;">';
                        foreach ($product_categories as $category) :
                            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                            $image = wp_get_attachment_url($thumbnail_id);
                            
                            if (!$image) {
                                $image = FLOWERIUM_URI . '/assets/images/category-placeholder.jpg';
                            }
                            ?>
                            <div class="product-card">
                                <div class="product-image">
                                    <a href="<?php echo esc_url(get_term_link($category)); ?>">
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>" />
                                    </a>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-title">
                                        <a href="<?php echo esc_url(get_term_link($category)); ?>">
                                            <?php echo esc_html($category->name); ?>
                                        </a>
                                    </h3>
                                    <p style="color: var(--color-text-light);">
                                        <?php echo sprintf(_n('%d товар', '%d товара', $category->count, 'flowerium-complete'), $category->count); ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                        endforeach;
                        echo '</div>';
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
