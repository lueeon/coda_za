<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/global.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style-home.css" type="text/css" media="screen" />
<?php wp_head();?>
</head>
<body id="home">
	<div id="sitemap">
		<div id="maptitle">
		<h1><a href="<?php bloginfo('url');?>"><?php bloginfo('name');?></a></h1>
		<h3><?php bloginfo('description');?></h3>
		</div><!--end of maptitle-->
		<div id="mapcontent">
			<div id="mapmenu" class="clear">
			<ul>
		<?php wp_list_pages('title_li=0&sort_column=menu_order&exclude=149'); ?>
		</ul>
			</div><!--end of mapmenu-->
			<div id="mappost">	
		<?php 	
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
    		// 控制只显示10篇文章，如果将10改成-1将显示所有文章
    		'showposts' => 12,
    		'paged' => $paged
			);
		query_posts($args);
		if(have_posts()):?>
		<span class="newposts">最新文章</span>
		<table id="highlight">
		<tbody>
		<?php while(have_posts()):?>
		<?php the_post();?>
		<tr>
		<td class="title"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></td>
		<td class="section"><?php comments_popup_link('没有评论', '1 条评论', '% 条评论');?></td>
		<td class="date"><?php the_time('Y-m-d'); ?></td> 
		</tr>
		<?php endwhile;?>
		</tbody> 
      		</table>
      		<div id="mapnavi" class="clear">
			<span class="left"><?php previous_posts_link(__('上一页')); ?></span>
			<span class="right"><?php next_posts_link(__('下一页')); ?></span>
		</div>
      		<?php else:?>
      		Not Found!!
		<?php endif;
		wp_reset_query();?>
			</div><!--end of mappost-->
		</div><!--end of mapcontent-->
		<div id="mapfooter">
		<span class="author">Powered by Wordpress | Copyright &copy; 2011-2013 <?php bloginfo('name');?><sup>&reg;</sup>  | Theme Coda_Za coded By <a href="http://isayme.com">iSayme</a></span> 
<!--<?php _e('页面加载: '); echo get_num_queries(), 'queries.'; ?> <?php timer_stop(1); ?> seconds.-->
		</div><!--end of mapfooter-->
	</div><!--end of sitemap-->
</body>
</html>
