<?php
  require_once '../_theme/util.inc.php';
  chk_login();
  $MasterPage = 'page_main.php';
  include "../_connection/db_base.php";


  isset($_SESSION[SESSIONPREFIX.'puser_id']) ? $session = $_SESSION[SESSIONPREFIX.'puser_id'] :  $session = '';

?>
  <section class="content">
    <div class="form-group">
      <label>ค้นหาสมาชิก </label>	    <code id="valTelFind" style="display:none;"></code>
      <div class="form-group has-feedback">
      <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์" id="telFind" name="telFind"
	    data-inputmask="'mask': ['9999999999']" data-mask
	    data-toggle="tooltip" data-placement="top" title=""/>

	  <span class="glyphicon glyphicon-phone-alt form-control-feedback" ></span>

      </div>
      <div style="float: right;">
      <button class="btn btn-success" onclick="findUser()"><i class="fa fa-search"></i></button>
      </div>
    </div><br><br>

      <div  id="showUser" style="display:none;">
	<div class="alert alert-default ">
                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                    <h4>	<i class="icon fa fa-check"></i> ค้นพบผู้ใช้งาน </h4>
		    <p>Username :: <span id='shwUsername'></span></p>
		    <p>ชื่อ :: <span id='shwFname'></span></p>
		    <p>นามสกุล :: <span id='shwLname'></span></p><br>
		    สถานะการจ่ายเงิน
		  <div class="radio">
		    <label>
		      <input type="radio" name="payment_status" id="payment_status" value="1" >
			จ่ายเงินแล้ว
		      </label>
		  </div>
		  <div class="radio">
		    <label>
		      <input type="radio" name="payment_status" id="payment_status" value="0" checked>
		      ยังไม่จ่าย
		    </label>
		  </div>
		    <input type="hidden" id="puser_id" name="puser_id" value=""/>
		    <br>
		      <button class="btn btn-success " onclick="addUser()">เพิ่มสมาชิกเข้าสู่ศูนย์</button><code id="valAddUser" style="display:none;"></code>
                  </div>
      </div>
      <div  id="showUser2" style="display:none;">
	<div class="alert alert-default">
                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                    <h4>	<i class="icon fa fa-fw fa-remove"></i> ไม่พบสมาชิกนี้ </h4>
		    <button class="btn btn-success " onclick="addNewUser()">เพิ่มสมาชิกใหม่</button>
                  </div>
      </div>

      <div id="formUser" style="display:none;">
    <div class="login-box" >

      <div class="login-box-body" >
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
	    <label>เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์" id="tel" name="tel"
	    data-inputmask="'mask': ['9999999999']" data-mask
	    data-toggle="tooltip" data-placement="top" title="ใช้แทน Username ในการเข้าสู่ระบบ"/>
	    <code id="valTel" style="display:none;"></code>
            <span class="glyphicon glyphicon-phone-alt form-control-feedback" ></span>
          </div>
          <div class="form-group has-feedback">
	    	    <label>รหัสผ่าน</label>
            <input type="text" class="form-control" placeholder="รหัสผ่าน" id="password" name="password"
	    data-toggle="tooltip" data-placement="top" title="ระบุรหัสผ่านตั้งแต่ 6 ตัวขึ้นไป"
	    /><code id="valPassword" style="display:none;"></code>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
 <label>สถานะการจ่ายเงิน</label>
		  <div class="radio">
		    <label>
		      <input type="radio" name="payment_status2" id="payment_status2" value="1" >
			จ่ายเงินแล้ว
		      </label>
		  </div>
		  <div class="radio">
		    <label>
		      <input type="radio" name="payment_status2" id="payment_status2" value="0" checked>
		      ยังไม่จ่าย
		    </label>
		  </div>
                  </div>
          <div class="row">
            <div class="col-xs-7">

            </div><!-- /.col -->
            <div class="col-xs-5">
              <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="saveUser();">สมัครสมาชิก</button>
            </div><!-- /.col -->
          </div>

      <!--  <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
        </div>
        <a href="login.html" class="text-center">I already have a membership</a>-->
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
      </div>
  </section><!-- /.content -->'

<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>
<script src="../_plugins/input-mask/jquery.inputmask.js"></script>
<script src="../_plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="../_plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script>
  $("[data-mask]").inputmask();
