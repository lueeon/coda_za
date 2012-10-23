<?php
/**
 * Output smilies for comment form
 *
 * @return unknown_type
 */
function iSaymeSmilies(){
	global $wpsmiliestrans;
	$path = get_bloginfo('template_directory').'/images/smilies/';
	$output = '';
	$smilies = array_unique($wpsmiliestrans);
	foreach ($smilies as $title=>$smilies){
		$output .= '<a title=" '.$title.' " href="#" rel="nofollow"><img src="'.$path.$smilies.'" alt=""/></a>';
	}
	$output = '<div id="smiles" class="clear"><div id="smiles_list">'.$output.'</div></div>'."\n";
	echo $output;
}
