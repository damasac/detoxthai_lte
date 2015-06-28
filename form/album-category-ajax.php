<?php
session_start();
header("Content-type:text/html; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

## System Start ############################################################
include_once "../_connection/db_base.php";
############################################################################

if($_GET['task']=="add"){
    if(($_GET['id'])<>''){
        $id = $_GET['id'];
        $task='update';
    }
$sql = "SELECT `name`, `detail` FROM tbl_surveyalbum_type WHERE id = '$id';";
$result = $mysqli->query($sql) or die($mysqli->error);
$dbarr = $result->fetch_assoc();

?>
<form  action="album-category-ajax.php?task=<?php echo $task; ?>&id=<?php echo $_GET['id']; ?>" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">ชื่อหมวดรูปภาพ</label>
    <input type="text" class="form-control" name="name" placeholder="ชื่อหมวดรูปภาพ" value="<?php echo $dbarr['name']; ?>" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">รายละเอียดหมวดรูปภาพ (ไม่บังคับ)</label>
    <textarea class="form-control" rows="3" name="detail" placeholder="รายละเอียดหมวดรูปภาพ"><?php echo $dbarr['detail']; ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary btn-block"><li class="fa fa-check"></li> บันทึก</button>
</form>
<?php } else if($_GET['task']=='update'){
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $id = $_GET['id'];
    $sql = "UPDATE tbl_surveyalbum_type SET `name`='$name', `detail`='$detail' WHERE id ='$id';";
    $result = $mysqli->query($sql);
    header('Location: album-category.php');
}else if(isset($_POST['name'])){
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $createtime = date('Y-m-d H:i:s');
    $ref_user = $_SESSION['dtt_user_form'];
    $sql = "INSERT INTO tbl_surveyalbum_type (`name`, `detail`, ref_user, `createtime`) VALUES('$name', '$detail', '$ref_user', '$createtime')";
    $result = $mysqli->query($sql);
    header('Location: album-category.php');
}else if($_GET['task']=='remove'){
    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_surveyalbum_type WHERE id = '$id';";
    $result = $mysqli->query($sql);
    header('Location: album-category.php');
}
?>
