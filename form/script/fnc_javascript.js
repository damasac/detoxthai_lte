function AutoSave(field,form_id) {
    var value = $("#"+field).val();
    //alert("fields = "+field+" value = "+value+" form_id = "+form_id);
     $.ajax({
                type: "POST",
                url: "../_connection/db_form.php?task=updateAuto",
                data:{
                    form_id:form_id,
                    field:field,
                    value:value
                },
                success: function(returndata){
                    $("#"+field).css("border","1px green solid !important"); 
          }
    });
}
function formatPID(field){
    var key = $("#"+field).val();
    var pid1;
    var pid2;
    var pid3;
    var pid4;
    if (key.length==1) {
       var pid1 = key.substr(0,1)+"-"+key.substr(1);
       $("#"+field).val(pid1);
    }
    if (key.length==6) {
        var pid2 = $("#"+field).val();
        $("#"+field).val(pid2+"-");
    }
    
    if (key.length==12) {
        var pid3 = $("#"+field).val();
        $("#"+field).val(pid3+"-");
    }
    if (key.length==15) {
        var pid4 = $("#"+field).val();
        $("#"+field).val(pid4+"-");
    }
    $("#"+field).blur(function(){
            if(validatePID($("#"+field).val())==true){
                    AutoSave(field,$("#form_id").val());
                }else{
                    $("#"+field).css("border","1px red solid");
                }
        });
}
function validatePID(pid){
    pid = pid.toString().replace(/\D/g,'');
    if(pid.length == 13){
        var sum = 0;
        for(var i = 0; i < pid.length-1; i++){
            sum += Number(pid.charAt(i))*(pid.length-i);
        }
        var last_digit = (11 - sum % 11) % 10;
        return pid.charAt(12) == last_digit;
    }else{
        return false;
    }
}

function formatNumber(field){
    var key = $("#"+field).val();
    var pid;
    if (key.length==3) {
        pid = $("#"+field).val()+"-";
        $("#"+field).val(pid);
    }
     $("#"+field).blur(function(){
        AutoSave(field,$("#form_id").val());
        });
}
function SaveNumber(field){
   
}
function validateEmail(field,form_id) {
    var email = $("#"+field).val();
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(regex.test(email)==true){
        AutoSave(field,form_id);
    }else{
        $("#"+field).css("border","1px red solid");
    }
} 
function AutoSaveRadio(field, form_id, val) {
    var value = val;
    alert("fields = "+field+" value = "+value+" form_id = "+form_id);
     $.ajax({
                type: "POST",
                url: "../_connection/db_form.php?task=updateAuto",
                data:{
                    form_id:form_id,
                    field:field,
                    value:value
                },
                success: function(returndata){
                    $("#"+field).css("border","1px green solid");
          }
    });
     
}
