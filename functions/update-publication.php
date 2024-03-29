<?php

$oldSourceUrl = '';
$oldPostContent = '';

// add_action( 'pre_post_update', 'get_post_data_before_update', 10, 2 );
// add_action( 'post_updated', 'update_publication_content', 10, 3 );

add_action( 'VU_after_insert_publication', 'provide_publication_with_extra_data', 10, 1 );

/**
 * provide_publication_with_extra_data
 *
 * @param $newPost
 * @return void
 */
function provide_publication_with_extra_data( $newPost )
{
    // Don't fire when $update is true or when the post isn't a publication
    /*if ($update === true) {
        return false;
    }*/
    if ( get_post_type( $newPost ) != 'publication' ) {
        return false;
    }

    // Debugging
    if ( defined( 'WP_DEBUG' ) ) {
        error_log( '========== START PUBLICATION UPDATE AFTER PUBLICATION INSERTION ==========' );
    }
    // get current publication state
    $postCurrent = get_post( $newPost );
    if ( defined( 'WP_DEBUG' ) ) {
        error_log( '====== CURRENT PUBLICATION STATE ======' );
        error_log( print_r( $postCurrent, true ) );
    }

    // get relevant data from the publication

    $source_url = get_field( 'google_scholar_url', $newPost );

    if ( !empty( $source_url ) ) {
        $page_html = get_html_from_url( $source_url );
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( '====== PAGE HTML TYPE ======' );
            error_log( gettype( $page_html ) );
        }

        if ( $page_html !== false ) {
            if ( defined( 'WP_DEBUG' ) ) {
                error_log( '====== GOT HTML FROM SOURCE LINK ======' );
            }

            //Set an empty publication data array
            $pub_data = array(
                'meta_description' => '',
                'authors'          => '',
                'publication_date' => '',
                'description'      => '',
            );

            // readout the html
            $dom = new DOMDocument();
            @$dom->loadHTML( $page_html );
            $xml = new DOMXPath( $dom );

            // get meta description from the HTML
            $meta_desc = $xml->evaluate( '//meta[@name="description"]/@content' )->item( 0 );
            $pub_data['meta_description'] = $meta_desc->value;

            // get scholar publication body
            $body = $xml->query( '//div[@id="gs_bdy"]/div[@id="gs_bdy_ccl"]' );

            if ( defined( 'WP_DEBUG' ) ) {
                error_log( '====== SCHOLAR POST META DESCRIPTION ======' );
                error_log( print_r( $meta_desc, true ) );

                error_log( '====== PUB BODY ======' );
                error_log( print_r( $body, true ) );

                error_log( '====== ALL NODES ======' );
                error_log( print_r( $body->item( 0 )->firstChild, true ) );
            }
        }
        // get the body contents
        $bodyChild = $body->item( 0 )->firstChild;

        // Loop through the child nodes
        foreach ( $bodyChild->childNodes as $index => $node ) {
            if ( $index + 1 === count( $bodyChild->childNodes ) ) {
                if ( defined( 'WP_DEBUG' ) ) {
                    error_log( '====== NODE DATA ======' );
                    error_log( "node count => " . $index );
                    error_log( 'Actual node count => ' . count( $bodyChild->childNodes ) );
                    error_log( print_r( $node->childNodes, true ) );
                }

                foreach ( $node->childNodes as $num => $dataNode ) {
                    if ( $num === 0 ) {
                        //fill Authors
                        $authors = $dataNode->lastChild->nodeValue;
                    }
                    if ( $num === 1 ) {
                        // fill date
                        $publication_date = $dataNode->lastChild->nodeValue;
                    }
                    if ( $num === 2 ) {
                        // fill description
                        $description = $dataNode->lastChild->nodeValue;
                    }
                }

                // set authors in the $pub_data
                if ( isset( $authors ) ) {
                    $pub_data['authors'] = $authors;
                }
                // set publication date in $pub_data
                if ( isset( $publication_date ) ) {
                    $pub_data['publication_date'] = $publication_date;
                }
                // set description in $pub_data
                if ( isset( $description ) ) {
                    $pub_data['description'] = $description;
                }
            }
        }

        // update the publication with the data from $pub_data
        // go update the post if no properties are the same as current
        if ( $pub_data['description'] !== $postCurrent->post_content ) {
            if ( defined( 'WP_DEBUG' ) ) {
                error_log( '========== UPDATE PUBLICATION ==========' );
                error_log( 'current content => ' . $postCurrent->post_content );
                error_log( 'current authors =>' . get_field( 'authors', $postCurrent->ID ) );
                error_log( 'current publication date' . get_field( 'publication_date', $postCurrent->ID ) );
            }

            $postArgs = array(
                'ID'           => $newPost,
                'post_content' => ( !empty( $pub_data['description'] ) ) ? $pub_data['description'] : '',
            );
            $_POST["yoast_wpseo_metadesc"] = $pub_data['meta_description'];
            wp_update_post( $postArgs );

            wp_cache_delete($newPost, 'post_meta');

            // update the authors field if not the same as gotten data
            if ( $pub_data['authors'] !== get_field( 'authors', $postCurrent->ID ) ) {
                if (defined('WP_DEBUG')) {
                    error_log('====== UPDATE AUTHORS FIELD ======');
                    error_log('post_id => ' . $postCurrent->ID);
                }
                update_field( 'field_625e8cfed4f38', $pub_data['authors'], $newPost);
            }
            // update publication date if different from current
            if ( $pub_data['publication_date'] !== get_field( 'publication_date', $postCurrent->ID ) ) {
                if (defined('WP_DEBUG')) {
                    error_log('====== UPDATE PUBLICATION DATE FIELD ======');
                }
                update_field( 'field_625e8fbcd4f39', $pub_data['publication_date'], $newPost );
            }


        } else {
            if ( defined( 'WP_DEBUG' ) ) {
                error_log( "========== DON'T UPDATE PUBLICATION ==========" );
                error_log( 'current content => ' . $postCurrent->post_content );
                error_log( 'current authors =>' . get_field( 'authors', $postCurrent->ID ) );
                error_log( 'current publication date' . get_field( 'publication_date', $postCurrent->ID ) );
            }
            return false;
        }

    } else {
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( "====== NO SOURCE URL FOUND ======" );
        }
        return false;
    }
}


