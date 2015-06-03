<?php
    include_once "../_connection/db.php";

    $site_id = $_POST['site_id'];
    $site_name = $_POST['site_name'];
    $site_url = $_POST['site_url'];
    $site_province = $_POST['site_province'];
    $site_amphur = $_POST['site_amphur'];
    $site_district = $_POST['site_district'];
    $site_house_no = $_POST['site_house_no'];
    $site_village_no = $_POST['site_village_no'];
    $site_muban = $_POST['site_muban'];
    $site_postal_code = $_POST['site_postal_code'];
    $site_telephone = $_POST['site_telephone'];
    $site_mobile = $_POST['site_mobile'];
    $site_user = $_POST['site_user'];

    $result = $mysqli->query("UPDATE site_detail
                             SET site_name = '$site_name', site_url = '$site_url', site_province = '$site_province', site_amphur = '$site_amphur', site_district = '$site_district', site_house_no = '$site_house_no', site_village_no = '$site_village_no', site_muban = '$site_muban',
                            site_postal_code = '$site_postal_code', site_telephone = '$site_telephone', site_mobile = '$site_mobile'
                             WHERE id = '$site_id'");
    //$result->execute();
?>
