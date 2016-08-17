<?php
/*
Template Name: Login
*/
?>

<?php get_header(); ?>

<div class="content">
	<div class="article">
		<div class="inner_constraint">
		
			<center><h1>Please login to our company portal:</h1></center>
			
			<?php 
			$args = array(
				'echo' => true,
				'redirect' => site_url( '/portal/' ), 
				'form_id' => 'loginform',
				'label_username' => __( 'Username' ),
				'label_password' => __( 'Password' ),
				'label_remember' => __( 'Remember Me' ),
				'label_log_in' => __( 'Log In' ),
				'id_username' => 'user_login',
				'id_password' => 'user_pass',
				'id_remember' => 'rememberme',
				'id_submit' => 'wp-submit',
				'remember' => true,
				'value_username' => NULL,
				'value_remember' => false
			);
			wp_login_form($args);
			?> 
		</div><!-- end inner_constraint -->
	</div>
</div>

<? get_footer(); ?>