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
                <div class="container">
                    <div class="row">

                    </div><!-- /.row -->
                </div> <!-- .container -->
            </div><!-- / .box solid -->

        </section><!-- /.content -->


<?php eb();?>

<?php sb('js_and_css_footer');?>

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

</script>
<![endif]-->
<?php eb();?>

<?php render($MasterPage);?>