/*function get_post_data_before_update( $post_id, $post_data )
{
    if ( get_post_type( $post_id ) != 'publication' ) {
        error_log( '========== POST IS NOT A PUBLICATION ==========' );
        return false;
    }
    global $oldSourceUrl;
    global $oldPostContent;
    // Set Variables
    $oldSourceUrl = get_field( 'old_source_url', $post_id ) ? get_field( 'old_source_url', $post_id ) : null;
    $oldPostContent = $post_data['post_content'];

    if ( defined( 'WP_DEBUG' ) ) {
        error_log( '========== POST CONTENT BEFORE UPDATE ==========' );
        error_log( $oldPostContent );
        error_log( '========== POST SOURCE URL BEFORE UPDATE ==========' );
        if ( isset( $oldSourceUrl ) ) {
            error_log( $oldSourceUrl );
        } else {
            error_log( 'No old source url' );
        }
    }
}*/

/*function update_publication_content( $post_ID, $post_after, $post_before )
{
    if ( post_modified_time_difference( $post_before->post_modified, $post_after->post_modified ) < 10 ) {
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( post_modified_time_difference( $post_before->post_modified, $post_after->post_modified ) );
        }
        return false;
    }

    if ( get_post_type( $post_ID ) != 'publication' ) {
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( '========== POST IS NOT A PUBLICATION ==========' );
        }
        return false;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( '========== PUBLICATION WAS SAVED AUTOMATICALLY ==========' );
        }
        return false;
    }

    if ( defined( 'WP_DEBUG' ) ) {
        error_log( '========== UPDATE PUBLICATION WITH CONTENT ==========' );
    }

    $sourceUrl = get_field( 'source_url', $post_ID );

    if ( defined( 'WP_DEBUG' ) ) {
        error_log( '==== POST_ID ====' );
        error_log( $post_ID );

        error_log( '==== SOURCE_URL ====' );
        error_log( $sourceUrl );
    }

    $urlType = get_field( 'type_of_url', $post_ID );
    error_log( '======== TYPE OF URL =========' );
    error_log( $urlType );

    if ( isset( $urlType ) && $urlType === "pdf" ) {

        // Get the file basename from the provided source URL
        $file_basename = basename( $sourceUrl );
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( '========== BASE FILE ==========' );
            error_log( $file_basename );
        }

        // Check if the file already exists within the WP media folder
        if ( does_file_exist( $file_basename ) >= 1 ) {
            // if the file does exist, make $file_ID the id of the existing file
            $file_ID = does_file_exist( $file_basename );
            if ( defined( 'WP_DEBUG' ) ) {
                error_log( '====== EXISTING FILE ID IS ======' );
                error_log( $file_ID );
            }
        } else {
            // Download the file from the source URL & set $file_ID to the ID of the newly uploaded file
            $file_ID = wp_sideload_file( $sourceUrl );
            if ( defined( 'WP_DEBUG' ) ) {
                error_log( '========== DOWNLOAD FILE ==========' );
                error_log( '====== NEW FILE ID IS ======' );
                error_log( $file_ID );
            }
        }

        if ( isset( $file_ID ) && gettype( $file_ID ) === "integer" ) {
            $fileUrl = wp_get_attachment_url( $file_ID );
            $fileName = get_the_title( $file_ID );


            $fileBlock = create_download_block( $file_ID, $fileName, $fileUrl, 'auto' );
            if ( defined( 'WP_DEBUG' ) ) {
                error_log( '========== FILE METADATA ==========' );
                error_log( '====== FILE URL ======' );
                error_log( $fileUrl );
                error_log( '====== FILE TITLE ======' );
                error_log( $fileName );
                error_log( '========== FILE WORDPRESS BLOCK DATA ==========' );
                error_log( $fileBlock );
            }

            // add download link if not present or different
            if ( !str_contains( $post_after->post_content, 'Download' ) && !empty( $post_after->post_content ) ) {
                // add PDF download + written text if the download is not yet present.
                $newContent = $fileBlock . $post_after->post_content;
            } elseif ( empty( $post_after->post_content ) ) {
                // Add the PDF download if content is completely empty
                $newContent = $fileBlock;
            } else {
                // don't actually update the content
                $newContent = $post_after->post_content;
            }
            // log the new content if WP_DEBUG is set to true
            if ( defined( 'WP_DEBUG' ) ) {
                error_log( '========== NEW POST CONTENT ==========' );
                error_log( $newContent );
            }

            // update post with PDF attached
            wp_update_post( [
                'ID'           => $post_ID,
                'post_content' => $newContent,
            ] );
        }
    } else {
        $html = get_html_from_url( $sourceUrl );

        $dom = new DOMDocument();
        @$dom->loadHTML( $html );
        $xpath = new DOMXPath( $dom );

        $elements = $xpath->query( "/html/body" );

        $childrenToRemove = [];

        if ( $elements->length === 1 ) {
            $body = $elements->item( 0 );
            foreach ( $body->childNodes as $node ) {
                if ( defined( 'WP_DEBUG' ) ) {
                    error_log( '==== NODE NAME ====' );
                    error_log( $node->nodeName );
                }
                switch ( $node->nodeName ) {
                    case "noscript":
                    case "iframe":
                    case "script":
                    case "#comment":
                        $childrenToRemove[] = $node;
                        break;

                }
                if ( $node->attributes ) {
                    for ( $i = $node->attributes->length; --$i >= 0; ) {
                        $name = $node->attributes->item( $i )->name;
                        if ( 'href' !== $name ) {
                            $node->removeAttribute( $name );
                        }
                    }
                }
            }
            if ( count( $childrenToRemove ) > 0 ) {
                if ( defined( 'WP_DEBUG' ) ) {
                    error_log( '==== TAGS TO REMOVE ====' );
                    error_log( print_r( $childrenToRemove, true ) );
                }

                foreach ( $childrenToRemove as $child ) {
                    $child->parentNode->removeChild( $child );
                }
            }


            $newBody = $dom->saveHTML( $body );

            if ( publication_changed( $post_before, $post_after ) && empty( $post_after->post_content ) ) {
                if ( defined( 'WP_DEBUG' ) ) {
                    error_log( '========== UPDATE EMPTY (HTML source) PUBLICATION WITH HTML FROM SOURCE ==========' );
                }
                wp_update_post( [
                    'ID'           => $post_ID,
                    'post_content' => $newBody,
                ] );
            }
        }
    }
}*/

