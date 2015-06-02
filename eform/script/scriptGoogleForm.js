        $(document).ready(function(){
                $("#panel").show();
                $("#form").sortable({
                                update: function( ) {
                                        var sort = $(this).sortable('serialize');
                                        //console.log(sort);
                                        $.ajax({
                                                url: "ajax-createform-loaddata.php?task=updateOrder",
                                                type: "post",
                                                data: {sort:sort},
                                                success: function(data){
                                                        console.log(data);
                                                },
                                                error:function(){
                                                    alert("failure");
                                                }
                                            });
        }
                        });
                var numForm = $(".formItem").length;
                numForm++;
                $("#valQuestion").val("value"+numForm);
            });

        function addSelect() {
                //code
                
                var num = $("label[id='select']").length;
                num++;
                var idSelect = "select"+num;
                var selectHtml = "<div class='form-inline' id='select"+num+"'><div class='form-group'>";
                selectHtml += "<label id='select'>"+num+".</label>&nbsp;&nbsp;&nbsp;&nbsp;";
                selectHtml += "<input type='text' class='form-control' id='valSelect"+num+"' value='"+num+"' style='width:15%;'>&nbsp;";
                selectHtml +="<input type='text' class='form-control' id='select"+num+"'>";

                selectHtml +="&nbsp;&nbsp;<button class='btn btn-danger' onclick=deleteSelect('"+idSelect+"');><i class='fa fa-times'></i></button>";
                selectHtml += "</div></div>";
                $("#selectShow").append(selectHtml);
        }
        function deleteSelect(idSelect){
                $("div[id='"+idSelect+"']").hide("fast",function(){
                        $(this).remove();
                 });
        }
        function addCheckbox() {
                //code
                var valQuestion = $("#valQuestion").val();
                var countCheckbox = $("input[id=buttonCheckbox]").length;
                countCheckbox++;
                var idCheckbox = "checkbox"+countCheckbox;
                //alert(idCheckbox);
                var checkboxHtml = "<div class='form-inline' id='"+idCheckbox+"'><div class='form-group'>";
                checkboxHtml += "<label><input type='checkbox' disabled='disabled' id='buttonCheckbox'>&nbsp;&nbsp;</label>";
                checkboxHtml += "&nbsp;<input type='text' class='form-control' id='valCheckbox"+countCheckbox+"' value='"+valQuestion+"_"+countCheckbox+"' style='width:18%'>&nbsp;";
                checkboxHtml += "<input type='text' class='form-control' id='checkbox"+countCheckbox+"' value='ตัวเลือกที่ "+countCheckbox+"'>&nbsp;";

                checkboxHtml +="&nbsp;&nbsp;<button class='btn btn-danger' onclick=deletecheckbox('"+idCheckbox+"');><i class='fa fa-times'></i></button>";
                checkboxHtml += "</div></div>";

                $("#checkboxShow").append(checkboxHtml);

                
        }
        function addCheckboxEtc() {
                //alert("OK!");
                var countCheckbox = $("input[id='buttonCheckbox']").length;
                countCheckbox++;
                var countCheckboxEtc = $("input[id='checkboxEtc']").length;
                var valQuestion = $("#valQuestion").val();
                var valCheckboxEtc = valQuestion+"_other";
                //alert(countCheckboxEtc);
                if (countCheckboxEtc=="0") {
                        //code
                        var radioCheckboxEtc = "<div class='form-inline' id='checkboxEtc'><div class='form-group'>";
                        radioCheckboxEtc += "<label><input type='checkbox' class='minimal'disabled='disabled' id='checkboxEtc'>&nbsp;&nbsp;</label>";
                        radioCheckboxEtc += "&nbsp;<input type='text' class='form-control' id='valCheckboxEtc' value='"+valCheckboxEtc+"' style='width:20%;'>&nbsp;";
                        radioCheckboxEtc += "<span>อื่นๆ : <span><input type='text' class='form-control' id='textCheckboxEtc' disabled='disabled' >";

                        radioCheckboxEtc +="&nbsp;&nbsp;<button class='btn btn-danger' onclick=deletecheckbox();><i class='fa fa-times'></i></button>";
                        
                        radioCheckboxEtc += "</div></div>";
                        $("#checkboxShowEtc").append(radioCheckboxEtc);
                }else{
                        return ;
                }
        }
        function deletecheckbox(idCheckbox) {
                if (!idCheckbox) {
                        //code
                        $("div[id='checkboxEtc']").hide(function(){
                                $(this).remove();
                                });
                }
                $("div[id='"+idCheckbox+"']").hide(function(){
                                $(this).remove();
                        });
        }
        function addRadiobox(args) {
                //code
                var appendRadio = $("#radioShow").html();
                var countRadio = $("input[id=buttonRadio]").length;
                var valRadio = $("#valQuestion").val();
                countRadio++;
                //alert(countRadio);
                var idRadio = "radio"+countRadio;
                var radioHtml = "<div class='form-inline' id='"+idRadio+"'><div class='form-group'>";
                radioHtml += "<label><input type='radio' class='form-control' disabled='disabled' id='buttonRadio'>&nbsp;&nbsp;</label>";
                radioHtml += "<input type='text' class='form-control' id='valRadio"+countRadio+"' value='"+countRadio+"' style='width:15%;'>&nbsp;";
                radioHtml += "<input type='text' class='form-control' id='radio"+countRadio+"' value='ตัวเลือกที่ "+countRadio+"'>";
                radioHtml +="&nbsp;&nbsp;<button class='btn btn-danger' onclick=deleteRadio('"+idRadio+"');><i class='fa fa-times'></i></button>";
                radioHtml += "</div></div>";

                $("#radioShow").append(radioHtml); 
                
        }
        function addRadiotextbox(args) {
                //code
                var appendRadio = $("#radioShow").html();
                var countRadio = $("input[id=radiotextbox]").length;
                
                var valRadio = $("#valQuestion").val();
                countRadio++;
                //alert(countRadio);
                var idRadio = "radio"+countRadio;
                var radioHtml = "<div class='form-inline' id='"+idRadio+"'><div class='form-group'>";
                radioHtml += "<label><input type='radio' class='form-control' disabled='disabled' id='radiotextbox'>&nbsp;</label>";
                radioHtml += "<input type='text' class='form-control' id='valTextRadio"+countRadio+"' value='"+valRadio+"_"+countRadio+"' style='width:15%;'>&nbsp;";
                radioHtml += "<input type='text' class='form-control' id='labelTextRadio"+countRadio+"' value='คำถามที่ "+countRadio+"' style='width:22%;'>&nbsp;";
                radioHtml += "<input type='text' class='form-control' id='"+countRadio+"' value='คำตอบที่ "+countRadio+"' disabled='diabled'>";
                radioHtml +="&nbsp;&nbsp;<button class='btn btn-danger' onclick=deleteRadio('"+idRadio+"');><i class='fa fa-times'></i></button>";
                radioHtml += "</div></div>";

                $("#showradiotextbox").append(radioHtml); 
                
        }
        function addRadioboxEtc(args) {
                var countRadioEtc = $("input[id='radioEtc']").length;
                var valQuestion = $("#valQuestion").val();
                var countRadio = $("input[id=buttonRadio]").length;
                countRadio++;
                var valueRadioEtc = valQuestion+"_other";
                if (countRadioEtc=="0") {
                        //code
                        var radioHtmlEtc = "<div class='form-inline' id='radioEtc'><div class='form-group'>";
                        radioHtmlEtc += "<label><input type='radio' class='form-control' disabled='disabled' id='radioEtc'>&nbsp;&nbsp;</label>";
                        radioHtmlEtc += "<input type='text' class='form-control' id='valueRadioEtc' value='"+valueRadioEtc+"' style='width:15%;'>&nbsp;&nbsp;";
                        radioHtmlEtc += "<span>อื่นๆ : <span><input type='text' class='form-control' id='textRadioEtc' disabled='disabled' >";
                        radioHtmlEtc +="&nbsp;&nbsp;<button class='btn btn-danger' onclick=deleteRadio();><i class='fa fa-times'></i></button>";
                        radioHtmlEtc += "</div></div>";
                        $("#radioShowEtc").append(radioHtmlEtc);
                }else{
                        return ;
                }
        }
        function deleteRadio(idRadio) {
                if (!idRadio) {
                        //code
                        $("div[id='radioEtc']").hide("fast",function(){
                                $(this).remove();
                                });
                }
                $("div[id='"+idRadio+"']").hide("fast",function(){
                                $(this).remove();
                        });
        }
        function autoSave(id,field,val) {
                //code
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=updateFormmain",
		    type: "post",
		    data: {id:id,field:field,val:val},
		    success: function(data){
                        //alert(data);
			//location.href="eform.php?idFormMain="+data+"";
		    },
		    error:function(){
			alert("failure");
		    }
		});

        }
        function selectTypeQuestion(typeQuestion) {
                var valQuestion = $("#valQuestion").val();
                $.post("ajax-addquestion-loaddata2.php",{typeQuestion:typeQuestion,valQuestion:valQuestion},function(data){
                                $("#exampleEform").show();
                                $("#exampleEform").html(data);
                        });
        }
        function addQuestion() {
                //code 
                $("#panel").show();
                $("div[class='panel-body2']").not($("div[class='panel-body']")).remove();
                $(".formItem").show();
                var formid = $("#formid").val();
                var dbname = $("#dbname").val();
                var nameQuestion = $("#nameQuestion").val();
                var helpQuestion = $("#helpQuestion").val();
                var valQuestion = $("#valQuestion").val();
                var typeQuestion = $("#typeQuestion").val();
                var idBox = $(".formItem").length+1;
                $("#nameQuestion").keyup(function(){
                        $("#nameError").html("");
                        $("#nameQuestion").attr("style","border:1px #ccc solid");
                });
                $("#valQuestion").keyup(function(){
                        $("#valueError").html("");
                        $("#valQuestion").attr("style","border:1px #ccc solid;width:20%;");
                });
                if (nameQuestion=="") {
                        //code
                        $("#nameError").html("กรุณากรอกชื่อคำถาม");
                        $("#nameQuestion").attr("style","border:1px red solid");
                        return ;
                }
                if(valQuestion=="" ) {
                        //code
                        $("#valueError").html("กรุณากรอกระบุตัวแปร");
                        $("#valQuestion").attr("style","border:1px red solid;width:20%;");
                        
                        return ;
                }
                if (validationEng(valQuestion)==false) {
                        //code
                        $("#valueError").html("กรุณากรอกระบุตัวแปรที่เป็นภาษาอังกฤษหรือตัวเลขเท่านั้น");
                        $("#valQuestion").attr("style","border:1px red solid;width:20%;");
                        return ;
                }
                //console.log(validationField(valQuestion,dbname));
                if (validationField(valQuestion,dbname)==false) {
                        //code
                        $("#valueError").html("ตัวแปรนี้มีอยู่ในฐานข้อมูลแล้วกรุณากรอกใหม่");
                        $("#valQuestion").attr("style","border:1px red solid;width:20%;");
                        return ;
                }
                        
                if (typeQuestion=="text") {
                        //code
                        genFormText(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion);
                }
                if (typeQuestion=="textarea") {
                        //code
                        genFormTextarea(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion);
                }
                if (typeQuestion=="radiotextbox") {
                        //code
                        var countRadio = $("input[id='radiotextbox']").length;
                        var i;
                        var labelRadio = [];
                        var valRadio = [];
                        for(i=1;i<=countRadio;i++){
                                labelRadio.push($("input[id=labelTextRadio"+i+"]").val());
                                valRadio.push($("input[id=valTextRadio"+i+"]").val());
                        }
                        genFormRadioTextBox(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion,labelRadio,valRadio);
                }
                if (typeQuestion=="radiobox") {
                        //code
                        var countRadio = $("input[id='buttonRadio']").length;
                        var countRadioEtc = $("input[id='radioEtc']").length;
                        var i;
                        var textRadio = [];
                        var valRadio = [];
                        for (i=1;i<=countRadio;i++) {
                               textRadio.push($("input[id=radio"+i+"]").val());
                                valRadio.push($("input[id='valRadio"+i+"']").val());
                        }



                        if (countRadioEtc=="1") {
                                var radioEtc = "radioetc";
                        }
                        var valRadioEtc = $("#valueRadioEtc").val();
                        genFormRadioBox(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion,textRadio,valRadio,radioEtc,valRadioEtc);
                }
                if (typeQuestion=="checkbox") {
                        //code
                        var countCheckbox = $("input[id='buttonCheckbox']").length;
                        var countCheckboxEtc = $("input[id='checkboxEtc']").length;
                        var i;
                        var textCheckbox = [];
                        var valCheckbox = [];
                        for (i=1;i<=countCheckbox;i++) {
                                //code
                                textCheckbox.push($("input[id='checkbox"+i+"']").val());
                                valCheckbox.push($("input[id='valCheckbox"+i+"']").val());
                        }
                        
                        if (countCheckboxEtc=="1") {
                                //code
                                var CheckboxEtc = 'checkboxetc';
                        }
                        var valCheckboxEtc = $("#valCheckboxEtc").val();

                        genFormCheckbox(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion,valCheckbox,textCheckbox,valCheckboxEtc);
                }
                if (typeQuestion=="select") {
                        //code
                        var countSelectBox = $("label[id='select']").length;
                        var i;
                        var textSelect = [];
                        var valSelect = [];
                        for (i=1;i<=countSelectBox;i++) {
                                textSelect.push($("input[id='select"+i+"']").val());
                                valSelect.push($("input[id='valSelect"+i+"']").val());
                        }
                        //console.log(valSelect);
                        genSelectBox(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion,textSelect,valSelect);
                }
                if (typeQuestion=="date") {
                        //code
                        genDate(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion);
                }
                if (typeQuestion=="time") {
                        //code
                        genTime(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion);
                }
                if (typeQuestion=="datetime") {
                        //code
                        genDatetime(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion)
                }
                if (typeQuestion=="dbthailand") {
                        //code

                        if ($("#tumbonCheck").is(":checked")) {
                                var tumbon = 1;
                        }else{
                                var tumbon = 0;
                        }
                        genDbthailand(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion,tumbon);
                }
                if (typeQuestion=="heading") {
                        //code
                        genHeading(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion);
                }

        }
        function genFormRadioTextBox(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion,labelRadio,valRadio){
                //code
                var arrayRadiotextBox = [labelRadio,valRadio];
                var id = "item_"+idBox;
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=createField",
		    type: "post",
		    data: {
                                formid:formid,
                                dbname:dbname,
                                idBox:idBox,
                                fieldtype:typeQuestion,
                                fieldname:nameQuestion,
                                fieldvalue:valQuestion,
                                fieldhelp:helpQuestion,
                                arrayRadioTextBox:arrayRadiotextBox
                                },
		    success: function(data){
                        //console.log(data);
			location.href="eform.php?idFormMain="+formid+"";
		    },
		    error:function(){
			alert("failure");
		    }
		});
        }
        function genHeading(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion){
                //alert(idBox);
                var id = "item_"+idBox;
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=createField",
		    type: "post",
		    data: {
                                formid:formid,
                                dbname:dbname,
                                idBox:idBox,
                                fieldtype:typeQuestion,
                                fieldname:nameQuestion,
                                fieldvalue:valQuestion,
                                fieldhelp:helpQuestion
                                },
		    success: function(data){
                        //console.log(data);
			location.href="eform.php?idFormMain="+formid+"";
		    },
		    error:function(){
			alert("failure");
		    }
		});
        }
        function genDbthailand(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion,tumbon)
        {
                //code
                //alert(valQuestion);
                var id = "item_"+idBox;
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=createField",
		    type: "post",
		    data: {
                                formid:formid,
                                dbname:dbname,
                                idBox:idBox,
                                fieldtype:typeQuestion,
                                fieldname:nameQuestion,
                                fieldvalue:valQuestion,
                                fieldhelp:helpQuestion,
                                tumbon:tumbon
                                },
		    success: function(data){
                        //console.log(data);
			location.href="eform.php?idFormMain="+formid+"";
		    },
		    error:function(){
			alert("failure");
		    }
		});
        }
        ///////////////////////////////////////////////// GET TIME  EXAMPLE ///////////////////////////////////////////
        function genDatetime(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion) {
                //code  
                var id = "item_"+idBox;
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=createField",
		    type: "post",
		    data: {
                                formid:formid,
                                dbname:dbname,
                                idBox:idBox,
                                fieldtype:typeQuestion,
                                fieldname:nameQuestion,
                                fieldvalue:valQuestion,
                                fieldhelp:helpQuestion
                                },
		    success: function(data){
			location.href="eform.php?idFormMain="+formid+"";
		    },
		    error:function(){
			alert("failure");
		    }
		});

        }
        ///////////////////////////////////////////////// GET TIME  EXAMPLE ///////////////////////////////////////////
        function genTime(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion) {
                //code
                var id = "item_"+idBox;
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=createField",
		    type: "post",
		    data: {
                                formid:formid,
                                dbname:dbname,
                                idBox:idBox,
                                fieldtype:typeQuestion,
                                fieldname:nameQuestion,
                                fieldvalue:valQuestion,
                                fieldhelp:helpQuestion
                                },
		    success: function(data){
			location.href="eform.php?idFormMain="+formid+"";
		    },
		    error:function(){
			alert("failure");
		    }
		});

        }
        ///////////////////////////////////////////////// GET DATE  EXAMPLE ///////////////////////////////////////////
        function genDate(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion) {
                //code  
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=createField",
		    type: "post",
		    data: {
                                formid:formid,
                                dbname:dbname,
                                idBox:idBox,
                                fieldtype:typeQuestion,
                                fieldname:nameQuestion,
                                fieldvalue:valQuestion,
                                fieldhelp:helpQuestion
                                },
		    success: function(data){
			location.href="eform.php?idFormMain="+formid+"";
		    },
		    error:function(){
			alert("failure");
		    }
		});
        }
        ///////////////////////////////////////////////// GET SELECT  EXAMPLE ///////////////////////////////////////////
        function  genSelectBox(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion,textSelect,valSelect){
                //code
                var id = "item_"+idBox;
                var arraySelect = [valSelect,textSelect];
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=createField",
		    type: "post",
		    data: {
                                formid:formid,
                                dbname:dbname,
                                idBox:idBox,
                                fieldtype:typeQuestion,
                                fieldname:nameQuestion,
                                fieldvalue:valQuestion,
                                fieldhelp:helpQuestion,
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
        ///////////////////////////////////////////////// GET CHECK BOX  EXAMPLE ///////////////////////////////////////////
        function genFormCheckbox(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion,valCheckbox,textCheckbox,valCheckboxEtc){
                var arrayCheckbox = [valCheckbox,textCheckbox,valCheckboxEtc];
                var countCheckbox = textCheckbox.length;
                var i;
                var id = "item_"+idBox;
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=createField",
		    type: "post",
		    data: {
                                formid:formid,
                                dbname:dbname,
                                idBox:idBox,
                                fieldtype:typeQuestion,
                                fieldname:nameQuestion,
                                fieldvalue:valQuestion,
                                fieldhelp:helpQuestion,
                                choiceCheckbox:arrayCheckbox
                                },
		    success: function(data){
			location.href="eform.php?idFormMain="+formid+"";
		    },
		    error:function(){
			alert("failure");
		    }
		});
        }
        ///////////////////////////////////////////////// GET RADIO  EXAMPLE ///////////////////////////////////////////
        function genFormRadioBox(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion,textRadio,valRadio,radioEtc,valRadioEtc){
                var arrayRadio = [valRadio,textRadio,valRadioEtc];
                var countRadio = textRadio.length;
                console.log(arrayRadio);
                var i;
                var id = "item_"+idBox;
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=createField",
		    type: "post",
		    data: {
                                formid:formid,
                                dbname:dbname,
                                idBox:idBox,
                                fieldtype:typeQuestion,
                                fieldname:nameQuestion,
                                fieldvalue:valQuestion,
                                fieldhelp:helpQuestion,
                                choiceRadio:arrayRadio
                                },
		    success: function(data){
			location.href="eform.php?idFormMain="+formid+"";
		    },
		    error:function(){
			alert("failure");
		    }
		});

        }
        ///////////////////////////////////////////////// GET TEXT  EXAMPLE ///////////////////////////////////////////
        function genFormText(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion) {
                //code
                //alert(dbname);
                var id = "item_"+idBox;
                 $.ajax({
		    url: "ajax-createform-loaddata.php?task=createField",
		    type: "post",
		    data: {formid:formid,dbname:dbname,idBox:idBox,fieldtype:typeQuestion,fieldname:nameQuestion,fieldvalue:valQuestion,fieldhelp:helpQuestion},
		    success: function(data){
			location.href="eform.php?idFormMain="+formid+"";
		    },
		    error:function(){
			alert("failure");
		    }
		});
        }
        ///////////////////////////////////////////////// GET TEXT AREA EXAMPLE ///////////////////////////////////////////
        function genFormTextarea(formid,idBox,dbname,typeQuestion,nameQuestion,valQuestion,helpQuestion) {
                //code
                var id = "item_"+idBox;
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=createField",
		    type: "post",
		    data: {formid:formid,dbname:dbname,idBox:idBox,fieldtype:typeQuestion,fieldname:nameQuestion,fieldvalue:valQuestion,fieldhelp:helpQuestion},
		    success: function(data){
			location.href="eform.php?idFormMain="+formid+"";
		    },
		    error:function(){
			alert("failure");
		    }
		});
                $("#form").sortable();
        }
        function genForm(args) {
                //code
        }
        ///////////////////////////////////////// EDIT FORM ITEM ///////////////////////////////////////////
 function editFormFnc(id,typeQuestion,dbname,fieldvalue,numclick) {
                //alert(id);
                //alert(dbname);

                if (numclick=='0') {

                        $("div[class='panel-body2']").not($("div[id='editpanel"+id+"']")).remove();
                        $("div[id='panel']").hide();
                        $(".formItem").show();
                                      $.post("ajax-editquestion-loaddata2.php",{
                                              id:id,
                                              typeQuestion:typeQuestion
                                              },function(data){
                                                      $("#"+id).hide();
                                                    insertP(data,id);
                                              });
                }else{
                        return;
                }
              
        }
        function insertP(data,id)
        {
              var a =  $("div[class='panel-body2']").length;
              if (a==0) {
                //code
                $("#"+id).after(data);
                
              }else{
                return ;
              }
        }
        ///////////////////////////////////////////////// DELETE FORM ITEM ///////////////////////////////////////////
        function delFormFnc(id,dbname,fieldvalue){
                var idsplit = id.split("_");
                var idDb = idsplit[1];
                $("#"+id).remove();
                $("div[class='panel-body2']").not($("div[class='panel-body']")).remove();
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=deleteField",
		    type: "post",
		    data: {idDb:idDb,dbname:dbname,fieldvalue:fieldvalue},
		    success: function(data){
                        $('#typeQuestion').prop('selectedIndex',0);
		    },
		    error:function(){
		    }
		});
        }
	function delFormFncMultiple(id,dbname,fieldvalue) {
		 var idsplit = id.split("_");
                var idDb = idsplit[1];
                $("#"+id).remove();
                $("div[class='panel-body2']").not($("div[class='panel-body']")).remove();
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=deleteFieldMultiple",
		    type: "post",
		    data: {idDb:idDb,dbname:dbname,fieldvalue:fieldvalue},
		    success: function(data){
                        $('#typeQuestion').prop('selectedIndex',0);
		    },
		    error:function(){
		    }
		});
	}
        function validationEng(valQuestion){
                var len, digit;
                if(valQuestion == " "){ 
                 len=0;
                }else{
                len = valQuestion.length;
                }
                for(var i=0 ; i<len ; i++)
                {
                digit = valQuestion.charAt(i)
                if( (digit >= "a" && digit <= "z") || (digit >="0" && digit <="9") || (digit >="A" && digit <="Z") || (digit =="_")){
                ;	
                }else{
                return false;	
                }	
                }	
                return true;
        }
        function validationField(valQuestion,dbname) {
                //cod
                var callback;
                $.ajax({
		    url: "ajax-createform-loaddata.php?task=checkField",
		    type: "post",
                    async: false,
		    data: {valQuestion:valQuestion,dbname:dbname},
		    success: function(data){
                                if (data==1) {
                                        //code
                                        callback = true;
                                }else{
                                          callback = false;
                                }


		    },
		    error:function(){
			alert("failure");
		    }
		});
                return callback;
        }
	