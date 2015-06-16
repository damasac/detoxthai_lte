<?php require_once '../_theme/util.inc.php';

$MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>
<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="blueimp/css/jquery.fileupload.css">
<link rel="stylesheet" href="blueimp/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="blueimp/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="blueimp/css/jquery.fileupload-ui-noscript.css"></noscript>
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
                        <div class="col-md-8">
                                    <input type="text" class="form-control" id="timeline_post" name="timeline_post"><br>     
                                    <button class="btn btn-primary btn-flat margin"
                                    data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-image"></i></button>

    <tbody class="files"></tbody>
                                    <!--<button class="btn btn-primary btn-flat margin"><i class="fa fa-video-camera"></i></button>-->
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-flat" onclick="postStatus();">โพสต์</button>
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
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- / .box solid -->

        </section><!-- /.content -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="padding:10px;">

    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                
                
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table">
            <tr>
                <td>Preview</td>
                <td>Name</td>
                <!--<td>size</td>s-->
                <td>
                    <div class="fileupload-buttonbar">
                    <button type="button" class="btn btn-danger delete">
                            <i class="glyphicon glyphicon-trash"></i>
                    </button>
                    <input type="checkbox" class="toggle">
                    </div>
            </td>
            </tr>
            <tbody class="files"></tbody>
        </table>
    </form>

    </div>
  </div>
</div>

<?php eb();?>
<?php

?>

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


<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td width="350px">
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td style="float:left;">
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">

{% for (var i=0, file; file=o.files[i]; i++) { %}

    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <!--<td>-->
        <!--    <!--<span class="size">{%=o.formatFileSize(file.size)%}</span>-->-->
        <!--</td>-->
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<script id="template-download" type="text/x-tmpl">

{% for (var i=0, file; file=o.files[i]; i++) { %}

    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <!--<td>-->
        <!--    <!--<span class="size">{%=o.formatFileSize(file.size)%}</span>-->-->
        <!--</td>-->
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<script src="blueimp/js/jquery.min.js"></script>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="blueimp/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="blueimp/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="blueimp/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="blueimp/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="blueimp/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<!-- <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script> -->
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="blueimp/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="blueimp/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="blueimp/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="blueimp/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="blueimp/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="blueimp/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="blueimp/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="blueimp/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="blueimp/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
<?php eb();?>
 
<?php render($MasterPage);?>
\ No newline at end of file