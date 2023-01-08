<?php

/**
 * Theme setup.
 */
function takeshapeadventures_setup()
{
	add_theme_support('title-tag');

	register_nav_menus(
		array(
			'primary' => __('Primary Menu', 'tailpress'),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	add_theme_support('custom-logo');
	add_theme_support('post-thumbnails');

	add_theme_support('align-wide');
	add_theme_support('wp-block-styles');

	add_theme_support('editor-styles');
	add_editor_style('css/editor-style.css');
}

add_action('after_setup_theme', 'takeshapeadventures_setup');

/**
 * Enqueue theme assets.
 */
function takeshapeadventures_enqueue_scripts()
{
	$theme = wp_get_theme();

	wp_enqueue_style('tailpress', takeshapeadventures_asset('css/app.css'), array(), $theme->get('Version'));
	wp_enqueue_script('tailpress', takeshapeadventures_asset('js/app.js'), array(), $theme->get('Version'));
	wp_enqueue_script('header', takeshapeadventures_asset('resources/js/header.js'), array('jquery'));
}

add_action('wp_enqueue_scripts', 'takeshapeadventures_enqueue_scripts');

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function takeshapeadventures_asset($path)
{
	if (wp_get_environment_type() === 'production') {
		return get_stylesheet_directory_uri() . '/' . $path;
	}

	return add_query_arg('time', time(),  get_stylesheet_directory_uri() . '/' . $path);
}

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function takeshapeadventures_nav_menu_add_li_class($classes, $item, $args, $depth)
{
	if (isset($args->li_class)) {
		$classes[] = $args->li_class;
	}

	if (isset($args->{"li_class_$depth"})) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}

add_filter('nav_menu_css_class', 'takeshapeadventures_nav_menu_add_li_class', 10, 4);

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function takeshapeadventures_nav_menu_add_submenu_class($classes, $args, $depth)
{
	if (isset($args->submenu_class)) {
		$classes[] = $args->submenu_class;
	}

	if (isset($args->{"submenu_class_$depth"})) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter('nav_menu_submenu_css_class', 'takeshapeadventures_nav_menu_add_submenu_class', 10, 3);
 

/**
 * @snippet       WooCommerce Max 1 Product @ Cart
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WC 5.1
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
 add_filter( 'woocommerce_add_to_cart_validation', 'bbloomer_only_one_in_cart', 9999, 2 );
   
 function bbloomer_only_one_in_cart( $passed, $added_product_id ) {
	if( has_term( 150, 'product_cat', $added_product_id ) ) {
		wc_empty_cart();
	}
	return $passed;
 }

 /**
 * Update cart product thumbnail
 */
function woocommerce_cart_item_thumbnail_2912067($image, $cartItem, $cartItemKey)
{
    $id = ($cartItem['variation_id'] !== 0 ? $cartItem['variation_id'] : $cartItem['product_id']);
    return wp_get_attachment_image(get_post_thumbnail_id((int) $id), 'medium');
}
add_filter('woocommerce_cart_item_thumbnail', 'woocommerce_cart_item_thumbnail_2912067', 10, 3);



function update_item_from_cart() {
	$cart_item_key = $_POST['cart_item_key'];   
	$quantity = $_POST['qty'];     

   // Get mini cart
   ob_start();

   foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
   {
	   if( $cart_item_key == $_POST['cart_item_key'] )
	   {
		   WC()->cart->set_quantity( $cart_item_key, $quantity, $refresh_totals = true );
	   }
   }
   WC()->cart->calculate_totals();
   WC()->cart->maybe_set_cart_cookies();
   return true;
}

add_action('wp_ajax_update_item_from_cart', 'update_item_from_cart');
add_action('wp_ajax_nopriv_update_item_from_cart', 'update_item_from_cart');