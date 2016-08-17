<?
/**
Template Name Posts: Magazine
*/

get_header();
?>

<div class="content">
<script>
	lazyLoadPage = "feature";
</script>

<?php 
if ( have_posts() ) : 

while ( have_posts() ) : the_post(); ?>


<div class="article">

	<!--title-->
	<h1 class="blogpost_title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tactics' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<div class="blogpost_subtitle"><div class="blogpost_excerpt"><? echo truncate(get_the_excerpt(), 200); ?></div><div class="blogpost_date" style="margin-top: 15px;">By <span class="blogpost_author_link"><? the_author_posts_link(); ?> &nbsp;&nbsp;&nbsp;<? the_time(get_option('date_format')); ?></div></div>
	<!--end title-->
	<?
	global $post;
	$embed = get_post_meta(get_the_ID(), 'embed', true);
	$embed_caption = get_post_meta(get_the_ID(), 'embed_caption', true);
	$authorID = $post->post_author;
	$byline = get_the_author_meta('byline', $authorID);
	$signature = get_the_author_meta('signature', $authorID);
	if ($embed != "") { ?>
		<div class="blogpost_embed"><? echo $embed; ?></div>
		<div class="blogpost_embed_caption"><? echo $embed_caption; ?></div>
	<? } ?>
	<div class="blogpost_author"></span></div>
	
	<div class="inner_constraint">
		<!--<div class="blogpost_nav">
			<ul>
				<li><a href="#"><img src="<? bloginfo('template_url'); ?>/images/blogpost_email.jpg"></a><div>Email</div></li>
				<li><a href="#"><img src="<? bloginfo('template_url'); ?>/images/blogpost_facebook.jpg"></a><div>Facebook</div></li>
				<li><a href="#"><img src="<? bloginfo('template_url'); ?>/images/blogpost_twitter.jpg"></a><div>Twitter</div></li>
				<li><a href="#"><img src="<? bloginfo('template_url'); ?>/images/blogpost_save.jpg"></a><div>Save</div></li>
				<li><a href="#"><img src="<? bloginfo('template_url'); ?>/images/blogpost_print.jpg"></a><div>Print</div></li>
				<li><a href="#"><img src="<? bloginfo('template_url'); ?>/images/blogpost_more.jpg"></a><div>More</div></li>
			</ul>
		</div>-->
		<div class="blogpost_content">
			<!-- post content -->
			<div class="blogpost_inner"><? the_content(); ?></div>
			
			<div class="blogpost_author_byline"><? echo $byline; ?></div>
			<div class="blogpost_author_signature"><? echo $signature; ?></div>
			<!-- end post content -->
			
			<div class="article_footer">
				<!-- if comments on -->
				<div class="current_comments"><? comments_number('', '1 Comment', '% Comments');?></div>
				<div class="comments_footer">
					<? comments_template('', true); ?>
				</div>
				<!-- end comments-->
			</div>
			<div class="clear"></div>
			
			<!-- next previous 
			<div id="single_navigation">
				<span class="nav-next"><?php next_post_link( '%link', 'Next <span>&rarr;</span>', TRUE); ?></span>
				<span class="nav-previous"><?php previous_post_link( '%link', '<span>&larr;</span> Previous | ', TRUE); ?></span>
			</div>
			end next previous -->
		</div>
		<div class="clear"></div>
		</div><!--end article-->
			
		<?php 
		
		endwhile;
		endif; ?>
		<div class="clear"></div>		
		
	</div><!-- /article -->
	<div class="clear"></div>
	
	<div id="blogpost_loadinto_container">
		<div id="loadInto_1"></div><!-- /loadInto -->
	</div>
</div><!-- /content -->

<? get_footer(); ?>