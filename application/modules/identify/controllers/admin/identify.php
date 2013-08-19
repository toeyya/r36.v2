<?php
class Identify extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('identify_model','identify');
		$this->load->model('identify_detail_model','detail');
		$this->template->append_metadata(js_checkbox());
	}
	function index(){
		$identify_id=(!empty($_GET['identify_id'])) ? " and n_identify.id=".$_GET['identify_id']: '';	
		$data['result']=$this->identify->select("count(n_identify_detail.id) as cnt,n_identify.name as name,n_identify.id as id,userfirstname,usersurname,n_identify.active as active")
									   ->join("LEFT JOIN n_identify_detail on n_identify.id=n_identify_detail.identify_id
											  LEFT JOIN n_user ON n_identify.user_id=uid")
													->where("1=1 $identify_id")
													->groupby("n_identify.id,n_identify.name,userfirstname,usersurname,n_identify.active")
												   ->sort("")->order("n_identify.id desc")->get();
		$data['pagination']=$this->identify->pagination();
		$this->template->build('admin/index',$data);
	}
	function form($id=FALSE){
		$data['rs']=$this->identify->get_row($id);		
		$this->template->build('admin/form',$data);
	}
	function delete($id){
		if($id){
			$this->identify->delete("id",$id);
			$this->detail->delete($id);
			set_notify('success', DELETE_DATA_COMPLETE);
		}
		redirect('identify/admin/identify/index');
	}
	function save(){
		if(!empty($_POST)){
			$_POST['user_id']=(!empty($_POST['user_id']))? $_POST['user_id']:$this->session->userdata('R36_UID');
			$this->identify->save($_POST);
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		redirect('identify/admin/identify/index');
	}
	
	public function checkIdentify(){
		//$this->db->debug=true;
		if(!empty($_GET['id'])){
			$rs = $this->db->GetOne("select id from n_identify where name = ?  and id <> ? ",array($_GET['name'],$_GET['id']));			
		}else{
			$rs = $this->identify->get_one("id","name",$_GET['name']);
		}		
		echo (!empty($rs)) ? "false" :"true";
	}
}