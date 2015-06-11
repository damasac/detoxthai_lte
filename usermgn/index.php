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


?>
<div class="box box-primary direct-chat direct-chat-primary">
<div class="box-header">
    <span style="float: right">
        <button class="btn btn-info btn-flat" onclick="refresh_data();"><i class="fa fa-refresh"></i> โหลดข้อมูลใหม่</button>
        <button class="btn btn-info btn-flat" onclick="popup_custom();"><i class="fa fa-plus"></i> เพิ่มสมาชิกเข้าสู่ศูนย์</button>
    </span>
<span >
    <br><br><br>
    <div class="row">
        <ul class="users-list clearfix">
            <li>
              <img src="../_dist/img/user1-128x128.jpg" alt="User Image"/>
              <a class="users-list-name" href="#">Alexander Pierce</a>
              <span class="users-list-date">Today</span>
            </li>
            <li>
              <img src="../_dist/img/user8-128x128.jpg" alt="User Image"/>
              <a class="users-list-name" href="#">Norman</a>
              <span class="users-list-date">Yesterday</span>
            </li>
            <li>
              <img src="../_dist/img/user7-128x128.jpg" alt="User Image"/>
              <a class="users-list-name" href="#">Jane</a>
              <span class="users-list-date">12 Jan</span>
            </li>
            <li>
              <img src="../_dist/img/user6-128x128.jpg" alt="User Image"/>
              <a class="users-list-name" href="#">John</a>
              <span class="users-list-date">12 Jan</span>
            </li>
            <li>
              <img src="../_dist/img/user2-160x160.jpg" alt="User Image"/>
              <a class="users-list-name" href="#">Alexander</a>
              <span class="users-list-date">13 Jan</span>
            </li>
            <li>
              <img src="../_dist/img/user5-128x128.jpg" alt="User Image"/>
              <a class="users-list-name" href="#">Sarah</a>
              <span class="users-list-date">14 Jan</span>
            </li>
            <li>
              <img src="../_dist/img/user4-128x128.jpg" alt="User Image"/>
              <a class="users-list-name" href="#">Nora</a>
              <span class="users-list-date">15 Jan</span>
            </li>
            <li>
              <img src="../_dist/img/user3-128x128.jpg" alt="User Image"/>
              <a class="users-list-name" href="#">Nadia</a>
              <span class="users-list-date">15 Jan</span>
            </li>
          </ul><!-- /.users-list -->
    </div>
    <div class="box-tools pull-right">
        <ul class="pagination pagination-sm inline">
          <li><a href="#">&laquo;</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">&raquo;</a></li>
        </ul>
    </div>

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
    function deleteUser(id){
        dialogPopWindow = BootstrapDialog.show({
                    title: "ลบผู้ใช้งาน",
                    cssClass: 'popup-dialog',
                    closable: true,
                    closeByBackdrop: false,
                    closeByKeyboard: false,
                    size:'size-wide',
                    draggable: false,
                    message: $('<div></div>').load("form_deleteuser.php?id="+id, function(data){
                    }),
                    onshown: function(dialogRef){
                    },
                    onhidden: function(dialogRef){
                    }

         });
    }
    function editUser(id,hcode) {
        //code
        dialogPopWindow = BootstrapDialog.show({
                    title: "แก้ไขผู้ใช้งาน",
                    cssClass: 'popup-dialog',
                    closable: true,
                    closeByBackdrop: false,
                    closeByKeyboard: false,
                    size:'size-wide',
                    draggable: false,
                    message: $('<div></div>').load("form_edituser.php?hcode="+hcode+"&id="+id, function(data){
                    }),
                    onshown: function(dialogRef){
                    },
                    onhidden: function(dialogRef){
                    }

            });
    }
    $("#area").on("change",function(){
            $("#hospital").html("<option value='0'>- เลือกโรงพยาบาล -</option>");
            $("#hospital").select2();
        });
    $("#hospital").select2();
    function popup_custom(hcode) {
        var hcode = $("#hospital").val();
        var area = $("#area").val();
        var province = $("#province").val();
        if (hcode=="0") {
               alert("กรุณาเลือกโรงพยาบาลก่อน");
               return ;
        }else{
            dialogPopWindow = BootstrapDialog.show({
                    title: "เพิ่มผู้ใช้งาน",
                    cssClass: 'popup-dialog',
                    closable: true,
                    closeByBackdrop: false,
                    closeByKeyboard: false,
                    size:'size-wide',
                    draggable: false,
                    message: $('<div></div>').load("form_adduser.php?hcode="+hcode, function(data){
                    }),
                    onshown: function(dialogRef){
                    },
                    onhidden: function(dialogRef){
                    }

            });
        }
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
                              //$("#dataSelectUser").append("<tr><td>"+field.username+"</td><td>"+field.email+"</td><td>"+field.fname+"</td><td>"+field.lname+"</td><td>"+statusName+"</td><td>"+field.createdate+"</td><td><button class='btn btn-warning btn-xs' onclick='editUser("+field.id+","+field.hcode+")'>แก้ไข</button>&nbsp;<button class='btn btn-danger btn-xs' onclick='deleteUser("+field.id+")'>ลบ</button></td></tr>");

                    });
                    }
            });

        }
            $("#area").on("change",function(){
                var area = $(this).val();
                    $.getJSON("ajax-area-loaddata.php?task=areaProvince&area="+area+"",function(result){
                        $("#province").html("<option value='0'>- เลือกจังหวัด -</option>");
                        $.each(result, function(i, field){
                              $("#province").append("<option value="+field.provincecode+" >"+field.province+"</option>");
                        });
                  });
            });
            $("#province").on("change",function(){
                var province = $(this).val();
                    $.getJSON("ajax-area-loaddata.php?task=provinceHospital&province="+province+"",function(result){
                        $("#hospital").html("<option value='0'>- เลือกโรงพยาบาล -</option>");
                            $("#hospital").select2();
                        $.each(result, function(i, field){
                              $("#hospital").append("<option value="+field.hcode+" >"+field.hcode+" : "+field.name+"</option>");
                        });
                  });
            });
        </script>
<script src="../_plugins/dataTables/jquery.dataTables.min.js"></script>
<script src="../_plugins/dataTables/dataTables.bootstrap.min.js"></script>
<link href="../_plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"></script>
<?php eb();?>

<?php render($MasterPage);?>
