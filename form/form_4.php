<style>
    .slider-handle{
        width: 40px !important; 
        height: 40px !important;
    }
    .slider.slider-horizontal .slider-handle {
        margin-top: -15px;
    }
    .tooltip-inner{
		margin-left: 15px;
    }
	.tooltip.top .tooltip-arrow {
		margin-left: 3px;
	}
</style>
<div class="row">
  <div class="col-md-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-hover" style="border: 1.5px solid green;">
              <thead>
                <tr style="background-color:green;color:white;border:1.5px solid green;">
                  <th  style="color: #FFF;"><b>ตอนที่ 4 การประเมินภาวะสุขภาพของท่าน <code>ในรอบหนึ่งเดือนที่ผ่านมา</code></b></th>
                </tr>
              </thead>
            
              <tbody>
               
                <tr>
                  <td><b>ขอให้ท่านประเมินภาวะสุขภาพของตนเองตามสุขภาพที่เป็นอยู่ตรงกับความเป็นจริงมากที่สุดไม่ใช่ประเมินจากความรู้สึก  เมื่อเสร็จข้อ 19 โปรดสไลด์ค่าคะแนนที่ตรงกับสภาวะสุขภาพของท่านมากที่สุด</b></td>
                </tr>
                
                <tr>
                  <td>
                        <div class="from-group">
                            <label for="name" style="font-weight: bold;">15. <b>ในช่วง 30 วันที่ผ่านมา</b> ท่านมีปัญหาใน <code>การเคลื่อนไหว</code> หรือไม่</label>
                            <div><input type="radio" name="p4a<?php $i=1; echo $i;?>" id="p4a<?php echo $i;?>" value="1"  <?php if($dataform["p4a1"]==1){echo "checked";}else{echo "";}?>><sub>1</sub> ไม่มีปัญหาในการเดิน</div>
                            <div><input type="radio" name="p4a<?php echo $i;?>" id="p4a<?php echo $i;?>" value="2"  <?php if($dataform["p4a1"]==2){echo "checked";}else{echo "";}?>><sub>2</sub> มีปัญหาในการเดินบ้าง</div>
                            <div><input type="radio" name="p4a<?php echo $i;?>" id="p4a<?php echo $i;?>" value="3"  <?php if($dataform["p4a1"]==3){echo "checked";}else{echo "";}?>><sub>3</sub> ไม่สามารถเดินไปไหนได้ จำเป็นต้องอยู่บนเตียง</div>
                        </div>
                  </td>
                </tr>
                <script>
                  $('input[name=p4a1]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p4a1', $('#form_id').val(), val);
		      });
                </script>
                <tr>
                  <td>
                        <div class="from-group">
                            <label for="name" style="font-weight: bold;">16. <b>ในช่วง 30 วันที่ผ่านมา</b> ท่านมีปัญหาใน <code>การดูแลตนเอง</code> หรือไม่</label>
                            <div><input type="radio" name="p4a<?php ++$i; echo $i;?>" id="p4a<?php echo $i;?>" value="1"  <?php if($dataform["p4a2"]==1){echo "checked";}else{echo "";}?>><sub>1</sub> ไม่มีปัญหาในการดูแลตนเองด้วยตนเอง</div>
                            <div><input type="radio" name="p4a<?php echo $i;?>" id="p4a<?php echo $i;?>" value="2"  <?php if($dataform["p4a2"]==2){echo "checked";}else{echo "";}?>><sub>2</sub> มีปัญหาบ้างในการอาบน้ำหรือสวมเสื้อผ้า</div>
                          <div><input type="radio" name="p4a<?php echo $i;?>" id="p4a<?php echo $i;?>" value="3"  <?php if($dataform["p4a2"]==3){echo "checked";}else{echo "";}?>><sub>3</sub> ไม่สามารถอาบน้ำหรือสวมเสื้อผ้าด้วยตนเองได้</div>
                        </div>
                  </td>
                </tr>
                 <script>
                  $('input[name=p4a2]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p4a2', $('#form_id').val(), val);
		      });
                </script>
                <tr>
                  <td>
                        <div class="from-group">
                            <label for="name" style="font-weight: bold;">17. <b>ในช่วง 30 วันที่ผ่านมา</b> ท่านมีปัญหาในการทำ <code>กิจกรรมที่ทำเป็นประจำ</code> หรือไม่ (เช่น ทำงานหาเลี้ยงชีพ การเรียน งานบ้าน การทำกิจกรรมในครอบครัวหรือกิจกรรมยามว่าง)</label>
                            <div><input type="radio" name="p4a<?php ++$i; echo $i;?>" id="p4a<?php echo $i;?>" value="1"
                            <?php if($dataform["p4a3"]==1){echo "checked";}else{echo "";}?>><sub>1</sub> ไม่มีปัญหาในการดูแลตนเองด้วยตนเอง</div>
                            <div><input type="radio" name="p4a<?php echo $i;?>" id="p4a<?php echo $i;?>" value="2"
                            <?php if($dataform["p4a3"]==2){echo "checked";}else{echo "";}?>><sub>2</sub> มีปัญหาบ้างในการอาบน้ำหรือสวมเสื้อผ้า</div>
                            <div><input type="radio" name="p4a<?php echo $i;?>" id="p4a<?php echo $i;?>" value="3"
                           <?php if($dataform["p4a3"]==3){echo "checked";}else{echo "";}?> ><sub>3</sub> ไม่สามารถอาบน้ำหรือสวมเสื้อผ้าด้วยตนเองได้</div>
                        </div>
                  </td>
                </tr>
                 <script>
                  $('input[name=p4a3]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p4a3', $('#form_id').val(), val);
		      });
                </script>
                <tr>
                  <td>
                        <div class="from-group">
                            <label for="name" style="font-weight: bold;">17. <b>ในช่วง 30 วันที่ผ่านมา</b> ท่านมีปัญหาในการทำ <code>กิจกรรมที่ทำเป็นประจำ</code> หรือไม่ (เช่น ทำงานหาเลี้ยงชีพ การเรียน งานบ้าน การทำกิจกรรมในครอบครัวหรือกิจกรรมยามว่าง)</label>
                            <div><input type="radio" name="p4a<?php ++$i; echo $i;?>" id="p4a<?php echo $i;?>" value="1"
                            <?php if($dataform["p4a4"]==1){echo "checked";}else{echo "";}?>><sub>1</sub> ไม่มีปัญหาในการทำกิจกรรมที่ทำเป็นประจำ</div>
                            <div><input type="radio" name="p4a<?php echo $i;?>" id="p4a<?php echo $i;?>" value="2"
                            <?php if($dataform["p4a4"]==2){echo "checked";}else{echo "";}?>><sub>2</sub> มีปัญหาในการทำกิจกรรมที่ทำเป็นประจำอยู่บ้าง</div>
                            <div><input type="radio" name="p4a<?php echo $i;?>" id="p4a<?php echo $i;?>" value="3"
                            <?php if($dataform["p4a4"]==3){echo "checked";}else{echo "";}?>><sub>3</sub> ไม่สามารถทำกิจกรรมที่ทำเป็นประจำได้</div>
                        </div>
                  </td>
                </tr>
                 <script>
                  $('input[name=p4a4]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p4a4', $('#form_id').val(), val);
		      });
                </script>
                <tr>
                  <td>
                        <div class="from-group">
                            <label for="name" style="font-weight: bold;">18. <b>ในช่วง 30 วันที่ผ่านมา</b> ท่านมีอาการ <code>ความเจ็บปวด/ไม่สุขสบาย</code> หรือไม่</label>
                            <div><input type="radio" name="p4a<?php ++$i; echo $i;?>" id="p4a<?php echo $i;?>" value="1"
                            <?php if($dataform["p4a5"]==1){echo "checked";}else{echo "";}?>><sub>1</sub> ไม่มีอาการเจ็บปวดหรืออาการไม่สุขสบาย</div>
                            <div><input type="radio" name="p4a<?php echo $i;?>" id="p4a<?php echo $i;?>" value="2"
                            <?php if($dataform["p4a5"]==2){echo "checked";}else{echo "";}?>><sub>2</sub> มีอาการเจ็บปวดหรืออาการไม่สุขสบายปานกลาง</div>
                            <div><input type="radio" name="p4a<?php echo $i;?>" id="p4a<?php echo $i;?>" value="3"
                            <?php if($dataform["p4a5"]==3){echo "checked";}else{echo "";}?>><sub>3</sub> มีอาการเจ็บปวดหรืออาการไม่สุขสบายอย่างมาก</div>
                        </div>
                  </td>
                </tr>
                 <script>
                  $('input[name=p4a5]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p4a5', $('#form_id').val(), val);
		      });
                </script>
                <tr>
                  <td>
                        <div class="from-group">
                            <label for="name" style="font-weight: bold;">19. <b>ในช่วง 30 วันที่ผ่านมา</b> ท่านมี <code>ความวิตกกังวล/ซึมเศร้า</code> หรือไม่</label>
                            <div><input type="radio" name="p4a<?php ++$i; echo $i;?>" id="p4a<?php echo $i;?>" value="1"
                            <?php if($dataform["p4a6"]==1){echo "checked";}else{echo "";}?>><sub>1</sub> ไม่รู้สึกวิตกกังวลหรือซึมเศร้า</div>
                            <div><input type="radio" name="p4a<?php echo $i;?>" id="p4a<?php echo $i;?>" value="2"
                            <?php if($dataform["p4a6"]==2){echo "checked";}else{echo "";}?>><sub>2</sub> รู้สึกวิตกกังวลหรือซึมเศร้าปานกลาง</div>
                            <div><input type="radio" name="p4a<?php echo $i;?>" id="p4a<?php echo $i;?>" value="3"
                            <?php if($dataform["p4a6"]==3){echo "checked";}else{echo "";}?>><sub>3</sub> รู้สึกวิตกกังวลหรือซึมเศร้าอย่างมาก</div>
                        </div>
                  </td>
                </tr>
                 <script>
                  $('input[name=p4a6]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p4a6', $('#form_id').val(), val);
		      });
                </script>
                <tr>
                  <td>
                        <div class="from-group">
                            <label for="name" style="font-weight: bold;">โปรดกำหนดค่าคะแนนที่ตรงกับสภาวะสุขภาพของท่านมากที่สุด จากคะแนน 1 - 100</label><br><br><br>
                            
                            <div class="text-center">
                              <input style="background: green;" class="from-control"
                                     id="p4a7" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1"
                                     data-slider-value="<?php if($dataform["p4a7"]!=""){echo $dataform["p4a7"];}else{echo "0";}?>"/></div>
                        </div>
                  </td>
                </tr>

                
                <tr>
                  <td>
                        <div class="from-group">
                            <label for="name" style="font-weight: bold;">20. โปรดเขียนบรรยายผลการตรวจสุขภาพของท่านครั้งล่าสุด (ตรวจอะไร ด้วยวิธีใด โดยใคร ที่ไหน และผลเป็นอย่างไร)</label>
                            <div><textarea id="p4a8" name="p4a8" class="form-control" rows="5" placeholder="พิมพ์รายละเอียด" onblur="AutoSave('p4a8',$('#form_id').val())" ><?php echo $dataform["p4a8"]?></textarea></div>
                           
                        </div>
                  </td>
                </tr>
              
              </tbody>
            </table>
  </div>

  </div>
  
</div>
<style>
   #ex1Slider .slider-selection {
	background: green;
}
</style>