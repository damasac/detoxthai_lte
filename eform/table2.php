<?php //error_reporting(0); ?>
<?php require_once '../_theme/util.inc.php'; chk_login(); chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?> Ez Form <?php eb();?>

<?php sb('js_and_css_head'); ?>
<link rel="stylesheet" href="../_plugins/js-select2/select2.css">

<link rel="stylesheet" href="../_plugins/js/jquery.datetimepicker.css">
<link rel="stylesheet" href="style/style.css">
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

<?php sb('content');?>
<?php
	$useradd = $_SESSION["tpc_puser_id"];
	$idForm = $_GET["idFormMain"];
	$MenuType="MenuEform";
	$MenuSetting="dataform";
	include("inc_menu.php");
	$sqlFormMain = "SELECT * FROM formmain WHERE formid='".$_GET["idFormMain"]."' ";
	
	$queryFormMain = mysqli_query($con,$sqlFormMain) or die(mysqli_error());
	$dataFormMain = mysqli_fetch_assoc($queryFormMain);
	$dataFormMain["status_share"];
	if($dataFormMain["status_share"]==1 && $dataFormMain["public_view"]==1){
	    $condition = "";
	}else if($dataFormMain["public_view"]=="0"){
	    $condition = "WHERE useradd='".$useradd."' ";
	}
	//print_r($dataFormMain);
        $sqlColumn = "desc `".$dataFormMain["tablename"]."`";
	
        $queryColumn = mysqli_query($con,$sqlColumn);
	$numColumn = mysqli_num_rows($queryColumn) or die(mysqli_error());

	if($numColumn<=6){
	    $truncate = mysqli_query($con,"TRUNCATE TABLE `".$dataFormMain["tablename"]."`");
	}

?>
<div class="panel panel-default">
                        <div class="panel-body" style="height: auto;">
                            <div class="container-fluid">
                                <h2><i class="fa fa-database"></i>&nbsp;&nbsp;&nbsp;<?php echo $dataFormMain["tablename"] ?></h2>
                                <br>
				  <div class="table-responsive">
				      <table  class="table table-striped table-bordered" id="dataTable" >
                                    <thead >
                                        <tr>
                                    <?php
						
	                                while($dataColumn=mysqli_fetch_assoc($queryColumn)){
						

	                                    ?>
                                            <?php
                                                //if($dataColumn["Key"]=="PRI"){
                                                //    //$icon = "<i class='fa fa-key'></i>";
                                                //}else{
                                                //    //$icon = "";
                                                //}
                                            ?>
                                            <th>
						<h5>
						<?php echo "&nbsp;&nbsp;&nbsp;".$dataColumn["Field"];?>
						</h5>
					    </th>
                                            <?php
                                        }
                                    ?>
                                        </tr>
                                    </thead>
				     <tbody>
					
				    
				    <?php
						$sqlSelectData = mysqli_query($con,"SELECT * FROM `".$dataFormMain["tablename"]."`  ORDER BY `id`  ");
						//$i=1;
						//$dataAr = array();
						while($data = mysqli_fetch_array($sqlSelectData)){;
						//	    $dataAr[$i][] = $data;
						//$i++;
						//}
						//print_r($dataAr);
						$numField =  sizeof($data)/2-1;
				    ?>
						<tr>
							    
									<?php
									for($i=0;$i<=$numField;$i++){
										    echo  "
										    <td onclick='popup_custom(".$data["id"].",".$dataFormMain["databaseid"].",".$dataFormMain["public_edit"].",".$dataFormMain["public_delete"].");' style='cursor:pointer'>".$data[$i]."
										    </td>
										    ";
									}
									?>
						</tr>
				    <?php } ?>
				    </tbody>
				    </table>
				  </div>
			    </div>
			</div>
</div>

<script>
    <?php if($dataFormMain["public_edit"]=="1"){?>
    function viewform(id){
	location.href="form.php?idFormMain=<?php echo $_GET["idFormMain"]?>&id="+id;
    }
    <?php }?>
</script>
<?php eb();?>
<?php sb('js_and_css_footer');?>
<script type="text/javascript" src="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
<link rel="stylesheet" href="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.css">
  
<script>
    $(document).ready(function() {
        $('#dataTable').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": false,
          "bInfo": false,
          "bAutoWidth": true
            });
    } );
    function popup_custom(id,formid,public_edit,public_delete) {
	
	dialogPopWindow = BootstrapDialog.show({
		title: "จัดการข้อมูล",
		cssClass: 'popup-dialog',
		size:'size-wide',
		draggable: false,
		message: $('<div></div>').load("ajax-edit-data.php?id="+id+"&formid="+formid+"&public_edit="+public_edit+"&public_delete="+public_delete, function(data){
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
</script>
<script src="../_plugins/dataTables/jquery.dataTables.min.js"></script>
<script src="../_plugins/dataTables/dataTables.bootstrap.min.js"></script>
<link href="../_plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"></script>
<?php eb();?>
 
<?php render($MasterPage);?>