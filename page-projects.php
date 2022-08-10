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

	<?php if ($projectsQuery->have_posts()) : while($projectsQuery->have_posts()) : $projectsQuery->the_post(); ?>

		<div class="project">
			<h3 class="project__title">
				<?php the_title(); ?>
			</h3>
			<div class="project__content">
				<?php the_excerpt(); ?>
			</div>
			<?php if (check_longer_than_excerpt(get_the_excerpt($post->ID), get_the_content($post->ID))) : ?>
				<div class="project__read-more">
					<a href="<?php the_permalink(); ?>" class="read-more__button">
						<?php _e('Read more', THEME_TEXT_DOMAIN); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	<?php endwhile; ?>
	<?php else : ?>
		<div class="no-results">
			<?php _e('No projects found', THEME_TEXT_DOMAIN); ?>
		</div>
	<?php endif; ?>
</div>

<?php get_footer(); ?>