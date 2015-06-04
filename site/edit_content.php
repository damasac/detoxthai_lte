<?php
    include_once "../_connection/db.php";

    /*if(!isset($_COOKIE['detoxthai'])){
      header('Location: http://www.detoxthai.org/');
    }*/

    $id = $_POST['id'];
    $content_html = $_POST['content_html'];
    //$token = $_POST['token'];
    //echo $content_html;

    $result = $mysqli->query("UPDATE site_content SET content_html = '$content_html' WHERE id = '$id'");
    //if(csrfguard_validate_token("codeerror", $token)){
        //$result->execute();
    //}
?>
