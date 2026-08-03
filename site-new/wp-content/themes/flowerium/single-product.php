<?php
/**
 * The template for displaying single products
 *
 * @package Flowerium
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <div class="section">
        <?php woocommerce_content(); ?>
    </div>

</main>

<?php
get_footer();
