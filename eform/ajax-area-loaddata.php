<?php
 include_once("../_connection/db_sql.php");
 error_reporting(0);
$task = $_GET["task"];
$mophID = $_GET["mophID"];
$province_id = $_GET["province_id"];
$amphur_id = $_GET["amphur_id"];

if($task=="amphur"){
    $sql1 = mysqli_query($con,"SELECT `AMPHUR_ID`,`AMPHUR_NAME` FROM `const_amphur` WHERE `PROVINCE_ID`='".$province_id."' ") or die (mysqli_error());
    $array = array();
    while($data = mysqli_fetch_assoc($sql1)){
        
        $array[] = $data;
    }
   
    print json_encode($array);
}

if($task=="tumbon"){
    $sql1 = "SELECT `DISTRICT_ID`,`DISTRICT_NAME` FROM `const_district`WHERE `AMPHUR_ID`='".$amphur_id."' ";

    $query1= mysqli_query($con,$sql1);

    $array = array();
    while($data = mysqli_fetch_assoc($query1)){
        $array[] = $data;
    }
    print json_encode($array);
}
?>