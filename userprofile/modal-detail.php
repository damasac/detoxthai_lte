<?php
    session_start();

  require_once '../_theme/util.inc.php';
  $MasterPage = 'page_main.php';
  include "../_connection/db_base.php";


    $sql = "SELECT * FROM `puser` WHERE id='".$_SESSION["dtt_puser_id"]."' ";
    // echo $sql;
    $query = $mysqli->query($sql);
    $data = $query->fetch_assoc();

?>
<div class="container">
    <div class="callout callout-warning" style="width:550px;">
        <h4><i class="fa fa-warning"></i> Warning !</h4>
        <p>คุณได้เข้าสู่ระบบเป็นครั้งแรกกรุณาตรวจสอบข้อมูลผู้ใช้งาน</p>
    </div>
    <p style="font-size:16px;">
        ชื่อ ::
        <code id="valFname" style="display:none;"></code>
    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $data["fname"];?>" style="width:550px;">

    </p>
    <p style="font-size:16px;">
        นามสกุล ::
        <code id="valLname" style="display:none;"></code>
            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $data["lname"];?>" style="width:550px;">
    </p>

    <p>
        รหัสผ่าน ::
        <code id="valPassword" style="display:none;"></code>

    <input type="password" class="form-control" id="password" name="password"  placeholder="กรุณากรอกเมื่อต้องการเปลี่ยนรหัสผ่าน" style="width:550px;">
    </p>
    <p>
        ยืนยันรหัสผ่าน ::
        <code id="valPassword2" style="display:none;"></code>
    <input type="password" class="form-control" id="password2" name="password2"  placeholder="กรุณากรอกเมื่อต้องการเปลี่ยนรหัสผ่าน" style="width:550px;">
    </p>
    <p style="font-size:16px;">
        เบอร์โทรศัพท์ ::
        <code id="valTel" style="display:none;"></code>
        <input type="text" class="form-control" id="tel" name="tel"

               value="<?php echo $data["tel"];?>" style="width:550px;"
               data-inputmask="'mask': ['9999999999']" data-mask
               >
    </p>
        <p style="font-size:16px;">
        อีเมล์ ::
        <code id="valEmail" style="display:none;"></code>
        <input type="text" class="form-control" id="email" name="email" value="<?php echo $data["email"];?>" style="width:550px;">
    </p>
    <p>
        นามแฝง ::
        <code style="color:green;">เป็นชื่อที่ใช้แทนชื่อจริงในกรณีที่ไม่อยากเปิดเผยตัวตน</code>
        <?php if($data["nickname"]==""){ $nickname=$data["fname"]." ".$data["lname"]; } else{ $nickname=$data["nickname"];}  ?>
            <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo $nickname;?>" style="width:550px;">
    </p>
    <button class="btn btn-warning btn-flat" onclick="editPuser('<?php echo $data["id"];?>');">
        <i class="fa fa-edit"></i>  แก้ไขข้อมูล
    </button>
</div>
<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>
<script src="../_plugins/input-mask/jquery.inputmask.js"></script>
<script src="../_plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="../_plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script>
  $("[data-mask]").inputmask();
</script>
<script>
    function skip(id){
        $.post("sql.php?task=skip",
        {
          user_id : id
        },
        function(data,status){
            location.href="../index.php?menu=หน้าหลัก&site_id=1";
        });
    }

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

    if (password2!=password) {
        //code
        $("#valPassword2").show();
        $("#valPassword2").html("ระบุรหัสผ่านไม่ตรงกัน");
        return ;
    }
    if(password===""){
       passwordSend= "<?php echo $data["password"]?>";
    }else{
       passwordSend= $("#password").val();
    }
    // alert(passwordSend);
       $.ajax({
		    url: "sql.php?task=edit",
		    type: "post",
		    data: {
                      passwordSend:passwordSend,
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
			location.href='../index.php';
                      }

		    },
		    error:function(){
			alert("failure");
		    }
		});
  }
</script>
