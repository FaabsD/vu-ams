<?php
// Template Name: Get a Quote
?>

<?php get_header(); ?>

<header class="header">
    <div class="header__left">
        <?php if ( get_field( 'page_head' ) ) : ?>
            <div class="header__heading">
                <?php the_field( 'page_head' ); ?>
            </div>
        <?php endif; ?>
        <?php if ( get_field( 'page_image' ) ) : ?>
            <?php $headerImg = get_field( 'page_image' ); ?>
            <img src="<?php echo $headerImg['url'] ?>" alt="<?php echo $headerImg['alt'] ?>" class="header__image">
        <?php endif; ?>
        <?php if ( get_field( 'page_text' ) ) : ?>
            <div class="header__text">
                <?php the_field( 'page_text' ); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="header__right">
        <?php if ( get_field( 'contact_form' ) ) : ?>
            <?php the_field( 'contact_form' ); ?>
        <?php endif; ?>
    </div>
</header>

<div class="about">
    <?php if ( have_rows( 'more' ) ) : while ( have_rows( 'more' ) ) : the_row(); ?>
        <?php if ( get_sub_field( 'more_head' ) ) : ?>
            <div class="about__heading">
                <h2>
                    <?php the_sub_field( 'more_head' ) ?>
                </h2>
            </div>
        <?php endif; ?>

        <?php if ( have_rows( 'more_section_left' ) ) : while ( have_rows( 'more_section_left' ) ) : the_row(); ?>
            <div class="section">
                <?php if ( get_sub_field( 'section_image' ) ) : ?>
                    <?php $sectionImg = get_sub_field( 'section_image' ); ?>
                    <img src="<?php echo $sectionImg['url'] ?>" alt="<?php echo $sectionImg['alt'] ?>"
                         class="section__img">
                <?php endif; ?>

                <?php if ( get_sub_field( 'section_head' ) ) : ?>
                    <h3 class="section__heading">
                        <?php the_sub_field( 'section_head' ); ?>
                    </h3>
                <?php endif; ?>

                <?php if ( get_sub_field( 'section_text' ) ) : ?>
                    <div class="section__text">
                        <?php the_sub_field( 'section_text' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( get_sub_field( 'section_link' ) ) : ?>
                    <?php $sectionLink = get_sub_field( 'section_link' ); ?>
                    <a href="<?php echo $sectionLink['url'] ?>" target="<?php echo $sectionLink['target'] ?>"
                       title="<?php echo $sectionLink['title'] ?>"
                       class="section__link">
                        <?php echo $sectionLink['title'] ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endwhile; endif; ?>

        <?php if ( have_rows( 'more_section_middle' ) ) : while ( have_rows( 'more_section_middle' ) ) : the_row(); ?>
            <div class="section">
                <?php if ( get_sub_field( 'section_image' ) ) : ?>
                    <?php $sectionImg = get_sub_field( 'section_image' ); ?>
                    <img src="<?php echo $sectionImg['url'] ?>" alt="<?php echo $sectionImg['alt'] ?>"
                         class="section__img">
                <?php endif; ?>

                <?php if ( get_sub_field( 'section_head' ) ) : ?>
                    <h3 class="section__heading">
                        <?php the_sub_field( 'section_head' ); ?>
                    </h3>
                <?php endif; ?>

                <?php if ( get_sub_field( 'section_text' ) ) : ?>
                    <div class="section__text">
                        <?php the_sub_field( 'section_text' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( get_sub_field( 'section_link' ) ) : ?>
                    <?php $sectionLink = get_sub_field( 'section_link' ); ?>
                    <a href="<?php echo $sectionLink['url'] ?>" target="<?php echo $sectionLink['target'] ?>"
                       title="<?php echo $sectionLink['title'] ?>"
                       class="section__link">
                        <?php echo $sectionLink['title'] ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endwhile; endif; ?>
        <?php if ( have_rows( 'more_section_right' ) ) : while ( have_rows( 'more_section_right' ) ) : the_row(); ?>
            <div class="section">
                <?php if ( get_sub_field( 'section_image' ) ) : ?>
                    <?php $sectionImg = get_sub_field( 'section_image' ); ?>
                    <img src="<?php echo $sectionImg['url'] ?>" alt="<?php echo $sectionImg['alt'] ?>"
                         class="section__img">
                <?php endif; ?>

                <?php if ( get_sub_field( 'section_head' ) ) : ?>
                    <h3 class="section__heading">
                        <?php the_sub_field( 'section_head' ); ?>
                    </h3>
                <?php endif; ?>

                <?php if ( get_sub_field( 'section_text' ) ) : ?>
                    <div class="section__text">
                        <?php the_sub_field( 'section_text' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( get_sub_field( 'section_link' ) ) : ?>
                    <?php $sectionLink = get_sub_field( 'section_link' ); ?>
                    <a href="<?php echo $sectionLink['url'] ?>" target="<?php echo $sectionLink['target'] ?>"
                       title="<?php echo $sectionLink['title'] ?>"
                       class="section__link">
                        <?php echo $sectionLink['title'] ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endwhile; endif; ?>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
