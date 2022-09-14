<?php
/**
 * Template Name: Subscribed
 *
 * @package WordPress
 * @subpackage VU-AMS
 */
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<header>
    <h1>
        <?php the_title(); ?>
    </h1>
</header>
<div class="content">
    <main>
        <?php the_content(); ?>
    </main>
</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>