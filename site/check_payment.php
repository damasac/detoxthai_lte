<?php
    include_once "../_connection/db_base.php";

    $schedule_id = $_GET['schedule_id'];
    $user_id = $_GET['user_id'];

    $result = $mysqli->query("UPDATE site_join SET payment_status = 1 WHERE schedule_id = '$schedule_id' AND user_id= '$user_id'");

    $result = $mysqli->query("UPDATE site_schedule
    SET user_qty = user_qty - 1 WHERE id = '$schedule_id'");

    header("Location: list_join.php?schedule_id=".$schedule_id);
?>
