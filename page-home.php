<?php
// Template Name: Home
?>

<?php get_header(); ?>

<!-- Homepage Header -->
<header class="header" style="background-image: url(<?php echo get_field('header_background_image') ? get_field('header_background_image')['url'] : '' ?>);">
	<div class="header__content">
		<div class="header__text">
			<?php if (get_field('header_text') && !empty(get_field('header_text'))) : ?>
				<?php the_field('header_text'); ?>
			<?php endif; ?>
		</div>
		<div class="header__buttons">
			<?php if (have_rows('homepage_header_buttons')) : while (have_rows('homepage_header_buttons')) : the_row(); ?>
				<?php
                    $btn1 = get_sub_field('header_button_1');
			    $btn2 = get_sub_field('header_button_2');
			    $btn3 = get_sub_field('header_button_3');
			    ?>

				<a href="<?php echo $btn1['url'] ?>" class="buttons__btn1" target="<?php echo $btn1['target'] ?>"
					title="<?php echo $btn1['title'] ?>">
					<?php echo $btn1['title'] ?>
				</a>

				<a href="<?php echo $btn2['url'] ?>" class="buttons__btn2" target="<?php echo $btn2['target'] ?>"
					title="<?php echo $btn2['title'] ?>">
					<?php echo $btn2['title'] ?>
				</a>
				<?php if ($btn3) : ?>
					<a href="<?php echo $btn3['url'] ?>" class="buttons__btn3" target="<?php echo $btn3['target'] ?>" 
						target="<?php echo $btn3['title'] ?>">
						<?php echo $btn3['title']; ?>
					</a>
				<?php endif; ?>
			<?php endwhile; endif; ?>
		</div>
	</div>


    <!-- Header images -->
    <?php if (get_field('header_image_1') || get_field('header_image_2')) : ?>
        <?php

        $imgGroup1 = get_field('header_image_1');
        $imgGroup2 = get_field('header_image_2');

        ?>
        <div class="header__slider">
            <div class="slider__img">
                <?php if (isset($imgGroup1['url']) && is_array($imgGroup1['url']) && count($imgGroup1['url']) >= 1) : ?>
                    <a href="<?php echo $imgGroup1['url']['url'] ?>" title="<?php echo $imgGroup1['url']['title'] ?>" target="<?php echo $imgGroup1['url']['target']?>">
                    <img src="<?php echo $imgGroup1['image']['url'] ?>" alt="<?php echo $imgGroup1['image']['alt'] ?>">
                    </a>
                    <?php else : ?>
                        <img src="<?php echo $imgGroup1['image']['url'] ?>" alt="<?php echo $imgGroup1['image']['alt'] ?>">
                <?php endif; ?>
            </div>
            <div class="slider__img slider__img--hidden">
                <?php if (isset($imgGroup2['url']) && is_array($imgGroup2['url']) && count($imgGroup2['url']) >= 1) : ?>
                    <a href="<?php echo $imgGroup2['url']['url'] ?>" title="<?php echo $imgGroup2['url']['title']?>" target="<?php echo $imgGroup2['url']['target']?>">
                        <img src="<?php echo $imgGroup2['image']['url'] ?>" alt="<?php echo $imgGroup2['image']['alt'] ?>">
                    </a>
                    <?php else : ?>
                        <img src="<?php echo $imgGroup2['image']['url'] ?>" alt="<?php echo $imgGroup2['image']['alt'] ?>">
                <?php endif; ?>
            </div>
            <div class="slider__nav">
                <div class="nav__thumb">
                    <img src="<?php echo $imgGroup1['image']['url'] ?>" alt="<?php echo $imgGroup1['image']['alt'] ?>">
                </div>
                <div class="nav__thumb nav__thumb--inactive">
                    <img src="<?php echo $imgGroup2['image']['url'] ?>" alt="<?php echo $imgGroup2['image']['alt'] ?>">
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Header dots -->
    <div class="dots1 bg-dots"></div>

    <div class="dots2 bg-dots"></div>
</header>

<!-- Homepage (caption Slider) -->
<?php if (get_field('image_caption_slider')) : ?>
<div class="caption-slider-container">
    <?php echo do_shortcode(get_field('image_caption_slider')); ?>
</div>
<?php endif ?>

<!-- Approved by section -->
<div class="approved">
    <?php if (get_field('approved_by')) : ?>
        <?php the_field('approved_by'); ?>
    <?php endif; ?>
</div>

