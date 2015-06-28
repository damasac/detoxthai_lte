<?php
//	print_r($_FILES);
//    echo "<hr>";
//    print_r($_POST);
//	exit;
    set_time_limit(36000000);
    ini_set('memory_limit', '256M');
    ini_set('post_max_size', '256M');
    ini_set('upload_max_filesize', '256M');

	  header("Content-type:text/html; charset=UTF-8");

    $photo=$_FILES['photo']['tmp_name'];
    $photo_name=$_FILES['photo']['name'];
    //$photo_size=$_FILES['photo']['size'];
    // $photo_type=$_FILES['photo']['type'];

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
    // id_photo ล่าสุด + นามสกุลไฟล์ = เป็นชื่อไฟล์รูป
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
        $new_w = 300;
        $new_h = round(($new_w/$ori_w) * $ori_h);
    } else {
        $new_h =225;
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
        imagejpeg($new_img,"file_upload/album/small/$filename");
    } else if ($ext =="png") {
        imagepng($new_img,"file_upload/album/small/$filename");
    } else if ($ext =="gif") {
        imagegif($new_img,"file_upload/album/small/$filename");
    }

    if ($ext =="jpg" or $ext =="jpeg") {
        imagejpeg($ori_img_new,"file_upload/album/large/$filename");
    } else if ($ext =="png") {
        imagepng($ori_img_new,"file_upload/album/large/$filename");
    } else if ($ext =="gif") {
        imagegif($ori_img_new,"file_upload/album/large/$filename");
    }
    // ทำลาย buffer
    imagedestroy($ori_img);
    imagedestroy($new_img);

    // บันทึกชื่อไฟล์รูป
	$filename_org = preg_replace("[^\w\s\d\.\-_~,;:\[\]\(\]]", '',  $photo_name);
	//


    $ref_userx = $_POST['ref_user'];
    $createtime = date('Y-m-d H:i:s');
	//
    $sql="INSERT INTO `tbl_surveyalbum` (`ref_user`, `file_name`, `file_name_org`, `file_type`, `createtime`)
    VALUES ('$ref_userx', '$filename', '$filename_org', '$ext',  '$createtime');";
	//echo $sql;
	$result = $mysqli->query($sql);
	$last_id = $mysqli->insert_id;
	//echo $last_idx; exit;
    echo '<div class="row"  id="divfile'.$last_id.'">
            <hr>
            <div class="col-lg-3 col-md-3 col-sm-3">
                    <a target="_blank" href="file_upload/album/large/'.$filename.'" data-gallery>
                    <img class="img-responsive img-thumbnail" src="file_upload/album/small/'.$filename.'">
                    </a>

              </div>
              <div class="col-md-9">
              ยังไม่ได้ระบุคำอธิบาย
              <hr>
              <a  style="cursor : pointer;" onclick="popup_album(\'manage\', \''.$last_id.'\')" class="btn btn-success"><li class="fa fa-edit"></li> แก้ไข</a>
              <a  style="cursor : pointer;" onclick="return confirm(\'ยืนยันการลบ ?\') ? del_file(\''.$last_id.'\', \'divfile'.$last_id.'\') : \'\';" class="btn btn-danger"><li class="fa fa-picture-o"></li> ลบ</a>
              <div class="pull-right">
              ส่วนตัว เห็นแค่ฉันเท่านั้น) <li class="text-danger fa fa-lock fa-2x"></li>
              </div>
              </div>
            </div>';
    } else {
	$filename_org = preg_replace("[^\w\s\d\.\-_~,;:\[\]\(\]]", '',  $photo_name);

  //   $ext = strtolower(end(explode('.', $photo_name)));
	// $filename=$timestamp.".".$ext;
	if (move_uploaded_file($_FILES['photo']['tmp_name'], "file_upload/video/$filename")) {

		//

        $ref_userx = $_POST['ref_user'];
        $createtime = date('Y-m-d H:i:s');
        //
        $sql="INSERT INTO `tbl_surveyalbum` (`ref_user`, `file_name`, `file_name_org`, `file_type`, `createtime`)
        VALUES ('$ref_userx', '$filename', '$filename_org', '$ext',  '$createtime');";

		$result = $mysqli->query($sql);
		$last_id = $mysqli->insert_id;
         echo '<div class="row" id="divfile'.$last_id.'">
         <hr>
         <div class="col-lg-3 col-md-3 col-sm-3 text-center" style="height:120px;">
                    <a target="_blank" href="file_upload/video/'.$filename.'"><i class="fa fa-file-video-o fa-5x"></i></a><br><br>
                    <h4>คลิกเพื่อชมวิดีโอคลิป</h4>
                </div>
                <div class="col-md-9">
                ยังไม่ได้ระบุคำอธิบาย
                <hr>
                <a  style="cursor : pointer;" onclick="popup_album(\'manage\', \''.$last_id.'\')" class="btn btn-success"><li class="fa fa-edit"></li> แก้ไข</a>
                <a  style="cursor : pointer;" onclick="return confirm(\'ยืนยันการลบ ?\') ? del_file(\''.$last_id.'\', \'divfile'.$last_id.'\') : \'\';" class="btn btn-danger"><li class="fa fa-picture-o"></li> ลบ</a>
                <div class="pull-right">
                ส่วนตัว เห็นแค่ฉันเท่านั้น) <li class="text-danger fa fa-lock fa-2x"></li>
                </div>
                </div>
            </div>';
	} else {
		echo "Possible file upload attack!\n";
	}

    }

?>
