<?php require_once '../_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>
<?php include_once "../_connection/db.php"; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    จัดการศูนย์
    <small>จัดการหรือแก้ไขส่วนต่างๆ ของศูนย์</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="../sites.php"><i class="fa fa-home"></i> ค่ายล้างพิษตับ</a></li>
    <li class="active">จัดการศูนย์</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php
  $result = $mysqli->query("SELECT COUNT(id) AS sitecount
    FROM site_detail WHERE create_user = 1");
  $row = $result->fetch_assoc();
  ?>

  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">ศูนย์ล้างพิษตับของท่าน <code>มีทั้งหมด <?php echo $row['sitecount']; ?> ศูนย์</code></h3>
    </div>
    <div class="box-body">
      <table class="table table-bordered">
        <tr class="active">
          <th>
            ลำดับ
          </th>
          <th>
            ชื่อศูนย์/ลิ้งค์
          </th>
          <th>
            ที่ตั้ง
          </th>
          <th>
            จัดการหน้าเว็บ
          </th>
          <th>
          </th>
        </tr>
        <?php
        $box = "";
        $html_province = "";
        $html_amphur = "";
        $html_district = "";
        $script = "";
        $script_address = "";

        $result = $mysqli->query("SELECT id, site_name, site_url, site_province, site_amphur, site_district, site_house_no, site_village_no, site_muban,
          site_postal_code, site_telephone, site_mobile, CONCAT(' บ้าน', site_muban, ' บ้านเลขที่ ', site_house_no, ' หมู่ ', site_village_no, ' ตำบล', DISTRICT_NAME, ' อำเภอ', AMPHUR_NAME, ' จังหวัด', PROVINCE_NAME) AS address
          FROM site_detail
          LEFT JOIN const_district ON site_district = DISTRICT_ID
          LEFT JOIN const_amphur ON site_amphur = const_amphur.AMPHUR_ID
          LEFT JOIN const_province ON site_province = const_province.PROVINCE_ID
          WHERE create_user = 1
          ORDER BY id");
        //$result->execute();
        $count = 1;
                // display it
        if ($result !== false) {
          foreach($result as $row) {
            echo "<tr><td>".$count."</td>
            <td><a href='http://".$row['site_url'].".detoxthai.org/wp-content/site/site.php' target='_blank'>".$row['site_name']."</a></td><td>".$row['address']."</td>
            <td><a href='index.php?site_name=".$row['site_url']."' class='btn btn-primary btn-flat'><i class='fa fa-fw fa-wrench'></a></td>
            <td>
              <button class='btn btn-primary btn-flat' data-toggle='modal' data-target='#myModal".$count."'><i class='fa fa-fw fa-pencil'></i></button>
              <a href='delete_site.php?site_id=".$row['id']."' class='btn btn-danger btn-flat'><i class='fa fa-fw fa-trash'></i></a>
            </td></tr>";

          // prepare and query (direct)
            $result = $mysqli->query('SELECT PROVINCE_ID, PROVINCE_NAME FROM const_province ORDER BY PROVINCE_NAME');
            //$result->execute();
          // display it
            if ($result !== false) {
              foreach($result as $province) {
                if($row['site_province'] == $province['PROVINCE_ID']){
                  $html_province .= '<option value='.$province['PROVINCE_ID'].' selected>'.$province['PROVINCE_NAME'].'</option>';
                }else{
                  $html_province .= '<option value='.$province['PROVINCE_ID'].'>'.$province['PROVINCE_NAME'].'</option>';
                }
              }
            }

            //echo $html_province;

          // prepare and query (direct)
            $result = $mysqli->query('SELECT AMPHUR_ID, AMPHUR_NAME FROM const_amphur WHERE PROVINCE_ID = '.$row['site_province'].' ORDER BY AMPHUR_NAME');
            //$result->execute();
          // display it
            if ($result !== false) {
              foreach($result as $amphur) {
                if($row['site_amphur'] == $amphur['AMPHUR_ID']){
                  $html_amphur .= '<option value='.$amphur['AMPHUR_ID'].' selected>'.$amphur['AMPHUR_NAME'].'</option>';
                }else{
                  $html_amphur .= '<option value='.$amphur['AMPHUR_ID'].'>'.$amphur['AMPHUR_NAME'].'</option>';
                }
              }
            }

          // prepare and query (direct)
            $result = $mysqli->query('SELECT DISTRICT_ID, DISTRICT_NAME FROM const_district WHERE AMPHUR_ID = '.$row['site_amphur'].' ORDER BY DISTRICT_NAME');
            //$result->execute();
          // display it
            if ($result !== false) {
              foreach($result as $district) {
                if($row['site_district'] == $district['DISTRICT_ID']){
                  $html_district .= '<option value='.$district['DISTRICT_ID'].' selected>'.$district['DISTRICT_NAME'].'</option>';
                }else{
                  $html_district .= '<option value='.$district['DISTRICT_ID'].'>'.$district['DISTRICT_NAME'].'</option>';
                }
              }
            }

            $script .= "<script>
            $(document).ready(function(){
              $('#btadd".$count."').click(function(){
                $.post('update_site.php',
                {
                  site_id: ".$row['id'].",
                  site_url: $('#urlname".$count."').val(),
                  site_name: $('#sitename".$count."').val(),
                  site_province: $('#province".$count."').val(),
                  site_amphur: $('#amphur".$count."').val(),
                  site_district: $('#district".$count."').val(),
                  site_house_no: $('#houseno".$count."').val(),
                  site_village_no: $('#villageno".$count."').val(),
                  site_muban: $('#muban".$count."').val(),
                  site_postal_code: $('#postalcode".$count."').val(),
                  site_telephone: $('#tel".$count."').val(),
                  site_mobile: $('#mobile".$count."').val(),
                  site_user: 1,
                },
                function(data,status){
                  location.reload();
                });
});
});
</script>";

            $script_address .= '<script type="text/javascript">
  $(document).ready(function(){
    $("#province'.$count.'").change(function() {
            //alert("Codeerror");
            $("#amphur'.$count.'").empty();
            var option = new Option("เลือกอำเภอ/เขต", "");
            $("#amphur'.$count.'").append($(option));
            $.getJSON("../api/getamphur.php?province_id=" + $("#province'.$count.'").val(), function(data){
              $.each(data.amphur, function(i, amphur){
                var option = new Option(amphur.AMPHUR_NAME, amphur.AMPHUR_ID);
                $("#amphur'.$count.'").append($(option));
              });
            });
          });
    $("#amphur'.$count.'").change(function() {
      $("#district'.$count.'").empty();
      var option = new Option("เลือกตำบล/แขวง", "");
      $("#district'.$count.'").append($(option));
      $.getJSON("../api/getdistrict.php?amphur_id=" + $("#amphur'.$count.'").val(), function(data){
        $.each(data.district, function(i, district){
          var option = new Option(district.DISTRICT_NAME, district.DISTRICT_ID);
          $("#district'.$count.'").append($(option));
        });
      });
    });

  });
  </script>';

$box .= "<div class='modal fade' id='myModal".$count."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <h4 class='modal-title' id='myModalLabel'>เพิ่มศูนย์ล้างพิษตับ</h4>
    </div>
    <div class='modal-body'>
      <form class='form-horizontal'>
        <div class='form-group'>
          <label for='urlname".$count."' class='col-sm-2 control-label'>URL : </label>
          <div class='col-sm-5'>
            <input type='text' class='form-control' id='urlname".$count."' placeholder='ชื่อคำนำหน้า URL' value='".$row['site_url']."' disabled>
          </div>
          <div class='col-sm-5'>
            <h4 id='url'>.detoxthai.org</h4>
          </div>
        </div>
        <div class='form-group'>
          <label for='sitename".$count."' class='col-sm-2 control-label'>ชื่อศูนย์ : </label>
          <div class='col-sm-10'>
            <input type='text' class='form-control' id='sitename".$count."' placeholder='ชื่อศูนย์' value='".$row['site_name']."'>
          </div>
        </div>
        <div class='form-group'>
          <label for='' class='col-sm-2 control-label'>ที่ตั้ง : </label>
          <div class='col-sm-10'>
            <label for='province".$count."' class='control-label'>จังหวัด : </label>
            <select id='province".$count."' class='form-control'>
              <option value=''>เลือกจังหวัด</option>
              ".$html_province."
            </select>
          </div>
        </div>
        <div class='form-group'>
          <label for='amphur' class='col-sm-2 control-label'></label>
          <div class='col-sm-10'>
            <label for='amphur".$count."' class='control-label'>อำเภอ : </label>
            <select id='amphur".$count."' o class='form-control'>
              <option value=''>เลือกอำเภอ/เขต</option>
              ".$html_amphur."
            </select>
          </div>
        </div>
        <div class='form-group'>
          <label for='district' class='col-sm-2 control-label'></label>
          <div class='col-sm-10'>
            <label for='district".$count."' class='control-label'>ตำบล : </label>
            <select id='district".$count."' o class='form-control'>
              <option value=''>เลือกตำบล/แขวง</option>
              ".$html_district."
            </select>
          </div>
        </div>
        <div class='form-group'>
          <label for='houseno".$count."' class='col-sm-2 control-label'></label>
          <div class='col-sm-10'>
            <label for='houseno".$count."' class='control-label'>บ้านเลขที่ : </label>
            <input type='text' class='form-control' id='houseno".$count."' placeholder='บ้านเลขที่' value='".$row['site_house_no']."'>
          </div>
        </div>
        <div class='form-group'>
          <label for='villageno".$count."' class='col-sm-2 control-label'></label>
          <div class='col-sm-10'>
            <label for='villageno".$count."' class='control-label'>หมู่ที่ : </label>
            <input type='text' class='form-control' id='villageno".$count."' placeholder='หมู่ที่' value='".$row['site_village_no']."'>
          </div>
        </div>
        <div class='form-group'>
          <label for='muban".$count."' class='col-sm-2 control-label'></label>
          <div class='col-sm-10'>
            <label for='muban".$count."' class='control-label'>หมู่บ้าน : </label>
            <input type='text' class='form-control' id='muban".$count."' placeholder='หมู่บ้าน' value='".$row['site_muban']."'>
          </div>
        </div>
        <div class='form-group'>
          <label for='postalcode".$count."' class='col-sm-2 control-label'></label>
          <div class='col-sm-10'>
            <label for='postalcode".$count."' class='control-label'>รหัสไปรษณีย์ : </label>
            <input type='text' class='form-control' id='postalcode".$count."' placeholder='รหัสไปรษณีย์' value='".$row['site_postal_code']."'>
          </div>
        </div>
        <div class='form-group'>
          <label for='tel".$count."' class='col-sm-2 control-label'></label>
          <div class='col-sm-10'>
            <label for='tel".$count."' class='control-label'>โทร : </label>
            <input type='text' class='form-control' id='tel".$count."' placeholder='โทร' value='".$row['site_telephone']."'>
          </div>
        </div>
        <div class='form-group'>
          <label for='mobile".$count."' class='col-sm-2 control-label'></label>
          <div class='col-sm-10'>
            <label for='mobile".$count."' class='control-label'>มือถือ : </label>
            <input type='text' class='form-control' id='mobile".$count."' placeholder='มือถือ' value='".$row['site_mobile']."'>
          </div>
        </div>
      </form>
    </div>
    <div class='modal-footer'>
      <button type='button' class='btn btn-default btn-flat' data-dismiss='modal'>ยกเลิก</button>
      <button type='button' class='btn btn-primary btn-flat' id='btadd".$count."'>แก้ไข</button>
    </div>
  </div>
</div>
</div>";

$count++;
}
}
?>
</table>
<?php echo $box; ?>
</div><!-- /.box-body -->
</div><!-- /.box -->

</section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>
  <?php echo  $script_address; ?>
  <?php echo $script ?>
<?php eb();?>

<?php render($MasterPage);?>

