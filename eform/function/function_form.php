<?php
function formgenForUpdate($dataField,$value,$value_province,$value_amphur,$value_tumbon){
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
	    include_once  "inc_dbthailand.php";
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
?>