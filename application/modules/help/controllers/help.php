<?php
class Help extends R36_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('help_model','help');
	
	}
	function index($view=FALSE){
			$data['result']=$this->help->sort("")->order("queue asc")->get();
			$data['pagination']=$this->help->pagination();
			$this->template->append_metadata(js_checkbox());
			$this->template->build('help_index',$data);
	}
	function form($id=FALSE){
		$data['rs']=$this->help->get_row($id);		
		$this->template->build('help_form',$data);
	}
	function delete($id){
		if($id){
			$this->help->delete($id);
		}
		redirect('help');
	}
}