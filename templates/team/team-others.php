<?php

// setup vars

// WP_Query arguments
$args = array(
	'post_type'              => array( 'team_member' ),
	'nopaging'               => true,
	'posts_per_page'         => '-1',
	'post__not_in'           => array( $post->ID ),
	'ignore_sticky_posts'    => false,
);

// The Query
$loop = new WP_Query( $args );

if ( $loop->have_posts() ) {
	?>
	<div class="grid-x">
		<div class="cell small-12">
			<h2 class="section-header"><?php the_field( "translation_team_meettherest", "translations" ); ?></h2>
			<div class="grid-x grid-margin-x">
				<?php
				while ( $loop->have_posts() ) {
					$loop->the_post();
					get_template_part( 'templates/team/team', 'single' );
				}
				?>
			</div>
		</div>	
	</div>
	<?php
}
wp_reset_postdata();
?>