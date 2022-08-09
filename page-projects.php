<?php 
/**
 * Template Name: Projects
 * 
 * @package    WordPress
 * @subpackage VU-AMS
 */

?>
<?php get_header(); ?>

<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
<header class="header">
	<h1>
		<?php the_title(); ?>
	</h1>
	<div class="header__content">
		<?php the_content(); ?>
	</div>
</header>
<?php wp_reset_query(); ?>
<?php endwhile; endif; ?>

<div class="content">
	<?php
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$projectsArgs = array(
			'post_type' => 'project',
			'posts_per_page' => 10,
			'paged' => $paged,
		);

		$projectsQuery = new WP_Query($projectsArgs);
	?>
</div>

<?php get_footer(); ?>