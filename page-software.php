<?php
// Template name: Software
?>
<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <header>
        <h1><?php the_title(); ?></h1>
        <div class="content">
            <?php if ( have_rows( 'header' ) ) : while ( have_rows( 'header' ) ): the_row(); ?>
                <?php if ( get_sub_field( 'header_text' ) ) : ?>
                    <?php the_sub_field( 'header_text' ); ?>
                <?php endif; ?>
            <?php endwhile; endif; ?>
        </div>
    </header>


    <main class="content">
        <?php the_content(); ?>
    </main>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
