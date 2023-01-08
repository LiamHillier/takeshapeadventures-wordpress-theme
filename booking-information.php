<?php
/* Template Name: Booking Information */
get_header();
?>

<div class="booking-info pt-16 pb-32 px">
    <div class=" max-w-7xl mx-auto h-full">
        <h1>Booking Overview</h1>
        <div><?php echo do_shortcode('[woocommerce_cart]'); ?></div>
    </div>
</div>

<?php get_footer(); ?>