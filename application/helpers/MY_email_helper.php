<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2009, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Email Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/email_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Validate email address
 *
 * @access	public
 * @return	bool
 */	
if ( ! function_exists('valid_email'))
{
	function valid_email($address)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $address)) ? FALSE : TRUE;
	}
}

// ------------------------------------------------------------------------

/**
 * Send an email
 *
 * @access	public
 * @return	bool
 */	
if ( ! function_exists('send_email'))
{
	
	function send_email($recipient, $subject = 'Test email', $message = 'Hello World',$strHeader='Content-type: text/html; charset=windows-874')
	{
		
		
		return mail($recipient, $subject, $message,$strHeader);
	}
}
if(!function_exists('phpmail')){
	function phpmail($subject,$address,$message,$redirect,$bcc=FALSE,$province=FALSE){				
		require_once("include/PHPMailer_v5.1/class.phpmailer.php");  // ประกาศใช้ class phpmailer กรุณาตรวจสอบ ว่าประกาศถูก path		
		//require_once("include/PHPMailer_v5.1/class.smtp.php");  // ประกาศใช้ class phpmailer กรุณาตรวจสอบ ว่าประกาศถูก path	
		$mail = new PHPMailer();		
		$mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้   
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;		
		//$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
		//$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server		
		//$mail->Port       = 465;		
		//$mail->Username = "r36.zoocdc@gmail.com"; // GMAIL username
		//$mail->Password = "zoocdcR36"; // GMAIL password
		//$mail->Username = "r36.rabies@gmail.com"; // GMAIL username
		//$mail->Password = "r36admin"; // GMAIL password		
		//$mail->From     = "r36.rabies@gmail.com"; // "name@yourdomain.com";
		//$mail->FromName = "ระบบรายงานผู้สัมผัสโรค (ร.36)"; //  ชื่อผู้ส่งที่แสดง เมื่อผู้รับได้รับเมล์ของเรา
		
		$mail->Host       = "mail1.favouritehosting.com";
		$mail->Port       = 25;
		$mail->Username   = "r36@favouritedesign.com";
		$mail->Password   = "r36@fd";                     		
		$mail->From       = "r36@favouritedesign.com";  //  account e-mail ของเราที่ใช้ในการส่งอีเมล
		$mail->FromName   = "ระบบรายงานผู้สัมผัสโรค (ร.36)"; //  ชื่อผู้ส่งที่แสดง เมื่อผู้รับได้รับเมล์ของเรา		
		
		
		if(is_array($address)){
			foreach($address as $item){
				$mail->AddAddress($item['usermail']);            
			}				
		}else{
			$mail->AddAddress($address);           
		}// Email ปลายทางที่เราต้องการส่ง
					  						
		if($bcc){			
			//$mail->AddBCC($bcc); //BCC
			$mail->AddBCC("r36.zoocdc@gmail.com");
			$mail->AddBCC("r36.rabies@gmail.com");
			$mail->AddBCC("kenku440065@gmail.com");
		}
		
		if($province){
			foreach($province as $item){
				$mail->AddBCC($item['usermail']);
			}
		}				
		$mail->IsHTML(true);                  // ถ้า E-mail นี้ มีข้อความในการส่งเป็น tag html ต้องแก้ไข เป็น true
		$mail->Subject     =  $subject;        // หัวข้อที่จะส่ง
		$mail->Body     = $message;                   // ข้อความ ที่จะส่ง
		$mail->SMTPDebug = false;
		//$mail->do_debug = 0;
		$flgSend = $mail->send();       			
			
		if (empty($flgSend))
		{											
		  print ('CANNOT SEND EMAIL');
		}else{			
			if($redirect) redirect($redirect);
		}	
		return true;    
	}
}

/* End of file email_helper.php */
/* Location: ./system/helpers/email_helper.php */