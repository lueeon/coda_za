<?php
/**
 * Template Name: 关于页面 (about)
 */
get_header();
?>
<style type="text/css">
.postinfo ul.postmeta{padding-left:0;}
.postinfo ul.postmeta li ul li{padding-top:4px;}
</style>
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
			 	<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我还在这里
			 		<ul>
					<?php $arr = array(
						'me_tsina' 	=>	'新浪微博',
						'me_tqq' 	=>	'腾讯微博',
						'me_netease' 	=>	'网易微博',
						'me_sohu' 	=>	'搜狐微博',
						'me_qzone' 	=>	'QQ空间',
						'me_renren' 	=>	'人人网',
						'me_douban' 	=>	'豆瓣网',
						'me_kaixin' 	=>	'开心网',
						'me_twitter' 	=>	'Twitter',
						'me_facebook' 	=>	'Facebook',
						'me_googleplus' =>	'Google+',
						'me_digu' 	=>	'嘀咕',
						'me_fanfou' 	=>	'饭否');
					foreach($arr as $what => $call){
						if($GLOBALS['coda_za'][$what] && $GLOBALS['coda_za'][$what] > "http://" )
						echo '<li><a target="_blank" href="'.$GLOBALS['coda_za'][$what].'" class="icon '.$what.'">'.$call.'</a></li>'."\n";
						} ?>
			 		</ul>
			 	</li>
			 	</ul><!--end of postmeta-->
			 </section><!--end of postinfo-->
			 <section class="postcontent maincolum left ver_side">
			 <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			 <div class="post_content"><?php the_content();?></div>
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
<?php get_footer();?>
