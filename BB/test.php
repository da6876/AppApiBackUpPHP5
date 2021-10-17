<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $conn = oci_connect('SOCAPP', 'SOCAPP', 'localhost/DA');
    $stid = oci_parse($conn, 'SELECT * FROM OAA_USER_INFO');
    oci_execute($stid);
    echo "\n";
    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
      foreach ($row as $item) {
        echo $item ."\n";
       }
    }
?>