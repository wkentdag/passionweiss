<?
/*Tactics Digital Options*/
/**add css**/
function tactics_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'tactics-theme-options', get_template_directory_uri() . '/inc/theme-options.css', false, '2012-08-27' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'tactics_admin_enqueue_scripts' );

/**add theme options**/
function tactics_theme_options_init() {
	if ( false === tactics_get_theme_options() )
	add_option( 'tactics_theme_options', tactics_get_default_theme_options() );

	register_setting(
		'tactics_options',       
		'tactics_theme_options',
		'tactics_theme_options_validate'
	);

	add_settings_section(
		'general', 
		'Settings', 
		'__return_false', 
		'theme_options' 
	);

	add_settings_field( 'fixed_header', __( 'Fixed Header','tactics' ), 'tactics_settings_field_fixed_header', 'theme_options', 'general' );
	add_settings_field( 'fixed_footer', __( 'Fixed Footer','tactics' ), 'tactics_settings_field_fixed_footer', 'theme_options', 'general' );
	add_settings_field( 'sidebars_on', __( 'Sidebars On','tactics' ), 'tactics_settings_field_sidebars_on', 'theme_options', 'general' );
	add_settings_field( 'comments_on', __( 'Comments On','tactics' ), 'tactics_settings_field_comments_on', 'theme_options', 'general' );
	add_settings_field( 'social_media', __( 'Social Media Icons On','tactics' ), 'tactics_settings_field_social_media', 'theme_options', 'general' );
	add_settings_field( 'slider_on', __( 'Slider On','tactics' ), 'tactics_settings_field_slider_on', 'theme_options', 'general' );
	add_settings_field( 'slider_show_caption', __( '&rarr; Show Caption','tactics' ), 'tactics_settings_field_slider_show_caption', 'theme_options', 'general' );
	add_settings_field( 'slider_show_description', __( '&rarr; Show Description','tactics' ), 'tactics_settings_field_slider_show_description', 'theme_options', 'general' );
	add_settings_field( 'slider_show_navigation', __( '&rarr; Show Navigation','tactics' ), 'tactics_settings_field_slider_show_navigation', 'theme_options', 'general' );
	add_settings_field( 'slider_width', __( '&rarr; Slider Width','tactics' ), 'tactics_settings_field_slider_width', 'theme_options', 'general' );
	add_settings_field( 'slider_height', __( '&rarr; Slider Height','tactics' ), 'tactics_settings_field_slider_height', 'theme_options', 'general' );

}
add_action( 'admin_init', 'tactics_theme_options_init' );

/**end**/
/**???option page capability**/
function tactics_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_tactics_options', 'tactics_option_page_capability' );
/**end**/
/**add admin menu page **/
function tactics_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'tactics' ),   
		__( 'Theme Options', 'tactics' ),   
		'edit_theme_options',                   
		'theme_options',                        
		'tactics_theme_options_render_page'
	);
}
add_action( 'admin_menu', 'tactics_theme_options_add_page' );

/**end**/

/**set default options **/
function tactics_get_default_theme_options() {
	$default_theme_options = array(
		'fixed_header' => 'true',
		'fixed_footer' => 'true',
		'slider_on' => 'true',
		'slider_show_caption' => 'false',
		'slider_show_description' => 'false',
		'slider_show_navigation' => 'false',
		'slider_width' => '1024',
		'slider_height' => '250',
		'sidebars_on' => 'true',
		'comments_on' => 'true',
		'social_media' => 'true',
	);

	return apply_filters( 'tactics_default_theme_options', $default_theme_options );
}

/**end**/
/**get theme options**/
function tactics_get_theme_options() {
	return get_option( 'tactics_theme_options', tactics_get_default_theme_options() );
}
/**end**/
/**render fixed header option**/
function tactics_settings_field_fixed_header() {
	$options = tactics_get_theme_options();

	?><div>
      <p>
        <label>
          <input type="radio" name="tactics_theme_options[fixed_header]" value="true" id="RadioGroup1_0" <?php checked( $options['fixed_header'], 'true' ); ?> />
          
          Yes</label> 
        <label>
          <input type="radio" name="tactics_theme_options[fixed_header]" value="false" id="RadioGroup1_1"<?php checked( $options['fixed_header'], 'false' ); ?> />
          No</label>
        
      </p>
	</div><?php
}
/**end**/

