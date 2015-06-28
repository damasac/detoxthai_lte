<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>

<script type="text/javascript" src="ajax-upload/JQuery.JSAjaxFileUploader.js"></script>
<link href="ajax-upload/JQuery.JSAjaxFileUploader.css" rel="stylesheet" type="text/css" />
<link href="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />

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
      <small> เพื่อร่วมสร้างองค์ความรู้ ในฐานข้อมูลทะเบียนผู้ล้างพิษตับ (Liver Flushing Registry)</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="../"><i class="fa fa-dashboard"></i> หน้าแรก</a></li>
      <li><a href="index.php"><i class="fa fa-dashboard"></i> หน้าแรกบันทึกข้อมูล</a></li>
      <li class="active">อัลบั้มรูปภาพ</li>
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

  test



          </div><!-- /.box-body -->
    </div><!-- /.box -->

  </section><!-- /.content -->

<?php eb();?>

<?php sb('js_and_css_footer');?>



<script type="text/javascript" src="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
<script type="text/javascript">
function popup_album(task, id) {

	dialogPopWindow = BootstrapDialog.show({
		title: 'Photo',
		cssClass: 'popup-dialog',
		size:'size-wide',
		draggable: false,
		message: $('<div></div>').load("album-loadimg.php?task="+task+"&id="+id, function(data){
			//runSomeScript();
		}),
		onshown: function(dialogRef){
            //$("#ezfrom").select2();
            //(".select2-input").attr("id","ezfrom");
		},
		onhidden: function(dialogRef){
			//alert('onhidden');
		}
	});
}

</script>

<?php eb();?>

<?php render($MasterPage);?>
