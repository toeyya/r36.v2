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
	function index($show="search",$id=FALSE)
	{	//$this->db->debug=true;
				$this->level=$this->session->userdata('R36_LEVEL');				
				$wh="uid <> '' ";
				if(!empty($_GET['name']))$wh.=" AND (userfirstname LIKE '%".$_GET['name']."%' OR usersurname LIKE '%".$_GET['name']."%' OR hospital_name LIKE '%".$_GET['name']."%' OR username LIKE '%".$_GET['name']."%')";		
				if(!empty($_GET['userposition']))	$wh.=" AND userposition = '".$_GET['userposition']."'";		
						
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
				$data['result'] = $this->user->select("uid, username, userfirstname, usersurname,level_name,userprovince,userhospital,userposition
									 									 ,province_name,hospital_name,active,confirm_province,confirm_admin")
														    ->join("INNER JOIN n_level_user  	ON  n_user.userposition=n_level_user.level_code
																	   LEFT  JOIN n_province     	ON  n_user.userprovince=n_province.province_id
																	   LEFT  JOIN n_hospital_1 	ON  userhospital =n_hospital_1.hospital_code and hospital_code <>''")
													      ->where($wh)->sort("")->order("uid desc")->get();

					$data['pagination']=$this->user->pagination();				
					$this->template->append_metadata(js_checkbox());
					$this->template->build('admin/users/index',$data);					
	}
	function form($id=FALSE,$profile=FALSE)
	{		
			$this->template->append_metadata(js_idcard());	
			$this->user->primary_key("uid");	
			if(!$id){$id="?";}				
			$data['rs']=$this->user->select("n_user.*,level_name, a.province_name as province_name1
											,b.province_name as province_name2,b.province_id as province_id2,hospital_amphur_id,hospital_district_id,status
											,hospital_name")
									->join("LEFT JOIN n_level_user  ON  n_user.userposition=n_level_user.level_code
											LEFT  JOIN n_province  a   ON  n_user.userprovince=a.province_id
											LEFT  JOIN n_hospital_1 	     ON  n_user.userhospital =n_hospital_1.hospital_code								
											LEFT  JOIN n_province  b  ON  n_hospital_1.hospital_province_id=b.province_id 
											LEFT  JOIN n_district		 ON  n_hospital_1.hospital_amphur_id=n_district.amphur_id  
													and  n_user.userhospital =n_hospital_1.hospital_code
													and n_district.province_id=n_hospital_1.hospital_province_id 
													and n_district.district_id=n_hospital_1.hospital_district_id
																				")
																->get_row($id);	
			$data['cardW0']=substr($data['rs']['idcard'],0,1);
			$data['cardW1']=substr($data['rs']['idcard'],1,4);
			$data['cardW2']=substr($data['rs']['idcard'],5,5);
			$data['cardW3']=substr($data['rs']['idcard'],10,2);
			$data['cardW4']=substr($data['rs']['idcard'],12,1);
			$data['title']=($profile)? "ประวัติส่วนตัว":"ข้อมูลผู้ใช้ระบบ (แก้ไข/เพิ่ม)";
			$data['profile']=$profile;
			$this->template->build('admin/users/form',$data);					
	}
	function save($profile=false)
	{		
		if($_POST){
			if(!empty($_POST['id']))$_POST['uid']=$_POST['id'];
			// กรณีติ๊กจาก เช็คบ็อค ถ้าไม่ใส่ if จะทำให้ข้อมูลบัตรประชาชนหาย			
			if(!empty($_POST['cardW0']))$_POST['idcard'] = $_POST['cardW0'].$_POST['cardW1'].$_POST['cardW2'].$_POST['cardW3'].$_POST['cardW4'];								
			if($_POST['userposition']=="00" || $_POST['userposition']=="01" || $_POST['userpostion']=="02"){
				$_POST['userhospital']="";$_POST['userprovince']="";
			}else if($_POST['userpostion']!="02"){
				$_POST['userprovince']="";
			}			
			$this->user->save($_POST);
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
	function popup(){
			$this->template->set_layout('blank');		
			$this->template->build('popup_list');		
	}
	function popup_list()
	{//$this->db->debug=TRUE;
		## # แสดงตารางนัดหมายคนไข้ได้อัตโนมัติ เมื่อถึงกำหนดในการับวัคซีนต่อไปโดยระบบจะต้องทำการแจ้งผ่านหน้าจอผู้ใช้งานได้ตลอดเวลา ###
			$this->session->unset_userdata('schedule');
			$yy=date('Y')+543;
			//$current_date=$yy.'-'.date('m').'-'.date('d');
			$current_date='2554-06-05';
			if($this->session->userdata('R36_PROVINCE')!='' && $this->session->userdata('R36_LEVEL')=='02'){
					$wh="AND provinceid = '".$this->session->userdata('R36_PROVINCE')."'  AND hospitalprovince <>  '".$this->session->userdata('R36_PROVINCE')."' ";
			}
			if($this->session->userdata('R36_HOSPITAL')){									
					$hospital=$this->hospital->get_row("hospital_code",$this->session->userdata('R36_HOSPITAL'));
					$wh="AND hospitalcode ='".$this->session->userdata('R36_HOSPITAL')."' 
								AND hospitalprovince='".$hospital['hospital_province_id']."'  
								AND hospitalamphur ='".$hospital['hospital_amphur_id']."' ";
			}
			if($this->session->userdata('R36_LEVEL')=='00'){
					$wh="AND ((provinceid = '10'  AND hospitalprovince <>  '10') OR (typeforeign='3' AND nationalityname!='1')) ";
			}
			$data['result']=$this->inform->select("hospitalcode,hn,hn_no,firstname,surname,in_out,means,total_vaccine ,id,historyid")
																->join("INNER Join n_history ON n_information.information_historyid = n_history.historyid
												 							  INNER Join n_vaccine ON n_information.information_historyid = n_vaccine.information_id ")	
																->where("information_historyid <>'' AND closecase <>'2' AND (means  IN (1,2)) AND hospitalcode <>''  
												 								AND n_vaccine.vaccine_date <>'' and vaccine_date >='".$current_date."' $wh AND n_information.total_vaccine<>'5' ")	
																->groupby("information_id")->sort("")->order("n_information.id asc")->limit(100)->get();	
			$data['current_date']=$current_date;												
			$this->template->set_layout('blank');		
			$this->template->build('popup_list',$data);
	}


	
}

?>