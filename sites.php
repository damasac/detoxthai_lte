<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>
<link rel="stylesheet" href="_plugins/dropzone/dropzone.css"/>
<?php eb();?>

<?php sb('notifications');?>
<?php include_once 'notifications.php'; ?>
<?php eb();?>

<?php sb('content');?>
<?php include_once "_connection/db_base.php"; ?>

<?php
isset($_SESSION[SESSIONPREFIX.'puser_id']) ? $session = $_SESSION[SESSIONPREFIX.'puser_id'] :  $session = '';

$result_data = $mysqli->query("SELECT COUNT(*) check_data
  FROM tbl_surveyprivate
  WHERE ref_id_user = '".$session."'");
$row_data = $result_data->fetch_assoc();

$check_data = 1;

if (0 == $row_data['check_data']) {
  $check_data = 0;
}

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
      if ('' != $session && $check_data) {
        ?>
        <p class="text-right">
          <button type="button" class="btn btn-primary btn-flat" onclick="showMap();">ตั้งศูนย์</button>
          <a class="btn btn-primary btn-flat" href="site/site_manage.php">จัดการศูนย์</a>
        </p>
        <?php
      } else if('' != $session && !$check_data) {
        echo "<div class='alert alert-danger alert-dismissable js-key'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <h4><i class='icon fa fa-ban'></i> สมาชิกที่บันทึกข้อมูล (คลิกยินยอมเข้าร่วมโครงการ) แล้วเท่านั้น ที่สามารถ สร้างศูนย์สุขภาพได้!</h4>
        ท่านสามารถบันทึกข้อมูลได้ที่เมนู <a href='form/'>บันทึกข้อมูล</a> <i class='icon fa fa-pencil'></i>
      </div>";
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
          ชื่อศูนย์
        </th>
        <th>
          ที่ตั้ง
        </th>
        <th></th>
      </tr>
      <?php
      $sql = "SELECT site_detail.id AS site_id, site_name, site_url, site_province, site_amphur, site_district, site_house_no, site_village_no, site_muban,
      site_postal_code, site_telephone, site_mobile, CONCAT(site_muban, ' บ้านเลขที่ ', site_house_no, ' หมู่ ', site_village_no, ' ตำบล', DISTRICT_NAME, ' อำเภอ', AMPHUR_NAME, ' จังหวัด', PROVINCE_NAME) AS address
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
          <td>".$count."</td><td><a href='http://".$row['site_url'].".detoxthai.org/detoxthai_lte/' target='_blank'>http://".$row['site_url'].".detoxthai.org</a></td>
          <td>".$row['site_name']."</td>
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
      <div class="modal-body form-horizontal">
        <!-- <form class="form-horizontal" id="addform"> -->
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
      <div class="form-group">
        <label for="mobile" class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
          <label for="mobile" class="control-label">ตำแหน่ง : </label>
          <div id="map" style="height:400px"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="mobile" class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
          <label for="mobile" class="control-label">แนบภาพถ่ายบัตรประจำตัวประชาชน : </label>

          <!-- ========================================== -->

          <div id="actions" class="row">

            <div class="col-lg-7">
              <!-- The fileinput-button span is used to style the file input field as button -->
              <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Add files...</span>
              </span>
              <button type="submit" class="btn btn-primary start">
                <i class="glyphicon glyphicon-upload"></i>
                <span>Start upload</span>
              </button>
              <button type="reset" class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span>Cancel upload</span>
              </button>
            </div>

            <div class="col-lg-5">
              <!-- The global file processing state -->
              <span class="fileupload-process" style="display: none;">
                <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
              </span>
            </div>

          </div>
          <!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
          <div class="table table-striped" class="files" id="previews">

            <div id="template" class="file-row">
              <!-- This is used as the file preview template -->
              <div>
                <p></p>
                <span class="preview"><img data-dz-thumbnail /></span>
              </div>
              <div>
                <p class="name" data-dz-name></p>
                <strong class="error text-danger" data-dz-errormessage></strong>
              </div>
              <div>
                <p class="size" data-dz-size></p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
              </div>
              <div>
                <button class="btn btn-primary start">
                  <i class="glyphicon glyphicon-upload"></i>
                  <span>Start</span>
                </button>
                <button data-dz-remove class="btn btn-warning cancel">
                  <i class="glyphicon glyphicon-ban-circle"></i>
                  <span>Cancel</span>
                </button>
                <button data-dz-remove class="btn btn-danger delete">
                  <i class="glyphicon glyphicon-trash"></i>
                  <span>Delete</span>
                </button>
              </div>
            </div>

          </div>

          <!-- ========================================== -->

          <!-- <form action="api/upload.php" class="dropzone">
            <div class="dz-message">
            ลากไฟล์เพื่ออัพโหลดหรือคลิกที่นี่<br>
              <span class="note">(อัพโหลดข้อมูลที่เป็นไฟล์ภาพเท่านั้น)</span>
            </div>
            <img src="removebutton.png" alt="Click me to remove the file." data-dz-remove />
          </form> -->
        </div>
      </div>
      <!-- </form> -->
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
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script src="_plugins/dropzone/dropzone.js"></script>
<script>
  var map;
  var markers = [];

  var lat;
  var lng;

  var locationName;

  var myDropzone;

  function showMap() {
    var mapOptions = {
      zoom: 5
    };

    map = new google.maps.Map(document.getElementById("map"),
      mapOptions);

    $('#myModal').on('shown.bs.modal', function () {
      google.maps.event.trigger(map, 'resize');
      map.setCenter(new google.maps.LatLng(13.736717, 100.523186));

      var myLatlng = new google.maps.LatLng(13.736717, 100.523186);

      var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        draggable:true
      });

      lat = 13.736717;
      lng = 100.523186;

      google.maps.event.addListener(marker, 'dragend', function(event) { lat = event.latLng.lat(); lng = event.latLng.lng(); } );
      markers.push(marker);


      /** ============================= */
        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
          url: "api/upload.php", // Set the url
          thumbnailWidth: 80,
          thumbnailHeight: 80,
          parallelUploads: 20,
          previewTemplate: previewTemplate,
          autoQueue: false, // Make sure the files aren't queued until manually added
          previewsContainer: "#previews", // Define the container to display the previews
          clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        });

        myDropzone.on("addedfile", function(file) {
          // Hookup the start button
          file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
          document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        });

        myDropzone.on("sending", function(file) {
          // Show the total progress bar when upload starts
          document.querySelector("#total-progress").style.opacity = "1";
          // And disable the start button
          file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
          document.querySelector("#total-progress").style.opacity = "0";
        });

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
          myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
        };
        document.querySelector("#actions .cancel").onclick = function() {
          myDropzone.removeAllFiles(true);
        };

      /** ============================= */

      //var myAwesomeDropzone = $(".uploadform").dropzone({ url: "api/upload.php" });
      //myDropzone = new Dropzone(".uploadform", { url: "api/upload.php"});

    });
