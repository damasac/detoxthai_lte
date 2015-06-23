<?php require_once '../_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<style type="text/css">
  #show_content {
    margin: 0 auto;
    width: 95%;
  }
</style>
<?php eb();?>

<?php include_once "../_connection/db_base.php"; ?>

<?php sb('notifications');?>
<?php include_once '../notifications.php'; ?>
<?php eb();?>

<?php

isset($_GET['site_id']) ? $site_id = $_GET['site_id'] :  $site_id = '';

isset($_GET['schedule_id']) ? $schedule_id = $_GET['schedule_id'] :  $schedule_id = '';

isset($_SESSION[SESSIONPREFIX.'puser_id']) ? $session = $_SESSION[SESSIONPREFIX.'puser_id'] :  $session = '';


$sql1 = "SELECT site_id FROM `site_schedule` WHERE id='".$schedule_id."'";
$query1 = $mysqli->query($sql1) or die(mysqli_error($mysqli));
$data1 = $query1->fetch_assoc();

$sql2 = "SELECT * FROM `site_detail` WHERE id='".$data1["site_id"]."' AND create_user='".$session."' ";
$query2 = $mysqli->query($sql2) or die(mysqli_error($query1));
$num2 = $query2->num_rows;

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
      <!-- <div class="row">
        <div class="col-sm-offset-5 col-sm-2 text-center">
          <div class="btn-group">
            <a href="../schedules.php" class="btn btn-block btn-primary btn-lg btn-flat">กลับหน้าหลักสูตร</a>
          </div>
        </div>
      </div> -->
      <br>
      <div class="row">
        <?php
          if($num2==1){
            ?>
          <div style="float:right;padding-right:10px; ">
           <button class="btn btn-primary btn-md btn-flat" onclick="add();">เพิ่มผู้เข้าร่วมหลักสูตร</button>
          </div>
            <?php
            }
          ?>
      </div>
      <p></p>
      <table class="table table-bordered">
        <tr class="active">
          <th>
            ลำดับ
          </th>
          <th>
            ชื่อผู้เข้าร่วม
          </th>
          <th>
            ยืนยันการจ่ายเงิน
          </th>
          <th>
            สถานะการจ่ายเงิน
          </th>
          <th>
          </th>
        </tr>
        <?php
        $count = 1;
        $model = "";
        $result = $mysqli->query("SELECT site_join.id, payment_status, site_join.schedule_id, site_join.user_id, puser.fname, puser.lname, puser.id AS user_id, payment_upload_status, image_path
          FROM site_join
          LEFT JOIN puser ON site_join.user_id = puser.id
          WHERE schedule_id = '$schedule_id'");
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {

            if (0 == $row['payment_status']) {
              $txt_status = "ยังไม่จ่ายเงิน";
            } else {
              $txt_status = "จ่ายเงินแล้ว";
            }


            if (0 != $row['payment_upload_status']) {
              $model .= "<div class='modal fade bs-example-modal-lg' id='myModal".$count."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
              <div class='modal-dialog modal-lg'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <h4 class='modal-title' id='myModalLabel'>ภาพ</h4>
                  </div>
                  <div class='modal-body'>
                    <img src='".$row['image_path']."' class='img-rounded img-responsive'>
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                  </div>
                </div>
              </div>
            </div>";
            $txt_payment_upload_status = "<i class='fa fa-fw fa-check'></i>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal".$count."'>
              ดูรูป
            </button>";
            } else {
              $txt_payment_upload_status = "<i class='fa fa-fw fa-remove'></i>";
            }


          echo "<tr>";
          echo "<td>".$count."</td>";
          echo "<td>".$row['fname']." ".$row['lname']."</td>";
          echo "<td>".$txt_payment_upload_status."</i></td>";
          echo "<td>".$txt_status."</td>";
          echo "<td>
          <a class='btn btn-primary btn-flat' href='check_payment.php?schedule_id=".$row['schedule_id']."&user_id=".$row['user_id']."'>โอนแล้ว</a>
          <a class='btn btn-danger btn-flat' href='delete_join.php?schedule_id=".$row['schedule_id']."&user_id=".$row['user_id']."'>ยกเลิกการเข้าร่วม</a>
        </td>";
        echo "</tr>";

        $count++;
      }
    }

    ?>
  </table>
  <?php
    echo $model;
  ?>
</div><!-- /.box-body -->
</div><!-- /.box -->

</section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>
<script type="text/javascript" src="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
<link rel="stylesheet" href="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.css">
<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>
<script>
  function add(){
        dialogPopWindow = BootstrapDialog.show({
                    title: "เพิ่มผู้เข้าร่วมหลักสูตร",
                    cssClass: 'popup-dialog',
                    closable: true,
                    closeByBackdrop: false,
                    closeByKeyboard: false,
                    size:'size-wide',
                    draggable: false,
                    message: $('<div></div>').load("form_adduser.php?schedule_id='<?php echo $schedule_id ?>'&site_id='<?php echo $data1["site_id"]?>'", function(data){
                    }),
                    onshown: function(dialogRef){
                    },
                    onhidden: function(dialogRef){
                    }
         });
    }
  $(document).ready(function(){
    $("#btnpayment").click(function(){
      $.post("check_payment.php",
      {
        schedule_id : <?php echo $schedule_id; ?>,
        user_id : <?php echo $session; ?>
      },
      function(data,status){
        location.reload();
      });
    });
  });

</script>
<?php eb();?>

<?php render($MasterPage);?>

