<?php

    include_once "../_connection/db_base.php";

    $schedulename = $_POST['schedulename'];
    $scheduledate = $_POST['scheduledate'];
    $scheduledateend = $_POST['scheduledateend'];
    $price = $_POST['price'];
    $user_qty = $_POST['user_qty'];
    $scheduledesc = htmlspecialchars($_POST['scheduledesc']);
    $payment = htmlspecialchars($_POST['payment']);
    $afterpayment = htmlspecialchars($_POST['afterpayment']);
    $id = $_POST['id'];

    $result = $mysqli->query("UPDATE site_schedule
                SET schedule_name = '$schedulename',
                    schedule_date = STR_TO_DATE('$scheduledate', '%d/%m/%Y'),
                    schedule_desc = '$scheduledesc',
                    schedule_end_date = STR_TO_DATE('$scheduledateend', '%d/%m/%Y'),
                    user_qty = $user_qty,
                    price_per_person = '$price',
                    schedule_payment = '$payment',
                    schedule_after_payment = '$afterpayment'
                WHERE id = '$id'");

    $result = $mysqli->query("SELECT site_id
        FROM site_schedule
        WHERE id = '$id'");
    $row = $result->fetch_assoc();

    /** Update site_detail. */
    $result = $mysqli->query("UPDATE site_detail SET update_at = NOW() WHERE id = '".$row['site_id']."'");
?>
