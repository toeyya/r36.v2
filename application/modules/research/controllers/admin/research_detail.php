<?php
class Research_detail extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('research_detail_model','detail');
		$this->template->append_metadata(js_checkbox());
	}
	function index($research_id=FALSE){
		$data['result']=$this->detail->select("n_research_detail.*,name,userfirstname,usersurname")
														->join("LEFT JOIN n_research ON n_research.id=n_research_detail.research_id
																	 LEFT JOIN n_user ON n_research_detail.user_id=uid")
														->sort("")->order("n_research_detail.id desc")->get();
		$data['research_id']=$research_id;
		$data['pagination']=$this->detail->pagination();
		$this->template->build('admin/detail/index',$data);
	}
	function form($research_id=FASLE,$id=FALSE){
		
		$data['rs']=$this->detail->get_row($id);	
		$data['research_id']=$research_id;	
		$this->template->build('admin/detail/form',$data);
	}
	function delete($id){
		if($id){
			$this->detail->delete("id",$id);
		}
		redirect('research/admin/research_detail/index');
	}
	function save(){
		if($_POST){
			$_POST['user_id']=(!empty($_POST['user_id']))? $_POST['user_id']:$this->session->userdata('R36_UID');
			$id=$this->detail->save($_POST);
			if(@$_FILES['file']['name'])
			{
				if(file_extension(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION))){
					$this->detail->delete_file($id,'uploads/research','file');
					$this->detail->save(array('id'=>$id,'file'=>$this->detail->upload($_FILES['file'],'uploads/research')));					
				}
			}
					
			set_notify('success',SAVE_DATA_COMPLETE);
		}
		redirect('research/admin/research_detail/index/'.$_POST['research_id']);
	}

}