
<script>
	lazyLoadPage = "post";
	lazyLoadParts = 2;
</script>

<?php 
if (have_posts) : while ( have_posts() ) : the_post(); ?>

	<div class="article">
		<div class="postSummaryHeader" style="margin-top: 50px;">
			<div class="postSummaryTitle"><a href="<? the_permalink(); ?>"><? echo truncate(get_the_title(), 150); ?></a></div>
			<div class="postSummaryDate"><? echo the_date(); ?></div>
			<div class="clear"></div>
		</div><!-- /post_summary_header -->
		<!--title
		<div class="defpost_title_container">
			<table border="0" width="100%"><tr>
				<td class="defpost_title"><h1><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tactics' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h1></td>
				<td class="defpost_date"><? the_date("F d Y"); ?></td>
			</tr></table>
		</div><!-- /post_summary_header -->
		
		<?
		$thumbnail = "";
		if (!$img_id = get_post_thumbnail_id (get_the_ID())) {
			$attachments = get_children(array(
				'post_parent' => get_the_ID(),
				'post_type' => 'attachment',
				'numberposts' => 1,
				'post_mime_type' => 'image'
			));
			if (is_array($attachments)) {
				$thumbMeta = wp_get_attachment($attachments[0]);
				$thumbnail = $attachments[0]['guid'];
				$embed_caption = $thumbMeta['caption'];
			}
		}
		
		$embed = get_post_meta(get_the_ID(), 'embed', true);
		$embed_caption = get_post_meta(get_the_ID(), 'embed_caption', true);
		
		$authorID = $post->post_author;
		$rating = get_post_meta(get_the_ID(), '_rating', true);
		$highlights = get_post_meta(get_the_ID(), '_highlights', true);
		$itunes = get_post_meta(get_the_ID(), '_itunes', true);
		$emusic = get_post_meta(get_the_ID(), '_emusic', true);
		$amazon = get_post_meta(get_the_ID(), '_amazon', true);
		$signatureImg = get_post_meta(get_the_ID(), 'wp_custom_attachment', true);
		$byline = get_the_author_meta('byline', $authorID);
		$signature = get_the_author_meta('signature', $authorID);
		
		if ($embed != "") { ?>
			<div class="defpost_embed"><? echo $embed; ?></div>
		<? } else if ($thumbnail != "") { ?>
			<div class="defpost_embed"><img src="<? echo $thumbnail; ?>"></div>
		<? } ?>
		<div class="defpost_embed_caption"><? echo $embed_caption; ?></div>
		
		<? if ($rating != "" && $highlights != "") { ?>
			<div class="rating_container">
				<table border="0" width="100%"><tr>
					<td class="rating">
						<? echo $rating; ?>/5<!--? echo get_option('max_rating_level'); ?-->
					</td><td class="highlights">
						<? if ($highlights != "") { ?><p>Highlights:</p> <? echo $highlights; ?><? } ?>
					</td>
				</tr></table>
			</div>
			<div class="rating_footer">
				<? if ($itunes != "" || $emusic != "" || $amazon != "") { ?>
					<div class="rating_footer_left">Buy It At <? 
						if ($itunes) echo "<a href=\"" . $itunes . "\">iTunes</a>";
						if ($itunes != "" && ($emusic != "" || $amazon != "")) echo " | ";
						if ($emusic != "") echo "<a href=\"" . $emusic . "\">emusic</a>";
						if ($itunes != "" || $emusic != "") echo " | ";
						if ($amazon != "") echo "<a href=\"" . $amazon . "\">amazon</a>"; ?>
					</div>
				<? } ?>
				<div class="rating_footer_right">
					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style" addthis:url="<? the_permalink(); ?>" addthis:title="<? echo addslashes(get_the_title()); ?>" addthis:description="<? echo str_replace("\"", "'", addslashes(wp_kses(get_the_excerpt(), ""))); ?>">
						<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
						<a class="addthis_button_tweet"></a>
						<a class="addthis_button_google_plusone" g:plusone:size="medium"></a> 
					</div>
				</div>
			</div>
		<? } ?>
		
		<div class="inner_constraint">
			<div class="defpost_content">
				<? the_content(); ?>
			</div><!-- /defpost_content -->
			<div class="clear"></div>	
			<div class="defpost_signature_image"><? if ($signatureImg) echo "<img src=\"" . $signatureImg['url'] . "\">"; ?></div>
			<div class="defpost_author_byline"><? echo $byline; ?></div>
			<div class="defpost_author_signature"><? echo $signature; ?></div>
			<!-- end post content -->
			
			<div class="defpost_footer">
				<div class="defpost_footer_top"><!-- if comments on -->
					<div class="defpost_footer_left"><? if ($comments = comments_number('','1 Comment', '% Comments') != '') { ?><div class="current_comments"><? comments_on();?></div><? } ?> <a href="#comments">Leave Comment</a> <span class="defpost_footer_divider">|</span> <a href="javascript: readLater('<? echo the_permalink(); ?>');">Read Later</a></div>
					<div class="defpost_footer_right">
						<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_default_style" addthis:url="<? the_permalink(); ?>" addthis:title="<? echo addslashes(get_the_title()); ?>" addthis:description="<? echo str_replace("\"", "'", addslashes(wp_kses(get_the_excerpt(), ""))); ?>">
							<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
							<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
							<a class="addthis_button_tweet"></a>
						</div>
					</div>
				</div><!-- /defpost_footer_top -->
				<div class="defpost_footer_bottom">
					Posted By <? the_author_posts_link(); ?> In <? echo the_tags(); ?> 
				</div><!-- /defpost_footer_bottom -->
				<div class="clear"></div>
			</div><!-- /defpost_footer -->
			
			<div class="comments_footer">
				<a name="comments"/>
				<? comments_template('', true); ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div><!-- /inner_constraint -->
		<div class="clear"></div>		
			
	</div><!-- /article -->
	<div class="clear"></div>
	<?php
	endwhile;
endif; ?>
	
<div id="blogpost_loadinto_container">
	<div id="loadInto_1"></div><!-- /loadInto -->
</div>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52af938927810ddc"></script>
