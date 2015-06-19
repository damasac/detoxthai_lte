<?php
    include_once "../_connection/db_base.php";
    $task = $_GET["task"];
    if($task=="post_timeline"){
        $sql1 = "INSERT INTO `timeline_post`(user_id,text) VALUES ('".$_POST["user_id"]."','".$_POST["post"]."') ";
        //echo $sql1;
        $query = $mysqli->query($sql1);
        $post_id = $mysqli->insert_id;
        if(isset($_POST["img"])!=""){
            foreach($_POST["img"] as $img){

                $newimg = substr($img,4);

                $sql2 = "INSERT INTO `timeline_image`(post_id,image)
                VALUES('".$post_id."','".$newimg."')
                ";

                $query2 = $mysqli->query($sql2);
                
            }
        }
    }
?>