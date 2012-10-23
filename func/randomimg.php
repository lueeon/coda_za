<?php
/**
 * head background image
 * @param unknown_type $format
 * @return unknown_type
 */
function iSaymeImage($format = ''){
	// the option form db
	$opt = $GLOBALS['coda_za']['special_img'];
	$opt = $opt ? $opt : 'default.jpg';

	if($format !== 'option' && $opt !== 'random'){
		return $opt;
	}

	$imagesDir = TEMPLATEPATH.'/images/special';

	// get all images
	$allImages = scandir($imagesDir);
	foreach($allImages as $key=>$name){
		if(!preg_match('/[\.]gif$|png$|jpg$|jpeg$/i', $name)){
			unset($allImages[$key]);
		}
	}
	unset($key, $name);

	if(empty($allImages)){
		return;
	}

	sort($allImages);

	// for css random
	if($opt == 'random' && $format !== 'option'){
		return count($allImages)>1 ? $allImages[ mt_rand(0, count($allImages) - 1) ] : 'default.jpg';
	}

	// for admin select
	$out = '';

	foreach($allImages as $file){
		$selected = $file == $opt ? ' selected="selected"' : '';
		$out .= '<option value="'.$file.'"'.$selected.'>'.$file.'</option>';
	}

	// add a random select
	$selected = $opt == 'random' ? ' selected="selected"' : '';
	$out .='<option value="random"'.$selected.'>随机图片</option>';
	unset($allImages, $file, $selected);
	return $out;
}

/**
 * add css style for #header
 * @return unknown_type
 */
function iSaymeSpecialImage(){
if(!$GLOBALS['coda_za']['special_homepage']||!is_home()) return;
	$img = get_bloginfo('template_directory') . '/images/special/' . iSaymeImage();
	$style = <<<EOF
<style type="text/css">
#sitemap {background: url($img) no-repeat;}
</style>\n
EOF;
	echo $style;
}
add_action('wp_head', 'iSaymeSpecialImage');
/*
<tr valign="top" style="border-bottom: 2px solid #fff;">
			<th scope="row"><?php _e('<h5>Header background image</h5>',YHL); ? ></th>
			<td>
				<label><?php _e('Select an Image (at least size 920 px by 145 px .You can upload more files to <code>themes\philna2\images\headers</code> :)',YHL); ? ><br/>
				<select name="headimg"><?php echo philnaHeadImage('option'); ? ></select>
				</label><br/>
			</td>
		</tr>
*/
