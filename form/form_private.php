<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>
<link rel="stylesheet" href="script/bootstrap-slider.css">
<link rel="stylesheet" href="css/datepicker.css">

<style>
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
    width: 20px;
    height: 20px;
   }
    input[type=checkbox]
    {
      margin: auto;
      width: 19px;
      height: 19px;
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
            <h3 class="box-title">Input Form</h3>
            <div class="pull-right">
                <a href="." class="btn btn-primary btn-lg active"><li class="fa fa-home"></li> บันทึกข้อมูลการล้างพิษตับ</a>
                <a href="form_private.php" class="btn btn-danger btn-lg"><li class="fa fa-lock"></li> ข้อมูลส่วนบุคคล</a>
            </div>
          </div>

          <div class="box-body">
            
            <div class="row">
                <div class="col-lg-12">
                <div class="showError" id="showError" style="display:none;"></div>
                </div>
            </div>
            
            <input type="hidden" class="form-control" value="<?php echo $_SESSION['dtt_puser_id'];?>" id="dtt_puser_id" />
            <?php
                $sqlSelectValue =  "SELECT * FROM `tbl_surveyperson` WHERE ref_id_user='".$_SESSION['dtt_puser_id']."' ";
                $querySelectValue = $conn->query($sqlSelectValue);
                $dataform = $querySelectValue->fetch_assoc();
            ?>
            <div id="formsurvey">
            <!-------------------------- form 1-2-->
            <?php include_once "form_consent.php"; include_once "form_person.php";?>
            
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
<?php eb();?>
 
<?php render($MasterPage);?>