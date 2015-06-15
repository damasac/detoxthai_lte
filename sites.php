<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('notifications');?>
  <?php include_once 'notifications.php'; ?>
<?php eb();?>

<?php sb('content');?>
<?php include_once "_connection/db_base.php"; ?>

<?php
  isset($_SESSION[SESSIONPREFIX.'puser_id']) ? $session = $_SESSION[SESSIONPREFIX.'puser_id'] :  $session = '';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    ค่ายล้างพิษ
    <small>สร้างหรือจัดการค่ายล้างพิษ</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-tachometer"></i> ค่ายล้างพิษ</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">ค่ายล้างพิษทั้งหมด</h3>
    </div>
    <div class="box-body">
      <?php
        //isset($_COOKIE['detoxthai']) ? $detoxthai = $_COOKIE['detoxthai'] :  $detoxthai = '';
        if ('' != $session) {
      ?>
      <p class="text-right">
        <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModal">ตั้งศูนย์</button>
        <a class="btn btn-primary btn-flat" href="site/site_manage.php">จัดการศูนย์</a>
      </p>
      <?php
        }
      ?>
      <table class="table table-bordered">
        <tr class="active">
          <th>
            ลำดับ
          </th>
          <th>
            ลิ้งค์
          </th>
          <th>
            ที่ตั้ง
          </th>
          <th></th>
        </tr>
        <?php
        $sql = "SELECT site_detail.id AS site_id, site_name, site_url, site_province, site_amphur, site_district, site_house_no, site_village_no, site_muban,
        site_postal_code, site_telephone, site_mobile, CONCAT(' บ้าน', site_muban, ' บ้านเลขที่ ', site_house_no, ' หมู่ ', site_village_no, ' ตำบล', DISTRICT_NAME, ' อำเภอ', AMPHUR_NAME, ' จังหวัด', PROVINCE_NAME) AS address
        FROM site_detail
        LEFT JOIN const_district ON site_district = DISTRICT_ID
        LEFT JOIN const_amphur ON site_amphur = const_amphur.AMPHUR_ID
        LEFT JOIN const_province ON site_province = const_province.PROVINCE_ID
        WHERE site_detail.delete_at IS NULL
        ORDER BY id";

        $result = $mysqli->query($sql);

        $count = 1;

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {

            $result_follow = $mysqli->query("SELECT COUNT(*) AS check_follow
                FROM site_follow
                WHERE user_id = '".$session."'
                AND site_id = '".$row['site_id']."'");
            $row_follow = $result_follow->fetch_assoc();

            if (0 == $row_follow['check_follow']) {
              $btn_follow = "<a type='button' href='site/site_follow.php?site_id=".$row['site_id']."' class='btn btn-primary btn-flat'><i class='fa fa-fw fa-heart'></i> ติดตาม</a>";
            } else {
              $btn_follow = "<a type='button' href='site/site_unfollow.php?site_id=".$row['site_id']."' class='btn btn-default btn-flat'><i class='fa fa-fw fa-heart'></i> ยกเลิกการติดตาม</a>";
            }

            echo "<tr>
                  <td>".$count."</td><td><a href='http://".$row['site_url'].".detoxthai.org/home.php' target='_blank'>http://".$row['site_url'].".detoxthai.org</a></td>
                  <td>".$row['address']."</td>
                  <td>".$btn_follow."</td>
                  </tr>";
            $count++;
          }
        }
        ?>
      </table>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ตั้งศูนย์</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="addform">
          <div class="form-group">
            <label for="urlname" class="col-sm-2 control-label">URL : </label>
            <div class="col-sm-5">
              <input type="text" class="form-control" id="urlname" placeholder="ชื่อคำนำหน้า URL" required>
            </div>
            <div class="col-sm-5">
              <h4 id="url">.detoxthai.org</h4>
            </div>
          </div>
          <div class="form-group">
            <label for="sitename" class="col-sm-2 control-label">ชื่อค่ายล้างพิษ : </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="sitename" placeholder="ชื่อค่าย">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">ที่ตั้ง : </label>
            <div class="col-sm-10">
              <label for="province" class="control-label">จังหวัด : </label>
              <select id="province" o class="form-control">
                <option value="">เลือกจังหวัด</option>
                <?php
                  // prepare and query (direct)
                  $sql = "SELECT PROVINCE_ID, PROVINCE_NAME FROM const_province ORDER BY PROVINCE_NAME";
                  $result = $mysqli->query($sql);

                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                     echo "<option value=".$row['PROVINCE_ID'].">".$row['PROVINCE_NAME']."</option>";
                   }
                 }
               ?>
             </select>
           </div>
         </div>
         <div class="form-group">
          <label for="amphur" class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <label for="amphur" class="control-label">อำเภอ : </label>
            <select id="amphur" o class="form-control">
              <option value="">เลือกอำเภอ/เขต</option>

            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="district" class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <label for="district" class="control-label">ตำบล : </label>
            <select id="district" o class="form-control">
              <option value="">เลือกตำบล/แขวง</option>

            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="houseno" class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <label for="houseno" class="control-label">บ้านเลขที่ : </label>
            <input type="text" class="form-control" id="houseno" placeholder="บ้านเลขที่">
          </div>
        </div>
        <div class="form-group">
          <label for="villageno" class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <label for="villageno" class="control-label">หมู่ที่ : </label>
            <input type="text" class="form-control" id="villageno" placeholder="หมู่ที่">
          </div>
        </div>
        <div class="form-group">
          <label for="muban" class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <label for="muban" class="control-label">หมู่บ้าน : </label>
            <input type="text" class="form-control" id="muban" placeholder="หมู่บ้าน">
          </div>
        </div>
        <div class="form-group">
          <label for="postalcode" class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <label for="postalcode" class="control-label">รหัสไปรษณีย์ : </label>
            <input type="text" class="form-control" id="postalcode" placeholder="รหัสไปรษณีย์">
          </div>
        </div>
        <div class="form-group">
          <label for="tel" class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <label for="tel" class="control-label">เบอร์โทร : </label>
            <input type="text" class="form-control" id="tel" placeholder="โทร">
          </div>
        </div>
        <div class="form-group">
          <label for="mobile" class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <label for="mobile" class="control-label">มือถือ : </label>
            <input type="text" class="form-control" id="mobile" placeholder="มือถือ">
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">ยกเลิก</button>
      <button type="button" class="btn btn-primary btn-flat" id="btadd">เพิ่ม</button>
    </div>
  </div>
