<?php
/**
 * 404 template.
 *
 * @package Flowerium
 */
get_header();
?>
<main><section class="page-hero"><p class="eyebrow">404</p><h1><?php esc_html_e('Страница не найдена', 'flowerium'); ?></h1><p><?php esc_html_e('Вернитесь на главную или откройте каталог букетов.', 'flowerium'); ?></p><a class="button button--primary" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('На главную', 'flowerium'); ?></a></section></main>
<?php get_footer(); ?>
