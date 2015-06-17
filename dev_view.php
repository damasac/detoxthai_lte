<?php require_once '_theme/util.inc.php'; $MasterPage = 'page_main.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Dev Preview - DAMASAC Studio</title>

    <!-- social network metas -->
    <meta property="image" content="http://almsaeedstudio.com/adminlte2.png"/>
    <meta property="og:image" content="http://almsaeedstudio.com/adminlte2.png"/>
    <meta property="site_name" content="Almsaeed Studio"/>
    <meta property="description" content="Preview of AdminLTE control panel and dashboard theme. AdminLTE is based on Bootstrap 3." />
    <meta name="description" content="Preview of AdminLTE control panel and dashboard theme. AdminLTE is based on Bootstrap 3." />

    <link rel="icon" type="image/png" href="http://almsaeedstudio.com/logo.png">

    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_plugins/icon-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />


    <style>
        html, body {
            min-height: 100%;
            padding: 0;
            margin: 0;
            font-family: 'Source Sans Pro', "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        iframe {
            display: block;
            overflow: auto;
            border: 0;
            margin: 0;
            padding: 0;
            margin: 0 auto;
        }
        .frame {
            height: 49px;
            margin: 0;
            padding: 0;
            border-bottom: 1px solid #ddd;
        }
        .frame a {
            color: #666;
        }
        .frame a:hover {
            color: #222;
        }
        .frame .buttons a {
            height: 49px;
            line-height: 49px;
            display: inline-block;
            text-align: center;
            width: 50px;
            border-left: 1px solid #ddd;
        }
        .frame .brand {
            color: #444;
            font-size: 20px;
            line-height: 49px;
            display: inline-block;
            padding-left: 10px;
        }
        .frame .brand small {
            font-size: 14px;
        }
        a,a:hover {
            text-decoration: none;
        }
        .container-fluid {
            padding: 0;
            margin: 0;
        }
        .text-muted {
            color: #999;
        }
        .ad {
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            background: #222;
            background: rgba(0,0,0,0.8);
            width: 100%;
            color: #fff;
            display: none;
        }
        #close-ad {
            float: left;
            margin-left: 10px;
            margin-top: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<header>
    <nav class="frame" role="navigation">
        <div class="container-fluid">
            <a href="#" class="brand">
                DAMASAC Studio
                <small class="text-muted hidden-xs">Dev preview</small>
            </a>
            <div class="buttons pull-right">
                <a class="first hidden-xs" id="display-full" href="#" data-toggle="tooltip" data-placement="bottom" title="Display Desktop - full width"><i class="fa fa-desktop fa-lg"></i></a>
                <a class="hidden-xs" id="display-950" href="#" data-toggle="tooltip" data-placement="bottom" title="Display Tablet - 950px"><i class="fa fa-tablet fa-lg"></i></a>
                <a class="hidden-xs" id="display-480" href="#" data-toggle="tooltip" data-placement="bottom" title="Display Phone - 480px"><i class="fa fa-mobile fa-lg"></i></a>
                <a id="remove-frame" href="#" data-toggle="tooltip" data-placement="bottom" title="Remove frame"><i class="fa fa-times"></i></a>
            </div>
        </div><!-- /.container -->
    </nav><!--/.navbar-->
</header>
<iframe src="index.php" id="preview-iframe"></iframe>


<!-- jQuery 2.1.4 -->
<script src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo 'http://',$_SERVER['SERVER_NAME'],'/',APP_WEBROOT;?>_bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script>
    $(function() {
        function _fix() {
            var h = $(window).height();
            var w = $(window).width();
            $("#preview-iframe").css({
                width: w + "px",
                height: (h - 50) + "px"
            });
        }
        _fix();
        $(window).resize(function() {
            _fix();
        });
        $('[data-toggle="tooltip"]').tooltip();

        function iframe_width(width) {
            $("#preview-iframe").animate({width: width}, 500);
        }

        $("#display-full").click(function(e){
            e.preventDefault();
            iframe_width("100%");
        });

        $("#display-950").click(function(e){
            e.preventDefault();
            iframe_width("950px");
        });

        $("#display-480").click(function(e){
            e.preventDefault();
            iframe_width("480px");
        });

        $("#remove-frame").click(function(e){
            e.preventDefault();
            window.location.href = ".";
        });

        $(".ad").hide().delay(3000).show(500);

        $("#close-ad").click(function(e){
            e.preventDefault();
            $(".ad").remove();
        });

    });

</script>
</body>
</html>