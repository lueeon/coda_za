<?php
if ( function_exists('register_nav_menus') ) {
	register_nav_menus(array('primary' => '头部导航栏'));
}
//define('SAYME_DEBUG', true);
define('SAYME','iSayme');
define('FUNC',TEMPLATEPATH.'/func');
define('CUSTOMFUNC',TEMPLATEPATH.'/custom-func');
/**
 * include all PHP script
 * @param string $dir
 * @return unknown_type
 */
function iSaymeIncludeAll($dir){
	$dir = realpath($dir);
	if($dir){
		$files = scandir($dir);
		sort($files);
		foreach($files as $file){
			if($file == '.' || $file == '..'){
				continue;
			}elseif(preg_match('/\.php$/i', $file)){
				include_once $dir.'/'.$file;
			}
		}
	}
}
iSaymeIncludeAll( FUNC );
iSaymeIncludeAll( CUSTOMFUNC );

include_once TEMPLATEPATH.'/admin/admin.php';
define('CODA_ZA_OPTIONS', 'coda_za');
$GLOBALS['coda_za'] = Coda_ZaOptions::getInstance();


function custom_smilies_src($src, $img){
    return get_bloginfo('template_directory').'/images/smilies/' . $img;
}
add_filter('smilies_src', 'custom_smilies_src', 10, 2); 
if ( !isset( $wpsmiliestrans ) ) {
$wpsmiliestrans = array(
	':no:'		=> '1.gif',
	':evil:'	=> '2.gif',
	':eat:'		=> '3.gif',
	':grin:'	=> '4.gif',
	':???:'		=> '5.gif',
	':han:'		=> '6.gif',
	':shock:'	=> '7.gif',
	':jiong:'	=> '8.gif',
	':idea:'	=> '9.gif',
	':cool:'	=> '10.gif',
	':mrgreen:'	=> '11.gif',
	':sex:'		=> '13.gif',
	':cold:'	=> '14.gif',
	//':sigh:'	=> '15.gif',
	':arrow:'	=> '16.gif',
	':razz:'	=> '17.gif',
	':eek:'		=> '18.gif',
	//':twisted:'	=> '19.gif',
	':love:'	=> '20.gif',
	':roll:'	=> '21.gif',
	':shut:'	=> '23.gif',
	':lol:'		=> '24.gif',
	//':oops:'	=> '25.gif',
	':surprise:'	=> '26.gif',
	':mask:'	=> '27.gif',
	':cry:'		=> '28.gif',
	//':zzz:'		=> '29.gif',
	':sad:'		=> '30.gif',
	':mad:'		=> '31.gif',
	':ool:'		=> '32.gif',
	':smile:'	=> '33.gif',
		);
	}
//禁用半角符号自动转换为全角
foreach(array('comment_text','the_content','the_excerpt','the_title') as $xx)
  remove_filter($xx,'wptexturize');

