<?php
class Area extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('area_model','area');
		$this->load->model('area_detail_model','detail');
	
	}
	function index($view=FALSE){
			$area_id=(!empty($_GET['area_id'])) ? "and id =".$_GET['area_id']:'';
			$data['result']=$this->area->where("1=1 $area_id")->sort("")->order("year desc")->get();
			$data['pagination']=$this->area->pagination();
			$this->template->build('area_index',$data);
	}
	function form($id=FALSE){
		$data['rs']=$this->area->get_row($id);		
		$this->template->build('area_form',$data);
	}
	function delete($id){
		if($id){
			$this->area->delete($id);
			$this->detail->delete("area_id",$id);
			set_notify('success', DELETE_DATA_COMPLETE);
		}
		redirect('area');
	}
	function save(){
		if($_POST){
			$this->area->save($_POST);
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		redirect('area');
	}
	
	public function checkArea(){
		//$this->db->debug=true;
		if(!empty($_GET['id'])){
			$rs = $this->db->GetOne("select id from n_area where name = ?  and id <> ? ",array($_GET['name'],$_GET['id']));	
			echo (!empty($rs)) ?"false": "true" ;		
		}else{
			$rs = $this->area->get_one("id","name",$_GET['name']);
			echo (!empty($rs)) ?"false": "true" ;	
		}		
		
	}
}