<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
$System_LayoutUse="layout_main.html";
$myMenuKey="Home";
include_once("../../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start.php");
include_once(SYSTEM_DOC_ROOT."system/core-body.php");
//-------------------------------------------------------------------------------------
?>
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js/jquery.datetimepicker.css">
<br>  
<br>  
<br>  
<br>  
<br>  
<input type="text" name="testdate5" id="testdate5" value="2557-12-03" style="width:100px;">       
<br>  
<br>  
<br>
<script type="text/javascript">

$("#testdate5").datetimepicker({  
    todayButton: true,
    datepicker: true,
    timepicker: false,
    format: 'Y-m-d',
    mask:true,
    lang:'th',
    onChangeMonth:datetimepicker_ThaiYear,
    onShow:datetimepicker_ThaiYear,
    yearOffset:543,
    closeOnDateSelect:true
});
</script>
<?
//-------------------------------------------------------------------------------------
include_once(SYSTEM_DOC_ROOT."system/core-end.php");
?>