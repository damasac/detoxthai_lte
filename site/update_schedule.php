<?php

    include_once "../_connection/db_base.php";

    $schedulename = $_POST['schedulename'];
    $scheduledate = $_POST['scheduledate'];
    $scheduledateend = $_POST['scheduledateend'];
    $price = $_POST['price'];
    $user_qty = $_POST['user_qty'];
    $scheduledesc = $_POST['scheduledesc'];
    $payment = $_POST['payment'];
    $afterpayment = $_POST['afterpayment'];
    $id = $_POST['id'];

    $result = $mysqli->query("UPDATE site_schedule
                SET schedule_name = '$schedulename',
                    schedule_date = STR_TO_DATE('$scheduledate', '%m/%d/%Y'),
                    schedule_desc = '$scheduledesc',
                    schedule_end_date = STR_TO_DATE('$scheduledateend', '%m/%d/%Y'),
                    user_qty = $user_qty,
                    price_per_person = $price,
                    schedule_payment = '$payment',
                    schedule_after_payment = '$afterpayment'
                WHERE id = '$id'");
?>
