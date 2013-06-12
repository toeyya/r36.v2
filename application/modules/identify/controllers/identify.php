<?php
class Identify extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('indentify_model','identify');
		$this->load->model('indenify_detiail_model','detail');
	
	}
	function index($view=FALSE){
		$data['result']=$this->quest->sort("")->get();
		$data['pagination']=$this->quest->pagination();
		$this->template->build('question_index',$data);
	}
}