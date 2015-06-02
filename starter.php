<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> สวัสดีครับ <?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>
<?php include_once "_connection/db.php"; ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Page Header
            <small>Optional description</small>
          </h1>
          <p><?php echo $_SESSION['test']; ?></p>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
<?php eb();?>


<?php sb('js_and_css_footer');?>
<?php eb();?>
 
<?php render($MasterPage);?>