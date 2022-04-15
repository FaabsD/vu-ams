<?php
if ( !function_exists( 'post_exists' ) ) {
    require_once ABSPATH . 'wp-admin/includes/post.php';
}


// add_action( 'init', 'run' );
add_action('retrieve_scholar_publications', 'run');
function run()
{
    $runContinues = true;
    $args = array(
        'engine'    => 'google_scholar_author',
        'hl'        => 'nl',
        'author_id' => 'cRt7JiIAAAAJ',
        'num'       => 0,
        'start'     => 0,
    );
    $scholar = new Scholar( THEME_URL . '/resources/dummy.json' );

    $originalData = $scholar->make_api_call( SERPAPI_API_KEY, $args );

    error_log('========== DATA FROM API CALL ==========');
    error_log(print_r($originalData, true));
    return false;

    $newData = $scholar->strip_data( $originalData );

    $decodedResponseData = json_decode( $originalData );

    $decodedData = json_decode( $newData );

    foreach ( $decodedData as $article ) {
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( '========== ARTICLE DATA =========' );
            error_log( 'TITLE: ' . $article->title );
            error_log( 'AUTHORS: ' . print_r( $article->authors, true ) );
            error_log( 'URL: ' . $article->link );
            error_log( 'PUBLICATION YEAR: ' . $article->year );
//                sleep(5);
        }

        $postArgs = array(
            'post_content' => implode( ', ', $article->authors ),
        );

        if ( post_exists( $article->title ) === 0 ) {
            save_publication( $article->title, $postArgs, $article->link );
        }
    }

    $calCount = 1;

    // TODO: Make a new call to next page if pagination present
    if ( isset( $decodedResponseData->serpapi_pagination ) && isset( $decodedResponseData->serpapi_pagination->next ) ) {
        // fire a new API call
        while ( $runContinues ) {
            $data = $scholar->make_api_call( SERPAPI_API_KEY, array( 'start' => $calCount * 100 ) );
            $calCount++;
            $strippedData = $scholar->strip_data( $data );

            $articleData = json_decode( $strippedData );

            foreach ( $articleData as $article ) {
                $postArgs = array(
                    'post_content' => implode( ', ', $article->authors ),
                );

                if (post_exists($article->title) === 0 ) {
                    save_publication($article->title, $postArgs, $article->link);
                }
            }
            if (!isset($data->serpapi_pagination)) {
                $runContinues = false;
            }
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
    $args = array_merge( $defaults, $args );
    $newPost = wp_insert_post( $args );
    update_field( 'google_scholar_url', $url, $newPost );

    if ( defined( 'WP_DEBUG' ) ) {
        error_log( 'NEW POST ID: ' . $newPost );
    }

}

