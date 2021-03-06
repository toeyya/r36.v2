<?php
class Question_detail extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('question_detail_model','detail');
		$this->template->append_metadata(js_checkbox());
	}
	function index($question_id=FALSE){
		$where =(empty($_GET['question'])) ? "":" and question like '%".$_GET['question']."%'";
		$data['result']=$this->detail->select("n_question_detail.*,name,userfirstname,usersurname")
									->join("LEFT JOIN n_question ON n_question.id=n_question_detail.question_id
											LEFT JOIN n_user ON n_question_detail.user_id=uid")
									->where("question_id=$question_id $where")
									->sort("")->order("n_question_detail.id desc")->get();
		$data['question_id']=$question_id;
		$data['pagination']=$this->detail->pagination();
		$this->template->build('admin/detail/index',$data);
	}
	function form($question_id=FASLE,$id=FALSE){
		
		$data['rs']=$this->detail->get_row($id);	
		$data['question_id']=$question_id;	
		$this->template->build('admin/detail/form',$data);
	}
	function delete($question_id,$id){
		if($id){
			$this->detail->delete("id",$id);
		}
		redirect('question/admin/question_detail/index/'.$question_id);
	}
	function save(){
		if($_POST){
			$_POST['user_id']=(!empty($_POST['user_id']))? $_POST['user_id']:$this->session->userdata('R36_UID');
			$this->detail->save($_POST);
			set_notify('success',SAVE_DATA_COMPLETE);
		}
		redirect('question/admin/question_detail/index/'.$_POST['question_id']);
	}

}