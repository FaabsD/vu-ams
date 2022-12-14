<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ) ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="content">
    <header>
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
    <main>
        <p>
            Well this is awkward... The page you are looking for (<b><?php echo home_url($wp->request) ?></b>) does not exist. But no need to stress (pun intended).<br/>
            Just click the following link to return to the previous page. 
        </p>
        <button onclick="history.back()" class="back-button">
            Go back
        </button>
        <p>
            Or if you would like to notify us about an incorrect/broken link click on the e-mail address and tell us which link is broken/incorrect with a screenshot (optional)<br/>
            And we will fix it as soon as possible.
        </p>
        <a href="mailto:info@vu-ams.nl?subject=Incorrect%2Fbroken%20link&body=Hello VU-AMS team,%0D%0D i am sending you this email to report a broken/incorrect link on your website...">
            info@vu-ams.nl
        </a>
        <p>Perhaps you wanted to visit our product page in that case follow the link below: </p>
        <a href="<?php echo get_permalink(wc_get_page_id('shop')) ?>" class="button--link">
            Go to Products
        </a>
        <div class="heart-rate--404">
            <svg version="1.1" viewBox="0 0 1920 360">
                <defs/>
                <clipPath id="ArtboardFrame">
                <rect height="360" width="1920" x="0" y="0"/>
                </clipPath>
                <g clip-path="url(#ArtboardFrame)" id="a">
                <path d="M1920.01 228.999L226.048 228.999L214.699 228.999L208.034 296.807L201.369 360L193.593 359.668L185.817 359.335C185.366 349.664 184.871 339.525 184.353 329.03C183.835 318.536 183.295 307.686 182.754 296.595C182.754 296.565 182.739 296.55 182.724 296.535C182.709 296.519 182.694 296.504 182.694 296.474C182.634 295.386 182.574 294.283 182.522 293.18C182.469 292.077 182.424 290.974 182.394 289.886C182.094 283.842 181.778 277.737 181.456 271.587C181.133 265.437 180.803 259.241 180.472 253.015C178.881 223.61 177.2 193.811 175.519 165.856C173.837 137.901 172.156 111.79 170.565 89.7582L158.675 192.602L146.786 295.447L141.382 278.522L135.978 261.598C133.996 255.403 131.504 249.041 129.14 243.873C126.776 238.706 124.539 234.731 123.068 233.311L121.927 233.311L120.786 233.311C112.56 232.888 107.11 232.48 103.327 231.951C99.5444 231.422 97.4278 230.772 95.8666 229.866C91.3931 227.267 87.8804 223.413 84.9156 219.077C81.9508 214.74 79.5339 209.919 77.2521 205.386C76.0211 202.878 74.4599 199.735 72.9437 197.211C71.4276 194.688 69.9564 192.784 68.9056 192.754C66.9841 192.633 65.603 193.146 64.1169 194.748C62.6307 196.35 61.0395 199.04 58.6977 203.271C57.797 204.903 56.8362 206.655 55.7854 208.416C54.7346 210.176 53.5937 211.944 52.3327 213.606C49.3304 217.565 45.2622 221.555 40.7662 224.554C36.2702 227.554 31.3464 229.563 26.6327 229.563L14.2631 229.563L1.89346 229.563L1.89346 220.104L1.89346 210.645L14.2631 210.645L26.6327 210.645C28.4641 210.645 31.0011 209.511 33.5906 207.713C36.1801 205.915 38.8222 203.452 40.8638 200.792C41.7044 199.674 42.5151 198.42 43.3182 197.068C44.1213 195.715 44.9169 194.265 45.7276 192.754C47.9793 188.674 50.6364 183.793 54.3593 180.008C58.0822 176.222 62.8709 173.533 69.386 173.835C74.6701 174.077 78.7232 177.008 82.0859 181.133C85.4485 185.259 88.1206 190.578 90.6425 195.594C92.4139 199.161 94.2153 202.787 96.1668 205.855C98.1183 208.922 100.22 211.43 102.592 212.76C103.673 213.153 107.23 213.486 111.088 213.758C114.946 214.03 119.105 214.241 121.386 214.392L123.038 214.483L124.689 214.574C127.091 214.694 129.478 215.798 131.857 217.875C134.236 219.953 136.608 223.005 138.98 227.025L152.1 113.512L165.221 0L170.745 6.37676L176.269 12.7535C177.41 14.1437 179.241 16.2743 182.176 43.5342C185.111 70.7942 189.149 123.183 194.703 225.091L194.703 225.091L194.703 225.091L194.703 225.151L194.703 225.212L195.014 231.079L195.286 236.223L195.544 241.108L196.385 257.005L196.385 257.488L196.385 257.972L196.475 257.277L196.565 256.582L198.186 241.41L199.807 221.624C200.108 218.361 201.414 215.489 203.335 213.434C205.257 211.379 207.794 210.727 210.556 210.727L1920.01 210.724L1920.01 228.999Z" stroke="none"/>
                </g>
            </svg>
            <div class="fade-in"></div>
        </div>
    </main>
</div>
</body>
</html>