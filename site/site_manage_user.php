<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>

<?php eb();?>

<?php sb('notifications');?>
  <?php include_once '../notifications.php'; ?>
<?php eb();?>

<?php include_once "../_connection/db_base.php"; ?>

<?php
isset($_GET['site_id']) ? $site_id = $_GET['site_id'] :  $site_id = '';

/** Check security. */
$check_point = 0;

$result = $mysqli->query("SELECT COUNT(*) check_secu
    FROM site_manage_user
    WHERE user_id = '".$_SESSION[SESSIONPREFIX.'puser_id']."'
    AND site_id = '$site_id'");
$row = $result->fetch_assoc();

if (0 == $row['check_secu']) {
  $check_point = 1;
}

$result = $mysqli->query("SELECT COUNT(*) check_secu
    FROM site_detail
    WHERE create_user = '".$_SESSION[SESSIONPREFIX.'puser_id']."'
    AND id = '$site_id'");
$row = $result->fetch_assoc();

if (0 == $row['check_secu'] && $check_point) {
  echo 'การเข้าถึงข้อมูลถูกปฏิเสธ';
  exit;
}
?>

<?php sb('content');?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    เพิ่มผู้ดูแลศูนย์
    <small>เพิ่มผู้ดูแลศูนย์</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="../sites.php"><i class="fa fa-tachometer"></i> ค่ายล้างพิษ</a></li>
    <li><a href="site_manage.php">จัดการศูนย์</a></li>
    <li class="active">เพิ่มผู้ดูแลศูนย์</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box box-default">
    <div class="box-body">
      <table class="table table-bordered">
        <tr class="active">
          <th>
            ลำดับ
          </th>
          <th>
            ชื่อผู้ใช้
          </th>
          <!-- <th>
            ชื่อ - นามสกุล
          </th> -->
          <th>
          </th>
        </tr>
        <?php
        $count = 1;
        $result = $mysqli->query("SELECT username, site_id, user_id
          FROM site_manage_user
          JOIN puser ON site_manage_user.user_id = puser.id
          WHERE site_id = $site_id");

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
          //foreach ($result as $row) {
            echo "<tr>";
            echo "<td>".$count."</td>";
            echo "<td>".$row['username']."</td>";
            //echo "<td>".$row['name']."</td>";
            echo "<td>
            <a href='delete_site_manage_user.php?site_id=".$row['site_id']."&user_id=".$row['user_id']."' class='btn btn-danger btn-flat' id='btndel'>
              ลบ
            </a>
            </td>";
            echo "</tr>";

            $count++;
          }
        }
        ?>
      </table>
      <p></p>
      <div class="col-sm-offset-4 col-sm-4 text-center">
        <div class="btn-group">
          <select class="form-control" id="user_id">
            <option value="">เลือก</option>
            <?php
            $result = $mysqli->query("SELECT id, username FROM puser WHERE id != '".$_SESSION[SESSIONPREFIX.'puser_id']."'");

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['id']."'>".$row['username']."</option>";
              }
            }
            ?>
          </select>
        </div>
        <button id="save" class="btn btn-primary btn-flat">เพิ่ม</button>
      </div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>
<script>
  $(document).ready(function(){
    $("#save").click(function(){
      if ( 0 != $('#user_id').val() || '' != $('#user_id').val()) {
        $.post("create_site_manage_user.php",
        {
          site_id: <?php echo $site_id; ?>,
          user_id: $('#user_id').val(),
        },
        function(data,status){
          if (!data) {
            location.reload();
          }else{
            alert(data);
          }
        });
      } else {
      alert('กรุราเลือกผุ้ใช้');
      }
    });

  /*$("#btndel").click(function(){
    $.post("delete_site_manage_user.php",
    {
      site_id: <?php echo $site_id; ?>,
      user_id: $('#user_id').val(),
    },
    function(data,status){
      location.reload();
    });
  });*/
});
</script>
<?php eb();?>

<?php render($MasterPage);?>
