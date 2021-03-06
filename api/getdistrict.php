<?php

include_once "../_connection/db_base.php";

$amphur_id = quote_smart($_GET['amphur_id']);

$sql = "SELECT DISTRICT_ID, DISTRICT_NAME FROM const_district WHERE AMPHUR_ID = $amphur_id ORDER BY DISTRICT_NAME";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $var[] = $row;
    }
}

echo '{"district":'.json_encode($var).'}';

$mysqli->close();

function quote_smart($value)
{
        // Stripslashes
    if (get_magic_quotes_gpc())
    {
        $value = stripslashes( $value );
    }
        // Quote if not a number or a numeric string
    if (!is_numeric( $value ))
    {
        $value = "'" . addslashes($value) . "'";
    }
        return $value;
}
?>
