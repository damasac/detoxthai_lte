<?php
include_once "../_connection/db_base.php";

$id = $_POST['id'];
$main_menu = $_POST['main_menu'];
$menuorder = $_POST['menuorder'];
$menuname = $_POST['menuname'];
$display = $_POST['display'];

$mysqli->query("UPDATE site_submenu SET menu_order = '$menuorder', menu_name = '$menuname', status_menu = '$display', main_menu_id = '$main_menu' WHERE id = '$id'");
?>

