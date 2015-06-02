Detox Thai (LTE)
===================================
Detoxthai PHP Framework Modified by vut

GETTING STARTED
---------------
* starter.php

```php
<?php require_once 'theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> สวัสดีครับ <?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>
<?php include "connection/db.php"; ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Page Header
            <small>Optional description</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
<?php eb();?>


<?php sb('js_and_css_footer');?>
<script src=""></script>
<?php eb();?>
 
<?php render($MasterPage);?>
```