<?php
class Hospital extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('hospital_model','hospital');

		
	}

	function hospitalExists()
	{	
		$sql="select hospital_id from n_hospital_1 where (hospital_province_id= ?  and hospital_amphur_id= ?  and hospital_name= ? and hospital_district_id = ? ) and hospital_id <> ? ";	
		$id=$this->db->GetOne($sql,array($_GET['province_id'],$_GET['amphur_id'],$_GET['hospital_name'],$_GET['district_id'],$_GET['hospital_id']));
		echo ($id)? "false":"true";
		
	}
	function getHospital()
	{
		$name=(isset($_GET['name']))?$_GET['name']:'hospital';
		$class=(isset($_GET['class']))?" styled-select ".$_GET['class']:"styled-select";			
		$special=' class="'.$class.'" id="'.$name.'"';		
		$default=(isset($_GET['default']))?"ทั้งหมด":'-โปรดเลือก-';
		if($_GET['ref1'] || $_GET['ref2'])
		{
			$wh="WHERE hospital_province_id='".$_GET['ref1']."' and hospital_amphur_id='".$_GET['ref2']."' and hospital_district_id='".$_GET['ref3']."' ORDER BY hospital_name ASC";				
			echo form_dropdown($name,get_option('hospital_code','hospital_name',"n_hospital_1 $wh"),'',$special,$default);
		}else{
			$output = '<select name="'.$name.'" class="'.$class.'" id="'.$name.'">';
	   		$output.= '<option value="" selected="selected">'.$default.'</option>';
	   		$output.='</select>';
	   		echo $output;			
		}
	}

	function GetClearHospital(){
		$output = '<select name="hospital" class="styled-select" id="hospital">';
   		$output.= '<option value="">ทั้งหมด</option>';
   		$output.='</select>';
   		echo $output;
	}

}
?>
