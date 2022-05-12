<?php
/**
 * Add navigation menu location to the theme
 */

add_action( 'init', 'register_menus' );

function register_menus()
{
    register_nav_menus(
        array(
            'navbar' => __( 'Navigation bar', 'Ambulatory Measuring System' ),
        )
    );
}
