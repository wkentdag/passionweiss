<?

function resizeDiv() {
	wp_enqueue_script(
		'resize-script',
		get_template_directory_uri() . '/inc/resize.js',
		array('jquery')
	);
}
add_action('wp_enqueue_scripts', 'resizeDiv');

?>