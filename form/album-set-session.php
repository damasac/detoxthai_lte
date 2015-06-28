<?php
session_start();
header("Content-type:text/html; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

if($_GET['task']=='set-session'){
  $_SESSION[$_POST['ss_name']]=$_POST['val'];
}
?>
