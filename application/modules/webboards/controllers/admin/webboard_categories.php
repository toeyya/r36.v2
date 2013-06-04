<?php
class Webboard_categories extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("webboard_category_model",'category');
		$this->load->model('webboard_quiz_model','quiz');
		$this->load->model('webboard_answer_model','answer');

	}
	
	function index()
	{
		//$data['categories'] = new Webboard_category();
		$data['categories']=$this->category->sort("")->order("orderlist asc")->get();
		//$data['categories']->order_by('orderlist','asc')->get_page();
		//$data['pagination']=$this->category->pagination();
		//$this->template->append_metadata(js_lightbox());
		//$this->template->append_metadata(js_checkbox('approve'));
		$this->template->build('admin/category_index',$data);
	}
	
	function approve($id)
	{
		if($_POST)
		{
			$categories = new Webboard_category($id);
			$categories->from_array($_POST);
			$categories->save();
		}
		echo $_POST['status'];
	}
	
	function form($id=FALSE)
	{	
			//$categories = new Webboard_category();
			//$categories->get();
			//$data['parent'] = $categories->get_clone();
		//	$categories->clear();
			//$data['category'] = $categories->get_by_id($id);
			$data['category'] = $this->category->get_row($id);
			$this->template->build('admin/category_form',$data);
	}
	
	function save()
	{				
		if($_GET)
		{
			if(isset($_GET['orderlist'])){
				foreach($_GET['orderlist'] as $key => $item)
				{
					if($item)
					{
						//$category = new Webboard_category(@$_POST['orderid'][$key]);
						$this->db->Execute("UPDATE webboard_categories SET orderlist='".$item."' WHERE id=".@$_GET['orderid'][$key]);
						//$category->from_array(array('orderlist' => $item));
						//$category->save();
					}
				}
				set_notify('success', SAVE_DATA_COMPLETE);
			}
		}
			if($_POST){
			
				//$category = new Webboard_category($id);						
				$this->category->save($_POST);
				set_notify('success', SAVE_DATA_COMPLETE);
			}
		
		redirect('webboards/admin/webboard_categories');
	}
	
	function delete($id)
	{
		if($id)
		{
			$this->category->delete($id);
			$this->quiz->delete("webboard_category_id",$id);
			$this->answer->delete("webboard_category_id",$id);
			
			set_notify('success', DELETE_DATA_COMPLETE);
		}
		redirect('webboards/admin/webboard_categories');
	}
	
}
?>