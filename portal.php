<?php
/*
Template Name: Portal
*/
query_posts("cat=".$GLOBALS['PORTAL_CAT']."&showposts=-1");
?>

<?php get_header(); ?>

<div class="content">
	<div class="article">
		<div class="inner_constraint" style="padding-top: 40px;">
			<?php if (!current_user_can('view_portal')) { ?><center style="margin-top: 100px;"><h2>Sorry, you don't have permission to access this part of the site...</h2><br><i>If you believe you received this message in error, please clear your cache and login again.</i></center><?php } else { 
				while (have_posts()) : the_post(); ?>
					<div class="blogpost_archive">
						<!-- post thumbnail-->
						<div class="blogpost_featimg">
							<?
							if ( has_post_thumbnail() ):
							$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
							?>
							<a href="<?php echo get_permalink(); ?>"><img src='<?php echo $url; ?>' class='post-thumbnail' /></a>
							<?
							endif;
							?>
						</div>
						<!-- end post thumbnail-->
						
						<div class="blogpost_summary">
							<!--title-->
							<h1 class="blogpost_title" style="font-size: 18pt; margin-top: 0px; padding-top: 0px; text-align: left;"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tactics' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
							<!--end title-->

							<!-- date and author-->
							<div class="blogpost_date" style="text-align: left;"><? echo "Posted on "; the_time(get_option('date_format')); echo " by "; the_author_posts_link(); ?></div>
							<!--end date and author-->
							
							<!-- post excerpt -->
							<?
							$SUMMARY_LEN = 250;
							$post_content = strip_tags(get_the_content());
							//remove shortcods
							$post_content = preg_replace('/[*+?]/', '', $post_content);
							if (strlen($post_content) > $SUMMARY_LEN) {
								$post_content = substr($post_content, 0, $SUMMARY_LEN);
								$post_content = substr($post_content, 0, strrpos($post_content, " ")) . "...";
							}
							
							echo $post_content;
							?>
							<!-- end post excerpt -->
									 
							<!-- read more -->
							<p><? echo "<a href='"; the_permalink(); echo "'>Continue reading <span class='meta-nav'>&rarr;</span></a>"; ?></p>
							<!--end read more-->   
						</div>
					</div>
					<div style="clear: both; float: none; width: 100%; height: 1px; border-top: 1px solid #efefef; margin-bottom: 40px; margin-top: 40px;"></div>
					<?php 
					endwhile; 
				}
				?>
		</div><!-- end inner_constraint -->
	</div>
</div>

<? get_footer(); ?>