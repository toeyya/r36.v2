<?php
$serverName = "DDC-01";
$connectionInfo = array( "Database"=>"c1r36", "UID"=>"sa", "PWD"=>"ddcqwER1234!@#$");
$conn = sqlsrv_connect( $serverName, $connectionInfo );
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$sql = "SELECT * FROM summary_province";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
      echo $row['rate_ppe'].", ".$row['no_ppe']."<br />";
}

sqlsrv_free_stmt( $stmt);
?>
