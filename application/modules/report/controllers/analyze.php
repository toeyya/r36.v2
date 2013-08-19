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
		 $data['textarea'] =(!empty($_GET['area'])) ? $this->area->get_one("name","id",$_GET['area']) :"ทั้งหมด";		
		 $data['textprovince'] = (!empty($_GET['province'])) ? $this->province->get_one("province_name","province_id",$_GET['province']) : 'ทั้งหมด';	
		 if(!empty($_GET['amphur'])){
		 	 $textamphur = $this->db->GetOne("select amphur_name from n_amphur where province_id= ? and amphur_id= ? ",array($_GET['province'],$_GET['amphur']));
			  $data['textamphur'] = ThaiToUtf8($textamphur);
		 }else{
		 	$data['textamphur'] = "ทั้งหมด";
		 }		
		 
		 if(!empty($_GET['district'])){
		 	 $textdistrict =  $this->db->GetOne("select district_name from n_district where province_id= ? and amphur_id= ? and district_id= ? ",array($_GET['province'],$_GET['amphur'],$_GET['district']));
			 $data['textdistrict'] = ThaiToUtf8($textdistrict);	
		 }else{
		 	$data['textdistrict']  = "ทั้งหมด";
		 }			 
		 $data['texthospital'] = "ทั้งหมด";
		 $data['textyear_start']="ทั้งหมด";
		 $data['textmonth_start']="ทั้งหมด";
		  $data['textmonth_end']="ทั้งหมด";
		 $data['texttype']="ทั้งหมด";
		 if(!empty($_GET['group'])){		 	
		 	$data['textgroup'] = $_GET['group'];			 	
		 }else{
		 	if(@$_GET['group']=="0"){
		 		$data['textgroup'] = "กทม.";
		 	}else{
		 		$data['textgroup'] = "ทั้งหมด";
		 	}		 	
		 } 		 
		 $type=array(1=>'จำแนกตามคนไข้ปัจจุบัน',2=>'จำแนกตามคนไข้ขาจร');	
		 $cond ="";
		if(!empty($_GET['hospital'])){
		  		$cond .= " 1=1  AND hospitalcode='".$_GET['hospital']."'";
			  	$data['texthospital']=$this->hospital->get_one("hospital_name","hospital_code",$_GET['hospital']);
		  }else{			  				  		 
			  if(!empty($_GET['province'])){
			  	 	$col="hospitalprovince";	
			  	 	if($no=="6") $col="n_amphur.province_id";
				  	$cond .=" 1=1 AND ".$col." = '".$_GET['province']."'";
					$data['province_id'] = $_GET['province'];
					$data['textprovince']=$this->province->get_one("province_name","province_id",$_GET['province']);
					
			  }else{
				  if(!empty($_GET['area']) && !empty($_GET['group'])){
				  	$provinceid= "select DISTINCT province_id from n_area_detail  where area_id= ".$_GET['area']." and level =".$_GET['group'];
				  	$provinceid = $this->province->get($provinceid);
					foreach($provinceid as $item){
						$p_id[] = $item['province_id'];
					}
					$pid =implode(',',$p_id);					
				  	$cond .= " 1=1 AND hospitalprovince IN (".$pid.")";			  	   
 	  
				  }else if(!empty($_GET['area'])){
				  		$cond="1=1";		  	   					 
				 			  
				  }	  	
			  }	
	  		 if(!empty($_GET['amphur'])){
				  	$cond = " 1=1 AND hospitalamphur='".$_GET['amphur']."' AND hospitalprovince='".$_GET['province']."'";		
					
			  }
			  if(!empty($_GET['district'])){
			  		$cond = " 1=1 AND hospitalamphur='".$_GET['amphur']."' AND hospitalprovince='".$_GET['province']."' and hospitaldistrict='".$_GET['district']."'";
					
			  }		  
		  }
		$data['select_date_type']="";
		$data['date_type'] ="";
		if(!empty($_GET['year_start'])){
				    $cond.= " AND year(datetouch) ='".$_GET['year_start']."'";	
				    $data['textyear_start'] = $_GET['year_start'];
					$data['date_type'] ="year(datetouch),";
					$data['select_date_type']="year(datetouch) as y,";
		
		}		  			  				  		    
		if(!empty($_GET['year_report_start'])){
				$cond.= " AND year(reportdate)='".$_GET['year_report_start']."'";
				$data['textyear_start'] = $_GET['year_report_start'];
				$data['date_type'] ="year(reportdate),";
				$data['select_date_type']="year(reportdate) as y,";
		}  
		 	if($cond!=""){$cond1=$cond." and ";}else{$cond1="";}				  	  			  		   											   
		    $data['cond']=$cond;
		    $preview = (empty($_GET['p'])) ? '':'preview';
			$excel = (empty($_GET['excel'])) ? '':'excel';
			switch($no)
			{
				case "1":$this->report1($cond,$preview,$data,$excel);break;
				case "2":$this->report2($cond,$preview,$data,$excel);break;
				case "3":$this->report3($cond,$preview,$data,$excel);break;
				case "4":$this->report4($cond,$preview,$data,$excel);break;
				case "5":$this->report5($cond,$preview,$data,$excel);break;
				case "6":$this->report6($cond,$preview,$data,$excel);break;
				case "7":$this->report7($cond,$preview,$data,$excel);break;
				case "8":$this->report8($cond,$preview,$data,$excel);break;
				case "9":$this->report9($cond,$preview,$data,$excel);break;
			}			  							

	}

	function report1($cond= FALSE,$preview=FALSE,$data,$excel=FALSE)
	{
		//$this->db->debug=true;	
		$data['head'] = "อายุผู้สัมผัส";
		$data['detail_minor_name'] = array('','เพศ','อาชีพ','อาชีพผู้ปกครอง','สถานที่สัมผัส','ชนิดสัตว์นำโรค','อายุสัตว์','สถานภาพสัตว์','สาเหตุที่ถูกกัด','การล้างแผล','การใส่ยาฆ่าเชื้อ');
		$data['detail_minor_type'] = array('',"age_group","gender","occupationname","occparentsname","placetouch","typeanimal","ageanimal","statusanimal","causedetail","washbefore","putdrug");
		$data['detail_main_name'] = array('ไม่ระบุ',"ต่ำกว่า 1 ปี","1-5 ปี","6-10 ปี","11-15 ปี","16-25 ปี","26-35 ปี","36-45 ปี","46-55 ปี","56-65ปี","65 ปีขึ้นไป");
		$data['detail_main_type'] = array("1","2","3","4","5","6","7","8","9","10","0");
		
		$field_minor = $data['detail_minor']+1;
		$num_main=count($data['detail_main_name']);
		$minorvalue_sub[0]="";
		
		if($data['detail_minor']==1){
			$data['minordetail']=array("ชาย","หญิง","ไม่ระบุ");			
			$data['minorvalue']=array("1","2","0");			
		}
		if($data['detail_minor']==2){
			$data['minordetail']=array("นักเรียน นักศึกษา","ในปกครอง","เกษตร ทำนา ทำสวน","ข้าราชการ","กรรมกร","รับจ้าง (เช่น พนักงานบริษัท/ดารา/นักแสดง ฯลฯ)","ค้าขาย","งานบ้าน","ทหาร ตำรวจ","ประมง","ครู","เลี้ยงสัตว์ / จับสุนัข","นักบวช / ภิกษุสามเณร","ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ","สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์หรือผู้ช่วยผู้ที่ทำงานในห้องปฏิบัติการโรคพิษสุนัขบ้า","อาสาสมัครฉีดวัคซีนสุนัข","เจ้าหน้าที่สวนสัตว์","ไปรษณีย์","ป่าไม้","พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า","อื่นๆ (ระบุ)","ไม่ระบุ");
			$data['minorvalue']=array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","0");
		}
		if($data['detail_minor']==3){
			$data['minordetail']=array("เกษตร ทำนา ทำสวน","ข้าราชการ","กรรมกร","รับจ้าง (เช่น พนักงานบริษัท/ดารา/นักแสดง ฯลฯ)","ค้าขาย","งานบ้าน","ทหาร ตำรวจ","ประมง","ครู","เลี้ยงสัตว์ / จับสุนัข","นักบวช / ภิกษุสามเณร","ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ","สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์หรือผู้ช่วยผู้ที่ทำงานในห้องปฏิบัติการโรคพิษสุนัขบ้า","อาสาสมัครฉีดวัคซีนสุนัข","เจ้าหน้าที่สวนสัตว์","ไปรษณีย์","ป่าไม้","พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า","อื่นๆ (ระบุ)","ไม่ระบุุ/เกิน 15 ปี");
			$data['minorvalue']=array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","0");
		}
		if($data['detail_minor']==4){
			$data['minordetail_head']=array("เขต กทม.","เขตเมืองพัทยา","เขตเทศบาล","เขตอบต.","ไม่ระบุ");
			$data['minorvalue_head']=array("1","1","4","3.","1");
			$data['minordetail']=array("","","นคร","เมือง","ตำบล","ไม่ระบุ","ในชุมชน/ตลาด","ชนบท","ไม่ระบุ",'');
			$data['minorvalue']=array("10","20","31","32","33","30","44","45","40","00");
			$data['m_value'] = array("1","2","3","4","5","6","7","8","9","10","11","12","13","0");
			$minorvalue_sub =array(",detailplacetouch");
		}
		
		if($data['detail_minor']==5){
			$data['minordetail']=array("สุนัข","แมว","ลิง","ชะนี","หนู","คน","วัว","กระบือ","สุกร","แพะ","แกะ","ม้า","กระรอก","กระแต","พังพอน","กระต่าย","สัตว์ป่า","ไม่ทราบ","ไม่ระบุ");
			$data['minorvalue']=array("10","20","30","40","50",'61','62','63','64','65','66','67','68','69','610','611','612','613','60');
			$minorvalue_sub=array(",typeother");
			$data['m_value'] = array("1","2","3","4","5","6","7","8","9","10","11","12","13","0");
			
		}
		if($data['detail_minor']==6){
			$data['minordetail']=array("น้อยกว่า 3 เดือน ","3 - 6 เดือน ","6 - 12 เดือน ","มากกว่า 1 ปี ","ไม่ทราบ","ไม่ระบุ");
			$data['minorvalue']=array("1","2","3","4","5","0");
		}
		if($data['detail_minor']==7){
			$data['minordetail']=array("มีเจ้าของ","ไม่มีเจ้าของ","ไม่ทราบ","ไม่ระบุ");
			$data['minorvalue']=array("1","2","3","0");
		}
		if($data['detail_minor']==8){
			$data['minordetail']=array("ทำให้สัตว์เจ็บปวด โมโหหรือตกใจ ","พยายามแยกสัตว์ที่กำลังต่อสู้กัน","เข้าใกล้สัตว์แม่ลูกอ่อน","รบกวนสัตว์ขณะกินอาหาร","เข้าไปในบริเวณที่สัตว์คิดว่าเป็นเจ้าของ","อื่นๆ",'ไม่ระบุ');
			$data['minorvalue']=array("1","2","3","4","5","6","0");
		}
		if($data['detail_minor']==9){
			$data['minordetail_head']=array("ไม่ได้ล้าง","ล้าง","ไม่ระบุ");
			$data['minorvalue_head']=array("1","4","1");
			$data['minordetail']=array("","น้ำ","น้ำและสบู่/<br>ผงซักฟอก","อื่นๆ","ไม่ระบุ","");
			$data['minorvalue']=array("10","21","22","23","20","00");
			$minorvalue_sub=array(",washbeforedetail");
			$data['m_value'] = array("1","2","3","0");
		}
		if($data['detail_minor']==10){
			$data['minordetail_head'] = array("ไม่ได้ใส่ยา","ใส่ยา","ไม่ระบุ");
			$data['minorvalue_head'] = array("1","4","1");
			$data['minordetail'] = array("","สารละลาย<br>ไอโอดีน<br>ที่ไม่มีแอลกอฮอล์","ทิงเจอร์ไอโอดีน <br>/ แอลกอฮอล์","อื่นๆ","ไม่ระบุ","");
			$data['minorvalue'] = array("10","21","22","23","20","00");
			$minorvalue_sub =array(",putdrugdetail");
			$data['m_value'] = array("1","2","3","0");
		}
		if($cond){
											
			$sql = "SELECT ".$data['select_date_type']." count(historyid) as cnt,".$data['detail_minor_type'][$field_minor]."
					,".$data['detail_minor_type'][$data['detail_main']].$minorvalue_sub[0]."
					FROM n_history inner join n_information on historyid=information_historyid
					WHERE ".$cond." 
					group by ".$data['date_type'].$data['detail_minor_type'][$data['detail_main']].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]."  
					ORDER BY ".$data['detail_minor_type'][$data['detail_main']].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]." ASC";
			
			$result = $this->db->Execute($sql);	
			
			$rs=array();				
			if($result){						
				if($minorvalue_sub[0]!=""){					
					$minorvalue_sub[0]	=substr($minorvalue_sub[0],1);
					foreach($result as $item){
						$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$data['detail_minor_type'][$field_minor]]][$item[$minorvalue_sub[0]]]=$item['cnt'];						
					}						
				}else{									
					foreach($result as $item){
						$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$data['detail_minor_type'][$field_minor]]]=$item['cnt'];
					}
				}
			}	
																			
			$main =count($data['detail_main_name']);
			$minor = count($data['minordetail']);
			$minor_sub =(empty($data['m_value'])) ? "":count($data['m_value']);
			
			if($minor_sub==""){
				for($i=0;$i<$main;$i++){
					$data['total_main'.$i]=0;
					for($j=0;$j<$minor;$j++){											
						$data['main'.$i.$j] = (empty($rs['main'][$i][$j])) ? 0 : $rs['main'][$i][$j];
						$data['total_main'.$i] = $data['total_main'.$i] + $data['main'.$i.$j];										
					}
														
				}				
			}else{				
				for($i=0;$i<$main;$i++){
					$data['total_main'.$i]=0;
					for($j=0;$j<$minor;$j++){
						for($k=0;$k<$minor_sub;$k++){																		
							$data['main'.$i.$j.$k] = (empty($rs['main'][$i][$j][$k])) ? 0 : $rs['main'][$i][$j][$k];
							$data['total_main'.$i] = $data['total_main'.$i] + $data['main'.$i.$j.$k];
						}										
					}				
			
				}
								
			}
				
			$data['main'] = $main;
			$data['minor']= $minor;
			$data['cond'] = $cond;
 		}			
		if($preview){
			$this->template->set_layout('print');
			$this->template->build('analyze/report1_index',$data);
		}else if($excel){				
			$filename ="report1_".$data['detail_minor'].'_'.date('YmdHis').".xls";			;						
			$this->template->set_layout('print');
			$this->load->view('analyze/report1_export',$data);	
			downloadFile($filename);						
		}else{
			$this->template->build('analyze/report1_index',$data);
		}
		
		
	}
	function report2($cond= FALSE,$preview=FALSE,$data,$excel=FALSE)
	{
		
		$data['detail_main'] = $data['detail_main']-1; // ตอนแรกใช้เพื่อ เลือกฟังก็ชั่่ น การคำนวน  ,เอามาลบเพราะ ต้องใช้เลือกฟิลด์มาคิวรี	
		$data['head'] = "สถานที่สัมผัส";	
		$data['detail_minor_name']=array("",'ชนิดสัตว์นำโรค','สถานภาพสัตว์','ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์','การส่งหัวสัตว์ตรวจ');
		$data['detail_minor_type']=array('',"placetouch","typeanimal","statusanimal","historyvacine","headanimal");
		
		$data['detail_main_type']=array("10","20","31","32","33","30","44","45","40","00");
		$data['detail_main_name_head']=array("เขต กทม.","เขตเมืองพัทยา","เขตเทศบาล","","","","เขตอบต.","","","ไม่ระบุ");
		$data['detail_main_name']=array("","","นคร","เมือง","ตำบล","ไม่ระบุ","ในชุมชน/ตลาด","ชนบท","ไม่ระบุ","");
		$data['main_value'] = array("0","0","1","2","3","0","4","5","0","0");
		$mainvalue_sub=array(",detailplacetouch");
				
		$field_minor = $data['detail_minor']+1;
		$num_main=count($data['detail_main_name']);
		$minorvalue_sub[0] ="";
		
		if($data['detail_minor']==1){
			$data['minordetail']=array("สุนัข","แมว","ลิง","ชะนี","หนู","คน","วัว","กระบือ","สุกร","แพะ","แกะ","ม้า","กระรอก","กระแต","พังพอน","กระต่าย","สัตว์ป่า","ไม่ทราบ","ไม่ระบุ");
			$data['minorvalue']=array("10","20","30","40","50",'61','62','63','64','65','66','67','68','69','610','611','612','613','60');
			$minorvalue_sub=array(",typeother");
			$data['m_value'] = array("1","2","3","4","5","6","7","8","9","10","11","12","13","0");
		}
		if($data['detail_minor']==2){
			$data['minordetail']=array("มีเจ้าของ","ไม่มีเจ้าของ","ไม่ทราบ","ไม่ระบุ");
			$data['minorvalue']=array("1","2","3","0");
			
		}
		if($data['detail_minor']==3){
			$data['minordetail_head'] = array("ไม่ทราบ","ไม่เคยฉีด","เคยฉีด 1 ครั้ง","เคยฉีดเกิน 1 ครั้ง","ไม่ระบุ");
			$data['minorvalue_head'] = array("1","1","1","3","1");
		
			$data['minordetail']=array("","",""," ภายใน 1 ปี ","เกิน 1 ปี","ไม่ระบุ","");
			$data['minorvalue']=array("10","20","30","41","42","40","00");
			$data['m_value'] = array("1","2","0");
			$minorvalue_sub=array(",historyvacine_within");
		}
		if($data['detail_minor']==4){
			$data['minordetail_head']=array("ไม่ได้ส่งตรวจ","ส่งตรวจ","ไม่ระบุ");
			$data['minorvalue_head']=array("1","3","1");
			
			$data['minordetail']=array("", "พบเชื้อ","ไม่พบเชื้อ", "ไม่ระบุ", "");
			$data['minorvalue']=array("10","21","22","20","00");
			$data['m_value'] = array("1","2","0");
			$minorvalue_sub=array(",batteria");
		}
		if($cond)
		{											
			$sql = "SELECT ".$data['select_date_type']." count(historyid) as cnt,".$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0]."
					,".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]."
					FROM n_history inner join n_information on historyid=information_historyid
					WHERE  ".$cond." 
					group by ".$data['date_type'].$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]."  
					ORDER BY ".$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]." ASC";
			//echo $sql;
			$result = $this->db->Execute($sql);	
			
			$rs=array();				
			$mainvalue_sub[0]   =substr($mainvalue_sub[0],1);
			if($result){						
				if($minorvalue_sub[0]!=""){					
					$minorvalue_sub[0]	=substr($minorvalue_sub[0],1);					
					foreach($result as $item){
						$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$mainvalue_sub[0]]][$item[$data['detail_minor_type'][$field_minor]]][$item[$minorvalue_sub[0]]]=$item['cnt'];						
					}						
				}else{									
					foreach($result as $item){
						$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$mainvalue_sub[0]]][$item[$data['detail_minor_type'][$field_minor]]]=$item['cnt'];
					}
				}
			}
			
			$main_head = count($data['detail_main_name_head']);					
			$main      = count($data['detail_main_name']);
			$minor     = count($data['minordetail']);
			$minor_sub =(empty($data['m_value'])) ? "":count($data['m_value']);
		
			if($minor_sub==""){
				for($h=0;$h<$main_head;$h++){								
					for($i=0;$i<$main;$i++){
						$data['total_main'.$h.$i]=0;						
						for($j=0;$j<$minor;$j++){					
							$data['main'.$h.$i.$j] = (empty($rs['main'][$h][$i][$j])) ? 0 : $rs['main'][$h][$i][$j];
							$data['total_main'.$h.$i] = $data['total_main'.$h.$i] + $data['main'.$h.$i.$j];										
						}									
					}
				}				
			}else{
				 for($h=0;$h<$main_head;$h++){												
					for($i=0;$i<$main;$i++){
						$data['total_main'.$h.$i]=0;							
						for($j=0;$j<$minor;$j++){
							for($k=0;$k<$minor_sub;$k++){																		
								$data['main'.$h.$i.$j.$k] = (empty($rs['main'][$h][$i][$j][$k])) ? 0 : $rs['main'][$h][$i][$j][$k];
								$data['total_main'.$h.$i] = $data['total_main'.$h.$i] + $data['main'.$h.$i.$j.$k];
							}										
						}				
					}				
				 }
			}
			//var_dump($rs);exit;	
			$data['main'] = $main;
			$data['minor']= $minor;
			$data['cond'] = $cond;
 		}						
		if($preview){
			$this->template->set_layout('print');
			$this->template->build('analyze/report2_index',$data);
		}else if($excel){				
			$filename ="report2_".$data['detail_minor'].'_'.date('YmdHis').".xls";			;						
			$this->template->set_layout('print');
			$this->load->view('analyze/report2_export',$data);	
			downloadFile($filename);						
		}else{
			$this->template->build('analyze/report2_index',$data);
		}		
	}
	function report3($cond= FALSE,$preview=FALSE,$data,$excel=FALSE)
	{
			
		$data['detail_main'] = $data['detail_main']-2; // ตอนแรกใช้เพื่อ เลือกฟังก็ชั่่ น การคำนวน  ,เอามาลบเพราะ ต้องใช้เลือกฟิลด์มาคิวรี	
		$data['head'] = "ชนิดสัตว์นำโรค";				
		$data['detail_minor_name']=array("","สถานภาพสัตว์","การกักขัง/ติดตามดูอาการสัตว์","ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์","การส่งหัวสัตว์ตรวจ");
		$data['detail_minor_type']=array('',"typeanimal","statusanimal","detain","historyvacine","headanimal");
		$data['detail_main_name']=array("สุนัข","แมว","ลิง","ชะนี","หนู","คน","วัว","กระบือ","สุกร","แพะ","แกะ","ม้า","กระรอก","กระแต","พังพอน","กระต่าย","สัตว์ป่า","ไม่ทราบ","ไม่ระบุ");
		$data['detail_main_type']=array("10","20","30","40","50","61","62","63","64","65","66","67","68","69","610","611","612","613","00");
		$data['main_value'] = array('1','2','3','4','5','6','0');
		$data['m_value'] = array("1","2","3","4","5","6","7","8","9","10","11","12","13","0");
		$mainvalue_sub=array(",typeother");
		
		$field_minor = $data['detail_minor']+1;
		$num_main=count($data['detail_main_name']);
		$minorvalue_sub[0]="";
		
		if($data['detail_minor']==1){
			$data['minordetail']=array("มีเจ้าของ","ไม่มีเจ้าของ","ไม่ทราบ","ไม่ระบุ");
			$data['minorvalue']=array("1","2","3","0");
		}
		if($data['detail_minor']==2){
			$data['minordetail_head']=array("กักขังได้","กักขังไม่ได้","ถูกฆ่าตาย","หนีหาย / จำไม่ได้","ไม่ระบุ");
			$data['minorvalue_head']=array("3","1","1","1","1","1");
			$data['minordetail']=array("ตายเองภายใน 10 วัน ","ไม่ตายภายใน 10 วัน","ไม่ระบุ","","","","");
			$data['minorvalue']=array("11","12","10","20","30","40",'00');
			$minorvalue_sub=array(",detaindate");
		}
		if($data['detail_minor']==3){
			$data['minordetail_head']=array("ไม่ทราบ","ไม่เคยฉีด","เคยฉีด 1 ครั้ง","เคยฉีดเกิน 1 ครั้ง","ไม่ระบุ");
			$data['minorvalue_head']=array("1","1","1","3","1");
		
			$data['minordetail']=array("","",""," ภายใน 1 ปี ","เกิน 1 ปี","ไม่ระบุ",'');
			$data['minorvalue']=array("10","20","30","41","42","40","00");
			$minorvalue_sub=array(",historyvacine_within");
		}
		if($data['detail_minor']==4){
			$data['minordetail_head']=array("ไม่ได้ส่งตรวจ","ส่งตรวจ","ไม่ระบุ");
			$data['minorvalue_head']=array("1","3","1");		
			$data['minordetail']=array("", "พบเชื้อ","ไม่พบเชื้อ", "ไม่ระบุ", "");
			$data['minorvalue']=array("10","21","22","20","00");
			$minorvalue_sub=array(",batteria");
		}
		if($cond)
		{											
			$sql = "SELECT ".$data['select_date_type']." count(historyid) as cnt,".$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0]."
					,".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]."
					FROM n_history inner join n_information on historyid=information_historyid
					WHERE  ".$cond." 
					GROUP BY ".$data['date_type'].$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]."  
					ORDER BY ".$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]." ASC";
			//echo $sql;
			$result = $this->db->Execute($sql);	
			
			$rs=array();				
			$mainvalue_sub[0] =substr($mainvalue_sub[0],1);
			if($result){						
				if($minorvalue_sub[0]!=""){					
					$minorvalue_sub[0]	=substr($minorvalue_sub[0],1);					
					foreach($result as $item){
						$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$mainvalue_sub[0]]][$item[$data['detail_minor_type'][$field_minor]]][$item[$minorvalue_sub[0]]]=$item['cnt'];						
					}						
				}else{									
					foreach($result as $item){
						$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$mainvalue_sub[0]]][$item[$data['detail_minor_type'][$field_minor]]]=$item['cnt'];
					}
				}
			}
							
			$main       = count($data['detail_main_name']);
			$main_sub   = (empty($data['m_value'])) ? "":count($data['m_value']);
			$minor_head = (empty($data['minordetail_head'])) ? "":count($data['minordetail_head']);
			$minor      = count($data['minordetail']);
				
				if(empty($minor_head)){
					for($i=0;$i<$main;$i++){																				
						for($j=0;$j<$main_sub;$j++){
							$data['total_main'.$i.$j]=0;														
								for($l=0;$l<$minor;$l++){																		
								$data['main'.$i.$j.$l] = (empty($rs['main'][$i][$j][$l])) ? 0 : $rs['main'][$i][$j][$l];
								$data['total_main'.$i.$j] = $data['total_main'.$i.$j] + $data['main'.$i.$j.$l];
								}										
											
						}					
					}						
				}else{
					for($i=0;$i<$main;$i++){																				
						for($j=0;$j<$main_sub;$j++){
							$data['total_main'.$i.$j]=0;							
							for($k=0;$k<$minor_head;$k++){
								for($l=0;$l<$minor;$l++){																		
								$data['main'.$i.$j.$k.$l] = (empty($rs['main'][$i][$j][$k][$l])) ? 0 : $rs['main'][$i][$j][$k][$l];
								$data['total_main'.$i.$j] = $data['total_main'.$i.$j] + $data['main'.$i.$j.$k.$l];
								}										
							}				
						}					
					}					
				}//else
					
											 											

				
			$data['main'] = $main;
			$data['minor']= $minor;
			$data['cond'] = $cond;
 		}		
		if($preview){
			$this->template->set_layout('print');
			$this->template->build('analyze/report3_index',$data);
		}else if($excel){				
			$filename ="report3_".$data['detail_minor'].'_'.date('YmdHis').".xls";			;						
			$this->template->set_layout('print');
			$this->load->view('analyze/report3_export',$data);	
			downloadFile($filename);						
		}else{
			$this->template->build('analyze/report3_index',$data);
		}		
	}
	function report4($cond= FALSE,$preview=FALSE,$data,$excel=FALSE)
	{
		
		$data['detail_main'] = $data['detail_main']-3; // ตอนแรกใช้เพื่อ เลือกฟังก็ชั่่ น การคำนวน  ,เอามาลบเพราะ ต้องใช้เลือกฟิลด์มาคิวรี	
		$data['head'] = "อายุสัตว์";	
		$data['detail_minor_name']=array("","ชนิดสัตว์นำโรค","สถานภาพสัตว์","ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์");
		$data['detail_minor_type']=array('',"ageanimal","typeanimal","statusanimal","historyvacine");
		$data['detail_main_name']=array('',"น้อยกว่า 3 เดือน ","3 - 6 เดือน ","6 - 12 เดือน ","มากกว่า 1 ปี ","ไม่ทราบ","ไม่ระบุ");
		$data['detail_main_type']=array("1","2","3","4","5","0");
		
		$field_minor = $data['detail_minor']+1;
		$num_main=count($data['detail_main_name']);
		$minorvalue_sub[0]="";
		
		if($data['detail_minor']==1){
			$data['minordetail']=array("สุนัข","แมว","ลิง","ชะนี","หนู","คน","วัว","กระบือ","สุกร","แพะ","แกะ","ม้า","กระรอก","กระแต","พังพอน","กระต่าย","สัตว์ป่า","ไม่ทราบ","ไม่ระบุ");
			$data['minorvalue']=array("10","20","30","40","50",'61','62','63','64','65','66','67','68','69','610','611','612','613','60');
			$minorvalue_sub=array(",typeother");
			$data['m_value'] = array("1","2","3","4","5","6","7","8","9","10","11","12","13","0");
		}
		if($data['detail_minor']==2){
			$data['minordetail']=array("มีเจ้าของ","ไม่มีเจ้าของ","ไม่ทราบ","ไม่ระบุ");
			$data['minorvalue']=array("1","2","3","0");
		}
		if($data['detail_minor']==3){
			$data['minordetail_head']=array("ไม่ทราบ","ไม่เคยฉีด","เคยฉีด 1 ครั้ง",'เคยฉีดเกิน 1 ครั้ง','ไม่ระบุ');
			$data['minorvalue_head']=array("1","1","1","3","1");		
			$data['minordetail']=array("","",""," ภายใน 1 ปี ","เกิน 1 ปี","ไม่ระบุ","");
			$data['minorvalue']=array("10","20","30","41","42","40","00");
			$minorvalue_sub = array(",historyvacine_within");
			
		}
		if($cond)
		{											
			$sql = "SELECT ".$data['select_date_type']." count(historyid) as cnt,".$data['detail_minor_type'][$data['detail_main']]."
					,".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]."
					FROM n_history inner join n_information on historyid=information_historyid
					WHERE  ".$cond." 
					group by ".$data['date_type'].$data['detail_minor_type'][$data['detail_main']].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]."  
					ORDER BY ".$data['detail_minor_type'][$data['detail_main']].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]." ASC";			
			$result = $this->db->Execute($sql);
				
			$rs=array();				
			
			if($result){						
				if($minorvalue_sub[0]!=""){					
					$minorvalue_sub[0]	=substr($minorvalue_sub[0],1);					
					foreach($result as $item){
						$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$data['detail_minor_type'][$field_minor]]][$item[$minorvalue_sub[0]]]=$item['cnt'];						
					}						
				}else{									
					foreach($result as $item){
						$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$data['detail_minor_type'][$field_minor]]]=$item['cnt'];
					}
				}
			}
			
							
			$main       = count($data['detail_main_name']);			
			$minor_head = (empty($data['minordetail_head'])) ? "":count($data['minordetail_head']);
			$minor      = count($data['minordetail']);
			$minor_sub   = (empty($data['m_value'])) ? "":count($data['m_value']);
				if($minor_head){## ประวัติการป้องกันโรคพิษสุนัขบ้า
					for($i=0;$i<$main;$i++){
						$data['total_main'.$i]=0;													
						for($j=0;$j<$minor_head;$j++){							
							for($k=0;$k<$minor;$k++){																									
								$data['main'.$i.$j.$k] = (empty($rs['main'][$i][$j][$k])) ? 0 : $rs['main'][$i][$j][$k];
								$data['total_main'.$i] = $data['total_main'.$i] + $data['main'.$i.$j.$k];
																		
							}				
						}					
					}					
				}else{
					if($minor_sub !=""){## ชนิดสัตว์
						for($i=0;$i<$main;$i++){																			
								$data['total_main'.$i]=0;
								for($k=0;$k<$minor;$k++){
									for($l=0;$l<$minor_sub;$l++){																		
									$data['main'.$i.$k.$l] = (empty($rs['main'][$i][$k][$l])) ? 0 : $rs['main'][$i][$k][$l];
									$data['total_main'.$i] = $data['total_main'.$i] + $data['main'.$i.$k.$l];
									}										
								}				
							}						
					}elseif($minor_sub==""){
						## สภานภาพสัตว์
						for($i=0;$i<$main;$i++){																			
							$data['total_main'.$i]=0;
							for($k=0;$k<$minor;$k++){																											
								$data['main'.$i.$k] = (empty($rs['main'][$i][$k])) ? 0 : $rs['main'][$i][$k];
								$data['total_main'.$i] = $data['total_main'.$i] + $data['main'.$i.$k];
							}										
						}																					
					}															
				}// $minor_head							 											

				
			$data['main'] = $main;
			$data['minor']= $minor;
			$data['cond'] = $cond;
 		}		
		if($preview){
			$this->template->set_layout('print');
			$this->template->build('analyze/report4_index',$data);
		}else if($excel){				
			$filename ="report4_".$data['detail_minor'].'_'.date('YmdHis').".xls";			;						
			$this->template->set_layout('print');
			$this->load->view('analyze/report4_export',$data);	
			downloadFile($filename);						
		}else{
			$this->template->build('analyze/report4_index',$data);
		}			
				
	}
	function report5($cond= FALSE,$preview=FALSE,$data,$excel=FALSE)
	{
		
		$data['detail_main'] = $data['detail_main']-4; // ตอนแรกใช้เพื่อ เลือกฟังก็ชั่่ น การคำนวน  ,เอามาลบเพราะ ต้องใช้เลือกฟิลด์มาคิวรี	
		$data['head'] = "สัตว์ถูกฆ่าตาย กับ สัตว์ตายเองภายใน 10 วัน";	
		$data['detail_minor_name']=array("","จำนวนหัวสัตว์ที่ส่งตรวจ");
		$data['detail_minor_type']=array('',"detain","headanimal");
		$data['detail_main_name_head']=array("กักขังได้ / ติดตามได้","","ถูกฆ่าตาย");
		$data['detail_main_name']=array('',"ตายเองภายใน 10 วัน","");
		$data['detail_main_type']=array("10","11","30");
		$data['main_value']=array("0","1","3");
		$mainvalue_sub=array(",detaindate");
		

		$field_minor = $data['detail_minor']+1;
		$num_main=count($data['detail_main_name']);
	
		if($data['detail_minor']==1){
			$data['minordetail_head']= array("ไม่ได้ส่งตรวจ","ส่งตรวจ","ไม่ระบุ");
			$data['minorvalue_head'] = array("1","3","1");			
			$data['minordetail'] = array("","พบเชื้อ","ไม่พบเชื้อ", "ไม่ระบุ","");
			$data['minorvalue'] = array("10","21","22","20","00");
			$data['m_value'] = array("1","2","0");
			$minorvalue_sub=array(",batteria");
		}
		if($cond)
		{											
			$sql = "SELECT ".$data['select_date_type']." count(historyid) as cnt,".$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0]."
					,".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]."
					FROM n_history inner join n_information on historyid=information_historyid
					WHERE  ".$cond." 
					group by ".$data['date_type'].$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]."  
					ORDER BY ".$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]." ASC";
			//echo $sql;
			$result = $this->db->Execute($sql);	
			
			$rs=array();				
			$mainvalue_sub[0] =substr($mainvalue_sub[0],1);
			if($result){														
				$minorvalue_sub[0]	=substr($minorvalue_sub[0],1);					
				foreach($result as $item){
					$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$mainvalue_sub[0]]][$item[$data['detail_minor_type'][$field_minor]]][$item[$minorvalue_sub[0]]]=$item['cnt'];						
				}										
			}
										
			$main       = count($data['detail_main_name'])+1;
			$main_sub   = count($data['main_value'])+1;			
			$minor      = count($data['minordetail']);
			$minor_sub  = count($data['m_value']);
											 											
				for($i=0;$i<$main;$i++){													
					for($j=0;$j<$main_sub;$j++){
						$data['total_main'.$i.$j]=0;
						for($k=0;$k<$minor;$k++){
							for($l=0;$l<$minor_sub;$l++){																		
							$data['main'.$i.$j.$k.$l] = (empty($rs['main'][$i][$j][$k][$l])) ? 0 : $rs['main'][$i][$j][$k][$l];
							$data['total_main'.$i.$j] = $data['total_main'.$i.$j] + $data['main'.$i.$j.$k.$l];
							}										
						}				
					}					
				}
				
			$data['main'] = $main;
			$data['minor']= $minor;
			$data['cond'] = $cond;
 		}						
		if($preview){
			$this->template->set_layout('print');
			$this->template->build('analyze/report5_index',$data);
		}else if($excel){				
			$filename ="report5_".$data['detail_minor'].'_'.date('YmdHis').".xls";			;						
			$this->template->set_layout('print');
			$this->load->view('analyze/report5_export',$data);	
			downloadFile($filename);						
		}else{
			$this->template->build('analyze/report5_index',$data);
		}					
	}
	function report6($cond= FALSE,$preview=FALSE,$data,$excel=FALSE)
	{
		
		$data['detail_main'] = $data['detail_main']-5; // ตอนแรกใช้เพื่อ เลือกฟังก็ชั่่ น การคำนวน  ,เอามาลบเพราะ ต้องใช้เลือกฟิลด์มาคิวรี	
		$data['head'] = "ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์";
		$data['detail_minor_name'] = array("",'ผลการส่งหัวสัตว์ตรวจที่พบเชื้อ' );
		$data['detail_minor_type'] = array('',"historyvacine","batteria");
		$data['detail_main_name_head'] = array("ไม่ทราบ","ไม่เคยฉีด","เคยฉีด 1 ครั้ง","เคยฉีดเกิน 1 ครั้ง","","","ไม่ระบุ");
		$data['detail_main_name'] = array("","","","ภายใน 1 ปี","เกิน 1 ปี","ไม่ระบุ",'');
		$data['detail_main_type'] = array("10","20","30","41","42","40","00");
		$mainvalue_sub=array(",historyvacine_within");
		$num_main=count($data['detail_main_name_head']);
		$field_minor = $data['detail_minor']+1;
		if($data['detail_minor']==1){
			$data['minordetail']= array("พบเชื้อ","ไม่พบเชื้อ", "ไม่ระบุ");
			$data['minorvalue'] = array(",batteria");
			$data['m_value'] = array("1","2","0");
		}
		if($cond)
		{											
			$sql = "SELECT ".$data['select_date_type']." count(historyid) as cnt,".$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0]."
					,".$data['detail_minor_type'][$field_minor]."
					FROM n_history inner join n_information on historyid=information_historyid
					WHERE  ".$cond." 
					group by ".$data['date_type'].$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0].",".$data['detail_minor_type'][$field_minor]."  
					ORDER BY ".$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0].",".$data['detail_minor_type'][$field_minor]." ASC";
			//echo $sql;
			$result = $this->db->Execute($sql);	
			
			$rs=array();				
			$mainvalue_sub[0] =substr($mainvalue_sub[0],1);
			if($result){														
									
				foreach($result as $item){
					$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$mainvalue_sub[0]]][$item[$data['detail_minor_type'][$field_minor]]]=$item['cnt'];						
				}										
			}
						
			$main  = count($data['detail_main_name_head']);
			$minor = count($data['minordetail']);
			$minor_sub   = (empty($data['m_value'])) ? "":count($data['m_value']);
				for($i=0;$i<$main;$i++){													
					for($j=0;$j<$minor;$j++){
						$data['total_main'.$i.$j]=0;
						for($k=0;$k<$minor_sub;$k++){																							
							$data['main'.$i.$j.$k] = (empty($rs['main'][$i][$j][$k])) ? 0 : $rs['main'][$i][$j][$k];
							$data['total_main'.$i.$j] = $data['total_main'.$i.$j] + $data['main'.$i.$j.$k];
																
						}				
					}					
				}			
			
		}
			$data['main'] = $main;
			$data['minor']= $minor;
			$data['cond'] = $cond;		
		if($preview){
			$this->template->set_layout('print');
			$this->template->build('analyze/report6_index',$data);
		}else if($excel){				
			$filename ="report6_".$data['detail_minor'].'_'.date('YmdHis').".xls";			;						
			$this->template->set_layout('print');
			$this->load->view('analyze/report6_export',$data);	
			downloadFile($filename);						
		}else{
			$this->template->build('analyze/report6_index',$data);
		}				
	}
	function report7($cond= FALSE,$preview=FALSE,$data,$excel=FALSE)
	{
				
		$data['detail_main'] = $data['detail_main']-6; // ตอนแรกใช้เพื่อ เลือกฟังก็ชั่่ น การคำนวน  ,เอามาลบเพราะ ต้องใช้เลือกฟิลด์มาคิวรี	
		$data['head'] = "ประวัติการฉีดวัคซีนของผู้สัมผัส";					
		$data['detail_minor_name'] = array("",'อาชีพ','อาชีพผู้ปกครอง','อายุ','การฉีดอิมมูโนโกลบุลิน','จำนวนเข็มของการฉีด','ผลการส่งหัวสัตว์ตรวจที่พบเชื้อ ');
		$data['detail_minor_type'] = array('',"historyprotect","occupationname","occparentsname","age_group","use_rig","total_vaccine","batteria");
		$data['detail_main_name_head'] = array("ไม่เคยฉีดหรือเคยฉีดน้อยกว่า 3 เข็ม ","เคยฉีด 3 เข็มหรือมากกว่า ","","","ไม่ระบุ");
		$data['detail_main_name'] = array("","ภายใน 6 เดือน","เกิน 6 เดือน","ไม่ระบุ","");
		$data['detail_main_type'] = array("10","21","22","20","00");
		$data['main_sub'] = array("1","2","0");
		$mainvalue_sub=array(",historyprotectdetail");
		$num_main=count($data['detail_main_name_head']);
		$field_minor = $data['detail_minor']+1;
		
		
		if($data['detail_minor']==1){
			$data['minordetail'] = array("นักเรียน นักศึกษา","ในปกครอง","เกษตร ทำนา ทำสวน","ข้าราชการ","กรรมกร","รับจ้าง (เช่น พนักงานบริษัท/ดารา/นักแสดง ฯลฯ)","ค้าขาย","งานบ้าน","ทหาร ตำรวจ","ประมง","ครู","เลี้ยงสัตว์ / จับสุนัข","นักบวช / ภิกษุสามเณร","ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ","สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์หรือผู้ช่วยผู้ที่ทำงานในห้องปฏิบัติการโรคพิษสุนัขบ้า","อาสาสมัครฉีดวัคซีนสุนัข","เจ้าหน้าที่สวนสัตว์","ไปรษณีย์","ป่าไม้","พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า","อื่นๆ (ระบุ)","ไม่ระบุ");
			$data['minorvalue'] = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","0");
		}
		if($data['detail_minor']==2){
			$data['minordetail'] = array("เกษตร ทำนา ทำสวน","ข้าราชการ","กรรมกร","รับจ้าง (เช่น พนักงานบริษัท/ดารา/นักแสดง ฯลฯ)","ค้าขาย","งานบ้าน","ทหาร ตำรวจ","ประมง","ครู","เลี้ยงสัตว์ / จับสุนัข","นักบวช / ภิกษุสามเณร","ผู้ขับขี่จักรยาน / จักรยานยนต์ส่งของ","สัตว์แพทย์ผู้ประกอบการบำบัดโรคสัตว์หรือผู้ช่วยผู้ที่ทำงานในห้องปฏิบัติการโรคพิษสุนัขบ้า","อาสาสมัครฉีดวัคซีนสุนัข","เจ้าหน้าที่สวนสัตว์","ไปรษณีย์","ป่าไม้","พ่อค้าซื้อขายแลกเปลี่ยนสุนัข แมว สัตว์ป่า","อื่นๆ (ระบุ)","ไม่ระบุ");
			$data['minorvalue'] = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","0");
		}
		if($data['detail_minor']==3){
			$data['minordetail'] = array("ต่ำกว่า 1 ปี","1-5 ปี","6-10 ปี","11-15 ปี","16-25 ปี","26-35 ปี","36-45 ปี","46-55 ปี","56-65ปี","66 ปีขึ้นไป","ไม่ระบุ");
			$data['minorvalue'] = array("1","2","3","4","5","6","7","8","9","10","0");
		}
		if($data['detail_minor']==4){
			$data['minordetail'] = array("ไม่ฉีด","ฉีด","ไม่ระบุ");
			$data['minorvalue'] = array("1","2","0");
		}
		if($data['detail_minor']==5){
			$data['minordetail'] = array("1 เข็ม","2 เข็ม","3 เข็ม","4 เข็ม","5 เข็ม","ไม่ระบุ");
			$data['minorvalue'] = array("1","2","3","4","5","0");
		}
		if($data['detail_minor']==6){
			$data['minordetail'] = array("พบเชื้อ","ไม่พบเชื้อ","ไม่ระบุ");
			$data['minorvalue'] = array("1","2","0");
		}	
		if($cond)
		{											
			$sql = "SELECT ".$data['select_date_type']." count(historyid) as cnt,".$data['detail_minor_type'][$data['detail_main']]."
				   ".$mainvalue_sub[0].",".$data['detail_minor_type'][$field_minor]."
					FROM n_history inner join n_information on historyid=information_historyid
					WHERE  ".$cond." 
					group by ".$data['date_type'].$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0].",".$data['detail_minor_type'][$field_minor]."  
					ORDER BY ".$data['detail_minor_type'][$data['detail_main']].$mainvalue_sub[0].",".$data['detail_minor_type'][$field_minor]." ASC";
			//echo $sql;
			$result = $this->db->Execute($sql);
				
			$rs=array();				
			$mainvalue_sub[0]=substr($mainvalue_sub[0],1);
			if($result){																		
				foreach($result as $item){
					$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$mainvalue_sub[0]]][$item[$data['detail_minor_type'][$field_minor]]]=$item['cnt'];
				}				
			}

			$main  = count($data['main_sub']);
			$main_sub  = count($data['main_sub']);
			$minor = count($data['minordetail']);
						
			for($i=0;$i<$main;$i++){																								
					for($k=0;$k<$main_sub;$k++){
						$data['total_main'.$i.$k]=0;
						for($l=0;$l<$minor;$l++){																		
						$data['main'.$i.$k.$l] = (empty($rs['main'][$i][$k][$l])) ? 0 : $rs['main'][$i][$k][$l];
						$data['total_main'.$i.$k] = $data['total_main'.$i.$k] + $data['main'.$i.$k.$l];
						}										
					}				
				}						
			
		}//$cond
			$data['main'] = $main;
			$data['minor']= $minor;
			$data['cond'] = $cond;						
		if($preview){
			$this->template->set_layout('print');
			$this->template->build('analyze/report7_index',$data);
		}else if($excel){				
			$filename ="report7_".$data['detail_minor'].'_'.date('YmdHis').".xls";			;						
			$this->template->set_layout('print');
			$this->load->view('analyze/report7_export',$data);	
			downloadFile($filename);						
		}else{
			$this->template->build('analyze/report7_index',$data);
		}	
	}
	function report8($cond= FALSE,$preview=FALSE,$data,$excel=FALSE)
	{		
		$data['detail_main'] = $data['detail_main']-7; // ตอนแรกใช้เพื่อ เลือกฟังก็ชั่่ น การคำนวน  ,เอามาลบเพราะ ต้องใช้เลือกฟิลด์มาคิวรี	
		$data['head'] = "การฉีดอิมมูโนโกลบุลิน";	
		$data['detail_minor_name'] = array("","ตำแหน่งที่สัมผัสโรค และลักษณะการสัมผัส","สถานภาพสัตว์","ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์","วิธีฉีดวัคซีนในคน");
		$data['detail_minor_type'] = array('',"use_rig","statusanimal","detain","historyvacine","means");
		$data['detail_main_name']  = array("ไม่ฉีด","ฉีด","ไม่ระบุ");
		$data['detail_main_type']  = array("1","2","0");
		$field_minor = $data['detail_minor']+1;
		$minorvalue_sub[0]="";
		if($data['detail_minor']=="1")
		{					
			$data['detailmain_B']    = array("ศรีษะ","หน้า","ลำคอ","มือ","แขน","ลำตัว","ขา","เท้า");
			$data['detailmain_T']    = array("head","face","neck","hand","arm","body","leg","feet");
			$data['detailminor_name'] = array('',"ฉีด","ไม่ฉีด");
			$data['detailminor_T']    = array('',"2","1");
			$data['detailmain_wh']    = array("_bite_blood","_bite_noblood","_claw_blood","_claw_noblood","_lick_blood","_lick_noblood");					
			$data['cond'] = $cond;
			if($preview){
				$this->template->set_layout('print');
				$this->template->build('analyze/report8_1_index',$data);
			}else if($excel){				
				$filename ="report8_1_".$data['detail_minor'].'_'.date('YmdHis').".xls";			;						
				$this->template->set_layout('print');
				$this->load->view('analyze/report8_1_export',$data);	
				downloadFile($filename);						
			}else{
				$this->template->build('analyze/report8_1_index',$data);
			}	

		}else{
				if($data['detail_minor']==2){
				$data['minordetail_head'] = array("กักขังได้","กักขังไม่ได้","ถูกฆ่าตาย","หนีหาย / จำไม่ได้","ไม่ระบุ");
				$data['minorvalue_head']  = array("3","1","1","1","1","1");
				$data['minordetail']      = array("ตายเองภายใน 10 วัน ","ไม่ตายภายใน 10 วัน","ไม่ระบุ","","","","");
				$data['minorvalue']       = array("11","12","10","20","30","40","00");
				$data['m_value'] = array("1","2","0");
				$minorvalue_sub = array(",detaindate");
			}
			else if($data['detail_minor']==3){
				$data['minordetail_head'] = array("ไม่ทราบ","ไม่เคยฉีด","เคยฉีด 1 ครั้ง","เคยฉีดเกิน 1 ครั้ง","ไม่ระบุ");
				$data['minorvalue_head']  = array("1","1","1","3","1");
				$data['minordetail']      = array("","",""," ภายใน 1 ปี ","เกิน 1 ปี","ไม่ระบุ","");
				$data['minorvalue']       = array("10","20","30","41","42","40","00");
				$data['m_value'] = array("1","2","0");
				$minorvalue_sub = array(",historyvacine_within");
			}
			else if($data['detail_minor']==4){
				$data['minordetail'] = array("เข้ากล้ามเนื้อ ","เข้าในผิวหนัง ","ไม่ฉีด ");
				$data['minorvalue']  = array("1","2","3");
			}
			if($cond)
			{											
				$sql = "SELECT ".$data['select_date_type']." count(historyid) as cnt,".$data['detail_minor_type'][$data['detail_main']]."
					    ,".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]."
						FROM n_history inner join n_information on historyid=information_historyid
						WHERE  ".$cond." 
						group by ".$data['date_type'].$data['detail_minor_type'][$data['detail_main']].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]."  
						ORDER BY ".$data['detail_minor_type'][$data['detail_main']].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]." ASC";
				//echo $sql;
				$result = $this->db->Execute($sql);
					
				$rs=array();							
				if($result){
					if($minorvalue_sub[0]!=""){
						$minorvalue_sub[0]=substr($minorvalue_sub[0],1);	
						foreach($result as $item){
							$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$data['detail_minor_type'][$field_minor]]][$item[$minorvalue_sub[0]]]=$item['cnt'];
						}				
					}else{
						foreach($result as $item){
							$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$data['detail_minor_type'][$field_minor]]]=$item['cnt'];
						}					
					}																						
				}
				$main  = count($data['detail_minor_name']);	
				$minor = count($data['minordetail'])+1;					
				if($data['detail_minor']==4){$minor = count($data['minordetail'])+1;}
				$minor_sub = (!empty($data['m_value'] )) ? count($data['m_value']):'';
				
				if($minorvalue_sub[0]!=""){
					for($i=0;$i<$main;$i++){
						$data['total_main'.$i]=0;																																	
						for($j=0;$j<$minor;$j++){
							for($k=0;$k<$minor_sub;$k++){
								$data['main'.$i.$j.$k] = (empty($rs['main'][$i][$j][$k])) ? 0 : $rs['main'][$i][$j][$k];								
								$data['total_main'.$i] = $data['total_main'.$i] + $data['main'.$i.$j.$k];							
							}																		
	
						}										
					}				
				}else{										
					for($i=0;$i<$main;$i++){																												
						$data['total_main'.$i]=0;
						for($j=0;$j<$minor;$j++){																		
							$data['main'.$i.$j] = (empty($rs['main'][$i][$j])) ? 0 : $rs['main'][$i][$j];
							$data['total_main'.$i] = $data['total_main'.$i] + $data['main'.$i.$j];
						}										
					}				
				}					
			}// $cond
			
			$data['cond'] = $cond;
							
			if($preview){
				$this->template->set_layout('print');
				$this->template->build('analyze/report8_index',$data);
			}else if($excel){				
				$filename ="report8_".$data['detail_minor'].'_'.date('YmdHis').".xls";			;						
				$this->template->set_layout('print');
				$this->load->view('analyze/report8_export',$data);	
				downloadFile($filename);						
			}else{
				$this->template->build('analyze/report8_index',$data);
			}
		}// report8
						
	}
	function report9($cond= FALSE,$preview=FALSE,$data,$excel=FALSE){
			
		$data['detail_main'] = $data['detail_main']-8; // ตอนแรกใช้เพื่อ เลือกฟังก็ชั่่ น การคำนวน  ,เอามาลบเพราะ ต้องใช้เลือกฟิลด์มาคิวรี	
		$data['head'] = "จำนวนครั้งที่ฉีดวัคซีนในคน";			
		$data['detail_minor_name'] = array("","การกักขังสัตว์ได้/ติดตามได้","ประวัติการฉีดวัคซีนป้องกันโรคพิษสุนัขบ้าในสัตว์","การส่งหัวสัตว์ตรวจ");
		$data['detail_minor_type'] = array("","total_vaccine","detaindate","historyvacine","headanimal");
		$data['detail_main_name'] = array("1 ครั้ง ","2 ครั้ง","3 ครั้ง","4 ครั้ง","5 ครั้ง", "ไม่ระบุ");
		$data['detail_main_type'] = array("1","2","3","4","5","0");
		
		$num_main=count($data['detail_main_name']);
		$field_minor = $data['detail_minor']+1;
		$minorvalue_sub[0]="";
		
		if($data['detail_minor']==1){
			$data['minordetail']=array("ตายเองภายใน 10 วัน","ไม่ตายภายใน 10 วัน", "ไม่ระบุ");
			$data['minorvalue']=array("1","2","0");
		}
		if($data['detail_minor']==2){
			$data['minordetail_head']=array("ไม่ทราบ","ไม่เคยฉีด","เคยฉีด 1 ครั้ง","เคยฉีดเกิน 1 ครั้ง","ไม่ระบุ");
			$data['minorvalue_head']=array("1","1","1","3","1");
			$data['minordetail']=array("","",""," ภายใน 1 ปี ","เกิน 1 ปี","ไม่ระบุ","");
			$data['minorvalue']=array("10","20","30","41","42","40","00");
			$m_value = array('1','2','0');
			$minorvalue_sub=array(",historyvacine_within");
		}
		if($data['detail_minor']==3){
			$data['minordetail_head']=array("","ส่งตรวจ","","ไม่ได้ส่งตรวจ","ไม่ระบุ");	
			$data['minorvalue_head']=array("","1","","1","1","1");		
			$data['minordetail'] = array("พบเชื้อ","ไม่พบเชื้อ","ไม่ระบุ","","");
			$data['minorvalue']  = array("21","22","20","10","00");

			$m_value = array('1','2','0');
			$minorvalue_sub=array(",batteria");
		}
		
		if($cond){
			$sql = "SELECT ".$data['select_date_type']." count(historyid) as cnt,".$data['detail_minor_type'][$data['detail_main']]."
				    ,".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]."
					FROM n_history inner join n_information on historyid=information_historyid
					WHERE  ".$cond." 
					GROUP BY ".$data['date_type'].$data['detail_minor_type'][$data['detail_main']].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]."  
					ORDER BY ".$data['detail_minor_type'][$data['detail_main']].",".$data['detail_minor_type'][$field_minor].$minorvalue_sub[0]." ASC";
			//echo $sql;
			$result = $this->db->Execute($sql);
			
			$rs=array();				
			
			if($minorvalue_sub[0]!=""){					
					$minorvalue_sub[0]	=substr($minorvalue_sub[0],1);					
					foreach($result as $item){
						$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$data['detail_minor_type'][$field_minor]]][$item[$minorvalue_sub[0]]]=$item['cnt'];						
					}						
				}else{									
					foreach($result as $item){
						$rs['main'][$item[$data['detail_minor_type'][$data['detail_main']]]][$item[$data['detail_minor_type'][$field_minor]]]=$item['cnt'];
					}
				}		
								
			$main  = count($data['detail_main_name']);		
			$minor = count($data['minordetail']);
			$minor_sub = (empty($m_value)) ? "":count($data['minordetail']);

				if($minor_sub !=""){
					for($i=0;$i<$main;$i++){
						$data['total_main'.$i]=0;																										
							for($k=0;$k<$minor;$k++){							
									for($l=0;$l<$minor_sub;$l++){																		
										$data['main'.$i.$k.$l] = (empty($rs['main'][$i][$k][$l])) ? 0 : $rs['main'][$i][$k][$l];
										$data['total_main'.$i] = $data['total_main'.$i] + $data['main'.$i.$k.$l];
									}										
							}				
						}						
				}else{															
					for($i=0;$i<$main;$i++){
						$data['total_main'.$i]=0;																								
						for($k=0;$k<$minor;$k++){																										
							$data['main'.$i.$k] = (empty($rs['main'][$i][$k])) ? 0 : $rs['main'][$i][$k];
							$data['total_main'.$i] = $data['total_main'.$i] + $data['main'.$i.$k];															
						}				
					}
				}											
		}
			
		$data['cond'] = $cond;
		if($preview){
			$this->template->set_layout('print');
			$this->template->build('analyze/report9_index',$data);
		}else if($excel){				
			$filename ="report9_".$data['detail_minor'].'_'.date('YmdHis').".xls";			;						
			$this->template->set_layout('print');
			$this->load->view('analyze/report9_export',$data);	
			downloadFile($filename);						
		}else{
			$this->template->build('analyze/report9_index',$data);
		}	
	}
}
?>