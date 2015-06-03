<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>
<?php include_once "_connection/db.php"; ?>

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      SQL Tables
      <small>สำหรับ Manipulate database</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">SQL</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-primary">
      <!-- row -->
      <div class="row" style="margin: 10px;">
        <div class="col-md-12">



                  <pre style="font-weight: 600;">

DROP TABLE IF EXISTS `puser`;
CREATE TABLE `puser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hcode` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `amphur` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `createdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `puser`
-- ----------------------------
INSERT INTO `puser` VALUES ('1', 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'admin@admin.com', 'Admin', '', '1', '13777', '7', '400101', '4001', '40', '2015-05-22 15:17:01');


                  </pre>
      
      

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- / .box solid -->


  </section><!-- /.content -->'
  
<?php eb();?>


<?php sb('js_and_css_footer');?>
<?php eb();?>
 
<?php render($MasterPage);?>