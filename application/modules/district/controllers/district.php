<?php
class District extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('district_model','district');
		$this->load->model("province/province_model",'province');
		$this->load->model("amphur/amphur_model",'amphur');
		$this->load->model('area/area_model','area');		
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

	function GetGroupByArea()
	{
		$area=$_GET['area'];
		if($area=="all"){$area="";} 	
		 if($area){
				$total = $this->area->get_one("total","id",$_GET['area']);			
				echo form_dropdown('group',getLevel($_GET['area'],$total),$_GET['group'],'class="styled-select" id="group"','ทั้งหมด'); 	
		    }elseif($area==''){
			   $output = '<select name="group" class="styled-select" id="group">';
			   $output.= '<option value="">ทั้งหมด</option>';
			   $output.='</select>';
			   echo $output;	
		   }
				
	}
	function GetProvinceByGroup()
	{
		 $group=$_GET['group'];
		 $area=$_GET['area'];
		  if($group!='' && $area!='' && $group!=''){
			   	
			   $sql = "select DISTINCT n_area_detail.province_id,province_name from n_area_detail inner join n_province on n_area_detail.province_id=n_province.province_id  where area_id= ".$_GET['area']." and level =".$_GET['group']; 
			   //$sql = "select province_id, province_name from n_province where ".$field."='".$group."' order by province_name asc";
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
