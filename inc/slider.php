<?
/**add css**/
function load_my_style() {
    $themedir = get_bloginfo('template_url');
    wp_enqueue_style( 'slider_style',  $themedir . "/inc/slider.css");
    }
add_action('init', load_my_style);
function slide_functions() {
	wp_enqueue_script(
		'slide-script',
		get_template_directory_uri() . '/inc/slider.js',
		array('jquery')
	);
	wp_enqueue_script(
		'easing-script',
		get_template_directory_uri() . '/js/jquery_easing.js',
		array('jquery')
	);
}
add_action('wp_enqueue_scripts', 'slide_functions');

/*loop*/
function setup_the_slider_loop(){
$argss = array(
'post_type' => 'post',
'posts_per_page' => '10',
'category_name' => 'slider', 
);

query_posts( $argss );
global $slider_posts;
$slider_posts = array(); 
if ( have_posts() ) : 
$i=0;
while ( have_posts() ) : the_post();
$imgid=get_post_thumbnail_id();
$imgsrc=wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$clickurl=get_permalink();
$caption=get_post(get_post_thumbnail_id())->post_excerpt;
$description=get_post(get_post_thumbnail_id())->post_content;

$slider_posts[$i]=array(
'imgid'=>$imgid,
'imgsrc'=>$imgsrc,
'clickurl'=>$clickurl,
'caption'=>$caption,
'description'=>$description
);
$i++;
endwhile;
wp_reset_query();
endif; 
}
/*end*/

/*set the slider details*/
function slider_details(){
global $slider_show_caption;
global $slider_show_description;
global $slider_show_navigation;
global $slider_width;
global $slider_height;
$sliderstyle="style='width: ".$slider_width."px; height: ".$slider_height."px;'";
$sliderstyleimg="style='width: ".$slider_width."; height: auto'";
setup_the_slider_loop();
global $slider_posts;

?>
<div class="slider_wrapper" <? //echo $sliderstyle; ?>>
<? if($slider_show_navigation=='true'){?>
<div class="lefta lclick"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/leftarr.png" width="29" height="43" class="arrows-slider" /></div>
<div class="righta rclick"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/rightarr.png" width="29" height="43" class="arrows-slider"/></div>
<? }else{} ?>
<?

for($i = 0; $i < count($slider_posts); ++$i) {
 ?>
<!--single slide container -->
<div class='slide_container' <? //echo $sliderstyle; ?>>
<!--image -->
<a href="<? echo $slider_posts[$i]['clickurl']; ?>"><img src="<? echo $slider_posts[$i]['imgsrc']; ?>" border="0" <? echo $sliderstyle; ?> class="slideimg" /></a>
<!--end image-->
<!--caption-->
<? if ($slider_show_caption=='true'||$slider_show_description=='true'){?><div class="slider-caption" <? echo $sliderstyleimg; ?>>
<? if ($slider_show_caption=='true'){?><span class="slidecap"><? echo $slider_posts[$i]['caption']; ?></span><BR /><? }else{}?>
<? if ($slider_show_description=='true'){?><span class="slidedes"><? echo $slider_posts[$i]['description']; ?></span><? }else{}?></div>
<? }else{}?>
<!--end description-->
</div>
<!--end single slide container -->
<? 
}
?>
</div>
<?
}
/**/
function slider_animation(){
slider_details();
}

?>