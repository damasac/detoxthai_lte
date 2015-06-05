<?php
// Read html file to be processed into $data variable
$html = file_get_contents('http://www.detoxthai.org/wp-content/surveyform/index.php');
$dom = new DOMDocument;
$dom->loadHTML($html);

for($i=0;$i<=1000;$i++){
$img = $dom->getElementsByTagName("textarea")->item($i);

//if($var =! $img->attributes->getNamedItem("id")->value){
//    $var = $img->attributes->getNamedItem("id")->value; 
//    echo $img->attributes->getNamedItem("id")->value; echo "<br>";
//}


//$img = $dom->getElementsByTagName('select')->item($i);
echo $img->attributes->getNamedItem("id")->value; echo "<br>";
//
//$img = $dom->getElementsByTagName('textarea')->item($i);
//echo $img->attributes->getNamedItem("id")->value; echo "<br>";
}
?>