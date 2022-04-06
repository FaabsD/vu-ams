<?php
class Scholar
{
    private $url;

    private $jsonData;
    private $return = array();

    /**
     * @param $api_link
     */
    public function __construct( $api_link )
    {
        $this->url = $api_link;
    }

    /**
     * @param $url
     * @return void
     */
    private function getPubs( $url )
    {
        $this->jsonData = file_get_contents($url);
    }

    /**
     * @param $json
     * @return mixed
     */
    private function parse_json_data( $json )
    {
        return json_decode($json, true);
    }

    private function get_remote_file_mime( $url )
    {
        $response = wp_remote_get($url);

        return wp_remote_retrieve_header($response, 'content-type');
    }

    /**
     * @return array
     */
    public function read_data()
    {
        $this->getPubs($this->url);
        $decodedJson = $this->parse_json_data($this->jsonData);
//        error_log('========[Google Scholar Data]========');

        foreach ( $decodedJson['organic_results'] as $index => $result ) {
//            error_log('title =>' . $result['title']);
            $myArr = array();
            $myArr['title'] = $result['title'];

            if ( array_key_exists('resources', $result) ) {
                $sourceUrl = $result['resources'][0]['link'];

                $myArr['url'] = $sourceUrl;
//                error_log('resource-link => ' . $sourceUrl);
                if (isset($sourceUrl) && !empty($sourceUrl)) {

                    $fileType = $this->get_remote_file_mime($sourceUrl);

                    if ( isset($fileType) ) {
//                        error_log('resource-file-type => ' . $fileType);

                        if ( str_contains($fileType, 'application/pdf') ) {
//                        error_log('This publication source is a PDF');
                        } elseif ( str_contains($fileType, 'text/html') ) {
                            $myArr['sourceType']  = 'html';

                        }
                    }
                }

            }

            $this->return[$index] = $myArr;
        }

        return $this->return;

    }
}