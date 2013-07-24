<?php

function login($username=FALSE,$password=FALSE,$admin='') 
{
	$CI =& get_instance();	
	if($admin){
		$admin =" and userposition IN('00','01','02')";
	}
	$sql="SELECT * FROM n_user 
				INNER JOIN n_level_user ON n_user.userposition=n_level_user.level_code 
				WHERE n_user.usermail= ?  AND n_user.userpassword= ? and active='1' ".$admin;
	
	$rs = $CI->db->GetRow($sql,array($username,$password));	
	
	if($rs)
	{
		$CI->session->set_userdata('R36_UID',$rs['uid']);
		$CI->session->set_userdata('R36_LEVEL',$rs['userposition']);
		$CI->session->set_userdata('R36_LEVEL_NAME',$rs['level_name']);
		$CI->session->set_userdata('R36_FNAME',$rs['userfirstname']);
		$CI->session->set_userdata('R36_SURNAME', $rs['usersurname']);
		$CI->session->set_userdata('R36_MAIL', $rs['usermail']);
		$CI->session->set_userdata('R36_HOSPITAL',$rs['userhospital']);
		$CI->session->set_userdata('R36_PROVINCE',$rs['userprovince']);
		$CI->session->set_userdata('R36_DISTRICT',$rs['userdistrict']);
		$CI->session->set_userdata('confirm_email',$rs['confirm_email']);
		$CI->session->set_userdata('confirm_province',$rs['confirm_province']);
		$CI->session->set_userdata('confirm_admin',$rs['confirm_admin']);
		$CI->session->set_userdata('confirm_admin',$rs['confirm_admin']);
		
				
			if(!empty($rs['userhospital'])){
				$rec_hospital=$CI->db->GetRow("SELECT hospital_name,hospital_province_id,hospital_amphur_id,hospital_district_id FROM n_hospital_1 WHERE hospital_code= ? ",$rs['userhospital']);			
				$CI->session->set_userdata('R36_HOSPITAL_NAME', $rec_hospital['hospital_name']);			
				$CI->session->set_userdata('R36_HOSPITAL_PROVINCE',$rec_hospital['hospital_province_id']);
				$CI->session->set_userdata('R36_HOSPITAL_AMPHUR',$rec_hospital['hospital_amphur_id']);
				$CI->session->set_userdata('R36_HOSPITAL_DISTRICT',$rec_hospital['hospital_district_id']);
				$CI->session->set_userdata('schedule','yes');
			}
			
		return true;
	}
	else
	{				
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
function is_owner($id)
{
    $CI =& get_instance();
    if($id == $CI->session->userdata('R36_UID') && $CI->session->userdata('R36_UID') != 0)
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
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
function permission($module, $action)
{	
	$CI =& get_instance();
	$CI->load->model('users/user_level_model','level');
	$CI->load->model('permissions/permission_model','permission');
	$level_id = $CI->level->get_one('lid','level_code',$CI->session->userdata('R36_LEVEL'));
	$perm = $CI->permission->where("level_id = ".$level_id." and module = '".$module."'")->get();
	if(!empty($perm)){
		if($perm[0][$action]){
			return TRUE;
		}else{
			return FALSE;
		}		
	}else{
		return FALSE;
	}

}


		
?>