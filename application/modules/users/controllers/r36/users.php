<?php
class Users extends R36_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model','user');
		$this->load->model('inform/inform_model','inform');
		$this->load->model('hospital/hospital_model','hospital');
		$this->load->model('inform/vaccine_model','vaccine');
		$this->load->model('user_level_model','level');
		$this->user->primary_key("uid");
		$this->template->append_metadata(js_idcard());
	}
	function index($id=FALSE)
	{ //$this->db->debug=TRUE;
		if(!$id){$id="?";}				
			$data['rs']=$this->user->select("n_user.*,level_name, a.province_name as province_name1,a.province_id as province_id1
											,b.province_name as province_name2,hospital_province_id,hospital_amphur_id,hospital_district_id,status
											,hospital_name")
								->join("INNER JOIN n_level_user  ON  n_user.userposition=n_level_user.level_code
										LEFT  JOIN n_province  a   ON  n_user.userprovince=a.province_id
										LEFT  JOIN n_hospital_1 	     ON  userhospital =n_hospital_1.hospital_code 								
										LEFT  JOIN n_province  b  ON  n_hospital_1.hospital_province_id=b.province_id 
										LEFT  JOIN n_district		 ON  n_hospital_1.hospital_amphur_id=n_district.amphur_id  
													and  n_user.userhospital =n_hospital_1.hospital_code 
													and n_district.province_id=n_hospital_1.hospital_province_id 
													and n_district.district_id=n_hospital_1.hospital_district_id")
								->get_row($id);	

		$data['cardW0']=substr($data['rs']['idcard'],0,1);
		$data['cardW1']=substr($data['rs']['idcard'],1,4);
		$data['cardW2']=substr($data['rs']['idcard'],5,5);
		$data['cardW3']=substr($data['rs']['idcard'],10,2);
		$data['cardW4']=substr($data['rs']['idcard'],12,1);
		
		$this->template->build('r36/user_index',$data);					
	}
	function save()
	{
		if($_POST){
			
			$_POST['idcard'] = $_POST['cardW0'].$_POST['cardW1'].$_POST['cardW2'].$_POST['cardW3'].$_POST['cardW4'];					
			$_POST['gen_id']=generate_password(20);		
			$id = $this->user->save($_POST);
	 				
			$userposition = $_POST['userposition'];			
			$arr_00 = array('uid'=>$id,'userprovince'=>'','userlevel'=>'','userhospital'=>'','useramphur'=>'','userdistrict'=>'','agency'=>'');		
			$arr_01 = array('uid'=>$id,'userprovince'=>'','userhospital'=>'','useramphur'=>'','userdistrict'=>'','agency'=>'');	
			$arr_02 = array('uid'=>$id,'userlevel'=>'','userhospital'=>'','useramphur'=>'','userdistrict'=>'');	
			$arr_03 = array('uid'=>$id,'userlevel'=>'','userhospital'=>'','userdistrict'=>'');	
			$arr_04 = array('uid'=>$id,'userlevel'=>'','userhospital'=>'');
			$arr_05 = array('uid'=>$id,'userprovince'=>'','userlevel'=>'','useramphur'=>'','userdistrict'=>'','agency'=>'');			
			$arr_06 = array('uid'=>$id,'userprovince'=>'','userlevel'=>'','userhospital'=>'','useramphur'=>'','userdistrict'=>'','agency'=>'');								
			$this->user->save(${'arr_'.$userposition});			
			set_notify('success',SAVE_DATA_COMPLETE);
			if(empty($_POST['confirm_email'])){							   
			   	$subject = "ยืนยันการลงทะเบียน(ระบบรายงานผู้สัมผัสโรคพิษสุนัขบ้า ร.36)";
			    $message ='<div><img src="'.base_url().'themes/default/media/images/email_head.png" width="711px" height="108px"></di>';
				$message.='<hr>';
				$message.='<p>เรียนคุณ'.$_POST['userfirstname'].' '.$_POST['usersurname'].', </p>';
				$message.='<p>ขอบคุณสำหรับการลงทะเบียนค่ะ  ข้อมูลบัญชีของคุณจะใช้ได้เมื่อ คุณยืนยันการลงทะเบียน/p>';
				$message.='<p>กรุณาคลิกลิงค์ด้านล่างเพื่อยืนยันการลงทะเบียน</p>';
				$message.='<a href="'.base_url().'users/confirm_email/'.$id.'/'.$_POST['gen_id'].'">'.base_url().'users/confirm_email/'.$id.'/'.$_POST['gen_id'].'</a>';
				$redirect="users/notice_email";
				$address=$_POST['usermail'];		
				phpmail($subject,$address,$message,$redirect);				 
			}else{
				redirect('users/r36/users/index/'.$_POST['uid']);
			}			
			
		}
		
	}
	
	
}

?>