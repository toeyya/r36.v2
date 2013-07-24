<?php
	
Class Webboard_quizs extends Admin_Controller{
		
	function __construct(){
		parent::__construct();
		$this->load->model('webboard_quiz_model','quizs');
	}
		
	function index()
	{
		//$webboard_quizs = new Webboard_quiz();
		//if(!empty($_GET['webboard_category_id']))$webboard_quizs->where('webboard_category_id',$_GET['webboard_category_id']);
		$where="";
		if(!empty($_GET['webboard_category_id']))$where=" and webboard_category_id=".$_GET['webboard_category_id'];
		//$data['webboard_quizs'] = $webboard_quizs->order_by('id','desc')->get_page(20);
		$data['webboard_quizs'] = $this->quizs->where("webboard_category_id <>'' $where ")->sort("")->order("id desc")->get();
		$data['pagination']=$this->quizs->pagination();
		//$this->template->append_metadata(js_lightbox());
		$this->template->build('admin/webboard_index',$data);
	}
	
	function form($id=FALSE)
	{
		//$data['webboard_quizs'] = new Webboard_quiz($id);
		$data['webboard_quizs'] = $this->quizs->get_row($id);
		$this->template->build('admin/webboard_new_topic_form',$data);
	}
	
	function save($id=FALSE){
		if($_POST){
			if($_POST['user_id']=="")$_POST['user_id']=$this->session->userdata('id');
			$this->quizs->save($_POST);
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		redirect('webboards/admin/webboard_quizs');
	}
	
	function delete($id=FALSE){
		if($id)
		{
		
			$this->quizs->delete($id);
			set_notify('success', DELETE_DATA_COMPLETE);
		}
		redirect('webboards/admin/webboard_quizs');
	}
}
?>