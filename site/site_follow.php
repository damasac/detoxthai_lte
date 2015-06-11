<?php
    require_once '../_theme/util.inc.php'; chk_login();
    include_once "../_connection/db_base.php";

    isset($_SESSION[SESSIONPREFIX.'puser_id']) ? $session = $_SESSION[SESSIONPREFIX.'puser_id'] :  $session = '';

    $site_id = $_GET['site_id'];

    if ($session) {
        $result = $mysqli->query("INSERT INTO
                site_follow (site_id, user_id)
                VALUES ('$site_id', '$session')");

        header('Location: ../sites.php');
    }else{
        header('Location: ../login.php');
    }


?>
