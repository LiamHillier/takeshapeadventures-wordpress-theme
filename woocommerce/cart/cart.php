<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */
defined('ABSPATH') || exit;
do_action('woocommerce_before_cart');

?>
<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
    <?php do_action('woocommerce_before_cart_table'); ?>
    <div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
        <div class="cart-contents">
            <?php do_action('woocommerce_before_cart_contents'); ?>
            <?php
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $cross_sells_ids_in_cart = array();
                $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                // Loop through cart items
                $cross_sells_ids_in_cart = array_merge($cart_item['data']->get_cross_sell_ids(), $cross_sells_ids_in_cart);
                $cross_sells = wp_parse_id_list($cross_sells_ids_in_cart);
                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                    if (has_term('ticket', 'product_cat', $_product->id)) {
            ?>
                        <div class="woocommerce-cart-form__cart-item ticket-cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                            <div class="product-thumbnail">
                                <?php
                                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                                echo $thumbnail; // PHPCS: XSS ok.
                                ?>
                            </div>
                            <div class='ticket-content'>
                                <div class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                    <?php
                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);
                                    // Meta data.
                                    echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.
                                    // Backorder notification.
                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                    }
                                    ?>
                                </div>
                                <p class="ticket-dates">Start Date: <?php echo date("F j, Y g:i a", strtotime(get_field('event_start', $_product->id))); ?></p>
                                <p class="ticket-dates">End Date: <?php echo date("F j, Y g:i a", strtotime(get_field('event_end', $_product->id))); ?></p>
                                <div class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                                    <?php
                                    echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                    ?>
                                </div>
                                <div class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                                    <?php
                                    if ($_product->is_sold_individually()) {
                                        $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                    } else {
                                        $product_quantity = woocommerce_quantity_input(
                                            array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                'min_value'    => '0',
                                                'product_name' => $_product->get_name(),
                                            ),
                                            $_product,
                                            false
                                        );
                                    }
                                    ?>
                                    <div class="ticket-quantity">
                                        <span>How many Adventurers</span>
                                        <?php
                                        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="woocommerce-cart-form__cart-item ticket-cart-addition <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                            <div class="product-thumbnail">
                                <?php
                                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                                echo $thumbnail; // PHPCS: XSS ok.
                                ?>
                            </div>
                            <div class='ticket-content'>
                                <div class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                    <?php
                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);
                                    // Meta data.
                                    echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.
                                    // Backorder notification.
                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                    }
                                    ?>
                                </div>

                                <div class="addtion-product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                                    <?php
                                    echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                    ?>
                                </div>
                                <div class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                                    <?php
                                    if ($_product->is_sold_individually()) {
                                        $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                    } else {
                                        $product_quantity = woocommerce_quantity_input(
                                            array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                'min_value'    => '0',
                                                'product_name' => $_product->get_name(),
                                            ),
                                            $_product,
                                            false
                                        );
                                    }
                                    ?>
                                    <div class="ticket-addition-footer">
                                        <div class="ticket-quantity">
                                            <span>Quantity</span>
                                            <?php
                                            echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                            ?>
                                        </div>
                                        <div class="product-remove">
                                            <?php
                                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                'woocommerce_cart_item_remove_link',
                                                sprintf(
                                                    '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',
                                                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                    esc_html__('Remove this item', 'woocommerce'),
                                                    esc_attr($product_id),
                                                    esc_attr($_product->get_sku())
                                                ),
                                                $cart_item_key
                                            );
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
            <?php do_action('woocommerce_cart_contents'); ?>
            <div>
            </div>
            <?php do_action('woocommerce_after_cart_contents'); ?>
            <div colspan="6" class="actions">
                <?php if (wc_coupons_enabled()) { ?>
                    <div class="coupon">
                        <label for="coupon_code"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" /> <button type="submit" class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_attr_e('Apply coupon', 'woocommerce'); ?></button>
                        <?php do_action('woocommerce_cart_coupon'); ?>
                    </div>
                <?php } ?>
                <button type="submit" class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>
                <?php do_action('woocommerce_cart_actions'); ?>
                <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
            </div>
        </div>
    </div>
    <?php do_action('woocommerce_after_cart_table'); ?>
</form>
<?php do_action('woocommerce_before_cart_collaterals');


?>
<div class="cart-collaterals">

    <?php



    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $cross_sells_ids_in_cart = array();
        $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
        // Loop through cart items
        $cross_sells_ids_in_cart = array_merge($cart_item['data']->get_cross_sell_ids(), $cross_sells_ids_in_cart);
        $cross_sells = wp_parse_id_list($cross_sells_ids_in_cart);

        if (count($cross_sells) > 0) :
    ?>
            <h2 class="mt-6">Optional Additions</h2>
            <div class="additions">
                <?php
                foreach ($cross_sells as $cross_sell_id) :
                    $product = wc_get_product($cross_sell_id);
                    $name = $product->get_name();
                    $image =  get_the_post_thumbnail($cross_sell_id, 'thumbnail');
                    $shortcode = '[add_to_cart id="' . $cross_sell_id . '"]';
                    $product_ids = array_merge(
                        wp_list_pluck(WC()->cart->get_cart_contents(), 'variation_id'),
                        wp_list_pluck(WC()->cart->get_cart_contents(), 'product_id')
                    );
                    if (!in_array($cross_sell_id, $product_ids)) {
                ?>
                        <div class="ticket-addition">
                            <?php echo $image; ?>
                            <div>
                                <h3><?php echo $name; ?></h3>
                                <?php echo do_shortcode($shortcode); ?>
                            </div>

                        </div>
                <?php
                    }
                endforeach;
                ?>
            </div>
    <?php
        endif;
    }
    /**
     * Cart collaterals hook.
     *
     * @hooked woocommerce_cross_sell_display
     * @hooked woocommerce_cart_totals - 10
     */
    do_action('woocommerce_cart_collaterals');



    ?>

</div>
<?php do_action('woocommerce_after_cart'); ?>