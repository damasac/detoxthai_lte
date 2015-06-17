<?php require_once '_theme/util.inc.php';  $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>
<?php
  $returnurl=$_POST['returnurl'];
  if ($returnurl=="") $returnurl=$_GET['returnurl'];
  if ($returnurl=="") $returnurl=$_SERVER['HTTP_REFERER'];

?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Login
      <small>Please login.</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Login</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

          <div class="error-page">
            <h2 class="headline text-yellow"> Login</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i> ท่านต้องทำการ Login ก่อน.</h3>
              <p>
                หน้าที่ท่านต้องการเข้าถึง จำเป็นต้องมีการ Login ก่อน.
                ทำการ Login เข้าสู่ระบบ <a href='login.php?returnurl=<?php urlencode($returnurl);?>'>คลิกที่นี่</a>.
              </p>
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->

  </section><!-- /.content -->'
  
<?php eb();?>


<?php sb('js_and_css_footer');?>
<?php eb();?>
 
<?php render($MasterPage);?>          