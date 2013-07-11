<?php
class Log extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('log_model','log');
		
	}
	function index()
	{ //$this->db->debug=TRUE;
		$name="";$where="";
		if(!empty($_GET['fullname'])){
			list($userfirstname, $usersurname)=explode(' ',$_GET['fullname']);		
			if($userfirstname!='' && $usersurname!=''){
				$name=" and userfirstname LIKE '%".$userfirstname."%' OR usersurname LIKE '%".$usersurname."%'";
			}else{
				$name=" and userfirstname LIKE '%".$userfirstname."%' OR usersurname LIKE '%".$userfirstname."%'";
			}
		}		
		$action=(!empty($_GET['action']))? " and action ='".$_GET['action']."'" :"";
		if(!empty($_GET['firstDate']) && !empty($_GET['lastDate'])){
			$firstDate=date2DB($_GET['firstDate']);		
			$lastDate=date2DB($_GET['lastDate']);
			$dd=" and date(n_logs.created) BETWEEN '".$firstDate."' and '".$lastDate."'";
		}else{
				$dd=(!empty($_GET['firstDate']))?" and date(n_logs.created)='".date2DB($_GET['firstDate'])."'":"";		
		}
		$cond =(!empty($_GET['province_id']))? "  and userhospital <>'' and substr(userhospital,1,2) =".$_GET['province_id'] :'';
		$cond .=(!empty($_GET['amphur_id']))? "  and userhospital <>'' and substr(userhospital,3,2) =".$_GET['amphur_id'] :'';
		$cond .=(!empty($_GET['userposition'])) ? " and userposition='".$_GET['userposition']."'" :'';
		if(!empty($_GET['district_id'])){
			$cond .=" and userhospital in(
							select hospital_code from n_hospital_1 where  hospital_district_id='".$_GET['district_id']."' 
							and hospital_province_id ='".$_GET['province_id']."' and hospital_amphur_id ='".$_GET['amphur_id']."')";
		}
		$where .=(!empty($_GET['hospital']))? " and userhospital=".$_GET['hospital']:"";		
		$data['result']=$this->log->select("n_logs.*,CONCAT(userfirstname,' ',usersurname) as fullname,userposition")
													 ->join(' LEFT JOIN n_user on n_logs.uid=n_user.uid')
													 ->where(" n_logs.uid<>'' $name $action $dd $where $cond")
													 ->sort("")->order("n_logs.created DESC")->get();
													 
		if(@$_GET['action']=="เข้าสู่ระบบ"){
			$sql="select max(n_logs.created)as created,max(id) as id,uid,action,detail from n_logs 
						where uid<>'' $dd and action='เข้าใช้ระบบ' group by uid"	;
			$data['result']=$this->log->select("max(n_logs.created)as created,max(id) as id,n_logs.uid as uid
																		 ,action,detail,CONCAT(userfirstname,' ',usersurname) as fullname,userposition,ipaddress")
													 ->join(' LEFT JOIN n_user on n_logs.uid=n_user.uid')
													 ->where("n_logs.uid<>'' $name $action $dd")
													 ->groupby("n_logs.uid")
													 ->sort("")->order("n_logs.created DESC")->get();
		}
		$data['pagination']=$this->log->pagination();
		$this->template->build('index',$data);
	}

}
?>
