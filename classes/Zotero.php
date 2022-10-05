<?php

/**
 * An class created to make API calls to the Zotero API.
 *
 * @param mixed  $userId
 * @param mixed  $groupId
 * @param mixed  $collection
 * @param string $format
 * @param array  $additionalParams
 *
 * For more information on the accepted (additional) parameters head to the API documentation
 * https://www.zotero.org/support/dev/web_api/v3/start
 */
class Zotero {

    protected string $base_url = 'https://api.zotero.org';
    protected $userId;
    protected $groupId;
    protected $collection;
    protected $format;
    protected array $params;
    private int $apiVersion = 3;
    public $response;

    public function __construct( int $userId = 0, int $groupId = 0, $collection = null, string $format = 'json', array $additionalParams = array() ) {
        $this->userId     = $userId;
        $this->groupId    = $groupId;
        $this->collection = $collection;
        $this->format     = $format;
        $this->params     = $additionalParams;
    }

    /**
     * Set the API version to use with Zotero
     * Default is 3
     *
     * @return void
     */
    public function set_version( int $apiVersion ) {
        $this->apiVersion = $apiVersion;
    }

    /**
     * Make an API call to the Zotero API
     *
     * @return void
     */
    public function makeAPICall() {
        error_log( '======== START DEBUGGING THE ZOTERO API CALL ========' );
        $url = null;
        // set the parameters
        $params = array(
            'format' => $this->format,
            'v'      => $this->apiVersion,
        );

        // merge $params with the $this->params
        $this->params = array_merge( $params, $this->params );
        // create api url according to construct
        if ( $this->userId != 0 && $this->groupId === 0 ) {
            // set the url to use the provided user id
            $url = $this->base_url . '/users/' . $this->userId;

            // check if an collection id was provided if so add it to the URL
            if ( isset( $this->collection ) ) {
                $url = $url . '/collections/' . $this->collection . '/items/top';
            } else {
                $url = $url . '/items/top';
            }
        } elseif ( $this->groupId != 0 && $this->userId === 0 ) {
            $url = $this->base_url . '/groups/' . $this->groupId;

            // again check if an collection id was given if so add to the url
            if ( isset( $this->collection ) ) {
                $url = $url . '/collections/' . $this->collection . '/items/top' /* the "/top" part is to return top level items without the attachments */;
            } else {
                // only append /top to url
                $url = $url . '/items/top';
            }
        } else {
            error_log( 'No user ID or group ID provided stooping the call...' );
            exit();
        }

        error_log( '===== ZOTERO API URL =====' );
        error_log( $url );

        // create a new instance of curl
        $curl = curl_init();

        // append params to the url
        $finalUrl = $url . '?' . http_build_query( $this->params );

        error_log( '===== FINAL API URL =====' );
        error_log( $finalUrl );

        // set URL IN CURL
        curl_setopt( $curl, CURLOPT_URL, $finalUrl );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );

        $this->response = curl_exec( $curl );

        curl_close( $curl );

        error_log( '===== Final result of the API call =====' );

        error_log( $this->response );

        return $this->response;
    }
}
