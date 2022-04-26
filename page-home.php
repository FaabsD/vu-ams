<?php
// Template Name: Home
?>

<?php get_header(); ?>

<!-- Homepage Header -->
<header class="header">
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
    <svg viewBox="0 0 295 326" xmlns="http://www.w3.org/2000/svg" class="header__shape">
        <defs>
            <linearGradient id="myGradient">
                <stop offset="5%" stop-color="skyblue"/>
                <stop offset="95%" stop-color="#424242"/>
            </linearGradient>
        </defs>

        <path d="M1 324.5V1H294.5V299L1 324.5Z"/>
    </svg>

</header>

<?php if ( have_posts() ) : while ( have_posts() ) :
    the_post(); ?>
    <div class="container prose">
        <?php the_content(); ?>
    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
