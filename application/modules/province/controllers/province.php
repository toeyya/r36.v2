<?php
class Province extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('province_model','province');
		$this->load->model('area/area_model','area');
		$this->load->model('amphur/amphur_model','amphur');	
		$this->load->model('area/area_detail_model','detail');
		$this->load->model('hospital/hospital_model','hospital');
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
	function province_new(){
		$data['area']=$this->area->get();
		$this->template->build('province_new',$data);
	}
	function save_province_new()
	{// province_id ไม่ auto increment;
		$this->db->debug=true;
		if($_POST)
		{					
			/*$province_id_old = $_POST['province_id'];
			$amphur_id_old   = $_POST['amphur_id'];
			## save จังหวัด ใหม่
			$_POST['province_id'] = $this->db->GetOne("select max(province_id)+1 as province_id from n_province");				  		
			$this->province->save($_POST);
			## บันทึการเลือกเขตความรับผิดชอบ
			if(!empty($_POST['area_id'])){
				$this->detail->delete("province_id",$_POST['province_id']);									
				foreach($_POST['area_id'] as $item){
					if(!empty($_POST['level'][$item])){
						$this->detail->save(array('id'=>'','province_id'=>$_POST['province_id'],'area_id'=>$item,'level'=>$_POST['level'][$item]));
					}					
				}
			}
			## บันทึก อำเภอของจังหวัดใหม่
			if(!empty($_POST['amphur_new_id']))
			{	$this->amphur->primary_key('amp_pro_id');						
				foreach($_POST['amphur_new_id'] as $key =>$item){
					$this->amphur->save(array('amp_pro_id'=>'','province_id'=>$_POST['province_id'],'amphur_id'=>$key,'amphur_name'=>$item,'timestamp'=>date('Y-m-d H:i:s')));
				}
			}*/
			## ย้ายโรงพยาบาล
			if(!empty($_POST['hospital_new_code'])){
				foreach($_POST['hospital_new_code'] as $key => $item){
					$hospital_code=substr($key,3);
					
				}
			}			
			//set_notify('success',SAVE_DATA_COMPLETE);
		}
		//redirect('province/province_new');
	}
	function getAmphurNew(){
		if($_GET){					
			$result = $this->amphur->where('province_id = '.$_GET['province_id'])->sort("")->order("amphur_name asc")->get();			
			echo '<ul>';
			foreach($result as $item){
				echo '<li><input name="amphur_new_id['.$item['amphur_id'].']" value="'.$item['amphur_name'].'" type="checkbox"> '.$item['amphur_name']."</li>";
			}
			echo '</ul>';			
		}		
	}
	function getHospital(){
		if($_GET){					
			$result = $this->hospital->where('hospital_province_id = '.$_GET['province_id']." and hospital_amphur_id =".$_GET['amphur_id'])->sort("")->order("hospital_name asc")->get();			
			echo '<ul>';
			foreach($result as $item){
				echo '<li><input name="hospital_new_code['.$item['hospital_code'].']" value="'.$item['hospital_name'].'" type="checkbox"> '.$item['hospital_name']."</li>";
			}
			echo '</ul>';			
		}		
	}	
}