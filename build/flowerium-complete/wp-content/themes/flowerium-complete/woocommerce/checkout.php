<?php
/**
 * The template for displaying checkout page
 *
 * @package Flowerium_Complete
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="page-header">
        <div class="container">
            <h1 class="page-title"><?php _e('Оформление заказа', 'flowerium-complete'); ?></h1>
        </div>
    </div>

    <div class="checkout-section">
        <div class="container">
            <?php woocommerce_content(); ?>
        </div>
    </div>
</main>

<?php
get_footer();
