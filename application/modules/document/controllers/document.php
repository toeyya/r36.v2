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
		$sql ="SELECT count(n_document_detail.id) as cnt,n_document.* FROM n_document
			   LEFT JOIN n_document_detail on n_document.id=n_document_detail.document_id and n_document_detail.active='1'
			   GROUP BY n_document.id HAVING active ='1' order by n_document.id desc";
		$data['result'] =$this->res->get($sql);		
		$data['pagination']=$this->res->pagination();
		$this->template->build('inc_index',$data);
	}
	function detail($document_id)
	{
		$data['result']=$this->detail->where("active ='1' and document_id=".$document_id)->sort('')->order('id asc')->get();
		$data['document_name']=$this->res->get_one("name","id",$document_id);
		$data['document_id'] = $document_id;
		$this->template->build('inc_detail',$data);
	}
	function view($document_id,$id){
		$data['rs']=$this->detail->get_row($id);
		$data['document_name']=$this->res->get_one("name","id",$document_id);
		$this->template->build('view',$data);
	}
	function download($id,$field="file")
	{
		//$content = new Content($id);
		$file=$this->detail->get_one($field,"id",$id);
		$this->load->helper('download');
		$data = file_get_contents("uploads/document/".basename($file));
		$name = basename($file);
		force_download($name, $data); 
	}
}