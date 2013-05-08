<?php
class User extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model','user');
		$this->load->model('inform/inform_model','inform');
		$this->load->model('hospital/hospital_model','hospital');
		$this->load->model('inform/vaccine_model','vaccine');
	}
	function index()
	{// หน้าแรก
			$data['rs']=$this->user->get_row("uid",$this->session->userdata('R36_UID'));	
			 $data['chk']="";
			 if($this->session->userdata('schedule')=="yes"){				 					
				 if($this->session->userdata('R36_LEVEL')=='00' || $this->session->userdata('R36_LEVEL')=='02' || $this->session->userdata('R36_LEVEL')=='03' || $this->session->userdata('R36_LEVEL')=='05')
				 {### ผู้ดูแลระบบระดับกรม, ผู้ดูแลระดับจังหวัด, ผู้ดูแลระดับตำบล, staff	 	 ###
				 	$data['chk']="show_popup";
				 }	
			 }
			$this->template->build('user_index',$data);
		
	}


	function search($show="search",$id=FALSE)
	{
		//$this->db->debug=TRUE;
				$wh="uid <> '' ";
				if(@$_GET['name']!='')$wh.=" AND (userfirstname LIKE '%".$_GET['name']."%' OR usersurname LIKE '%".$_GET['name']."%' OR usermail LIKE '%".$_GET['name']."%' OR username LIKE '%".$_GET['name']."%')";
				//if(@$_GET['usersurname']!='')$wh.=" AND usersurname LIKE '%".$_GET['usersurname']."%'";			
				//if(@$_GET['usermail']!='')$wh.=" AND usermail LIKE '%".$_GET['usermail']."%'";				
				if(@$_GET['userposition']!='')	$wh.=" AND userposition = '".$_GET['userposition']."'";
				if(@$_GET['userprovince']!="") $wh.=" AND userprovince ='".$_GET['userprovince']."'";				
				//if(@$_GET['username']!='')$wh.=" AND username = '".$_GET['username']."'";	
				if(@$_GET['hospital']!='')$wh.=" AND userhospital ='".$_GET['hospital']."'";					
				if(isset($_GET['form_add']))$wh.=" AND form_add ='".$_GET['form_add']."'";
				if(isset($_GET['form_edit']))$wh.=" AND form_edit ='".$_GET['form_edit']."'";	
				if(isset($_GET['form_del']))$wh.=" AND form_del ='".$_GET['form_del']."'";	
					$sql ="SELECT uid, username, userfirstname, usersurname,level_name,userprovince,userhospital,userposition
											  ,province_name,hospital_name												
								FROM n_user 
								INNER JOIN n_level_user  	ON  n_user.userposition=n_level_user.level_code
								LEFT  JOIN n_province     		ON  n_user.userprovince=n_province.province_id
								LEFT  JOIN n_hospital_1 	 	 	ON  userhospital =n_hospital_1.hospital_code 																
								WHERE  $wh  order by userposition asc";

					if($_GET){
					$data['result']=$this->user->get($sql);
					$data['pagination']=$this->user->pagination();			
					}else{$data['result']=array();$data['pagination']="";}		
					$this->template->build('user_list',$data);					
	}
	function form($id=FALSE)
	{
			//$this->db->debug=TRUE;
			$this->user->primary_key("uid");
			if(!$id){$id="?";}				
			$data['rs']=$this->user->select("uid, username, userfirstname, usersurname,level_name,userprovince,userhospital,userposition,level_name,usermail,userpassword
																				,a.province_name as province_name1,a.province_id as province_id1
																				,b.province_name as province_name2,b.province_id as province_id2,n_amphur.amphur_id
																				,hospital_name,amphur_name")
																->join("INNER JOIN n_level_user  ON  n_user.userposition=n_level_user.level_code
																				LEFT  JOIN n_province  a   ON  n_user.userprovince=a.province_id
																				LEFT  JOIN n_hospital_1 	     ON  userhospital =n_hospital_1.hospital_code 								
																				LEFT  JOIN n_province  b  ON  n_hospital_1.hospital_province_id=b.province_id 
																				LEFT  JOIN n_amphur 		 ON  n_hospital_1.hospital_amphur_id=n_amphur.amphur_id  
																															and  userhospital =n_hospital_1.hospital_code 
																															and n_amphur.province_id=n_hospital_1.hospital_province_id 
																				")
																->get_row($id);	
			
			$this->template->build('user_form',$data);					
	}
	function save()
	{
		if($_POST){
			$this->user->save();
		}
		set_notify('success',SAVE_DATA_COMPLETE);
	}
	/*public function ListAmphur()
	{
			 if($_GET){
			 	echo from_dropdown('amphur',get_option('amphur_id','amphur_name','n_amphur where province_id='.$_GET['ref1'],'','-โปรดเลือก-','id="'.$_GET['name'].'"'));
			 }
			 
	}
	public function ListHospital()
	{
			if($_GET){
			 	echo from_dropdown('district',get_option('hospital_code','hospital_name',"n_hospital_1 where hospital_province_id='".$_GET['ref1']."' and hospital_amphur_id= '".$_GET['ref2']."'",'','-โปรดเลือก-','id="'.$_GET['name'].'"'));
			 }
	}*/
	
	function delete(){	
		$this->db->Execute("DELETE FROM n_user WHERE uid in(".$_GET['id'].")");				
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
	function logout()
	{
		logout();
		redirect('user/admin/user/index');
	}

}

?>