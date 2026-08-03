<?php
/**
 * The template for displaying 404 pages
 *
 * @package Flowerium
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <div class="section text-center">
        <div class="page-hero">
            <p class="eyebrow">😔</p>
            <h1><?php _e('Страница не найдена', 'flowerium'); ?></h1>
            <p><?php _e('К сожалению, мы не смогли найти страницу, которую вы ищете.', 'flowerium'); ?></p>
        </div>
        
        <div style="max-width: 500px; margin: 0 auto;">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
                <label>
                    <span class="screen-reader-text"><?php _e('Найти:', 'flowerium'); ?></span>
                    <input type="search" class="search-field" placeholder="<?php _e('Поиск по сайту…', 'flowerium'); ?>" value="" name="s" />
                </label>
                <button type="submit" class="button button--primary"><?php _e('Найти', 'flowerium'); ?></button>
            </form>
            
            <div style="margin-top: 32px;">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="button button--ghost"><?php _e('Вернуться на главную', 'flowerium'); ?></a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('catalog'))); ?>" class="button button--primary"><?php _e('Перейти в каталог', 'flowerium'); ?></a>
            </div>
        </div>
    </div>

</main>

<?php
get_footer();
