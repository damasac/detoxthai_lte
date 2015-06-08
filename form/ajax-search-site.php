<?php
header("Content-type:text/html; charset=utf-8"); 
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false);

## System Start ############################################################
include_once "../_connection/db_base.php";
############################################################################

if($_GET['task']=="site"){
    $key = $_GET['key'];
    $sql = "SELECT id, `site_name` FROM site_detail WHERE site_name LIKE '%".$key."%' LIMIT 10";
    $query = $mysqli->query($sql);
    $array = array();
    while($data = $query->fetch_assoc()){
        $array[] = $data;
    }
    echo json_encode($array);
}
?>