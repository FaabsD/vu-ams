<?php

add_action( 'after_setup_theme', 'ams_add_filters' );

/**
 * Add filters to use with VU-AMS Theme
 *
 * @return void
 */
function ams_add_filters() {

    // prefill the tag-group posttype with all the available tags
    add_filter( 'default_content', 'ams_set_default_tag_group_content', 10, 2 );

    /**
     * Prefill the content of new posts of the tag-group post type with the most used tags in publications.
     * Tags will be separated by comma's and spaces
     *
     * @param string $content The posts default content
     * @param object $post    The post to be created
     *
     * @return empty|string
     */
    function ams_set_default_tag_group_content( $content, $post ) {
        if ( $post->post_type !== 'tag-group' ) {
            return $content;
        }
        // get all publication tags
        $unfilteredTags = publicationTags();

        if ( $unfilteredTags && is_array( $unfilteredTags ) ) {
            /**
             * filter the tags using the getMostUsedTags helper function
             * change minimumCount to any desired occurrence count per tag
             * to preserve it in the resulting array
             */
            $filteredTags = getMostUsedTags( $unfilteredTags, 5 );
        }

        if ( $filteredTags && is_array( $filteredTags ) ) {
            // turn the filtered tags array into a comma separated string
            $content = implode( ', ', $filteredTags );
        } else {
            // keep content empty
            $content = '';
        }

        return $content;
    }

    add_filter( 'woocommerce_add_to_cart_fragments', 'ams_cart_button_count' );

    /**
     * Update the shopping cart button product count (quantity) every time a product is added
     *
     * @param [type] $fragments
     *
     * @return void
     */
    function ams_cart_button_count( $fragments ) {
        ob_start();

        $cart_count = WC()->cart->cart_contents_count;
        $cart_url   = wc_get_cart_url();

        ?>
        <a class="cart-contents" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>">
            <span class="dashicons dashicons-cart"></span>
        <?php
        if ( $cart_count > 0 ) {
            ?>
            <span class="cart-contents__count"><?php echo $cart_count; ?></span>
            <?php
        }
        ?></a>
        <?php

        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }

}
