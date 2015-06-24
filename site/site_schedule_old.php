<?php
isset($_GET['site_id']) ? $site_id = $_GET['site_id'] :  $site_id = '';

$site_name = explode(".",$_SERVER['SERVER_NAME']);
$sub_domain =  $site_name[sizeof($site_name) - 3];

//$all = $_GET['site'];
isset($_GET['site']) ? $all = $_GET['site'] :  $all = '';

if('' == $all){
  if ("www" === $sub_domain) {
    header('Location: site_schedule_old.php?site=all');
  }
}
?>
<?php require_once '../_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>
<link rel="stylesheet" href="../_plugins/datepicker/datepicker3.css">
<?php eb();?>

<?php sb('notifications');?>
<?php include_once '../notifications.php'; ?>
<?php eb();?>

<?php
function System_ShowDate($myDate) {
  $myDateArray=explode("-",$myDate);
  switch($myDateArray[1]) {
    case "01" : $myMonth = "ม.ค.";  break;
    case "02" : $myMonth = "ก.พ.";  break;
    case "03" : $myMonth = "มี.ค."; break;
    case "04" : $myMonth = "เม.ย."; break;
    case "05" : $myMonth = "พ.ค.";   break;
    case "06" : $myMonth = "มิ.ย.";  break;
    case "07" : $myMonth = "ก.ค.";   break;
    case "08" : $myMonth = "ส.ค.";  break;
    case "09" : $myMonth = "ก.ย.";  break;
    case "10" : $myMonth = "ต.ค.";  break;
    case "11" : $myMonth = "พ.ย.";   break;
    case "12" : $myMonth = "ธ.ค.";  break;
  }
  return $myDateArray['0']." ".$myMonth." ".$myDateArray['2'];
}

isset($_SESSION[SESSIONPREFIX.'puser_id']) ? $session = $_SESSION[SESSIONPREFIX.'puser_id'] :  $session = '';

?>

