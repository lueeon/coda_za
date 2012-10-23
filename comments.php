<?php
if( post_password_required() ):
?>
<div>
	<?php _e('This post is password protected. Enter the password to view comments.');?>
</div>
<?php return; endif;?>
<h3 id="commentcount" class="hor_side">评论</h3>
<ol id="comments" class="clear">
<?php if( have_comments() ):?>
<?php wp_list_comments(array( 'callback' => 'coda_za_comment'));//array( 'callback' => 'fakeblogger_comment')?>
<?php else:?>
	<?php //_e('No comments yet.'); ?>
<?php endif; ?>
</ol>
<?php if(comments_open()):?>
<div id="ajaxbox" class="hor_side">
<p class="ajaxloading">评论提交中,请稍候......</p>
</div>
<?php endif; ?>
<?php
if (get_option('page_comments')):
	$comment_pages = paginate_comments_links('echo=0');
	if ($comment_pages):
?>
<!--comments pages-->
<div id="commentnavi" class="page hor_side">
	<span class="pages">评论分页:</span>
	<span id="cpager"><?php echo $comment_pages; ?></span>
</div>
<?php
	endif;
endif;
?>
<?php  if(comments_open()) : ?>
<div id="respond">
<form action="<?php echo get_option('siteurl');?>/wp-comments-post.php" method="post" id="commentform">
<div  id="commenter_info"> 
<?php if ($user_ID):?>
<p>Logged in as <a href="<?php echo get_option('siteurl');?>/wp-admin/profile.php"><?php echo $user_identity;?></a>. <a href="<?php echo get_option('siteurl');?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a>
</p>
<?php else:?>
<p>请填写你的 E-mail 地址, 它不会被公开.</p> 
	<fieldset> 
		<label for="author">姓名 <?php if ($req) echo "(*)";?></label> 
		<input <?php if ($req) echo "required=\"required\"";?> id="author" size="22" type="text" name="author" value="<?php echo $comment_author;?>" placeholder="Your Name Here" /> 
		<label for="email">E-mail 地址 <?php if ($req) echo "(*)";?></label> 
		<input <?php if ($req) echo "required=\"required\"";?> id="email" size="22" type="email" name="email" value="<?php echo $comment_author_email;?>"  placeholder="Your Email Here" /> 
		<label for="url">个人网站</label> 
		<input id="url" size="22" type="url" name="url" value="<?php echo $comment_author_url;?>" placeholder="Your Website Here (Not required)" /> 
    </fieldset>
<?php endif;?>
</div>
<?php iSaymeSmilies();?>
<fieldset>
    <label for="comment">评论内容 (*)</label> 
    <textarea required="required" id="comment" name="comment" rows="10" cols="30" placeholder="What Do You Want To Say?"></textarea>
</fieldset>
<fieldset> 
<p><input name="submit" class="button" type="submit" id="submit" tabindex="5" value="Submit Comment" />
	<input type="hidden" name="comment_post_ID" value="<?php echo $id;?>" />
</p>
</fieldset> 
<?php //comment_id_fields(); ?>
<?php	do_action('comment_form', $post->ID);?>
</form>
</div>
<?php else:?>
<h3 id="commentcount"><?php _e( 'Comments are closed.'); ?></h3>
<?php endif;?>
