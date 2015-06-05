<div class="table-responsive fix">
		<table class="table table-hover" style="border: 1.5px solid #AA66CC;">
			<tr>
				<td class="p3tableheader" style="background-color: #AA66CC;color: #FFFFFF;">
					<strong>ตอนที่ 2 ผลการล้างพิษตับในครั้งที่ผ่านมา</strong>
				</td>
			</tr>
			<tr>
				<td>
					<div class="checkbox">
					  	<label>
						    <input type="checkbox" id="p2a1" value="<?php echo $dataform["p2a1"]?>" <?php if($dataform["p2a1"]==0){echo "checked";}else{echo "";}?>>
						    ไม่เคยล้างพิษตับมาก่อน ครั้งนี้เป็นครั้งแรก --> <code>ข้ามไปตอบตอนที่ 3</code>
					  	</label>
					</div>
					<script>
						$(function(){
							if ($("#p2a1").val()==0) {
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
					<table class="table table-bordered table-hover" id="tableHide2">
						<thead>
						<tr>
							<th rowspan="2"  style="vertical-align: middle;text-align: center;width:120px;" >
								ดื่มน้ำมันมะกอก
							</th>
							<th colspan="3" class="text-center">
								โปรดระบุผลการตรวจถังอุจจาระ
							</th>
							<th colspan="2" class="text-center">
								อาการทางร่างกาย
							</th>
						</tr>
						<tr>
							<th class="text-center">
								สิ่งที่พบในถัง
							</th>
							<th class="text-center">
								การวินิจฉัย <br>(โรคที่พบหรือที่คาดว่าจะเกิด )
							</th>
							<th class="text-center">
								คําแนะนําการปฏิบัติตัว
							</th>
							<th class="text-center">
								ก่อนถ่าย
							</th>
							<th class="text-center">
								หลังถ่าย
							</th>
						</tr>
						</thead>
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
						
					<?php
		  			for($i = 1; $i < 19; $i++){
		  				echo "<tr>
							<td>
					    		<form class='form-inline'>
								<div class='form-group'>
								    แก้วที่
								    <input type='text' class='form-control fix2' id='p2a13b1c".$i."' onblur=AutoSave('p2a13b1c{$i}',$('#form_id').val()) value=".$dataform["p2a13b1c{$i}"].">
					  			</div>
					  			</form>
							</td>
							<td>
								<textarea class='form-control' rows='3' id='p2a13b2c".$i."' onblur=AutoSave('p2a13b2c{$i}',$('#form_id').val())>".$dataform["p2a13b2c{$i}"]."</textarea>
							</td>
							<td>
								<textarea class='form-control' rows='3' id='p2a13b3c".$i."' onblur=AutoSave('p2a13b3c{$i}',$('#form_id').val())>".$dataform["p2a13b3c{$i}"]."</textarea>
							</td>
							<td>
								<textarea class='form-control' rows='3' id='p2a13b4c".$i."' onblur=AutoSave('p2a13b4c{$i}',$('#form_id').val())>".$dataform["p2a13b4c{$i}"]."</textarea>
							</td>
							<td>
								<textarea class='form-control' rows='3' id='p2a13b5c".$i."' onblur=AutoSave('p2a13b5c{$i}',$('#form_id').val())>".$dataform["p2a13b5c{$i}"]."</textarea>
							</td>
							<td>
								<textarea class='form-control' rows='3' id='p2a13b6c".$i."' onblur=AutoSave('p2a13b6c{$i}',$('#form_id').val())>".$dataform["p2a13b6c{$i}"]."</textarea>
							</td>
						</tr>";
					}
					?>

					</table>
				</td>
			</tr>
		</table>
		</div>
	<!-- </div> -->