<? 
function load_my_style_social() {
    $themedir = get_bloginfo('template_url');
    wp_enqueue_style( 'social_style',  $themedir . "/inc/social.css");
    }
add_action('init', load_my_style_social);


function output_header_social_media(){
social_media_on();
global $social_media;

$social_array=array(
'blogger'=>"",
'facebook'=>"http://www.facebook.com",
'flickr'=>"",
'google'=>"http://www.google.com",
'linkedin'=>"http://www.linked.com",
'myspace'=>"",
'twitter'=>"http://www.twitter.com",
'wordpress'=>"",
'yahoo'=>"",
'youtube'=>""
);

if($social_media=='true'){
?>
<div id="social_media">
<? foreach ($social_array as $key => $value){
if(!$value){}else{
?>
<a href="<? echo $value; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social_media/<? echo $key; ?>.png" border="0"></a>
<? }} ?>
</div>

<?
}else{}
}
?>