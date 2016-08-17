<? get_header(); ?>

	<div class="content" style="border-top: 1px solid #262626; margin-top: 50px;">
	<!-- leftCol -->
		<div class="leftCol">
			<!--content-->
			<?php 
			get_template_part( 'content', 'page' ); ?>
			<!--end content-->
		</div>
		<div class="rightcol">
			<!--if siderbar on-->
			<?php get_sidebar(); ?>
			<!--end sidebar-->
		</div>
	</div>
<? get_footer(); ?>