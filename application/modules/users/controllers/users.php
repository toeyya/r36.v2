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
			}	

    function inc_login()
    {   $this->db->debug=TRUE;
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
		echo ($rs) ? $rs:"false";
	}
	function forgetPassword(){
		$this->template->build('forgetpassword');
	}
	
	function test(){
		
		$result = $this->db->getrow("SELECT * FROM n_user where username='admin7'");
		var_dump($result);
	}
	

}  
?>