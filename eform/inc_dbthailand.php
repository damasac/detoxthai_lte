<?php
 include_once("../_connection/db_eform.php");
 $sqlProvince = mysqli_query($con,"SELECT * FROM const_province ") or die(mysql_error());
?>
<div class="row">
    <div class="col-lg-3">    
    <select id="province" name="province" class="form-control" >
        <option value="">จังหวัด</option>
        <?php
            while($dataProvince = mysqli_fetch_assoc($sqlProvince)){
                    
                    echo "<option value='".$dataProvince["PROVINCE_CODE"]."'>".$dataProvince["PROVINCE_NAME"]."</option>";
                    
                }
        ?>
     </select>
    </div>
    <div class="col-lg-3">
    <select id="amphur" name="amphur" class="form-control">
        <option value="">อำเภอ</option>
    </select>
    </div>
    <div class="col-lg-3">
    <select id="tumbon" name="tumbon" style="display:none;" class="form-control">
        <option value="">ตำบล</option>
    </select>
    </div>
</div>
<script>
    $("#province").change(function(){
            $("#amphur").html("<option value=''>อำเภอ</option>");
           var province_id = $(this).val();
           $.getJSON("ajax-area-loaddata.php?task=amphur&province_id="+province_id,function(result){
                    $.each(result, function(i, field){
                            $("#amphur").append("<option value="+field.AMPHUR_CODE+" >"+field.AMPHUR_NAME+"</option>");
                    });
                  });
        });
    $("#amphur").change(function(){
        $("#tumbon").html("<option value=''>ตำบล</option>");
       var amphur_id = $(this).val();
       $.getJSON("ajax-area-loaddata.php?task=tumbon&amphur_id="+amphur_id,function(result){
                $.each(result, function(i, field){

                        $("#tumbon").append("<option value="+field.DISTRICT_CODE+" >"+field.DISTRICT_NAME+"</option>");
                });
              });
    });
    $("#tumbonCheck").click(function(){
        
        if ($("#tumbonCheck").is(":checked")) {
            $("#tumbon").show();
        }else{
            $("#tumbon").hide();
        }
    });
</script>