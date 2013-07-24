<?php
class Webboard_relate_dels extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('webboard_relate_del_model','dels');
		$this->load->model('webboard_quiz_model','quiz');
		$this->load->model('webboard_answer_model','answer');
		
	}
	
	function index()
	{
		//$this->db->debug=TRUE;
		$data['webboard_relate_dels']=$this->dels->select("webboard_answers.detail as detail,webboard_quizs.title as title,webboard_relate_dels.*,userfirstname,usersurname")
										   ->join("LEFT JOIN  webboard_answers ON  webboard_answers.id=webboard_answer_id
										  		   LEFT JOIN  webboard_quizs ON webboard_quizs.id=webboard_relate_dels.webboard_quiz_id
										  		   LEFT JOIN  n_user ON n_user.uid=webboard_relate_dels.user_id
										  			    ")
										  				
										   ->sort("")->order("webboard_relate_dels.id desc")->get();
		//$this->template->append_metadata(js_lightbox());
		$this->template->build('admin/webboard_relate_del_index',$data);
	}
	
	function delete($id=FALSE,$quiz_id=FALSE,$answer_id=FALSE)
	{
		if($id)
		{			
			if($answer_id == 0){		
				$this->quiz->delete($quiz_id);
			
			}else{
				$this->quiz->delete($quiz_id);	
				$this->answer->delete($answer_id);				
			}	
			$this->dels->delete($id);	
			set_notify('success', DELETE_DATA_COMPLETE);
		}
		redirect('webboards/admin/webboard_relate_dels');
	}
	
	function form(){
		$this->template->set_layout('lightbox');
		
	}
}
?>