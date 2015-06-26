<?php
require_once '../_theme/util.inc.php';

$MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('notifications');?>
  <?php include_once '../notifications.php'; ?>
<?php eb();?>

<?php sb('js_and_css_head'); ?>
        <link href="../_plugins/js-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script src="../_plugins/js-fileinput/js/fileinput.js" type="text/javascript"></script>
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
            $sqlSelectUser = "SELECT * FROM `puser` INNER JOIN `tbl_surveyprivate` ON puser.id =tbl_surveyprivate.ref_id_user  WHERE id='".$_SESSION["dtt_puser_id"]."' ";
            $querySelectUser = $mysqli->query($sqlSelectUser);
            $dataSelectUser = $querySelectUser->fetch_assoc();
            $cid = $dataSelectUser["p0a1b2"];
            // echo $cid;
            $sqlDateUser = "SELECT  DATE_FORMAT(a.createdate, '%Y-%m-%d') AS date FROM puser AS a ORDER BY a.createdate DESC";
            $queryDateUser = $mysqli->query($sqlDateUser);
            $sqlDateFollow = "SELECT  DATE_FORMAT(a.create_at, '%Y-%m-%d') AS date1,DATE_FORMAT(a.delete_at, '%Y-%m-%d') AS date2 FROM site_follow AS a ORDER BY a.create_at DESC";
            $queryDateFollow = $mysqli->query($sqlDateFollow);
            $dateQuery = array();
            $sqlDateJoin = "SELECT  DATE_FORMAT(a.create_at, '%Y-%m-%d') AS date1,DATE_FORMAT(a.delete_at, '%Y-%m-%d') AS date2 FROM site_join AS a ORDER BY a.create_at DESC";
            $queryDateJoin = $mysqli->query($sqlDateJoin);
            $dateQuery1 = array();
            $sqlTimeline = "SELECT  DATE_FORMAT(createtime, '%Y-%m-%d') AS date FROM `timeline_post` AS a ORDER BY createtime DESC";
            $queryTimeline = $mysqli->query($sqlTimeline);
            while($dataTimeline = $queryTimeline->fetch_assoc()){
                //print_r($dataDateUser);
                foreach($dataTimeline as $key=>$value){
                    //echo $key."=".$value."<br>";
                    array_push($dateQuery1,$value);
                }
            }
            while($dataDateJoin = $queryDateJoin->fetch_assoc()){
                //print_r($dataDateUser);
                foreach($dataDateJoin as $key=>$value){
                    //echo $key."=".$value."<br>";
                    array_push($dateQuery1,$value);
                }
            }
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
            rsort($dateQuery);
            //print_r($dateQuery);
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

  <!-- Main content -->
        <section class="content">
            <div class="box box-primary">
            <?php if($_SESSION["dtt_puser_id"]!=""){?>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <label>คุณกำลังคิดอะไรอยู่</label><br>
                            <code id="valPost" style="display:none;"></code>
                        </div>
                        <div class="col-md-7">

                        <input type="text" class="form-control" id="timeline_post" name="timeline_post"><br>
                        <div id="form-upload" style="display:none;">
                        <input id="file" class="file" type="file" name="images[]"  accept="image/*"  multiple="multiple">
                        </div>
                        <br>


                        </div>
                        <div class="col-md-2">
                        <input type="hidden" id="cid" name="cid" value="<?php echo $cid;?>">
                        <input type="hidden" id="pid" name="pid" value="<?php echo $dataSelectUser["id"];?>">
                        <button type="submit" class="btn btn-primary" id="btn-form-upload"><i class='fa fa-camera'> </i></button>
                        <button type="submit" class="btn btn-success" id="button_post"><i class="fa fa-pencil"></i> โพสต์</button>
                        </div>
                    </div>
                </div>

                <br>
             </div>
            <?php }?>
        <div class="box box-primary">
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
                    $sqlTimeline = "SELECT * FROM `timeline_post`AS a  WHERE a.createtime LIKE '%".$key."%' ORDER BY a.createtime DESC";

                    $queryTimeline = $mysqli->query($sqlTimeline);
                    while($dataTimeline = $queryTimeline->fetch_assoc()){
                        $sqlImg = "SELECT * FROM `timeline_image` WHERE post_id='".$dataTimeline["id"]."' ";
                        $queryImg = $mysqli->query($sqlImg);
                        $numImg = $queryImg->num_rows;

                ?>
                 <li>
            <?php if($numImg==1){?>
                        <i class="fa fa-comment bg-green"></i>
            <?php }else{?>
                        <i class="fa fa-image bg-blue"></i>
            <?php }?>
                        <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i><?php echo TimeThai($dataTimeline["createtime"]);?></span>
                                <h3 class="timeline-header"><a href="#"><?php echo lookUpUser($dataTimeline["user_id"],$mysqli)?></a>
                                <?php
                                    if($numImg==1){
                                                echo "ได้โพสข้อความ";
                                    }else{
                                                echo "ได้อัพโหลดรุปภาพ";
                                    }
                                ?>
                                </h3>
                                <div class="timeline-body">
                                    <?php if($dataTimeline["text"]!=""){?>
                                    <p>"<?php echo $dataTimeline["text"];?>"</p>
                                    <?php }?>
                                    <?php
                                                 if($numImg!=""){

                                                            $sqlImg = "SELECT * FROM `timeline_image` WHERE post_id='".$dataTimeline["id"]."' ";
                                                            $queryImg = $mysqli->query($sqlImg);
                                                            while($dataImg = $queryImg->fetch_assoc()){
                                                                       ?>
                                                                         <img src="img/<?php echo $dataImg["image"]?>"  class='margin'   height='100' />
                                                                       <?php
                                                            }
                                                }
                                    ?>
                                </div>

                        </div>
                </li>
               <li>
            <?php }?>
                <?php
                    $sqlCreate = "SELECT  * FROM  puser WHERE createdate LIKE '%".$key."%'";
                    $queryCreate = $mysqli->query($sqlCreate);
                    while($dateCreate = $queryCreate->fetch_assoc()){
                ?>
                 <li>
                  <i class="fa fa-user-plus bg-green"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo TimeThai($dateCreate["createdate"]);?></span>
                    <h3 class="timeline-header no-border"><a  >
                    <?php if($dateCreate["nickname"]==""){?>
                    <?php echo $dateCreate["fname"]." ".$dateCreate["lname"];?>
                    <?php }else{?>
                    <?php echo $dateCreate["nickname"];?>
                    <?php }?>
                    </php></a> ได้สมัครเข้าเป็นสมาชิกใหม่</h3>
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
                    <h3 class="timeline-header no-border"><a  ><?php echo lookUpUser($dateJoin["user_id"],$mysqli);?></a> ได้เข้าร่วมหลักสูตร <a><?php  echo LookUpSchdule($dateJoin["schedule_id"],$mysqli)?></a></h3>
                  </div>
                </li>
                 <?php }?>
                <?php  }?>


                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- / .box solid -->

        </section><!-- /.content -->


