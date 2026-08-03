<?php
/**
 * WooCommerce wrapper template.
 *
 * @package Flowerium
 */
get_header();
?>
<main><section class="page-hero"><p class="eyebrow"><?php esc_html_e('Каталог', 'flowerium'); ?></p><h1><?php woocommerce_page_title(); ?></h1></section><div class="entry-content"><?php woocommerce_content(); ?></div></main>
<?php get_footer(); ?>
