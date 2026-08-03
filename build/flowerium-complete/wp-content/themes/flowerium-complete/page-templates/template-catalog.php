<?php
/**
 * Template Name: Каталог
 * The template for displaying catalog page
 *
 * @package Flowerium_Complete
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="page-header">
        <div class="container">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <?php if (get_the_content()) : ?>
                <div class="page-description" style="max-width: 800px; margin: 20px auto;">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="catalog-section">
        <div class="container">
            <!-- Product Categories -->
            <?php
            $args = array(
                'taxonomy'   => 'product_cat',
                'orderby'    => 'name',
                'order'      => 'ASC',
                'hide_empty' => false,
                'parent'     => 0,
            );
            
            $product_categories = get_terms($args);
            
            if ($product_categories && !is_wp_error($product_categories)) :
                ?>
                <div class="categories-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: var(--spacing-md); margin-bottom: var(--spacing-xl);">
                    <?php foreach ($product_categories as $category) : 
                        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $image = wp_get_attachment_url($thumbnail_id);
                        
                        if (!$image) {
                            $image = FLOWERIUM_URI . '/assets/images/category-placeholder.jpg';
                        }
                        ?>
                        <a href="<?php echo esc_url(get_term_link($category)); ?>" class="category-card" style="text-decoration: none; color: inherit;">
                            <div class="category-image" style="aspect-ratio: 1; overflow: hidden; border-radius: var(--border-radius); box-shadow: var(--box-shadow);">
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'"/>
                            </div>
                            <div class="category-info" style="padding: var(--spacing-sm); text-align: center;">
                                <h3 style="margin-bottom: 5px;"><?php echo esc_html($category->name); ?></h3>
                                <p style="color: var(--color-text-light); font-size: 0.875rem;">
                                    <?php echo sprintf(_n('%d товар', '%d товара', $category->count, 'flowerium-complete'), $category->count); ?>
                                </p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- All Products -->
            <div class="all-products">
                <h2><?php _e('Все букеты', 'flowerium-complete'); ?></h2>
                
                <?php
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => -1,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );
                
                $products = new WP_Query($args);
                
                if ($products->have_posts()) :
                    echo '<div class="products-grid">';
                    while ($products->have_posts()) :
                        $products->the_post();
                        global $product;
                        ?>
                        <div class="product-card">
                            <?php if ($product->is_featured()) : ?>
                                <span class="product-badge"><?php _e('Хит', 'flowerium-complete'); ?></span>
                            <?php endif; ?>
                            
                            <?php if ($product->is_on_sale()) : ?>
                                <span class="product-badge" style="background-color: var(--color-success);"><?php _e('Акция', 'flowerium-complete'); ?></span>
                            <?php endif; ?>
                            
                            <div class="product-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo $product->get_image('flowerium-product'); ?>
                                </a>
                            </div>
                            
                            <div class="product-info">
                                <h3 class="product-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <div class="product-price">
                                    <?php echo $product->get_price_html(); ?>
                                </div>
                                
                                <?php if ($product->is_purchasable() && $product->is_in_stock()) : ?>
                                    <button class="btn btn-primary product-add-to-cart" 
                                            data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                                        <i class="fas fa-shopping-cart"></i>
                                        <?php _e('В корзину', 'flowerium-complete'); ?>
                                    </button>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline">
                                        <?php _e('Подробнее', 'flowerium-complete'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    echo '</div>';
                    wp_reset_postdata();
                else :
                    ?>
                    <p><?php _e('Товары временно отсутствуют.', 'flowerium-complete'); ?></p>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
