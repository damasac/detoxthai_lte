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
 <form action="upload.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION[SESSIONPREFIX.'puser_id']; ?>">
    <label for="exampleInputFile">ไฟล์ภาพเท่านั้น</label>
    <input name="fileToUpload" id="fileToUpload" type="file">
    <p class="help-block">อัพโหลดรูปประจำตัว ที่เป็นไฟล์ภาพเท่านั้น</p>
  </div>
  <input type="submit" class="btn btn-primary btn-flat" value="อัพโหลดภาพ" name="submit">
</form>
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
    var password2 = $("#password2").val();
    var email = $("#email").val();
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
    if (password2!=password) {
        //code
        $("#valPassword2").show();
        $("#valPassword2").html("ระบุรหัสผ่านไม่ตรงกัน");
        return ;
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
                      email:email,
                      id:id
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
			location.href='../index.php'
                      }

		    },
		    error:function(){
			alert("failure");
		    }
		});
  }
  
</script>
