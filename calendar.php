<?php
/* Template Name: Calendar */
get_header();
?>

<div class="px pt-10 bg-gray-50 pb-32">
    <h1 class="mb-2">Calendar</h1>
    <p class="max-w-xl">We have a lot of events! So browse our events and use the filters down the side to help choose your next event. From short events through to overseas trips, we can take you on an adventure that will suit your level of challenge. </p>
    <div class="event-filter">
        <?php echo do_shortcode('[searchandfilter id="9804"]'); ?>
    </div>
    <div class="events-container">
        <?php echo do_shortcode('[searchandfilter id="9804" show="results"]'); ?>
    </div>
</div>

<?php get_footer(); ?>