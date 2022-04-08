<?php


add_action('init', 'run');
function run()
{
    $count = 0;
    $args = array(
        'author_id' => 'cRt7JiIAAAAJ',
        'hl'        => 'nl'
    );
    $scholar = new Scholar(THEME_URL . '/resources/dummy.json');

    $originalData = $scholar->make_api_call(SERPAPI_API_KEY, $args);
    $newData = $scholar->strip_data($originalData);


    $decodedData = json_decode($newData);

    foreach ( $decodedData as $article ) {
        $count++;

        if ( $count <= 50 ) {

            if ( defined('WP_DEBUG') ) {
                error_log('========== ARTICLE DATA =========');
                error_log('TITLE: ' . $article->title);
                error_log('AUTHORS: ' . print_r($article->authors, true));
                error_log('URL: ' . $article->link);
                error_log('PUBLICATION YEAR: ' . $article->year);
//                sleep(5);
            }
        }
    }
}

/**
 * @param $url
 * @return bool|DOMDocument
 */
function openScholarUrl( $url )
{
    $xml = new DOMDocument();
    $dom = $xml->loadHTMLFile($url, LIBXML_NOERROR);

    return $dom;
}

