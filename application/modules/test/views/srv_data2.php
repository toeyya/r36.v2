<?php

//DDC-01,(local)

$serverName = "DDC-01";
$connectionInfo = array( "Database"=>"c1r36", "UID"=>"sa","PWD"=>"ddcqwER1234!@#$");
$conn = sqlsrv_connect($serverName, $connectionInfo);
if( $conn ) {
echo "Econnection established ติดต่อ ดาต้าเบส ได้ ครับ .<br />";
}else{
echo "Connection could not be established. ทำอะไรไมได้เลยครับ <br />";
echo "<pre>";
print_r(sqlsrv_erros());
echo "</pre>";

}

?>