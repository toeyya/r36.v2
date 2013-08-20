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
		if(is_login('admin')){			
			redirect('users/admin/users');
		}			
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
				set_notify('success', 'ยินดีต้อนรับเข้าสู่ระบบ');								
				if(permission('users','act_read')){
					redirect('users/admin/users');
				}else{
					redirect('users/admin/users/form/'.$this->session->userdata('R36_UID').'/profile');
				}
				
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
		logout();
		redirect('home');
	}
	
}

?>
