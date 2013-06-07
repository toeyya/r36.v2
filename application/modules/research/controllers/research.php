<?php
class Research extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('research_model','quest');
	
	}
	function index($view=FALSE){
		$data['result']=$this->quest->sort("")->get();
		$data['pagination']=$this->quest->pagination();
		$this->template->build('question_index',$data);
	}
}