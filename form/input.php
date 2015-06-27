<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>
<link rel="stylesheet" href="script/bootstrap-slider.css">
<link rel="stylesheet" href="css/datepicker.css">

<style>
    body{
        font-size: 20px;
    }
    .form-group.paddingleft {
          padding-bottom: 5px;
          padding-left: 50px;
    }
    .form-group.fix {
          padding-bottom: 5px;
    }
    .form-control.fix {
          width: 270px !important;
    }
    .p3tableheader {
      background-color: #ccc;
    }
    .radio.p3paddingleft {
      padding-left: 50px;
    }
    .form-control.fix2 {
          width: 40px !important;
    }
    @media (min-width:765px) {
         input[type=radio] {
            margin-left : -22px !important;
            position: static !important;
            border: 0px;
            width: 35px;
            height: 35px;
           }
    }
    input[type=radio] {
    margin-left : 0px !important;
    position: static !important;
    border: 0px;
    width: 35px;
    height: 35px;
   }
    input[type=checkbox]
    {
        margin: auto;
      width: 25px;
      height: 100%;
    }
    .textindent{
      text-indent: 1.5em;
    }
    .table-responsive.fix {
      overflow-x: hidden;
    }
    .showError{
      padding:20px;
      background-color:#FE2B2B;
      border-radius:2px;
      color:white;
    }
</style>

<link rel="stylesheet" href="gallery-js/css/blueimp-gallery.min.css">
<link rel="stylesheet" href="gallery-js/css/bootstrap-image-gallery.min.css">
<?php eb();?>

<?php sb('notifications');?>
  <?php include_once '../notifications.php'; ?>
<?php eb();?>

<?php sb('content');?>
<?php include_once "../_connection/db_form.php"; ?>

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      บันทึกข้อมูลการล้างพิษตับ
      <small>สำหรับฐานข้อมูลทะเบียนผู้ล้างพิษตับ (Liver Flushing Registry)</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="../"><i class="fa fa-dashboard"></i> หน้าแรก</a></li>
      <li><a href="index.php"><i class="fa fa-dashboard"></i> หน้าแรกบันทึกข้อมูล</a></li>
      <li class="active">ฟอร์มบันทึกข้อมูล</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="pull-right">
                <a href="album.php" class="btn btn-success btn-lg"><li class="fa fa-picture-o"></li> อัลบั้มภาพ</a>
                <a href="." class="btn btn-primary btn-lg"><li class="fa fa-list"></li> รายการข้อมูลการล้างพิษตับ</a>
                <a href="form_private.php" class="btn btn-danger btn-lg"><li class="fa fa-lock"></li> ข้อมูลส่วนบุคคล</a>
            </div>
          </div>

          <div class="box-body">

            <div class="row">
                <div class="col-lg-12">
                <div class="alert alert-danger" id="showError" style="display:none;"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">

                <?php
                if(isset($_GET["form_id"])){
                    $form_id =$_GET["form_id"];
                }else{
                    $form_id='';
                }
                ?>
                <?php
                include_once("system_function.php");
                $sql = "SELECT * FROM `tbl_surveyuser` WHERE id='".$form_id."';";
                $query = $conn->query($sql);
                $data = $query->fetch_assoc();
                if($data["location"] =='10000001'){ $dbarr['site_name'] = 'บ้าน';} else if($data['location']=='10000002') {$dbarr['site_name']= 'อื่นๆ'; } else {
                   $sql = "select `site_name` from site_detail where id='".$data['location']."';";
                   $res = $conn->query($sql);
                   $dbarr = $res->fetch_assoc();
                }
                ?>

                </div>
            </div>


            <input type="hidden" class="form-control" value="<?php echo $form_id;?>" id="form_id" />
            <?php
                $sqlSelectValue =  "SELECT * FROM `tbl_surveyform` WHERE ref_id_create='".$form_id."' ";
                $querySelectValue = $conn->query($sqlSelectValue);
                $dataform = $querySelectValue->fetch_assoc();
            ?>
            <div id="formsurvey">
            <!-------------------------- form 1-2-->
            <?php
                $sqlx =  "SELECT MIN(b.id) as min FROM `tbl_surveyform` AS a INNER JOIN  tbl_surveyuser AS b ON a.ref_id_create=b.id WHERE b.user_id = '".$_SESSION['dtt_user_form']."';";
                $queryx = $conn->query($sqlx);
                $resx = $queryx->fetch_assoc();

                include_once "form_1.php";

                if($form_id == $resx['min'])
                    include_once "form_2.php";
                else{ ?>
                <table class="table table-hover" style="border: 1.5px solid green;">
			<tr>
				<td class="p3tableheader"  style="background-color:green;color:white;border:1.5px solid green;">
					<strong>ตอนที่ 2 ผลการล้างพิษตับในครั้งที่ผ่านมา (ท่านได้กรอกไปแล้วในครั้งแรก)</strong>
				</td>
			</tr>
                </table>
                <?php
                }
            ?>

            <!-------------------------- form 3-4-->
            <?php include_once "form_3.php"; ?>
            <?php include_once "form_4.php"; ?>

            <!-------------------------- form 5-6-->
            <?php include_once "form_5.php"; ?>
            <?php include_once "form_6.php"; ?>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="index.php" class="btn btn-success btn-lg btn-flat"><li class="fa fa-check"></li> บันทึกข้อมูล</a>
                </div>
            </div>

          </div><!-- /.box-body -->
    </div><!-- /.box -->


  </section><!-- /.content -->

  <div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php eb();?>


