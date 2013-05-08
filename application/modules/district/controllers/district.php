<?php
class District extends R36_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('district_model','district');
		$this->load->model("province/province_model",'province');
		$this->load->model("amphur/amphur_model",'amphur');		
	}
	function index($view=FALSE)
	{
		//$this->db->debug=TRUE;
		$amphur=@$_GET['amphur_id'];
		$province=@$_GET['province_id'];	
		$district=@$_GET['district_name'];
		$wh='';
		if($amphur!=''){
		  		$wh=" AND  amphur_id = '".$amphur."' AND province_id ='".$province."'";
		  }else if($province!=''){
		  		$wh=" AND province_id ='".$province."'";
		  }
		  if($district!=''){
		  		$wh .=" AND district_name LIKE'%".$district."%'";
		  }
		  if($view)
		  {
		  		$wh="hospital_id='$view'";
		  		
		  }
		$data['wh']=$wh;
		$data['result']=$this->district->select("district_name,province_id,amphur_id,tam_amp_id,district_id")															
														    ->where(" district_id<>'' and province_id<>'' $wh")->sort("")->order("province_id,amphur_id,district_name ASC")
														    ->limit(20)->get();
				
	
		$data['pagination']=$this->district->pagination();
		$this->template->build('district_index',$data);				
		
		
	}
	function form($tam_amp_id=FALSE)
	{
		$data['rs']=$this->db->GetRow("select district_name,n_district.province_id,n_district.amphur_id,tam_amp_id,district_id 
																from n_district 
																INNER JOIN n_province on n_province.province_id=n_district.province_id 
																INNER JOIN n_amphur on n_amphur.amphur_id=n_district.amphur_id 
																where tam_amp_id =$tam_amp_id 
																GROUP BY district_name,n_district.province_id,n_district.amphur_id,tam_amp_id,district_id");
		
		$this->template->build('district_form',$data);
	}
	function view($district_name=FALSE,$amphur_name=FALSE,$province_name=FALSE)
	{
		$data['district_name']=$district_name;
		$data['amphur_name']=$amphur_name;
		$data['province_name']=$province_name;	
		$this->template->build("district_view",$data);
	}
	function getProvince(){
		$name=(isset($_GET['name']))?$_GET['name']:'province_id';
		if($_GET['ref1']){
			$wh=($name=="provinceidplace")?" WHERE province_id='".$_GET['ref1']."'":"";	
		}else{$wh="";}
			
		echo form_dropdown($name,get_option('province_id','province_name','n_province '.$wh.' ORDER BY province_name ASC'),@$_GET['ref1'],' class="styled-select" id="'.$name.'"','-โปรดเลือก-');
	}
	function getAmphur(){		
		$name=(isset($_GET['name']))? $_GET['name']:"amphur_id";
		$mode=(isset($_GET['mode']))?$_GET['mode']:'';		
		$class=(isset($_GET['class']))?" styled-select ".$_GET['class']:"styled-select";
		
		$default=(isset($_GET['default']))?"ทั้งหมด":'-โปรดเลือก-';
		if($_GET['ref1']){
			if($mode=="place_amppattaya")
			{
				echo '<select class="styled-select" name="amphuridplace"  id="amphuridplace">';
				echo '<option value="" selected="selected">เมืองพัทยา</option>';
				echo  '</select>';				
			}else{											
				echo form_dropdown($name,get_option('amphur_id','amphur_name'," n_amphur where province_id='".$_GET['ref1']."' ORDER BY amphur_name ASC"),'',' class="'.$class.'" id="'.$name.'"',$default);		
			}
		}else{
				echo '<select class="'.$class.'" name="'.$name.'"  id="'.$name.'">';
				echo '<option value="" selected="selected">'.$default.'</option>';
				echo  '</select>';				
		}// $_GET['ref1']				
	}
	function getDistrict()
	{
		$name=(isset($_GET['name']))? $_GET['name']:"district_id";	
		$class=(isset($_GET['class']))?" styled-select ".$_GET['class']:"styled-select";			
		$special=' class="'.$class.'" id="'.$name.'"';	

		$default=(isset($_GET['default']))?"ทั้งหมด":'-โปรดเลือก-';
		if($_GET['ref1'] && $_GET['ref2']){
			echo form_dropdown($name,get_option('district_id','district_name'," n_district WHERE province_id='".$_GET['ref1']."' AND amphur_id ='".$_GET['ref2']."' ORDER BY district_name ASC"),'',$special,$default);
		}else{
				echo '<select class="'.$class.'" name="'.$name.'"  id="'.$name.'">';
				echo '<option value="" selected="selected">'.$default.'</option>';
				echo  '</select>';	
		}		
	}
	function distrctExists()
	{
		$sql="select  tam_amp_id from n_district where province_id='".$_GET['province_id']."' and amphur_id='".$_GET['amphur_id']."' and district_name='".$_GET['district_name']."' ";
		$id=$this->db->getOne($sql);	
		echo ($id)? "false":"true";
	}
	function save()
	{
		
			$max_id=$this->db->getOne("SELECT max(district_id)  AS chk_district_id FROM n_district WHERE province_id ='".$_POST['province_id']."' AND amphur_id='".$_POST['amphur_id']."'");
			$district_id=$max_id+101;
			$district_id=substr($district_id,1,2);
			$_POST['district_id']=($_POST['district_id']!="") ? $_POST['district_id']:$district_id;

		if($_POST)
		{
			$this->district->primary_key("tam_amp_id");	
			$this->district->save($_POST);	
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		
		redirect('district/index?province_id='.$_POST['province_id'].'&amphur_id='.$_POST['amphur_id']);	
	}
	function delete($id,$province_id,$amphur_id){
		if($id){
			$this->district->delete("tam_amp_id",$id);	
			set_notify('success', DELETE_DATA_COMPLETE);	
		}		
		redirect('district/index?province_id='.$province_id.'&amphur_id='.$amphur_id);	
	}

	function GetGroupByArea()
	{
		$area=$_GET['area']; 	
		 if($area=='1' || $area=='2'){
				if($area=='1'){
					$province=$this->province->select("province_level_old as groupno")->groupby("province_level_old")->sort("")->order("province_level_old")->get();
				}else{
					$province=$this->province->select("province_level_new as groupno")->groupby("province_level_new")->sort("")->order("province_level_new")->get();
				}

			   
			   $output = '<select name="group" class="styled-select" id="group">';
			   $output.= '<option value="">ทั้งหมด</option>';
				foreach($province as $rec){
					  if($rec['groupno']=='0'){
						$groupname = "กทม.";
					  }else{
						$groupname = "เขต ".$rec['groupno'];
					  }
					  $output .= '<option value="'.$rec['groupno'].'">'.$groupname.'</option>';
				}
				$output.='</select>';
		    }elseif($area=='-'){
			   $output = '<select name="group" class="styled-select" id="group">';
			   $output.= '<option value="">ทั้งหมด</option>';
			   $output.='</select>';
		   }
			echo $output;		
	}
	function GetProvinceByGroup()
	{
		 $group=$_GET['group'];
		 $area=$_GET['area'];
		  if($group!='-' && $area!='-' && $group!=''){
				if($area=='1'){
					$field = "province_level_old";
				}else{
					$field = "province_level_new";																	
				}
			   $sql = "select province_id, province_name from n_province where ".$field."='".$group."' order by province_name asc";
			   $result=$this->province->get($sql);
			   $output = '<select name="province" class="styled-select" id="province">';
			   $output.= '<option value="">ทั้งหมด</option>';
				foreach($result as $rec){
					  $output .= '<option value="'.$rec['province_id'].'">'.$rec['province_name'].'</option>';
				}
				$output.='</select>';
		    }elseif($group==''){
			   $output = '<select name="province" class="styled-select" id="province">';
			   $output.= '<option value="">ทั้งหมด</option>';
			   $output.='</select>';
		   }
			echo $output;		
	}

	function GetClear(){
		   $output = '<select name="'.$_GET['place'].'" class="styled-select" id="'.$_GET['place'].'">';
   		   $output.= '<option value="">ทั้งหมด</option>';
   		   $output.='</select>';
   		  echo $output;
	}

}
?>
