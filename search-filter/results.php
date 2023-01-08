<?php

/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think 
 * of it as a template part
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
 *
 */
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
	exit;
}
if ($query->have_posts()) {
	while ($query->have_posts()) {
		$query->the_post();
		$terms = get_the_terms(get_the_ID(), 'product_cat');
		foreach ($terms as $term) {
			$product_cat_id = $term->term_id;
			$product_cat_name = $term->name;
			break;
		}
		$countries =  get_the_terms(get_the_ID(), 'country');
		foreach ($countries as $countryS) {
			$country_id = $countryS->term_id;
			$country = $countryS->name;
			break;
		}
		$product = wc_get_product(get_the_ID());
		$stock = $product->get_stock_quantity();
		$locations = wp_get_post_terms(get_the_ID(), 'location');
		$location_link = '';
		if (!is_wp_error($locations) && !empty($locations)) {
			$location_link = esc_url(get_term_link($locations[0]));
		}
?>
		<div class="event-card relative" data-id="<?php echo get_the_ID(); ?> ">
			<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php echo the_title(); ?> featured image" width="500" height="200" />
			<div class="px-3 py-2 pb-6">
				<p class="text-xs uppercase"><?php echo $country . ' - ';
												echo $product_cat_name; ?></p>
				<h4 class="font-semibold my-1 text-lg"><?php echo the_title(); ?></h4>
				<p class="font-semibold ">State: <?php the_field('State'); ?></p>
				<p class=" mt-1">Start: <?php echo date("F j, Y g:i a", strtotime(get_field('event_start'))); ?></p>
				<p class="mb-1">End: <?php echo date("F j, Y g:i a", strtotime(get_field('event_end'))); ?></p>
				<p class=" mb-1">Grade: <?php the_field('grade_level'); ?></p>
				
				<p class="font-semibold mb-4">Price: $<?php echo $product->get_price(); ?></p>
				<?php if (strlen(trim($location_link)) > 0) {
				?>
					<a href="<?php echo $location_link ?>" class="bg-primary border-2 border-primary rounded-xl text-white uppercase text-xs px-4 py-2">View Trip</a>
				<?php
				}
				?>
				<?php if ($stock > 0) : ?>
					<a href="/booking-information?add-to-cart=<?php echo $product->id; ?>&quantity=1" class="border-2 border-black rounded-xl text-black uppercase text-xs px-4 py-2">Book now</a>
				<?php endif; ?>
				<span class="rounded-full absolute top-2 right-2 bg-primary px-2 py-2 text-sm text-white"><?php echo $stock; ?> left</span>
			</div>
		</div>
<?php
	}
} else {
	echo "No Results Found";
}
