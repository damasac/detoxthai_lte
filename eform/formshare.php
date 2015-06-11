<?php require_once '../_theme/util.inc.php'; chk_login(); chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?> Ez Form <?php eb();?>

<?php sb('js_and_css_head'); ?>
<link href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php eb();?>

<?php include "../_connection/db_eform.php"; ?>
<?php sb('content_header');?>
        <br>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol>
<?php eb();?>
<?php sb('content'); ?>
<?php
$MenuType="MenuMain";
$MenuSetting="shareform";
include_once("inc_menu.php");
?>
                    <div class="panel panel-default">
                        <div class="panel-body" style="height: auto;">
                            <div class="container-fluid">
                             <h1>Form Share</h1>
                             <br>
			    <?php
				//mysqli_select_db("eform") or die(mysqli_error());
				$sqlForm = mysqli_query($con,"SELECT MAX(formid) AS id FROM formmain") or die(mysqli_error());
				$numberRow = mysqli_num_rows($sqlForm);
				$dataRow = mysqli_fetch_assoc($sqlForm);
				$idEform =  $dataRow["id"]+1;
			    ?>

				<br>
			   </div>
			    <?php if($numberRow==0){
				
				}else{?>
				<table class="table table-bordered">
				    <thead>
					<tr>
					    <th>ลำดับ</th>
					    <th>ชื่อตาราง</th>
					    <th>วันที่สร้าง</th>
					    <th>จัดการ</th>
					</tr>
				    </thead>
				    <tbody>
					<?php
					$i = 1;
					
					$sqlForm2 = "SELECT * FROM formmain  WHERE `status_share`='1' ";
					
					$queryForm2 = mysqli_query($con,$sqlForm2);
					while($dataForm = mysqli_fetch_assoc($queryForm2)){
					?>
					<tr id="<?php echo $dataForm["formid"];?>">
					    <td><?php echo $i;?></td>
					    <td><?php echo $dataForm["formname"];?></td>
					    <td><?php echo $dataForm["createdate"];?></td>

					    <td>
						<button class='btn btn-primary btn-xs'
							onclick="location.href='form.php?task=public&idFormMain=<?php echo $dataForm["formid"]?>'">
						<i class="fa fa-eye"></i>  ดูฟอร์ม</button>
						<button
							class='btn btn-primary btn-xs'
							onclick="popup_custom('<?php echo $dataForm["formid"]?>','ตั้งค่าการแชร์')"> 
							<i class="fa fa-share-alt"></i>   แชร์
							</button>
					    </td>
					</tr>
					<?php $i++;
					} ?>
				    </tbody>
				</table>
			    <?php } ?>
                        </div>
                    </div>

<?php eb();?>
<?php sb('js_and_css_footer');?>
	<script type="text/javascript" src="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
	<link rel="stylesheet" href="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.css">
<script>
function popup_custom(id,title) {

	dialogPopWindow = BootstrapDialog.show({
		title: title,
		cssClass: 'popup-dialog',
		draggable: true,
		message: $('<div></div>').load("ajax-share-data.php?id="+id, function(data){
			//runSomeScript();
		}),
		onshown: function(dialogRef){ 
			//runSomeScript();
			//alert(action);
		},
		onhidden: function(dialogRef){ 
			//alert('onhidden');
		}
	});
}
	function deleteEform(id,dbname) {
	    $("#delBar").slideDown();
	    $("#delConfrim").click(function(){
		    $.ajax({
			url: "ajax-createform-loaddata.php?task=delDatabase",
			type: "post",
			data: {id:id,dbname:dbname},
			success: function(data){
			    $("#delBar").slideUp();
			    $("#"+id+"").remove();
			},
			error:function(){
			    alert("failure");
			}
		    });
		});
	    $("#exitDel").click(function(){
		$("#delBar").slideUp();
		});
	}
        function showEform(id){
	    $.ajax({
		    url: "ajax-createform-loaddata.php?task=createForm",
		    type: "post",
		    data: {id:id},
		    success: function(data){
			location.href="eform.php?idFormMain="+data+"";
		    },
		    error:function(){
			alert("failure");
		    }
		});
        }
</script>

<script src="../_plugins/dataTables/jquery.dataTables.min.js"></script>
<script src="../_plugins/dataTables/dataTables.bootstrap.min.js"></script>
<link href="../_plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"></script>
<script type="text/javascript" src="../_plugins/js/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript" src="script/scriptGoogleForm.js"></script>
<script>
        $("select[data-attr]").select2();  
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

