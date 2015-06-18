<?php
###############################
function System_ShowDateLongTh($myDate) {
###############################
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "มกราคม";  break;
			case "02" : $myMonth = "กุมภาพันธ์";  break;
			case "03" : $myMonth = "มีนาคม"; break;
			case "04" : $myMonth = "เมษายน"; break;
			case "05" : $myMonth = "พฤษภาคม";   break;
			case "06" : $myMonth = "มิถุนายน";  break;
			case "07" : $myMonth = "กรกฎาคม";   break;
			case "08" : $myMonth = "สิงหาคม";  break;
			case "09" : $myMonth = "กันยายน";  break;
			case "10" : $myMonth = "ตุลาคม";  break;
			case "11" : $myMonth = "พฤศจิกายน";   break;
			case "12" : $myMonth = "ธันวาคม";  break;
		}
		$myYear = sprintf("%d",$myDateArray[0]);
        return($myDay . " " . $myMonth . " " . $myYear);
}
###############################
function System_ShowDateEn($myDate) {
###############################
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "Jan.";  break;
			case "02" : $myMonth = "Feb.";  break;
			case "03" : $myMonth = "Mar."; break;
			case "04" : $myMonth = "Apr."; break;
			case "05" : $myMonth = "May.";   break;
			case "06" : $myMonth = "Jun.";  break;
			case "07" : $myMonth = "Jul.";   break;
			case "08" : $myMonth = "Aug.";  break;
			case "09" : $myMonth = "Sep.";  break;
			case "10" : $myMonth = "Oct.";  break;
			case "11" : $myMonth = "Nov.";   break;
			case "12" : $myMonth = "Dec.";  break;
		}
		$myYear = substr(sprintf("%d",$myDateArray[0]),2,2);
        return($myDay . " " . $myMonth . " " . $myYear);
}
###############################
function System_ShowDate($myDate) {
###############################
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "ม.ค.";  break;
			case "02" : $myMonth = "ก.พ.";  break;
			case "03" : $myMonth = "มี.ค."; break;
			case "04" : $myMonth = "เม.ย."; break;
			case "05" : $myMonth = "พ.ค.";   break;
			case "06" : $myMonth = "มิ.ย.";  break;
			case "07" : $myMonth = "ก.ค.";   break;
			case "08" : $myMonth = "ส.ค.";  break;
			case "09" : $myMonth = "ก.ย.";  break;
			case "10" : $myMonth = "ต.ค.";  break;
			case "11" : $myMonth = "พ.ย.";   break;
			case "12" : $myMonth = "ธ.ค.";  break;
		}
		$myYear = substr(sprintf("%d",$myDateArray[0])+543,2,2);
        return($myDay . " " . $myMonth . " " . $myYear);
}
?>