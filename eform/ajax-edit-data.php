<?php
$id = $_GET["id"];
$public_edit = $_GET["public_edit"];
$public_delete = $_GET["public_delete"];
if($public_edit==0){
    $buttonEdit = "disabled='disabled'";
}else{
    $buttonEdit = "";
}
if($public_delete==0){
    $buttonDel = "disabled='disabled'";
}else{
    $buttonDel = "";
}
    include "../_connection/db_sql.php"; ?>
    <button onclick="viewform(<?php echo $id;?>)" class="btn btn-warning btn-block" <?php echo $buttonEdit;?>>แก้ไข</button>
    <button onclick="deleteform(<?php echo $id?>)" class="btn btn-danger btn-block" <?php echo $buttonDel;?>>ลบ</button>
<?php ?>
<script>
    function viewform(id){
	location.href="form.php?idFormMain=<?php echo $_GET["formid"]?>&id="+id;
    }
    function deleteform(id){
        var formid = <?php echo $_GET["formid"];?>;
         $.ajax({
                url: "ajax-createform-loaddata.php?task=deleteDataTable",
                type: "post",
                data: {id:id,formid:formid},
                success: function(data){
                    location.href="table2.php?idFormMain=<?php echo $_GET["formid"]?>&id="+id;
                },
                error:function(){
                    alert("failure");
                }
            });
    }
</script>