<?php
class R36_Controller extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		if(!is_login()){
			set_notify('error','กรุณาเข้าสู่ระบบ');
			redirect('home');
		}
		//set theme
		$this->template->set_theme('R36');		
		//set layout
		$this->template->set_layout('layout');		
		//set title
		$this->template->title('โปรแกรมการรายงานผู้สัมผัสหรือสงสัยว่าสัมผัสโรคพิษสุนัขบ้า');		
		//Set js
		$this->template->append_metadata(js_notify());
		 
	}

	
}
?>