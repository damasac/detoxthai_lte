<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>
<?php include_once "_connection/db_base.php"; ?>

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
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
	      <input type="hidden" name="returnurl" value="<?php echo $_SERVER['HTTP_REFERER'];?>">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->

        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  </section><!-- /.content -->'

<?php eb();?>
<?php sb('js_and_css_footer');?>
<?php eb();?>

<?php render($MasterPage);?>
