
		<table class="table table-hover" style="border: 1.5px solid green;">
			<tr>
				<td class="p3tableheader" style="background-color:green;color:white;border:1.5px solid green;">
					<strong>ตอนที่ 1 ข้อมูลเกี่ยวกับตัวท่าน</strong>
				</td>
			</tr>
			<tr>
				<td>
					<form class="form-inline">
					<h3>บันทึกการล้างพิษตับ ระหว่าง <code><?php echo System_ShowDateLongTh($data['startdate']);?></code> ถึง <code><?php echo System_ShowDateLongTh($data['enddate']);?></code> ณ สถานที่ <code><?php echo $dbarr['site_name'];?></code></h3>
		  			</form>
				</td>
			</tr>
			<tr>
				<td>
					<form class="form-inline">
					<div class="form-group">
					    <label for="p1a2b1">2. ท่านเกิด</label>
					    <input type="text" class="form-control fix" id="p1a2b1" data-date-format='dd/m/yyyy'  placeholder="วัน/เดือน/ปี" onblur="AutoSave('p1a2b1',$('#form_id').val())" value="<?php echo $dataform["p1a2b1"]; ?>">
		  			</div>
		  			<div class="form-group">
					    <label for="p1a2b2">อายุ</label>
					    <input type="text" class="form-control fix" id="p1a2b2" placeholder="อายุ" onblur="AutoSave('p1a2b2',$('#form_id').val())" onchange="AutoSave('p1a2b2',$('#form_id').val())" value="<?php echo $dataform["p1a2b2"]; ?>">
		  			</div>
		  			<div class="form-group">
					    <label>ปี</label>
		  			</div>
		  			</form>
	
	
					<form class="form-inline">
					<div class="form-group">
					    <label for="p1a3b1">3. เพศ</label>
		  			</div>
					<div class="radio">
					  	<label>
					    	<input type="radio" name="p1a3b1" id="p1a3b1" value="1" <?php if($dataform["p1a3b1"] == "1") {echo "checked";} ?>>
					    	ชาย
					  	</label>
					</div>
					<div class="radio">
					  	<label>
					    	<input type="radio" name="p1a3b1" id="p1a3b2" value="2" <?php if($dataform["p1a3b1"] == "2") {echo "checked";} ?>>
					    	หญิง
					  	</label>
					</div>
		  			</form>
		
			<script>
			$(document).ready(function(){

				$("#p1a4b2").empty();
				<?php
				$sql = "SELECT AMPHUR_ID, AMPHUR_NAME FROM tbl_amphur WHERE AMPHUR_ID = '$dataform[p1a4b2]' ORDER BY AMPHUR_NAME";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				echo "var option = new Option('$row[AMPHUR_NAME]', '');";
				echo '$("#p1a4b2").append($(option));';
				?>

					$.getJSON("getamphur.php?province_id=" + $("#p1a4b1").val(), function(data){
						$.each(data.amphur, function(i, amphur){
							var option = new Option(amphur.AMPHUR_NAME, amphur.AMPHUR_ID);
							$("#p1a4b2").append($(option));
						});
			  		});

			    $("#p1a4b1").change(function() {
			    	$("#p1a4b2").empty();
			    	var option = new Option("เลือกอำเภอ/เขต", "");
    				$("#p1a4b2").append($(option));
					$.getJSON("getamphur.php?province_id=" + $("#p1a4b1").val(), function(data){
						$.each(data.amphur, function(i, amphur){
						var option = new Option(amphur.AMPHUR_NAME, amphur.AMPHUR_ID);
    					$("#p1a4b2").append($(option));
						});
			  		});
				});

				$("#p1a4b1").select2();
				$("#p1a4b2").select2();
				$("#p1a5").select2();
				$("#p1a6").select2();

			});
		  	</script>
			
					<form class="form-inline">
					<div class="form-group">
					    <label for="p1a4b1">4. ภูมิลำเนาเดิมหรือบ้านเกิดของท่านอยู่ที่ใด จังหวัด</label>
					    <!-- <input type="text" class="form-control fix" id="p1a4b1" placeholder="จังหวัด"> -->
		  				<select id="p1a4b1" onchange="AutoSave('p1a4b1',$('#form_id').val())" class="form-control">
						    <option value="">เลือกจังหวัด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
						    <?php
						    	$sql = "SELECT PROVINCE_ID, PROVINCE_NAME FROM tbl_province ORDER BY PROVINCE_NAME";
						    	$result = $conn->query($sql);

								if ($result->num_rows > 0) {
								    // output data of each row
								    while($row = $result->fetch_assoc()) {
								    	if($row['PROVINCE_ID'] == $dataform["p1a4b1"]){
								        	echo "<option value=".$row['PROVINCE_ID']." selected>".$row['PROVINCE_NAME']."</option>";
								        }else{
								        	echo "<option value=".$row['PROVINCE_ID'].">".$row['PROVINCE_NAME']."</option>";
								        }
								    }
								}
						    ?>
						</select>
		  			</div>
		  			<div class="form-group">
					    <label for="p1a4b2">อําเภอ</label>
					    <!-- <input type="text" class="form-control fix" id="p1a4b2" placeholder="อําเภอ"> -->
		  				<select style="width: auto;" id="p1a4b2" onchange="AutoSave('p1a4b2',$('#form_id').val())" class="form-control">
						    <option value="">เลือกอําเภอ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
						</select>
		  			</div>
		  			</form>
			
					<form class="form-inline">
					<div class="form-group">
					    <label for="p1a5">5. วุฒิการศึกษาสูงสุดที่ท่านได้รับในปัจจุบัน</label>
					    <!-- <input type="text" class="form-control fix" id="p1a5" placeholder="วุฒิการศึกษา"> -->
		  				<select id="p1a5" onchange="AutoSave('p1a5',$('#form_id').val())" class="form-control">
						    <option value="">วุฒิการศึกษา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
						    <?php
						    	$sql = "SELECT id, edu_name FROM tbl_education ORDER BY id";
						    	$result = $conn->query($sql);

								if ($result->num_rows > 0) {
								    // output data of each row
								    while($row = $result->fetch_assoc()) {
								    	if($row['id'] == $dataform["p1a5"]){
								        	echo "<option value=".$row['id']." selected>".$row['edu_name']."</option>";
								    	}else{
								        	echo "<option value=".$row['id'].">".$row['edu_name']."</option>";
								    	}
								    }
								}
						    ?>
						</select>
		  			</div>
		  			</form>
			
					<form class="form-inline">
					<div class="form-group">
					    <label for="p1a6">6. อาชีพหลักของท่านในปัจจุบัน</label>
					    <!-- <input type="text" class="form-control fix" id="p1a6" placeholder="อาชีพ"> -->
		  				<select id="p1a6" onchange="AutoSave('p1a6',$('#form_id').val())" class="form-control">
						    <option value="">อาชีพ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
						    <?php
						    	$sql = "SELECT id, job_name FROM tbl_job ORDER BY id";
						    	$result = $conn->query($sql);

								if ($result->num_rows > 0) {
								    // output data of each row
								    while($row = $result->fetch_assoc()) {
								    	if($row['id'] == $dataform["p1a6"]){
								        echo "<option value=".$row['id']." selected>".$row['job_name']."</option>";
								    	}else{
								        echo "<option value=".$row['id'].">".$row['job_name']."</option>";
								    	}
								    }
								}
						    ?>
						</select>
		  			</div>
		  			</form>
		
					<form class="form-inline">
					<div class="form-group">
					    <label for="p1a7b1">7. ท่านเริ่มล้างพิษตับครั้งแรกเมื่อเดือน/ปี</label>
					    <input type="text" class="form-control" id="p1a7b1" data-date-format="m/yyyy" data-date-minviewmode="months" data-date-viewmode="years" placeholder="เดือน/ปี" onblur="AutoSave('p1a7b1',$('#form_id').val())" value="<?php echo $dataform["p1a7b1"]; ?>">
		  			</div>
		  			<!-- <div class="form-group">
					    <label for="p1a7b2">ปี พ.ศ.</label>
					    <input type="text" class="form-control" id="p1a7b2" placeholder="พ.ศ.">
		  			</div> -->
		  			<div class="form-group">
					    <label>ปี</label>
		  			</div>
		  			<div class="form-group">
					    <label for="p1a7b3">สถานที่</label>
					    <input type="text" class="form-control" id="p1a7b2" placeholder="สถานที่" onblur="AutoSave('p1a7b2',$('#form_id').val())" value="<?php echo $dataform["p1a7b2"]; ?>">
		  			</div>
		  			</form>
		
					<form class="form-inline">
					<div class="form-group">
					    <label for="p1a8b1">8. การล้างพิษตับครั้งนี้นับเป็นครั้งที่</label>
					    <input type="text" class="form-control" id="p1a8b1" placeholder="ครั้งที่" onblur="AutoSave('p1a8b1',$('#form_id').val())" value="<?php echo $dataform["p1a8b1"]; ?>">
		  			</div>
		  			<div class="form-group">
					    <label for="p1a8b2">ซึ่งเป็นการเริ่มดื่มนํ้ามันมะกอกแก้วที่</label>
					    <input type="text" class="form-control" id="p1a8b2" placeholder="แก้วที่" onblur="AutoSave('p1a8b2',$('#form_id').val())" value="<?php echo $dataform["p1a8b2"]; ?>">
		  			</div>
		  			</form>
					
					<div class="form-group">
					    <label for="p1a9">9. โปรดระบุเหตุผลหลัก ที่ท่านมารับการล้างพิษตับครั้งนี้</label>
					    <!-- <input type="text" class="form-control fix" id="p1a9" placeholder="เหตุผล"> -->
					    <textarea class='form-control' rows='3' id="p1a9" onblur="AutoSave('p1a9',$('#form_id').val())" ><?php echo $dataform["p1a9"]; ?></textarea>
		  			</div>
		
					<form class="form-inline">
					<div class="form-group" id="labelHide1">
					    <label>10. โปรดระบุอาการหลักๆ หรือโรคที่ได้รับการวินิจฉัยจากแพทย์</label>
		  			</div>
		  			<label class="checkbox-inline">
					  	<input type="checkbox" id="p1a10" value="<?php echo $dataform["p1a10"]; ?>" <?php if($dataform["p1a10"]==1){echo "checked";} ?>> &nbsp;&nbsp;ไม่มีอาการป่วยใดๆ
					</label>
					<div class="form-group">
					    <code>--> ข้ามไปตอบข้อ 11</code>
		  			</div>
					<script>
						$(function(){
							if ($("#p1a10").val()==0) {
								$("#tableHide1").show();
							}else{
								$("#tableHide1").hide();
							}
							});
					</script>
		  			</form>
					<style>
						.divhide{
							display: none;
						}
					</style>
					<script>
						$(document).ready(function(){
							$('#p1a10b3c1').show();
						});
					</script>
		  			<table class="table table-bordered table-hover" id="tableHide1">
		  				<thead>
		  				<tr class="p3tableheader">
		  					<th>อาการหลักๆ หรือโรคที่เคยเป็นหรือที่กำลังเป็นอยู่</th>
		  					<th>เดือน/ปี ที่ เริ่มมีอาการ</th>
		  					<th>ยังรักษาอยู่</th>
		  				</tr>
		  				</thead>
		  			<?php
		  			for($i = 1; $i <= 6; $i++){
		  				$radioyes = "";
		  				$radiono = "";
		  				echo "<script>
		  				$(document).ready(function(){
		  					$('#p1a10b2c".$i."').datepicker();
							
		  					$('#p1a10b2c{$i}').datepicker().on('hide', function(ev) {
  								AutoSave('p1a10b2c{$i}',$('#form_id').val());
							});
							$('input[name=p1a10b3c{$i}]').change(function(e) {
							  	var val = $(this).val();
							  	AutoSaveRadio('p1a10b3c{$i}', $('#form_id').val(), val);
								$('#p1a10b3c".($i+1)."').slideDown();
							});
		  				});
		  				</script>";
		  				$val = $dataform["p1a10b3c{$i}"];
						$radioyes1='';
						$radioyes2='';
		  				if($dataform["p1a10b3c{$i}"] == "1"){
		  					$radioyes1 = " checked";
							$classcss = '';
		  				}else if($dataform["p1a10b3c{$i}"] == "2"){
		  					$radioyes2 = " checked";
							$classcss = '';
		  				}else{
		  					//$radiono = " checked";
							$classcss = "divhide";
		  				}
		  				echo "<tr id='p1a10b3c{$i}' class='{$classcss}'>
		  					<td>
		  						<textarea class='form-control' rows='3' id='p1a10b1c".$i."' onblur=AutoSave('p1a10b1c{$i}',$('#form_id').val())>".$dataform["p1a10b1c{$i}"]."</textarea>
		  					</td>
		  					<td>
		  					<input type='text' class='form-control' data-date-format='m/yyyy' data-date-minviewmode='months' data-date-viewmode='years' id='p1a10b2c".$i."' value='".$dataform["p1a10b2c{$i}"]."' placeholder='เดือน/ปี' onblur=AutoSave('p1a10b1c{$i}',$('#form_id').val())>
		  					</td>
		  					<td>
		  						<form class='form-inline'>
									<div class='radio'>
									  	<label>
									    	<input type='radio' name='p1a10b3c".$i."' id='codeerror".$i."' value='1' ".$radioyes1.">
									    	ใช่
									  	</label>
									</div>
									<div class='radio'>
									  	<label>
									    	<input type='radio' name='p1a10b3c".$i."' id='codeerror".$i."' value='2' ".$radioyes2.">
									    	ไม่ใช่
									  	</label>
									</div>
					  			</form>
		  					</td>
		  				</tr>";
		  			}
		  			?>

		  			</table>
			
		  			<div class="form-group">
					    <label>11. ในวันแรกของการล้างพิษตับครั้งนี้ ท่านอยู่ในสถานะเช่นใด</label>
		  			</div>
		  			<form class="form-inline">
						<div class="radio p3paddingleft">
							<label>
								<input type="radio" name="p1a11b1" id="codeerror1" value="1" <?php if($dataform["p1a11b1"] == "1"){echo "  checked";} ?>>
									ต้องได้รับการดูแลเป็นพิเศษโดยการ
							</label>
						</div>
						<div class="form-group">
					    	<input type="text" class="form-control fix" id="p1a11b1c1" onblur="AutoSave('p1a11b1c1',$('#form_id').val())" value="<?php echo $dataform["p1a11b1c1"]; ?>">
		  				</div>
						<br/>
						<div class="radio p3paddingleft">
							<label>
								<input type="radio" name="p1a11b1" id="codeerror2" value="2"  <?php if($dataform["p1a11b1"] == "2"){echo "  checked";} ?>>
									ไม่สบาย แต่ช่วยเหลือตัวเองได้
							</label>
						</div>
						<br/>
						<div class="radio p3paddingleft">
							<label>
								<input type="radio" name="p1a11b1" id="codeerror3" value="3"  <?php if($dataform["p1a11b1"] == "3"){echo "  checked";} ?>>
									เป็นปกติ
							</label>
						</div>
						<br/>
						<div class="radio p3paddingleft">
							<label>
								<input type="radio" name="p1a11b1" id="codeerror4" value="4"  <?php if($dataform["p1a11b1"] == "4"){echo "  checked";} ?>>
									อื่นๆ ระบุ
							</label>
						</div>
						<div class="form-group">
					    	<input type="text" class="form-control fix" id="p1a11b1c4" onblur="AutoSave('p1a11b1c4',$('#form_id').val())" value="<?php echo $dataform["p1a11b1c4"]; ?>">
		  				</div>
					</form>
		  		
		  			<div class="form-group">
					    <label>12. โปรดบันทึกข้อมูลเกี่ยวกับรูปร่างของท่านในปัจจุบัน</label>
		  			</div>
		  			<table class="table table-bordered table-hover">
		  				<thead>
		  				<tr class="p3tableheader">
		  					<th>รูปร่างของท่านในปัจจุบัน</th>
		  				</tr>
		  				</thead>
		  				<tr>
		  					<td>
		  						<form class="form-inline">
								<div class="form-group">
								    <label for="p1a12b1">a) ส่วนสูง (เซนติเมตร) วัดโดยไม่สวมรองเท้า</label>
								    <input type="text" class="form-control" id="p1a12b1" placeholder="000.0" onblur="AutoSave('p1a12b1',$('#form_id').val())" value="<?php echo $dataform["p1a12b1"]; ?>">
					  			</div>
					  			</form>
		  					</td>
							</tr>
		  				<tr>
		  					<td>
		  						<form class="form-inline">
								<div class="form-group">
								    <label for="p1a12b2">c) รอบเอว (นิ้ว )</label>
								    <input type="text" class="form-control" id="p1a12b2" placeholder="000.0" onblur="AutoSave('p1a12b2',$('#form_id').val())" value="<?php echo $dataform["p1a12b2"]; ?>">
					  			</div>
					  			</form>
		  					</td>
		  				</tr>
		  				<tr>
		  					<td>
		  						<form class="form-inline">
								<div class="form-group">
								    <label for="p1a12b3">b) นํ้าหนัก (กิโลกรัม )</label>
								    <input type="text" class="form-control" id="p1a12b3" placeholder="000.0" onblur="AutoSave('p1a12b3',$('#form_id').val())" value="<?php echo $dataform["p1a12b3"]; ?>">
					  			</div>
					  			</form>
		  					</td>
							</tr>
		  				<tr>
		  					<td>
		  						<form class="form-inline">
								<div class="form-group">
								    <label for="p1a12b4">d) รอบสะโพก (นิ้ว )</label>
								    <input type="text" class="form-control" id="p1a12b4" placeholder="000.0" onblur="AutoSave('p1a12b4',$('#form_id').val())" value="<?php echo $dataform["p1a12b4"]; ?>">
					  			</div>
					  			</form>
		  					</td>
		  				</tr>
		  			</table>
		</td>
		</tr>
</table>  	

<script>
	function getAge(dateString) 
	{
	    var today = new Date();
	    var birthDate = new Date(dateString);
	    var age = (today.getFullYear()+543) - birthDate.getFullYear();
	    var m = today.getMonth() - birthDate.getMonth();
	    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
	    {
	        age--;
	    }
	    return age;
	}

	$(document).ready(function(){
		  $("#p1a2b1").datepicker().on('changeDate', function(ev) {
  				$("#p1a2b2").val(getAge(ev.date));
			});

		  $("#p1a2b1").datepicker().on('hide', function(ev) {
		  		AutoSave('p1a2b1',$('#form_id').val());
		  		AutoSave('p1a2b2',$('#form_id').val());
			});

		  $("#p1a7b1").datepicker().on('hide', function(ev) {
  				AutoSave('p1a7b1',$('#form_id').val());
			});

		  $('input[name="p1a3b1"]').change(function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p1a3b1', $('#form_id').val(), val);
			});

		  $('input[name="p1a11b1"]').change(function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p1a11b1', $('#form_id').val(), val);
			});

		  
	});
</script>
		