<?php
include_once "../_connection/db_base.php";

$id = $_POST['id'];
$menuorder = $_POST['menuorder'];
$menuname = $_POST['menuname'];
$display = $_POST['display'];

$mysqli->query("UPDATE site_menu SET menu_order = '$menuorder', menu_name = '$menuname', display_menu = '$display' WHERE id = '$id'");
?>

