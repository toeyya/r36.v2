<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| My Constants
|--------------------------------------------------------------------------
|
*/

define('YOUTUBE_USER', 'aidsstithai');

define('USER_IMG_WIDTH',24);
define('USER_IMG_HEIGHT',24);
define('MEDIA_IMG_WIDTH',100);
define('MEDIA_IMG_HEIGHT',100);
define('LINK_IMG_WIDTH',110);
define('LINK_IMG_HEIGHT',75);
define('HILIGHT_IMG_WIDTH',100);
define('HILIGHT_IMG_HEIGHT',100);




define('BTN_ADD','เพิ่มรายการ');
define('BTN_EDIT','แก้ไข');
define('BTN_DELETE','ลบ');
define('BTN_SUBMIT','ตกลง');
define('BTN_ANS', 'ตอบกระทู้');
define('BTN_SENDMAIL', 'ส่งเมลล์');
define('NOTICE_CONFIRM_DELETE', 'คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลนี้');

define('SAVE_DATA_COMPLETE','บันทึกข้อมูลเรียบร้อย');
define('DELETE_DATA_COMPLETE', 'ลบข้อมูลเรียบร้อยแล้ว');
define('REMOVE_IMAGE_COMPLETE', 'ลบรูปภาพเรียบร้อยแล้ว');

define('CAPTCHA', 'ใส่รหัสตามรูปภาพให้ถูกต้องด้วยค่ะ');
define('LOGIN_NOT', 'คุณต้อง Login ก่อนค่ะ');
define('LOGIN_FAIL', 'Username หรือ Password ไม่ถูกต้อง');
define('CANCEL_RECEIVE','คุณต้องการยกเลิกรับข่าว-สาร ใช่หรือไม่ ?');
define('CANNOT SEND EMAIL','CANNOT SEND EMAIL');
define('NOTICE_ERROR_REGISTER','คุณได้ลงทะเบียนหลักสูตรนี้แล้ว !!! ');
define('CODE_AUTOMATED','ระบบจะสร้างให้อัตโนมัติ');



/* End of file constants.php */
/* Location: ./system/application/config/constants.php */