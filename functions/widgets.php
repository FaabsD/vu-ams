<?php
/**
 * Register theme widgets
 */

add_action('init', 'register_widgets');

function register_widgets()
{
    register_sidebar([
        'name'          => 'navbar call to action',
        'id'            => 'navbar_menu_section',
        'before_widget' => '<div class="navigation__cta">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => 'Footer Address',
        'id'            => 'footer_address',
        'before_widget' => '<div class="footer__address">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => 'Footer Sitemap',
        'id'            => 'footer_sitemap',
        'before_widget' => '<div class="footer__sitemap">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => 'Footer Call to Action',
        'id'            => 'footer_call_to_action',
        'before_widget' => '<div class="footer__cta">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => 'Footer Bottom',
        'id'            => 'footer_bottom',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ]);
}

// remove the Woocommerce sidebar

add_action('init', 'remove_woo_commerce_sidebar');

function remove_woo_commerce_sidebar()
{
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
}
