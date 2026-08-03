<?php
/**
 * Mini cart template part
 *
 * @package Flowerium_Complete
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<?php if (WC()->cart && !WC()->cart->is_empty()) : ?>
    <div class="cart-items">
        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            
            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) :
                $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('flowerium-thumbnail'), $cart_item, $cart_item_key);
                $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                ?>
                <div class="cart-item" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                    <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($product_name); ?>" class="cart-item-image" />
                    
                    <div class="cart-item-details">
                        <h4 class="cart-item-title"><?php echo esc_html($product_name); ?></h4>
                        <div class="cart-item-price"><?php echo $product_price; ?></div>
                        
                        <div class="cart-item-quantity">
                            <button class="qty-minus" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>" data-quantity="<?php echo esc_attr($cart_item['quantity'] - 1); ?>">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span><?php echo esc_html($cart_item['quantity']); ?></span>
                            <button class="qty-plus" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>" data-quantity="<?php echo esc_attr($cart_item['quantity'] + 1); ?>">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button class="qty-remove" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>" style="margin-left: auto;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php
            endif;
        endforeach; ?>
    </div>
    
    <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
        <div class="cart-shipping-info" style="margin-top: 15px; padding: 10px; background: var(--color-secondary); border-radius: var(--border-radius);">
            <?php woocommerce_cart_totals_shipping_html(); ?>
        </div>
    <?php endif; ?>
    
<?php else : ?>
    <div class="cart-empty" style="text-align: center; padding: 40px 20px;">
        <i class="fas fa-shopping-basket" style="font-size: 3rem; color: var(--color-primary); margin-bottom: 20px;"></i>
        <p><?php _e('Ваша корзина пуста', 'flowerium-complete'); ?></p>
        <a href="<?php echo esc_url(get_permalink(get_page_by_path('catalog'))); ?>" class="btn btn-primary" style="margin-top: 15px;">
            <?php _e('Перейти в каталог', 'flowerium-complete'); ?>
        </a>
    </div>
<?php endif; ?>

<script type="text/javascript">
jQuery(document).ready(function($) {
    // Update cart item quantity
    $('.qty-plus, .qty-minus').on('click', function(e) {
        e.preventDefault();
        
        var $button = $(this);
        var cartItemKey = $button.data('cart-item-key');
        var quantity = parseInt($button.data('quantity'));
        
        if (quantity < 0) quantity = 0;
        
        $.ajax({
            type: 'POST',
            url: flowerium_ajax.ajax_url,
            data: {
                action: 'flowerium_update_cart',
                nonce: flowerium_ajax.nonce,
                cart_item_key: cartItemKey,
                quantity: quantity
            },
            beforeSend: function() {
                $('#cart-modal-body').addClass('loading');
            },
            success: function(response) {
                $('#cart-modal-body').removeClass('loading');
                
                if (response.success) {
                    $('#cart-modal-body').html(response.data.cart_html);
                    $('#cart-modal-total').text(response.data.cart_total);
                    $('.cart-count').text(response.data.cart_count);
                    
                    showNotification(response.data.message, 'success');
                } else {
                    showNotification(response.data.message || '<?php _e("Ошибка обновления", "flowerium-complete"); ?>', 'error');
                }
            },
            error: function() {
                $('#cart-modal-body').removeClass('loading');
                showNotification('<?php _e("Произошла ошибка. Попробуйте еще раз.", "flowerium-complete"); ?>', 'error');
            }
        });
    });
    
    // Remove cart item
    $('.qty-remove').on('click', function(e) {
        e.preventDefault();
        
        var $button = $(this);
        var cartItemKey = $button.data('cart-item-key');
        
        $.ajax({
            type: 'POST',
            url: flowerium_ajax.ajax_url,
            data: {
                action: 'flowerium_remove_from_cart',
                nonce: flowerium_ajax.nonce,
                cart_item_key: cartItemKey
            },
            beforeSend: function() {
                $('#cart-modal-body').addClass('loading');
            },
            success: function(response) {
                $('#cart-modal-body').removeClass('loading');
                
                if (response.success) {
                    $('#cart-modal-body').html(response.data.cart_html);
                    $('#cart-modal-total').text(response.data.cart_total);
                    $('.cart-count').text(response.data.cart_count);
                    
                    showNotification(response.data.message, 'success');
                } else {
                    showNotification(response.data.message || '<?php _e("Ошибка удаления", "flowerium-complete"); ?>', 'error');
                }
            },
            error: function() {
                $('#cart-modal-body').removeClass('loading');
                showNotification('<?php _e("Произошла ошибка. Попробуйте еще раз.", "flowerium-complete"); ?>', 'error');
            }
        });
    });
});
</script>
