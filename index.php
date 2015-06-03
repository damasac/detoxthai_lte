<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>
<?php include_once "_connection/db.php"; ?>

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Content Management 
      <small>สำหรับ site หลัก</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Detox Thailand</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-primary">
      <!-- row -->
      <div class="row" style="margin: 10px;">
        <div class="col-md-12">



          <div class="entry-content">
            <p><img class="img-responsive" src="http://www.detoxthai.org/wp-content/themes/timeline-wp/images/headers/pine-cone.jpg" alt="582142_102480126564665_634474745_n"/></p>
            <p>ตับเป็นอวัยวะสำคัญของร่างกาย เนื่องจากมีหน้าที่สำคัญในการขจัดสารพิษออกจากร่างกาย โดยมีตำแหน่งอยู่บริเวณช่องท้องด้านขวา หนักประมาณ 4 ปอนด์ ลักษณะของตับจะเป็นเหมือนฟองน้ำซึ่งมีรูพรุนภายในจำนวนมากและภายในช่องว่างเหล่านั้นจะมีเลือดบรรจุอยู่ สำหรับเส้นเลือดที่มาเลี้ยงตับ จะมาจาก 2 แหล่งด้วยกัน แหล่งแรกเป็นเส้นเลือดแดงที่มาจากหัวใจ แหล่งที่สองเป็นเส้นเลือดดำที่มาจากบริเวณลำไส้ ซึ่งจะนำสารอาหาร ตลอดจนสารพิษต่างๆมายังตับ ก่อนที่จะไปยังส่วนอื่นของร่างกาย ตับจึงเป็นด่านแรกที่จะรับมือกับสารพิษเหล่านั้นโดยตรง</p>
            <center>
              <img class="img-responsive" src="http://tunyasamui.detoxthai.org/wp-content/uploads/2015/01/406337_102679079878103_1071214236_n-300x225.jpg" alt="406337_102679079878103_1071214236_n"/><br>
              <img class="img-responsive" src="http://tunyasamui.detoxthai.org/wp-content/uploads/2015/01/582142_102480126564665_634474745_n-300x225.jpg" alt="582142_102480126564665_634474745_n"/>
            </center>
          </div><!-- .entry-content -->

   
      
      
      
      

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- / .box solid -->


  </section><!-- /.content -->'
  
<?php eb();?>


<?php sb('js_and_css_footer');?>
<?php eb();?>
 
<?php render($MasterPage);?>