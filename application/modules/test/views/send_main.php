<?php

 if(!function_exists('phpmail')){
 function phpmail($subject,$address,$message,$redirect){  
  //$subject = "ยืนยันการลงทะเบียน(ระบบรายงานผู้สัมผัสโรค ร.36)";
  require_once("include/PHPMailer_v5.1/class.phpmailer.php");  // ประกาศใช้ class phpmailer กรุณาตรวจสอบ ว่าประกาศถูก path  
  require_once("include/PHPMailer_v5.1/class.smtp.php");  // ประกาศใช้ class phpmailer กรุณาตรวจสอบ ว่าประกาศถูก path 
  $mail = new PHPMailer();  
  $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้   
  $mail->IsSMTP();
  $mail->SMTPDebug = 0;
  $mail->SMTPAuth = true;
  $mail->Host       = "mail1.favouritehosting.com";
  $mail->Port       = 25;
  $mail->Username   = "r36@favouritedesign.com";
  $mail->Password   = "r36@fd";                       
  $mail->From     = "r36@favouritedesign.com";  //  account e-mail ของเราที่ใช้ในการส่งอีเมล
  $mail->FromName = "ระบบรายงานผู้สัมผัสโรค (ร.36)"; //  ชื่อผู้ส่งที่แสดง เมื่อผู้รับได้รับเมล์ของเรา
  $mail->AddAddress($address);            // Email ปลายทางที่เราต้องการส่ง       
  $mail->IsHTML(true);                  // ถ้า E-mail นี้ มีข้อความในการส่งเป็น tag html ต้องแก้ไข เป็น true
  $mail->Subject     =  $subject;        // หัวข้อที่จะส่ง
  $mail->Body     = $message;                   // ข้อความ ที่จะส่ง
  $mail->SMTPDebug = false;
  $mail->do_debug = 0;
  $flgSend = $mail->send();          
   /* ###### PHPMailer #### */
  if (empty($flgSend))
  {           
    print ('CANNOT SEND EMAIL');
  }else{
   //redirect('users/notice_email');
   if($redirect) redirect($redirect);
  } 
  return true;    
 }
}


?>