</script>
<script>
  function addNewUser() {
    //code
    var telUser = $("#telFind").val();
    $("#tel").val(telUser);
    $("#password").val(telUser);
    $("#formUser").show();
    $("#showUser2").hide();
  }
    function addUser(){
      var puser_id = $("#puser_id").val();
      var site_id = <?php echo $_GET["site_id"];?>;
      var schedule_id = <?php echo $_GET["schedule_id"];?>;
      var payment_status = $("#payment_status:checked").val();

            $.post("ball-sql.php?task=addUserFind",
	    {
	      schedule_id : schedule_id,
	      site_id:site_id,
	      user_id : puser_id,
	      payment_status : payment_status
	    },
	    function(data,status){
	      if (data==1) {
		//code
		$("#valAddUser").show();
		$("#valAddUser").html("สมาชิกนี้อยู่ในหลักสูตรแล้วกรุณาตรวจสอบ");
	      }else{
	        location.reload();
	      }
	    });
    }
    function findUser(){

      var user_id = $("#telFind").val();
      if (user_id=="") {
	$("#valTelFind").show();
	$("#valTelFind").html("กรุณาระบุเบอร์โทรศัพท์");
	return ;
      }else{
	$.ajax({
		    url: "ball-sql.php?task=findUser",
		    type: "post",
		    dataType: "json",
		    data: {
                      user_id:user_id
                      },
		    success: function(data){

		      if (data!=0) {
			$("#showUser2").hide();
			$("#formUser").hide();
			$("#showUser").show();
			$("#shwUsername").html(data.username);
			$("#shwFname").html(data.fname);
			$("#shwLname").html(data.lname);
			$("#puser_id").val(data.id);
		      }else if(data==0){
			$("#formUser").hide();
			$("#showUser2").show();
			$("#shwUsername").html("");
			$("#shwFname").html("");
			$("#shwLname").html("");
			$("#puser_id").val("");
			$("#showUser").hide();
		      }

		    },
		    error:function(){
			alert("failure");
		    }
		});
      }
    }
     function saveUser() {
    //code
    var username = $("#username").val();
    var tel = $("#tel").val();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var password = $("#password").val();
    var payment_status2 = $("#payment_status2:checked").val();
    var site_id = <?php echo $_GET["site_id"];?>;
    var schedule_id = <?php echo $_GET["schedule_id"];?>;

    if (fname=="") {
      $("#valFname").show();
      $("#valFname").html("กรุณาระบุชื่อ");
      return ;
    }else{
      $("#valFname").hide();
    }
    if (lname=="") {
      $("#valLname").show();
      $("#valLname").html("กรุณาระบุนามสกุล");
      return ;
    }else{
      $("#valLname").hide();
    }
    if (tel=="") {
      $("#valTel").show();
      $("#valTel").html("กรุณาระบุเบอร์โทรศัพท์");
      return ;
    }else{
      $("#valTel").hide();
    }
    if (password=="") {
      $("#valPassword").show();
      $("#valPassword").html("กรุณาระบุรหัสผ่าน");
      return ;
    }
    else{
      $("#valPassword").hide();
    }
    if (password<6) {
      $("#valPassword").show();
      $("#valPassword").html("กรุณาระบุรหัสผ่าน 6 ตัวขึ้นไป");
      return ;
    }else{
      $("#valPassword").hide();
    }

    goAjaxSave(username,password,tel,fname,lname,payment_status2,site_id,schedule_id);
  }
  function goAjaxSave(username,password,tel,fname,lname,payment_status2,site_id,schedule_id){
      $.ajax({
		    url: "../usermgn/ajax-sql-query.php?task=addUserNormal2",
		    type: "post",
		    data: {
                      username:username,
                      password:password,
                      tel:tel,
                      fname:fname,
                      lname:lname,
		      payment_status:payment_status2,
		      site_id:site_id,
		      schedule_id:schedule_id
                      },
		    success: function(data){

                      if ($.trim(data)=="1") {
                        //code
                        $("#valTel").show();
                        $("#valTel").html("เบอร์โทรศัพท์มีอยู่ในระบบแล้วกรุณาตรวจสอบ");
                      }
                      else{
                        //code
			location.reload();
                      }

		    },
		    error:function(){
			alert("failure");
		    }
		});
  }
  </script>
