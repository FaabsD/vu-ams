<?php get_header(); ?>

<?php
    $s = get_search_query();
$args  = array(
    's' => $s,
);
// The Query
$the_query = new WP_Query( $args );
?>

<?php if ( $the_query->have_posts() ) : ?>
    <h1>
        <?php _e( 'Search Results for: ' . get_query_var( 's' ) ); ?>
        <?php $post_type_objects = array_filter( get_post_types( array( 'public' => true ), 'objects' ), function ( $post_type_object ) {
            return ! in_array( $post_type_object->name, array( 'sliced_invoice', 'sliced_quote' ) );
        } );
    print_r( $post_type_objects ); ?>
    </h1>
    <div class="results">
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="results__item">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
                <p class="item-excerpt">
                    <?php the_excerpt(); ?>
                </p>
                <span><?php echo get_post_type(); ?></span>
            </div>
        <?php endwhile; ?>
    </div>
 <?php else : ?>
        <h2 style='font-weight:bold;color:#000'>Nothing Found</h2>
        <div class="alert alert-info">
            <p>
                <?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.' ); ?>
            </p>
        </div>
<?php endif; ?>
<?php get_footer(); ?>