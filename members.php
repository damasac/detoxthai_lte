<?php require_once '_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวมแ <?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>
<?php include_once "_connection/db_base.php"; ?>

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Top Navigation
      <small>Example 2.0</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">SITE NAME HERE</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">


          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">รายชื่อสมาชิก</h3>
                  <div class="box-tools">
                    <div class="input-group">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ลำดับ</th>
                      <th>ชื่อเรียกขาน</th>
                      <th>วันที่สมัคร</th>
                      <th>Follow</th>
                    </tr>
                    <?php
                      $result = $mysqli->query("SELECT `id`, `username`, `password`, `email`, `fname`, `lname`, `status`, `hcode`, `area`, `district`, `amphur`, `province`, `tel`, DATE_FORMAT(`createdate`,'%d-%m-%Y') AS `createdate`
                                                FROM puser");
                      $count = 1;
                      if ($result !== false) {
                        foreach($result as $row) {
                          echo "<tr>";
                          echo "<td>".$count."</td>";
                          echo "<td>".$row['username']."</td>";
                          echo "<td>".$row['createdate']."</td>";
                          echo "<td><button class='btn btn-block btn-default btn-sm'>Follow</button></td>";
                          echo "</tr>";

                          $count++;
                        }
                      }
                    ?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>

  </section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>
<?php eb();?>

<?php render($MasterPage);?>
