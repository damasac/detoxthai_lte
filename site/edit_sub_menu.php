<?php require_once '../_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>
<?php include_once "../_connection/db.php"; ?>

<?php

  /** init */
  $site_name = $_GET['site_name'];
  $id = $_GET['id'];

  $result = $mysqli->query("SELECT id, menu_order, menu_name, status_menu, main_menu_id FROM site_submenu WHERE site_name = '$site_name' AND id = '$id'");
  $row = $result->fetch_assoc();

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    แกไขเมนู
    <small>แกไขเมนูต่าง ๆ</small>
  </h1>
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
      <li><a href="#">ค่ายล้างพิษตับ</a></li>
      <li><a href="#">จัดการศูนย์</a></li>
      <li class="#">จัดการหน้าเว็บ</li>
      <li class="#">จัดการเมนู</li>
      <li class="active">แก้ไขเมนู</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">เมนู</h3>
    </div>
    <div class="box-body">
      <form class="form-horizontal">
        <div class="form-group">
          <label for="menuorder" class="col-sm-2 control-label">ลำดับเมนู</label>
          <div class="col-sm-9">
            <select class="form-control" id="menuorder">
              <?php
              for($i=1; $i<=50; $i++){
                if ($i == $row['menu_order']) {
                        echo '<option value='.$i.' selected>ลำดับ '.$i.'</option>';
                } else {
                        echo '<option value='.$i.'>ลำดับ '.$i.'</option>';
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="menuname" class="col-sm-2 control-label">ชื่อเมนู</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="menuname" placeholder="ชื่อเมนู" value="<?php echo $row['menu_name']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="main_menu" class="col-sm-2 control-label">เมนูย่อยของ</label>
          <div class="col-sm-9">
            <select class="form-control" id="main_menu">
              <?php
                $result_sub_menu = $mysqli->query("SELECT id, menu_name FROM site_menu WHERE site_name = '$site_name' ORDER BY menu_order");
                while ($row_sub_menu = $result_sub_menu->fetch_assoc()) {
                  if ($row['main_menu_id'] == $row_sub_menu['id']) {
                    echo '<option value='.$row_sub_menu['id'].' selected>'.$row_sub_menu['menu_name'].'</option>';
                  } else {
                    echo '<option value='.$row_sub_menu['id'].'>'.$row_sub_menu['menu_name'].'</option>';
                  }
                }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="display" class="col-sm-2 control-label">การแสดงผล</label>
          <div class="col-sm-9">
            <select class="form-control" id="display">
              <?php
                if (0 == $row['status_menu']) {
                  echo '<option value="0" selected>แสดงผล</option>';
                  echo '<option value="1">ไม่แสดงผล</option>';
                } else {
                  echo '<option value="0">แสดงผล</option>';
                  echo '<option value="1" selected>ไม่แสดงผล</option>';
                }
              ?>
            </select>
          </div>
        </div>
        <p class="text-center">
        <button type="button" class="btn btn-primary btn-flat" id="btadd">แก้ไข</button>
        </p>
      </form>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>
  <script>
    $(document).ready(function(){
        $("#btadd").click(function(){
            $.post("update_sub_menu.php",
            {
              id: <?php echo $row['id']; ?>,
              menuorder: $("#menuorder").val(),
              main_menu: $("#main_menu").val(),
              menuname: $("#menuname").val(),
              display: $("#display").val(),
            },
            function(data,status){
              //alert(data);
              window.location.href = 'menu.php?site_name=<?php echo $site_name; ?>';
            });
        });
    });
  </script>
<?php eb();?>

<?php render($MasterPage);?>
