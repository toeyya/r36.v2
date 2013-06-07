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
		$question_id=(!empty($_GET['question_id'])) ? " and n_question.id=".$_GET['question_id']: '';
		$data['result']=$this->quest->select("count(n_question_detail.id) as cnt,n_question.*,userfirstname,usersurname")
														 ->join("LEFT JOIN n_question_detail on n_question.id=n_question_detail.question_id
																	   LEFT JOIN n_user ON n_question.user_id=uid")
														->where("1=1 $question_id")
														->groupby("question_id")
														->sort("")->order("n_question.id desc")->get();
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