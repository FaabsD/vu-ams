<?php

add_action('init', 'VU_AMS_create_custom_taxonomies', 0);
/**
this function will be used to create custom taxonomies
which you could see as some sort of categories/tags
*/
function VU_AMS_create_custom_taxonomies()
{
	// create roles taxonomy for team members
	register_taxonomy(
			'roles',
			'team-member',
			array(
				'hierarchical' => true,
				'labels' => array(
					'name' => _x('Roles', 'taxonomy general name'),
					'singular_name' => _x('Role', 'taxonomy singular name'),
					'search_items' => __('Search Roles', THEME_TEXT_DOMAIN),
					'all_items' => __('All Roles', THEME_TEXT_DOMAIN),
					'parent_item' => __('Parent Role', THEME_TEXT_DOMAIN),
					'parent_item_colon' => __('Parent Role:', THEME_TEXT_DOMAIN),
					'edit_item' => __('Edit Role', THEME_TEXT_DOMAIN),
					'update_item' => __('Update Role', THEME_TEXT_DOMAIN),
					'add_new_item' => __('Add new Role', THEME_TEXT_DOMAIN),
					'new_item_name' => __('New Role Name', THEME_TEXT_DOMAIN),
					'menu_name' => __('Roles'),
				),
				'show_ui' => true,
				'show_in_rest' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => array('slug' => 'role'),
			) 
		);

}
