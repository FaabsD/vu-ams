<?php
add_action('after_setup_theme', 'register_post_types');
function register_post_types()
{
    register_post_type('publication', array(

        'labels'       => array(
            'name'               => __( 'Publications', THEME_TEXT_DOMAIN ),
            'singular_name'      => __( 'Publication', THEME_TEXT_DOMAIN ),
            'add_new'            => __( 'Add publication', THEME_TEXT_DOMAIN ),
            'add_new_item'       => __( 'Add new publication', THEME_TEXT_DOMAIN ),
            'all_items'          => __( 'All publications', THEME_TEXT_DOMAIN ),
            'edit_item'          => __( 'Edit publication', THEME_TEXT_DOMAIN ),
            'name_admin_bar'     => __( 'Publications', THEME_TEXT_DOMAIN ),
            'menu_name'          => __( 'Publications', THEME_TEXT_DOMAIN ),
            'new_item'           => __( 'New publication', THEME_TEXT_DOMAIN ),
            'not_found'          => __( 'No publication found', THEME_TEXT_DOMAIN ),
            'not_found_in_trash' => __( 'No publication found in trash', THEME_TEXT_DOMAIN ),
            'search_items'       => __( 'Search publication', THEME_TEXT_DOMAIN ),
            'view_item'          => __( 'View publication', THEME_TEXT_DOMAIN ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-text-page',
        'rewrite'      => array( 'with_front' => true ),
        'supports'     => array( 'title', 'thumbnail', 'editor', 'excerpt' ),
        'show_in_rest' => true,

    ));
}
