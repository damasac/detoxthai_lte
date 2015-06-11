<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>
<link rel="stylesheet" href="script/bootstrap-slider.css">
<link rel="stylesheet" href="css/datepicker.css">
  
<?php eb();?>

<?php sb('content');?>
<?php include_once "../_connection/db_form.php"; ?>

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      บันทึกข้อมูลการล้างพิษตับ
      <small> เพื่อร่วมสร้างองค์ความรู้ ในฐานข้อมูลทะเบียนผู้ล้างพิษตับ (Liver Flushing Registry)</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">SITE NAME HERE</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Input Form</h3>
          </div>
<?php
    include_once("system_function.php");
    //session user
    $user_id = $_SESSION['dtt_puser_id'];

    $user_name = $_SESSION['dtt_puser_fname'].'  '.$_SESSION['dtt_puser_lname'];
    $sql = "SELECT * FROM `tbl_surveyuser` WHERE user_id='".$user_id."' ORDER BY id ASC";
    //echo $sql;
    $query = $conn->query($sql);
?>
          <div class="box-body">
            
            <div class="row">
                <div class="col-lg-12">
                <div class="showError" id="showDelete"style="display:none;">
                  ยืนยันการลบแบบบันทึก ?
                  <div class="pull-right">
                  <button class="btn btn-success" id="doDelete">ใช่</button>&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-warning" id="cancerDelete">ยกเลิก</button>
                  </div>
                  </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                <div class="showError" id="showError" style="display:none;"></div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                <h3>
                    คุณ&nbsp<code><?php echo $user_name?></code>&nbsp; ได้บันทึกข้อมูลเป็นจำนวน <code id="numForm"><?php echo $query->num_rows; ?></code> ครั้ง
                </h3>
                
                <hr>
                
                <div class="text-center">
                        <div class="row form-inline">
                            <div class="form-group col-md-3">
                                <label for="name" style="font-weight: bold;">เลือกวันที่ต้องการบันทึกข้อมูล</label><br>
                                <input type="text" class="form-control" style="cursor: pointer;" placeholder="วันที่เริ่ม" id="startDate">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="name" style="font-weight: bold;">ถึง</label><br>
                              <input type="text" class="form-control" style="cursor: pointer;" placeholder="วันที่สิ้นสุด" id="endDate">
                            </div>
                            <div class="form-group col-md-3">
                               
                                <label for="name" style="font-weight: bold;">สถานที่ทำการ Detox</label><br>
                                <select id="location" class="form-control">
                                    <option value='0'>เลือกสถานที่ทำการ Detox</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">    
                                <button class="margin btn btn-success btn-flat btn-lg" id="AddForm">  เพิ่มประวัติการ Detox</button>
                                <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
                            </div>
                        </div>
            
                </div>

                <hr>
                
                <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr class="h4" style="background-color: #c0c0c0; color: #00; font-weight: 900;">
                      <th>ครั้งที่</th>
                      <th>สถานที่</th>
                      <th>วันที่</th>
                      <th>วันที่บันทึก</th>
                      <th>การจัดการ</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    
                    <?php
                    $i=1;
                    while($data = $query->fetch_assoc()){?>
                    <tr id='trForm_<?php echo $data["id"]?>'>
                      <td><?php echo $i;?></td>
                      <td><?php if($data["location"] =='10000001'){ echo 'บ้าน';} else if($data['location']=='10000002') {echo 'อื่นๆ'; } else {
                    $sql = "select `site_name` from site_detail where id='".$data['location']."';";
                    $res = $conn->query($sql);
                    $dbarr = $res->fetch_assoc();
                    echo $dbarr['site_name'];
                    }?> </td>
                      <td><?php echo System_ShowDate($data["startdate"])." ถึง ".System_ShowDate($data["enddate"])?></td>
                      <td><?php echo System_showDate($data["createdate"]);?></td>
                      <td><button class="btn btn-primary" onclick='window.location.href="input.php?form_id=<?php echo $data["id"]; ?>"'> ตรวจสอบ </button>
                      <button class="btn btn-danger" onclick='deleteForm(<?php echo $data["id"];?>);'> ลบ </button></td>
                    </tr> 
                    <?php $i++; }?>
                  </tbody>
                </table>
                </div>
                
                </div>
            </div>            
            
          </div><!-- /.box-body -->
    </div><!-- /.box -->


  </section><!-- /.content -->'
  
<?php eb();?>


<?php sb('js_and_css_footer');?>
<script type="text/javascript" src="script/fnc_javascript.js"></script>
<script type='text/javascript' src="script/bootstrap-slider.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>

