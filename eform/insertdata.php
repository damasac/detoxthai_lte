<?php
    error_reporting(0);
    include "../_connection/db_sql.php";
?>
<?php
    
    $tablename = $_POST["tablename"];
    $useradd = $_SESSION["tpc_puser_id"];
    $task = $_POST["task"];
    $id = $_POST["id"];
    $dadd = date("Y-m-d H:i:s");
    $sqlInsert = "INSERT INTO `".$tablename."`(id,rstat,useradd,dadd) VALUES('".$id."','0','".$useradd."','".$dadd."')";
    mysqli_query($con,$sqlInsert);
    mysqli_query($con,"UPDATE `".$tablename."` SET `rstat`='2' WHERE `id`='".$id."' ") or die(mysqli_error());
    foreach ($_POST as $key => $value){
        if(is_array($value)){
            for($i=0;$i<sizeof($value);$i++){
               $sqlUpdateCheckbox = "UPDATE `".$tablename."` SET `".$value[$i]."`='1' WHERE `id`='".$id."' ";
               mysqli_query($con,$sqlUpdateCheckbox);
            }
        }
        $sqlUpdateField = "UPDATE `".$tablename."` SET `".$key."`='".$value."' WHERE `id`='".$id."'";
        mysqli_query($con,$sqlUpdateField)."<br>";
    }
    ?>
<script>
    <?php //ห้ามลบ Redirect by vut
    if($_GET['Redirect']){ ?>
        location.href = "../<?php echo base64_decode($_GET["Redirect"]);?>";
    <?php } else {  ?>
        location.href = "table2.php?idFormMain=<?php echo $_POST["formid"];?>";
    <?php } ?>
</script>
