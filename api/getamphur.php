<?php

include_once "../_connection/db.php";

$province_id = quote_smart($_GET['province_id']);

$sql = "SELECT AMPHUR_ID, AMPHUR_NAME FROM const_amphur WHERE PROVINCE_ID = $province_id ORDER BY AMPHUR_NAME";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $var[] = $row;
    }
}

echo '{"amphur":'.json_encode($var).'}';

$mysqli->close();

function quote_smart($value)
{
        // Stripslashes
    if ( get_magic_quotes_gpc() )
    {
        $value = stripslashes( $value );
    }
        // Quote if not a number or a numeric string
    if ( !is_numeric( $value ) )
    {
        $value = "'" . addslashes($value) . "'";
}
    return $value;
}
?>
