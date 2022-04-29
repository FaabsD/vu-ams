<?php
define('THEME_URL', get_template_directory_uri() . '');
define('THEME_TEXT_DOMAIN', wp_get_theme()->get('Text Domain'));

add_action('after_setup_theme', 'theme_setup');

function theme_setup() {
    if (!isset( $content_width )) {
        $content_width = 1140;
    }

    // add theme supports
    add_theme_support('menus');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-formats', array('quote', 'image', 'gallery', 'video', 'page'));
    add_theme_support('get_avatar');
    add_theme_support('wp_list_comments');

    add_theme_support('html', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'widgets'));
    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');
    add_image_size('custom-thumbnail-image-size', 570, 380, true);
}

// add support for custom logo
function custom_logo_setup() {
    $defaults = array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => array('site-title', 'site-description'),
        'unlink-homepage-logo' => false,
    );

    add_theme_support('custom-logo', $defaults);
}

add_action('after_setup_theme', 'custom_logo_setup');

/**
 * Display or get post image
 * @param array $args
 *
 * @return void|string
 */

function get_image( $args = array() ) {
    $default = array(
        'post_id'   => 0,
        'size'      => 'thumbnail',
        'format'    => 'html', // html or src
        'attr'      => '',
        'thumbnail' => true,
        'scan'      => true,
        'echo'      => true,
        'default'   => '',
        'meta_key'  => '',
    );

    $args = wp_parse_args( $args, $default );

    if ( ! $args[ 'post_id' ] ) {
        $args[ 'post_id' ] = get_the_ID();
    }

    // Get image from cache
    $key = md5( serialize( $args ) );
    $image_cache = wp_cache_get( $args['post_id'], __FUNCTION__ );

    if ( !is_array( $image_cache ) )
        $image_cache = array();

    if ( empty( $image_cache[$key] ) )
    {
        // Get post thumbnail
        if ( has_post_thumbnail( $args['post_id'] ) && $args['thumbnail'] )
        {
            $id = get_post_thumbnail_id( $args['post_id'] );
            $html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
            list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false );
        }

        // Get the first image in the custom field
        if ( !isset( $html, $src ) && $args['meta_key'] )
        {
            $id = get_post_meta( $args['post_id'], $args['meta_key'], true );

            // Check if this post has attached images
            if ( $id )
            {
                $html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
                list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false );
            }
        }

        // Get the first attached image
        if ( !isset( $html, $src ) )
        {
            $image_ids = array_keys( get_children( array(
                'post_parent'    => $args['post_id'],
                'post_type'	     => 'attachment',
                'post_mime_type' => 'image',
                'orderby'        => 'menu_order',
                'order'	         => 'ASC',
            ) ) );

            // Check if this post has attached images
            if ( !empty( $image_ids ) )
            {
                $id = $image_ids[0];
                $html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
                list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false );
            }
        }

        // Get the first image in the post content
        if ( !isset( $html, $src ) && ( $args['scan'] ) )
        {
            preg_match( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field( 'post_content', $args['post_id'] ), $matches );

            if ( !empty( $matches ) )
            {
                $html = $matches[0];
                $src = $matches[1];
            }
        }

        // Use default when nothing found
        if ( !isset( $html, $src ) && !empty( $args['default'] ) )
        {
            if ( is_array( $args['default'] ) )
            {
                $html = @$args['html'];
                $src = @$args['src'];
            }
            else
            {
                $html = $src = $args['default'];
            }
        }

        // Still no images found?
        if ( !isset( $html, $src ) )
            return false;

        $output = 'html' === strtolower( $args['format'] ) ? $html : $src;

        $image_cache[$key] = $output;
        wp_cache_set( $args['post_id'], $image_cache, __FUNCTION__ );
    }
    // If image already cached
    else
    {
        $output = $image_cache[$key];
    }

    if ( ! $args[ 'echo' ] ) {
        return $output;
    }

    echo $output;
}