<!-- Learnmore section -->
<div class="learn-more">
    <?php if (get_field('learn_more_head')) : ?>

        <?php
        $learn_more_title = colorize_last_string_word(get_field('learn_more_head'));

        ?>

        <div class="learn-more__heartbeat">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 85.31 76.61">
                <g id="a">
                    <path d="M71.36,42.01v3.12h-9.88l-2.17-6.39c-.29-.85-.96-.9-1.13-.9-.2,0-.84,.06-1.14,.89l-.06,.16-3.81,8.28h-3.78l-2.22,20.91-2.59-.11c-.15-3.2-.33-6.71-.51-10.38,0-.01-.01-.01-.01-.02-.02-.36-.04-.73-.05-1.09-.1-2-.21-4.04-.32-6.1-.53-9.73-1.12-19.72-1.65-27.01l-3.96,34.03-1.8-5.6c-.66-2.05-1.66-4.21-2.15-4.68h-.38c-2.74-.14-3.63-.27-4.15-.57-1.49-.86-2.34-2.55-3.1-4.05-.41-.83-1.04-2.08-1.39-2.09-.64-.04-.92,.34-1.7,1.74-.3,.54-.64,1.16-1.06,1.71-1,1.31-2.71,2.64-4.28,2.64h-4.12v-3.13h4.12c.61,0,1.69-.75,2.37-1.63,.28-.37,.54-.83,.81-1.33,.75-1.35,1.77-3.23,3.94-3.13,1.76,.08,2.7,1.94,3.54,3.6,.59,1.18,1.2,2.4,1.99,2.84,.36,.13,2.37,.22,3.13,.27l.55,.03c.8,.04,1.59,.73,2.38,2.06l4.37-37.56,1.84,2.11c.38,.46,1.22,1.41,3.07,35.13h0v.02c.09,1.67,.18,3.42,.28,5.26v.16l.03-.23,.54-5.02c.1-1.08,.87-1.9,1.79-1.9h2.94l3.04-6.61c.62-1.69,1.95-2.73,3.49-2.73h.02c1.57,0,2.92,1.09,3.52,2.86l1.51,4.44h8.14Z"/>
                </g>
                <g id="b"/>
                <g id="c"/>
            </svg>
        </div>

        <h3 class="learn-more__heading">
            <?php echo $learn_more_title; ?>
        </h3>
        <div class="dots bg-dots"></div>
    <?php endif; ?>
    <?php if (get_field('learn_more_description')) : ?>
        <div class="learn-more__description">
            <?php the_field('learn_more_description'); ?>
        </div>
    <?php endif; ?>

    <?php if (have_rows('learn_more_data')) : ?>
        <div class="learn-more__data-section">
            <?php while (have_rows('learn_more_data')) : the_row(); ?>

                <?php
                $dataImageArr = get_sub_field('learn_more_data_image');
                $dataHead = get_sub_field('learn_more_data_head');
                $dataText = get_sub_field('learn_more_data_text');
                $dataUrl = get_sub_field('learn_more_data_url');
                ?>

                <!-- Learn more Data Img -->
                <?php if ($dataImageArr) : ?>
                    <div class="image">
                        <img src="<?php echo $dataImageArr['url'] ?>" alt="<?php echo $dataImageArr['alt'] ?>">
                    </div>
                <?php endif; ?>
                <section>
                    <!-- Learn more Data Heading -->
                    <?php if ($dataHead) : ?>
                        <h3>
                            <?php the_sub_field('learn_more_data_head'); ?>
                        </h3>
                    <?php endif; ?>

                    <!-- Learn more Data text -->
                    <?php if ($dataText) : ?>
                        <?php the_sub_field('learn_more_data_text'); ?>
                    <?php endif; ?>

                    <!-- Learn more Data Link -->
                    <?php if ($dataUrl) : ?>
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

        <?php if (have_rows('learn_more_hardware')) : while (have_rows('learn_more_hardware')): the_row(); ?>
            <div class="hardware">
                <?php if (get_sub_field('learn_more_hardware_text')) : ?>
                    <div class="hardware__text">
                        <?php the_sub_field('learn_more_hardware_text'); ?>
                    </div>
                <?php endif; ?>

                <?php if (get_sub_field('learn_more_hardware_url')) : ?>
                    <?php
                    $hardwareUrl = get_sub_field('learn_more_hardware_url');
                    ?>
                    <a href="<?php echo $hardwareUrl['url'] ?>" class="hardware__link"
                       target="<?php echo $hardwareUrl['target'] ?>"
                       title="<?php echo $hardwareUrl['title'] ?>">
                        <?php echo $hardwareUrl['title'] ?>
                    </a>
                <?php endif; ?>

                <?php if (get_sub_field('learn_more_hardware_image')) : ?>
                    <?php
                    $hardwareImageArr = get_sub_field('learn_more_hardware_image');
                    ?>
                    <div class="hardware__image">
                        <img src="<?php echo $hardwareImageArr['url'] ?>" alt="<?php echo $hardwareImageArr['alt'] ?>">
                    </div>
                <?php endif; ?>

            </div>
        <?php endwhile; endif; ?>

        <?php if (have_rows('learn_more_software')) : while (have_rows('learn_more_software')) : the_row(); ?>
            <div class="software">
                <?php if (get_sub_field('learn_more_software_text')) : ?>
                    <div class="software__text">
                        <?php the_sub_field('learn_more_software_text'); ?>
                    </div>
                <?php endif; ?>

                <?php if (get_sub_field('learn_more_software_url')) : ?>
                    <?php
                    $softwareUrl = get_sub_field('learn_more_software_url');
                    ?>
                    <a href="<?php echo $softwareUrl['url'] ?>" class="hardware__link"
                       target="<?php echo $softwareUrl['target'] ?>"
                       title="<?php echo $softwareUrl['title'] ?>">
                        <?php echo $softwareUrl['title'] ?>
                    </a>
                <?php endif; ?>

                <?php if (get_sub_field('learn_more_software_image')) : ?>
                    <?php
                    $softwareImageArr = get_sub_field('learn_more_software_image')
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
    <?php if (have_rows('innovative_experience_section')) : while (have_rows('innovative_experience_section')) :
        the_row(); ?>

        <?php if (get_sub_field('innovative_experience_head') && get_sub_field('innovative_experience_description')) : ?>
        <?php
        $innovative_head = colorize_last_string_word(get_sub_field('innovative_experience_head'));
            ?>
        <section>
            <h2 class="innovative-experience__head">
                <?php echo $innovative_head; ?>
            </h2>
            <?php the_sub_field('innovative_experience_description'); ?>
        </section>
    <?php endif; ?>
        <section class="innovative-experience__image-box">
            <?php for ($i = 1; $i <= 4; $i++) : ?>
                <?php if (get_sub_field('innovative_experience_image_' . $i)) : ?>
                    <?php $innovativeImgArr = get_sub_field('innovative_experience_image_' . $i); ?>
                    <div class="innovative-experience__img--<?php echo $i; ?>">
                        <img src="<?php echo $innovativeImgArr['url'] ?>" alt="<?php echo $innovativeImgArr['alt'] ?>">
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </section>

    <?php endwhile; endif; ?>
