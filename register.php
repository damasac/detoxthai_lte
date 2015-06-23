<?php require_once '_theme/util.inc.php';  $MasterPage = 'page_main.php';?>
<?php
if (isset($_SESSION[SESSIONPREFIX.'puser_id'])) {
  echo '<meta http-equiv="refresh" content="0;URL='.'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT.'">';
}
?>
<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>
<?php sb('notifications');?>
<?php include_once 'notifications.php'; ?>
<?php eb();?>
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
        <a href="index.php"><b>Detox</b>Thai</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
		  <h3>สมัครสมาชิก</h3>
        <p class="login-box-msg">

	</p>
          <div class="form-group has-feedback">
	    <label>ชื่อ</label>
            <input type="text" class="form-control" placeholder="ชื่อ" id="fname" name="fname"/><code id="valFname" style="display:none;"></code>
            <span class="glyphicon glyphicon-user form-control-feedback" ></span>
          </div>
          <div class="form-group has-feedback">
            <label>นามสกุล</label>
	    <input type="email" class="form-control" placeholder="นามสกุล" id="lname" name="lname"/><code id="valLname" style="display:none;"></code>
            <span class="glyphicon glyphicon-user form-control-feedback" ></span>
          </div>
	  <div class="form-group has-feedback">
            <label>อีเมล์</label>
	    <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์" id="email" name="email"
	    />
	    <code id="valEmail" style="display:none;"></code>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label>เบอร์โทรศัพท์</label>
	    <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์" id="tel" name="tel"
	    data-inputmask="'mask': ['9999999999']" data-mask
	    data-toggle="tooltip" data-placement="top" title="ใช้แทน Username ในการเข้าสู่ระบบ"/>
	    <code id="valTel" style="display:none;"></code>
            <span class="glyphicon glyphicon-phone-alt form-control-feedback" ></span>
          </div>
          <div class="form-group has-feedback">
            <label>รหัสผ่าน</label>
	    <input type="password" class="form-control" placeholder="รหัสผ่าน" id="password" name="password"
	    data-toggle="tooltip" data-placement="top" title="กรอกรหัสผ่านตั้งแต่ 6 ตัวขึ้นไป"
	    /><code id="valPassword" style="display:none;"></code>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
           <label>ยืนยันรหัสผ่าน</label>
            <input type="password" class="form-control" placeholder="รหัสผ่านอีกครั้ง" id="password2" name="password2"/><code id="valPassword2" style="display:none;"></code>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-7">    
              
            </div><!-- /.col -->
            <div class="col-xs-5">
              <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="saveUser();">สมัครสมาชิก</button>
            </div><!-- /.col -->
          </div>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
        </div>
        <a href="login.html" class="text-center">I already have a membership</a>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  </section><!-- /.content -->'
  <script>
     function saveUser() {
    //code
    var username = $("#username").val();
    var tel = $("#tel").val();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var password = $("#password").val();
    var password2 = $("#password2").val();
    var email = $("#email").val();
        
    if (fname=="") {
      $("#valFname").show();
      $("#valFname").html("กรุณากรอกชื่อ");
      return ;
    }else{
      $("#valFname").hide();
    }
    if (lname=="") {
      $("#valLname").show();
      $("#valLname").html("กรุณากรอกนามสกุล");
      return ;
    }else{
      $("#valLname").hide();
    }
    if (tel=="") {
      $("#valTel").show();
      $("#valTel").html("กรุณากรอกเบอร์โทรศัพท์");
      return ;
    }else{
      $("#valTel").hide();
    }
    if (password=="") {
      $("#valPassword").show();
      $("#valPassword").html("กรุณากรอกรหัสผ่าน");
      return ;
    }
    else{
      $("#valPassword").hide();
    }
    if (password<6) {
      $("#valPassword").show();
      $("#valPassword").html("กรุณากรอกรหัสผ่าน 6 ตัวขึ้นไป");
      return ;
    }else{
      $("#valPassword").hide();
    }
    if (password2 != password || password2<6) {
      //code
      $("#valPassword2").show();
      $("#valPassword2").html("รหัสผ่านไม่ตรงกัน");
      return ;
    }else{
      $("#valPassword2").hide();
    }

    goAjaxSave(username,password,tel,fname,lname,email);
  }
  function goAjaxSave(username,password,tel,fname,lname,email){
      $.ajax({
		    url: "usermgn/ajax-sql-query.php?task=addUserNormal",
		    type: "post",
		    data: {
                      username:username,
                      password:password,
                      tel:tel,
                      fname:fname,
                      lname:lname,
		      email:email
                      },
		    success: function(data){

                      if ($.trim(data)=="1") {
                        //code
                        $("#valTel").show();
                        $("#valTel").html("เบอร์โทรศัพท์มีอยู่ในระบบแล้วกรุณาตรวจสอบ");
                      }
		     else if ($.trim(data)=="2") {
			//code
			$("#valEmail").show();
			$("#valEmail").html("อีเมล์นี้มีอยู่ในระบบแล้วกรุณาตรวจสอบ");
		      }
                      else{
                        //code
                        location.href="login.php";
                      }

		    },
		    error:function(){
			alert("failure");
		    }
		});
  }
  </script>
<?php eb();?>
<?php sb('js_and_css_footer');?>

<script src="_plugins/input-mask/jquery.inputmask.js"></script>
<script src="_plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="_plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script>
  $("[data-mask]").inputmask();

</script>
<?php eb();?>
 
<?php render($MasterPage);?>
