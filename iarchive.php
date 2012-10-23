<?php
/**
 * Template Name: 归档(archive)
 */
get_header();
?>
		<div id="content" class="clear">
			<div id="main" class="left">
			<?php if(have_posts()):?>
			<?php while(have_posts()):?>
			<?php the_post();?>
			<article id="post-<?php the_ID();?>" class="clear">
			 <section class="postinfo left extracolum">
			 	<div class="post_time icon">
			 	<?php the_time('Y年m月j日<b\r /> g:i a'); ?>
			 	</div><!--end of post_time-->
			 	<ul class="postmeta opaque_5">
			 	<?php if(comments_open()) : ?>
			 		<li><a class="comment_post comment_on icon" rel="nofollow" href="<?php the_permalink();?>#respond" title="发表你的评论">发表你的评论 <?php comments_number('( 0 )','( 1 )','( % )'); ?></a></li>
			<?php else:?>
					<li><a class="comment_off icon" rel="nofollow" title="评论已关闭">评论已关闭 <?php comments_number('( 0 )','( 1 )','( % )'); ?></a></li>
			<?php endif; ?>
			 		<li><a href="#" class="share icon">分享到</a>
			 		<ul class="opaque_10 share_to">
			 			<li><a href="#" class="icon ishare me_tsina">新浪微博</a></li>
			 			<li><a href="#" class="icon ishare me_tqq">腾讯微博</a></li>
			 			<li><a href="#" class="icon ishare me_renren">人人网</a></li>
			 			<li><a href="#" class="icon ishare me_qzone">QQ空间</a></li>
			 			<li><a href="#" class="icon ishare me_douban">豆瓣</a></li>
			 			<li><a href="#" class="icon ishare me_kaixin">开心网</a></li>
			 			<li><a href="#" class="icon ishare me_twitter">Twitter</a></li>
			 			<li><a href="#" class="icon ishare me_facebook">Facebook</a></li>
			 		</ul>
			 		</li>
			 		<li><a href="#" class="subscribe icon"> 订 阅</a>
			 			<ul class="opaque_10 subscribe_to">
			 				<li><a target="_blank" rel="nofollow" title="订阅到Google阅读器" href="http://fusion.google.com/add?feedurl=<?php bloginfo('rss2_url');?>" class="icon me_greader">GReader</a></li>
			 				<li><a target="_blank" rel="nofollow" title="订阅到鲜果" href="http://www.xianguo.com/subscribe.php?url=<?php bloginfo('rss2_url');?>" class="icon me_xianguo">鲜果</a></li>
			 				<li><a target="_blank" rel="nofollow" title="订阅到抓虾" href="http://www.zhuaxia.com/add_channel.php?url=<?php bloginfo('rss2_url');?>" class="icon me_zhuaxia">抓虾</a></li>
			 				<li><a target="_blank" rel="nofollow" title="订阅到yahoo"href="http://add.my.yahoo.com/rss?url=<?php bloginfo('rss2_url');?>" class="icon me_yahoo">Yahoo!</a></li>
			 				<li class="icon subrcomment"><?php comments_rss_link('订阅本文评论'); ?></li>
			 			</ul>
			 		</li>
			 		<li><a href="<?php trackback_url(); ?>" class="trackback icon">引用通告地址</a></li>
			 		<li><a href="<?php the_permalink();?>" class="permalink icon">文章链接</a></li>
			 		<?php edit_post_link(__('Edit'), '<li class="edit_post icon">', '</li>'); ?>
			 	</ul><!--end of postmeta-->
			 </section><!--end of postinfo-->
			 <section class="postcontent maincolum left ver_side">
			 <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			 <div class="post_content">	<?php the_content();?>
			 <a id="expand_collapse" href="#">全部展开/收缩</a>
			<div id="archives">
				<?php archives_list_SHe(); ?>
			</div> 	
			</div>
		<div class="hor_side"></div>
			 </section><!--end of postcontent-->
			<?php endwhile;?>
			<div class="left extracolum opaque_5">
				<ul class="postmeta opaque_5">
			<?php if(comments_open()) : ?><li><a class="comment_post comment_on icon" rel="nofollow" href="<?php the_permalink();?>#respond" title="发表你的评论">发表你的评论</a></li>
			<?php else:?>
			<li><a class="comment_off icon" rel="nofollow" title="评论已关闭">评论已关闭</a></li>
			<?php endif; ?>
			 </ul><!--end of commentstate-->
			 </div>  
			 <section class="left ver_side maincolum">
<?php comments_template();?> 
			 </section><!--end of comment-->	 		 	 
			 <?php else:?>
 Not Found!
			<?php endif;?>
			</article><!--end of post-<?php the_ID();?>-->
			</div><!--end of main-->
<?php get_sidebar();?>
		</div><!--end of content-->
<?php
function callback($buffer)
{
  $append_js=<<<EOT
	<script type="text/javascript">
		/* <![CDATA[ */
	jQuery(document).ready(function() {
	$('#expand_collapse,.archives-yearmonth').css({
		cursor: "s-resize"
	});
	$('#archives ul li ul.archives-monthlisting').hide();
	$('#archives ul li ul.archives-monthlisting:first').show();
	$('#archives ul li span.archives-yearmonth').click(function() {
		$(this).next().slideToggle('fast');
		return false;
	});
	//以下下是全局的操作
	$('#expand_collapse').toggle(
	function() {
		$('#archives ul li ul.archives-monthlisting').slideDown('fast');
	},
	function() {
		$('#archives ul li ul.archives-monthlisting').slideUp('fast');
	});
});
		/* ]]> */
	</script>
EOT;
//$buffer=ob_get_contents();
$buffer=str_replace('</body>',$append_js.'</body>',$buffer);
  return $buffer;
}
ob_start("callback");
get_footer();
ob_end_flush();
?>
