<?php
    include_once "../_connection/db_base.php";

    $schedule_id = $_POST['schedule_id'];
    $user_id = $_POST['user_id'];

    $result = $mysqli->query("INSERT INTO
                site_join (schedule_id, user_id)
                VALUES ('$schedule_id', '$user_id')");
?>