</div>
</div>

<?php eb();?>


<?php sb('js_and_css_footer');?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#province").change(function() {
            //alert("Codeerror");
            $("#amphur").empty();
            var option = new Option("เลือกอำเภอ/เขต", "");
            $("#amphur").append($(option));
            $.getJSON("api/getamphur.php?province_id=" + $("#province").val(), function(data){
              $.each(data.amphur, function(i, amphur){
                var option = new Option(amphur.AMPHUR_NAME, amphur.AMPHUR_ID);
                $("#amphur").append($(option));
              });
            });
          });
    $("#amphur").change(function() {
      $("#district").empty();
      var option = new Option("เลือกตำบล/แขวง", "");
      $("#district").append($(option));
      $.getJSON("api/getdistrict.php?amphur_id=" + $("#amphur").val(), function(data){
        $.each(data.district, function(i, district){
          var option = new Option(district.DISTRICT_NAME, district.DISTRICT_ID);
          $("#district").append($(option));
        });
      });
    });
    $("#btadd").click(function(){
      var site_url = $("#urlname");

      var check_site_exit = 0;
      $.post("site/check_exit_site.php",
        {
          site_url: $("#urlname").val(),
        },
        function(data,status){
              //alert("Data: " + data + "\nStatus: " + status);
              if(0 < data){
                alert('URL นี้มีการใช้งานแล้ว');
                check_site_exit = 1;
              }
        });


      var site_name = $("#sitename");

      var check_site_url = 0;
      var check_site_name = 0;

      if(!site_url.val()) {
        site_url.closest('.form-group').removeClass('has-success').addClass('has-error');
        check_site_url = 1;
      } else {
        site_url.closest('.form-group').removeClass('has-error').addClass('has-success');
      }

      if(!site_name.val()) {
        site_name.closest('.form-group').removeClass('has-success').addClass('has-error');
        check_site_name = 1;
      } else {
        site_name.closest('.form-group').removeClass('has-error').addClass('has-success');
      }

      if( 0 == check_site_url && 0 == check_site_name && 0 == check_site_exit){

        $.post("site/add_site.php",
        {
          site_url: $("#urlname").val(),
          site_name: $("#sitename").val(),
          site_province: $("#province").val(),
          site_amphur: $("#amphur").val(),
          site_district: $("#district").val(),
          site_house_no: $("#houseno").val(),
          site_village_no: $("#villageno").val(),
          site_muban: $("#muban").val(),
          site_postal_code: $("#postalcode").val(),
          site_telephone: $("#tel").val(),
          site_mobile: $("#mobile").val(),
          site_user: <?php echo $session; ?>,
        },
        function(data,status){
              //alert("Data: " + data + "\nStatus: " + status);
              location.reload();
        });
      }
    });

  });
</script>
<script src="../_plugins/input-mask/jquery.inputmask.js"></script>
<script src="../_plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="../_plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script>
  $("[data-mask]").inputmask();
  $("#urlname").inputmask("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
</script>
<?php eb();?>

<?php render($MasterPage);?>
