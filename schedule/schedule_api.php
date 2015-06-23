<?php
//require_once '../_theme/util.inc.php'; //chk_login();
header('Content-Type: text/html; charset=utf-8');
include_once "../_connection/db_base.php";
define('SESSIONPREFIX' , "dtt_");

function System_ShowDate($myDate) {
  $myDateArray=explode("-",$myDate);
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
  return $myDateArray['0']." ".$myMonth." ".$myDateArray['2'];
}

$site_url = $_POST['site_url'];

isset($_SESSION[SESSIONPREFIX.'puser_id']) ? $session = $_SESSION[SESSIONPREFIX.'puser_id'] :  $session = '';

$table = "<table class='table table-bordered' id='show_content'>
    <tr class='active'>
      <th>
        ลำดับ
    </th>
    <th>
        วันที่
    </th>
    <th>
        ชื่อหลักสูตร
    </th>
    <th>
        ชื่อศูนย์
    </th>
    <th>
        จำนวนที่รับ
    </th>
    <th>
        ราคา/คน
    </th>
    <th>
        รายละเอียด
    </th>
    <th>
    </th>
</tr>";

$count = 1;
$script = "";
$modal = "";
$btn_edit = "";
        // prepare and query (direct)
$result = $mysqli->query("SELECT site_schedule.id, schedule_name, user_qty, DATE_FORMAT(schedule_date,'%d-%m-%Y') AS schedule_date, DATE_FORMAT(schedule_end_date,'%d-%m-%Y') AS schedule_end_date, price_per_person, schedule_desc, schedule_payment, schedule_after_payment, site_id, site_name, site_url
                          FROM site_schedule
                          INNER JOIN site_detail ON site_schedule.site_id = site_detail.id
                          WHERE site_schedule.delete_at IS NULL
                          AND site_id = '".$site_url."'
                          AND DATE(schedule_end_date) >= DATE_ADD(DATE(NOW()), INTERVAL 543 YEAR)
                          ORDER BY site_schedule.id");
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {

    $result_check = $mysqli->query("SELECT count(*) AS join_status, payment_upload_status
      FROM site_join
      WHERE schedule_id = '".$row['id']."'
      AND user_id = '".$session."'");
    $row_check = $result_check->fetch_assoc();

    $result_check_edit = $mysqli->query("SELECT count(*) AS edit_status
                FROM site_schedule
                WHERE user_id = '".$session."'
                AND site_id = '".$row['site_id']."'");
    $result_check_edit = $result_check_edit->fetch_assoc();

    if (0 < $result_check_edit['edit_status']) {
      $btn_edit = "<a type='button' href='site/site_schedule.php?site_id=".$row['site_id']."' class='btn btn-primary btn-flat'>จัดการหลักสูตร</a>";
    } else {
      $btn_edit = "";
    }

    if (0 < $row_check['join_status']) {
      if (0 == $row_check['payment_upload_status']) {
        //echo $row_check['payment_upload_status'];
        $btn_join = "<a type='button' class='btn btn-default btn-flat'>เข้าร่วมหลักสูตรแล้ว</a>
        <a type='button' class='btn btn-primary btn-flat' href='site/transfer_confirm.php?schedule_id=".$row['id']."'>ยืนยันการจ่ายเงิน</a>";
    } else {
        $btn_join = "<a type='button' class='btn btn-default btn-flat'>เข้าร่วมหลักสูตรแล้ว</a>
        <a type='button' class='btn btn-success btn-flat'>การจ่ายเงินเรียบร้อยแล้ว</a>";
    }
} else {
  $btn_join = "<a type='button' href='schedule/join.php?schedule_id=".$row['id']."' class='btn btn-primary btn-flat'>เข้าร่วมหลักสูตร</a>";
}

$table .= "<tr>
<td>".$count."</td>
<td>".System_ShowDate($row['schedule_date'])." - ".System_ShowDate($row['schedule_end_date'])."</td>
<td>".$row['schedule_name']."</td>
<td><a href='http://".$row['site_url'].".detoxthai.org/detoxthai_lte/'>".$row['site_name']."<a></td>
<td>".$row['user_qty']." คน</td>
<td>".$row['price_per_person']."</td>
<td><button type='button' class='btn btn-primary btn-flat' data-toggle='modal' data-target='#myModal_gen".$count."'>รายละเอียด</button></td>
<td>".$btn_edit."</td>
</tr>";

$modal .= "<div class='modal fade bs-example-modal-lg' id='myModal_gen".$count."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h4 class='modal-title' id='myModalLabel'>
          รายละเอียด
      </h4>
  </div>
  <div class='modal-body'>
    <p class='text-right'>
      ".$btn_join."
  </p>
  <p><strong>วันที่ :</strong> ".System_ShowDate($row['schedule_date'])." - ".System_ShowDate($row['schedule_end_date'])."</p>
  <p><strong>ชื่อหลักสูตร :</strong> ".$row['schedule_name']."</p>
  <p><strong>จำนวนที่รับ :</strong> ".$row['user_qty']." คน</p>
  <p><strong>ราคา/คน :</strong> ".$row['price_per_person']."</p>
  <p><strong>รายละเอียด :<hr/></strong><p>
      ".htmlspecialchars_decode($row['schedule_desc'])."
      <p><strong>รายละเอียดการจ่ายเงิน :<hr/></strong><p>
        ".htmlspecialchars_decode($row['schedule_payment'])."
        <p><strong>รายละเอียดหลังการจ่ายเงิน :<hr/></strong><p>
        ".htmlspecialchars_decode($row['schedule_after_payment'])."
      </div>
      <div class='modal-footer'>
          <button type='button' class='btn btn-default btn-flat' data-dismiss='modal'>Close</button>
      </div>
  </div>
</div>
</div>";
$script = "<script>
  $(document).ready(function(){";
$script .= "$('#detail_gen".$count."').sceditor({
    plugins: 'bbcode',
    width: '98%',
    toolbar: 'justify',
    readOnly: 'true',
    resizeEnabled: false,
    style: 'edit/minified/jquery.sceditor.default.min.css'
});";
$script .= "$('#payment_gen".$count."').sceditor({
  plugins: 'bbcode',
  width: '98%',
  toolbar: 'justify',
  readOnly: 'true',
  resizeEnabled: false,
  style: 'edit/minified/jquery.sceditor.default.min.css'
});";
$script .= "$('#afterpayment_gen".$count."').sceditor({
  plugins: 'bbcode',
  width: '98%',
  toolbar: 'justify',
  readOnly: 'true',
  resizeEnabled: false,
  style: 'edit/minified/jquery.sceditor.default.min.css'
});";
$script .= "});";

$count++;
}
}
$table .= "</table>";
echo $table.":codeerror:".$modal." ".$script;
?>
