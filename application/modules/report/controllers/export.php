<?php
class Export extends R36_Controller
{// พี่จิ๊บบอกว่า เขาใช้ zip file
	
	function __construct()
	{
		parent::__construct();		
		$this->load->model('hospital/hospital_model','hospital');
		$this->load->model('province/province_model','province');
		$this->load->model('amphur/amphur_model','amphur');
		$this->load->model('district/district_model','district');
		$this->load->model('inform/inform_model','inform');
		$this->load->model('inform/vaccine_model','vaccine');
		$this->load->helper('download');
		
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
		DeleteFile();
		$fileName = "uploads/export/n_province".date('YmdHis').".".$data['fileType'];					
		if(!empty($data['fileType']))
		{	$objWrite = fopen($fileName, "w");				
			$result = $this->province->sort('')->order('province_id asc')->limit(100)->get();												
			foreach($result as $item)
			{
				fwrite($objWrite, "\"$item[province_id]\",\"$item[province_name]\",\"$item[region_id]\",\"$item[province_short_name]\",\"$item[provincerelated]\"\r\n");
			}
			fclose($objWrite);
			if($objWrite){
 					
 				$data = file_get_contents("uploads/export/".basename($fileName));
				$name = basename($fileName);
				force_download($name, $data);        
			}						
		}else{
			$this->template->build('export/export_province');
		}

	
	}
	function amphur($data)
	{
		DeleteFile();
		$fileName = "uploads/export/n_amphur".date('YmdHis').".".$data['fileType'];					
		if(!empty($data['fileType']))
		{	$objWrite = fopen($fileName, "w");	
			$result = $this->amphur->sort("")->order("amp_pro_id asc ")->limit(1000)->get();											
			foreach($result as $item)
			{
				fwrite($objWrite, "\"$item[amp_pro_id]\",\"$item[province_id]\",\"$item[amphur_id]\",\"$item[amphur_name]\",\"$item[timestamp]\"\r\n");
			}
			fclose($objWrite);
			if($objWrite){
 					
 				$data = file_get_contents("uploads/export/".basename($fileName));
				$name = basename($fileName);
				force_download($name, $data);        
			}						
		}else{
			$this->template->build('export/export_amphur');
	
	}
	}
	function district($data)
	{
		DeleteFile();
		$fileName = "uploads/export/n_district".date('YmdHis').".".$data['fileType'];					
		if(!empty($data['fileType']))
		{	$objWrite = fopen($fileName, "w");	
			$result = $this->district->sort("")->order("tam_amp_id asc ")->limit(10000)->get();											
			foreach($result as $item)
			{
				fwrite($objWrite, "\"$item[tam_amp_id]\",\"$item[province_id]\",\"$item[amphur_id]\",\"$item[district_id]\",\"$item[district_name]\",\"$item[timestamp]\"\r\n");
			}
			fclose($objWrite);
			if($objWrite){
 					
 				$data = file_get_contents("uploads/export/".basename($fileName));
				$name = basename($fileName);
				force_download($name, $data);        
			}						
		}else{
		$this->template->build('export/export_district');
		}
	}
	
	function hospital()
	{
		$this->template->build('export/export_hospital');
		
	}
	function information()
	{
		if(!empty($_POST['fileType']))
		{								
			DeleteFile();
			$fileName = "uploads/export/n_information".date('YmdHis').".".$data['fileType'];					
	
			if($data['fileType']=="txt")
			{	$objWrite = fopen($fileName, "w");															
				foreach($result as $item)
				{
					fwrite($objWrite, "\"$item[tam_amp_id]\",\"$item[province_id]\",\"$item[amphur_id]\",\"$item[district_id]\",\"$item[district_name]\",\"$item[timestamp]\"\r\n");
				}
				fclose($objWrite);
				if($objWrite){
	 					
	 				$data = file_get_contents("uploads/export/".basename($fileName));
					$name = basename($fileName);
					force_download($name, $data);        
				}						
			}else if($data['fileType']=="excel"){
			$result = $this->information->select("n_information.*,n_history.*,n_vaccine.*")->join("INNER JOIN n_history ON information_historyid = historyid
												LEFT  JOIN n_vaccine ON n_information.id = information_id")
						   ->sort("")->order("id asc ")->limit(10000)->get();					
				foreach($result as $item){
					$tb ='<table width="100%" border="1">';
					$tb.='<tr>';
					$columns = $this->db->MetaColumnNames('n_information');
					$columns = array_change_key_case($columns,CASE_LOWER);
					foreach($columns as $key=> $item){
						$tb.='<th>'.$key.'</th>';
					}
					$columns = $this->db->MetaColumnNames('n_history');
					$columns = array_change_key_case($columns,CASE_LOWER);					
					foreach($columns as $key=> $item){
						$tb.='<th>'.$key.'</th>';
					}
					$columns = $this->db->MetaColumnNames('n_vaccine');
					$columns = array_change_key_case($columns,CASE_LOWER);					
					foreach($columns as $key=> $item){
						$tb.='<th>'.$key.'</th>';
					}					
					$tb.='</tr>';
					$tb.='</table>';
					echo $tb;
				}				
			}
		}
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