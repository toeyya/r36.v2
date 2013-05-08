<?php
class Amphur extends R36_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('amphur_model','amphur');	
		$this->amphur->primary_key("amp_pro_id");
	}
	function index($view=FALSE){
		$where="amp_pro_id<>'' ";
		$where.=(!empty($_GET['province_id']))? " and n_amphur.province_id=".$_GET['province_id']:'';
		$where.=(!empty($_GET['amphur_name'])) ? " and amphur_name LIKE '%".$_GET['amphur_name']."%'":'';
		$data['result']=$this->amphur->select("amphur_name,province_name,amphur_id,n_province.province_id,amp_pro_id")
															 ->join("left join n_province on n_province.province_id=n_amphur.province_id")
															 ->where($where)->sort("")->order("amp_pro_id asc")->get();		
		$data['pagination']=$this->amphur->pagination();
		$this->template->build('amphur_index',$data);
	}
	function form($id=FALSE,$area_id=FALSE){
		$this->template->build('amphur_form');
	}
	function save(){
		
		$this->amphur->save($_POST);
	}
	function delete(){
		
	}
	
	
}