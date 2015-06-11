<?php
if(!isset($_SESSION)){
   session_start();
}
//encoding to utf-8
header("Content-type:text/html; charset=UTF-8");
//for path directory
define("APP_WEBROOT", "detoxthai_lte/");
//Session Prefix
define('SESSIONPREFIX' , "dtt_");
//check login
$arr_file = array("login.php", "index.php", "home.php");
if(empty($_SESSION['dtt_puser_id']) && empty($_SESSION['dtt_puser_username']) && !in_array(basename($_SERVER["SCRIPT_FILENAME"]), $arr_file)){
	echo '<meta http-equiv="refresh" content="1;URL='.'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT.'login.php">';
	unset($arr_file);
	exit('Redirect to login page!');
}

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
