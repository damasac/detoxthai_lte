<?php
session_start();
header("Content-type:text/html; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

## System Start ############################################################
include_once "../_connection/db_base.php";
############################################################################

if($_GET['task']=="manage"){
    $sql = "SELECT id, `file_name`, `file_type`, detail,  photo_type, status FROM tbl_surveyalbum WHERE ref_user='".$_SESSION['dtt_user_form']."' AND id='".$_GET['id']."';";
    $query = $mysqli->query($sql);
    $result = $query->fetch_assoc();
    if($result['file_type']=='mp4'){
      echo '<video width="100%" height="350" controls>
        <source src="file_upload/video/'.$result['file_name'].'" type="video/mp4">
      Your browser does not support the video tag.
      </video>';
    }  else{
      echo '<img class="img-responsive" src="file_upload/album/large/'.$result['file_name'].'">';
      echo "[คลิกที่รูปภาพเพื่อดูขนาดเต็ม]";
    }

    ?>

    <div id="div-save" class="alert alert-success" style="display:none;"></div>
        <form>

       <div class="form-group">
          <textarea id='detail' class="form-control" rows="3" placeholder="เขียนคำอธิบาย" onblur="edit_save('detail', $(this).val(), '<?php echo $_GET['id']; ?>');"><?php echo $result['detail']; ?></textarea>
        </div>


        <div class="form-group">
          <label for="exampleInputEmail2">เลือกหมวด</label>
          <select id='photo_typex' class="form-control">
          <option value='1' <?php if($result['photo_type']==1) echo ' selected'; ?>>สิ่งที่ออกมาจากการสวนล้างลำไส้</option>
          <option value='2' <?php if($result['photo_type']==2) echo ' selected'; ?>>สภาพร่างกาย</option>
          <option value='3' <?php if($result['photo_type']==3) echo ' selected'; ?>>หลักฐานผลการตรวจร่างกาย</option>
          <option value='4' <?php if($result['photo_type']==4) echo ' selected'; ?>>อาหาร ยา หรือสิ่งต่างๆที่ใช้</option>
          <option value='99' <?php if($result['photo_type']==99) echo ' selected'; ?>>อื่นๆ</option>
          <option value='add'>+ เพิ่มหมวด</option>
        </select>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail2">ประเภทการแชร์</label>
          <select id='statusx' class="form-control" onchange="edit_save('status', $(this).val(), '<?php echo $_GET['id']; ?>');">
          <option value='1' <?php if($result['status']==1) echo ' selected'; ?>>เป็นความลับส่วนตัวของฉัน</option>
          <option value='2' <?php if($result['status']==2) echo ' selected'; ?>>แชร์เพื่อให้นักวิจัยสามารถดูได้</option>
        </select>
        </div>

        <a href="album.php" target="_parent" class="btn btn-primary btn-block"><li class="fa fa-edit"></li> เสร็จแล้ว</a>

      </form>
      <script type="text/javascript">
      //$(document).ready(function(){
      $( "#photo_typex" ).change(function() {
          var add = $(this).val();
          if(add == 'add'){
            var url = "album-category.php";
            $(location).attr('href',url);
          }else{
            edit_save('photo_type', $(this).val(), '<?php echo $_GET['id']; ?>');
          }
      });
    //});
      function edit_save(field_id, val, id){
        $.post( "album-loadimg.php?task=edit-save", { field_id: field_id, val:val, id: id },  function( data ) {
          $('#div-save').fadeIn();
          $('#div-save').html('บันทึกข้อมูลแล้ว');
        });
      }
      </script>

<?php
}else if($_GET['task']=='edit-save') {
  $field_id = $_POST['field_id'];
  $val = $_POST['val'];
  $id = $_POST['id'];

  $sql = "UPDATE tbl_surveyalbum SET $field_id ='$val' WHERE id='$id';";
  $query = $mysqli->query($sql);
}
?>
