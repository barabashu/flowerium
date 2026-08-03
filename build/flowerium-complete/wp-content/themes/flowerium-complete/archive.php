<?php
/**
 * The template for displaying archive pages
 *
 * @package Flowerium_Complete
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="page-header">
        <div class="container">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </div>
    </div>

    <div class="archive-section">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="products-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php if (get_post_type() === 'product') : ?>
                            <?php global $product; ?>
                            <div class="product-card">
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
                        <?php else : ?>
                            <article class="archive-item">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="archive-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline">
                                    <?php _e('Читать далее', 'flowerium-complete'); ?>
                                </a>
                            </article>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>

                <div class="pagination" style="margin-top: 40px; text-align: center;">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => '<i class="fas fa-chevron-left"></i>',
                        'next_text' => '<i class="fas fa-chevron-right"></i>',
                    ));
                    ?>
                </div>

            <?php else : ?>
                <div class="no-results" style="text-align: center; padding: 60px 20px;">
                    <i class="fas fa-box-open" style="font-size: 4rem; color: var(--color-primary); margin-bottom: 20px;"></i>
                    <h2><?php _e('Записей не найдено', 'flowerium-complete'); ?></h2>
                    <p><?php _e('В этой категории пока нет материалов.', 'flowerium-complete'); ?></p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary" style="margin-top: 20px;">
                        <?php _e('На главную', 'flowerium-complete'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
get_footer();
