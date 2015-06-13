<div class="row">
    <div class="col-md-12 col-xs-12">
         <div class="table-responsive">
            <table class="table" style="border:1.5px solid green;">
                <thead>
                    <tr style="background-color:green;color:white;border:1.5px solid green;">
                        <th>ตอนที่ 5 ผลการล้างพิษตับในครั้ง <code>ปัจจุบัน</code> นี้</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>21. โปรดบรรยายการเปลี่ยนแปลงที่ชัดเจน ที่สัมพัส หรือรู้สึกได้ ก่อนและหลังการล้างพิษตับ</td>
                    </tr>
                    <tr>
                        <td>
                            <script>
                                $(document).ready(function(){
                                    $('#section5_1').show();
                                });
                            </script>
                                <table class="table table-striped table-bordered table-hover" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2"  style="vertical-align: middle;text-align: center;width:120px;" >ดื่มน้ำมะกอก</th>
                                            <th colspan="3" class="text-center">โปรดระบุผลการตรวจถังอุจจาระ</th>
                                            <th colspan="2" class="text-center">อาการทางร่างกาย</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">สิ่งที่พบในถัง</th>
                                            <th class="text-center">การวินิจฉัย <br>(โรคที่พบ หรือที่คาดว่าจะเกิด)</th>
                                            <th class="text-center">คำแนะนำ การปฏิบัติตัว</th>
                                            <th class="text-center">ก่อนถ่าย</th>
                                            <th class="text-center">หลังถ่าย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php for($i=1;$i<=9;$i++){
                                    if($dataform["p5a21g{$i}c1"] OR $dataform["p5a21g{$i}c2"] OR $dataform["p5a21g{$i}c3"] OR $dataform["p5a21g{$i}c4"] OR $dataform["p5a21g{$i}c5"]){
                                        $classcss='';
                                    }else{
                                        $classcss = "divhide";
                                    }
                                    ?>
                                        <tr id='section5_<?php echo $i; ?>' class='<?php echo $classcss; ?>'>
                                            <td class="text-center">แก้วที่ <?php echo $i;?></td>
                                            <td  class="text-center">
                                                <textarea class="form-control" id="p5a21g<?php echo $i?>c1" cols="10"
                                                onclick="add_tr('section5_<?php echo ($i+1); ?>');"
                                                onblur="AutoSave('<?php echo "p5a21g".$i."c1";?>',$('#form_id').val())"><?php echo $dataform["p5a21g".$i."c1"];?></textarea></td>
                                            <td  class="text-center">
                                                <textarea class="form-control" id="p5a21g<?php echo $i?>c2" cols="10"
                                                onclick="add_tr('section5_<?php echo ($i+1); ?>');"
                                                 onblur="AutoSave('<?php echo "p5a21g".$i."c2";?>',$('#form_id').val())"><?php echo $dataform["p5a21g".$i."c2"];?></textarea></td>
                                            <td  class="text-center">
                                                <textarea class="form-control" id="p5a21g<?php echo $i?>c3" cols="10"
                                                onclick="add_tr('section5_<?php echo ($i+1); ?>');"
                                               onblur="AutoSave('<?php echo "p5a21g".$i."c3";?>',$('#form_id').val())" ><?php echo $dataform["p5a21g".$i."c3"];?></textarea></td>
                                            <td  class="text-center">
                                                <textarea class="form-control" id="p5a21g<?php echo $i?>c4" cols="10"
                                                onclick="add_tr('section5_<?php echo ($i+1); ?>');"
                                                 onblur="AutoSave('<?php echo "p5a21g".$i."c4";?>',$('#form_id').val())" ><?php echo $dataform["p5a21g".$i."c4"];?></textarea></td>
                                            <td  class="text-center">
                                                <textarea class="form-control" id="p5a21g<?php echo $i?>c5" cols="10"
                                                onclick="add_tr('section5_<?php echo ($i+1); ?>');"
                                                 onblur="AutoSave('<?php echo "p5a21g".$i."c5";?>',$('#form_id').val())" ><?php echo $dataform["p5a21g".$i."c5"];?> </textarea></td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                <div class="col-lg-12" style="padding-left:0px;">
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label>22. ท่าน<code>พึงพอใจมาก</code>กับผล หลังการดื่มน้ำมันมะกอก แก้วที่</label>
                                            <select class="selectpicker" id="p5a22q1" onchange="AutoSave('p5a22q1',$('#form_id').val());" >
                                                            <?php for($i=1;$i<=9;$i++){?>
                                                                <option value="<?php echo $i?>" <?php if($dataform["p5a23q1"]==$i){echo "selected";}else{echo "";}?>><?php echo $i?></option>
                                                            <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                <div class="col-lg-12" style="padding-left:0px;">
                                    <label>เหตุผล เพราะ</label>
                                    <textarea id="p5a22q2" class="form-control" cols="30" onblur="AutoSave('p5a22q2',$('#form_id').val());"><?php echo $dataform["p5a22q2"]?></textarea>
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                <div class="col-lg-12" style="padding-left:0px;">
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label>23. ท่าน<code>รู้สึกแย่มาก</code>กับผล หลังการดื่มน้ำมันมะกอก แก้วที่</label>
                                           
                                            <select class="selectpicker" id="p5a23q1" onchange="AutoSave('p5a23q1',$('#form_id').val());">
                                                            <?php for($i=1;$i<=9;$i++){?>
                                                                <option value="<?php echo $i?>"  <?php if($dataform["p5a23q1"]==$i){echo "selected";}else{echo "";}?>><?php echo $i?></option>
                                                            <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                                <div class="col-lg-12" style="padding-left:0px;">
                                    <label>เหตุผล เพราะ</label>
                                    <textarea id="p5a23q2" class="form-control" cols="30" onblur="AutoSave('p5a23q2',$('#form_id').val());"><?php echo $dataform["p5a23q2"]?></textarea>
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            
                                <div class="col-lg-12" style="padding-left:0px;">
                                    <label>24. อาการทางกายที่มีการเปลี่ยนแปลงไปจากเดิม ที่ท่านรับรู้ได้ หลังจากทำการล้างพิษตับในครั้งนี้</label>
                                    <textarea id="p5a24q1" class="form-control" cols="30" onblur="AutoSave('p5a24q1',$('#form_id').val());"><?php echo $dataform["p5a24q1"]?></textarea>
                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <div class="col-lg-12" style="padding-left:0px;">
                                <label>25. อาการข้างเคียงที่รุนแรงจากการล้างพิษตับในครั้งนี้ สาเหตุ และ การแก้ไขที่ได้รับ</label>
                                <textarea id="p5a25q1" class="form-control" cols="30" onblur="AutoSave('p5a25q1',$('#form_id').val());"><?php echo $dataform["p5a25q1"]?></textarea>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>
</div>
