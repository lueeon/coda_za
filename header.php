<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php iSaymeDocumentTitle();?></title>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/global.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php wp_head(); ?>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body id="blog">
	<div id="wrap">
		<header>
			<h2 id="logo"><a href="<?php bloginfo('url');?>"><?php bloginfo('name');?></a></h2>
			<nav>
				<ul class="menu clear">
		<li><a href="<?php bloginfo('url');?>">首页</a></li>
		<?php wp_list_pages('title_li=0&sort_column=menu_order&exclude=149'); ?>
				</ul>
			</nav><!--end of menu-->
		<?php //wp_nav_menu(array('theme_location'=>'primary','container_class' => 'menu')); ?>
		
			<div id="dash" class="clear">
				<div class="right"><?php bloginfo('description');?></div>
				<div>
				<p class="icon post_subr"><a href="<?php bloginfo('rss2_url');?>">订阅博客文章</a> 或 <a href="<?php bloginfo('comments_rss2_url'); ?>">订阅最新评论</a></p>
				<?php if($GLOBALS['coda_za']['me_tsina']):?>
				<p class="icon me_tsina"><a target="_blank" href="<?php echo $GLOBALS['coda_za']['me_tsina'] ?>" rel="external">看看我的新浪微博</a></p>
				<?php else:?>
				<p>&nbsp;</p>
				<?php endif;?>
				</div>
			</div><!--end of dash-->
		</header><!--end of header-->
