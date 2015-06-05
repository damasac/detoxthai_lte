
<?php
    error_reporting(0);   
    include_once("../_connection/db_eform.php");
    $id = $_POST["id"];
    $typeQuestion = $_POST["typeQuestion"];
    $idexplode = explode("_",$id);
    $idDb = $idexplode["1"];
    $selectField = "SELECT * FROM formfield WHERE fieldid='".$idDb."' ";
    $queryField =  mysqli_query($con,$selectField) or die(mysqli_error());
    $dataField = mysqli_fetch_assoc($queryField);
    $selectTable = mysqli_query($con,"SELECT `tablename` FROM `formmain` WHERE `formid`='".$dataField["formid"]."' ") or die(mysqli_error());
    $dataTable = mysqli_fetch_assoc($selectTable);

    if($typeQuestion=="text"){
        ?>
	<div class="panel-body2" id="editpanel<?php echo $id;?>" style="">
                        <h4>แก้ไข</h4>
			<hr style="border:1px #AAAAAA solid;">
			    <div class="panel-heading" style="height: auto;">
				<div class="editIPanel" style="float:right;font-size:16px;cursor: pointer">
				    <button class="btn btn-default" disabled="disabled"><i class="fa fa-pencil"></i></button>
				    <button class="btn btn-default" onclick="delFormFnc('item_<?php echo $dataField["fieldid"]?>','<?php echo $dataTable["tablename"]; ?>','<?php echo $dataField["fieldvalue"]?>')"><i class="fa fa-trash-o"></i></button>
				</div>
				    <div class="row">
					<div class="col-lg-2">
					    <p>หัวข้อคำถาม</p><code id="nameError2"></code><code id="nameError2"></code><code id="nameError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="nameQuestion2" placeholder="คำถามไม่ระบุหัวข้อ" value="<?php echo $dataField["fieldname"];?>">
					</div>
				    </div><br>
				     <div class="row">
					<div class="col-lg-2">
					    <p>ตัวแปร</p><code id="valueError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="valQuestion2" placeholder="" value="<?php echo $dataField["fieldvalue"];?>" style="width:20%">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ข้อความช่วยเหลือ</p>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="helpQuestion2" value="<?php echo $dataField["fieldhelp"];?>">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ประเภทคำถาม</p>
					</div>
					<div class="col-lg-4">
					    <select class="form-control" id="typeQuestion2" onchange="selectTypeQuestion($(this).val());">
						<option value="0" >- กรุณาเลือกประเภทคำถาม -</option>
						<option value="text" selected>Text</option>
						<option value="heading">Heading Text</option>
						<option value="textarea" >Paragraph text</option>
						<option value="radiobox" >Multiple choice</option>
						<option value="checkbox" >Checkbox</option>
						<option value="select" >Choose from list</option>
						<option value="date">Date</option>
						<option value="time">Time</option>
						<option value="datetime" >Date & Time</option>
						<option value="dbthailand">Province/ District/ Subdistrict</option>
					    </select>
					</div>
				    </div>
				    <div class="row">
					<br>
					<div id="exampleEform">
                                            <div class="col-lg-4">
                                            <label id="nameQuestion">หัวข้อคำถาม</label>
                                            <input type="text" class="form-control" disabled="disabled" placeholder="คำตอบ"/>
                                            </div>
					</div>
					<br><br>
				    </div>
				    <br><br>
				    <div class="row">
					<div class="col-lg-12">
					    <button type="button" class="btn btn-primary" onclick="editQuestion('<?php echo $dataField["fieldid"];?>');">เสร็จสิ้น</button>
					</div>
				    </div>
			    </div>
		</div>
            <?php
   }
    if($typeQuestion=="textarea"){
        ?>
        	<div class="panel-body2" id="editpanel<?php echo $id;?>" style="">
                        <h4>แก้ไข</h4>
			<hr style="border:1px #AAAAAA solid;">
			    <div class="panel-heading" style="height: auto;">
				<div class="editIPanel" style="float:right;font-size:16px;cursor: pointer">
				    <button class="btn btn-default" disabled="disabled"><i class="fa fa-pencil"></i></button>
				    <button class="btn btn-default" onclick="delFormFnc('item_<?php echo $dataField["fieldid"]?>','<?php echo $dataTable["tablename"]; ?>','<?php echo $dataField["fieldvalue"]?>')"><i class="fa fa-trash-o"></i></button>
				</div>
				    <div class="row">
					<div class="col-lg-2">
					    <p>หัวข้อคำถาม</p><code id="nameError2"></code><code id="nameError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="nameQuestion2" placeholder="คำถามไม่ระบุหัวข้อ" value="<?php echo $dataField["fieldname"];;?>">
					</div>
				    </div><br>
				     <div class="row">
					<div class="col-lg-2">
					    <p>ตัวแปร</p><code id="valueError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="valQuestion2" placeholder="" value="<?php echo $dataField["fieldvalue"];?>" style="width:20%">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ข้อความช่วยเหลือ</p>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="helpQuestion2" value="<?php echo $dataField["fieldhelp"];?>">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ประเภทคำถาม</p>
					</div>
					<div class="col-lg-4">
					    <select class="form-control" id="typeQuestion2" onchange="selectTypeQuestion($(this).val());">
						<option value="0" >- กรุณาเลือกประเภทคำถาม -</option>
						<option value="text" >Text</option>
						<option value="heading">Heading Text</option>
						<option value="textarea" selected >Paragraph text</option>
						<option value="radiobox" >Multiple choice</option>
						<option value="checkbox" >Checkbox</option>
						<option value="select" >Choose from list</option>
						<option value="date">Date</option>
						<option value="time">Time</option>
						<option value="datetime" >Date & Time</option>
						<option value="dbthailand">Province/ District/ Subdistrict</option>
					    </select>
					</div>
				    </div>
				    <div class="row">
					<br>
					<div id="exampleEform">
                                                   <div class="col-lg-6">
						    <label id="nameQuestion">หัวข้อคำถาม</label>
						    <textarea class="form-control" disabled="disabled" placeholder="คำตอบแบบยาว"></textarea>
						    </div>
					</div>
					<br><br>
				    </div>
				    <br><br>
				    <div class="row">
					<div class="col-lg-12">
					    <button type="button" class="btn btn-primary" onclick="editQuestion('<?php echo $dataField["fieldid"];?>');">เสร็จสิ้น</button>
					</div>
				    </div>
			    </div>
		</div>

        <?php 
    }
    if($typeQuestion=="radiobox"){
        ?>
                	<div class="panel-body2" id="editpanel<?php echo $id;?>" style="">
                        <h4>แก้ไข</h4>
			<hr style="border:1px #AAAAAA solid;">
			    <div class="panel-heading" style="height: auto;">
				<div class="editIPanel" style="float:right;font-size:16px;cursor: pointer">
				    <button class="btn btn-default" disabled="disabled"><i class="fa fa-pencil"></i></button>
				    <button class="btn btn-default" onclick="delFormFnc('item_<?php echo $dataField["fieldid"]?>','<?php echo $dataTable["tablename"]; ?>','<?php echo $dataField["fieldvalue"]?>')"><i class="fa fa-trash-o"></i></button>
				</div>
				    <div class="row">
					<div class="col-lg-2">
					    <p>หัวข้อคำถาม</p><code id="nameError2"></code><code id="nameError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="nameQuestion2" placeholder="คำถามไม่ระบุหัวข้อ" value="<?php echo $dataField["fieldname"];?>">
					</div>
				    </div><br>
				     <div class="row">
					<div class="col-lg-2">
					    <p>ตัวแปร</p><code id="valueError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="valQuestion2" placeholder="" value="<?php echo $dataField["fieldvalue"];?>" style="width:20%">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ข้อความช่วยเหลือ</p>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="helpQuestion2" value="<?php echo $dataField["fieldhelp"];?>">
					</div>
				    </div><br>
				    <div class="row" >
					<div class="col-lg-2">
					    <p>ประเภทคำถาม</p>
					</div>
					<div class="col-lg-4">
					    <select class="form-control" id="typeQuestion2" onchange="selectTypeQuestion($(this).val());">
						<option value="0" >- กรุณาเลือกประเภทคำถาม -</option>
						<option value="text" >Text</option>
						<option value="heading">Heading Text</option>
						<option value="textarea" >Paragraph text</option>
						<option value="radiobox" selected>Multiple choice</option>
						<option value="checkbox" >Checkbox</option>
						<option value="select" >Choose from list</option>
						<option value="date">Date</option>
						<option value="time">Time</option>
						<option value="datetime" >Date & Time</option>
						<option value="dbthailand">Province/ District/ Subdistrict</option>

					    </select>
					</div>
				    </div>
				    <div class="row">
					<br>
					<div id="exampleEform">
					            <div class="row"  id="inputRadio">
							<div class="col-lg-6 col-lg-offset-2" >
									<?php
									    $sqlChoiceRadio = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY choiceid ";
									    $queryChoiceRadio = mysqli_query($con,$sqlChoiceRadio);
									    $sqlChoiceRadioEtc = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='1' ";
									    $queryChoiceRadioEtc = mysqli_query($con,$sqlChoiceRadioEtc);
									    $dataEtc = mysqli_fetch_assoc($queryChoiceRadioEtc);
									?>
									<?php
										$i=1;
										while($dataRadio= mysqli_fetch_assoc($queryChoiceRadio)){
										$radioId = "radio".$dataRadio["choiceid"];
									?>
									<div class="form-inline" id="<?php echo $radioId?>">
									    <div class="form-group">
									    <label><input type="radio" class="form-control" disabled="disabled" id="buttonRadio"></label>
									    <input type='text' class='form-control' id="valRadio<?php echo $i;?>" value="<?php echo $dataRadio["choicevalue"];?>" style='width:15%;'>&nbsp;
									    <input type='text' class='form-control' id="radio<?php echo $i?>" value="<?php echo $dataRadio["choicelabel"]?>">
									    &nbsp;&nbsp;<button class='btn btn-danger' onclick="deleteRadio('<?php echo $radioId;?>');"><i class='fa fa-times'></i></button>
									    </div>
									</div>
									<?php $i++; }?>
									<?php if($dataEtc!=""){?>
									<div class='form-inline' id='radioEtc'><div class='form-group'>
									<label><input type='radio' class='form-control' disabled='disabled' id='radioEtc'>&nbsp;&nbsp;</label>
									<input type='text' class='form-control' id='valueRadioEtc' value="<?php echo $dataEtc["choicevalue"]?>" style='width:15%;'>&nbsp;&nbsp;
									<span>อื่นๆ : <span><input type='text' class='form-control' id='textRadioEtc' disabled='disabled' >
									&nbsp;&nbsp;<button class='btn btn-danger' onclick=deleteRadio();><i class='fa fa-times'></i></button>
									</div></div>
									<?php }?>
								<div id="radioShow">
								</div>
								<div id="radioShowEtc">
								</div>
							</div>
						    
						    </div>
					
					        <div class="col-lg-6 col-lg-offset-2" >
						    <button class="btn btn-primary" onclick="addRadiobox();"><i class="fa fa-plus"></i> คลิ้กเพื่อเพิ่มตัวเลือก</button>
						    &nbsp;&nbsp;หรือ<a onclick="addRadioboxEtc();" style='cursor:pointer;'> เพื่มตัวเลือก "อื่นๆ" </a>
					    </div>
						</div>
				    </div>
				    <br><br>
				    <div class="row">
					<div class="col-lg-12">
					    <button type="button" class="btn btn-primary" onclick="editQuestion('<?php echo $dataField["fieldid"];;?>');">เสร็จสิ้น</button>
					</div>
				    </div>
			    </div>
		</div>

        <?php 
    }
    if($typeQuestion=="checkbox"){
        ?>
                	<div class="panel-body2" id="editpanel<?php echo $id;?>" style="">
                        <h4>แก้ไข</h4>
                        <code>Item id <?php echo $id;?></code>
			<hr style="border:1px #AAAAAA solid;">
			    <div class="panel-heading" style="height: auto;">
				<div class="editIPanel" style="float:right;font-size:16px;cursor: pointer">
				    <button class="btn btn-default" disabled="disabled"><i class="fa fa-pencil"></i></button>
				    <button class="btn btn-default" onclick="delFormFnc('item_<?php echo $dataField["fieldid"]?>','<?php echo $dataTable["tablename"]; ?>','<?php echo $dataField["fieldvalue"]?>')"><i class="fa fa-trash-o"></i></button>
				</div>
				    <div class="row">
					<div class="col-lg-2">
					    <p>หัวข้อคำถาม</p><code id="nameError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="nameQuestion2" placeholder="คำถามไม่ระบุหัวข้อ" value="<?php echo $dataField["fieldname"];?>">
					</div>
				    </div><br>
				     <div class="row">
					<div class="col-lg-2">
					    <p>ตัวแปร</p><code id="valueError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="valQuestion2" placeholder="" value="<?php echo $dataField["fieldvalue"]?>">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ข้อความช่วยเหลือ</p>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="helpQuestion2" value="<?php  echo $dataField["fieldhelp"]?>">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ประเภทคำถาม</p>
					</div>
					<div class="col-lg-4">
					    <select class="form-control" id="typeQuestion2" onchange="selectTypeQuestion($(this).val());">
						<option value="0" >- กรุณาเลือกประเภทคำถาม -</option>
						<option value="text" >Text</option>
						<option value="heading">Heading Text</option>
						<option value="textarea" >Paragraph text</option>
						<option value="radiobox" >Multiple choice</option>
						<option value="checkbox" selected>Checkbox</option>
						<option value="select" >Choose from list</option>
						<option value="date">Date</option>
						<option value="time">Time</option>
						<option value="datetime" >Date & Time</option>
						<option value="dbthailand">Province/ District/ Subdistrict</option>
					    </select>
					</div>
				    </div>
				    <div class="row"  id="exampleEform">
					<br>
					<div class="col-lg-6 col-lg-offset-2" >
							    <?php
									    $sqlChoiceCheckbox = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY choiceid ";
									    $queryChoiceCheckbox = mysqli_query($con,$sqlChoiceCheckbox);
									    $sqlChoiceCheckboxEtc = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='1' ";
									    $queryChoiceCheckboxEtc = mysqli_query($con,$sqlChoiceCheckboxEtc);
									    $dataEtc = mysqli_fetch_assoc($queryChoiceCheckboxEtc);
									?>
									<?php
										$i=1;
										while($dataCheckbox= mysqli_fetch_assoc($queryChoiceCheckbox)){
										$checkboxId = "checkbox".$dataCheckbox["choiceid"];
									?>
									<div class="form-inline" id="<?php echo $checkboxId?>">
									    <div class="form-group">
									    <label><input type="checkbox" class="form-control" disabled="disabled" id="buttonCheckbox"></label>
									    <input type='text' class='form-control' id="valCheckbox<?php echo $i;?>" value="<?php echo $dataCheckbox["choicevalue"];?>" style='width:20%;'>&nbsp;
									    <input type='text' class='form-control' id="checkbox<?php echo $i?>" value="<?php echo $dataCheckbox["choicelabel"]?>">
									    &nbsp;&nbsp;<button class='btn btn-danger' onclick="deletecheckbox('<?php echo $checkboxId;?>');"><i class='fa fa-times'></i></button>
									    </div>
									</div>
									<?php $i++; }?>
									<?php if($dataEtc!=""){?>
									<div class='form-inline' id='checkboxEtc'><div class='form-group'>
									<label><input type='checkbox' class='form-control' disabled='disabled' id='checkboxEtc'>&nbsp;&nbsp;</label>
									<input type='text' class='form-control' id='valCheckboxEtc' value="<?php echo $dataEtc["choicevalue"]?>" style='width:15%;'>&nbsp;&nbsp;
									<span>อื่นๆ : <span><input type='text' class='form-control' id='textCheckboxEtc' disabled='disabled' >
									&nbsp;&nbsp;<button class='btn btn-danger' onclick=deletecheckbox();><i class='fa fa-times'></i></button>
									</div></div>
									<?php }?>
						<div id="checkboxShow">
						</div>
						<div id="checkboxShowEtc">
						</div>
						</div>

				    <div class="col-lg-6 col-lg-offset-2" >
					    <button class="btn btn-primary" onclick="addCheckbox();"><i class="fa fa-plus"></i> คลิ้กเพื่อเพิ่มตัวเลือก</button>
					    &nbsp;&nbsp;หรือ<a onclick="addCheckboxEtc();" style='cursor:pointer;'> เพื่มตัวเลือก "อื่นๆ" </a>
				    </div>
							    </div>
			    </div>
				    <div class="row">
					<div class="col-lg-12">
					    <button type="button" class="btn btn-primary" onclick="editQuestion('<?php echo $dataField["fieldid"];;?>');">เสร็จสิ้น</button>
					</div>
				    </div>

		</div>

        <?php 
    }
    if($typeQuestion=="select"){
        ?>
                <div class="panel-body2" id="editpanel<?php echo $id;?>" style="">
                        <h4>แก้ไข</h4>
			<hr style="border:1px #AAAAAA solid;">
			    <div class="panel-heading" style="height: auto;">
				<div class="editIPanel" style="float:right;font-size:16px;cursor: pointer">
				    <button class="btn btn-default" disabled="disabled"><i class="fa fa-pencil"></i></button>
				    <button class="btn btn-default" onclick="delFormFnc('item_<?php echo $dataField["fieldid"]?>','<?php echo $dataTable["tablename"]; ?>','<?php echo $dataField["fieldvalue"]?>')"><i class="fa fa-trash-o"></i></button>
				</div>
				    <div class="row">
					<div class="col-lg-2">
					    <p>หัวข้อคำถาม</p><code id="nameError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="nameQuestion2" placeholder="คำถามไม่ระบุหัวข้อ" value="<?php echo $dataField["fieldname"];?>">
					</div>
				    </div><br>
				     <div class="row">
					<div class="col-lg-2">
					    <p>ตัวแปร</p><code id="valueError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="valQuestion2" placeholder="" value="<?php echo $dataField["fieldvalue"];?>" style="width:20%">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ข้อความช่วยเหลือ</p>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="helpQuestion2" value="<?php echo $dataField["fieldhelp"]?>">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ประเภทคำถาม</p>
					</div>
					<div class="col-lg-4">
					    <select class="form-control" id="typeQuestion2" onchange="selectTypeQuestion($(this).val());">
						<option value="0" >- กรุณาเลือกประเภทคำถาม -</option>
						<option value="text" >Text</option>
						<option value="heading">Heading Text</option>
						<option value="textarea" >Paragraph text</option>
						<option value="radiobox">Multiple choice</option>
						<option value="checkbox">Checkbox</option>
						<option value="select" selected>Choose from list</option>
						<option value="date">Date</option>
						<option value="time">Time</option>
						<option value="datetime" >Date & Time</option>
						<option value="dbthailand">Province/ District/ Subdistrict</option>
					    </select>
					</div>
				    </div>
				    <br>
					<div class="row" id="exampleEform">
					    <div class="col-lg-6 col-lg-offset-2" id="inputSelect">

<?php
                    $sqlChoiceSelect = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY choiceid ";
                    $queryChoiceSelect = mysqli_query($con,$sqlChoiceSelect);
            ?>
                            <?php
                                    $i=1;
                                    while($dataSelect= mysqli_fetch_assoc($queryChoiceSelect)){
                                    $selectId = "select".$dataSelect["choiceid"];
                            ?>
                            <div class="form-inline" id="<?php echo $selectId?>">
                                <div class="form-group">
                                <label id="select"><?php echo $i;?>. &nbsp;&nbsp;</label>
                                <input type='text' class='form-control' id="valSelect<?php echo $i;?>" value="<?php echo $dataSelect["choicevalue"];?>" style='width:15%;'>
                                <input type='text' class='form-control' id="select<?php echo $i?>" value="<?php echo $dataSelect["choicelabel"]?>">
                                &nbsp;<button class='btn btn-danger' onclick="deleteSelect('<?php echo $selectId;?>');"><i class='fa fa-times'></i></button>
                                </div>
					    </div>
                            <?php $i++; }?>
			    
						    <div id="selectShow">
						    </div>
						</div>
					<br><br>
					<div class="col-lg-6 col-lg-offset-2" >
					<br>
					    <button class="btn btn-primary" onclick="addSelect();"><i class="fa fa-plus"></i> คลิ้กเพื่อเพิ่มตัวเลือก</button>
					</div><br><br></div></div>
				    <div class="row">
					<div class="col-lg-12">
					    <button type="button" class="btn btn-primary" onclick="editQuestion('<?php echo $dataField["fieldid"];?>');">เสร็จสิ้น</button>
					</div>
				    </div>
			    </div>
		</div>

        <?php 
    }
    if($typeQuestion=="date"){
        ?>
                	<div class="panel-body2" id="editpanel<?php echo $id;?>" style="">
                        <h4>แก้ไข</h4>
			<hr style="border:1px #AAAAAA solid;">
			    <div class="panel-heading" style="height: auto;">
				<div class="editIPanel" style="float:right;font-size:16px;cursor: pointer">
				    <button class="btn btn-default" disabled="disabled"><i class="fa fa-pencil"></i></button>
				    <button class="btn btn-default" onclick="delFormFnc('item_<?php echo $dataField["fieldid"]?>','<?php echo $dataTable["tablename"]; ?>','<?php echo $dataField["fieldvalue"]?>')"><i class="fa fa-trash-o"></i></button>
				</div>
				    <div class="row">
					<div class="col-lg-2">
					    <p>หัวข้อคำถาม</p><code id="nameError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="nameQuestion2" placeholder="คำถามไม่ระบุหัวข้อ" value="<?php echo $dataField["fieldname"];?>">
					</div>
				    </div><br>
				     <div class="row">
					<div class="col-lg-2">
					    <p>ตัวแปร</p><code id="valueError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="valQuestion2" placeholder="" value="<?php echo $dataField["fieldvalue"];?>" style='width:20%'>
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ข้อความช่วยเหลือ</p>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="helpQuestion2" value="<?php echo $dataField["fieldhelp"];?>">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ประเภทคำถาม</p>
					</div>
					<div class="col-lg-4">
					    <select class="form-control" id="typeQuestion2" onchange="selectTypeQuestion($(this).val());">
						<option value="0" >- กรุณาเลือกประเภทคำถาม -</option>
						<option value="text" >Text</option>
						<option value="heading">Heading Text</option>
						<option value="textarea" >Paragraph text</option>
						<option value="radiobox">Multiple choice</option>
						<option value="checkbox">Checkbox</option>
						<option value="select">Choose from list</option>
						<option value="date" selected>Date</option>
						<option value="time">Time</option>
						<option value="datetime" >Date & Time</option>
						<option value="dbthailand">Province/ District/ Subdistrict</option>
					    </select>
					</div>
				    </div>
				    <div class="row">
					<br>
					<div id="exampleEform">
					     <div class="col-lg-6">
            <!--<div class="checkbox" style="font-size:16px;">-->
                <input type="text" class="form-control" id="date" name="date" value="__/__/____"><br><br>
                <script>
                    jQuery($con,'#date').datetimepicker({
                        timepicker:false,
                        format:'d.m.Y H:i',
                        inline:true,
                        lang:'th'
                      });
                </script>
            </div><br><br>
        </div>
        <br>
        <br>

        <input type="text" class="form-control" id="time" placeholder="__:__" style="cursor:pointer;display:none;" />

        <div>
					</div>
				    </div>
				    <br><br>
				    <div class="row">
					<div class="col-lg-12">
					    <button type="button" class="btn btn-primary" onclick="editQuestion('<?php echo $dataField["fieldid"];?>');">เสร็จสิ้น</button>
					</div>
				    </div>
			    </div>
		</div>

        <?php 
    }
    if($typeQuestion=="time"){
        ?>
                	<div class="panel-body2" id="editpanel<?php echo $id;?>" style="">
                        <h4>แก้ไข</h4>
			<hr style="border:1px #AAAAAA solid;">
			    <div class="panel-heading" style="height: auto;">
				<div class="editIPanel" style="float:right;font-size:16px;cursor: pointer">
				    <button class="btn btn-default" disabled="disabled"><i class="fa fa-pencil"></i></button>
				    <button class="btn btn-default" onclick="delFormFnc('item_<?php echo $dataField["fieldid"]?>','<?php echo $dataTable["tablename"]; ?>','<?php echo $dataField["fieldvalue"]?>')"><i class="fa fa-trash-o"></i></button>
				</div>
				    <div class="row">
					<div class="col-lg-2">
					    <p>หัวข้อคำถาม</p><code id="nameError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="nameQuestion2" placeholder="คำถามไม่ระบุหัวข้อ" value="<?php echo $dateField["fieldname"];?>">
					</div>
				    </div><br>
				     <div class="row">
					<div class="col-lg-2">
					    <p>ตัวแปร</p><code id="valueError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="valQuestion2" placeholder="" value="<?php echo $dataField["fieldvalue"]?>" style="width:20%;">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ข้อความช่วยเหลือ</p>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="helpQuestion2" value="<?php echo $dataField["fieldhelp"]?>">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ประเภทคำถาม</p>
					</div>
					<div class="col-lg-4">
					    <select class="form-control" id="typeQuestion2" onchange="selectTypeQuestion($(this).val());">
						<option value="0" >- กรุณาเลือกประเภทคำถาม -</option>
						<option value="text" >Text</option>
						<option value="textarea" >Paragraph text</option>
						<option value="radiobox">Multiple choice</option>
						<option value="checkbox">Checkbox</option>
						<option value="select">Choose from list</option>
						<option value="date">Date</option>
						<option value="time" selected>Time</option>
						<option value="datetime">Date & Time</option>
						<option value="dbthailand">Province/ District/ Subdistrict</option>
					    </select>
					</div>
				    </div>
				    <div class="row">
					<br>
					<div id="exampleEform">
					    <div class="col-lg-3">
						<input type="text" class="form-control" id="time" placeholder="" id="time" />
						<script>
						    jQuery($con,'#time').datetimepicker({
							    datepicker:false,
							    inline:true,
							    format:'H:i'
							  });
						</script>
					    </div>
					</div>
				    </div>
				    <br><br>
				    <div class="row">
					<div class="col-lg-12">
					    <button type="button" class="btn btn-primary" onclick="editQuestion('<?php echo $dataField["fieldid"];?>');">เสร็จสิ้น</button>
					</div>
				    </div>
			    </div>
		</div>

        <?php 
    }
    if($typeQuestion=="datetime"){
        ?>
                	<div class="panel-body2" id="editpanel<?php echo $id;?>" style="">
                        <h4>แก้ไข</h4>
			<hr style="border:1px #AAAAAA solid;">
			    <div class="panel-heading" style="height: auto;">
				<div class="editIPanel" style="float:right;font-size:16px;cursor: pointer">
				    <button class="btn btn-default" disabled="disabled"><i class="fa fa-pencil"></i></button>
				    <button class="btn btn-default" onclick="delFormFnc('item_<?php echo $dataField["fieldid"]?>','<?php echo $dataTable["tablename"]; ?>','<?php echo $dataField["fieldvalue"]?>')"><i class="fa fa-trash-o"></i></button>
				</div>
				    <div class="row">
					<div class="col-lg-2">
					    <p>หัวข้อคำถาม</p><code id="nameError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="nameQuestion2" placeholder="คำถามไม่ระบุหัวข้อ" value="<?php echo $dateField["fieldname"];?>">
					</div>
				    </div><br>
				     <div class="row">
					<div class="col-lg-2">
					    <p>ตัวแปร</p><code id="valueError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="valQuestion2" placeholder="" value="<?php echo $dataField["fieldvalue"]?>" style="width:20%">
					    
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ข้อความช่วยเหลือ</p>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="helpQuestion2" value="<?php echo $dataField["fieldhelp"]?>">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ประเภทคำถาม</p>
					</div>
					<div class="col-lg-4">
					    <select class="form-control" id="typeQuestion2" onchange="selectTypeQuestion($(this).val());">
						<option value="0" >- กรุณาเลือกประเภทคำถาม -</option>
						<option value="text" >Text</option>
						<option value="heading">Heading Text</option>
						<option value="textarea" >Paragraph text</option>
						<option value="radiobox">Multiple choice</option>
						<option value="checkbox">Checkbox</option>
						<option value="select">Choose from list</option>
						<option value="date">Date</option>
						<option value="time">Time</option>
						<option value="datetime" selected>Date & Time</option>
						<option value="dbthailand">Province/ District/ Subdistrict</option>
						
					    </select>
					</div>
				    </div>
				    <div class="row">
					<br>
					<div id="exampleEform">
					    <div class="col-lg-6">
						<input type="text" class="form-control" id="datetime" placeholder="" id="datetime" />
						<script>
						    jQuery($con,'#datetime').datetimepicker({
							inline:true,
							lang:'th'
							});
						</script>
					    </div>
					</div>
				    </div>
				    <br><br>
				    <div class="row">
					<div class="col-lg-12">
					    <button type="button" class="btn btn-primary" onclick="editQuestion('<?php echo $dataField["fieldid"];?>');">เสร็จสิ้น</button>
					</div>
				    </div>
			    </div>
		</div>

        <?php 
    }
