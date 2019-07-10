		<?php
		/**
		 *	The template for displaying Archive.
		 *
		 *	@package lawyeria-lite
		 */
		get_header();
		?>
		<section class="wide-nav">
			<div class="wrapper">
				<h3>
					<?php
					$obj = get_post_type_object( get_post_type() );
					echo $obj->labels->singular_name;
					?>
				</h3><!--/h3-->
			</div><!--/div .wrapper-->
		</section><!--/section .wide-nav-->
	</header>
	<section id="content">
		<div class="wrapper cf">
			<div class="grid-x grid-margin-x">
				<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					get_template_part( 'templates/team/team', 'single' );
				endwhile; else:
				?>
				<p><?php _e('Sorry, no posts matched your criteria.', 'lawyeria-lite'); ?></p>
			<?php endif; ?>
		</div>
	</div><!--/div .wrapper-->
</section><!--/section #content-->
<?php get_footer(); ?>