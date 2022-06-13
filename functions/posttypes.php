<?php
add_action( 'after_setup_theme', 'register_post_types' );
function register_post_types()
{
    register_post_type( 'publication', array(

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

    ) );

    register_post_type( 'team-member', array(
        'labels'       => array(
            'name'               => __( 'Team-members', THEME_TEXT_DOMAIN ),
            'singular_name'      => __( 'Team-member', THEME_TEXT_DOMAIN ),
            'add_new'            => __( 'Add team-member', THEME_TEXT_DOMAIN ),
            'add_new_item'       => __( 'Add new team-member', THEME_TEXT_DOMAIN ),
            'all_items'          => __( 'All team-members', THEME_TEXT_DOMAIN ),
            'edit_item'          => __( 'Edit team-member', THEME_TEXT_DOMAIN ),
            'name_admin_bar'     => __( 'Team-members', THEME_TEXT_DOMAIN ),
            'menu_name'          => __( 'Team-members', THEME_TEXT_DOMAIN ),
            'new_item'           => __( 'New team-member', THEME_TEXT_DOMAIN ),
            'not_found'          => __( 'No team-members found', THEME_TEXT_DOMAIN ),
            'not_found_in_trash' => __( 'No team-members found in trash', THEME_TEXT_DOMAIN ),
            'search_items'       => __( 'Search team-members', THEME_TEXT_DOMAIN ),
            'view_item'          => __( 'View team-member', THEME_TEXT_DOMAIN ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-groups',
        'rewrite'      => array( 'with_front' => true ),
        'supports'     => array( 'title', 'thumbnail', 'editor', 'excerpt' ),
        'show_in_rest' => false,
    ) );

    register_post_type('software-release', array(
        'labels' => array(
            'name' => 'Software Releases',
            'singular_name' => 'Software Release',
            'add_new' => 'Add Software Release',
            'add_new_item' => 'Add new Software Release',
            'all_items' => 'All Software Releases',
            'edit_item' => 'Edit Software Release',
            'name_admin_bar' => 'Software Releases',
            'menu_name' => 'Software Releases',
            'new_item' => 'New Software Release',
            'not_found' => 'No Software Release found',
            'not_found_in_trash' => 'No Software Release found in trash',
            'search_items' => 'Search Software Releases',
            'view_item' => 'View Software Release',
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-media-archive',
        'rewrite'      => array( 'with_front' => true ),
        'supports'     => array( 'title', 'editor', 'excerpt'),
        'show_in_rest' => true,
    ));
}
