<?php
// Template name: Support
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
        <?php if ( have_rows( 'support_images' ) ) : while ( have_rows( 'support_images' ) ) : the_row(); ?>
            <aside>
                <?php $i = 0;
                while ( $i < 3 ): $i++ ?>
                    <?php if ( get_sub_field( 'image_' . $i ) ) : ?>
                        <?php $imgArr = get_sub_field( 'image_' . $i ) ?>
                        <img src="<?php echo $imgArr['url'] ?>" alt="<?php echo $imgArr['alt'] ?>">
                    <?php endif; ?>
                <?php endwhile; ?>
            </aside>
        <?php endwhile; endif; ?>
    <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
