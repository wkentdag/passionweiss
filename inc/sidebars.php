<?
function set_up_sidebars() {
	register_sidebar(array("name"=>"Main", "id"=>"sidebar-1"));
	register_sidebar(array("name"=>"Main-Bottom", "id"=>"sidebar-2"));
	register_sidebar(array("name"=>"Secondary", "id"=>"secondary"));
}
add_action( 'init', 'set_up_sidebars' );

?>