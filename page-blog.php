		<?php
		/**
		 *  The template for displaying Page Blog..
		 *
		 *  @package lawyeria-lite
		 *
		 *	Template Name: Blog
		 */
		get_header();
		$archive_period = get_field('archive_period');
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
				$upcoming_args = array (
					'post_type'				=> 'post',
					'ignore_sticky_posts'	=> true,
					'meta_key'				=> 'start_date',
					'orderby'				=> 'meta_value_num',
					'order'					=> 'ASC',
					'paged'					=> $paged,
					'meta_query'			=> array(
						array(
							'key'					=> 'end_date',
							'compare'				=> '>=',
							'value'					=> date( 'Ymd', strtotime("-{$archive_period} Months") )
						)
					)
				);

				$archived_args = array (
					'post_type'				=> 'post',
					'ignore_sticky_posts'	=> true,
					'meta_key'				=> 'start_date',
					'orderby'				=> 'meta_value_num',
					'paged'					=> $paged,
					'meta_query'			=> array(
						array(
							'key'					=> 'end_date',
							'compare'				=> '<',
							'value'					=> date( 'Ymd', strtotime("-{$archive_period} Months") )
						)
					)
				);

				// upcoming events section displays only events that have their acf field end date set as not older than today - $archive_period * 1 month

				$upcoming_events = new WP_Query( $upcoming_args );

				if ( $upcoming_events->have_posts() ) : while ( $upcoming_events->have_posts() ) : $upcoming_events->the_post();
					$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
						<div class="post-excerpt">
							<h2>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a><!--/a-->
							</h2><!--/h2-->
							<?php
							if ( $feat_image != NULL ) { ?>
								<div class="post-image">
									<img src="<?php echo $feat_image[0]; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
								</div><!--/.post-image-->
							<?php } ?>
							<?php the_excerpt(); ?>
							<a href="<?php the_permalink(); ?>" title="<?php _e( 'Read More', 'lawyeria-lite' ); ?>">
								<span><?php _e( 'Read More', 'lawyeria-lite' ); ?></span>
							</a><!--/a .read-more-->
						</div>
					</article><!--/div .post-->
				<?php endwhile; else: ?>
				<p><?php the_field('message'); ?></p>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
			<?php wp_reset_query(); ?>
		</div>

		<div id="posts-archive">
			<?php
			$archived_events = new WP_Query( $archived_args );
			if ( $archived_events->have_posts() ) : 
				?>
				<h2 class="section-header"><?php _e("Finished camps", 'lawyeria-lite'); ?></h2>
				<?php while ( $archived_events->have_posts() ) : $archived_events->the_post();
					$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
					?>
					<article <?php post_class( 'post post-archive' ); ?>>
						<div class="post-excerpt grid-x grid-margin-x align-middle">
							<?php
							if ( $feat_image != NULL ) { ?>
								<div class="cell small-12 medium-6 post-image">
									<img src="<?php echo $feat_image[0]; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
								</div><!--/.post-image-->
							<?php } ?>
							<div class="cell small-12 medium-6 post-content">
								<h3>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a><!--/a-->
								</h3><!--/h2-->
								<a href="<?php the_permalink(); ?>" title="<?php _e( 'Read More', 'lawyeria-lite' ); ?>">
									<span><?php _e( 'Read More', 'lawyeria-lite' ); ?></span>
								</a><!--/a .read-more-->
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
			<?php wp_reset_query(); ?>
		</div><!--/div #posts-->
	</div><!--/div .wrapper-->
</section><!--/section #content-->
<?php get_footer(); ?>