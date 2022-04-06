<?php get_header(); ?>
<div class="w-screen bg-teal-500">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="container prose">
            <?php the_content(); ?>
            <?php if ( comments_open() || get_comments_number() ) : ?>
                <?php comments_template(); ?>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
    <?php else : ?>
        <article class="prose">
            <header>
                <h1>
                    <?php esc_html_e('Nothing found', THEME_TEXT_DOMAIN) ?>
                </h1>
            </header>
            <div>
                <p>
                    <?php esc_html_e('It looks like nothing was found on this location', THEME_TEXT_DOMAIN); ?>
                </p>
            </div>
        </article>
    <?php endif; ?>

</div>

<?php get_footer(); ?>
