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
		$this->user->primary_key("uid");
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
			if($_POST['userposition']=="00" || $_POST['userposition']=="01" || $_POST['userpostion']=="02"){
				$_POST['userhospital']="";$_POST['userprovince']="";
			}else if($_POST['userpostion']!="02"){
				$_POST['userprovince']="";
			}
			$_POST['idcard'] = $_POST['cardW0'].$_POST['cardW1'].$_POST['cardW2'].$_POST['cardW3'].$_POST['cardW4'];		
			$this->user->save($_POST);
			set_notify('success',SAVE_DATA_COMPLETE);
		}
		redirect('users/r36/users/index/'.$_POST['uid']);
	}
	
	
}

?>