<?php
class Question extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('question_model','quest');
		$this->load->model('question_detail_model','detail');
	
	}
	function index($view=FALSE){
		$data['result']=$this->quest->select("count(n_question_detail.id) as cnt,n_question.*")
									 ->join("LEFT JOIN n_question_detail on n_question.id=n_question_detail.question_id")									
									->groupby("n_question.id")
									->sort("")->order("n_question.id desc")->get();
		$data['pagination']=$this->quest->pagination();
		$this->template->build('inc_index',$data);
	}
	function detail($question_id)
	{
		$data['result']=$this->detail->where("question_id=".$question_id)->sort('')->order('no asc')->limit(5)->get();
		$data['question_name']=$this->quest->get_one("name","id",$question_id);
		$data['pagination'] =$this->detail->pagination();
		$this->template->build('inc_detail',$data);
	}
	

}