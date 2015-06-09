<?php
    include_once "../_connection/db_base.php";

    $schedule_id = $_GET['schedule_id'];
    $user_id = $_GET['user_id'];

    $result = $mysqli->query("DELETE FROM site_join
                                WHERE schedule_id = '$schedule_id'
                                AND user_id = '$user_id'");

    header("Location: list_join.php?schedule_id=".$schedule_id);
?>
