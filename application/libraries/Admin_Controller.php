<?php
class Admin_Controller extends Controller
{
	
	function __construct()
	{
		parent::__construct();				
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