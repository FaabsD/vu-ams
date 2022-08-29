<?php
// Template Name: Teampage
?>

<?php get_header(); ?>
<header class="header">
    <h1>
        <?php the_title(); ?>
    </h1>
</header>

<div class="team">
	<?php $roles = get_categories(array(
		'taxonomy' => 'roles',
		'type' =>'team-member',
		'hide_empty' => false,
		'parent' => 0,
		'order_by' => 'date',
		'order' => 'DESC',

	));
	?>

	<?php foreach($roles as $role) : ?>
		<div class="role">
			<section class="role__info">
				<h2>
					<?php echo $role->name ?>
				</h2>
			</section>
			<?php
			$args = array(
				'post_type' => 'team-member',
				'tax_query' => array(
					array(
					'taxonomy' => 'roles',
					'field' => 'name',
					'terms' => array($role->name),
					)
				),
				'posts_per_page' => -1,
				
			);
			$query = new WP_Query( $args );
			?>

			<?php if ( $query->have_posts() ) : ?>
				<section class="role__members">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<div class="member">
						<div class="member__img-section">
							<?php the_post_thumbnail(); ?>
						</div>

						<div class="member__text-section">
							<h2 class="member__name">
								<?php the_title(); ?>
							</h2>
							<div class="member__text">
								<div class="sub-roles">
										<?php $subRoles = get_categories(array(
											'taxonomy'=> 'roles', 
											'child_of' => $role->term_id,
											'object_ids' => $post->ID
										));
										$subRolesCount = count($subRoles);
										?>
										<?php if( $subRolesCount >= 1 ): ?>
											<h2>
												<?php foreach($subRoles as $index => $subRole) : ?>
													<?php if ($subRolesCount === $index + 1) {
														echo $subRole->name . ".";
													} else {
														echo $subRole->name . ", ";
													}
													?>
												<?php endforeach; ?>
											</h2>
									<?php endif; ?>
								</div>
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				<?php endwhile;?>
				</section>  
			<?php endif; ?>
			<?php wp_reset_query(); ?>
		</div>
	<?php endforeach; ?>
</div>

<?php get_footer(); ?>
