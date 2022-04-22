<?php
if ( !function_exists( 'post_exists' ) ) {
    require_once ABSPATH . 'wp-admin/includes/post.php';
}


// add_action( 'init', 'run' );
add_action( 'retrieve_scholar_publications', 'retrieve_google_scholar_publications' );
function retrieve_google_scholar_publications()
{
    // we'll set a variable to determine if the while loop
    // for consecutive calls should continue or stop.
    $runContinues = true;

    // set the arguments for the api call in a variable.
    $args = array(
        'engine'    => 'google_scholar_author',
        'hl'        => 'nl',
        'author_id' => 'cRt7JiIAAAAJ',
        'num'       => 100,
        'start'     => 0,
    );
    $scholar = new Scholar( THEME_URL . '/resources/dummy.json' );

    $originalData = $scholar->make_api_call( SERPAPI_API_KEY, $args );

    foreach ( $originalData->articles as $article ) {
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( '========== ARTICLE DATA =========' );
            error_log( 'TITLE: ' . $article->title );
            error_log( 'AUTHORS: ' . print_r( $article->authors, true ) );
            error_log( 'URL: ' . $article->link );
            error_log( 'PUBLICATION YEAR: ' . $article->year );
        }

        $postArgs = array(
            'post_content' => $article->authors,
        );

        $extraPostArgs = array(
            'authors'          => $article->authors,
            'publication_date' => $article->year,
        );

        if ( post_exists( $article->title ) === 0 ) {
            save_publication( $article->title, $postArgs, $article->link, $extraPostArgs );
        }
    }

    $callCount = 1;

    // Make following calls if a serpapi_pagination is present in
    // the first call response & if it contains a next link
    if ( isset( $originalData->serpapi_pagination ) && isset( $originalData->serpapi_pagination->next ) ) {
        // fire a new API call
        while ( $runContinues ) {
            $data = $scholar->make_api_call( SERPAPI_API_KEY, array( 'num' => 100, 'start' => $callCount * 100 ) );
            $callCount++;

            if ( defined( 'WP_DEBUG' ) ) {
                error_log( '========== API CALL ' . $callCount . 'DATA ==========' );
                error_log( print_r( $data, true ) );
            }

            // loop through the articles from the new call
            foreach ( $data->articles as $article ) {
                $postArgs = array(
                    'post_content' => $article->authors,
                );

                $extraPostArgs = array(
                    'authors'          => $article->authors,
                    'publication_date' => $article->year,
                );
                // save any post that doesn't exist by the given title
                if ( post_exists( $article->title ) === 0 ) {
                    save_publication( $article->title, $postArgs, $article->link, $extraPostArgs );
                }
            }
            // set $runContinues to false. To stop the while loop
            // if there is no pagination present in the response
            if ( !isset( $data->serpapi_pagination ) ) {
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
function save_publication( $title, $args, $url, $extraPostArgs = null )
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

    // save extra publication data to publication when extra post args are given
    if ( isset( $extraPostArgs ) && is_array( $extraPostArgs ) ) {
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( '========== SET PUBLICATION DATA FIELDS ==========' );
            error_log( '====== EXTRA POST ARGS ======' );
            error_log( print_r( $extraPostArgs, true ) );
        }

        // if authors are given in the extraPostArgs save them in the extra authors field
        if ( array_key_exists( 'authors', $extraPostArgs ) ) {
            if ( defined( 'WP_DEBUG' ) ) {
                error_log( '========== FILL AUTHORS FIELD ==========' );
                error_log( '====== AUTHORS ======' );
                error_log( $extraPostArgs['authors'] );
            }
            update_field( 'authors', $extraPostArgs['authors'], $newPost );
        }

        if ( array_key_exists( 'publication_date', $extraPostArgs ) ) {
            if ( defined( 'WP_DEBUG' ) ) {
                error_log( '========== FILL PUBLICATION DATE FIELD ==========' );
                error_log( '====== PUBLICATION DATE ======' );
                error_log( $extraPostArgs['publication_date'] );
            }
            update_field( 'publication_date', $extraPostArgs['publication_date'], $newPost );
        }
    }

    if ( defined( 'WP_DEBUG' ) ) {
        error_log( 'NEW POST ID: ' . $newPost );
    }

    // fire a new custom hook
    do_action('VU_after_insert_publication', $newPost);

}

