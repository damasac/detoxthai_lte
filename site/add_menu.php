<?php
    include_once "../_connection/db_base.php";

    /*if(!isset($_COOKIE['detoxthai'])){
      header('Location: http://www.detoxthai.org/');
    }*/

    $menu_order = $_POST['menuorder'];
    $menu_name = $_POST['menuname'];
    $display = $_POST['display'];
    $subdisplay = $_POST['subdisplay'];
    $mainmenu = $_POST['mainmenu'];
    $site_id = $_POST['site_id'];

    $result = $mysqli->query("INSERT INTO
                site_content (content_html)
                VALUES ('เพิ่มเนื้อหาเว็บไซต์')");
    $last_id = $mysqli->insert_id;

    if(0 == $subdisplay){
        $result = $mysqli->query("INSERT INTO
                site_menu (menu_order, menu_name, display_menu, content_id, site_id)
                VALUES ('$menu_order', '$menu_name', '$display', $last_id, '$site_id')");
    }else{
        $result = $mysqli->query("INSERT INTO
                site_submenu (menu_order, menu_name, status_menu, main_menu_id, content_id, site_id)
                VALUES ('$menu_order', '$menu_name', '$display', '$mainmenu', $last_id, '$site_id')");
    }
?>
