<?php
class Export extends R36_Controller
{
	function __construct()
	{
		parent::__construct();		
		$this->load->model('hospital/hospital_model','hospital');
		$this->load->model('province/province_model','province');
		$this->load->model('inform/inform_model','inform');
		$this->load->model('inform/vaccine_model','vaccine');
	}
	function export_system(){
		$this->template->build('export_system');
	}
	function export_rabies(){
		$this->template->build('export_rabies');
	}
}
?>