<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?> สมาชิก<?php eb();?>

<?php sb('js_and_css_head'); ?>
<style>
    body { font-size: 140%; }
</style>
<?php eb();?>
<?php sb('content_header');?>
        <br>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol>
<?php eb();?>
<?php sb('content');?>
<?php include "../_connection/db_base.php"; ?>
<?php

    $MenuSetting = "user";
    include_once("inc_menu.php");
    $site_id = explode(".",$_SERVER['SERVER_NAME']);
    $sub_domain =  $site_id[sizeof($site_id) - 3];
    if ('www' == $sub_domain) {
      $site_id = 1;
    } else {
      $result = $mysqli->query("SELECT id
              FROM site_detail
              WHERE site_url = '$sub_domain'");
      $row_id = $result->fetch_assoc();
      $site_id = $row_id['id'];
    }
  if($site_id==1){
    $sql1 = "SELECT * FROM `puser`";
    $query1 = $mysqli->query($sql1);
  }else{
    $sql1 = "SELECT * FROM `puser` INNER JOIN site_follow ON puser.id = site_follow.user_id WHERE site_follow.site_id='".$site_id."'";
    $query1 = $mysqli->query($sql1);
  }
?>
<div class="box box-primary direct-chat direct-chat-primary">
<div class="box-header">
    <?php
        //print_r($_SESSION);
        $sql2 = "SELECT * FROM `site_detail` WHERE id='".$site_id."' AND create_user='".$_SESSION[SESSIONPREFIX."puser_id"]."' ";
        //echo $sql2;
        $query2 = $mysqli->query($sql2) or die(mysqli_error($query1));
        $num2 = $query2->num_rows;
    ?>
    <?php if($num2==1){?>
    <span style="float: right">
        <button class="btn btn-info btn-flat" onclick="popup_custom();"><i class="fa fa-plus"></i> เพิ่มสมาชิกเข้าสู่ศูนย์</button>
    </span><br><br><br>
    <?php }?>

    <table id="userTable" class="table table-hover">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ</th>
                <th>เบอร์โทรศัพท์</th>
                <?php if($num2==1){?>
                <th>จัดการ</th>
                <?php }?>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;while($data1 = $query1->fetch_assoc()){?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $data1["fname"]." ".$data1["lname"];?></td>
                <td><?php echo $data1["tel"];?></td>
                <td>
                    <button class="btn btn-success">กรอกข้อมูล</button>
                </td>
            </tr>
            <?php $i++;}?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
<?php eb();?>
<?php sb('js_and_css_footer');?>
<script type="text/javascript" src="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
<link rel="stylesheet" href="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.css">
<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>
<script>
    function popup_custom() {
            var site_id = <?php echo $site_id;?>;
            var user_id = <?php echo $_SESSION[SESSIONPREFIX."puser_id"];?>;
            dialogPopWindow = BootstrapDialog.show({
                    title: "เพิิ่มสมาชิกเข้าสู่ศูนย์",
                    cssClass: 'popup-dialog',
                    closable: true,
                    closeByBackdrop: false,
                    closeByKeyboard: false,
                    size:'size-wide',
                    draggable: false,
                    message: $('<div></div>').load("form_adduser.php?site_id="+site_id+"&user_id="+user_id, function(data){
                    }),
                    onshown: function(dialogRef){
                    },
                    onhidden: function(dialogRef){
                    }
            });
    }
    $(document).ready(function() {
        $('#userTable').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": false,
          "bInfo": false,
          "bAutoWidth": true
            });
    } );
</script>
<script>
        function refresh_data(){
            var area = $("#area").val();
            var province = $("#province").val();
            var hcode = $("#hospital").val();
            var status = $("#statusVal").val();
            $.getJSON("ajax-sql-query.php?task=getData",{status:status,area:area,province:province,hcode:hcode},function(result){
                $('#userTable').dataTable().fnClearTable();
                    if (result==null) {
                        $("#dataSelectUser").html("<tr><td>ไม่มีข้อมูล</td></tr>");
                        return ;
                    }else{
                        $("#dataSelectUser").html("<tr><td></td></tr>");

                        $.each(result, function(i, field){
                            console.log(field);
                            $("#dataSelectUser").html();
                            if (field.status==1) {
                                //code
                                var statusName = "Super Admin";
                            }else if (field.status==2){
                                var statusName = "Admin Area";
                            }else if (field.status==3) {
                                //code
                                var statusName = "Admin Province";
                            }else if (field.status==4) {
                                //code
                                var statusName = "Admin Site";
                            }else{
                                var statusName = "User Site";
                            }
                                $('#userTable').dataTable();
                               $('#example').dataTable( {
                                    "data": dataSet,
                                    "columns": [
                                        { "title": "Name" },
                                        { "title": "Other" },
                                    ]
                                } );

                    });
                    }
            });

        }

</script>
<script src="../_plugins/dataTables/jquery.dataTables.min.js"></script>
<script src="../_plugins/dataTables/dataTables.bootstrap.min.js"></script>
<link href="../_plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"></script>
<?php eb();?>

<?php render($MasterPage);?>
