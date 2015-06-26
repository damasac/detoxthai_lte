<?php
    include_once "../_connection/db_base.php";
    $task = $_GET["task"];
    if($task=="post_timeline"){
        $sql1 = "INSERT INTO `timeline_post`(user_id,text) VALUES ('".$_POST["user_id"]."','".$_POST["post"]."') ";
        //echo $sql1;
        $query = $mysqli->query($sql1);
        $post_id = $mysqli->insert_id;
//        $sql3 = "INSERT INTO `timeline_event`(id_event,type_event)"
//                . "VALUES('".$post_id.",'post')";
//        $query3 = $mysqli->query($sql3);
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
    if($task=="cid"){
      $sql = "UPDATE
        `puser`
        SET
        `cid`='".$_POST["cid"]."'
        WHERE
        `id`='".$_POST["pid"]."'
      ";
      $query = $mysqli->query($sql);
    }
?>
