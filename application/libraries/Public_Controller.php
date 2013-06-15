<?php
class Public_Controller extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		//set theme
		$this->template->set_theme('default');		
		//set layout
		$this->template->set_layout('layout');		
		//set title
		$this->template->title('ระบบรายงานผู้สัมพัส หรือสงสัยว่าสัมผัสโรคพิษสุนัขบ้า');		
		//Set js
		$this->template->append_metadata(js_notify());

	}
	function captcha()
	{
		$this->load->library('captcha');
		$captcha = new Captcha();
		$captcha->size = 4;
		$captcha->chars = '0123456789';
		$captcha->session = "captcha";
		$captcha->display();
	}

	
}
?>