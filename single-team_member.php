		<?php
		/**
		 *  The template for displaying Single.
		 *
		 *  @package lawyeria-lite
		 */
		get_header();
		?>
		<section class="wide-nav">
			<div class="wrapper">
				<h3>
					<?php the_title(); ?>
				</h3><!--/h3-->
			</div><!--/div .wrapper-->
		</section><!--/section .wide-nav-->
	</header>
	<section id="content">
		<div class="wrapper cf">
			<div class="post">
				<?php if ( have_posts() ) { ?>
					<div class="grid-x">
						<?php
						while ( have_posts() ) {
							the_post();
							$linkedin_url = get_field('sm_link_linkedin');
							?>
							<div class="cell small-12 medium-4 show-for-medium">
								<?php the_post_thumbnail( 'full' ); ?>					
							</div>
							<div class="cell small-12 medium-7 medium-offset-1">
								<div class="reveal__team--part reveal__team--meta">
									<div class="reveal__team--content">
										<h3 class="reveal__team--title"><?php the_title(); ?></h3>
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
										<?php the_content(); ?>
										<?php if ($linkedin_url) { ?>
											<p>
												<a class="reveal__team--link" href="<?= $linkedin_url; ?>" title="<?php _e( "Link to the LinkedIn profile", "sage" ); ?>" target="_blank"><?php _e( "LinkedIn profile", "sage" ); ?></a>
											</p>
										<?php } ?>
									</div>
								</div>
							</div>
							<?php
						}
						?>
					</div><!--/div #posts-->
				<?php } ?>
				<?php get_template_part( 'templates/team/team', 'others'); ?>
			</div>
		</div><!--/div .wrapper-->
	</section><!--/section #content-->
	<?php get_footer(); ?>