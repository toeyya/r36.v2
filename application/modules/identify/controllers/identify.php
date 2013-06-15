<?php
class Identify extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('identify_model','identify');
		$this->load->model('identify_detail_model','detail');
	
	}
	function index(){
		$data['result']=$this->identify->get();
		$data['pagination']=$this->identify->pagination();
		$this->template->build('inc_index',$data);
	}
}