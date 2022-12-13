<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ) ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(array('!pt-0', '!bg-ams-grey')); ?>>
<div class="prose-sm md:prose md:max-w-none w-screen h-screen">
    <header class="text-left px-8 md:px-16 md:pt-16 md:pb-4 2xl:px-0 md:max-w-screen-md xl:max-w-screen-lg 2xl:max-w-screen-xl mx-auto md:flex md:flex-row-reverse md:justify-between md:items-center">
        <?php if(function_exists('get_theme_mod')) : ?>
            <?php 
                global $wp;
                $site_logo_id = get_theme_mod('custom_logo');
                // $site_logo_id = 3841;
                $site_logo_src = wp_get_attachment_image_url($site_logo_id, 'full');
                $site_logo = wp_get_attachment_image($site_logo_id, 'full');
                $site_logo_alt = get_post_meta($site_logo_id, '_wp_attachment_image_alt', true);
            ?>
            <img src="<?php echo $site_logo_src ?>" alt="<?php echo $site_logo_alt ?>" class="md:w-full md:!my-0 md:max-w-full md:shrink xl:basis-1/2 2xl:basis-1/3">
        <?php endif; ?>
        <h1 class="!text-ams-cyan md:shrink-0 md:grow-0 md:m-0 xl:basis-1/2">
            404 Page not found.
        </h1>
    </header>
    <main class="text-left px-8 md:px-16 2xl:px-0 md:max-w-screen-md xl:max-w-screen-lg 2xl:max-w-screen-xl mx-auto">
        <p>
            Well that is awkward... The page you are looking for (<b><?php echo home_url($wp->request) ?></b>) doesn't exist. But no need to stress (pun intended).<br/>
            Just click the following link to return to the previous page. 
        </p>
        <button onclick="history.back()" class="bg-ams-yellow text-ams-dark hover:bg-ams-dark hover:text-ams-grey px-4 py-2 font-semibold">
            Go back
        </button>
        <p>
            Or if you would like to notify us about an incorrect/broken link click on the e-mail address and tell us which link is broken/incorrect with a screenshot (optional)<br/>
            And we will fix it as soon as possible.
        </p>
        <a href="mailto:info@vu-ams.nl?subject=Incorrect%2Fbroken%20link&body=Hello VU-AMS team,%0D%0D i am sending you this email to report a broken/incorrect link on your website..." class="hover:text-ams-cyan">
            info@vu-ams.nl
        </a>
        <p>Perhaps you wanted to visit our product page in that case follow the link below: </p>
        <a href="<?php echo get_permalink(wc_get_page_id('shop')) ?>" class="bg-ams-yellow text-ams-dark hover:bg-ams-dark hover:text-ams-grey px-4 py-2 !font-semibold !no-underline">
            Go to Products
        </a>
    </main>
</div>
</body>
</html>