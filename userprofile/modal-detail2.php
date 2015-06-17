<?php
    session_start();    
    require_once '../_theme/util.inc.php';
    $MasterPage = 'page_main.php';
    include "../_connection/db_base.php";
    $sql = "SELECT * FROM `puser` WHERE id='".$_SESSION["dtt_puser_id"]."' ";
    $query = $mysqli->query($sql);
    $data = $query->fetch_assoc();
?>

<div class="container">
    
    <div class="row">
        <div class="col-lg-6">
            <label>ชื่อ</label><code id="valFname" style="display:none;"></code>
            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $data["fname"];?>">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label>นามสกุล</label><code id="valLname" style="display:none;"></code>
            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $data["lname"];?>">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label>นามแฝง</label>
            <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo $data["nickname"];?>">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label>เบอรโทรศัพท์</label><code id="valTel" style="display:none;"></code>
            <input type="text" class="form-control" id="tel" name="tel"
                   value="<?php echo $data["tel"];?>"
                   data-inputmask="'mask': ['9999999999']" data-mask>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label>รหัสผ่าน</label><code id="valPassword" style="display:none;"></code>
            <input type="password" class="form-control" id="password" name="password"
            value="<?php echo $data["password"]?>"
            >
        </div>
    </div>
    <br>
    <button class="btn btn-primary btn-flat" onclick="editPuser('<?php echo $data["id"];?>');">
        <i class="fa fa-save"></i>   บันทึก
    </button>
</div>

<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>
<script src="../_plugins/input-mask/jquery.inputmask.js"></script>
<script src="../_plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="../_plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="blueimpupload/js/vendor/jquery.ui.widget.js"></script>
<script src="blueimpupload/js/jquery.iframe-transport.js"></script>
<script src="blueimpupload/js/jquery.fileupload.js"></script>
<script>
  $("[data-mask]").inputmask();
</script>
<script>
     function editPuser(id) {

    //code
    var tel = $("#tel").val();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var nickname = $("#nickname").val();
    var password = $("#password").val();
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
       $.ajax({
		    url: "sql.php?task=edit",
		    type: "post",
		    data: {
                      password:password,
                      tel:tel,
                      fname:fname,
                      lname:lname,
                      nickname:nickname,
                      id:id
                      },
		    success: function(data){

                      if ($.trim(data)=="1") {
                        //code
                        $("#valTel").show();
                        $("#valTel").html("เบอร์โทรศัพท์มีอยู่ในระบบแล้วกรุณาตรวจสอบ");
                      }
                      else{
                        //code
			location.href='../index.php'
                      }

		    },
		    error:function(){
			alert("failure");
		    }
		});
  }
  
  </script>
<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/';
    $('#imgupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>