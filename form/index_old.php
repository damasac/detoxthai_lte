<?php

header( 'Content-type: text/html; charset=utf-8' ); ?>
<?php
	include_once "db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survey Form</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <!-- Optional theme -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">-->
    <link rel="stylesheet" href="script/bootstrap-theme.min.css">
    <link rel="stylesheet" href="script/bootstrap-slider.css">
    <link rel="stylesheet" href="js-select2/select2.css">
    <link rel="stylesheet" href="css/datepicker.css">
    <link rel="stylesheet" href="bootstrap-select/bootstrap-select.css">
    <script type='text/javascript' src="script/jquery.min.js"></script>
    
    
    <script type="text/javascript" src="script/fnc_javascript.js"></script>
    
    <script type='text/javascript' src="script/bootstrap.min.js"></script>
    <script type='text/javascript' src="script/bootstrap-slider.js"></script>
    <script type="text/javascript" src="js-select2/select2.js"></script>
    <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="bootstrap-select/bootstrap-select.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script charset='utf-8' src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script charset='utf-8' src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script charset='utf-8' src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <!--<script charset='utf-8' src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>-->
  
  <style>
    .form-group.paddingleft {
          padding-bottom: 5px;
          padding-left: 50px;
    }
    .form-group.fix {
          padding-bottom: 5px;
    }
    .form-control.fix {
          width: 270px !important;
    }
    .p3tableheader {
      background-color: #ccc;
    }
    .radio.p3paddingleft {
      padding-left: 50px;
    }
    .form-control.fix2 {
          width: 40px !important;
    }
    input[type=radio] {
    border: 0px;
    width: 20px;
    height: 20px;
   }
    input[type=checkbox]
    {
      margin: auto;
      width: 19px;
      height: 19px;
    }
    .textindent{
      text-indent: 1.5em;
    }
    .table-responsive.fix {
      overflow-x: hidden;
    }
    .showError{
      padding:20px;
      background-color:#FE2B2B;
      border-radius:2px;
      color:white;
    }
  </style>
  </head>
  <body>
    
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php
          require_once( '../../wp-load.php' );
          global $current_user;
          get_currentuserinfo();
          include_once("system_function.php");
          //echo "<pre>";
          //print_r ($current_user);
          //echo "</pre>";
          $user_id = $current_user->ID;
          $user_email = $current_user->user_login;
          $user_name = $current_user->display_name;
          if($user_name == 'admin'){
            exit("Error : Admin ไม่สามารถบันทึกข้อมูลได้");
          }
          else if($user_name == ''){
            //echo "http://".$_SERVER[HTTP_HOST]."/surveyform/";
            include_once "fb_login.php";
            exit();
          }
           ?>
        </div>
      </div>
    <?php
                    $sql = "SELECT * FROM `tbl_surveyuser` WHERE user_id='".$user_id."' ";
                    //echo $sql;
                    $query = $conn->query($sql);
    ?>
      <div class="row">
        <div class="showError" id="showDelete"style="display:none;">
          ยืนยันการลบแบบบันทึก ?
          <div class="pull-right">
          <button class="btn btn-success" id="doDelete">ใช่</button>&nbsp;&nbsp;&nbsp;
          <button class="btn btn-warning" id="cancerDelete">ยกเลิก</button>
          </div>
          </div>
      </div>
        <div class="row">
        <div class="showError" id="showError" style="display:none;"></div>
      </div>
    <div class="row">
      <h3>
          คุณ&nbsp<code><?php echo $user_name?></code>&nbsp; ได้บันทึกข้อมูลเป็นจำนวน <code id="numForm"><?php echo $query->num_rows; ?></code> ครั้ง
      </h3>
      <table class="table">
        <thead>
          <tr>
            <th>ครั้งที่</th>
            <th>สถานที่</th>
            <th>วันที่</th>
            <th>วันที่บันทึก</th>
            <th></th>
          </tr>
        </thead>
        
        <tbody>
          
          <?php
          $i=1;
          while($data = $query->fetch_assoc()){?>
          <tr id='trForm_<?php echo $data["id"]?>'>
            <td><?php echo $i;?></td>
            <td><?php echo $data["location"]?></td>
            <td><?php echo System_ShowDate($data["startdate"])." ถึง ".System_ShowDate($data["enddate"])?></td>
            <td><?php echo System_showDate($data["createdate"]);?></td>
            <td><button class="btn btn-warning" onclick='window.location.href="index.php?form_id=<?php echo $data["id"]; ?>"'> ตรวจสอบ </button>
            <button class="btn btn-danger" onclick='deleteForm(<?php echo $data["id"];?>);'> ลบ </button></td>
          </tr> 
          <?php $i++; }?>
        </tbody>
      </table>
    
    </div>
    <br>
    <br>
      
      <div class="text-center">
      
        <div class="form-inline">
          <div class="form-group">
            <input type="text" class="form-control" style="width:140px;cursor: pointer;" placeholder="วันที่เริ่ม" id="startDate">
              ถึง
            <input type="text" class="form-control" style="width:140px;cursor: pointer;" placeholder="วันที่สิ้นสุด" id="endDate">
                สถานที่  
            <input type="text" class="form-control" id="location" style="width:200px;"> &nbsp;&nbsp;<button class="btn btn-success pull-right" id="AddForm">  บันทึกข้อมูลใหม่</button>
            <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" id="user_name" value="<?php echo $user_name;?>">
            <input type="hidden" id="user_email" value="<?php echo $user_email;?>">
          </div>
        </div>
      </div>
      <br><br>
      <br>
      <br>
      <input type="hidden" class="form-control" value="<?php echo $_GET["form_id"];?>" id="form_id"/>
      <?php
          $sqlSelectValue =  "SELECT * FROM `tbl_surveyform` WHERE ref_id_create='".$_GET["form_id"]."' ";
          $querySelectValue = $conn->query($sqlSelectValue);
          $dataform = $querySelectValue->fetch_assoc();
      ?>
      <div id="formsurvey" style="display:none;">
          
      <!-------------------------- form 1-2-->
      <?php //include_once "form_consent.php";include_once "form_person.php";include_once "form_1.php";include_once "form_2.php"; ?>
      
      <!-------------------------- form 3-4-->
      <?php //include_once "form_3.php"; ?>
      <?php //include_once "form_4.php"; ?>
      
      <!-------------------------- form 5-6-->
      <?php //include_once "form_5.php"; ?>
      <?php //include_once "form_6.php"; ?>


      </div>
    </div>
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
        var user_name = $("#user_name").val();
        var user_email = $("#user_email").val();
        
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
                  url: "db_connect.php?task=insertBlank",
                  data:{
                    startdate:startdate,
                    enddate:enddate,
                    user_id:user_id,
                    user_name:user_name,
                    user_email:user_email,
                    location:location
                  },
                  success: function(returndata){
                    $("#form_id").val(returndata);
                    $("#formsurvey").show();
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
                  url: "db_connect.php?task=deleteForm",
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
  </body>
</html>