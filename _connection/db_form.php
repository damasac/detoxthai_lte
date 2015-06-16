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
		if(isset($_POST["field"]))
			$field = $_POST["field"];
		if($_POST["value"])
			$value = $_POST["value"];
	}
	
	if($task=="insertBlank"){
		
		
		$sqlInsert1 =  "INSERT INTO `tbl_surveyuser`(`startdate`,`enddate`,`createdate`,`location`,`user_id`, `status`)
		VALUES('".$startdate."','".$enddate."','".$createdate."','".$location."','".$user_id."')
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
	else if($task=="updateAuto_private"){
		$sqlUpdate = "UPDATE `tbl_surveyprivate`
				SET `".$field."`='".$value."'
				WHERE `ref_id_user`='".$form_id."' ";
		echo $sqlUpdate;
		$sqlQuery = $conn->query($sqlUpdate) or die($conn->error());
		
	}
	
	if($task=="deleteForm"){
		$sql1 = "UPDATE `tbl_surveyuser` SET status = '1' WHERE `id`='".$form_id."'";
		$query1 = $conn->query($sql1);
		
		$sql3 = "SELECT * FROM `tbl_surveyuser` WHERE id='".$form_id."' AND status='0';";
		$query3 = $conn->query($sql3);
		echo $query3->num_rows;
	}
?>