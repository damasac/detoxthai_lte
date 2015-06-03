<?php

    include_once "../_connection/db.php";

    if(!isset($_COOKIE['detoxthai'])){
      header('Location: http://www.detoxthai.org/');
    }

    $site_id = $_GET['site_id'];

    $result = $mysqli->query("SELECT COUNT(id) AS checkuser
                                FROM site_detail WHERE create_user = 1 AND id = '$site_id'");
    //$result->execute();
    //$row = $result->fetch(PDO::FETCH_ASSOC);

    if($result->num_rows > 0){
        $result = $mysqli->query("DELETE FROM site_detail WHERE id = '$site_id'");
        //$result->execute();
        //$host  = $_SERVER['HTTP_HOST'];
        header('location: site_manage.php');
    }else{
        header('location: site_manage.php');
    }
?>
