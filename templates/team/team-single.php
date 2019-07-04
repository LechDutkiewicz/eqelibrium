<div class="brick__team column small-6 medium-4 large-3">
	<figure class="brick__team--thumb">
		<?php
		if ($post->post_content) {
			?>
			<button class="reveal__open" data-open="<?= sanitize_title($post->post_title); ?>">
				<?php
			}
			?>
			<?php the_post_thumbnail( 'team_thumb' ); ?>
			<?php
			if ($post->post_content) {
				?>
			</button>
			<?php
		}
		?>
	</figure>
	<h3 class="brick__team--title"><?= $post->post_title; ?></h3>
	<?php
	$post_specializations = get_the_terms( $post->ID, 'member_func' );
	if (count($post_specializations) > 0) {
		?>
		<ul class="brick__team--specialization">
			<?php
			foreach ($post_specializations as $specialization) {
				?>
				<li><?= $specialization->name; ?></li>
				<?php
			}
			?>
		</ul>
		<?php
	}

	/*----------  Reveal window with extended content  ----------*/

	if ( $post->post_content ) {
		$linkedin_url = get_field('sm_link_linkedin', $post->ID);
		?>

		<div class="reveal large reveal__team" id="<?= sanitize_title($post->post_title); ?>" data-reveal data-close-on-click="true" data-animation-in="hinge-in-from-middle-x" data-animation-out="hinge-out-from-middle-x">
			<div class="container">
			<div class="row">
				<div class="column small-12 medium-4 show-for-medium">
					<?php the_post_thumbnail( 'full' ); ?>					
				</div>
				<div class="column small-12 medium-7 medium-offset-1">
					<div class="reveal__team--part reveal__team--meta">
						<div class="reveal__team--content">
							<h3 class="reveal__team--title"><?= $post->post_title; ?></h3>
							<?php
							$post_specializations = wp_get_post_terms( $post->ID, 'member_func' );
							if (count($post_specializations) > 0) {
								?>
								<ul class="brick__team--specialization">
									<?php
									foreach ($post_specializations as $specialization) {
										?>
										<li><?= $specialization->name; ?></li>
										<?php
									}
									?>
								</ul>
								<?php
							}
							?>
						</div>
					</div>
					<div class="reveal__team--part">
						<div class="reveal__team--content">
							<?= wpautop($post->post_content); ?>
							<?php if ($linkedin_url) { ?>
								<p>
									<a class="reveal__team--link" href="<?= $linkedin_url; ?>" title="<?php _e( "Link to the LinkedIn profile", "sage" ); ?>" target="_blank"><?php _e( "LinkedIn Profile", "sage" ); ?></a>
								</p>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			</div>
			<button class="close-button" data-close aria-label="Close modal" type="button">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php
	}	
	?>
</div>