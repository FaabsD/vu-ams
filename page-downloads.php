<?php
// Template Name: Downloads
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <header>
        <h1><?php the_title(); ?></h1>
    </header>

    <?php if ( have_rows( 'header' ) ) : while ( have_rows( 'header' ) ) : the_row(); ?>
        <div class="header">
            <div>
                <?php if ( get_sub_field( 'head' ) ) : ?>
                    <h2>
                        <?php the_sub_field( 'head' ); ?>
                    </h2>
                <?php endif; ?>
                <?php if ( get_sub_field( 'text' ) && get_sub_field( 'download' ) && get_sub_field( 'download_button_text' ) ) : ?>
                    <?php $header_download = get_sub_field( 'download' ); ?>

                    <p>
                        <?php the_sub_field( 'text' ); ?>
                    </p>
                    <!-- <a href="<?php echo $header_download['url'] ?>" class="btn" download>
                        <?php the_sub_field( 'download_button_text' ); ?>
                    </a> -->
                <?php endif; ?>
            </div>
            <?php if ( get_sub_field( 'image' ) ) : ?>
                <?php $header_image = get_sub_field( 'image' ) ?>
                <img src="<?php echo $header_image['url'] ?>" alt="<?php echo $header_image['alt'] ?>">
            <?php endif; ?>
        </div>
    <?php endwhile; endif; ?>
    <main class="content">
        <?php the_content(); ?>
    </main>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
