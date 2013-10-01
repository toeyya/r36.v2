<?php	
			$serverName = "(local)\R36, 1433"; //serverName\instanceName, portNumber (default is 1433)
			$connectionInfo = array( "Database"=>"c1r36", "UID"=>"sa", "PWD"=>"ddcqwER1234!@#$");
			$conn = sqlsrv_connect( $serverName, $connectionInfo);
			if( $conn ) {
				 echo "Connection established.<br />";
			}else{
				 echo "Connection could not be established.<br />";
				 die( print_r( sqlsrv_errors(), true));
			}
?>