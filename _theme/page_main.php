<?php require_once '_theme/util.inc.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>{$title}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_plugins/icon-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_plugins/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />    
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!--Page Load Progress Bar [ OPTIONAL ]-->
	<link href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_plugins/pace/pace.css" rel="stylesheet">
	<script src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_plugins/pace/pace.js"></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        @media (max-width:430px) {
            #divusername {
                display: none;
            }
        }
    </style>
	{$js_and_css_head}
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">               
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>" class="navbar-brand"><b>Detox</b>Thai</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>home.php" data-toggle="tooltip" data-placement="bottom" title="หน้าแรกของศูนย์ (Portal)">หน้าแรก <span class="sr-only">(current)</span></a></li>
                <li><a href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>members.php" data-toggle="tooltip" data-placement="bottom" title="สมาชิกทั้งหมดของ DetoxThai (Member)">สมาชิก</a></li>
		<li><a href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>feeds.php" data-toggle="tooltip" data-placement="bottom" title="เหตุการณ์ DetoxThai (Feeds)">เหตุการณ์</a></li>
                <li><a href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>sites.php" data-toggle="tooltip" data-placement="bottom" title="หน้าแสดงรายการรวมทุกศูนย์ (Site)">ค่ายล้างพิษตับ</a></li>
                <li><a href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>schedules.php" data-toggle="tooltip" data-placement="bottom" title="รายการแสดงหลักสูตรล้างพิษตับของทุกศูนย์ (Course)">หลักสูตรล้างพิษตับ</a></li>
                
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cogs"></span><span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>dev_view.php">Dev View</a></li>
                    <li><a target="_blank" href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>example_pages/widgets.html">Example</a></li>
                    <li class="divider"></li>
                    <li><a target="_blank" href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>documentation">Document</a></li>
                  </ul>
                </li>
                
              </ul>

            </div><!-- /.navbar-collapse -->
<?php

if ($_SESSION[SESSIONPREFIX.'puser_id'] != "") {
?>  
            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->
                  <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-envelope-o"></i>
                      <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have 4 messages</li>
                      <li>
                        <!-- inner menu: contains the messages -->
                        <ul class="menu">
                          <li><!-- start message -->
                            <a href="#">
                              <div class="pull-left">
                                <!-- User Image -->
                                <img src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                              </div>
                              <!-- Message title and timestamp -->
                              <h4>
                                Support Team
                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                              </h4>
                              <!-- The message -->
                              <p>Why not buy a new awesome theme?</p>
                            </a>
                          </li><!-- end message -->
                        </ul><!-- /.menu -->
                      </li>
                      <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                  </li><!-- /.messages-menu -->

                  <!-- Notifications Menu -->
                  <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bell-o"></i>
                      <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have 10 notifications</li>
                      <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                          <li><!-- start notification -->
                            <a href="#">
                              <i class="fa fa-users text-aqua"></i> 5 new members joined today
                            </a>
                          </li><!-- end notification -->
                        </ul>
                      </li>
                      <li class="footer"><a href="#">View all</a></li>
                    </ul>
                  </li>
                  <!-- Tasks Menu -->
                  <li class="dropdown tasks-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-flag-o"></i>
                      <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have 9 tasks</li>
                      <li>
                        <!-- Inner menu: contains the tasks -->
                        <ul class="menu">
                          <li><!-- Task item -->
                            <a href="#">
                              <!-- Task title and progress text -->
                              <h3>
                                Design some buttons
                                <small class="pull-right">20%</small>
                              </h3>
                              <!-- The progress bar -->
                              <div class="progress xs">
                                <!-- Change the css width attribute to simulate progress -->
                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                  <span class="sr-only">20% Complete</span>
                                </div>
                              </div>
                            </a>
                          </li><!-- end task item -->
                        </ul>
                      </li>
                      <li class="footer">
                        <a href="#">View all tasks</a>
                      </li>
                    </ul>
                  </li>
                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <img src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>img/userimg.jpg" class="user-image" alt="User Image"/>
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span id="divusername">Admin</span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- The user image in the menu -->
                      <li class="user-header">
                        <img src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>img/userimg.jpg" class="img-circle" alt="User Image" />
                        <p>
                          Administrator
                          <small>Member since Nov. 2012</small>
                        </p>
                      </li>
                      <!-- Menu Body -->
                      <li class="user-body">
                        <div class="col-xs-4 text-center">
                          <a href="#">Followers</a>
                        </div>
                        <div class="col-xs-4 text-center">
                          <a href="#"></a>
                        </div>
                        <div class="col-xs-4 text-center">
                          <a href="#">Friends</a>
                        </div>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="#" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                          <a href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>logout.php" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
<?php
}else{
?>
            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
		  <li class="dropdown user user-menu">
		    <a href="login.php"><span class="badge bg-yellow"> เข้าสู่ระบบ </span></a>
		  </li>
		  <li class="dropdown user user-menu">
		    <a href="register.php"><span class="badge bg-yellow"> ลงทะเบียน </span></a>
		  </li>
		  <li class="dropdown user user-menu">
		    <a href="forminput.php"><span class="badge bg-yellow"> บันทึกข้อมูล </span></a>
		  </li>		  
                </ul>
              </div><!-- /.navbar-custom-menu -->
<?php
}
?>
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->

      <div class="content-wrapper">
        <div class="container">
         {$content}
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->
    <footer class="main-footer">
        <div class="container">
          <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
          </div>
          <strong>Copyright &copy; 2014-2015 <a href="#">Detox Thai</a>.</strong> All rights reserved.
        </div><!-- /.container -->
      </footer>


    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery Validation -->
    <script src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_plugins/jQueryValidate/jquery.validate.js"></script>    
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_dist/js/app.min.js" type="text/javascript"></script>
	 <!-- Slimscroll -->
    <script src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_plugins/fastclick/fastclick.min.js'></script>
    <!-- iCheck -->
    <script src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  

    {$js_and_css_footer}
  </body>
</html>