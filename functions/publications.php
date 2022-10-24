<?php

if ( !function_exists( 'post_exists' ) ) {
    require_once ABSPATH . 'wp-admin/includes/post.php';
}

function get_publications_from_zotero() {
    $userID     =  ( defined( 'ZOTERO_USER_ID' ) && null !== ZOTERO_USER_ID ) ? ZOTERO_USER_ID : 0;
    $groupID    = ( defined( 'ZOTERO_GROUP_ID' ) && null !== ZOTERO_GROUP_ID ) ? ZOTERO_GROUP_ID : 0;
    $collection = ( defined( 'ZOTERO_COLLECTION_ID' ) && null !== ZOTERO_COLLECTION_ID ) ? ZOTERO_COLLECTION_ID : null;

    $resultsLimit = ( defined( 'ZOTERO_RESULT_LIMIT' ) ) ? ZOTERO_RESULT_LIMIT : 100;

    error_log( '===== SETUP ZOTERO API CALL USER_ID, GROUP_ID, COLLECTION ========' );
    error_log( 'user id: ' . $userID );
    error_log( 'group id: ' . $groupID );
    error_log( 'collection: ' . $collection );

    $zotero = new Zotero( $userID, $groupID, $collection, 'json', array( 'limit' => $resultsLimit ) );

    // put the API response in a variable
    $response = $zotero->makeAPICall();

    if ( defined( 'WP_DEBUG' ) ) {
        error_log( '======== DATA FROM API CALL ========' );
        error_log( 'response type: ' . gettype( $response ) );
    }
    $responseBody = json_decode( $response['body'] );

    if ( defined( 'WP_DEBUG' ) ) {
        error_log( 'formatted response data type: ' . gettype( $responseBody ) );
        error_log( '===== response body =====' );
        error_log( print_r( $responseBody, true ) );
        error_log( '======== GET RESPONSE HEADER INFORMATION ========' );
        error_log( 'type: ' . gettype( $response['header'] ) );
        error_log( 'contents: ' );
        error_log( print_r( $response['headers'], true ) );
    }

    if ( gettype( $responseBody ) === 'array' ) {
        foreach ( $responseBody as $item ) {
            // put the data that will be saved in variables
            $version             = $item->data->version;
            $itemType            = $item->data->itemType;
            $title               = $item->data->title;
            $creators            = $item->data->creators;
            $abstract            = $item->data->abstractNote;
            $publicationTitle    = $item->data->publicationTitle;
            $volume              = $item->data->volume;
            $pages               = $item->data->pages;
            $date                = ( isset( $item->meta->parsedDate ) ) ? $item->meta->parsedDate : $item->data->date;

            $series              = $item->data->series;
            $seriesTitle         = $item->data->seriesTitle;
            $seriesText          = $item->data->seriesText;
            $journalAbbreviation = $item->data->journalAbbreviation;
            $DOI                 = 'https://www.doi.org/' . $item->data->DOI;
            $ISSN                = $item->data->ISSN;
            $shortTitle          = $item->data->shortTitle;
            // URL only as a fallback option if there is no Doi
            $url            = $item->data->url;
            $libraryCatalog = $item->data->libraryCatalog;
            $tags           = $item->data->tags;

            if ( defined( 'WP_DEBUG' ) ) {
                error_log( '====== ITEM DATA ======' );
                error_log( 'version: ' . $version );
                error_log( 'itemType: ' . $itemType );
                error_log( 'title: ' . $title );
                error_log( 'creators:' );

                foreach ( $creators as $author ) {
                    error_log( $author->firstName . ' ' . $author->lastName );
                }
                error_log( 'abstractNote: ' . $abstract );
                error_log( 'publicationTitle: ' . $publicationTitle );
                error_log( 'volume: ' . $volume );
                error_log( 'pages: ' . $pages );
                error_log( 'date: ' . $date );
                error_log( 'series: ' . $series );
                error_log( 'seriesTitle: ' . $seriesTitle );
                error_log( 'seriesText: ' . $seriesText );
                error_log( 'journalAbbreviation: ' . $journalAbbreviation );
                error_log( 'DOI: ' . $DOI );
                error_log( 'ISSN: ' . $ISSN );
                error_log( 'shortTitle: ' . $shortTitle );
                error_log( 'url: ' . $url );
                error_log( 'libraryCatalog: ' . $libraryCatalog );
                error_log( 'tags:' );

                foreach ( $tags as $tag ) {
                    error_log( $tag->tag );
                }
            }

            // save the values for the custom fields in an array

            $pubMetaValues = array(
                'version'              => $version,
                'item_type'            => $itemType,
                'authors'              => $creators,
                'authors_firstnames'   => $creators,
                'authors_lastnames'    => $creators,
                'publication_title'    => $publicationTitle,
                'volume'               => $volume,
                'pages'                => $pages,
                'publication_date'     => $date,
                'series'               => $series,
                'series_title'         => $seriesTitle,
                'series_text'          => $seriesText,
                'journal_abbreviation' => $journalAbbreviation,
                'doi'                  => $DOI,
                'issn'                 => $ISSN,
                'short_title'          => $shortTitle,
                'fallback_url'         => $url,
                'library_catalog'      => $libraryCatalog,
                'tags'                 => $tags,
            );

            // check if post exists by title

            if ( post_exists( $title, '', '', 'publication' ) === 0 ) {
                // go save the publication
                save_publication( $title, array( 'post_content' => $abstract ), $pubMetaValues );
            } else {
                // a post with the same title was found
                // get the existing posts id
                $existing_post = post_exists( $title, '', '', 'publication' );
                // update post only if version number is present and different from current version number
                if ( get_field( 'item_type', $existing_post ) && get_field( 'item_type', $existing_post ) !== $itemType ) {
                    if ( defined( 'WP_DEBUG' ) ) {
                        error_log( 'existing publication is of a different type than this one save as another separate publication' );
                    }
                    save_publication( $title, array( 'post_content' => $abstract ), $pubMetaValues );
                } elseif ( get_field( 'item_type', $existing_post ) && get_field( 'item_type', $existing_post ) === $itemType && get_field( 'version', $existing_post ) && get_field( 'version', $existing_post ) !== $version ) {
                    if ( defined( 'WP_DEBUG' ) ) {
                        error_log( 'publication with same title and type exists but version has changed. Update this publication' );
                    }
                    save_publication( $title, array( 'post_content' => $abstract, 'ID' => $existing_post ), $pubMetaValues );
                } elseif ( get_field( 'version', $existing_post ) && get_field( 'version', $existing_post ) !== $version ) {
                    if ( defined( 'WP_DEBUG' ) ) {
                        error_log( 'update existing publication' );

                        save_publication( $title, array( 'post_content' => $abstract, 'ID' => $existing_post ), $pubMetaValues );
                    }
                }
            }
        }

        // make consecutive calls
        $callCount            = 1;
        $makeConsecutiveCalls = false;

        $totalResultsCount = (int) $response['headers']['Total-Results'];

        if ( defined( 'WP_DEBUG' ) ) {
            error_log( '======== GET SET DATA FOR CONSECUTIVE API CALLS ========' );
            error_log( 'Call count: ' . $callCount );
            error_log( 'Results Limit: ' . $resultsLimit );
            error_log( 'Total Results: ' . $totalResultsCount );
            error_log( 'Total Results datatype: ' . gettype( $totalResultsCount ) );
            error_log( 'First results count: ' . count( $responseBody ) );
            error_log( 'First results Count Type: ' . gettype( count( $responseBody ) ) );
        }

        if ( isset( $totalResultsCount ) && $totalResultsCount > count( $responseBody ) ) {
            if ( defined( 'WP_DEBUG' ) ) {
                error_log( 'THE TOTAL NUMBER OF PUBLICATION RESULTS IS GREATER THEN THE NUMBER RETRIEVED MAKE FOLLOW-UP CALLS' );
            }

            $makeConsecutiveCalls = true;

            while ( $makeConsecutiveCalls ) {
                // make a new call with start
                $start = $callCount * $resultsLimit;
                // create a new Zotero class instance
                $api         = new Zotero( $userID, $groupID, $collection, 'json', array( 'limit' => $resultsLimit, 'start' => $start ) );
                $apiResponse = $api->makeAPICall();

                $apiResponseBody = json_decode( $apiResponse['body'] );

                if ( gettype( $apiResponseBody ) === 'array' ) {
                    foreach ( $apiResponseBody as $item ) {
                        // put the data that will be saved in variables
                        $version             = $item->data->version;
                        $itemType            = $item->data->itemType;
                        $title               = $item->data->title;
                        $creators            = $item->data->creators;
                        $abstract            = $item->data->abstractNote;
                        $publicationTitle    = $item->data->publicationTitle;
                        $volume              = $item->data->volume;
                        $pages               = $item->data->pages;
                        $date                = ( isset( $item->meta->parsedDate ) ) ? $item->meta->parsedDate : $item->data->date;

                        $series              = $item->data->series;
                        $seriesTitle         = $item->data->seriesTitle;
                        $seriesText          = $item->data->seriesText;
                        $journalAbbreviation = $item->data->journalAbbreviation;
                        $DOI                 = 'https://www.doi.org/' . $item->data->DOI;
                        $ISSN                = $item->data->ISSN;
                        $shortTitle          = $item->data->shortTitle;
                        // URL only as a fallback option if there is no Doi
                        $url            = $item->data->url;
                        $libraryCatalog = $item->data->libraryCatalog;
                        $tags           = $item->data->tags;

                        if ( defined( 'WP_DEBUG' ) ) {
                            error_log( '====== ITEM DATA ======' );
                            error_log( 'version: ' . $version );
                            error_log( 'itemType: ' . $itemType );
                            error_log( 'title: ' . $title );
                            error_log( 'creators:' );

                            foreach ( $creators as $author ) {
                                error_log( $author->firstName . ' ' . $author->lastName );
                            }
                            error_log( 'abstractNote: ' . $abstract );
                            error_log( 'publicationTitle: ' . $publicationTitle );
                            error_log( 'volume: ' . $volume );
                            error_log( 'pages: ' . $pages );
                            error_log( 'date: ' . $date );
                            error_log( 'series: ' . $series );
                            error_log( 'seriesTitle: ' . $seriesTitle );
                            error_log( 'seriesText: ' . $seriesText );
                            error_log( 'journalAbbreviation: ' . $journalAbbreviation );
                            error_log( 'DOI: ' . $DOI );
                            error_log( 'ISSN: ' . $ISSN );
                            error_log( 'shortTitle: ' . $shortTitle );
                            error_log( 'url: ' . $url );
                            error_log( 'libraryCatalog: ' . $libraryCatalog );
                            error_log( 'tags:' );

                            foreach ( $tags as $tag ) {
                                error_log( $tag->tag );
                            }
                        }

                        // save the values for the custom fields in an array

                        $pubMetaValues = array(
                            'version'              => $version,
                            'item_type'            => $itemType,
                            'authors'              => $creators,
                            'authors_firstnames'   => $creators,
                            'authors_lastnames'    => $creators,
                            'publication_title'    => $publicationTitle,
                            'volume'               => $volume,
                            'pages'                => $pages,
                            'publication_date'     => $date,
                            'series'               => $series,
                            'series_title'         => $seriesTitle,
                            'series_text'          => $seriesText,
                            'journal_abbreviation' => $journalAbbreviation,
                            'doi'                  => $DOI,
                            'issn'                 => $ISSN,
                            'short_title'          => $shortTitle,
                            'fallback_url'         => $url,
                            'library_catalog'      => $libraryCatalog,
                            'tags'                 => $tags,
                        );

                        // check if post exists by title

                        if ( post_exists( $title, '', '', 'publication' ) === 0 ) {
                            // go save the publication
                            save_publication( $title, array( 'post_content' => $abstract ), $pubMetaValues );
                        } else {
                            // a post with the same title was found
                            // get the existing posts id
                            $existing_post = post_exists( $title, '', '', 'publication' );
                            // update post only if version number is present and different from current version number
                            if ( get_field( 'item_type', $existing_post ) && get_field( 'item_type', $existing_post ) !== $itemType ) {
                                if ( defined( 'WP_DEBUG' ) ) {
                                    error_log( 'existing publication is of a different type than this one save as another separate publication' );
                                }
                                save_publication( $title, array( 'post_content' => $abstract ), $pubMetaValues );
                            } elseif ( get_field( 'item_type', $existing_post ) && get_field( 'item_type', $existing_post ) === $itemType && get_field( 'version', $existing_post ) && get_field( 'version', $existing_post ) !== $version ) {
                                if ( defined( 'WP_DEBUG' ) ) {
                                    error_log( 'publication with same title and type exists but version has changed. Update this publication' );
                                }
                                save_publication( $title, array( 'post_content' => $abstract, 'ID' => $existing_post ), $pubMetaValues );
                            } elseif ( get_field( 'version', $existing_post ) && get_field( 'version', $existing_post ) !== $version ) {
                                if ( defined( 'WP_DEBUG' ) ) {
                                    error_log( 'update existing publication' );

                                    save_publication( $title, array( 'post_content' => $abstract, 'ID' => $existing_post ), $pubMetaValues );
                                }
                            }
                        }
                    }
                }

                $callCount++;

                if ( defined( 'WP_DEBUG' ) ) {
                    error_log( 'Total API call count: ' . $callCount );
                }

                if ( !( $callCount * $resultsLimit < $totalResultsCount ) ) {
                    if ( defined( 'WP_DEBUG' ) ) {
                        error_log( 'STOP MAKING CONSECUTIVE API CALLS' );
                        $makeConsecutiveCalls = false;
                    }
                }
            }
        }
    }
}

