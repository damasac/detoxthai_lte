<?php
session_start();

header("Content-type:text/html; charset=UTF-8");          
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false);

$user_login = (($_POST['username']));
$pwd_login = sha1(md5($_POST['password']));


if(isset($user_login) and isset($pwd_login)) {
    include_once "../_connection/db_base.php";
    
    $sql="SELECT * FROM puser WHERE username='".$mysqli->real_escape_string($user_login)."' OR email='".$mysqli->real_escape_string($user_login)."';";

    $res = $mysqli->query($sql)or die('[' . $mysqli->error . ']');
	$dbarr = $res->fetch_assoc(); 

	if(empty($_POST['username'])) {
		echo "Error : กรุณากรอกรหัสผู้ใช้งาน";
		exit();
	}
	else if(empty($_POST['password'])) {
		echo "Error : กรุณากรอกรหัสผ่าน";
		exit();
	}
	else if($user_login!=$dbarr['username'] AND $user_login!=$dbarr['email']) {
		echo "Error : ไม่พบ User นี้";
		exit();
	}
	else if($pwd_login!=$dbarr['password']) {
		echo "Error : รหัสผ่านไม่ถูกต้อง";
		exit();
	}
	else if(($user_login==$dbarr['username'] OR $user_login==$dbarr['email']) AND $pwd_login==$dbarr['password']) {
        //-----------------------

        $Ss_prefix = 'tpc_';
	$_SESSION[$Ss_prefix.'puser_id'] = $dbarr['id'];
        $_SESSION[$Ss_prefix.'puser_username'] = $dbarr['username'];
        $_SESSION[$Ss_prefix.'puser_email'] = $dbarr['email'];
        $_SESSION[$Ss_prefix.'puser_status'] = $dbarr['status'];
        $_SESSION[$Ss_prefix.'puser_province'] = $dbarr['province'];
        $_SESSION[$Ss_prefix.'puser_district'] = $dbarr['district'];
        $_SESSION[$Ss_prefix.'puser_hcode'] = $dbarr['hcode'];
        $_SESSION[$Ss_prefix.'puser_amphur'] = $dbarr['amphur'];
        $_SESSION[$Ss_prefix.'puser_area'] = $dbarr['area'];
	$_SESSION[$Ss_prefix."puser_hcodename"] = hospitalname($dbarr["hcode"]);
	$_SESSION[$Ss_prefix."puser_hcodenamecode"] = hospitalname($dbarr["hcode"]) . " ({$dbarr['hcode']})";
        //-----------------------
		echo "success";
	}
$mysqli->close();
}

?>