<?php
class Content extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('content_model','content');
		$this->load->model('categories_model','category');		
		$this->template->append_metadata(js_checkbox());
		//$this->template->append_metadata(js_datepicker());
		
	
	}
	
	function index($category_id=FALSE,$id=FALSE)
	{
		$data['result'] = $this->content->select('contents.*,userfirstname,usersurname') 
										->join("INNER JOIN n_user on contents.user_id=uid")
										->where("category_id='".$category_id."'")
										->sort("")->order("contents.created DESC,contents.id DESC")->get();		
		$data['pagination'] = $this->content->pagination();
		$data['category_id']=$category_id;
		$data['category']=$this->category->get_row($category_id);
	
		if($category_id){
			$data['content']=$this->content->get_row("category_id",$category_id);		
		}
		if($data['category']['structure']=="contact"){		
			$this->template->build('admin/content_contact',$data);
			
		}else if($data['category']['structure']=="page"){
			$this->template->build('admin/content_page',$data);
			
		}else{
			$this->template->build('admin/content_index',$data);
		}		
	}
	
	function form($category_id = FALSE,$id=FALSE)
	{
		$data['rs'] = $this->content->get_row($id);
		$data['category_id']=$category_id;
		$data['category_name']=$this->category->get_one("name","id",$category_id);		
		$this->template->build('admin/content_form',$data);
	}
	
	function save()
	{
		if($_POST)
		{
			//var_dump($_POST);exit;	
			if(!empty($_POST['start_date']))$_POST['start_date'] = Date2DB($_POST['start_date']);	 else $_POST['start_date'] = date('Y-m-d');
			if(!empty($_POST['end_date']))$_POST['end_date'] = Date2DB($_POST['end_date']);	else $_POST['end_date'] = "0000-00-00";
			if($_POST['user_id']=="")$_POST['user_id'] = $this->session->userdata('R36_UID');
			$id = $this->content->save($_POST);
			if(@$_FILES['image']['name'])
			{
					
				if(image_extension(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION))){	
				$this->content->delete_file($id,'uploads/content/','image');
				$this->content->delete_file($id,'uploads/content/thumbnail/','image');
				
				$this->content->save(array('id' => $id, 'image' => $this->content->upload($_FILES['image'],'uploads/content/',false,600,300)));
				$this->content->thumb('uploads/content/thumbnail/',92,67,'x');
				}
				
			} 
			if(@$_FILES['file']['name'])
			{
				if(file_extension(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION))){
					$this->content->delete_file($id,'uploads/content/download','file');
					$this->content->save(array('id'=>$id,'file'=>$this->content->upload($_FILES['file'],'uploads/content/download')));					
				}
			}
						
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		redirect('content/admin/content/index/'.$_POST['category_id']);
		
	}
	
	function delete($id)
	{
		if($id)
		{
			$this->content->delete($id);
			set_notify('success', DELETE_DATA_COMPLETE);
		} 
		//redirect('content/admin/content/index');		
		redirect($_SERVER['HTTP_REFERER']);
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
	
	function delete_file()
	{			
		$this->content->delete_file($_POST['id'],'uploads/content/download','file');
		$this->content->save(array('id'=>$_POST['id'],'file'=>''));
	}
	function search()
	{
		$searchs = $_POST['search'];
		$data['result'] = $this->content->where("title LIKE '%$searchs%' OR title_eng LIKE '%$searchs%'")->limit(20)->get();
		$data['pagination'] = $this->content->pagination();
		$this->template->build('admin/content_index',$data);
	}
	function category($cat_id = FALSE)
	{
		$data['category'] = $this->category->where("id = $cat_id")->get();
		$this->load->view('admin/category_name',$data);
	}
}
?>