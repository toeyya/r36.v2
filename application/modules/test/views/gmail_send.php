<?php
require_once('themes/map/phpMailer/class.phpmailer.php');
	//--------send mail

									$email="pichai_preeda@hotmail.com";

									$name="pichaipreeda";
									
									$mail = "pichai_preeda@hotmail.com";

									$from = $mail;

									$cname = $mail;

									$message = "test Send Mail";

									$mail = new PHPMailer();

									$mail->IsHTML(true); 

									$mail->IsSMTP();

									$mail->SMTPAuth = true; $mail->Host = 'ssl://smtp.gmail.com:465'; 

									$mail->Username = "kenku440065@gmail.com"; 

									$mail->Password = "3550100352995"; 

									$mail->From = $from; 

									$mail->FromName = $cname;

									$mail->Subject = "test_send_mail";

									$mail->Body = $message;

									$mail->AddAddress($email, $name); 

									$mail->AddCC("kenku440065@gmail.com", "kenku440065@gmail.com");


									$mail->Send(); 

?>