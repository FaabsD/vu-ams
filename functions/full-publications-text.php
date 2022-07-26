<?php
/**
 * Create a full text from all publications
 *
 * @package VU-AMS
 * @return  void
 */

add_action('init', 'create_full_publications_text');
function create_full_publications_text()
{
    // get all publication
    $args = [
        'post_type' => 'publication',
        'posts_per_page' => -1,
        'orderby' => 'post_title',
        'order' => 'desc',
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        foreach ($query->get_posts() as $publication) {
            if (defined('WP_DEBUG')) {
                error_log(gettype($publication));
            }
        }
    }

    // TODO: run an action to save the full text to an text file
}
