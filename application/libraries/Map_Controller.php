<?php
class Map_Controller extends Controller
{
	
	function __construct()
	{
		parent::__construct();

		/*if(!is_login()){
			set_notify('error','กรุณาเข้าสู่ระบบ');
			redirect('users/admin/auth');
		}*/
		//set theme
		$this->template->set_theme('map');		
		//set layout
		$this->template->set_layout('home');		
		//set title
		$this->template->title('ระบบสารสนเทศภูมิศาสตร์ของโปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า');		
		//Set js


	}

	
}
?>