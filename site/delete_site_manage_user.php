<?php

    require_once '../_theme/util.inc.php'; chk_login();

    if (!isset($_SESSION)) {
        session_start();
    }

    include_once "../_connection/db_base.php";

    $site_id = $_GET['site_id'];
    $user_id = $_GET['user_id'];

    $result = $mysqli->query("SELECT COUNT(*) check_secu
        FROM site_detail
        WHERE create_user = '".$_SESSION[SESSIONPREFIX.'puser_id']."'
        AND id = '$site_id'");
    $row = $result->fetch_assoc();

    if (0 == $row['check_secu'] && $check_point) {
        echo 'การเข้าถึงข้อมูลถูกปฏิเสธ';
        exit;
    }

    $result = $mysqli->query("DELETE FROM site_manage_user
                                WHERE site_id = '$site_id'
                                AND user_id = '$user_id'");

    header('Location: site_manage_user.php?site_id='.$site_id);
?>
