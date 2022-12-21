<?php

add_action( 'after_setup_theme', 'register_post_types' );
function register_post_types() {
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

    register_post_type( 'software-release', array(
        'labels' => array(
            'name'               => __( 'Software Releases', THEME_TEXT_DOMAIN ),
            'singular_name'      => __( 'Software Release', THEME_TEXT_DOMAIN ),
            'add_new'            => __( 'Add Software Release', THEME_TEXT_DOMAIN ),
            'add_new_item'       => __( 'Add new Software Release', THEME_TEXT_DOMAIN ),
            'all_items'          => __( 'All Software Releases', THEME_TEXT_DOMAIN ),
            'edit_item'          => __( 'Edit Software Release', THEME_TEXT_DOMAIN ),
            'name_admin_bar'     => __( 'Software Releases', THEME_TEXT_DOMAIN ),
            'menu_name'          => __( 'Software Releases', THEME_TEXT_DOMAIN ),
            'new_item'           => __( 'New Software Release', THEME_TEXT_DOMAIN ),
            'not_found'          => __( 'No Software Release found', THEME_TEXT_DOMAIN ),
            'not_found_in_trash' => __( 'No Software Release found in trash', THEME_TEXT_DOMAIN ),
            'search_items'       => __( 'Search Software Releases', THEME_TEXT_DOMAIN ),
            'view_item'          => __( 'View Software Release', THEME_TEXT_DOMAIN ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-media-archive',
        'rewrite'      => array( 'with_front' => true ),
        'supports'     => array( 'title', 'editor', 'excerpt' ),
        'show_in_rest' => true,
    ) );

    // create an FAQ posttype
    register_post_type( 'faq', array(
        'labels' => array(
            'name'               => __( 'FAQ', THEME_TEXT_DOMAIN ),
            'singular_name'      => __( 'FAQ', THEME_TEXT_DOMAIN ),
            'add_new'            => __( 'Add FAQ', THEME_TEXT_DOMAIN ),
            'add_new_item'       => __( 'Add new FAQ', THEME_TEXT_DOMAIN ),
            'all_items'          => __( 'All FAQ', THEME_TEXT_DOMAIN ),
            'edit_item'          => __( 'Edit FAQ', THEME_TEXT_DOMAIN ),
            'name_admin_bar'     => __( 'FAQ', THEME_TEXT_DOMAIN ),
            'menu_name'          => __( 'FAQ', THEME_TEXT_DOMAIN ),
            'new_item'           => __( 'New FAQ', THEME_TEXT_DOMAIN ),
            'not_found'          => __( 'No FAQ found', THEME_TEXT_DOMAIN ),
            'not_found_in_trash' => __( 'No FAQ found in trash', THEME_TEXT_DOMAIN ),
            'search_items'       => __( 'Search FAQ', THEME_TEXT_DOMAIN ),
            'view_item'          => __( 'View FAQ', THEME_TEXT_DOMAIN ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-format-status',
        'rewrite'      => array( 'with_front' => true ),
        'supports'     => array( 'title', 'editor', 'excerpt' ),
        'show_in_rest' => true,
    ) );

    // create a Projects posttype
    register_post_type( 'project', array(
        'labels' => array(
            'name'               => __( 'Projects', THEME_TEXT_DOMAIN ),
            'singular_name'      => __( 'Project', THEME_TEXT_DOMAIN ),
            'add_new'            => __( 'Add project', THEME_TEXT_DOMAIN ),
            'add_new_item'       => __( 'Add new project', THEME_TEXT_DOMAIN ),
            'all_items'          => __( 'All projects', THEME_TEXT_DOMAIN ),
            'edit_item'          => __( 'Edit project', THEME_TEXT_DOMAIN ),
            'name_admin_bar'     => __( 'Projects', THEME_TEXT_DOMAIN ),
            'menu_name'          => __( 'Projects', THEME_TEXT_DOMAIN ),
            'new_item'           => __( 'New project', THEME_TEXT_DOMAIN ),
            'not_found'          => __( 'No projects found', THEME_TEXT_DOMAIN ),
            'not_found_in_trash' => __( 'No projects found in trash', THEME_TEXT_DOMAIN ),
            'search_items'       => __( 'Search projects', THEME_TEXT_DOMAIN ),
            'view_item'          => __( 'View project', THEME_TEXT_DOMAIN ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-portfolio',
        'rewrite'      => array( 'with_front' => true ),
        'supports'     => array( 'title', 'thumbnail', 'editor', 'excerpt' ),
        'show_in_rest' => true,
    ) );

    register_post_type( 'location', array(
        'labels' => array(
            'name'               => __( 'Locations', THEME_TEXT_DOMAIN ),
            'singular_name'      => __( 'Location', THEME_TEXT_DOMAIN ),
            'add_new'            => __( 'Add location', THEME_TEXT_DOMAIN ),
            'add_new_item'       => __( 'Add new location', THEME_TEXT_DOMAIN ),
            'all_items'          => __( 'All locations', THEME_TEXT_DOMAIN ),
            'edit_item'          => __( 'Edit location', THEME_TEXT_DOMAIN ),
            'name_admin_bar'     => __( 'Locations', THEME_TEXT_DOMAIN ),
            'menu_name'          => __( 'Locations', THEME_TEXT_DOMAIN ),
            'new_item'           => __( 'New location', THEME_TEXT_DOMAIN ),
            'not_found'          => __( 'No locations found', THEME_TEXT_DOMAIN ),
            'not_found_in_trash' => __( 'No locations found in trash', THEME_TEXT_DOMAIN ),
            'search_items'       => __( 'Search locations', THEME_TEXT_DOMAIN ),
            'view_item'          => __( 'View location', THEME_TEXT_DOMAIN ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-location-alt',
        'rewrite'      => array( 'with_front' => true ),
        'supports'     => array( 'title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ) );

    // create a posttype to group tags
    register_post_type( 'tag-group', array(
        'labels' => array(
            'name'               => __( 'Tag groups', THEME_TEXT_DOMAIN ),
            'singular_name'      => __( 'Tag group', THEME_TEXT_DOMAIN ),
            'add_new'            => __( 'Add tag group', THEME_TEXT_DOMAIN ),
            'add_new_item'       => __( 'Add new tag group', THEME_TEXT_DOMAIN ),
            'all_items'          => __( 'All tag groups', THEME_TEXT_DOMAIN ),
            'edit_item'          => __( 'Edit tag group', THEME_TEXT_DOMAIN ),
            'name_admin_bar'     => __( 'Tag groups', THEME_TEXT_DOMAIN ),
            'menu_name'          => __( 'Tag groups', THEME_TEXT_DOMAIN ),
            'new_item'           => __( 'New tag group', THEME_TEXT_DOMAIN ),
            'not_found'          => __( 'No tag groups found', THEME_TEXT_DOMAIN ),
            'not_found_in_trash' => __( 'No tag groups found in trash', THEME_TEXT_DOMAIN ),
            'search_items'       => __( 'Search tag groups', THEME_TEXT_DOMAIN ),
            'view_item'          => __( 'View tag group', THEME_TEXT_DOMAIN ),
        ),
        'public'             => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-tag',
        'rewrite'            => array( 'with_front' => true ),
        'supports'           => array( 'title', 'editor' ),
        'show_in_rest'       => false,
        'publicly_queryable' => false,
    ) );

}
