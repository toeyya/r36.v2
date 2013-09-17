<?php
class Export extends R36_Controller
{// พี่จิ๊บบอกว่า เขาใช้ zip file
	
	function __construct()
	{
		parent::__construct();		
		$this->load->model('hospital/hospital_model','hospital');
		$this->load->model('province/province_model','province');
		$this->load->model('inform/inform_model','inform');
		$this->load->model('inform/vaccine_model','vaccine');
	
		
	}
	function index($module){
		$data['wh_province'] = "";
		$wh_province='';$wh_amphur='';$wh_district='';$wh_hospital='';		
		if($this->session->userdata('R36_HOSPITAL_PROVINCE')){
			$wh_province = $this->session->userdata('R36_HOSPITAL_PROVINCE');
			$data['wh_province'] = " where province_id ='".$wh_province."'";
		}
		$data['wh_amphur'] = "";
		if($this->session->userdata('R36_HOSPITAL_AMPHUR')){				
			$wh_amphur = $this->session->userdata('R36_HOSPITAL_AMPHUR');
			$data['wh_amphur'] = " where province_id ='".$wh_province."' and amphur_id ='".$wh_amphur."'";
		}	
		$data['wh_district'] = "";
		if($this->session->userdata('R36_HOSPITAL_DISTRICT')){
				
			$wh_district = $this->session->userdata('R36_HOSPITAL_DISTRICT');
			$data['wh_district'] = " where province_id ='".$wh_province."' and amphur_id ='".$wh_amphur."' and district_id ='".$wh_district."'";
		}
		$data['wh_hospital'] ="";
		if($this->session->userdata('R36_HOSPITAL')){
			$wh_hospital = $this->session->userdata('R36_HOSPITAL');
			$data['wh_hospital'] = " where hospital_code ='".$wh_hospital."'";
		}	
		$data['fileType'] = (!empty($_GET['fileType'])) ? $_GET['fileType']:'';
		if($module=="province"){
			$this->province($data);
		}else if($module=="amphur"){
			$this->amphur($data);			
		}else if($module=="district"){
			$this->district($data);
		}else if($module=="information"){
			$this->information($data);
		}				
	}
	function province($data)
	{// ต้องเลือกหมด เพราะใช้ในการเลือกที่อยู่
		if(!empty($data['fileType']))
		{													
			$fileName = "uploads/export/n_province".date('YmdHis').".".$data['fileType'];								
			$result = $this->province->sort('')->order('province_id asc')->limit(100)->get();	
			foreach($result as $item)
			{
				$text[]=$item['province_id'].",".$item['province_name'].",".$item['region_id'].",".$item['province_short_name'].",".$item['provincerelated'];
			}
			$output = implode( "\n" , $text );			
		      header("Pragma: public");
		      header("Expires: 0");
		      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		      header("Cache-Control: private",false);
		      header("Content-Transfer-Encoding: binary;\n");
		      header("Content-Disposition: attachment; filename=\"filename.txt\";\n");
		      header("Content-Type: application/force-download");
		      header("Content-Type: application/octet-stream");
		      header("Content-Type: application/download");
		      header("Content-Description: File Transfer");
		      header("Content-Length: ".strlen($output).";\n");
		      echo $output;
      		  die;       												
		}else{
			$this->template->build('export/export_province');
		}

	
	}
	function amphur()
	{
		$this->template->build('export/export_amphur');
	}
	function district()
	{
		$this->template->build('export/export_district');
	}
	function information()
	{
		$this->template->build('export/export_information');
		
	}
  function test(){
  	$strFileName = "thaicreate.txt";
	$objFopen = fopen($strFileName, 'w');
	$strText1 = "I Love ThaiCreate.Com Line1\r\n";
	fwrite($objFopen, $strText1);
	$strText2 = "I Love ThaiCreate.Com Line2\r\n";
	fwrite($objFopen, $strText2);
	$strText3 = "I Love ThaiCreate.Com Line3\r\n";
	fwrite($objFopen, $strText3);
	
	if($objFopen)
	{
		echo "File writed.";
	}
	else
	{
		echo "File can not write";
	}
	
	fclose($objFopen);
	//downloadFile($strFileName);
  }
	
}
?>