?>
<?php if($typeQuestion=="dbthailand"){
        ?>
                	<div class="panel-body2" id="editpanel<?php echo $id;?>" style="">
                        <h4>แก้ไข</h4>
			<hr style="border:1px #AAAAAA solid;">
			    <div class="panel-heading" style="height: auto;">
				<div class="editIPanel" style="float:right;font-size:16px;cursor: pointer">
				    <button class="btn btn-default" disabled="disabled"><i class="fa fa-pencil"></i></button>
				    <button class="btn btn-default" onclick="delFormFnc('item_<?php echo $dataField["fieldid"]?>','<?php echo $dataTable["tablename"]; ?>','<?php echo $dataField["fieldvalue"];?>')"><i class="fa fa-trash-o"></i></button>
				</div>
				    <div class="row">
					<div class="col-lg-2">
					    <p>หัวข้อคำถาม</p><code id="nameError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="nameQuestion2" placeholder="คำถามไม่ระบุหัวข้อ" value="<?php echo $dataField["fieldname"];?>">
					</div>
				    </div><br>
				     <div class="row">
					<div class="col-lg-2">
					    <p>ตัวแปร</p><code id="valueError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="valQuestion2" placeholder="" value="<?php echo $dataField["fieldvalue"]?>" style="width:20%">
					    
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ข้อความช่วยเหลือ</p>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="helpQuestion2" value="<?php echo $dataField["fieldhelp"]?>">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ประเภทคำถาม</p>
					</div>
					<div class="col-lg-4">
					    <select class="form-control" id="typeQuestion2" onchange="selectTypeQuestion($(this).val());">
						<option value="0" >- กรุณาเลือกประเภทคำถาม -</option>
						<option value="text" >Text</option>
						<option value="heading">Heading Text</option>
						<option value="textarea" >Paragraph text</option>
						<option value="radiobox">Multiple choice</option>
						<option value="checkbox">Checkbox</option>
						<option value="select">Choose from list</option>
						<option value="date">Date</option>
						<option value="time">Time</option>
						<option value="datetime" >Date & Time</option>
						<option value="dbthailand" selected>Province/ District/ Subdistrict</option>
					    </select>
					</div>
				    </div>
				    <div class="row">
					<br>
					<div id="exampleEform">
					    <div class="col-lg-6">
						<div class="checkbox">
						    <label >
							<input type="checkbox" name="tumbonCheck" id="tumbonCheck" value="0"> ตำบล
						    </label>
						</div>
						<br>
						<?php  include("inc_dbthailand.php");?>
					    </div>
					</div>
				    </div>
				    <br><br>
				    <div class="row">
					<div class="col-lg-12">
					    <button type="button" class="btn btn-primary" onclick="editQuestion('<?php echo $dataField["fieldid"];?>');">เสร็จสิ้น</button>
					</div>
				    </div>
			    </div>
		</div>

        <?php 
    }
