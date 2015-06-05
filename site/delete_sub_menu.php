<?php
include_once "../_connection/db_base.php";

$id = $_GET['id'];
$site_name = $_GET['site_name'];

$mysqli->query("DELETE FROM site_submenu
                WHERE id = '$id'");
header('Location: menu.php?site_name='.$site_name);
?>
