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
          width: 350px !important;
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
                <div class="showError" id="showError" style="display:none;"></div>
                </div>
            </div>
            
            <input type="hidden" class="form-control" value="<?php echo $_SESSION['dtt_user_form'];?>" id="form_id" />
            <?php
            $sql = "SELECT ref_id_user FROM tbl_surveyprivate WHERE ref_id_user = '".$_SESSION['dtt_user_form']."';";
            $query = $conn->query($sql) or die($conn->error());
            $data = $query->fetch_assoc();
            
            if(!$data['ref_id_user']){
                $sql = "INSERT INTO `tbl_surveyprivate`(`ref_id_user`) VALUES('".$_SESSION['dtt_user_form']."')";
                $query = $conn->query($sql) or die($conn->error());
            }
            
                $sqlSelectValue =  "SELECT * FROM `tbl_surveyprivate` WHERE ref_id_user='".$_SESSION['dtt_user_form']."' ";
                $querySelectValue = $conn->query($sqlSelectValue);
                $dataform = $querySelectValue->fetch_assoc();
            ?>
            <div id="formsurvey">
            <!-------------------------- form 1-2-->
            <?php include_once "form_consent.php"; include_once "form_person.php";?>
            
            <hr>
            <h3><b>*หมายเหตุ เมื่อท่านกดปุ่ม "<u>ข้อมูลทั้งหมดถูกต้อง</u>" ข้อมูลจะถูกจัดเก็บเป็นความลับ และจะแก้ไขไม่ได้ (ถ้าจำเป็นต้องแก้ไข ต้องส่งคำขอแก้ข้อมูล เพื่อเสนอแก้ไขต่อไป)</b></h3>
            <div class="pull-right">
            <?php if(($dataform['status']+0)) { ?>
            <a class="btn btn-danger btn-lg btn-flat"><li class="fa fa-lock"></li> ข้อมูลถูกจัดเก็บเป็นความลับแล้ว</a>
            <a class="btn btn-info btn-lg btn-flat" id="btnFormEdit"><li class="fa fa-pencil-square-o"></li> เสนอแก้ไขข้อมูล</a>
            <?php } else { ?>
            <a id="btnChkdata" class="btn btn-success btn-lg btn-flat"><li class="fa fa-check"></li> ข้อมูลทั้งหมดถูกต้อง</a>
            <?php } ?>
            </div>
            <br><br>
            <hr>
            
            </div>



          </div><!-- /.box-body -->
    </div><!-- /.box -->


  </section><!-- /.content -->'
  
<?php eb();?>


<?php sb('js_and_css_footer');?>
<?php if(!($dataform['status']+0)) { ?>
<script type="text/javascript" src="script/fnc_javascript.js"></script>
<?php } else { ?>
<script>
    $("input").prop('disabled', true);
    $("select").prop('disabled', true);
</script>
<?php } ?>

<script>
    $( "#btnChkdata" ).click(function() {
        var chk = confirm("ยืนว่า ข้อมูลทั้งหมดถูกต้อง.");
        if (chk) {
           var user_id =$('#form_id').val();
            $.post( "ajax.php",
                { user_id: user_id, task:'setFormPrivate' },
                function( data ) {
                    parent.location='index.php';
                });
        }
        
    });
	//
	$( "#btnFormEdit" ).click(function() {
        //var chk = confirm("ยืนว่า ข้อมูลทั้งหมดถูกต้อง.");
        if (1) {
           var user_id =$('#form_id').val();
            $.post( "ajax.php",
                { user_id: user_id, task:'setFormPrivateEdit' },
                function( data ) {
                    parent.location='form_private.php';
                });
        }
        
    });
</script>
<script type='text/javascript' src="script/bootstrap-slider.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>

<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>
<?php eb();?>
 
<?php render($MasterPage);?>