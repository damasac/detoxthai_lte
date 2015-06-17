<?php
session_start();

header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
?>

<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>
<?php
$user_login = (($_POST['username']));
$pwd_login = sha1(md5($_POST['password']));

$returnurl=$_POST['returnurl'];
if ($returnurl=="") $returnurl=$_GET['returnurl'];
if ($returnurl=="") $returnurl='http://'.$_SERVER['SERVER_NAME'].'/'.APP_WEBROOT


$_SESSION[SESSIONPREFIX.'input_username']=$user_login;

if (isset($user_login) and isset($pwd_login)) {
    include_once "_connection/db_base.php";

    $sql="SELECT * FROM puser WHERE tel='".$mysqli->real_escape_string($user_login)."' OR username='".$mysqli->real_escape_string($user_login)."' OR email='".$mysqli->real_escape_string($user_login)."';";

    $res = $mysqli->query($sql)or die('[' . $mysqli->error . ']');
    $dbarr = $res->fetch_assoc();

    if (empty($_POST['username'])) {
        $errmsg="Error : กรุณากรอกรหัสผู้ใช้งาน";
        //exit();
    } else if (empty($_POST['password'])) {
        $errmsg="Error : กรุณากรอกรหัสผ่าน";
        //exit();
    } else if ($user_login!=$dbarr['username'] AND $user_login!=$dbarr['email']) {
        $errmsg="Error : ไม่พบ User นี้";
        //exit();
    } else if ($pwd_login!=$dbarr['password']) {
        $errmsg="Error : รหัสผ่านไม่ถูกต้อง";
        //exit();
    } else if (($user_login==$dbarr['username'] OR $user_login==$dbarr['email']) AND $pwd_login==$dbarr['password']) {
        //-----------------------

        $_SESSION[SESSIONPREFIX.'puser_id'] = $dbarr['id'];
        $_SESSION[SESSIONPREFIX.'puser_username'] = $dbarr['username'];
        $_SESSION[SESSIONPREFIX.'puser_fname'] = $dbarr['fname'];
        $_SESSION[SESSIONPREFIX.'puser_lname'] = $dbarr['lname'];
        $_SESSION[SESSIONPREFIX.'puser_tel'] = $dbarr['tel'];
        $_SESSION[SESSIONPREFIX.'puser_status'] = $dbarr['status'];
        $_SESSION[SESSIONPREFIX.'puser_create_date'] = $dbarr['createdate'];
        $_SESSION[SESSIONPREFIX.'puser_first_login'] = $dbarr['isFristLogin'];
        //-----------------------
        //echo "success";
    }
    $mysqli->close();
}

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="_bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="_plugins/icon-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="_plugins/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="_dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="_dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!--Page Load Progress Bar [ OPTIONAL ]-->
    <link href="_plugins/pace/pace.css" rel="stylesheet">
    <script src="_plugins/pace/pace.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="skin-blue sidebar-mini">

     <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
        <!-- Content Header (Page header) -->
<?php
    if ($_SESSION[SESSIONPREFIX.'puser_id'] != "") {
?>

    <?php if($_SESSION[SESSIONPREFIX."puser_first_login"]==""){?>
        <meta http-equiv="refresh" content="1;URL=userprofile/firstlogin.php">            
    <?php }else{?>
        <meta http-equiv="refresh" content="1;URL=<?php echo $returnurl;?>">
    <?php }?>
<?php
    } else {
?>
        <meta http-equiv="refresh" content="1;URL=login.php?errmsg=<?php echo urlencode($errmsg);?>">
<?php
    }
?>
        <div class="lockscreen-logo">
        <b>Logging in</b></a>
        </div>
        <div align="center"><img src="login/img/loading.gif" width="65" height="65" /><br>

        <!-- /.content -->

    </div><!-- /.center -->


    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="_plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="_bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="_dist/js/app.min.js" type="text/javascript"></script>
     <!-- Slimscroll -->
    <script src="_plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='_plugins/fastclick/fastclick.min.js'></script>

  </body>
</html>
