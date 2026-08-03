<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Flowerium
 */

?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php _e('Ничего не найдено', 'flowerium'); ?></h1>
    </header>

    <div class="page-content">
        <?php if (is_search()) : ?>
            <p><?php _e('К сожалению, по вашему запросу ничего не найдено. Попробуйте изменить поисковый запрос.', 'flowerium'); ?></p>
            
            <?php get_search_form(); ?>
            
        <?php else : ?>
            <p><?php _e('Похоже, здесь пока ничего нет. Вернитесь позже или перейдите на главную страницу.', 'flowerium'); ?></p>
            
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary mt-2">
                <?php _e('На главную', 'flowerium'); ?>
            </a>
        <?php endif; ?>
    </div>
</section>
