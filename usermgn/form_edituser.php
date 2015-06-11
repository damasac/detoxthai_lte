<?php
  require_once '../_theme/util.inc.php'; chk_login(); chk_login(); $MasterPage = 'page_main.php';
  include "../_connection/db.php";
  $status = $_SESSION["tpc_puser_status"];
  $area = $_SESSION["tpc_puser_area"];
  $site = $_SESSION["tpc_puser_hcode"];
  $hcode = $_GET["hcode"];
  $id = $_GET["id"];
  $status=1;
  $sqlSelectUser = "SELECT * FROM `puser` WHERE id='".$id."' ";
  $querySelectUser = $mysqli->query($sqlSelectUser);
  $dataValue = $querySelectUser->fetch_assoc();
  $sqlSelectAddress =  "SELECT
        a.`name` AS hname,
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
    $querySelectAddress = $mysqli->query($sqlSelectAddress);
    $dataAddr = $querySelectAddress->fetch_assoc();
    
?>
<div class="row">
<div class="col-lg-6">
<div class="form-group">
    <label>Username</label><code id="valUsername" style="display:none;"></code>
    <input type="text" class="form-control" id="username" value="<?php echo $dataValue["username"];?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
    <label>Password</label><code id="valPassword" style="display:none;"></code>
    <input type="password" class="form-control" id="password" value="<?php echo $dataValue["password"];?>">
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="form-group">
    <label>Email</label><code id="valEmail" style="display:none;"></code>
    <input type="email" class="form-control" id="email" value="<?php echo $dataValue["email"];?>">
</div>
</div>
</div>
<div class="row">
<div class="col-lg-6">
<div class="form-group">
    <label>ชื่อ</label><code id="valFname" style="display:none;"></code>
    <input type="text" class="form-control" id="fname" value="<?php echo $dataValue["fname"];?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
    <label>นามสกุล</label><code id="valLname" style="display:none;"></code>
    <input type="text" class="form-control" id="lname" value="<?php echo $dataValue["lname"];?>">
</div>
</div>
</div>

<div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <label>สถานะ</label><code id="valStatus" style="display:none;"></code>
          <select class="form-control" id="status" name="status">
              <option value="0">- เลือกสถานะ -</option>
              <?php if($dataValue["status"]==1){?>
              <option value="1" <?php if($dataValue["status"]==1){echo "selected";}else{echo "";}?>>Super Admin</option>
              <option value="2" <?php if($dataValue["status"]==2){echo "selected";}else{echo "";}?>>Admin Area</option>
              <option value="3" <?php if($dataValue["status"]==3){echo "selected";}else{echo "";}?>>Admin Province</option>
              <option value="4" <?php if($dataValue["status"]==4){echo "selected";}else{echo "";}?>>Admin Site</option>
              <option value="5" <?php if($dataValue["status"]==5){echo "selected";}else{echo "";}?>>User Site</option>
              <?php }if($dataValue["status"]==2){?>
              <option value="2" <?php if($dataValue["status"]==2){echo "selected";}else{echo "";}?>>Admin Area</option>
              <option value="3" <?php if($dataValue["status"]==3){echo "selected";}else{echo "";}?>>Admin Province</option>
              <option value="4" <?php if($dataValue["status"]==4){echo "selected";}else{echo "";}?>>Admin Site</option>
              <option value="5" <?php if($dataValue["status"]==5){echo "selected";}else{echo "";}?>>User Site</option>
              <?php }?>
              <?php if($dataValue["status"]==3){?>
              <option value="2" <?php if($dataValue["status"]==2){echo "selected";}else{echo "";}?>>Admin Area</option>
              <option value="3" <?php if($dataValue["status"]==3){echo "selected";}else{echo "";}?>>Admin Province</option>
              <option value="4" <?php if($dataValue["status"]==4){echo "selected";}else{echo "";}?>>Admin Site</option>
              <option value="5" <?php if($dataValue["status"]==5){echo "selected";}else{echo "";}?>>User Site</option>
              <?php }if($dataValue["status"]==4){?>
             <option value="4" <?php if($dataValue["status"]==4){echo "selected";}else{echo "";}?>>Admin Site</option>
              <option value="5" <?php if($dataValue["status"]==5){echo "selected";}else{echo "";}?>>User Site</option>
              <?php }?>
          </select>
      </div>
    </div>
</div>
      <p>
      <label>เขตบริการ</label>
      <span class="text">เขตบริการสุขภาพที่ <?php echo $dataAddr["zone_code"];?></span>
      </p>
      <p>
      <label>โรงพยาบาล</label><code id="valHospital" ></code>
      <span class="text"><?php echo $dataAddr["hname"];?></span>
      </p>



    <label>จังหวัด</label>
    <span class="text"><?php echo $dataAddr["province"];?></span>


    <label>อำเภอ</label>
    <span class="text"><?php echo $dataAddr["amphur"];?></span>


    <label>ตำบล</label>
    <span class="text"><?php echo $dataAddr["tambon"];?></span>
    <input type="hidden" id="area" name="area" value="<?php echo $dataAddr["zone_code"];?>">
    <input type="hidden" id="id" name="id" value="<?php echo $dataValue["id"];?>">
    <input type="hidden" id="hospital" name="hospital" value="<?php echo $hcode;?>">
    <input type="hidden" id="province" name="province" value="<?php echo $dataAddr["provincecode"]?>">
    <input type="hidden" id="amphur" name="amphur" value="<?php echo $dataAddr["amphurcode"]?>">
    <input type="hidden" id="tambon" name="tambon" value="<?php echo $dataAddr["tamboncode"]?>">
    <div class="row">
      <div class="col-lg-12">
         <br>
          <button class="btn btn-success btn-block" onclick="saveUser();">บันทึก</button>
      </div>
    </div>
