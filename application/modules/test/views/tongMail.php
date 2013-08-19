<?php 

$subject = "testSendMail";
$address = "pichai_preeda@hotmail.com";
$message = "test msg";
$redirect = "164.115.32.57";

$flgSend = phpmail($subject,$address,$message,$redirect);

	if($flgSend)
	{
		echo "Email ส่งได้แล้วครับ.";
	}
	else
	{
		echo "Email ส่งไม่ได้ เสียใจครับ T-T.";
	}

?>