/**render fixed footer option**/
function tactics_settings_field_fixed_footer() {
	$options = tactics_get_theme_options();

	?>
	<div>
      <p>
        <label>
          <input type="radio" name="tactics_theme_options[fixed_footer]" value="true" id="fixed_footer_true" <?php checked( $options['fixed_footer'], 'true' ); ?> />
          
          Yes</label> 
        <label>
          <input type="radio" name="tactics_theme_options[fixed_footer]" value="false" id="fixed_footer_false" <?php checked( $options['fixed_footer'], 'false' ); ?> />
          No</label>
        
      </p>
	</div><?php
}
/**end**/
/**render slider on option**/
function tactics_settings_field_slider_on() {
	$options = tactics_get_theme_options();

	?><div>
      <p>
        <label>
          <input type="radio" name="tactics_theme_options[slider_on]" value="true" id="slider_on_true" <?php checked( $options['slider_on'], 'true' ); ?> />
          
          Yes</label> 
        <label>
          <input type="radio" name="tactics_theme_options[slider_on]" value="false" id="slider_on_false" <?php checked( $options['slider_on'], 'false' ); ?> />
          No</label>
        
      </p>
      </div><?php
}
 
function tactics_settings_field_slider_show_caption() {
	$options = tactics_get_theme_options();
	?><div class="slidersettings">

<p><label><input type="radio" name="tactics_theme_options[slider_show_caption]" value="true" id="slider_show_caption_true" <?php checked( $options['slider_show_caption'], 'true' ); ?> />Yes</label> 
<label><input type="radio" name="tactics_theme_options[slider_show_caption]" value="false" id="slider_show_caption_false" <?php checked( $options['slider_show_caption'], 'false' ); ?> />No</label></p>

</div><? }
function tactics_settings_field_slider_show_navigation() {
	$options = tactics_get_theme_options();
	?><div class="slidersettings">

<p><label><input type="radio" name="tactics_theme_options[slider_show_navigation]" value="true" id="slider_show_navigation_true" <?php checked( $options['slider_show_navigation'], 'true' ); ?> />Yes</label> 
<label><input type="radio" name="tactics_theme_options[slider_show_navigation]" value="false" id="slider_show_navigation_false" <?php checked( $options['slider_show_navigation'], 'false' ); ?> />No</label></p>

</div>
<? } 
function tactics_settings_field_slider_show_description() {
	$options = tactics_get_theme_options();
	?><div class="slidersettings">

<p><label><input type="radio" name="tactics_theme_options[slider_show_description]" value="true" id="slider_show_description_true" <?php checked( $options['slider_show_description'], 'true' ); ?> />Yes</label> 
<label><input type="radio" name="tactics_theme_options[slider_show_description]" value="false" id="slider_show_description_false" <?php checked( $options['slider_show_description'], 'false' ); ?> />No</label></p>

</div>
<? }
function tactics_settings_field_slider_width() {
	$options = tactics_get_theme_options();
	?><div class="slidersettings">

<p><input name="tactics_theme_options[slider_width]" type="text" value="<?php echo $options['slider_width']; ?>" /></p>
</div>
<? } 
function tactics_settings_field_slider_height() {
	$options = tactics_get_theme_options();
	?><div class="slidersettings">

<p><input name="tactics_theme_options[slider_height]" type="text" value="<?php echo $options['slider_height']; ?>" /></p>

</div>
<? }
/**end**/
/**render sidebars on option**/
function tactics_settings_field_sidebars_on() {
	$options = tactics_get_theme_options();

	?>
	<div>
      <p>
        <label>
          <input type="radio" name="tactics_theme_options[sidebars_on]" value="true" id="sidebars_on_true" <?php checked( $options['sidebars_on'], 'true' ); ?> />
          
          Yes</label> 
        <label>
          <input type="radio" name="tactics_theme_options[sidebars_on]" value="false" id="sidebars_on_false" <?php checked( $options['sidebars_on'], 'false' ); ?> />
          No</label>
        
      </p>
	</div>
	<?php
}
/**end**/
/**render comments on option**/
function tactics_settings_field_comments_on() {
	$options = tactics_get_theme_options();
?><div>
      <p>
        <label>
          <input type="radio" name="tactics_theme_options[comments_on]" value="true" id="comments_on_true" <?php checked( $options['comments_on'], 'true' ); ?> />
          
          Yes</label> 
        <label>
          <input type="radio" name="tactics_theme_options[comments_on]" value="false" id="comments_on_false" <?php checked( $options['comments_on'], 'false' ); ?> />
          No</label>
        
      </p>
	</div>
<?php
}
/**end**/

/**render social media on option**/
function tactics_settings_field_social_media() {
	$options = tactics_get_theme_options();
?><div>
      <p>
        <label>
          <input type="radio" name="tactics_theme_options[social_media]" value="true" id="social_media_true" <?php checked( $options['social_media'], 'true' ); ?> />
          
          Yes</label> 
        <label>
          <input type="radio" name="tactics_theme_options[social_media]" value="false" id="social_media_false" <?php checked( $options['social_media'], 'false' ); ?> />
          No</label>
        
      </p>
	</div>
<?php
}
/**end**/

