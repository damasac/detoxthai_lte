<?php
    session_start();
    require_once '../_theme/util.inc.php';
    $MasterPage = 'page_main.php';
    include "../_connection/db_base.php";
    // $sql = "SELECT * FROM `puser` WHERE id='".$_SESSION["dtt_puser_id"]."' ";
    // echo $sql;
    // $query = $mysqli->query($sql);
    // $data = $query->fetch_assoc();
    // echo $_GET["pid"];
?>

<?php ?>
  <h4>&nbsp;กรุณาระบบัตรประชาชนก่อนโพสต์เพื่อยืนยันตัวตน</h4><br>
  <button class="btn btn-block btn-success" onclick="location.href='../form/form_private.php'" >เริ่มกรอกข้อมูลเดี๋ยวนี้</button>
<script>

</script>
