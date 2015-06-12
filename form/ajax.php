<?php
header("Content-type:text/html; charset=utf-8"); 
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false);

## System Start ############################################################
include_once "../_connection/db_base.php";
############################################################################
if($_POST['task']=='setFormPrivate'){
    $sql = "UPDATE tbl_surveyprivate SET status='1' WHERE ref_id_user = '".$_POST['user_id']."';";
    $query = $mysqli->query($sql);
    echo $sql;
}
?>