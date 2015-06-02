<?php
    //header("Content-type:text/html; charset=UTF-8");          
    //header("Cache-Control: no-store, no-cache, must-revalidate");         
    //header("Cache-Control: post-check=0, pre-check=0", false);
    $typeQuestion = trim($_POST["typeQuestion"]);
    $valQuestion = trim($_POST["valQuestion"]);
    if($typeQuestion=="text"){
        ?>
        <div class="col-lg-4">
        <label id="nameQuestion">หัวข้อคำถาม</label>
        <input type="text" class="form-control" disabled="disabled" placeholder="คำตอบ"/>
        </div>
        <?
        exit;
    }
     else if($typeQuestion=="textarea"){ ?>
 
        <div class="col-lg-4">
        </div>
        
<?
exit;
    }
     else if($typeQuestion=='radiobox'){
        ?>
        
        <div class="row"  id="inputRadio">
            <div class="col-lg-6 col-lg-offset-2" >
                    <div class="form-inline">
                        <div class="form-group">
                            <label>
                                <input type="radio" class="form-control" disabled="disabled" id="buttonRadio">&nbsp;&nbsp;
                            </label>
                            <input type="text" class="form-control"  id="valRadio1" value="1" style="width:15%;"/>
                            <input type="text" class="form-control" value="ตัวเลือกที่ 1" id="radio1">
                        </div>
                    </div>
                    <div id="radioShow">
                    </div>
                    <div id="radioShowEtc">
                    </div>
            </div>
        </div>
        <div class="col-lg-6 col-lg-offset-2" >
                <button class="btn btn-primary" onclick="addRadiobox();"><i class="fa fa-plus"></i> คลิ้กเพื่อเพิ่มตัวเลือก</button>
                <!--<button class="btn btn-primary" onclick="addRadioTextbox();"><i class="fa fa-plus"></i> คลิ้กเพื่อเพิ่มตัวเลือกแบบข้อความ</button> -->
                &nbsp;&nbsp;หรือ<a onclick="addRadioboxEtc();" style='cursor:pointer;'> เพื่มตัวเลือก "อื่นๆ" </a> 
        </div>
        <?
    exit;}
     else if($typeQuestion=="radiotextbox"){
        ?>
        <div class="row"  id="inputRadio">
            <div class="col-lg-8 col-lg-offset-2" >
                <div class="form-inline">
                    <div class="form-group">
                        <label>
                            <input type="radio" class="form-control" id="radiotextbox" disabled="disabled">
                            <input type="text" class="form-control"  id="valTextRadio1" value="<?php echo $valQuestion?>_1" style="width:15%;"/>
                            <input type="text" class="form-control"  id="labelTextRadio1" value="คำถามที่ 1" style="width:22%;"/>
                            <input type="text" class="form-control" value="คำตอบที่ 1" id="radio1" disabled="disabled">
                        </label>
                    </div>
                </div>
                <div id="showradiotextbox">
                </div>
            </div>
            <div class="col-lg-6 col-lg-offset-2" >
                <button class="btn btn-primary" onclick="addRadiotextbox();"><i class="fa fa-plus"></i> คลิ้กเพื่อเพิ่มตัวเลือก</button>
        </div>
        </div>
        <?php 
    exit;}
     else if($typeQuestion=="checkbox"){
        ?>
        <div class="row"  id="inputCheckbox">
            <div class="col-lg-6 col-lg-offset-2" >
                <div class="form-inline">
                    <div class="form-group">
                        <label>
                            <input type="checkbox"  id="buttonCheckbox" disabled="disabled">&nbsp;&nbsp;
                        </label>
                        <input type="text" class="form-control" id="valCheckbox1" value="<?php echo $valQuestion?>_1" style="width:20%;"/>
                        <input type="text" class="form-control" id="checkbox1" value="ตัวเลือกที่ 1">

                    </div>
                    <div id="checkboxShow">
                    </div>
                    <div id="checkboxShowEtc">
                    </div>
                </div>
            </div>
        <div class="col-lg-6 col-lg-offset-2" ><br>
                <button class="btn btn-primary" onclick="addCheckbox();"><i class="fa fa-plus"></i> คลิ้กเพื่อเพิ่มตัวเลือก</button>
                &nbsp;&nbsp;หรือ<a onclick="addCheckboxEtc();" style='cursor:pointer;'> เพื่มตัวเลือก "อื่นๆ" </a>
        </div>
        </div>
        <?php 
    }
     else if($typeQuestion=="select"){
        ?>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-2" id="inputSelect">
                    <div class="form-inline">
                        <div class="form-group">
                            <label id="select">
                                1.&nbsp;&nbsp;&nbsp;
                            </label>
                            <input type="text" class="form-control" id="valSelect1" value="1" style='width:15%;'/>
                            <input type="text" class="form-control" id="select1"/>

                        </div> 
                        <div id="selectShow">
                        </div>
                    </div>
                </div>        
            </div>
            <br>
            <div class="col-lg-6 col-lg-offset-2" >
                <button class="btn btn-primary" onclick="addSelect();"><i class="fa fa-plus"></i> คลิ้กเพื่อเพิ่มตัวเลือก</button>
            </div>
        <?php 
    }
     else if($typeQuestion=="range"){
        ?>
        <div class="col-lg-6">
                <div class="form-inline">
                    <div class="form-group">
                        <label>
                          
                        </label>
                        <input type="range" class="form-control" id="range" disabled="disabled"/>

                    </div>
                </div>
            </div>
        <?php 
    }
     else if($typeQuestion=="date"){
        ?>
        <div class="col-lg-6">
            <!--<div class="checkbox" style="font-size:16px;">-->
                <input type="text" class="form-control" id="date" name="date" value="__/__/____">
                <script>
                    jQuery('#date').datetimepicker({
                        timepicker:false,
                        format:'d.m.Y H:i',
                        inline:true,
                        lang:'th'
                      });
                </script>
            <!--</div>-->
        </div>
        <br>
        <br>

        <input type="text" class="form-control" id="time" placeholder="__:__" style="cursor:pointer;display:none;" />

        <div>
        <?php 
    }
     else if($typeQuestion=="time"){
        ?>
        <div class="col-lg-3">
            <input type="text" class="form-control" id="time" placeholder="" id="time" />
            <script>
                jQuery('#time').datetimepicker({
                        datepicker:false,
                        inline:true,
                        format:'H:i'
                      });
            </script>
        </div>
        <?php 
    }
     else if($typeQuestion=="datetime"){
        ?>
        <div class="col-lg-6">
            <input type="text" class="form-control" id="datetime" placeholder="" id="datetime" />
            <script>
                jQuery('#datetime').datetimepicker({
                    inline:true,
                    lang:'th'
                    });
            </script>
        </div>
        <?php 
    }
     else if($typeQuestion=="dbthailand"){
        ?>
        <div class="col-lg-6">
            <div class="checkbox">
                <label >
                    <input type="checkbox" name="tumbonCheck" id="tumbonCheck" value="0"> ตำบล
                </label>
            </div>
            <br>
            <?php  include("inc_dbthailand.php");?>
        </div>
      <?php 
    }
     else if($typeQuestion=="heading"){
        ?>
        <div class="col-lg-12">
                <h4>หัวข้อคำถาม</h4>
                <hr class="hr-form">
        </div>
        <?php 
    }
    //($typeQuestion=="scale")
    else{
        //echo $typeQuestion;
        ?>
         <div class="row">
                <div class="col-lg-6 col-lg-offset-2" id="inputSelect">
                    <div class="form-inline">
                        <div class="form-group">
                            <select>
                                <option>0</option><option>1</option>
                            </select>
                            ไปยัง
                            <select>
                                <option>2</option><option>10</option>
                            </select>
                        </div>
                    </div>
                </div>
        </div>
        <?php
    }
?>