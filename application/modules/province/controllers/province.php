<?php
class Province extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('province_model','province');
		$this->load->model('area/area_model','area');
		$this->load->model('amphur/amphur_model','amphur');	
		$this->load->model('district/district_model','district');
		$this->load->model('area/area_detail_model','detail');
		$this->load->model('hospital/hospital_model','hospital');
		$this->load->model('province_people_model','people');
		$this->province->primary_key("province_id");
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
												,level,n_area_detail.id as id,provincepeople,total,n_area_detail.id as detail_id
										  FROM n_province
										  LEFT JOIN n_area_detail on n_area_detail.province_id=n_province.province_id
			   							  LEFT JOIN n_area on n_area.id=n_area_detail.area_id
			   							  WHERE n_area_detail.area_id=$area_id and n_area_detail.province_id=$id");				
			
		$data['people'] = $this->people->where("province_id = $id")->sort("")->order("years desc")->get();
		}
		$this->template->build('province_form',$data);
		
	}
	function save(){
		
		//$this->db->debug=true;	
		if($_POST){
			$this->province->primary_key("province_id");
			//$data = array('province_id'=>$_POST['province_id'],'area_id'=>$_POST['area_id'],'')
			$this->province->save($_POST);
			$this->detail->save($_POST);						
			foreach($_POST['people'] as $key=>$item){
				if(!empty($item))
				{										
					$this->db->Execute("delete from n_province_people where province_id = ? and years = ? ",array($_POST['province_id'],$_POST['years'][$key]));
					$this->people->save(array('id'=>'','province_id'=>$_POST['province_id'],'years'=>$_POST['years'][$key],'people'=>$item));
				}
			}
			set_notify('success', SAVE_DATA_COMPLETE);			
		}
		redirect('province/form/'.$_POST['province_id'].'/'.$_POST['area_id']);		
	}

	function province_new(){
		$data['area']=$this->area->get();
		$this->template->build('province_new',$data);
	}
	function save_province_new()
	{// province_id ไม่ auto increment;
			
		if(!empty($_POST['date_cutoff'])){
			$data_cutoff =date2DB($_POST['date_cutoff']);			
			if($_POST)
			{					
				$province_id_old = $_POST['province_id'];
				$amphur_id_old   = $_POST['amphur_id'];
				$user_id = $this->session->userdata('R36_UID');
				$created = date('Y-m-d H:i:s');
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
					$i=0;
					foreach($_POST['amphur_new_id'] as $key =>$item){
						$i++;
						$amphur_code = strval($i);
						$amphur_code = str_pad($amphur_code,2,"0",STR_PAD_LEFT);										
						$this->amphur->save(array('amp_pro_id'=>'','province_id'=>$_POST['province_id'],'amphur_id'=>$amphur_code,'amphur_name'=>$item,'timestamp'=>$created));					
						$this->district->primary_key('tam_amp_id');
						$district = $this->db->Execute("select * from n_district where province_id ='".$province_id_old."' and amphur_id ='".$key."'");
						$j=0;
						foreach($district as $key_d =>$dis){
							$j++;
							$district_code = strval($j);
							$district_code = str_pad($district_code,2,"0",STR_PAD_LEFT);						
							$this->district->save(array('tam_amp_id'=>'','province_id'=>$_POST['province_id']
										,'amphur_id'=>$amphur_code,'district_id'=>$district_code
										,'district_name'=>$dis['district_name'],'timestamp'=>$created));
					
						}// loop district					
					}//loop amphur
				}
				
				$k=0;
				$this->hospital->primary_key('hospital_id');
				foreach($_POST['hospital_new_code'] as $key_h => $item){
					$k++;	
					$hospital_code = strval($k);
					$hospital_code = str_pad($hospital_code,4,'0',STR_PAD_LEFT);
					$amphur_code = substr($key_h,2,2);
					$amphur_id = $this->db->GetOne("select amphur_id from n_amphur where province_id= ? 
									   and amphur_name=(select amphur_name from n_amphur where province_id= ? and amphur_id= ? )",array($_POST['province_id'],$province_id_old,$amphur_code));						
					$hospital_code = $_POST['province_id'].$amphur_id.$hospital_code;															
					$district_code = $this->db->GetOne("select hospital_district_id from n_hospital_1 where hospital_code = ? ",$key_h);
					$data =array('hospital_id'=>'','hospital_code'=>$hospital_code,'hospital_name'=>$item,'hospital_province_id'=>$_POST['province_id']
								,'hospital_amphur_id'=>$amphur_id,'hospital_district_id'=>$district_code,'hospital_name1'=>$item
								,'hospital_type'=>$_POST['hospital_type'][$key_h],'user_id'=>$user_id,'created'=>$created);
					//echo '<pre>';
					//print_r($data);
					//echo '</pre>';
					$this->hospital->save($data);
					//$result = $this->db->Execute("select * from n_information where hospitalcode = ? ",$item);
					
					
				}// loop hospital	
													
				set_notify('success',SAVE_DATA_COMPLETE);
			}//$_POST
		}//date cutoff
		redirect('province/province_new');
	}

	function getAmphurNew(){
		if($_GET){					
			$result = $this->amphur->where('province_id = '.$_GET['province_id'])->sort("")->order("amphur_name asc")->limit(200)->get();			
			echo '<ul>';
			foreach($result as $item){
				echo '<li><input name="amphur_new_id['.$item['amphur_id'].']" value="'.$item['amphur_name'].'" type="checkbox"> '.$item['amphur_name']."</li>";
				
			}
			echo '</ul>';			
		}		
	}
	function getHospital(){
		//$this->db->debug=true;	
		if($_GET){					
			$result = $this->hospital->where('hospital_province_id = '.$_GET['province_id'])->sort("")->order("hospital_name asc")->limit(200)->get();			
			echo '<ul>';
			foreach($result as $item){
				echo '<li><input name="hospital_new_code['.$item['hospital_code'].']" value="'.$item['hospital_name'].'" type="checkbox"> '.$item['hospital_name'];
				echo '<input type="hidden" name="hospital_type['.$item['hospital_code'].']" value="'.$item['hospital_type'].'"></li>';
			}
			echo '</ul>';			
		}		
	}
	function delete($id){
    	if(check_delete_setting("province",$id)){
    		$this->province->delete("province_id",$id);
    		set_notify('success', DELETE_DATA_COMPLETE);
    	}else{
    		set_notify('success','ข้อมูลนี้ถูกใช้อยู่ ไม่สามารถลบรายการนี้ได้');
    	}
		 redirect('province/index');		
	}	
}