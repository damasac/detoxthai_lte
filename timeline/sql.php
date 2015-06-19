<?php
// ...
// SERVER CODE that processes ajax upload and returns a JSON response. Your server action 
// must return a json object containing initialPreview, initialPreviewConfig, & append.
// An example for PHP Server code is mentioned below.
// ...
$p1 = $p2 = [];
$images = $_FILES['images'];
$filenames = $images['name'];
if (empty($filenames)) {
    echo '{}';
    return;
}
for ($i = 0; $i < count($filenames); $i++) {
    $j = $i + 1;
    $key = '<code to parse your image key>';
    $url = '<your server action to delete the file>';
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
    $p2[$i] = ['caption' => '', 'width' => '120px', 'url' => 'delete.php', 'key' => $target];
}
echo json_encode([
    'initialPreview' => $p1, 
    'initialPreviewConfig' => $p2,   
    'append' => true // whether to append these configurations to initialPreview.
                     // if set to false it will overwrite initial preview
                     // if set to true it will append to initial preview
                     // if this propery not set or passed, it will default to true
 ]);
?>