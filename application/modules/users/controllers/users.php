<?php
class Users extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model','user');
		$this->load->model('inform/inform_model','inform');
		$this->load->model('hospital/hospital_model','hospital');
		$this->load->model('inform/vaccine_model','vaccine');
		$this->user->primary_key("uid");
		$this->template->append_metadata(js_idcard());	
	}	

    function inc_login()
    {   
		 $this->load->view('inc_login');      
    }

  function login()
   {
        if($_POST)
        {
            if(login($_POST['username'], $_POST['password']))
            {
                set_notify('success', 'ยินดีต้อนรับเข้าสู่ระบบค่ะ');
              redirect('inform/index');
               
            }
            else
            {
                set_notify('error', 'ชื่อผู้ใช้หรือรหัสผ่านผิดพลาดค่ะ');
               redirect($_SERVER['HTTP_REFERER']);
            }   
        }
        else
        {
            set_notify('error', 'กรุณาทำการล็อคอินค่ะ');
          redirect($_SERVER['HTTP_REFERER']);
        }       
    }
	function logout()
	{
		logout();
		redirect('home');
	}
	function register(){
			
		$this->template->build('register');
	}
	function chkHospitalcode(){
		$rs=$this->hospital->get_one("hospital_name","hospital_code_healthoffice",$_GET['userhospital']);		
		if($rs){
			$data['status']="true";
			$data['texts']=$rs;
		}else{
			$data['status']="false";
		}
		echo json_encode($data);
	}
	function forgetPassword(){
		$this->template->build('forgetpassword');
	}
	function confirm_email(){
		$this->template->build('confirm_email');
	}
	function signup()
	{
	   var_dump($_POST);exit;
	   $_POST['telephone'] =$_POST['tel0'].$_POST['tel1'].$_POST['tel2'];
	   $_POST['mobile'] = $_POST['mobile0'].$_POST['mobile1'].$_POST['mobile2'];
	    include("mimemail.inc.php");  // include ฟังก์ชัน เข้ามาใช้งาน	
	  	
	  	$mail = new MIMEMAIL("HTML"); // ส่งแบบ HTML  
	
	    $mail->senderName = $_POST["firstname"]; // ชื่อผู้ส่ง  
	
	    $mail->senderMail = "clinton.toey@gmail.com"; // อีเมลล์ผู้ส่ง  
	
	    $mail->bcc = $_POST["usermail"]; // ส่งแบบ bind carbon copy
	
	    $mail->subject = "ลงทะเบียนเข้าใช้โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า";// หัวข้ออีเมลล์ 
	
	    $mail->body = "test";   // ข้อความ หรือ HTML ก็ได้
	
	    $mail->attachment[] = ''; // ระบุตำแหน่งไฟล์ที่จะแนบ
	
	    $mail->create();
	
	    $mail->send('clinton_toey@hotmail.com'); // เมลล์ผู้รับ 
	
	    //redirect('users/confirm_email');

	}
	

	

}  
?>