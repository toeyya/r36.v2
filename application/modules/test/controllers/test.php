<?php
class Test extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		//$this->load->model('research_model','res');
		//$this->load->model('research_detail_model','detail');
	
	}
	function index($view=FALSE){
		//$data['result']=$this->res->select("count(n_research_detail.id) as cnt,n_research.*")
			//						->join("LEFT JOIN n_research_detail on n_research.id=n_research_detail.research_id")
			//						->groupby("n_research.id")
			//				   		->sort("")->order("n_research.id desc")->get();
		//$data['pagination']=$this->res->pagination();
		//$this->template->build('inc_index',$data);
		$this->load->view('phpinfo');
	}
	
	function send_mail()
	{
		$this->load->view('gmail_send');
	}
	
	function send_mail_php()
	{
		$this->load->view('sendthaimail');
	}
	
	function send_mail_t()
	{
		$this->load->view('tongMail');
	}
	
	function phpmail()
	{
		$this->load->view('phpmail');
	}
	
	function php_mail()
	{
		$this->load->view('phpSendmail');
	}
	
	function smtpgmail()
	{
		$this->load->view('smtpgmail');
	}
	
		
	function hmail()
	{
		$this->load->view('hmailserver');
	}
	
	function detail($research_id)
	{
		$data['result']=$this->detail->where("research_id=".$research_id)->sort('')->order('id asc')->get();
		$data['research_name']=$this->res->get_one("name","id",$research_id);
		$this->template->build('inc_detail',$data);
	}
	function view($research_id,$id){
		$data['rs']=$this->detail->get_row($id);
		$data['research_name']=$this->res->get_one("name","id",$research_id);
		$this->template->build('view',$data);
	}
	
	public function img()
	{
		echo $_SESSION['captcha'];
	}
}