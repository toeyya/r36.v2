<?php
class Amphur extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('amphur_model','amphur');
		$this->load->model('amphur_people_model','people');
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
	function form($id=FALSE){	
		$data['rs']=$this->amphur->get_row($id);
		$data['people'] = $this->people->where("amp_pro_id =  $id")->sort("")->order("years desc")->get();	
		$this->template->build('amphur_form',$data);
	}
	function save()
	{		
		if($_POST){
			$this->amphur->save($_POST);
			foreach($_POST['people'] as $key =>$item){
				if(!empty($item)){
					$this->db->Execute("delete from n_amphur_people where amp_pro_id =  ?  and years = ? ",array($_POST['amp_pro_id'],$_POST['years'][$key]));	
					$this->people->save(array('amp_pro_id'=>$_POST['amp_pro_id'],'years'=>$_POST['years'][$key],'people'=>$item));
				}
			}
			set_notify('success', SAVE_DATA_COMPLETE);			
		}
		redirect('amphur/index');		
	}
	function delete($id,$amphur_id,$province_id){
	    if($id){
	    	if(check_delete_setting("amphur",$province_id,$amphur_id)){
	    		$this->amphur->delete($id);
	    		set_notify('success', DELETE_DATA_COMPLETE);
	    	}else{
	    		set_notify('success','ข้อมูลนี้ถูกใช้อยู่ ไม่สามารถลบรายการนี้ได้');
	    	}		
	    }	
	    redirect('amphur/index');
	}
	
	
}