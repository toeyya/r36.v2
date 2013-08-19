<html>
<head>
<title>PHP Sending Email</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
</head>
<body>
<?php
	$strHeader = "";
	$strTo = "pichai_preeda@hotmail.com";
	$strSubject = "=?UTF-8?B?".base64_encode("ส่งอีเมล์ภาษาไทย ด้วย php ทดสอบชื่อเรื่องภาษาไทย")."?=";
	//$strHeader .= "MIME-Version: 1.0' . \r\n";
	//$strHeader .= "Content-type: text/html; charset=utf-8\r\n"; 
	//$strHeader .= "From: Mr.preeda pichai<dev@fd.com>\r\nReply-To: pichai_preeda@hotmail.com";
	$strVar = "ข้อความภาษาไทย";
	$strMessage = "
	<h1>My Message</h1><br>
	<table width='285' border='1'>
	 <tr>
	 <td><div align='center'><strong>My Message </strong></div></td>
	 <td><div align='center'><font color='red'>My Message</font></div></td>
	 <td><div align='center'><font size='2'>My Message</font></div></td>
	 </tr>
	 <tr>
	 <td><div align='center'>My Message</div></td>
	 <td><div align='center'>My Message</div></td>
	 <td><div align='center'>My Message</div></td>
	 </tr>
	 <tr>
	 <td><div align='center'>".$strVar."</div></td>
	 <td><div align='center'>".$strVar."</div></td>
	 <td><div align='center'>".$strVar."</div></td>
	 </tr>
	</table>";

	//$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
	$flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
	if($flgSend)
	{
		echo "Email Sending.";
	}
	else
	{
		echo "Email Can Not Send.";
	}
?>
</body>
</html>