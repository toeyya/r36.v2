<?php
class Report extends R36_Controller
{
	function __construct()
	{
		parent::__construct();		
		$this->load->model('hospital/hospital_model','hospital');
		$this->load->model('province/province_model','province');
		$this->load->model('inform/inform_model','inform');
		$this->load->model('inform/vaccine_model','vaccine');
	}

	function index($no=FALSE,$preview=FALSE)
	{
		### ###################################################			
		###	 user file  "ajaxreport.js"													    			###
		###	 report1  --> สรุปข้อมูล r36															    ###
		###  report4   --->สรุปประวัติคนไข้ในเขตอำเภอและคนไข้นอกเขตอำเภอ   ###	
		// $this->db->debug=TRUE;

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
				$data['texthospital']=$this->db->GetOne("select district_name from n_district where province_id= ? and amphur_id= ? and district_id= ? ",array($_GET['province'],$_GET['amphur'],$_GET['district']));
		  }elseif(!empty($_GET['province'])){
			  	$cond = " AND hospitalprovince='".$_GET['province']."'";
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
		  if(!empty($_GET['year'])){
		  	$cond = $cond." AND year(datetouch)='".$_GET['year']."'";	
			  	$data['textyear'] = $_GET['year'];
		  	} 
		  if(!empty($_GET['month'])){
		  	$cond = $cond." AND month(datetouch)='".$_GET['month']."'";
			  $data['textmonth'] = convert_month($_GET['month'],"longthai");
		  	}
		  if(!empty($_GET['year_report']))	$cond = $cond." AND year(reportdate)='".$_GET['year_report']."'";		 
		  if(!empty($_GET['month_report']))$cond = $cond." AND month(reportdate)='".$_GET['month_report']."'";	  
		   if(!empty($_GET['type'])){
		   	$cond = $cond." AND in_out='".$type."'";					  
			$data['texttype'] =$type[$_GET['type']];										
		   }
			$current = date('Ymdhis');
			$data['current']=$current;
		    $data['cond']=$cond;

				  	
			if($preview) $this->template->set_layout('print');
			
			if($no=="4"){
				//$this->template->build('report4_demo',$data);
				$this->template->build("report".$no."_index",$data);
			}else{
				$this->template->build("report".$no."_index",$data);
			}

			
		
	}
	function dead(){
		$this->template->build('report7_index');
	}
	function form()
	{
		$this->template->set_layout('blank');	
		$this->template->build('report4_form');
	}
	function schedule($preview=FALSE)
	{//$this->db->debug=TRUE;
				
			if($this->session->userdata('R36_PROVINCE')!='' && $this->session->userdata('R36_LEVEL')=='02'){
						$wh="AND provinceid = '".$this->session->userdata('R36_PROVINCE')."'  AND hospitalprovince <>  '".$this->session->userdata('R36_HOSPITAL')."' ";
			}
			if($this->session->userdata('R36_HOSPITAL')){
						//$rechospital=$DB->FETCHARRAY($DB->QUERY("SELECT hospital_amphur_id,hospital_province_id FROM n_hospital WHERE hospital_code='".$this->session->userdata('R36_HOSPITAL')."'"));				
					
						//$wh="AND hospitalcode ='".$this->session->userdata('R36_HOSPITAL')."'";
						$wh="AND hospitalcode ='60080003'";
			}
			/*if($this->session->userdata('R36_LEVEL')=='00'){
						$wh="AND ((provinceid = '10'  AND hospitalprovince <>  '10') OR (typeforeign='3' AND nationalityname!='1')) ";
			}*/			
			$nextday=date ("Y-m-d", mktime (0,0,0,date('m')+1,date('d'),date('Y')));		
			$nextday=date ("Y-m-d", mktime (0,0,0,date('m')+1,date('d'),date('Y')));		
			$data['result']=$this->inform->select("hospitalcode,hn,hn_no,firstname,surname,in_out,means,total_vaccine ,id,historyid")
														   	       ->join("INNER JOIN n_history ON n_information.information_historyid = n_history.historyid
																		        INNER JOIN n_vaccine ON n_information.id = n_vaccine.information_id 
																		      ")		
														       ->where("closecase !='2' AND (means  IN (1,2)) AND n_vaccine.vaccine_date!='' $wh 
														       					AND n_information.total_vaccine!='5' AND date(vaccine_date) BETWEEN '2555-11-25' AND '2555-12-25' 
																		        GROUP BY n_information.id")->sort("")->order("vaccine_date asc")->get();
		if($preview)$this->template->set_layout('print');
		$this->template->build('report_schedule_demo',$data);
	}
	function analyze(){
		$this->template->build('report_analyze');
	}


	
}
?>