<?php require_once '../_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> Ez Form <?php eb();?>

<?php sb('js_and_css_head'); ?>

<link rel="stylesheet" href="../_plugins/js-select2/select2.css">

<link rel="stylesheet" href="../_plugins/js/jquery.datetimepicker.css">
<link rel="stylesheet" href="style/style.css">
<?php eb();?>

<?php include "../_connection/db_sql.php"; ?>
<?php sb('content_header');?>
        <br>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol>
<?php eb();?>

<?php sb('content');?>
<?php
$idForm = $_GET["idFormMain"];
$MenuType="MenuEform";
$MenuSetting="manageform";
	include("inc_menu.php");
?>

<?php 
	include_once("function/function_eform.php");
	//----------------------------------------------------------------------------------------------------------------
	$sqlFormMain = "SELECT * FROM formmain WHERE formid='".$_GET["idFormMain"]."'";
	$queryFormMain = mysqli_query($con,$sqlFormMain) or die(mysqli_error());
	$dataFormMain = mysqli_fetch_assoc($queryFormMain);

	
        ?>
	<div class="panel panel-default">
		<div class="panel-body" style="height: auto;">
		    <div class="tagInput" style="background-color:red;height: auto;">
			<input type="hidden" id="formid" value="<?php echo $dataFormMain["formid"];?>">
			<input type="hidden" id="dbname" value="<?php echo$dataFormMain["tablename"];?>">
			<input type="text" class="gFormInput" id="formname" style="font-size:36px;color:black;"  onblur="autoSave('<?php echo $dataFormMain["formid"]?>',$(this).attr('id'),$(this).val());" value="<?php echo $dataFormMain["formname"];?>">
		    </div>
		    <div class="tagInput">
			<input type="text" class="gFormInput" id="formdesc" style="font-size:16px;"  onblur="autoSave('<?php echo $dataFormMain["formid"]?>',$(this).attr('id'),$(this).val());" value="<?php echo $dataFormMain["formdesc"];?>">
		    </div><br>
		    <hr style="border:1px #AAAAAA solid">
		<div  id="form" style="height:auto;">
		    <?php
			$selectField = "SELECT * FROM formfield WHERE formid='".$dataFormMain["formid"]."' ORDER BY forder ";
			$queryField = mysqli_query($con,$selectField) or die(mysqli_error());

			while($dataField = mysqli_fetch_assoc($queryField)){
			echo formgenForEdit($dataField,$dataFormMain,$con);

		    ?>
		    <?php }  ?>

		</div>

	<div class="panel-body" id="panel" style="height: auto;display: none;">
			<h4>เพิ่ม</h4>
			<hr style="border:1px #AAAAAA solid;">
			    <div class="panel-heading" style="height: auto;">
				<div class="editIPanel" style="float:right;font-size:16px;cursor: pointer">
				    <button class="btn btn-default" style='font-size:20px;'><i class="fa fa-pencil"></i></button>
				    <!--<button class="btn btn-default"><i class="fa fa-folder-o"></i></button>-->
				    <button class="btn btn-default" style='font-size:20px;'disabled="disabled"><i class="fa fa-trash-o"></i></button>
				</div>
				    <div class="row">
					<div class="col-lg-2">
					    <p>หัวข้อคำถาม</p><code id="nameError"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="nameQuestion" placeholder="คำถามไม่ระบุหัวข้อ" value="คำถามไม่ระบุหัวข้อ">
					</div>
				    </div><br>
				     <div class="row">
					<div class="col-lg-2">
					    <p>ตัวแปร</p><code id="valueError"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="valQuestion" placeholder="" style="width:20%;">
					</div>
				    </div><br>

				    <div class="row">
					<div class="col-lg-2">
					    <p>ข้อความช่วยเหลือ</p>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="helpQuestion">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ประเภทคำถาม</p>
					</div>
					<div class="col-lg-4">
					    <select class="form-control" id="typeQuestion" onchange="selectTypeQuestion($(this).val());">
						<option value="0" >- กรุณาเลือกประเภทคำถาม -</option>
						<option value="text" selected>Text</option>
						<option value="heading">Heading Text</option>
						<option value="textarea">Paragraph text</option>
						<option value="radiobox">Multiple choice</option>
						<option value="radiotextbox">Multiple text choice</option>
						<option value="checkbox">Checkbox</option>
						<option value="select">Choose from list</option>
						<option value="date">Date</option>
						<option value="time">Time</option>
						<option value="datetime">Date & Time</option>
						<option value="dbthailand">Province/ District/ Subdistrict</option>
					    </select>
					</div>
				    </div>
				    <div class="row">
					<br>
					<div id="exampleEform">
					            <div class="col-lg-4">
							<label id="nameQuestion">หัวข้อคำถาม</label>
							<code></code>
							<input type="text" class="form-control" disabled="disabled" placeholder="คำตอบ"/>
						    </div>
					</div>
				    </div>
				    <br><br>
				    <div class="row">
					<div class="col-lg-12">
					    <button type="button" class="btn btn-primary" onclick="addQuestion();">เสร็จสิ้น</button>
					</div>
				    </div>
			    </div>
		</div>
	    <br><br>
		<div class="container-fluid">
			    <button type="button" class="btn btn-default" onclick="addQuestion();">เพิ่มรายการ</button>
		</div>
	    </div>




<?php eb();?>
<?php sb('js_and_css_footer');?>


<script src="../_plugins/dataTables/jquery.dataTables.min.js"></script>
<script src="../_plugins/dataTables/dataTables.bootstrap.min.js"></script>
<link href="../_plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"></script>
<script type="text/javascript" src="../_plugins/js/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript" src="script/scriptGoogleForm.js"></script>
<script>
	$('input[data-attr=date]').datetimepicker({
		timepicker:false
	      });
    	$('input[data-attr=time]').datetimepicker({
		datepicker:false
	      });
    	$('input[data-attr=datetime]').datetimepicker({

	      });
</script>
<?php eb();?>
 
<?php render($MasterPage);?>
