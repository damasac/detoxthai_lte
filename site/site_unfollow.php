<?php
    require_once '../_theme/util.inc.php';
    include_once "../_connection/db_base.php";

    isset($_SESSION[SESSIONPREFIX.'puser_id']) ? $session = $_SESSION[SESSIONPREFIX.'puser_id'] :  $session = '';

    $site_id = $_GET['site_id'];

    if ($session) {
        $result = $mysqli->query("DELETE FROM site_follow WHERE site_id = '".$site_id."' AND user_id = '".$session."'");

        header('Location: ../sites.php');
    } else {
        header('Location: ../login.php');
    }
?>