<script>
    $(function(){
        if ($("#form_id").val()!="") {
          $("#formsurvey").show();
        }
               
      });
    $("#p1a10").click(function(){
        if ($("#p1a10").is(":checked")) {
          $("#tableHide1").fadeOut();
          $("#p1a10").val("0");
          AutoSave("p1a10",$("#form_id").val());
        }else{
          $("#p1a10").val("1");
          $("#tableHide1").fadeIn();
          AutoSave("p1a10",$("#form_id").val());
        }
      });
    $("#p2a1").click(function(){
      if ($("#p2a1").is(":checked")) {
          $("#p2a1").val("0");
          $("#labelHide2").fadeOut();
          $("#tableHide2").fadeOut();
           AutoSave("p2a1",$("#form_id").val());
        }else{
          $("#p2a1").val("1");
          $("#tableHide2").fadeIn();
          $("#tableHide2").fadeIn();
          AutoSave("p2a1",$("#form_id").val());
        }
      });
    $("#startDate").datepicker({
      format: 'dd/mm/yyyy',
      });
    $("#endDate").datepicker({
      format: 'dd/mm/yyyy',
      });
    $("#AddForm").click(function(){
        var startDate =$("#startDate").val();
        var endDate = $("#endDate").val();
        var location = $("#location").val();
        var startDateSplit = startDate.split("/");
        var endDateSplit = endDate.split("/");
        var startdate = startDateSplit[2]+"/"+startDateSplit[1]+"/"+startDateSplit[0];
        var enddate = endDateSplit[2]+"/"+endDateSplit[1]+"/"+endDateSplit[0];
        var user_id = $("#user_id").val();
        
        //console.log(startDate+endDate);
        if (startDate=="" || endDate=="" || location=="") {
            $('#showError').show('fast').delay(2000).fadeOut(300);
            $("#showError").html("กรุณากรอกข้อมูลให้ครบถ้วน");
          return ;
        }
        else if(startDate>endDate){
            $('#showError').show('fast').delay(2000).fadeOut(300);
            $("#showError").html("วันที่สิ้นสุดมากกว่าวันที่เริ่มต้น");
          return ;
        }else{
          $.ajax({
                  type: "POST",
                  url: "../_connection/db_form.php?task=insertBlank",
                  data:{
                    startdate:startdate,
                    enddate:enddate,
                    user_id:user_id,
                    location:location
                  },
                  success: function(returndata){
                    $("#form_id").val(returndata);
                    //$("#formsurvey").show();
                    parent.location='input.php?form_id='+returndata;
                }
            }); 
          }
      });
    function deleteForm(form_id) {
      $("#showDelete").show();
      var user_id = $("#user_id").val();
      $("#doDelete").click(function(){
                $.ajax({
                  type: "POST",
                  url: "../_connection/db_form.php?task=deleteForm",
                  data:{
                    form_id:form_id,
                    user_id:user_id
                  },
                  success: function(returndata){
                    $("#numForm").html(returndata);
                    $("#showDelete").hide();
                    $("#trForm_"+form_id).fadeOut();
                }
            }); 
        });
      $("#cancerDelete").click(function(){
          $("#showDelete").hide();
        })
    }
     function goAutoSave() {
                        //code
                        var form_id = $("#form_id").val();
                       alert(field+form_id);
                       //AutoSave(field,form_id);
      }
      
  </script>
<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>
<script>
    $( document ).ready(function() {
        //---
        $("#location").select2();
        
        $(".select2-input").keyup(function(event){
            var jsonAPI = "ajax-search-site.php?task=site&key=";
            var key = $(this).val();
            $("#location").html("<option value='0'>- สถานที่ทำการ Detox -</option>");
            $.getJSON(jsonAPI+key,
                function(result){
                    $.each(result, function(i, field){
                        $("#location").append("<option value="+field.id+" >"+field.site_name+"</option>");
                    });
                     $("#location").append("<option value=10000001>ที่บ้าน</option>");
                    $("#location").append("<option value=10000002 >อื่นๆ</option>");
            });
        });
        var jsonAPI = "ajax-search-site.php?task=site&key=";
        var key = '';
        $("#location").html("<option value='0'>- สถานที่ทำการ Detox -</option>");
        $.getJSON(jsonAPI+key,
            function(result){
                $.each(result, function(i, field){
                    $("#location").append("<option value="+field.id+" >"+field.site_name+"</option>");
                });
        });
        $("#location").append("<option value=10000001>ที่บ้าน</option>");
        $("#location").append("<option value=10000002 >อื่นๆ</option>");
    });
        //---
</script>
<?php eb();?>
 
<?php render($MasterPage);?>