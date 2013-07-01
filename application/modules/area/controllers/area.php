<?php
class Area extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('area_model','area');
	
	}
	function index($view=FALSE){
			$data['result']=$this->area->sort("")->order("year desc")->get();
			$data['pagination']=$this->area->pagination();
			$this->template->build('area_index',$data);
	}
	function form($id=FALSE){
		$data['rs']=$this->area->get_row($id);		
		$this->template->build('area_form',$data);
	}
	function delete($id){
		if($id){
			$this->area->delete($id);
			set_notify('success', DELETE_DATA_COMPLETE);
		}
		redirect('area');
	}
	function save(){
		if($_POST){
			$this->area->save($_POST);
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		redirect('area');
	}
}