<?php
$software_releases = get_query_var('softwareReleases');
?>

<div class="releases">
	<?php if ($software_releases->have_posts()): ?>
		<?php $current_release  = $software_releases->get_posts()[0];?>
		<div class="releases__current">
			<h3>
				<?php echo $current_release->post_title; ?>
			</h3>

			<a href="<?php echo get_permalink($current_release->ID) ?>">
				View changelog
			</a>

			<div class="downloads">
				<?php if (have_rows('download_windows', $current_release->ID)) : while (have_rows('download_windows', $current_release->ID)) : the_row(); ?>
					<?php if (get_sub_field('download_text') && get_sub_field('download_file')): ?>
						<?php $winDownload = get_sub_field('download_file'); ?>
						<a href="<?php echo $winDownload['url'] ?>" class="downloads__download" download>
							<?php the_sub_field('download_text'); ?>
							<svg class="brand-logo" xmlns="http://www.w3.org/2000/svg"
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
							</svg>
						</a>
					<?php endif; ?>
				<?php endwhile; endif; ?>
				<?php if (have_rows('download_macos', $current_release->ID)) : while (have_rows('download_macos', $current_release->ID)) : the_row(); ?>
					<?php if (get_sub_field('download_text') && get_sub_field('download_file')): ?>
						<?php $macDownload = get_sub_field('download_file'); ?>
						<a href="<?php echo $macDownload['url'] ?>" class="downloads__download" download>
							<?php the_sub_field('download_text'); ?>
							<!-- xml version = "1.0" encoding = "iso-8859-1"-->
							<svg class="brand-logo" xmlns="http://www.w3.org/2000/svg"
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
							</svg>
						</a>
					<?php endif; ?>
				<?php endwhile; endif; ?>
				<?php if (have_rows('download_universal', $current_release->ID)) : while (have_rows('download_universal', $current_release->ID)) : the_row(); ?>
					<?php if (get_sub_field('download_text') && get_sub_field('download_file')): ?>
						<?php $universalDownload = get_sub_field('download_file'); ?>
						<a href="<?php echo $universalDownload['url'] ?>" class="downloads__download" download>
							<?php the_sub_field('download_text'); ?>
						</a>
					<?php endif; ?>
				<?php endwhile; endif; ?>
			</div>
		</div>

		<div class="releases__opener">
			<h3>
				Previous versions
			</h3>
			<div class="opener-btn">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-6 md:w-8">
					<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
				</svg>
			</div>
		</div>

		<div class="releases__previous releases__previous--closed">
			<?php foreach ($software_releases->get_posts() as $index => $release) : if ($index > 0) : ?>
				<div class="release">
                            <h4>
                                <?php echo $release->post_title; ?>
                            </h4>

                            <a href="<?php echo get_permalink($release->ID) ?>">
                                View changelog
                            </a>

                            <div class="release__downloads">
                                <?php if (have_rows('download_windows', $release->ID)) : while (have_rows('download_windows', $release->ID)) : the_row(); ?>
                                    <?php if (get_sub_field('download_text') && get_sub_field('download_file')): ?>
                                        <?php $winDownload = get_sub_field('download_file'); ?>
                                        <a href="<?php echo $winDownload['url'] ?>" class="release__download" download>
                                            <?php the_sub_field('download_text'); ?>
                                            <svg class="brand-logo" xmlns="http://www.w3.org/2000/svg"
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
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                <?php endwhile; endif; ?>

                                <?php if (have_rows('download_macos', $release->ID)) : while (have_rows('download_macos', $release->ID)) : the_row(); ?>
                                    <?php if (get_sub_field('download_text') && get_sub_field('download_file')): ?>
                                        <?php $macDownload = get_sub_field('download_file'); ?>
                                        <a href="<?php echo $macDownload['url'] ?>" class="release__download" download>
                                            <?php the_sub_field('download_text'); ?>
                                            <!-- xml version = "1.0" encoding = "iso-8859-1"-->
                                            <svg class="brand-logo" xmlns="http://www.w3.org/2000/svg"
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
                    						</svg>
                                        </a>
                                    <?php endif; ?>
                                <?php endwhile; endif; ?>

                                <?php if (have_rows('download_universal', $release->ID)) : while (have_rows('download_universal', $release->ID)) : the_row(); ?>
                                    <?php if (get_sub_field('download_text') && get_sub_field('download_file')): ?>
                                        <?php $universalDownload = get_sub_field('download_file'); ?>
                                        <a href="<?php echo $universalDownload['url'] ?>" class="release__download"
                                           download>
                                            <?php the_sub_field('download_text'); ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endwhile; endif; ?>
                            </div>
                        </div>
			<?php endif; endforeach; ?>
		</div>
	<?php endif; ?>
</div>
