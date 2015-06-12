		<h3><p>ข้อมูลส่วนบุคคล </p></h3>
		<p><u>
		ข้อมูลนี้จะถูกเก็บรักษาไว้เป็นความลับ และจะถูกแยกออกจากแบบสอบถามส่วนอื่นๆ หลังจากนําเข้าฐานข้อมูล
		</u></p>
		<div class="table-responsive">
		<table class="table table-hover" style="border: 1.5px solid #99CC00;">
		<tr><td>
		<strong>1. ข้อมูลที่อย่ของผู้ตอบแบบสอบถาม</strong>
		<form class="form-inline">
			<input type="hidden" id="form_id" value="<?php echo $_SESSION['dtt_user_form'];?>" />
			<br/>
	  		<div class="form-group paddingleft fix">
			    <label for="p0a1b1c1">1.1 ชื่อ</label>
			    <input type="text" class="form-control input-xxlarge fix" id="p0a1b1c1" placeholder="ชื่อ" onblur="AutoSave_private('p0a1b1c1',$('#form_id').val())" value="<?php echo $dataform["p0a1b1c1"]; ?>">
		  	</div>
		  	<div class="form-group">
			    <label for="p0a1b1c2">นามสกุล</label>
			    <input type="text" class="form-control input-xxlarge fix" id="p0a1b1c2" placeholder="นามสกุล" onblur="AutoSave_private('p0a1b1c2',$('#form_id').val())" value="<?php echo $dataform["p0a1b1c2"]; ?>">
		  	</div>
		  	<br/>
			<!--onblur="AutoSave_private('p0a1b2',$('#form_id').val())"-->
		  	<div class="form-group paddingleft fix">
			    <label for="p0a1b2">1.2 เลขที่บัตรประชาชน</label>
			    <input type="text" class="form-control fix" id="p0a1b2" placeholder="0-0000-000000-00-0" maxlength="17"  value="<?php echo $dataform["p0a1b2"]; ?>" onkeyup="formatPID_private('p0a1b2');">
		  	</div>
		  	<br/>
		  	<div class="form-group paddingleft fix">
			    <label for="p0a1b3">1.3 ที่อยู่ที่ติดต่อได้ : เลขที่</label>
			    <input type="text" class="form-control fix" id="p0a1b3" placeholder="เลขที่" onblur="AutoSave_private('p0a1b3',$('#form_id').val())" value="<?php echo $dataform["p0a1b3"]; ?>">
		  	</div>
		  	<div class="form-group fix">
			    <label for="p0a1b3c1">หมู่ที่</label>
			    <input type="text" class="form-control fix" id="p0a1b3c1" placeholder="หมู่ที่" onblur="AutoSave_private('p0a1b3c1',$('#form_id').val())" value="<?php echo $dataform["p0a1b3c1"]; ?>">
		  	</div>

		  	<div class="form-group fix">
			    <label for="p0a1b3c2">หมู่บ้าน</label>
			    <input type="text" class="form-control fix" id="p0a1b3c2" placeholder="หมู่บ้าน" onblur="AutoSave_private('p0a1b3c2',$('#form_id').val())" value="<?php echo $dataform["p0a1b3c2"]; ?>">
		  	</div>
		  	<div class="form-group fix">
			    <label for="p0a1b3c3">ซอย</label>
			    <input type="text" class="form-control fix" id="p0a1b3c3" placeholder="ซอย" onblur="AutoSave_private('p0a1b3c3',$('#form_id').val())" value="<?php echo $dataform["p0a1b3c3"]; ?>">
		  	</div>
		  	<div class="form-group fix">
			    <label for="p0a1b3c4">ถนน</label>
			    <input type="text" class="form-control fix" id="p0a1b3c4" placeholder="ถนน" onblur="AutoSave_private('p0a1b3c4',$('#form_id').val())" value="<?php echo $dataform["p0a1b3c4"]; ?>">
		  	</div>
		  	<script>
			$(document).ready(function(){
				//alert("Codeerror");
/*
				$("#p0a1b3c6").empty();
			    	var option = new Option("เลือกอำเภอ/เขต", "");
    				$("#p0a1b3c6").append($(option));
					$.getJSON("http://www.detoxthai.org/wp-content/surveyform/getamphur.php?province_id=" + $("#p0a1b3c5").val(), function(data){
						$.each(data.amphur, function(i, amphur){
						if(amphur.AMPHUR_ID == <?php // echo $dataform["p0a1b3c6"]+0; ?>){
							var option = new Option(amphur.AMPHUR_NAME, amphur.AMPHUR_ID);
							option.setAttribute("selected","selected");
						}else{
							var option = new Option(amphur.AMPHUR_NAME, amphur.AMPHUR_ID);
						}
    					$("#p0a1b3c6").append($(option));
						});
			  		});

			    $("#p0a1b3c5").change(function() {
			    	//alert("Codeerror");
			    	$("#p0a1b3c6").empty();
			    	var option = new Option("เลือกอำเภอ/เขต", "");
    				$("#p0a1b3c6").append($(option));
					$.getJSON("http://www.detoxthai.org/wp-content/surveyform/getamphur.php?province_id=" + $("#p0a1b3c5").val(), function(data){
						$.each(data.amphur, function(i, amphur){
						var option = new Option(amphur.AMPHUR_NAME, amphur.AMPHUR_ID);
    					$("#p0a1b3c6").append($(option));
						});
			  		});
				});
			    //alert($("#p0a1b3c6").val());
				$("#p0a1b3c7").empty();
			    	var option = new Option("เลือกตำบล/แขวง", "");
    				$("#p0a1b3c7").append($(option));
					$.getJSON("http://www.detoxthai.org/wp-content/surveyform/getdistrict.php?amphur_id=<?php //echo $dataform["p0a1b3c6"]; ?>", function(data){
						$.each(data.district, function(i, district){
						if(district.DISTRICT_ID == <?php //echo $dataform["p0a1b3c7"]+0; ?>){
							var option = new Option(district.DISTRICT_NAME, district.DISTRICT_ID);
							option.setAttribute("selected","selected");
						}else{
							var option = new Option(district.DISTRICT_NAME, district.DISTRICT_ID);
						}
    					$("#p0a1b3c7").append($(option));
					});
			  	});

				$("#p0a1b3c6").change(function() {
			    	$("#p0a1b3c7").empty();
			    	var option = new Option("เลือกตำบล/แขวง", "");
    				$("#p0a1b3c7").append($(option));
					$.getJSON("http://www.detoxthai.org/wp-content/surveyform/getdistrict.php?amphur_id=" + $("#p0a1b3c6").val(), function(data){
						$.each(data.district, function(i, district){
						var option = new Option(district.DISTRICT_NAME, district.DISTRICT_ID);
    					$("#p0a1b3c7").append($(option));
						});
			  		});
				});

				//$("#p0a1b3c5").select2();
				//$("#p0a1b3c6").select2();
				//$("#p0a1b3c7").select2();
*/
			});

		  	</script>
		  	<div class="form-group fix">
			    <label for="p0a1b3c5">จังหวัด</label>
			    <select id="p0a1b3c5" onchange="AutoSave_private('p0a1b3c5',$('#form_id').val())" class="form-control">
			    <option value="">เลือกจังหวัด</option>
			    <?php
			    	$sql = "SELECT PROVINCE_ID, PROVINCE_NAME FROM province ORDER BY PROVINCE_NAME";
			    	$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					    // output data of each row
					    while($row = $result->fetch_assoc()) {
					    	if($row['PROVINCE_ID'] == $dataform["p0a1b3c5"]){
					        	echo "<option value=".$row['PROVINCE_ID']." selected>".$row['PROVINCE_NAME']."</option>";
					    	}else{
					    		echo "<option value=".$row['PROVINCE_ID'].">".$row['PROVINCE_NAME']."</option>";
					    	}
					    }
					}
					/*$conn->close();*/
			    ?>
				</select>
		  	</div>
		  	<div class="form-group fix">
			    <label for="p0a1b3c6">อำเภอ/เขต</label>
			    <select id="p0a1b3c6" onchange="AutoSave_private('p0a1b3c6',$('#form_id').val())" class="form-control">
			    	<option value="">เลือกอำเภอ/เขต</option>
				</select>
			    <!-- <input type="text" class="form-control fix" id="p0a1b3c6" placeholder="อำเภอ/เขต"> -->
		  	</div>
		  	<div class="form-group fix">
			    <label for="p0a1b3c7">ตำบล/แขวง</label>
			    <select id="p0a1b3c7" onchange="AutoSave_private('p0a1b3c7',$('#form_id').val())" class="form-control">
			    	<option value="">เลือกตำบล/แขวง</option>
				</select>
			    <!-- <input type="text" class="form-control fix" id="p0a1b3c7" placeholder="ตำบล/แขวง"> -->
		  	</div>
		  	<div class="form-group fix">
			    <label for="p0a1b3c8">รหัสไปรษณีย์</label>
			    <input type="text" class="form-control fix" id="p0a1b3c8" placeholder="รหัสไปรษณีย์" maxlength="5" onblur="AutoSave_private('p0a1b3c8',$('#form_id').val())" value="<?php echo $dataform["p0a1b3c8"]; ?>">
		  	</div>
		  	<br/>
		  	<div class="form-group paddingleft fix">
			    <label for="p0a1b4">1.4 เบอร์โทรศัพท์ที่ติดต่อได้สะดวก
			    </label>
			    <input type="text" class="form-control fix" id="p0a1b4" placeholder="000-0000000" onkeyup="formatNumber_private('p0a1b4',$('#form_id').val())" value="<?php echo $dataform["p0a1b4"]; ?>">
		  	</div>
		  	<br/>
		  	<div class="form-group paddingleft fix">
			    <label for="p0a1b5">1.5 มือถือ
			    </label>
			    <input type="text" class="form-control fix" id="p0a1b5" placeholder="000-0000000" onkeyup="formatNumber_private('p0a1b5',$('#form_id').val())" value="<?php echo $dataform["p0a1b5"]; ?>">
		  	</div>
		  	<br/>
		  	<div class="form-group paddingleft fix">
			    <label for="p0a1b6">1.6 E-mail
			    </label>
			    <input type="text" class="form-control fix" id="p0a1b6" placeholder="E-mail" value="<?php echo $dataform["p0a1b6"];?>" onblur="validateEmail_private('p0a1b6',$('#form_id').val());">
		  	</div>
		</form>
		</td></tr>
		<tr><td>
		<strong>2. ข้อมูลที่อยู่ของผู้ที่สามารถติดต่อท่านได้สะดวกในกรณีที่ติดต่อท่านไม่ได้</strong>
		<br/>
		<br/>
		<form class="form-inline">
			<div class="form-group paddingleft fix">
				    <label for="p0a2b1c1">2.1 ชื่อ</label>
				    <input type="text" class="form-control fix" id="p0a2b1c1" placeholder="ชื่อ" onblur="AutoSave_private('p0a2b1c1',$('#form_id').val())" value="<?php echo $dataform["p0a2b1c1"]; ?>">
			</div>
			<div class="form-group">
				    <label for="p0a2b1c2">นามสกุล</label>
				    <input type="text" class="form-control fix" id="p0a2b1c2" placeholder="นามสกุล" onblur="AutoSave_private('p0a2b1c2',$('#form_id').val())" value="<?php echo $dataform["p0a2b1c2"]; ?>">
			</div>
			<br/>
			<div class="form-group paddingleft fix">
				    <label for="p0a2b2">2.2 เบอร์โทรศัพท์ที่ติดต่อได้สะดวก</label>
				    <input type="text" class="form-control fix" id="p0a2b2" placeholder="000-0000000" onkeyup="formatNumber_private('p0a2b2',$('#form_id').val())" value="<?php echo $dataform["p0a2b2"]; ?>">
			</div>
			<br/>
			<div class="form-group paddingleft fix">
				    <label for="p0a2b3">2.3 มือถือ</label>
				    <input type="text" class="form-control fix" id="p0a2b3" placeholder="000-0000000" onkeyup="formatNumber_private('p0a2b3',$('#form_id').val())" value="<?php echo $dataform["p0a2b3"]; ?>">
			</div>
			<br/>
			<div class="form-group paddingleft fix">
				    <label for="p0a2b4">2.4 E-mail</label>
				    <input type="text" class="form-control fix" id="p0a2b4" placeholder="E-mail" value="<?php echo $dataform["p0a2b4"];?>" onblur="validateEmail_private('p0a2b4',$('#form_id').val());">
			</div>
		</form>
		</td></tr>
		</table>
		</div>