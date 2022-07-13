<?php
/**
 * Template name: My account
 *
 * @package    WordPress
 * @subpackage VU-AMS
 */

?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="content">
	<header>
		<h1>
			<?php the_title(); ?>
		</h1>
	</header>
	<main>
		<?php the_content();?>
	</main>
</div>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>
