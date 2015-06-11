<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?> User Setting <?php eb();?>

<?php sb('js_and_css_head'); ?>
<style>
    .hospital{
        /*background-color:red;*/
    }
</style>
<?php eb();?>
<?php sb('content');?>
<?php include "../_connection/db.php"; ?>
<?php
    $MenuSetting = "department";
    include_once("menu_user.php");
?>
<div class="box">
<div class="box-header">
<div class="box-title">รายละเอียดหน่วยงาน</div><br><br>
    <div class="tree">
    <ul>
        <li>
            <span><i class="icon-calendar"></i> 2013, Week 2</span>
            <ul>
                <li>
                	<span class="badge badge-success"><i class="icon-minus-sign"></i> Monday, January 7: 8.00 hours</span>
                    <ul>
                        <li>
	                        <a href=""><span><i class="icon-time"></i> 8.00</span> &ndash; Changed CSS to accomodate...</a>
                        </li>
                    </ul>
                </li>
                <li>
                	<span class="badge badge-success"><i class="icon-minus-sign"></i> Tuesday, January 8: 8.00 hours</span>
                    <ul>
                        <li>
	                        <span><i class="icon-time"></i> 6.00</span> &ndash; <a href="">Altered code...</a>
                        </li>
                        <li>
	                        <span><i class="icon-time"></i> 2.00</span> &ndash; <a href="">Simplified our approach to...</a>
                        </li>
                    </ul>
                </li>
                <li>
                	<span class="badge badge-warning"><i class="icon-minus-sign"></i> Wednesday, January 9: 6.00 hours</span>
                    <ul>
                        <li>
	                        <a href=""><span><i class="icon-time"></i> 3.00</span> &ndash; Fixed bug caused by...</a>
                        </li>
                        <li>
	                        <a href=""><span><i class="icon-time"></i> 3.00</span> &ndash; Comitting latest code to Git...</a>
                        </li>
                    </ul>
                </li>
                <li>
                	<span class="badge badge-important"><i class="icon-minus-sign"></i> Wednesday, January 9: 4.00 hours</span>
                    <ul>
                        <li>
	                        <a href=""><span><i class="icon-time"></i> 2.00</span> &ndash; Create component that...</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <span><i class="icon-calendar"></i> 2013, Week 3</span>
            <ul>
                <li>
                	<span class="badge badge-success"><i class="icon-minus-sign"></i> Monday, January 14: 8.00 hours</span>
                    <ul>
                        <li>
	                        <span><i class="icon-time"></i> 7.75</span> &ndash; <a href="">Writing documentation...</a>
                        </li>
                        <li>
	                        <span><i class="icon-time"></i> 0.25</span> &ndash; <a href="">Reverting code back to...</a>
                        </li>
                    </ul>
                </li>
		    </ul>
        </li>
    </ul>
</div>
</div>
</div>
</div>
<?php eb();?>
<?php sb('js_and_css_footer');?>
<script>
    
</script>
<script src="../_plugins/treeview/script.js">" type="text/javascript"></script>
<link href="../_plugins/treeview/style.css" rel="stylesheet" type="text/css"/>
<script src="../_plugins/dataTables/jquery.dataTables.min.js"></script>
<script src="../_plugins/dataTables/dataTables.bootstrap.min.js"></script>
<link href="../_plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"></script>
<?php eb();?>
 
<?php render($MasterPage);?>