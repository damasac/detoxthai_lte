<?php

    require_once '../_theme/util.inc.php'; chk_login();

    if (!isset($_SESSION)) {
        session_start();
    }

    include_once "../_connection/db_base.php";

    $schedulename = $_POST['schedulename'];
    $scheduledate = $_POST['scheduledate'];
    $scheduledateend = $_POST['scheduledateend'];
    $price = $_POST['price'];
    $user_qty = $_POST['user_qty'];
    $scheduledesc = htmlspecialchars($_POST['scheduledesc']);
    $payment = htmlspecialchars($_POST['payment']);
    $afterpayment = htmlspecialchars($_POST['afterpayment']);
    $site_id = $_POST['site_id'];

    $result = $mysqli->query("INSERT INTO
                site_schedule (schedule_name, schedule_date, schedule_desc, site_id, schedule_end_date, user_qty, price_per_person, schedule_payment, schedule_after_payment, user_id)
                VALUES ('$schedulename', STR_TO_DATE('$scheduledate', '%d/%m/%Y'), '$scheduledesc', '$site_id', STR_TO_DATE('$scheduledateend', '%d/%m/%Y'), $user_qty, '$price', '$payment', '$afterpayment', '".$_SESSION[SESSIONPREFIX.'puser_id']."')");

    /** Update site_detail. */
    $result = $mysqli->query("UPDATE site_detail SET update_at = NOW() WHERE id = '$site_id'");

?>
