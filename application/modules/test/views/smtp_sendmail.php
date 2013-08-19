<?php

$name=$_POST['name'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$messege="Dear Webmaster,<br /> An user sent query.<br /> Query: <br/> ".$_POST['messege']."<br /><br /><br /> <b>User Contact Detail:</b><br />Name:".$name."<br/> Email:".$email."<br />Mobile:".$mobile;

$to = 'xyz@gmail.com';
$subject = 'xx';

$headers = "From: abc@xyz.com\r\n" .
'X-Mailer: PHP/' . phpversion() . "\r\n" .
"MIME-Version: 1.0\r\n" .
"Content-Type: text/html; charset=utf-8\r\n" .
"Content-Transfer-Encoding: 8bit\r\n\r\n";

ini_set("SMTP","smtp.xyz.com");
ini_set("smtp_port","25");
ini_set("sendmail_from","abc@xyz.com");
mail($to, $subject, $message, $headers);

?>