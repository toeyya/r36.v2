<?php
class Analyze extends R36_Controller
{
	function __construct()
	{
		parent::__construct();		
		$this->load->model('hospital/hospital_model','hospital');
		$this->load->model('province/province_model','province');
		$this->load->model('inform/inform_model','inform');
		$this->load->model('inform/vaccine_model','vaccine');
		$this->template->append_metadata(js_report());
	}
	function index($no=FALSE,$preview=FALSE)
	{
	 	 $data['textarea'] ="";
		 $data['textprovince'] = "ทั้งหมด";
		 $data['textamphur'] = "ทั้งหมด";
		 $data['textdistrict']="ทั้งหมด";
		 $data['texthospital'] = "ทั้งหมด";
		 $data['textyear']="ทั้งหมด";
		 $data['textmonth']="ทั้งหมด";
		 $data['texttype']="ทั้งหมด";
		 $data['textgroup'] = "ทั้งหมด";
		 $type=array(1=>'จำแนกตามคนไข้ปัจจุบัน',2=>'จำแนกตามคนไข้ขาจร');	
		 $cond="";
		  if(!empty($_GET['hospital'])){
		  		$cond = " AND hospitalcode='".$_GET['hospital']."'";
			  	$data['texthospital']=$this->hospital->get_one("hospital_name","hospital_code",$_GET['hospital']);
		  }elseif(!empty($_GET['amphur'])){
			  	$cond = " AND hospitalamphur='".$_GET['amphur']."' AND hospitalprovince='".$_GET['province']."'";		
				$data['textamphur']=$this->db->GetOne("select amphur_name from n_amphur where province_id= ? and amphur_id= ? ",array($_GET['province'],$_GET['amphur']));
		  }elseif(!empty($_GET['district'])){
		  		$cond = " AND hospitalamphur='".$_GET['amphur']."' AND hospitalprovince='".$province."' and hospitaldistrict='".$_GET['district']."'";
				$data['textdistrict']=$this->db->GetOne("select district_name from n_district where province_id= ? and amphur_id= ? and district_id= ? ",array($_GET['province'],$_GET['amphur'],$_GET['district']));
		  }elseif(!empty($_GET['province'])){
		  	 	$col="hospitalprovince";	
		  	 	if($no=="6") $col="n_amphur.province_id";
			  	$cond = " AND ".$col." = '".$_GET['province']."'";
				$data['textprovince']=$this->province->get_one("province_name","province_id",$_GET['province']);	
		  }elseif(!empty($_GET['group'])){
		  	  if(!empty($_GET['area'])=='1'){
		  	  	 $field="province_level_old";	
				  $data['textarea'] = "รูปแบบเดิม (12 เขต)";		  		
			  }elseif(!empty($_GET['area'])=='2'){
		 		 $field="province_level_new";		
				 $data['textarea']  = "รูปแบบใหม่ (19 เขต)";			
			  }
				  $where=$field."='".$_GET['group']."'";
				  $area=$this->province->select("province_id")->where($where)->sort("")->order("province_id asc")->get();
				  $provinceid=explode(',',$area[0]['province_id']);
				  //$provinceid = substr($provinceid, 0, -2);  
				  $cond = " AND hospitalprovince IN (".$provinceid.")";												
					
					if($_GET['group']=='0'){
						$data['textgroup'] = "กทม.";
					}else{
						$data['textgroup'] = "เขต ".$_GET['group'];
					}
		  }
		  if(!empty($_GET['year'])){					$cond.= " AND year(datetouch)='".$_GET['year']."'";	    	$data['textyear'] = $_GET['year'];}		  	
		  if(!empty($_GET['month'])){				$cond.= " AND month(datetouch)='".$_GET['month']."'";  	$data['textmonth'] = convert_month($_GET['month'],"longthai");	}	  	
		  if(!empty($_GET['year_report'])){		$cond.= " AND year(reportdate)='".$_GET['year_report']."'";}		 
		  if(!empty($_GET['month_report'])){	$cond.= " AND month(reportdate)='".$_GET['month_report']."'";}	  
		  if(!empty($_GET['type'])){					$cond.= " AND in_out='".$type."'";	$data['texttype'] =$type[$_GET['type']];	}									
		
	if($preview)$this->template->set_layout('print');
	$this->template->build('analyze/report1');
		   		
	}
	function report1(){
		
	}
}
?>