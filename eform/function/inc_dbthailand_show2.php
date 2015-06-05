<?php
 include_once("db_eform.php");

 $sqlProvince = mysqli_query($con,"SELECT * FROM `const_province`") or die(mysqli_error());
 $sqlCount = mysqli_query($con,"SELECT * FROM `formfield` WHERE `fieldtype`='dbthailand' ");
 if($value_amphur!=""){
   $sqlAmphur = mysqli_query($con,"SELECT * FROM `const_amphur` WHERE `PROVINCE_ID`='".$value_province."' ");
 }
 if($value_tumbon!=""){
  $sqlTumbon = mysqli_query($con,"SELECT * FROM `const_district` WHERE `AMPHUR_ID`='".$value_amphur."'") or die(mysqli_error());
 }
?>
<label>
    <?php echo $dataField["fieldname"];?>
</label>
<div class="row">
    <div class="col-lg-3" >
        <select data-attr="province" id="province_<?php echo $i;?>" name="<?php echo $dataField["valueprovince"];?>"
        onChange="getAmphur('<?php echo $dataField["valueprovince"];?>',$(this).val(),<?php echo $i;?>)";
        class="form-control">
           <?php if($value_province==""){?>
            <option value="">- เลือกจังหวัด -</option>
            <?php }?>
                    <?php
            while($dataProvince = mysqli_fetch_assoc($sqlProvince)){
                    ?>
                    <option value="<?php echo $dataProvince["PROVINCE_ID"]?>" <?php if($dataProvince["PROVINCE_ID"]==$value_province){ echo "selected"; }?>><?php echo $dataProvince["PROVINCE_NAME"]?></option>
                    <?php 
                }
        ?>
        </select>
    </div>
    <div class="col-lg-3" >
        <select data-attr="amphur" id="amphur_<?php echo $i;?>" name="<?php echo $dataField["valueamphur"];?>"
        onChange="getTumbon('<?php echo $dataField["valueamphur"];?>',$(this).val(),<?php echo $i;?>)";
        class="form-control">
         <?php if($value_amphur==""){?>
            <option value="">- เลือกอำเภอ -</option>
        <?php }else {
          while($dataAmphur = mysqli_fetch_assoc($sqlAmphur)){
         ?>
        <option value="<?php echo $dataAmphur["AMPHUR_ID"]?>"<?php if($dataAmphur["AMPHUR_ID"]==$value_amphur){echo "selected";}?>><?php echo $dataAmphur["AMPHUR_NAME"]?></option>   
        <?php }
        }?>
        </select>
    </div>
    <?php if($dataField["haveTumbon"]==1){ ?>
    <div class="col-lg-3">
        <select data-attr="tumbon" id="tumbon_<?php echo $i;?>" name="<?php echo $dataField["valuetumbon"];?>" class="form-control">
        <?php if($value_tumbon==""){?>
            <option value="">- เลือกตำบล -</option>
        <?php }else{
         while($dataTumbon = mysqli_fetch_assoc($sqlTumbon)){
         ?>
        <option value="<?php echo $dataTumbon["DISTRICT_ID"]?>"<?php if($dataTumbon["DISTRICT_ID"]==$value_tumbon){echo "selected";}?>><?php echo $dataTumbon["DISTRICT_NAME"]?></option>   
        <?php }
        }?>
        </select>
    </div>
    <?php }?>
</div>
    <script>
        function getAmphur(name,value,num){
          
                $("#amphur_"+num).html("<option value=''>- เลือกอำเภอ -</option>");
               var province_id = value;
               $.getJSON("ajax-area-loaddata.php?task=amphur&province_id="+province_id,function(result){
                        $.each(result, function(i, field){
                                $("#amphur_"+num).append("<option value="+field.AMPHUR_ID+" >"+field.AMPHUR_NAME+"</option>");
                        });
                    });
        }
        function getTumbon(name,value,num){
           $("#tumbon_"+num).html("<option value=''>- เลือกตำบล -</option>");
           var amphur_id = value;
           $.getJSON("ajax-area-loaddata.php?task=tumbon&amphur_id="+amphur_id,function(result){
                    $.each(result, function(i, field){
                            $("#tumbon_"+num).append("<option value="+field.DISTRICT_ID+" >"+field.DISTRICT_NAME+"</option>");
                    });
                });
        }
</script>