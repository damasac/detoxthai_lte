<?php

    include_once "../_connection/db_base.php";

    $site_id = $_POST['site_id'];
    $user_id = $_POST['user_id'];

    $result = $mysqli->query("DELETE FROM site_manage_user
                                WHERE site_id = '$site_id'
                                AND user_id = '$user_id'");
?>