?>
<?php if($typeQuestion=="heading"){
        ?>
                	<div class="panel-body2" id="editpanel<?php echo $id;?>" style="">
                        <h4>แก้ไข</h4>
			<hr style="border:1px #AAAAAA solid;">
			    <div class="panel-heading" style="height: auto;">
				<div class="editIPanel" style="float:right;font-size:16px;cursor: pointer">
				    <button class="btn btn-default" disabled="disabled"><i class="fa fa-pencil"></i></button>
				    <button class="btn btn-default" onclick="delFormFnc('item_<?php echo $dataField["fieldid"]?>','<?php echo $dataTable["tablename"]; ?>','<?php echo $dataField["fieldvalue"]?>')"><i class="fa fa-trash-o"></i></button>
				</div>
				    <div class="row">
					<div class="col-lg-2">
					    <p>หัวข้อคำถาม</p><code id="nameError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="nameQuestion2" placeholder="คำถามไม่ระบุหัวข้อ" value="<?php echo $dataField["fieldname"];?>">
					</div>
				    </div><br>
				     <div class="row">
					<div class="col-lg-2">
					    <p>ตัวแปร</p><code id="valueError2"></code>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="valQuestion2" placeholder="" value="<?php echo $dataField["fieldvalue"]?>" style="width:20%">
					    
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ข้อความช่วยเหลือ</p>
					</div>
					<div class="col-lg-8">
					    <input type="text" class="form-control" id="helpQuestion2" value="<?php echo $dataField["fieldhelp"]?>">
					</div>
				    </div><br>
				    <div class="row">
					<div class="col-lg-2">
					    <p>ประเภทคำถาม</p>
					</div>
					<div class="col-lg-4">
					    <select class="form-control" id="typeQuestion2" onchange="selectTypeQuestion($(this).val());">
						<option value="0" >- กรุณาเลือกประเภทคำถาม -</option>
						<option value="text" >Text</option>
						<option value="heading" selected>Heading Text</option>
						<option value="textarea" >Paragraph text</option>
						<option value="radiobox">Multiple choice</option>
						<option value="checkbox">Checkbox</option>
						<option value="select">Choose from list</option>
						<option value="date">Date</option>
						<option value="time">Time</option>
						<option value="datetime" >Date & Time</option>
						<option value="dbthailand" >Province/ District/ Subdistrict</option>
					    </select>
					</div>
				    </div>
				    <div class="row">
					<br>
					<div id="exampleEform">
					    <div class="col-lg-12">
						      <h4>หัวข้อคำถาม</h4>
						      <hr class="hr-form">
					    </div>
					</div>
				    </div>
				    <br><br>
				    <div class="row">
					<div class="col-lg-12">
					    <button type="button" class="btn btn-primary" onclick="editQuestion('<?php echo $dataField["fieldid"];?>');">เสร็จสิ้น</button>
					</div>
				    </div>
			    </div>
		</div>

        <?php 
    }
