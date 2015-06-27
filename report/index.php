<?php
require_once '../_theme/util.inc.php';

$MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('notifications');?>
  <?php include_once '../notifications.php'; ?>
<?php eb();?>

<?php sb('js_and_css_head'); ?>
        <link href="../_plugins/js-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script src="../_plugins/js-fileinput/js/fileinput.js" type="text/javascript"></script>
<?php eb();?>

<?php sb('content');?>

<?php include_once "../_connection/db_base.php"; ?>

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Time Line
      <small>ศูนย์หลัก</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <li class="active">รายงาน</li>
    </ol>
  </section>
<?php
    //ส่วนที่1
   $result_total = $mysqli->query("SELECT COUNT(*) AS total FROM puser");
    $row_total = $result_total->fetch_assoc();
    $total = $row_total['total'];
    $result_form = $mysqli->query("SELECT COUNT(DISTINCT a.id) AS form FROM puser AS a INNER JOIN tbl_surveyuser AS b ON a.id = b.user_id");
    $row_form = $result_form->fetch_assoc();
    $total_form = $row_form['form'];
     $result_site = $mysqli->query("SELECT COUNT(*) AS site FROM puser AS a INNER JOIN site_detail AS b ON a.id = b.create_user");
    $row_site = $result_site->fetch_assoc();
    $total_site = $row_site['site'];
    $result_schedule = $mysqli->query("SELECT COUNT(*) AS schedule FROM puser AS a INNER JOIN site_schedule AS b ON a.id = b.user_id");
    $row_schedule = $result_schedule->fetch_assoc();
    $total_schedule = $row_schedule['schedule'];

