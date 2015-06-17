<?php
require_once '../_theme/util.inc.php';
chk_login();

isset($_SESSION[SESSIONPREFIX.'puser_id']) ? $session = $_SESSION[SESSIONPREFIX.'puser_id'] :  $session = '';

$ds = DIRECTORY_SEPARATOR;
$storeFolder = 'uploads';

if (!empty($_FILES)) {

    $length = 30;
    $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    $target_file = $target_dir.date("Y_m_d").'_'.$randomString.'.'.$imageFileType;

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    if ($_FILES["file"]["size"] > 500000) {
        $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $uploadOk = 0;
}
if ($uploadOk == 0) {
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        include_once "../_connection/db_base.php";

        $mysqli->query("INSERT INTO site_user_id_card(user_id, card_image) VALUES ('".$session."', '".$target_file."');");

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

}
?>
