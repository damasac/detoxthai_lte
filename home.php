<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?> Liver flushing registry <?php eb();?>

<?php sb('js_and_css_head'); ?>
<style type="text/css">
  #show_content {
    margin: 0 auto;
    width: 95%;
  }
</style>
<?php eb();?>

<?php include_once "_connection/db_base.php"; ?>

<?php
  /** Get sub domain. */
  $site_id = explode(".",$_SERVER['SERVER_NAME']);
  $sub_domain =  $site_id[sizeof($site_id) - 3];

  if ('www' == $sub_domain) {
    $site_id = 1;
  } else {
    $result = $mysqli->query("SELECT id
            FROM site_detail
            WHERE site_url = '$sub_domain'");
    $row_id = $result->fetch_assoc();
    $site_id = $row_id['id'];
  }
?>

<?php sb('content');?>

<?php

isset($_GET['menu']) ? $menu = $_GET['menu'] :  $menu = '';
isset($_GET['sub_menu']) ? $sub_menu = $_GET['sub_menu'] :  $sub_menu = 0;


if ('' == $menu) {
    $result = $mysqli->query("SELECT menu_name
    FROM site_menu
    WHERE site_id = '$site_id'
    AND display_menu = 0
    ORDER BY menu_order");
    $row = $result->fetch_assoc();
    $count = $result->num_rows;
    if (0 == $count) {
        $menu_exit = 0;
    } else {
        echo "<script>
               window.location.href = 'home.php?menu=".$row['menu_name']."&site_id=".$site_id."'".";
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
                    WHERE id = '$site_id'");
    $site_id_desc = $result_name_site->fetch_assoc();
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Content Management
    <small>สำหรับ site (เปลี่ยนไปตาม URL)</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo $site_id_desc['site_name']; ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box box-default">
    <div class="box-body">
      <div class="row">
        <div class="col-md-3">
          <h3 class="text-muted"><?php echo $site_id_desc['site_name']; ?></h3>
        </div>
        <div class="col-md-9">
          <nav>
            <ul class="nav nav-pills pull-right">
            <?php
              $result = $mysqli->query("SELECT id, menu_name, display_menu FROM site_menu WHERE site_id = '$site_id' AND display_menu = 0 ORDER BY menu_order");

            if ($result !== false) {
              foreach($result as $row) {

                    $menu_sub_show = 0;
                    $html_sub_menu = "";
                    $getSubMenu = $mysqli->query("SELECT menu_name FROM site_submenu WHERE main_menu_id = ".$row['id']." AND status_menu = 0 ORDER BY menu_order");
                    if ($getSubMenu !== false) {
                        $count = $getSubMenu->num_rows;
                        if (0 < $count) {
                            $menu_sub_show = 1;
                        }
                    foreach($getSubMenu as $submenu) {
                            $html_sub_menu .= "<li role='presentation'><a role='menuitem' tabindex='-1' href='home.php?menu=".trim($submenu['menu_name'])."&site_id=".$site_id."&sub_menu=1'>".$submenu['menu_name']."</a></li>";
                            array_push($arrMenu, $submenu['menu_name']);
                    }
                    }
                    if ($menu_sub_show == 0) {
                        if (strcmp($menu, $row['menu_name']) === 0) {
                            echo "<li role='presentation' class='active'><a href='home.php?menu=".trim($row['menu_name'])."&site_id=".$site_id."'>".trim($row['menu_name'])."</a></li>";
                        } else {
                            echo "<li role='presentation'><a href='home.php?menu=".trim($row['menu_name'])."&site_id=".$site_id."'>".trim($row['menu_name'])."</a></li>";
                        }
                    } else {
                        //print_r($arrMenu);
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
          </ul>
        </nav>
      </div>
    </div>
    <p><hr/></p>
    <div class="row marketing" id="show_content">
          <?php
          if (1 != $sub_menu) {
            $result = $mysqli->query("SELECT menu_name, display_menu, content_id, content_html
                                      FROM site_menu
                                      INNER JOIN site_content ON site_menu.content_id = site_content.id
                                      WHERE menu_name = '$menu' AND
                                      site_id = '$site_id'
                                      ORDER BY site_menu.id");
                    $row = $result->fetch_assoc();
          } else {
            $result = $mysqli->query("SELECT menu_name, status_menu, content_id, content_html
                                      FROM site_submenu
                                      INNER JOIN site_content ON site_submenu.content_id = site_content.id
                                      WHERE menu_name = '$menu' AND
                                      site_id = '$site_id'
                                      ORDER BY site_submenu.id");
                    $row = $result->fetch_assoc();
          }
            echo "<textarea name='textarea' rows='0' style='display: none;'></textarea>";
          ?>
      </div>
      <p><hr/></p>
      <footer class="footer">
        <?php $year_create = explode("-",$site_id_desc['create_date']) ?>
        <p>&copy; <?php echo $site_id_desc['site_name']." ".$year_create[0]; ?></p>
      </footer>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->

<?php eb();?>


<?php sb('js_and_css_footer');?>
<link rel="stylesheet" type="text/css" href="_plugins/edit/minified/themes/default.min.css">
<script src="_plugins/edit/minified/jquery.sceditor.bbcode.min.js"></script>

<script>
$(document).ready(function() {
  <?php
    echo "$('textarea').sceditor({
                plugins: 'bbcode',
                width: '98%',
                resizeEnabled: false,
                style: 'edit/minified/jquery.sceditor.default.min.css'
            });
            var html = $('textarea').sceditor('instance').fromBBCode('".trim(preg_replace('/[\n\r]/', '\n', $row['content_html']))."');
            //alert(html);
            $('#show_content').html(html);
            $('.sceditor-container').hide();";
  ?>
});
</script>

<?php eb();?>

<?php render($MasterPage);?>
