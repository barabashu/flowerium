<?php
/**
 * The template for displaying search results
 *
 * @package Flowerium_Complete
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="page-header">
        <div class="container">
            <h1 class="page-title">
                <?php 
                printf(
                    __('Результаты поиска: %s', 'flowerium-complete'),
                    '<span style="color: var(--color-primary);">' . get_search_query() . '</span>'
                );
                ?>
            </h1>
        </div>
    </div>

    <div class="search-results-section">
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
                            <article class="search-result-item" style="padding: 20px; border-bottom: 1px solid var(--color-border);">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
                    <i class="fas fa-search" style="font-size: 4rem; color: var(--color-primary); margin-bottom: 20px;"></i>
                    <h2><?php _e('Ничего не найдено', 'flowerium-complete'); ?></h2>
                    <p style="max-width: 600px; margin: 0 auto 30px;">
                        <?php _e('По вашему запросу ничего не найдено. Попробуйте изменить поисковый запрос или воспользуйтесь навигацией по сайту.', 'flowerium-complete'); ?>
                    </p>
                    
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form" style="max-width: 500px; margin: 0 auto;">
                        <label style="display: none;" for="search-field"><?php _e('Поиск:', 'flowerium-complete'); ?></label>
                        <input type="search" id="search-field" class="search-field" placeholder="<?php esc_attr_e('Поиск...', 'flowerium-complete'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                        <button type="submit" class="search-submit btn btn-primary">
                            <i class="fas fa-search"></i> <?php _e('Найти', 'flowerium-complete'); ?>
                        </button>
                    </form>
                    
                    <div style="margin-top: 40px;">
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('catalog'))); ?>" class="btn btn-outline">
                            <i class="fas fa-shopping-bag"></i> <?php _e('Перейти в каталог', 'flowerium-complete'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
get_footer();
