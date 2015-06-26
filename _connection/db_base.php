<?php
if(empty($_SESSION)){
   session_start();
}

## System Start ############################################################
$mysqli = new mysqli("localhost", "root", "", "detoxthai");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$mysqli ->set_charset("utf8");
############################################################################



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
            $_SESSION[SESSIONPREFIX.'puser_first_login'] = $dbarr['isFristLogin'];
            $_SESSION[SESSIONPREFIX.'puser_image'] = $dbarr['image'];
            $_SESSION[SESSIONPREFIX.'puser_nickname'] = $dbarr['nickname'];
    		//echo '<meta http-equiv="refresh" content="1;URL='.'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT.'index.php">';

    	}
    }
}
?>
