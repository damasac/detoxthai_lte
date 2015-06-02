function submit_login() {

       var datalist=$('#frm-login').serialize();    
        $.ajax({
                url : "login/chk-login.php",
                type:"POST",
                data : datalist,
                success : function(returndata) {
                    returndata = $.trim(returndata);
                    if (returndata!='success') {
                        $('#alert-login').fadeIn();
                        $('#alert-login').text(returndata);
                    }
                    else if (returndata=='success') {
                        $('#alert-login').fadeOut();
                        parent.location='home.php';
                    }
             
                    
                },
                error : function(xhr, statusText, error) {
                    //$(document).ajaxStop($.unblockUI); 
                                    
                }
        });
 

}