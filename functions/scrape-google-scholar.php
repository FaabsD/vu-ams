<?php
if ( !function_exists('post_exists') ) {
    require_once ABSPATH . 'wp-admin/includes/post.php';
}


//add_action('init', 'run');
function run()
{
    $args = array(
        'author_id' => 'cRt7JiIAAAAJ',
        'hl'        => 'nl'
    );
    $scholar = new Scholar(THEME_URL . '/resources/dummy.json');

    $originalData = $scholar->make_api_call(SERPAPI_API_KEY, $args);
    $newData = $scholar->strip_data($originalData);


    $decodedData = json_decode($newData);

    foreach ( $decodedData as $article ) {
        if ( defined('WP_DEBUG') ) {
            error_log('========== ARTICLE DATA =========');
            error_log('TITLE: ' . $article->title);
            error_log('AUTHORS: ' . print_r($article->authors, true));
            error_log('URL: ' . $article->link);
            error_log('PUBLICATION YEAR: ' . $article->year);
//                sleep(5);
        }

        $postArgs = array(
            'post_content' => implode(', ', $article->authors),
        );

        if ( post_exists($article->title) === 0 ) {
            save_publication($article->title, $postArgs, $article->link);
        }
    }
}

/**
 * Creates a new publication post-type post and saves it as a private post
 *
 * @param $title
 * @param $args
 * @param $url
 * @return void
 */
function save_publication( $title, $args, $url )
{
    $defaults = array(
        'post_title'     => $title,
        'post_content'   => '',
        'post_status'    => 'private',
        'comment_status' => 'closed',
        'post_type'      => 'publication',

    );
    $args = array_merge($defaults, $args);
    $newPost = wp_insert_post($args);
    update_field('google_scholar_url', $url, $newPost);

    if ( defined('WP_DEBUG') ) {
        error_log('NEW POST ID: ' . $newPost);
    }

}