// TODO remove/comment helper functions which become redundant
/**
 * Retrieve HTML code from a provided url
 * @param $url
 * @return bool|string
 */
function get_html_from_url( $url )
{
    $ch = curl_init();
    $timeout = 5;
    curl_setopt( $ch, CURLOPT_URL, $url );
    // for errors
    curl_setopt( $ch, CURLOPT_FAILONERROR, true );
    curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36' );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );

    $html = curl_exec( $ch );
    if ( curl_errno( $ch ) ) {
        $err_msg = curl_error( $ch );
    }
    curl_close( $ch );

    if ( isset( $err_msg ) ) {
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( '====== ERROR WHILE RETRIEVING PUBLICATION FROM SOURCE LINK ======' );
            error_log( $err_msg );
        }
        return false;
    }

    return $html;
}

/**
 * Determine if the Posts content actually changed
 * @param $post_id
 * @param $content
 * @return bool
 */
function publication_changed( $post_before, $post_after ): bool
{
    if ( $post_before->post_content !== $post_after->post_content ) {
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( '========== NEW CONTENT IS NOT THE SAME AS OLD CONTENT ==========' );
            error_log( '====== OLD CONTENT ======' );
            error_log( print_r( $post_before, true ) );
            error_log( '====== NEW CONTENT ======' );
            error_log( print_r( $post_after, true ) );
        }
        return true;
    }

    return false;
}

