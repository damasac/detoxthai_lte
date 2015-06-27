<?php require_once '../_theme/util.inc.php';  $MasterPage = 'page_main.php';?>
<?php

?>
<?php sb('title');?><?php eb();?>

<?php sb('js_and_css_head'); ?>
<?php eb();?>
<?php sb('notifications');?>
<?php include_once '../notifications.php'; ?>
<?php eb();?>
<?php sb('content');?>

  <div class='container'>
    <div class='row'>
      <div class="col-lg-3">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h4 class="box-title"><?php echo $_SESSION["dtt_puser_nickname"];?></h3>
          </div>
          <div class="box-body">
            <?php
              if($_SESSION["dtt_puser_image"]==""){
                $image = "img/avatar-male_4.jpg";
              }else{
                $image = "userprofile/".$_SESSION["dtt_puser_image"];
              }
              // echo $image;
            ?>

            <center><img
              src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?><?php echo $image;?>"
              class="user-image" alt="User Image"/>
            </center><br>
            <button class="btn btn-block btn-success" onclick="goTimeline();">ไทมไลน์</button>
            <button class="btn btn-block btn-success" onclick="goProfile();">ข้อมูลส่วนตัว</button>
            <button class="btn btn-block btn-success" onclick="goSetting();">ตั้งค่า</button>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="box box-success">
          <div class="box-title">
            <div id="loadPage">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php eb();?>
<?php sb('js_and_css_footer');?>
<script type="text/javascript" src="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
<link rel="stylesheet" href="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.css">
<script>
      $(window).load(function(){
        $("#loadPage").load("timeline.php");
      })
      function goTimeline(){
        $("#loadPage").load("timeline.php");
      }
      function goProfile(){
        $("#loadPage").load("editprofile.php");
      }
      function goSetting(){
        $("#loadPage").load("setting.php")
      }

</script>
<!--<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>
<script src="../_plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../_plugins/datatables/dataTables.bootstrap.min.js"></script>
<link href="../_plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"></script>-->
<?php eb();?>

<?php render($MasterPage);?>
