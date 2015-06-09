<?php
include_once "../_connection/db_base.php";

$id = $_GET['id'];
$site_id = $_GET['site_id'];

$mysqli->query("DELETE FROM site_schedule
                WHERE id = '$id'");
header('Location: site_schedule.php?site_id='.$site_id);
?>
