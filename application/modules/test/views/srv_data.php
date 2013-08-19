<?php
   $serverName = "(local)"; 
   $database = "c1r36";

   // Get UID and PWD from application-specific files. 
$uid = "sa";
$pwd = "ddcqwER1234!@#$";

   try {
      $conn = new PDO( "sqlsrv:server=$serverName;Database = $database", $uid, $pwd); 
      $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
   }

   catch( PDOException $e ) {
      die( "Error connecting to SQL Server" ); 
   }

   echo "Connected to SQL Server\n";

   $query = 'select * from n_province'; 
   $stmt = $conn->query( $query ); 
   while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
      print_r( $row );
	  echo "<br>";		
   }

   // Free statement and connection resources. 
   $stmt = null; 
   $conn = null; 
?>