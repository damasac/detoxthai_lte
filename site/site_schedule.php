<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<link rel="stylesheet" href="css/datepicker.css">
<style>
  .datepicker{z-index:1151 !important;}
</style>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../ckfinder/ckfinder.js"></script>
<script type="text/javascript">
  var editor = CKEDITOR;
  CKFinder.setupCKEditor(editor, '../ckfinder/');
</script>

<?php eb();?>

<?php sb('notifications');?>
<?php include_once '../notifications.php'; ?>
<?php eb();?>

<?php include_once "../_connection/db_base.php"; ?>

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


isset($_GET['site_id']) ? $site_id = $_GET['site_id'] :  $site_id = '';

/** Check security. */
$check_point = 0;

$result = $mysqli->query("SELECT COUNT(*) check_secu
  FROM site_manage_user
  WHERE user_id = '".$_SESSION[SESSIONPREFIX.'puser_id']."'
  AND site_id = '$site_id'");
$row = $result->fetch_assoc();

if (0 == $row['check_secu']) {
  $check_point = 1;
}

$result = $mysqli->query("SELECT COUNT(*) check_secu
  FROM site_detail
  WHERE create_user = '".$_SESSION[SESSIONPREFIX.'puser_id']."'
  AND id = '$site_id'");
$row = $result->fetch_assoc();

if (0 == $row['check_secu'] && $check_point) {
  echo 'การเข้าถึงข้อมูลถูกปฏิเสธ';
  exit;
}

?>

<?php sb('content');?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    จัดการหลักสูตรล้างพิษ
    <small>เพิ่ม แก้ไข ลบ หลักสูตรล้างพิษ</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="../sites.php"><i class="fa fa-tachometer"></i> ค่ายล้างพิษ</a></li>
    <li><a href="site_manage.php">จัดการศูนย์</a></li>
    <li class="active">จัดการหลักสูตรล้างพิษ</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">หลักสูตรล้างพิษทั้งหมด</h3>
    </div>
    <div class="box-body">
      <p class="text-left col-xs-2" style="margin-left: -15px;">
        <button class="btn btn-block btn-primary btn-flat" onclick="show_model ();">เพิ่มหลักสูตรล้างพิษ</button>
      </p>
      <table class="table table-bordered">
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
            ดูสมาชิกที่เข้าร่วม
          </th>
          <th>
          </th>
        </tr>
        <?php
        $count = 1;
        $script = "";
        $modal = "";
        // prepare and query (direct)
        $result = $mysqli->query("SELECT site_schedule.id, schedule_name, user_qty, DATE_FORMAT(schedule_date,'%d-%m-%Y') AS schedule_date, DATE_FORMAT(schedule_end_date,'%d-%m-%Y') AS schedule_end_date, price_per_person, schedule_desc, schedule_payment, schedule_after_payment, site_id, site_name, site_url
                                    FROM site_schedule
                                    INNER JOIN site_detail ON site_schedule.site_id = site_detail.id
                                    WHERE site_schedule.delete_at IS NULL
                                    AND site_id = '".$site_id."'
                                    ORDER BY site_schedule.id");
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>".$count."</td>
            <td>".System_ShowDate($row['schedule_date'])." - ".System_ShowDate($row['schedule_end_date'])."</td>
            <td>".$row['schedule_name']."</td>
            <td><a href='http://".$row['site_url'].".detoxthai.org/detoxthai_lte/'>".$row['site_name']."<a></td>
            <td>".$row['user_qty']." คน</td>
            <td>".$row['price_per_person']."</td>
            <td><button type='button' class='btn btn-primary btn-flat' data-toggle='modal' data-target='#myModal".$count."'>รายละเอียด</button></td>
            <td><a type='button' href='list_join.php?schedule_id=".$row['id']."&site_id=".$site_id."' class='btn btn-primary btn-flat'>ดูสมาชิกที่เข้าร่วม</i></a></td>
            <td><a href='edit_schedule.php?schedule_id=".$row['id']."' class='btn btn-primary btn-flat'>แก้ไข</a> <a href='delete_schedule.php?id=".$row['id']."&site_id=".$site_id."' class='btn btn-danger btn-flat'>ลบ</a></td>
          </tr>";

          $modal .= "<div class='modal fade bs-example-modal-lg' id='myModal".$count."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
          <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>รายละเอียด</h4>
              </div>
              <div class='modal-body'>

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
                <input type="text" class="form-control" id="scheduledate" data-provide="datepicker" data-date-language="th-th" placeholder="วัน/เดือน/ปี" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="scheduledateend" class="col-sm-2 control-label">วันที่สิ้นสุด</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="scheduledateend" data-provide="datepicker" data-date-language="th-th" placeholder="วัน/เดือน/ปี" value="">
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
                  <input type="text" class="form-control" id="price" placeholder="ราคา">
                  <div class="input-group-addon">.00</div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="scheduledesc" class="col-sm-2 control-label">รายละเอียดหลักสูตร</label>
              <div class="col-sm-10">
                <textarea cols="80" id="editor1" name="editor1" rows="10" data-sample="1" data-sample-short="">
                </textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="scheduledesc" class="col-sm-2 control-label">รายละเอียดการโอนเงิน</label>
              <div class="col-sm-10">
                <textarea cols="80" id="editor2" name="editor1" rows="10" data-sample="2" data-sample-short="">
                </textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="scheduledesc" class="col-sm-2 control-label">รายละเอียดหลังการโอนเงินเรียบร้อยแล้ว</label>
              <div class="col-sm-10">
                <textarea cols="80" id="editor3" name="editor1" rows="10" data-sample="3" data-sample-short="">
                </textarea>
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
</div><!-- /.box-body -->
</div><!-- /.box -->

</section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/bootstrap-datepicker-thai.js"></script>
<script src="js/locales/bootstrap-datepicker.th.js"></script>
<script>
  CKEDITOR.replace( 'editor1', {
    width: '100%',
    height: 500
  } );

  CKEDITOR.replace( 'editor2', {
    width: '100%',
    height: 500
  } );

  CKEDITOR.replace( 'editor3', {
    width: '100%',
    height: 500
  } );
</script>
<script>
  function show_model () {
    $('#myModal').on('shown.bs.modal', function () {
      $('.datepicker').datepicker();
      //$("#scheduledate").datepicker({ dateFormat: 'dd/mm/yyyy', });
      //$("#scheduledateend").datepicker({ dateFormat: 'dd/mm/yyyy', });
    });

    $('#myModal').modal("show");
  }
  $(document).ready(function(){

    jQuery.fn.CKEditorValFor = function( element_id ){
      return CKEDITOR.instances[element_id].getData();
    }

    $('.datepicker').datepicker();
    //$("#scheduledate").datepicker({ dateFormat: 'dd/mm/yyyy', });
    //$("#scheduledateend").datepicker({ dateFormat: 'dd/mm/yyyy', });

    $("#btadd").click(function(){

      var schedulename = $("#schedulename");
      var scheduledate = $("#scheduledate");
      var scheduledateend = $("#scheduledateend");
      var user_qty = $("#user_qty");
      var price = $("#price");

      var check = 0;

      if(!schedulename.val()) {
        schedulename.closest('.form-group').removeClass('has-success').addClass('has-error');
        check = 1;
      } else {
        schedulename.closest('.form-group').removeClass('has-error').addClass('has-success');
      }

      if(!scheduledate.val()) {
        scheduledate.closest('.form-group').removeClass('has-success').addClass('has-error');
        check = 1;
      } else {
        scheduledate.closest('.form-group').removeClass('has-error').addClass('has-success');
      }

      if(!scheduledateend.val()) {
        scheduledateend.closest('.form-group').removeClass('has-success').addClass('has-error');
        check = 1;
      } else {
        scheduledateend.closest('.form-group').removeClass('has-error').addClass('has-success');
      }

      if(!user_qty.val()) {
        user_qty.closest('.form-group').removeClass('has-success').addClass('has-error');
        check = 1;
      } else {
        user_qty.closest('.form-group').removeClass('has-error').addClass('has-success');
      }

      if(!price.val()) {
        price.closest('.form-group').removeClass('has-success').addClass('has-error');
        check = 1;
      } else {
        price.closest('.form-group').removeClass('has-error').addClass('has-success');
      }

      if(0 == check){

        var bbCode_detail = $().CKEditorValFor('editor1');

        var bbCode_payment = $().CKEditorValFor('editor2');

        var bbCode_afterpayment = $().CKEditorValFor('editor3');

        $.post("add_schedule.php",
        {
          schedulename: $("#schedulename").val(),
          scheduledate: $("#scheduledate").val(),
          scheduledateend : $("#scheduledateend").val(),
          user_qty : $("#user_qty").val(),
          price : $("#price").val(),
          scheduledesc: bbCode_detail,
          payment : bbCode_payment,
          afterpayment : bbCode_afterpayment,
          site_id: '<?php echo $site_id; ?>',
        },
        function(data,status){
                      //alert("Data: " + data + "\nStatus: " + status);
                      location.reload();
                    });
      }
    });
});
</script>
<?php eb();?>

<?php render($MasterPage);?>
