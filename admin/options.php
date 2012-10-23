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
	<table class="form-table">
	<tbody>
		<tr valign="top" style="border-bottom: 2px solid #fff;">
			<th scope="row"><h5>Meta</h5><em>仅对首页有效</em></th>
			<td class="form-field">
				关键字
				<label for="keywords">( 每个关键字用逗号隔开)</label><br/>
				<input type="text" name="keywords" id="keywords" class="code" value="<?php echo($saved_options['keywords']); ?>"><br/>
				描述
				<label for="description">( 您博客的主要描述 )</label><br/>
				<input type="text" name="description" id="description" class="code" value="<?php echo($saved_options['description']); ?>">
			</td>
		</tr>
		<tr valign="top" style="border-bottom: 2px solid #fff;">
			<th scope="row"><h5>首页文章截断长度</h5>(普通首页模板有效)</th>
			<td class="form-field">
				<label for="excerpt_length">默认为220,请根据自己的需要进行调整(手动加More标签时无效,显示more标签之前的内容)</label><br/>
				<input type="text" name="excerpt_length" id="excerpt_length" class="code" value="<?php echo($saved_options['excerpt_length']); ?>">
			</td>
		</tr>
		<tr valign="top" style="border-bottom: 2px solid #fff;">
			<th scope="row"><h5>Gavatar</h5></th>
			<td>
				<input id="cacheavatar" name="cacheavatar" type="checkbox" value="checkbox" <?php if($saved_options['cacheavatar']) echo "checked='checked'"; ?> />
				<label for="cacheavatar">开启Gavatar头像缓存.</label><br/>
				如需使用头像缓存,请先在wp-content目录建立avatar文件夹,并设置此文件夹权限为777,文件夹中放置一张default.jpg.
			</td>
		</tr>		
		
		<tr valign="top" style="border-bottom: 2px solid #fff;">
			<th scope="row"><h5>个性首页模板</h5></th>
			<td><input id="special_homepage" name="special_homepage" type="checkbox" value="checkbox" <?php echo $saved_options['special_homepage'] ? 'checked="checked"': '';?>/>
				<label for="special_homepage">使用个性首页模板</label><br />
			<strong>个性首页图片</strong>(上面选中的情况下有效)<br /><select name="special_img"><?php echo iSaymeImage('option'); ?></select><br />
			<label>选择一张489X525左右的图片.你也可以上传你的图片到<code>themes\coda_za\images\special</code> :)<br/>
				</label>
			</td>
		</tr>
		<tr valign="top" style="border-bottom: 2px solid #fff;">
			<th scope="row"><h5>Google统计代码</h5></th>
			<td><input id="enable_google_analytics" name="enable_google_analytics" type="checkbox" value="checkbox" <?php echo $saved_options['enable_google_analytics'] ? "checked='checked'" : '';?>/>
				<label for="enable_google_analytics">开启Google统计代码</label>
				<p>
				   <textarea name="google_analytics_code" rows="6" cols="50" class="large-text"><?php echo $saved_options['google_analytics_code']; ?></textarea>
				</p>
				<input id="exclude_admin_analytics" name="exclude_admin_analytics" type="checkbox" value="checkbox" <?php echo $saved_options['exclude_admin_analytics'] ? "checked='checked'" : '';?>/>
				<label for="exclude_admin_analytics">( 管理员登录时不统计 )</label>
			</td>
		</tr>
		<tr valign="top" style="border-bottom: 2px solid #fff;">
			<th scope="row"><h5>版权信息设置</h5></th>
			<td>
				<label>
				<input name="rss_additional_show" type="checkbox" value="checkbox" <?php if($saved_options['rss_additional_show']) echo "checked='checked'"; ?> />
				添加自定义文字到 文章和RSS 输出中.比如版权信息等.
				</label>
				<br/>
				<label for="rss_copyright">
				在下面填写自定义信息(支持HTML代码).
				</label>
				<br/>
				<textarea name="rss_additional" cols="50" rows="5" style="width:98%;font-size:12px;"><?php echo $saved_options['rss_additional']; ?></textarea>
				<div class="info">
					<p>你可以在您的代码中使用下面这些占位符:<br />
						%BLOG_LINK% - 博客地址<br />
						%FEED_URL% - RSS订阅地址<br />
						%POST_URL% - 文章固定链接<br />
						%POST_TITLE% - 文章标题<br />
					</p>
					<p>例如：本文链接地址：&lt;a href="%POST_URL%">%POST_TITLE%&lt;/a><br />
					欢迎&lt;a href="%FEED_URL%">订阅我们&lt;/a> 来阅读更多有趣的文章。</p>
					<p>输出结果将被包围在一个DIV元素中</p>
				</div>
			</td>
		</tr>
		<tr valign="top" style="border-bottom: 2px solid #fff;">
		   <th scope="row"><h5>社交/微博地址</h5>显示在关于页面,没有可以空着<br/>不要忘记http://</th>
		     <td class="form-field">
			<label for="me_tsina">新浪微博</label><br />
			<input type="text" name="me_tsina" id="me_tsina" class="code" value="<?php echo($saved_options['me_tsina']); ?>" /><br />
			<label for="me_tqq">腾讯微博</label><br />
			<input type="text" name="me_tqq" id="me_tqq" class="code" value="<?php echo($saved_options['me_tqq']); ?>" /><br />
			<label for="me_qzone">QQ空间</label><br />
			<input type="text" name="me_qzone" id="me_qzone" class="code" value="<?php echo($saved_options['me_qzone']); ?>" /><br />
			<label for="me_renren">人人网</label><br />
			<input type="text" name="me_renren" id="me_renren" class="code" value="<?php echo($saved_options['me_renren']); ?>" /><br />
			<label for="me_douban">豆瓣网</label><br />
			<input type="text" name="me_douban" id="me_douban" class="code" value="<?php echo($saved_options['me_douban']); ?>" /><br />
			<label for="me_kaixin">开心网</label><br />
			<input type="text" name="me_kaixin" id="me_kaixin" class="code" value="<?php echo($saved_options['me_kaixin']); ?>" /><br />
			<label for="me_twitter">Twitter</label><br />
			<input type="text" name="me_twitter" id="me_twitter" class="code" value="<?php echo($saved_options['me_twitter']); ?>" /><br />
			<label for="me_facebook">Facebook</label><br />
			<input type="text" name="me_facebook" id="me_facebook" class="code" value="<?php echo($saved_options['me_facebook']); ?>" /><br />
			<label for="me_googleplus">Google+</label><br />
			<input type="text" name="me_googleplus" id="me_googleplus" class="code" value="<?php echo($saved_options['me_googleplus']); ?>" /><br />
			<label for="me_netease">网易微博</label><br />
			<input type="text" name="me_netease" id="me_netease" class="code" value="<?php echo($saved_options['me_netease']); ?>" /><br />
			<label for="me_sohu">搜狐微博</label><br />
			<input type="text" name="me_sohu" id="me_sohu" class="code" value="<?php echo($saved_options['me_sohu']); ?>" /><br />
			<label for="me_digu">嘀咕</label><br />
			<input type="text" name="me_digu" id="me_digu" class="code" value="<?php echo($saved_options['me_digu']); ?>" /><br />
			<label for="me_fanfou">饭否</label><br />
			<input type="text" name="me_fanfou" id="me_fanfou" class="code" value="<?php echo($saved_options['me_fanfou']); ?>" /><br />
	
		     </td>
		</tr>
	</tbody>
	</table>
	<p class="submit">
		<input class="button-primary" type="submit" value="保存修改" name="Submit"/>
		<input class="button-primary" type="submit" value="恢复默认设置" name="Restore"/>
	</p>
	</form>
</div>
