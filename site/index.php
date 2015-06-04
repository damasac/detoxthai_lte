<?php require_once '../_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>
<?php include_once "../_connection/db.php"; ?>

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      จัดการหน้าเว็บ
      <small>แก้ไขเนื้อหาหรือเมนูของเว็บ</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
    <li><a href="#">ค่ายล้างพิษตับ</a></li>
     <li><a href="#">จัดการศูนย์</a></li>
    <li class="active">จัดการหน้าเว็บ </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Blank Box</h3>
        </div>
        <div class="box-body">
          The great content goes here
        </div><!-- /.box-body -->
  </div><!-- /.box -->

  </section><!-- /.content -->'

<?php eb();?>


<?php sb('js_and_css_footer');?>
<?php eb();?>

<?php render($MasterPage);?>
