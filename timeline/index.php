<?php require_once '../_theme/util.inc.php';

$MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('notifications');?>
  <?php include_once '../notifications.php'; ?>
<?php eb();?>

<?php sb('js_and_css_head'); ?>
        <link href="../_plugins/js-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script src="../_plugins/js-fileinput/js/fileinput.min.js" type="text/javascript"></script>
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

                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <label>คุณกำลังคิดอะไรอยู่</label><br>
                            <code id="valPost" style="display:none;"></code>
                        </div>
<form id="post" action="sql.php" enctype="multipart/form-data">
                        <div class="col-md-8">
            <input type="text" class="form-control" id="timeline_post" name="timeline_post"><br>

                <input id="file" class="images" type="file" name="images[]"  accept="image/*"  multiple="multiple">
                <br>
                <button type="submit" class="btn btn-primary">โพสต์</button>
</form>
<script>
            var $input = $("#file");
                $('#file').fileinput({
                        showUpload:false,
                        uploadAsync: false,
                        uploadUrl: "sql.php", // your upload server url
                        
                        uploadExtraData: function() {
                            return {
                                //userid: $("#userid").val(),
                                //username: $("#username").val()
                            };
                        },
                         initialPreview: [
                                    "<img src='http://placeimg.com/200/150/nature/1'>",
                                    "<img src='http://placeimg.com/200/150/nature/2'>",
                                    "<img src='http://placeimg.com/200/150/nature/3'>",
                        ],
                        initialPreviewConfig: [
                            {caption: "Food-1.jpg", width: "120px", url: "/site/file-delete", key: 1},
                         
                        ]
            }).on("filebatchselected", function(event, files) {
    // trigger upload method immediately after files are selected
    $input.fileinput("upload");
});
                
$("#file").on("filepresfdfdelete", function(jqXHR) {
            alert("delete");
});

</script>
                        </div>
                    </div>
                </div>

                <br>
             </div>
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
                    <h3 class="timeline-header no-border"><a  ><?php echo lookUpUser($dateJoin["user_id"],$mysqli);?></a> ได้เข้าร่วมหลักสูตร <a>asdasd</a></h3>
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
<script>
            $("#timeline_post").click(function(){

                        });
            function postStatus(){
                        var timeline_post = $("#timeline_post").val();
                        if (timeline_post=="") {
                                    //code
                                    $("#valPost").show();
                                    $("#valPost").html("กรุณากรอกข้อความ");
                                    $("#timeline_post").attr("style","border-color:red;")
                                    return ;
                        }else{
                                    $.ajax({
		    url: "usermgn/ajax-sql-query.php?task=addUserNormal",
		    type: "post",
		    data: {
                      text:timeline_post
                      },
		    success: function(data){

		    },
		    error:function(){
			alert("failure");
		    }
		});

                        }
            }
</script>


<![endif]-->
<?php eb();?>

<?php render($MasterPage);?>
