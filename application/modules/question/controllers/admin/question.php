<?php
class Question extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('question_model','quest');
		$this->load->model('question_model','type');
		$this->template->append_metadata(js_checkbox());
	}
	function index(){
		$question_id=(!empty($_GET['question_id'])) ? " and n_question.id=".$_GET['question_id']: '';
		$data['result']=$this->quest->select("count(n_question_detail.id) as cnt,n_question.id,n_question.active,n_question.name,userfirstname,usersurname")
														 ->join("LEFT JOIN n_question_detail on n_question.id=n_question_detail.question_id
																	   LEFT JOIN n_user ON n_question.user_id=uid")
														->where("1=1 $question_id")
														->groupby("n_question.id,n_question.active,n_question.name,userfirstname,usersurname")
														->sort("")->order("n_question.id desc")->get();
		$data['pagination']=$this->quest->pagination();
		$this->template->build('admin/index',$data);
	}
	function form($id=FALSE){
		$data['rs']=$this->quest->get_row($id);		
		$this->template->build('admin/form',$data);
	}
	function delete($id){
		if($id){
			$this->quest->delete("question_id",$id);
			$this->type->delete($id);
		}
		redirect('question/admin/question/index');
	}
	function save(){
		if(!empty($_POST)){
			$_POST['user_id']=(!empty($_POST['user_id']))? $_POST['user_id']:$this->session->userdata('R36_UID');
			$this->quest->save($_POST);
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		redirect('question/admin/question/index');
	}
	
	public function checkQues(){
		//$this->db->debug=true;
		if(!empty($_GET['id'])){
			$rs = $this->db->GetOne("select id from n_question where name = ?  and id <> ? ",array($_GET['name'],$_GET['id']));			
		}else{
			$rs = $this->quest->get_one("id","name",$_GET['name']);
		}		
		echo (!empty($rs)) ? "false" :"true";
	}
}