<?php sb('content');?>
<?php include_once "../_connection/db_base.php"; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    หลักสูตรสุขภาพองค์รวม
    <small>เพิ่ม แก้ไข ลบ หลักสูตร</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-calendar"></i> หลักสูตรสุขภาพองค์รวม</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">หลักสูตรทั้งหมด</h3>
    </div>
    <div class="box-body">
      <div class="form-group">
        <label for="sch" class="col-sm-1 control-label">หลักสูตร</label>
        <div class="col-sm-8">
          <select class="form-control" id="sch">
            <option value="0">หลักสูตรทั้งหมด</option>
            <?php
            if("all" != $all){
              $result = $mysqli->query("SELECT id, site_name FROM site_detail WHERE site_url = '$sub_domain' AND delete_at IS NULL ORDER BY id");
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  echo "<option value=".$row['id']." selected>".$row['site_name']."</option>";
                }
              }
            }else{
              $result = $mysqli->query("SELECT id, site_url, site_name FROM site_detail WHERE delete_at IS NULL ORDER BY id");
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  echo "<option value=".$row['id'].">".$row['site_name']."</option>";
                }
              }
            }
            ?>
          </select>
        </div>
      </div>
      <p></p>
      <br/><br/>
      <div id="show_table">
        <table class="table table-bordered" id="show_content">
          <tr class="active">
            <th>
              ลำดับ
            </th>
            <th>
              วันที่
            </th>
            <th>
              ชื่อหลักสูตร
            </th>
            <th>
              ชื่อศูนย์
            </th>
            <th>
              จำนวนที่รับ
            </th>
            <th>
              ราคา/คน
            </th>
            <th>
              รายละเอียด
            </th>
            <th>
            </th>
          </tr>
          <?php
          $count = 1;
          $script = "";
          $modal = "";

          $btn_edit = "";
        // prepare and query (direct)
          $result = $mysqli->query("SELECT site_schedule.id, schedule_name, user_qty, DATE_FORMAT(schedule_date,'%d-%m-%Y') AS schedule_date, DATE_FORMAT(schedule_end_date,'%d-%m-%Y') AS schedule_end_date, price_per_person, schedule_desc, schedule_payment, schedule_after_payment, site_id, site_name, site_url
            FROM site_schedule
            INNER JOIN site_detail ON site_schedule.site_id = site_detail.id
            WHERE site_schedule.delete_at IS NULL ORDER BY site_schedule.id");
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

              $result_check = $mysqli->query("SELECT count(*) AS join_status, payment_upload_status
                FROM site_join
                WHERE schedule_id = '".$row['id']."'
                AND user_id = '".$session."'");
              $row_check = $result_check->fetch_assoc();

              $result_check_edit = $mysqli->query("SELECT count(*) AS edit_status
                FROM site_schedule
                WHERE user_id = '".$session."'
                AND site_id = '".$row['site_id']."'");
              $result_check_edit = $result_check_edit->fetch_assoc();

              if (0 < $result_check_edit['edit_status']) {
                $btn_edit = "<a type='button' href='site_schedule.php?site_id=".$row['site_id']."' class='btn btn-primary btn-flat'>จัดการหลักสูตร</a>";
              } else {
                $btn_edit = "";
              }

              if (0 < $row_check['join_status']) {
                if (0 == $row_check['payment_upload_status']) {
                //echo $row_check['payment_upload_status'];
                  $btn_join = "<a type='button' class='btn btn-default btn-flat'>เข้าร่วมหลักสูตรแล้ว</a>
                  <a type='button' class='btn btn-primary btn-flat' href='site/transfer_confirm.php?schedule_id=".$row['id']."'>ยืนยันการจ่ายเงิน</a>";
                } else {
                  $btn_join = "<a type='button' class='btn btn-default btn-flat'>เข้าร่วมหลักสูตรแล้ว</a>
                  <a type='button' class='btn btn-success btn-flat'>การจ่ายเงินเรียบร้อยแล้ว</a>";
                }
              } else {
                $btn_join = "<a type='button' href='schedule/join.php?schedule_id=".$row['id']."' class='btn btn-primary btn-flat'>เข้าร่วมหลักสูตร</a>";
              }

              echo "<tr>
              <td>".$count."</td>
              <td>".System_ShowDate($row['schedule_date'])." - ".System_ShowDate($row['schedule_end_date'])."</td>
              <td>".$row['schedule_name']."</td>
              <td><a href='http://".$row['site_url'].".detoxthai.org/detoxthai_lte/'>".$row['site_name']."<a></td>
              <td>".$row['user_qty']." คน</td>
              <td>".$row['price_per_person']."</td>
              <td><button type='button' class='btn btn-primary btn-flat' data-toggle='modal' data-target='#myModal".$count."'>รายละเอียด</button></td>
              <td>".$btn_edit."</td>
            </tr>";

            $modal .= "<div class='modal fade bs-example-modal-lg' id='myModal".$count."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-lg'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                  <h4 class='modal-title' id='myModalLabel'>
                    รายละเอียด
                  </h4>
                </div>
                <div class='modal-body'>
                  <p class='text-right'>
                  </p>
                  <p><strong>วันที่ :</strong> ".System_ShowDate($row['schedule_date'])." - ".System_ShowDate($row['schedule_end_date'])."</p>
                  <p><strong>ชื่อหลักสูตร :</strong> ".$row['schedule_name']."</p>
                  <p><strong>จำนวนที่รับ :</strong> ".$row['user_qty']." คน</p>
                  <p><strong>ราคา/คน :</strong> ".$row['price_per_person']."</p>
                  <p><strong>รายละเอียด :<hr/></strong></p>
                  ".htmlspecialchars_decode($row['schedule_desc'])."
                  <p><strong>รายละเอียดการจ่ายเงิน :<hr/></strong></p>
                  ".htmlspecialchars_decode($row['schedule_payment'])."
                  <p><strong>รายละเอียดหลังการจ่ายเงิน :<hr/></strong></p>
                  ".htmlspecialchars_decode($row['schedule_after_payment'])."
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-default btn-flat' data-dismiss='modal'>Close</button>
                </div>
              </div>
            </div>
          </div>";

          $count++;
        }
      }
      ?>
    </table>
  </div>

  <!-- Modal -->
  <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">เพิ่มหลักสูตรล้างพิษ</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="schedulename" class="col-sm-2 control-label">ชื่อหลักสูตร</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="schedulename" placeholder="ชื่อหลักสูตร">
              </div>
            </div>
            <div class="form-group">
              <label for="scheduledate" class="col-sm-2 control-label">วันที่เริ่ม</label>
              <div class="col-sm-10">
                <input type="text" data-date-format="dd/mm/yyyy" class="form-control" id="scheduledate" placeholder="วัน/เดือน/ปี" value="<?php echo date("d/m/Y"); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="scheduledateend" class="col-sm-2 control-label">วันที่สิ้นสุด</label>
              <div class="col-sm-10">
                <input type="text" data-date-format="dd/mm/yyyy" class="form-control" id="scheduledateend" placeholder="วัน/เดือน/ปี" value="<?php echo date("d/m/Y"); ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="user_qty" class="col-sm-2 control-label">จำนวนคน</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="user_qty" placeholder="จำนวนคน" value="">
              </div>
            </div>

            <div class="form-group">
              <label for="price" class="col-sm-2 control-label">ราคา/คน</label>
              <label class="sr-only" for="price">ราคา/คน</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <div class="input-group-addon">฿</div>
                  <input type="number" class="form-control" id="price" placeholder="ราคา">
                  <div class="input-group-addon">.00</div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="scheduledesc" class="col-sm-2 control-label">รายละเอียดหลักสูตร</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="detail" rows="50" id="scheduledesc" placeholder="รายละเอียดหลักสูตร"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="scheduledesc" class="col-sm-2 control-label">รายละเอียดการโอนเงิน</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="payment" rows="50" id="scheduledesc" placeholder="รายละเอียดหลักสูตร"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="scheduledesc" class="col-sm-2 control-label">รายละเอียดหลังการโอนเงินเรียบร้อยแล้ว</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="afterpayment" rows="50" id="scheduledesc" placeholder="รายละเอียดหลักสูตร"></textarea>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">ยกเลิก</button>
          <button type="button" id="btadd" class="btn btn-primary btn-flat">เพิ่ม</button>
        </div>
      </div>
    </div>
  </div>

  <?php
  echo $modal;
  ?>
  <div id="show_modal"></div>
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

    $("#sch").change(function(){
      var sch = $("#sch").val();
      if (0 == sch) {
        window.location.assign("site_schedule_old.php?site=all")
      }else{
       $.post("schedule/schedule_api.php",
       {
        site_url: sch,
      },
      function(data,status){
        var res = data.split(":codeerror:");
        console.log(res);
        $('#show_table').html(res[0]);
        var res_script = res[1].split(":codeerror_script:");
        $('#show_modal').html(res[1]);
      });
     }
   });

  });
</script>
<?php eb();?>

<?php render($MasterPage);?>
