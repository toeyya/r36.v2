<?php
class Identify_detail extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('identify_detail_model','detail');
		$this->template->append_metadata(js_checkbox());
	}
	function index($identify_id=FALSE){
		//$this->db->debug=TRUE;	
		$data['result']=$this->detail->select("n_identify_detail.*,n_identify.name as identify_name,userfirstname,usersurname")
									 ->join("LEFT JOIN n_identify ON n_identify.id=n_identify_detail.identify_id
																	 LEFT JOIN n_user ON n_identify_detail.user_id=uid")
									 ->where("identify_id=$identify_id")					
									 ->sort("")->order("n_identify_detail.id desc")->get();
		$data['identify_id']=$identify_id;
		$data['pagination']=$this->detail->pagination();
		$this->template->build('admin/detail/index',$data);
	}
	function form($identify_id=FASLE,$id=FALSE){
		
		$data['rs']=$this->detail->get_row($id);	
		$data['identify_id']=$identify_id;	
		$this->template->build('admin/detail/form',$data);
	}
	function delete($id){
		if($id){
			$this->detail->delete("id",$id);
		}
		redirect('identify/admin/identify_detail/index');
	}
	function save(){
		if($_POST){
			$_POST['user_id']=(!empty($_POST['user_id']))? $_POST['user_id']:$this->session->userdata('R36_UID');
			$id=$this->detail->save($_POST);
			if(@$_FILES['file']['name'])
			{
				if(file_extension(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION))){
					$this->detail->delete_file($id,'uploads/identify','file');
					$this->detail->save(array('id'=>$id,'file'=>$this->detail->upload($_FILES['file'],'uploads/identify')));					
				}
			}
					
			set_notify('success',SAVE_DATA_COMPLETE);
		}
		redirect('identify/admin/identify_detail/index/'.$_POST['identify_id']);
	}

}