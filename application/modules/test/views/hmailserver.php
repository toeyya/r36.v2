<?php
$to = 'pichai_preeda@hotmail.com';
$subject = 'test mail server';
$message = 'This is my first  e-mail in my life';
 
$header = "MIME-Version: 1.0\r\n" ;
$header .= "Content-type: text/html; charset=UTF-8\r\n" ;
$header .= "From: no-reply@preeda\r\n" ;
 
if( mail( $to , $subject , $message , $header ) ){ 
	echo 'Complete.';
}else{
	echo 'Incomplete.';
}
?>