<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<link rel="stylesheet" href="../_plugins/datepicker/datepicker3.css">
<?php eb();?>

<?php sb('content');?>
<?php include_once "../_connection/db_base.php"; ?>
<?php
  $id = $_GET['schedule_id'];

  $result = $mysqli->query("SELECT `id`, `schedule_name`, `schedule_date`, `schedule_end_date`, `user_qty`, `price_per_person`, `schedule_desc`, `schedule_payment`, `schedule_after_payment`, `site_id`
            FROM site_schedule
            WHERE id = '$id'");
  $row = $result->fetch_assoc();
?>

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      แก้ไขหลักสูตร
      <small>แก้ไขหลักสูตร</small>
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
          <h3 class="box-title">หลักสูตร</h3>
        </div>
        <div class="box-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="schedulename" class="col-sm-2 control-label">ชื่อหลักสูตร</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="schedulename" placeholder="ชื่อหลักสูตร" value="<?php echo $row['schedule_name']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="scheduledate" class="col-sm-2 control-label">วันที่เริ่ม</label>
              <div class="col-sm-10">
                <input type="text" data-date-format="dd/mm/yyyy" class="form-control" id="scheduledate" placeholder="วัน/เดือน/ปี" value="<?php $date = date_create($row['schedule_date']); echo date_format($date, 'm/d/Y'); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="scheduledateend" class="col-sm-2 control-label">วันที่สิ้นสุด</label>
              <div class="col-sm-10">
                <input type="text" data-date-format="dd/mm/yyyy" class="form-control" id="scheduledateend" placeholder="วัน/เดือน/ปี" value="<?php $date = date_create($row['schedule_end_date']); echo date_format($date, 'm/d/Y'); ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="user_qty" class="col-sm-2 control-label">จำนวนคน</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="user_qty" placeholder="จำนวนคน" value="<?php echo $row['user_qty']; ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="price" class="col-sm-2 control-label">ราคา/คน</label>
              <label class="sr-only" for="price">ราคา/คน</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <div class="input-group-addon">฿</div>
                  <input type="number" class="form-control" id="price" placeholder="ราคา" value="<?php echo $row['price_per_person']; ?>">
                  <div class="input-group-addon">.00</div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="scheduledesc" class="col-sm-2 control-label">รายละเอียดหลักสูตร</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="detail" rows="50" id="scheduledesc" placeholder=""><?php echo $row['schedule_desc']; ?></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="scheduledesc" class="col-sm-2 control-label">รายละเอียดการโอนเงิน</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="payment" rows="50" id="scheduledesc" placeholder=""><?php echo $row['schedule_payment']; ?></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="scheduledesc" class="col-sm-2 control-label">รายละเอียดหลังการโอนเงินเรียบร้อยแล้ว</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="afterpayment" rows="50" id="scheduledesc" placeholder=""><?php echo $row['schedule_after_payment']; ?></textarea>
              </div>
            </div>
          </form>
          <p class="text-center">
          <button type="button" id="btnedit" class="btn btn-primary btn-flat">แก้ไข</button>
          </p>
        </div><!-- /.box-body -->
  </div><!-- /.box -->

  </section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>
<script type="text/javascript" src="../_plugins/datepicker/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../_plugins/edit/minified/themes/default.min.css">
<script src="../_plugins/edit/minified/jquery.sceditor.bbcode.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
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

     $("#btnedit").click(function(){

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

        $.post("update_schedule.php",
        {
          schedulename: $("#schedulename").val(),
          scheduledate: $("#scheduledate").val(),
          scheduledateend : $("#scheduledateend").val(),
          user_qty : $("#user_qty").val(),
          price : $("#price").val(),
          scheduledesc: bbCode_detail,
          payment : bbCode_payment,
          afterpayment : bbCode_afterpayment,
          id: '<?php echo $id; ?>',
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