?>
<script>

    function editQuestion(fieldid) {
        if ($("#tumbonCheck").is(":checked")) {
		var tumbon = 1;
	}else{
		var tumbon = 0;
	}
	var countRadio = $("input[id='buttonRadio']").length;
	var countRadioEtc = $("input[id='radioEtc']").length;
	var i;
	var textRadio = [];
	var valRadio = [];
	    for (i=1;i<=countRadio;i++) {
		textRadio.push($("input[id=radio"+i+"]").val());
		valRadio.push($("input[id=valRadio"+i+"]").val());
	    }
	if (countRadioEtc=="1") {
		var valRadioEtc = $("#valueRadioEtc").val();
	}
	var countCheckbox = $("input[id='buttonCheckbox']").length;
	var countCheckboxEtc = $("input[id='checkboxEtc']").length;
	var i;
	var textCheckbox = [];
	var valCheckbox = [];
	    for (i=1;i<=countCheckbox;i++) {
		textCheckbox.push($("input[id=checkbox"+i+"]").val());
		valCheckbox.push($("input[id=valCheckbox"+i+"]").val());
	    }
	if (countCheckboxEtc=="1") {
		var valCheckboxEtc = $("#valCheckboxEtc").val();
	}
	var countSelectBox = $("label[id='select']").length;
	var i;
	var textSelect = [];
	var valSelect = [];
	for (i=1;i<=countSelectBox;i++) {
		textSelect.push($("input[id='select"+i+"']").val());
		valSelect.push($("input[id='valSelect"+i+"']").val());
	}
	var arraySelect = [valSelect,textSelect];
	var arrayCheckbox = [valCheckbox,textCheckbox,valCheckboxEtc];
	var arrayRadio = [valRadio,textRadio,valRadioEtc];
        var fieldname = $("#nameQuestion2").val();
	var fieldvalueOld = "<?php echo $dataField["fieldvalue"];?>";
	var radioEtcOld = "<?php echo $dataEtc["choicevalue"];?>";
	var checkboxOld = "<?php echo $dataEtc["choicevalue"]?>";
        var fieldvalue = $("#valQuestion2").val();
        var fieldhelp = $("#helpQuestion2").val();
        var fieldtype = $("#typeQuestion2").val();
	var dbname = $("#dbname").val();
	var formid = $("#formid").val();
	    $("#nameQuestion2").keyup(function(){
                        $("#nameError2").html("");
                        $("#nameQuestion2").attr("style","border:1px #ccc solid");
	    });
	    $("#valQuestion2").keyup(function(){
		    $("#valueError2").html("");
		    $("#valQuestion2").attr("style","border:1px #ccc solid;width:20%;");
	    });
	    if (fieldname=="") {
		    //code
		    $("#nameError2").html("กรุณากรอกชื่อคำถาม");
		    $("#nameQuestion2").attr("style","border:1px red solid");
		    return ;
	    }
	    if(fieldvalue=="" ) {
		    //code
		    $("#valueError2").html("กรุณากรอกระบุตัวแปร");
		    $("#valQuestion2").attr("style","border:1px red solid;width:20%;");
		    
		    return ;
	    }
	    if (validationEng(fieldvalue)==false) {
		    //code
		    $("#valueError2").html("กรุณากรอกระบุตัวแปรที่เป็นภาษาอังกฤษหรือตัวเลขเท่านั้น");
		    $("#valQuestion2").attr("style","border:1px red solid;width:20%;");
		    return ;
	    }
	 $.ajax({
		    url: "ajax-createform-loaddata.php?task=editField",
		    type: "post",
		    data: {
				formid:formid,
				dbname:dbname,
				fieldid:fieldid,
				fieldname:fieldname,
				fieldvalueOld:fieldvalueOld,
				fieldvalue:fieldvalue,
				fieldhelp:fieldhelp,
				fieldtype:fieldtype,
				tumbon:tumbon,
				choiceRadio:arrayRadio,
				choiceRadioEtc:radioEtcOld,
				choiceCheckbox:arrayCheckbox,
				choiceCheckboxEtc:checkboxOld,
				choiceSelect:arraySelect
			    },
		    success: function(data){
			location.href="eform.php?idFormMain="+formid+"";
		    },
		    error:function(){
			alert("failure");
		    }
		});
    }
</script>