<?php
class Research extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('research_model','res');
		$this->load->model('research_detail_model','detail');
	
	}
	function index($view=FALSE){
		$data['result']=$this->res->select("count(n_research_detail.id) as cnt,n_research.*")
									->join("LEFT JOIN n_research_detail on n_research.id=n_research_detail.research_id")
									->groupby("n_research.id")
							   		->sort("")->order("n_research.id desc")->get();
		$data['pagination']=$this->res->pagination();
		$this->template->build('inc_index',$data);
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
	function download($id)
	{
		//$content = new Content($id);
		$file=$this->detail->get_one("file","id",$id);
		$this->load->helper('download');
		$data = file_get_contents("uploads/research/".basename($file));
		$name = basename($file);
		force_download($name, $data); 
	}
}