<?php

$task = $_GET["task"];
$value = $_GET["value"];
if($task=="editTable"){
    $sql = "SELECT * FROM efm_system WHERE id='".$value."'";
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
    //print_r($data);
    ?>
    <div class="row">
    <div class="form-horizontal">
        <div class="form-group">
                <label class="col-lg-3 control-label">Table Name</label> 
            <div class="col-lg-8">
                <input type="text" class="form-control" id="tableValue" value="<?php echo $data["efm_table"];?>"/>
                <input type="hidden" class="" id="idValue" value="<?php echo $data["id"];?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-8" style="margin:auto;padding:auto;">
                <button class="btn btn-warning btn-lg btn-block" id="EditTable" onclick="">Edit Table</button>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $("#EditTable").click(function(e){
                var tableValue = $("#tableValue").val();
                var id = $("#idValue").val();
                if (tableValue=="") {
                    e.preventDefault();
                    alert("กรุณากรอกชื่อตารางด้วย");
                    return ;
                }
                $.ajax({
                    type: "POST",
                    url: "ajax-eform-data.php?task=editTable",
                    data:{tableValue:tableValue,id:id},
                    success: function(returndata){
                            location.href="index.php";
                        }
                   }); 
                });
            });
    </script>
</div>
    <?php
}
if($task=="createTable"){
    ?>
<div class="row">
    <div class="form-horizontal">
        <div class="form-group">
                <label class="col-lg-3 control-label">Table Name</label> 
            <div class="col-lg-8">
                <input type="text" class="form-control" id="tableValue"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-8" style="margin:auto;padding:auto;">
                <button class="btn btn-success btn-lg btn-block" id="AddTable">Create Table</button>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $("#AddTable").click(function(e){
                var tableValue = $("#tableValue").val();
                if (tableValue=="") {
                    e.preventDefault();
                    alert("กรุณากรอกชื่อตารางด้วย");
                    return ;
                }
                $.ajax({
                    type: "POST",
                    url: "ajax-eform-data.php?task=addTable",
                    data:{tableValue:tableValue},
                    success: function(returndata){
                            location.href="index.php";
                        }
                   }); 
                });
            });
    </script>
</div>
<?php
}

    if($task=="deleteTable"){
        
?>
<div class="row" >
    <!--<form >-->
    <div class="col-lg-6">
        <button href="javascript:void(0);" class="btn btn-success btn-lg btn-block" onclick="delete2('<?php echo $value?>')">ลบ</button>
    </div>
     <div class="col-lg-6">
        <button class="btn btn-primary  btn-lg btn-block">ยกเลิก</button>
    </div>
    <!--</form>-->
</div>
<script>
    function delete2(id) {
         $.ajax({
            type: "POST",
                url: "ajax-eform-data.php?task=deleteTable",
                data:{id:id},
                success: function(returndata){
                    window.parent.showDelete(id);
                    dialogPopWindow.close();
                         }
               }); 
    }
</script>
<?php }
    $valueInput = $_POST["valueInput"];
    $valueLabel = $_POST["valueLabel"];
    $valueField = $_POST["valueField"];
    if($task=="text"){
?>
<div class="paper-box" style="padding:30px;backgroud-color:#eee !important;">
    <div class="row">
        <h4>ตัวอย่าง</h4>
        <div class="col-lg-5">
            <?php if($valueLabel==""){?>
            <label>หัวข้อคำถาม</label>
            <?php }else{?>
            <label><?php echo $valueLabel;?></label>
            <?php }?>
            <input type="text" class="form-control" disabled>
        </div>
    </div>
</div>
<?php
}
?>