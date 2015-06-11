<?php
    include_once "../_connection/db_base.php";
    $task = $_GET["task"];
    if($task=="findUser"){
        $sql = "SELECT * FROM `puser` WHERE `username`='".$_POST["user_id"]."' ";
        $query = $mysqli->query($sql);
        $num = $query->num_rows;
        if($num==1){
            $data = $query->fetch_assoc();
            echo json_encode($data);
        }else{
            echo "0";
        }
    }
    if($task=="addUserFind"){
        $sqlUser = "SELECT * FROM `site_join` WHERE schedule_id='".$_POST["schedule_id"]."' AND user_id='".$_POST["user_id"]."' ";
        $queryUser = $mysqli->query($sqlUser);

        $numUser = $queryUser->num_rows;
        if($numUser==1){
            echo "1";
            exit;
        }else{
        $sql = "INSERT INTO `site_join`(schedule_id,user_id,payment_status,payment_upload_status)
        VALUES('".$_POST["schedule_id"]."','".$_POST["user_id"]."','0','0')";

        $query = $mysqli->query($sql) or die(mysqli_error($mysqli));
        }
    }
?>