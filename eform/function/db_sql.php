<?Php
    $con = mysqli_connect("localhost","root","","thaipalliative_lte") or die(mysql_error());
    mysqli_select_db($con,"thaipalliative_lte") or die(mysql_error());
    mysqli_query($con,"SET NAMES UTF8");
?>