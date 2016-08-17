<? 
function lightbox_functions() {
	wp_enqueue_script(
		'lightbox-script',
		get_template_directory_uri() . '/inc/lightbox.js',
		array('jquery')
	);
}
add_action('wp_enqueue_scripts', 'lightbox_functions');


function lightbox_effect( $atts, $tagcontent ){

  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $tagcontent, $matches);
  $my_img = $matches [1] [0];
  
list($imgwidth, $imgheight, $type, $attr) = getimagesize("$my_img");

return '<a href="javascript: lightbox(\''.$my_img.'\',\''.$imgwidth.'\',\''.$imgheight.'\');">'.$tagcontent.'</a>'; 
}
add_shortcode( 'lightbox', 'lightbox_effect' );
?>