<?php
class Document_detail extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('document_detail_model','detail');
		$this->template->append_metadata(js_checkbox());
	}
	function index($document_id=FALSE){
		$name =(!empty($_GET['name'])) ? " and title like '%".$_GET['name']."%'":'';
		$data['result']=$this->detail->select("n_document_detail.*,name,userfirstname,usersurname")
									->join("LEFT JOIN n_document ON n_document.id=n_document_detail.document_id
											LEFT JOIN n_user ON n_document_detail.user_id=uid")
									->where("document_id=$document_id $name")
									->sort("")->order("n_document_detail.id desc")->get();
		$data['document_id']=$document_id;
		$data['pagination']=$this->detail->pagination();
		$this->template->build('admin/detail/index',$data);
	}
	function form($document_id=FASLE,$id=FALSE){
		
		$data['rs']=$this->detail->get_row($id);	
		$data['document_id']=$document_id;	
		$this->template->build('admin/detail/form',$data);
	}
	function delete($id){
		$this->db->debug=true;
		if($id){
			$this->detail->delete($id);
			set_notify('success', DELETE_DATA_COMPLETE);
		}
		redirect('document/admin/document_detail/index/'.$_GET['document_id']);
	}
	function save()
	{
		//$this->db->debug=true;		
		if($_POST){
			$_POST['user_id']=(!empty($_POST['user_id']))? $_POST['user_id']:$this->session->userdata('R36_UID');
			$id=$this->detail->save($_POST);
			if(!empty($_FILES['image']['name']))
			{					
				if(image_extension(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION))){	
				$this->detail->delete_file($id,'uploads/document/','image');
				$this->detail->delete_file($id,'uploads/document/thumbnail/','image');
				
				$this->detail->save(array('id' => $id, 'image' => $this->detail->upload($_FILES['image'],'uploads/document/',792,583)));
				$this->detail->thumb('uploads/document/thumbnail/',100,80,'x');
				}				
			}			
			if(!empty($_FILES['file']['name']))
			{
				if(file_extension(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION))){
					$this->detail->delete_file($id,'uploads/document','file');
					$this->detail->save(array('id'=>$id,'file'=>$this->detail->upload($_FILES['file'],'uploads/document')));					
				}
			}
					
			set_notify('success',SAVE_DATA_COMPLETE);
		}
		redirect('document/admin/document_detail/index/'.$_POST['document_id']);
	}

}