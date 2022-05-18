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
$args = array(
    'post_type' => 'publication',
);
$query = new WP_Query( $args );
?>

<?php if ( $query->have_posts() ) : ?>
    <table class="pub-table">
        <thead class="pub-table__head">
        <tr>
            <td></td>
            <td>Title</td>
            <td>Authors</td>
            <td>Date</td>
        </tr>
        </thead>
        <tbody class="pub-table__body">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
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
        </tbody>
    </table>

<?php endif; ?>

<?php get_footer(); ?>
