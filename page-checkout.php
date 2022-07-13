<?php
/**
 * Template name: Checkout
 *
 * @package WordPress
 * @subpackage VU-AMS
 * */
?>

<?php get_header(); ?>

<div class="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<header>
			<h1>
				<?php the_title(); ?>
			</h1>
		</header>
		<main>
			<?php the_content(); ?>
		</main>
	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
