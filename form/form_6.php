
     <div class="col-md-12 col-xs-12">
             <!--<div class="table-responsive">-->
                <table class="table" style="border:1.5px solid red;">
                    <thead>
                        <tr style="background-color:red;color:white;border:1.5px solid red;">
                            <th>
                            ตอนที่ 6 การประเมินภาพรวมเกี่ยวกับการล้างพิษตับในครั้งนี้
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                            <div class="from-group">
                                <label for="name" style="font-weight: bold;">26. ท่านตั้งใจจะทำการล้างพิษตับอีกหรือไม่ในอนาคต</label>
                                <div><input type="radio" name="p6a26" id="p6a26" value="1" <?php if($dataform["p6a26"]==1){echo "checked";}else{echo "";}?>><sub>1</sub> ทำแน่นอน โดยจะกลับมาทำที่เดิมนี้อีก</div>
                                <div><input type="radio" name="p6a26" id="p6a26" value="2" <?php if($dataform["p6a26"]==2){echo "checked";}else{echo "";}?>><sub>2</sub> ทำแน่นอน โดยจะไปทำที่ศูนย์ฯ อื่น</div>
                                <div><input type="radio" name="p6a26" id="p6a26" value="3" <?php if($dataform["p6a26"]==3){echo "checked";}else{echo "";}?>><sub>3</sub> ทำแน่นอน โดยจะทำด้วยตนเองเองที่บ้าน</div>
                                <div><input type="radio" name="p6a26" id="p6a26" value="4" <?php if($dataform["p6a26"]==4){echo "checked";}else{echo "";}?>><sub>4</sub> ยังไม่แน่ใจ</div>
                                <div><input type="radio" name="p6a26" id="p6a26" value="5" <?php if($dataform["p6a26"]==5){echo "checked";}else{echo "";}?>><sub>5</sub> จะไม่ทำอีกเลย เพราะ</div>
                                <br><input type="text" class="form-control" name="p6a26q1" id="p6a26q1" onblur="AutoSave('p6a26q1',$('#form_id').val())" value="<?php echo $dataform["p6a26q1"];?>">
                            </div>
                            </td>
                        </tr>
                        <script>
                          $('input[name=p6a26]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p6a26', $('#form_id').val(), val);
                         });
                        </script>
                        <tr>
                            <td>
                            <div class="from-group">
                                <label for="name" style="font-weight: bold;">27. ท่านตั้งใจจะแนะนำคนอื่นให้ทำการล้างพิษตับหรือไม่</label>
                                <div><input type="radio" name="p6a27" id="p6a27" value="1" <?php if($dataform["p6a27"]==1){echo "checked";}else{echo "";}?>><sub>1</sub> แนะนำอย่างแน่นอน</div>
                                <div><input type="radio" name="p6a27" id="p6a27" value="2" <?php if($dataform["p6a27"]==2){echo "checked";}else{echo "";}?>><sub>2</sub> ยังไม่แน่ใจ</div>
                                <div><input type="radio" name="p6a27" id="p6a27" value="3" <?php if($dataform["p6a27"]==3){echo "checked";}else{echo "";}?>><sub>3</sub> ไม่แนะนำเลย เพราะ</div>
                                <br>
                                <input type="text" class="form-control" name="p6a27q1" id="p6a27q1" onblur="AutoSave('p6a27q1',$('#form_id').val())" value="<?php echo $dataform["p6a27q1"];?>">
                            </div>
                            </td>
                        </tr>
                        <script>
                          $('input[name=p6a27]').on("change",function(e) { // Select the radio input group
			  	var val = $(this).val();
			  	AutoSaveRadio('p6a27', $('#form_id').val(), val);
                         });
                        </script>
                        <tr>
                            <td>
                                    <div class="col-lg-12" style="padding-left:0px;">
                                        <label>28. โปรดเขียนบรรยายความรู้สึกของท่านเกี่ยวกับการล้างพิษตับ</label>
                                        <textarea name="p6a28" id="p6a28" class="form-control" onblur="AutoSave('p6a28',$('#form_id').val())" ><?php echo $dataform["p6a28"];?></textarea>
                                    </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
    </div>
