<?php
$p1 = $p2 = [];
$images = $_FILES['images'];
$filenames = $images['name'];
if (empty($filenames)) {
    echo '{}';
    return;
}
for ($i = 0; $i < count($filenames); $i++) {

    $ext = explode('.', basename($filenames[$i]));

    $target = "img" . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
    if(move_uploaded_file($images['tmp_name'][$i], $target)) {
        $newimage = explode('/',$target);
        //print_r($newimage);
        $success = true;
        $paths[] = $target;
    } else {
        $success = false;
        break;
    }
    
    $p1[$i] = "<img src='".$target."' data-id='$i' class='file-preview-image'>";
    $p2[$i] = ['caption' => '', 'width' => '120px', 'url' => 'upload-delete.php', 'key' => $target];
}
echo json_encode([
    'initialPreview' => $p1, 
    'initialPreviewConfig' => $p2,   
    'append' => true

 ]);
?>