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
    input[type=radio] {
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
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">SITE NAME HERE</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="pull-right">
                <a href="." class="btn btn-primary btn-lg active"><li class="fa fa-home"></li> รายการข้อมูลการล้างพิษตับ</a>
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
            <?php include_once "form_1.php"; ?>
            <?php
                $sqlx =  "SELECT MIN(b.id) as min FROM `tbl_surveyform` AS a INNER JOIN  tbl_surveyuser AS b ON a.ref_id_create=b.id WHERE b.user_id = '".$_SESSION['dtt_user_form']."';";
                $queryx = $conn->query($sqlx);
                $resx = $queryx->fetch_assoc();
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



          </div><!-- /.box-body -->
    </div><!-- /.box -->


  </section><!-- /.content -->'
  
<?php eb();?>


<?php sb('js_and_css_footer');?>
<script type="text/javascript" src="script/fnc_javascript.js"></script>
<script type='text/javascript' src="script/bootstrap-slider.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>

<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>

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
</script>



<?php eb();?>
 
<?php render($MasterPage);?>