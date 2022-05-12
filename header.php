<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ) ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Site Navigation -->
<?php if ( function_exists( 'wp_nav_menu' ) ) : ?>
    <?php
    $navbarArgs = array(
        'menu'                 => 'navbar',
        'menu_class'           => 'navbar__navigation',
        'menu_id'              => 'navbarNavigation',
        'container'            => 'nav',
        'container_class'      => 'navbar',
        'container_id'         => 'siteNavbar',
        'container_aria_label' => '',
        'echo'                 => true,

    );
    wp_nav_menu( $navbarArgs );
    ?>

<?php endif; ?>