</div>


<!-- What is -->
<div class="what-is">
    <?php if (get_field('what_is_title')): ?>

        <?php
            $what_is_title = colorize_last_string_word(get_field('what_is_title'));

        ?>
        <div class="what-is__heartbeat">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 85.31 76.61">
                <g id="a">
                    <path d="M71.36,42.01v3.12h-9.88l-2.17-6.39c-.29-.85-.96-.9-1.13-.9-.2,0-.84,.06-1.14,.89l-.06,.16-3.81,8.28h-3.78l-2.22,20.91-2.59-.11c-.15-3.2-.33-6.71-.51-10.38,0-.01-.01-.01-.01-.02-.02-.36-.04-.73-.05-1.09-.1-2-.21-4.04-.32-6.1-.53-9.73-1.12-19.72-1.65-27.01l-3.96,34.03-1.8-5.6c-.66-2.05-1.66-4.21-2.15-4.68h-.38c-2.74-.14-3.63-.27-4.15-.57-1.49-.86-2.34-2.55-3.1-4.05-.41-.83-1.04-2.08-1.39-2.09-.64-.04-.92,.34-1.7,1.74-.3,.54-.64,1.16-1.06,1.71-1,1.31-2.71,2.64-4.28,2.64h-4.12v-3.13h4.12c.61,0,1.69-.75,2.37-1.63,.28-.37,.54-.83,.81-1.33,.75-1.35,1.77-3.23,3.94-3.13,1.76,.08,2.7,1.94,3.54,3.6,.59,1.18,1.2,2.4,1.99,2.84,.36,.13,2.37,.22,3.13,.27l.55,.03c.8,.04,1.59,.73,2.38,2.06l4.37-37.56,1.84,2.11c.38,.46,1.22,1.41,3.07,35.13h0v.02c.09,1.67,.18,3.42,.28,5.26v.16l.03-.23,.54-5.02c.1-1.08,.87-1.9,1.79-1.9h2.94l3.04-6.61c.62-1.69,1.95-2.73,3.49-2.73h.02c1.57,0,2.92,1.09,3.52,2.86l1.51,4.44h8.14Z"/>
                </g>
                <g id="b"/>
                <g id="c"/>
            </svg>
        </div>
        <h3 class="what-is__heading">
            <?php echo $what_is_title; ?>
        </h3>
        <div class="dots1 bg-dots"></div>
        <div class="dots2 bg-dots"></div>
    <?php endif; ?>
    <?php if (get_field('what_is_description')) : ?>
        <div class="what-is__description">
            <?php the_field('what_is_description'); ?>
        </div>
    <?php endif; ?>
    <!-- THREEJS Container -->
    <div id="THREE_container">

    </div>
