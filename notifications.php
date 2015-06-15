<?php

/** Init session. */
isset($_SESSION[SESSIONPREFIX.'puser_id']) ? $session = $_SESSION[SESSIONPREFIX.'puser_id'] :  $session = '';

/** Init database. */
include_once "_connection/db_base.php";

/** Array notification. */
$notificationArray = array();

/** Join notification. */
$result = $mysqli->query("SELECT site_schedule.schedule_name, site_join.schedule_id
                          FROM site_join
                          JOIN site_schedule ON site_join.schedule_id = site_schedule.id
                          WHERE site_join.user_id = '".$session."'
                          AND payment_upload_status = 0");

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    array_push($notificationArray, array("url" => "http://".$_SERVER['SERVER_NAME']."/".APP_WEBROOT."site/transfer_confirm.php?schedule_id=".$row['schedule_id'], "icon" => "<i class='fa fa-users text-aqua'></i>", "msg" => "คุณได้เข้าร่วมหลักสูตร <strong>".$row['schedule_name']."</strong>"));
  }
}

/** After Join notification. */
$result = $mysqli->query("SELECT site_schedule.schedule_name, site_join.schedule_id
                          FROM site_join
                          JOIN site_schedule ON site_join.schedule_id = site_schedule.id
                          WHERE site_join.user_id = '".$session."'
                          AND payment_upload_status = 1
                          AND payment_status = 1");

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    array_push($notificationArray, array("url" => "http://".$_SERVER['SERVER_NAME']."/".APP_WEBROOT."site/transfer_confirm.php?schedule_id=".$row['schedule_id'], "icon" => "<i class='fa fa-users text-aqua'></i>", "msg" => "เข้าร่วมหลักสูตร <strong>".$row['schedule_name']."</strong> เรียบร้อย"));
  }
}

?>

<!-- Menu toggle button -->
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-bell-o"></i>
  <span class="label label-warning"><?php echo count($notificationArray); ?></span>
</a>
<ul class="dropdown-menu">
  <li class="header">คุณมี <?php echo count($notificationArray); ?> การแจ้งเตือน</li>
  <li>
    <!-- Inner Menu: contains the notifications -->
    <ul class="menu">
      <?php
      foreach ($notificationArray as &$notification) {
        /** <!-- start notification --> */
        echo "<li>";
        echo "<a href='".$notification['url']."'>";
        echo $notification['icon']." ".$notification['msg'];
        echo "</a";
        /** <!-- end notification --> */
        echo "</li>";
      }
      ?>
    </ul>
  </li>
  <li class="footer"><a href="#">View all</a></li>
</ul>
