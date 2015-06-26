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
        $password = $_POST["passwordSend"];
        $sqlSelect = "SELECT * FROM `puser` WHERE `password`='".$password."' ";
        $querySelect = $mysqli->query($sqlSelect);
        $numSelect = $querySelect->num_rows;
        $sql1 = "SELECT * FROM `puser` WHERE username='".$_POST["tel"]."' AND id!='".$_POST["id"]."' ";
	$query1 = $mysqli->query($sql1);
	$num1 = $query1->num_rows;
        $sql2 = "SELECT * FROM `puser` WHERE email='".$_POST["tel"]."' AND id!='".$_POST["id"]."' ";
	$query2 = $mysqli->query($sql2);
	$num2 = $query1->num_rows;
	if($num1==1){
	    echo "1";
	    exit;
        }
        if($num2==1){
            echo "2";
            exit;
        }
        if($numSelect==1){
            $password = $_POST["passwordSend"];
        }else{
            $password = sha1(md5($_POST["passwordSend"]));
        }
        $sql = "
        UPDATE `puser`
        SET
        `fname`='".$_POST["fname"]."',
        `lname`='".$_POST["lname"]."',
        `tel`='".$_POST["tel"]."',
        `password`='".$password."',
        `nickname`='".$_POST["nickname"]."',
        `email`='".$_POST["email"]."',
        `isFristLogin`='1'
        WHERE
            `id`='".$_POST["id"]."'
        ";
        $query= $mysqli->query($sql);
        if($query){
            $_SESSION["dtt_puser_first_login"] = 1;
        }
    }
?>
