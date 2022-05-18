<?php
// Template name: Publications
?>
<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <header class="header">
        <h1> <?php the_title(); ?></h1>
    </header>
    <div>
        <?php the_content(); ?>
    </div>
    <?php wp_reset_query(); ?>
<?php endwhile; endif; ?>

<?php
$meta_query = array();
if ( isset( $_GET['author'] ) && !empty( $_GET['author'] ) ) {
    $meta_query[] = array(
        'key'     => 'authors',
        'value'   => $_GET['author'],
        'compare' => "LIKE",
    );
}
if ( isset( $_GET['date'] ) && $_GET['date'] != 'Date' ) {
    $meta_query[] = array(
        'key'     => 'publication_date',
        'value'   => $_GET['date'],
        'compare' => '=',
    );
}
$paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
$args = array(
    's'              => isset( $_GET['search'] ) && $_GET['search'] != '' ? $_GET['search'] : '',
    'post_type'      => 'publication',
    'meta_query'     => $meta_query,
    'posts_per_page' => 10,
    'paged'          => $paged,
);
$query = new WP_Query( $args );
?>
<form action="<?php the_permalink();?>" method="get" id="pubForm">
    <table class="pub-table">
        <thead class="pub-table__head">
        <tr>
            <td colspan="2">
                <input type="text" name="search" id="search"
                       value="<?php echo isset( $_GET['search'] ) && !empty( $_GET['search'] ) ? $_GET['search'] : '' ?>"
                       placeholder="<?php _e( 'Search', THEME_TEXT_DOMAIN ); ?>">
            </td>
            <td>
                <input type="text" name="author" id="author"
                       value="<?php echo isset( $_GET['author'] ) && !empty( $_GET['author'] ) ? $_GET['author'] : '' ?>">
            </td>
            <td>
                <?php
                $dateArr = array();
                $pubDates = getPublicationDates();
                ?>
                <?php if ( $pubDates ) {
                    foreach ( $pubDates as $date ) {
                        if ( !in_array( $date, $dateArr, ) ) {
                            $dateArr[] = $date;
                        }
                    }

                    arsort( $dateArr );
                } ?>
                <select name="date" id="date">
                    <option value="Date">Date</option>
                    <?php foreach ( $dateArr as $date ) : ?>
                        <option <?php echo isset( $_GET['date'] ) && $_GET['date'] === $date ? 'selected' : '' ?>
                                value="<?php echo $date ?>">
                            <?php echo $date; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>Title</td>
            <td>Authors</td>
            <td>Date</td>
        </tr>
        </thead>
        <tbody class="pub-table__body">
        <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
            <tr>
                <td></td>
                <td>
                    <?php the_title(); ?>
                    <?php the_excerpt(); ?>
                </td>
                <td>
                    <?php if ( get_field( 'authors' ) ) : ?>
                        <?php the_field( 'authors' ); ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php
                    if ( get_field( 'publication_date' ) ) {
                        the_field( 'publication_date' );
                    };
                    ?>
                </td>
            </tr>
        <?php endwhile; ?>
            <tr>
                <td>
                    <?php custom_pagination($query->max_num_pages) ?>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</form>
<?php get_footer(); ?>
