<?php

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

if ( ! function_exists('team_post_type') ) {

// Register Custom Post Type
	function team_post_type() {

		$labels = array(
			'name'                  => __( 'Team', 'sage' ),
			'singular_name'         => __( 'Team', 'sage' ),
			'menu_name'             => __( 'Team', 'sage' ),
			'name_admin_bar'        => __( 'Team', 'sage' ),
			'all_items'             => 'Wszyscy ludzie',
			'add_new_item'          => 'Dodaj nową osobę',
			'add_new'               => 'Dodaj osobę',
			'view_items'            => 'Zobacz wszystkich ludzi',
			);
		$args = array(
			'label'                 => 'osoba',
			'description'           => 'osoby w zespole',
			'labels'                => $labels,
			'supports'              => array( 'title', 'thumbnail', 'editor', 'revisions' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 8,
			'menu_icon'             => 'dashicons-businessman',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'rewrite'               => array(
				'slug'                  => __( 'team', 'sage' ),
				'with_front'            => false,
				'feed'                  => true,
				'pages'                 => true,
			),
			'capability_type'       => 'page',
			);
		register_post_type( 'team_member', $args );

	}
	add_action( 'init', 'team_post_type', 50 );

}

if ( ! function_exists( 'team_member_function' ) ) {

// Register Custom Taxonomy
	function team_member_function() {

		$labels = array(
			'name'                       => 'Funkcje',
			'singular_name'              => 'Funkcja',
			'menu_name'                  => 'Funkcje',
			'add_new_item'               => 'Stwórz nową funkcję',
			'items_list'                 => 'Zobacz wszystkie funkcje',
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => false,
			'publicly_queryable'         => false,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'show_in_rest'               => false,
			'sort'                       => true,
		);
		register_taxonomy( 'member_func', array( 'team_member' ), $args );

	}
	add_action( 'init', 'team_member_function', 0 );

}

/*----------  Posts per page  ----------*/

add_action( 'pre_get_posts', 'team_member_archive_pagesize', 1 );

function team_member_archive_pagesize( $query ) {
	if ( is_admin() || ! $query->is_main_query() )
		return;

	if ( is_post_type_archive( 'team_member' ) ) {
		// Display all posts for a custom post type called 'team_member'
		$query->set( 'posts_per_page', -1 );
		return;
	}
}

?>