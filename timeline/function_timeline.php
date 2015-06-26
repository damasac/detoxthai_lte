<?php

    	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
	function TimeThai($strDate)
	{
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		return "$strHour:$strMinute:$strSeconds";
	}
        function formatDateThai($date){

	    $strDay= date("d",strtotime($date));
	    $strYear = date("Y",strtotime($date))+543;
            $strMonth =  date("n",strtotime($date));
	    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	    $strMonthThai=$strMonthCut[$strMonth];
            return "$strDay $strMonthThai $strYear ";
        }
	function lookUpUser($user_id,$mysqli){
      $sql = "SELECT * FROM `puser` WHERE id='".$user_id."' ";
      $query = $mysqli->query($sql);
      $data = $query->fetch_assoc();
      $name = "";
      if($data["nickname"]==""){
        $name=$data["fname"]." ".$data["lname"];
      }else{
        $name=$data["nickname"];
      }

      return $name;

  }
	function lookUpSite($site_id,$mysqli){
		$sql = "SELECT * FROM `site_detail` WHERE id='".$site_id."' ";
		$query = $mysqli->query($sql);
		$data = $query->fetch_assoc();
    // print_r($data["sitename"]);
		$dataSitename = $data["site_name"];
		return $dataSitename;
	}
  function LookUpSchdule($schedule_id,$mysqli){
    $sql = "SELECT * FROM `site_schedule` WHERE id='".$schedule_id."' ";
    $query = $mysqli->query($sql);
    $data = $query->fetch_assoc();
    return $data["schedule_name"];
  }
?>
