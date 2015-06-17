<?php
    session_start();
    include_once "../_connection/db_base.php";
    $task = $_GET["task"];
    if($task=="findUser"){
        $sql = "SELECT * FROM `puser` WHERE `username`='".$_POST["user_id"]."'  ";
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
        
        $sqlUser = "SELECT * FROM `site_follow` WHERE site_id='".$_POST["site_id"]."' AND user_id='".$_POST["user_id"]."' AND delete_at>='' ";
        
        $queryUser = $mysqli->query($sqlUser);
        
        $numUser = $queryUser->num_rows;
        

        if($numUser==1){
            
            $sql1 = "UPDATE `site_follow`
                SET create_at = NOW() , delete_at = NULL
                WHERE site_id='".$_POST["site_id"]."' AND user_id = '".$_POST["user_id"]."'
            ";
            $query1 = $mysqli->query($sql1);
            
        }else{
            $sqlUser2 = "SELECT * FROM `site_follow` WHERE site_id='".$_POST["site_id"]."' AND user_id='".$_POST["user_id"]."' ";
            $queryUser2 = $mysqli->query($sqlUser2);
            $numUser2 = $queryUser2->num_rows;
            if($numUser2==1){
                echo "1";
                exit;
            }else{
            $sql2 = "INSERT INTO `site_follow`(site_id,user_id)
            VALUES('".$_POST["site_id"]."','".$_POST["user_id"]."')";
            $query = $mysqli->query($sql2) or die(mysqli_error($mysqli));
            }
        }
        
    }
    if($task=="saveSession"){
        $_SESSION["dtt_user_form"] = $_POST["user_id"];
    }
    if($task=="changeSession"){
        $_SESSION["dtt_user_form"] = "";
    }
    if($task=="outSite"){
        
        $sql = "UPDATE `site_follow` SET delete_at=NOW() WHERE site_id='".$_POST["site_id"]."' AND user_id='".$_POST["user_id"]."' ";

        $query = $mysqli->query($sql) or die(mysql_error($mysqli));

    }
?>