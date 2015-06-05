<pre>
<?php
    $servername = "mysql";
    $username = "wordpress";
    $password = "detoxthai";
                                        

    $dbname="detoxthai_wordpress";   // ชื่อฐานข้อมูล
                                        
    ////////////////ส่วนติดต่อฐานข้อมูล//////////////////////
    $condb = mysql_connect($servername,$username,$password) or die("<hr><b>server เชื่อมต่อไม่ได้");
    mysql_select_db($dbname) or die("<hr><b>dbname เชื่อมต่อไม่ได้");
    mysql_query("SET NAMES UTF8");
    ///////////////////////////////////////
    
    
    $sql = "select * from tbl_dunp_fields";
    $results = mysql_query($sql) or die(mysql_error());
	$sql = "CREATE TABLE tbl_surveyform(\n";
        $sql .= "id int(10), \n";
	while($dbarr= mysql_fetch_array($results)){
	    $sql .="". $dbarr['vardata']." ".$dbarr['vartype'].",\n";
	}
	$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8;";
	echo $sql;

    ?>
	
</pre>