/**returns the options array**/
function tactics_theme_options_render_page() {
	?>
<div>
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'tactics' ), get_current_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'tactics_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
</div>
	<?php
}
/**end**/
/** Sanitize and validate form input. Accepts an array, return a sanitized array.**/
function tactics_theme_options_validate( $input ) {
	$output = $defaults = tactics_get_default_theme_options();

	if ( isset( $input['fixed_header'] ) )
		$output['fixed_header'] = $input['fixed_header'];
	if ( isset( $input['fixed_footer'] ) )
		$output['fixed_footer'] = $input['fixed_footer'];
	if ( isset( $input['slider_on'] ) )
		$output['slider_on'] = $input['slider_on'];
	if ( isset( $input['slider_show_caption'] ) )
		$output['slider_show_caption'] = $input['slider_show_caption'];
	if ( isset( $input['slider_show_description'] ) )
		$output['slider_show_description'] = $input['slider_show_description'];
	if ( isset( $input['slider_show_navigation'] ) )
		$output['slider_show_navigation'] = $input['slider_show_navigation'];
	if ( isset( $input['slider_width'] ) )
		$output['slider_width'] = $input['slider_width'];
	if ( isset( $input['slider_height'] ) )
		$output['slider_height'] = $input['slider_height'];
	if ( isset( $input['sidebars_on'] ) )
		$output['sidebars_on'] = $input['sidebars_on'];
	if ( isset( $input['comments_on'] ) )
		$output['comments_on'] = $input['comments_on'];
	if ( isset( $input['social_media'] ) )
		$output['social_media'] = $input['social_media'];

	return apply_filters( 'tactics_theme_options_validate', $output, $input, $defaults );
}
/**end**/
/**attach to wp-head**/
function tag_style(){
echo "<style>";
}
add_action( 'wp_head', 'tag_style' );

/**fixed header**/
function tactics_print_fixed_header() {
	$options = tactics_get_theme_options();
	$fixed_header = $options['fixed_header'];

	if ( $fixed_header == 'true' || $fixed_header == '' ){
	?>	
#heading{ position: fixed; }    
.spacer {
display: inline-block;
float: left;
width: 100%;
height:60px;}
	<?
	}else{ ?>
#heading{ position: inherit; }        
.spacer {
display: none;}
	<?	}
}
add_action( 'wp_head', 'tactics_print_fixed_header' );
/**end**/
/**fixed footer**/
function tactics_print_fixed_footer() {
	$options = tactics_get_theme_options();
	$fixed_footer = $options['fixed_footer'];

	if ( $fixed_footer == 'true' || $fixed_footer == '' ){
	?>	
#footer{position: fixed;}  
	<?
	}else{ ?>	
#footer{position: inherit;}  
<? }
}
add_action( 'wp_head', 'tactics_print_fixed_footer' );
/*end*/
/**sidebar on**/
function tactics_print_sidebars_on() {
	$options = tactics_get_theme_options();
	$sidebars_on = $options['sidebars_on'];

	if ( $sidebars_on == 'true' || $sidebars_on == '' ){
	?>	
.content{ width: 67%; }
.sidebar{ display: inline-block;
	width: 20%;
} 
	<?
	}else{ ?>	
.content{ width: 100%; }
.sidebar{ display: none;} 
<? }
}
add_action( 'wp_head', 'tactics_print_sidebars_on' );
/*end*/
/**sidebar on**/
function tactics_print_comments_on() {
	$options = tactics_get_theme_options();
	$comments_on = $options['comments_on'];
	if ( $comments_on == 'true' || $comments_on == '' ){
	?>	
.comments_footer{ display: inline-block;} 
	<?
	}else{ ?>	
.comments_footer{ display: none;} 
<? }
}
add_action( 'wp_head', 'tactics_print_comments_on' );
/*end*/

function untag_style(){
echo "</style>";
}
add_action( 'wp_head', 'untag_style' );

/**end**/

/*set global variable sliders*/
function g_slider_on() {
global $slider_on;
global $slider_show_caption;
global $slider_show_description;
global $slider_show_navigation;
global $slider_width;
global $slider_height;
	$options = tactics_get_theme_options();
	$slider_on = $options['slider_on'];
	$slider_show_caption = $options['slider_show_caption'];
	$slider_show_description = $options['slider_show_description'];
	$slider_show_navigation = $options['slider_show_navigation'];
	$slider_width = $options['slider_width'];
	$slider_height = $options['slider_height'];
}
function social_media_on() {
global $social_media;
	$options = tactics_get_theme_options();
	$social_media = $options['social_media'];
}
/*end*/
/*create category for slider*/
wp_insert_term('Slider', 'category', array(
    'description' => 'Featured images within posts in this category will be added to the slider',
    'slug' => 'slider'
));
/**/
?>