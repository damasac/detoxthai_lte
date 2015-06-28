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
      <li class="active">อัลบั้มรูปภาพของฉัน</li>
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
<?php
// echo $_SESSION['dtt_album_phototype'];
// echo "<hr>";
// echo $_SESSION['dtt_album_status'];
if(empty($_SESSION['dtt_album_phototype']))
  $_SESSION['dtt_album_phototype']='';
if(empty($_SESSION['dtt_album_status']))
  $_SESSION['dtt_album_status']='';
 ?>
            <div class="pull-right">
              <div class="form-group">
                <label for="exampleInputEmail2">เลือกหมวด</label>
                <select id='photo_type' class="form-control" onchange="album_set_session('dtt_album_phototype', $(this).val());">
                <option value='' <?php if($_SESSION['dtt_album_phototype']=='') echo ' selected'; ?>>เลือกทั้งหมด</option>
                <option value='1' <?php if($_SESSION['dtt_album_phototype']==1) echo ' selected'; ?>>สิ่งที่ออกมาจากการสวนล้างลำไส้</option>
                <option value='2' <?php if($_SESSION['dtt_album_phototype']==2) echo ' selected'; ?>>สภาพร่างกาย</option>
                <option value='3' <?php if($_SESSION['dtt_album_phototype']==3) echo ' selected'; ?>>หลักฐานผลการตรวจร่างกาย</option>
                <option value='4' <?php if($_SESSION['dtt_album_phototype']==4) echo ' selected'; ?>>อาหาร ยา หรือสิ่งต่างๆที่ใช้</option>
                <option value='99' <?php if($_SESSION['dtt_album_phototype']==99) echo ' selected'; ?>>อื่นๆ</option>

                <?php
                $sql = "SELECT id, name FROM tbl_surveyalbum_type WHERE ref_user ='".$_SESSION['dtt_user_form']."';";
                $result = $conn->query($sql);
                while($dbarr = $result->fetch_assoc()){?>
                     <option value="<?php echo $dbarr['id']; ?>" <?php if($dbarr['id']==$_SESSION['dtt_album_phototype']) echo ' selected'; ?>><?php echo $dbarr['name']; ?></option>
                <?php } ?>
              </select>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail2">ประเภทการแชร์</label>
                <select id='status' class="form-control" onchange="album_set_session('dtt_album_status', $(this).val());">
                <option value='1' <?php if($_SESSION['dtt_album_status']==1) echo ' selected'; ?>>เป็นความลับส่วนตัวของฉัน</option>
                <option value='2' <?php if($_SESSION['dtt_album_status']==2) echo ' selected'; ?>>แชร์เพื่อให้นักวิจัยสามารถดูได้</option>
                <option value='' <?php if($_SESSION['dtt_album_status']=='') echo ' selected'; ?>>เลือกทั้งหมด</option>
              </select>
              </div>
            </div>

            <script type="text/javascript">

            function album_set_session(ss_name, val){
                $.post( "album-set-session.php?task=set-session", { ss_name:ss_name, val:val },  function( data ) {
                  var url = "album.php";
                  $(location).attr('href',url);
                });
            }

            </script>

            <br><br><br><br>


            <script>
            var ref_user ='<?php echo $_SESSION['dtt_user_form']; ?>';

            $(document).ready(function(){
              var size_media = 5400900*40; //200MB
                    $('#photo_upload').JSAjaxFileUploader({
                        uploadUrl:'upload-album.php',
                        inputText:'<span style="font-size:30px !important";><li class="fa fa-picture-o"></li> เลือกรูปภาพหรือวิดีโอ...</span>',
                        fileName:'photo',
                        allowExt:'gif|jpg|jpeg|png|bmp|mp4',
                        //autoSubmit:false,
                        formData:{ref_user:ref_user},
                        maxFileSize:size_media,
                        zoomPreview:true,
                        zoomWidth:260,
                        zoomHeight:260,
                        success: function(returndata){
                            $("#photo_upload_file").prepend(returndata);
                            //$("#post-photo").slideDown();
                        }
                    });
            });

              </script>
            <h2><b>อัลบั้มรูปภาพของฉัน</b></h2><hr>
            <div class="form-group">
                  <div id='photo_upload'></div>
              </div>


            <div id="photo_upload_file">
              <?php


                  $sql = "SELECT id, `file_name`, `file_type`, detail,  photo_type, status  FROM tbl_surveyalbum WHERE ref_user='".$_SESSION['dtt_user_form']."'";
                  if($_SESSION['dtt_album_phototype']<>''){
                    $sql .= " AND photo_type='".$_SESSION['dtt_album_phototype']."'";
                  }
                  if($_SESSION['dtt_album_status']<>''){
                    $sql .= " AND status='".$_SESSION['dtt_album_status']."'";
                  }
                  $sql .= " ORDER BY id DESC;";
                  //echo $sql;
                  $result = $conn->query($sql);
                  while($dbarr = $result->fetch_assoc()){
                    if($dbarr['detail']==''){
                      $dbarr['detail'] = 'ยังไม่ได้ระบุคำอธิบาย';
                    }
                    if($dbarr['status']==1){
                      $dbarr['status'] = 'ส่วนตัว เห็นแค่ฉันเท่านั้น) <li class="text-danger fa fa-lock fa-2x"></li>';
                    }else{
                      $dbarr['status'] = '(เปิด ให้แสดงข้อมูลเฉพาะนักวิจัย) <li class="text-success fa fa-unlock fa-2x"></li>';
                    }
                          if($dbarr['file_type'] =='mp4'){
                          echo '<div class="row" id="divfile'.$dbarr['id'].'">
                          <hr>
                          <div class="col-lg-3 col-md-3 col-sm-3 text-center" style="height:120px;">
                    <a target="_blank" href="file_upload/video/'.$dbarr['file_name'].'"><i class="fa fa-file-video-o fa-5x"></i></a>
                    <h4>คลิกเพื่อชมวิดีโอคลิป</h4>
                    </div>
                    <div class="col-md-9">
                    '.$dbarr['detail'].'
                    <hr>
                    <a  style="cursor : pointer;" onclick="popup_album(\'manage\', \''.$dbarr['id'].'\')" class="btn btn-success"><li class="fa fa-edit"></li> แก้ไข</a>
                    <a  style="cursor : pointer;" onclick="del_file(\''.$dbarr['id'].'\', \'divfile'.$dbarr['id'].'\');" class="btn btn-danger"><li class="fa fa-picture-o"></li> ลบ</a>
                    <div class="pull-right">
                    '.$dbarr['status'].'
                    </div>
                    </div>
                </div>';
                          }
                          else {
                             echo '<div class="row" id="divfile'.$dbarr['id'].'">
                             <hr>
                             <div class="col-lg-3 col-md-3 col-sm-3">
                    <a onclick="popup_album(\'manage\', \''.$dbarr['id'].'\')">
                    <img class="img-responsive img-thumbnail" src="file_upload/album/small/'.$dbarr['file_name'].'">
                    </a>

                    </div>
                    <div class="col-md-9">
                    '.$dbarr['detail'].'
                    <hr>
                    <a  style="cursor : pointer;" onclick="popup_album(\'manage\', \''.$dbarr['id'].'\')" class="btn btn-success"><li class="fa fa-edit"></li> แก้ไข</a>
                    <a  style="cursor : pointer;" onclick="del_file(\''.$dbarr['id'].'\', \'divfile'.$dbarr['id'].'\');" class="btn btn-danger"><li class="fa fa-picture-o"></li> ลบ</a>
                    <div class="pull-right">
                    '.$dbarr['status'].'
                    </div>
                    </div>
                </div>';
                          }
                  }
                  ?>


            </div>


          </div><!-- /.box-body -->
    </div><!-- /.box -->

  </section><!-- /.content -->

<?php eb();?>

<?php sb('js_and_css_footer');?>

<script>
  function del_file(file_id, div) {
    $.get( "remove_file_album.php", { file_id: file_id } )
    .done(function( data ) {
      $('#'+div).fadeOut();
    });
}
</script>

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
