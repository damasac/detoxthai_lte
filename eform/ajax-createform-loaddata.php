<?php
   include "../_connection/db_eform.php";
   error_reporting(0);
   $task = $_GET["task"];
   $id =  $_POST["id"];
   $field = $_POST["field"];
   $value = $_POST["val"];
   $formid = mysqli_real_escape_string($con,$_POST["formid"]);
   $dbname = $_POST["dbname"];
   $fieldtype = $_POST["fieldtype"];
   $fieldvalue = $_POST["fieldvalue"];
   $useradd = $_POST["useradd"];
   if($task=="deleteDataTable"){
      $sqlDeleteData = "DELETE FROM `tbdata_".$_POST["formid"]."` WHERE id='".$_POST["id"]."' ";

      mysqli_query($con,$sqlDeleteData) ;
      exit;
   }
   if($task=="shareform"){
      $sqlUpdateShare = "UPDATE `formmain` SET
         `status_share`='".$_POST["status_share"]."',
         `public_add`='".$_POST["add_to_patient"]."',
         `public_view`='".$_POST["view_share"]."',
         `public_edit`='".$_POST["edit_share"]."',
         `public_delete`='".$_POST["delete_share"]."'
         WHERE formid='".$_POST["id"]."'
      ";
      $queryUpdateShare = mysqli_query($con,$sqlUpdateShare) or die(mysqli_error());
      if($queryUpdateShare){
         return true;
      }
   }
   if($task=="checkField"){
      $sqlField = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='".$dbname."'";
      $queryField = mysqli_query($con,$sqlField);
      $listField = array();
      while($dataField = mysqli_fetch_assoc($queryField)){
         foreach($dataField as $data){
            $listfield[] = $data;
         }
      }
      
      if(in_array($_POST["valQuestion"],$listfield)){
         echo "0";
      }else{
         echo "1";
      }
   }
 if($_GET["task"]=="createForm"){
    $sqlCreateDB = "
      CREATE TABLE `tbdata_".$id."`(
         `id` int(11) NOT NULL,
         `rstat` int(11) DEFAULT NULL,
         `useradd` VARCHAR(50) DEFAULT  NULL,
         `dadd` VARCHAR(50) DEFAULT NULL,
         `userupdate` VARCHAR(50) DEFAULT  NULL,
         `dupdate` VARCHAR(50) DEFAULT NULL,
         PRIMARY KEY (id)
      )ENGINE=MyISAM DEFAULT CHARSET=utf8
    ";
    $datenow = date("Y-m-d H:i:s");
    $queryCreateDB = mysqli_query($con,$sqlCreateDB);
    $sqlCreateForm = "INSERT INTO formmain(databaseid,formname,formdesc,tablename,pid,createdate,status_share,public_add,public_edit,public_delete)
    VALUES('".$id."','ฟอร์มไม่มีชื่อ','คำอธิบายฟอร์ม','tbdata_".$id."','".$useradd."','".$datenow."','0','1','1','1')";
 
    $queryCreateForm = mysqli_query($con,$sqlCreateForm) or die(mysqli_error()."$datenow");
    $sqlCreateFormId = mysqli_insert_id($con);
    echo $sqlCreateFormId;
    
 }
 if($task=="delDatabase"){
   $sqlDeleteForm = mysqli_query($con,"DELETE FROM `formmain` WHERE formid='".$id."' ") or die(mysqli_error());
   $sqlDeleteField = mysqli_query($con,"DELETE FROM `formfield` WHERE formid='".$id."' ") or die(mysqli_error());
   $sqlDeleteChoice = mysqli_query($con,"DELETE FROM `formchoice` WHERE formid='".$id."' ") or die(mysqli_error());
   $sqlDropDatabase = mysqli_query($con,"DROP TABLE `".$dbname."`") or die(mysqli_error());
 }
 if($task=="updateFormmain"){
   $sqlUpdateForm = "UPDATE formmain SET ".$field." = '".$value."' WHERE formid='".$id."' ";
   //echo $sqlUpdateForm;
   $queryUpdateForm = mysqli_query($con,$sqlUpdateForm);
   if($queryUpdateForm){
      return true;
   }
   else{
      return false;
   }
 }

 if($task=="deleteField"){
   
   $sqlSelectField = "SELECT * FROM `formfield` WHERE fieldid='".$_POST["idDb"]."' ";
   $querySelectField = mysqli_query($con,$sqlSelectField) or die(mysqli_error());
   $dataSField = mysqli_fetch_assoc($querySelectField);
   $sqlDeleteField = "DELETE FROM `formfield` WHERE fieldid='".$_POST["idDb"]."' ";
   $queryDeleteField = mysqli_query($con,$sqlDeleteField) or die(mysqli_error());
   
   if($dataSField["valueprovince"]!=""){
      if($dataSField["haveTumbon"]==1){
         $sql1 = "ALTER TABLE `".$dbname."`
                     DROP  `".$dataSField["valueprovince"]."`,
                     DROP `".$dataSField["valueamphur"]."`,
                     DROP `".$dataSField["valuetumbon"]."`
                     ";
                     echo $sql1;
         mysqli_query($con,$sql1)or die(mysqli_error());
      }else{
         $sql2 = "ALTER TABLE `".$dbname."`
                     DROP  `".$dataSField["valueprovince"]."`,
                     DROP `".$dataSField["valueamphur"]."`
                     ";
                     echo $sql2;
         mysqli_query($con,$sql2)or die(mysqli_error());
      }
      exit;
   }else{
      $sqlDeleleChoice = "DELETE FROM `formchoice` WHERE fieldid='".$_POST["idDb"]."' ";
      $sqlDeleteColumn = "ALTER TABLE `".$dbname."` DROP COLUMN `".$fieldvalue."`";

      $queryDeleteChoice = mysqli_query($con,$sqlDeleleChoice) or die(mysqli_error());
      $queryDeleteCoulmn = mysqli_query($con,$sqlDeleteColumn) or die(mysqli_error());
      deleteAlterEtc($dbname,$fieldvalue,$_POST["idDb"],$con);
      if($queryDeleteField){
         return true;
      }else{
         return false;
      }
   }
 }
 if($task=="deleteFieldMultiple"){
   $sqlSelectFieldChoice = "SELECT * FROM `formchoice` WHERE `fieldid`='".$_POST["idDb"]."' ";
   $querySelectFieldChoice = mysqli_query($con,$sqlSelectFieldChoice);
   //echo $sqlSelectFieldChoice;
   while($dataChoice = mysqli_fetch_assoc($querySelectFieldChoice)){
      //print_r($dataChoice);
      $sql = mysqli_query($con,"ALTER TABLE `".$dbname."` DROP COLUMN `".$dataChoice["choicevalue"]."`") or die(mysqli_error());
   }
   $sqlDeleleChoice = mysql_query("DELETE FROM `formchoice` WHERE fieldid='".$_POST["idDb"]."' ");
   $sqlDeleteField = "DELETE FROM `formfield` WHERE fieldid='".$_POST["idDb"]."' ";
   $queryDeleteField = mysqli_query($con,$sqlDeleteField) or die(mysqli_error());
 }
 if($task=="createField"){
   if($fieldtype=="heading"){
      $sqlHead = mysqli_query($con,"SELECT *,forder FROM `formfield` WHERE `fieldtype`='heading' AND `formid`='".$_POST["formid"]."' ");
      $numHead = mysqli_num_rows($sqlHead);
      $sqlOrder = mysqli_query($con,"SELECT MAX(forder) FROM `formfield`");
      $numOrder = mysqli_num_rows($sqlOrder);
      
      if($numHead==0){
         $horder = 1;
      }else if($numHead>0){
         $horder = $numHead+1;
      }
      $sql = "INSERT INTO `formfield`(formid,fieldname,fieldtype,fieldvalue,horder,forder)
      VALUES(
         '".$_POST["formid"]."',
         '".$_POST["fieldname"]."',
         '".$_POST["fieldtype"]."',
         '".$_POST["fieldvalue"]."',
         '".$horder."',
         '".$numOrder."'
      )";
      mysqli_query($con,$sql) or die(mysqli_error());
      exit;
   }
   if($fieldtype=="dbthailand"){
      $sqlAddField = "INSERT INTO `formfield`(fieldid,formid,fieldname,fieldvalue,fieldhelp,fieldtype,valueprovince,valueamphur,valuetumbon,haveTumbon,forder)
      VALUES(
         '',
         '".$_POST["formid"]."',
         '".$_POST["fieldname"]."',
         '".$_POST["fieldvalue"]."',
         '".$_POST["fieldhelp"]."',
         '".$_POST["fieldtype"]."',
         '".$_POST["fieldvalue"]."_province',
         '".$_POST["fieldvalue"]."_amphur',
         '".$_POST["fieldvalue"]."_tumbon',
         '".$_POST["tumbon"]."',
         '".$_POST["idBox"]."'
      )
      ";
      mysqli_query($con,$sqlAddField) or die(mysqli_error());
      if($_POST["tumbon"]==1){
      $sqlAlter = "ALTER TABLE `$dbname`
         ADD COLUMN `".$_POST["fieldvalue"]."_province` INT(11),
         ADD COLUMN `".$_POST["fieldvalue"]."_amphur` INT(11),
         ADD COLUMN `".$_POST["fieldvalue"]."_tumbon` INT(11)
      ";
      }else{
         $sqlAlter = "ALTER TABLE `$dbname`
         ADD COLUMN `".$_POST["fieldvalue"]."_province` INT(11),
         ADD COLUMN `".$_POST["fieldvalue"]."_amphur` INT(11)
      ";
      }
      
      mysqli_query($con,$sqlAlter) or die(mysqli_error());
      exit;
   }
   $sqlAddField = "INSERT INTO `formfield`(fieldid,formid,fieldname,fieldvalue,fieldhelp,fieldtype,haveTumbon,forder)
      VALUES(
         '',
         '".$_POST["formid"]."',
         '".$_POST["fieldname"]."',
         '".$_POST["fieldvalue"]."',
         '".$_POST["fieldhelp"]."',
         '".$_POST["fieldtype"]."',
         '',
         '".$_POST["idBox"]."'
      )
   ";
         
   mysqli_query($con,$sqlAddField) or die(mysqli_error());
   $fieldid =  mysqli_insert_id($con);
   addAlter($con,$dbname,$fieldvalue,$fieldtype,$fieldid);
   if($_POST["arrayRadioTextBox"]!=""){
      $labelRadio = $_POST["arrayRadioTextBox"][0];
      $valueRadio = $_POST["arrayRadioTextBox"][1];
      for($i=0;$i<count($valueRadio);$i++){
            mysqli_query($con,"ALTER TABLE `".$dbname."` ADD ".$valueRadio[$i]."  VARCHAR(255)") or die(mysqli_error());
           $sqlInsertRadio = "
                  INSERT INTO `formchoice` (formid,fieldid,choicevalue,choicelabel,choiceetc)
                  VALUES(
                     '".$_POST["formid"]."',
                     '".$fieldid."',
                     '".$valueRadio[$i]."',
                     '".$labelRadio[$i]."',
                     '0'
                  )
               ";
               mysqli_query($con,$sqlInsertRadio) or die(mysqli_error());
      }
   }
   if($_POST["choiceRadio"]!=""){
            $alter = mysqli_query($con,"ALTER TABLE `".$dbname."` ADD ".$fieldvalue." VARCHAR(50) ");
            $valueRadio = $_POST["choiceRadio"][0];
            $labelRadio = $_POST["choiceRadio"][1];
            $etcRadio = $_POST["choiceRadio"][2];
            echo $formid;
            for($i=0;$i<count($valueRadio);$i++){
               $sqlInsertRadio = "
                  INSERT INTO `formchoice` (formid,fieldid,choicevalue,choicelabel,choiceetc)
                  VALUES(
                     '".$formid."',
                     '".$fieldid."',
                     '".$valueRadio[$i]."',
                     '".$labelRadio[$i]."',
                     '0'
                  )
               ";
               mysqli_query($con,$sqlInsertRadio) or die(mysqli_error());
                          
            }

      if($etcRadio!=""){
      $sqlInsertRadioEtc = "INSERT INTO `formchoice`(formid,fieldid,choicevalue,choicelabel,choiceetc) VALUES('".$_POST["formid"]."','".$fieldid."','".$etcRadio."','อื่นๆ','1') ";
      mysqli_query($con,$sqlInsertRadioEtc);
      $alteretc = mysqli_query($con,"ALTER TABLE `".$dbname."` ADD ".$etcRadio." VARCHAR(255) ");
      }
   }
   if($_POST["choiceCheckbox"]!=""){
            $valueCheckbox = $_POST["choiceCheckbox"][0];
            $labelCheckbox = $_POST["choiceCheckbox"][1];
            $etcCheckbox = $_POST["choiceCheckbox"][2];
            
            for($i=0;$i<count($valueCheckbox);$i++){
               mysqli_query($con,"ALTER TABLE `".$dbname."` ADD ".$valueCheckbox[$i]."  VARCHAR(50)");
               $sqlInsertCheckbox = "
                  INSERT INTO `formchoice`(formid,fieldid,choicevalue,choicelabel,choiceetc)
                  VALUES(
                     '".$_POST["formid"]."',
                     '".$fieldid."',
                     '".$valueCheckbox[$i]."',
                     '".$labelCheckbox[$i]."',
                     '0'
                  )
               ";
               echo $_POST["id"];
               echo $sqlInsertCheckbox;
               mysqli_query($con,$sqlInsertCheckbox) or die(mysqli_error());
                          
            }
      if($etcCheckbox!=""){
      mysqli_query($con,"ALTER TABLE `".$dbname."` ADD ".$etcCheckbox." VARCHAR(255)");
      mysqli_query($con,"INSERT INTO `formchoice`(formid,fieldid,choicevalue,choicelabel,choiceetc) VALUES('".$_POST["formid"]."','".$fieldid."','".$etcCheckbox."','อื่นๆ','1') ");
      }
   }
   if($_POST["choiceSelect"]!=""){
            $valueSelect = $_POST["choiceSelect"][0];
            $labelSelect = $_POST["choiceSelect"][1];            

            for($i=0;$i<count($valueSelect);$i++){
               $sqlInsertSelect = "
                  INSERT INTO `formchoice` (formid,fieldid,choicevalue,choicelabel,choiceetc)
                  VALUES(
                     '".$_POST["formid"]."',
                     '".$fieldid."',
                     '".$valueSelect[$i]."',
                     '".$labelSelect[$i]."',
                     '0'
                  )
               ";
               mysqli_query($con,$sqlInsertSelect) or die(mysqli_error());
                          
            }
      }
 }
 if($task=="editField"){
   $sqlSelectField = mysqli_query($con,"SELECT * FROM `formfield` WHERE `fieldid`='".$_POST["fieldid"]."' ");
   $dataSelectField = mysqli_fetch_assoc($sqlSelectField);
  if($_POST["fieldtype"]=="dbthailand"){
      $sqlUpdateField = "UPDATE `formfield` SET
            fieldname='".$_POST["fieldname"]."',
            fieldvalue='".$_POST["fieldvalue"]."',
            fieldhelp='".$_POST["fieldhelp"]."',
            fieldtype='".$_POST["fieldtype"]."',
            valueprovince='".$_POST["fieldvalue"]."_province',
            valueamphur='".$_POST["fieldvalue"]."_amphur',
            valuetumbon='".$_POST["fieldvalue"]."_tumbon',
            haveTumbon='".$_POST["tumbon"]."'
            WHERE fieldid='".$_POST["fieldid"]."'
      ";
      mysqli_query($con,$sqlUpdateField) or die(mysqli_error());
      if($dataSelectField["haveTumbon"]==1){
         $sqlAlterDrop = "ALTER TABLE `".$dbname."` DROP `".$_POST["fieldvalueOld"]."_province`,DROP `".$_POST["fieldvalueOld"]."_amphur`,DROP `".$_POST["fieldvalueOld"]."_tumbon`  ";
         
      }else{
         $sqlAlterDrop = "ALTER TABLE `".$dbname."` DROP `".$_POST["fieldvalueOld"]."_province`,DROP `".$_POST["fieldvalueOld"]."_amphur` ";
      }
      mysqli_query($con,$sqlAlterDrop) or die(mysqli_error());
      if($_POST["tumbon"]==1){
         $sqlAlterAdd = "ALTER TABLE `".$dbname."` ADD `".$_POST["fieldvalue"]."_province` INT(11),ADD `".$_POST["fieldvalue"]."_amphur` INT(11),ADD `".$_POST["fieldvalue"]."_tumbon` INT(11) ";
      }else{
         
         $sqlAlterAdd = "ALTER TABLE `".$dbname."` ADD `".$_POST["fieldvalue"]."_province` INT(11),ADD `".$_POST["fieldvalue"]."_amphur` INT(11)";
      }
      mysqli_query($con,$sqlAlterAdd) or die(mysqli_error());
      exit;
  }
   $sqlUpdateField = "UPDATE formfield SET
            fieldname='".$_POST["fieldname"]."',
            fieldvalue='".$_POST["fieldvalue"]."',
            fieldhelp='".$_POST["fieldhelp"]."',
            fieldtype='".$_POST["fieldtype"]."'
            WHERE fieldid='".$_POST["fieldid"]."'
   ";
   
   mysqli_query($con,$sqlUpdateField);
   if($_POST["fieldtype"]!="checkbox"){
   $sqlDeleteColumn = "ALTER TABLE `".$dbname."` DROP COLUMN `".$_POST["fieldvalueOld"]."`";
   mysqli_query($con,$sqlDeleteColumn) or die(mysqli_error());
   }
   addAlter($con,$dbname,$fieldvalue,$fieldtype);
   
   if($_POST["choiceRadio"]!=""){
      $alter = mysqli_query($con,"ALTER TABLE `".$dbname."` ADD ".$fieldvalue." VARCHAR(50)");
      $sqlDeleteRadio = mysqli_query($con,"DELETE FROM `formchoice` WHERE fieldid='".$_POST["fieldid"]."' ");
      
      $valueRadio = $_POST["choiceRadio"][0];
      $labelRadio = $_POST["choiceRadio"][1];
      $etcRadio = $_POST["choiceRadio"][2];

            for($i=0;$i<count($valueRadio);$i++){
               $sqlInsertRadio = "
                  INSERT INTO `formchoice`(formid,fieldid,choicevalue,choicelabel,choiceetc)
                  VALUES(
                     '".$_POST["formid"]."',
                     '".$_POST["fieldid"]."',
                     '".$valueRadio[$i]."',
                     '".$labelRadio[$i]."',
                     '0'
                  )
               ";
               mysqli_query($con,$sqlInsertRadio) or die(mysqli_error());
                          
            }
      if($etcRadio!=""){
         mysqli_query($con,"ALTER TABLE `".$dbname."` DROP COLUMN ".$_POST["choiceRadioEtc"]." ");
         mysqli_query($con,"INSERT INTO `formchoice`(formid,fieldid,choicevalue,choicelabel,choiceetc) VALUES('".$_POST["formid"]."','".$_POST["fieldid"]."','".$etcRadio."','อื่นๆ','1') ");
         mysqli_query($con,"ALTER TABLE `".$dbname."` ADD ".$etcRadio." VARCHAR(255)");
      }
   }
   if($_POST["choiceCheckbox"]!=""){
      $sqlCheckbox = mysqli_query($con,"SELECT choicevalue FROM `formchoice` WHERE fieldid='".$_POST["fieldid"]."' AND choiceetc='0' ") or die(mysqli_error());
      $num = mysqli_num_rows($sqlCheckbox);
      if($num>=1){
         while($dataCheckbox=mysqli_fetch_assoc($sqlCheckbox)){
            //print_r($dataCheckbox["choicevalue"]);
            mysqli_query($con,"ALTER TABLE `".$dbname."` DROP COLUMN `".$dataCheckbox["choicevalue"]."`") or die(mysqli_error());  
         }
      }
      $sqlDeleteCheckbox = mysqli_query($con,"DELETE FROM `formchoice` WHERE fieldid='".$_POST["fieldid"]."' ") or die(mysqli_error());
      $valueCheckbox = $_POST["choiceCheckbox"][0];
      $labelCheckbox = $_POST["choiceCheckbox"][1];
      $etcCheckbox = $_POST["choiceCheckbox"][2];
            for($i=0;$i<count($valueCheckbox);$i++){
               $sqlInsertCheckbox = "
                  INSERT INTO `formchoice`(formid,fieldid,choicevalue,choicelabel,choiceetc)
                  VALUES(
                     '".$_POST["formid"]."',
                     '".$_POST["fieldid"]."',
                     '".$valueCheckbox[$i]."',
                     '".$labelCheckbox[$i]."',
                     '0'
                  )
               ";
               mysqli_query($con,$sqlInsertCheckbox) or die(mysqli_error());
               mysqli_query($con,"ALTER TABLE `".$dbname."` ADD ".$valueCheckbox[$i]." VARCHAR(50)") or die(mysqli_error());
               
            }
      if($etcCheckbox!=""){
         mysqli_query($con,"ALTER TABLE `".$dbname."` DROP COLUMN ".$_POST["choiceCheckboxEtc"]." ");
         mysqli_query($con,"INSERT INTO `formchoice`(formid,fieldid,choicevalue,choicelabel,choiceetc) VALUES('".$_POST["formid"]."','".$_POST["fieldid"]."','".$etcCheckbox."','อื่นๆ','1') ");
         mysqli_query($con,"ALTER TABLE `".$dbname."` ADD ".$etcCheckbox." VARCHAR(255)");
      }
   }
   if($_POST["choiceSelect"]!=""){
      $sqlDeleteSelect = mysqli_query($con,"DELETE FROM `formchoice` WHERE fieldid='".$_POST["fieldid"]."' ");
      $valueSelect = $_POST["choiceSelect"][0];
      $labelSelect = $_POST["choiceSelect"][1];
            

            for($i=0;$i<count($valueSelect);$i++){
               $sqlInsertSelect = "
                  INSERT INTO `formchoice`(formid,fieldid,choicevalue,choicelabel,choiceetc)
                  VALUES(
                     '".$_POST["formid"]."',
                     '".$_POST["fieldid"]."',
                     '".$valueSelect[$i]."',
                     '".$labelSelect[$i]."',
                     '0'
                  )
               ";
               mysqli_query($con,$sqlInsertSelect) or die(mysqli_error());
                          
            }
   }
 }
 if($task=="updateOrder"){
      $sort = $_POST["sort"];
      $output = array();
      $sort = parse_str($sort,$output);
      $index=1;
      foreach($output as $order){
         for($i=0;$i<=sizeof($order);$i++){
            $sqlUpdateOrder = "UPDATE `formfield` SET `forder` = '".$index."' WHERE `fieldid` = '".$order[$i]."' ";
            mysqli_query($con,$sqlUpdateOrder) OR DIE("Error: ".$sqlUpdateOrder."<br>\n");
            $index++;
         }
      }
 }
 function deleteAlterEtc($dbname,$fieldvalue,$fieldid,$con){
      $sqlSelectType = mysqli_query($con,"SELECT fieldtype FROM `formfield` WHERE fieldid='".$fieldid."' AND fieldvalue='".$fieldvalue."' ") or die(mysqli_error());
      $dataType = mysqli_fetch_assoc($sqlSelectType);
      if($dataType["fieldtype"]=="radiobox"){
         $sqlSelect = mysqli_query($con,"SELECT choicevalue FROM `formchoice` WHERE fieldid='".$fieldid."' AND choiceetc='1' ") or die(mysqli_error());
         $num = mysqli_num_rows($sqlSelect);
         $data = mysqli_fetch_assoc($sqlSelect);
            if($num==1){
               echo "OK!";
               $sql = mysqli_query($con,"ALTER TABLE `".$dbname."` DROP COLUMN `".$data["choicevalue"]."`") or die(mysqli_error());
            }   
      }else if ($dataType["fieldtype"]=="checkbox"){
         $sqlCheckbox = mysqli_query($con,"SELECT choicevalue FROM `formchoice` WHERE fieldid='".$fieldid."' ") or die(mysqli_error());
         $num = mysqli_num_rows($sqlCheckbox);
         if($num>=1){
            while($dataCheckbox=mysqli_fetch_assoc($sqlCheckbox)){
               mysqli_query($con,"ALTER TABLE `".$dbname."` DROP COLUMN `".$dataCheckbox["choicevalue"]."`") or die(mysqli_error());  
            }
         }
      }

 }
 function addAlter($con,$dbname,$fieldvalue,$fieldtype,$fieldid){
   if($fieldtype=="text"){
      $type = "VARCHAR(255)";
      $sql = "ALTER TABLE `".$dbname."`ADD ".$fieldvalue." ".$type." ";
      mysqli_query($con,$sql) or die(mysqli_error());
   }
   else if($fieldtype=="textarea"){
      $type = "VARCHAR(255)";
      
      $sql = "ALTER TABLE `".$dbname."`ADD ".$fieldvalue." ".$type." ";
      mysqli_query($con,$sql) or die(mysqli_error());
   }
   else if($fieldtype=="select"){
      $type = "VARCHAR(50)";
      $sql = "ALTER TABLE `".$dbname."`ADD ".$fieldvalue." ".$type." ";
      mysqli_query($con,$sql) or die(mysqli_error());
   }else if($fieldtype=="date" || $fieldtype=="time" || $fieldtype=="datetime"){
      $type = "VARCHAR(50)";
      $sql = "ALTER TABLE `".$dbname."`ADD ".$fieldvalue." ".$type." ";
      mysqli_query($con,$sql) or die(mysqli_error());
   }

 }
?>