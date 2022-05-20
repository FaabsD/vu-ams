<?php
// Template name: Hardware
?>
<?php get_header(); ?>

<header>
    <?php the_title(); ?>
    <?php if ( have_rows( 'specifications' ) ) : while ( have_rows( 'specifications' ) ) : the_row(); ?>
        <section>
            <?php if ( get_sub_field( 'head' ) ) : ?>
                <h2>
                    <?php the_sub_field( 'head' ); ?>
                </h2>
            <?php endif; ?>
            <?php if ( get_sub_field( 'text' ) ) : ?>
                <?php the_sub_field( 'text' ); ?>
            <?php endif; ?>

        </section>
        <section>
            <?php if (get_sub_field('hardware_image')) : ?>
            <?php $hardwareImg = get_sub_field('hardware_image'); ?>
                <img src="<?php echo $hardwareImg['url']?>" alt="<?php echo $hardwareImg['alt']?>">
            <?php endif; ?>
        </section>
    <?php endwhile; endif; ?>
</header>
<main>

</main>
<?php get_footer(); ?>
