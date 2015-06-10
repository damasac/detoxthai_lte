<?php
    error_reporting(0);
    include "../_connection/db.php";
    $task = $_GET["task"];
    $hcode = $_GET["hcode"];
    $txtSearch = $_GET["txtSearch"];
    $area = $_GET["area"];
    $province = $_GET["province"];
    if($task=="hospital"){
    $sql = "SELECT hcode,name FROM all_hospital_thai WHERE `name` LIKE '%".$txtSearch."%' OR `hcode` LIKE '%".$txtSearch."%' LIMIT 10 ";

    $query = $mysqli->query($sql);
    
    while($data = $query->fetch_assoc()){
        $array[] = $data;
    }
    print json_encode($array);
    }
    if($task=="areaProvince"){
	$sql = "SELECT * FROM `all_hospital_zone` WHERE zone_code='".$area."' ";
	 $query = $mysqli->query($sql);
	while($data = $query->fetch_assoc()){
	    $array[] = $data;
	}
	print json_encode($array);
    }
    if($task=="provinceHospital"){
	$sql = "SELECT `hcode`,`name` FROM all_hospital_thai WHERE provincecode='".$province."' ORDER BY hcode";
	$query = $mysqli->query($sql);
	while($data = $query->fetch_assoc()){
	    $array[] = $data;
	}
	print json_encode($array);
    }
    if($task=="getdetailaddress"){
	$sql = "SELECT
	a.provincecode,
	a.province,
	CONCAT(a.provincecode,a.amphurcode) AS amphurcode,
	a.amphur,
	CONCAT(a.provincecode,a.amphurcode,a.tamboncode) AS tamboncode,
	a.tambon,
	b.zone_code
	FROM
		all_hospital_thai AS a
	INNER JOIN all_hospital_zone AS b ON a.provincecode = b.provincecode
	WHERE
		`hcode` = '".$hcode."'
	";
	$query = $mysqli->query($sql);
	while($data = $query->fetch_assoc()){
	    $array[] = $data;
	}
	print json_encode($array);
    }
?>