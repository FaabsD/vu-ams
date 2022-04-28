<?php
// Template Name: Home
?>

<?php get_header(); ?>

<!-- Homepage Header -->
<header class="header">
    <div class="header__content">
        <div class="header__text">
            <?php if ( get_field( 'header_text' ) && !empty( get_field( 'header_text' ) ) ) : ?>
                <?php the_field( 'header_text' ); ?>
            <?php endif; ?>
        </div>
        <div class="header__buttons">
            <?php if ( have_rows( 'homepage_header_buttons' ) ) : while ( have_rows( 'homepage_header_buttons' ) ) : the_row(); ?>
                <?php
                $btn1 = get_sub_field( 'header_button_1' );
                $btn2 = get_sub_field( 'header_button_2' );
                ?>

                <a href="<?php echo $btn1['url'] ?>" class="buttons__btn1" target="<?php echo $btn1['target'] ?>"
                   title="<?php echo $btn1['title'] ?>">
                    <?php echo $btn1['title'] ?>
                </a>

                <a href="<?php echo $btn2['url'] ?>" class="buttons__btn2" target="<?php echo $btn2['target'] ?>"
                   title="<?php echo $btn2['title'] ?>">
                    <?php echo $btn2['title'] ?>
                </a>
            <?php endwhile; endif; ?>
        </div>
    </div>
    <div class="header__shape"></div>


    <!-- Header images -->
    <?php if ( get_field( 'header_image_1' ) || get_field( 'header_image_2' ) ) : ?>
        <div class="header__images">
            <div class="header__images--1">
                <?php $img1 = get_field( 'header_image_1' ); ?>
                <img src="<?php echo $img1['url'] ?>" alt="<?php echo $img1['alt'] ?>">
            </div>
            <div class="header__images--2">
                <?php $img2 = get_field( 'header_image_2' ); ?>
                <img src="<?php echo $img2['url'] ?>" alt="<?php echo $img2['alt'] ?>">
            </div>

        </div>
    <?php endif; ?>

</header>

<?php if ( have_posts() ) : while ( have_posts() ) :
    the_post(); ?>
    <div class="container prose">
        <?php the_content(); ?>
    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
