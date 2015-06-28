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

    //ส่วนที่2
    $result_sex = $mysqli->query("SELECT COUNT(a.ref_id_create) AS total,SUM(p1a3b1=1) AS male, SUM(p1a3b1=2) AS female FROM tbl_surveyform AS a INNER JOIN tbl_surveyuser AS b ON a.ref_id_create=b.id");
    $row_sex = $result_sex->fetch_assoc();
    $male = $row_sex['male'];
    $female = $row_sex['female'];

    $result = $mysqli->query("SELECT COUNT(a.id) AS edu0
      ,SUM(p1a5=1) AS edu1
      ,SUM(p1a5=2) AS edu2
      ,SUM(p1a5=3) AS edu3
      ,SUM(p1a5=4) AS edu4
      ,SUM(p1a5=5) AS edu5
      ,SUM(p1a5=6) AS edu6
      ,SUM(p1a5=7) AS edu7
      ,SUM(p1a5=8) AS edu8
      ,SUM(p1a5=9) AS edu9
      FROM tbl_surveyuser AS a INNER JOIN tbl_surveyform AS b ON a.id=b.ref_id_create");
    $row = $result->fetch_assoc();
    $edu1 = $row['edu1'];
    $edu2 = $row['edu2'];
    $edu3 = $row['edu3'];
    $edu4 = $row['edu4'];
    $edu5 = $row['edu5'];
    $edu6 = $row['edu6'];
    $edu7 = $row['edu7'];
    $edu8 = $row['edu8'];
    $edu9 = $row['edu9'];

        $result = $mysqli->query(" SELECT COUNT(a.id) AS job0
,SUM(p1a6=1) AS job1
,SUM(p1a6=2) AS job2
,SUM(p1a6=3) AS job3
,SUM(p1a6=4) AS job4
,SUM(p1a6=5) AS job5
,SUM(p1a6=6) AS job6
,SUM(p1a6=7) AS job7
,SUM(p1a6=8) AS job8
,SUM(p1a6=9) AS job9
,SUM(p1a6=10) AS job10
,SUM(p1a6=11) AS job11
,SUM(p1a6=12) AS job12
,SUM(p1a6=13) AS job13
,SUM(p1a6=14) AS job14
,SUM(p1a6=15) AS job15
,SUM(p1a6=16) AS job16
,SUM(p1a6=17) AS job17
,SUM(p1a6=18) AS job18
,SUM(p1a6=19) AS job19
,SUM(p1a6=20) AS job20
,SUM(p1a6=21) AS job21
,SUM(p1a6=22) AS job22
 FROM tbl_surveyuser AS a INNER JOIN tbl_surveyform AS b ON a.id=b.ref_id_create");
    $row = $result->fetch_assoc();
    $job1 = $row['job1'];
    $job2 = $row['job2'];
    $job3 = $row['job3'];
    $job4 = $row['job4'];
    $job5 = $row['job5'];
    $job6 = $row['job6'];
    $job7 = $row['job7'];
    $job8 = $row['job8'];
    $job9 = $row['job9'];
    $job10 = $row['job10'];
    $job11 = $row['job11'];
    $job12 = $row['job12'];
    $job13 = $row['job13'];
    $job14 = $row['job14'];
    $job15 = $row['job15'];
    $job16 = $row['job16'];
    $job17 = $row['job17'];
    $job18 = $row['job18'];
    $job19 = $row['job19'];
    $job20 = $row['job20'];
    $job21 = $row['job21'];
    $job22 = $row['job22'];
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
                          <h3 class="box-title">กราฟวงกลมแสดงจำนวนผู้ล้างพิษตับ จำแนกตามเพศ</h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="chart-responsive">
                                <canvas id="pieChart" height="150"></canvas>
                              </div><!-- ./chart-responsive -->
                            </div><!-- /.col -->
                            <div class="col-md-6">
                              <ul class="chart-legend clearfix">
                                <li><i class="fa fa-circle-o text-red"></i> ชาย</li>
                                <li><i class="fa fa-circle-o text-green"></i> หญิง</li>
                              </ul>
                            </div><!-- /.col -->
                          </div><!-- /.row -->
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                            <div class="box box-default">
                        <div class="box-header with-border">
                          <h3 class="box-title">กราฟวงกลมแสดงจำนวนผู้ล้างพิษตับ จำแนกตามระดับการศึกษา</h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="chart-responsive">
                                <canvas id="eduChart" height="150"></canvas>
                              </div><!-- ./chart-responsive -->
                            </div><!-- /.col -->
                            <div class="col-md-6">
                              <ul class="chart-legend clearfix">
                        <li><i class="fa fa-circle-o text-red"></i> ไม่ได้ศึกษา/ไม่มีวุฒิการศึกษา</li>
                        <li><i class="fa fa-circle-o text-purple"></i> ก่อนประถมศึกษา</li>
                        <li><i class="fa fa-circle-o text-lime"></i> ประถมศึกษา</li>
                        <li><i class="fa fa-circle-o text-black"></i> มัธยมศึกษาตอนต้น หรือเทียบเท่า</li>
                        <li><i class="fa fa-circle-o text-green"></i> มัธยมศึกษาตอนปลาย หรือเทียบเท่า</li>
                        <li><i class="fa fa-circle-o text-yellow"></i> ประกาศนียบัตรวิชาชีพ/อนุปริญญา</li>
                        <li><i class="fa fa-circle-o text-aqua"></i> ปริญญาตรี หรือเทียบเท่า</li>
                        <li><i class="fa fa-circle-o text-light-blue"></i> ปริญญาโท หรือเทียบเท่า</li>
                        <li><i class="fa fa-circle-o text-gray"></i> ปริญญาเอก หรือเทียบเท่า</li>                        
                              </ul>
                            </div><!-- /.col -->
                          </div><!-- /.row -->
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                      <div class="box box-default">
                        <div class="box-header with-border">
                          <h3 class="box-title">กราฟวงกลมแสดงจำนวนผู้ล้างพิษตับ จำแนกตามอาชีพ</h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="chart-responsive">
                                <canvas id="jobChart" height="150"></canvas>
                              </div><!-- ./chart-responsive -->
                            </div><!-- /.col -->
                            <div class="col-md-3">
                              <ul class="chart-legend clearfix">
                        <li><i class="fa fa-circle-o text-red"></i> นักเรียน</li>
                        <li><i class="fa fa-circle-o text-green"></i> ธุรกิจส่วนตัว</li>
                        <li><i class="fa fa-circle-o text-yellow"></i> แพทย์/พยาบาล</li>
                        <li><i class="fa fa-circle-o text-aqua"></i> ครู/อาจารย์</li>
                        <li><i class="fa fa-circle-o text-light-blue"></i> นักกฎหมาย</li>
                        <li><i class="fa fa-circle-o text-gray"></i> วิศวกร/ช่าง</li>
                        <li><i class="fa fa-circle-o text-purple"></i> พนักงานบัญชี</li>
                        <li><i class="fa fa-circle-o text-lime"></i> การตลาด</li>
                        <li><i class="fa fa-circle-o text-black"></i> รับราชการ</li>
                        <li><i class="fa fa-circle-o text-orange"></i> ที่ปรึกษา</li>
                        <li><i class="fa fa-circle-o text-maroon"></i> รัฐวิสาหกิจ</li>
                      </ul>
                    </div>
                         
                    <div class="col-md-3">
                      <ul class="chart-legend clearfix">
                        <li><i class="fa fa-circle-o text-olive"></i> ผู้จัดการ</li>
                        <li><i class="fa fa-circle-o" style="color:#7FFFD4"></i> พนักงานทั่วไป</li>
                        <li><i class="fa fa-circle-o" style="color:#8A2BE2"></i> ท่องเที่ยว</li>
                        <li><i class="fa fa-circle-o" style="color:#5F9EA0"></i> ออกแบบ/ดีไซน์</li>
                        <li><i class="fa fa-circle-o" style="color:#D2691E"></i>พนักงานโรงงาน</li>
                        <li><i class="fa fa-circle-o" style="color:#6495ED"></i> นักวิชาการ</li>
                        <li><i class="fa fa-circle-o" style="color:#00008B"></i> สื่อสารมวลชน</li>
                        <li><i class="fa fa-circle-o" style="color:#B8860B"></i> ดารา/นักแสดง</li>
                        <li><i class="fa fa-circle-o" style="color:#FF1493"></i> ว่างงาน</li>
                        <li><i class="fa fa-circle-o" style="color:#00FF7F"></i> ไม่ได้ทำงาน</li>
                        <li><i class="fa fa-circle-o" style="color:#8B4513"></i> อื่นๆ</li>
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
                                  <div class="progress-bar progress-bar-danger" style="width: 10%"></div>
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
                              var male = parseInt('<?=$male?>');
                              var female = parseInt('<?=$female?>');
                              var PieData = [
                                {
                                  value: (male),
                                  color: "#f56954",
                                  highlight: "#f56954",
                                  label: "ชาย"
                                },
                                {
                                  value: (female),
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
                          <script>
                              //-------------
                              //- EDU CHART -
                              //-------------
                              // Get context with jQuery - using jQuery's .get() method.
                              var eduChartCanvas = $("#eduChart").get(0).getContext("2d");
                              var eduChart = new Chart(eduChartCanvas);
                               var edu1 = parseInt('<?=$edu1?>');
                               var edu2 = parseInt('<?=$edu2?>');
                               var edu3 = parseInt('<?=$edu3?>');
                               var edu4 = parseInt('<?=$edu4?>');
                               var edu5 = parseInt('<?=$edu5?>');
                               var edu6 = parseInt('<?=$edu6?>');
                               var edu7 = parseInt('<?=$edu7?>');
                               var edu8 = parseInt('<?=$edu8?>');
                               var edu9 = parseInt('<?=$edu9?>');
                              var PieData = [
                                {
                                  value: (edu1),
                                  color: "#f56954",
                                  highlight: "#f56954",
                                  label: " ไม่ได้ศึกษา/ไม่มีวุฒิการศึกษา"
                                },
                                {
                                  value: (edu2),
                                  color: "#B48EAD", //purple
                                  highlight: "#B48EAD",
                                  label: "ก่อนประถมศึกษา"
                                },
                                  {
                                  value: (edu3),
                                  color: "#00FF00", //lime
                                  highlight: "#00FF00",
                                  label: "ประถมศึกษา"
                                },
                                {
                                  value: (edu4),
                                  color: "#000000", 
                                  highlight: "#000000",
                                  label: "มัธยมศึกษาตอนต้น หรือเทียบเท่า"
                                },
                                  {
                                  value: (edu5),
                                  color: "#00a65a", 
                                  highlight: "#00a65a",
                                  label: "มัธยมศึกษาตอนปลาย หรือเทียบเท่า"
                                },
                                {
                                  value: (edu6),
                                  color: "#f39c12", 
                                  highlight: "#f39c12",
                                  label: "ประกาศนียบัตรวิชาชีพ/อนุปริญญา"
                                },
                                  {
                                  value: (edu7),
                                  color: "#00c0ef", 
                                  highlight: "#00c0ef",
                                  label: "ปริญญาตรี หรือเทียบเท่า"
                                },
                                {
                                  value: (edu8),
                                  color: "#3c8dbc", 
                                  highlight: "#3c8dbc",
                                  label: "ปริญญาโท หรือเทียบเท่า"
                                },
                                  {
                                  value: (edu9),
                                  color: "#d2d6de", 
                                  highlight: "#d2d6de",
                                  label: "ปริญญาเอก หรือเทียบเท่า"
                                }
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
                              eduChart.Doughnut(PieData, pieOptions);
                              //-----------------
                              //- END EDU CHART -
                              //-----------------                          
                          </script>
                                               <script>
                              //-------------
                              //- JOB CHART -
                              //-------------
                              // Get context with jQuery - using jQuery's .get() method.
                              var jobChartCanvas = $("#jobChart").get(0).getContext("2d");
                              var jobChart = new Chart(jobChartCanvas);
                              var job1 = parseInt('<?=$job1?>');
                              var job2 = parseInt('<?=$job2?>');
                              var job3 = parseInt('<?=$job3?>');
                              var job4 = parseInt('<?=$job4?>');
                              var job5 = parseInt('<?=$job5?>');
                              var job6 = parseInt('<?=$job6?>');
                              var job7 = parseInt('<?=$job7?>');
                              var job8 = parseInt('<?=$job8?>');
                              var job9 = parseInt('<?=$job9?>');
                              var job10 = parseInt('<?=$job10?>');
                              var job11 = parseInt('<?=$job11?>');
                              var job12 = parseInt('<?=$job12?>');
                              var job13 = parseInt('<?=$job13?>');
                              var job14 = parseInt('<?=$job14?>');
                              var job15 = parseInt('<?=$job15?>');
                              var job16 = parseInt('<?=$job16?>');
                              var job17 = parseInt('<?=$job17?>');
                              var job18 = parseInt('<?=$job18?>');
                              var job19 = parseInt('<?=$job19?>');
                              var job20 = parseInt('<?=$job20?>');
                              var job21 = parseInt('<?=$job21?>');
                              var job22 = parseInt('<?=$job22?>');
                              var PieData = [
                                               {
                                  value: (job1),
                                  color: "#f56954",
                                  highlight: "#f56954",
                                  label: "นักเรียน"
                                },
                                {
                                  value: (job2),
                                  color: "#00a65a",
                                  highlight: "#00a65a",
                                  label: "ธุรกิจส่วนตัว"
                                },
                                {
                                  value: (job3),
                                  color: "#f39c12",
                                  highlight: "#f39c12",
                                  label: "แพทย์/พยาบาล"
                                },
                                {
                                  value: (job4),
                                  color: "#00c0ef",
                                  highlight: "#00c0ef",
                                  label: "ครู/อาจารย์"
                                },
                                {
                                  value: (job5),
                                  color: "#3c8dbc",
                                  highlight: "#3c8dbc",
                                  label: "นักกฎหมาย"
                                },
                                {
                                  value: (job6),
                                  color: "#d2d6de",
                                  highlight: "#d2d6de",
                                  label: "วิศวกร/ช่าง"
                                },
                                {
                                  value: (job7),
                                  color: "#B48EAD",
                                  highlight: "#B48EAD",
                                  label: "พนักงานบัญชี"
                                },
                                {
                                  value: (job8),
                                  color: "#00FF00",
                                  highlight: "#00FF00",
                                  label: "การตลาด"
                                },
                                {
                                  value: (job9),
                                  color: "#000000",
                                  highlight: "#000000",
                                  label: "รับราชการ"
                                },
                                {
                                  value: (job10),
                                  color: "#FFA500",
                                  highlight: "#FFA500",
                                  label: "ที่ปรึกษา"
                                },
                                {
                                  value: (job11),
                                  color: "#800000",
                                  highlight: "#800000",
                                  label: "รัฐวิสาหกิจ"
                                },
                                {
                                  value: (job12),
                                  color: "#808000",
                                  highlight: "#808000",
                                  label: "ผู้จัดการ"
                                },
                                {
                                  value: (job13),
                                  color: "#7FFFD4",
                                  highlight: "#7FFFD4",
                                  label: "พนักงานทั่วไป"
                                },
                                {
                                  value: (job14),
                                  color: "#8A2BE2",
                                  highlight: "#8A2BE2",
                                  label: "ท่องเที่ยว"
                                },
                                {
                                  value: (job15),
                                  color: "#5F9EA0",
                                  highlight: "#5F9EA0",
                                  label: "ออกแบบ/ดีไซน์"
                                },
                                {
                                  value: (job16),
                                  color: "#D2691E",
                                  highlight: "#D2691E",
                                  label: "พนักงานโรงงาน"
                                },
                                {
                                  value: (job17),
                                  color: "#6495ED",
                                  highlight: "#6495ED",
                                  label: "นักวิชาการ"
                                },
                                {
                                  value: (job18),
                                  color: "#00008B",
                                  highlight: "#00008B",
                                  label: "สื่อสารมวลชน"
                                },
                                {
                                  value: (job19),
                                  color: "#B8860B",
                                  highlight: "#B8860B",
                                  label: "ดารา/นักแสดง"
                                },
                                {
                                  value: (job20),
                                  color: "#FF1493",
                                  highlight: "#FF1493",
                                  label: "ว่างงาน"
                                },
                                {
                                  value: (job21),
                                  color: "#00FF7F",
                                  highlight: "#00FF7F",
                                  label: "ไม่ได้ทำงาน"
                                },
                                {
                                  value: (job22),
                                  color: "#8B4513",
                                  highlight: "#8B4513",
                                  label: "อื่นๆ"
                                }


                                      
                                //#FFA500 orange
                                //#800000 maroon
                                //#808000 olive
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
                              jobChart.Doughnut(PieData, pieOptions);
                              //-----------------
                              //- END JOB CHART -
                              //-----------------                          
                          </script>


<?php eb();?>

<?php sb('js_and_css_footer');?>

<?php eb();?>

<?php render($MasterPage);?>
