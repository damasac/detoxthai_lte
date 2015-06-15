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

  if(!isset($_SESSION[SESSIONPREFIX.'puser_id'])){
    echo "<script>
            window.location.href = '../login.php';
          </script>";
  }
?>

<?php sb('content');?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    ยืนยันการเข้าร่วม
    <small>ยืนยันการเข้าร่วม</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="../schedules.php"><i class="fa fa-calendar"></i> หลักสูตรสุขภาพองค์รวม</a></li>
    <li class="active">เข้าร่วมหลักสูตร</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box box-default">
    <div class="box-body">
      <h2>
        <p class="text-center">
          ยืนยันการเข้าร่วมหลักสูตร
        </p>
        <div class="row">
          <div class="col-sm-offset-5 col-sm-2 text-center">
            <div class="btn-group">
              <button class="btn btn-block btn-primary btn-lg btn-flat" id="btnjoin">ยืนยัน</button>
              <a href="../schedules.php" class="btn btn-block btn-danger btn-lg btn-flat">ยกเลิก</a>
            </div>
          </div>
        </div>
      </h2>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>
<script>
  $(document).ready(function(){
    $("#btnjoin").click(function(){
      $.post("create_join.php",
      {
        schedule_id: <?php echo $schedule_id; ?>,
        user_id: <?php echo $_SESSION[SESSIONPREFIX.'puser_id']; ?>,
      },
      function(data,status){
        window.location.href = 'payment_detail.php?schedule_id=<?php echo $schedule_id; ?>';
      });
    });
  });
</script>
<?php eb();?>

<?php render($MasterPage);?>
