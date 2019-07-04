<?php
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// define theme paths for template and extensions
define('THEME_PATH',get_stylesheet_directory().'/');
define('THEME_URL',get_stylesheet_directory_uri().'/');
define('EXTENSIONS_PATH',THEME_PATH.'lib/extensions/');
define('POST_TYPES_PATH',THEME_PATH.'lib/post_types/');
define('CUSTOM_FIELDS_PATH',THEME_PATH.'lib/custom_fields/');

$sage_includes = [
	'lib/assets.php',    // Scripts and stylesheets
	'lib/setup.php',     // Theme setup
];

foreach ($sage_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}
unset($file, $filepath);

if (is_readable(EXTENSIONS_PATH)) {
	$sage_extensions = scandir(EXTENSIONS_PATH);

	foreach ($sage_extensions as $extension) {
			// echo $extension;
		$file = EXTENSIONS_PATH.$extension;

		if(is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === "php") {
			require_once($file);
		} else if (is_dir($file) && $extension !== ".." && $extension !== ".") {

				// scan through dir with extension
			$dir_extension = scandir($file);

			foreach ($dir_extension as $dir_file) {
				if ($dir_file !== ".." && $dir_file !== ".") {
					$dir_file_path = EXTENSIONS_PATH.$extension . "/" . $dir_file;
					$dir_file_type = pathinfo($dir_file_path, PATHINFO_EXTENSION);

						// include only php files
					if ($dir_file_type === "php") {
						require_once($dir_file_path);
					}
				}
			}
		}
	}
}

if (is_readable(POST_TYPES_PATH)) {
	$sage_post_types = scandir(POST_TYPES_PATH);

	foreach ($sage_post_types as $post_type) {
		$file = POST_TYPES_PATH.$post_type;
		if(is_file($file)) {
			require_once($file);
		}
	}
}

if (is_readable(CUSTOM_FIELDS_PATH)) {
	$sage_custom_fields = scandir(CUSTOM_FIELDS_PATH);

	foreach ($sage_custom_fields as $custom_field) {
		$file = CUSTOM_FIELDS_PATH.$custom_field;
		if(is_file($file)) {
			require_once($file);
		}
	}
}
?>