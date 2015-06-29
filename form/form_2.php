<div class="table-responsive">
		<table class="table table-hover" style="border: 1.5px solid green;">
			<tr>
				<td class="p3tableheader" style="background-color:green;color:white;border:1.5px solid green;">
					<strong>ตอนที่ 2 ผลการล้างพิษตับในครั้งที่ผ่านมา (กรอกครั้งเดียว)</strong>
				</td>
			</tr>
			<tr>
				<td>
					<div class="checkbox">
					  	<label>
						    <input type="checkbox" id="p2a1" value="<?php echo $dataform["p2a1"]?>" <?php if($dataform["p2a1"]==1){echo "checked";}?>>
						    &nbsp;&nbsp;ไม่เคยล้างพิษตับมาก่อน ครั้งนี้เป็นครั้งแรก --> <code>ข้ามไปตอบตอนที่ 3</code>
					  	</label>
					</div>
					<script>
						$(function(){
							if ($("#p2a1").val()==1) {
								$("#labelHide2").hide();
								$("#tableHide2").hide();
							}else{
								$("#labelHide2").show();
								$("#tableHide2").show();
							}
							});
					</script>
					<div class="form-group" id="labelHide2">
					    <label>13. โปรดบรรยายการเปลี่ยนแปลงที่ชัดเจน ที่สัมผัส หรือรู้สึกได้ ก่อนและหลังการล้างพิษตับ <code>ครั้งที่ผ่านมา</code></label>
		  			</div>
				</td>
			</tr>
			<tr>
				<td>
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="tableHide2">

						<!-- <tr>
							<td>
					    		<form class="form-inline">
								<div class="form-group">
								    แก้วที่
								    <input type="text" class="form-control fix2" id="p2a13b1c1">
					  			</div>
					  			</form>
							</td>
							<td>
								<textarea class="form-control" rows="3" id="p2a13b2c1"></textarea>
							</td>
							<td>
								<textarea class="form-control" rows="3" id="p2a13b3c1"></textarea>
							</td>
							<td>
								<textarea class="form-control" rows="3" id="p2a13b4c1"></textarea>
							</td>
							<td>
								<textarea class="form-control" rows="3" id="p2a13b5c1"></textarea>
							</td>
							<td>
								<textarea class="form-control" rows="3" id="p2a13b6c1"></textarea>
							</td>
						</tr> -->
					<script>
					var glass=0;

						function add_tr(args) {
						$('.section2_'+args).fadeIn();
								args = parseInt(args);
								glass = args;
						if(glass==19){
								$('#section2_add_glass').hide();
							}
						}

						function add_glass(args) {
							args = parseInt(args);
							if(glass>=args){
								glass++;
							}else{
								glass=args;
								glass++;
							}

							$('.section2_'+glass).fadeIn();
							if(glass==19){
								$('#section2_add_glass').hide();
							}

            }
						$(document).ready(function(){
							$('.section2_1').show();
						});
					</script>
					<?php
					$classcss_addglass=0;
		  			for($i = 1; $i <= 19; $i++){
						if($dataform["p2a13b1c{$i}"] OR $dataform["p2a13b2c{$i}"] OR $dataform["p2a13b3c{$i}"] OR $dataform["p2a13b4c{$i}"] OR $dataform["p2a13b5c{$i}"] OR $dataform["p2a13b6c{$i}"]){
							$classcss='';
							$classcss_addglass++;
						}else{
							$classcss = "divhide";
						} ?>
						<thead class="<?php echo $classcss; ?> section2_<?php echo $i; ?>">
						<tr>
							<th rowspan="2"  style="vertical-align: middle;text-align: center;width:120px;" >
								ดื่มน้ำมันมะกอก
							</th>
							<th colspan="3" class="text-center" style="background-color: #E8FFF2;">
								โปรดระบุผลการตรวจถังอุจจาระ
							</th>
							<th colspan="2" class="text-center" style="background-color: #A1FFC9;">
								อาการทางร่างกาย
							</th>
						</tr>
						<tr>
							<th class="text-center" style="background-color: #E8FFF2;">
								สิ่งที่พบในถัง
							</th>
							<th class="text-center" style="background-color: #E8FFF2;">
								การวินิจฉัย <br>(โรคที่พบหรือที่คาดว่าจะเกิด )
							</th>
							<th class="text-center" style="background-color: #E8FFF2;">
								คําแนะนําการปฏิบัติตัว
							</th>
							<th class="text-center" style="background-color: #A1FFC9;">
								ก่อนถ่าย
							</th>
							<th class="text-center" style="background-color: #A1FFC9;">
								หลังถ่าย
							</th>
						</tr>
						</thead>


						<?php
						echo "<tr class='{$classcss} section2_{$i}'>
							<td>
					    		<form class='form-inline'>
								<div class='form-group'>
								    แก้วที่
								    <input type='number' style='width:70px;' class='form-control' onclick=\"add_tr('".($i+1)."');\" id='p2a13b1c".$i."' onblur=AutoSave('p2a13b1c{$i}',$('#form_id').val()) value=".$dataform["p2a13b1c{$i}"].">
					  			</div>
					  			</form>
							</td>
							<td style='background-color: #E8FFF2;'>
								<textarea class='form-control' rows='3' id='p2a13b2c".$i."' onclick=\"add_tr('".($i+1)."');\" onblur=AutoSave('p2a13b2c{$i}',$('#form_id').val())>".$dataform["p2a13b2c{$i}"]."</textarea>
							</td>
							<td style='background-color: #E8FFF2;'>
								<textarea class='form-control' rows='3' id='p2a13b3c".$i."' onclick=\"add_tr('".($i+1)."');\" onblur=AutoSave('p2a13b3c{$i}',$('#form_id').val())>".$dataform["p2a13b3c{$i}"]."</textarea>
							</td>
							<td style='background-color: #E8FFF2;'>
								<textarea class='form-control' rows='3' id='p2a13b4c".$i."' onclick=\"add_tr('".($i+1)."');\" onblur=AutoSave('p2a13b4c{$i}',$('#form_id').val())>".$dataform["p2a13b4c{$i}"]."</textarea>
							</td>
							<td style='background-color: #A1FFC9;'>
								<textarea class='form-control' rows='3' id='p2a13b5c".$i."' onclick=\"add_tr('".($i+1)."');\" onblur=AutoSave('p2a13b5c{$i}',$('#form_id').val())>".$dataform["p2a13b5c{$i}"]."</textarea>
							</td>
							<td style='background-color: #A1FFC9;'>
								<textarea class='form-control' rows='3' id='p2a13b6c".$i."' onclick=\"add_tr('".($i+1)."');\" onblur=AutoSave('p2a13b6c{$i}',$('#form_id').val())>".$dataform["p2a13b6c{$i}"]."</textarea>
							</td>
						</tr>"; ?>
					<script>

						$(document).ready(function(){
								var size_media = 5400900*40; //200MB
								$('#section2_<?php echo $i; ?>').JSAjaxFileUploader({
									uploadUrl:'upload.php',
									inputText:'<li class="fa fa-picture-o"></li> แนบรูปภาพหรือวิดีโอ สิ่งที่ออกมาจากการล้างพิษตับ',
									fileName:'photo',
									allowExt:'gif|jpg|jpeg|png|bmp|mp4',
									//autoSubmit:false,
									formData:{ref_form:'<?php echo $_GET['form_id']; ?>', ref_field:'p2a13b1c<?php echo $i; ?>', ref_user:'<?php echo $_SESSION['dtt_user_form']; ?>'},
									maxFileSize:size_media,
									zoomPreview:true,
									zoomWidth:260,
									zoomHeight:260,
									success: function(returndata){
										$("#section2_file<?php echo $i; ?>").prepend(returndata);
									}
								});
						});

					</script>
					<tr class='<?php echo $classcss; echo " section2_",$i; ?>'>
						<td colspan="6"><div id="section2_<?php echo $i; ?>"></div></td>
					</tr>
				    <tr class='<?php echo $classcss; echo " section2_",$i; ?>'>
						<td colspan="6"  id="section2_file<?php echo $i; ?>" class="row">
						<?php
						$sql = "SELECT `id`, `file_name`, `file_type` FROM tbl_surveyfile WHERE ref_form='".$_GET['form_id']."' AND ref_field='p2a13b1c".$i."' AND ref_user='".$_SESSION['dtt_user_form']."' ORDER BY id DESC;";
						//echo $sql;
						$result = $conn->query($sql);
						while($dbarr = $result->fetch_assoc()){

								if($dbarr['file_type'] =='mp4'){
								echo '<div id="divfile'.$dbarr['id'].'" class="col-md-2" style="height:150px;"><a target="_blank" href="file_upload/video/'.$dbarr['file_name'].'"><i class="fa fa-file-video-o fa-5x"></i></a> <br>[<a target="_blank" href="file_upload/video/'.$dbarr['file_name'].'">ดูขนาดใหญ่</a>] [<a style="cursor : pointer;" onclick="return confirm(\'ยืนยันการลบ ?\') ? del_file(\''.$dbarr['id'].'\', \'divfile'.$dbarr['id'].'\') : \'\';">ลบ</a>]</div>';
								}
								else {
								echo '<div id="divfile'.$dbarr['id'].'" class="col-md-2" style="height:150px;"><a href="file_upload/images_large/'.$dbarr['file_name'].'" data-gallery><img class="img-responsive" src="file_upload/images_small/'.$dbarr['file_name'].'"></a> [<a style="cursor : pointer;" onclick="return confirm(\'ยืนยันการลบ ?\') ? del_file(\''.$dbarr['id'].'\', \'divfile'.$dbarr['id'].'\') : \'\';">ลบ</a>]</div>';
								}
						}
						?>
						</td>
					</tr>

					<?php
					}
					?>
					<tr id="section2_add_glass" style="display:<?php if($classcss_addglass==19) echo 'none'; ?>">
						<td colspan="6" class="text-center bg-warning"><a onclick="add_glass(<?php echo $classcss_addglass; ?>);" class="btn btn-warning btn-lg btn-block"><li class="fa fa-plus"></li> เพิ่มแก้ว <li class="fa fa-coffee"></li></a></td>
					</tr>

					</table>
					</div>
				</td>
			</tr>
		</table>
</div>
	<!-- </div> -->
