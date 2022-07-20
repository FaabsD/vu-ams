<?php
/**
 * Template Name: Manual Page
 *
 * @package WordPress
 * @subpackage VU-AMS
 * */

?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<header>
	<h1>
		<?php the_title(); ?>
	</h1>
</header>

<main class="content">
		<?php the_content(); ?>
</main>

<?php endwhile; endif; ?>

<?php get_footer(); ?>

