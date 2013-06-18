<?php
class Patient extends R36_Controller
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
	{ 	$data=array();	
		if(!empty($_GET['name'])){
			$wh=(!empty($_GET['name'])) ? " firstname like '%".$_GET['name']."%' OR surname like '%".$_GET['name']."%' OR idcard like '%".$_GET['name']."%'":'';
			$data['result'] = $this->history->select('n_history.*,province_name,amphur_name,district_name')
																 ->join("LEFT JOIN n_province ON province_id=provinceid
																 			  LEFT JOIN n_amphur ON amphur_id=amphurid and provinceid=n_amphur.province_id
																 			  LEFT JOIN n_district ON district_id=districtid and provinceid=n_district.province_id and amphurid=n_district.amphur_id")
																->where($wh)->limit(20)->sort("")->order('historyid desc')->get();
			$data['pagination'] = $this->history->pagination();
		}
		$this->template->build('patient/index',$data);
	}
	function form($id=FALSE){
		$data['rs']=$this->history->get_row($id);
		$data['cardW0']=substr($data['rs']['idcard'],0,1);
		$data['cardW1']=substr($data['rs']['idcard'],1,4);
		$data['cardW2']=substr($data['rs']['idcard'],5,5);
		$data['cardW3']=substr($data['rs']['idcard'],10,2);
		$data['cardW4']=substr($data['rs']['idcard'],12,13);	
		$this->template->build('patient/form',$data);
	}
	function delete($id){
		if($id){
			$this->inform->delete('information_historyid',$id);
			$this->history->delete($id);
			set_notify('success',DELETE_DATA_COMPLETE);
		}
		redirect('inform/patient/index');
	}
	function save(){
		if($_POST){
			if($_POST['statusid']=='1'){ 
						$_POST['idcard']=$_POST['cardW0'].$_POST['cardW1'].$_POST['cardW2'].$_POST['cardW3'].$_POST['cardW4'];						
			}else if($_POST['statusid']=='2'){
						$_POST['idcard']=$_POST['idpassport'];
			}
							if(isset($_POST['chkage'])=='Y'){$_POST['age']=0;$_POST['age_group']=1;
							}else if($_POST['age'] < 1){			$_POST['age']=0;$_POST['age_group']=1;
							}else if($_POST['age']>=1    && $_POST['age'] <=5){$_POST['age_group']=2;
							}else if($_POST['age']>=6 	&& $_POST['age'] <=10){$_POST['age_group']=3;
							}else if($_POST['age']>=11 && $_POST['age'] <=15){$_POST['age_group']=4;
							}else if($_POST['age']>=16 && $_POST['age'] <=25){$_POST['age_group']=5;
							}else if($_POST['age']>=26 && $_POST['age'] <=35){$_POST['age_group']=6;
							}else if($_POST['age']>=36 && $_POST['age'] <=45){$_POST['age_group']=7;
							}else if($_POST['age']>=46 && $_POST['age'] <=55){$_POST['age_group']=8;
							}else if($_POST['age']>=56 && $_POST['age'] <=65){$_POST['age_group']=9;
							}else if($_POST['age']>=66){$_POST['age_group']=10;}
			
			if(isset($_POST['nationality']))
			{					
				if($_POST['nationality']=='1'){$_POST['nationalityname']=$_POST['nationality'];}
				else if($_POST['nationality']=='2'){$_POST['nationalityname']=$_POST['nationalityname'];}
			}
			if($_POST['age']<=15){
				$_POST['occupationname']=$_POST['occupationname_b'];
			}
		
			$_POST['updatetime']=(is_null(@$_POST['updatedtime']))? '0000-00-00 00:00:00':@$_POST['updatetime'];
			$this->history->save($_POST);
		}
		set_notify('success',SAVE_DATA_COMPLETE);
		redirect('inform/patient/index');
	}
}