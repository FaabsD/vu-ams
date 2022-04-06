<?php

//add_action('init', 'run');
function run()
{

    $scholar = new Scholar(THEME_URL . '/resources/dummy.json');

    $data = $scholar->read_data();

    foreach ( $data as $item ) {
//        error_log(print_r($item, true));

        if ( array_key_exists('url', $item) ) {

            $html = returnHtmlBody($item['url']);
            error_log($html);
        }
    }
}

/**
 * @param $html
 * @return mixed
 */
function returnHtmlBody( $html )
{
    $dom = new DOMDocument();
    @$dom->loadHTMLFile($html);

    $article = $dom->getElementsByTagName('article');

    return count($article);

}