<?php
include_once "../_connection/db_base.php";

$site_url = str_replace("_", "", $_POST['site_url']);

$result = $mysqli->query("SELECT COUNT(*) AS check_exit
    FROM site_detail
    WHERE site_url = '$site_url'
    AND delete_at IS NULL");

$check_exit = $result->fetch_assoc();

echo $check_exit['check_exit'];

?>
