<?php
		### ###################################################			
		###	 user file  "ajaxreport.js"													    			###
		###	 report1  --> สรุปข้อมูล r36															    ###
		###  report4   --->สรุปประวัติคนไข้ในเขตอำเภอและคนไข้นอกเขตอำเภอ   ###	
class Report extends R36_Controller
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
				$data['textdistrict']=$this->db->GetOne("select district_name from n_district where province_id= ? and amphur_id= ? and district_id= ? ",array($_GET['province'],$_GET['amphur'],$_GET['district']));
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
			switch($no){
				case "1":$this->report1($cond,$preview,$data);break;
				case "2":$this->report2($cond,$preview,$data);break;
				case "3":$this->report3($cond,$preview,$data);break;
				case "4":$this->report4($cond,$preview,$data);break;
				case "5":$this->report5($cond,$preview,$data);break;
				case "6":$this->report6($cond,$preview,$data);break;
				case "8":$this->report8($cond,$preview,$data);break;
			}
			//if($preview) $this->template->set_layout('print');				
			//$this->template->build("report".$no."_index",$data);				  	

						
	}
	function report1($cond= FALSE,$preview=FALSE,$data){
		if($preview)$this->template->set_layout('print');	
		$this->template->build("report1_index",$data);		
	}
	function report2($cond= FALSE,$preview=FALSE,$data){
		if($preview)$this->template->set_layout('print');	
		$this->template->build("report2_index",$data);			
	}
	function report3($cond= FALSE,$preview=FALSE,$data){
		if($preview)$this->template->set_layout('print');	
		$this->template->build("report3_index",$data);			
	}
	function report4($cond= FALSE,$preview=FALSE,$data){
		if($preview)$this->template->set_layout('print');	
		$this->template->build("report4_index",$data);		
	}
	function report5($cond= FALSE,$preview=FALSE,$data){
		$this->db->debug=True;
		$data['result_1']= $this->inform->select("count(total_vaccine) as cnt,total_vaccine")->join("LEFT JOIN n_vaccine ON n_information.id=information_id")
												->where("historyprotect=2 and total_vaccine<>0 ".$cond)->groupby("total_vaccine")->sort("")->order("total_vaccine asc")->get();
		if($preview)$this->template->set_layout('print');	
		$this->template->build("report5_index",$data);			
	}
	function report6($cond= FALSE,$preview=FALSE,$data){
		if($preview)$this->template->set_layout('print');	
		$this->template->build("report6_index",$data);			
	}
	function dead($part=FALSE,$preview=FALSE){
		$data['part']=$part;
		if($preview) $this->template->set_layout('print');
		$this->template->build('report7_index',$data);
	}			
	function report8($cond= FALSE,$preview=FALSE){
			//echo $cond;
			//if($preview) $this->template->set_layout('print');				
			$this->template->build("report8_index");			
	}
	function schedule($preview=FALSE)
	{ ## ต้องมาแก้ ให้  n_vaccine.hospital_id=n_hospital_1.hospital_id ##
		//$this->db->debug=true;
		$today=DBdate(date('Y-m-d'));
		$nextday=DBdate(date("Y-m-d",strtotime("+3 days",strtotime(date ("Y-m-d")))));			
		//$hospital_name =$this->hospital->get_one('hospital_name','hospital_code',$this->session->userdata('R36_HOSPITAL'));	
		$data['hospital'] = $this->db->GetRow("SELECT province_name,amphur_name,district_name,hospital_name FROM n_hospital_1
																   LEFT JOIN n_province on hospital_province_id=n_province.province_id
																   LEFT JOIN n_amphur on  hospital_amphur_id =n_amphur.amphur_id and n_amphur.province_id=n_province.province_id
																   LEFT JOIN n_district on hospital_district_id = n_district.district_id and  n_district.amphur_id =n_amphur.amphur_id and n_district.province_id=n_province.province_id
																   WHERE hospital_code = ? ",$this->session->userdata('R36_HOSPITAL'));
		$sql="SELECT hn,hn_no,firstname,surname,in_out,means,total_vaccine ,id,historyid,vaccine_date,datetouch,idcard
					FROM n_information
					INNER JOIN n_history   ON n_information.information_historyid = n_history.historyid
					INNER JOIN n_vaccine  ON n_information.id = n_vaccine.information_id		
					WHERE closecase ='1' AND means <> '' AND (vaccine_date BETWEEN '$today' AND '$nextday' AND vaccine_name=0)  
								and (hospitalcode='".$this->session->userdata('R36_HOSPITAL')."' OR byplace='".$data['hospital']['hospital_name']."')
					ORDER BY  vaccine_date asc";	
 		$data['result']=$this->inform->get($sql);
		$data['pagination'] = $this->inform->pagination();
		if($preview)$this->template->set_layout('print');
		$this->template->build('report_schedule',$data);
	}

	function analyze()
	{
		$this->template->build('report_analyze');
	}


	
}
?>