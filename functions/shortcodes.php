<?php

add_action('init', 'ams_add_shortcodes');

function ams_add_shortcodes()
{

    // add a shortcode to display software downloads
    add_shortcode('dams_downloads', 'retrieve_software_releases');

    // retrieve the vu-dams downloads for the dams_downloads shortcode
    function retrieve_software_releases($atts)
    {
        $defaultArgs = [
            'post_type' => 'software-release',
            'orderby' => 'date',
            'order' => 'DESC',
        ];

        $args = shortcode_atts($defaultArgs, $atts);

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            set_query_var('softwareReleases', $query);
            $releasesPart = template_view('software', 'releases');
            wp_reset_query();

            return $releasesPart;
        }
    }
}
