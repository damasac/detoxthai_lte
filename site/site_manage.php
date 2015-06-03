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
      จัดการศูนย์
      <small>จัดการหรือแก้ไขส่วนต่างๆ ของศูนย์</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
       <li><a href="#">ค่ายล้างพิษตับ</a></li>
      <li class="active">จัดการศูนย์</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php
      $result = $mysqli->query("SELECT COUNT(id) AS sitecount
                              FROM site_detail WHERE create_user = 1");
      $row = $result->fetch_assoc();
    ?>

    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">ศูนย์ล้างพิษตับของท่าน <code>มีทั้งหมด <?php echo $row['sitecount']; ?> ศูนย์</code></h3>
        </div>
        <div class="box-body">
          ศูนย์ล้างพิษตับของท่าน
        </div><!-- /.box-body -->
  </div><!-- /.box -->

  </section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>
<?php eb();?>

<?php render($MasterPage);?>

