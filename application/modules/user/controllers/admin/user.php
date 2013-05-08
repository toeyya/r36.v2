<?php
class User extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model','user');		
	}
	function index($action=FALSE)
	{
		$this->template->set_layout('login');						
		$this->template->build('admin/login');
			
		
			
	}
	function login()
	{	   
		if($_POST)
		{
				if(login(mysql_real_escape_string($_POST['username']),mysql_real_escape_string($_POST['userpassword'])))
				{
					redirect('inform/index');
														
				}
				else
				{
					set_notify('error',"กรุณากรอกใหม่อีกครั้ง");	
					redirect('user/admin/user/index');
				}				
												
		}				
	}
	function forgot_password(){
		
	}
	
	function test(){
		echo 'test'; 
	}


}
?>