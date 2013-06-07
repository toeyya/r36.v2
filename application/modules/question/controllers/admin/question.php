<?php
class Question extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('question_model','quest');
		$this->template->append_metadata(js_checkbox());
	}
	function index(){
		$data['result']=$this->quest->select("n_question.*,userfirstname,usersurname")->join("LEFT JOIN n_user ON user_id=uid")->sort("")->order("id desc")->get();
		$data['pagination']=$this->quest->pagination();
		$this->template->build('admin/index',$data);
	}
	function form($id=FALSE){
		$data['rs']=$this->quest->get_row($id);		
		$this->template->build('admin/form',$data);
	}
	function delete($id){
		if($type_id){
			$this->question->delete("id",$id);
			$this->type->delete($id);
		}
		redirect('admin/index');
	}
	function save(){
		if(!empty($_POST)){
			$_POST['user_id']=(!empty($_POST['user_id']))? $_POST['user_id']:$this->session->userdata('R36_UID');
			$this->quest->save($_POST);
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		redirect('question/admin/question/index');
	}
}