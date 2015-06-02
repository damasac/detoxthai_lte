<?php
session_start();
header("Content-type:text/html; charset=UTF-8");

if (isset($_SESSION['tpc_puser_hcode'])) {
  Header("Location: home.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Thai Palliative Care</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="_bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- jQuery 2.1.4 -->
    <script src="_plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="_bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Font Awesome Icons -->
    <link href="_plugins/icon-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!--Page Load Progress Bar [ OPTIONAL ]-->
	<link href="_plugins/pace/pace.css" rel="stylesheet">
	<script src="_plugins/pace/pace.js"></script>
    <!-- Theme style -->
    <link href="_dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<!-- Login theme -->
	<link href="login/css/main.css" rel="stylesheet" type="text/css" />
	<!--BG -->
	<link href="login/css/bg.css" rel="stylesheet" type="text/css" />

  </head>

<body>
<!-- Content Header (Page header) -->
<div id="container" class="cls-container">
		
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay" style="background-image: url('login/img/bg-img-<?php echo rand(1,5); ?>.jpg');" class="bg-img "></div>
		
		
		<!-- HEADER -->
		<!--===================================================-->
		<div class="cls-header cls-header-lg">
			<div class="cls-brand">
				<a class="box-inline" href=".">
					<!-- <img alt="Nifty Admin" src="img/logo.png" class="brand-icon"> -->
					<span class="h1">Thai Palliative</span>
				</a>
			</div>
		</div>
		<!--===================================================-->
		
		
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
			
		<div row="row">
            <div class="col-md-4">
				<div class="cls-content-sm panel">
					<div class="panel-body">
                        <img src="img/karunruk-logo.png" alt="karunruk-logo" class="img-responsive img-rounded" style="margin: auto;">
						<div style="display: none;" id="alert-login" class="callout callout-danger"></div>
						<p class="pad-btm h2">Sign In to system panel</p>
						<form id="frm-login" onsubmit="submit_login(); return false;">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-user"></i></div>
									<input type="text" name="username" class="form-control" placeholder="E-mail or Username">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
									<input type="password" name="password" class="form-control" placeholder="Password">
								</div>
							</div>
							<button class="btn btn-success btn-lg btn-block" type="submit">
								<i class="fa fa-sign-in"></i> Login
							</button>
						</form>
					</div>
				</div>
				<div class="pad-ver">
					<a href="#" class="btn-link mar-rgt">Forgot password ?</a>
					<a href="#" class="btn-link mar-lft">Contact us</a>
				</div>
			</div>
			
			<div class="col-md-8">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom: -20px; color: #000;">
  <div class="panel panel-info">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <div class="text-left">
        <a class="text-left h4" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          จำนวนผู้ป่วย ใน Thai Palliative
        </a>
        </div>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
			<div class="table-responsive no-padding">
            <table class="table table-hover h4">
			<tbody>
			<tr>
			<td class="h2 text-right">ทั้งหมด</td>
			<td class="textvaluebig text-right">15,367</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr>
			<td class="h3 text-right">นับตั้งแต่ต้นปี 2557</td>
			<td class="textvaluesmall text-right">3,665</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr>
			<td class="h4 text-right">เดือนนี้ พ.ย. 2557</td>
			<td class="textvaluesmall text-right">34</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr>
			<td class="h4 text-right">สัปดาห์นี้</td>
			<td class="textvaluesmall text-right">4</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr>
			<td class="h4 text-right">วันนี้</td>
			<td class="textvaluesmall text-right">2</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			</tbody>
			</table>
			</div>

      </div>
    </div>
  </div>
  <div class="panel panel-info">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <div class="text-left">
        <a class="collapsed text-left h4" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          จำนวนผู้ป่วย วันนี้ 2 ราย
        </a>
        </div>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
			<div class="table-responsive no-padding">
            <table class="table table-hover h4">
			<tbody>
			<tr class="odd">
			<td class="text-right">ผู้ป่วยใน</td>
			<td class="textvaluesmall text-right">1</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr>
			<td class="text-right">มาตามนัด</td>
			<td class="textvaluesmall text-right">1</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr class="odd">
			<td class="text-right">Refer มา</td>
			<td class="textvaluesmall text-right">-</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr>
			<td class="text-right">Walk-in</td>
			<td class="textvaluesmall text-right">-</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			</tbody>
			</table>
			</div>
      </div>
    </div>
  </div>
  <div class="panel panel-info">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <div class="text-left">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <span class="h4">จำนวนผู้ป่วยจำแนกตามหน่วยบริการ</span>
        </a>
        </div>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
			<div class="table-responsive no-padding">
            <table class="table table-hover h4">
			<thead>
			<tr>
			<th> </th>
			<th class="text-right">ทั้งหมด</th>
			<th class="text-right">ปีนี้</th>
			<th class="text-right">เดือนนี้</th>
			<th class="text-right">วันนี้</th>
			</tr>
			</thead>
			<tbody>
			<tr class="odd footable-disabled">
			<td class="textlabelbold text-left" colspan="5">1. โรงพยาบาลศูนย์&#8203;ฯ ขอนแก่น</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">50,554</td>
			<td class="textvaluesmall text-right">17,869</td>
			<td class="textvaluesmall text-right">4,921</td>
			<td class="textvaluesmall text-right">766</td>
			</tr>
			<tr class="odd footable-disabled">
			<td class="textlabelbold text-left" colspan="5">2. โรงพยาบาลมะเร็ง อุดร</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">22,578</td>
			<td class="textvaluesmall text-right">8,407</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">266</td>
			</tr>
			<tr class="odd footable-disabled">
			<td class="textlabelbold text-left" colspan="5">3. โรงพยาบาลศรีนครินทร์</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">38,351</td>
			<td class="textvaluesmall text-right">4,178</td>
			<td class="textvaluesmall text-right">487</td>
			<td class="textvaluesmall text-right">96</td>
			</tr>
			<!-- <tr class="odd footable-disabled">
			<td class="textlabelbold text-left" colspan="5">4. โรงพยาบาล A</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>
			<tr class="odd footable-disabled">
			<td class="textlabelbold text-left" colspan="5">5. โรงพยาบาล B</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>
			<tr class="odd footable-disabled">
			<td class="textlabelbold text-left" colspan="5">6. โรงพยาบาล C</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>			
			<tr class="odd footable-disabled">
			<td class="textlabelbold text-left" colspan="5">7. โรงพยาบาล D</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>			
			<tr class="odd footable-disabled">
			<td class="textlabelbold text-left" colspan="5">8. โรงพยาบาล E</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>			
			<tr class="odd footable-disabled">
			<td class="textlabelbold text-left" colspan="5">9. โรงพยาบาล F</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>			
			<tr class="odd footable-disabled">
			<td class="textlabelbold text-left" colspan="5">10. โรงพยาบาล G</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>			 -->
			</tbody>
			</table>
			</div>

      </div>
    </div>
  </div>
</div>

			</div>
			
		</div>
		</div>
		<!--===================================================-->
		
		
	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->

<script src="login/js/main.js" type="text/javascript"></script>
<script src="login/js/login.min.js" type="text/javascript"></script>

</body>
 
</html>