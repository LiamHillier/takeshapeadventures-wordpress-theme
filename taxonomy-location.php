<?php
get_header();
$location = get_queried_object();
$featured_img = get_field('featured_image', $location);
$grade =  get_field('grade', $location);
$distance =  get_field('distance', $location);
$days =  get_field('days', $location);
$brochure = get_field('brochure', $location);
$form_id = get_field('form_id', $location);
$brochure_img = get_field('brochure_image', $location);
$gallery = get_field('gallery', $location);
$image_one =  get_field('image_one', $location);
$type =  get_field('type', $location);
// get_field('highlights', $location) 
$highlights = get_field('highlights', $location);
$included = get_field('includes', $location);
$accommodation = get_field('accommodation', $location);
$accommodation_image = get_field('accommodation_image', $location);
$food = get_field('food', $location);
$food_image = get_field('food_image', $location);
$video_testimonial = get_field('video_testimonial', $location);
if ($video_testimonial) {
    $testimonial_videos = get_field('testimonial_videos', $location);
}
$testimonial_text = get_field('testimonial_text', $location);
$itinerary = get_field('itinerary', $location);
$taxonomy = 'location'; // The targeted custom taxonomy
// Get the terms IDs for the current product related to 'collane' custom taxonomy
$term_ids = wp_get_post_terms(get_the_id(), $taxonomy, array('fields' => 'ids')); // array
$query = new WP_Query($args = array(
    'post_type'             => 'product',
    'post_status'           => 'publish',
    'posts_per_page'        => -1,
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'event_start',
            'value' => date('Ymd'), // today's date in YYYYMMDD format
            'compare' => '>=', // show posts with a date greater than or equal to today
            'type' => 'DATE'
        )
    ),
    'tax_query'             => array(array(
        'taxonomy'      => $taxonomy,
        'field'         => 'term_id', // can be 'term_id', 'slug' or 'name'
        'terms'         => $term_ids,
    ),),
));
?>
<div>
    <div class="location-hero">
        <img class="featured-image" src="<?php echo $featured_img['url'] ?>" alt="<?php echo the_title(); ?> hiking tour with take shape adventures" width="1980" height="1000" />
        <div class="hero-overlay"></div>
        <div class="relative z-10">
            <h1 class="text-white text-5xl"><?php echo the_title(); ?></h1>
        </div>
    </div>
    <div class="bg-neutral-900 w-full px-10 py-4 text-white flex flex-col md:flex-row md:items-center justify-between">
        <div class="flex gap-x-20 flex-wrap gap-y-4">
            <div class="flex gap-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                </svg>
                <div class="font-bold">
                    <h4>Days</h4>
                    <p><?php echo $days ?></p>
                </div>
            </div>
            <div class="flex gap-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                </svg>
                <div class="font-bold">
                    <h4>Grade</h4>
                    <p><?php echo $grade ?></p>
                </div>
            </div>
            <div class="flex gap-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                <div class="font-bold">
                    <h4>Distance</h4>
                    <p><?php echo $distance ?>km</p>
                </div>
            </div>
        </div>
        <a href="#dates" class="button secondary !mt-4 md:mt-0 text-center">View Dates</a>
    </div>
    <div class="px py-16 grid grid-cols-1 lg:grid-cols-5 gap-16" id="tour-overview">
        <div class="py-4 lg:col-span-3">
            <h2 class="font-bold">Tour Overview</h2>
            <p class="mt-6"><?php echo term_description(); ?></p>
        </div>
        <div class="h-full w-full relative rounded-lg min-h-500px lg:col-span-2">
            <?php if ($brochure == 1  && isset($brochure_img['url']) && isset($form_id)) : ?>
                <div class="location-brochure-container">
                    <img src="<?php echo $brochure_img['url']; ?>" alt="<?php echo the_title(); ?> trip brochure" width="150px" height="250px" class="rounded-lg shadow object-cover object-center" />
                    <h4 class="font-semibold text-center mt-4 text-md">Download our <?php echo the_title(); ?> brochure with everything you need to know about this adventure.</h4>
                    <?php echo do_shortcode("[gravityforms id='$form_id' title='false' description='false']"); ?>
                </div>
            <?php else : ?>
                <img src="<?php echo $image_one['url'] ?>" alt="<?php echo the_title(); ?> hiking tour with take shape adventures" width="600" height="600" class="overview-img h-full w-full !object-center object-cover absolute top-0 left-0" />
            <?php endif; ?>
        </div>
    </div>
    <?php
    if ($gallery) :
        if (count($gallery)) : ?>
            <ul class="location-carousel mb-8">
                <?php foreach ($gallery as $image) :
                    $alt = get_the_title($image);
                    $imageUrlFull = wp_get_attachment_image_url($image, 'full') ?>
                    <li class="">
                        <img src="<?php echo $image['url']; ?>" alt="image" width="600" height="600" />
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (strlen($highlights) > 0) : ?>
        <div class="bg-primary text-white grid grid-cols-1 lg:grid-cols-2  py-16" id="highlights">
            <div class="px">
                <h2 class="mb-4">Tour Highlights</h2>
                <?php echo $highlights; ?>
            </div>
            <div class="px mt-8 lg:mt-0">
                <h2 class="mb-4">What's included</h2>
                <?php echo $included; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (strlen($highlights) < 1) : ?>
        <div class="grid grid-cols-1 lg:grid-cols-2 px py-12" id="included">
            <div class="relative h-full w-full rounded-lg overflow-hidden">
                <img src="<?php echo $image_one['url'] ?>" alt="<?php echo $image_one['alt'] ?>" width="800" height="800" class="!h-full !w-full !object-center object-cover absolute top-0 left-0" />
            </div>
            <div class="py lg:pl-10 ">
                <h2 class="mb-4 font-bold">What's included</h2>
                <?php echo $included; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (strlen($accommodation) > 0) : ?>
        <div class="grid grid-cols-1 lg:grid-cols-2 px pt-16 pb-12" id="accommodation">
            <div class="py lg:pr-10 mb-10 lg:mb-0">
                <h2 class="mb-4 font-bold">Accommodation</h2>
                <?php echo $accommodation; ?>
            </div>
            <div class="relative h-full w-full rounded-lg overflow-hidden min-h-300px">
                <img src="<?php echo $accommodation_image['url'] ?>" alt="<?php echo $accommodation_image['alt'] ?>" width="800" height="300" class="!h-full !w-full !object-center object-cover absolute top-0 left-0 " />
            </div>
        </div>
    <?php endif; ?>
    <?php if (strlen($food) > 0) : ?>
        <div class="grid grid-cols-1 lg:grid-cols-2 px py-12" id="food">
            <div class="order-2 lg:order-1 relative h-full w-full rounded-lg overflow-hidden min-h-300px ">
                <img src="<?php echo $food_image['url'] ?>" alt="<?php echo $food_image['alt'] ?>" width="800" height="300" class="!h-full !w-full !object-center object-cover absolute top-0 left-0 " />
            </div>
            <div class="order-1 lg:order-2 py lg:pl-10 mb-10 lg:mb-0">
                <h2 class="mb-4 font-bold">Food</h2>
                <?php echo $food; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="bg-primary px py-16 text-white text-center flex justify-center flex-col items-center" id="testimonials">
        <h2 class="mb-4 font-bold">What our adventureres have said</h2>
        <div class="max-w-7xl">
            <?php
            if ($video_testimonial) : ?>
                <video class="rounded-lg" src="<?php echo $testimonial_videos['url']; ?>" controls controlslist="nodownload"></video>
            <?php else : ?>
                <p class="text-xl max-w-lg mx-auto"><?php echo $testimonial_text ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php if (have_rows('itinerary', $location)) : ?>
        <div class="px py-16 text-center" id="itinerary">
            <h2 class="mb-6">Itinerary</h2>
            <div class="shadow-xl p-6 text-left max-w-5xl mx-auto rounded-xl bg-white">
                <?php while (have_rows('itinerary', $location)) : the_row();
                    $day = get_sub_field('day');
                    $content = get_sub_field('content');
                ?>
                    <details class="my-4">
                        <summary class="flex justify-between items-center text-primary font-bold text-lg">
                            <h3 class=""><?php echo $day; ?></h3><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </summary>
                        <p class="py-4"><?php echo $content ?></p>
                    </details>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="py-16 w-full text-center max-w-7xl mx-auto" id="dates">
        <h4>BOOK NOW</h4>
        <h2>Upcoming Dates</h2>
        <div class="dates-carousel">
            <?php if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
                    $product = wc_get_product($query->post->ID);
                    $stock = $product->get_stock_quantity();
            ?>
                    <div class="shadow-lg p-4 text-left relative select-none rounded-xl font-bold bg-white mx-4">
                        <p class="text-lg"><?php echo the_title(); ?></p>
                        <p class=" mt-1">Start: <?php echo date("F j, Y g:i a", strtotime(get_field('event_start', $product->id))); ?></p>
                        <p class="mb-1">End: <?php echo date("F j, Y g:i a", strtotime(get_field('event_end', $product->id))); ?></p>
                        <?php if ($product->get_sale_price() < $product->get_regular_price()) : ?>
                            <p class="text-sm">Price: <span class="line-through">$<?php echo $product->get_regular_price(); ?></span> $<?php echo $product->get_price(); ?></p>
                        <?php else : ?>
                            <p class="text-sm">Price: $<?php echo $product->get_price(); ?></p>
                        <?php endif; ?>
                        <p class="mb-4 font-normal text-sm">Members Price: $<?php echo get_field('members_price', $location); ?></p>
                        <span class="rounded-full absolute top-2 right-2 bg-primary px-2 py-2 text-sm text-white"><?php echo $stock; ?> left</span>
                        <?php
                        if ($product->is_type('variable')) {
                        ?>
                            <?php if (empty($product->get_available_variations()) && false !== $product->get_available_variations()) : ?>
                            <?php else : ?>
                                <form class="variations_form cart" method="post" enctype='multipart/form-data'>
                                    <label for="variation_select">Select a variation:</label>
                                    <select id="variation_select" name="variation_id">
                                        <?php
                                        // Get the product variations
                                        $product_variations = $product->get_available_variations();
                                        // Loop through each variation
                                        foreach ($product_variations as $variation) {
                                            // Get the variation ID and attributes
                                            $variation_id = $variation['variation_id'];
                                            $attributes = implode(', ', $variation['attributes']);
                                            // Display the variation as an option in the select dropdown
                                            echo '<option value="' . $variation_id . '">' . $attributes . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <button type="submit"class="border-2 border-secondary bg-secondary rounded-xl text-white uppercase text-xs px-4 py-2 font-bold">Book now</button>
                                    <input type="hidden" name="add-to-cart" value="<?php echo $product->get_id(); ?>">
                                </form>
                            <?php endif; ?>
                        <?php } else {
                        ?>
                            <a href="/booking-information?add-to-cart=<?php echo $product->id; ?>&quantity=1" class="border-2 border-secondary bg-secondary rounded-xl text-white uppercase text-xs px-4 py-2 font-bold">Book now</a>
                        <?php
                        }
                        ?>
                    </div>
            <?php endwhile;
                wp_reset_postdata();
            endif; ?>
        </div>
        <?php if ($type === 'Adventure Tour' || $type === "Micro Adventure") : ?>
            <p class="max-w-5xl mx-auto text-sm mt-4 font-semibold">Secure your spot with a non refundable deposit, and have the remainder payment be automatically split over additional payments. Proceed with booking to choose your payment option. See here for our payment plan details terms and conditions.</p>
        <?php endif;
        if (current_user_can('manage_options')) {
            echo do_shortcode('[custom-plugin-button]');
        }
        ?>
    </div>
    <?php get_template_part('components/elements/become-a-member-banner'); ?>
    <?php get_template_part('components/elements/upcoming-events'); ?>
</div>
<?php
get_footer();
