<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<link rel="stylesheet" href="_plugins/datepicker/datepicker3.css">
<style type="text/css">
  .sceditor-container {
    height: 700px;
  }
  iframe {
    height: 82% !important;
    width: 97% !important;
  }
</style>
<?php eb();?>

<?php
function getDateThai($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("j",strtotime($strDate));
  $strDay= date("n",strtotime($strDate));
  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear";
}

isset($_GET['site_id']) ? $site_id = $_GET['site_id'] :  $site_id = '';

?>

<?php sb('content');?>
<?php include_once "_connection/db_base.php"; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    จัดการหลักสูตรล้างพิษตับ
    <small>เพิ่ม แก้ไข ลบ หลักสูตรล้างพิษตับ</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">SITE NAME HERE</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">หลักสูตรล้างพิษตับทั้งหมด</h3>
    </div>
    <div class="box-body">
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
            จำนวนที่รับ
          </th>
          <th>
            ราคา/คน
          </th>
          <th>
            รายละเอียด
          </th>
        </tr>
        <?php
        $count = 1;
        $script = "";
        $modal = "";
        // prepare and query (direct)
        $result = $mysqli->query("SELECT id, schedule_name, user_qty, DATE_FORMAT(schedule_date,'%d-%m-%Y') AS schedule_date, DATE_FORMAT(schedule_end_date,'%d-%m-%Y') AS schedule_end_date, price_per_person, schedule_desc, schedule_payment, schedule_after_payment FROM site_schedule ORDER BY id");
        if ($result !== false) {
          foreach($result as $row) {
            echo "<tr>
            <td>".$count."</td>
            <td>".getDateThai($row['schedule_date'])." - ".getDateThai($row['schedule_end_date'])."</td>
            <td>".$row['schedule_name']."</td>
            <td>".$row['user_qty']." คน</td>
            <td>".number_format($row['price_per_person'])." บาท</td>
            <td><button type='button' class='btn btn-primary btn-flat' data-toggle='modal' data-target='#myModal".$count."'>รายละเอียด</button></td>
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
                  <a type='button' href='join_schedule.php?schedule_id=".$row['id']."' class='btn btn-primary btn-flat'>เข้าร่วมหลักสูตร</a>
                </p>
                <p><strong>วันที่ :</strong> ".getDateThai($row['schedule_date'])." - ".getDateThai($row['schedule_end_date'])."</p>
                <p><strong>ชื่อหลักสูตร :</strong> ".$row['schedule_name']."</p>
                <p><strong>จำนวนที่รับ :</strong> ".$row['user_qty']." คน</p>
                <p><strong>ราคา/คน :</strong> ".number_format($row['price_per_person'])." บาท</p>
                <p><strong>รายละเอียด :<hr/></strong><p>
                <textarea class='form-control' id='detail".$count."' rows='50' id='scheduledesc' placeholder='รายละเอียดหลักสูตร'>".html_entity_decode($row['schedule_desc'])."</textarea>
                <p><strong>รายละเอียดการจ่ายเงิน :<hr/></strong><p>
                <textarea class='form-control' id='payment".$count."' rows='50' id='scheduledesc' placeholder='รายละเอียดหลักสูตร'>".html_entity_decode($row['schedule_payment'])."</textarea>
                <p><strong>รายละเอียดหลังการจ่ายเงิน :<hr/></strong><p>
                <textarea class='form-control' id='afterpayment".$count."' rows='50' id='scheduledesc' placeholder='รายละเอียดหลักสูตร'>".html_entity_decode($row['schedule_after_payment'])."</textarea>
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-default btn-flat' data-dismiss='modal'>Close</button>
              </div>
            </div>
          </div>
        </div>";
        $script .= "$('#detail".$count."').sceditor({
                plugins: 'bbcode',
                width: '98%',
                toolbar: 'justify',
                readOnly: 'true',
                resizeEnabled: false,
                style: 'edit/minified/jquery.sceditor.default.min.css'
              });";
        $script .= "$('#payment".$count."').sceditor({
                plugins: 'bbcode',
                width: '98%',
                toolbar: 'justify',
                readOnly: 'true',
                resizeEnabled: false,
                style: 'edit/minified/jquery.sceditor.default.min.css'
              });";
        $script .= "$('#afterpayment".$count."').sceditor({
                plugins: 'bbcode',
                width: '98%',
                toolbar: 'justify',
                readOnly: 'true',
                resizeEnabled: false,
                style: 'edit/minified/jquery.sceditor.default.min.css'
              });";

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
          <h4 class="modal-title" id="myModalLabel">เพิ่มหลักสูตรล้างพิษตับ</h4>
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
</div><!-- /.box-body -->
</div><!-- /.box -->

</section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>
<link rel="stylesheet" type="text/css" href="_plugins/edit/minified/themes/default.min.css">
<script src="_plugins/edit/minified/jquery.sceditor.bbcode.min.js"></script>
<script type="text/javascript" src="_plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
  $(document).ready(function(){
    $("#scheduledate").datepicker();
    $("#scheduledateend").datepicker();

    $("#detail").sceditor({
      plugins: "bbcode",
      width: '98%',
      resizeEnabled: false,
      style: "edit/minified/jquery.sceditor.default.min.css"
    });

    $("#payment").sceditor({
      plugins: "bbcode",
      width: '98%',
      resizeEnabled: false,
      style: "edit/minified/jquery.sceditor.default.min.css"
    });

    $("#afterpayment").sceditor({
      plugins: "bbcode",
      width: '98%',
      resizeEnabled: false,
      style: "edit/minified/jquery.sceditor.default.min.css"
    });

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

        var bbCode_detail = $('#detail').sceditor('instance').val();
        //var html_detail = $('#detail').sceditor('instance').fromBBCode(bbCode_detail);

        var bbCode_payment = $('#payment').sceditor('instance').val();
        //var html_payment = $('#payment').sceditor('instance').fromBBCode(bbCode_payment);

        var bbCode_afterpayment = $('#afterpayment').sceditor('instance').val();
        //var html_afterpayment = $('#afterpayment').sceditor('instance').fromBBCode(bbCode_afterpayment);

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

    <?php echo $script; ?>
});
</script>
<?php eb();?>

<?php render($MasterPage);?>
