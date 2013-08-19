<html>
<head>
<title> PHP Sending Email </title>
</head>
<body>
<?php
	$strTo = 'pichai_preeda@hotmail.com';
	$strSubject = 'Test System Mail To Me';
	$strForm = 'kenku440065@gmail.com';
	$strMsg = 'Test Body Message Send Mail To Me';
	
	
	$strHeader = "Content-type: text/html; charset=windows-874\r\n"; // or UTF-8 //
	$strHeader .= "From: ".$strForm."<".$strForm.">\r\nReply-To: ".$strForm."";
	$strMessage = nl2br($strMsg);
	
	$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
	if($flgSend)
	{
		echo "อีเมล์ถูกส่งแล้วครัีบ.";
	}
	else
	{
		echo "ติดปัญหา ส่ง เมล์ ไม่ได้ ครัีบ ";
	}
?>
</body>
</html>