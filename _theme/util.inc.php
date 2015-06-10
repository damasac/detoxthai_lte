<?php
if(!isset($_SESSION)){
   session_start();
}
//encoding to utf-8
header("Content-type:text/html; charset=UTF-8");
//for path directory
define("APP_WEBROOT", "/detoxthai_lte/");
//Session Prefix
define('SESSIONPREFIX' , "dtt_");
//check login
/*
if(!$_SESSION['tpc_puser_id'] && !$_SESSION['tpc_puser_status'] && !$_SESSION['tpc_puser_area'] && !$_SESSION['tpc_puser_site']){
	echo '<meta http-equiv="refresh" content="1;URL='.'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT.'">';
	exit('Redirect to login page!');
}
*/

$_vars = array();
function sb($name){
	static $sName;
	if (empty($name)) return $sName;
	$sName = $name;
	ob_start();
}
function eb(){
	global $_vars;
	$name = sb(0);
	$_vars[$name] = ob_get_clean();
}
function render($name){
	global $_vars;
	ob_start();
	include_once ($name);
	$page = ob_get_clean();
	foreach($_vars as $name=>$var)
	$page = str_replace('{$'.$name.'}',$var,$page);
	echo $page;
}
 ob_end_flush();
