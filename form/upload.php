<?php
	//print_r($_FILES);
//    echo "<hr>";
//    print_r($_POST);
	//exit;
  set_time_limit(36000000);
  ini_set('memory_limit', '256M');
  ini_set('post_max_size', '256M');
  ini_set('upload_max_filesize', '256M');

	header("Content-type:text/html; charset=UTF-8");

    $photo=$_FILES['photo']['tmp_name'];
    $photo_name=$_FILES['photo']['name'];
    //$photo_size=$_FILES['photo']['size'];
    //$photo_type=$_FILES['photo']['type'];

    $timestamp=time();

    include_once "../_connection/db_base.php";

    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    $ext = strtolower(end(explode('.', $photo_name)));
    // random string + timestamp + นามสกุลไฟล์ = เป็นชื่อไฟล์รูป
    $filename=random_string(10).'-'.$timestamp.".".$ext;

	if ($ext == "jpg" or $ext == "jpeg" or $ext =="png" or $ext=="gif") {

    // เริ่มกระบวนการ resize
    if ($ext =="jpg" or $ext =="jpeg") {
        $ori_img = imagecreatefromjpeg($photo);
    } else if ($ext =="png") {
        $ori_img = imagecreatefrompng($photo);
    } else if ($ext =="gif") {
        $ori_img = imagecreatefromgif($photo);
    }
    // ดึงเอาค่าความกว้าง ความสูง
    $ori_size = getimagesize($photo);
    $ori_w = $ori_size[0];
    $ori_h = $ori_size[1];

    //small
    if ($ori_w>=$ori_h) {
        $new_w = 150;
        $new_h = round(($new_w/$ori_w) * $ori_h);
    } else {
        $new_h =110;
        $new_w = round(($new_h/$ori_h) * $ori_w);
    }

    /// large
    if ($ori_w>=$ori_h) {
        $new_w2 = 1250;
        $new_h2 = round(($new_w2/$ori_w) * $ori_h);
    } else {
        $new_h2 =1050;
        $new_w2 = round(($new_h2/$ori_h) * $ori_w);
    }
    // เริ่มกระบวนการ copy
    $new_img= imagecreatetruecolor($new_w, $new_h);
    imagecopyresized($new_img,$ori_img,0,0,0,0,$new_w, $new_h,$ori_w,$ori_h);

    $ori_img_new= imagecreatetruecolor($new_w2, $new_h2);
    imagecopyresized($ori_img_new,$ori_img,0,0,0,0,$new_w2, $new_h2,$ori_w,$ori_h);

    if ($ext =="jpg" or $ext =="jpeg") {
        imagejpeg($new_img,"file_upload/images_small/$filename");
    } else if ($ext =="png") {
        imagepng($new_img,"file_upload/images_small/$filename");
    } else if ($ext =="gif") {
        imagegif($new_img,"file_upload/images_small/$filename");
    }

    if ($ext =="jpg" or $ext =="jpeg") {
        imagejpeg($ori_img_new,"file_upload/images_large/$filename");
    } else if ($ext =="png") {
        imagepng($ori_img_new,"file_upload/images_large/$filename");
    } else if ($ext =="gif") {
        imagegif($ori_img_new,"file_upload/images_large/$filename");
    }
    // ทำลาย buffer
    imagedestroy($ori_img);
    imagedestroy($new_img);

    // บันทึกชื่อไฟล์รูป
	$filename_org = preg_replace("[^\w\s\d\.\-_~,;:\[\]\(\]]", '',  $photo_name);
	//
	$ref_formx = $_POST['ref_form'];
	$ref_fieldx = $_POST['ref_field'];
	$ref_userx = $_POST['ref_user'];
	//
    $sql="INSERT INTO `tbl_surveyfile` (`ref_form`, `ref_field`, `ref_user`, `file_name`, `file_name_org`, `file_type`) VALUES ('$ref_formx', '$ref_fieldx', '$ref_userx', '$filename', '$filename_org', '$ext');";
	//echo $sql;
	$result = $mysqli->query($sql);
	$last_id = $mysqli->insert_id;
	//echo $last_idx; exit;
	echo '<div id="divfile'.$last_id.'" class="col-md-2" style="height:150px;"><a target="_blank" href="file_upload/images_large/'.$filename.'" data-gallery><img class="img-responsive" src="file_upload/images_small/'.$filename.'"></a> [<a style="cursor : pointer;" onclick="del_file(\''.$last_id.'\', \'divfile'.$last_id.'\');">ลบ</a>]</div>';
    } else {
	$filename_org = preg_replace("[^\w\s\d\.\-_~,;:\[\]\(\]]", '',  $photo_name);
    //
	$ref_formx = $_POST['ref_form'];
	$ref_fieldx = $_POST['ref_field'];
	$ref_userx = $_POST['ref_user'];
	//
    $ext = strtolower(end(explode('.', $photo_name)));
	if (move_uploaded_file($_FILES['photo']['tmp_name'], "file_upload/video/$filename")) {
		$sql="INSERT INTO `tbl_surveyfile` (`ref_form`, `ref_field`, `ref_user`, `file_name`, `file_name_org`, `file_type`) VALUES ('$ref_formx', '$ref_fieldx', '$ref_userx', '$filename', '$filename_org', '$ext');";
		//echo $sql; exit;
		$result = $mysqli->query($sql);
		$last_id = $mysqli->insert_id;
		echo '<div id="divfile'.$last_id.'" class="col-md-2" style="height:150px;"><a target="_blank" href="file_upload/video/'.$filename.'"><i class="fa fa-file-video-o fa-5x"></i></a> <br>[<a target="_blank" href="file_upload/video/'.$filename.'">ดูขนาดใหญ่</a>] [<a style="cursor : pointer;" onclick="del_file(\''.$last_id.'\', \'divfile'.$last_id.'\');">ลบ</a>]</div>';
	} else {
		echo "Possible file upload attack!\n";
	}

  }

?>
