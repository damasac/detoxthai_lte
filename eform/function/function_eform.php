<?php
function formgenForEdit($dataField,$dataFormMain,$con){
	 if($dataField["fieldtype"]=="text"){
	    $formtext = "<div class='formItem' id='item_".$dataField["fieldid"]."' >";
	    $formtext .= "<div id='editForm'>";
	    $formtext .= "<button class='btn btn-default btn-xs' onclick=editFormFnc('item_".$dataField["fieldid"]."','".$dataField["fieldtype"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."','0');><i class='fa fa-pencil'></i></button>";
	    $formtext .= "<button class='btn btn-default btn-xs' onclick=delFormFnc('item_".$dataField["fieldid"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."')><i class='fa fa-trash-o'></i></button>";
	    $formtext .= "</div>";
	    $formtext .= "<label>".$dataField["fieldname"]."</label>";
	    $formtext .= "<code>".$dataField["fieldvalue"]."</code>";
	    $formtext .= "<input type='text' class='form-control' id='' name=''>";
	    $formtext .= "</div>";
	    return $formtext;
	 }
	 else if($dataField["fieldtype"]=="textarea"){
	    $form = "<div class='formItem' id='item_".$dataField["fieldid"]."' >";
	    $form .= "<div id='editForm'>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=editFormFnc('item_".$dataField["fieldid"]."','".$dataField["fieldtype"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."','0');><i class='fa fa-pencil'></i></button>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=delFormFnc('item_".$dataField["fieldid"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."')><i class='fa fa-trash-o'></i></button>";
	    $form .= "</div>";
	    $form .= "<label>".$dataField["fieldname"]."</label><code>".$dataField["fieldvalue"]."</code>";
	    $form .= "<textarea class='form-control' id='' name=''></textarea>";
	    $form .= "</div>";
	    return $form;
	 }else if($dataField["fieldtype"]=="radiobox"){

	    $formradio = "<div class='formItem' id='item_".$dataField["fieldid"]."' >";

	    $formradio .= "<div id='editForm'>";
	    $formradio .= "<button class='btn btn-default btn-xs' onclick=editFormFnc('item_".$dataField["fieldid"]."','".$dataField["fieldtype"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."','0');><i class='fa fa-pencil'></i></button>";
	    $formradio .= "<button class='btn btn-default btn-xs' onclick=delFormFnc('item_".$dataField["fieldid"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."')><i class='fa fa-trash-o'></i></button>";
	    $formradio .= "</div>";
	    $formradio .= "<label>".$dataField["fieldname"]."</label> <code>".$dataField["fieldvalue"]."</code><br><br>";
	    
	    $sqlRadio = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY `choiceid`";
	    $queryRadio = mysqli_query($con,$sqlRadio);
	    while($dataRadio = mysqli_fetch_assoc($queryRadio)){
		$formradio .= "<div class='radio-inline'>";
		$formradio .= "<label><input type='radio' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' value='".$dataRadio["choicevalue"]."'><code>".$dataRadio["choicevalue"]."</code>".$dataRadio["choicelabel"]."</label>";
		$formradio .= "<br><br></div>";
	    }
	    $sqlRadioEtc = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='1' ";
	    $queryRadioEtc = mysqli_query($con,$sqlRadioEtc);
	    $dataRadioEtc = mysqli_fetch_array($queryRadioEtc);
	    if(mysqli_num_rows($queryRadioEtc)!=0){
		$formradio .= "<div class='radio-inline'><label>";
		$formradio .= "<input type='radio' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' value='".$dataRadioEtc["choicevalue"]."'>".$dataRadioEtc["choicelabel"]."";
		$formradio .= "</label>&nbsp;&nbsp:<input type='text' class='' name='".$dataRadioEtc["choicevalue"]."' id='".$dataRadioEtc["choicevalue"]."'/></div>";
	    }
	    $formradio .= "</div>";
	    return $formradio;
	    
	 }
	 else if($dataField["fieldtype"]=="checkbox"){
	    $formcheckbox = "<div class='formItem' id='item_".$dataField["fieldid"]."' >";
	    $formcheckbox .= "<div id='editForm'>";
	    $formcheckbox .= "<button class='btn btn-default btn-xs' onclick=editFormFnc('item_".$dataField["fieldid"]."','".$dataField["fieldtype"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."','0');><i class='fa fa-pencil'></i></button>";
	    $formcheckbox .= "<button class='btn btn-default btn-xs' onclick=delFormFncMultiple('item_".$dataField["fieldid"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."')><i class='fa fa-trash-o'></i></button>";
	    $formcheckbox .= "</div>";
	    $formcheckbox .= "<label>".$dataField["fieldname"]."</label> <code>".$dataField["fieldvalue"]."</code><br><br>";
	    $sqlCheckbox = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY choiceid";
	    $queryCheckbox = mysqli_query($con,$sqlCheckbox);
	    while($dataCheckbox = mysqli_fetch_assoc($queryCheckbox)){
		$formcheckbox .= "<div class='checkbox-inline'>";
		$formcheckbox .= "<label><input type='checkbox' name='".$dataField["fieldvalue"]."[]' id='".$dataField["fieldvalue"]."[]' value='".$dataCheckbox["choicevalue"]."'><code>".$dataCheckbox["choicevalue"]."</code>".$dataCheckbox["choicelabel"]."</label>";
		$formcheckbox .= "<br><br></div>";
	    }
	    $sqlCheckboxEtc = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='1' ";
	    $queryCheckboxEtc = mysqli_query($con,$sqlCheckboxEtc);
	    $dataCheckboxEtc = mysqli_fetch_array($queryCheckboxEtc);
	    if(mysqli_num_rows($queryCheckboxEtc)!=0){
		$formcheckbox .= "<div class='checkbox-inline'><label>";
		$formcheckbox .= "<input type='checkbox' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldavalue"]."' value='".$dataCheckboxEtc["choicevalue"]."'>".$dataCheckboxEtc["choicelabel"]."";
		$formcheckbox .= "</label>&nbsp;&nbsp:<input type='text' class='' id='".$dataCheckboxEtc["choicevalue"]."'/></div>";
		
	    }
	    $formcheckbox .= "</div>";
	    return $formcheckbox;
	    
	 }
	else if($dataField["fieldtype"]=="select"){
	    $formselect = "<div class='formItem' id='item_".$dataField["fieldid"]."' >";
	    $formselect .= "<div id='editForm'>";
	    $formselect .= "<button class='btn btn-default btn-xs' onclick=editFormFnc('item_".$dataField["fieldid"]."','".$dataField["fieldtype"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."','0');><i class='fa fa-pencil'></i></button>";
	    $formselect .= "<button class='btn btn-default btn-xs' onclick=delFormFnc('item_".$dataField["fieldid"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."')><i class='fa fa-trash-o'></i></button>";
	    $formselect .= "</div>";
	    $formselect .= "<label>".$dataField["fieldname"]."</label> <code>".$dataField["fieldvalue"]."</code><br><br>";
            $formselect .= "<select class='form-control' id='".$dataField["fieldvalue"]."' name='".$dataField["fieldvalue"]."' style='width:auto;'>";
	    $sqlSelect = " SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY choiceid";
	    $querySelect = mysqli_query($con,$sqlSelect) or die(mysqli_error());
	    while($dataSelect = mysqli_fetch_assoc($querySelect)){
                $formselect .= "<option value='".$dataSelect["choicevalue"]."'>".$dataSelect["choicelabel"]."</option>";
	    }
            $formselect .= "</select>";
	    $formselect .= "</div>";
	    return $formselect;
	    
	 }else if($dataField["fieldtype"]=="date"){
	    $form = "<div class='formItem' id='item_".$dataField["fieldid"]."' >";
	    $form .= "<div id='editForm'>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=editFormFnc('item_".$dataField["fieldid"]."','".$dataField["fieldtype"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."','0');><i class='fa fa-pencil'></i></button>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=delFormFnc('item_".$dataField["fieldid"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."')><i class='fa fa-trash-o'></i></button>";
	    $form .= "</div>";
	    $form .= "<label>".$dataField["fieldname"]."</label> <code>".$dataField["fieldvalue"]."</code>";
	    $form .= "<input type='text' class='form-control' data-attr='date' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' style='cursor:pointer;width:auto;' placeholder='__/__/____'>";
	    $form .= "</div>";
	    return $form;
	 }
	else if($dataField["fieldtype"]=="time"){
	    $form = "<div class='formItem' id='item_".$dataField["fieldid"]."' >";
	    $form .= "<div id='editForm'>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=editFormFnc('item_".$dataField["fieldid"]."','".$dataField["fieldtype"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."','0');><i class='fa fa-pencil'></i></button>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=delFormFnc('item_".$dataField["fieldid"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."')><i class='fa fa-trash-o'></i></button>";
	    $form .= "</div>";
	    $form .= "<label>".$dataField["fieldname"]."</label> <code>".$dataField["fieldvalue"]."</code>";
	    $form .= "<input type='text' class='form-control' data-attr='time' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' style='cursor:pointer;width:auto;' placeholder='__:__'>";
	    $form .= "</div>";
	    return $form;
	 }
	else if($dataField["fieldtype"]=="datetime"){
	    $form = "<div class='formItem' id='item_".$dataField["fieldid"]."' >";
	    $form .= "<div id='editForm'>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=editFormFnc('item_".$dataField["fieldid"]."','".$dataField["fieldtype"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."','0');><i class='fa fa-pencil'></i></button>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=delFormFnc('item_".$dataField["fieldid"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."')><i class='fa fa-trash-o'></i></button>";
	    $form .= "</div>";
	    $form .= "<label>".$dataField["fieldname"]."</label> <code>".$dataField["fieldvalue"]."</code>";
	    $form .= "<input type='text' class='form-control' data-attr='datetime' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' style='cursor:pointer;width:auto;' placeholder='__/__/____  __:__'>";
	    $form .= "</div>";
	    return $form;
	 }else if($dataField["fieldtype"]=="dbthailand"){
	    $form = "<div class='formItem' id='item_".$dataField["fieldid"]."' >";
	    $form .= "<div id='editForm'>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=editFormFnc('item_".$dataField["fieldid"]."','".$dataField["fieldtype"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."','0');><i class='fa fa-pencil'></i></button>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=delFormFnc('item_".$dataField["fieldid"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."')><i class='fa fa-trash-o'></i></button>";
	    $form .= "</div>";
	    $form .= "<label>".$dataField["fieldname"]."</label> <code>".$dataField["fieldvalue"]."</code>";
	    $form .= "<div class='row'>";
	    $form .= "<div class='col-lg-3'><select class='form-control'><option value=''>จังหวัด</option value=''></select></div>";
	    $form .= "<div class='col-lg-3'><select class='form-control'><option value=''>อำเภอ</option value=''></select></div>";
	    if($dataField["haveTumbon"]==1){
	    $form .= "<div class='col-lg-3'><select class='form-control'><option value=''>ตำบล</option value=''></select></div>";
	    }
	    $form .= "</div></div>";
	    return $form;
	 }else if($dataField["fieldtype"]=="heading"){
	     $form = "<div class='formItem' id='item_".$dataField["fieldid"]."'>";
	    $form .= "<div id='editForm'>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=editFormFnc('item_".$dataField["fieldid"]."','".$dataField["fieldtype"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."','0');><i class='fa fa-pencil'></i></button>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=delFormFnc('item_".$dataField["fieldid"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."')><i class='fa fa-trash-o'></i></button>";
	    $form .= "</div>";
	    $form .= "";
	    $form .=  "<h4>".$dataField["horder"]." . ".$dataField["fieldname"]."</h4>";
	    $form .= "<hr class='hr-form'>";
	    $form .= "";
	    $form .= "</div>";
	    
	    return $form;
	 }else if($dataField["fieldtype"]=="radiotextbox"){
	     $form = "<div class='formItem' id='item_".$dataField["fieldid"]."'>";
	    $form .= "<div id='editForm'>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=editFormFnc('item_".$dataField["fieldid"]."','".$dataField["fieldtype"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."','0');><i class='fa fa-pencil'></i></button>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=delFormFncMultiple('item_".$dataField["fieldid"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."')><i class='fa fa-trash-o'></i></button>";
	    $form .= "</div>";
	    $form .= "<label>".$dataField["fieldname"]."</label> <code>".$dataField["fieldvalue"]."</code>";
	    $sqlRadioText = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY `choiceid`";
	    $queryRadioText = mysqli_query($con,$sqlRadioText);
	    while($dataRadioText = mysqli_fetch_assoc($queryRadioText)){
		$form .= "<div class='radio'>";
		$form .= "<label><input type='radio' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' value='".$dataRadioText["choicevalue"]."'><code>".$dataRadioText["choicevalue"]."</code>".$dataRadioText["choicelabel"]."";
		$form .= "<input type='text' class='form-control' value='' name='".$dataRadioText["choicevalue"]."' id='".$dataRadioText["choicevalue"]."'></label>";
		$form .= "<br><br></div>";
	    }
	    $form .= "</div>";
	    return $form;
	 }
	 else if($dataField["fieldtype"]=="headsub"){
	    
	    $form = "<div class='formItem' id='item_".$dataField["fieldid"]."' >";
	    $form .= "<div id='editForm'>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=editFormFnc('item_".$dataField["fieldid"]."','".$dataField["fieldtype"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."','0');><i class='fa fa-pencil'></i></button>";
	    $form .= "<button class='btn btn-default btn-xs' onclick=delFormFnc('item_".$dataField["fieldid"]."','".$dataFormMain["tablename"]."','".$dataField["fieldvalue"]."')><i class='fa fa-trash-o'></i></button>";
	    $form .= "</div>";
	    $form .= "";
	    $form .=  "<h3 style='padding-left:10px;'>".$dataField["fieldname"]."</h3>";
	    $form .= "";
	    $form .= "</div>";
	    return $form; 
	 }
    }
    
    ///////////////////////////////////////////////////
    ///////////////////////////////////////////////////
    ///////////////////////////////////////////////////
    ///////////////////////////////////////////////////
    ///////////////////////////////////////////////////
    ///////////////////////////////////////////////////
    ///////////////////////////////////////////////////
    ///////////////////////////////////////////////////
    
    
function formgenForShow($i,$dataField){
	 if($dataField["fieldtype"]=="text"){
	    $formtext = "<label>".$dataField["fieldname"]."</label>";
	    $formtext .= "<input type='text' class='form-control' id='".$dataField["fieldvalue"]."' name='".$dataField["fieldvalue"]."'>";
	    return $formtext;
	 }
	 else if($dataField["fieldtype"]=="textarea"){
	    $formtextarea = "<label>".$dataField["fieldname"]."</label>";
	    $formtextarea .= "<textarea class='form-control' id='".$dataField["fieldvalue"]."' name='".$dataField["fieldvalue"]."'></textarea>";
	    return $formtextarea;
	 }else if($dataField["fieldtype"]=="radiobox"){
	    $formradio = "<label>".$dataField["fieldname"]."</label><br><br>";
	    $sqlRadio = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY `choiceid`";
	    $queryRadio = mysqli_query($con,$sqlRadio);
	    while($dataRadio = mysqli_fetch_assoc($queryRadio)){
		$formradio .= "<div class='radio-inline'>";
		$formradio .= "<label><input type='radio' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' value='".$dataRadio["choicevalue"]."'>".$dataRadio["choicelabel"]."</label>";
		$formradio .= "<br></div>";
	    }
	    $sqlRadioEtc = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='1' ";
	    $queryRadioEtc = mysqli_query($con,$sqlRadioEtc);
	    $dataRadioEtc = mysqli_fetch_array($queryRadioEtc);
	    if(mysqli_num_rows($queryRadioEtc)!=0){
		$formradio .= "<div class='radio-inline'><label>";
		$formradio .= "<input type='radio' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' value='".$dataRadioEtc["choicevalue"]."'>".$dataRadioEtc["choicelabel"]."";
		$formradio .= "</label>&nbsp;&nbsp<input type='text' class='' name='".$dataRadioEtc["choicevalue"]."' id='".$dataRadioEtc["choicevalue"]."'/></div>";
		
	    }
	    return $formradio;
	    
	 }
	 else if($dataField["fieldtype"]=="checkbox"){
	    $formcheckbox = "<label>".$dataField["fieldname"]."</label><br><br>";
	    $sqlCheckbox = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY choiceid";
	    $queryCheckbox = mysqli_query($con,$sqlCheckbox);
	    while($dataCheckbox = mysqli_fetch_assoc($queryCheckbox)){
		$formcheckbox .= "<div class='checkbox-inline'>";
		$formcheckbox .= "<label><input type='checkbox' name='".$dataCheckbox["choicevalue"]."' id='".$dataCheckbox["choicevalue"]."' value='".$dataCheckbox["choicelabel"]."'>".$dataCheckbox["choicelabel"]."</label>";
		$formcheckbox .= "<br></div>";
	    }
	    $sqlCheckboxEtc = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='1' ";
	    $queryCheckboxEtc = mysqli_query($con,$sqlCheckboxEtc);
	    $dataCheckboxEtc = mysqli_fetch_array($queryCheckboxEtc);
	    if(mysqli_num_rows($queryCheckboxEtc)!=0){
		$formcheckbox .= "<div class='checkbox-inline'><label>";
		$formcheckbox .= "<input type='checkbox' name='".$dataField["fieldvalue"]."[]' id='".$dataField["fieldvalue"]."[]' value='".$dataCheckboxEtc["choicevalue"]."'>".$dataCheckboxEtc["choicelabel"]."";
		$formcheckbox .= "</label>&nbsp;&nbsp;<input type='text' class='' name='".$dataCheckboxEtc["choicevalue"]."' id='".$dataCheckboxEtc["choicevalue"]."'/></div>";
		
	    }
	    return $formcheckbox;
	    
	 }
	else if($dataField["fieldtype"]=="select"){
	    $formselect = "<label>".$dataField["fieldname"]."</label><br><br>";
            $formselect .= "<select class='form-control' id='".$dataField["fieldvalue"]."' name='".$dataField["fieldvalue"]."' style='width:auto;'>";
	    $sqlSelect = " SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY choiceid";
	    $querySelect = mysqli_query($con,$sqlSelect) or die(mysqli_error());
	    while($dataSelect = mysqli_fetch_assoc($querySelect)){
                $formselect .= "<option value='".$dataSelect["choicevalue"]."'>".$dataSelect["choicelabel"]."</option>";
	    }
            $formselect .= "</select>";
	    return $formselect;
	    
	 }else if($dataField["fieldtype"]=="date"){
	    $formtextarea = "<label>".$dataField["fieldname"]."</label>";
	    $formtextarea .= "<input type='text' class='form-control' data-attr='date' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' style='cursor:pointer;width:auto;' placeholder='__/__/____'>";
	    return $formtextarea;
	 }
	else if($dataField["fieldtype"]=="time"){
	    $formtextarea = "<label>".$dataField["fieldname"]."</label>";
	    $formtextarea .= "<input type='text' class='form-control' data-attr='time' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' style='cursor:pointer;width:auto;' placeholder='__:__'>";
	    return $formtextarea;
	 }
	else if($dataField["fieldtype"]=="datetime"){
	    $formtextarea = "<label>".$dataField["fieldname"]."</label>";
	    $formtextarea .= "<input type='text' class='form-control' data-attr='datetime' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' style='cursor:pointer;width:auto;' placeholder='__/__/____  __:__'>";
	    return $formtextarea;
	 }
	 else if($dataField["fieldtype"]=="dbthailand"){
	    include("inc_dbthailand_show.php");
	    ?>
	    <?php
	 }
	 else if($dataField["fieldtype"]=="heading"){
	    $form .= "<div class='heading-form'>";
	    $form .=  "<h4>".$dataField["horder"]." . ".$dataField["fieldname"]."</h4>";
	    $form .= "<hr class='hr-form'>";
	    $form .= "</div>";
	    return $form;
	 }else if($dataField["fieldtype"]=="radiotextbox"){
	    $form = "<label>".$dataField["fieldname"]."</label> <code>".$dataField["fieldvalue"]."</code>";
	    $sqlRadioText = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY `choiceid`";
	    $queryRadioText = mysqli_query($con,$sqlRadioText);
	    while($dataRadioText = mysqli_fetch_assoc($queryRadioText)){
		$form .= "<div class='radio'>";
		$form .= "<label><input type='radio' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' value='".$dataRadioText["choicevalue"]."'><code>".$dataRadioText["choicevalue"]."</code>".$dataRadioText["choicelabel"]."";
		$form .= "<input type='text' class='form-control' value='' name='".$dataRadioText["choicevalue"]."' id='".$dataRadioText["choicevalue"]."'></label>";
		$form .= "<br><br></div>";
	    }
	    $form .= "</div>";
	    return $form;
	 }
	 	 else if($dataField["fieldtype"]=="headsub"){
	    
	    $form .= "";
	    $form .=  "<h3 style='padding-left:20px;'>".$dataField["fieldname"]."</h3>";
	    $form .= "";
	    return $form; 
	 }

    }
    

function formgenForUpdate($con,$i,$dataField,$value,$value_province,$value_amphur,$value_tumbon){
	 if($dataField["fieldtype"]=="text"){
	    $formtext = "<label>".$dataField["fieldname"]."</label>";
	    $formtext .= "<input type='text' class='form-control' id='".$dataField["fieldvalue"]."' name='".$dataField["fieldvalue"]."' value='".$value."'>";
	    return $formtext;
	 }
	 else if($dataField["fieldtype"]=="textarea"){
	    $formtextarea = "<label>".$dataField["fieldname"]."</label>";
	    $formtextarea .= "<textarea class='form-control' id='".$dataField["fieldvalue"]."' name='".$dataField["fieldvalue"]."'>".$value."</textarea>";
	    return $formtextarea;
	 }else if($dataField["fieldtype"]=="radiobox"){
	
	    $formradio = "<label>".$dataField["fieldname"]."</label><br><br>";
	    
	    $sqlRadio = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY `choiceid`";
	    
	    $queryRadio = mysqli_query($con,$sqlRadio);
	    
	    while($dataRadio = mysqli_fetch_assoc($queryRadio)){
		if($dataRadio["choicevalue"]==$value){
			$check = "checked";
		}else{
			$check = "";
		}
		$formradio .= "<div class='radio-inline'>";
		$formradio .= "<label>
		<input type='radio' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' value='".$dataRadio["choicevalue"]."'
		".$check."
		>".$dataRadio["choicelabel"]."</label>";
		$formradio .= "<br></div>";
		
	    }
	    $sqlRadioEtc = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='1' ";
	    $queryRadioEtc = mysqli_query($con,$sqlRadioEtc);
	    $dataRadioEtc = mysqli_fetch_array($queryRadioEtc);
	    if(mysqli_num_rows($queryRadioEtc)!=0){
		$formradio .= "<div class='radio-inline'><label>";
		$formradio .= "<input type='radio' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' value='".$dataRadioEtc["choicevalue"]."'>".$dataRadioEtc["choicelabel"]."";
		$formradio .= "</label>&nbsp;&nbsp;<input type='text' class='' name='".$dataRadioEtc["choicevalue"]."' id='".$dataRadioEtc["choicevalue"]."'/></div>";
	    }
	    
	    return $formradio;
	    
	 }
	 else if($dataField["fieldtype"]=="checkbox"){
	    $formcheckbox = "<label>".$dataField["fieldname"]."</label><br><br>";
	    $sqlCheckbox = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY choiceid";
	    $queryCheckbox = mysqli_query($con,$sqlCheckbox);
	    while($dataCheckbox = mysqli_fetch_assoc($queryCheckbox)){
		$formcheckbox .= "<div class='checkbox-inline'>";
		$formcheckbox .= "<label><input type='checkbox' name='".$dataCheckbox["choicevalue"]."' id='".$dataCheckbox["choicevalue"]."' value='".$dataCheckbox["choicelabel"]."'>".$dataCheckbox["choicelabel"]."</label>";
		$formcheckbox .= "<br></div>";
	    }
	    $sqlCheckboxEtc = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='1' ";
	    $queryCheckboxEtc = mysqli_query($con,$sqlCheckboxEtc);
	    $dataCheckboxEtc = mysqli_fetch_array($queryCheckboxEtc);
	    if(mysqli_num_rows($queryCheckboxEtc)!=0){
		$formcheckbox .= "<div class='checkbox-inline'><label>";
		$formcheckbox .= "<input type='checkbox' name='".$dataField["fieldvalue"]."[]' id='".$dataField["fieldvalue"]."[]' value='".$dataCheckboxEtc["choicevalue"]."'>".$dataCheckboxEtc["choicelabel"]."";
		$formcheckbox .= "</label>&nbsp;&nbsp:<input type='text' class='' name='".$dataCheckboxEtc["choicevalue"]."' id='".$dataCheckboxEtc["choicevalue"]."'/></div>";
		
	    }
	    return $formcheckbox;
	    
	 }
	else if($dataField["fieldtype"]=="select"){
	    $formselect = "<label>".$dataField["fieldname"]."</label><br><br>";
            $formselect .= "<select class='form-control' id='".$dataField["fieldvalue"]."' name='".$dataField["fieldvalue"]."' style='width:auto;'>";
	    $sqlSelect = " SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY choiceid";
	    $querySelect = mysqli_query($con,$sqlSelect) or die(mysqli_error());
	    while($dataSelect = mysqli_fetch_assoc($querySelect)){
                $formselect .= "<option value='".$dataSelect["choicevalue"]."'>".$dataSelect["choicelabel"]."</option>";
	    }
            $formselect .= "</select>";
	    return $formselect;
	    
	 }else if($dataField["fieldtype"]=="date"){
	    $formtextarea = "<label>".$dataField["fieldname"]."</label>";
	    $formtextarea .= "<input type='text' class='form-control' data-attr='date' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' style='cursor:pointer;width:auto;' placeholder='__/__/____' value='".$value."'>";
	    return $formtextarea;
	 }
	else if($dataField["fieldtype"]=="time"){
	    $formtextarea = "<label>".$dataField["fieldname"]."</label>";
	    $formtextarea .= "<input type='text' class='form-control' data-attr='time' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' style='cursor:pointer;width:auto;' placeholder='__:__' value='".$value."'>";
	    return $formtextarea;
	 }
	else if($dataField["fieldtype"]=="datetime"){

	    $formtextarea = "<label>".$dataField["fieldname"]."</label>";
	    $formtextarea .= "<input type='text' class='form-control' data-attr='datetime' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' style='cursor:pointer;width:auto;' placeholder='__/__/____  __:__' value='".$value."'>";
	    return $formtextarea;
	 }
	 else if($dataField["fieldtype"]=="dbthailand"){
	    include_once  "inc_dbthailand_show2.php";
	 }
	 else if($dataField["fieldtype"]=="heading"){
	    $form .= "<div class='heading-form'>";
	    $form .=  "<h4>".$dataField["horder"]." . ".$dataField["fieldname"]."</h4>";
	    $form .= "<hr class='hr-form'>";
	    $form .= "</div>";
	    return $form;
	 }else if($dataField["fieldtype"]=="radiotextbox"){
	    $form = "<label>".$dataField["fieldname"]."</label> <code>".$dataField["fieldvalue"]."</code>";
	    $sqlRadioText = "SELECT * FROM `formchoice` WHERE fieldid='".$dataField["fieldid"]."' AND choiceetc='0' ORDER BY `choiceid`";
	    $queryRadioText = mysqli_query($con,$sqlRadioText);
	    while($dataRadioText = mysqli_fetch_assoc($queryRadioText)){
		$form .= "<div class='radio'>";
		$form .= "<label><input type='radio' name='".$dataField["fieldvalue"]."' id='".$dataField["fieldvalue"]."' value='".$dataRadioText["choicevalue"]."'><code>".$dataRadioText["choicevalue"]."</code>".$dataRadioText["choicelabel"]."";
		$form .= "<input type='text' class='form-control' value='' name='".$dataRadioText["choicevalue"]."' id='".$dataRadioText["choicevalue"]."'></label>";
		$form .= "<br><br></div>";
	    }
	    $form .= "</div>";
	    return $form;
	 }
        else if($dataField["fieldtype"]=="headsub"){
	    $form .= "";
	    $form .=  "<h3 style='padding-left:20px;'>".$dataField["fieldname"]."</h3>";
	    $form .= "";
	    return $form; 
	 }

    }

function make_seed()
{
	  list($usec, $sec) = explode(' ', microtime());
	  return (float) $sec + ((float) $usec * 100000);
}

?>