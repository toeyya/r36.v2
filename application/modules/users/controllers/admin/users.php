<?php
class Users extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model','user');
		$this->load->model('inform/inform_model','inform');
		$this->load->model('hospital/hospital_model','hospital');
		$this->load->model('inform/vaccine_model','vaccine');
		$this->user->primary_key("uid");	
	}
	public $level;
	public $reference= "แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข";
	function index($show="search",$id=FALSE)
	{
				$this->level=$this->session->userdata('R36_LEVEL');				
				$wh="uid <> '' ";
				if(!empty($_GET['name']))$wh.=" AND (userfirstname LIKE '%".$_GET['name']."%' OR usersurname LIKE '%".$_GET['name']."%' OR hospital_name LIKE '%".$_GET['name']."%' OR username LIKE '%".$_GET['name']."%')";		
				if(!empty($_GET['userposition']))	$wh.=" AND userposition = '".$_GET['userposition']."'";	
				if(!empty($_GET['userhospital'])){
					$wh.= " AND userhospital = '".$_GET['userhospital']."'";
				}else{
					if(!empty($_GET['useramphur']) && !empty($_GET['userprovince']) && !empty($_GET['userdistrict'])){
						$wh.=" AND (userdistrict ='".$_GET['userdistrict']."'  
							   OR userhospital in(select hospital_code from n_hospital_1 
							   					   where hospital_province_id ='".$_GET['userprovince']."' and hospital_amphur_id ='".$_GET['useramphur']."' and hospital_district_id ='".$_GET['userdistrict']."'))";												
					}elseif(!empty($_GET['useramphur']) && !empty($_GET['userprovince'])){
						$wh.=" AND (useramphur ='".$_GET['useramphur']."'  
							   OR userhospital in(select hospital_code from n_hospital_1 
							   					   where hospital_province_id ='".$_GET['userprovince']."' and hospital_amphur_id ='".$_GET['useramphur']."'))";												
					}elseif(!empty($_GET['userprovince'])){
						$wh.=" AND (userprovince = '".$_GET['userprovince']."' 
							   OR userhospital in(select hospital_code from n_hospital_1 
							   					   where hospital_province_id ='".$_GET['userprovince']."'))";						
					}
									
				}
	 						
				//****************************show data depend on permission
					if($this->level=="02" || $this->level=="03" || $this->level=="04"){						
						if($this->level=="02"){
							$col=" hospital_province_id =".$this->session->userdata('R36_PROVINCE');
						}elseif($this->level=="03" || $this->level=="04"){						
							$hospital_name=$this->session->userdata('R36_HOSPITAL');
							$province=substr($hospital_name,0,2);
							$amphur=substr($hospital_name,3,2);	
							$district=substr($hospital_name,4,2);
							$district_wh=($this->level=="04")?" and hospital_district_id=$district":'';
							$col=" hospital_province_id =$province and hospital_amphur_id=$amphur".$district_wh;			
						}
							$wh.=" and userhospital IN(select hospital_code from n_hospital_1 where ".$col.")";													
					}
				//**********************************
		
		$sql = "SELECT uid, username, userfirstname, usersurname,level_name,userprovince,userhospital,userposition
					  ,province_name,hospital_name,active,confirm_province,confirm_admin,CONVERT(VARCHAR(10), n_user.created, 120) AS [created]
					  ,userlevel,useramphur,userdistrict,agency 
				FROM n_user
				INNER JOIN n_level_user  	ON  n_user.userposition=n_level_user.level_code
				LEFT  JOIN n_province     	ON  n_user.userprovince=n_province.province_id
				LEFT  JOIN n_hospital_1 	ON  userhospital =n_hospital_1.hospital_code and hospital_code <>'' WHERE $wh ORDER BY uid desc,userfirstname";
		
		if(!empty($_GET['act'])){			
			$data['province'] = (!empty($_GET['userprovince']))? province($_GET['userprovince']):'ทั้งหมด';
			$data['amphur']   = (!empty($_GET['useramphur'])) ? amphur($_GET['userprovince'],$_GET['useramphur']):'ทั้งหมด';
			$data['district'] = (!empty($_GET['userdistrict'])) ? district($_GET['userprovince'],$_GET['useramphur'],$_GET['district_id']):'ทั้งหมด';
			$data['position_name']  = (!empty($_GET['userposition'])) ? getPosition($_GET['userposition']):'ทั้งหมด';
			$data['hospital'] 		= (!empty($_GET['userhospital'])) ? hospital($_GET['userhospital']):'ทั้งหมด';
			$data['name'] =(!empty($_GET['name'])) ? $_GET['name'] : 'ทั้งหมด';
			$data['result']=$this->user->get($sql,true);
			$data['pagination']='';	
			$data['reference'] = $this->reference;
			$this->template->set_layout('print')->build('admin/users/print',$data);
		}else{
			$data['result']=$this->user->get($sql);	
			$data['pagination']=$this->user->pagination();
			$this->template->append_metadata(js_checkbox());
		    $this->template->build('admin/users/index',$data);	
		}				
				
	}
	function form($id=FALSE,$profile=FALSE)
	{	
			$this->template->append_metadata(js_idcard());	
			$data['disabled'] ='';
			if($this->session->userdata('R36_LEVEL')!="00"){
				$data['disabled'] ='disabled="disabled"';
			}
			$this->user->primary_key("uid");	
			if(!$id){$id="?";}				
			$data['rs']=$this->user->select("n_user.*,level_name, a.province_name as province_name1
											,b.province_name as province_name2,b.province_id as province_id2,hospital_amphur_id,hospital_district_id,status
											,hospital_name")
									->join("LEFT JOIN n_level_user   ON  n_user.userposition=n_level_user.level_code
											LEFT JOIN n_province  a  ON  n_user.userprovince=a.province_id
											LEFT JOIN n_hospital_1   ON  n_user.userhospital =n_hospital_1.hospital_code								
											LEFT JOIN n_province  b  ON  n_hospital_1.hospital_province_id=b.province_id 
											LEFT JOIN n_district	 ON  n_hospital_1.hospital_amphur_id=n_district.amphur_id  
													and n_user.userhospital =n_hospital_1.hospital_code
													and n_district.province_id=n_hospital_1.hospital_province_id 
													and n_district.district_id=n_hospital_1.hospital_district_id")
																->get_row($id);	
			
			$data['cardW0']=(!empty($data['rs']['idcard'])) ? substr($data['rs']['idcard'],0,1) :'';
			$data['cardW1']=(!empty($data['rs']['idcard'])) ? substr($data['rs']['idcard'],1,4) :'';
			$data['cardW2']=(!empty($data['rs']['idcard'])) ? substr($data['rs']['idcard'],5,5) :'';
			$data['cardW3']=(!empty($data['rs']['idcard'])) ? substr($data['rs']['idcard'],10,2):'';
			$data['cardW4']=(!empty($data['rs']['idcard'])) ? substr($data['rs']['idcard'],12,1):'';
			$data['title']=($profile)? "ประวัติส่วนตัว":"ข้อมูลผู้ใช้ระบบ (แก้ไข/เพิ่ม)";
			$data['profile']=$profile;
			$this->template->build('admin/users/form',$data);					
	}
	function save($profile=false)
	{	
		if($_POST)
		{			
			$userposition = $_POST['userposition'];
			if(!empty($_POST['id']))$_POST['uid']=$_POST['id'];
			// กรณีติ๊กจาก เช็คบ็อค ถ้าไม่ใส่ if จะทำให้ข้อมูลบัตรประชาชนหาย			
			if(!empty($_POST['cardW0']))$_POST['idcard'] = $_POST['cardW0'].$_POST['cardW1'].$_POST['cardW2'].$_POST['cardW3'].$_POST['cardW4'];								
			$_POST['agency'] =(!empty($_POST['agency'])) ? $_POST['agency'] : '';		
			$id = $this->user->save($_POST);
					
			$arr_00 = array('uid'=>$id,'userprovince'=>'','userlevel'=>'','userhospital'=>'','useramphur'=>'','userdistrict'=>'','agency'=>'');		
			$arr_01 = array('uid'=>$id,'userprovince'=>'','userhospital'=>'','useramphur'=>'','userdistrict'=>'','agency'=>'');	
			$arr_02 = array('uid'=>$id,'userlevel'=>'','userhospital'=>'','useramphur'=>'','userdistrict'=>'');	
			$arr_03 = array('uid'=>$id,'userlevel'=>'','userhospital'=>'','userdistrict'=>'');	
			$arr_04 = array('uid'=>$id,'userlevel'=>'','userhospital'=>'');
			$arr_05 = array('uid'=>$id,'userprovince'=>'','userlevel'=>'','useramphur'=>'','userdistrict'=>'','agency'=>'');			
			$arr_06 = array('uid'=>$id,'userprovince'=>'','userlevel'=>'','userhospital'=>'','useramphur'=>'','userdistrict'=>'','agency'=>'');		
			
			
			$this->user->save(${'arr_'.$userposition});
			
			if(!empty($_POST['send_mail'])){
				$subject="อนุมัติการใช้งาน(ระบบรายงานผู้สัมผัสโรคพิษสุนัขบ้า ร.36)";
				$message='<div><img src="'.base_url().'themes/default/media/images/email_head.png" width="711px" height="108px"></di>';
				$message.='<hr>';
				$message.='<p>เรียนคุณ'.$_POST['userfirstname'].' '.$_POST['usersurname'].', </p>';
				$message.='<p>เจ้าหน้าที่ตรวจสอบและอนุมัติการใช้งานระบบรายงานผู้สัมผัสโรคสุนัขบ้า ร.36 ของคุณแล้วค่ะ</p>';
				$message.='<p>username : '.$_POST['usermail'].'</p>';
				$message.='<p>password : '.$_POST['userpassword'].'</p>';								
				$address=$_POST['usermail'];
				phpmail($subject,$address,$message);
			}
			set_notify('success',SAVE_DATA_COMPLETE);
		}
		($profile) ?redirect('users/admin/users/form/'.$_POST['uid'].'/profile'):redirect('users/admin/users');
	}
	
	function delete($id){
		if($id){
			$this->user->delete("uid",$id);
			set_notify('success',DELETE_DATA_COMPLETE);		
		}
		redirect('users/admin/users');	
	}

}

?>