<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> สวัสดีครับ <?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>
<?php include_once "_connection/db.php"; ?>

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Content Management 
      <small>สำหรับ site (เปลี่ยนไปตาม URL)</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">SITE NAME HERE</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-primary" style="margin: 10px;">
      <!-- row -->
      <div class="row" style="margin: 10px;">
        <div class="col-md-12">



          <div class="row">
              <div class="col-md-3">
                <h3 class="text-muted">ศูนย์ธัญสมุย</h3>
              </div>
              <div class="col-md-9">
                <nav>
                <ul class="nav nav-pills pull-right">
                  <li role='presentation' class='active'><a href='site.php?menu=หน้าหลัก&site_name=imu'>หน้าหลัก</a></li>
                  <li role='presentation'><a href='site.php?menu=เกี่ยวกับเรา&site_name=imu'>เกี่ยวกับเรา</a></li>
                  <li class='dropdown'><a id='drop1' href='#' class='dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' role='button' aria-expanded='false'>คอร์สล้างพิษตับ<span class='caret'></span></a>
                        <ul class='dropdown-menu' role='menu' aria-labelledby='drop1'>
                          <li role='presentation'><a role='menuitem' tabindex='-1' href='site.php?menu=ปฎิทินกิจกรรมล้างพิษตับ&site_name=imu&sub_menu=1'>ปฎิทินกิจกรรมล้างพิษตับ</a></li>
                          <li role='presentation'><a role='menuitem' tabindex='-1' href='site.php?menu=การเตรียมตัวมาเข้าค่ายล้างพิษตับ&site_name=imu&sub_menu=1'>การเตรียมตัวมาเข้าค่ายล้างพิษตับ</a></li><li role='presentation'><a role='menuitem' tabindex='-1' href='site.php?menu=รวมภาพกิจกรรมล้างพิษตับ&site_name=imu&sub_menu=1'>รวมภาพกิจกรรมล้างพิษตับ</a></li>
                        </ul>
                  </li>
                  <li role='presentation'><a href='site.php?menu=ติดต่อเรา&site_name=imu'>ติดต่อเรา</a></li>
                </ul>
              </nav>
              </div>
          </div>

<div class="row marketing" id="show_content"><div align="center"><font color="#126a9d"><font size="5"><font face="Tahoma, sans-serif, Arial, Helvetica, Garuda"><strong><img src="http://s.exaidea.com/upload2/1/20130710/ad74aed9ec4598611f66243abfca0078.jpg" class="img-responsive"></strong></font></font></font><br></div><div><br></div>
<div><br></div>
<div><br></div>
<div><font color="#126a9d"><strong>"ล้างพิษตับ" โดย ทีมงาน "ศูนย์ธัญสมุย"</strong></font><br></div>
<div><br></div>
<div><font color="#595959">&nbsp; &nbsp; &nbsp; &nbsp; " ยินดีต้อนรับ ... ผู้รักสุขภาพทุกท่าน ที่ต้องการ ล้างพิษตับ ด้วยวิธีธรรมชาติบำบัดกับกิจกรรมการฟื้นฟูสุขภาพ ทีมงานศูนย์ธัญสมุย จัดคอร์สล้างพิษตับนี้ขึ้นมาด้วยใจที่มุ่งหวังอยากจะให้ผู้ที่สนใจในเรื่องการล้างพิษตับ ได้มีสุขภาพที่ดี และได้รับความรู้ในการดูแลสุขภาพของตนโดยอาศัยวิธีธรรมชาติบำบัดเพื่อสามารถนำกลับไปปฎิบัติ ใช้ที่บ้านได้ ... โดยให้เสียค่าใช้จ่ายน้อยที่สุด แล้วพบกันที่ ศูนย์ธัญสมุย นะค่ะ "</font></div>
<br><br>      
</div>          
      
      
      
      

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- / .box solid -->


  </section><!-- /.content -->'
  
<?php eb();?>


<?php sb('js_and_css_footer');?>
<?php eb();?>
 
<?php render($MasterPage);?>