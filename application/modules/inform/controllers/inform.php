<?php
class Inform extends R36_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('inform_model','inform');
		$this->load->model('historydead_model','dead');
		$this->load->model('hospital/hospital_model','hospital');
		$this->load->model('occupation_model','occu');
		$this->load->model('vaccine_model','vaccine');
		$this->load->model("history_model",'history');
		$this->load->model('users/user_model','user');
		$this->load->model('document/document_detail_model','detail');
		$this->template->append_metadata(js_idcard());							
	}
	function closecase_person($idcard,$chk=FALSE){
		if($chk){
			
		$sql="SELECT count(id) as cnt FROM n_information 
			  LEFT JOIN n_history ON historyid=information_historyid 
			  WHERE closecase=1 and idcard='".$idcard."'";	
			$result = $this->db->GetOne($sql);	
			$data['chk']=($result) ?"yes":"no";
			$data['idcard'] = $idcard;	
			echo json_encode($data);
			return true;		
		}else{
			$sql="SELECT id,hn,idcard,hn_no,firstname,surname,information_historyid,CONVERT(VARCHAR(10), datetouch, 120) AS [datetouch] FROM n_information 
				  LEFT JOIN n_history ON historyid=information_historyid 
				  WHERE closecase=1 and idcard='".$idcard."' order by n_information.datetouch asc";	
			$data['result'] =$this->inform->get($sql);				 				
		}	
		$data['pagination']=$this->inform->pagination();

		$this->template->build('view_closecase_person',$data);

		
	}
	function DateDiff()
	{
		$date = date_create(date('Y-m-d'));
		date_sub($date,date_interval_create_from_date_string("90 days"));
		$dd = date_format($date,"Y-m-d");
		return $dd;
	}
	function closecase($chk=FALSE)
	{	//เอาที่วันปัจจุบัน ลบ ออกไปเก้าสิบวัน แล้ว  แล้วแปลงเป็นวันที่ เพื่อนหาค่าวันที่น้อยกว่าวันดังกล่าว
		$hospitalcode =	$this->session->userdata('R36_HOSPITAL');
		//$hospitalcode ="80090005";
		$year = date('y')+543;	
		$dd = $this->DateDiff();
		$data['chk']="no";	
		if($this->session->userdata('R36_LEVEL')=="05" ){
			if($chk)
			{													
				$sql="select count(id) as cnt  from n_information 
					inner join n_history on n_information.information_historyid=n_history.historyid
					inner join n_vaccine on n_information.id=n_vaccine.information_id
					where  hospitalcode = $hospitalcode and  vaccine_date <='$dd' and closecase=1
					group by id";					 									 	
				$result = $this->db->GetOne($sql);				
				$data['chk']=($result) ?"yes":"no";	
				echo json_encode($data);
				return true;				
			}else{
				$sql = "select id,hn,idcard,hn_no,firstname,surname,information_historyid,CONVERT(VARCHAR(10), datetouch, 120) AS [datetouch],total_vaccine   from n_information 
					inner join n_history on n_information.information_historyid=n_history.historyid
					inner join n_vaccine on n_information.id=n_vaccine.information_id
					where  hospitalcode = $hospitalcode and  vaccine_date <='$dd' and closecase=1
					group by id";
				$result= $this->db->Execute($sql);
				$data['result'] =dbConvert($result);
				
				
			}			
		}
					
		$data['pagination']=$this->inform->pagination();
		//$this->template->set_layout('blank');
		$this->template->build('view_closecase',$data);
	}
	function index()
	{	//$this->db->debug=true;
		if(!empty($_GET['action']))
		{//กดค้นหา												
				$where ="";
				if(!empty($_GET['name'])) $where.=" and firstname like'%".$_GET['name']."%'";
				if(!empty($_GET['surname'])) $where.=" and surname like '%".$_GET['surname']."%'";
				if(!empty($_GET['hospitalcode'])) $where.=" and hospitalcode ='".$_GET['hospitalcode']."'";
				if(@$_GET['statusid']=="1"){
					$_GET['idcard']=$_GET['cardW0'].$_GET['cardW1'].$_GET['cardW2'].$_GET['cardW3'].$_GET['cardW4'];
				}
				if(!empty($_GET['hn']) && !empty($_GET['idcard']))	{
					$where.=" AND hn='".$_GET['hn']."' AND idcard='".$_GET['idcard']."'";
				}else{
					if(!empty($_GET['hn'])){
						$where.=" AND hospitalcode='".$_GET['hospitalcode']."' AND hn='".$_GET['hn']."'";					
						$sql="SELECT  information_historyid FROM n_information WHERE id=(select max(id) from n_information WHERE hospitalcode =?  AND hn= ? )";
						// ให้มีปุ่มเพิ่มเฉพาะ historyid ล่าสุด
						$data['historyid']=$this->db->GetOne($sql,array($_GET['hospitalcode'],$_GET['hn']));
					}elseif(!empty($_GET['idcard'])){
						$where.=" AND (idcard='".$_GET['idcard']."') AND idcard!='' and hospitalcode<>''";
					}
				}							
								
				if(!empty($_GET['hospital_province_id']) && !empty($_GET['hospital_amphur_id']) && !empty($_GET['hospital_district_id'])){
					$where .= " AND  (hospitalcode='".$_GET['hospitalcode']."' and hospitalprovince='".$_GET['hospital_province_id']."' 
									  and hospitalamphur='".$_GET['hospital_amphur_id']."' and hospital_district_id='".$_GET['hospital_district_id']."')";
				}else{
					$where.=(!empty($_GET['hospitalcode']))? " and hospitalcode='".$_GET['hospitalcode']."'":"";
					$where.=(!empty($_GET['hospital_province_id']))? " and hospitalprovince='".$_GET['hospital_province_id']."'":"";
					$where.=(!empty($_GET['hospital_amphur_id']))? " and hospitalamphur='".$_GET['hospital_amphur_id']."'":"";
					$where.=(!empty($_GET['hospital_district_id']))? " and hospital_district_id='".$_GET['hospital_district_id']."'":"";					
				}
				if(!empty($_GET['enddate']) && !empty($_GET['startdate'])){
					$where.=" and datetouch BETWEEN '".cld_date2my($_GET['startdate'])."' AND  '".cld_date2my($_GET['enddate'])."' ";
				}else{
					if(!empty($_GET['startdate'])){
						$where.=" and datetouch = '".cld_date2my($_GET['startdate'])."'";	
					}elseif(!empty($_GET['enddate'])){
						$where.=" and datetouch = '".cld_date2my($_GET['enddate'])."'";	
					}					
				} 
		
				if(!empty($_GET['report_startdate']) && !empty($_GET['report_enddate'])){
					$where.=" and reportdate BETWEEN '".cld_date2my($_GET['report_startdate'])."' and '".cld_date2my($_GET['report_enddate'])."'";
				}else{
					if(!empty($_GET['report_startdate'])){
						$where.=" and reportdate = '".cld_date2my($_GET['report_startdate'])."'";		
					}elseif(!empty($_GET['report_enddate'])){
						$where.=" and reportdate = '".cld_date2my($_GET['report_enddate'])."'";
					}					
				}
										
				$where .=(!empty($_GET['in_out']))? " and in_out='".$_GET['in_out']."'":'';
				if(!empty($_GET['total_vaccine'])){
					$total_vaccine=implode(',',$_GET['total_vaccine']);
					$where.="  AND total_vaccine in(".$total_vaccine.")";
				}

		}// $_GET['action]
		
		if(!empty($where))
		{ 
			$sql="SELECT  historyid,firstname,surname ,hn_no,hn,hospitalcode,id,hospitalprovince,total_vaccine,idcard,n_hospital_1.hospital_district_id
				 ,hospital_name,in_out,closecase, CONVERT(VARCHAR(10), datetouch, 120) AS [datetouch]								
				 FROM n_history
				 INNER JOIN n_information ON n_history.historyid=n_information.information_historyid
				 INNER JOIN n_hospital_1 	on n_hospital_1.hospital_code=n_information.hospitalcode WHERE 1=1 $where order by datetouch desc";
			$data['result']=$this->inform->limit(20)->get($sql);
			$data['pagination']=$this->inform->pagination();			

			$data['hospitalprovince']=@$_GET['hospital_province_id'];
			$data['hisamp']=@$_GET['hospital_amphur_id'];
			$data['hospital']=@$_GET['hospitalcode'];
			/** กรณี user staff   **/
			$data['hn']=@$_GET['hn'];
			$data['in_out']=@$_GET['in_out'];
			/**************************/
			$data['idcard']=(!empty($_GET['idcard']))?@$_GET['idcard']:'';
			$data['statusid']=(!empty($_GET['statusid']))? $_GET['statusid']:'';
			$this->template->set_layout('layout');
			$this->template->build('index',$data);
		}else{
			$this->template->set_layout('layout');			
			$this->template->build('index');
		}		
	}
	
	function form($id=FALSE,$historyid=FALSE,$in_out=FALSE,$process=FALSE)
	{		
			$data['in_out']=$in_out;
			$data['historyid']=$historyid;
			$data['process'] = $process;
			//$data['value_disabled']=($process=="view" || $process=="vaccine")? 'disabled="disabled"':'';
			$idcard = $this->history->get_one("idcard","historyid",$historyid);
			$data['cardW0']=substr($idcard,0,1);
			$data['cardW1']=substr($idcard,1,4);
			$data['cardW2']=substr($idcard,5,5);
			$data['cardW3']=substr($idcard,10,2);
			$data['cardW4']=substr($idcard,12,13);	
			$data['h_name'] =$this->session->userdata('R36_HOSPITAL_NAME');
			## กดเลือก 	view หรือ เรคอร์ดที่ถูกบันทึกในฐานข้อมูลแล้ว กรณีผู้ที่มีสิทธิ์สามารถดูได้ทั้งหมด
			$data['rs']=$this->inform->select("n_information.*
											  ,CONVERT(VARCHAR(10), datetouch, 120) AS [datetouch]
											  ,CONVERT(VARCHAR(10), reportdate, 120) AS [reportdate]
											  ,CONVERT(VARCHAR(10), daterig, 120) AS [daterig]
											  ,CONVERT(VARCHAR(10), datelongfeel, 120) AS [datelongfeel]
											  ,CONVERT(VARCHAR(10), after_vaccine_date, 120) AS [after_vaccine_date]
											  ,n_history.*,n_hospital_1.*")										
									->join("INNER JOIN n_history ON n_history.historyid=information_historyid
											INNER JOIN n_hospital_1 ON n_hospital_1.hospital_code=n_information.hospitalcode")
									->get_row($id);	
			if($this->session->userdata('R36_LEVEL')=="05"){
				$data['rs']['hospital_code']=$this->session->userdata('R36_HOSPITAL');
				$data['rs']['hospital_province_id']=$this->session->userdata('R36_HOSPITAL_PROVINCE');
				$data['rs']['hospital_amphur_id']=$this->session->userdata('R36_HOSPITAL_AMPHUR');
				$data['rs']['hospital_district_id']=$this->session->userdata('R36_HOSPITAL_DISTRICT');	
			}
			
			//$data['now']=strtotime(date("Y-m-d H:i:s"));
			$data['now']=strtotime(date("Y-m-d H:i:sP"));														
			$this->template->build('form',$data);
				
	}		
	function addnew()
	{//กรอกข้อมูลการสัมผัสโรค
		$idcard=$_GET['cardW0'].$_GET['cardW1'].$_GET['cardW2'].$_GET['cardW3'].$_GET['cardW4'];
		$historyid=$this->db->GetOne("select historyid from n_history where idcard= ? ",$idcard);		
		if(!empty($historyid)){
			$data['rs'] = $this->history->get_row("historyid",$historyid);		
			$hn_no =$this->db->GetOne('SELECT hn_no as cnt from n_information where information_historyid= ? order by id desc',$historyid);																   	
			$data['rs']['hn_no']=$hn_no+1;
		}else{
			$data['rs']['hn_no']=1;
		}			
		$data['rs']['hn']=$_GET['hn'];	
		$data['rs']['idcard']=$idcard;
		$data['rs']['statusid']=$_GET['statusid'];
		$data['rs']['hospitalprovince']=$_GET['hospital_province_id'];
		$data['rs']['hospitalamphur']=$_GET['hospital_amphur_id'];
		$data['rs']['hospitaldistrict'] = $_GET['hospital_district_id'];
		$data['rs']['hospitalcode'] = $_GET['hospitalcode'];
					
		$data['cardW0']=$_GET['cardW0'];
		$data['cardW1']=$_GET['cardW1'];
		$data['cardW2']=$_GET['cardW2'];
		$data['cardW3']=$_GET['cardW3'];
		$data['cardW4']=$_GET['cardW4'];
		$data['rs']['in_out']=$_GET['in_out'];		
		$data['value_disabled']='';	
		$data['process']="";
		$data['h_name'] =$this->session->userdata('R36_HOSPITAL_NAME');		
		$this->template->build('form',$data);
	}


	function save()
	{	 
		/*  ป้องกันการบันทึกข้อมูลผู้สัมผัสโรคซ้ำ : ตรวจสอบรหัสบัตรประชาชนก่อนบันทึกลง n_history ถ้ามีแล้วให้ update ถ้าไม่มี insert  	
		 *   ที่ยอมให้บันทึกได้หลายเรคอร์ด - ไมได้ตรวจสอบก่อนบันทึก, ผู้สัมผัสโรคอาจย้ายที่อยู่ และสถานที่สัมผัสโรคคนละที่-					*/	
		//$this->db->debug=TRUE;			
		if($_POST['statusid']=='1'){ 
					$_POST['idcard']=$_POST['cardW0'].$_POST['cardW1'].$_POST['cardW2'].$_POST['cardW3'].$_POST['cardW4'];						
		}else if($_POST['statusid']=='2'){
					$_POST['idcard']=$_POST['idpassport'];
		}
		$historyid=$this->db->GetOne("select historyid from n_history where (idcard='".$_POST['idcard']."')  and statusid= '".$_POST['statusid']."'");
		//table n_history
						if(isset($_POST['chkage'])=='Y'){$_POST['age']=0;$_POST['age_group']=1;
						}else if($_POST['age'] < 1){$_POST['age']=0;$_POST['age_group']=1;
						}else if($_POST['age']>=1  && $_POST['age'] <=5){$_POST['age_group']=2;
						}else if($_POST['age']>=6  && $_POST['age'] <=10){$_POST['age_group']=3;
						}else if($_POST['age']>=11 && $_POST['age'] <=15){$_POST['age_group']=4;
						}else if($_POST['age']>=16 && $_POST['age'] <=25){$_POST['age_group']=5;
						}else if($_POST['age']>=26 && $_POST['age'] <=35){$_POST['age_group']=6;
						}else if($_POST['age']>=36 && $_POST['age'] <=45){$_POST['age_group']=7;
						}else if($_POST['age']>=46 && $_POST['age'] <=55){$_POST['age_group']=8;
						}else if($_POST['age']>=56 && $_POST['age'] <=65){$_POST['age_group']=9;
						}else if($_POST['age']>=66){$_POST['age_group']=10;}
		
		if(isset($_POST['nationality']))
		{					
			if($_POST['nationality']=='1'){$_POST['nationalityname']=$_POST['nationality'];}
			else if($_POST['nationality']=='2'){$_POST['nationalityname']=$_POST['nationalityname'];}
		}
		if($_POST['age']<=15){
			$_POST['occupationname']=$_POST['occupationname_b'];
		}
	
		//  n_history
		//$_POST['updatetime'] = (empty($_POST['updatetime']) || $_POST['updatetime']=='0000-00-00 00:00:00') ? "CONVERT(datetime, GETDATE(), 120)":"CONVERT(VARCHAR(19), '".$_POST['updatetime']."', 120)";			
	   // $_POST['created'] 	 = (empty($_POST['created']) 	|| $_POST['created']=='0000-00-00 00:00:00') ? "CONVERT(datetime, GETDATE(), 120)":"CONVERT(VARCHAR(19), '".$_POST['created']."', 120)";			
	    $this->history->primary_key('historyid');
		$_POST['information_historyid']=$this->history->save($_POST);
		//var_dump($_POST);
		//exit;
		$head_lick_noblood = (!empty($_POST['head_lick_noblood'])) ? $_POST['head_lick_noblood'] :'';
		$face_lick_noblood = (!empty($_POST['face_lick_noblood'])) ? $_POST['face_lick_noblood'] :'';
		$neck_lick_noblood = (!empty($_POST['neck_lick_noblood'])) ? $_POST['neck_lick_noblood'] :'';
		$hand_lick_noblood = (!empty($_POST['hand_lick_noblood'])) ? $_POST['hand_lick_noblood'] :'';
		$body_lick_noblood = (!empty($_POST['body_lick_noblood'])) ? $_POST['body_lick_noblood'] :'';
		$feet_lick_noblood = (!empty($_POST['feet_lick_noblood'])) ? $_POST['feet_lick_noblood'] :'';
		//********************    table n_information          **********************
		if(!empty($_POST['head_bite_blood']) || !empty($_POST['head_bite_noblood']) || !empty($_POST['head_claw_blood']) || !empty($_POST['head_claw_noblood'])|| !empty($_POST['face_lick_blood']) || !empty($head_lick_noblood)){
			@$_POST['head']='1';
		}
		if(!empty($_POST['face_bite_blood']) || !empty($_POST['face_bite_noblood']) || !empty($_POST['face_claw_blood'])|| !empty($_POST['face_claw_noblood'])|| !empty($_POST['face_lick_blood'])||  !empty($face_lick_noblood)){
			@$_POST['face']='1';
		}
		if(!empty($_POST['neck_bite_blood']) || !empty($_POST['neck_bite_noblood']) || !empty($_POST['neck_claw_blood']) || !empty($_POST['neck_claw_noblood'])|| !empty($_POST['neck_lick_blood'])|| !empty($neck_lick_noblood)){
			@$_POST['neck']='1';
		}
		if(!empty($_POST['hand_bite_blood']) || !empty($_POST['hand_bite_noblood']) || !empty($_POST['hand_claw_blood'])|| !empty($_POST['hand_claw_noblood']) || !empty($_POST['hand_lick_blood'])|| !empty($hand_lick_noblood)){
			@$_POST['hand']='1';
		}
		if(!empty($_POST['arm_bite_blood']) || !empty($_POST['arm_bite_noblood']) || !empty($_POST['arm_claw_blood'])|| !empty($_POST['arm_claw_noblood']) || !empty($_POST['arm_lick_blood']) || !empty($_POST['arm_lick_noblood'])){
			
			@$_POST['arm']='1';
		}
		if(!empty($_POST['body_bite_blood']) || !empty($_POST['body_bite_noblood']) || !empty($_POST['body_claw_blood']) || !empty($_POST['body_claw_noblood']) || !empty($_POST['body_lick_blood']) || !empty($body_lick_noblood)){
			@$_POST['body']='1';
		}
		if(!empty($_POST['leg_bite_blood']) || !empty($_POST['leg_bite_noblood']) || !empty($_POST['leg_claw_blood']) || !empty($_POST['leg_claw_noblood'])|| !empty($_POST['leg_lick_blood']) || !empty($_POST['leg_lick_noblood'])){
			@$_POST['leg']='1';
		}
		if(!empty($_POST['feet_bite_blood']) || !empty($_POST['feet_bite_noblood']) || !empty($_POST['feet_claw_blood'])|| !empty($_POST['feet_claw_noblood']) || !empty($_POST['feet_lick_blood'])|| !empty($feet_lick_noblood)){
			@$_POST['feet']='1';
		}				
		//--------------------------chk_total_vaccine-----------------------------
			if($_POST['means']!='3' && $_POST['means']!=''){		
				$total_vaccine=0;
				
				for($c=0;$c<count($_POST['vaccine_name']);$c++){
						if($_POST['vaccine_date'][$c]!='' && $_POST['vaccine_name'][$c]!='0' && $_POST['byname'][$c]!="" ){
							$total_vaccine++;
						}
				}
				$_POST['total_vaccine']=$total_vaccine;
				if($total_vaccine>=4 && $_POST['means']=='2'){
							if($_POST['vaccine_point'][4]==2){
									$_POST['package']=1;
							}else if($vaccine_point[4]==1){
									$_POST['package']=2;
							}
				}
			}
		//-----------------------end chk_total_vaccine--------------------------
		
		//$_POST['created']		= (empty($_POST['created']) ||$_POST['created']=='0000-00-00 00:00:00') ? "CONVERT(datetime, GETDATE(), 120)":"CONVERT(VARCHAR(19), '".$_POST['created']."', 120)";
		$_POST['datetouch']		= cld_date2my($_POST['datetouch']);
		$_POST['reportdate']	= cld_date2my($_POST['reportdate']);

		
		$_POST['daterig']			=(is_null($_POST['daterig'])			|| $_POST['daterig']=='')? '':cld_date2my($_POST['daterig']);
		$_POST['datelongfeel']		=(is_null($_POST['datelongfeel'])		|| $_POST['datelongfeel']=='')? '':cld_date2my($_POST['datelongfeel']);
		$_POST['after_vaccine_date']=(is_null($_POST['after_vaccine_date'])	|| $_POST['after_vaccine_date']=='')? '':cld_date2my($_POST['after_vaccine_date']);
			
		$_POST['hospitalcode']=$_POST['hospital'];
		$_POST['id']=$_POST['information_id'];	
		$_POST['typeother']	=($_POST['typeother']=='') ? '0':$_POST['typeother'];	
		$information_id=$this->inform->save($_POST);
		//   ------++++------    table n_vaccine	------++++------ 	
		$this->vaccine->primary_key('vaccine_id');
		$this->vaccine->delete("information_id",$information_id);
		
		if($_POST['means']!='3' && $_POST['means']!=''){
			$j=($_POST['means']=="2")?4:5;			
					for($i=0;$i<$j;$i++){
								if($_POST['vaccine_name'][$i]!="0"){					
									$hospital_name = $this->hospital->get_one("hospital_name",'hospital_code',$_POST['hospitalcode']);	
									$_POST['byplace'][$i] = (empty($_POST['byplace'][$i])) ? $hospital_name:$_POST['byplace'][$i];
									$hospital = $this->db->GetOne("select hospital_id from n_hospital_1 where hospital_name ='".$_POST['byplace'][$i]."'");																																												
									$user_id=(!empty($_POST['user_id'][$i]))? $_POST['user_id'][$i]:$this->session->userdata('R36_UID');									
									$data=array('vaccine_id'=>'','information_id'=>$information_id,'vaccine_date' =>date2DB($_POST['vaccine_date'][$i])
											   ,'vaccine_name'=>$_POST['vaccine_name'][$i],'vaccine_no'=> $_POST['vaccine_no'][$i]
											   ,'vaccine_cc'=>$_POST['vaccine_cc'][$i] ,'vaccine_point'=>$_POST['vaccine_point'][$i]
											   ,'byname'=> $_POST['byname'][$i],'byplace'=> $_POST['byplace'][$i],'user_id'=>$user_id,'hospital_id'=>$hospital
											   ,'updatetime'=>@$_POST['updatetime'],'created'=>@$_POST['created']);									
									$this->vaccine->save($data);
										
								}	
								if($_POST['vaccine_date'][$i] &&  $_POST['vaccine_name'][$i]=="0"){									
									$data=array('vaccine_id'=>'','information_id'=>$information_id,'vaccine_date' =>date2DB($_POST['vaccine_date'][$i]));
									$this->vaccine->save($data);
								}
					}//exit;
		}
		$title = "ข้อมูลการสัมผัสโรค ".$_POST['patient_type'];
		
		save_log($process,$title_log,$label,$label_val);	
		//  ------++++------    End n_vaccine  ------++++------ 
		set_notify('success', SAVE_DATA_COMPLETE);		
		redirect('inform/index');
	}

	function addContactTime()
	{	
		$rs=$this->db->GetRow("select * from n_history where  historyid=(select max(historyid) from n_history where idcard='".$_GET['idcard']."')");
		$rs['hn_no'] = $this->db->GetOne("select count(id)+1 from n_information 
										  left join n_history on n_information.information_historyid=n_history.historyid 
										  where idcard =  ?  ",$_GET['idcard']);			
		$rs['amphur_name']   = $this->db->GetOne("select amphur_name from n_amphur where province_id= ? and amphur_id = ? ",array($rs['provinceid'],$rs['amphurid']));
		$rs['district_name'] = $this->db->GetOne("select district_name from n_district where province_id= ? and amphur_id= ? and district_id= ? ",array($rs['provinceid'],$rs['amphurid'],$rs['districtid']));
		echo json_encode($rs);
	}
	public function chk_format_idcard($idcard,$digit_last)
	{
		for($i=0;$i<13;$i++){
			$idcard_arr[]=substr($idcard,$i,1);
		}		
		$chk=chk_idcard($idcard_arr,$digit_last);
		return ($chk=="no")? "no":"yes";
	}
	function chk_idcard_edit()
	{
			$data['historyid']=$_GET['historyid'];				
			$this->template->set_layout('blank');	
			$this->template->build('popup_chk_idcard_edit',$data);
	}
	function chk_idcard_edit_process()
	{	
			$data['show']="";		
			$sql="select * from n_history where idcard= ? and statusid= ? and historyid<> ? and idcard<>''";
			$id=$this->db->GetOne($sql,array($_GET['idcard'],$_GET['statusid'],$_GET['historyid']));
			$digit_last=substr($_GET['idcard'],-1,1);			
			if($_GET['statusid']=="1"){
				$data['format'] = $this->chk_format_idcard($_GET['idcard'],$digit_last);
			}else{
				$data['format'] = "yes";
			}								
			if($id){
				$data['show']="duplicate";
			}
			echo json_encode($data);	
	}
	function delete($id=FALSE,$historyid=FALSE){
		if(!empty($_GET['id']) && !empty($_GET['historyid'])){
			$id = $_GET['id'];
			$historyid = $_GET['historyid'];
		}
		if($id && $historyid){					
			$this->inform->delete($id);
			$idcard=$this->history->get_one("historyid",$historyid);
			if($idcard){
				$cnt=$this->db->GetOne("select count(idcard) as cnt from n_history inner join n_information on historyid = information_historyid where idcard= ? ",$idcard);
				if($cnt=="1"){
					$this->history->delete("historyid",$historyid);
				}		
			}						
			$this->vaccine->delete("information_id",$id);
			set_notify('success', DELETE_DATA_COMPLETE);				
		}
		if(empty($_GET)){redirect('inform/index');}				
	}
	function checkDatetouch()
	{
		$datetouch=strtotime(date2DB($_GET['datetouch']));	
		$now=strtotime(date("Y-m-d"));
		echo ($datetouch > $now)? "false":"true";					
	}
	function popuplist(){
		$this->template->build('popup_list');
	}
	function download($id,$field="file")
	{
		//$content = new Content($id);
		$file=$this->detail->get_one($field,"id",$id);
		$this->load->helper('download');
		$data = file_get_contents("uploads/document/".basename($file));
		$name = basename($file);
		force_download($name, $data); 
	}

	
	
	
}