/**
 * Custom the_title function
 * With custom length
 *
 * @param $size
 * @return string
 */
function custom_title_length( $size ) {
    $output = '';

    $title = get_the_title();
    if ( strlen( $title ) > $size ) {

        if ( strpos( $title, ' ', $size ) == true ) {
            $output .= substr( get_the_title( '', '', false ), 0, strpos( $title, ' ', $size ) ) . '...';
        } else {
            $output .= substr( get_the_title('', '', false), 0, $size ) . '...';
        }

    } else {
        $output .= get_the_title();
    }

    echo $output;

}

/**
 * Custom the_excerpt function
 * With custom length
 *
 * @param $size
 * @return string
 */
function custom_excerpt_length( $size ) {

    $output = '';

    $content = get_the_excerpt();

    if ( strlen( $content ) > $size ) {

        if ( strpos( $content, ' ', $size ) == true ) {
            $output .= substr( get_the_excerpt( '', '', false ), 0, strpos( $content, ' ', $size ) );
        } else {
            $output .= substr( get_the_excerpt( '', '', false ), 0, $size ) . '...';
        }

    } else {

        $output .= get_the_excerpt();

    }

    echo $output;
}

/**
 * Custom pagination
 *
 * @param int $pages
 * @param int $range
 */
function custom_pagination( $pages = 0, $range = 2 ) {

    $showItems = ( $range * 2 ) + 1;

    global $paged;

    if ( empty( $paged ) ) $paged = 1;

    if ( $pages == 0 ) {

        global $wp_query;

        $pages = $wp_query->max_num_pages;

        if ( !$pages ) {
            $pages = 1;
        }

    }

    $result = '';

    if ( 1 != $pages ) {

        $result = '<ul class="pagination">';

        for ( $i = 1; $i <= $pages; $i++ ) {

            if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showItems) ) {

                $result .= ( $paged == $i ) ? '<li class="active"><a href="' . get_pagenum_link( $i ) . '"><span>' . $i . '</span></a></li>':'<li><a href=">' . get_pagenum_link( $i ) . '" class="g-pagination-item"><span>'. $i . '</span></a></li>';

            }

        }

        $result .= '</ul>';

    }

    return $result;

}

/**
 *
 * Custom WordPress body classes
 *
 * @param $classes
 * @return array|mixed
 */

function custom_body_class( $classes = array() )
{
    global $post;

    // Add category class on each post
    if ( ! is_admin() && is_single() ) {
        foreach ( get_the_category( $post->ID ) as $category ) {
            // Add category slug to the $classes array
            $classes[] = $category->category_nicename;
        }
    }

    // Add page specific class on each page-*.php
    if ( $templates = wp_get_theme()->get_page_templates() ) {
        foreach ( $templates as $slug => $name ) {
            if ( is_page_template( $slug ) ) {
                // Add page name to the $classes array
                $classes[] = sanitize_title( $name );
            }
        }
    }

    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    return $classes;
}

add_filter('body_class', 'custom_body_class');

/**
 * Load a template part into a template
 *
 * This allows to use the same root without having
 * to constantly writing the "get_template_part()" function
 * over and over again
 *
 * @param string $view
 * @param string $name
 *
 * @return string
 */
function template_view( $view, $name = null )
{
    if ( $name ) {
        $name = (string) '-' . $name;
    }

    return get_template_part('resources/views/' . str_replace( '.', '/', $view ) . $name );
}

/**
 * Let's use a new helper function to wrap the last word of a string in
 * a span width the class "colored-word"
 * @param $str
 * @return string
 */
function colorize_last_string_word($str) {
    $strArr = explode(' ', $str);
    // print_r($strArr);

    foreach ($strArr as $iterator => $word) {
        if (count($strArr) === $iterator + 1) {
            $strArr[$iterator] = '<span class="colored-word">' . $word . '</span>';
        }
    }
    return implode(' ', $strArr);
}
