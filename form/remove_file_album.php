<?php
header("Content-type:text/html; charset=utf-8"); 
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false);

## System Start ############################################################
include_once "../_connection/db_base.php";
############################################################################

if(isset($_GET['file_id'])){
    $file_id = $_GET['file_id'];
    $sql = "SELECT * FROM `tbl_surveyalbum` WHERE id = '$file_id';";
    $query = $mysqli->query($sql);
    $data = $query->fetch_assoc();

    unlink('file_upload/album/'.$data['file_name']);

    $sql = "DELETE FROM tbl_surveyalbum WHERE id='$file_id';";
    $query = $mysqli->query($sql);
}
?>