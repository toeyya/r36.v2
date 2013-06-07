<?php
class Question extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('question_model','quest');
	
	}
	function index($view=FALSE){
		$data['result']=$this->quest->sort("")->get();
		$data['pagination']=$this->quest->pagination();
		$this->template->build('question_index',$data);
	}
	function form($id=FALSE){
		$data['rs']=$this->quest->get_row($id);		
		$this->template->build('question_form',$data);
	}
	function delete($id){
		if($type_id){
			$this->question->delete("id",$id);
			$this->type->delete($id);
		}
		redirect('question/index');
	}
	function detail_form($type_id=FALSE,$id=FALSE){
		$this->template->build('question_detail');
	}
	function detail_delete($id){
		if($id){
			$this->quest->delete($id);
		}
		redirect('question/index');
	}
}