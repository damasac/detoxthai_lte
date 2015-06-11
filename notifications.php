<?php

/** Init session. */
isset($_SESSION[SESSIONPREFIX.'puser_id']) ? $session = $_SESSION[SESSIONPREFIX.'puser_id'] :  $session = '';

/** Init database. */
include_once "_connection/db_base.php";

/** Array notification. */
$notificationArray = array();

$result = $mysqli->query("SELECT site_schedule.schedule_name
                          FROM site_join
                          JOIN site_schedule ON site_join.schedule_id = site_schedule.id
                          WHERE user_id = '".$session."'");

if ($result !== false) {
  foreach($result as $row) {
    array_push($notificationArray, array("icon" => "<i class='fa fa-users text-aqua'></i>", "msg" => "คุณได้เข้าร่วม ".$row['schedule_name']));
    //echo $row['schedule_name'];
  }
}
//print_r($notificationArray);
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
        echo "<a href='#'>";
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