/**
 * A modified version of the media_sideload_image function
 * to download a PDF from an url to the WordPress media folder
 * @param $file
 * @param $post_id
 * @param $desc
 * @return int|WP_Error
 */
function wp_sideload_file( $file, $post_id = 0, $desc = null )
{
    require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
    require_once( ABSPATH . "wp-admin" . '/includes/file.php' );
    require_once( ABSPATH . "wp-admin" . '/includes/media.php' );

    if ( empty( $file ) ) {
        return new WP_Error( 'error', 'File is empty' );
    }

    $file_array = [];

    // Get filename and store in into $file_array
    // Add more file types if necessary
    preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png|pdf)\b/i', $file, $matches );

    if ( defined( 'WP_DEBUG' ) ) {
        error_log( '====== NO. OF MATCHES ======' );
        error_log( 'TYPE IS ' . gettype( $matches ) );
        error_log( 'COUNT MATCHES: ' . count( $matches ) );
        error_log( '====== FILE ======' );
        error_log( $file );
        error_log( 'BASENAME: ' . basename( $file ) );
    }

    $file_array['name'] = basename( $matches[0] );


    //Download file into temp location
    $file_array['tmp_name'] = download_url( $file );

    // If error storing temporarily, return the error.
    if ( is_wp_error( $file_array['tmp_name'] ) ) {
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( '====== ERROR ======' );
            error_log( "Couldn't store the file temporarily" );
        }
        return new WP_Error( 'error', 'Error while storing file temporarily' );
    }

    // Store and validate
    $id = media_handle_sideload( $file_array, $post_id, $desc );

    // Unlink if couldn't store permanently
    if ( is_wp_error( $id ) ) {
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( '====== ERROR ======' );
            error_log( "Couldn't store upload permanently" );
        }
        unlink( $file_array['tmp_name'] );
        return new WP_Error( 'error', "Couldn't store upload permanently" );
    }
    if ( empty( $id ) ) {
        if ( defined( 'WP_DEBUG' ) ) {
            error_log( '====== ERROR ======' );
            error_log( "Upload ID is empty" );
        }
        return new WP_Error( 'error', "Upload ID is empty" );
    }

    return $id;
}

/**
 * @param $file_id
 * @param $file_name
 * @param $file_url
 * @param $height
 * @return string
 */
function create_download_block( $file_id, $file_name, $file_url, $height = 'auto' )
{
    $fileBlock = [];

    $fileBlock['blockName'] = 'core/file';
    $fileBlock['attrs'] = [
        'id'             => $file_id,
        'href'           => $file_url,
        'displayPreview' => 0,
        'previewHeight'  => $height,

    ];
    $fileBlock['innerBlocks'] = [];
    $fileBlock['innerHTML'] = '<div class="wp-block-file">' .
        '<a id="wp-block-file--media-38670589-6333-4bcd-b1c5-3d26780528fc" href="' . $fileBlock['attrs']['href'] . '" >' . $file_name . '</a>' .
        '</div >';
    $fileBlock['innerContent'] = [
        0 => '<div class="wp-block-file">' .
            '<a id="wp-block-file--media-38670589-6333-4bcd-b1c5-3d26780528fc" href="' . $fileBlock['attrs']['href'] . '">' . $file_name . '</a>' .
            '<a href="' . $fileBlock['attrs']['href'] . '" class="wp-block-file__button" download="" aria-describedby="wp-block-file--media-38670589-6333-4bcd-b1c5-3d26780528fc"> Download</a>' .
            '</div>',
    ];


    // return a rendered block

    return serialize_block( $fileBlock );
}

/**
 * calculate the difference in seconds between two timestamps
 * @param $timeModifiedBefore
 * @param $timeModifiedAfter
 * @return false|int
 */
function post_modified_time_difference( $timeModifiedBefore, $timeModifiedAfter )
{
    $timeBefore = strtotime( $timeModifiedBefore );
    $timeAfter = strtotime( $timeModifiedAfter );
    return $timeAfter - $timeBefore;
}

/**
 * check if file already exists in media folder
 * @param $fileName
 * @return int
 */
function does_file_exist( $fileName )
{
    global $wpdb;

    $query = "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_value LIKE '%/$fileName' AND meta_key = '_wp_attached_file'";

    return intval( $wpdb->get_var( $query ) );
}
