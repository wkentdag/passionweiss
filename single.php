<? get_header(); ?>
<div class="content">
	<!-- left_col -->
	<div class="leftCol">
		<?php get_template_part( 'content', 'single' ); ?>	
	</div><!-- /left_col -->

	<!-- right_col -->
	<div class="rightCol">
		<div class="clear" style="height: 40px;"></div>
		<div id="topSocial">
			<a href="http://www.twitter.com/passionweiss"><img src="<? bloginfo("template_directory"); ?>/images/twitter.png" style="float: left; margin-left: 0px;"></a>
			<a href="http://www.facebook.com/passionweiss"><img src="<? bloginfo("template_directory"); ?>/images/facebook.png" style="float: left;"></a>
			<a href="http://www.instagram.com/passionweiss"><img src="<? bloginfo("template_directory"); ?>/images/instagram.png" style="float: left;"></a>
			<a href="http://soundcloud.com/passionweiss"><img src="<? bloginfo("template_directory"); ?>/images/soundcloud.png" style="float: left;"></a>
			<a href="https://www.youtube.com/channel/UCbd7VXWPG13AbTiL8BSV5jg"><img src="<? bloginfo("template_directory"); ?>/images/youtube.png" style="float: left;"></a>
			<!--<a href="#"><img src="<? bloginfo("template_directory"); ?>/images/paypal.png" style="float: left;"></a>-->
		</div>
		<? get_sidebar('secondary'); ?>
	</div>
	<div class="clear"></div>

	<div id="loadInto_2"></div>
</div>
<? get_footer(); ?>