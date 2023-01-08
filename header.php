<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">



	<?php wp_head(); ?>

	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
</head>

<body <?php body_class('bg-white text-gray-900 antialiased'); ?>>
	<?php do_action('takeshapeadventures_site_before'); ?>
	<div id="page" class="min-h-screen flex flex-col">
		<?php do_action('takeshapeadventures_header'); ?>

		<?php get_template_part('template-parts/header/header'); ?>
		<?php get_template_part('template-parts/header/mega-menu'); ?>
		<?php get_template_part('template-parts/header/promo-bar'); ?>


		<div id="content" class="site-content flex-grow">
			<?php do_action('takeshapeadventures_content_start'); ?>
			<main>