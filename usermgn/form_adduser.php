<?php
  require_once '../_theme/util.inc.php'; $MasterPage = 'page_main.php';
  include "../_connection/db_base.php";
  $status=1;

?>

<div class="login-box">
      <div class="login-logo">
        <a href="../index2.html"><b>Detox</b>Thailand</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">

	</p>
        <!--<form action="../index.html" method="post">-->
	
	    <code id="valFname" style="display: none;"></code>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="ชื่อ" id="fname" name="fname"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
	    <code id="valLname" style="display: none;"></code>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="นามสกุล" id="lname" name="lname"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
	    <code id="valTel" style="display: none;"></code>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์" id="tel" name="tel"/>
            <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
          </div>
	    <code id="valUsername" style="display: none;"></code>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" id="username" name="username"/>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
	  <code id="valPassword" style="display: none;"></code>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="รหัสผ่าน" placeholder="รหัสผ่าน" id="password" name="password"/>
            
	    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <!--<div class="checkbox icheck">-->
              <!--  <label>-->
              <!--    <input type="checkbox"> I agree to the <a href="#">terms</a>-->
              <!--  </label>-->
              <!--</div>-->
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="saveUser();">Register</button>
            </div><!-- /.col -->
          </div>
        <!--</form>        -->


      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>
<?php ?>
<script>


  $("#hospitalSelect").select2();
  $(".select2-input").attr("id","textSearch");
  $("#status").change(function(){
      var status = $(this).val();
      //alert(status);
      if (status==2 || status==3) {
	//code
	$("#siteChose").show();
      }else{
	$("#siteChose").hide();
      }
    });
  $(function(){
      $(".select2-input").attr("id","textSearch");
      $("#textSearch").on('keyup', function(e){
          if (e.keyCode>3) {
            var txtSearch = $(this).val();
                  $.getJSON("ajax-area-loaddata.php?task=hospital&txtSearch="+txtSearch+"",function(result){
                    console.log(result);
                  $("#hospitalSelect").html("<option value='0'>- ค้นหาจากชื่อโรงพยาบาล หรือ รหัสโรงพยาบาล -</option>");
                  $.each(result, function(i, field){
                        $("#hospitalSelect").append("<option value="+field.hcode+" >"+field.hcode+" : "+field.name+"</option>");
                  });
                  });
            }
        });
    });
  $("#hospitalSelect").on("change",function(){
      var hcode = $(this).val();
                  $.getJSON("ajax-area-loaddata.php?task=getdetailaddress&hcode="+hcode+"",function(result){
                    $.each(result, function(i, field){
                        $("#provinceSelect").attr("value",field.province);
                        $("#province").attr("value",field.provincecode);
                        $("#amphurSelect").attr("value",field.amphur);
                        $("#amphur").attr("value",field.amphurcode);
                        $("#tambonSelect").attr("value",field.tambon);
                        $("#tambon").attr("value",field.tamboncode);
                        $("#area").attr("value","เขตบริการสุขภาพที่"+field.zone_code);
                        $("#areaSelect").attr("value",field.zone_code);
                      });
                  });
    });
  function saveUser() {
    //code
    var username = $("#username").val();
    var password = $("#password").val();
    var email = $("#email").val();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var status = $("#status").val();
    var area = $("#area").val();
    var site = $("#hospital").val();
    var province = $("#province").val();
    var amphur = $("#amphur").val();
    var district = $("#tambon").val();
    if (username=="") {
      $("#valUsername").show();
      $("#valUsername").html("กรุณากรอกชื่อผู้ใช้งาน");
      return ;
    }else{
      $("#valUsername").hide();
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
    
    if (fname=="") {
      $("#valFname").show();
      $("#valFname").html("กรุณากรอกชื่อ");
      return ;
    }else{
      $("#valEmail").hide();
    }
    if (lname=="") {
      $("#valLname").show();
      $("#valLname").html("กรุณากรอกนามสกุล");
      return ;
    }else{
      $("#valEmail").hide();
    }
    if (status==0) {
      $("#valStatus").show();
      $("#valStatus").html("กรุณาระบุสถานะ");
      return ;
    }else{
      $("#valStatus").hide();
    }
    goAjaxSave(username,password,fname,lname,status);
  }
  function goAjaxSave(username,password,fname,lname,status){
      $.ajax({
		    url: "ajax-sql-query.php?task=addUser",
		    type: "post",
		    data: {
                      username:username,
                      password:password,
                      fname:fname,
                      lname:lname,
                      status:status
                      },
		    success: function(data){

                      if ($.trim(data)=="1") {
                        //code
                        $("#valUsername").show();
                        $("#valUsername").html("ชื่อนี้มีผู้ใช้งานแล้วกรุณาระบุใหม่");
                      }
                      //if ($.trim(data)=="2") {
                      //  //code
                      //  $("#valEmail").show();
                      //  $("#valEmail").html("อีเมล์นี้มีผู้ใช้งานแล้วกรุณาระบุใหม่");
                      //}
                      if ($.trim(data)=="0") {
                        //code
                        location.href="index.php";
                      }

		    },
		    error:function(){
			alert("failure");
		    }
		});
  }
</script>