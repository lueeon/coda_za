<?php
function coda_za_comment($comment, $args, $depth){
	$GLOBALS['comment'] = $comment;
	static $commentcount;
	extract($args, EXTR_SKIP);
	if(defined('DOING_AJAX') && !isset($page)){
		$commentcount = get_comments_number($comment->comment_post_ID)-1; // will be increased
	}elseif(!$commentcount){
		if (get_option('page_comments')){
			$page = isset($page) ? $page : 1;
			$commentcount = get_option('comments_per_page') * ($page - 1);
		}else{
			$commentcount = 0;
		}
	}
	++$commentcount; // increase
	?>
<li <?php comment_class();?> id="comment-<?php comment_ID();?>">
<div id="div-comment-<?php comment_ID();?>" class="clear hor_side">
<div class="comment-meta post_time icon"><?php comment_time(__('Y年m月j日<b\r /> g:i a'))?></div>
<div class="comment-author vcard"><cite class="fn"><?php comment_author_link(); ?></cite><span class="says">&nbsp;说道：</span></div>
<div class="avatar right"><?php echo my_avatar($comment->comment_author_email, 30); ?></div>
<div class="reply right"><span class="floor">#<?php echo $commentcount;?></span><a rel="nofollow" class="quote" href="#comment-<?php comment_ID() ?>" title="引用这条评论"><?php _e('Quote'); ?></a> | <a class="replyto" rel="nofollow" href="#comment-<?php comment_ID() ?>" title="回复这条评论"><?php _e('Reply'); ?></a></div>
<div class="comment-content">
<?php if( ! $comment->comment_approved ): ?>
<p><strong>您的评论正在等待审核...</strong></p>
<?php endif; ?>
	<?php comment_text(); ?>
</div>
</div>
<?php
}
  function Coda_ZaGetComment(){
	$id = isset($_GET['id']) ? trim($_GET['id']) : null;
	if(!$id){
		fail(__('Error comment id'));
	}
	$comment = get_comment($id);
	if(!$comment){
		fail(sprintf(__('Whoops! I am sorry I can\'t find the comment width id  %1$s'), $id));
	}
	defined('DOING_AJAX')||define('DOING_AJAX',true);
	defined('SAYMETIP')||define('SAYMETIP',true);
	coda_za_comment($comment,array(),1);
	echo '</li>';
	die();
}
if ( isset( $_GET['AjaxGetComment']) && $_GET['id'] ){
	add_action( 'template_redirect', 'Coda_ZaGetComment' );
}
	
	
/**
 * Filter comment class
 * if doing ajax add class 'tip'
 * @param array $class
 * @return unknown_type
 */
function Coda_ZaCommentClass(array $class){
	if(defined('DOING_AJAX')){
		$class = array_merge($class, array('ajax'));
	}
	if(defined('SAYMETIP')){
		$class = array_merge($class, array('tip'));
	}
	return array_unique($class);
}
add_filter('comment_class', 'Coda_ZaCommentClass');
