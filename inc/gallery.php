<? 
function gallery_functions() {
	wp_enqueue_script(
		'gallery-script',
		get_template_directory_uri() . '/inc/gallery.js',
		array('jquery')
	);
}
add_action('wp_enqueue_scripts', 'gallery_functions');

function load_my_style_gal() {
    $themedir = get_bloginfo('template_url');
    wp_enqueue_style( 'gallery_style',  $themedir . "/inc/gallery.css");
    }
add_action('init', load_my_style_gal);

function gallery_effect( $atts, $galcontent ){
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $galcontent, $matches);
 $i=0;
 $countme=count($matches[1]);
while ($i<$countme){
list($imgwidth, $imgheight, $type, $attr) = getimagesize($matches[1][$i]);
$my_img.="<div class='singleimg'><img src='".$matches[1][$i]."' width='$imgwidth' height='$imgheight'></div>"; $i++;}
return '<div id="gal_display"></div>'.'<div id="nav_gal_display">'.$my_img.'</div>'; 
}
add_shortcode( 'mygallery', 'gallery_effect' );
?>