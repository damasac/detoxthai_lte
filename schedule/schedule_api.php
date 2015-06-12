<?php
require_once '../_theme/util.inc.php'; //chk_login();
include_once "../_connection/db_base.php";

function getDateThai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
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
        จำนวนที่รับ
    </th>
    <th>
        ราคา/คน
    </th>
    <th>
        รายละเอียด
    </th>
</tr>";

$count = 1;
$script = "";
$modal = "";
        // prepare and query (direct)
$result = $mysqli->query("SELECT id, schedule_name, user_qty, DATE_FORMAT(schedule_date,'%d-%m-%Y') AS schedule_date, DATE_FORMAT(schedule_end_date,'%d-%m-%Y') AS schedule_end_date, price_per_person, schedule_desc, schedule_payment, schedule_after_payment FROM site_schedule WHERE site_id = '".$site_url."' ORDER BY id");
if ($result->num_rows > 0) {
  foreach($result as $row) {

    $result_check = $mysqli->query("SELECT count(*) AS join_status, payment_upload_status
      FROM site_join
      WHERE schedule_id = '".$row['id']."'
      AND user_id = '".$session."'");
    $row_check = $result_check->fetch_assoc();

            //echo $row_check['join_status'];

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
<td>".getDateThai($row['schedule_date'])." - ".getDateThai($row['schedule_end_date'])."</td>
<td>".$row['schedule_name']."</td>
<td>".$row['user_qty']." คน</td>
<td>".number_format($row['price_per_person'])." บาท</td>
<td><button type='button' class='btn btn-primary btn-flat' data-toggle='modal' data-target='#myModal_gen".$count."'>รายละเอียด</button></td>
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
  <p><strong>วันที่ :</strong> ".getDateThai($row['schedule_date'])." - ".getDateThai($row['schedule_end_date'])."</p>
  <p><strong>ชื่อหลักสูตร :</strong> ".$row['schedule_name']."</p>
  <p><strong>จำนวนที่รับ :</strong> ".$row['user_qty']." คน</p>
  <p><strong>ราคา/คน :</strong> ".number_format($row['price_per_person'])." บาท</p>
  <p><strong>รายละเอียด :<hr/></strong><p>
      <textarea class='form-control' id='detail_gen".$count."' rows='50' id='scheduledesc' placeholder='รายละเอียดหลักสูตร'>".html_entity_decode($row['schedule_desc'])."</textarea>
      <p><strong>รายละเอียดการจ่ายเงิน :<hr/></strong><p>
        <textarea class='form-control' id='payment_gen".$count."' rows='50' id='scheduledesc' placeholder='รายละเอียดหลักสูตร'>".html_entity_decode($row['schedule_payment'])."</textarea>
        <p><strong>รายละเอียดหลังการจ่ายเงิน :<hr/></strong><p>
          <textarea class='form-control' id='afterpayment_gen".$count."' rows='50' id='scheduledesc' placeholder='รายละเอียดหลักสูตร'>".html_entity_decode($row['schedule_after_payment'])."</textarea>
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
