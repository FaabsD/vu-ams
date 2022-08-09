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
			'posts_per_page' => -1,
		];

		$args = shortcode_atts($defaultArgs, $atts);

		$query = new WP_Query($args);

		$html = '<div class="releases">';
		if ($query->have_posts()) {
			$current_release = $query->get_posts()[0];

			$html .= '<div class="releases__current">';

			$html .= '<h3>' . $current_release->post_title . '</h3>';
			$html .= '<a href="' . get_permalink($current_release->ID) . '">';
			$html .= 'View changelog</a>';

			// downloads section current release
			$html .= '<div class="downloads">';

			// edit the windows part of the downloads
			if (have_rows('download_windows', $current_release->ID)) : while (have_rows('download_windows', $current_release->ID)) : the_row();
				if (get_sub_field('download_text') && get_sub_field('download_file')):
					$winDownload = get_sub_field('download_file');
					$html .= '<a href="' . $winDownload['url'] . '" class="downloads__download" download>';
					$html .= get_sub_field('download_text');
					// add the svg
					$html .= '<svg class="brand-logo" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										viewBox="0 0 497.886 497.886"
										xml:space="preserve">
									<g>
										<g>
											<g>
												<polygon
														points="227.959,39.869 227.959,242.386 496.549,242.386 496.549,0 			"/>
												<polygon
														points="1.336,244.746 211.172,244.746 211.172,41.818 1.336,72.798 			"/>
												<polygon
														points="227.959,458.017 496.549,497.886 496.549,261.535 227.959,261.535 			"/>
												<polygon
														points="1.336,425.086 211.172,456.066 211.172,261.531 1.336,261.531 			"/>
											</g>
										</g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
								</svg>';
					$html .= '</a>';
				endif;
			endwhile;
			endif;

			// edit the macos part of the downloads
			if (have_rows('download_macos', $current_release->ID)) : while (have_rows('download_macos', $current_release->ID)): the_row();

				if (get_sub_field('download_text') && get_sub_field('download_file')):
					$macDownload = get_sub_field('download_file');
					$html .= '<a href="' . $macDownload['url'] . '" class="downloads__download" download>';
					$html .= get_sub_field('download_text');
					// add the svg
					$html .= '<svg class="brand-logo" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										viewBox="0 0 305 305" style="enable-background:new 0 0 305 305;"
										xml:space="preserve">
									<g id="XMLID_228_">
										<path id="XMLID_229_" d="M40.738,112.119c-25.785,44.745-9.393,112.648,19.121,153.82C74.092,286.523,88.502,305,108.239,305
											c0.372,0,0.745-0.007,1.127-0.022c9.273-0.37,15.974-3.225,22.453-5.984c7.274-3.1,14.797-6.305,26.597-6.305
											c11.226,0,18.39,3.101,25.318,6.099c6.828,2.954,13.861,6.01,24.253,5.815c22.232-0.414,35.882-20.352,47.925-37.941
											c12.567-18.365,18.871-36.196,20.998-43.01l0.086-0.271c0.405-1.211-0.167-2.533-1.328-3.066c-0.032-0.015-0.15-0.064-0.183-0.078
											c-3.915-1.601-38.257-16.836-38.618-58.36c-0.335-33.736,25.763-51.601,30.997-54.839l0.244-0.152
											c0.567-0.365,0.962-0.944,1.096-1.606c0.134-0.661-0.006-1.349-0.386-1.905c-18.014-26.362-45.624-30.335-56.74-30.813
											c-1.613-0.161-3.278-0.242-4.95-0.242c-13.056,0-25.563,4.931-35.611,8.893c-6.936,2.735-12.927,5.097-17.059,5.097
											c-4.643,0-10.668-2.391-17.645-5.159c-9.33-3.703-19.905-7.899-31.1-7.899c-0.267,0-0.53,0.003-0.789,0.008
											C78.894,73.643,54.298,88.535,40.738,112.119z"/>
										<path id="XMLID_230_" d="M212.101,0.002c-15.763,0.642-34.672,10.345-45.974,23.583c-9.605,11.127-18.988,29.679-16.516,48.379
											c0.155,1.17,1.107,2.073,2.284,2.164c1.064,0.083,2.15,0.125,3.232,0.126c15.413,0,32.04-8.527,43.395-22.257
											c11.951-14.498,17.994-33.104,16.166-49.77C214.544,0.921,213.395-0.049,212.101,0.002z"/>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
								</svg>';
					$html .= '</a>';
				endif;
			endwhile;
			endif;

			// edit the universal part of the downloads
			if (have_rows('download_universal', $current_release->ID)) : while (have_rows('download_universal', $current_release->ID)): the_row();

				if (get_sub_field('download_text') && get_sub_field('download_file')):
					$universalDownload = get_sub_field('download_file');
					$html .= '<a href="' . $universalDownload['url'] . '" class="downloads__download" download>';
					$html .= get_sub_field('download_text');
					// add the svg
					$html .= '</a>';
				endif;
			endwhile;
			endif;
			// close downloads section
			$html .= '</div>';

			// close current release
			$html .= '</div>';

			// start releases opener
			$html .= '<div class="releases__opener">';
			$html .= '<h3>Previous versions</h3>';
			$html .= '<div class="opener-btn">';

			$html .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-6 md:w-8">';
			$html .= '<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>';
			$html .= '</svg>';

			$html .= '</div>';

			// close releases opener
			$html .= '</div>';

			// start previous releases
			$html .= '<div class="releases__previous releases__previous--closed">';

			foreach ($query->get_posts() as $index => $release) : if ($index > 0) :
					$html .= '<div class="release">';
					$html .= '<h4>' . $release->post_title . '</h4>';
					$html .= '<a href="' . get_permalink($release->ID) . '">';
					$html .= 'View changelog';
					$html .= '</a>';


					// downloads section current release
					$html .= '<div class="release__downloads">';

					// edit the windows part of the downloads
					if (have_rows('download_windows', $release->ID)) : while (have_rows('download_windows', $release->ID)) : the_row();
						if (get_sub_field('download_text') && get_sub_field('download_file')):
							$winDownload = get_sub_field('download_file');
							$html .= '<a href="' . $winDownload['url'] . '" class="release__download" download>';
							$html .= get_sub_field('download_text');
							// add the svg
							$html .= '<svg class="brand-logo" xmlns="http://www.w3.org/2000/svg"
											xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											viewBox="0 0 497.886 497.886"
											xml:space="preserve">
										<g>
											<g>
												<g>
													<polygon
															points="227.959,39.869 227.959,242.386 496.549,242.386 496.549,0 			"/>
													<polygon
															points="1.336,244.746 211.172,244.746 211.172,41.818 1.336,72.798 			"/>
													<polygon
															points="227.959,458.017 496.549,497.886 496.549,261.535 227.959,261.535 			"/>
													<polygon
															points="1.336,425.086 211.172,456.066 211.172,261.531 1.336,261.531 			"/>
												</g>
											</g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
									</svg>';
							$html .= '</a>';
						endif;
					endwhile;
					endif;

					// edit the macos part of the downloads
					if (have_rows('download_macos', $release->ID)) : while (have_rows('download_macos', $release->ID)): the_row();

						if (get_sub_field('download_text') && get_sub_field('download_file')):
							$macDownload = get_sub_field('download_file');
							$html .= '<a href="' . $macDownload['url'] . '" class="release__download" download>';
							$html .= get_sub_field('download_text');
							// add the svg
							$html .= '<svg class="brand-logo" xmlns="http://www.w3.org/2000/svg"
											xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											viewBox="0 0 305 305" style="enable-background:new 0 0 305 305;"
											xml:space="preserve">
										<g id="XMLID_228_">
											<path id="XMLID_229_" d="M40.738,112.119c-25.785,44.745-9.393,112.648,19.121,153.82C74.092,286.523,88.502,305,108.239,305
												c0.372,0,0.745-0.007,1.127-0.022c9.273-0.37,15.974-3.225,22.453-5.984c7.274-3.1,14.797-6.305,26.597-6.305
												c11.226,0,18.39,3.101,25.318,6.099c6.828,2.954,13.861,6.01,24.253,5.815c22.232-0.414,35.882-20.352,47.925-37.941
												c12.567-18.365,18.871-36.196,20.998-43.01l0.086-0.271c0.405-1.211-0.167-2.533-1.328-3.066c-0.032-0.015-0.15-0.064-0.183-0.078
												c-3.915-1.601-38.257-16.836-38.618-58.36c-0.335-33.736,25.763-51.601,30.997-54.839l0.244-0.152
												c0.567-0.365,0.962-0.944,1.096-1.606c0.134-0.661-0.006-1.349-0.386-1.905c-18.014-26.362-45.624-30.335-56.74-30.813
												c-1.613-0.161-3.278-0.242-4.95-0.242c-13.056,0-25.563,4.931-35.611,8.893c-6.936,2.735-12.927,5.097-17.059,5.097
												c-4.643,0-10.668-2.391-17.645-5.159c-9.33-3.703-19.905-7.899-31.1-7.899c-0.267,0-0.53,0.003-0.789,0.008
												C78.894,73.643,54.298,88.535,40.738,112.119z"/>
											<path id="XMLID_230_" d="M212.101,0.002c-15.763,0.642-34.672,10.345-45.974,23.583c-9.605,11.127-18.988,29.679-16.516,48.379
												c0.155,1.17,1.107,2.073,2.284,2.164c1.064,0.083,2.15,0.125,3.232,0.126c15.413,0,32.04-8.527,43.395-22.257
												c11.951-14.498,17.994-33.104,16.166-49.77C214.544,0.921,213.395-0.049,212.101,0.002z"/>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
									</svg>';
							$html .= '</a>';
						endif;
					endwhile;
					endif;

					// edit the universal part of the downloads
					if (have_rows('download_universal', $release->ID)) : while (have_rows('download_universal', $release->ID)): the_row();

						if (get_sub_field('download_text') && get_sub_field('download_file')):
							$universalDownload = get_sub_field('download_file');
							$html .= '<a href="' . $universalDownload['url'] . '" class="release__download" download>';
							$html .= get_sub_field('download_text');
							// add the svg
							$html .= '</a>';
						endif;
					endwhile;
					endif;
					// close downloads section
					$html .= '</div>';


					$html .= '</div>';
			endif;
			endforeach;

			// close previous retrieve_software_releases
			$html .= '</div>';
		}
		// close releases div
		$html .= '</div>';
		return $html;
	}

	// add a shortcode to display the downloads to the most recent dams version

	add_shortcode('dams_recent', 'retrieve_recent_software_release');

	function retrieve_recent_software_release()
	{
		$args = [
			'post_type' => 'software-release',
			'posts_per_page' => 1,
			'orderby' => 'date',
			'order' => 'DESC',
		];

		$query = new WP_Query($args);

		$html = '<div class="recent_software-release">';

		if ($query->have_posts()) {
			$release = $query->get_posts()[0];

			$html .= '<div class="recent_software-release__inner">';
			$html .= '<h3>' . $release->post_title . '</h3>';
			// Add View changelog button
			$html .= '<a href="' . get_permalink($release->ID) . '">';
			$html .= 'View changelog</a>';

			// download section of release
			$html .= '<div class="downloads">';

			// windows downloads
			if (have_rows('download_windows', $release->ID)) : while (have_rows('download_windows', $release->ID)) : the_row();
				if (get_sub_field('download_text') && get_sub_field('download_file')):
					$winDownload = get_sub_field('download_file');
					$html .= '<a href="' . $winDownload['url'] . '" class="downloads__download" download>';
					$html .= get_sub_field('download_text');
					// add the svg
					$html .= '<svg class="brand-logo" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										viewBox="0 0 497.886 497.886"
										xml:space="preserve">
									<g>
										<g>
											<g>
												<polygon
														points="227.959,39.869 227.959,242.386 496.549,242.386 496.549,0 			"/>
												<polygon
														points="1.336,244.746 211.172,244.746 211.172,41.818 1.336,72.798 			"/>
												<polygon
														points="227.959,458.017 496.549,497.886 496.549,261.535 227.959,261.535 			"/>
												<polygon
														points="1.336,425.086 211.172,456.066 211.172,261.531 1.336,261.531 			"/>
											</g>
										</g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
									<g>
									</g>
								</svg>';
					$html .= '</a>';
				endif;
			endwhile;
			endif;

			// edit the macos part of the downloads
			if (have_rows('download_macos', $release->ID)) : while (have_rows('download_macos', $release->ID)): the_row();

				if (get_sub_field('download_text') && get_sub_field('download_file')):
					$macDownload = get_sub_field('download_file');
					$html .= '<a href="' . $macDownload['url'] . '" class="downloads__download" download>';
					$html .= get_sub_field('download_text');
					// add the svg
					$html .= '<svg class="brand-logo" xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								viewBox="0 0 305 305" style="enable-background:new 0 0 305 305;"
								xml:space="preserve">
							<g id="XMLID_228_">
								<path id="XMLID_229_" d="M40.738,112.119c-25.785,44.745-9.393,112.648,19.121,153.82C74.092,286.523,88.502,305,108.239,305
									c0.372,0,0.745-0.007,1.127-0.022c9.273-0.37,15.974-3.225,22.453-5.984c7.274-3.1,14.797-6.305,26.597-6.305
									c11.226,0,18.39,3.101,25.318,6.099c6.828,2.954,13.861,6.01,24.253,5.815c22.232-0.414,35.882-20.352,47.925-37.941
									c12.567-18.365,18.871-36.196,20.998-43.01l0.086-0.271c0.405-1.211-0.167-2.533-1.328-3.066c-0.032-0.015-0.15-0.064-0.183-0.078
									c-3.915-1.601-38.257-16.836-38.618-58.36c-0.335-33.736,25.763-51.601,30.997-54.839l0.244-0.152
									c0.567-0.365,0.962-0.944,1.096-1.606c0.134-0.661-0.006-1.349-0.386-1.905c-18.014-26.362-45.624-30.335-56.74-30.813
									c-1.613-0.161-3.278-0.242-4.95-0.242c-13.056,0-25.563,4.931-35.611,8.893c-6.936,2.735-12.927,5.097-17.059,5.097
									c-4.643,0-10.668-2.391-17.645-5.159c-9.33-3.703-19.905-7.899-31.1-7.899c-0.267,0-0.53,0.003-0.789,0.008
									C78.894,73.643,54.298,88.535,40.738,112.119z"/>
								<path id="XMLID_230_" d="M212.101,0.002c-15.763,0.642-34.672,10.345-45.974,23.583c-9.605,11.127-18.988,29.679-16.516,48.379
									c0.155,1.17,1.107,2.073,2.284,2.164c1.064,0.083,2.15,0.125,3.232,0.126c15.413,0,32.04-8.527,43.395-22.257
									c11.951-14.498,17.994-33.104,16.166-49.77C214.544,0.921,213.395-0.049,212.101,0.002z"/>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
							<g>
							</g>
						</svg>';
					$html .= '</a>';
				endif;
			endwhile;
			endif;

			// edit the universal part of the downloads
			if (have_rows('download_universal', $release->ID)) : while (have_rows('download_universal', $release->ID)): the_row();

				if (get_sub_field('download_text') && get_sub_field('download_file')):
					$universalDownload = get_sub_field('download_file');
					$html .= '<a href="' . $universalDownload['url'] . '" class="downloads__download" download>';
					$html .= get_sub_field('download_text');
					// add the svg
					$html .= '</a>';
				endif;
			endwhile;
			endif;
			// close downloads section
			$html .= '</div>';

			// close release__inner div
			$html .= '</div>';
			
		}

		// close the parent div
		$html .= '</div>';

		return $html;
	}

	// add shortcode to retrieve and display old software releases/sodium_version_string(  )

	add_shortcode('dams_old_versions', 'retrieve_old_software_versions');

	function retrieve_old_software_versions($atts)
	{
		$atts = shortcode_atts(
			array (
				'post_type' => 'software-release',
				'posts_per_page' => -1,
				'orderby' => 'date',
				'order' => 'DESC',
			),
			$atts,
			'dams_old_versions'
		);

		$query = new WP_Query($atts);

		if ($query->have_posts()) {
			// open a new div
			$html = '<div class="old_software_releases>';

			//open the inner container
			$html .= '<div class="old_software_releases__inner">';

			foreach($query->get_posts() as $index => $release) : if($index > 0):
				$html .= '<div class="release">';
					$html .= '<h4>' . $release->post_title . '</h4>';
					$html .= '<a href="' . get_permalink($release->ID) . '">';
					$html .= 'View changelog';
					$html .= '</a>';


					// downloads section current release
					$html .= '<div class="release__downloads">';

					// edit the windows part of the downloads
					if (have_rows('download_windows', $release->ID)) : while (have_rows('download_windows', $release->ID)) : the_row();
						if (get_sub_field('download_text') && get_sub_field('download_file')):
							$winDownload = get_sub_field('download_file');
							$html .= '<a href="' . $winDownload['url'] . '" class="release__download" download>';
							$html .= get_sub_field('download_text');
							// add the svg
							$html .= '<svg class="brand-logo" xmlns="http://www.w3.org/2000/svg"
											xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											viewBox="0 0 497.886 497.886"
											xml:space="preserve">
										<g>
											<g>
												<g>
													<polygon
															points="227.959,39.869 227.959,242.386 496.549,242.386 496.549,0 			"/>
													<polygon
															points="1.336,244.746 211.172,244.746 211.172,41.818 1.336,72.798 			"/>
													<polygon
															points="227.959,458.017 496.549,497.886 496.549,261.535 227.959,261.535 			"/>
													<polygon
															points="1.336,425.086 211.172,456.066 211.172,261.531 1.336,261.531 			"/>
												</g>
											</g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
									</svg>';
							$html .= '</a>';
						endif;
					endwhile;
					endif;

					// edit the macos part of the downloads
					if (have_rows('download_macos', $release->ID)) : while (have_rows('download_macos', $release->ID)): the_row();

						if (get_sub_field('download_text') && get_sub_field('download_file')):
							$macDownload = get_sub_field('download_file');
							$html .= '<a href="' . $macDownload['url'] . '" class="release__download" download>';
							$html .= get_sub_field('download_text');
							// add the svg
							$html .= '<svg class="brand-logo" xmlns="http://www.w3.org/2000/svg"
											xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											viewBox="0 0 305 305" style="enable-background:new 0 0 305 305;"
											xml:space="preserve">
										<g id="XMLID_228_">
											<path id="XMLID_229_" d="M40.738,112.119c-25.785,44.745-9.393,112.648,19.121,153.82C74.092,286.523,88.502,305,108.239,305
												c0.372,0,0.745-0.007,1.127-0.022c9.273-0.37,15.974-3.225,22.453-5.984c7.274-3.1,14.797-6.305,26.597-6.305
												c11.226,0,18.39,3.101,25.318,6.099c6.828,2.954,13.861,6.01,24.253,5.815c22.232-0.414,35.882-20.352,47.925-37.941
												c12.567-18.365,18.871-36.196,20.998-43.01l0.086-0.271c0.405-1.211-0.167-2.533-1.328-3.066c-0.032-0.015-0.15-0.064-0.183-0.078
												c-3.915-1.601-38.257-16.836-38.618-58.36c-0.335-33.736,25.763-51.601,30.997-54.839l0.244-0.152
												c0.567-0.365,0.962-0.944,1.096-1.606c0.134-0.661-0.006-1.349-0.386-1.905c-18.014-26.362-45.624-30.335-56.74-30.813
												c-1.613-0.161-3.278-0.242-4.95-0.242c-13.056,0-25.563,4.931-35.611,8.893c-6.936,2.735-12.927,5.097-17.059,5.097
												c-4.643,0-10.668-2.391-17.645-5.159c-9.33-3.703-19.905-7.899-31.1-7.899c-0.267,0-0.53,0.003-0.789,0.008
												C78.894,73.643,54.298,88.535,40.738,112.119z"/>
											<path id="XMLID_230_" d="M212.101,0.002c-15.763,0.642-34.672,10.345-45.974,23.583c-9.605,11.127-18.988,29.679-16.516,48.379
												c0.155,1.17,1.107,2.073,2.284,2.164c1.064,0.083,2.15,0.125,3.232,0.126c15.413,0,32.04-8.527,43.395-22.257
												c11.951-14.498,17.994-33.104,16.166-49.77C214.544,0.921,213.395-0.049,212.101,0.002z"/>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
										<g>
										</g>
									</svg>';
							$html .= '</a>';
						endif;
					endwhile;
					endif;

					// edit the universal part of the downloads
					if (have_rows('download_universal', $release->ID)) : while (have_rows('download_universal', $release->ID)): the_row();

						if (get_sub_field('download_text') && get_sub_field('download_file')):
							$universalDownload = get_sub_field('download_file');
							$html .= '<a href="' . $universalDownload['url'] . '" class="release__download" download>';
							$html .= get_sub_field('download_text');
							// add the svg
							$html .= '</a>';
						endif;
					endwhile;
					endif;
					// close downloads section
					$html .= '</div>';


					$html .= '</div>';
			endif; endforeach;

			//close the inner container
			$html .= '</div>';

			// close the old_software_releases container
			$html .= '</div>';
		}

		return $html;
	}

	// add shortcode to display FAQ's at any position on the FAQ page

	add_shortcode('ams_display_faq', 'get_all_faq');

	/**
	 * Retrieve all FAQ items
	 * and return them in a html markup for the ams_display_faq shortcode
	 *
	 * @param array $atts
	 * @return html|string returns the FAQ items in a HTML markup or a string if none are found
	 */
	function get_all_faq($atts) {
		$atts = shortcode_atts(array(
			'post_type' => 'faq',
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => -1,
		), $atts, 'ams_display_faq');

		$query = new WP_Query($atts);

		if ($query->have_posts()) {
			$html = '<div class="questions">';

			foreach( array_chunk($query->get_posts(), 3) as $values) {
				if (defined('WP_DEBUG')) {
					if (count($values) > 1) {
						error_log('======== FAQ GROUPED PER 3 ========');
						error_log(print_r($values, true));
					}
					else {
						error_log("======== FAQ ON IT'S OWN ========");
						error_log(print_r($values[0], true));
					}
				}

				if (count($values) > 1) {
					$html .= '<div class="questions__col">';
					foreach ($values as $faq) {
						$html .= '<div class="question">';

						$html .= '<h3 class="question__title">' . $faq->post_title . '</h3>';

						$html .= '<div class="question__answer">';
						$html .= $faq->post_content;
						$html .= '</div>';


						$html .= '</div>';
					}
					$html .= '</div>';
				} else {
					$html .= '<div class="questions__col">';

						$html .= '<div class="question">';

						$html .= '<h3 class="question__title">' . $values[0]->post_title . '</h3>';

						$html .= '<div class="question__answer">';
						$html .= $values[0]->post_content;
						$html .= '</div>';

					$html .= '</div>';
				}
			}
			$html .= '</div>';

		} else {
			return "No FAQ found";
		}

		return $html;
	}
}
