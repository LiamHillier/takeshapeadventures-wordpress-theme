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
	if( has_term( 19, 'product_cat', $added_product_id ) ) {
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


// Adventure Life Stats
function days_on_the_trail($atts)
{
    $user_id = get_current_user_id();
    $customer_orders = wc_get_orders(
        array(
            'meta_key' => '_customer_user',
            'meta_value' => $user_id,
            'post_status' => 'completed',
            'numberposts' => -1
        )
    );
    $count = 0;
    foreach ($customer_orders as $order) {
        $order = new WC_Order($order->ID);
        $order_items = $order->get_items(); // Get order items array of objects
        foreach ($order_items as $item_id => $item) :
            $variation_id = $item->get_variation_id();
            $product_id   = $variation_id > 0 ? $variation_id : $item->get_product_id();
            $days = get_field('days', $product_id, true);
            if (isset($days)) {
                if (is_numeric($days)) {
                    if ($days > 0) {
                        $count = $count + $days;
                    };
                };
            };
        endforeach;
    };
    return $count;
}
add_shortcode('days_on_the_trail', 'days_on_the_trail');
function kms_hiked($atts)
{
    $user_id = get_current_user_id();
    $customer_orders = wc_get_orders(
        array(
            'meta_key' => '_customer_user',
            'meta_value' => $user_id,
            'post_status' => 'completed',
            'numberposts' => -1
        )
    );
    $count = 0;
    foreach ($customer_orders as $order) {
        $order = new WC_Order($order->ID);
        $order_items = $order->get_items(); // Get order items array of objects
        foreach ($order_items as $item_id => $item) :
            $variation_id = $item->get_variation_id();
            $product_id   = $variation_id > 0 ? $variation_id : $item->get_product_id();
            $kms = get_field('kms', $product_id, true);
            if (isset($kms)) {
                if (is_numeric($kms)) {
                    if ($kms > 0) {
                        $count = $count + $kms;
                    };
                };
            };
        endforeach;
    };
    return $count;
}
add_shortcode('kms_hiked', 'kms_hiked');
function unique_destinations($atts)
{
    $user_id = get_current_user_id();
    $customer_orders = wc_get_orders(
        array(
            'meta_key' => '_customer_user',
            'meta_value' => $user_id,
            'post_status' => 'completed',
            'numberposts' => -1
        )
    );
    $count = 0;
    foreach ($customer_orders as $order) {
        $order = new WC_Order($order->ID);
        $order_items = $order->get_items(); // Get order items array of objects
        $list = array();
        foreach ($order_items as $item_id => $item) :
            $variation_id = $item->get_variation_id();
            $product_id   = $variation_id > 0 ? $variation_id : $item->get_product_id();
            $location = get_field('event_name', $product_id, true);
            if (isset($location)) {
                if (!in_array($location, $list)) {
                    $count = $count + 1;
                    $list[] = $location;
                };
            };
        endforeach;
    };
    return $count;
}
add_shortcode('unique_destinations', 'unique_destinations');
function pay_it_forward($atts)
{
    $user_id = get_current_user_id();
    $customer_orders = wc_get_orders(
        array(
            'meta_key' => '_customer_user',
            'meta_value' => $user_id,
            'post_status' => 'completed',
            'numberposts' => -1
        )
    );
    $count = 0;
    foreach ($customer_orders as $order) {
        $order = new WC_Order($order->ID);
        $order_items = $order->get_items(); // Get order items array of objects
        foreach ($order_items as $item_id => $item) :
            $variation_id = $item->get_variation_id();
            $product_id   = $variation_id > 0 ? $variation_id : $item->get_product_id();
            $days = get_field('days', $product_id, true);
            if (isset($days)) {
                if (is_numeric($days)) {
                    if ($days > 0) {
                        $count = $count + $days;
                    };
                };
            };
        endforeach;
    };
    if ($count < 11) {
        return $count / 10 * 100;
    }
    if ($count > 10 && $count < 26) {
        return $count / 25 * 100;
    }
    if ($count > 25 && $count < 51) {
        return $count / 50 * 100;
    }
    if ($count > 50 && $count < 150) {
        return $count / 150 * 100;
    }
}
add_shortcode('pay_it_forward', 'pay_it_forward');

add_action('elementor/query/customer_orders', function ($query) {
    // GET CURR USER
    global $wpdb;
    // this SQL query allows to get all the products purchased by the current user
    // in this example we sort products by date but you can reorder them another way
    $purchased_products_ids = $wpdb->get_col($wpdb->prepare(
        "
		SELECT      itemmeta.meta_value
		FROM        " . $wpdb->prefix . "woocommerce_order_itemmeta itemmeta
		INNER JOIN  " . $wpdb->prefix . "woocommerce_order_items items
		            ON itemmeta.order_item_id = items.order_item_id
		INNER JOIN  $wpdb->posts orders
		            ON orders.ID = items.order_id
		INNER JOIN  $wpdb->postmeta ordermeta
		            ON orders.ID = ordermeta.post_id
		WHERE       itemmeta.meta_key = '_product_id'
		            AND ordermeta.meta_key = '_customer_user'
		            AND ordermeta.meta_value = %s
		ORDER BY    orders.post_date DESC
		",
        get_current_user_id()
    ));
    // some orders may contain the same product, but we do not need it twice
    $ids = [];
    $purchased_products_ids = array_unique($purchased_products_ids);
    if (empty($purchased_products_ids)) {
        $ids[] =  [];
    } else {
        $ids[] = $purchased_products_ids;
    }
    $today = date('Y-m-d H:i:s');
    $query->set('orderby', 'meta_value');
    $query->set('order', 'ASC');
    $query->set(
        'meta_query',
        array(
            array(
                'key' => 'event_start',
                'value' => $today,
                'compare' => '>='
            )
        )
    );
    $query->set('post__in', $purchased_products_ids);
});

// get all events api
add_action('rest_api_init', function () {
    register_rest_route('tsa', '/get-events', array(
        'methods' => 'GET',
        'callback' => 'tsa_events'
    ));
});
add_action('rest_api_init', function () {
    register_rest_route('tsa', '/future-events', array(
        'methods' => 'GET',
        'callback' => 'future_events'
    ));
});
add_action('rest_api_init', function () {
    register_rest_route('tsa', '/weekend-events', array(
        'methods' => 'GET',
        'callback' => 'weekend_events'
    ));
});
function get_orders_ids_by_product_id($product_id)
{
    global $wpdb;
    // Define HERE the orders status to include in  <==  <==  <==  <==  <==  <==  <==
    $orders_statuses = "'wc-completed', 'wc-processing'";
    # Get All defined statuses Orders IDs for a defined product ID (or variation ID)
    return $wpdb->get_col(
        "
        SELECT DISTINCT woi.order_id
        FROM {$wpdb->prefix}woocommerce_order_itemmeta as woim, 
             {$wpdb->prefix}woocommerce_order_items as woi, 
             {$wpdb->prefix}posts as p
        WHERE  woi.order_item_id = woim.order_item_id
        AND woi.order_id = p.ID
        AND p.post_status IN ( $orders_statuses )
        AND woim.meta_key IN ( '_product_id', '_variation_id' )
        AND woim.meta_value LIKE '$product_id'
        ORDER BY woi.order_item_id DESC"
    );
}
function future_events(WP_REST_Request $request)
{
    $args = array(
        'posts_per_page' => '-1',
        'post_status'           => 'publish',
        'tax_query'             => array(
            array(
                'taxonomy'      => 'product_cat',
                'field' =>         'term_id', //This is optional, as it defaults to 'term_id'
                'terms'         => 19,
                'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
            )
        ),
        'meta_key'          => 'date_start',
        'orderby'           => 'meta_value_num',
        'order'             => 'ASC'
    );
    $allProducts = wc_get_products($args);
    $products = array_filter($allProducts, function ($obj) {
        if (isset($obj)) {
            $product = wc_get_product($obj->id);
            if (isset($product)) {
                $eventDate = get_field('date_start', $product->get_id(), true);
                $today = Date('Ymd');
                if ($eventDate <= $today) {
                    return false;
                } else {
                    return true;
                };
            } else {
                return false;
            };
        };
        return true;
    });
    $events = array();
    global $wpdb;
    foreach ($products as $post) {
        $product = wc_get_product($post->id);
        $attendees = array();
        foreach (get_orders_ids_by_product_id($product->id) as $order_id) {
            $order = wc_get_order($order_id);
            $final = new stdClass();
            $line_items = array();
            foreach ($order->get_items() as $item_key => $item) {
                $line_items[] = $item->get_data();
            }
            // Get the WP_User Object instance
            $user = $order->get_user();
            $final = $order->get_data();
            $final['line_items'] = $line_items;
            $final['customerID'] = $order->get_customer_id();
            $final['userRoles'] = $user->roles;
            $attendees[] = $final;
        }
        $events[] = array(
            'title' => $product->get_title(),
            'stock' => $product->get_stock_quantity(),
            'date_created' => $product->get_date_created(),
            'attendees' => $attendees,
            'id' => $product->get_id(),
            'accommodation' => $product->get_meta('accommodation', true, 'view'),
            'submissions' => $product->get_meta('user_submissions', true, 'view'),
            'link' => get_the_permalink($product->get_id()),
            'categories' => $product->get_category_ids(),
            'tags' => $product->get_tag_ids(),
            'sold' => (int)$product->get_total_sales(),
            'event_start' => $product->get_meta('event_start', true, 'view'),
            'requires_accommodation' => $product->get_meta('requires_accommodation', true, 'view'),
            'requires_activities' => $product->get_meta('requires_activities', true, 'view'),
            'event_end' => $product->get_meta('event_end', true, 'view'),
            'inf_tag' => $product->get_meta('infusionsoft_tag', true, 'view'),
            'image' => wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'single-post-thumbnail'),
        );
    };
    return $events;
}
function weekend_events(WP_REST_Request $request)
{
    $args = array(
        'posts_per_page' => '-1',
        'post_status'           => 'publish',
        'tax_query'             => array(
            array(
                'taxonomy'      => 'product_cat',
                'field' =>         'term_id', //This is optional, as it defaults to 'term_id'
                'terms'         => 19,
                'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
            )
        ),
        'meta_key'          => 'date_start',
        'orderby'           => 'meta_value_num',
        'order'             => 'ASC'
    );
    $allProducts = wc_get_products($args);
    $products = array_filter($allProducts, function ($obj) {
        if (isset($obj)) {
            $product = wc_get_product($obj->id);
            if (isset($product)) {
                $eventDate = get_field('date_start', $product->get_id());
                if ($eventDate) {
                    $date = DateTime::createFromFormat('Ymd', $eventDate);
                    if ($date >= new DateTime()) {
                        $date->modify('-7 days');
                        if ($date <= new DateTime()) {
                            return true;
                        } else {
                            return false;
                        };
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            };
        };
        return true;
    });
    $events = array();
    global $wpdb;
    foreach ($products as $post) {
        $product = wc_get_product($post->id);
        $attendees = array();
        foreach (get_orders_ids_by_product_id($product->id) as $order_id) {
            $order = wc_get_order($order_id);
            $final = new stdClass();
            $line_items = array();
            foreach ($order->get_items() as $item_key => $item) {
                $line_items[] = $item->get_data();
            }
            // Get the WP_User Object instance
            $user = $order->get_user();
            $final = $order->get_data();
            $final['line_items'] = $line_items;
            $final['customerID'] = $order->get_customer_id();
            $final['userRoles'] = $user->roles;
            $attendees[] = $final;
        }
        $events[] = array(
            'title' => $product->get_title(),
            'stock' => $product->get_stock_quantity(),
            'date_created' => $product->get_date_created(),
            'attendees' => $attendees,
            'id' => $product->get_id(),
            'accommodation' => $product->get_meta('accommodation', true, 'view'),
            'submissions' => $product->get_meta('user_submissions', true, 'view'),
            'link' => get_the_permalink($product->get_id()),
            'categories' => $product->get_category_ids(),
            'tags' => $product->get_tag_ids(),
            'sold' => (int)$product->get_total_sales(),
            'event_start' => $product->get_meta('event_start', true, 'view'),
            'requires_accommodation' => $product->get_meta('requires_accommodation', true, 'view'),
            'requires_activities' => $product->get_meta('requires_activities', true, 'view'),
            'event_end' => $product->get_meta('event_end', true, 'view'),
            'inf_tag' => $product->get_meta('infusionsoft_tag', true, 'view'),
            'image' => wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'single-post-thumbnail'),
        );
    };
    return $events;
}
function tsa_events(WP_REST_Request $request)
{
    $today = date('Ymd');
    $page = $request['page'];
    $args = array(
        'post_type'             => 'product',
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page'        => '500',
        'orderby' => 'meta_value_num',
        'meta_key' => 'date_start',
        'order' => 'ASC',
        'paged' => $page,
        'tax_query'             => array(
            array(
                'taxonomy'      => 'product_cat',
                'field' =>         'term_id', //This is optional, as it defaults to 'term_id'
                'terms'         => 19,
                'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
            )
        )
    );
    $products = new WP_Query($args);
    $events = array();
    global $wpdb;
    foreach ($products->posts as $post) {
        $product = wc_get_product($post->ID);
        $attendees = array();
        foreach (get_orders_ids_by_product_id($product->id) as $order_id) {
            $order = wc_get_order($order_id);
            $final = new stdClass();
            $line_items = array();
            foreach ($order->get_items() as $item_key => $item) {
                $line_items[] = $item->get_data();
            }
            // Get the WP_User Object instance
            $user = $order->get_user();
            $final = $order->get_data();
            $final['line_items'] = $line_items;
            $final['customerID'] = $order->get_customer_id();
            $final['userRoles'] = $user->roles;
            $attendees[] = $final;
        }
        $events[] = array(
            'title' => $product->get_title(),
            'stock' => $product->get_stock_quantity(),
            'attendees' => $attendees,
            'id' => $product->get_id(),
            'accommodation' => $product->get_meta('accommodation', true, 'view'),
            'submissions' => $product->get_meta('user_submissions', true, 'view'),
            'link' => get_the_permalink($product->get_id()),
            'categories' => $product->get_category_ids(),
            'tags' => $product->get_tag_ids(),
            'sold' => (int)$product->get_total_sales(),
            'event_start' => $product->get_meta('event_start', true, 'view'),
            'event_end' => $product->get_meta('event_end', true, 'view'),
            'inf_tag' => $product->get_meta('infusionsoft_tag', true, 'view'),
            'image' => wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'single-post-thumbnail'),
        );
    };
    return $events;
}
function retrieve_orders_ids_from_a_product_id($product_id)
{
    global $wpdb;
    // Define HERE the orders status to include in  <==  <==  <==  <==  <==  <==  <==
    $orders_statuses = "'wc-completed'";
    # Get All defined statuses Orders IDs for a defined product ID (or variation ID)
    return $wpdb->get_col(
        "
        SELECT DISTINCT woi.order_id
        FROM {$wpdb->prefix}woocommerce_order_itemmeta as woim, 
             {$wpdb->prefix}woocommerce_order_items as woi, 
             {$wpdb->prefix}posts as p
        WHERE  woi.order_item_id = woim.order_item_id
        AND woi.order_id = p.ID
        AND p.post_status IN ( $orders_statuses )
        AND woim.meta_key IN ( '_product_id', '_variation_id' )
        AND woim.meta_value LIKE '$product_id'
        ORDER BY woi.order_item_id DESC"
    );
}
function example_get_orders_by_product($product_id)
{
    global $wpdb;
    $raw = "
        SELECT
          `items`.`order_id`,
          MAX(CASE WHEN `itemmeta`.`meta_key` = '_product_id' THEN `itemmeta`.`meta_value` END) AS `product_id`,
        FROM
          `{$wpdb->prefix}woocommerce_order_items` AS `items`
        INNER JOIN
          `{$wpdb->prefix}woocommerce_order_itemmeta` AS `itemmeta`
        ON
          `items`.`order_item_id` = `itemmeta`.`order_item_id`
        WHERE
          `items`.`order_item_type` IN('line_item')
        AND
          `itemmeta`.`meta_key` IN('_product_id')
        GROUP BY
          `items`.`order_item_id`
        HAVING
          `product_id` = %d";
    $sql = $wpdb->prepare($raw, $product_id);
    return array_map(function ($data) {
        return wc_get_order($data->order_id);
    }, $wpdb->get_results($sql));
};
add_filter('manage_edit-product_columns', 'show_product_order', 15);
function show_product_order($columns)
{
    //add column
    $columns['startdate'] = __('Start Date');
    $columns['enddate'] = __('End Date');
    return $columns;
}
add_action('manage_product_posts_custom_column', 'wpso23858236_product_column_offercode', 10, 2);
function wpso23858236_product_column_offercode($column, $postid)
{
    $product_cats_ids = wc_get_product_term_ids($postid, 'product_cat');
    if ($column == 'startdate') {
        $dateString = get_post_meta($postid, 'event_start', true);
        if (in_array(19, $product_cats_ids)) {
            $date = strtotime($dateString);
            echo (date("F d, Y ", $date));
        } else {
            echo 'N/A';
        }
    }
    if ($column == 'enddate') {
        $dateString = get_post_meta($postid, 'event_end', true);
        if (in_array(19, $product_cats_ids)) {
            $date = strtotime($dateString);
            echo (date("F d, Y ", $date));
        } else {
            echo 'N/A';
        }
    }
}
function my_set_sortable_columns($columns)
{
    $columns['startdate'] = 'startdate';
    return $columns;
}
add_filter('manage_edit-product_sortable_columns', 'my_set_sortable_columns');
function my_sort_custom_column_query($query)
{
    $orderby = $query->get('orderby');
    if ('startdate' == $orderby) {
        $meta_query = array(
            'relation' => 'OR',
            array(
                'key' => 'event_start',
                'compare' => '>', // see note above
            ),
            array(
                'key' => 'event_start',
            ),
        );
        $query->set('meta_query', $meta_query);
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'my_sort_custom_column_query');
// Display order items product categories (Orders on front end and emails)
add_action('woocommerce_order_item_meta_end', 'display_custom_data_in_emails', 10, 4);
function display_custom_data_in_emails($item_id, $item, $order, $bool)
{
    // Get the product categories for this item
    $terms = wp_get_post_terms($item->get_product_id(), 'product_cat', array('fields' => 'names'));
    // Output a coma separated string of product category names
    echo "<br><small>" . implode(', ', $terms) . "</small>";
}
// Display order items product categories in admin order edit pages
add_action('woocommerce_after_order_itemmeta', 'custom_admin_order_itemmeta', 15, 3);
function custom_admin_order_itemmeta($item_id, $item, $product)
{
    //if( ! is_admin() ) return; // only backend
    // Target order "line items" only to avoid errors
    if ($item->is_type('line_item')) {
        // Get the product categories for this item
        $terms = wp_get_post_terms($item->get_product_id(), 'product_cat', array('fields' => 'names'));
        // Output a coma separated string of product category names
        echo "<br><small>" . implode(', ', $terms) . "</small>";
    }
}
add_filter('manage_edit-shop_order_columns', '_order_items_column');
function _order_items_column($order_columns)
{
    $order_columns['order_products'] = "Product Name";
    return $order_columns;
}
add_action('manage_shop_order_posts_custom_column', '_order_items_column_cnt');
function _order_items_column_cnt($colname)
{
    global $the_order; // the global order object
    if ($colname == 'order_products') {
        // get items from the order global object
        $order_items = $the_order->get_items();
        if (!is_wp_error($order_items)) {
            foreach ($order_items as $order_item) {
                echo $order_item['quantity'] . ' × <a href="' . admin_url('post.php?post=' . $order_item['product_id'] . '&action=edit') . '">' . $order_item['name'] . '</a><br />';
                // you can also use $order_item->variation_id parameter
                // by the way, $order_item['name'] will display variation name too
            }
        }
    }
}
add_filter('woocommerce_my_account_my_orders_columns', 'additional_my_account_orders_column', 10, 1);
function additional_my_account_orders_column($columns)
{
    $new_columns = [];
    foreach ($columns as $key => $name) {
        $new_columns[$key] = $name;
        if ('order-number' === $key) {
            $new_columns['order-items'] = __('Product Name', 'woocommerce');
        }
    }
    return $new_columns;
}
add_action('woocommerce_my_account_my_orders_column_order-items', 'additional_my_account_orders_column_content', 10, 1);
function additional_my_account_orders_column_content($order)
{
    $details = array();
    foreach ($order->get_items() as $item)
        $details[] = $item->get_quantity() . ' × ' . $item->get_name();
    echo count($details) > 0 ? implode('<br>', $details) : '–';
}

// Customer orders API
add_action('rest_api_init', function () {
    register_rest_route('tsa', '/get-orders', array(
        'methods'  => 'GET',
        'callback' => 'get_customer_orders'
    ));
});
function iconic_get_customer_by_billing_email($email)
{
    global $wpdb;
    $customer_id = $wpdb->get_var($wpdb->prepare("
		SELECT user_id 
		FROM $wpdb->usermeta 
		WHERE meta_key = 'billing_email'
		AND meta_value = '%s'
	", $email));
    if (!$customer_id) {
        return false;
    }
    $customer = new WC_Customer($customer_id);
    if (!$customer) {
        return false;
    }
    return $customer;
}
function get_customer_orders(WP_REST_Request $request)
{
    $email = $request['email'];
    $customer = iconic_get_customer_by_billing_email($email);
    $order_statuses = array('wc-completed');
    $customer_user_id = $customer->ID;
    // Getting current customer orders
    $customer_orders = wc_get_orders(
        array(
            'meta_key' => '_customer_user',
            'meta_value' => $customer_user_id,
            'post_status' => $order_statuses,
            'numberposts' => -1
        )
    );
    $orders = array();
    $taxonomy = 'location'; // <== Here set your custom taxonomy
    foreach ($customer_orders as $order) {
        $order = new WC_Order($order->ID);
        $order_items = $order->get_items(); // Get order items array of objects
        $items_count = count($items); // Get order items count
        $items_data  = []; // Initializing
        $order_data = $order->get_data();
        $items = array();
        foreach ($order_items as $item_id => $item) :
            $variation_id = $item->get_variation_id();
            $product_id   = $variation_id > 0 ? $variation_id : $item->get_product_id();
            $item_data = $item->get_data();
            $items[] = array(
                'item_data' => $item_data,
                'item_meta' => get_fields($product_id)
            );
        endforeach;
        $orders[] = array(
            'order_data' => $order_data,
            'items' => $items
        );
    };
    return $orders;
}


add_filter('gform_pre_render_31', 'populate_posts');
add_filter('gform_pre_validation_31', 'populate_posts');
add_filter('gform_pre_submission_filter_31', 'populate_posts');
add_filter('gform_admin_pre_render_31', 'populate_posts');
function populate_posts($form)
{
    foreach ($form['fields'] as &$field) {
        if ($field->type != 'select' || strpos($field->cssClass, 'populate-posts') === false) {
            continue;
        }
        // you can add additional parameters here to alter the posts that are retrieved
        // more info: http://codex.wordpress.org/Template_Tags/get_posts
        $args = array(
            'posts_per_page' => '-1',
            'tax_query'             => array(
                array(
                    'taxonomy'      => 'product_cat',
                    'field' =>         'term_id', //This is optional, as it defaults to 'term_id'
                    'terms'         => 19,
                    'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                )
            ),
            'meta_key'          => 'date_start',
            'orderby'           => 'meta_value_num',
            'order'             => 'ASC'
        );
        $allProducts = wc_get_products($args);
        $products = array_filter($allProducts, function ($obj) {
            if (isset($obj)) {
                $product = wc_get_product($obj->id);
                if (isset($product)) {
                    $eventDate = get_field('date_start', $product->get_id(), true);
                    $today = Date('Ymd');
                    if ($eventDate <= $today) {
                        return false;
                    } else {
                        return true;
                    };
                } else {
                    return false;
                };
            };
            return true;
        });
        usort($products, function ($a, $b) {
            $product1 = wc_get_product($a->id);
            $product2 = wc_get_product($b->id);
            return strcasecmp($product1->get_name(), $product2->get_name());
        });
        $choices = array();
        foreach ($products as $post) {
            $product = wc_get_product($post->id);
            $t = strtotime(get_field('event_start', $product->get_id(), true));
            $choices[] = array('text' => $product->get_name() . ' - ' . date('l M j, y \a\t g:iA', $t), 'value' => $product->get_id());
        }
        // update 'Select a Post' to whatever you'd like the instructive option to be
        $field->placeholder = 'Select your event';
        $field->choices = $choices;
    }
    return $form;
}