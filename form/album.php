<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>
  
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
       
            <div class="col-lg-12 col-md-12 col-sm-12" style="border: 2px solid green;padding:20px;">
                <h2><b>โพสต์รูปภาพ</b></h2><hr>
                <form>
                  
                <div class="form-group">
                  <input type="file" id="exampleInputFile">
                </div>
                
                <div class="form-group">
                  <textarea class="form-control" rows="3" placeholder="เขียนคำอธิบาย"></textarea>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail2">เลือกหมวดภาพ</label>
                  <select class="form-control">
                  <option>สิ่งที่ออกมาจากการสวนล้างลำไส้</option>
                  <option>สภาพร่างกาย</option>
                  <option>หลักฐานผลการตรวจร่างกาย</option>
                  <option>อาหาร ยา หรือสิ่งต่างๆที่ใช้</option>
                  <option>อื่นๆ</option>
                  <option>+ เพิ่มหมวด</option>
                </select>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail2">Email</label>
                  <select class="form-control">
                  <option>เป็นความลับส่วนตัวของฉัน</option>
                  <option>สาธารณะ</option>
                  <option>เฉพาะสมาชิก DetoxThai</option>
                  <option>เฉพาะเพื่อนที่ติดตาม</option>
                  <option>เฉพาะ Admin DetoxThai</option>
                  <option>เฉพาะสมาชิกที่ระบุ...</option>
                </select>
                </div>
                
                <button type="submit" class="btn btn-primary"><li class="fa fa-send"></li> โพสต์</button>
              </form>
            </div>
            
            <hr>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4"> 
                    <img class="img-responsive img-thumbnail" src="http://lorempixel.com/400/200/nature/">
                    <a href="album.php" class="btn btn-success"><li class="fa fa-share-alt"></li> แชร์</a> <a href="album.php" class="btn btn-danger"><li class="fa fa-picture-o"></li> ลบ</a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4"> 
                    <img class="img-responsive img-thumbnail" src="http://lorempixel.com/400/200/nature/">
                    <a href="album.php" class="btn btn-success"><li class="fa fa-share-alt"></li> แชร์</a> <a href="album.php" class="btn btn-danger"><li class="fa fa-picture-o"></li> ลบ</a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4"> 
                    <img class="img-responsive img-thumbnail" src="http://lorempixel.com/400/200/nature/">
                    <a href="album.php" class="btn btn-success"><li class="fa fa-share-alt"></li> แชร์</a> <a href="album.php" class="btn btn-danger"><li class="fa fa-picture-o"></li> ลบ</a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4"> 
                    <img class="img-responsive img-thumbnail" src="http://lorempixel.com/400/200/nature/">
                    <a href="album.php" class="btn btn-success"><li class="fa fa-share-alt"></li> แชร์</a> <a href="album.php" class="btn btn-danger"><li class="fa fa-picture-o"></li> ลบ</a>
                </div>
            </div>
         
            
          </div><!-- /.box-body -->
    </div><!-- /.box -->

  </section><!-- /.content -->'
  
<?php eb();?>


<?php sb('js_and_css_footer');?>

<?php eb();?>
 
<?php render($MasterPage);?>