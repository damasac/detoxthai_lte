<?php
include_once "../_connection/db_base.php";

$id = $_GET['id'];
$site_id = $_GET['site_id'];

$mysqli->query("DELETE FROM site_menu
                WHERE id = '$id'");
header('Location: menu.php?id='.$site_id);
?>
