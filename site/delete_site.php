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
    //$result->execute();
    //$row = $result->fetch(PDO::FETCH_ASSOC);

    $result = $mysqli->query("SELECT site_url
                            FROM site_detail WHERE id = '$site_id'");
    $row = $result->fetch_assoc();

    if($result->num_rows > 0){
        $result = $mysqli->query("DELETE FROM site_detail WHERE id = '$site_id'");
        $result = $mysqli->query("DELETE FROM site_menu WHERE site_name = '".$row['site_url']."'");
        //$result->execute();
        //$host  = $_SERVER['HTTP_HOST'];
        header('location: site_manage.php');
    }else{
        header('location: site_manage.php');
    }
?>
