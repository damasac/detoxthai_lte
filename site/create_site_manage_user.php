<?php

    include_once "../_connection/db_base.php";

    $site_id = $_POST['site_id'];
    $user_id = $_POST['user_id'];

    $result = $mysqli->query("SELECT COUNT(*) check_exit
                FROM site_manage_user
                WHERE user_id = '".$user_id."'
                AND site_id = '$site_id'");

    $row = $result->fetch_assoc();

    if (0 < $row['check_exit']) {
        echo 'มีการเพิ่มข้อมูลแล้ว';
        exit;
    }

    $result = $mysqli->query("INSERT INTO
                site_manage_user (site_id, user_id)
                VALUES ('$site_id', '$user_id')");
?>
