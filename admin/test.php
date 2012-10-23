 <style type="text/css">
.wrap{padding:10px; font-size:12px; line-height:24px;width:75%;}
strong{ color:#666}
.wrap textarea{ width:95% !important; margin:0 20px 0 0;  overflow:auto}
.none{display:none;}
fieldset{ border:1px solid #ddd;margin:5px 0 10px;padding:20px 15px 15px;-moz-border-radius:5px;-khtml-border-radius:5px;-webkit-border-radius:5px;border-radius:5px; width:800px}
fieldset fieldset{ width:700px;} 
fieldset:hover{border-color:#bbb;}
fieldset legend{padding:0 5px;color:#777;font-size:14px;font-weight:700;cursor:pointer}
fieldset .line{border-bottom:1px solid #e5e5e5;padding-bottom:15px;}
</style>
<script type="text/javascript">
jQuery(document).ready(function($){  
$(".toggle").click(function(){$(this).next().slideToggle('slow')});
});
</script>
<div class="wrap">
<?php screen_icon(); ?>
	<h2>Coda_Za 选项设置</h2>
<?php
$saved_options = &$GLOBALS['coda_za'];
if(isset($_POST['Submit'])) {
	$this->save($_POST);
?>
	<div id="message" class="updated fade">
		<p><strong>您的修改已经被保存。</strong></p>
	</div>
<?php
} else if(isset($_POST['Restore'])) {
	$this->restore();
?>
	<div id="message" class="updated fade">
		<p><strong>已恢复成默认设置。</strong></p>
	</div>
<?php
}
$saved_options->refresh();
?>
<form action="" method="post" style="background-color: #f1f1f1;">
	<fieldset>
		<legend class="toggle">站点信息设置</legend>
			<div class="none">
				网站首页关键词 ( 多个关键词用英文的逗号隔开 )<br/><label><textarea name="keywords"  rows="1"  id="keywords" ><?php echo($saved_options['keywords']); ?></textarea></label><br/><br/>
				网站首页描述 ( 您博客的主要描述,最好200字以内)<br/><label><textarea name="description" rows="4" id="description" ><?php echo($saved_options['description']); ?></textarea></label><br/><br/>
				Google统计代码<br /><input id="enable_google_analytics" name="enable_google_analytics" type="checkbox" value="checkbox" <?php echo $saved_options['enable_google_analytics'] ? "checked='checked'" : '';?>/>
				<label for="enable_google_analytics">开启Google统计代码</label>
				<p>
					<textarea name="google_analytics_code" rows="6" cols="50" class="large-text"><?php echo $saved_options['google_analytics_code']; ?></textarea>
				</p>
				<input id="exclude_admin_analytics" name="exclude_admin_analytics" type="checkbox" value="checkbox" <?php echo $saved_options['exclude_admin_analytics'] ? "checked='checked'" : '';?>/>
				<label for="exclude_admin_analytics">( 管理员登录时不统计 )</label>
			
			</div>
	
	
	
	</fieldset>



	<p class="submit">
		<input class="button-primary" type="submit" value="保存修改" name="Submit"/>
		<input class="button-primary" type="submit" value="恢复默认设置" name="Restore"/>
	</p>
</form>
