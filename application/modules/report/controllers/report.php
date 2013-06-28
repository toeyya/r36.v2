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
					
					if($_GET['group']=='0'){$data['textgroup'] = "กทม.";
					}else{$data['textgroup'] = "เขต ".$_GET['group'];}
		  }		  
		  if((!empty($_GET['month_start'])  && !empty($_GET['year_start']))   && (!empty($_GET['month_end']) && !empty($_GET['year_end']))){
		  	 	$cond.= " AND (month(datetouch) BETWEEN '".$_GET['month_start']."' AND '".$_GET['month_end']."') AND (year(datetouch) BETWEEN '".$_GET['year_start']."' AND '".$_GET['year_end']."')";
		 		$data['textyear_start'] = $_GET['year_start'];
				$data['textmonth_start'] = convert_month($_GET['month_start'],"longthai");
			 	$data['textyear_end'] = $_GET['year_end'];
				$data['textmonth_end'] = convert_month($_GET['month_end'],"longthai");
		  }else{
				if(!empty($_GET['year_start'])){					$cond.= " AND year(datetouch)='".$_GET['year_start']."'";	$data['textyear_start'] = $_GET['year_start'];}		  	
		  		if(!empty($_GET['month_start'])){				$cond.= " AND month(datetouch)='".$_GET['month_start']."'";  	$data['textmonth_start'] = convert_month($_GET['month_start'],"longthai");	}	
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
				case "7":$this->report7($cond,$preview,$data);break;
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
	function report4($cond= FALSE,$preview=FALSE,$data)
	{
		if($cond){	
			$total=0;$total1[1]=0;$total1[2]=0;$total2[1]=0;$total2[2]=0;$total3[1]=0;$total3[2]=0;
			## รายงานประวัติการฉีดวัคซีนคนไข้ (คน) ( N = 0
			$sql="SELECT in_out,count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid  WHERE in_out<>'0' ".$cond." GROUP BY  in_out  ORDER BY in_out asc";
			$result=$this->inform->get($sql);	
			foreach($result as $item){
				$in_out[$item['in_out']]=$item['cnt'];
				$total=$total+$item['cnt'];
			}
			 $data['in_out1'] = (empty($in_out[1])) ? 0 : $in_out[1];
			 $data['in_out2'] = (empty($in_out[2])) ? 0 : $in_out[2];	
			 $data['total'] = (empty($total)) ?  0 : $total;			 
			 #สัญชาติ (คน)
			$sql="select nationalityname,count(historyid) as cnt,in_out from n_history INNER JOIN n_information on historyid=information_historyid   WHERE nationalityname!='0' ".$cond." GROUP BY nationalityname,in_out ORDER BY nationalityname,in_out  asc";
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
			$sql="SELECT erig_hrig,count(id) as cnt,in_out FROM n_history INNER JOIN n_information  on historyid=information_historyid  WHERE erig_hrig<>'0' ".$cond." GROUP BY erig_hrig,in_out order by erig_hrig,in_out asc";
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
			 $sql="SELECT  vaccine_name,count(id) as cnt,in_out FROM n_history INNER JOIN n_information   on historyid=information_historyid  INNER JOIN n_vaccine ON n_information.id=information_id
						WHERE vaccine_name<>'0' ".$cond." GROUP BY vaccine_name,in_out order by vaccine_name,in_out asc";	
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
		
		if($preview)$this->template->set_layout('print');	
		$this->template->build("report4_index",$data);		
	}
	function report5($cond= FALSE,$preview=FALSE,$data)
	{		
		if($cond){		 
		$total=0;$total1=0;$total2=0;$total3=0;$total4=0;$total5=0;$total6=0;
		## ไม่เคยฉีดวัคซีน หรือเคยฉีดน้อยกว่า 3 เข็ม
		$sql="SELECT count(historyid) as cnt,total_vaccine FROM n_history INNER JOIN n_information ON historyid=information_historyid INNER JOIN n_vaccine ON n_information.id=information_id WHERE historyprotect=1 ".$cond."";
		$data['total']=$this->db->GetOne($sql);

		## --  ภายใน 6 เดือน
		$sql="SELECT count(historyid) as cnt,total_vaccine FROM n_history INNER JOIN n_information ON historyid=information_historyid INNER JOIN n_vaccine ON n_information.id=information_id WHERE historyprotectdetail=1  and total_vaccine<>0 ".$cond." group by total_vaccine ORDER BY total_vaccine ASC";
		$result=$this->inform->get($sql);	
		foreach($result as $item){
			$vaccine2[$item['total_vaccine']]=$item['cnt'];
			$total2=$total2+$item['cnt'];
		}
		 $data['v6']=(empty($vaccine2[1])) ? 0:$vaccine2[1];
		 $data['v7']=(empty($vaccine2[2])) ? 0:$vaccine2[2];
		 $data['v8']=(empty($vaccine2[3])) ? 0:$vaccine2[3];
		 $data['v9']=(empty($vaccine2[4])) ? 0:$vaccine2[4];
		 $data['v10']=(empty($vaccine2[5])) ? 0:$vaccine2[5];
		 $data['total2']=$total2;	 		
		## เกิน 6 เดือน
		$sql="SELECT count(historyid) as cnt,total_vaccine FROM n_history INNER JOIN n_information ON historyid=information_historyid INNER JOIN n_vaccine ON n_information.id=information_id WHERE historyprotectdetail=2  and total_vaccine<>0  ".$cond." group by total_vaccine ORDER BY total_vaccine ASC";
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
		$sql="SELECT count(historyid) as cnt,total_vaccine FROM n_history INNER JOIN n_information ON historyid=information_historyid INNER JOIN n_vaccine ON n_information.id=information_id WHERE  detaindate=2  and total_vaccine<>0 ".$cond." 	GROUP BY total_vaccine ORDER BY total_vaccine ASC";
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
		$sql="SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid INNER JOIN n_vaccine ON n_information.id=information_id 	WHERE  closecase_reason_detail2=1  and total_vaccine<>0 "	;
		$total5=$this->db->GetOne($sql);	
		$data['total5'] = (empty($total5)) ? 0:$total5;	
		## จำนวนเข็มของแต่ละชนิด
		$sql="SELECT vaccine_name, count(historyid) as cnt FROM n_history INNER JOIN n_information ON historyid=information_historyid INNER JOIN n_vaccine ON n_information.id=information_id WHERE (vaccine_name !='0')  and total_vaccine<>'0' AND vaccine_date<>''".$cond."  group by vaccine_name  order by vaccine_name asc";						
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
		  
		 $data['cond']=$cond; 
		}//$cond	

		if($preview)$this->template->set_layout('print');			
		$this->template->build("report5_index",$data);			
	}
	function report6($cond= FALSE,$preview=FALSE,$data){					
		$sql="SELECT n_amphur.amphur_name as amphur_name,province_name,cnt,in_out,n_amphur.amphur_id as amphur_id from n_amphur
			 	   LEFT JOIN(
						SELECT amphur_id,amphur_name,province_name,n_province.province_id as province_id,count(historyid) as cnt,in_out
						FROM n_province
						LEFT JOIN n_amphur 			on n_province.province_id = n_amphur.province_id 
						LEFT JOIN n_information 	on n_amphur.amphur_id = hospitalamphur and n_amphur.province_id=hospitalprovince 
						INNER JOIN n_history 			on historyid = information_historyid
						WHERE n_amphur.province_id=66
						GROUP BY in_out) a on n_amphur.amphur_id=a.amphur_id and n_amphur.province_id=a.province_id 
			 WHERE n_amphur.province_id =66
			 ORDER BY  n_amphur.amphur_id,in_out";		
		if($cond){
			$data['result']=$this->inform->get($sql);				
		}
		$data['cond'] = $cond;
		if($preview){$this->template->set_layout('print');}	
		$this->template->build("report6_index",$data);			
	}
	function report7($part=FALSE,$preview=FALSE){
		$sql="";	
		if($preview) $this->template->set_layout('print');
		$this->template->build('report7_index',$data);
	}			
	function report8($cond= FALSE,$preview=FALSE){
	## ข้อมูลการฉีดวัคซีนและอิมมูโนโกลบูลิน
		
		if($cond){			
			#ฉีดวัคซีนครบชุด
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid   WHERE  means='2' and total_vaccine>'3'  ".$cond."";	
			$data['total1'] = $this->db->GetOne($sql);
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid   WHERE   means='1' and total_vaccine='5'  ".$cond."";	
			$data['total2'] = $this->db->GetOne($sql);	

			#ฉีดต่ำกว่า 4-5 เข็ม
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid   WHERE  means='2' and closecase_reason_detail1='1' and total_vaccine<'4' ".$cond."";	
			$data['total3'] = $this->db->GetOne($sql);
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid   WHERE  means='1' and closecase_reason_detail1='1' and total_vaccine<'5' ".$cond."";	
			$data['total4'] = $this->db->GetOne($sql);	

			## ฉีดวัคซีนไม่ครบชุด
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid   WHERE  means='2' and closecase_reason_detail1 <>'1' and total_vaccine<'4' ".$cond."";	
			$data['total5'] = $this->db->GetOne($sql);
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid   WHERE  means='1' and closecase_reason_detail1 <>'1' and total_vaccine<'5' ".$cond."";	
			$data['total6'] = $this->db->GetOne($sql);	
			
			##ฉีดวัคซีนรวม
			$data['total7'] = $data['total1'] + $data['total3'] + $data['total5']; 	
			$data['total8'] = $data['total2'] + $data['total4'] + $data['total6'];				
			## ไม่ฉีดวัคซีน		
			$sql="SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid  WHERE means='3'".$cond."";
			$data['total9']=$this->db->GetOne($sql);	
			## ฉีด rig
			$sql = " SELECT count(historyid) as cnt FROM n_history INNER JOIN n_information on historyid=information_historyid  WHERE use_rig='2' ".$cond."";	
			$data['total10']=$this->db->GetOne($sql);									
		}
			$data['cond'] = $cond;
			if($preview) $this->template->set_layout('print');				
			$this->template->build("report8_index",$data);			
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




	
}
?>