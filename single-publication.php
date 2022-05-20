<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <main class="publication">
        <header>
            <?php if ( get_field( 'publication_date' ) ) : ?>
                <h3>
                    Published:&nbsp;
                    <?php the_field( 'publication_date' ); ?>
                </h3>
            <?php endif; ?>
            <h1>
                <?php the_title(); ?>
            </h1>
            <h2 class="authors">
                <span class="authors__head">Authors:&nbsp;</span>
                <?php if ( get_field( 'authors' ) ) {
                    the_field( 'authors' );
                } ?>
            </h2>
            <a class="scholar-link" href="<?php the_field( 'google_scholar_url' ); ?>"
               title="<?php _e( 'View publication on Google Scholar' ); ?>">
                Google Scholar
            </a>
        </header>
        <article>
            <?php the_content(); ?>
        </article>
    </main>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
