<?php
/**
 * The template for displaying cart page
 *
 * @package Flowerium_Complete
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="page-header">
        <div class="container">
            <h1 class="page-title"><?php _e('Корзина', 'flowerium-complete'); ?></h1>
        </div>
    </div>

    <div class="cart-section">
        <div class="container">
            <?php woocommerce_content(); ?>
        </div>
    </div>
</main>

<?php
get_footer();
