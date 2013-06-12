<?php
class Document extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('document_model','res');
		$this->load->model('document_detail_model','detail');
	
	}
	function index($view=FALSE){
		$data['result']=$this->res->select("count(n_document_detail.id) as cnt,n_document.*")
									->join("LEFT JOIN n_document_detail on n_document.id=n_document_detail.document_id")
									->groupby("n_document.id")
							   		->sort("")->order("n_document.id desc")->get();
		$data['pagination']=$this->res->pagination();
		$this->template->build('inc_index',$data);
	}
	function detail($document_id)
	{
		$data['result']=$this->detail->where("document_id=".$document_id)->sort('')->order('id asc')->get();
		$data['document_name']=$this->res->get_one("name","id",$document_id);
		$this->template->build('inc_detail',$data);
	}
	function view($document_id,$id){
		$data['rs']=$this->detail->get_row($id);
		$data['document_name']=$this->res->get_one("name","id",$document_id);
		$this->template->build('view',$data);
	}
}