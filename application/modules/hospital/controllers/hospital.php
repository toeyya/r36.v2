<?php
class Hospital extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('hospital_model','hospital');

		
	}
	function index($view=FALSE){
		$amphur=(!empty($_GET['amphur_id'])) ? $_GET['amphur_id']:'';
		$province=(!empty($_GET['province_id'])) ? $_GET['province_id']:'';
		$district=(!empty($_GET['district_id'])) ? $_GET['district_id']:'';
		$hospital_name=(!empty($_GET['hospital_name'])) ? $_GET['hospital_name']:'';
		$hospital=(!empty($_GET['hospital'])) ? $_GET['hospital'] :'';
		$wh='';
		 if($amphur!=''){	$wh=" AND  hospital_amphur_id = '".$amphur."' AND hospital_province_id ='".$province."'";
		  }else if($province!=''){$wh=" AND hospital_province_id ='".$province."'"; }
		  if($district!=''){$wh .=" AND hospital_district_id ='".$district."'"; }
		  if($hospital_name!=''){$wh .=" AND hospital_name LIKE'%".$hospital_name."%'";}	
		  if($hospital){$wh.=" AND hospital_code_healthoffice LIKE'".$hospital."%' OR hospital_name like'%".$hospital."%'";}  
		  if($view){$wh=" AND hospital_id='$view'";}
		  
		  $data['wh']=$wh;		  
		 /*  INNER JOIN n_district on n_hospital_1.hospital_district_id    =n_district.district_id 
												  and n_hospital_1.hospital_amphur_id  =n_amphur.amphur_id
												 and n_hospital_1.hospital_province_id =n_province.province_id*/
		 
		  $data['result']=$this->hospital->select("n_hospital_1.*,province_name,amphur_name,province_level_old,province_level_new,hospital_code_healthoffice ")
		  														  ->join("INNER JOIN n_province on n_hospital_1.hospital_province_id=n_province.province_id
																			    LEFT JOIN n_amphur on n_hospital_1.hospital_amphur_id=n_amphur.amphur_id 
																			 										and n_amphur.province_id				=n_hospital_1.hospital_province_id

																			")
		  														 ->where("hospital_id <>'' $wh ")->sort("")
		  													     ->order("hospital_province_id,hospital_amphur_id,hospital_name ASC")->limit(20)->get();	
		  $data['pagination']=$this->hospital->pagination();	
		 if($view){
		 	 $this->template->build('hospital_view',$data);
		 }else{
		 	 $this->template->build('hospital_index',$data);
		 }
		 
	}
	function form($id=FALSE){
		$data['rs']=$this->hospital->get_row("hospital_id",$id);	
		$this->template->build('hospital_form',$data);
	}
	function delete($id){
		if($id)
		{	
			$this->hospital->delete("hospital_id",$id);
		}
		redirect('hospital/index?');
	}
	function hospitalExists()
	{	
		$sql="select hospital_id from n_hospital_1 where (hospital_province_id= ?  and hospital_amphur_id= ?  and hospital_name= ? and hospital_district_id = ? ) and hospital_id <> ? ";	
		$id=$this->db->GetOne($sql,array($_GET['province_id'],$_GET['amphur_id'],$_GET['hospital_name'],$_GET['district_id'],$_GET['hospital_id']));
		echo ($id)? "false":"true";
		
	}
	function getHospital()
	{
		$name=(isset($_GET['name']))?$_GET['name']:'hospital';
		$class=(isset($_GET['class']))?" styled-select ".$_GET['class']:"styled-select";			
		$special=' class="'.$class.'" id="'.$name.'"';		
		$default=(isset($_GET['default']))?"ทั้งหมด":'-โปรดเลือก-';
		if($_GET['ref1'] || $_GET['ref2'])
		{
			$wh="WHERE hospital_province_id='".$_GET['ref1']."' and hospital_amphur_id='".$_GET['ref2']."' and hospital_district_id='".$_GET['ref3']."' ORDER BY hospital_name ASC";				
			echo form_dropdown($name,get_option('hospital_code','hospital_name',"n_hospital_1 $wh"),'',$special,$default);
		}else{
			$output = '<select name="'.$name.'" class="'.$class.'" id="'.$name.'">';
	   		$output.= '<option value="" selected="selected">'.$default.'</option>';
	   		$output.='</select>';
	   		echo $output;			
		}
	}
	function save()
	{
		//$this->db->debug=true;
		if($_POST){	
			$_POST['hospital_province_id']=$_POST['province_id'];
			$_POST['hospital_amphur_id']=$_POST['amphur_id'];
			$_POST['hospital_district_id']=$_POST['district_id'];
			$_POST['user_id']=$this->session->userdata('R36_UID');
			
			if($_POST['hospital_id'])
			{
				$rs = $this->hospital->get_row("hospital_id",$_POST['hospital_id']);		
				$_POST['hospital_code']=$_POST['province_id'].$_POST['amphur_id'].substr($_POST['hospital_code'],4);			
								
				$this->db->Execute("UPDATE n_information SET hospitalcode = '".$_POST['hospital_code']."'
													,hospitalprovince ='".$_POST['hospital_province_id']."' 
													,hospitalamphur = '".$_POST['hospital_amphur_id']."'
													,hospitaldistrict ='".$_POST['hospital_district_id']."'
													WHERE hospitalcode = '".$rs['hospital_code']."'");
				$this->db->Execute("UPDATE n_historydead SET hospitalid = '".$_POST['hospital_code']."' WHERE hospitalid = '".$rs['hospital_code']."'");
				$this->db->Execute("UPDATE n_user SET userhospital = '".$_POST['hospital_code']."' WHERE userhospital = '".$rs['hospital_code']."'");
				$this->db->Execute("UPDATE n_vaccine SET byplace ='".$_POST['hospital_name']."' WHERE byplace ='".$rs['hospital_name']."'");
			}else{
				$sql="SELECT Max(hospital_code) AS chk_hospitalcode FROM n_hospital_1 WHERE hospital_province_id= ? AND  hospital_amphur_id=? ";
				$code=$this->db->GetOne($sql,array($_POST['province_id'],$_POST['amphur_id']));					
				if($_POST['hospital_code']=='')
				{
					if($code){
								$_POST['hospital_code']=$code+1;
					}else{
								$_POST['hospital_code']=$_POST['province_id'].$_POST['amphur_id'].'0001';
					}						
				}				
			}			
			$this->hospital->primary_key("hospital_id");
			$id=$this->hospital->save($_POST);
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		redirect('hospital/index');
	}
	function GetClearHospital(){
		$output = '<select name="hospital" class="styled-select" id="hospital">';
   		$output.= '<option value="">ทั้งหมด</option>';
   		$output.='</select>';
   		echo $output;
	}

}
?>
