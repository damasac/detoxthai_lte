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
        $sqlUser = "SELECT * FROM `site_follow` WHERE site_id='".$_POST["site_id"]."' AND user_id='".$_POST["user_id"]."' ";
        $queryUser = $mysqli->query($sqlUser);

        $numUser = $queryUser->num_rows;
        if($numUser==1){
            echo "1";
            exit;
        }else{
        $sql2 = "INSERT INTO `site_follow`(site_id,user_id)
        VALUES('".$_POST["site_id"]."','".$_POST["user_id"]."')";
        $query = $mysqli->query($sql2) or die(mysqli_error($mysqli));
        }
    }
?>