<?php eb();?>

<?php sb('js_and_css_footer');?>
<script type="text/javascript" src="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
<link rel="stylesheet" href="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.css">
<script src="../_plugins/input-mask/jquery.inputmask.js"></script>
<script src="../_plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="../_plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script>

var $input = $("#file");
$('#file').fileinput({
showUpload:false,
showRemove:true,
uploadAsync: false,
uploadUrl: "upload.php", // your upload server url
}).on("filebatchselected", function(event, files) {
// trigger upload method immediately after files are selected
$input.fileinput("upload");
});

            $("#btn-form-upload").click(function(){
                        $("#form-upload").toggle({

                                    });
                        });

            $("#button_post").click(function(){
                        var pid = $("#pid").val();
                        var cid = $("#cid").val();
                        if(cid==""){
                          // alert("กรุณาระบุบัตรประชาชนของท่านก่อนทำการโพสต์");
                          cidDialog(pid);
                          return ;
                        }
                        var imgLength = $(".file-preview-image").length;
                        var imgQuery = [];
                        var post = $("#timeline_post").val();
                        if (post=="") {
                                    //code
                                    alert("กรุณาระบุโพสต์");
                                    return ;
                        }else if (imgLength==0) {
                                    //code
                                    alert("กรุณาระบุโพสต์");
                                    return ;
                        }
                        var user_id = <?php echo  $_SESSION["dtt_puser_id"];?>;
                        for (i=0;i<imgLength;i++) {
                                    //code
                                    var img = $(".file-preview-image[data-id='"+i+"']").attr("src");
                                    imgQuery.push(img);

                        }
                        $.ajax({
                                    url: "sql.php?task=post_timeline",
                                    type: "post",
                                    data: {
                                      user_id:user_id,
                                      post:post,
                                      img:imgQuery
                                      },
                                    success: function(data){
                                                location.reload();
                                    },
                                    error:function(){
                                        alert("failure");
                                    }
                                });
                        });
          function cidDialog(pid){
              BootstrapDialog.show({
                type: BootstrapDialog.TYPE_WARNING,
                closable: true,
                closeByBackdrop: false,
                closeByKeyboard: false,
                title: 'ยืนยันตัวตน',
                message: $('<div></div>').load('modal-cid.php?pid='+pid)
            });
          }
</script>
<![endif]-->
<?php eb();?>

<?php render($MasterPage);?>
