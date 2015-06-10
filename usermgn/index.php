<?php require_once '../_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

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
<?php include "../_connection/db.php"; ?>
<?php

    $MenuSetting = "user";
    include_once("inc_menu.php");
    $status = $_SESSION["tpc_puser_status"];
    if($status==1){
        $condition = "";
    }
    else if($status==2 || $status==3){
        $condition = "AND status!='1'";
    }
    else if($status==4){
        $condition = "AND status NOT IN (1,2,3)";
    }
    $sqlSelectUser = "SELECT  * FROM `puser`
    WHERE
    `area`='".$_SESSION["tpc_puser_area"]."'
    AND `province`='".$_SESSION["tpc_puser_province"]."'
    AND `hcode`='".$_SESSION["tpc_puser_hcode"]."'
    ".$condition."
    ";
    
    $querySelectUser = $mysqli->query($sqlSelectUser);
    function getTypeUser($status){
        $typeUser;
        if($status==1){
            $typeUser="Super Admin";
        }else if($status==2){
            $typeUser="Admin Area";
        }
        else if($status==3){
            $typeUser="Admin Province";
        }
        else if($status==4){
            $typeUser="Admin Site";
        }
        else if($status==5){
            $typeUser="User Site";
        }
        return $typeUser;
    }
?>
<div class="box">
<div class="box-header">
    <span style="float: right">
        <button class="btn btn-info btn-flat" onclick="refresh_data();"><i class="fa fa-refresh"></i> โหลดข้อมูลใหม่</button>
        <button class="btn btn-info btn-flat" onclick="popup_custom();"><i class="fa fa-plus"></i> เพิ่มผู้ใช้งาน</button>
    </span>
<span >
    <div class="row">
        <?php if($_SESSION["tpc_puser_status"]==1){?>
        <div class="col-lg-3">
        <select class="form-control" id="area" name="area" >
           <option value="0">- เลือกเขต -</option>
            <?php for($i=1;$i<=13;$i++){?>
                <option value="<?php echo $i?>"
                    <?php if($_SESSION["tpc_puser_area"]==$i){echo "selected";}else{echo "";}?>
                                >เขตบริการสุขภาพที่ <?php echo $i;?></option>
           <?php }?>
        </select>
        </div>
        <?php }else {}?>
        <?php if($_SESSION["tpc_puser_status"]==2 || $_SESSION["tpc_puser_status"]==3 || $_SESSION["tpc_puser_status"]==1){?>
        <div class="col-lg-2">
        <?php
                    $sqlProvince = "SELECT * FROM `all_hospital_zone` WHERE zone_code='".$_SESSION["tpc_puser_area"]."' ";
                    $queryProvince = $mysqli->query($sqlProvince);
        ?>
        <select class="form-control" id="province" name="province" >
            <option value="0">- เลือกจังหวัด -</option>
            <?php while($dataProvince = $queryProvince->fetch_assoc()){?>
                <option value="<?php echo $dataProvince["provincecode"];?>"
                <?php if($_SESSION["tpc_puser_province"]==$dataProvince["provincecode"]){echo "selected";}else{echo "";}?>
                ><?php echo $dataProvince["province"]?></option>
            <?php }?>
        </select>
        </div>
        <?php }?>
        <?php if($_SESSION["tpc_puser_status"]==3 || $_SESSION["tpc_puser_status"]==2 || $_SESSION["tpc_puser_status"]==1 || $_SESSION["tpc_puser_status"]==4){?>
        <div class="col-lg-3">
        <?php
                    $sqlHospital = "SELECT `hcode`,`name` FROM `all_hospital_thai` WHERE provincecode='".$_SESSION["tpc_puser_province"]."' ORDER BY hcode";
                    $queryHospital = $mysqli->query($sqlHospital);
        ?>
            <select class="form-control" id="hospital" name="hospital"  >
                <option value="0">- เลือกโรงพยาบาล -</option>
                <?php while($dataHospital = $queryHospital->fetch_assoc()){?>
                    <option value="<?php echo $dataHospital["hcode"];?>"
                    <?php if($_SESSION["tpc_puser_hcode"]==$dataHospital["hcode"]){echo "selected";}else{echo "";}?>
                    ><?php echo $dataHospital["hcode"]?> : <?php echo $dataHospital["name"]?></option>
                <?php }?>
            </select>
        </div>
        <?php }?>
    </div>
</span>
<input type="hidden" id="areaVal" name="areaVal" value="<?php echo $_SESSION["tpc_puser_area"]?>">
<input type="hidden" id="provinceVal" name="provinceVal" value="<?php echo $_SESSION["tpc_puser_province"]?>">
<input type="hidden" id="hospitalVal" name="hospitalVal" value="<?php echo $_SESSION["tpc_puser_hcode"]?>">
<input type="hidden" id="statusVal" name="statusVal" value="<?php echo $_SESSION["tpc_puser_status"]?>">
  <?php  //echo "<pre>"; print_r($_SESSION);?>
<!--<div class="box-title">จัดการสมาชิก-->

<!--</div>--><br><br><br>

<table id="userTable" class="table table-striped table-bordered" cellspacing="0">
        <thead>
            <tr>
                <th>ชื่อผู้ใช้</th>
                <th>อีเมลล์</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>สถานะ</th>
                <th>วันที่สร้าง</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody id="dataSelectUser">
            <?php while($dataSelectUser = $querySelectUser->fetch_assoc()){?>
            <tr>
                <td><?php echo $dataSelectUser["username"];?></td>
                <td><?php echo $dataSelectUser["email"];?></td>
                <td><?php echo $dataSelectUser["fname"];?></td>
                <td><?php echo $dataSelectUser["lname"];?></td>
                <td><?php echo getTypeUser($dataSelectUser["status"]);?></td>
                <td><?php echo $dataSelectUser["createdate"];?></td>
                <td>
                    <button class='btn btn-warning btn-xs' onclick="editUser('<?php echo $dataSelectUser['id'];?>','<?php echo $dataSelectUser['hcode']?>')">แก้ไข</button>
                    <button class='btn btn-danger btn-xs' onclick="deleteUser('<?php echo $dataSelectUser['id'];?>')">ลบ</button>
                </td>
            </tr>
            <?php }?>
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