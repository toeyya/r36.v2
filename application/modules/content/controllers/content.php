<?php
class Content extends Public_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('content_model','content');
		$this->load->model('categories_model','cat');
		

		
	}
	function index($category_id,$layout=FALSE)
	{
		
		$data['contents']=$this->content->select("contents.*,CONVERT(VARCHAR(10), start_date, 120) AS [start_date]")
							   ->where("category_id='".$category_id."' and start_date <= CONVERT(date, getdate()) and (end_date >= CONVERT(date, getdate()) or end_date is null) and active = '1'")
							   ->sort("")->order("id desc ")->limit(20)->get();
		$data['pagination']=$this->content->pagination();	
		$data['category_id']=$category_id;
		$data['category']=$this->cat->get_row($category_id);
		if($category_id=="8"){// ติดต่อเรา
			$data['contents']=$this->content->get_row("category_id",$category_id);
			$this->template->build('content_contact',$data);
		}else if($data['category']['structure']=="page"){
			$data['contents']=$this->content->get_row("category_id",$category_id);			
			$this->template->build('content_page',$data);
		}else if($data['category']['structure']=="download"){
			$this->template->build('inc_download',$data);
		}else{
			$this->template->build('inc_index',$data);
		}
		
	}
	
	function view($category_id,$id){
		$data['content']=$this->content->select("contents.*,CONVERT(VARCHAR(10), start_date, 120) AS [start_date]")->get_row($id);
		$data['category_id']=$category_id;
		$data['category'] = $this->cat->get_row($category_id);
		$this->template->build('view',$data);
	}
		
	
	function search()
	{
		if(isset($_GET['search'])){$where = " and title like '%".$_GET['search']."%' "; $data['search'] = $_GET['search'];}else{$where=' ';}
		
		$data['result'] = $this->content->limit(20)->get("SELECT contents.* FROM contents JOIN categories ON contents.cat_id= categories.id WHERE type = 'content' and active='1' ".$where." ORDER BY contents.created desc,contents.id DESC");

		$data['pagination'] = $this->content->pagination();
	
		$this->template->build('search',$data);
			
	}
	
	

	function view_all($id)
	{//sysdate()
		$data['contents']=$this->content->select("contents.*,CONVERT(VARCHAR(10), start_date, 120) AS [start_date]")->where("category_id=$id and start_date <= CONVERT(date, getdate()) and (end_date >= CONVERT(date, getdate()) or end_date is null)  and active = '1'")->sort("")
						->sort("")->order("id desc")->limit(20)->get();						
		$data['category']  = $this->cat->get_row($id);
		$data['pagination'] = $this->content->pagination();
		$this->template->build('inc_index',$data);	
	}	
	function inc_knowledge(){
		//$this->db->debug=TRUE;	
		$data['contents']=$this->content->where("category_id='7' and start_date <= CONVERT(date, getdate()) and (end_date >= CONVERT(date, getdate()) or end_date is null) and active = '1'")->sort("")
								        ->sort("")->order("id desc")->limit(4)->get();
		$data['category_id'] ="7";
		$this->load->view('inc_knowledge',$data);		
	}
	function inc_information()
	{//GETDATE()
		$data['contents']=$this->content->where("category_id='6' and start_date <= CONVERT(date, getdate()) and (end_date >= CONVERT(date, getdate()) or end_date is null) and active = '1'")->sort("")
										->sort("")->order("queue")->limit(10)->get();
		$data['category_id'] ="6";
		$this->load->view('inc_information',$data);
	}
	function inc_marquee()
	{  //$this->db->debug = true;
		$data['contents']=$this->content->where("category_id=9")->limit(1)->get();
		$this->load->view('inc_marquee',$data);
	}
	function download($id)
	{
		//$content = new Content($id);
		$file=$this->content->get_one("file","id",$id);
		$this->load->helper('download');
		$data = file_get_contents("uploads/content/download/".basename($file));
		$name = basename($file);
		force_download($name, $data); 
	}
	function inc_footer($category_id){
		$data['content']=$this->content->get_row("category_id",$category_id);	
		$this->load->view('inc_footer',$data);
	}
}
?>