<?php get_header(); ?>

<?php
    $s = get_search_query();
    $filters = $_GET['filters'];
$args  = array(
    's' => $s,
);
if (isset($filters) && is_array($filters)) {
    $args['post_type'] = $filters;
}
// The Query
$the_query = new WP_Query( $args );

// posttypes to filter
$filter_post_types = array_filter( get_post_types( array( 'public' => true ), 'objects' ), function ( $post_type_object ) {
    return ! in_array( $post_type_object->name, array( 'sliced_invoice', 'sliced_quote', 'mailpoet_page' ) );

} );
?>
<div class="content">
<?php if ( $the_query->have_posts() ) : ?>
    <header>
        <h1>
            <?php _e( 'Search Results for: ' . get_query_var( 's' ) ); ?>
        </h1>
        <section class="refine-search">
            <h2>
                <?php _e('Refine search') ?>
            </h2>
            <form role="search" action="<?php echo home_url() ?>" method="get">
                <fieldset>
                    <label for="s" class="screen-reader-text">
                        <?php echo _x('Search for:', 'label'); ?>
                    </label>
                    <input type="search" name="s"
                            placeholder="<?php esc_attr_x('Search ...', 'placeholder') ?>"
                            value="<?php echo get_search_query(); ?>"
                            title="<?php esc_attr_x('Search for:', 'label') ?>"/>
                </fieldset>
                <fieldset>
                    <h3>
                        <?php _e('Include post types: ', THEME_TEXT_DOMAIN); ?>
                    </h3>
                    <?php foreach ($filter_post_types as $index => $post_type) : ?>
                        <label>
                            <?php _e($post_type->labels->name, THEME_TEXT_DOMAIN) ?>
                            <input type="checkbox" name="filters[]" value="<?php echo $post_type->name ?>" <?php if (in_array($post_type->name, $filters ) || !isset($filters)) { echo "checked"; }?>>
                        </label>
                    <?php endforeach; ?>
                </fieldset>
                <input type="submit" value="<?php _e('Update Search Query', THEME_TEXT_DOMAIN) ?>">
            </form>
        </section>
    </header>
    <main class="results">
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <?php
            $post_type = get_post_type_object(get_post_type()); 
        ?>
            <article class="results__item">
                <p class="result-type">
                    <?php echo $post_type->labels->singular_name ?>
                </p>
                <a href="<?php the_permalink(); ?>">
                    <h2>
                        <?php the_title(); ?>
                    </h2>
                </a>
                <div class="item-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </main>
 <?php else : ?>
        <h2 style='font-weight:bold;color:#000'>Nothing Found</h2>
        <div class="alert alert-info">
            <p>
                <?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.' ); ?>
            </p>
        </div>
<?php endif; ?>
 </div>
<?php get_footer(); ?>