<?php
/**
 * Create a full text from all publications
 *
 * @package VU-AMS
 * @return  void
 */

add_action('ams_put_publication_texts_in_file', 'create_full_publications_text');

function create_full_publications_text()
{
	$full_text = (string) "";

	// get all publication
	$args = [
		'post_type' => 'publication',
		'posts_per_page' => -1,
		'orderby' => 'post_title',
		'order' => 'desc',
	];

	$query = new WP_Query($args);

	if ($query->have_posts()) {
		foreach ($query->get_posts() as $publication) {
			if (defined('WP_DEBUG')) {
				error_log($publication->post_title);
			}

			$full_text .= $publication->post_title;
			$full_text .= "\r\n";
			$full_text .= $publication->post_content;
			$full_text .= "\r\n";
			$full_text .= "\r\n";
		}

		if(defined('WP_DEBUG')) {
			error_log('===== START FULL TEXT OUTPUT =====');
			error_log($full_text . PHP_EOL);
			error_log('===== END FULL TEXT OUTPUT =====');
		}

		do_action('AMS_strip_wp_comments', $full_text);
	}
}

add_action('AMS_strip_wp_comments', 'strip_comments_from_full_pub_texts', 10, 1);

/**
 * strip all html comments and tags from the full publications text
 *
 * @param string $text
 * @return void
 */
function strip_comments_from_full_pub_texts($text) {

	// $stripped_text = str_replace(array('<!-- wp:paragraph -->', '<!-- /wp:paragraph -->'), "\r", $text);
	// preg_replace('/<!-- wp:heading \\{"level":3\\} --><!-- /wp:heading -->/i', )
	$stripped_text = strip_tags($text);

	if (defined('WP_DEBUG')) {
		error_log("======== STRIPPED FULL PUBLICATION TEXTS ========");
		error_log($stripped_text . PHP_EOL);
		error_log("======== END STRIPPED FULL PUBLICATION TEXTS ========");
	}

	do_action('AMS_save_publication_texts_to_file', $stripped_text);
}

add_action('AMS_save_publication_texts_to_file', 'ams_save_pub_texts_to_file', 10, 1);

/**
 * Save the publications text to a file
 *
 * @param string $full_text
 * @return void
 */
function ams_save_pub_texts_to_file($full_text) {
	
	$filename = "publications_index.txt";
	
	$path = get_template_directory();

	if (defined('WP_DEBUG')) {
		error_log('====== SAVE THE PUBLICATION TEXTS TO A FILE ======');
		error_log('FILE NAME => '. $filename);
		error_log('PATH TO FILE => ' . $path);
	}
	
	$file = fopen($path. "/" . $filename, 'w');

	$writeFile = fwrite($file, $full_text);

	if ($writeFile === false) {
		if(defined('WP_DEBUG')) {
			error_log("Couldn't write content to file (" . $filename . ")");
		}
		exit;
	} else {
		if(defined('WP_DEBUG')) {
			error_log('Successfully wrote the text to file (' . $filename . ')');
		}
	}

	fclose($file);
}
