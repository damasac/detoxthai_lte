<?php
  include_once "../_connection/db_base.php";
  $sql = "SELECT * FROM `puser` WHERE `id`='".$_SESSION["dtt_puser_id"]."' ";
  // echo $sql;
  $query = $mysqli->query($sql);
  $data = $query->fetch_assoc();
  // echo "<pre>";
  // print_r($data);
  // echo "</pre>";
?>

<div class="container">
  <h4><i class="fa fa-user"></i> ข้อมูลส่วนตัว</h4>

  <hr>
  <div class="profile">
    ชื่อ : <?php echo $data["fname"]." ".$data["lname"];?>
    <hr>
  </div>
  <div class="profile">
    ชื่อเล่น : <?php echo $data["nickname"];?>
    <hr>
  </div>
  <div class="profile">
    เบอร์โทรศัพท์ : <?php echo $data["tel"];?>
    <hr>
  </div>
  <div class="profile">
    อีเมล์ : <?php echo $data["email"];?>
    <hr>
  </div>
  <button class="btn btn-primary" onclick="dialogEdit();">แก้ไข</button>
  <br><br>
</div>
<script>
  function dialogEdit(){
    BootstrapDialog.show({
      type: BootstrapDialog.TYPE_WARNING,
      closable: true,
      closeByBackdrop: false,
      closeByKeyboard: false,
      title: 'แก้ไขข้อมูลผู้ใช้งาน',
      message: $('<div></div>').load('modal-detail2.php')
    });
  }
</script>
