<aside class="left ver_side">
	<form action="<?php echo get_option('siteurl');?>" id="searchform" method="get"> 
    		<fieldset class="opaque_10"> 
    			<input type="text" value="" class="search icon" name="s" id="s" /> 
    			<input type="submit" id="searchsubmit" class="button" value="搜索" />
    		</fieldset> 
  	</form>
  <div class="hor_side"></div>
  	<?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ): ?>
<div class="widget hor_side">
<?php if(is_singular()):
	Recentposts($limit = 8);
	else :
	Randomposts($limit = 8);
	endif;?>
</div>
<div class="widget hor_side">
		<?php iSaymeRecentcomments('number=5&status=approve');?>
</div>
	<?php endif;//widget 1?>
	
	<?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ): ?>
<div class="widget hor_side">
<?php wp_tag_cloud('unit=px&smallest=11&largest=18&order=RAND&number=30');//参数含义:单位(px),最小(11),最大(18),排序(随机) ?>
</div>
<!-- <div class="widget hor_side">
<ul>
<?php //wp_list_bookmarks('title_before=<h3>&title_after=</h3>&orderby=rand&limit=20'); //如不想随机显示.请去掉 &orderby=rand
		//此处显示的是友情链接,如果只想让某个分类显示,请去后台查看相应的分类ID,然后在orderby=rand的后面添加如下内容 &category= ID 即可 如果还想显示显示的数目,请再添加&limit=数字?>
</ul>
</div>-->
	<?php endif;//widget 2?>
 <div class="widget hor_side">
<ul><li><a href="http://www.weijin520.com/" target="_blank">围巾编织方法</a></li></ul>
</div>
<div class="widget hor_side">
		<h3><span>功能</span></h3>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
		</ul>
</div>
</aside><!--end of sidebar-->
