<?php
/**
 * Register theme widgets
 */

add_action('init', 'register_widgets');

function register_widgets()
{
    register_sidebar( array(
        'name'          => 'navbar call to action',
        'id'            => 'navbar_menu_section',
        'before_widget' => '<div class="navigation__cta">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ) );
}