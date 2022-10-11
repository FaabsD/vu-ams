<?php

use Extendify\MetaGallery\Contracts\BasicRoute;

 get_header(); ?>

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
            <h3 class="publication-tags">
                <span class="publication-tags__head">
                    <?php _e('Tags:&nbsp;', THEME_TEXT_DOMAIN); ?>
                </span>
                <?php $tags = get_field('tags');
                if ($tags && !empty($tags)) {
                    $tagsArr = explode(', ', $tags);
                }
                ?>

                <?php if( isset($tagsArr) && is_array($tagsArr) ) : ?>
                    <?php foreach($tagsArr as $index => $tag) : ?>
                        <a href="<?php echo get_site_url() . "/publications?tags=" . $tag;  ?>">
                            <?php echo (count($tagsArr) !== $index+1) ? $tag . "," : $tag ?>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </h3>
            <ul class="publication-info">
                <li>
                    <strong>Item Type:</strong>
                    <?php if ( get_field('item_type') && !empty( get_field('item_type') ) ) :?>
                        &nbsp; <?php the_field('item_type'); ?>
                    <?php endif; ?>
                </li>
                <li>
                    <strong>Publication Title:</strong>
                    <?php if (get_field('publication_title') && !empty(get_field('publication_title'))) : ?>
                        &nbsp;<?php the_field('publication_title'); ?>
                    <?php endif; ?>
                </li>
                <li>
                    <strong>Volume:</strong>
                    <?php if(get_field('volume') && !empty(get_field('volume'))) : ?>
                        &nbsp;<?php the_field('volume'); ?>
                    <?php endif;?>
                </li>
                <li>
                    <strong>Pages:</strong>
                    <?php if(get_field('pages') && !empty(get_field('pages'))) : ?>
                        &nbsp;<?php the_field('pages'); ?>
                    <?php endif; ?>
                </li>
                <li>
                    <strong>Series:</strong>
                    <?php if(get_field('series') && !empty(get_field('series'))) : ?>
                        &nbsp;<?php the_field('series'); ?>
                    <?php endif; ?>
                </li>
                <li>
                    <strong>Series Title:</strong>
                    <?php if(get_field('series_title') && !empty(get_field('series_title'))) : ?>
                        &nbsp;<?php the_field('series_title'); ?>
                    <?php endif; ?>
                </li>
                <li>
                    <strong>Series Text:</strong>
                    <?php if(get_field('series_text') && !empty(get_field('series_text'))) : ?>
                        &nbsp;<?php the_field('series_text'); ?>
                    <?php endif; ?>
                </li>
                <li>
                    <strong>Journal Abbreviation:</strong>
                    <?php if(get_field('journal_abbreviation') && !empty(get_field('journal_abbreviation'))) : ?>
                        &nbsp;<?php the_field('journal_abbreviation'); ?>
                    <?php endif; ?>
                </li>
                <li>
                    <strong>DOI:</strong>
                    <?php if(get_field('doi') && !empty(get_field('doi'))) : ?>
                        &nbsp; 
                        <a target="_blank" href="<?php the_field('doi') ?>">
                            <?php echo parse_url(get_field('doi'), PHP_URL_PATH) ?>
                        </a>
                    <?php endif;?>
                </li>
                <li>
                    <strong>ISSN:</strong>
                    <?php if(get_field('issn') && !empty(get_field('issn'))) : ?>
                        &nbsp;<?php the_field('issn'); ?>
                    <?php endif; ?>
                </li>
                <li>
                    <strong>Short Title:</strong>
                    <?php if (get_field('short_title') && !empty(get_field('short_title'))) : ?>
                        &nbsp;<?php the_field('short_title'); ?>
                    <?php endif; ?>
                </li>
                <li>
                    <strong>Library Catalog:</strong>
                    <?php if ( get_field('library_catalog') && !empty( get_field('library_catalog') ) ) : ?>
                        &nbsp;<?php the_field('library_catalog'); ?>
                    <?php endif; ?>
                </li>
            </ul>
            <!-- Get link to the source -->
            <?php if(get_field('doi') && !empty(get_field('doi'))) : ?>
                <a class="source-link" href="<?php the_field('doi') ?>" 
                title="<?php _e('Go to source (DOI)', THEME_TEXT_DOMAIN); ?>">
                    <?php _e("Go to source (DOI)", THEME_TEXT_DOMAIN); ?>
                </a>
                <?php elseif(get_field('fallback_url') && !empty(get_field('fallback_url'))) : ?>
                    <a href="<?php  the_field('fallback_url') ?>" class="source-link" 
                    title="<?php _e('Go to source', THEME_TEXT_DOMAIN); ?>">
                        <?php _e('Go to source', THEME_TEXT_DOMAIN); ?>
                    </a>
            <?php endif; ?>
        </header>
        <article>
            <?php the_content(); ?>
        </article>
    </main>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
