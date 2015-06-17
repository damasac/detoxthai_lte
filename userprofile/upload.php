<?php require_once '../_theme/util.inc.php';  $MasterPage = 'page_main.php';?>
<?php

?>
<?php sb('title');?><?php eb();?>

<?php sb('js_and_css_head'); ?>
<?php eb();?>

<?php sb('content');?>

<?php eb();?>
<?php sb('js_and_css_footer');?>
<script type="text/javascript" src="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
<link rel="stylesheet" href="../_plugins/bootstrap3-dialog/bootstrap-dialog.min.css">
<script>
          BootstrapDialog.show({
            type: BootstrapDialog.TYPE_PRIMARY,
            closable: true,
            closeByBackdrop: false,
            closeByKeyboard: false,
            title: 'อัพโหลดรูปประจำตัว',
            message: $('<div></div>').load('modal-upload.php')
        });
</script>
<!--<link rel="stylesheet" href="../_plugins/js-select2/select2.css">
<script type="text/javascript" src="../_plugins/js-select2/select2.js"></script>
<script src="../_plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../_plugins/datatables/dataTables.bootstrap.min.js"></script>
<link href="../_plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"></script>-->
<?php eb();?>
 
<?php render($MasterPage);?>