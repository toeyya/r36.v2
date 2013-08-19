<?php 
	//echo "test connect";
?>
<html>
<head>
<title>ddc sqlserver</title>
</head>
<body>
<?php
	$objConnect = mssql_connect("DDC-01","sa","ddcqwER1234!@#$");
	if($objConnect)
	{
		echo "Database Connected.";
	}
	else
	{
		echo "Database Connect Failed.";
	}

	mssql_close($objConnect);
?>
</body>
</html>