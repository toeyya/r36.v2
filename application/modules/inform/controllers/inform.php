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
		$this->template->append_metadata(js_idcard());
		$this->history->primary_key('historyid');
						
	}
	function closecase_person($idcard){
		$sql="SELECT id,hn,idcard,hn_no,firstname,surname,information_historyid,datetouch 
			  FROM n_information 
			  LEFT JOIN n_history ON historyid=information_historyid 
			  WHERE closecase=1 and idcard='".$idcard."' order by n_information.datetouch asc";	
		$result=$this->inform->get($sql);
		if($result){
			$tb = '<div class="alert alert-warning"><span class="label label-warning">มีเคสนี้อยู่แล้วในระบบ</span> คุณต้องปิดเคสนี้ก่อนจึงสามารถเพิ่มครั้งที่สัผมัสโรคได้</div>';
			$tb.= '<table class="tb_search_Rabies1">';
			$tb.= '<tr>';
			$tb.= '<th>วันที่สัมผัสโรค</th>';
			$tb.= '<th>HN</th>';
			$tb.= '<th>ครั้งที่สัมผัสโรค</th>';
			$tb.= '<th>ชื่อ-นามสกุล</th>';
			$tb.= '<th>บัตรประชาชน/passport</th>';
			$tb.= '<th></th>';
			$tb.= '</tr>';
			foreach($result as $item){
				$tb.= '<tr>';
				$tb.= '<td>'.cld_my2date($item['datetouch']).'</td>';
				$tb.= '<td>'.$item['hn'].'</td>';
				$tb.= '<td>'.$item['hn_no'].'</td>';
				$tb.= '<td>'.$item['firstname'].' '.$item['surname'].'</td>';
				$tb.= '<td>'.$item['idcard'].'</td>';
				$tb.= '<td><a href="inform/form/'.$item['id'].'/'.$item['information_historyid'].'" class="btn_edit vtip" target="_blank"></a>';
				$tb.= '</td>';
				$tb.= '</tr>';
			}
			$tb.= '</table>';
			$data['tb']=$tb;
			$data['chk']="yes";
		}else{
			$data['chk']="no";
		}
		echo json_encode($data);
		
	}
	function closecase($chk=FALSE)
	{
	
		$hospitalcode =	$this->session->userdata('R36_HOSPITAL');			 	
		$result=$this->inform->select("id,hn,idcard,hn_no,firstname,surname,information_historyid,datetouch,vaccine_date ")
							 ->join("LEFT JOIN n_history ON historyid=information_historyid
									 LEFT JOIN (select information_id,vaccine_date from n_vaccine 
			  			 			 WHERE datediff(now(),vaccine_date) >=90 
			  			             ORDER BY vaccine_date  limit 1)vaccine ON vaccine.information_id=n_information.id							 			
							 ")->where("hospitalcode = $hospitalcode and closecase=1")
							 ->sort('')->order("n_information.datetouch asc")->get();					
		/*$data['chk']=($result) ?"yes":"no";	
		if($chk){
			echo json_encode($data);
			return true;
		}*/
		var_dump($result);exit;
		$data['result'] = $result;		
		$data['pagination']=$this->inform->pagination();
		$this->template->set_layout('blank');
		$this->template->build('view_closecase',$data);
	}
	function index()
	{				
		if(!empty($_GET['action']))
		{//กดค้นหา												
				$where ="";
				if(!empty($_GET['name'])) $where.=" and firstname like'%".$_GET['name']."%'";
				if(!empty($_GET['surname'])) $where.=" and surname like '%".$_GET['surname']."%'";
				if(@$_GET['statusid']=="1"){
					$_GET['idcard']=$_GET['cardW0'].$_GET['cardW1'].$_GET['cardW2'].$_GET['cardW3'].$_GET['cardW4'];
				}
				if(!empty($_GET['hn']) && !empty($_GET['idcard']))	{
					$where.="AND  hospitalcode='".$_GET['hospitalcode']."' AND hn='".$_GET['hn']."' AND idcard='".$_GET['idcard']."'";
				}else{
					if(!empty($_GET['hn'])){
						$where.=" AND hospitalcode='".$_GET['hospitalcode']."' AND hn='".$_GET['hn']."'";					
						$sql="SELECT  information_historyid FROM n_information WHERE id=(select max(id) from n_information WHERE hospitalcode =?  AND hn= ? )";
						// ให้มีปุ่มเพิ่มเฉพาะ historyid ล่าสุด
						$data['historyid']=$this->db->GetOne($sql,array($_GET['hospitalcode'],$_GET['hn']));
					}elseif(!empty($_GET['idcard'])){
						$where.=" AND (idcard='".$_GET['idcard']."' AND statusid='".$_GET['statusid']."') AND idcard!='' and hospitalcode<>''";
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
					$where.=" and datetouch BETWEEN '".date2DB($_GET['startdate'])."' AND  '".date2DB($_GET['enddate'])."' ";
				}else if(!empty($_GET['enddate'])){
					$where.=" and datetouch BETWEEN '".date2DB($_GET['startdate'])."' and '".date2DB($_GET['startdate'])."'";	
				}
		
				if(!empty($_GET['report_startdate']) && !empty($_GET['report_enddate'])){
					$startdate=date2DB($_GET['report_startdate']);	
					$enddate=date2DB($_GET['report_enddate']);
					$where.=" and reportdate BETWEEN '".$startdate."' and '".$enddate."'";
				}elseif(!empty($_GET['report_startdate'])){
					$where.=" and reportdate BETWEEN '".$startdate."' and '".$startdate."'";		
				}
										

				$where .=(!empty($_GET['in_out']))? " and in_out='".$_GET['in_out']."'":'';
				if(!empty($_GET['total_vaccine'])){
					$total_vaccine=implode(',',$_GET['total_vaccine']);
					$where.="  AND total_vaccine in(".$total_vaccine.")";
				}

		}// $_GET['action]
		
		if(!empty($where))
		{
			$sql="SELECT  historyid,firstname,surname ,hn_no,hn,hospitalcode,id,hospitalprovince,total_vaccine,idcard,n_hospital_1.hospital_district_id,hospital_name,in_out,closecase									
				FROM n_history
				INNER JOIN n_information ON n_history.historyid=n_information.information_historyid
				INNER JOIN n_hospital_1 	on n_hospital_1.hospital_code=n_information.hospitalcode WHERE 1=1 $where";

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
			$data['rs']=$this->inform->select("n_information.*,n_history.*,n_hospital_1.*")										
									->join("INNER JOIN n_history ON n_history.historyid=information_historyid
											INNER JOIN n_hospital_1 ON n_hospital_1.hospital_code=n_information.hospitalcode")
									->get_row($id);	
			if($this->session->userdata('R36_LEVEL')=="05"){
				$data['rs']['hospital_code']=$this->session->userdata('R36_HOSPITAL');
				$data['rs']['hospital_province_id']=$this->session->userdata('R36_HOSPITAL_PROVINCE');
				$data['rs']['hospital_amphur_id']=$this->session->userdata('R36_HOSPITAL_AMPHUR');
				$data['rs']['hospital_district_id']=$this->session->userdata('R36_HOSPITAL_DISTRICT');	
			}
			
			$data['now']=strtotime(date("Y-m-d H:i:s"));														
			$this->template->build('form',$data);
				
	}		
	function addnew()
	{//กรอกข้อมูลการสัมผัสโรค
	   
		$idcard=$_GET['cardW0'].$_GET['cardW1'].$_GET['cardW2'].$_GET['cardW3'].$_GET['cardW4'];
		$historyid=$this->db->GetOne("select historyid from n_history where idcard= ? ",$idcard);
		if(!empty($historyid)){
			$data['rs'] = $this->history->get_row("historyid",$historyid);			
			$data['rs']['hn_no']=$this->db->GetOne('SELECT hn_no+1 as cnt from n_information where information_historyid= ? order by id desc',$historyid);																   	
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


	function save(){
	
		/*  ป้องกันการบันทึกข้อมูลผู้สัมผัสโรคซ้ำ : ตรวจสอบรหัสบัตรประชาชนก่อนบันทึกลง n_history ถ้ามีแล้วให้ update ถ้าไม่มี insert  	
		 *   ที่ยอมให้บันทึกได้หลายเรคอร์ด - ไมได้ตรวจสอบก่อนบันทึก, ผู้สัมผัสโรคอาจย้ายที่อยู่ และสถานที่สัมผัสโรคคนละที่-					*/	
		//$this->db->debug=TRUE;			
		if($_POST['statusid']=='1'){ 
					$_POST['idcard']=$_POST['cardW0'].$_POST['cardW1'].$_POST['cardW2'].$_POST['cardW3'].$_POST['cardW4'];						
		}else if($_POST['statusid']=='2'){
					$_POST['idcard']=$_POST['idpassport'];
		}
		$historyid=$this->db->GetOne("select historyid from n_history where idcard= ?  and statusid= ? and idcard<>0",array($_POST['idcard'],$_POST['statusid']));
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
	
		$_POST['updatetime']=(is_null(@$_POST['updatedtime']))? '0000-00-00 00:00:00':@$_POST['updatetime'];
		//  n_history
		
		$_POST['information_historyid']=$this->history->save($_POST);
		
		$head_lick_noblood=@$_POST['head_lick_noblood'];
		$face_lick_noblood=@$_POST['face_lick_noblood'];
		$neck_lick_noblood=@$_POST['neck_lick_noblood'];
		$hand_lick_noblood=@$_POST['hand_lick_noblood'];
		$body_lick_noblood=@$_POST['body_lick_noblood'];
		$feet_lick_noblood=@$_POST['feet_lick_noblood'];
		//********************    table n_information          **********************
		if(@$_POST['head_bite_blood']=='1' || @$_POST['head_bite_noblood']=='1' || @$_POST['head_claw_blood']=='1'|| @$_POST['head_claw_noblood']=='1'|| @$_POST['face_lick_blood']=='1'|| $head_lick_noblood=='1' ){
			@$_POST['head']='1';
		}
		if(@$_POST['face_bite_blood']=='1' || @$_POST['face_bite_noblood']=='1' || @$_POST['face_claw_blood']=='1'|| @$_POST['face_claw_noblood']=='1'|| @$_POST['face_lick_blood']=='1'||  $face_lick_noblood=='1' ){
			@$_POST['face']='1';
		}
		if(@$_POST['neck_bite_blood']=='1' || @$_POST['neck_bite_noblood']=='1' || @$_POST['neck_claw_blood']=='1'|| @$_POST['neck_claw_noblood']=='1'|| @$_POST['neck_lick_blood']=='1'|| $neck_lick_noblood=='1' ){
			@$_POST['neck']='1';
		}
		if(@$_POST['hand_bite_blood']=='1' || @$_POST['hand_bite_noblood']=='1' || @$_POST['hand_claw_blood']=='1'|| @$_POST['hand_claw_noblood']=='1'|| @$_POST['hand_lick_blood']=='1'|| $hand_lick_noblood=='1' ){
			@$_POST['hand']='1';
		}
		if(@$_POST['arm_bite_blood']=='1' || @$_POST['arm_bite_noblood']=='1' || @$_POST['arm_claw_blood']=='1'|| @$_POST['arm_claw_noblood']=='1'|| @$_POST['arm_lick_blood']=='1'|| @$_POST['arm_lick_noblood']=='1' ){
			@$_POST['arm']='1';
		}
		if(@$_POST['body_bite_blood']=='1' || @$_POST['body_bite_noblood']=='1' || @$_POST['body_claw_blood']=='1'|| @$_POST['body_claw_noblood']=='1'|| @$_POST['body_lick_blood']=='1'|| $body_lick_noblood=='1' ){
			@$_POST['body']='1';
		}
		if(@$_POST['leg_bite_blood']=='1' || @$_POST['leg_bite_noblood']=='1' || @$_POST['leg_claw_blood']=='1'|| @$_POST['leg_claw_noblood']=='1'|| @$_POST['leg_lick_blood']=='1'|| @$_POST['leg_lick_noblood']=='1' ){
			@$_POST['leg']='1';
		}
		if(@$_POST['feet_bite_blood']=='1' || @$_POST['feet_bite_noblood']=='1' || @$_POST['feet_claw_blood']=='1'|| @$_POST['feet_claw_noblood']=='1'|| @$_POST['feet_lick_blood']=='1'|| $feet_lick_noblood=='1' ){
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
		$_POST['datetouch']=cld_date2my($_POST['datetouch']);
		$_POST['reportdate']=cld_date2my($_POST['reportdate']);
		$_POST['daterig']=cld_date2my($_POST['daterig']);
		$_POST['datelongfeel']=cld_date2my($_POST['datelongfeel']);
		$_POST['after_vaccine_date']=cld_date2my($_POST['after_vaccine_date']);		
		
		$_POST['daterig']=(is_null($_POST['daterig'])|| $_POST['daterig']=='')? '0000-00-00':$_POST['daterig'];
		$_POST['datelongfeel']=(is_null($_POST['datelongfeel'])|| $_POST['datelongfeel']=='')? '0000-00-00':$_POST['datelongfeel'];
		$_POST['after_vaccine_date']=(is_null($_POST['after_vaccine_date'])|| $_POST['after_vaccine_date']=='')? '0000-00-00':$_POST['after_vaccine_date'];
			
		$_POST['hospitalcode']=$_POST['hospital'];
		$_POST['id']=$_POST['information_id'];			
		$information_id=$this->inform->save($_POST);
		//   ------++++------    table n_vaccine	------++++------ 	
		$this->vaccine->primary_key('vaccine_id');
		$this->vaccine->delete("information_id",$information_id);
		
		if($_POST['means']!='3' && $_POST['means']!=''){
			$j=($_POST['means']=="2")?4:5;			
					for($i=0;$i<$j;$i++){
								if($_POST['vaccine_name'][$i]!="0"){
										
									$hospital=$this->hospital->get_one("hospital_id","hospital_name",$_POST['byplace'][$i]);
									$user_id=(!empty($_POST['user_id'][$i]))? $_POST['user_id'][$i]:$this->session->userdata('R36_UID');
									
									$data=array('vaccine_id'=>'','information_id'=>$information_id,'vaccine_date' =>date2DB($_POST['vaccine_date'][$i])
											   ,'vaccine_name'=>$_POST['vaccine_name'][$i],'vaccine_no'=> $_POST['vaccine_no'][$i]
											   ,'vaccine_cc'=>$_POST['vaccine_cc'][$i] ,'vaccine_point'=>$_POST['vaccine_point'][$i]
											   ,'byname'=> $_POST['byname'][$i],'byplace'=> $_POST['byplace'][$i],'user_id'=>$user_id,'hospital_id'=>$hospital
											   ,'updatetime'=>@$_POST['updatetime'],'created'=>@$_POST['created']);									
									$this->vaccine->save($data);
										
								}	
								if($_POST['vaccine_date'][$i] &&  $_POST['vaccine_name'][$i]=="0"){									
									$data=$data=array('vaccine_id'=>'','information_id'=>$information_id,'vaccine_date' =>date2DB($_POST['vaccine_date'][$i]));
									$this->vaccine->save($data);
								}
					}//exit;
		}
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
		$datetouch=strtotime(DateTH2DB($_GET['datetouch']));
		$now=strtotime(date("Y-m-d H:i:s"));
		echo ($datetouch >$now)? "false":"true";					
	}
	function popuplist(){
		$this->template->build('popup_list');
	}

}

