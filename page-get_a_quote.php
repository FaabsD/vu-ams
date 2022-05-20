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
        <?php if ( get_field( 'page_text' ) ) : ?>
            <div class="header__text">
                <?php the_field( 'page_text' ); ?>
            </div>
        <?php endif; ?>
        <?php if ( have_rows( 'page_images' ) ) : while ( have_rows( 'page_images' ) ) : the_row(); ?>
            <div class="header__hand-animation">
                <div class="inner">
                    <?php if ( get_sub_field( 'page_image_hand' ) ) : ?>
                        <?php $handImageArr = get_sub_field( 'page_image_hand' ); ?>
                        <img src="<?php echo $handImageArr['url'] ?>" alt="<?php echo $handImageArr['alt'] ?>"
                             class="hand">
                    <?php endif; ?>

                    <?php if ( get_sub_field( 'page_image_arrow' ) ) : ?>
                        <?php $arrowImageArr = get_sub_field( 'page_image_arrow' ); ?>
                        <img src="<?php echo $arrowImageArr['url'] ?>" alt="<?php echo $arrowImageArr['alt'] ?>"
                             class="arrow">
                    <?php endif; ?>

                    <?php if ( get_sub_field( 'page_image_letter' ) ) : ?>
                        <?php $letterImageArr = get_sub_field( 'page_image_letter' ); ?>
                        <img src="<?php echo $letterImageArr['url'] ?>" alt="<?php echo $letterImageArr['alt'] ?>"
                             class="letter">
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; endif; ?>
        <div class="dotted-shape"></div>
    </div>
    <div class="header__right">
        <?php if ( get_field( 'contact_form' ) ) : ?>
            <?php the_field( 'contact_form' ); ?>
        <?php endif; ?>
    </div>
</header>

<div class="about">
    <div class="dotted-shape"></div>
    <?php if ( have_rows( 'more' ) ) : while ( have_rows( 'more' ) ) : the_row(); ?>
        <?php if ( get_sub_field( 'more_head' ) ) : ?>
            <div class="about__heading">
                <div class="about__heartbeat">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 85.31 76.61">
                        <g id="a">
                            <path d="M71.36,42.01v3.12h-9.88l-2.17-6.39c-.29-.85-.96-.9-1.13-.9-.2,0-.84,.06-1.14,.89l-.06,.16-3.81,8.28h-3.78l-2.22,20.91-2.59-.11c-.15-3.2-.33-6.71-.51-10.38,0-.01-.01-.01-.01-.02-.02-.36-.04-.73-.05-1.09-.1-2-.21-4.04-.32-6.1-.53-9.73-1.12-19.72-1.65-27.01l-3.96,34.03-1.8-5.6c-.66-2.05-1.66-4.21-2.15-4.68h-.38c-2.74-.14-3.63-.27-4.15-.57-1.49-.86-2.34-2.55-3.1-4.05-.41-.83-1.04-2.08-1.39-2.09-.64-.04-.92,.34-1.7,1.74-.3,.54-.64,1.16-1.06,1.71-1,1.31-2.71,2.64-4.28,2.64h-4.12v-3.13h4.12c.61,0,1.69-.75,2.37-1.63,.28-.37,.54-.83,.81-1.33,.75-1.35,1.77-3.23,3.94-3.13,1.76,.08,2.7,1.94,3.54,3.6,.59,1.18,1.2,2.4,1.99,2.84,.36,.13,2.37,.22,3.13,.27l.55,.03c.8,.04,1.59,.73,2.38,2.06l4.37-37.56,1.84,2.11c.38,.46,1.22,1.41,3.07,35.13h0v.02c.09,1.67,.18,3.42,.28,5.26v.16l.03-.23,.54-5.02c.1-1.08,.87-1.9,1.79-1.9h2.94l3.04-6.61c.62-1.69,1.95-2.73,3.49-2.73h.02c1.57,0,2.92,1.09,3.52,2.86l1.51,4.44h8.14Z"/>
                        </g>
                        <g id="b"/>
                        <g id="c"/>
                    </svg>
                </div>
                <?php $more_head = colorize_last_string_word( get_sub_field( 'more_head' ) ); ?>
                <h2>
                    <?php echo $more_head ?>
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

        <?php if ( get_sub_field( 'more_link_button' ) ) : ?>
            <?php $more_link = get_sub_field( 'more_link_button' ); ?>
            <a href="<?php echo $more_link['url'] ?>" title="<?php echo $more_link['title'] ?>"
               target="<?php echo $more_link['target'] ?>" class="about__more">
                <?php echo $more_link['title'] ?>
            </a>
        <?php endif; ?>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
