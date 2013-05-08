<?php
class Log extends R36_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('log_model','log');
		
	}
	function index()
	{ //$this->db->debug=TRUE;
		$name="";
		if(@$_GET['fullname']){
			@list($userfirstname, $usersurname)=explode(' ',$_GET['fullname']);		
			if($userfirstname!='' && $usersurname!=''){
				$name=" and userfirstname LIKE '%".$userfirstname."%' OR usersurname LIKE '%".$usersurname."%'";
			}else{
				$name=" and userfirstname LIKE '%".$userfirstname."%' OR usersurname LIKE '%".$userfirstname."%'";
			}
		}		
		$action=(@$_GET['action']!='')? " and action ='".$_GET['action']."'" :"";
		if(@$_GET['firstDate'] && @$_GET['lastDate']){
			$firstDate=date2DB($_GET['firstDate']);		
			$lastDate=date2DB($_GET['lastDate']);
			$dd=" and date(created) BETWEEN '".$firstDate."' and '".$lastDate."'";
		}else{
				$dd=(@$_GET['firstDate']!='')?" and date(created)='".date2DB($_GET['firstDate'])."'":"";		
		}
		$where="";
		$where .=(!empty($_GET['hospital']))? " and userhospital=".$_GET['hospital']:"";		
		$data['result']=$this->log->select("n_logs.*,CONCAT(userfirstname,' ',usersurname) as fullname,userposition")
													 ->join(' LEFT JOIN n_user on n_logs.uid=n_user.uid')
													 ->where(" n_logs.uid<>'' $name $action $dd $where")
													 ->sort("")->order("n_logs.created DESC")->get();
													 
		if(!empty($_GET['action'])=="เข้าสู่ระบบ"){
			$sql="select max(created)as created,max(id) as id,uid,action,detail from n_logs 
						where uid<>'' $dd and action='เข้าใช้ระบบ' group by uid"	;
			$data['result']=$this->log->select("max(created)as created,max(id) as id,n_logs.uid as uid
																		 ,action,detail,CONCAT(userfirstname,' ',usersurname) as fullname,userposition,ipaddress")
													 ->join(' LEFT JOIN n_user on n_logs.uid=n_user.uid')
													 ->where("n_logs.uid<>'' $name $action $dd")
													 ->groupby("n_logs.uid")
													 ->sort("")->order("n_logs.created DESC")->get();
		}
		$data['pagination']=$this->log->pagination();
		$this->template->build('log_index',$data);
	}

}
?>
