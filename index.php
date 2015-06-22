<?php include_once "_connection/db_base.php"; ?>
<?php
isset($_GET['menu']) ? $menu = $_GET['menu'] :  $menu = '';

/** Get sub domain. */
$site_id = explode(".",$_SERVER['SERVER_NAME']);
$sub_domain =  $site_id[sizeof($site_id) - 3];

if ('www' == $sub_domain) {
  $site_id = 1;
} else {
  $result = $mysqli->query("SELECT id
          FROM site_detail
          WHERE site_url = '$sub_domain'
          AND delete_at IS NULL");
  $row_id = $result->fetch_assoc();
  $site_id = $row_id['id'];
}

if ('' == $menu) {
    $result = $mysqli->query("SELECT menu_name
    FROM site_menu
    WHERE site_id = '$site_id'
    AND display_menu = 0
    AND delete_at IS NULL
    ORDER BY menu_order");
    $row = $result->fetch_assoc();
    $count = $result->num_rows;
    if (0 == $count) {
        $menu_exit = 0;
    } else {
        header("Location: index.php?menu=".$row['menu_name']."&site_id=".$site_id);
    }
} else {
    $menu_exit = 1;
}
?>
<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>

<?php sb('title');?>ศูนย์สุขภาพองค์รวม<?php eb();?>

<?php sb('js_and_css_head'); ?>
<style type="text/css">
  #show_content {
    margin: 0 auto;
    width: 95%;
  }
</style>
<?php eb();?>

<?php sb('notifications');?>
  <?php include_once 'notifications.php'; ?>
<?php eb();?>

<?php sb('content');?>

<?php
isset($_SESSION[SESSIONPREFIX.'puser_id']) ? $session = $_SESSION[SESSIONPREFIX.'puser_id'] :  $session = '';
isset($_GET['sub_menu']) ? $sub_menu = $_GET['sub_menu'] :  $sub_menu = 0;

$edit_show = 1;
$arrMenu = array();

?>

<?php
    $result_name_site = $mysqli->query("SELECT site_name, create_date
                    FROM site_detail
                    WHERE id = '$site_id'
                    AND delete_at IS NULL");
    $site_id_desc = $result_name_site->fetch_assoc();
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    หน้าแรก
    <small>http://<?php echo $_SERVER['HTTP_HOST']; ?></small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-home"></i> <?php echo $site_id_desc['site_name']; ?></li>
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
              $result = $mysqli->query("SELECT id, menu_name, display_menu FROM site_menu WHERE site_id = '$site_id' AND display_menu = 0 AND delete_at IS NULL ORDER BY menu_order");

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {

                    $menu_sub_show = 0;
                    $html_sub_menu = "";
                    $getSubMenu = $mysqli->query("SELECT menu_name FROM site_submenu WHERE main_menu_id = ".$row['id']." AND status_menu = 0 AND delete_at IS NULL ORDER BY menu_order");
                    if ($getSubMenu->num_rows > 0) {
                    //if ($getSubMenu !== false) {
                        $count = $getSubMenu->num_rows;
                        if (0 < $count) {
                            $menu_sub_show = 1;
                        }
                    while($submenu = $getSubMenu->fetch_assoc()) {
                    //foreach($getSubMenu as $submenu) {
                            $html_sub_menu .= "<li role='presentation'><a role='menuitem' tabindex='-1' href='index.php?menu=".trim($submenu['menu_name'])."&site_id=".$site_id."&sub_menu=1'>".$submenu['menu_name']."</a></li>";
                            array_push($arrMenu, $submenu['menu_name']);
                    }
                    }
                    if ($menu_sub_show == 0) {
                        if (strcmp($menu, $row['menu_name']) === 0) {
                            echo "<li role='presentation' class='active'><a href='index.php?menu=".trim($row['menu_name'])."&site_id=".$site_id."'>".trim($row['menu_name'])."</a></li>";
                        } else {
                            echo "<li role='presentation'><a href='index.php?menu=".trim($row['menu_name'])."&site_id=".$site_id."'>".trim($row['menu_name'])."</a></li>";
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
  <?php
  $result_check_secu = $mysqli->query("SELECT COUNT(*) AS check_secu
                                      FROM site_detail
                                      WHERE
                                      id = '".$site_id."'
                                      AND create_user = '$session'");
  $check_secu = $result_check_secu->fetch_assoc();
  //echo $check_secu['check_secu'];
  if (0 < $check_secu['check_secu']) {
  ?>
  <div class="col-md-12 text-right">
      <a href="site/index.php?menu=<?php echo $menu ?>&id=<?php echo $site_id; ?>" class="btn btn-primary btn-flat">แก้ไขเนื้อหา</a>
  </div>
  <?php
  }
  ?>
    <div class="row marketing" id="show_content">
          <?php
          if (1 != $sub_menu) {
            $result = $mysqli->query("SELECT menu_name, display_menu, content_id, content_html
                                      FROM site_menu
                                      INNER JOIN site_content ON site_menu.content_id = site_content.id
                                      WHERE menu_name = '$menu' AND
                                      site_id = '$site_id'
                                      AND site_menu.delete_at IS NULL
                                      ORDER BY site_menu.id");
                    $row = $result->fetch_assoc();
          } else {
            $result = $mysqli->query("SELECT menu_name, status_menu, content_id, content_html
                                      FROM site_submenu
                                      INNER JOIN site_content ON site_submenu.content_id = site_content.id
                                      WHERE menu_name = '$menu' AND
                                      site_id = '$site_id'
                                      AND site_submenu.delete_at IS NULL
                                      ORDER BY site_submenu.id");
                    $row = $result->fetch_assoc();
          }
            echo htmlspecialchars_decode($row['content_html']);
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
<?php eb();?>

<?php render($MasterPage);?>
