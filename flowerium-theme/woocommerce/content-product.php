<?php
/**
 * WooCommerce template override - Product Grid
 *
 * @package Flowerium
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('', $product); ?>>
    <?php
    // Product badge (sale, new, etc.)
    do_action('woocommerce_before_shop_loop_item_title');
    ?>
    
    <a href="<?php the_permalink(); ?>" class="woocommerce-loop-product__link">
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item_title.
         */
        if (has_post_thumbnail()) {
            $thumbnail_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_image_url($thumbnail_id, 'flowerium-product');
            if ($image_url) {
                echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '" class="attachment-flowerium-product size-flowerium-product" />';
            } else {
                echo woocommerce_get_product_thumbnail();
            }
        } else {
            echo woocommerce_get_product_thumbnail();
        }
        ?>
        
        <div class="product-info">
            <h2 class="woocommerce-loop-product__title"><?php the_title(); ?></h2>
            
            <?php
            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             * Includes: price, rating, etc.
             */
            woocommerce_template_loop_price();
            ?>
            
            <?php if ($product->is_purchasable() && $product->is_in_stock()) : ?>
                <?php woocommerce_template_loop_add_to_cart(); ?>
            <?php endif; ?>
        </div>
    </a>
    
    <?php
    /**
     * Hook: woocommerce_after_shop_loop_item.
     */
    do_action('woocommerce_after_shop_loop_item');
    ?>
</li>
