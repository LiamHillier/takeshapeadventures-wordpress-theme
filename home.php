<?php
/* Template Name: Home */
get_header();
?>

<div class="home">
    <!-- Hero -->
    <div class="relative flex justify-center items-centerpx">
        <img src="/wp-content/uploads/2022/12/whitesunday_tour_take_shape_adventures-11-1.jpg" alt="take shape adventures hiking adventures" width="1980" height="1280" class="full-image" />
        <div class="overlay"></div>
        <!-- hero content -->
        <div class="max-w-5xl mx-auto text-center relative z-10 py-64 px">
            <h1 class="uppercase text-white text-5xl">Bringing People Together And Adventures to Life</h1>
            <div class="button-container mt-8">
                <a href="/calendar" class="button secondary">Calendar</a>
                <a href="/how-to-begin/" class="button alt">Getting Started</a>
            </div>
        </div>
    </div>
    <!-- Introduction -->
    <div class="px py-20 text-center max-w-5xl mx-auto">
        <h2>We Encourage Adventure To Improve Physical And Mental Wellbeing.</h2>
        <p class="mt-6">
            <strong>Adventure is for everybody</strong>
            <br /><br />
            Whether you’re wanting to live with a bit more adventure and don’t know where to start, or trying to decide what you’re next adventure will be, we’ve got you covered.
            <br /><br />
            <strong>Our </strong> vision is to offer a complete experience. We believe strongly in the healing benefits of exercise, nutrition, nature and community. We bring all of these things together with a huge array of experiences to suit everyone.
            <br /><br />
            <strong> Our difference </strong> is we are not just hiking guides. Our team is made up of personal trainers, nutritionists, park rangers, first aid experts, chefs and even a couple of circus acrobats! We offer the option of complete wellness support to help you live your best life.
        </p>
    </div>
    <!-- 50 / 50 Image & Text -->
    <div class="md:flex">
        <div class="relative w-full md:w-6/12 min-h-[540px] md:min-h-fit">
            <img src="/wp-content/uploads/2022/12/take-shape-adventures1-768x512.jpg.webp" alt="helping hand while hiking on trail" width="1000" height="700" class="full-image" />
        </div>
        <div class="w-full md:w-6/12 bg-secondary px py-20 flex flex-col items-center justify-center gap-6 text-white text-center">
            <h2>All you need to get started!</h2>
            <p class="text-center max-w-xl mx-auto">
                If you are new to hiking or looking to get back into adventure tour, our ‘Getting Started’ page is a great place to start.<br /><br />
                Learn about how we grade our hikes, things to consider before booking your first adventure with us and have all your questions answered in the FAQ section.
            </p>
            <a href="/how-to-begin" class="button alt md:mt-4">Getting Started</a>
        </div>
    </div>
    <!-- 50 / 50 Image & Text -->
    <div class="flex flex-col-reverse md:flex md:flex-row">
        <div class="w-full md:w-6/12 bg-zinc-900 px py-20 flex flex-col items-center justify-center gap-6 text-white text-center">
            <h2>Join Australia's fastest growing hiking community</h2>
            <p class="text-center max-w-xl mx-auto">
                Everyone starts somewhere. Let us be your somewhere and help you live a life of adventure you’ve only dreamed of! Join our growing community on Facebook and start to make real connections with real people. We can’t wait to meet you!
            </p>
            <a href="https://www.facebook.com/groups/629685937200599" target="_blank" class="button alt md:mt-4">Join Us</a>
        </div>
        <div class="relative w-full md:w-6/12 min-h-[540px] md:min-h-fit">
            <img src="/wp-content/uploads/2022/12/weekendescape_wilsonsprom-_bigdrift_group11.jpg" alt="helping hand while hiking on trail" width="1000" height="700" class="full-image" />
        </div>
    </div>
    <!-- Adventure Types -->
    <?php get_template_part('components/elements/adventure-types'); ?>
    <?php get_template_part('components/elements/become-a-member-banner'); ?>
    <div class="md:flex">
        <div class="relative w-full md:w-6/12 min-h-[540px] md:min-h-fit">
            <img src="/wp-content/uploads/2022/12/take-shape-adventures1-768x512.jpg.webp" alt="helping hand while hiking on trail" width="1000" height="700" class="full-image" />
        </div>
        <div class="w-full md:w-6/12 bg-amber-500 px py-32 flex flex-col items-center justify-center gap-6 text-white text-center">
            <h2>Hiking Tips, insights and amazing stories</h2>
            <p class="text-center max-w-xl mx-auto">
                Not quite sure where to start? What to bring? What tour to choose or who to talk to? Check out the TSA Hiking Blog where we answer all your burning questions around hiking and more.
            </p>
            <a href="/blogs" class="button alt md:mt-4">Our blogs</a>
        </div>
    </div>
    <?php get_template_part('components/elements/upcoming-events'); ?>
    <?php get_template_part('components/elements/hike-the-world'); ?>
</div>

<?php get_footer(); ?>