<?php
// Template Name: Teampage
?>

<?php get_header(); ?>
<header class="header">
    <h1>
        <?php the_title(); ?>
    </h1>
</header>

<div class="team">
    <?php
    $ars = array(
        'post_type' => 'team-member',
    );
    $query = new WP_Query( $ars );
    ?>

    <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="team__member">
            <div class="member__img-section">
                <?php the_post_thumbnail(); ?>
            </div>

            <div class="member__text-section">
                <h2 class="member__name">
                    <?php the_title(); ?>
                </h2>
                <div class="member__text">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
