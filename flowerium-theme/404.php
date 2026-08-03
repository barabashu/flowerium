<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Flowerium
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php _e('404 - Страница не найдена', 'flowerium'); ?></h1>
            </header>

            <div class="page-content">
                <p><?php _e('К сожалению, запрашиваемая страница не существует. Возможно, она была удалена или перемещена.', 'flowerium'); ?></p>
                
                <div class="mt-3">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                        <?php _e('Вернуться на главную', 'flowerium'); ?>
                    </a>
                    
                    <?php if (class_exists('WooCommerce')) : ?>
                        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn-outline ml-2">
                            <?php _e('Перейти в каталог', 'flowerium'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <h3><?php _e('Поиск по сайту', 'flowerium'); ?></h3>
                    <?php get_search_form(); ?>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
get_sidebar();
get_footer();
