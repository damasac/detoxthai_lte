<?php
  require_once '../_theme/util.inc.php'; $MasterPage = 'page_main.php';
  include "../_connection/db_base.php";
  $id = $_GET["id"];
  $sql1 = "select * from `puser` where id='".$id."' ";

  $query1 = $mysqli->query($sql1);
  $dataValue = $query1->fetch_assoc();

  $status = $dataValue["status"];
    
?>
<div class="row">
<div class="col-lg-6">
<div class="form-group">
    <label>ชื่อจริง</label><code id="valFname" style="display:none;"></code>
    <input type="text" class="form-control" id="fname" value="<?php echo $dataValue["fname"]?>">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
    <label>นามสกุล</label><code id="valLname" style="display:none;"></code>
    <input type="text" class="form-control" id="lname" value="<?php echo $dataValue["lname"]?>">
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="form-group">
    <label>ชื่อผู้ใช้งาน</label><code id="valUsername" style="display:none;"></code>
    <input type="text" class="form-control" id="username" value="<?php echo $dataValue["username"];?>">
</div>
</div>


</div>
<div class="row">
<div class="col-lg-12">
<div class="form-group">
<label>รหัสผ่าน</label><code id="valPassword" style="display:none;"></code>

  <input type="password" class="form-control"
	 id="tel" name="tel"
	 value="<?php echo $dataValue["password"];?>"
	 data-toggle="tooltip" data-placement="bottom" title="แนะนำให้ใช้เป็นเบอร์โทรศัพท์">

</div>
</div>
</div>
</div>
<!--<div class="row">-->
<!--  <div class="col-lg-12">-->
<!--    <label>ใช้เบอร์โทรศัพท์เป็นรหัสผ่าน ??</label>-->
<!--<div class="radio">-->
<!--    <label>-->
<!--      <input type="radio" id="passwordChk" name="passwordChk" value="1"> ใช่-->
<!--    </label>-->
<!--</div>-->
<!--<div class="radio">-->
<!--    <label>-->
<!--      <input type="radio" id="passwordChk" name="passwordChk" value="0"> ไม่ <div class="col-lg-12"><input type="password" class="form-control" ></div>-->
<!--    </label>-->
<!--</div>-->
<!--  </div>-->
<!--</div>-->

<div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <label>สถานะ</label><code id="valStatus" style="display:none;"></code>
          <select class="form-control" id="status" name="status">
              <option value="0">- เลือกสถานะ -</option>
              <?php if($status==1){?>
              <option value="1" <?php if($status==1){echo "selected";}else{echo "";}?>>Super Admin</option>
              <option value="2" <?php if($status==2){echo "selected";}else{echo "";}?>>Admin Site</option>
              <option value="3" <?php if($status==3){echo "selected";}else{echo "";}?>>User Site</option>
              <?php }?>
	      <?php if($status==3){?>
              <option value="3" <?php if($status==3){echo "selected";}else{echo "";}?>>User Site</option>
              <?php }?>
          </select>
      </div>
    </div>
</div>
<div class="row" id="siteChose" style="display:none;">
    <div class="col-lg-12">
      <div class="form-group">
        <label>ศูนย์ล้างพิษตับ</label><code id="valStatus" style="display:none;"></code>
          <select class="form-control" id="status" name="status">
              <option value="0">- เลือกศูนย์ -</option>
	      <?php
		$sql1 = "SELECT * FROM `site_detail` ORDER BY `id`";
		$query1 = $mysqli->query($sql1);
		while($data1 = $query1->fetch_assoc()){
	     ?>
	     <option value="<?php echo $data1["id"]?>"><?php echo $data1["site_name"]?></optIon>
	     <?php }
	      ?>
          </select>
      </div>
    </div>
</div>
  <button class="btn btn-success btn-block" onclick="saveUser()">บันทึก</button>

<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>

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