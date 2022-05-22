<?php
// Template name: Hardware
?>
<?php get_header(); ?>

<header>
    <h1>
        <?php the_title(); ?>
    </h1>
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
            <?php if ( get_sub_field( 'hardware_image' ) ) : ?>
                <?php $hardwareImg = get_sub_field( 'hardware_image' ); ?>
                <img src="<?php echo $hardwareImg['url'] ?>" alt="<?php echo $hardwareImg['alt'] ?>">
            <?php endif; ?>
        </section>
    <?php endwhile; endif; ?>
</header>
<main class="content">
    <section class="content__measurement">
        <?php if ( have_rows( 'measurement' ) ) : while ( have_rows( 'measurement' ) ) : the_row(); ?>
            <?php if ( get_sub_field( 'head' ) ) : ?>
                <h2>
                    <?php the_sub_field( 'head' ); ?>
                </h2>
            <?php endif; ?>
            <?php if ( get_sub_field( 'content' ) ) : ?>
                <div class="table-container">
                    <?php the_sub_field( 'content' ); ?>
                </div>
            <?php endif; ?>
        <?php endwhile; endif; ?>
    </section>
    <section class="content__content">
        <?php the_content(); ?>
    </section>
</main>
<?php get_footer(); ?>
