<?php
class Content extends Public_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('content_model','content');
		$this->load->model('category_model','cat');
		$this->load->model('vote_model','vote');

		
	}
	function index($category_id,$layout=FALSE){
		//$this->db->debug=TRUE;	
		$data['contents']=$this->content->where("category_id='".$category_id."' and start_date <= date(sysdate()) and (end_date >= date(sysdate()) or end_date = date('0000-00-00')) and status = 'approve'")
																  ->sort("")->order("id desc")->limit(20)->get();
		$data['pagination']=$this->content->pagination();	
		$data['category_id']=$category_id;
		$data['category']=$this->cat->get_row($category_id);
		if($category_id=="16"){
			$this->template->build('content_contact');
		}else if($layout=="page"){
			$data['contents']=$this->content->get_row("category_id",$category_id);			
			$this->template->build('content_page',$data);
		}else if($data['category']['type']=="download"){
			$this->template->build('inc_download',$data);
		}else{
			$this->template->build('inc_index',$data);
		}
		
	}
	
	function view($category_id,$id){
		$data['content']=$this->content->get_row($id);
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
	
	

	
	
	function inc_hilight($cat_id,$limit)
	{
		$data['result'] = $this->content->select("*,ifnull((datediff(curdate(),created)),0) as new,ifnull((datediff(modified,created)),0) as updated")->where('active=1 and cat_id = '.$cat_id)->limit($limit)->sort('')->order('created desc')->get();
		$this->load->view('inc_hilight',$data);
	}
	
	
	function vote()
	{		
		$data = array('cat_id'=>$_POST['cat_id'],'content_id' => $_POST['content_id'],'value' => $_POST['value'],'ip' => getIP());
		$this->db->autoexecute('votes',$data,'INSERT');
	
	}
	function inc_report(){
		//$this->db->debug=TRUE;	
		$data['contents']=$this->content->where("category_id='11' and start_date <= date(sysdate()) and (end_date >= date(sysdate()) or end_date = date('0000-00-00')) and status = 'approve'")->sort("")
																->sort("")->order("id desc")->limit(6)->get();
		$this->load->view('inc_report',$data);		
	}
	function inc_information(){
		$data['contents']=$this->content->where("category_id='1' and start_date <= date(sysdate()) and (end_date >= date(sysdate()) or end_date = date('0000-00-00')) and status = 'approve'")->sort("")
																->sort("")->order("id desc")->limit(3)->get();
		$this->load->view('inc_information',$data);
	}
	function inc_marquee()
	{	
		$data['contents']=$this->content->select("GROUP_CONCAT(title) as title")->where("category_id=2 and start_date <= date(sysdate()) and (end_date >= date(sysdate()) or end_date = date('0000-00-00')) and status = 'approve'")
																  ->sort("")->order('id desc')->limit(3)->get();
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