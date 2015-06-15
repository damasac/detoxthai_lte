
<?php require_once '../_theme/util.inc.php'; //chk_login();
$MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>
<?php
            date_default_timezone_set("Asia/Bangkok");
            include_once "../_connection/db_base.php";
            include_once "function_timeline.php";
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $dateNow = DateThai($date);
            $timeNow = TimeThai($time);
            $sqlDateUser = "SELECT  DATE_FORMAT(a.createdate, '%Y-%m-%d') AS date FROM puser AS a ORDER BY a.createdate DESC";
            $queryDateUser = $mysqli->query($sqlDateUser);
            $sqlDateFollow = "SELECT  DATE_FORMAT(a.create_at, '%Y-%m-%d') AS date1,DATE_FORMAT(a.delete_at, '%Y-%m-%d') AS date2 FROM site_follow AS a ORDER BY a.create_at DESC";
            $queryDateFollow = $mysqli->query($sqlDateFollow);
            $dateQuery = array();
            $sqlDateJoin = "SELECT  DATE_FORMAT(a.create_at, '%Y-%m-%d') AS date1,DATE_FORMAT(a.delete_at, '%Y-%m-%d') AS date2 FROM site_join AS a ORDER BY a.create_at DESC";
            $queryDateJoin = $mysqli->query($sqlDateJoin);
            $dateQuery1 = array();

            while($dataDateFollow = $queryDateFollow->fetch_assoc()){
                //print_r($dataDateUser);
                foreach($dataDateFollow as $key=>$value){
                    //echo $key."=".$value."<br>";
                    array_push($dateQuery1,$value);
                }
            }
            while($dataDateUser = $queryDateUser->fetch_assoc()){
                //print_r($dataDateUser);
                foreach($dataDateUser as $key=>$value){
                    //echo $key."=".$value."<br>";
                    array_push($dateQuery1,$value);
                }
            }
            $dateQuery = array_filter(array_unique($dateQuery1));

?>

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Time Line
      <small>ศูนย์หลัก</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <li class="active">Time Line</li>
    </ol>
  </section>
<?php

?>
  <!-- Main content -->
        <section class="content">
        <div class="box box-primary">
          <!-- row -->
          <div class="row" style="margin: 10px;">
            <div class="col-md-12">
              <!-- The time line -->
              <ul class="timeline">
                <!-- timeline time label -->
                <?php foreach($dateQuery as $key){?>
                <li class="time-label">
                  <span class="bg-red">
                    <?php
                        echo formatDateThai($key);
                    ?>
                    
                  </span>
                </li>
               <li>
                <?php
                    $sqlCreate = "SELECT  * FROM  puser WHERE createdate LIKE '%".$key."%'";
                    $queryCreate = $mysqli->query($sqlCreate);
                    while($dateCreate = $queryCreate->fetch_assoc()){
                ?>
                 <li>
                  <i class="fa fa-user-plus bg-green"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo TimeThai($dateCreate["createdate"]);?></span>
                    <h3 class="timeline-header no-border"><a  ><?php echo $dateCreate["fname"];?> <?php echo $dateCreate["lname"];?></php></a> ได้สมัครเข้าเป็นสมาชิกใหม่</h3>
                  </div>
                </li>
               <?php }?>
                <?php
                    $sqlFollow = "SELECT  * FROM  site_follow WHERE create_at LIKE '%".$key."%' AND delete_at is NULL ";
                    $queryFollow = $mysqli->query($sqlFollow);
                    while($dateFollow = $queryFollow->fetch_assoc()){
                ?>
                 <li>
                  <i class="fa fa-heart bg-maroon"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo TimeThai($dateFollow["create_at"]);?></span>
                    <h3 class="timeline-header no-border"><a  ><?php echo lookUpUser($dateFollow["user_id"],$mysqli);?></a> ได้ติดตามศูนย์ <a><?php echo lookUpSite($dateFollow["site_id"],$mysqli);?></a></h3>
                  </div>
                </li>
                 <?php }?>
                <?php
                    $sqlFollowOut = "SELECT  * FROM  site_follow WHERE create_at LIKE '%".$key."%' AND delete_at <>'' ";
                    $queryFollowOut = $mysqli->query($sqlFollowOut);
                    while($dateFollowOut = $queryFollowOut->fetch_assoc()){
                ?>
                <li>
                  <i class="fa fa-heart bg-black"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo TimeThai($dateFollowOut["create_at"]);?></span>
                    <h3 class="timeline-header no-border"><a  ><?php echo lookUpUser($dateFollowOut["user_id"],$mysqli);?></a> ได้เลิกติดตามศูนย์ <a><?php echo lookUpSite($dateFollowOut["site_id"],$mysqli);?></a></h3>
                  </div>
                </li>
                 <?php }?>
                <?php
                    $sqlJoin = "SELECT  * FROM  site_join WHERE create_at LIKE '%".$key."%' AND delete_at is NULL ";
                    $queryJoin = $mysqli->query($sqlJoin);
                    while($dateJoin = $queryJoin->fetch_assoc()){
                ?>
                 <li>
                  <i class="fa fa-book bg-teal"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo TimeThai($dateJoin["create_at"]);?></span>
                    <h3 class="timeline-header no-border"><a  ><?php echo lookUpUser($dateJoin["user_id"],$mysqli);?></a> ได้เข้าร่วมหลักสูตร <a>asdasd</a></h3>
                  </div>
                </li>
                 <?php }?>
                <?php  }?>
                

                <li>
                  <i class="fa fa-envelope bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                    <h3 class="timeline-header"><a href="#">Support Team</a> @ <a href="#">ธัญสมุย</a> ได้เพิ่ม <a href="#">กำหนดการหลักสูตรล้างพิษตับสำหรับผู้เริ่มต้น</a></h3>
                    <div class="timeline-body">
                      Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                      weebly ning heekya handango imeem plugg dopplr jibjab, movity
                      jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                      quora plaxo ideeli hulu weebly balihoo...
                    </div>
                    <div class='timeline-footer'>
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-user bg-aqua"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> ได้สมัครเข้าเป็นสมาชิกใหม่</h3>
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-comments bg-yellow"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                    <div class="timeline-body">
                      Take me to your leader!
                      Switzerland is small and neutral!
                      We are more like Germany, ambitious and misunderstood!
                    </div>
                    <div class='timeline-footer'>
                      <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-green">
                    3 Jan. 2014
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-camera bg-purple"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                    <h3 class="timeline-header"><a href="#">Mina Lee</a> @ <a href="#">บ้านสุขภาพเขาใหญ่</a> uploaded new photos</h3>
                    <div class="timeline-body">
                      <img src="http://placehold.it/150x100" alt="..." class='margin' />
                      <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                      <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                      <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                  <i class="fa fa-video-camera bg-maroon"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span>
                    <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                    <div class="timeline-body">
                      <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" frameborder="0" allowfullscreen></iframe>                        
                      </div>
                    </div>
                    <div class="timeline-footer">
                      <a href="#" class="btn btn-xs bg-maroon">See comments</a>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->                
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- / .box solid -->

        </section><!-- /.content -->
  
<?php eb();?>
<?php

?>

<?php sb('js_and_css_footer');?>
<?php eb();?>
 
<?php render($MasterPage);?>
\ No newline at end of file