<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>
<?php ?>
<script>
  $("#hospitalSelect").select2();
  $(".select2-input").attr("id","textSearch");
  $("#status").change(function(){
      var status = $(this).val();
    });
  $(function(){
      $(".select2-input").attr("id","textSearch");
      $("#textSearch").on('keyup', function(e){
          if (e.keyCode>3) {
            var txtSearch = $(this).val();
                  $.getJSON("ajax-area-loaddata.php?task=hospital&txtSearch="+txtSearch+"",function(result){
                    console.log(result);
                  $("#hospitalSelect").html("<option value='0'>- ค้นหาจากชื่อโรงพยาบาล หรือ รหัสโรงพยาบาล -</option>");
                  $.each(result, function(i, field){
                        $("#hospitalSelect").append("<option value="+field.hcode+" >"+field.hcode+" : "+field.name+"</option>");
                  });
                  });
            }
        });
    });
  $("#hospitalSelect").on("change",function(){
      var hcode = $(this).val();
                  $.getJSON("ajax-area-loaddata.php?task=getdetailaddress&hcode="+hcode+"",function(result){
                    $.each(result, function(i, field){
                        $("#provinceSelect").attr("value",field.province);
                        $("#province").attr("value",field.provincecode);
                        $("#amphurSelect").attr("value",field.amphur);
                        $("#amphur").attr("value",field.amphurcode);
                        $("#tambonSelect").attr("value",field.tambon);
                        $("#tambon").attr("value",field.tamboncode);
                        $("#area").attr("value","เขตบริการสุขภาพที่"+field.zone_code);
                        $("#areaSelect").attr("value",field.zone_code);
                      });
                  });
    });
  function saveUser() {
    //code
    var username = $("#username").val();
    var password = $("#password").val();
    var email = $("#email").val();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var status = $("#status").val();
    var area = $("#area").val();
    var site = $("#hospital").val();
    var province = $("#province").val();
    var amphur = $("#amphur").val();
    var district = $("#tambon").val();
    var id = $("#id").val();
    if (username=="") {
      $("#valUsername").show();
      $("#valUsername").html("กรุณากรอกชื่อผู้ใช้งาน");
      return ;
    }else{
      $("#valUsername").hide();
    }
    if (password=="") {
      $("#valPassword").show();
      $("#valPassword").html("กรุณากรอกรหัสผ่าน");
      return ;
    }
    else{
      $("#valPassword").hide();
    }
    if (password<6) {
      $("#valPassword").show();
      $("#valPassword").html("กรุณากรอกรหัสผ่าน 6 ตัวขึ้นไป");
      return ;
    }else{
      $("#valPassword").hide();
    }
    if (email=="") {
      $("#valEmail").show();
      $("#valEmail").html("กรุณากรอกอีเมล์");
      return ;
    }else{
      $("#valEmail").hide();
    }
    if (fname=="") {
      $("#valFname").show();
      $("#valFname").html("กรุณากรอกชื่อ");
      return ;
    }else{
      $("#valEmail").hide();
    }
    if (lname=="") {
      $("#valLname").show();
      $("#valLname").html("กรุณากรอกนามสกุล");
      return ;
    }else{
      $("#valEmail").hide();
    }
    if (status==0) {
      $("#valStatus").show();
      $("#valStatus").html("กรุณาระบุสถานะ");
      return ;
    }else{
      $("#valStatus").hide();
    }
    if (site==0) {
      //code
      $("#valHospital").show();
      $("#valHospital").html("กรุณาระบโรงพยาบาล");
    }else{
      $("#valHospital").hide();
    }
    goAjaxSave(id,username,password,email,fname,lname,status,area,site,province,amphur,district);
  }
  function goAjaxSave(id,username,password,email,fname,lname,status,area,site,province,amphur,district){
      $.ajax({
		    url: "ajax-sql-query.php?task=editUser",
		    type: "post",
		    data: {
                      id:id,
                      username:username,
                      password:password,
                      email:email,
                      fname:fname,
                      lname:lname,
                      status:status,
                      area:area,
                      site:site,
                      province:province,
                      amphur:amphur,
                      district:district
                      },
		    success: function(data){

                      if ($.trim(data)=="1") {
                        //code
                        $("#valUsername").show();
                        $("#valUsername").html("ชื่อนี้มีผู้ใช้งานแล้วกรุณาระบุใหม่");
                      }
                      if ($.trim(data)=="2") {
                        //code
                        $("#valEmail").show();
                        $("#valEmail").html("อีเมล์นี้มีผู้ใช้งานแล้วกรุณาระบุใหม่");
                      }
                      if ($.trim(data)=="0") {
                        //code
                        location.href="index.php";
                      }

		    },
		    error:function(){
			alert("failure");
		    }
		});
  }
</script>