$('#myModal').modal("show");
}
</script>
<script type="text/javascript">
  $(document).ready(function(){

    $('.js-key').click(function(){
      window.location.assign("form/")
    });

    $("#province").change(function() {
      locationName = $("#province").find('option:selected').text();
      $("#amphur").empty();
      var option = new Option("เลือกอำเภอ/เขต", "");
      $("#amphur").append($(option));
      $.getJSON("api/getamphur.php?province_id=" + $("#province").val(), function(data){
        $.each(data.amphur, function(i, amphur){
          var option = new Option(amphur.AMPHUR_NAME, amphur.AMPHUR_ID);
          $("#amphur").append($(option));
        });
      });

      /** Get lat lng from address */
      $.ajax({
        url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + locationName,
        dataType: "text",
        success: function(data) {
          var json = $.parseJSON(data);

          for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
          }

          var myLatlng = new google.maps.LatLng(json.results[0].geometry.location.lat, json.results[0].geometry.location.lng);

          var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            draggable:true
          });

          lat = json.results[0].geometry.location.lat;
          lng = json.results[0].geometry.location.lng;

          google.maps.event.addListener(marker, 'dragend', function(event) { lat = event.latLng.lat(); lng = event.latLng.lng(); } );
          markers.push(marker);

          map.setZoom(10)
          map.setCenter(myLatlng);

        }
      });

    });
$("#amphur").change(function() {
  locationName = $("#amphur").find('option:selected').text() + ' ' + $("#province").find('option:selected').text();
  $("#district").empty();
  var option = new Option("เลือกตำบล/แขวง", "");
  $("#district").append($(option));
  $.getJSON("api/getdistrict.php?amphur_id=" + $("#amphur").val(), function(data){
    $.each(data.district, function(i, district){
      var option = new Option(district.DISTRICT_NAME, district.DISTRICT_ID);
      $("#district").append($(option));
    });
  });

  /** Get lat lng from address */
  $.ajax({
    url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + locationName,
    dataType: "text",
    success: function(data) {
      var json = $.parseJSON(data);

      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
      }

      var myLatlng = new google.maps.LatLng(json.results[0].geometry.location.lat, json.results[0].geometry.location.lng);

      var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        draggable:true
      });

      lat = json.results[0].geometry.location.lat;
      lng = json.results[0].geometry.location.lng;

      google.maps.event.addListener(marker, 'dragend', function(event) { lat = event.latLng.lat(); lng = event.latLng.lng(); } );
      markers.push(marker);

      map.setZoom(10)
      map.setCenter(myLatlng);

    }
  });

});

$("#district").change(function() {
  locationName = $("#district").find('option:selected').text() + $("#amphur").find('option:selected').text() + $("#province").find('option:selected').text();
      //alert(locationName);
      /** Get lat lng from address */
      $.ajax({
        url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + locationName,
        dataType: "text",
        success: function(data) {
          var json = $.parseJSON(data);

          for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
          }

          var myLatlng = new google.maps.LatLng(json.results[0].geometry.location.lat, json.results[0].geometry.location.lng);

          var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            draggable:true,
            title:"Drag me!"
          });

          lat = json.results[0].geometry.location.lat;
          lng = json.results[0].geometry.location.lng;

          google.maps.event.addListener(marker, 'dragend', function(event) { lat = event.latLng.lat(); lng = event.latLng.lng(); } );
          markers.push(marker);

          map.setZoom(10)
          map.setCenter(myLatlng);

        }
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
      lat: lat,
      lng: lng,
    },
    function(data,status){
      if ('กรุณาแนบภาพถ่ายบัตรประจำตัวประชาชน' == data) {
        alert(data);
      } else {
        location.reload();
      }
    });
  }
});

});
</script>
<script src="_plugins/input-mask/jquery.inputmask.js"></script>
<script src="_plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="_plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script>
  $("[data-mask]").inputmask();
  $("#urlname").inputmask("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
</script>
<?php eb();?>

<?php render($MasterPage);?>
