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
?>