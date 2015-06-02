<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> Home <?php eb();?>

<?php sb('js_and_css_head'); ?>
<?php eb();?>

<?php sb('content_header');?>
<?php include "_connection/db.php"; ?>



<?php eb();?>

<?php sb('content');?>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  </ol>
        <div class="info-box">
          <span class="info-box-icon bg-blue"><i class="fa fa-home"></i></span>
          
          <div class="info-box-content">
            <span class="info-box-text"><h4>Thai Palliative Care Cloud</h4></span>
            <span class="info-box-text">
              <div id="address-bar">
                      
                      <div class="address-box">
                              <span> ตึก สว.1 ชั้น 18 รพ.ศรีนครินทร์ คณะแพทยศาสตร์ ม.ขอนแก่น 40002</span>
                      </div>
                      <div class="phone-box">
                              <span class="top-email"><i class="fa fa-phone"></i> 084-4099935, (043)366-656</span>&nbsp;&nbsp;&nbsp;
                              <span class="top-email"><i class="fa fa-envelope"></i><a href="mailto:info@karunruk.com"> info@karunruk.com</a></span>
                      </div>
              </div><!---address-bar-->
            </span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <center><img src="ss1.png" class="img-responsive img-rounded" border=0></center><br>
          <center><img src="ss2.png" class="img-responsive img-rounded" border=0></center>
        </section>
        <section class="content-header">
          <h1>
            $_SESSION
            <small>Development mode</small>
          </h1>
          
        </section>

        <!-- Main content -->
        <section class="content">
            <pre>
            <?php print_r($_SESSION); ?>
            </pre>
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
        
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="color: #000;">
  <div class="panel panel-primary">
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
  <div class="panel panel-primary">
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
  <div class="panel panel-primary">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <div class="text-left">
        <a class="collapsed h4" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          จำนวนผู้ป่วยจำแนกตามหน่วยบริการ
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
			
			</tbody>
			</table>
			</div>

      </div>
    </div>
  </div>
</div>

			        
<?php eb();?>


<?php sb('js_and_css_footer');?>
<?php eb();?>
 
<?php render($MasterPage);?>