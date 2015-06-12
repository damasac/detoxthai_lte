<?php require_once '../_theme/util.inc.php'; chk_login(); $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<style type="text/css">
  #fix_size {
    margin: 0 auto;
    width: 95%;
  }
</style>
<?php eb();?>

<?php sb('notifications');?>
  <?php include_once '../notifications.php'; ?>
<?php eb();?>

<?php sb('content');?>
<?php include_once "../_connection/db_base.php"; ?>

<?php

$id = $_GET['id'];
isset($_GET['menu']) ? $menu = $_GET['menu'] :  $menu = '';

/** Check security. */
$check_point = 0;

$result = $mysqli->query("SELECT COUNT(*) check_secu
    FROM site_manage_user
    WHERE user_id = '".$_SESSION[SESSIONPREFIX.'puser_id']."'
    AND site_id = '$id'");
$row = $result->fetch_assoc();

if (0 == $row['check_secu']) {
  $check_point = 1;
}

$result = $mysqli->query("SELECT COUNT(*) check_secu
    FROM site_detail
    WHERE create_user = '".$_SESSION[SESSIONPREFIX.'puser_id']."'
    AND id = '$id'");
$row = $result->fetch_assoc();

if (0 == $row['check_secu'] && $check_point) {
  echo 'การเข้าถึงข้อมูลถูกปฏิเสธ';
  exit;
}

if ('' == $menu) {
    $result = $mysqli->query("SELECT menu_name
    FROM site_menu
    WHERE site_id = '$id'
    AND display_menu = 0
    ORDER BY menu_order");
    $row = $result->fetch_assoc();
    $count = $result->num_rows;
    if (0 == $count) {
        $menu_exit = 0;
    } else {
        echo "<script>
               window.location.href = 'index.php?menu=".$row['menu_name']."&id=".$id."'".";
              </script>";
    }
} else {
    $menu_exit = 1;
}

$edit_show = 1;
$arrMenu = array();

?>

<?php
    $result_name_site = $mysqli->query("SELECT site_name, create_date
                    FROM site_detail
                    WHERE id = '$id'");
    $id_desc = $result_name_site->fetch_assoc();
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    จัดการหน้าเว็บ
    <small>แก้ไขเนื้อหาหรือเมนูของเว็บ</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="../sites.php"><i class="fa fa-tachometer"></i> ค่ายล้างพิษตับ</a></li>
    <li><a href="site_manage.php">จัดการศูนย์</a></li>
    <li class="active">จัดการหน้าเว็บ</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box box-default">
    <div class="box-body">
      <div class="row">
        <div class="col-md-3">
          <h3 class="text-muted"><?php echo $id_desc['site_name']; ?></h3>
        </div>
        <div class="col-md-9">
          <nav>
            <ul class="nav nav-pills pull-right">
            <?php
              $result = $mysqli->query("SELECT id, menu_name, display_menu FROM site_menu WHERE site_id = '$id' AND display_menu = 0 ORDER BY menu_order");

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {

                    $menu_sub_show = 0;
                    $html_sub_menu = "";
                    $getSubMenu = $mysqli->query("SELECT menu_name FROM site_submenu WHERE main_menu_id = ".$row['id']." AND status_menu = 0 ORDER BY menu_order");
                    if ($getSubMenu->num_rows > 0) {
                    //if ($getSubMenu !== false) {
                        $count = $getSubMenu->num_rows;
                        if (0 < $count) {
                            $menu_sub_show = 1;
                        }
                    while($submenu = $getSubMenu->fetch_assoc()) {
                    //foreach($getSubMenu as $submenu) {
                            $html_sub_menu .= "<li role='presentation'><a role='menuitem' tabindex='-1' href='index.php?menu=".trim($submenu['menu_name'])."&id=".$id."&sub_menu=1'>".$submenu['menu_name']."</a></li>";
                            array_push($arrMenu, $submenu['menu_name']);
                    }
                    }
                    if ($menu_sub_show == 0) {
                        if (strcmp($menu, $row['menu_name']) === 0) {
                            echo "<li role='presentation' class='active'><a href='index.php?menu=".trim($row['menu_name'])."&id=".$id."'>".trim($row['menu_name'])."</a></li>";
                        } else {
                            echo "<li role='presentation'><a href='index.php?menu=".trim($row['menu_name'])."&id=".$id."'>".trim($row['menu_name'])."</a></li>";
                        }
                    } else {
                        $active_sub_menu = array_search($menu, $arrMenu);
                        if (is_numeric($active_sub_menu)) {
                          echo "<li class='dropdown active'>
                                <a id='drop1' href='#' class='dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' role='button' aria-expanded='false'>
                                  ".$row['menu_name']."
                                  <span class='caret'></span>
                                </a>
                                <ul class='dropdown-menu' role='menu' aria-labelledby='drop1'>
                                  ".$html_sub_menu."
                                </ul>
                              </li>";
                        } else {
                                echo "<li class='dropdown'>
                                <a id='drop1' href='#' class='dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' role='button' aria-expanded='false'>
                                  ".$row['menu_name']."
                                  <span class='caret'></span>
                                </a>
                                <ul class='dropdown-menu' role='menu' aria-labelledby='drop1'>
                                  ".$html_sub_menu."
                                </ul>
                              </li>";
                        }
                    }
                }
            }
            ?>

            <?php if (0 !== $edit_show) {?>
            <li class="dropdown">
              <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                <strong>ผู้ดูแลระบบ</strong>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="menu.php?id=<?php echo $id; ?>">แก้ไขเมนู</a></li>
                <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="site_schedule.php?site_url=<?php echo $id; ?>">กำหนดการหลักสูตร</a></li> -->
              </ul>
            </li>
            <?php } ?>
          </ul>
        </nav>
      </div>
    </div>
     <p><hr/></p>
    <div class="row marketing" id="show_content">
    <?php
      $sub_menu = 0;
      isset($_GET['sub_menu'])? $sub_menu = 1 : $sub_menu = 0;
    if (1 != $sub_menu) {
        $result = $mysqli->query("SELECT menu_name, display_menu, content_id, content_html
          FROM site_menu
          INNER JOIN site_content ON site_menu.content_id = site_content.id
          WHERE menu_name = '$menu' AND
          site_id = '$id'
          ORDER BY site_menu.id");
        $row = $result->fetch_assoc();
    } else {
        $result = $mysqli->query("SELECT menu_name, status_menu, content_id, content_html
          FROM site_submenu
          INNER JOIN site_content ON site_submenu.content_id = site_content.id
          WHERE menu_name = '$menu' AND
          site_id = '$id'
          ORDER BY site_submenu.id");
        $row = $result->fetch_assoc();
    }
    ?>
      <div id="fix_size">
        <textarea name="textarea" rows="50"><?php echo $row['content_html']; ?></textarea>
      </div>
    </div>
    <p></p>
    <div class="col-md-12 text-center">
      <button id="save" class="btn btn-primary btn-flat"><strong>แก้ไข</strong></button>
    </div>
  </div>
</div><!-- /.box-body -->
</div><!-- /.box -->

</section><!-- /.content -->'

<?php eb();?>


<?php sb('js_and_css_footer');?>
<link rel="stylesheet" type="text/css" href="../_plugins/edit/minified/themes/default.min.css">
<script src="../_plugins/edit/minified/jquery.sceditor.bbcode.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("textarea").sceditor({
      plugins: "bbcode",
      width: '98%',
      resizeEnabled: false,
      style: "edit/minified/jquery.sceditor.default.min.css"
    });

    $("#save").click(function() {
              var bbCode = $( 'textarea' ).sceditor( 'instance' ).val();
              $.post("edit_content.php",
              {
                id: <?php echo $row['content_id']; ?>,
                content_html: bbCode,
                //token: $('#token').val(),
              },
              function(data,status){
                    location.reload();
                  });
            });

  });



  $('#fix').hide();
  </script>
        <?php eb();?>

        <?php render($MasterPage);?>
