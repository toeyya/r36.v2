<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

<title><?php echo $title; ?></title>
</head>

<body>

<h1><?php echo $heading;?></h1>

<?php

			foreach ($query->result() as $row)
			{
				echo "จังหวัด :";
				echo $row->province_name;
				echo "|-|";
				echo "จำนวนประชากร :";
				echo number_format($row->provincepeople,0);
				echo "|<br>";
			}
			
?>

</body>
</html>