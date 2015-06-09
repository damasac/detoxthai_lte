<?php
require_once '../_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> User Setting <?php eb();?>

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
<div class="box">
<div class="box-header">
    <span style="float: right">
        <!--<button class="btn btn-info btn-flat" onclick="refresh_data();"><i class="fa fa-refresh"></i> โหลดข้อมูลใหม่</button>-->
        <button class="btn btn-info btn-flat" onclick="popup_custom();"><i class="fa fa-plus"></i> เพิ่มสมาชิกเข้าสู่ศูนย์</button>
    </span>
    <br><br><br>
        <table id="userTable" class="table table-striped table-bordered dataTable no-footer">
            <thead>
                    <tr>
                        <th>ลำดับที่</th>
                        <th>ชื่อผู้ใช้งาน</th>
                        <th>ชื่อ</th>
                        <th>จัดการ</th>
                    </tr>
            </thead>
            <tbody>
                <?php
                    $sql1 = "select * from `puser` order by `id`";
                    $query1 = $mysqli->query($sql1);
                    if($query1->num_rows>0){
                    $i=1;
                    while($data1 = $query1->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $data1["username"];?></td>
                    <td><?php echo $data1["fname"]." ".$data1["lname"];?></td>
                    <td>
                        <button class="btn btn-primary btn-xs">ลงชื่อเข้าใช้ (Login As) </button>
                        <!--<button class="btn btn-warning btn-xs" onclick="editUser('<?php echo $data1["id"]?>')">แก้ไข</button>-->
                        <button class="btn btn-warning btn-xs" onclick="deleteUser('<?php echo $data1["id"]?>')">ย้ายออกจากศูนย์</button>
                    </td>
                </tr>
                <?php                     
                    $i++;}
                }?>
            </tbody>
        </table>
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