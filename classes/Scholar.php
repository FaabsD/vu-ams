<?php

/**
 * Scholar
 * We will be using this class to make API calls to the SerpApi
 * and to return the data we need.
 */
require_once dirname( __DIR__ ) . '/vendor/autoload.php';


class Scholar
{
    private $url;

    private $jsonData;
    private $return = array();

    private array $defaultArgs = [
        "engine"    => "google_scholar_author",
        "hl"        => "nl",
        "author_id" => "cRt7JiIAAAAJ",
        "num"       => 0,
        "start"     => 0,
    ];

    /**
     * @param $api_link
     */
    public function __construct( $api_link )
    {
        $this->url = $api_link;
    }

    /**
     * @param array $args
     * @return false|string
     */
    public function make_api_call( $key = null, $args = [] )
    {
        $this->jsonData = file_get_contents( $this->url );
        if ( isset( $key ) && !empty( $key ) ) {
            if ( count( $args ) >= 1 ) {
                $args = array_merge( $this->defaultArgs, $args );
                if ( defined( 'WP_DEBUG' ) ) {
                    error_log( '======= API arguments ====' );
                    error_log( print_r( $args, true ) );
                }
            } else {
                $args = $this->defaultArgs;
                if ( define( 'WP_DEBUG' ) ) {
                    error_log( '========== API arguments ==========' );
                    error_log( print_r( $args, true ) );
                }
            }
            // TODO: Make an Actual API call
            $search = new GoogleSearch( $key );
            $this->jsonData = $search->get_json( $args );

        }

        return $this->jsonData;
    }

    /**
     * Return only the relevant Article data (title, link, authors, year)
     * and pagination data
     * @param $json
     * @return false|string
     */
    public function strip_data( $json )
    {
        $decodedJson = json_decode( $json );
//        error_log('========[Google Scholar Data]========');
//        error_log('==== data ====');
        foreach ( $decodedJson->articles as $index => $article ) {
            $newArr = array();

            $newArr['title'] = $article->title;
            $newArr['link'] = $article->link;
            $newArr['authors'] = explode( ', ', $article->authors );
            $newArr['year'] = $article->year;

            $this->return[$index] = $newArr;

//            error_log(print_r($newArr, true));
        }

        return json_encode( $this->return );

    }
}