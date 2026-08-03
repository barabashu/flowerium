<?php
/**
 * The template for displaying search results
 *
 * @package Flowerium
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <div class="section">
        <div class="page-hero">
            <p class="eyebrow"><?php _e('Результаты поиска', 'flowerium'); ?></p>
            <h1><?php printf(__('Поиск: %s', 'flowerium'), '<span>' . get_search_query() . '</span>'); ?></h1>
        </div>
        
        <?php if (have_posts()) : ?>
            
            <div class="product-grid product-grid--catalog">
                <?php while (have_posts()) : the_post(); ?>
                    
                    <?php if (get_post_type() === 'product') : ?>
                        <?php global $product; ?>
                        <article class="product-card">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo $product->get_image('product-thumb'); ?>
                            </a>
                            <div>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 12); ?></p>
                                <strong><?php echo $product->get_price_html(); ?></strong>
                            </div>
                            <button class="button button--small" type="button" data-product-id="<?php echo get_the_ID(); ?>"><?php _e('В корзину', 'flowerium'); ?></button>
                        </article>
                    <?php else : ?>
                        <article class="category-card">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        </article>
                    <?php endif; ?>
                    
                <?php endwhile; ?>
            </div>
            
            <div class="text-center mt-3">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('← Назад', 'flowerium'),
                    'next_text' => __('Вперёд →', 'flowerium'),
                ));
                ?>
            </div>
            
        <?php else : ?>
            
            <p><?php _e('К сожалению, по вашему запросу ничего не найдено.', 'flowerium'); ?></p>
            
            <div style="margin-top: 32px;">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
                    <label>
                        <span class="screen-reader-text"><?php _e('Найти:', 'flowerium'); ?></span>
                        <input type="search" class="search-field" placeholder="<?php _e('Попробуйте другой запрос…', 'flowerium'); ?>" value="" name="s" />
                    </label>
                    <button type="submit" class="button button--primary"><?php _e('Найти', 'flowerium'); ?></button>
                </form>
            </div>
            
        <?php endif; ?>
    </div>

</main>

<?php
get_footer();
