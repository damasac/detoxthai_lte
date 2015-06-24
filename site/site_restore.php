<?php

    require_once '../_theme/util.inc.php'; chk_login();

    if(!isset($_SESSION)){
        session_start();
    }

    include_once "../_connection/db_base.php";

    $site_id = $_GET['site_id'];

    /** Check security. */
    $check_point = 0;

    $result = $mysqli->query("SELECT COUNT(*) check_secu
        FROM site_manage_user
        WHERE user_id = '".$_SESSION[SESSIONPREFIX.'puser_id']."'
        AND site_id = '$site_id'");
    $row = $result->fetch_assoc();

    if (0 == $row['check_secu']) {
      $check_point = 1;
    }

    $result = $mysqli->query("SELECT COUNT(*) check_secu
        FROM site_detail
        WHERE create_user = '".$_SESSION[SESSIONPREFIX.'puser_id']."'
        AND id = '$site_id'");
    $row = $result->fetch_assoc();

    if (0 == $row['check_secu'] && $check_point) {
      echo 'การเข้าถึงข้อมูลถูกปฏิเสธ';
      exit;
    }

    $result = $mysqli->query("SELECT COUNT(id) AS checkuser
                                FROM site_detail WHERE create_user = 1 AND id = '$site_id'");

    if ($result->num_rows > 0) {
        /** Delete site_detail. */
        $result = $mysqli->query("UPDATE site_detail SET delete_at = NULL WHERE id = '$site_id'");
        /** Delete site_menu. */
        $result = $mysqli->query("UPDATE site_menu SET delete_at = NULL WHERE site_id = '$site_id'");
        /** Delete site_submenu. */
        $result = $mysqli->query("UPDATE site_submenu SET delete_at = NULL WHERE site_id = '$site_id'");
        /** Delete site_schedule. */
        $result = $mysqli->query("UPDATE site_schedule SET delete_at = NULL WHERE site_id = '$site_id'");

        header('location: site_manage.php');
    } else {
        header('location: site_manage.php');
    }
?>
