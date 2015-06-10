<?php require_once '../_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>

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
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
          <th>
            ชื่อ - นามสกุล
          </th>
          <th>
          </th>
        </tr>
        <?php
        $count = 1;
        $result = $mysqli->query("SELECT username, CONCAT(  fname, ' ', lname) AS name
          FROM site_manage_user
          JOIN puser ON site_manage_user.user_id = puser.id");

        if ($result !== false) {
          foreach ($result as $row) {
            echo "<tr>";
            echo "<td>".$count."</td>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>
            <button class='btn btn-danger btn-flat' id='btndel'>
              <i class='fa fa-fw fa-trash'></i>
            </button>
            </td>";
            echo "</tr>";

            $count++;
          }
        }
        ?>
      </table>
      <p></p>
      <div class="col-sm-offset-5 col-sm-2 text-center">
        <div class="btn-group">
          <select class="form-control" id="user_id">
            <?php
            $result = $mysqli->query("SELECT id, username FROM puser");

            if ($result !== false) {
              foreach ($result as $row) {
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
      $.post("create_site_manage_user.php",
      {
        site_id: <?php echo $site_id; ?>,
        user_id: $('#user_id').val(),
      },
      function(data,status){
        location.reload();
      });
    });

    $("#btndel").click(function(){
      $.post("delete_site_manage_user.php",
      {
        site_id: <?php echo $site_id; ?>,
        user_id: $('#user_id').val(),
      },
      function(data,status){
        location.reload();
      });
    });
  });
</script>
<?php eb();?>

<?php render($MasterPage);?>
