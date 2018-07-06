<?php

use Roots\Sage\Assets;
use Roots\Sage\Helper;

if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

/*=======================================================
=            Register and add tinymce button            =
=======================================================*/

// init process for registering our button
add_action('admin_init', 'encrypt_email_tinymce_button');
function encrypt_email_tinymce_button() {

	//Abort early if the user will never see TinyMCE
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
		return;

	//Add a callback to regiser our tinymce plugin   
	add_filter("mce_external_plugins", "encrypt_email_register_tinymce_button"); 

	// Add a callback to add our button to the TinyMCE toolbar
	add_filter('mce_buttons', 'encrypt_email_add_tinymce_button');
}


//This callback registers our plug-in
function encrypt_email_register_tinymce_button($plugin_array) {
	$plugin_array['encrypt_email_button'] = Assets\asset_path('scripts/shortcodes.js');
	return $plugin_array;
}

//This callback adds our button to the toolbar
function encrypt_email_add_tinymce_button($buttons) {
	//Add the button ID to the $button array
	array_push( $buttons, 'encrypt_email_button');
	return $buttons;
}

/*=====  End of Register and add tinymce button  ======*/



/*==========================================
=            Register shortcode            =
==========================================*/

add_action( "init", "register_encrypt_email_shortcode" );
function register_encrypt_email_shortcode() {
	add_shortcode( "zaszyfrowany_mail", "encrypt_email_shortcode" );
}

function encrypt_email_shortcode($atts = null, $email) {

	if ($email) {

		$encrypted_email = new Rotate13_Email($email);

		ob_start();

		$encrypted_email->encrypt_email();

		$return_string = ob_get_contents();
		ob_end_clean();
	}

	return $return_string;
}

/*=====  End of Register shortcode  ======*/
?>