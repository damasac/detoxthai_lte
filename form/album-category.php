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
<?php include_once "../_connection/db_form.php"; include_once("system_function.php"); ?>

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
          <div>
            <a href="album.php" class="text-left btn btn-lg btn-primary"><li class="fa fa-chevron-left fa-1x"></li> กลับหน้าอัลบั้มรูปภาพ</a>
            <a onclick="popup_album('add', '');"class="pull-right btn btn-lg btn-success"><li class="fa fa-plus fa-1x"></li> เพิ่มหมวดใหม่</a><hr>
          </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr class="h4" style="background-color: #c0c0c0; color: #00; font-weight: 900;">
                  <th>#</th>
                  <th>ชื่อหมวด</th>
                  <th>รายละเอียด</th>
                  <th>วันที่สร้าง</th>
                  <th>การจัดการ</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $sql = "SELECT id, name, detail, createtime FROM tbl_surveyalbum_type WHERE ref_user ='".$_SESSION['dtt_user_form']."';";
                $result = $conn->query($sql);
                $i=1;
                while($dbarr = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $dbarr['name']; ?></td>
                    <td><?php echo $dbarr['name']; ?></td>
                    <td><?php $obdate = new DateTime($dbarr['createtime']); echo $obdate->format('d/m').'/'.($obdate->format('Y')+543); ?></td>
                    <td><a class="btn btn-success" onclick="popup_album('add', '<?php echo $dbarr['id']; ?>')"><li class="fa fa-edit"></li></a>
                        <a class="btn btn-danger" onclick="return confirm('ยืนยันการลบ ?');" href="album-category-ajax.php?task=remove&id=<?php echo $dbarr['id']; ?>"><li class="fa fa-times"></li></a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>


          </div><!-- /.box-body -->
    </div><!-- /.box -->

  </section><!-- /.content -->

<?php eb();?>

<?php sb('js_and_css_footer');?>



<script type="text/javascript" src="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
<script type="text/javascript">
function popup_album(task, id) {

	dialogPopWindow = BootstrapDialog.show({
		title: 'Add Category Photo',
		cssClass: 'popup-dialog',
		size:'size-wide',
		draggable: false,
		message: $('<div></div>').load("album-category-ajax.php?task="+task+"&id="+id, function(data){
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
