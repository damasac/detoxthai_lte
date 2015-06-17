<?php
    include_once "../_connection/db_base.php";

    $id = $_POST['id'];
    $content_html = htmlspecialchars($_POST['content_html']);

    $result = $mysqli->query("UPDATE site_content SET content_html = '$content_html' WHERE id = '$id'");

?>
