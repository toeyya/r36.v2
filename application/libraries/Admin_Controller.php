<?php
class Admin_Controller extends Controller
{
	
	function __construct()
	{
		parent::__construct();				
		if(!is_login()){
			set_notify('error','กรุณาเข้าสู่ระบบ');
			redirect('users/admin/auth');
		}
		// set themes
		$this->template->set_theme('admin');
		
		// set layout
		$this->template->set_layout('layout');
		
		// set title
		$this->template->title('ระบบรายงานผู้สัมพัส หรือสงสัยว่าสัมผัสโรคพิษสุนัขบ้า');
		
		// Set js
		$this->template->append_metadata(js_notify());			
	
	}
}
?>