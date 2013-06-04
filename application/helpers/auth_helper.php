<?php

function login($username=FALSE,$password=FALSE,$remember=FALSE) 
{
	$CI =& get_instance();
	if($username=='' && $password=='' && $remember=="1")
	{	
		$CI->session->set_userdata('nologin','nologin');
		return true;
	}

	$sql="SELECT * FROM n_user 
				INNER JOIN n_level_user ON n_user.userposition=n_level_user.level_code 
				WHERE n_user.username= (?)  AND n_user.userpassword= (?) ";
	$rs = $CI->db->GetRow($sql,array($username,$password));	
	
	if($rs)
	{
		$CI->session->set_userdata('R36_UID',$rs['uid']);
		$CI->session->set_userdata('R36_LEVEL',$rs['userposition']);
		$CI->session->set_userdata('R36_LEVEL_NAME',$rs['level_name']);
		$CI->session->set_userdata('R36_USERNAME',$rs['username']);
		$CI->session->set_userdata('R36_FNAME',$rs['userfirstname']);
		$CI->session->set_userdata('R36_SURNAME', $rs['usersurname']);
		$CI->session->set_userdata('R36_MAIL', $rs['usermail']);
		$CI->session->set_userdata('R36_HOSPITAL',$rs['userhospital']);
		$CI->session->set_userdata('R36_PROVINCE',$rs['userprovince']);
		$CI->session->set_userdata('R36_DISTRICT',$rs['userdistrict']);
		$CI->session->set_userdata('R36_FROMADD',$rs['form_add']);
		$CI->session->set_userdata('R36_FROMEDIT',$rs['form_edit']);
		$CI->session->set_userdata('R36_FROMDELETE',$rs['form_del']);
		$CI->session->set_userdata('schedule','yes');
				
			if($rs['userhospital']!=''){
				$sql="SELECT hospital_name,hospital_province_id,hospital_amphur_id,hospital_district_id FROM n_hospital WHERE hospital_code= ? ";
				$rec_hospital=$CI->db->GetRow($sql,$rs['userhospital']);			
				$CI->session->set_userdata('R36_HOSPITAL_NAME', $rec_hospital['hospital_name']);
				$CI->session->set_userdata('R36_HOSPITAL_PROVINCE',$rec_hospital['hospital_province_id']);
				$CI->session->set_userdata('R36_HOSPITAL_AMPHUR',$rec_hospital['hospital_amphur_id']);
				$CI->session->set_userdata('R36_HOSPITAL_DISTRICT',$rec_hospital['hospital_district_id']);
			}
			
		return true;
	}
	else
	{				
		return false;
	}
	return false;
}

function admin_login($username=FALSE,$password=FALSE){
	// ผู้ดูแลระบบระดับกรม	
	$CI =& get_instance();	
	$CI->db->debug=TRUE;
	$sql="SELECT * FROM n_user	 WHERE  userposition='00' and   username= ?  AND userpassword= ? ";
	$rs = $CI->db->GetRow($sql,array($username,$password));	
	if($rs){
		$CI->session->set_userdata('R36_UID',$rs['uid']);	
		$CI->session->set_userdata('R36_FNAME',$rs['userfirstname']);
		$CI->session->set_userdata('R36_SURNAME', $rs['usersurname']);
		return true;
	}else{
		return false;
	}
}

function is_login()
{
	$CI =& get_instance();
	$sql="SELECT uid FROM n_user 
				INNER JOIN n_level_user ON n_user.userposition=n_level_user.level_code 
				WHERE uid= ? ";
	
	$id = $CI->db->GetOne($sql,$CI->session->userdata('R36_UID'));
	return ($id) ? true : false;
}
function login_data($field)
{
	$CI =& get_instance();
	$sql = 'select '.$field.' from n_user  where uid  = ?';
	return $CI->db->GetOne($sql,$CI->session->userdata('R36_UID'));
}

function logout()
{
	$CI =& get_instance();
	$CI->session->sess_destroy();

}



		
?>