?>
  <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">สถิติ DetoxThai</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                      </ul>
                    </div>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <p class="text-center">
                        <h3 class="box-title">ส่วนที่ 1: ภาพรวม</h3>
                      </p>


                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title">สถิติด้านจำนวน</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <table class="table table-bordered table-striped">
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>รายการ</th>
                              <th style="width: 40px">จำนวน</th>
                            </tr>
                            <tr>
                              <td>1.</td>
                              <td> จำนวนสมาชิกที่ลงทะเบียนใน DetoxThai</td>
                              <td><span class="badge bg-red"><?php echo $total; ?></span></td>
                            </tr>
                            <tr>
                              <td>2.</td>
                              <td>จำนวนสมาชิกที่บันทึกข้อมูลใน Liver Flushing Registry</td>
                              <td><span class="badge bg-yellow"><?php echo $total_form; ?></span></td>
                            </tr>
                            <tr>
                              <td>3.</td>
                              <td>จำนวนศูนย์สุขภาพองค์รวม</td>
                              <td><span class="badge bg-light-blue"><?php echo $total_site; ?></span></td>
                            </tr>
                            <tr>
                              <td>4.</td>
                              <td> จำนวนหลักสูตรสุขภาพองค์รวม</td>
                              <td><span class="badge bg-green"><?php echo $total_schedule; ?></span></td>
                            </tr>
                          </table>
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->



                    </div><!-- /.col -->
                    <div class="col-md-6">
                      <p class="text-center">
                        <h3 class="box-title">ส่วนที่ 2: การล้างพิษตับ</h3>
                      </p>

                   
                      <div class="box box-default">
                        <div class="box-header with-border">
                          <h3 class="box-title">กราฟวงกลมแสดงจำนวนผู้ล้างพิษตับ จำแนกตาม เพศ ระดับการศึกษา อาชีพ</h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-8">
                              <div class="chart-responsive">
                                <canvas id="pieChart" height="150"></canvas>
                              </div><!-- ./chart-responsive -->
                            </div><!-- /.col -->
                            <div class="col-md-4">
                              <ul class="chart-legend clearfix">
                                <li><i class="fa fa-circle-o text-red"></i> ชาย</li>
                                <li><i class="fa fa-circle-o text-green"></i> หญิง</li>
                              </ul>
                            </div><!-- /.col -->
                          </div><!-- /.row -->
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div>
                    <div class="col-md-6">
                      <p class="text-center">
                         <h3 class="box-title">&nbsp;</h3>
                      </p>                        
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title">กราฟแท่งแนวนอนแสดงจำนวนผู้ล้างพิษตับ จำแนกตามจำนวนแก้ว</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <table class="table table-bordered table-striped">
                            <tr>
                              <th style="width: 80px">จำนวนแก้ว</th>
                              <th>กราฟ</th>
                              <th style="width: 80px">จำนวนคน</th>
                            </tr>
                            <tr>
                              <td>1-10</td>
                              <td>
                                <div class="progress progress-xs progress-striped active">
                                  <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                </div>
                              </td>
                              <td><span class="badge bg-red">xx</span></td>
                            </tr>
                            <tr>
                              <td>11-20</td>
                              <td>
                                <div class="progress progress-xs progress-striped active">
                                  <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                                </div>
                              </td>
                              <td><span class="badge bg-yellow">xx</span></td>
                            </tr>
                            <tr>
                              <td>21-30</td>
                              <td>
                                <div class="progress progress-xs progress-striped active">
                                  <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                                </div>
                              </td>
                              <td><span class="badge bg-light-blue">xx</span></td>
                            </tr>
                            <tr>
                              <td>31-40</td>
                              <td>
                                <div class="progress progress-xs progress-striped active">
                                  <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                                </div>
                              </td>
                              <td><span class="badge bg-green">xx</span></td>
                            </tr>
                          </table>
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                  <div class="row">
                    <div class="col-md-12">
                      <p class="text-center">
                        <h3 class="box-title">ส่วนที่ 3: แผนที่</h3>
                      </p>
                      <div class="box box-default">
                        <div class="box-header with-border">
                          <h3 class="box-title">แผนที่ที่ตั้งศูนย์ล้างพิษ</h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <div class="row">
                            <iframe src="../maps.php" scrolling="no" frameborder="no" width="100%" height="600"></iframe>
                          </div><!-- /.row -->
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->

                    </div><!-- /.col -->


                  </div><!-- /.row -->
                  <div class="row">
                    <div class="col-md-12">
                      <p class="text-center">
                        <strong>&nbsp;</strong>
                      </p>
                      <div class="box box-default">
                        <div class="box-header with-border">
                          <h3 class="box-title">แผนที่ที่ตั้งสมาชิก</h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <div class="row">
                            <iframe src="../maps.php" scrolling="no" frameborder="no" width="100%" height="600"></iframe>
                          </div><!-- /.row -->
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->

                    </div><!-- /.col -->


                  </div><!-- /.row -->

                </div><!-- ./box-body -->
                <div class="box-footer">

                </div><!-- /.box-footer -->
              </div><!-- /.box -->
          </div><!-- /.row -->      
        </section><!-- /.content -->

           <script src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>/_plugins/chartjs/Chart.js" type="text/javascript"></script>
                          <script src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>/_plugins/chartjs/Chart.min.js" type="text/javascript"></script>
                          <script>
                              //-------------
                              //- PIE CHART -
                              //-------------
                              // Get context with jQuery - using jQuery's .get() method.
                              var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
                              var pieChart = new Chart(pieChartCanvas);
                              var PieData = [
                                {
                                  value: 700,
                                  color: "#f56954",
                                  highlight: "#f56954",
                                  label: "ชาย"
                                },
                                {
                                  value: 500,
                                  color: "#00a65a",
                                  highlight: "#00a65a",
                                  label: "หญิง"
                                },
                              ];
                              var pieOptions = {
                                //Boolean - Whether we should show a stroke on each segment
                                segmentShowStroke: true,
                                //String - The colour of each segment stroke
                                segmentStrokeColor: "#fff",
                                //Number - The width of each segment stroke
                                segmentStrokeWidth: 1,
                                //Number - The percentage of the chart that we cut out of the middle
                                percentageInnerCutout: 50, // This is 0 for Pie charts
                                //Number - Amount of animation steps
                                animationSteps: 100,
                                //String - Animation easing effect
                                animationEasing: "easeOutBounce",
                                //Boolean - Whether we animate the rotation of the Doughnut
                                animateRotate: true,
                                //Boolean - Whether we animate scaling the Doughnut from the centre
                                animateScale: false,
                                //Boolean - whether to make the chart responsive to window resizing
                                responsive: true,
                                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                                maintainAspectRatio: false,
                                //String - A legend template
                                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
                                //String - A tooltip template
                                tooltipTemplate: "<%=label%> <%=value %>  คน"
                              };
                              //Create pie or douhnut chart
                              // You can switch between pie and douhnut using the method below.  
                              pieChart.Doughnut(PieData, pieOptions);
                              //-----------------
                              //- END PIE CHART -
                              //-----------------                          
                          </script>


<?php eb();?>

<?php sb('js_and_css_footer');?>

<?php eb();?>

<?php render($MasterPage);?>
