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
        'meta_key' 		 => isset( $_GET['meta_key'] ) && $_GET['meta_key'] != '' ? $_GET['meta_key'] : 'publication_date',
        'orderby'	     => isset( $_GET['orderby'] ) && $_GET['orderby'] != '' ? $_GET['orderby'] : 'meta_value_num',
        'order'			 => isset( $_GET['order'] ) && $_GET['order'] != '' ? $_GET['order'] : 'DESC',
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
            <td>
                <?php
                    $authorsSort = array(
                        'order'    => ( isset( $_GET['order'] ) && $_GET['order'] === 'ASC' ) ? 'DESC' : 'ASC',
                        'orderby'  => 'meta_value',
                        'meta_key' => 'authors_lastnames',
                    ); 
                ?>
                <a href="<?php echo get_permalink() . '?' . http_build_query($authorsSort) ?>">
                    Authors
                    <span class="sort inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8 <?php echo (isset($_GET['order']) && $_GET['order'] === 'ASC' && isset($_GET['meta_key']) && $_GET['meta_key'] === 'authors_lastnames') ? 'inline-block' : ((!isset($_GET['order']) || isset($_GET['meta_key']) && $_GET['meta_key'] !== 'authors_lastnames') ? 'inline-block' : 'hidden')?>">
                            <path fill-rule="evenodd" d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832 6.29 12.77a.75.75 0 11-1.08-1.04l4.25-4.5a.75.75 0 011.08 0l4.25 4.5a.75.75 0 01-.02 1.06z" clip-rule="evenodd" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8 <?php echo (isset($_GET['order']) && $_GET['order'] === 'DESC' && isset($_GET['meta_key']) && $_GET['meta_key'] === 'authors_lastnames') ? 'inline-block' : ((!isset($_GET['order']) || isset($_GET['meta_key']) && $_GET['meta_key'] !== 'authors_lastnames') ? 'inline-block' : 'hidden') ?>">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </a>
            </td>
            <td>
                <?php
                    $dateSort = array(
                        'order'    => ( isset( $_GET['order'] ) && $_GET['order'] === 'ASC' ) ? 'DESC' : 'ASC',
                        'orderby'  => 'meta_value_num',
                        'meta_key' => 'publication_date',
                    );
                ?>
                <a href="<?php echo get_permalink() . '?' . http_build_query($dateSort) ?>">
                    Date

                    <span class="sort inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8 <?php echo (isset($_GET['order']) && $_GET['order'] === 'ASC' && isset($_GET['meta_key']) && $_GET['meta_key'] === 'publication_date') ? 'inline-block' : ((!isset($_GET['order']) || isset($_GET['meta_key']) && $_GET['meta_key'] !== 'publication_date') ? 'inline-block' : 'hidden') ?>">
                            <path fill-rule="evenodd" d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832 6.29 12.77a.75.75 0 11-1.08-1.04l4.25-4.5a.75.75 0 011.08 0l4.25 4.5a.75.75 0 01-.02 1.06z" clip-rule="evenodd" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8 <?php echo (isset($_GET['order']) && $_GET['order'] === 'DESC' && isset($_GET['meta_key']) && $_GET['meta_key'] === 'publication_date') ? 'inline-block' : ((!isset($_GET['order']) || isset($_GET['meta_key']) && $_GET['meta_key'] !== 'publication_date') ? 'inline-block' : 'hidden') ?>">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </a>
            </td>
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
                        <?php if ( get_field( 'authors_lastnames' ) ) : ?>
                            <?php
                                $authorsArr = explode(', ', get_field('authors_lastnames'));
                                foreach ($authorsArr as $index => $author) {
                                    if(count($authorsArr) - $index === 2) {
                                        echo $author . ' & ';
                                    } elseif( count($authorsArr) !== $index + 1) {
                                        echo $author . ", ";
                                    } 
                                    else {
                                        echo $author;
                                    }
                                } 
                            ?>
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
