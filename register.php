<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> ศูนย์สุขภาพองค์รวม <?php eb();?>

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
  if ($_GET[errmsg] != "") {
?>
  <i class="fa fa-circle-o text-yellow"></i> <span><?php echo $_GET[errmsg];?></span>
<?php
  }
?>  
	</p>
        <form action="../index.html" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="ชื่อ"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="นามสกุล"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์"/>
            <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="รหัสผ่าน"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="รหัสผ่านอีกครั้ง"/>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> I agree to the <a href="#">terms</a>
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div><!-- /.col -->
          </div>
        </form>        

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
        </div>

        <a href="login.html" class="text-center">I already have a membership</a>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  </section><!-- /.content -->'

<?php eb();?>
<?php sb('js_and_css_footer');?>
<?php eb();?>
 
<?php render($MasterPage);?>