<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! is_shop() && ! is_product_taxonomy() ) {
	$quantity_field = woocommerce_quantity_input( array(
		'input_name'  => 'product_id',
		'input_value' => ! empty( $product->cart_item['quantity'] ) ? $product->cart_item['quantity'] : 1,
		'max_value'   => $product->backorders_allowed() ? '' : $product->get_stock_quantity(),
		'min_value'   => 0,
	), $product, false );

	$quantity_field = str_replace( array( '<div class="quantity">', "</div>" ), '', $quantity_field );
	echo str_replace( '<input ', '<input style="max-width: 70px" ', $quantity_field );
}

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">Add</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : 'button' ),
		esc_html( $product->add_to_cart_text() )
	),
$product );

wc_enqueue_js( "
	jQuery( '.add_to_cart_inline .qty' ).on( 'change', function() {
		var qty = jQuery( this ),
			atc = jQuery( this ).next( '.add_to_cart_button' );

			atc.attr( 'data-quantity', qty.val() );
	});
" );
