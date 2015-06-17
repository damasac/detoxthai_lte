<?php
    session_start();    
    include_once "../_connection/db_base.php";
    
    $task = $_GET["task"];
    
    if($task=="skip"){
        $sql = "UPDATE
            `puser`
            SET
            `isFristLogin`='1'
            WHERE
            `id`='".$_POST["user_id"]."'
        ";
        $query = $mysqli->query($sql);
        if($query){
            $_SESSION["dtt_puser_first_login"] = 1;
        }
    }
    if($task=="editUser"){
        $sql = "UPDATE
            `puser`
            SET
            `nickname`='".$_POST["nickname"]."',
            `isFristLogin`='1'
            WHERE
            `id`='".$_POST["user_id"]."'
        ";
        $query = $mysqli->query($sql);
        if($query){
            $_SESSION["dtt_puser_first_login"] = 1;
        }
    }
    if($task=="edit"){
        $password = $_POST["password"];
        $sqlSelect = "SELECT * FROM `puser` WHERE `password`='".$password."' ";
        $querySelect = $mysqli->query($sqlSelect);
        $numSelect = $querySelect->num_rows;
        $sql1 = "SELECT * FROM `puser` WHERE username='".$_POST["tel"]."' AND id!='".$_POST["id"]."' ";
	$query1 = $mysqli->query($sql1);
	$num1 = $query1->num_rows;
	if($num1==1){
	    echo "1";
	    exit;
        }
        if($numSelect==1){
            $password = $_POST["password"];
        }else{
            $password = sha1(md5($_POST["password"]));
        }
        $sql = "
        UPDATE `puser`
        SET
        `fname`='".$_POST["fname"]."',
        `lname`='".$_POST["lname"]."',
        `username`='".$_POST["tel"]."',
        `tel`='".$_POST["tel"]."',
        `password`='".$_POST["password"]."',
        `nickname`='".$_POST["nickname"]."'
        WHERE
            `id`='".$_POST["id"]."'
        ";
        $query= $mysqli->query($sql);
        
    }
?>