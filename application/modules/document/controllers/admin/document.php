<?php
class Document extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('document_model','doc');
		$this->load->model('document_detail_model','detail');
		$this->template->append_metadata(js_checkbox());
	}
	function index(){
		$document_id=(!empty($_GET['document_id'])) ? " and n_document.id=".$_GET['document_id']: '';	
		$data['result']=$this->doc->select("count(n_document_detail.id) as cnt,n_document.*,userfirstname,usersurname")
													->join("LEFT JOIN n_document_detail on n_document.id=n_document_detail.document_id
																 LEFT JOIN n_user ON n_document.user_id=uid")
													->where("1=1 $document_id")
													->groupby("n_document.id")
												   ->sort("")->order("n_document.id desc")->get();
		$data['pagination']=$this->doc->pagination();
		$this->template->build('admin/index',$data);
	}
	function form($id=FALSE){
		$data['rs']=$this->doc->get_row($id);		
		$this->template->build('admin/form',$data);
	}
	function delete($id){
		if($type_id){
			$this->document->delete("id",$id);
			$this->type->delete($id);
			set_notify('success', DELETE_DATA_COMPLETE);
		}
		redirect('document/admin/document/index');
	}
	function save(){
		if(!empty($_POST)){
			$_POST['user_id']=(!empty($_POST['user_id']))? $_POST['user_id']:$this->session->userdata('R36_UID');
			$this->doc->save($_POST);
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		redirect('document/admin/document/index');
	}
	function download($id)
	{
		//$content = new Content($id);
		$file=$this->detail->get_one("file","id",$id);
		$this->load->helper('download');
		$data = file_get_contents("uploads/document/".basename($file));
		$name = basename($file);
		force_download($name, $data); 
	}
	
	function delete_file()
	{			
		$this->detail->delete_file($_POST['id'],'uploads/document','file');
		$this->detail->save(array('id'=>$_POST['id'],'file'=>''));
	}
}