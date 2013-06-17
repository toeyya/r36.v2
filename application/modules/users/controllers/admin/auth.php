<?php
class Auth extends Public_Controller
{
	
	public function __construct()
	{		
		parent::__construct();
		$this->load->model('user_model','user');	
	}
	
	public function index()
	{
		$this->template->set_theme('admin');
		$this->template->set_layout('blank');
		$this->template->build('admin/auth/login');
	}
	
	public function login()
	{
		if($_POST)
		{		
			if(login($_POST['username'], $_POST['password'],'admin'))
			{
				//Addlog("login","เข้าสู่ระบบ");	
				set_notify('success', 'ยินดีต้อนรับเข้าสู่ระบบ');
				redirect('users/admin/profiles');
			}
			else
			{
				set_notify('error', 'คุณไม่มีสิทธิ์เข้าใช้ในส่วนนี้ !!!');
				redirect('users/admin/auth');
			}	
		}else{
			set_notify('error', 'อีเมล์หรือรหัสผ่านผิดพลาด');
			redirect('users/admin/auth');
		}
		
	}
	
	public function logout()
	{
		//Addlog("logout",'ออกจากระบบ');	
		logout();
		redirect('home');
	}
	
}

?>
