<?php include_once "_connection/db_base.php"; ?>
<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>

<?php
require 'facebooksdk/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '418140078352087',
  'secret' => 'a09e48c084788e337b7092e46f7cd057',
));

/** Define value. */
$user_profile = '';

// Get User ID
$user = $facebook->getUser();

if ($user) {
  try {
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}
print_r($user_profile);
// Save to mysql
if ($user) {
	if($_GET["code"] != "")
	{
				$objConnect = mysql_connect("mysql","webmaster","xpctc2004x");
				$objDB = mysql_select_db("detoxthai_lte");
				mysql_query("SET NAMES UTF8");
				$strSQL ="  INSERT INTO  tb_facebook (FACEBOOK_ID,NAME,LINK,CREATE_DATE)
					VALUES
					('".trim($user_profile["id"])."',
					'".trim($user_profile["name"])."',
					'".trim($user_profile["link"])."',
					'".trim(date("Y-m-d H:i:s"))."')";
				$objQuery  = mysql_query($strSQL);
				mysql_close();
				header("location:index.php");
				exit();
	}
}

?>

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '418140078352087',
    cookie     : true,  // enable cookies to allow the server to access
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>

<!-- Content Header (Page header) -->
  <section class="content-header">

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Login</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="login-box">
      <div class="login-logo">
        <a href="../index2.html"><b>Detox</b>Thailand</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">
<?php
  $errmsg = "";
  if (isset($_GET['s'])) {
    $errmsg = $_GET['errmsg'];
  }
  if ($errmsg != "") {
?>
  <i class="fa fa-circle-o text-yellow"></i> <span><?php echo $errmsg;?></span>
<?php
  }

  $seeesion_name = "";
  $seeesion_value = "";
  $prefix = "";

  if (isset($Ss_prefix)) {
    $prefix = $Ss_prefix;
  }

  $session_name = $prefix.'input_username';
  if (isset($_SESSION[$session_name])){
    if ($_SESSION[$session_name] != NULL){
      $session_value = $_SESSION[$session_name];
    }
  }
?>
	</p>
        <form action="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>chk-login.php" method="post">
          <div class="form-group has-feedback">
            <input type="username" name="username" value="<?php echo $seeesion_value;?>" class="form-control" placeholder="เบอร์โทรศัพท์"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> จดจำฉันไว้ในคราวต่อไป
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
	      <input type="hidden" name="returnurl" value="<?php echo $_SERVER['HTTP_REFERER'];?>">
              <button type="submit" class="btn btn-primary btn-block btn-flat">เข้าใช้งาน</button>
            </div><!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- หรือ -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> เข้าใช้งานโดยใช้ เฟซบุ๊ค</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> เข้าใช้งานโดยใช้  Google+</a>
        </div><!-- /.social-auth-links -->

        <a href="#">ลืมรหัสผ่าน</a><br>
        <a href="register.html" class="text-center">สมัครสมาชิกใหม่</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  </section><!-- /.content -->'

<?php eb();?>
<?php sb('js_and_css_footer');?>
<?php eb();?>

<?php render($MasterPage);?>
