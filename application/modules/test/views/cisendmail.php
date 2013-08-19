<?php


$this->load->library('email');

$this->email->from('pichai_preeda@hotmail.com', 'pichaipreeda');
$this->email->to('pichai_preeda@hotmail.com'); 
$this->email->cc('kenku440065@gmail.com'); 
//$this->email->bcc('them@their-example.com'); 

$this->email->subject('Email Test');
$this->email->message('Testing the email class.');	

$this->email->send();

echo $this->email->print_debugger();


?>