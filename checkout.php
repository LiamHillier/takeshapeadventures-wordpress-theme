<?php
/* Template Name: Checkout */
get_header();
?>

<div class="checkout pt-16 pb-32 px">
    <div class=" max-w-7xl mx-auto h-full">
        <h1>Checkout</h1>
        <div><?php echo do_shortcode('[woocommerce_checkout]'); ?></div>
    </div>
</div>

<?php get_footer(); ?>