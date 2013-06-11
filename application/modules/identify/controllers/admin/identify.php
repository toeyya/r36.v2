<?php
class Identify extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('identify_model','identify');
		$this->template->append_metadata(js_checkbox());
	}
	function index(){
		//$this->db->debug=TRUE;
		$identify_id=(!empty($_GET['identify_id'])) ? " and n_identify.id=".$_GET['identify_id']: '';	
		$data['result']=$this->identify->select("count(n_identify_detail.id) as cnt,n_identify.*,userfirstname,usersurname")
													->join("LEFT JOIN n_identify_detail on n_identify.id=n_identify_detail.identify_id
																 LEFT JOIN n_user ON n_identify.user_id=uid")
													->where("1=1 $identify_id")
													->groupby("n_identify.id")
												   ->sort("")->order("n_identify.id desc")->get();
		$data['pagination']=$this->identify->pagination();
		$this->template->build('admin/index',$data);
	}
	function form($id=FALSE){
		$data['rs']=$this->identify->get_row($id);		
		$this->template->build('admin/form',$data);
	}
	function delete($id){
		if($type_id){
			$this->identify->delete("id",$id);
			$this->type->delete($id);
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
}