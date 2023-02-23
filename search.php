<?php
/* Template Name: Search */
get_header();
?>

<div class="px pt-10 bg-gray-50 pb-32">
    <h1 class="mb-2">Search results</h1>
    <div class="event-filter">
        <?php echo do_shortcode('[searchandfilter id="29867"]'); ?>
    </div>
    <div class="events-container">
        <?php echo do_shortcode('[searchandfilter id="29867" show="results"]'); ?>
    </div>
</div>

<?php get_footer(); ?>