<?php
add_action('post_updated', 'update_publication_content');

function update_publication_content( $post_ID )
{
    if ( get_post_type($post_ID) != 'publication' ) {
        if ( defined('WP_DEBUG') ) {
            error_log('========== POST IS NOT A PUBLICATION ==========');
        }
        return false;
    }

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        if ( defined('WP_DEBUG') ) {
            error_log('========== PUBLICATION WAS SAVED AUTOMATICALLY ==========');
        }
        return false;
    }

    if ( defined('WP_DEBUG') ) {
        error_log('========== UPDATE PUBLICATION WITH CONTENT ==========');
    }

    $sourceUrl = get_field('source_url', $post_ID);

    if ( defined('WP_DEBUG') ) {
        error_log('==== POST_ID ====');
        error_log($post_ID);

        error_log('==== SOURCE_URL ====');
        error_log($sourceUrl);
    }

    $urlType = get_field('type_of_url');
    error_log('======== TYPE OF URL =========');
    error_log(print_r($urlType, true));

    if ( isset($sourceUrl) && str_contains($sourceUrl, 'pdf') ) {
        error_log('Link is a PDF');

    } else {
        $html = get_html_from_url($sourceUrl);

        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        $elements = $xpath->query("/html/body");

        $childrenToRemove = array();

        if ( $elements->length === 1 ) {

            $body = $elements->item(0);
            foreach ( $body->childNodes as $node ) {

                if ( defined('WP_DEBUG') ) {
                    error_log('==== NODE NAME ====');
                    error_log($node->nodeName);
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
                        $name = $node->attributes->item($i)->name;
                        if ( 'href' !== $name ) {
                            $node->removeAttribute($name);
                        }
                    }
                }
            }
            if ( count($childrenToRemove) > 0 ) {
                if ( defined('WP_DEBUG') ) {
                    error_log('==== TAGS TO REMOVE ====');
                    error_log(print_r($childrenToRemove, true));
                }

                foreach ( $childrenToRemove as $child ) {
                    $child->parentNode->removeChild($child);
                }
            }


            $newBody = $dom->saveHTML($body);
            error_log('==== STRIPPED HTML BODY ====');
            error_log($newBody);
        }

    }

}

/**
 * @param $url
 * @return bool|string
 */
function get_html_from_url( $url )
{
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

    $html = curl_exec($ch);
    curl_close($ch);

    return $html;
}
