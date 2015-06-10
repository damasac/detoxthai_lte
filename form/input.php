<?php require_once '../_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

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
       
          <div class="box-body">
            
            <div class="row">
                <div class="col-lg-12">
                <div class="showError" id="showError" style="display:none;"></div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                <h3>
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
                    สถานที่ <code><?php echo $dbarr['site_name'];?></code> วันที่ <code><?php echo System_ShowDate($data['startdate']);?></code> ถึง <code><?php echo System_ShowDate($data['enddate']);?></code>
                </h3>
                
                
                
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
            <?php include_once "form_consent.php";include_once "form_person.php";include_once "form_1.php";include_once "form_2.php"; ?>
            
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
<?php eb();?>
 
<?php render($MasterPage);?>