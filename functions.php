<? 

$GLOBALS['special_category'] = 6438;
$GLOBALS['topbillin_category'] = 6439;
$GLOBALS['passionfeatures_category'] = 6440;
$GLOBALS['news_category'] = 6441;
$GLOBALS['links_category'] = 6442;
$GLOBALS['deepthoughts_category'] = 6443;
$GLOBALS['highfidelity_category'] = 5582;
$GLOBALS['passionpresents_category'] = 6444;
$GLOBALS['staffpicks_category'] = 6445;
$GLOBALS['albumofthemonth_category'] = 6446;
$GLOBALS['sidepieces_category'] = 6466;
$GLOBALS['innersanctum_category'] = 2;
$GLOBALS['top5_category'] = 6475;

$GLOBALS['random_old_posts_weeks_old'] = 52;

//include other functions
/*sidebar*/
require( get_template_directory() . '/inc/sidebars.php' );
require( get_template_directory() . '/inc/bottom_nav.php' );
require( get_template_directory() . '/lazyload_home.php' );

function is_blog() {
 
    global $post;
 
    //Post type must be 'post'.
    $post_type = get_post_type($post);
 
    //Check all blog-related conditional tags, as well as the current post type, 
    //to determine if we're viewing a blog page.
    return (
        ( is_home() || is_archive() || is_single() )
        && ($post_type == 'post')
    ) ? true : false ;
 
}

function find_image_id($post_id) {
    if (!$img_id = get_post_thumbnail_id ($post_id)) {
        $attachments = get_children(array(
            'post_parent' => $post_id,
            'post_type' => 'attachment',
            'numberposts' => 1,
            'post_mime_type' => 'image'
        ));
        if (is_array($attachments)) foreach ($attachments as $a)
            $img_id = $a->ID;
    }
    if ($img_id)
        return $img_id;
    return false;
}

function find_img_src($post) {
    if (!$img = find_image_id($post->ID))
        if ($img = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches))
            $img = $matches[1][0];
    if (intVal($img) > 0) {
        $img = wp_get_attachment_image_src($img, "original");
        $img = $img[0];
    }
    return $img;
}

function load_jquery_and_other_scripts() {

    // only use this method is we're not in wp-admin
    if (!is_admin()) {

        // deregister the original version of jQuery
        wp_deregister_script('jquery');

        // discover the correct protocol to use
        $protocol='http:';
        if($_SERVER['HTTPS']=='on') {
            $protocol='https:';
        }

        wp_register_script('jquery', get_bloginfo('template_url') . '/js/jquery.min.js', false, '1.10.2');

        // add it back into the queue
        wp_enqueue_script('jquery');
    }
	
	wp_enqueue_script('spin', get_bloginfo('template_url') . '/js/spin.min.js');
	wp_enqueue_script('functions', get_bloginfo('template_url') . '/js/wfunctions.js');
	wp_enqueue_script('wp_links', get_bloginfo('template_url') . '/js/wp_links.js');
	wp_enqueue_script('resize', get_bloginfo('template_url') . '/js/resize.js');
	
	if (strstr($_SERVER['REQUEST_URI'], "user-edit.php") != "") {
		wp_enqueue_script('jquery');
 
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
 
        wp_enqueue_script('media-upload');
		wp_register_script("user_photo_uploader", get_template_directory_uri() . "/js/userphoto.js");
		wp_enqueue_script("user_photo_uploader");
	}

}
add_action('wp_enqueue_scripts', 'load_jquery_and_other_scripts');
add_action('admin_enqueue_scripts', 'load_jquery_and_other_scripts');

function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}

register_nav_menus(array('top'=>'top', 'bottom'=>'bottom'));

add_theme_support('post-thumbnails');

// Original PHP code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.

function truncate($string, $limit, $break=" ", $pad="...")
{
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  $string = substr($string, 0, $limit);
  if(false !== ($breakpoint = strrpos($string, $break))) {
    $string = substr($string, 0, $breakpoint);
  }

  return $string . $pad;
}

function exclude_list( $query ) {

    global $exclude_posts;

    if (is_array($exclude_posts)) $query->set( 'post__not_in', $exclude_posts );
}

add_action( 'pre_get_posts', 'exclude_list');

function get_writers() { 

    $users = array();
    $roles = array('author', 'administrator');

    foreach ($roles as $role) :
        $users_query = new WP_User_Query( array( 
            'fields' => 'all_with_meta', 
            'role' => $role, 
            'orderby' => 'display_name'
            ) );
        $results = $users_query->get_results();
        if ($results) $users = array_merge($users, $results);
    endforeach;
	
	//uasort($users, "writer_cmp");

    return $users;
}
function writer_cmp($v1, $v2) {
	if (strcasecmp($v1->last_name, $v2->last_name) > 0) return 1;
	else return 0;
}
?>