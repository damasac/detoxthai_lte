<?php require_once '../_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<?php eb();?>

<?php include_once "../_connection/db_base.php"; ?>

<?php sb('notifications');?>
<?php include_once '../notifications.php'; ?>
<?php eb();?>

<?php
isset($_GET['site_id']) ? $site_id = $_GET['site_id'] :  $site_id = '';
?>

<?php sb('content');?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    รายชื่อผู้เข้าร่วม
    <small>รายชื่อผู้เข้าร่วม</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="../sites.php"><i class="fa fa-tachometer"></i> ค่ายล้างพิษ</a></li>
    <li><a href="site_manage.php">จัดการศูนย์</a></li>
    <li><a href="site_schedule.php?site_id=<?php echo $site_id; ?>">จัดการหลักสูตรล้างพิษ</a></li>
    <li class="active">รายชื่อผู้เข้าร่วม</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box box-default">
    <div class="box-body">
      <h2>
      <p class="text-center">ข้อมูลทั้งหมดที่เกี่ยวข้องกับศูนย์นี้ จะหายไปจาก DetoxThai เป็นการชั่วคราว</p>
      <br>
      </h2>
      <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
          <a href="delete_site.php?site_id=<?php echo $site_id; ?>" class="btn btn-block btn-danger btn-lg">ยืนยันการลบ</a>
          <a href="site_manage.php" class="btn btn-block btn-primary btn-lg">ยกเลิก</a>
        </div>
        <div class="col-md-4">
        </div>
      </div>
      <br>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>
<?php eb();?>

<?php render($MasterPage);?>

