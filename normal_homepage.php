<?php get_header();?>
		<div id="content" class="clear">
			<div id="main" class="left">	
<?php
if(is_search()){
	echo "<div class=\"opaque_10 result\"><strong class=\"icon tags\">搜索关键词 : </strong>";
	global $s; printf( '&quot; %1$s &quot;', wp_specialchars($s, 1) );
	echo "</div>";
}elseif(is_tag()){
	echo "<div class=\"opaque_10 result\"><strong class=\"icon tags\">文章标签 : </strong>";
	printf( "&quot;%1\$s&quot;<br />", single_tag_title('', false) );
	if( $desc = tag_description()){
		$desc=preg_replace("/<p>(.*)<\/p>/","$1",$desc);
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;标签描述: $desc";
	}
	echo "</div>";
}
?>
			<?php if(have_posts()):?>
			<?php while(have_posts()):?>
			<?php the_post();?>
			<article id="post-<?php the_ID();?>" class="clear">
			 <section class="postinfo left extracolum">
			 	<div class="post_time icon">
			 	<?php the_time('Y年m月j日<b\r /> g:i a'); ?>
			 	</div><!--end of post_time-->
			 	<ul class="postmeta opaque_5">
			 	<?php if(comments_open()) : ?><li><a class="comment_post comment_on icon" rel="nofollow" href="<?php the_permalink();?>#respond" title="发表你的评论">发表你的评论 <?php comments_number('( 0 )','( 1 )','( % )'); ?></a></li>
			<?php else:?>
			<li><a class="comment_off icon" rel="nofollow" title="评论已关闭">评论已关闭 <?php comments_number('( 0 )','( 1 )','( % )'); ?></a></li>
			<?php endif; ?>
			 	<li><a href="<?php the_permalink();?>" class="permalink icon">文章链接</a></li>
			 	<?php edit_post_link(__('Edit'), '<li class="edit_post icon">', '</li>'); ?>
			 	</ul><!--end of postmeta-->
			 </section><!--end of postinfo-->
			 
			 <section class="postcontent maincolum left ver_side">
			 <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			 	<div class="post_content"><?php the_excerpt();?></div>
			 	<div class="opaque_5 post_tags">
			 <?php the_tags('<span class="tags icon">', ', ', '</span>');?>
			 	</div>
			 	<div class="hor_side"></div>
			 </section><!--end of postcontent-->
			</article><!--end of post-<?php the_ID();?>-->
			<?php endwhile;?>
	<div id="pagenavi"  class="page">
		<?php if(function_exists('wp_pagenavi')) : ?>
			<?php wp_pagenavi() ?>
		<?php elseif(function_exists('Mini_pagenavi')) : ?>
			<?php Mini_pagenavi() ?>	
		<?php else : ?>
			<span class="left"><?php previous_posts_link('上一页'); ?></span>
			<span class="right"><?php next_posts_link('下一页'); ?></span>
		<?php endif; ?>
	</div>		 	 
			 <?php else:?>
 Not Found!
			<?php endif;?>
			</div><!--end of main-->
<?php get_sidebar();?>	
		</div><!--end of content-->
<?php get_footer();?>
