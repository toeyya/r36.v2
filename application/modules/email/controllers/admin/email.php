<?php
class Email extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('province/province_model','province');
		$this->load->model('users/user_model','user');				
	}
	
	function index()
	{
			$data['province'] = $this->province->sort("")->order("province_name asc")->limit(80)->get();	
			$this->template->build('admin/index',$data);				
	}		
	function save()
	{
		if($_POST)
		{
			$userposition  = $this->session->userdata('R36_LEVEL');	
			$subject = $_POST['subject'];	
			$message = $_POST['message'];
			$_POST['userprovince'] =($userposition=="02") ? $this->session->userdata('R36_PROVINCE'):$_POST['userprovince'];	
			$address = $this->user->select("usermail")
								  ->where("usermail <>'xx@moph.go.th' and active ='1'  and
								  		  (usermail<>'' or usermail is not null) 
								  		   and (userprovince='".$_POST['userprovince']."' 
								  		   OR userhospital in(select hospital_code from n_hospital_1 where hospital_province_id ='".$_POST['userprovince']."')			  		  
								  		   OR useramphur in (select amphur_id from n_amphur where province_id='".$_POST['userprovince']."')) 
								  		  ")
					   			  ->sort("")->order("uid asc")->get();				
			$redirect="email/admin/email/index/";				
			set_notify('success', "ส่งข้อมูลเรียบร้อยแล้วค่ะ");
			phpmail($subject,$address,$message,$redirect);						
		}				
	}
	


	

}
?>