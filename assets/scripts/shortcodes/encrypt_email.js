jQuery(document).ready(function($) {

	tinymce.create('tinymce.plugins.encrypt_email_plugin', {
		init : function(ed, url) {
				// Register command for when button is clicked
				ed.addCommand('encrypt_email_insert_shortcode', function() {
					var selected = tinyMCE.activeEditor.selection.getContent(),

					content = "[zaszyfrowany_mail]" + selected + "[/zaszyfrowany_mail]";

					tinymce.execCommand('mceInsertContent', false, content);
				});

			// Register buttons - trigger above command when clicked
			ed.addButton('encrypt_email_button', {title : 'Zaszyfruj adres email', cmd : 'encrypt_email_insert_shortcode', image: url + '/../images/tinymce_encrypt.png' });
		},
	});

	// Register our TinyMCE plugin
	// first parameter is the button ID1
	// second parameter must match the first parameter of the tinymce.create() function above
	tinymce.PluginManager.add('encrypt_email_button', tinymce.plugins.encrypt_email_plugin);
});
