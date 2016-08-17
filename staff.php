<?
/** Template Name: Staff **/

get_header();
$writers = get_writers();
?>

<div class="content">

<?php 
if ( have_posts() ) : 

while ( have_posts() ) : the_post(); ?>


	<div class="article">
		<div class="clear" style="height: 80px;">&nbsp;</div>
		<div class="staffpicks">
			<? foreach ($writers as $writer) { 
				$img = $writer->get("photo");
				$author_url = "/author/" . str_replace(" ", "-", strtolower($writer->user_login));
				?>
				<div class="author_item" style="padding-left: 0px !important;">
					<div class="staffpicks_left" style="width: 230px !important; height: 230px;">
						<div class="staffpicks_tag_container"><div class="staffpicks_tag"><? echo $writer->display_name; ?></div></div>
						<div class="author_image" style="width: 230px; max-height: 230px;"><a href="<? echo $author_url; ?>"><img src="<? echo $img ?>" border="0"></a></div>
					</div>
					<div class="staffpicks_right"  style="width: 200px !important;">
						<div class="staffpicks_author" style="height: 30px;">
							<div class="staffpicks_author_details" style="height: 10px;">
								<div class="staffpicks_author_tag">CONTRIBUTOR</div>
							</div>
						</div>
						<div class="staffpicks_title"><a href="<? echo $author_url; ?>"><? echo $writer->display_name; ?></a></div>
						<div class="staffpicks_description"><!--? echo truncate($writer->get('bio'), 250, " "); ?--><a href="<? echo $author_url; ?>"><img src="<? bloginfo("template_directory"); ?>/images/readarrow.jpg" border="0" class="staffpicks_read"></a></div>
					</div>
				</div>
			<? } ?>
		</div>
		<div class="clear"></div>
	</div><!-- /article -->
	<div class="clear"></div>

</div><!-- /content -->

<? endwhile; endif;

get_footer(); ?>