<?php
class Province extends R36_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('province_model','province');	
	}
	function index($view=FALSE){
		//$this->db->debug=TRUE;	
		$where=" n_area_detail.province_id <>'' ";
		$where.=(!empty($_GET['province_id']))? " and n_area_detail.province_id=".$_GET['province_id']:'';
		$where.=(!empty($_GET['area_id']))? " and n_area_detail.area_id=".$_GET['area_id']:'';
		$where.=(!empty($_GET['level']))? " and n_area_detail.level=".$_GET['level']:'';
		
		$data['result']=$this->province->select("n_area_detail.province_id as province_id,province_name,area_id,n_area.name as area_name,level,provincepeople")
										   ->join("LEFT JOIN n_area_detail on n_area_detail.province_id=n_province.province_id
										   				LEFT JOIN n_area on n_area.id=n_area_detail.area_id")
										   	->where($where)->sort("")->order("area_id desc,level asc")->get();
		$data['total']=$this->db->GetOne("select max(total) from n_area");
		$data['pagination']=$this->province->pagination();
		$this->template->build('province_index',$data);
	}
	function form($id=FALSE,$area_id=FALSE){
		$data['rs']=array();
		if($id && $area_id){
			$data['rs']=$this->db->GetRow("SELECT n_area_detail.province_id as province_id,province_name,area_id,n_area.name as area_name
																					,level,n_area_detail.id as id,provincepeople
																	  FROM n_province
																	  LEFT JOIN n_area_detail on n_area_detail.province_id=n_province.province_id
										   							  LEFT JOIN n_area on n_area.id=n_area_detail.area_id
										   							  WHERE n_area_detail.area_id=$area_id and n_area_detail.province_id=$id");				
			
		}
		$this->template->build('province_form',$data);
		
	}
	function save(){
		
	}
	function delete(){
		
	}
	
	
}