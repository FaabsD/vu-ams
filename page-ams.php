<?php
// Template name: AMS
?>
<?php get_header(); ?>
<div class="content">
    <?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
        <main>
            <h1>
                <?php the_title(); ?>
            </h1>
            <?php the_content(); ?>
        </main>
        <?php if ( get_field( 'image' ) ) : ?>
            <?php $image = get_field( 'image' ); ?>

            <aside>
                <img src="<?php echo $image['url'] ?>" alt="<?php $image['alt'] ?>">
            </aside>
        <?php endif; ?>
    <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
