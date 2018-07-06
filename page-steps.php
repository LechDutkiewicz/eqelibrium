		<?php
		/**
		 *  The template for displaying Page Steps..
		 *
		 *  @package lawyeria-lite
		 *
		 *	Template Name: Steps
		 */
		get_header();

		$sections = get_field('section');
		?>
		<section class="wide-nav">
			<div class="wrapper">
				<h3>
					<?php the_title(); ?>
				</h3><!--/h3-->
			</div><!--/div .wrapper-->
		</section><!--/section .wide-nav-->
	</header><!--/header-->
	<section id="content">
		<div class="wrapper cf">
			<div id="posts">
				<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post();

					?>
					<div class="post">

						<div class="post-excerpt">
							<?php the_content(); ?>

							<?php

							// check if the repeater field has rows of data
							if( have_rows('section') ):

 								// loop through the rows of data
								while ( have_rows('section') ) : the_row();
									$feat_image_array = get_sub_field('img');
									$section_title = get_sub_field('title');
									?>
									<hr>
									<div class="grid-x align-justify">
										<?php
										if ( $feat_image_array != NULL ) { ?>
											<div class="cell small-12 large-5">
												<img src="<?php echo $feat_image_array['sizes']['medium_large']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
											</div><!--/.post-image-->
										<?php } ?>

										<?php

									// check if the repeater field has rows of data
										if( have_rows('accordion') ):
											$i = 0;
											?>
											<div class="cell small-12 large-6">
												<h2><?= $section_title; ?></h2>
												<ul class="accordion" data-accordion data-allow-all-closed="true">
													<?php
 										// loop through the rows of data
													while ( have_rows('accordion') ) : the_row();
														?>
														<li class="accordion-item <?= $i === 0 ? 'is-active' : ''; ?>" data-accordion-item>
															<!-- Accordion tab title -->
															<a href="#" class="accordion-title"><?php the_sub_field('title'); ?></a>
															<!-- Accordion tab content: it would start in the open state due to using the `is-active` state class. -->
															<div class="accordion-content" data-tab-content>
																<?php the_sub_field('panel'); ?>
															</div>
														</li>
														<?php
														$i++;
													endwhile;
													?>
												</ul>
											</div>
										<?php endif; ?>
									</div>
								<?php endwhile; ?>
							<?php endif; ?>
						</div><!--/div .post-excerpt-->


					</div><!--/div .post-->
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.', 'lawyeria-lite'); ?></p>
			<?php endif; ?>
		</div><!--/div #posts-->
	</div><!--/div .wrapper-->
</section><!--/section #content-->
<?php get_footer(); ?>