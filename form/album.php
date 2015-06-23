<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>
<link rel="stylesheet" href="gallery-js/css/blueimp-gallery.min.css">
<link rel="stylesheet" href="gallery-js/css/bootstrap-image-gallery.min.css">

<script type="text/javascript" src="ajax-upload/JQuery.JSAjaxFileUploader.js"></script>
<link href="ajax-upload/JQuery.JSAjaxFileUploader.css" rel="stylesheet" type="text/css" />

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
       
            <!--<div class="pull-right">
              <div class="form-group">
                  <label for="exampleInputEmail2">เลือกหมวดภาพ</label>
                  <select class="form-control">
                  <option>สิ่งที่ออกมาจากการสวนล้างลำไส้</option>
                  <option>สภาพร่างกาย</option>
                  <option>หลักฐานผลการตรวจร่างกาย</option>
                  <option>อาหาร ยา หรือสิ่งต่างๆที่ใช้</option>
                  <option>อื่นๆ</option>
                </select>
                </div>
            </div>-->
            
            <br><br><br><br>
            
            
            <script>
            var ref_user ='<?php echo $_SESSION['dtt_user_form']; ?>';
            var file_type = 0;
            var status = 0;
            
            $(document).ready(function(){
              $( "#status" ).change(function() {
                file_type = $('#status').val();
                alert( file_type );
              });
              $( "#file_type" ).change(function() {
                status = $('#status').val();
                alert( status );
              });
            });
            

            
            $(document).ready(function(){
                    $('#photo_upload').JSAjaxFileUploader({
                        uploadUrl:'upload-album.php',
                        inputText:'<li class="fa fa-picture-o"></li> เลือกรูปภาพหรือวิดีโอ...',
                        fileName:'photo',
                        allowExt:'gif|jpg|jpeg|png|bmp|mp4',
                        //autoSubmit:false,
                        formData:{ref_user:ref_user, file_type:file_type, status:status},
                        maxFileSize:5400900,
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
            <h2><b>โพสต์รูปภาพ</b></h2><hr>
            <div class="form-group">
                  <div id='photo_upload'></div>
              </div>
            
            <div id="post-photo" class="col-lg-12 col-md-12 col-sm-12" style="border: 2px solid green;padding:20px; display: none;">
                
                <form>
                
               <div class="form-group">
                  <textarea id='detail' class="form-control" rows="3" placeholder="เขียนคำอธิบาย"></textarea>
                </div>
                
                
                <div class="form-group">
                  <label for="exampleInputEmail2">เลือกหมวดภาพ</label>
                  <select id='file_type' class="form-control">
                  <option value='1'>สิ่งที่ออกมาจากการสวนล้างลำไส้</option>
                  <option value='2'>สภาพร่างกาย</option>
                  <option value='3'>หลักฐานผลการตรวจร่างกาย</option>
                  <option value='4'>อาหาร ยา หรือสิ่งต่างๆที่ใช้</option>
                  <option value='0' selected>อื่นๆ</option>
                </select>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail2">ประเภทการแชร์</label>
                  <select id='status' class="form-control">
                  <option value='0'>เป็นความลับส่วนตัวของฉัน</option>
                  <option value='1'>สาธารณะ</option>
                  <option value='2'>เฉพาะสมาชิก DetoxThai</option>
                  <option value='3'>เฉพาะเพื่อนที่ติดตาม</option>
                  <option value='4'>เฉพาะ Admin DetoxThai</option>
                  <option value='5'>เฉพาะสมาชิกที่ระบุ...</option>
                </select>
                </div>
                
                <button type="button" class="btn btn-primary"><li class="fa fa-send"></li> โพสต์</button>

              </form>
            </div>
            
            <hr>
            <div id="photo_upload_file" class="row">
              <?php
                  $sql = "SELECT id, `file_name`, `file_type` FROM tbl_surveyalbum WHERE ref_user='".$_SESSION['dtt_user_form']."' ORDER BY id DESC;";
                  //echo $sql;
                  $result = $conn->query($sql);
                  while($dbarr = $result->fetch_assoc()){
                          
                          if($dbarr['file_type'] =='mp4'){
                          echo '<div  id="divfile'.$dbarr['id'].'" class="col-lg-4 col-md-4 col-sm-4">
                    <a target="_blank" href="file_upload/video/'.$dbarr['file_name'].'"><i class="fa fa-file-video-o fa-5x"></i></a><br><br>
                    <a class="btn btn-success" target="_blank" href="file_upload/video/'.$dbarr['file_name'].'">ดูขนาดใหญ่</a>
                    <a  style="cursor : pointer;" onclick="del_file(\''.$dbarr['id'].'\', \'divfile'.$dbarr['id'].'\');" class="btn btn-danger"><li class="fa fa-picture-o"></li> ลบ</a>
                </div>';
                          }
                          else {
                             echo '<div  id="divfile'.$dbarr['id'].'" class="col-lg-4 col-md-4 col-sm-4">
                    <a target="_blank" href="file_upload/album/'.$dbarr['file_name'].'" data-gallery>
                    <img class="img-responsive img-thumbnail" src="file_upload/album/'.$dbarr['file_name'].'">
                    </a>
                    <br><br>
                    <a class="btn btn-success" href="file_upload/video/'.$dbarr['file_name'].'" data-gallery>ดูขนาดใหญ่</a>
                    <a  style="cursor : pointer;" onclick="del_file(\''.$dbarr['id'].'\', \'divfile'.$dbarr['id'].'\');" class="btn btn-danger"><li class="fa fa-picture-o"></li> ลบ</a>
                </div>';
                          }
                  }
                  ?>
                
                
            </div>
         
            
          </div><!-- /.box-body -->
    </div><!-- /.box -->

  </section><!-- /.content -->'
  
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
<script src="gallery-js/js/jquery.blueimp-gallery.min.js"></script>
<script src="gallery-js/js/bootstrap-image-gallery.min.js"></script>

<script>
  function del_file(file_id, div) {
    $.get( "remove_file_album.php", { file_id: file_id } )
    .done(function( data ) {
      $('#'+div).fadeOut();
    });
}
</script>

<?php eb();?>
 
<?php render($MasterPage);?>