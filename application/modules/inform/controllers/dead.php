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
	{ 		//$this->db->debug=TRUE;	  	  	
			$wh='';
			if(!empty($_GET['startdate']))				$wh.=" AND n_historydead.datetouch >='".cld_date2my($_GET['startdate'])."'";			
			if(!empty($_GET['enddate']))				$wh.=" AND n_historydead.datetouch <='".cld_date2my($_GET['endate'])."'";			
			if(!empty($_GET['hospitalprovince']))	$wh.=" AND n_historydead.hospitalprovince='".$_GET['hospitalprovince']."'";		
		  	if(!empty($_GET['hospitaldistrct']))		$wh.=" AND n_historydead.hospitalamphur='".$hospitalamphur."'";		
		  	if(!empty($_GET['hospital']))				$wh.=" AND n_information.hospitalcode='".$_GET['hospital']."'";			
			if(!empty($_GET['name']))$wh.=" AND (firstname LIKE '%".$_GET['name']."%' OR surname LIKE '%".$_GET['name']."%' OR idcard LIKE '%".$_GET['name']."%')";			
			if(!empty($_GET['provinceidplace']))	$wh.=" AND provinceidplace='".$_GET['provinceidplace']."'";
			if(!empty($_GET['amphuridplace']))	$wh.=" AND amphuridplace='".$_GET['amphuridplace']."'";
			if(!empty($_GET['districtidplace']))		$wh.=" AND districtidplace ='".$_GET['districtidplace']."'";
			
			if(empty($_GET['btn_save'])){
				$data['result']=$this->dead->where(" id<>'' $wh")->sort("")->order("id desc")->limit(20)->get();			
			}
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
		//$this->db->debug=true;
		//var_dump($_POST);	
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
		$_POST['occipital_skindate']=(empty($_POST['occipital_skindate'])) ? "":cld_date2my($_POST['occipital_skindate']);
		$_POST['corneal_cellsdate']=(empty($_POST['corneal_cellsdate'])) ? "":cld_date2my($_POST['corneal_cellsdate']);
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
	
}