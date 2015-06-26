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
                                    $('.section5_1').show();
                                });
                                function add_tr5(args) {
                                    $('.'+args).fadeIn();
                                }
                            </script>
                                <table class="table table-striped table-bordered table-hover" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2"  style="vertical-align: middle;text-align: center;width:120px;" >ดื่มน้ำมะกอก</th>
                                            <th colspan="3" class="text-center" style='background-color: #E8FFF2;'>โปรดระบุผลการตรวจถังอุจจาระ</th>
                                            <th colspan="2" class="text-center" style='background-color: #A1FFC9;'>อาการทางร่างกาย</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center" style='background-color: #E8FFF2;'>สิ่งที่พบในถัง</th>
                                            <th class="text-center" style='background-color: #E8FFF2;'>การวินิจฉัย <br>(โรคที่พบ หรือที่คาดว่าจะเกิด)</th>
                                            <th class="text-center" style='background-color: #E8FFF2;'>คำแนะนำ การปฏิบัติตัว</th>
                                            <th class="text-center" style='background-color: #A1FFC9;'>ก่อนถ่าย</th>
                                            <th class="text-center" style='background-color: #A1FFC9;'>หลังถ่าย</th>
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
                                        <tr class='<?php echo $classcss, ' section5_',$i; ?>'>
                                            <td class="text-center">แก้วที่ <?php echo $i;?></td>
                                            <td  class="text-center" style='background-color: #E8FFF2;'>
                                                <textarea class="form-control" id="p5a21g<?php echo $i?>c1" cols="10"
                                                onclick="add_tr5('section5_<?php echo ($i+1); ?>');"
                                                onblur="AutoSave('<?php echo "p5a21g".$i."c1";?>',$('#form_id').val())"><?php echo $dataform["p5a21g".$i."c1"];?></textarea></td>
                                            <td  class="text-center" style='background-color: #E8FFF2;'>
                                                <textarea class="form-control" id="p5a21g<?php echo $i?>c2" cols="10"
                                                onclick="add_tr5('section5_<?php echo ($i+1); ?>');"
                                                 onblur="AutoSave('<?php echo "p5a21g".$i."c2";?>',$('#form_id').val())"><?php echo $dataform["p5a21g".$i."c2"];?></textarea></td>
                                            <td  class="text-center" style='background-color: #E8FFF2;'>
                                                <textarea class="form-control" id="p5a21g<?php echo $i?>c3" cols="10"
                                                onclick="add_tr5('section5_<?php echo ($i+1); ?>');"
                                               onblur="AutoSave('<?php echo "p5a21g".$i."c3";?>',$('#form_id').val())" ><?php echo $dataform["p5a21g".$i."c3"];?></textarea></td>
                                            <td  class="text-center" style='background-color: #A1FFC9;'>
                                                <textarea class="form-control" id="p5a21g<?php echo $i?>c4" cols="10"
                                                onclick="add_tr5('section5_<?php echo ($i+1); ?>');"
                                                 onblur="AutoSave('<?php echo "p5a21g".$i."c4";?>',$('#form_id').val())" ><?php echo $dataform["p5a21g".$i."c4"];?></textarea></td>
                                            <td  class="text-center" style='background-color: #A1FFC9;'>
                                                <textarea class="form-control" id="p5a21g<?php echo $i?>c5" cols="10"
                                                onclick="add_tr5('section5_<?php echo ($i+1); ?>');"
                                                 onblur="AutoSave('<?php echo "p5a21g".$i."c5";?>',$('#form_id').val())" ><?php echo $dataform["p5a21g".$i."c5"];?> </textarea></td>
                                        </tr>
                                        <script>

                                            $(document).ready(function(){
                                                    $('#section5_<?php echo $i; ?>').JSAjaxFileUploader({
                                                        uploadUrl:'upload.php',
                                                        inputText:'<li class="fa fa-picture-o"></li> แนบรูปภาพหรือวิดีโอ สิ่งที่ออกมาจากการล้างพิษตับ',
                                                        fileName:'photo',
                                                        allowExt:'gif|jpg|jpeg|png|bmp|mp4',
                                                        //autoSubmit:false,
                                                        formData:{ref_form:'<?php echo $_GET['form_id']; ?>', ref_field:'p5a21g<?php echo $i; ?>', ref_user:'<?php echo $_SESSION['dtt_user_form']; ?>'},
                                                        maxFileSize:5400900,
                                                        zoomPreview:true,
                                                        zoomWidth:260,
                                                        zoomHeight:260,
                                                        success: function(returndata){
                                                            $("#section5_file<?php echo $i; ?>").prepend(returndata);
                                                        }
                                                    });
                                            });

                                        </script>
                                        <tr class='<?php echo $classcss; echo " section5_",$i; ?>'>
                                            <td colspan="6"><div id="section5_<?php echo $i; ?>"></div></td>
                                        </tr>
                                        <tr class='<?php echo $classcss; echo " section5_",$i; ?>'>
                                            <td colspan="6"  id="section5_file<?php echo $i; ?>">
                                            <?php
                                            $sql = "SELECT `id`, `file_name` FROM tbl_surveyfile WHERE ref_form='".$_GET['form_id']."' AND ref_field='p5a21g".$i."' AND ref_user='".$_SESSION['dtt_user_form']."' ORDER BY id DESC;";
                                            //echo $sql;
                                            $result = $conn->query($sql);
                                            while($dbarr = $result->fetch_assoc()){

                                              if($dbarr['file_type'] =='mp4'){
                                                echo '<div id="divfile'.$dbarr['id'].'"><a target="_blank" href="file_upload/video/'.$dbarr['file_name'].'"><i class="fa fa-file-video-o fa-5x"></i></a> <br>[<a target="_blank" href="file_upload/video/'.$dbarr['file_name'].'">ดูขนาดใหญ่</a>] [<a style="cursor : pointer;" onclick="del_file(\''.$dbarr['id'].'\', \'divfile'.$dbarr['id'].'\');">ลบ</a>]</div>';
                                                }
                                                else {
                                                echo '<div id="divfile'.$dbarr['id'].'"><a target="_blank" href="file_upload/images_large/'.$dbarr['file_name'].'" data-gallery><img class="img-responsive" src="file_upload/images_small/'.$dbarr['file_name'].'"></a> [<a style="cursor : pointer;" onclick="del_file(\''.$dbarr['id'].'\', \'divfile'.$dbarr['id'].'\');">ลบ</a>]</div>';
                                                }

                                            }
                                            ?>
                                            </td>
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
