<?php
include_once "../_connection/db.php";

$id = $_GET['id'];
$site_name = $_GET['site_name'];

$mysqli->query("DELETE FROM site_menu
                WHERE id = '$id'");
header('Location: menu.php?site_name='.$site_name);
?>
