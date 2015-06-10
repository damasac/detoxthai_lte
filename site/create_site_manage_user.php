<?php

    include_once "../_connection/db_base.php";

    $site_id = $_POST['site_id'];
    $user_id = $_POST['user_id'];

    $result = $mysqli->query("INSERT INTO
                site_manage_user (site_id, user_id)
                VALUES ('$site_id', '$user_id')");
?>
