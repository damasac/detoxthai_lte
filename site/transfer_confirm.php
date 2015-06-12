<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<style type="text/css">
  #show_content {
    margin: 0 auto;
    width: 95%;
  }
</style>
<?php eb();?>

<?php sb('notifications');?>
  <?php include_once '../notifications.php'; ?>
<?php eb();?>

<?php include_once "../_connection/db_base.php"; ?>

<?php
isset($_GET['schedule_id']) ? $schedule_id = $_GET['schedule_id'] :  $schedule_id = '';

//isset($_COOKIE['detoxthai']) ? $detoxthai = $_COOKIE['detoxthai'] :  $detoxthai = '';

$result_schedule_name = $mysqli->query("SELECT schedule_name
  FROM site_schedule
  WHERE id = '".$schedule_id."'");
$schedule_name = $result_schedule_name->fetch_assoc();


$result_user_name = $mysqli->query("SELECT CONCAT(fname, ' ', lname) AS name
  FROM puser
  WHERE id = '".$_SESSION[SESSIONPREFIX.'puser_id']."'");
$user_name = $result_user_name->fetch_assoc();

?>

<?php sb('content');?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    รายชื่อผู้เข้าร่วม
    <small>รายชื่อผู้เข้าร่วม</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="../schedules.php"><i class="fa fa-calendar"></i> หลักสูตรสุขภาพองค์รวม</a></li>
    <li class="active">รายชื่อผู้เข้าร่วม</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box box-default">
    <div class="box-body">
      <h2>หลักสูตร: <?php echo $schedule_name['schedule_name']; ?></h2>
      <h2>ชื่อผู้เข้าร่วม: <?php echo $user_name['name']; ?></h2>
      <br/>
      <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <input type="hidden" name="user_id" value="<?php echo $_SESSION[SESSIONPREFIX.'puser_id']; ?>">
          <input type="hidden" name="schedule_id" value="<?php echo $schedule_id; ?>">
          <label for="exampleInputFile">ไฟล์ภาพเท่านั้น</label>
          <input name="fileToUpload" id="fileToUpload" type="file">
          <p class="help-block">อัพโหลดรายละเอียดการจ่ายเงิน ที่เป็นไฟล์ภาพเท่านั้น</p>
        </div>
        <input type="submit" class="btn btn-primary btn-flat" value="อัพโหลดภาพ" name="submit">
      </form>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>

<?php eb();?>

<?php render($MasterPage);?>

