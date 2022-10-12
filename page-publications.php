<?php
// Template name: Publications
?>
<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <header class="header">
        <h1> <?php the_title(); ?></h1>
    </header>
    <div class="publications__content">
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
            'compare' => 'LIKE',
        );
    }

    if ( isset( $_GET['date'] ) && $_GET['date'] != 'Date' ) {
        $meta_query[] = array(
            'key'     => 'publication_date',
            'value'   => $_GET['date'],
            'compare' => '=',
        );
    }

    if ( isset( $_GET['tags'] ) && !empty( $_GET['tags'] ) ) {
        $meta_query[] = array(
            'key'     => 'tags',
            'value'   => $_GET['tags'],
            'compare' => 'LIKE',
        );
    }

    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args  = array(
        's'              => isset( $_GET['search'] ) && $_GET['search'] != '' ? $_GET['search'] : '',
        'post_type'      => 'publication',
        'meta_query'     => $meta_query,
        'posts_per_page' => 10,
        'paged'          => $paged,
        'meta_key' 		 => 'publication_date',
        'orderby'	     => 'meta_value_num',
        'order'			 => 'DESC',
    );
    $query = new WP_Query( $args );
?>
<form action="<?php the_permalink(); ?>" method="get" id="pubForm">
    <table class="pub-table">
        <thead class="pub-table__head">
        <tr>
            <td id="searchCell">
                <input type="text" name="search" id="search"
                       value="<?php echo isset( $_GET['search'] ) && !empty( $_GET['search'] ) ? $_GET['search'] : ''; ?>"
                       placeholder="<?php _e( 'Search', THEME_TEXT_DOMAIN ); ?>">
            </td>
            <td>
                <input type="text" name="author" id="author"
                       value="<?php echo isset( $_GET['author'] ) && !empty( $_GET['author'] ) ? $_GET['author'] : ''; ?>"
                       placeholder="<?php _e( 'Search', THEME_TEXT_DOMAIN ); ?>">
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
                        <option <?php echo isset( $_GET['date'] ) && $_GET['date'] === $date ? 'selected' : ''; ?>
                                value="<?php echo $date; ?>">
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
        <?php if ( $query->have_posts() ) : ?>
            <tbody class="pub-table__body">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <tr>
                    <td width="10px" style="width: 10px;"></td>
                    <td>
                        <a href="<?php the_permalink(); ?> ">
                            <h3 class="pub-title">
                                <?php the_title(); ?>
                            </h3>
                        </a>
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
                            }
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        <?php else: ?>
            <tbody class="pub-table__body--no-results">
            <tr>
                <td colspan="3" class="prose-sm md:prose">
                    <h2 class="!text-ams-strong_cyan my-2">
                        <?php _e( 'No publications found using given criteria', THEME_TEXT_DOMAIN ); ?>
                    </h2>
                </td>
            </tr>
            </tbody>
        <?php endif; ?>
        <tfoot class="pub-table__foot">
        <tr>
            <td></td>
            <td colspan="2" class="pagination-cell">
                <?php custom_pagination( $query->max_num_pages ); ?>
            </td>
        </tr>
        </tfoot>
    </table>
</form>
<?php get_footer(); ?>
