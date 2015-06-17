<?php
if(empty($_SESSION)){
   session_start();
}
//encoding to utf-8
header("Content-type:text/html; charset=UTF-8");
//for path directory
define("APP_WEBROOT", "detoxthai_lte/");
//Session Prefix
define('SESSIONPREFIX' , "dtt_");

/*set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

try {
    include_once '_connection/db_base.php';
} catch (ErrorException $e) {
    include_once '../_connection/db_base.php';
}*/

include_once '../_connection/db_base.php';

if (empty($_SESSION['dtt_puser_id']) && empty($_SESSION['dtt_puser_username'])) {
    $sql = "SELECT * FROM puser";

    isset($_COOKIE['detoxthai']) ? $detoxthai = $_COOKIE['detoxthai'] :  $detoxthai = '';

    $res = $mysqli->query($sql)or die('[' . $mysqli->error . ']');
    while($dbarr = $res->fetch_assoc()) {
    	if($detoxthai == md5($dbarr['id'].'codeerrorDev444')){
    		$_SESSION[SESSIONPREFIX.'puser_id'] = $dbarr['id'];
	        $_SESSION[SESSIONPREFIX.'puser_username'] = $dbarr['username'];
	        $_SESSION[SESSIONPREFIX.'puser_fname'] = $dbarr['fname'];
	        $_SESSION[SESSIONPREFIX.'puser_lname'] = $dbarr['lname'];
	        $_SESSION[SESSIONPREFIX.'puser_tel'] = $dbarr['tel'];
	        $_SESSION[SESSIONPREFIX.'puser_status'] = $dbarr['status'];
	        $_SESSION[SESSIONPREFIX.'puser_create_date'] = $dbarr['createdate'];

    		//echo '<meta http-equiv="refresh" content="1;URL='.'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT.'index.php">';

    	}
    }
}

//check login
function chk_login(){
	if(empty($_SESSION['dtt_puser_id']) && empty($_SESSION['dtt_puser_username'])){
		echo '<meta http-equiv="refresh" content="1;URL='.'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT.'login.php">';
		unset($arr_file);
		exit('Redirect to login page!');
	} else {
		/** Set cookie. */
		//if (!isset($detoxthai)) {
		  $domain='detoxthai.org';
		  setcookie("detoxthai", md5($_SESSION[SESSIONPREFIX.'puser_id'].'codeerrorDev444'), time() + (86400 * 30), '/', $domain, false);
		//}
	}
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