<?php sb('js_and_css_footer');?>
<script type="text/javascript" src="script/fnc_javascript.js"></script>
<script type='text/javascript' src="script/bootstrap-slider.js"></script>

<script src="datepicker/bootstrap-datepicker.js"></script>
<script src="datepicker/bootstrap-datepicker-thai.js"></script>
<script src="datepicker/bootstrap-datepicker.th.js"></script>

<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>

<script src="gallery-js/js/jquery.blueimp-gallery.min.js"></script>
<script src="gallery-js/js/bootstrap-image-gallery.min.js"></script>

<script type='text/javascript'>
    // With JQuery
    $("#p4a7").slider({
            tooltip: 'always'
    });

    $("#p1a10").click(function(){
    if ($("#p1a10").is(":checked")) {
      $("#tableHide1").fadeOut();
      $("#p1a10").val("1");
      AutoSave("p1a10",$("#form_id").val());
    }else{
      $("#p1a10").val("0");
      $("#tableHide1").fadeIn();
      AutoSave("p1a10",$("#form_id").val());
    }
  });
$("#p2a1").click(function(){
  if ($("#p2a1").is(":checked")) {
      $("#p2a1").val("1");
      $("#labelHide2").fadeOut();
      $("#tableHide2").fadeOut();
       AutoSave("p2a1",$("#form_id").val());
    }else{
      $("#p2a1").val("0");
      $("#tableHide2").fadeIn();
      $("#tableHide2").fadeIn();
      AutoSave("p2a1",$("#form_id").val());
    }
  });
//
var originalVal;
$('#p4a7').slider().on('slideStart', function(ev){
    originalVal = $('#p4a7').data('slider').getValue();
      AutoSave("p4a7",$("#form_id").val());
});
$('#p4a7').slider().on('slideStop', function(ev){
    var newVal = $('#p4a7').data('slider').getValue();
    if(originalVal != newVal) {
        //console.log(originalVal+"  2");
        AutoSave("p4a7",$("#form_id").val());
    }
});

//
datepicker_hide('p1a2b1');
datepicker_hide('p1a7b1');

datepicker_hide('p1a10b2c1');
datepicker_hide('p1a10b2c2');
datepicker_hide('p1a10b2c3');
datepicker_hide('p1a10b2c4');
datepicker_hide('p1a10b2c5');
datepicker_hide('p1a10b2c6');
function datepicker_hide(datePick){
  $(function(){
	  $('#'+datePick).on('changeDate', function(ev){
		$(this).datepicker('hide');

	});
});
}

function del_file(file_id, div) {
    $.get( "remove_file.php", { file_id: file_id } )
    .done(function( data ) {
      $('#'+div).fadeOut();
    });
}
</script>

<script type="text/javascript" src="ajax-upload/JQuery.JSAjaxFileUploader.js"></script>
<link href="ajax-upload/JQuery.JSAjaxFileUploader.css" rel="stylesheet" type="text/css" />


<?php eb();?>

<?php render($MasterPage);?>
