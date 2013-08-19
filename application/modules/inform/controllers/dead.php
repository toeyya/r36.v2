<?php
class Dead extends R36_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('inform_model','inform');
		$this->load->model('historydead_model','dead');
		$this->load->model('hospital/hospital_model','hospital');
		$this->load->model('occupation_model','occu');
		$this->load->model('vaccine_model','vaccine');
		$this->load->model("history_model",'history');
		$this->load->model('users/user_model','user');
		$this->template->append_metadata(js_idcard());
		$this->history->primary_key('historyid');		
	}
	function index()
	{ 								 	  	
			$wh='';
			if(!empty($_GET['startdate']))				$wh.=" AND endate  >='".cld_date2my($_GET['startdate'])."'";			
			if(!empty($_GET['enddate']))				$wh.=" AND endate <='".cld_date2my($_GET['endate'])."'";			
			if(!empty($_GET['provinceidplace']))		$wh.=" AND provinceidplace='".$_GET['provinceidplace']."'";		
		  	if(!empty($_GET['amphuridplace']))			$wh.=" AND amphuridplace='".$_GET['amphuridplace']."'";
		  	if(!empty($_GET['districtidplace']))		$wh.=" AND districtidplace='".$_GET['districtidplace']."'";
		  	if(!empty($_GET['hospitaldistrct']))		$wh.=" AND n_historydead.hospitalamphur='".$hospitalamphur."'";		
		  	if(!empty($_GET['hospital']))				$wh.=" AND hospitalid='".$_GET['hospital']."'";			
			if(!empty($_GET['name']))$wh.=" AND (firstname LIKE '%".$_GET['name']."%' OR surname LIKE '%".$_GET['name']."%' OR idcard LIKE '%".$_GET['name']."% ')";			
			
										   
			$data['result']=$this->dead->select("n_historydead.*,CONVERT(VARCHAR(10),endate, 111) as endate,province_name,amphur_name,district_name,hospital_name")
									->join("LEFT JOIN n_province ON n_province.province_id =provinceidplace
										   LEFT JOIN n_amphur ON  n_province.province_id = n_amphur.province_id and amphur_id=amphuridplace
										   LEFT JOIN n_district ON n_district.district_id =districtidplace
										   and n_district.province_id = n_province.province_id
										   and n_district.amphur_id = n_amphur.amphur_id
										   LEFT JOIN n_hospital_1 ON n_hospital_1.hospital_code =hospitalid 
										   WHERE 1=1 $wh")->get();		
		 				
				
		 
			
		$data['pagination']=$this->dead->pagination();			
		$this->template->build('dead/index',$data);
	}
	function form($id=FALSE)
	{			
		$data['rs']=$this->dead->get_row($id);		
		$this->template->build('dead/form',$data);
	}

	function delete($id){
		if($id){
			$this->inform->delete('information_historyid',$id);
			$this->history->delete($id);
			set_notify('success',DELETE_DATA_COMPLETE);
		}
		redirect('inform/dead/index');
	}

	function save()
	{
		$this->db->debug=true;
		//var_dump($_POST);	
		$_POST['provinceid']=@$_POST['province_id'];
		$_POST['hospitalid']=@$_POST['hospital'];
		$_POST['amphurid']=@$_POST['amphur_id'];
		$_POST['districtid']=@$_POST['district_id'];
		$_POST['hospital_local']=@$_POST['hospital'];	
		$_POST['headbiteblood']=@$_POST['head_bite_blood']." ".@$_POST['head_bite_noblood'].@$_POST['head_claw_blood']." ".@$_POST['head_claw_noblood'].@$_POST['head_bite_blood']." ".@$_POST['head_bite_noblood'];
		$_POST['facebiteblood']=@$_POST['face_bite_blood']." ".@$_POST['face_bite_noblood'].@$_POST['face_claw_blood']." ".@$_POST['face_claw_noblood'].@$_POST['face_bite_blood']." ".@$_POST['face_bite_noblood'];
		$_POST['neckbiteblood']=@$_POST['neck_bite_blood']." ".@$_POST['neck_bite_noblood'].@$_POST['neck_claw_blood']." ".@$_POST['neck_claw_noblood'].@$_POST['neck_bite_blood']." ".@$_POST['neck_bite_noblood'];
		$_POST['handbiteblood']=@$_POST['hand_bite_blood']." ".@$_POST['hand_bite_noblood'].@$_POST['hand_claw_blood']." ".@$_POST['hand_claw_noblood'].@$_POST['hand_bite_blood']." ".@$_POST['hand_bite_noblood'];
		$_POST['armbiteblood']=@$_POST['arm_bite_blood']." ".@$_POST['arm_bite_noblood'].@$_POST['arm_claw_blood']." ".@$_POST['arm_claw_noblood'].@$_POST['arm_bite_blood']." ".@$_POST['arm_bite_noblood'];
		$_POST['bodybiteblood']=@$_POST['body_bite_blood']." ".@$_POST['body_bite_noblood'].@$_POST['body_claw_blood']." ".@$_POST['body_claw_noblood'].@$_POST['body_bite_blood']." ".@$_POST['body_bite_noblood'];
		$_POST['legbiteblood']=@$_POST['leg_bite_blood']." ".@$_POST['leg_bite_noblood'].@$_POST['leg_claw_blood']." ".@$_POST['leg_claw_noblood'].@$_POST['leg_bite_blood']." ".@$_POST['leg_bite_noblood'];
		$_POST['feetbiteblood']=@$_POST['feet_bite_blood']." ".@$_POST['feet_bite_noblood'].@$_POST['feet_claw_blood']." ".@$_POST['feet_claw_noblood'].@$_POST['feet_bite_blood']." ".@$_POST['feet_bite_noblood'];
		$_POST['idcard'] = @$_POST['cardW0'].@$_POST['cardW1'].@$_POST['cardW2'].@$_POST['cardW3'].@$_POST['cardW4'];
		$_POST['exp_userig']=cld_date2my($_POST['exp_userig']);
		$_POST['exp_vaccine']=cld_date2my($_POST['exp_vaccine']);
		$_POST['brain_tumordate']=cld_date2my($_POST['brain_tumordate']);
		$_POST['saliva_headachedate']=cld_date2my($_POST['saliva_headachedate']);
		$_POST['csfdate']=cld_date2my($_POST['csfdate']);
		$_POST['pissdate']=cld_date2my($_POST['pissdate']);
		$_POST['rootdate']=cld_date2my($_POST['rootdate']);
		$_POST['occipital_skindate']=cld_date2my($_POST['occipital_skindate']);
		$_POST['corneal_cellsdate']=cld_date2my($_POST['corneal_cellsdate']);
		$_POST['datetouch']=(empty($_POST['datetouch'])) ? "":cld_date2my($_POST['datetouch']);
		$_POST['hr_date']=(empty($_POST['hr_date'])) ? "":cld_date2my($_POST['hr_date']);
		$_POST['treatdate']=(empty($_POST['treatdate'])) ? "":cld_date2my($_POST['treatdate']);
		$_POST['endate']=cld_date2my($_POST['endate']);
		$_POST['vaccine_date']=cld_date2my($_POST['vaccine_date']);
		$_POST['startdate']=cld_date2my($_POST['startdate']);
		$_POST['reportdate']=cld_date2my($_POST['reportdate']);
		$this->dead->save($_POST);
		redirect('inform/dead/index');
	
	}

function form_dead($id=FALSE)
	{
		$idcard = $this->dead->get_one("idcard","id",$id);
			$data['cardW0']=substr($idcard,0,1);
			$data['cardW1']=substr($idcard,1,4);
			$data['cardW2']=substr($idcard,5,5);
			$data['cardW3']=substr($idcard,10,2);
			$data['cardW4']=substr($idcard,12,13);	
			$data['h_name'] =$this->session->userdata('R36_HOSPITAL_NAME');			
		$data['now']=strtotime(date("Y-m-d H:i:s"));				
		$data['rs']=$this->dead->get_row($id);		
		$this->template->build('dead/form_dead',$data);
	}		
	
	
	function form_edit_dead($id=FALSE)
	{ 
		$idcard = $this->dead->get_one("idcard","id",$id);
			$data['cardW0']=substr($idcard,0,1);
			$data['cardW1']=substr($idcard,1,4);
			$data['cardW2']=substr($idcard,5,5);
			$data['cardW3']=substr($idcard,10,2);
			$data['cardW4']=substr($idcard,12,13);	
			$data['h_name'] =$this->session->userdata('R36_HOSPITAL_NAME');			
		$data['now']=strtotime(date("Y-m-d H:i:s"));				
		$data['rs']=$this->dead->select("*,REPLACE(CONVERT(VARCHAR(10),startdate, 111), '/', '-') as startdate
										,REPLACE(CONVERT(VARCHAR(10),treatdate, 111), '/', '-') as treatdate
										,REPLACE(CONVERT(VARCHAR(10),endate, 111), '/', '-') as endate
										,REPLACE(CONVERT(VARCHAR(10),datetouch, 111), '/', '-') as datetouch
									    ,REPLACE(CONVERT(VARCHAR(10),reportdate, 111), '/', '-') as reportdate
									    ,REPLACE(CONVERT(VARCHAR(10),brain_tumordate, 111), '/', '-') as brain_tumordate
									    ,REPLACE(CONVERT(VARCHAR(10),saliva_headachedate, 111), '/', '-') as saliva_headachedate
									    ,REPLACE(CONVERT(VARCHAR(10),csfdate, 111), '/', '-') as csfdate
									    ,REPLACE(CONVERT(VARCHAR(10),pissdate, 111), '/', '-') as pissdate
									    ,REPLACE(CONVERT(VARCHAR(10),occipital_skindate, 111), '/', '-') as occipital_skindate
									    ,REPLACE(CONVERT(VARCHAR(10),corneal_cellsdate, 111), '/', '-') as corneal_cellsdate	    
									    ,REPLACE(CONVERT(VARCHAR(10),rootdate, 111), '/', '-') as rootdate")->get_row($id);		
		$this->template->build('dead/form_edit_dead',$data);
	}
	
	function test()
	{
		$this->template->build('inform/dead/test');
	}
	}