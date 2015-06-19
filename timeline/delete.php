<?php
    unlink($_POST["key"]);
    $output = [];
    echo json_encode($output);
?>