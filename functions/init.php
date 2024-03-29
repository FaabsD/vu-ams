<?php

define('THEME_URL', get_template_directory_uri() . '');
define('THEME_TEXT_DOMAIN', wp_get_theme()->get('Text Domain'));

add_action('after_setup_theme', 'theme_setup');

function theme_setup()
{
    if (!isset($content_width)) {
        $content_width = 1140;
    }

    // add theme supports
    add_theme_support('menus');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-formats', [ 'quote', 'image', 'gallery', 'video', 'page' ]);
    add_theme_support('get_avatar');
    add_theme_support('wp_list_comments');

    add_theme_support('html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'widgets' ]);
    add_theme_support('title-tag');

    // add theme support for Woocommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    add_theme_support('post-thumbnails');
    add_image_size('custom-thumbnail-image-size', 570, 380, true);

    // add filter to add search bar to primary navigation menu

    add_filter('wp_nav_menu_items', 'ams_add_searchbar_to_navigation', 10, 2);

    /**
     * Add a searchbar to the end of the main navigation
     *
     * @param [type] $items
     * @param [type] $args
     *
     * @return void
     */
    function ams_add_searchbar_to_navigation( $items, $args )
    {
        if (defined('WP_DEBUG') ) {
            error_log(print_r($args, true));
        }

        if ($args->menu == 'navbar' ) {
            $items .= '<li class="menu-item menu-searchbar">' . get_search_form(array( 'echo' => false )) . '</li>';
        }

        return $items;
    }

}

// add support for custom logo
function custom_logo_setup()
{
    $defaults = [
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => [ 'site-title', 'site-description' ],
        'unlink-homepage-logo' => false,
    ];

    add_theme_support('custom-logo', $defaults);
}

add_action('after_setup_theme', 'custom_logo_setup');

/**
 * Display or get post image
 *
 * @param array $args
 *
 * @return void|string
 */

function get_image($args = [])
{
    $default = [
        'post_id'   => 0,
        'size'      => 'thumbnail',
        'format'    => 'html', // html or src
        'attr'      => '',
        'thumbnail' => true,
        'scan'      => true,
        'echo'      => true,
        'default'   => '',
        'meta_key'  => '',
    ];

    $args = wp_parse_args($args, $default);

    if (!$args['post_id']) {
        $args['post_id'] = get_the_ID();
    }

    // Get image from cache
    $key = md5(serialize($args));
    $image_cache = wp_cache_get($args['post_id'], __FUNCTION__);

    if (!is_array($image_cache)) {
        $image_cache = [];
    }

    if (empty($image_cache[$key])) {
        // Get post thumbnail
        if (has_post_thumbnail($args['post_id']) && $args['thumbnail']) {
            $id = get_post_thumbnail_id($args['post_id']);
            $html = wp_get_attachment_image($id, $args['size'], false, $args['attr']);
            [$src] = wp_get_attachment_image_src($id, $args['size'], false);
        }

        // Get the first image in the custom field
        if (!isset($html, $src) && $args['meta_key']) {
            $id = get_post_meta($args['post_id'], $args['meta_key'], true);

            // Check if this post has attached images
            if ($id) {
                $html = wp_get_attachment_image($id, $args['size'], false, $args['attr']);
                [$src] = wp_get_attachment_image_src($id, $args['size'], false);
            }
        }

        // Get the first attached image
        if (!isset($html, $src)) {
            $image_ids = array_keys(
                get_children(
                    [
                    'post_parent'    => $args['post_id'],
                    'post_type'      => 'attachment',
                    'post_mime_type' => 'image',
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                    ]
                )
            );

            // Check if this post has attached images
            if (!empty($image_ids)) {
                $id = $image_ids[0];
                $html = wp_get_attachment_image($id, $args['size'], false, $args['attr']);
                [$src] = wp_get_attachment_image_src($id, $args['size'], false);
            }
        }

        // Get the first image in the post content
        if (!isset($html, $src) && ($args['scan'])) {
            preg_match('|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field('post_content', $args['post_id']), $matches);

            if (!empty($matches)) {
                $html = $matches[0];
                $src = $matches[1];
            }
        }

        // Use default when nothing found
        if (!isset($html, $src) && !empty($args['default'])) {
            if (is_array($args['default'])) {
                $html = @$args['html'];
                $src = @$args['src'];
            } else {
                $html = $src = $args['default'];
            }
        }

        // Still no images found?
        if (!isset($html, $src)) {
            return false;
        }

        $output = 'html' === strtolower($args['format']) ? $html : $src;

        $image_cache[$key] = $output;
        wp_cache_set($args['post_id'], $image_cache, __FUNCTION__);
    } // If image already cached
    else {
        $output = $image_cache[$key];
    }

    if (!$args['echo']) {
        return $output;
    }

    echo $output;
}

/**
 * Custom the_title function
 * With custom length
 *
 * @param  $size
 * @return string
 */
function custom_title_length($size)
{
    $output = '';

    $title = get_the_title();
    if (strlen($title) > $size) {
        if (strpos($title, ' ', $size) == true) {
            $output .= substr(get_the_title('', '', false), 0, strpos($title, ' ', $size)) . '...';
        } else {
            $output .= substr(get_the_title('', '', false), 0, $size) . '...';
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
 * @param  $size
 * @return string
 */
function custom_excerpt_length($size)
{
    $output = '';

    $content = get_the_excerpt();

    if (strlen($content) > $size) {
        if (strpos($content, ' ', $size) == true) {
            $output .= substr(get_the_excerpt('', '', false), 0, strpos($content, ' ', $size));
        } else {
            $output .= substr(get_the_excerpt('', '', false), 0, $size) . '...';
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
function custom_pagination($pages = '', $range = 2)
{
    $showitems = ($range * 2) + 1;

    global $paged;
    if (empty($paged)) {
        $paged = 1;
    }

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<div class='pagination'>";
        if ($paged > 1 && $showitems < $pages) {

            echo "<a href='" . get_pagenum_link($paged - 1) . "' class='prev' title='Previous page'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path d='M4 4l12 6-12 6z'/></svg></a>";

        }
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
            echo "<a href='" . get_pagenum_link(1) . "' title='Page 1'>1</a>";
            echo "<span class='pagination-dots'>...</span>";
        }
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ( $paged == $i ) ? "<span class='current'>" . $i . '</span>' : "<a href='" . get_pagenum_link($i) . "' class='inactive' title='Page " . $i . "'>" . $i . '</a>';

            }
        }
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
            if ($pages - $paged >= 4) {
                echo "<span class='pagination-dots'>... </span>";
            }
            echo "<a href='" . get_pagenum_link($pages) . "' title='Page " . $i . "'>". $pages . "</a>";
        }
        if ($paged < $pages && $showitems < $pages && $pages - $paged >= 4) {

            echo "<a href='" . get_pagenum_link($paged + 1) . "' class='next' title='Next page'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path d='M4 4l12 6-12 6z'/></svg></a>";

        }

        echo "</div>\n";
    }
}

/**
 * Custom WordPress body classes
 *
 * @param  $classes
 * @return array|mixed
 */

function custom_body_class($classes = [])
{
    global $post;

    // Add category class on each post
    if (!is_admin() && is_single()) {
        foreach (get_the_category($post->ID) as $category) {
            // Add category slug to the $classes array
            $classes[] = $category->category_nicename;
        }
    }

    // Add page specific class on each page-*.php
    if ($templates = wp_get_theme()->get_page_templates()) {
        foreach ($templates as $slug => $name) {
            if (is_page_template($slug)) {
                // Add page name to the $classes array
                $classes[] = sanitize_title($name);
            }
        }
    }

    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
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
function template_view($view, $name = null)
{
    if ($name) {
        $name = (string)'-' . $name;
    }

    return get_template_part('resources/views/' . str_replace('.', '/', $view) . $name);
}

/**
 * Let's use a new helper function to wrap the last word of a string in
 * a span width the class "colored-word"
 *
 * @param  $str
 * @return string
 */
function colorize_last_string_word($str)
{
    $strArr = explode(' ', $str);
    // print_r($strArr);

    foreach ($strArr as $iterator => $word) {
        if (count($strArr) === $iterator + 1) {
            $strArr[$iterator] = '<span class="colored-word">' . $word . '</span>';
        }
    }
    return implode(' ', $strArr);
}

/**
 * Get all publication dates (Years)
 *
 * @return array|false
 */
function getPublicationDates()
{
    $args = [
        'post_type'      => 'publication',
        'posts_per_page' => -1,
    ];
    $query = new WP_Query($args);

    $dates = [];


    if ($query->have_posts()) :
        $posts = $query->posts;
        foreach ($posts as $index => $post) {
            error_log($index);

            $date = get_post_meta($post->ID, 'publication_date', true);


            if (strlen($date) > 4 ) {
                $dates[$index] = substr($date, 0, 4);
            } else {
                $dates[$index] = $date;
            }

            $dates = array_unique($dates, SORT_NUMERIC);
            arsort($dates);
            array_unshift($dates);
        
        }
        wp_reset_query();
        return $dates; else:
            wp_reset_query();
            return false;
        endif;
}

/**
 * Determine if the full post content word count is greater 
 * then the excerpt word count and if excerpt word count is greater then 1
 *
 * @param  string $excerpt
 * @param  string $full_text
 * @return boolean
 */
function check_longer_than_excerpt($excerpt, $full_text = null)
{
    // get excerpt length
    $excerptWordCount = (str_word_count($excerpt) > 1) ? str_word_count($excerpt) -1 : str_word_count($excerpt);
    $full_text_word_count = preg_split('/[\s,.:]+/', htmlentities(strip_tags($full_text)));


    if (defined('WP_DEBUG')) {
        error_log("======== DEBUGGING THE CHECK_LONGER_THAN_EXCERPT FUNCTION ========");
        error_log("Full text wordcount = " . count($full_text_word_count));
        error_log("excerp wordcount = " . $excerptWordCount);

        error_log("fulltext wordcount higher then or equal to excerpt wordcount =  ". (count($full_text_word_count) >= $excerptWordCount) ? "true" : "false");
        error_log('====== Original text stripped from tags ======');
        error_log(htmlentities(strip_tags($full_text)));
    }

    if(is_array($full_text_word_count) && count($full_text_word_count) >= $excerptWordCount && $excerptWordCount > 1) {
        return true;
    }

    return false;
}


/**
 * Retrieve all the publications tags
 *
 * @return array|false
 */
function publicationTags()
{
    global $post;
    // retrieve all publications first
    $args = array(
        'post_type'      => 'publication',
        'posts_per_page' => -1,
        'order'          => 'ASC',
    );

    $tags = array();

    $query = new WP_Query($args);

    if ($query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
            $current_post_tags = get_post_meta($post->ID, 'tags', true);
            
            if(isset($current_post_tags) && !empty($current_post_tags)) {
                $current_post_tags_arr = explode(", ", $current_post_tags);
            }

            if(isset($current_post_tags_arr) && is_array($current_post_tags_arr)) {
                foreach ($current_post_tags_arr as $current_post_tag) {
                    $tags[] = $current_post_tag;
                }
            }

            if(defined('WP_DEBUG') ) {
                error_log($current_post_tags);
            }
        endwhile;
        wp_reset_query(); 
        if(defined('WP_DEBUG')) {
            error_log('======== ALL THE TAGS FROM THE PUBLICATIONS ========');
            error_log(print_r($tags, true));
        }
        return $tags;
    endif;
    return false;
}

/**
 * filter all the most used tags from given tags array
 * and return those with duplicates filtered out
 *
 * @param array $unfilteredTags
 * @param integer $minimumCount The minimum count that a tag should occur in the given array
 * @return array
 */
function getMostUsedTags( array $unfilteredTags, int $minimumCount = 5)
{
    $filteredTags = array();
    $mostUsedTags = array();
    $tagsCounts = array_count_values($unfilteredTags);

    if(defined('WP_DEBUG')) {
        error_log(print_r($tagsCounts, true));
    }

    if(is_array($tagsCounts)) {
        foreach($tagsCounts as $key => $tagCount) {
            if($tagCount >= $minimumCount) {
                $mostUsedTags[] = $key;
            }
        }

        if(defined('WP_DEBUG')) {
            error_log('======== Most used tags filtered ========');
            error_log(print_r($mostUsedTags, true));
        }
    }

    if(is_array($mostUsedTags) && count($mostUsedTags) >= 1) {
        // filter out all the double entries case insensitive
        $filteredTags = array_intersect_key($mostUsedTags, array_unique(array_map('strtolower', $mostUsedTags)));

        if(defined('WP_DEBUG')) {
            error_log('======== FILTERED TAGS ARRAY WITHOUT DUPLICATES ========');
            error_log(print_r($filteredTags, true));
        }
    }

    return $filteredTags;
}
