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
		
	}
	function index()
	{
	
		if($this->session->userdata('R36_LEVEL')=="05"){
				$_GET['hospitalcode']=$this->session->userdata('R36_HOSPITAL_NAME');
				$_GET['hospital_province_id']=$this->session->userdata('R36_HOSPITAL_PROVINCE');
				$_GET['hospital_amphur_id']=$this->session->userdata('R36_HOSPITAL_AMPHUR');
				$_GET['hospital_district_id']=$this->session->userdata('R36_HOSPITAL_DISTRICT');

		}	
		$where=(!empty($_GET['hospitalcode']))? "and hospitalcode='".$_GET['hospitalcode']."'":"";
		$where.=(!empty($_GET['hospital_province_id']))? " and hospitalprovince='".$_GET['hospital_province_id']."'":"";
		$where.=(!empty($_GET['hospital_amphur_id']))? " and hospitalamphur='".$_GET['hospital_amphur_id']."'":"";
		$where.=(!empty($_GET['hospital_district_id']))? " and hospital_district_id='".$_GET['hospital_district_id']."'":"";		
		$where.=(!empty($_GET['in_out']))? " and in_out='".$_GET['in_out']."'":'';
		if(empty($_GET['enddate']) && !empty($_GET['startdate'])){
			$_GET['enddate']=$_GET['startdate'];
			$where.=" and datetouch BETWEEN '".DBdate($_GET['startdate'])."' and '".DBdate($_GET['endtdate'])."' ";
		}else if(!empty($_GET['report_enddate']) && !empty($_GET['report_startdate'])){
			$_GET['report_enddate']=$_GET['report_startdate'];
		}
		if(!empty($_GET['startdate']) && !empty($_GET['enddate'])){
			$startdate=cld_date2my($_GET['startdate']);		
			$enddate=cld_date2my($_GET['enddate']);
			$where.=" and datetouch BETWEEN '".$startdate."' and '".$enddate."'";
		}elseif(!empty($_GET['startdate'])){
				$where.=(@$_GET['startdate']!='')?" and datetouch BETWEEN '".$startdate."' and '".$startdate."'":"";		
		}

		if(!empty($_GET['report_startdate']) && !empty($_GET['report_enddate'])){
			$startdate=cld_date2my($_GET['report_startdate']);		
			$enddate=cld_date2my($_GET['report_enddate']);
			$where.=" and reportdate BETWEEN '".$startdate."' and '".$enddate."'";
		}elseif(!empty($_GET['report_startdate'])){
				$where.=(@$_GET['report_startdate']!='')?" and reportdate BETWEEN '".$startdate."' and '".$startdate."'":"";		
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
		if(!empty($_GET['total_vaccine'])){
			$total_vaccine=implode(',',$_GET['total_vaccine']);
			$where.=" AND (closecase=2 AND total_vaccine in(".$total_vaccine."))";
		}
		if($where){
			$sql="SELECT  historyid,firstname,surname ,hn_no,hn,hospitalcode,id,hospitalprovince,total_vaccine,idcard,n_hospital_1.hospital_district_id,hospital_name,in_out
					   FROM n_information
					   LEFT JOIN n_hospital_1 	on n_hospital_1.hospital_code=n_information.hospitalcode				 
			           INNER JOIN n_history ON n_history.historyid=n_information.information_historyid WHERE id<>'' ".$where;
			//$result=$this->db->Execute($sql);		
			//$num_chk=$result->Recordcount();	
			$data['result']=$this->inform->where("id<>'' $where")->sort("")->order("created desc")->limit(20)->get($sql);
			$data['pagination']=$this->inform->pagination();			
			//$data['num_chk']=$num_chk;
			//$data['result']=$result;
			$data['hospitalprovince']=@$_GET['hospital_province_id'];
			$data['hisamp']=@$_GET['hospital_amphur_id'];
			$data['hospital']=@$_GET['hospitalcode'];
			/** กรณี user staff   **/
			$data['hn']=@$_GET['hn'];
			$data['in_out']=@$_GET['in_out'];
			/** กรณี user staff   **/
			$data['idcard']=(!empty($_GET['idcard']))?@$_GET['idcard']:'';
			$data['statusid']=(!empty($_GET['statusid']))? $_GET['statusid']:'';		
			$this->template->build('inform_index',$data);
		}else{
			
			$this->template->build('inform_index');
		}
	
		
	}
	function hn($in_out){
		$data['in_out']=$in_out;
		$data['statusid']='';
		$this->template->build('inform_hn',$data);
	}
	function chk_hn()
	{		
			$hn=$_GET['hn'];
			$data['hospital']=$_GET['hospital'];	
			$sql="SELECT hospitalcode,hn,firstname,surname,hospitalprovince,id ,historyid
						FROM n_information
						INNER JOIN n_history ON n_history.historyid=n_information.information_historyid
						WHERE hospitalcode='".$_GET['hospital']."' AND hn='".$hn."'";
			$result=$this->db->Execute($sql);		
			$num_chk=$result->Recordcount();	
			// กรณีเพิ่มครั้งที่สัมผัสโรค
			$data['historyid']=$this->db->GetOne("SELECT  information_historyid FROM n_information WHERE id=(select max(id) from n_information WHERE hospitalcode =?  AND hn= ? )",array($_GET['hospital'],$hn));
			$data['show_title']=($num_chk>0)? "	รหัส HN $hn มีอยู่ในฐานข้อมูลแล้ว":"	รหัส HN $hn ยังไม่มีอยู่ในฐานข้อมูล";
			$data['num_chk']=$num_chk;
			$data['result']=$result;
			$data['hospitalprovince']=$_GET['hospitalprovince'];
			$data['hisamp']=$_GET['hospitalamphur'];
			$data['hn']=$hn;
			$data['in_out']=$_GET['in_out'];
			$data['idcard']=(!empty($_GET['idcard']))?@$_GET['idcard']:'';
			$data['statusid']=(!empty($_GET['statusid']))? $_GET['statusid']:'';
		
			$this->template->set_layout('blank');	
			$this->template->build('popup_chk_hn',$data);

		
	}
	function chk_idcard_informhn(){
		/*  left join ข้าง n_history เป็นหลัก เพราะ มีข้อมูล history แต่ไม่มีข้อมูล n_information  เพราะเวลาบันทึกจะบันทึก n_history ก่อน แล้วเอาค่า historyid มาใส่ใน n_information	*/	
		//$this->db->debug=TRUE;
		$way=(isset($_GET['way']))?$_GET['way']:"";
		if($_GET['statusid']=="1")
		{
			$idcard=$_GET['idcard'];
		}else{
			$idcard=$_GET['idpassport'];
		}
		$sql="SELECT historyid,firstname,surname ,hn_no,hn,hospitalcode,id,hospitalprovince
					FROM n_history 
					LEFT JOIN n_information ON n_history.historyid=n_information.information_historyid
					WHERE idcard='".$idcard."' AND statusid ='".$_GET['statusid']."' AND idcard!='' and hospitalcode<>''";
		$result=$this->db->Execute($sql);
		$num_chk=$result->Recordcount();
		$data['show_title']=($num_chk>0)? "	รหัส ID $idcard มีอยู่ในฐานข้อมูลแล้ว":"	รหัส ID $idcard  ยังไม่มีอยู่ในฐานข้อมูล";
		$data['num_chk']=$num_chk;
		$data['result']=$result;		
		
		// ต้อง get () เพราะหนึ่งคนสามารถมีได้หลาย information record <relationship = n_history <---- n_information >
			$hospitalcode=(isset($_GET['hospital_code']))?" AND hospitalcode ='".$_GET['hospital_code']."'":"";
			$historyid=(isset($_GET['historyid']))? " AND historyid<>'".$_GET['historyid']."'":"";
			$data['add_inform']=$this->inform ->select("id,hn,historyid,hn_no")
														 ->join("RIGHT JOIN  n_history ON n_history.historyid =n_information.information_historyid")
														 ->where("idcard='".$idcard."' AND statusid ='".$_GET['statusid']."' AND idcard !=''".$hospitalcode.$historyid)
														 ->sort("")->order("id desc")->get();
								
		$data['idcard']=$idcard;	
		$data['in_out']=@$_GET['in_out'];
		$data['hn']=@$_GET['hn'];
		$data['statusid']=$_GET['statusid'];
		$this->template->set_layout('blank');	
		
		if($way=="chk_idcard"){
				$data['hn']=$_GET['hn'];
				$data['cardW0']=substr($_GET['idcard'],0,1);
				$data['cardW1']=substr($_GET['idcard'],1,4);
				$data['cardW2']=substr($_GET['idcard'],5,5);
				$data['cardW3']=substr($_GET['idcard'],10,2);
				$data['cardW4']=substr($_GET['idcard'],12,13);
				$data['statusid']=$_GET['statusid'];
				
				$this->template->build("popup_chk_idcard",$data);
				
		}else{
				$this->template->build("popup_chk_idcard_informhn",$data);
		}
	
	}


	function form($id=FALSE,$historyid=FALSE,$in_out=FALSE,$process=FALSE)
	{
			//$this->db->debug=TRUE;				
			$data['in_out']=$in_out;
			$data['historyid']=$historyid;		
			if($process=="addnew"){
				$data['rs']=$this->history->get_row("historyid",$historyid);	
			}else{
				## กดเลือก 	view หรือ เรคอร์ดที่ถูกบันทึกในฐานข้อมูลแล้ว กรณีผู้ที่มีสิทธิ์สามารถดูได้ทั้งหมด
				$data['rs']=$this->inform->select("n_information.*,n_history.*,n_hospital_1.*")										
															->join("INNER JOIN n_history ON n_history.historyid=information_historyid
																		 INNER JOIN n_hospital_1 ON n_hospital_1.hospital_code=n_information.hospitalcode")
															->get_row($id);	
				if($this->session->userdata('R36_LEVEL')=="05"){
					$data['hp']=$this->hospital->get_row("hospital_code",$this->session->userdata('R36_HOSPITAL'));
					$data['rs']['hospital_code']=$data['hp']['hospital_code'];
					$data['rs']['hospital_province_id']=$data['hp']['hospital_province_id'];
					$data['rs']['hospital_amphur_id']=$data['hp']['hospital_amphur_id'];
					$data['rs']['hospital_district_id']=$data['hp']['hospital_district_id'];
				}					
			}
			if(isset($_GET['hn'])){
				$data['rs']['hn']=@$_GET['hn'];
			}			
			$idcard=$data['rs']['idcard'];
			$data['cardW0']=substr($idcard,0,1);
			$data['cardW1']=substr($idcard,1,4);
			$data['cardW2']=substr($idcard,5,5);
			$data['cardW3']=substr($idcard,10,2);
			$data['cardW4']=substr($idcard,12,13);		
			$data['value_disabled']=($id)? ' disabled="disabled"':'';			
			$data['process']=$process;
			$this->template->build('inform_form',$data);
				
	}

	function addnew($hospitalprovince=FALSE,$hospitalamphur=FALSE,$hospital=FALSE,$in_out=FALSE,$historyid=FALSE)
	{// กรณีกรอกข้อมูล hn ครั้งแรก
		$data['process']="addnew";
		$data['rs']=$this->history->get_row("historyid",$historyid);		
		$data['rs']['hn']=@$_GET['hn'];	
		$data['value_disabled']='';
		$data['rs']['idcard']=@$_GET['idcard'];
		$data['rs']['statusid']=@$_GET['statusid'];
		$data['rs']['hospitalprovince']=$hospitalprovince;
		$data['rs']['hospitalamphur']=$hospitalamphur;
		$data['rs']['hospitalcode']=$hospital;
		if($data['rs']){
			$data['cardW0']=substr(@$data['rs']['idcard'],0,1);
			$data['cardW1']=substr(@$data['rs']['idcard'],1,4);
			$data['cardW2']=substr(@$data['rs']['idcard'],5,5);
			$data['cardW3']=substr(@$data['rs']['idcard'],10,2);
			$data['cardW4']=substr(@$data['rs']['idcard'],12,13);		
			
			if($data['rs']['idcard']){
				$data['value_disabled']=' disabled="disabled"';
			}	
		}else{
			

			$data['rs']['historyid']=$historyid;
			$data['cardW0']=substr(@$_GET['idcard'],0,1);
			$data['cardW1']=substr(@$_GET['idcard'],1,4);
			$data['cardW2']=substr(@$_GET['idcard'],5,5);
			$data['cardW3']=substr(@$_GET['idcard'],10,2);
			$data['cardW4']=substr(@$_GET['idcard'],12,13);	
			$data['value_disabled']='';		
		}

		$data['in_out']=$in_out;	
	
		$this->template->build('inform_form',$data);
	}

	function index_dead()
	{
		  	//$this->db->debug=TRUE;	  	  	
			$wh='';
			if(!empty($_GET['startdate']))				$wh.=" AND n_historydead.datetouch >='".cld_date2my($_GET['startdate'])."'";			
			if(!empty($_GET['enddate']))				$wh.=" AND n_historydead.datetouch <='".cld_date2my($_GET['endate'])."'";			
			if(!empty($_GET['hospitalprovince']))	$wh.=" AND n_historydead.hospitalprovince='".$_GET['hospitalprovince']."'";		
		  	if(!empty($_GET['hospitaldistrct']))		$wh.=" AND n_historydead.hospitalamphur='".$hospitalamphur."'";		
		  	if(!empty($_GET['hospital']))				$wh.=" AND n_information.hospitalcode='".$_GET['hospital']."'";			
			if(!empty($_GET['name']))$wh.=" AND (firstname LIKE '%".$_GET['name']."%' OR surname LIKE '%".$_GET['name']."%' OR idcard LIKE '%".$_GET['name']."%')";			
			if(!empty($_GET['provinceidplace']))	$wh.=" AND provinceidplace='".$_GET['provinceidplace']."'";
			if(!empty($_GET['amphuridplace']))	$wh.=" AND amphuridplace='".$_GET['amphuridplace']."'";
			if(!empty($_GET['districtidplace']))		$wh.=" AND districtidplace ='".$_GET['districtidplace']."'";
			
			if(empty($_GET['btn_save'])){
				$data['result']=$this->dead->where(" id<>'' $wh")->sort("")->order("id desc")->limit(20)->get();			
			}
		$data['pagination']=$this->dead->pagination();			
		$this->template->build('inform_dead_index',$data);
	}
	function form_dead($id=FALSE)
	{			
		$data['rs']=$this->dead->get_row($id);		
		$this->template->build('inform_dead_form',$data);
	}
	function form_dead1($id=FALSE)
	{			
		$data['rs']=$this->dead->get_row($id);		
		$this->template->build('inform_dead_form1',$data);
	}
	function save_dead()
	{
		$_POST['endate']=(empty($_POST['enddate'])) ? "":cld_date2my($_POST['endate']);
		$_POST['startdate']=(empty($_POST['startdate'])) ? "":cld_date2my($_POST['startdate']);
		$_POST['reportdate']=cld_date2my($_POST['reportdate']);
		$this->head->save($_POST);
		redirect('inform/index_dead');
	}
	function save(){
		/*  ป้องกันการบันทึกข้อมูลผู้สัมผัสโรคซ้ำ : ตรวจสอบรหัสบัตรประชาชนก่อนบันทึกลง n_history ถ้ามีแล้วให้ update ถ้าไม่มี insert  	
		 *   ที่ยอมให้บันทึกได้หลายเรคอร์ด - ไมได้ตรวจสอบก่อนบันทึก, ผู้สัมผัสโรคอาจย้ายที่อยู่ และสถานที่สัมผัสโรคคนละที่-				
		 * 
		 */	
		//$this->db->debug=TRUE;			
		if($_POST['statusid']=='1'){ 
					$_POST['idcard']=$_POST['cardW0'].$_POST['cardW1'].$_POST['cardW2'].$_POST['cardW3'].$_POST['cardW4'];						
		}else if($_POST['statusid']=='2'){
					$_POST['idcard']=$_POST['idpassport'];
		}
		$historyid=$this->db->GetOne("select historyid from n_history where idcard= ?  and statusid= ? and idcard<>0",array($_POST['idcard'],$_POST['statusid']));
		//table n_history
						if(isset($_POST['chkage'])=='Y'){			$_POST['age']=0;$_POST['age_group']=1;
						}else if($_POST['age'] < 1){			$_POST['age']=0;$_POST['age_group']=1;
						}else if($_POST['age']>=1    && $_POST['age'] <=5){$_POST['age_group']=2;
						}else if($_POST['age']>=6 	&& $_POST['age'] <=10){$_POST['age_group']=3;
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
		$this->history->primary_key('historyid');
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
						if($_POST['vaccine_date'][$c]!='' && $_POST['vaccine_name'][$c]!='' && $_POST['vaccine_cc'][$c]!='' && $_POST['vaccine_point'][$c]!='' ){
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
		
		/*echo '<pre>';
		var_dump($_POST['occupationname']);	
		echo '</pre>';	
		exit;*/
				
		$information_id=$this->inform->save($_POST);
		//   ------++++------    table n_vaccine	------++++------ 	
		$this->vaccine->primary_key('vaccine_id');
		$this->vaccine->delete("information_id",$information_id);
		if($_POST['means']!='3' && $_POST['means']!=''){
			$j=($_POST['means']=="2")?4:5;			
					for($i=0;$i<$j;$i++){
								if($_POST['vaccine_date'][$i]!=''){
									$data=array('vaccine_id'=>'','information_id'=>$information_id,'vaccine_date' =>cld_date2my($_POST['vaccine_date'][$i])
														 ,'vaccine_name'=>$_POST['vaccine_name'][$i],'vaccine_no'=> $_POST['vaccine_no'][$i]
														 , 'vaccine_cc'=>$_POST['vaccine_cc'][$i] ,'vaccine_point'=>$_POST['vaccine_point'][$i]
														 ,'byname'=> $_POST['byname'][$i],'byplace'=> $_POST['byplace'][$i]
														,'updatetime'=>@$_POST['updatetime'],'created'=>@$_POST['created']);									
									$this->vaccine->save($data);
								}	
					}
		}
		//  ------++++------    End n_vaccine  ------++++------ 
		set_notify('success', SAVE_DATA_COMPLETE);		
		redirect('inform/form/'.$information_id.'/'.$_POST['historyid'].'/'.$_POST['in_out'].'/'.$_POST['process']);
	}
	function  save_vaccine()
	{
		echo'<pre>';
		print_r($_POST);
		echo '</pre>';		
		//var_dump($_POST);	
	}

	function addContactTime()
	{
		//$this->db->debug=TRUE;	
		$rs=$this->db->GetRow("select * from n_history where  historyid=(select max(historyid) from n_history where idcard='".$_GET['idcard']."')");
		$rs['hn_no']=$this->db->GetOne("select count(id)+1 from n_information 
													                 left join n_history on n_information.information_historyid=n_history.historyid 
													                 where idcard =  ?  ",$_GET['idcard']);			
		$rs['amphur_name']=$this->db->GetOne("select amphur_name from n_amphur where province_id= ? and amphur_id = ? ",array($rs['provinceid'],$rs['amphurid']));
		$rs['district_name']=$this->db->GetOne("select district_name from n_district where province_id= ? and amphur_id= ? and district_id= ? ",array($rs['provinceid'],$rs['amphurid'],$rs['districtid']));
		echo json_encode($rs);
	}
	function chk_idcard(){
	   if(@$_GET['idcard']!=""){
				for($i=0;$i<13;$i++){
						$idcard_arr[]=substr($_GET['idcard'],$i,1);
				}		
				$chk=chk_idcard($idcard_arr,$_GET['digit_last']);	
				$data['chk']=$chk;			
			
			}else{
				$data['chk']="no";					 
			}
			echo json_encode($data);
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
			if($id){
				$data['show']="duplicate";
			}
			echo json_encode($data);	
	}
	function delete($id,$historyid){
		if($id && $historyid){
			$this->inform->delete($id);
			$this->history->delete("historyid",$historyid);
			$this->vaccine->delete("information_id",$id);
			set_notify('success', DELETE_DATA_COMPLETE);				
		}
		redirect('inform');
		
	}
	function dead_delete($id){
		if($id){
			$this->dead->delete($id);
		}
		redirect('inform/index_dead');
	}
}
?>