add_action( 'retrieve_pubs_from_zotero', 'get_publications_from_zotero', 10 );

/**
 * Handle saving and updating? The publications retrieved from Zotero
 *
 * @param string $title
 * @param array  $args
 * @param array  $metaValues
 *
 * @return void
 */
function save_publication( $title, $args, $metaValues ) {
    $defaults = array(
        'post_title'     => $title,
        'post_content'   => '',
        'post_status'    => 'Publish',
        'comment_status' => 'closed',
        'post_type'      => 'publication',
    );

    $args = array_merge( $defaults, $args );

    $postId = wp_insert_post( $args );

    if ( isset( $metaValues ) && is_array( $metaValues ) ) {
        // save meta's

        foreach ( $metaValues as $key => $metaValue ) {
            if ( defined( 'WP_DEBUG' ) ) {
                error_log( '========= extra data to save in the custom field ========' );
                error_log( 'key: ' . $key );
                error_log( 'value: ' . $metaValue );
            }

            switch ( $key ) {
                case 'authors':
                    $reformattedMetaValue = '';

                    foreach ( $metaValue as $index => $creator ) {
                        if ( $index !== count( $metaValue ) - 1 ) {
                            $reformattedMetaValue .= $creator->firstName . ' ' . $creator->lastName . ', ';
                        } else {
                            $reformattedMetaValue .= $creator->firstName . ' ' . $creator->lastName;
                        }

                        if ( defined( 'WP_DEBUG' ) ) {
                            error_log( 'Creators count: ' . count( $metaValue ) );
                            error_log( 'current creator index: ' . $index );
                        }
                    }

                    if ( defined( 'WP_DEBUG' ) ) {
                        error_log( '====== transform meta value from Array to a comma separated string ======' );
                        error_log( 'original meta value array: ' . print_r( $metaValue, true ) );
                        error_log( 'transformed meta value: ' . $reformattedMetaValue );
                    }
                    break;

                case 'tags':
                    $reformattedMetaValue = '';

                    foreach ( $metaValue as $index => $tag ) {
                        if ( $index !== count( $metaValue ) - 1 ) {
                            $reformattedMetaValue .= $tag->tag . ', ';
                        } else {
                            $reformattedMetaValue .= $tag->tag;
                        }

                        if ( defined( 'WP_DEBUG' ) ) {
                            error_log( 'Tags count: ' . count( $metaValue ) );
                            error_log( 'current tag index: ' . $index );
                        }
                    }

                    if ( defined( 'WP_DEBUG' ) ) {
                        error_log( '====== transform meta value from Array to a comma separated string ======' );
                        error_log( 'original meta value array: ' . print_r( $metaValue, true ) );
                        error_log( 'transformed meta value: ' . $reformattedMetaValue );
                    }
                    break;

                case 'authors_firstnames':
                    $reformattedMetaValue = '';
                    $firstNamesCount      = 0;

                    foreach ( $metaValue as $index => $creator ) {
                        if ( $index !== count( $metaValue ) - 1 ) {
                            $reformattedMetaValue .= $creator->firstName . ', ';
                        } else {
                            $reformattedMetaValue .= $creator->firstName;
                        }

                        if ( !empty( $creator->firstName ) ) {
                            $firstNamesCount + 1;
                        }

                        if ( defined( 'WP_DEBUG' ) ) {
                            error_log( 'Creators count: ' . count( $metaValue ) );
                            error_log( 'Current creator first name(s): ' . $creator->firstName );
                            error_log( 'Current creators firstnames count: ' . $firstNamesCount );
                        }
                    }

                    if ( defined( 'WP_DEBUG' ) ) {
                        error_log( '====== Transform creators from Array to a comma separated string with only the first names ======' );
                        error_log( 'Original creators Array: ' . print_r( $metaValue, true ) );
                        error_log( 'Transformed value only containing first names: ' . $reformattedMetaValue );
                    }
                    break;

                case 'authors_lastnames':
                    $reformattedMetaValue = '';
                    $lastNamesCount       = 0;

                    foreach ( $metaValue as $index => $creator ) {
                        if ( $index !== count( $metaValue ) - 1 ) {
                            $reformattedMetaValue .= $creator->lastName . ', ';
                        } else {
                            $reformattedMetaValue .= $creator->lastName;
                        }

                        if ( !empty( $creator->lastName ) ) {
                            $lastNamesCount + 1;
                        }

                        if ( defined( 'WP_DEBUG' ) ) {
                            error_log( 'Creators count: ' . count( $metaValue ) );
                            error_log( 'Current creator first name(s): ' . $creator->lastName );
                            error_log( 'Current creators firstnames count: ' . $lastNamesCount );
                        }
                    }

                    if ( defined( 'WP_DEBUG' ) ) {
                        error_log( '====== Transform creators from Array to a comma separated string with only the last names ======' );
                        error_log( 'Original creators Array: ' . print_r( $metaValue, true ) );
                        error_log( 'Transformed value only containing last names: ' . $reformattedMetaValue );
                    }
                    break;
            }

            // save meta values or formatted meta value

            if ( $key === 'authors' && isset( $reformattedMetaValue ) || $key === 'tags' && isset( $reformattedMetaValue ) || $key === 'authors_firstnames' && isset( $reformattedMetaValue ) || $key === 'authors_lastnames' && isset( $reformattedMetaValue ) ) {
                // save extra data with transformed value
                if ( defined( 'WP_DEBUG' ) ) {
                    error_log( '====== SAVE EXTRA DATA WITH TRANSFORMED VALUE ======' );
                }
                update_field( $key, $reformattedMetaValue, $postId );
            } else {
                // save extra data as it is
                if ( defined( 'WP_DEBUG' ) ) {
                    error_log( '====== SAVE EXTRA DATA AS IT IS ======' );
                }

                update_field( $key, $metaValue, $postId );
            }
        }
    }
}
