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
	{ 			  	//$this->db->debug=TRUE;	  	  	
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
		$_POST['endate']=(empty($_POST['enddate'])) ? "":cld_date2my($_POST['endate']);
		$_POST['startdate']=(empty($_POST['startdate'])) ? "":cld_date2my($_POST['startdate']);
		$_POST['reportdate']=cld_date2my($_POST['reportdate']);
		$this->head->save($_POST);
		redirect('inform/dead');
	}

}