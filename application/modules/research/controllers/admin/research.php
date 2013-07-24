<?php
class Research extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('research_model','res');
		$this->load->model('research_detail_model','detail');
		$this->template->append_metadata(js_checkbox());
	}
	function index(){
		$research_id=(!empty($_GET['research_id'])) ? " and n_research.id=".$_GET['research_id']: '';	
		$data['result']=$this->res->select("count(n_research_detail.id) as cnt,n_research.*,userfirstname,usersurname")
													->join("LEFT JOIN n_research_detail on n_research.id=n_research_detail.research_id
																 LEFT JOIN n_user ON n_research.user_id=uid")
													->where("1=1 $research_id")
													->groupby("n_research.id")
												   ->sort("")->order("n_research.id desc")->get();
		$data['pagination']=$this->res->pagination();
		$this->template->build('admin/index',$data);
	}
	function form($id=FALSE){
		$data['rs']=$this->res->get_row($id);		
		$this->template->build('admin/form',$data);
	}
	function delete($id){
		if($id){
			$this->detail->delete("research_id",$id);
			$this->res->delete($id);
			set_notify('success', DELETE_DATA_COMPLETE);
		}
		redirect('research/admin/research/index');
	}
	function save(){
		if(!empty($_POST)){
			$_POST['user_id']=(!empty($_POST['user_id']))? $_POST['user_id']:$this->session->userdata('R36_UID');
			$this->res->save($_POST);
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		redirect('research/admin/research/index');
	}

	function delete_file()
	{			
		$this->detail->delete_file($_POST['id'],'uploads/research','file');
		$this->detail->save(array('id'=>$_POST['id'],'file'=>''));
	}
}