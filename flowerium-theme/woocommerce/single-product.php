<?php
/**
 * WooCommerce template override - Single Product
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
<div <?php wc_product_class('woocommerce-product', $product); ?>>
    
    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     */
    do_action('woocommerce_before_single_product_summary');
    ?>
    
    <div class="summary entry-summary">
        <?php
        /**
         * Hook: woocommerce_single_product_summary.
         * Includes: title, price, excerpt, cart, meta, sharing.
         */
        do_action('woocommerce_single_product_summary');
        ?>
    </div>
    
    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     */
    do_action('woocommerce_after_single_product_summary');
    ?>
</div>
