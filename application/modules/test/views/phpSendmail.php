<html>
<head>
<title>test send mail</title>
</head>
<body>

<?php
	$to = "pichai_preeda@hotmail.com";
	$subject = "test send mail";
	$header = "from :kenku";
	$msg = "desc";
	$smtpSend = mail($to,$subject,$msg,$header);
	if($smtpSend)
	{
		echo "ok";
	}
	else
	{
		echo "not work";
	}
?>

</body>
</html>