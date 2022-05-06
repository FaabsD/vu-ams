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

<!-- Approved by section -->
<div class="approved">
    <?php if ( get_field( 'approved_by' ) ) : ?>
        <?php the_field( 'approved_by' ); ?>
    <?php endif; ?>
</div>

<!-- Learnmore section -->
<div class="learn-more">
    <?php if ( get_field( 'learn_more_head' ) ) : ?>

        <?php
        $learn_more_title = colorize_last_string_word( get_field( 'learn_more_head' ) );

        ?>

        <div class="learn-more__heartbeat">
            <svg height="55.172" viewBox="0 0 177 55.172" width="177" xmlns="http://www.w3.org/2000/svg">
                <path d="m0 0h94.723c4.69 0 10.541-32.693 15.335-32.693 7.329 0 13.185 52.172 20.1 52.172 7.051 0 13.572-19.479 19.67-19.479h27.172"
                      transform="translate(0 34.193)"/>
            </svg>
        </div>

        <h3 class="learn-more__heading">
            <?php echo $learn_more_title; ?>
        </h3>
    <?php endif; ?>
    <?php if ( get_field( 'learn_more_description' ) ) : ?>
        <div class="learn-more__description">
            <?php the_field( 'learn_more_description' ); ?>
        </div>
    <?php endif; ?>

    <?php if ( have_rows( 'learn_more_data' ) ) : ?>
        <div class="learn-more__data-section">
            <?php while ( have_rows( 'learn_more_data' ) ) : the_row(); ?>

                <?php
                $dataImageArr = get_sub_field( 'learn_more_data_image' );
                $dataHead = get_sub_field( 'learn_more_data_head' );
                $dataText = get_sub_field( 'learn_more_data_text' );
                $dataUrl = get_sub_field( 'learn_more_data_url' );
                ?>

                <!-- Learn more Data Img -->
                <?php if ( $dataImageArr ) : ?>
                    <div class="image">
                        <img src="<?php echo $dataImageArr['url'] ?>" alt="<?php echo $dataImageArr['alt'] ?>">
                    </div>
                <?php endif; ?>
                <section>
                    <!-- Learn more Data Heading -->
                    <?php if ( $dataHead ) : ?>
                        <h3>
                            <?php the_sub_field( 'learn_more_data_head' ); ?>
                        </h3>
                    <?php endif; ?>

                    <!-- Learn more Data text -->
                    <?php if ( $dataText ) : ?>
                        <?php the_sub_field( 'learn_more_data_text' ); ?>
                    <?php endif; ?>

                    <!-- Learn more Data Link -->
                    <?php if ( $dataUrl ) : ?>
                        <a href="<?php echo $dataUrl['url'] ?>" class="data-link"
                           target="<?php echo $dataUrl['target'] ?>"
                           title="<?php echo $dataUrl['title'] ?>">
                            <?php echo $dataUrl['title'] ?>
                        </a>
                    <?php endif; ?>
                </section>

            <?php endwhile; ?>
        </div>
    <?php endif; ?>

    <div class="learn-more__hard-software">

        <div class="tabs">
            <a href="*" class="tabs__tab tabs__tab--active" data-tab-for="Hardware">
                Hardware
            </a>
            <a href="*" class="tabs__tab" data-tab-for="Software">
                Software
            </a>
        </div>

        <?php if ( have_rows( 'learn_more_hardware' ) ) : while ( have_rows( 'learn_more_hardware' ) ): the_row(); ?>
            <div class="hardware">
                <?php if ( get_sub_field( 'learn_more_hardware_text' ) ) : ?>
                    <div class="hardware__text">
                        <?php the_sub_field( 'learn_more_hardware_text' ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( get_sub_field( 'learn_more_hardware_url' ) ) : ?>
                    <?php
                    $hardwareUrl = get_sub_field( 'learn_more_hardware_url' );
                    ?>
                    <a href="<?php echo $hardwareUrl['url'] ?>" class="hardware__link"
                       target="<?php echo $hardwareUrl['target'] ?>"
                       title="<?php echo $hardwareUrl['title'] ?>">
                        <?php echo $hardwareUrl['title'] ?>
                    </a>
                <?php endif; ?>

                <?php if ( get_sub_field( 'learn_more_hardware_image' ) ) : ?>
                    <?php
                    $hardwareImageArr = get_sub_field( 'learn_more_hardware_image' );
                    ?>
                    <div class="hardware__image">
                        <img src="<?php echo $hardwareImageArr['url'] ?>" alt="<?php echo $hardwareImageArr['alt'] ?>">
                    </div>
                <?php endif; ?>

            </div>
        <?php endwhile; endif; ?>

        <?php if ( have_rows( 'learn_more_software' ) ) : while ( have_rows( 'learn_more_software' ) ) : the_row(); ?>
            <div class="software">
                <?php if ( get_sub_field( 'learn_more_software_text' ) ) : ?>
                    <div class="software__text">
                        <?php the_sub_field( 'learn_more_software_text' ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( get_sub_field( 'learn_more_software_url' ) ) : ?>
                    <?php
                    $softwareUrl = get_sub_field( 'learn_more_software_url' );
                    ?>
                    <a href="<?php echo $softwareUrl['url'] ?>" class="hardware__link"
                       target="<?php echo $softwareUrl['target'] ?>"
                       title="<?php echo $softwareUrl['title'] ?>">
                        <?php echo $softwareUrl['title'] ?>
                    </a>
                <?php endif; ?>

                <?php if ( get_sub_field( 'learn_more_software_image' ) ) : ?>
                    <?php
                    $softwareImageArr = get_sub_field( 'learn_more_software_image' )
                    ?>
                    <div class="software__image">
                        <img src="<?php echo $softwareImageArr['url'] ?>" alt="<?php echo $softwareImageArr['alt'] ?>">
                    </div>
                <?php endif; ?>

            </div>
        <?php endwhile; endif; ?>
    </div>
</div>

<!-- Innovative Experience section -->
<div class="innovative-experience">
    <?php if ( have_rows( 'innovative_experience_section' ) ) : while ( have_rows( 'innovative_experience_section' ) ) :
        the_row(); ?>

        <?php if ( get_sub_field( 'innovative_experience_head' ) && get_sub_field( 'innovative_experience_description' ) ) : ?>
        <?php
        $innovative_head = colorize_last_string_word( get_sub_field( 'innovative_experience_head' ) );
        ?>
        <section>
            <h2 class="innovative-experience__head">
                <?php echo $innovative_head; ?>
            </h2>
            <?php the_sub_field( 'innovative_experience_description' ); ?>
        </section>
    <?php endif; ?>
        <section class="innovative-experience__image-box">
            <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
                <?php if ( get_sub_field( 'innovative_experience_image_' . $i ) ) : ?>
                    <?php $innovativeImgArr = get_sub_field( 'innovative_experience_image_' . $i ); ?>
                    <div class="innovative-experience__img--<?php echo $i; ?>">
                        <img src="<?php echo $innovativeImgArr['url'] ?>" alt="<?php echo $innovativeImgArr['alt'] ?>">
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </section>

    <?php endwhile; endif; ?>
</div>

<div class="what-is">
    <?php if ( get_field( 'what_is_title' ) ): ?>

        <?php
        $what_is_title = colorize_last_string_word( get_field( 'what_is_title' ) );

        ?>
        <div class="what-is__heartbeat">
            <svg height="55.172" viewBox="0 0 177 55.172" width="177" xmlns="http://www.w3.org/2000/svg">
                <path d="m0 0h94.723c4.69 0 10.541-32.693 15.335-32.693 7.329 0 13.185 52.172 20.1 52.172 7.051 0 13.572-19.479 19.67-19.479h27.172"
                      transform="translate(0 34.193)"/>
            </svg>
        </div>
        <h3 class="what-is__heading">
            <?php echo $what_is_title; ?>
        </h3>
    <?php endif; ?>
    <?php if ( get_field( 'what_is_description' ) ) : ?>
        <div class="what-is__description">
            <?php the_field( 'what_is_description' ); ?>
        </div>
    <?php endif; ?>
    <!-- THREEJS Container -->
    <div id="THREE_container">

    </div>
</div>

<?php if ( have_posts() ) : while ( have_posts() ) :
    the_post(); ?>
    <div class="container prose">
        <?php the_content(); ?>
    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
