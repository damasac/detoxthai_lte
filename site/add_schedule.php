<?php

    include_once "../_connection/db_base.php";

    $schedulename = $_POST['schedulename'];
    $scheduledate = $_POST['scheduledate'];
    $scheduledateend = $_POST['scheduledateend'];
    $price = $_POST['price'];
    $user_qty = $_POST['user_qty'];
    $scheduledesc = htmlspecialchars($_POST['scheduledesc']);
    $site_id = $_POST['site_id'];

    $result = $mysqli->query("INSERT INTO
                site_schedule (schedule_name, schedule_date, schedule_desc, site_id, schedule_end_date, user_qty, price_per_person)
                VALUES ('$schedulename', STR_TO_DATE('$scheduledate', '%m/%d/%Y'), '$scheduledesc', '$site_id', STR_TO_DATE('$scheduledateend', '%m/%d/%Y'), $user_qty, $price)");
?>
