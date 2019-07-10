<?php

use Roots\Sage\Assets;

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly


/*============================================
=            Add ACF custom field            =
============================================*/

/*=====  End of Add ACF custom field  ======*/





/*============================================
=            Add ACF options page            =
============================================*/

if ( !function_exists('setup_acf_tab_archives') ) {

	function setup_acf_tab_archives() {

		if( function_exists('acf_add_options_page') ) {

			acf_add_options_page(array(
				'page_title' 	=> 'Theme options',
				'menu_title' 	=> 'Theme options',
				'menu_slug'		=> 'theme-options',
				'position'		=> 52,
				'icon_url'		=> Assets\asset_path('images/brand-icon.png'),
				'redirect' 		=> true,
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> 'Terms to translate',
				'menu_title' 	=> 'Terms to translate',
				'menu_slug'		=> 'theme-translations',
				'parent_slug'	=> 'theme-options',
				'post_id'		=> 'translations',
			));
		}
	}

	setup_acf_tab_archives();

}

/*=====  End of Add ACF options page  ======*/

/*==================================================================
=            Custom fields for translations option page            =
==================================================================*/

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5d259eac30d6b',
	'title' => 'Team',
	'fields' => array(
		array(
			'key' => 'field_5d259ecaa5848',
			'label' => 'Meet the rest of the team',
			'name' => 'translation_team_meettherest',
			'type' => 'text',
			'instructions' => 'Type in the header above section that displays the rest of the team on single tutor page.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'Meet the rest of the team',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-translations',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;

/*=====  End of Custom fields for translations option page  ======*/




?>