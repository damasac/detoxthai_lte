<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

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
                      <th>ชื่อ - สกุล</th>
                      <th>วันที่สมัคร</th>
                      <th>Follow</th>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>John Doe</td>
                      <td>11-7-2014</td>
                      <td><button class="btn btn-block btn-default btn-sm">Follow</button></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Alexander Pierce</td>
                      <td>11-7-2014</td>
                      <td><button class="btn btn-block btn-default btn-sm">Follow</button></td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Bob Doe</td>
                      <td>11-7-2014</td>
                      <td><button class="btn btn-block btn-default btn-sm">Follow</button></td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Mike Doe</td>
                      <td>11-7-2014</td>
                      <td><button class="btn btn-block btn-default btn-sm">Follow</button></td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>

  </section><!-- /.content -->'
  
<?php eb();?>


<?php sb('js_and_css_footer');?>
<?php eb();?>
 
<?php render($MasterPage);?>