<?php
class Search_data extends R36_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('inform/history_model','history');
		$this->load->model('inform/inform_model','inform');
		$this->load->model('inform/historydead_model','dead');
		
	}
	function index()
	{
		  $startdate=@$_GET['startdate'];
		  $enddate=@$_GET['enddate'];
		  $hospitalprovince=@$_GET['province_id'];
		  $hospitalamphur=@$_GET['amphur_id'];
		  $hospital=@$_GET['hospital'];
		  $hn=@$_GET['hn'];
		  $name=@$_GET['name'];
		  $surname=@$_GET['surname'];
		  $idcard=@$_GET['idcard'];
		  $wh='';
			if($startdate){
				$wh.=" AND n_information.datetouch >='".cld_date2my($startdate)."'";
			}
			if($enddate){
			  	$wh.=" AND n_information.datetouch <='".cld_date2my($enddate)."'";
			}
		  	if($hospitalprovince){
				$wh.=" AND n_information.hospitalprovince='".$hospitalprovince."'";
			}
		  	if($hospitalamphur){
				$wh.=" AND n_information.hospitalamphur='".$hospitalamphur."'";
			}

		  	if($hospital){
				$wh.=" AND n_information.hospitalcode='".$hospital."'";
			}
		  	if($hn){
				$wh.=" AND n_information.hn like'%".$hn."%'";
			}
		  	if($name){
				$wh.=" AND n_history.firstname like'%".$name."%'";
			}
		  	if($surname){
				$wh.=" AND n_history.surname like'%".$surname."%'";
			}
		  	if($idcard){
				$wh.=" AND n_history.idcard like'%".$idcard."%'";
			}
			
			if(!empty($_GET['total_vaccine'])){
				$total_vaccine=implode(',',$_GET['total_vaccine']);
				$wh.=" AND (closecase=2 AND total_vaccine in(".$total_vaccine."))";
			}
			//$this->db->debug=TRUE;
			if(!empty($_GET['ok']))
			{					 						 	
			 			$data['result']=$this->history
			 												->select("DISTINCT historyid,firstname,surname,in_out,total_vaccine,n_information.id,closecase,hn_no,idcard,datetouch")
														   	->join(" INNER JOIN n_information ON n_history.historyid=n_information.information_historyid ")
														   	->where("historyid!='' $wh ")->sort("")->order("historyid ,firstname,surname ASC")->limit(20)->get();		
			}
		
		$data['pagination']=$this->history->pagination();
		
		$this->template->build('search_data_index',$data);
	}
	function dead()
	{
		  	//$this->db->debug=TRUE;	  	  	
		  	$wh='';
			if(!empty($_GET['startdate']))				$wh.=" AND n_historydead.datetouch >='".cld_date2my($_GET['startdate'])."'";			
			if(!empty($_GET['enddate']))				$wh.=" AND n_historydead.datetouch <='".cld_date2my($_GET['endate'])."'";			
		  	if(!empty($_GET['hospitalprovince']))	$wh.=" AND n_historydead.hospitalprovince='".$_GET['hospitalprovince']."'";		
		  	if(!empty($_GET['hospitaldistrct']))		$wh.=" AND n_historydead.hospitalamphur='".$hospitalamphur."'";		
		  	if(!empty($_GET['hospital']))				$wh.=" AND n_information.hospitalcode='".$_GET['hospital']."'";			
			if(!empty($_GET['firstname']) && !empty($_GET['surname']))$wh.=" AND (firstname LIKE '%".$_GET['firstname']."%' OR surname LIKE '%".$_GET['surname']."%')";			
			if(!empty($_GET['idcard']))					$wh.=" AND idcard='".$_GET['idcard']."'";
			if(!empty($_GET['provinceidplace']))	$wh.=" AND provinceidplace='".$_GET['provinceidplace']."'";
			if(!empty($_GET['amphuridplace']))	$wh.=" AND amphuridplace='".$_GET['amphuridplace']."'";
			if(!empty($_GET['districtidplace']))		$wh.=" AND districtidplace ='".$_GET['districtidplace']."'";
			
		if(!empty($_GET['ok'])){
			$data['result']=$this->dead->where(" id<>'' $wh")->sort("")->order("id desc")->limit(20)->get();			
		}
		$data['pagination']=$this->dead->pagination();
		$this->template->build('search_data_dead',$data);
	}
}
?>
