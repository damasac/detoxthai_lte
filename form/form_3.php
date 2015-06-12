<div class="row">
    <div class="col-md-12 col-xs-12">
         <div class="table-responsive">
            <table class="table" style="border:1.5px solid #3C3CF5;">
              <thead>
                <tr style="background-color:#3C3CF5;color:white;border:1.5px solid #3C3CF5;">
                  <th>ตอนที่ 3 ข้อมูลเกี่ยวกับพฤติกรรมสุขภาพของตัวท่าน</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    14.โปรดทำเครื่องหมายกากบาท <code>(X)</code> ลงช่อง <code>สี่เหลี่ยม</code> ที่ตรงกับพฤติกรรมสุขภาพของท่าน <code>ในรอบหนึ่งเดือนที่ผ่านมา</code>
                  </td>
                </tr>
                <tr>
                  <td>
                    
                    <?Php
                      $question = array(
                                        "1"=>"a) นอนหลังเที่ยงคืน",
                                        "2"=>"b) นอนหลังสี่ทุ่ม",
                                        "3"=>"c) รับประทานอาหารไม่เป็นเวลา",
                                        "4"=>"d) รับประทานอาหารระหว่างมื้อ",
                                        "5"=>'e) รับประทานขนม <br> <input type="text" class="form-control" id="p3a5c1" value="'.$dataform['p3a5c1'].'">',
                                        "6"=>"f) รับประทานอาหารประเภทเนื้อสัตว์",
                                        "7"=>"g) รับประทานอาหารประเภทผัก ผลไม้",
                                        "8"=>"h) รับประทานอาหารไหม้จากการย่างหรือปิ้ง",
                                        "9"=>"i) รับประทานอาหารจากการทอดโดยนํ้ามันพืช",
                                        "10"=>"j) รับประทานปลาดิบ หรือสุกๆ ดิบๆ ประเภทปลาเกล็ดขาว",
                                        "11"=>'k) รับประทานวิตามิน หรืออาหารเสริมต่างๆ <br> <input type="text" class="form-control" id="p3a11c1" value="'.$dataform['p3a11c1'].'">',
                                        "12"=>'l) ดื่มเครื่องดื่มที่มีรสหวาน <br> <input type="text" class="form-control" id="p3a12c1" value="'.$dataform['p3a12c1'].'">',
                                        "13"=>'m) ดื่มกาแฟ <br> <input type="text" class="form-control" id="p3a13c1" value="'.$dataform['p3a13c1'].'">',
                                        "14"=>"n) สูบบุหรี่",
                                        "15"=>"o) ดื่มสุรา เบียร์ กระแช่ ไวน์",
                                        "16"=>'p) สารสเพติด <br> <input type="text" class="form-control" id="p3a16c1" value="'.$dataform['p3a16c1'].'">',
                                        "17"=>'q) ออกกำลังกาย <br> <input type="text" class="form-control" id="p3a17c1" value="'.$dataform['p3a17c1'].'">',
                                        "18"=>"r) นั่งสมาธิ",
                                        );
                    
                    ?>
                    
                                  <table class="table table-striped table-bordered table-hover" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>พฤติกรรมในรอบหนึ่งเดือนที่ผ่านมา</th>
                                            <th>บ่อยมาก</th>
                                            <th >บางครั้ง</th>
                                            <th >น้อยมาก</th>
                                            <th >ไม่เคยเลย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                    <?php for($i=1;$i<=18;$i++){?>
                                        <tr>
                                          <td><?php echo $question["$i"];?></td>
                                          <td >
                                            <input type="hidden" id="selectValue" value="<?php echo $dataform["p3a$i"];?>"/>
                                            <input type="radio" name="p3a<?php echo$i;?>" id="p3a<?php echo$i;?>v1" value="1" <?php if($dataform["p3a$i"]==1){echo "checked";}else{echo "";}?>>
                                          </td>
                                          <td>
                                            <input type="radio" name="p3a<?php echo$i;?>" id="p3a<?php echo$i;?>v2" value="2" <?php if($dataform["p3a$i"]==2){echo "checked";}else{echo "";}?>>
                                          </td>
                                          <td>
                                            <input type="radio" name="p3a<?php echo$i;?>" id="p3a<?php echo$i;?>v3" value="3" <?php if($dataform["p3a$i"]==3){echo "checked";}else{echo "";}?>>
                                          </td>
                                          <td>
                                            <input type="radio" name="p3a<?php echo$i;?>" id="p3a<?php echo$i;?>v4" value="4" <?php if($dataform["p3a$i"]==4){echo "checked";}else{echo "";}?>>
                                          </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                  </td>
                </tr>
              </tbody>
            </table>
         </div>
    </div>
</div>
<script>
                     $("#p3a5c1").on("blur",function(){
                            var field = "p3a5c1";
                            var form_id = $("#form_id").val();
                            AutoSave(field,form_id);
                      })
                     $("#p3a11c1").on("blur",function(){
                            var field = "p3a11c1";
                            var form_id = $("#form_id").val();
                            AutoSave(field,form_id);
                      });
                     $("#p3a12c1").on("blur",function(){
                            var field = "p3a12c1";
                            var form_id = $("#form_id").val();
                            AutoSave(field,form_id);
                      });
                     $("#p3a13c1").on("blur",function(){
                            var field = "p3a13c1";
                            var form_id = $("#form_id").val();
                            AutoSave(field,form_id);
                      })
                     $("#p3a16c1").on("blur",function(){
                            var field = "p3a16c1";
                            var form_id = $("#form_id").val();
                            AutoSave(field,form_id);
                      });
                     $("#p3a17c1").on("blur",function(){
                            var field = "p3a17c1";
                            var form_id = $("#form_id").val();
                            AutoSave(field,form_id);
                      })
                     $('input[name=p3a1]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a1', $('#form_id').val(), val);
		      });
                     $('input[name=p3a2]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a2', $('#form_id').val(), val);
		      });
                     $('input[name=p3a3]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a3', $('#form_id').val(), val);
		      });
                     $('input[name=p3a4]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a4', $('#form_id').val(), val);
		      });
                     $('input[name=p3a5]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a5', $('#form_id').val(), val);
		      });
                     $('input[name=p3a6]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a6', $('#form_id').val(), val);
		      });
                     $('input[name=p3a7]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a7', $('#form_id').val(), val);
		      });
                     $('input[name=p3a8]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a8', $('#form_id').val(), val);
		      });
                     $('input[name=p3a9]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a9', $('#form_id').val(), val);
		      });
                     $('input[name=p3a10]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a10', $('#form_id').val(), val);
		      });
                     $('input[name=p3a11]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a11', $('#form_id').val(), val);
		      });
                     $('input[name=p3a12]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a12', $('#form_id').val(), val);
		      });
                     $('input[name=p3a13]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a13', $('#form_id').val(), val);
		      });
                     $('input[name=p3a14]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a14', $('#form_id').val(), val);
		      });
                     $('input[name=p3a15]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a15', $('#form_id').val(), val);
		      });
                     $('input[name=p3a16]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a16', $('#form_id').val(), val);
		      });
                     $('input[name=p3a17]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a17', $('#form_id').val(), val);
		      });
                     $('input[name=p3a18]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p3a18', $('#form_id').val(), val);
		      });
</script>