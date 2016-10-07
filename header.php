<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<title>
		<?php
		global $page, $paged;
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		?>
	</title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link href='http://fonts.googleapis.com/css?family=Quicksand:400,700' rel='stylesheet' type='text/css'>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="icon" href="favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>

	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-545f8d7155dd5b9d" async="async"></script>

	<? wp_head(); ?>
</head>

<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-35027451-1', 'auto');
  ga('send', 'pageview');

</script>
<!--header div-->
<div class="headingParallax">
	<div id="navigationParallax"><?php get_template_part( 'nav', 'parallax' ); ?></div>
</div>
<div id="headingWrapper">
	<div class="headingContainer">
		<div id="heading">
			<div id="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<? bloginfo('template_directory'); ?>/images/logo.png" border="0" alt="<?php bloginfo( 'name' ); ?>"></a>
			</div>
			<div id="topAds"><a href="http://www.amazon.com/Original-Gangstas-Untold-Eazy-E-Shakur/dp/0316383899"><img src="/wp-content/uploads/2016/10/original_gangstas_animated-1.gif" border="0"></a></div>
		</div><!-- /heading -->
    </div><!-- /headingContainer -->
</div><!-- /headingWrapper -->

<div id="navigationContainer">
	<div id="navigation"><?php get_template_part( 'nav', 'top' ); ?></div>
</div><!-- /navigationContainer -->
<div class="wrapper">
	<div id="searchbar">
		<div id="searchfrm">
			<form id="searchform" action="<? bloginfo('siteurl'); ?>" method="get">
				<button id="searchbtn"><img src="<? bloginfo('template_directory'); ?>/images/search.png"></button>
				<input type="text" id="s" name="s" value="Enter your search here..." onfocus="jQuery('#s').val('');">
			</form>
		</div>
	</div>
</div>

<!--main div -->
<div class="main">