</div>

<!-- Call to action -->
<div class="call-to-action">
    <section>
        <?php if (get_field('call_to_action_head')): ?>
            <?php $call_to_action_head = colorize_last_string_word(get_field('call_to_action_head')) ?>
            <h3 class="call-to-action__heading">
                <?php echo $call_to_action_head; ?>
            </h3>
        <?php endif; ?>

        <?php if (get_field('call_to_action_text')) : ?>
            <?php the_field('call_to_action_text'); ?>
        <?php endif; ?>
    </section>
    <?php if (get_field('call_to_action_form')) : ?>
        <section>
            <?php the_field('call_to_action_form'); ?>
        </section>
    <?php endif; ?>
</div>

<!-- Meet the Team -->
<div class="meet-the-team">
    <?php
    $memberArgs = [ 'post_type' => 'team-member' ];
$teamMembers = new WP_Query($memberArgs);
?>

    <?php if (get_field('meet_the_team_head')) : ?>
        <?php
    $meet_heading = colorize_last_string_word(get_field('meet_the_team_head'));
        ?>
        <div class="meet-the-team__heartbeat">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 85.31 76.61">
                <g id="a">
                    <path d="M71.36,42.01v3.12h-9.88l-2.17-6.39c-.29-.85-.96-.9-1.13-.9-.2,0-.84,.06-1.14,.89l-.06,.16-3.81,8.28h-3.78l-2.22,20.91-2.59-.11c-.15-3.2-.33-6.71-.51-10.38,0-.01-.01-.01-.01-.02-.02-.36-.04-.73-.05-1.09-.1-2-.21-4.04-.32-6.1-.53-9.73-1.12-19.72-1.65-27.01l-3.96,34.03-1.8-5.6c-.66-2.05-1.66-4.21-2.15-4.68h-.38c-2.74-.14-3.63-.27-4.15-.57-1.49-.86-2.34-2.55-3.1-4.05-.41-.83-1.04-2.08-1.39-2.09-.64-.04-.92,.34-1.7,1.74-.3,.54-.64,1.16-1.06,1.71-1,1.31-2.71,2.64-4.28,2.64h-4.12v-3.13h4.12c.61,0,1.69-.75,2.37-1.63,.28-.37,.54-.83,.81-1.33,.75-1.35,1.77-3.23,3.94-3.13,1.76,.08,2.7,1.94,3.54,3.6,.59,1.18,1.2,2.4,1.99,2.84,.36,.13,2.37,.22,3.13,.27l.55,.03c.8,.04,1.59,.73,2.38,2.06l4.37-37.56,1.84,2.11c.38,.46,1.22,1.41,3.07,35.13h0v.02c.09,1.67,.18,3.42,.28,5.26v.16l.03-.23,.54-5.02c.1-1.08,.87-1.9,1.79-1.9h2.94l3.04-6.61c.62-1.69,1.95-2.73,3.49-2.73h.02c1.57,0,2.92,1.09,3.52,2.86l1.51,4.44h8.14Z"
                    />
                </g>
                <g id="b"/>
                <g id="c"/>
            </svg>
        </div>
        <h2 class="meet-the-team__heading">
            <?php echo $meet_heading; ?>
        </h2>
    <?php endif; ?>

    <?php if (get_field('meet_the_team_readmore')) : ?>
        <?php $readMore = get_field('meet_the_team_readmore'); ?>
    <?php endif; ?>

    <?php if ($teamMembers->have_posts()) : ?>
        <div class="meet-the-team__members">
            <?php while ($teamMembers->have_posts()) : $teamMembers->the_post(); ?>
                <div class="members__member">
                    <div class="member__image-block">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="member__info-block">
                        <h2 class="member__heading">
                            <?php the_title(); ?>
                        </h2>
                        <div class="member__text">
                            <?php the_excerpt(); ?>
                        </div>
                        <?php if (isset($readMore)) : ?>
                            <a href="<?php echo $readMore['url'] ?>" target="<?php echo $readMore['target'] ?>"
                               title="<?php echo $readMore['title'] ?>" class="member__readmore">
                                <?php echo $readMore['title']; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    <?php endif; ?>
</div>

<?php if (have_posts()) : while (have_posts()) :
    the_post(); ?>
    <div class="container prose">
        <?php the_content(); ?>
    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
