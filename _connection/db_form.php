<?php
	// Create connection
	$conn = new mysqli("localhost", "root", "root", "detoxthai_lte");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$conn->set_charset("utf8");
	
	//Value Insert
	if(isset( $_POST["startdate"])){
		$startdate = $_POST["startdate"];
		$enddate = $_POST["enddate"];
		$user_id = $_POST["user_id"];
		$user_name = $_POST["user_name"];
		$location = $_POST["location"];
		$createdate = date("Y-m-d H:i:s");
	}
	
	//Value Task
	if(isset($_GET["task"]))
		$task = $_GET["task"];
	else
		$task='';
	
	//Value Auto Update
	if(isset($_POST["form_id"])) {
		$form_id = $_POST["form_id"];
		$field = $_POST["field"];
		$value = $_POST["value"];
	}
	
	if($task=="insertBlank"){
		
		
		$sqlInsert1 =  "INSERT INTO `tbl_surveyuser`(`startdate`,`enddate`,`createdate`,`location`,`user_id`,`user_name`)
		VALUES('".$startdate."','".$enddate."','".$createdate."','".$location."','".$user_id."','".$user_name."')
		";
		
		$sqlquery1 = $conn->query($sqlInsert1) or die($conn->error());
		
		$id = $conn->insert_id;
		
		$sqlInsert2 = "INSERT INTO `tbl_surveyform`(`ref_id_create`) VALUES('".$id."')";
		
		$sqlquery2 = $conn->query($sqlInsert2) or die($conn->error());
		
		$_SESSION["form_id"] = $id;
		
		echo $_SESSION["form_id"];
		
		
	}
	if($task=="updateAuto"){
		
		$sqlUpdate = "UPDATE `tbl_surveyform`
				SET `".$field."`='".$value."'
				WHERE `ref_id_create`='".$form_id."' ";
		echo $sqlUpdate;
		$sqlQuery = $conn->query($sqlUpdate) or die($conn->error());
		
		
	}
	if($task=="deleteForm"){
		$sql1 = "DELETE FROM `tbl_surveyform`
				WHERE `ref_id_create`='".$form_id."'";
		$query1 = $conn->query($sql1);
		$sql2 = "DELETE FROM `tbl_surveyuser`
				WHERE `id`='".$form_id."'
				AND `user_id`='".$user_id."'
		";
		//echo $sql1."<br>".$sql2;
		$query2 = $conn->query($sql2);
		
		$sql3 = "SELECT * FROM `tbl_surveyuser` WHERE id='".$form_id."' ";
		
		$query3 = $conn->query($sql3);
		echo $query3->num_rows;
	}
?>