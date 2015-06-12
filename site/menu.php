<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<script src=""></script>
<?php eb();?>

<?php sb('content');?>
<?php include_once "../_connection/db_base.php"; ?>

<?php
    /** init */
    $id = $_GET['id'];
?>

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      จัดการเมนู
      <small>เพิ่ม แก้ไข ลบ เมนู</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="../site.php"><i class="fa fa-home"></i> ค่ายล้างพิษตับ</a></li>
      <li><a href="site_manage.php">จัดการศูนย์</a></li>
      <li><a href="index.php?id=<?php echo $id; ?>">จัดการหน้าเว็บ</a></li>
      <li class="active">จัดการเมนู</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">เมนู</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
            <tr class="active">
                <th>
                    ลำดับเมนู
                </th>
                <th>
                    ชื่อเมนู
                </th>
                <th>
                    การแสดงผล
                </th>
                <th>
                </th>
            </tr>
             <?php
                // prepare and query (direct)
                $result = $mysqli->query("SELECT id, menu_order, menu_name, display_menu FROM site_menu WHERE site_id = '$id' ORDER BY menu_order");
                $count = 1;
                // display it
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if(0 == $row['display_menu']){
                            $disstatus = "<span class='glyphicon glyphicon-ok text-success' aria-hidden='true'></span>";
                        }else{
                            $disstatus = "<span class='glyphicon glyphicon-remove text-danger' aria-hidden='true'></span>";
                        }

                        $html_sub_menu = "";
                        $getSubMenu = $mysqli->query("SELECT id, menu_name FROM site_submenu WHERE main_menu_id = ".$row['id']." ORDER BY menu_order");
                        while($submenu = $getSubMenu->fetch_assoc()) {
                        //foreach($getSubMenu as $submenu) {
                            $html_sub_menu .= "<tr>
                                                <td>- ".$submenu['menu_name']."</td>
                                                <td><a type='button' href=edit_sub_menu.php?id=".$submenu['id']."&site_id=".$id." class='btn btn-primary btn-flat'><i class='fa fa-fw fa-pencil'></i></a>
                                                <a type='button' href=delete_sub_menu.php?id=".$submenu['id']."&site_id=".$id." class='btn btn-danger btn-flat'><i class='fa fa-fw fa-trash'></i></a></td>
                                                </tr>";
                        }

                        echo "<tr>
                                <td>".$row['menu_order']."</td>
                                <td>".$row['menu_name']."<p></p><table class='table table-bordered'>".$html_sub_menu."</table></td><td>".$disstatus."</td>
                                <td><a type='button' href=edit_menu.php?id=".$row['id']."&site_id=".$id." class='btn btn-primary btn-flat'><i class='fa fa-fw fa-pencil'></i></a> <a type='button' href=delete_menu.php?id=".$row['id']."&site_id=".$id." class='btn btn-danger btn-flat'><i class='fa fa-fw fa-trash'></i></a></td></tr>";
                        $count++;
                    }
                }
            ?>
        </table>
        <p></p>
        <p class="text-center">
            <!-- Button trigger modal -->
            <!-- <a href="index.php?site_name=<?php echo $id; ?>" class="btn btn-primary btn-flat">
             กลับ
            </a> -->
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModal">
             เพิ่มเมนู
            </button>
        </p>
        </div><!-- /.box-body -->
  </div><!-- /.box -->

  </section><!-- /.content -->

  <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">เพิ่มเมนู</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal">
                <div class="form-group">
                  <label for="menuorder" class="col-sm-2 control-label">ลำดับเมนู</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="menuorder">
                        <?php
                          for($i=1; $i<=50; $i++){
                            echo '<option value='.$i.'>ลำดับ '.$i.'</option>';
                          }
                        ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="menuname" class="col-sm-2 control-label">ชื่อเมนู</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="menuname" placeholder="ชื่อเมนู">
                  </div>
                </div>
                <div class="form-group">
                  <label for="display" class="col-sm-2 control-label">การแสดงผล</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="display">
                        <option value="0">แสดงผล</option>
                        <option value="1">ไม่แสดงผล</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="subdisplay" class="col-sm-2 control-label">รูปแบบเมนู</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="subdisplay">
                        <option value="0">เมนูหลัก</option>
                        <option value="1">เมนูย่อย</option>
                    </select>
                  </div>
                </div>
                <div class="form-group" id="subdis">
                  <label for="mainmenu" class="col-sm-2 control-label">เมนูย่อยของ</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="mainmenu">
                        <?php
                            // prepare and query (direct)
                            $result = $mysqli->query("SELECT id, menu_name FROM site_menu WHERE site_id = '$id' ORDER BY id");
                            // display it
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='".$row['id']."'>".$row['menu_name']."</option>";
                                }
                            }
                        ?>
                    </select>
                  </div>
                </div>
              </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary btn-flat" id="btadd">เพิ่ม</button>
              </div>
            </div>
          </div>
        </div>

<?php eb();?>


<?php sb('js_and_css_footer');?>
  <script>
        $(document).ready(function(){
            $("#subdis").hide();
            $("#subdisplay").change(function(){
                var status = $("#subdisplay").val();
                //alert(status);
                if (0 == status) {
                    $("#subdis").hide();
                }else{
                    $("#subdis").show();
                }
            });

            $("#btadd").click(function(){
                $.post("add_menu.php",
                {
                  menuorder: $("#menuorder").val(),
                  menuname: $("#menuname").val(),
                  display: $("#display").val(),
                  subdisplay: $("#subdisplay").val(),
                  mainmenu: $("#mainmenu").val(),
                  site_id: '<?php echo $id; ?>',
                },
                function(data,status){
                  location.reload();
                });
            });
        });
    </script>
<?php eb();?>

<?php render($MasterPage);?>
