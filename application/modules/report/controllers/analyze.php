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
		$this->load->model('area/area_model','area');	
		$this->template->append_metadata(js_report());
	}
	public $reference= "แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข";
	function index($no=FALSE)
	{
		// $this->db->debug=TRUE;
		 $data['detail_main'] = (empty($_GET['detail_main'])) ? '':$_GET['detail_main'];
		 $data['detail_minor'] = (empty($_GET['detail_minor'])) ? '':$_GET['detail_minor'];		
		 $data['reference'] = $this->reference;
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
		  if(!empty($_GET['province'])){
		  	 	$col="hospitalprovince";	
		  	 	if($no=="6") $col="n_amphur.province_id";
			  	$cond .= " AND ".$col." = '".$_GET['province']."'";
				$data['province_id'] = $_GET['province'];
				
				$data['textprovince']=$this->province->get_one("province_name","province_id",$_GET['province']);	
		  }	
  		 if(!empty($_GET['amphur'])){
			  	$cond = " AND hospitalamphur='".$_GET['amphur']."' AND hospitalprovince='".$_GET['province']."'";		
				$data['textamphur']=$this->db->GetOne("select amphur_name from n_amphur where province_id= ? and amphur_id= ? ",array($_GET['province'],$_GET['amphur']));
		  }

		  if(!empty($_GET['district'])){
		  		$cond = " AND hospitalamphur='".$_GET['amphur']."' AND hospitalprovince='".$_GET['province']."' and hospitaldistrict='".$_GET['district']."'";
				$data['textdistrict']=$this->db->GetOne("select district_name from n_district where province_id= ? and amphur_id= ? and district_id= ? ",array($_GET['province'],$_GET['amphur'],$_GET['district']));
		  }		  
		  if(!empty($_GET['hospital'])){
		  		$cond = " AND hospitalcode='".$_GET['hospital']."'";
			  	$data['texthospital']=$this->hospital->get_one("hospital_name","hospital_code",$_GET['hospital']);
		  }
		 
		  if(!empty($_GET['area']))
		  {
		 		$data['textarea'] = $this->area->get_one("name","id",$_GET['area']);			  	  
			   	if(!empty($_GET['group'])&& empty($_GET['province'])){		  	   					 
				  $provinceid= "select DISTINCT province_id from n_area   inner join n_area_detail on n_area.id = n_area_detail.area_id
				
								where hospitalprovince = n_area_detail.province_id and area_id= ".$_GET['area'];  
				  $cond .= " AND hospitalprovince IN (".$provinceid.")";			  	   
			   	}
																
				if($_GET['group']=='0'){$data['textgroup'] = "กทม.";
				}else{$data['textgroup'] = $_GET['group'];}
		  }		  
		  if((!empty($_GET['month_start'])  && !empty($_GET['year_start']))   && (!empty($_GET['month_end']) && !empty($_GET['year_end']))){
		  	 	$cond.= " AND (month(datetouch) BETWEEN '".$_GET['month_start']."' AND '".$_GET['month_end']."') AND (year(datetouch) BETWEEN '".$_GET['year_start']."' AND '".$_GET['year_end']."')";
		 		$data['textyear_start'] = $_GET['year_start'];
				$data['textmonth_start'] = convert_month($_GET['month_start'],"longthai");
			 	$data['textyear_end'] = $_GET['year_end'];
				$data['textmonth_end'] = convert_month($_GET['month_end'],"longthai");
		  }else{
				if(!empty($_GET['year_start'])){	$cond.= " AND year(datetouch)='".$_GET['year_start']."'";	$data['textyear_start'] = $_GET['year_start'];}		  	
		  		if(!empty($_GET['month_start'])){	$cond.= " AND month(datetouch)='".$_GET['month_start']."'";  	$data['textmonth_start'] = convert_month($_GET['month_start'],"longthai");	}	
		  }
		    
		  if((!empty($_GET['month_report_start'])  && !empty($_GET['year_report_start']))   && (!empty($_GET['month_report_end']) && !empty($_GET['year_report_start']))){
		  	 	$cond.= " AND (month(datetouch) BETWEEN '".$_GET['month_report_start']."' AND '".$_GET['month_report_end']."') AND (year(datetouch) BETWEEN '".$_GET['year_report_start']."' AND '".$_GET['year_report_end']."')";
		 		$data['textyear_report_start'] = $_GET['year_report_start'];
				$data['textmonth_report_start'] = convert_month($_GET['month_report_start'],"longthai");
			 	$data['textyear_report_end'] = $_GET['year_report_end'];
				$data['textmonth_report_end'] = convert_month($_GET['month_report_end'],"longthai");				
		  }else{
		  		if(!empty($_GET['year_report_start'])){		$cond.= " AND year(reportdate)='".$_GET['year_report_start']."'";		$data['textyear_start'] = $_GET['year_report_start'];}  
		 	 	if(!empty($_GET['month_report_start'])){	$cond.= " AND month(reportdate)='".$_GET['month_report_start']."'";  $data['textmonth_start'] = convert_month($_GET['month_report_start'],"longthai");	}	
		  }  
		  			  
		   if(!empty($_GET['type'])){	$cond.= " AND in_out='".$type."'";	$data['texttype'] =$type[$_GET['type']];	}									
		   
		    $data['cond']=$cond;
		    $preview = (empty($_GET['p'])) ? '':'preview';
			switch($no){
				case "1":$this->report1($cond,$preview,$data);break;
				case "2":$this->report2($cond,$preview,$data);break;
				case "3":$this->report3($cond,$preview,$data);break;
				case "4":$this->report4($cond,$preview,$data);break;
				case "5":$this->report5($cond,$preview,$data);break;
				case "6":$this->report6($cond,$preview,$data);break;
				case "7":$this->report7($cond,$preview,$data);break;
				case "8":$this->report8($cond,$preview,$data);break;
				
			}			  							

	}
	function report1($cond= FALSE,$preview=FALSE,$data)
	{
		$data['detail_minor_name'] = array('','เพศ','อาชีพ','อาชีพผู้ปกครอง','สถานที่สัมผัส','ชนิดสัตว์นำโรค','อายุสัตว์','สถานภาพสัตว์','สาเหตุที่ถูกกัด','การล้างแผล','การใส่ยาฆ่าเชื้อ');
		$data['detail_minor_type'] = array('',"age_group","gender","occupationname","occparentsname","placetouch","typeanimal","ageanimal","statusanimal","causedetail","washbefore","putdrug");
		$data['detail_main_name'] = array("ต่ำกว่า 1 ปี","1-5 ปี","6-10 ปี","11-15 ปี","16-25 ปี","26-35 ปี","36-45 ปี","46-55 ปี","56-65ปี","65 ปีขึ้นไป","ไม่ระบุ");
		$data['detail_main_type'] = array("1","2","3","4","5","6","7","8","9","10","0");
		$num_main=count($data['detail_main_name']);
		if($data['detail_minor']==1){
			$data['minordetail']=array("ชาย","หญิง","ไม่ระบุ");			
			$data['minorvalue']=array('',"1","2","0");			
		}
		if($data['detail_minor']==2){
			$data['minordetail']=array("","นักเรียน นักศึกษา","ในปกครอง","เกษตร ทำนา ทำสวน","ข้าราชการ","กรรมกร","รับจ้าง (เช่น พนักงานบริษัท/ดารา/นักแสดง ฯลฯ)","ค้าขาย","งานบ้าน","ทหาร ตำรวจ","ประมง","ครู","เลี้ยงสัตว์ / จับสุนัข","นักบวช / ภิกษุสามเณร","ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ","สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์หรือผู้ช่วยผู้ที่ทำงานในห้องปฏิบัติการโรคพิษสุนัขบ้า","อาสาสมัครฉีดวัคซีนสุนัข","เจ้าหน้าที่สวนสัตว์","ไปรษณีย์","ป่าไม้","พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า","อื่นๆ (ระบุ)","ไม่ระบุ");
			$data['minorvalue']=array("","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","");
		}
		if($data['detail_minor']==3){
			$data['minordetail']=array("","เกษตร ทำนา ทำสวน","ข้าราชการ","กรรมกร","รับจ้าง (เช่น พนักงานบริษัท/ดารา/นักแสดง ฯลฯ)","ค้าขาย","งานบ้าน","ทหาร ตำรวจ","ประมง","ครู","เลี้ยงสัตว์ / จับสุนัข","นักบวช / ภิกษุสามเณร","ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ","สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์หรือผู้ช่วยผู้ที่ทำงานในห้องปฏิบัติการโรคพิษสุนัขบ้า","อาสาสมัครฉีดวัคซีนสุนัข","เจ้าหน้าที่สวนสัตว์","ไปรษณีย์","ป่าไม้","พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า","อื่นๆ (ระบุ)","ไม่ระบุุ/เกิน 15 ปี");
			$data['minorvalue']=array("","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","0");
		}
		if($data['detail_minor']==4){
			$data['minordetail_head']=array("","เขต กทม.","เขตเมืองพัทยา","เขตเทศบาล","เขตอบต.","ไม่ระบุ");
			$data['minorvalue_head']=array("","1","1","4","3.","1");
			$data['minordetail']=array("","","","นคร","เมือง","ตำบล","ไม่ระบุ","ในชุมชน/ตลาด","ชนบท","ไม่ระบุ");
			$data['minorvalue']=array("","1","2","301","302","303","3099","404","405","4099","0");
			$data['minorvalue_sub']=array("detailplacetouch");
		}
		
		if($data['detail_minor']==5){
			$data['minordetail']=array("","สุนัข","แมว","ลิง","ชะนี","หนู","คน","วัว","กระบือ","สุกร","แพะ","แกะ","ม้า","กระรอก","กระแต","พังพอน","กระต่าย","สัตว์ป่า","ไม่ทราบ","ไม่ระบุ");
			$data['minorvalue']=array("","1","2","3","4","5","601","602","603","604","605","606","607","608","609","6010","6011","6012","6013","");
			$data['minorvalue_sub']=array("typeother");
		}
		if($data['detail_minor']==6){
			$data['minordetail']=array("","น้อยกว่า 3 เดือน ","3 - 6 เดือน ","6 - 12 เดือน ","มากกว่า 1 ปี ","ไม่ทราบ","ไม่ระบุ");
			$data['minorvalue']=array("","1","2","3","4","5","0");
		}
		if($data['detail_minor']==7){
			$data['minordetail']=array("","มีเจ้าของ","ไม่มีเจ้าของ","ไม่ทราบ","ไม่ระบุ");
			$data['minorvalue']=array("","1","2","3","0");
		}
		if($data['detail_minor']==8){
			$data['minordetail']=array("","ทำให้สัตว์เจ็บปวด โมโหหรือตกใจ ","พยายามแยกสัตว์ที่กำลังต่อสู้กัน","เข้าใกล้สัตว์แม่ลูกอ่อน","รบกวนสัตว์ขณะกินอาหาร","เข้าไปในบริเวณที่สัตว์คิดว่าเป็นเจ้าของ","อื่นๆ","ไม่ระบุ");
			$data['minorvalue']=array("","1","2","3","4","5","6","0");
		}
		if($data['detail_minor']==9){
			$data['minordetail_head']=array("","ไม่ได้ล้าง","ล้าง","ไม่ระบุ");
			$data['minorvalue_head']=array("","1","4","1");
			$data['minordetail']=array("","","น้ำ","น้ำและสบู่/<br>ผงซักฟอก","อื่นๆ","ไม่ระบุ","");
			$data['minorvalue']=array("","1","201","202","203","2099","");
			$data['minorvalue_sub']=array("washbeforedetail","1","2","3","0");
		}
		if($data['detail_minor']==10){
			$data['minordetail_head'] = array("","ไม่ได้ใส่ยา","ใส่ยา","ไม่ระบุ");
			$data['minorvalue_head'] = array("","1","4","1");
			$data['minordetail'] = array("","","สารละลาย<br>ไอโอดีน<br>ที่ไม่มีแอลกอฮอล์","ทิงเจอร์ไอโอดีน <br>/ แอลกอฮอล์","อื่นๆ","ไม่ระบุ","");
			$data['minorvalue'] = array("","1","201","202","203","2099","");
			$data['minorvalue_sub']=array("putdrugdetail","1","2","3");
		}
		if($cond){										
			$sql = "select year(datetouch) as y,count(historyid) as cnt,age_group,gender from n_history inner join n_information on historyid=information_historyid
					where 1=1 ".$cond." group by year(datetouch),age_group ,gender asc";
			$result = $this->db->Execute($sql);	
			if($result){
				foreach($result as $item){
					$rs['main'][$item['age_group']][$item['gender']]=$item['cnt'];
				}
			}
			
			$main =count($data['detail_main_name']);
			$minor = count($data['minordetail']);
			for($i=0;$i<$main;$i++){
				$data['main'.$i]=0;
				for($j=0;$j<$minor;$j++){
					$data['main'.$i.$j] = (empty($rs['main'][$i][$j])) ? 0 : $rs['main'][$i][$j];
					$data['main'.$i] = $data['main'.$i] + $data['main'.$i.$j];
				}
				
			}
			$data['main'] = $main;
			$data['minor'] = $minor;
		}			
		if($preview)$this->template->set_layout('print');		
		$this->template->build('analyze/report1_index',$data);
	}
}
?>