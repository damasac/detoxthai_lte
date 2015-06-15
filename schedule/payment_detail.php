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
?>

<?php sb('content');?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    รายละเอียดการจ่ายเงิน
    <small>รายละเอียดการจ่ายเงิน</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">รายละเอียดการจ่ายเงิน</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box box-default">
    <div class="box-body">
    <div class="row">
      <div class="col-sm-offset-5 col-sm-2 text-center">
        <div class="btn-group">
          <a href="../schedules.php" class="btn btn-block btn-primary btn-lg btn-flat">กลับหน้าหลักสูตร</a>
        </div>
      </div>
    </div>
    <p></p>
    <?php
        $result = $mysqli->query("SELECT schedule_payment
                                      FROM site_schedule
                                      WHERE id = '$schedule_id'");
        $row = $result->fetch_assoc();

        echo "<textarea class='form-control' id='detail' rows='50' id='scheduledesc' placeholder='รายละเอียดหลักสูตร'>".html_entity_decode($row['schedule_payment'])."</textarea>";
        //echo $row['schedule_payment'];
    ?>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>
<link rel="stylesheet" type="text/css" href="../_plugins/edit/minified/themes/default.min.css">
<script src="../_plugins/edit/minified/jquery.sceditor.bbcode.min.js"></script>
<script type="text/javascript" src="../_plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
  $(document).ready(function(){
    $("#detail").sceditor({
      plugins: 'bbcode',
      width: '98%',
      toolbar: 'justify',
      readOnly: 'true',
      resizeEnabled: false,
      style: 'edit/minified/jquery.sceditor.default.min.css'
    });
});
</script>
<?php eb();?>

<?php render($MasterPage);?>

