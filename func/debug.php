<?php
/**
 * debug
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * Required Version:
 * 	PHP5 or higher
 * 	WordPress 2.9 or higher
 *
 * If you find my work useful and you want to encourage the development of more free resources,
 * you can do it by donating...
 * 	paypal: yinheli@gmail.com
 * 	alipay: yinheli@gmail.com
 *
 * @author yinheli <yinheli@gmail.com>
 * @link http://philna.com/
 * @copyright Copyright (C) 2009 yinheli All rights reserved.
 * @license PhilNa2 is released under the GPL.
 * @version $Id$
 */
 
 
//funcitons.php文件中定义:  define('SAYME_DEBUG', true);

if(defined('SAYME_DEBUG') && constant('SAYME_DEBUG')){
	set_error_handler('iSaymeErrorHandler', E_ALL);
	$GLOBALS['iSaymePHPErrorMessage'] = array();
}


/**
 * @param int $errno contains the level of the error raised, as an integer.
 * @param string $errstr contains the error message, as a string.
 * @param string $errfile which contains the filename that the error was raised in, as a string.
 * @param int $errline contains the line number the error was raised at, as an integer.
 * @param array $errcontext which is an array that points to the active symbol table at the point the error occurred...
 * @return unknown_type
 */
function iSaymeErrorHandler($errno, $errstr, $errfile, $errline, $errcontext){

	static $id = 1;
	if(!is_user_logged_in()){
		return;
	}

	switch($errno){
		case E_WARNING : case E_USER_WARNING :
			$type = 'Warning';
			break;
		case E_NOTICE : case E_USER_NOTICE :
			$type = 'Notice';
			break;
		default :
			$type = 'Error';
			break;
	}
	$GLOBALS['iSaymePHPErrorMessage'][] = 'ID: '.$id.' '.$type.': '.$errfile.' line: '.$errline.' '.$errstr;
	$id++;
	return;
}

//echo E_NOTICE;

function iSaymeDisplayPHPErrorMessage(){

	if(is_bot()) return;

	if(isset($GLOBALS['iSaymePHPErrorMessage']) && $GLOBALS['iSaymePHPErrorMessage']){
		echo '<div style="margin: 0 auto; width: 898px"><h3>PHP errors on this blog</h3><ul>';
		foreach($GLOBALS['iSaymePHPErrorMessage'] as $message){
			echo '<li>', $message, '</li>';
		}
		echo '</ul></div>';
	}

}
add_action('wp_footer', 'iSaymeDisplayPHPErrorMessage', 0);

//trigger_error('test');


/**
 * for local test
 * @param unknown_type $avatar
 * @return unknown_type
 */
function philnaPhoto($avatar){
	preg_match("/src='(.*?)'/i", $avatar, $matches);
	$avatarFileUrl = isset($matches[1]) ? $matches[1] : '';
	$localFileUrl = 'http://localhost/css/images/avatar.jpg';
	return str_replace($avatarFileUrl, $localFileUrl, $avatar);
}
//add_filter('get_avatar', 'philnaPhoto', 100);
