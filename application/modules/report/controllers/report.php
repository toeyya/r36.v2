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
		$this->load->model('area/area_model','area');
		$this->load->model('inform/historydead_model','dead');		
		$this->template->append_metadata(js_report());
	}
	public $reference= "แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข";
	function index($no=FALSE)
	{
		// $this->db->debug=TRUE;
		 $data['reference'] = $this->reference;
		 $data['textarea'] ="ทั้งหมด";
		 $data['textprovince'] = "ทั้งหมด";
		 $data['textamphur'] = "ทั้งหมด";
		 $data['textdistrict']="ทั้งหมด";
		 $data['texthospital'] = "ทั้งหมด";
		 $data['textyear_start']="ทั้งหมด";
		 $data['textmonth_start']="ทั้งหมด";
		 $data['texttype']="ทั้งหมด";
		 $data['textgroup'] = "ทั้งหมด";
		 $type=array(1=>'จำแนกตามคนไข้ปัจจุบัน',2=>'จำแนกตามคนไข้ขาจร');			 
		 $cond ="";// ใส่ 1=1 ไม่ได้ เพราะเปิดมาตอนแรกจะคิวรีเลย
	if($no=="7"){		
		if(!empty($_GET['province'])){
		  if($_GET['province']=="all"){
		  	$cond ="1=1";
		  }else{			  				 
		  	$cond .=" AND province_id = '".$_GET['province']."'";
		  	$data['textprovince']=$this->province->get_one("province_name","province_id",$_GET['province']);
		 }
		}
			if(!empty($_GET['year_start'])){
				$cond.= " AND year(datetouch)='".$_GET['year_start']."'";
				$data['textyear_start'] = $_GET['year_start'];
			} 	
		 	
	}else{
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
				  	$cond .= " 1=1 AND hospitalprovince IN (".$provinceid.")";			  	   
				  	if($_GET['group']=='0'){$data['textgroup'] = "กทม.";
					}else{$data['textgroup'] = $_GET['group'];}	  	  
				  }else if(!empty($_GET['area'])){
				  		$cond="1=1";		  	   					 
				 		$data['textarea'] = $this->area->get_one("name","id",$_GET['area']);	  
				  }	  	
			  }	
	  		 if(!empty($_GET['amphur'])){
				  	$cond = " 1=1 AND hospitalamphur='".$_GET['amphur']."' AND hospitalprovince='".$_GET['province']."'";		
					$data['textamphur']=$this->db->GetOne("select amphur_name from n_amphur where province_id= ? and amphur_id= ? ",array($_GET['province'],$_GET['amphur']));
			  }
			  if(!empty($_GET['district'])){
			  		$cond = " 1=1 AND hospitalamphur='".$_GET['amphur']."' AND hospitalprovince='".$_GET['province']."' and hospitaldistrict='".$_GET['district']."'";
					$data['textdistrict']=$this->db->GetOne("select district_name from n_district where province_id= ? and amphur_id= ? and district_id= ? ",array($_GET['province'],$_GET['amphur'],$_GET['district']));
			  }		  
		  }
	 		  
		  if((!empty($_GET['month_start'])  && !empty($_GET['year_start']))   && (!empty($_GET['month_end']) && !empty($_GET['year_end']))){
		  	 	$cond.= " AND (month(datetouch) BETWEEN '".$_GET['month_start']."' AND '".$_GET['month_end']."') AND (year(datetouch) BETWEEN '".$_GET['year_start']."' AND '".$_GET['year_end']."')";
		 		$data['textyear_start'] = $_GET['year_start'];
				$data['textmonth_start'] = convert_month($_GET['month_start'],"longthai");
			 	$data['textyear_end'] = $_GET['year_end'];
				$data['textmonth_end'] = convert_month($_GET['month_end'],"longthai");
				//$data['date_type']="datetouch";
		  }else{
				if(!empty($_GET['year_start'])){	$cond.= " AND year(datetouch)='".$_GET['year_start']."'";	$data['textyear_start'] = $_GET['year_start'];}		  	
		  		if(!empty($_GET['month_start'])){	$cond.= " AND month(datetouch)='".$_GET['month_start']."'";  	$data['textmonth_start'] = convert_month($_GET['month_start'],"longthai");	}	
		 		//$data['date_type']="datetouch";
		  }
		    
		  if((!empty($_GET['month_report_start'])  && !empty($_GET['year_report_start']))   && (!empty($_GET['month_report_end']) && !empty($_GET['year_report_end']))){
		  	 	$cond.= " AND (month(reportdate) BETWEEN '".$_GET['month_report_start']."' AND '".$_GET['month_report_end']."') AND (year(reportdate) BETWEEN '".$_GET['year_report_start']."' AND '".$_GET['year_report_end']."')";
		 		$data['textyear_start'] = $_GET['year_report_start'];
				$data['textmonth_start'] = convert_month($_GET['month_report_start'],"longthai");
			 	$data['textyear_end'] = $_GET['year_report_end'];
				$data['textmonth_end'] = convert_month($_GET['month_report_end'],"longthai");				
		 		//$data['date_type']="reportdate";
		  }else if((!empty($_GET['month_report_start'])  && !empty($_GET['month_report_end']))   && !empty($_GET['year_report_start'])){
		  	 	$cond.= "AND year(reportdate)= '".$_GET['year_report_start']."' AND (month(reportdate) BETWEEN '".$_GET['month_report_start']."' AND '".$_GET['month_report_end']."')";
		 		$data['textyear_start'] = $_GET['year_report_start'];
				$data['textmonth_start'] = convert_month($_GET['month_report_start'],"longthai");
				$data['textmonth_end'] = convert_month($_GET['month_report_end'],"longthai");				
			  	
		  }else{
		  		if(!empty($_GET['year_report_start'])){		$cond.= " AND year(reportdate)='".$_GET['year_report_start']."'";		$data['textyear_start'] = $_GET['year_report_start'];}  
		 	 	if(!empty($_GET['month_report_start'])){	$cond.= " AND month(reportdate)='".$_GET['month_report_start']."'";  $data['textmonth_start'] = convert_month($_GET['month_report_start'],"longthai");	}	
		  		//$data['date_type']="reportdate";
		  }  
		  			  
		   if(!empty($_GET['type'])){	$cond.= " AND in_out='".$type."'";	$data['texttype'] =$type[$_GET['type']];	}											   
	}// $no==7
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
	function total_n($cond=''){
		$sql="select count(historyid) as cnt FROM n_history INNER JOIN  n_information ON historyid=information_historyid  where  ".$cond;	
		//echo $sql;
		$total_n = $this->db->GetOne($sql);
		return (empty($total_n)) ? 0 : $total_n;
				
	}
	function report1($cond= FALSE,$preview=FALSE,$data)
	{
		if($cond){
			if($cond=="1=1"){$cond1="";}else{$cond1=$cond;}
			#### 	จำนวน N ทั้งหมด  		####	
			$data['total_n'] =$this->total_n($cond);	
			####   จำนวน N จำแนกตามเพศ      ####
			$rs = array();
			$total = array(0,3,0);
			$sql="select  count(historyid) as cnt,gender  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where   ".$cond." group by gender  order by gender  asc";		    
		    //echo $sql;exit;
		    $result = $this->db->Execute($sql);
			foreach($result as $key =>$item){
				$rs[$item['gender']] = $item['cnt'];
										
			}
			for($i=0;$i<3;$i++){
				$data['total_gender'.$i] = (empty($rs[$i])) ? 0 : $rs[$i];
							
			}
			## จำนวน N จำแนกตามช่วงอายุ
			$rs = array();	
			$total= array(0,11,0);	
			$sql="select count(historyid) as cnt,age_group  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where   ".$cond." group by age_group order by age_group  asc";
		   
		    $result = $this->db->Execute($sql);						
			foreach($result as $key =>$item){
				$rs[$item['age_group']] = $item['cnt'];	
									
			}
			for($i=0;$i<11;$i++){							
				$data['total_age'.$i] = (empty($rs[$i])) ? 0:$rs[$i];	
											
			}
			## หา X,SD,MIN,MAX
			$sql="select avg(age) as avg_age,stddev(age) as stddev_age,min(age) as min_age,max(age) as max_age FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where   ".$cond;	
			$result = $this->db->GetRow($sql);
			$data['avg_age'] = $result['avg_age'];
			$data['stddev_age'] = $result['stddev_age'];
			$data['min_age'] = $result['min_age'];
			$data['max_age'] = $result['max_age'];				
			## จำนวน N จำแนกตามอาชีพขณะสัมผัสโรค
			$rs = array();
			$total = array(0,22,0);		
			$sql="select count(historyid) as cnt,occupationname  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where   ".$cond." group by occupationname order by occupationname  asc";
		    //echo $sql;exit;
		    $result = $this->db->Execute($sql);						
			foreach($result as $key =>$item){
				$rs[$item['occupationname']] = $item['cnt'];
											
			}
			for($i=0;$i<11;$i++){							
				$data['total_occupationname'.$i] = (empty($rs[$i])) ? 0:$rs[$i];
													
			}			
			## detailplacetouch
			$rs = array();
			$array = array(0,4,0);
			$total = array(0,5,$array);		
			$sql="select count(historyid) as cnt,placetouch,detailplacetouch  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where  ".$cond." group by placetouch,detailplacetouch order by placetouch,detailplacetouch  asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $key =>$item){
				$rs[$item['placetouch']][$item['detailplacetouch']] = $item['cnt'];	
									
			}
			for($i=0;$i<5;$i++){
				for($j=0;$j<4;$j++){
					$data['total_placetouch'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];					
				}																			
			}
			## bite
			
			$data['bite_blood']=0;
			$sql="select count(historyid) as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid  
				 where (head_bite_blood='1' OR face_bite_blood='1' OR neck_bite_blood='1' 
				 OR hand_bite_blood='1' OR arm_bite_blood='1' OR body_bite_blood='1' 
				 OR leg_bite_blood='1' OR feet_bite_blood='1') $cond1";
			$data['bite_blood'] = $this->db->GetOne($sql);	
			$data['bite_noblood'] =0;			
			$sql="select count(historyid) as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid  
				 where (head_bite_noblood='1' OR face_bite_noblood='1' 
				 	OR neck_bite_noblood='1' OR hand_bite_noblood='1' 
				 	OR arm_bite_noblood='1' OR body_bite_noblood='1' 
				 	OR leg_bite_noblood='1' OR feet_bite_noblood='1') $cond1";
			$data['bite_noblood'] = $this->db->GetOne($sql);
			$data['claw_blood'] =0;			
			$sql="select count(historyid) as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid  
				 where (head_claw_blood='1' OR face_claw_blood='1' OR neck_claw_blood='1' 
				 		OR hand_claw_blood='1' OR arm_claw_blood='1' OR body_claw_blood='1' 
				 		OR leg_claw_blood='1' OR feet_claw_blood='1') $cond1";
			$data['claw_blood'] = $this->db->GetOne($sql);
			
			$data['claw_noblood'] =0; 	
			$sql="select count(historyid)as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid  
				 where ( head_claw_noblood='1' OR face_claw_noblood='1' OR neck_claw_noblood='1' 
				 		OR hand_claw_noblood='1' OR arm_claw_noblood='1' OR body_claw_noblood='1' 
				 		OR leg_claw_noblood='1' OR feet_claw_noblood='1') $cond1";
			$data['claw_noblood'] = $this->db->GetOne($sql);
			
			$data['lick_blood'] =0;
			$sql="select count(historyid) FROM n_history INNER JOIN n_information ON historyid=information_historyid  
				 where (head_lick_blood='1' OR face_lick_blood='1' OR neck_lick_blood='1' OR hand_lick_blood='1' OR arm_lick_blood='1' OR body_lick_blood='1' OR leg_lick_blood='1' OR feet_lick_blood='1') $cond1";
			$data['lick_blood'] = $this->db->GetOne($sql);			

			$data['lick_noblood'] =0;
			$sql="select count(historyid) FROM n_history INNER JOIN n_information ON historyid=information_historyid  
				 where (head_lick_noblood='1' OR face_lick_noblood='1' OR neck_lick_noblood='1' 
				 OR hand_lick_noblood='1' OR arm_lick_noblood='1' OR body_lick_noblood='1' OR leg_lick_noblood='1' OR feet_lick_noblood='1') $cond1";
			$data['lick_noblood'] = $this->db->GetOne($sql);				
			
			
			## food_dangerous
			$data['total_food'] = 0;
			$sql="select count(historyid) as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid where food_dangerous='1'".$cond1;
			$data['total_food'] = $this->db->GetOne($sql);	
			
			$data['totaltouch'] = $data['lick_blood'] + $data['lick_noblood'] + $data['claw_noblood'] + $data['claw_blood'] + $data['bite_noblood'] + $data['bite_blood']+$data['total_food'];						
			## ตำแหน่งการสัมผัส
			$sql ="select  sum(head) as head,sum(face) as face,sum(neck) as neck,sum(hand) as hand,sum(arm) as arm,sum(body) as body,sum(leg) as leg,sum(feet) as feet 
				   from(
					select count(historyid) as cnt,head,face,neck,hand,arm,body,leg,feet FROM n_history INNER JOIN n_information ON historyid=information_historyid 
					where   ".$cond." group by head,face,neck,hand,arm,body,leg ,feet 
				   )a";
			$data['rs']=$this->db->GetRow($sql);
			$data['total_position'] = $data['rs']['head']+$data['rs']['face']+$data['rs']['neck']+$data['rs']['hand']
							  +$data['rs']['arm']+$data['rs']['body']+$data['rs']['leg']+$data['rs']['feet'];		

			## ชนิดสัตว์นำโรค
			$rs=array();
			$array = array_fill(0,6,0);
			$total = array_fill(0,14,$array);
			$sql="select count(historyid) as cnt,typeanimal,typeother  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where   ".$cond." group by typeanimal,typeother  order by typeanimal,typeother  asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['typeanimal']][$item['typeother']] = $item['cnt'];
				//$total1[$item['typeanimal']][$item['typeother']] = $total[$item['typeanimal']][$item['typeother']]+$item['cnt'];			
			}
			for($i=0;$i<7;$i++){
				for($j=0;$j<14;$j++){				
					$data['total_animal'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];
				}
				//$data['total_animal_all'.$i] = (empty($total[$i])) ? 0 : $total1[$i];
			}
			## จำนวน N จำแนกตามอายุของสัตว์	
			$rs=array();
			$total1=array_fill(0,7,0);
			$sql="select count(historyid) as cnt,ageanimal  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where   ".$cond." group by ageanimal  order by ageanimal  asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['ageanimal']] = $item['cnt'];
				$total1[$item['ageanimal']]	= $total1[$item['ageanimal']]+$item['cnt'];			
			}
			for($i=0;$i<8;$i++){								
				$data['total_ageanimal'.$i] = (empty($rs[$i])) ? 0:$rs[$i];				
				//$data['total_ageanimal_all'.$i] = (empty($total1[$i])) ? 0 : $total1[$i];
			}
		   ## สถานะของสัตว์
			$rs=array();
			$total1=array_fill(0,4,0);
			$sql="select count(historyid) as cnt,statusanimal  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where   ".$cond." group by statusanimal  order by statusanimal  asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['statusanimal']] = $item['cnt'];
				$total1[$item['statusanimal']]	= $total1[$item['statusanimal']]+$item['cnt'];			
			}
			for($i=0;$i<5;$i++){								
				$data['total_statusanimal'.$i] = (empty($rs[$i])) ? 0:$rs[$i];				
				//$data['total_ageanimal_all'.$i] = (empty($total1[$i])) ? 0 : $total1[$i];
			}
			## จำนวน N จำแนกตามการกักขัง
			$rs=array();
			$array=array_fill(0,3,0);			
			$total1 =array_fill(0,5,$array);				
			$sql="SELECT count(historyid) as cnt,detain,detaindate FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE  ".$cond." GROUP BY detain,detaindate ORDER BY detain,detaindate asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['detain']][$item['detaindate']] = $item['cnt'];
				//$total1[$item['detain']][$item['detaindate']] = $total1[$item['detain']][$item['detaindate']]+$item['cnt'];				
			}
			for($i=0;$i<5;$i++){
				for($j=0;$j<3;$j++){									
					$data['total_detain'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];					
					//$data['total_detain_all'.$i] = (empty($total1[$i][$j])) ? 0 : $total1[$i][$j];
				}								
			}	
			## ประวัติการฉีดวัคซีนของสัตว์
			$rs=array();
			$array=array_fill(0,3,0);			
			$total1 =array_fill(0,5,$array);				
			$sql="SELECT count(historyid) as cnt,historyvacine,historyvacine_within FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE    ".$cond." GROUP BY historyvacine,historyvacine_within ORDER BY historyvacine,historyvacine_within asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['historyvacine']][$item['historyvacine_within']] = $item['cnt'];
				//$total1[$item['historyvacine']] = $total1[$item['historyvacine']]+$item['cnt'];				
			}
			for($i=0;$i<5;$i++){
				for($j=0;$j<3;$j++){								
					$data['total_vaccinedog'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];					
					//$data['total_vaccinedog_all'.$i.$j] = (empty($total1[$i][$j])) ? 0 : $total1[$i][$j];
				}								
			}
			## การล้างแผล					
			$rs=array();								
			$sql="SELECT count(historyid) as cnt,washbefore FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE    ".$cond." GROUP BY washbefore ORDER BY washbefore asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['washbefore']] = $item['cnt'];
							
			}
			for($i=0;$i<3;$i++){												
				$data['total_wash'.$i] = (empty($rs[$i])) ? 0:$rs[$i];																					
			}
			## วิธีการล้างแผล				
			$rs=array();			
			$total1 =array_fill(0,4,0);									
			$sql="SELECT count(historyid) as cnt,washbeforedetail FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE ".$cond1." AND washbefore='2'  and  washbeforedetail<>'0'   GROUP BY washbeforedetail ORDER BY washbeforedetail asc";
		    //echo $sql;
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['washbeforedetail']] = $item['cnt'];										
			}
			for($i=0;$i<4;$i++){												
				$data['total_washdetail'.$i] = (empty($rs[$i])) ? 0:$rs[$i];																
			} 
			$data['total_washdetail_all'] = $data['total_washdetail0'] +$data['total_washdetail1'] + $data['total_washdetail2']+ $data['total_washdetail3'];  									
			
			## การใส่ยา					
			$rs=array();								
			$sql="SELECT count(historyid) as cnt,putdrug FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE    ".$cond." GROUP BY putdrug ORDER BY putdrug asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['putdrug']] = $item['cnt'];							
			}
			for($i=0;$i<3;$i++){								
				$data['total_drug'.$i] = (empty($rs[$i])) ? 0:$rs[$i];											
			}

			## ชนิดยา				
			
			$rs=array();												
			$sql="SELECT count(historyid) as cnt,putdrugdetail FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE ".$cond1." AND putdrug='2'   GROUP BY putdrugdetail ORDER BY putdrugdetail asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['putdrugdetail']] = $item['cnt'];	
									
			}
			for($i=0;$i<4;$i++){								
				$data['total_drugdetail'.$i] = (empty($rs[$i])) ? 0:$rs[$i];											
			}
			$data['total_drugdetail_all'] = $data['total_drugdetail0'] +$data['total_drugdetail1'] + $data['total_drugdetail2']+ $data['total_drugdetail3'];  									

			## ประวัติการฉีดวัคซีน			
			$rs=array();								
			$sql="SELECT count(historyid) as cnt,historyprotect,historyprotectdetail FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE   ".$cond." GROUP BY historyprotect,historyprotectdetail  ORDER BY historyprotect,historyprotectdetail  asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['historyprotect']][$item['historyprotectdetail']] = $item['cnt'];										
			}
			for($i=0;$i<3;$i++){
				for($j=0;$j<3;$j++){
					$data['total_protect'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];
				}																						
			}			
			$data['total_protect_all'] = $data['total_protect20'] +	$data['total_protect21'] + $data['total_protect22'];
			## use_rig,hrig_erig				
			$rs=array();								
			$sql="SELECT count(historyid) as cnt,use_rig,erig_hrig  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE   ".$cond." GROUP BY use_rig,erig_hrig   ORDER BY use_rig,erig_hrig   asc";
		    $result = $this->inform->get($sql);						
			foreach($result as $item){
				$rs[$item['use_rig']][$item['erig_hrig']] = $item['cnt'];										
			}
			for($i=0;$i<3;$i++){
				for($j=0;$j<3;$j++){
					 $data['total_rig'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];
					
				}																						
			}			
			$data['total_rig_all'] = $data['total_rig20'] +	$data['total_rig21'] + $data['total_rig22'];								
			##อาการหลังฉีดวัคซีน
			$rs=array();								
			$sql="SELECT count(historyid) as cnt,use_rig,erig_hrig  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE   ".$cond." GROUP BY use_rig,erig_hrig   ORDER BY use_rig,erig_hrig   asc";
		    $result = $this->inform->get($sql);						
			foreach($result as $item){
				$rs[$item['use_rig']][$item['erig_hrig']] = $item['cnt'];										
			}
			for($i=0;$i<3;$i++){
				for($j=0;$j<3;$j++){
					 $data['total_rig'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];
					
				}																						
			}			
			$data['total_rig_all'] = $data['total_rig20'] +	$data['total_rig21'] + $data['total_rig22'];			
			## after_rig
			$rs=array();								
			$sql="SELECT count(historyid) as cnt,after_rig   FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE   ".$cond." GROUP BY after_rig ORDER BY after_rig asc";
		    $result = $this->inform->get($sql);						
			foreach($result as $item){
				$rs[$item['after_rig']] = $item['cnt'];										
			}
			$data['total_afterrig_all']=0;
			for($i=0;$i<3;$i++){				
				$data['total_afterrig'.$i] = (empty($rs[$i])) ? 0:$rs[$i];
				$data['total_afterrig_all'] = $data['total_afterrig_all'] + $data['total_afterrig'.$i];																														
			}
			## อาการแพ้ rig
			$sql="select count(historyid) as cnt FROM n_history INNER JOIN  n_information ON historyid=information_historyid  
			where  $cond1 and after_rigdetail1 ='1' AND after_rig='2'";
			//echo $sql;exit;
			$data['total_detail1'] = $this->db->GetOne($sql);
			
			$sql="select count(historyid) as cnt FROM n_history INNER JOIN  n_information ON historyid=information_historyid  
			where $cond1 and after_rigdetail2 ='1' AND after_rig='2'";
			$data['total_detail2'] = $this->db->GetOne($sql);	

			$sql="select count(historyid) as cnt FROM n_history INNER JOIN  n_information ON historyid=information_historyid  
			where $cond1 and after_rigdetail3 ='1' AND after_rig='2'";
			$data['total_detail3'] = $this->db->GetOne($sql);				
			
			$sql="select count(historyid) as cnt FROM n_history INNER JOIN  n_information ON historyid=information_historyid  
			where $cond1 and after_rigdetail4 ='1' AND after_rig='2'";
			$data['total_detail4'] = $this->db->GetOne($sql);				
			
			$sql="select count(historyid) as cnt FROM n_history INNER JOIN  n_information ON historyid=information_historyid  
			where $cond1 and after_rigdetail5 ='1' AND after_rig='2'";
			$data['total_detail5'] = $this->db->GetOne($sql);	
			
			$sql="select count(historyid) as cnt FROM n_history INNER JOIN  n_information ON historyid=information_historyid  
			where $cond1 and after_rigdetail6 ='1' AND after_rig='2'";
			$data['total_detail6'] = $this->db->GetOne($sql);				
											
			$sql="select count(historyid) as cnt FROM n_history INNER JOIN  n_information ON historyid=information_historyid  
			where $cond1 and after_rigdetail7 ='1' AND after_rig='2'";
			$data['total_detail7'] = $this->db->GetOne($sql);	


			$sql="select count(historyid) as cnt FROM n_history INNER JOIN  n_information ON historyid=information_historyid  
			where  $cond1 and after_rigdetail1 !='1' AND  after_rigdetail2 !='1' AND  after_rigdetail6 !='1' AND after_rig='2'
			AND  after_rigdetail3 !='1' AND  after_rigdetail4 !='1' AND  after_rigdetail5 !='1' AND  after_rigdetail7 !='1'";			
			$data['total_detailno'] = $this->db->GetOne($sql);	
			$data['total_detail'] = $data['total_detail1']+ $data['total_detail2'] + $data['total_detail3'] 
									+$data['total_detail4'] + $data['total_detail5'] + $data['total_detail6']
									+$data['total_detail7']+$data['total_detailno'];
			
			## ชนิดยา				
			
			$rs=array();												
			$sql="SELECT count(historyid) as cnt,longfeel FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE $cond1 and  putdrug='2'  GROUP BY longfeel ORDER BY longfeel asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['longfeel']] = $item['cnt'];	
									
			}
			$data['total_longfeel']=0;
			for($i=0;$i<3;$i++){								
				$data['total_longfeel'.$i] = (empty($rs[$i])) ? 0:$rs[$i];	
				$data['total_longfeel'] = $data['total_longfeel'] +	$data['total_longfeel'.$i];								
			}
			
		}//cond				
		$data['cond'] =$cond;			
		if($preview)$this->template->set_layout('print');	
		$this->template->build("report1_index",$data);		
	}
		
	function report2($cond= FALSE,$preview=FALSE,$data)
	{		
		  if($cond){
			#### 	จำนวน N ทั้งหมด  		####	
			$data['total_n'] =$this->total_n($cond);
			####   จำนวน N แต่ละเดือน		####
			$sql="select month(datetouch) as m ,count(historyid) as cnt FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where  ".$cond." group by month(datetouch) order by month(datetouch) asc";
		    $result = $this->db->Execute($sql);
			foreach($result as $item){
				$rs[$item['m']] =$item['cnt'];
			}
			// วนลูปข้างนอก  กรณี select ไม่เจอ ก็สามารถส่งค่าไปได้
			for($i=1;$i<13;$i++){$data['total_m'.$i] = (empty($rs[$i])) ? 0 : $rs[$i];}
			
			
			####   จำนวน N จำแนกตามเพศ      ####
			$rs = array();
			$total = array_fill(0, 3, 0);	
			$sql="select month(datetouch) as m ,count(historyid) as cnt,gender  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where   ".$cond." group by month(datetouch),gender  order by month(datetouch),gender  asc";
		    $result = $this->db->Execute($sql);
			foreach($result as $key =>$item){
				$rs[$item['gender']][$item['m']] = $item['cnt'];
				$total[$item['gender']] = intval($total[$item['gender']])+intval($item['cnt']);				
			}
			// วนลูปข้างนอก  กรณี select ไม่เจอ ก็สามารถส่งค่าไปได้
			//$total=0;
			for($i=0;$i<3;$i++){
					for($j=1;$j<13;$j++){				
					$data['total_gender'.$i.$j] = (empty($rs[$i][$j])) ? 0 : $rs[$i][$j];
				}
				$data['total_gender_all'.$i] = (empty($total[$i])) ? 0 : $total[$i];
			}

			
			## จำนวน N จำแนกตามช่วงอายุ
			
			$rs = array();
			$total1 = array_fill(0, 11, 0);							
			$sql="select month(datetouch) as m ,count(historyid) as cnt,age_group  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where age<>0  ".$cond1." group by month(datetouch),age_group  order by month(datetouch),age_group  asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $key =>$item){
				$rs[$item['age_group']][$item['m']] = $item['cnt'];
				$total1[$item['age_group']]	= $total1[$item['age_group']]+$item['cnt'];			
			}
			for($i=1;$i<12;$i++){
				for($j=1;$j<13;$j++){				
					$data['total_age'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];
				}
				$data['total_age_all'.$i] = (empty($total1[$i])) ? 0 : $total1[$i];
			}
			## จำนวน N จำแนกตามสถานที่สัมผัสโรค	
			$rs=array();
			$total1=array_fill(0,8,0);
			$sql="select month(datetouch) as m ,count(historyid) as cnt,placetouch  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where   ".$cond." group by month(datetouch),placetouch  order by month(datetouch),placetouch  asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['placetouch']][$item['m']] = $item['cnt'];								
				$total1[$item['placetouch']]	= $total1[$item['placetouch']]+$item['cnt'];			
			}			
			for($i=0;$i<6;$i++){
				for($j=1;$j<13;$j++){				
					$data['total_place'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];
				}
				$data['total_place_all'.$i] = (empty($total1[$i])) ? 0 : $total1[$i];
			}
			## จำนวน N จำแนกตามชนิดสัตว์นำโรค
			$rs=array();
			$total1=array_fill(0,9,0);
			$sql="select month(datetouch) as m ,count(historyid) as cnt,typeanimal  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where   ".$cond." group by month(datetouch),typeanimal  order by month(datetouch),typeanimal  asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['typeanimal']][$item['m']] = $item['cnt'];
				$total1[$item['typeanimal']]	= $total1[$item['typeanimal']]+$item['cnt'];			
			}
			for($i=0;$i<8;$i++){
				for($j=1;$j<13;$j++){				
					$data['total_animal'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];
				}
				$data['total_animal_all'.$i] = (empty($total1[$i])) ? 0 : $total1[$i];
			}
			## จำนวน N จำแนกตามอายุของสัตว์	
			$rs=array();
			$total1=array_fill(0,7,0);
			$sql="select month(datetouch) as m ,count(historyid) as cnt,ageanimal  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where   ".$cond." group by month(datetouch),ageanimal  order by month(datetouch),ageanimal  asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['ageanimal']][$item['m']] = $item['cnt'];
				$total1[$item['ageanimal']]	= $total1[$item['ageanimal']]+$item['cnt'];			
			}
			for($i=0;$i<8;$i++){
				for($j=1;$j<13;$j++){				
					$data['total_ageanimal'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];
				}
				$data['total_ageanimal_all'.$i] = (empty($total1[$i])) ? 0 : $total1[$i];
			}			
			## จำนวน N จำแนกตามการกักขัง
			$rs=array();
			$array=array_fill(0,3,0);			
			$total1 =array_fill(0,5,$array);				
			$sql="SELECT month(datetouch) as m ,count(historyid) as cnt,detain,detaindate FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE    ".$cond." GROUP BY month(datetouch),detain,detaindate ORDER BY month(datetouch) ,detain,detaindate asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['detain']][$item['detaindate']][$item['m']] = $item['cnt'];
				$total1[$item['detain']][$item['detaindate']] = $total1[$item['detain']][$item['detaindate']]+$item['cnt'];				
			}
			for($i=0;$i<5;$i++){
				for($j=0;$j<3;$j++){
					for($k=1;$k<13;$k++){				
						$data['total_detain'.$i.$j.$k] = (empty($rs[$i][$j][$k])) ? 0:$rs[$i][$j][$k];
					}
					$data['total_detain_all'.$i.$j] = (empty($total1[$i][$j])) ? 0 : $total1[$i][$j];
				}								
			}					
		
			## ประวัติการฉีดวัคซีน
			$rs=array();
			$array=array_fill(0,3,0);			
			$total1 =array_fill(0,5,$array);				
			$sql="SELECT month(datetouch) as m ,count(historyid) as cnt,historyvacine,historyvacine_within FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE    ".$cond." GROUP BY month(datetouch),historyvacine,historyvacine_within ORDER BY month(datetouch) ,historyvacine,historyvacine_within asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['historyvacine']][$item['historyvacine_within']][$item['m']] = $item['cnt'];
				$total1[$item['historyvacine']][$item['historyvacine_within']] = $total1[$item['historyvacine']][$item['historyvacine_within']]+$item['cnt'];				
			}
			for($i=0;$i<5;$i++){
				for($j=0;$j<3;$j++){
					for($k=1;$k<13;$k++){				
						$data['total_vaccinedog'.$i.$j.$k] = (empty($rs[$i][$j][$k])) ? 0:$rs[$i][$j][$k];
					}
					$data['total_vaccinedog_all'.$i.$j] = (empty($total1[$i][$j])) ? 0 : $total1[$i][$j];
				}								
			}
			## สาเหตุถูกกัด					
			$rs=array();
			$array=array_fill(0,7,0);			
			$total1 =array_fill(0,3,$array);						
			$sql="SELECT month(datetouch) as m ,count(historyid) as cnt,reasonbite,causedetail FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE    ".$cond." GROUP BY month(datetouch),reasonbite,causedetail ORDER BY month(datetouch) ,reasonbite,causedetail asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['reasonbite']][$item['causedetail']][$item['m']] = $item['cnt'];
				$total1[$item['reasonbite']][$item['causedetail']] = $total1[$item['reasonbite']][$item['causedetail']]+$item['cnt'];				
			}
			for($i=0;$i<3;$i++){
				for($j=0;$j<7;$j++){
					for($k=1;$k<13;$k++){				
						$data['total_reason'.$i.$j.$k] = (empty($rs[$i][$j][$k])) ? 0:$rs[$i][$j][$k];
					}
					$data['total_reason_all'.$i.$j] = (empty($total1[$i][$j])) ? 0 : $total1[$i][$j];
				}								
			}			

			## การล้างแผล					
			$rs=array();
			$array=array_fill(0,5,0);			
			$total1 =array_fill(0,3,$array);						
			$sql="SELECT month(datetouch) as m ,count(historyid) as cnt,washbefore,washbeforedetail FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE    ".$cond." GROUP BY month(datetouch),washbefore,washbeforedetail ORDER BY month(datetouch) ,washbefore,washbeforedetail asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['washbefore']][$item['washbeforedetail']][$item['m']] = $item['cnt'];
				$total1[$item['washbefore']][$item['washbeforedetail']] = $total1[$item['washbefore']][$item['washbeforedetail']]+$item['cnt'];				
			}
			for($i=0;$i<3;$i++){
				for($j=0;$j<5;$j++){
					for($k=1;$k<13;$k++){				
						$data['total_wash'.$i.$j.$k] = (empty($rs[$i][$j][$k])) ? 0:$rs[$i][$j][$k];
					}
					$data['total_wash_all'.$i.$j] = (empty($total1[$i][$j])) ? 0 : $total1[$i][$j];
				}								
			}			
			## การใส่ยา					
			$rs=array();
			$array=array_fill(0,5,0);			
			$total1 =array_fill(0,3,$array);						
			$sql="SELECT month(datetouch) as m ,count(historyid) as cnt,putdrug,putdrugdetail FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE    ".$cond." GROUP BY month(datetouch),putdrug,putdrugdetail ORDER BY month(datetouch),putdrug,putdrugdetail asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['putdrug']][$item['putdrugdetail']][$item['m']] = $item['cnt'];
				$total1[$item['putdrug']][$item['putdrugdetail']] = $total1[$item['putdrug']][$item['putdrugdetail']]+$item['cnt'];				
			}
			for($i=0;$i<3;$i++){
				for($j=0;$j<5;$j++){
					for($k=1;$k<13;$k++){				
						$data['total_drug'.$i.$j.$k] = (empty($rs[$i][$j][$k])) ? 0:$rs[$i][$j][$k];
					}
					$data['total_drug_all'.$i.$j] = (empty($total1[$i][$j])) ? 0 : $total1[$i][$j];
				}								
			}
		## historyprotectdetail		
			$rs=array();
			$array=array_fill(0,5,0);			
			$total1 =array_fill(0,3,$array);						
			$sql="SELECT month(datetouch) as m ,count(historyid) as cnt,historyprotect,historyprotectdetail FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE    ".$cond." GROUP BY month(datetouch),historyprotect,historyprotectdetail ORDER BY month(datetouch),historyprotect,historyprotectdetail asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['historyprotect']][$item['historyprotectdetail']][$item['m']] = $item['cnt'];
				$total1[$item['historyprotect']][$item['historyprotectdetail']] = $total1[$item['historyprotect']][$item['historyprotectdetail']]+$item['cnt'];				
			}
			for($i=0;$i<3;$i++){
				for($j=0;$j<5;$j++){
					for($k=1;$k<13;$k++){				
						$data['total_historyprotect'.$i.$j.$k] = (empty($rs[$i][$j][$k])) ? 0:$rs[$i][$j][$k];
					}
					$data['total_historyprotect_all'.$i.$j] = (empty($total1[$i][$j])) ? 0 : $total1[$i][$j];
				}								
			}
		## สัญชาติ	
			$rs=array();		
			$total1 =array_fill(0,13,0);						
			$sql="SELECT month(datetouch) as m ,count(historyid) as cnt,nationalityname FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE    ".$cond." GROUP BY month(datetouch),nationalityname ORDER BY month(datetouch),nationalityname asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['nationalityname']][$item['m']] = $item['cnt'];
				$total1[$item['nationalityname']] = $total1[$item['nationalityname']] + $item['cnt'];				
			}	
			for($i=0;$i<13;$i++){
				for($j=1;$j<13;$j++){										
					$data['total_nationalityname'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];					
					$data['total_nationalityname_all'.$i] = (empty($total1[$i])) ? 0 : $total1[$i];
				}								
			}		
		## อาชีพขณะสัมผัสโรค
			$rs=array();		
			$total1 =array_fill(0,22,0);						
			$sql="SELECT month(datetouch) as m ,count(historyid) as cnt,occupationname FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE    ".$cond." GROUP BY month(datetouch),occupationname ORDER BY month(datetouch),occupationname asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['occupationname']][$item['m']] = $item['cnt'];
				$total1[$item['occupationname']] = $total1[$item['occupationname']] + $item['cnt'];				
			}			
			for($i=0;$i<22;$i++){
				for($j=1;$j<13;$j++){										
					$data['total_occupation'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];					
					$data['total_occupation_all'.$i] = (empty($total1[$i])) ? 0 : $total1[$i];
				}								
			}				
		## อาชีพผู้ปกครอง
			
			$rs=array();		
			$total1 =array_fill(0,22,0);										
			$sql="SELECT month(datetouch) as m ,count(historyid) as cnt,occparentsname FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  WHERE  age < '15'  ".$cond1." GROUP BY month(datetouch),occparentsname ORDER BY month(datetouch),occparentsname asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['occparentsname']][$item['m']] = $item['cnt'];
				$total1[$item['occparentsname']] = $total1[$item['occparentsname']] + $item['cnt'];				
			}			
			for($i=0;$i<22;$i++){
				for($j=1;$j<13;$j++){										
					$data['total_occparentsname'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];										
				}
				$data['total_occparentsname_all'.$i] = (empty($total1[$i])) ? 0 : $total1[$i];								
			}		
		## สถานภาพสัตว์
			$rs=array();
			$total1=array_fill(0,4,0);
			$sql="select month(datetouch) as m ,count(historyid) as cnt,statusanimal  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where   ".$cond." group by month(datetouch),statusanimal  order by month(datetouch),statusanimal  asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['statusanimal']][$item['m']] = $item['cnt'];
				$total1[$item['statusanimal']]	= $total1[$item['statusanimal']]+$item['cnt'];			
			}
			for($i=0;$i<5;$i++){
				for($j=1;$j<13;$j++){									
				$data['total_statusanimal'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];	
				}			
				$data['total_statusanimal_all'.$i] = (empty($total1[$i])) ? 0 : $total1[$i];
			}
		## การส่งหัวตรวจ
			
			$rs=array();			
			$data['total_head'] = 0;			
			$sql="select month(datetouch) as m ,count(historyid) as cnt,headanimal  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where headanimal='2'  ".$cond1." group by month(datetouch),headanimal  order by month(datetouch),headanimal  asc";
		    $result = $this->db->Execute($sql);						
			foreach($result as $item){
				$rs[$item['m']] = $item['cnt'];						
			}
			
		    for($i=1;$i<13;$i++){									
				$data['total_head'.$i] = (empty($rs[$i])) ? 0:$rs[$i];
				$data['total_head'] = $data['total_head'] + $data['total_head'.$i];
			}			
									
		## หัวสัตว์ที่ส่งตรวจพบเชื้อ			
					
			$rs=array();
			$data['total_batteria_all'] = 0;			
			$sql="select month(datetouch) as m ,count(historyid) as cnt FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where batteria='1' ".$cond1." group by month(datetouch) order by month(datetouch)  asc";
		    $result = $this->db->Execute($sql);				
			foreach($result as $item){
				$rs[$item['m']] = $item['cnt'];						
			}			
		    for($i=1;$i<13;$i++){
		    	$data['total_batteria_all'.$i]=0;									
				$data['total_batteria'.$i] = (empty($rs[$i])) ? 0:$rs[$i];
				$data['total_batteria_all'] = $data['total_batteria_all'] + $data['total_batteria'.$i];
			}
							
		## การฉีดอิมมูโนโกลบุลิน(RIG)use_rig,hrig_erig				
			$rs=array();					
			$sql="select month(datetouch) as m ,count(historyid) as cnt,erig_hrig  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where use_rig='2' ".$cond1." group by month(datetouch),erig_hrig order by month(datetouch),erig_hrig asc";
		    $result = $this->db->Execute($sql);						
			if(!empty($result)){
				foreach($result as $item){
					$rs['erig_hrig '][$item['m']] = $item['cnt'];						
				}				
			}
			for($i=0;$i<3;$i++){
				$data['total_rig_all'.$i] =0;											
			    for($j=1;$j<13;$j++){									
					$data['total_rig'.$i.$j]  = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];
					$data['total_rig_all'.$i] = $data['total_rig_all'.$i] + $data['total_rig'.$i.$j];					
				}				
			}			
					
		## อาการหลังฉีดอิมมูโนโกลบุลิน (RIG)
			$rs=array();					
			$sql="select month(datetouch) as m ,count(historyid) as cnt,after_rig  FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where use_rig='2' ".$cond1." group by month(datetouch),after_rig order by month(datetouch),after_rig   asc";
		    $result = $this->db->Execute($sql);						
			if(!empty($result)){
				foreach($result as $item){
					$rs['after_rig '][$item['m']] = $item['cnt'];						
				}				
			}
			for($i=0;$i<3;$i++){
				$data['total_afterrig_all'.$i] =0;											
			    for($j=1;$j<13;$j++){									
					$data['total_afterrig'.$i.$j]  = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];
					$data['total_afterrig_all'.$i] = $data['total_afterrig_all'.$i] + $data['total_afterrig'.$i.$j];					
				}				
			}
		## วิธีการฉีดวัคซีน
			
			$rs=array();					
			$sql="select month(datetouch) as m ,count(historyid) as cnt,means FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where means <>'0' ".$cond1." group by month(datetouch),means order by month(datetouch),means  asc";
		    $result = $this->db->Execute($sql);						
			if(!empty($result)){
				foreach($result as $item){
					$rs['means'][$item['m']] = $item['cnt'];
						
				}				
			}
			for($i=1;$i<4;$i++){
				$data['total_means_all'.$i] =0;											
			    for($j=1;$j<13;$j++){									
					$data['total_means'.$i.$j]  = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];
					$data['total_means_all'.$i] = $data['total_means_all'.$i] + $data['total_means'.$i.$j];					
				}				
			}
		## ชนิดวัคซีน(จำนวนครั้งที่ใช้) (โด๊ส)
			
			$rs=array();					
			$sql="select month(datetouch) as m ,count(historyid) as cnt,vaccine_name FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where vaccine_name <>'0' ".$cond1." group by month(datetouch),vaccine_name order by month(datetouch),vaccine_name  asc";
		    $result = $this->db->Execute($sql);						
			if(!empty($result)){
				foreach($result as $item){
					$rs['vaccine_name'][$item['m']] = $item['cnt'];						
				}				
			}
			for($i=1;$i<5;$i++){
				$data['total_vaccine_all'.$i] =0;										
			    for($j=1;$j<13;$j++){			    											
					$data['total_vaccine'.$i.$j] = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];	
					$data['total_vaccine_all'.$i] = $data['total_vaccine_all'.$i] + $data['total_vaccine'.$i.$j];				
				}				
			}
					
		## การแพ้วัคซีน
			
			$rs=array();					
			$sql="select month(datetouch) as m ,count(historyid) as cnt,after_vaccine FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				  where after_vaccine <>'0' ".$cond1." group by month(datetouch),after_vaccine order by month(datetouch),after_vaccine  asc";
		    $result = $this->db->Execute($sql);						
			if(!empty($result)){
				foreach($result as $item){
					$rs['after_vaccine'][$item['m']] = $item['cnt'];
						
				}				
			}
			for($i=1;$i<3;$i++){
				$data['total_aftervaccine_all'.$i] =0;											
			    for($j=1;$j<13;$j++){									
					$data['total_aftervaccine'.$i.$j]  = (empty($rs[$i][$j])) ? 0:$rs[$i][$j];
					$data['total_aftervaccine_all'.$i] = $data['total_aftervaccine_all'.$i] + $data['total_aftervaccine'.$i.$j];					
				}				
			}
		
		}//$cond				 
		$data['cond'] = $cond;
		if($preview){$this->template->set_layout('print');}
		$this->template->build("report2_index",$data);			
	}
	function report3($cond= FALSE,$preview=FALSE,$data){
		if($cond){
			if($cond=="1=1"){$cond1="";}else{$cond1=$cond;}	
			$whmonth[1]="  month(datetouch) IN (1,2,3)";
			$whmonth[2]="  month(datetouch) IN (4,5,6)";
			$whmonth[3]="  month(datetouch) IN (7,8,9)";
			$whmonth[4]="  month(datetouch) IN (10,11,12)";
			
			#### 	จำนวน N ทั้งหมด  		####	
			$data['total_n'] =$this->total_n($cond);
			
			####   จำนวน N แต่ละไตรมาส	####
			for($i=1;$i<5;$i++){
				$sql="select count(historyid) as cnt FROM n_history INNER JOIN  n_information ON historyid=information_historyid
				      where ".$whmonth[$i].$cond1;
		    	$data['q'.$i] = $this->db->GetOne($sql);
			}
		    ## จำแนกตามเพศ
		    $module = array('gender'=>'เพศ','age_group'=>'กลุ่มอายุ','placetouch'=>'สถานที่สัมผัสโรค'
		    			   ,'typeanimal'=>'ชนิดสัตว์นำโรค','ageanimal'=>'อายุสัตว์');	
			$data['module']     = $module;		
		    $data['gender']     = array(1=>'ชาย',2=>'หญิง',0=>'ไม่ระบุ');
			$data['age_group']  = array(1=>"ต่ำกว่า 1 ปี",2=>"1-5 ปี",3=>"6-10 ปี",4=>"11-15 ปี",5=>"16-25 ปี",6=>"26-35 ปี",7=>"36-45 ปี",8=>"46-55 ปี",9=>"56-65ปี",10=>"65 ปีขึ้นไป",0=>'ไม่ระบุ');
			$data['placetouch'] = array(1=>"เขต กทม.",2=>"เขตเมืองพัทยา",3=>"เขตเทศบาล",4=>"เขตอบต.",0=>"ไม่ระบุ");
			$data['typeanimal'] = array(1=>'สุนัข',2=>'แมว',3=>'ลิง',4=>'ชะนี',5=>'หนู',6=>'อื่นๆ',7=>'ไม่ระบุ');
			$data['ageanimal']  = array(1=>"น้อยกว่า 3 เดือน ",2=>"3 - 6 เดือน ",3=>"6 - 12 เดือน ",4=>"มากกว่า 1 ปี ",5=>"ไม่ทราบ",6=>"ไม่ระบุ");
			foreach($module as $field =>$name)
			{	$quarter = array();						
				for($i=1;$i<5;$i++){
					$sql="select count(historyid) as cnt,$field FROM n_history INNER JOIN  n_information ON historyid=information_historyid
					  	where ".$whmonth[$i].$cond1." group by $field order by $field asc";		 
					$result = $this->db->Execute($sql);
					foreach($result as $item){
						$quarter[$item[$field]][$i] = $item['cnt'];
					}				
				}
				$num =count($data[$field]);
				for($i=0;$i<$num;$i++){
					$data[$field.$i]=0;
					for($j=0;$j<5;$j++){
						$data[$field.$i.$j] = (empty($quarter[$i][$j])) ? 0: $quarter[$i][$j];
						$data[$field.$i]    = $data[$field.$i] +  $data[$field.$i.$j];
					}
				}
			}//endforeach;
		}//$cond
		$data['cond'] = $cond;
								
		if($preview)$this->template->set_layout('print');	
		$this->template->build("report3_index",$data);			
	}
	function report4($cond= FALSE,$preview=FALSE,$data)
	{   
		if($cond){
			if($cond=="1=1"){$cond1="";}else{$cond1=$cond;}	
			$total=0;$total1[1]=0;$total1[2]=0;$total2[1]=0;$total2[2]=0;$total3[1]=0;$total3[2]=0;
			## รายงานประวัติการฉีดวัคซีนคนไข้ (คน) ( N = 0
			$sql="SELECT in_out,count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid  WHERE in_out<>'0' ".$cond1." GROUP BY  in_out  ORDER BY in_out asc";
			$result=$this->inform->get($sql);	
			foreach($result as $item){
				$in_out[$item['in_out']]=$item['cnt'];
				$total=$total+$item['cnt'];
			}
			 $data['in_out1'] = (empty($in_out[1])) ? 0 : $in_out[1];
			 $data['in_out2'] = (empty($in_out[2])) ? 0 : $in_out[2];	
			 $data['total'] = (empty($total)) ?  0 : $total;			 
			 #สัญชาติ (คน)
			$sql="select nationalityname,count(historyid) as cnt,in_out from n_history INNER JOIN n_information on historyid=information_historyid   WHERE nationalityname!='0' ".$cond1." 
				  GROUP BY nationalityname,in_out ORDER BY nationalityname,in_out  asc";			
			$result=$this->inform->get($sql);	
			foreach($result as $item){
				$in_out1[$item['in_out']][$item['nationalityname']]=$item['cnt'];
				$total1[$item['in_out']]=$total1[$item['in_out']]+$item['cnt'];
			}
			 $data['in_out3']=(empty($in_out1[1][1])) ? 0 : $in_out1[1][1];
			 $data['in_out4']=(empty($in_out1[1][2])) ? 0 : $in_out1[1][2];
			 $data['in_out5']=(empty($in_out1[1][3])) ? 0 : $in_out1[1][3];
			 $data['in_out6']=(empty($in_out1[1][4])) ? 0 : $in_out1[1][4];
			 $data['in_out7']=(empty($in_out1[1][5])) ? 0 : $in_out1[1][5];
			 $data['in_out8']=(empty($in_out1[1][6])) ? 0 : $in_out1[1][6];
			 $data['in_out9']=(empty($in_out1[1][7])) ? 0 : $in_out1[1][7];
			 $data['in_out10']=(empty($in_out1[1][8])) ? 0: $in_out1[1][8];
	 		 $data['in_out11']=(empty($in_out1[1][9])) ? 0: $in_out1[1][9];	
			 $data['in_out12']=(empty($in_out1[1][10])) ? 0: $in_out1[1][10];
	 		 $data['in_out13']=(empty($in_out1[1][11])) ? 0: $in_out1[1][11];	
			 
			 $data['in_out14']=(empty($in_out1[2][1])) ? 0 : $in_out1[2][1];
			 $data['in_out15']=(empty($in_out1[2][2])) ? 0 : $in_out1[2][2];
			 $data['in_out16']=(empty($in_out1[2][3])) ? 0 : $in_out1[2][3];
			 $data['in_out17']=(empty($in_out1[2][4])) ? 0 : $in_out1[2][4];
			 $data['in_out18']=(empty($in_out1[2][5])) ? 0 : $in_out1[2][5];
			 $data['in_out19']=(empty($in_out1[2][6])) ? 0 : $in_out1[2][6];
			 $data['in_out20']=(empty($in_out1[2][7])) ? 0 : $in_out1[2][7];
			 $data['in_out21']=(empty($in_out1[2][8])) ? 0: $in_out1[2][8];
	 		 $data['in_out22']=(empty($in_out1[2][9])) ? 0: $in_out1[2][9];	
			 $data['in_out23']=(empty($in_out1[2][10])) ? 0: $in_out1[2][10];
	 		 $data['in_out24']=(empty($in_out1[2][11])) ? 0: $in_out1[2][11];	
	 		  		  		  		 		
			 $data['total1'] =(empty($total1[1])) ? 0 : $total1[1];
			 $data['total2'] =(empty($total1[2])) ? 0 : $total1[2];			
			
			## erig,hrig
			$total1[1]=0;$total1[2]=0;$total2[1]=0;$total2[2]=0;$total3[1]=0;$total3[2]=0;
			$sql="SELECT erig_hrig,count(id) as cnt,in_out FROM n_history INNER JOIN n_information  on historyid=information_historyid  WHERE erig_hrig<>'0' ".$cond1." GROUP BY erig_hrig,in_out order by erig_hrig,in_out asc";
			$result=$this->inform->get($sql);	
			foreach($result as $item){
				$in_out2[$item['in_out']][$item['erig_hrig']]=$item['cnt'];
				$total2[$item['in_out']]=$total2[$item['in_out']]+$item['cnt'];
			}
	
			 $data['in_out25'] =(empty($in_out2[1][1])) ? 0 : $in_out2[1][1];	 
			 $data['in_out26'] =(empty($in_out2[2][1])) ? 0 : $in_out2[2][1];			
			 $data['in_out27'] =(empty($in_out2[1][2])) ? 0 : $in_out2[1][2];	 
			 $data['in_out28'] =(empty($in_out2[2][2])) ? 0 : $in_out2[2][2];		 
	
			 $data['total3'] =(empty($total2[1])) ? 0 : $total2[1];
			 $data['total4'] =(empty($total2[2])) ? 0 : $total2[2];			 
			 ## vaccine_name
			 $total1[1]=0;$total1[2]=0;$total2[1]=0;$total2[2]=0;$total3[1]=0;$total3[2]=0;
			 $sql="SELECT  vaccine_name,count(id) as cnt,in_out FROM n_history INNER JOIN n_information   on historyid=information_historyid  INNER JOIN n_vaccine ON n_information.id=information_id
				   WHERE vaccine_name<>'0' ".$cond1." GROUP BY vaccine_name,in_out order by vaccine_name,in_out asc";	
			$result=$this->inform->get($sql);	
			foreach($result as $item){
				$in_out3[$item['in_out']][$item['vaccine_name']]=$item['cnt'];
				$total3[$item['in_out']]=$total3[$item['in_out']]+$item['cnt'];
			}
	 
			 $data['in_out29'] =(empty($in_out3[1][1])) ? 0 : $in_out3[1][1];	 
			 $data['in_out30'] =(empty($in_out3[2][1])) ? 0 : $in_out3[2][1];			
			 $data['in_out31'] =(empty($in_out3[1][2])) ? 0 : $in_out3[1][2];	 
			 $data['in_out32'] =(empty($in_out3[2][2])) ? 0 : $in_out3[2][2];		 
			 $data['in_out33'] =(empty($in_out3[1][3])) ? 0 : $in_out3[1][3];	 
			 $data['in_out34'] =(empty($in_out3[2][3])) ? 0 : $in_out3[2][3];			
			 $data['in_out35'] =(empty($in_out3[1][4])) ? 0 : $in_out3[1][4];	 
			 $data['in_out36'] =(empty($in_out3[2][4])) ? 0 : $in_out3[2][4];			
			 $data['total5'] =(empty($total3[1])) ? 0 : $total3[1];
			 $data['total6'] =(empty($total3[2])) ? 0 : $total3[2];	
		}//$cond
		
		$data['cond']=$cond;
		if($preview)$this->template->set_layout('print');	
		$this->template->build("report4_index",$data);		
	}
	function report5($cond= FALSE,$preview=FALSE,$data)
	{	
		if($cond)
		{ //$this->db->debug=true;
			##total_n
			$data['total_n'] = $this->total_n($cond);			 
			$total=0;$total1=0;$total2=0;$total3=0;$total4=0;$total5=0;$total6=0;
			## ไม่เคยฉีดวัคซีน หรือเคยฉีดน้อยกว่า 3 เข็ม
			if($cond=="1=1"){$cond1="";}else{$cond1=$cond;}	
			if($cond1!=""){$cond1=$cond1." and ";}		
			$sql="SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid INNER JOIN n_vaccine ON n_information.id=information_id 
				  WHERE $cond1  historyprotect=1";		
			$data['total']=$this->db->GetOne($sql);
	
			## --  ภายใน 6 เดือน			
			$sql="SELECT count(historyid) as cnt,total_vaccine FROM n_history INNER JOIN n_information ON historyid=information_historyid INNER JOIN n_vaccine ON n_information.id=information_id 
				  WHERE $cond1 historyprotectdetail=1  and total_vaccine<>0  group by total_vaccine ORDER BY total_vaccine ASC";
			$result=$this->inform->get($sql);	
			foreach($result as $item){
				$vaccine2[$item['total_vaccine']]=$item['cnt'];
				$total2=$total2+$item['cnt'];
			}
			 $data['v6'] = (empty($vaccine2[1])) ? 0:$vaccine2[1];
			 $data['v7'] = (empty($vaccine2[2])) ? 0:$vaccine2[2];
			 $data['v8'] = (empty($vaccine2[3])) ? 0:$vaccine2[3];
			 $data['v9'] = (empty($vaccine2[4])) ? 0:$vaccine2[4];
			 $data['v10']= (empty($vaccine2[5])) ? 0:$vaccine2[5];
			 $data['total2']=$total2;	 		
			## เกิน 6 เดือน
			
			$sql="SELECT count(historyid) as cnt,total_vaccine FROM n_history INNER JOIN n_information ON historyid=information_historyid INNER JOIN n_vaccine ON n_information.id=information_id 
			      WHERE $cond1  historyprotectdetail=2  and total_vaccine<>0       
			      group by total_vaccine ORDER BY total_vaccine ASC";
			$result=$this->inform->get($sql);	
			foreach($result as $item){
				$vaccine3[$item['total_vaccine']]=$item['cnt'];
				$total3=$total3+$item['cnt'];
			}	
			 $data['v11']=(empty($vaccine3[1])) ? 0:$vaccine3[1];
			 $data['v12']=(empty($vaccine3[2])) ? 0:$vaccine3[2];
			 $data['v13']=(empty($vaccine3[3])) ? 0:$vaccine3[3];
			 $data['v14']=(empty($vaccine3[4])) ? 0:$vaccine3[4];
			 $data['v15']=(empty($vaccine3[5])) ? 0:$vaccine3[5];
			 $data['total3']=$total3;	 	
			## ไม่ตายภายใน 10 วัน
			
			$sql="SELECT count(historyid) as cnt,total_vaccine FROM n_history INNER JOIN n_information ON historyid=information_historyid INNER JOIN n_vaccine ON n_information.id=information_id 
			      WHERE $cond1  detaindate=2  and total_vaccine<>0  GROUP BY total_vaccine ORDER BY total_vaccine ASC";
			$result=$this->inform->get($sql);	
			foreach($result as $item){
				$vaccine4[$item['total_vaccine']]=$item['cnt'];
				$total4=$total4+$item['cnt'];
			}
			 $data['v16']=(empty($vaccine4[1])) ? 0:$vaccine4[1];
			 $data['v17']=(empty($vaccine4[2])) ? 0:$vaccine4[2];
			 $data['v18']=(empty($vaccine4[3])) ? 0:$vaccine4[3];
			 $data['v19']=(empty($vaccine4[4])) ? 0:$vaccine4[4];
			 $data['v20']=(empty($vaccine4[5])) ? 0:$vaccine4[5];
			 $data['total4']=$total4;			
			## ฉีดวัคซีนไม่ครบ
			
			$sql="SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid INNER JOIN n_vaccine ON n_information.id=information_id 	
				  WHERE $cond1 closecase_reason_detail2=1  and total_vaccine<>0";
			$total5=$this->db->GetOne($sql);	
			$data['total5'] = (empty($total5)) ? 0:$total5;	
			## จำนวนเข็มของแต่ละชนิด
			$sql="SELECT vaccine_name, count(historyid) as cnt 
				 FROM n_history INNER JOIN n_information ON historyid=information_historyid INNER JOIN n_vaccine ON n_information.id=information_id 
				  WHERE  $cond1 (vaccine_name !='0')  and total_vaccine<>'0' AND vaccine_date<>'' group by vaccine_name  order by vaccine_name asc";						
			//echo $sql;
			$result=$this->inform->get($sql);	
			foreach($result as $item){
				$vaccine6[$item['vaccine_name']]=$item['cnt'];
				$total6=$total6+$item['cnt'];
			}
			 $data['v21']=(empty($vaccine6[1])) ? 0:$vaccine6[1];
			 $data['v22']=(empty($vaccine6[2])) ? 0:$vaccine6[2];
			 $data['v23']=(empty($vaccine6[3])) ? 0:$vaccine6[3];
			 $data['v24']=(empty($vaccine6[4])) ? 0:$vaccine6[4];
			 $data['total6']=$total6;	
		  
		  
		}//$cond	
		$data['cond']=$cond;
		if($preview)$this->template->set_layout('print');			
		$this->template->build("report5_index",$data);			
	}
	function report6($cond= FALSE,$preview=FALSE,$data)
	{
		if($cond=="1=1"){$cond1="";}else{$cond1=$cond;}									 
		$sql="SELECT n_amphur.amphur_name as amphur_name,a.province_name,cnt1,in_out1,cnt2,in_out2,n_amphur.amphur_id as amphur_id 
			  from n_amphur 
			  LEFT JOIN( 
						SELECT amphur_id,amphur_name,province_name,n_province.province_id as province_id,count(historyid) as cnt1,in_out  as in_out1
						FROM n_province LEFT JOIN n_amphur on n_province.province_id = n_amphur.province_id 
						LEFT JOIN n_information on n_amphur.amphur_id = hospitalamphur and n_amphur.province_id=hospitalprovince 
						INNER JOIN n_history on historyid = information_historyid 
						WHERE $cond1 and in_out=1  ) a ON n_amphur.amphur_id=a.amphur_id and n_amphur.province_id=a.province_id 
			  LEFT JOIN (
			  			SELECT amphur_id,amphur_name,province_name,n_province.province_id as province_id,count(historyid) as cnt2,in_out  as in_out2
						FROM n_province LEFT JOIN n_amphur on n_province.province_id = n_amphur.province_id 
						LEFT JOIN n_information on n_amphur.amphur_id = hospitalamphur and n_amphur.province_id=hospitalprovince 
						INNER JOIN n_history on historyid = information_historyid 
						WHERE $cond1 and in_out=2 )b on n_amphur.amphur_id=b.amphur_id and n_amphur.province_id=b.province_id 
			WHERE n_amphur.province_id=".@$data['province_id']." ORDER BY n_amphur.amphur_id,in_out1,in_out2";		
		//echo $sql;exit;
		if($cond1){
			$data['result']=$this->inform->get($sql);				
		}
		$data['cond'] = $cond;
		if($preview){$this->template->set_layout('print');}	
		$this->template->build("report6_index",$data);			
	}
	function report7($cond= FALSE,$preview=FALSE,$data){
			
		$data['result']=$this->dead->select("n_historydead.*,province_name,amphur_name,district_name")->join("LEFT JOIN n_province ON n_province.province_id =provinceid
										   LEFT JOIN n_amphur ON  n_province.province_id = n_amphur.province_id and amphur_id=amphurid
										   LEFT JOIN n_district ON n_district.district_id =districtid 
										   and n_district.province_id = n_province.province_id
										   and n_district.amphur_id = n_amphur.amphur_id")
										   ->where("$cond")->get();	
		if($preview) $this->template->set_layout('print');
		$this->template->build('report7_index',$data);
	}			
	function report8($cond= FALSE,$preview=FALSE,$data){
	## ข้อมูลการฉีดวัคซีนและอิมมูโนโกลบูลิน
		if($cond=="1=1"){$cond1="";}else{$cond1=$cond;}
		if($cond){			
			#ฉีดวัคซีนครบชุด
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid   WHERE  means='2' and total_vaccine>'3'  ".$cond1."";	
			$data['total1'] = $this->db->GetOne($sql);
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid   WHERE   means='1' and total_vaccine='5'  ".$cond1."";	
			$data['total2'] = $this->db->GetOne($sql);	

			#ฉีดต่ำกว่า 4-5 เข็ม
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid   WHERE  means='2' and closecase_reason_detail1='1' and total_vaccine<'4' ".$cond1."";	
			$data['total3'] = $this->db->GetOne($sql);
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid   WHERE  means='1' and closecase_reason_detail1='1' and total_vaccine<'5' ".$cond1."";	
			$data['total4'] = $this->db->GetOne($sql);	

			## ฉีดวัคซีนไม่ครบชุด
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid   WHERE  means='2' and closecase_reason_detail1 <>'1' and total_vaccine<'4' ".$cond1."";	
			$data['total5'] = $this->db->GetOne($sql);
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid   WHERE  means='1' and closecase_reason_detail1 <>'1' and total_vaccine<'5' ".$cond1."";	
			$data['total6'] = $this->db->GetOne($sql);	
			
			##ฉีดวัคซีนรวม
			$data['total7'] = $data['total1'] + $data['total3'] + $data['total5']; 	
			$data['total8'] = $data['total2'] + $data['total4'] + $data['total6'];				
			## ไม่ฉีดวัคซีน		
			$sql="SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid  WHERE means='3'".$cond1."";
			$data['total9']=$this->db->GetOne($sql);	
			## ฉีด rig
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid  WHERE use_rig='2' ".$cond1."";	
			$data['total10']=$this->db->GetOne($sql);									
		}
			$data['cond'] = $cond;
			if($preview) $this->template->set_layout('print');				
			$this->template->build("report8_index",$data);			
	}
	function schedule($preview=FALSE,$popup=FALSE)
	{ ## ต้องมาแก้ ให้  n_vaccine.hospital_id=n_hospital_1.hospital_id ##
	  ## vaccine_date เปลี่ยน พ.ศ. เป็น ค.ศ. โดยเริ่มจากวันที่เริ่มเปิดให้เทสโปรแกรมใหม่ 		
		$today=date('Y-m-d');
		$nextday=date("Y-m-d",strtotime("+3 days",strtotime(date ("Y-m-d"))));			
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
		if($preview){$this->template->set_layout('print');}
		$this->template->build('report_schedule',$data);
	}




	
}
?>