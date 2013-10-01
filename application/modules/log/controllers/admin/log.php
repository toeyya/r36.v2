<?php
class Log extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('log_model','log');
		
	}
	public $reference= "แหล่งข้อมูล: โปรแกรมรายงานผู้สัมผัสโรคพิษสุนัขบ้า (ร.36) กลุ่มโรคติดต่อระหว่างสัตว์และคน สำนักโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข";
	function index()
	{   //$this->db->debug = true;
		$name="";$where="";	
		if(!empty($_GET['fullname']))
		{
			if(preg_match('/\s/',$_GET['fullname'])){
				list($userfirstname, $usersurname)=explode(' ',$_GET['fullname']);
			}else{
				$userfirstname = $_GET['fullname'];
			}								 	
														
			if(!empty($userfirstname) && !empty($usersurname)){
				$name=" and userfirstname LIKE '%".$userfirstname."%' AND usersurname LIKE '%".$usersurname."%'";
			}else{
				$name=" and userfirstname LIKE '%".$userfirstname."%'";
			}
		}		
		$action=(!empty($_GET['action']))? " and action ='".$_GET['action']."'" :"";
		if(!empty($_GET['firstDate']) && !empty($_GET['lastDate'])){
			$firstDate=date2DB($_GET['firstDate']);		
			$lastDate=date2DB($_GET['lastDate']);
			$dd=" and CONVERT(VARCHAR(10), n_logs.created, 120) BETWEEN '".$firstDate."' and '".$lastDate."'";
		}else{
			$dd=(!empty($_GET['firstDate']))?" and CONVERT(VARCHAR(10), n_logs.created, 120)='".date2DB($_GET['firstDate'])."'":"";		
		}
		$cond =(!empty($_GET['province_id']))? "  and userhospital <>'' and substring(userhospital,1,2) =".$_GET['province_id'] :'';
		$cond .=(!empty($_GET['amphur_id']))? "  and userhospital <>'' and substring(userhospital,3,2) =".$_GET['amphur_id'] :'';
		$cond .=(!empty($_GET['userposition'])) ? " and userposition='".$_GET['userposition']."'" :'';
		
		if(!empty($_GET['district_id'])){
			$cond .=" and userhospital in(
							select hospital_code from n_hospital_1 where  hospital_district_id='".$_GET['district_id']."' 
							and hospital_province_id ='".$_GET['province_id']."' and hospital_amphur_id ='".$_GET['amphur_id']."')";
		}
		$where .=(!empty($_GET['userhospital']))? " and userhospital=".$_GET['userhospital']:"";				
		$sql = "SELECT n_logs.id,n_logs.action,n_logs.detail,n_logs.ipaddress,n_logs.uid,userfirstname,usersurname,userposition
						,CONVERT(VARCHAR(19), n_logs.created, 120) AS [created]
			    FROM n_logs 
			    LEFT JOIN n_user on n_logs.uid=n_user.uid WHERE n_logs.uid<>'' $name $action $dd $where $cond ORDER BY n_logs.created DESC";
																				 
		if(!empty($_GET['action']) && $_GET['action']=="เข้าสู่ระบบ"){
		   $sql = "SELECT max(n_logs.created)as created,max(id) as id,n_logs.uid as uid,action,detail,userfirstname,usersurname,userposition,ipaddress
		   		   FROM n_logs 
		   		   LEFT JOIN n_user on n_logs.uid=n_user.uid
		   		   WHERE n_logs.uid<>'' $name $action $dd $where $cond GROUP BY  n_logs.uid ORDER BY n_logs.created DESC";
													 
		}
		$data['position'] =array('00'=>'ผู้ดูแลระบบระดับกรม(สำนักโรคติดต่อทั่วไป)','01'=>'ผู้ดูแลระบบระดับเขต','02'=>'ผู้ดูแลระบบระดับจังหวัด'
								,'03'=>'ผู้ดูแลระบบระดับอำเภอ','04'=>'ผู้ดูแลระบบระดับตำบล','05'=>'Staff','06'=>'ผู้ใช้ระบบทั่วไป');
		if(!empty($_GET['act'])){
			$data['fullname'] 		= (!empty($_GET['fullname'])) ? $_GET['fullname']:'ทั้งหมด';
			$data['firstDate']		= (!empty($_GET['firstDate'])) ?$_GET['firstDate']:'ทั้งหมด';
			$data['lastDate'] 		= (!empty($_GET['lastDate'])) ? $_GET['lastDate']:'ทั้งหมด';	
			$data['action']   		= (!empty($_GET['action'])) ? 	$_GET['action']:'ทั้งหมด';
			$data['province'] 		= (!empty($_GET['province_id']))?	province($_GET['province_id']):'ทั้งหมด';
			$data['amphur']   		= (!empty($_GET['amphur_id'])) ? 	amphur($_GET['province_id'],$_GET['amphur_id']):'ทั้งหมด';
			$data['district'] 		= (!empty($_GET['district_id']))?	district($_GET['province_id'],$_GET['amphur_id'],$_GET['district_id']):'ทั้งหมด';
			$data['position_name']  = (!empty($_GET['userposition'])) ?  getPosition($_GET['userposition']):'ทั้งหมด';
			$data['action']   		= (!empty($_GET['action'])) ? 	$_GET['action']:'ทั้งหมด';
			$data['hospital'] 		= (!empty($_GET['userhospital'])) ? hospital($_GET['userhospital']):'ทั้งหมด';
			$data['result']			= $this->log->get($sql,true);
			$data['pagination']		='';	
			$data['reference'] = $this->reference;
			$this->template->set_layout('print')->build('print',$data);
		}else{
			$data['result']=$this->log->get($sql);	
			$data['pagination']=$this->log->pagination();
		    $this->template->build('index',$data);
		}
		
	}

}
?>
