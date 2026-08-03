<?php
/**
 * The template for displaying product archives
 *
 * @package Flowerium_Complete
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="page-header">
        <div class="container">
            <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
            
            <?php if (wc_get_page_description('shop')) : ?>
                <div class="page-description">
                    <?php echo wc_get_page_description('shop'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="products-section">
        <div class="container">
            <?php woocommerce_content(); ?>
        </div>
    </div>
</main>

<?php
get_footer();
