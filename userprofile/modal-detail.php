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
    <div class="callout callout-danger" style="width:550px;">
        <h4><i class="fa fa-warning"></i> Warning !</h4>
        <p>คุณได้เข้าสู่ระบบเป็นครั้งแรกกรุณาตรวจสอบข้อมูลผู้ใช้งาน</p>
    </div>
    <p style="font-size:16px;">
        ชื่อ :: <?php echo $data["fname"];?>
    </p>
    <p style="font-size:16px;">
        นามสกุล :: <?php echo $data["lname"];?>
    </p>
    <p>
        นามแฝง ::
        <code>เป็นชื่อที่ใช้แทนชื่อจริงในกรณีที่ไม่อยากเปิดเผยตัวตน</code>
        <input type="text" class="form-control" id="nickname" name="nickname" style="width:550px;">
    </p>
    <p style="font-size:16px;">
        เบอร์โทรศัพท์ :: <?php echo $data["tel"];?>
    </p>
    <button class="btn btn-success btn-flat" onclick="skip('<?php echo $data["id"];?>');">
        <i class="fa fa-check"></i> ข้อมูลถูกต้อง
    </button>
    <button class="btn btn-warning btn-flat" onclick="editPuser('<?php echo $data["id"];?>');">
        <i class="fa fa-edit"></i>  แก้ไขข้อมูล
    </button>
</div>
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
    function editPuser(id){
        var nickname = $("#nickname").val();
        $.post("sql.php?task=editUser",
        {
          user_id : id,
          nickname:nickname
        },
        function(data,status){
            location.href="profile.php";
        });
    }
</script>