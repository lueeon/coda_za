<?php 
if($GLOBALS['coda_za']['special_homepage'] && !is_bot())
	include_once TEMPLATEPATH.'/special_homepage.php';
else include_once TEMPLATEPATH.'/normal_homepage.php';
