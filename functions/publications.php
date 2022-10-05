<?php

function get_publications_from_zotero() {
    $userID     =  ( defined( 'ZOTERO_USER_ID' ) && null !== ZOTERO_USER_ID ) ? ZOTERO_USER_ID : 0;
    $groupID    = ( defined( 'ZOTERO_GROUP_ID' ) && null !== ZOTERO_GROUP_ID ) ? ZOTERO_GROUP_ID : 0;
    $collection = ( defined( 'ZOTERO_COLLECTION_ID' ) && null !== ZOTERO_COLLECTION_ID ) ? ZOTERO_COLLECTION_ID : null;

    error_log( '===== SETUP ZOTERO API CALL USER_ID, GROUP_ID, COLLECTION ========' );
    error_log( 'user id: ' . $userID );
    error_log( 'group id: ' . $groupID );
    error_log( 'collection: ' . $collection );

    $zotero     = new Zotero( $userID, $groupID, $collection, 'json' );

    $zotero->makeAPICall();
}

add_action( 'retrieve_pubs_from_zotero', 'get_publications_from_zotero', 10 );
