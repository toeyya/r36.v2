<?php
class District extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('district_model','district');
		$this->load->model('district_people_model','people');
		$this->load->model("province/province_model",'province');
		$this->load->model("amphur/amphur_model",'amphur');
		$this->load->model('area/area_model','area');		
	}
	function index($view=FALSE)
	{
		$wh='';
		$wh .=(!empty($_GET['amphur_id'])) ? " AND  amphur_id = '".$_GET['amphur_id']."'": '';
		$wh .=(!empty($_GET['province_id'])) ? " AND province_id ='".$_GET['province_id']."'":'';
		$wh .=(!empty($_GET['district_name'])) ? " AND district_name LIKE'%".$_GET['district_name']."%'" : '';
		if($view){$wh.="hospital_id='$view'";}
		$data['wh']=$wh;
		$data['result']=$this->district->select("district_name,province_id,amphur_id,tam_amp_id,district_id")															
									    ->where(" district_id<>'' and province_id<>'' $wh")
									    ->sort("")->order("province_id,amphur_id,district_name ASC")->get();						
		$data['pagination']=$this->district->pagination();
		$this->template->build('district_index',$data);								
	}
	function form($tam_amp_id=FALSE)
	{	//$this->db->debug=true;
		if($tam_amp_id)
		{					
			$data['rs']=$this->db->GetRow("select district_name,n_district.province_id,n_district.amphur_id,tam_amp_id,district_id 
											from n_district 
											INNER JOIN n_province on n_province.province_id=n_district.province_id 
											INNER JOIN n_amphur on n_amphur.amphur_id=n_district.amphur_id 
											where tam_amp_id =$tam_amp_id 
											GROUP BY district_name,n_district.province_id,n_district.amphur_id,tam_amp_id,district_id");
			$data['people'] = $this->people->where("tam_amp_id = $tam_amp_id")->sort("")->order("years desc")->get();
		}
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
			foreach($_POST['people'] as $key =>$item){
				if(!empty($item))
				{											
					$this->db->Execute("delete from n_district_people where tam_amp_id =  ?  and years = ? ",array($_POST['tam_amp_id'],$_POST['years'][$key]));	
					$this->people->save(array('tam_amp_id'=>$_POST['tam_amp_id'],'years'=>$_POST['years'][$key],'people'=>$item));
				}
			}	
			set_notify('success', SAVE_DATA_COMPLETE);
		}
		
		redirect('district/admin/district/index');	
	}
	function delete($id,$province_id,$amphur_id,$district_id){
		if($id){
			if(check_delete_setting("district",$province_id,$amphur_id,$district_id)){
				$this->district->delete("tam_amp_id",$id);	
				set_notify('success', DELETE_DATA_COMPLETE);	
			}else{
				set_notify('success','ข้อมูลนี้ถูกใช้อยู่ ไม่สามารถลบรายการนี้ได้');
			}		
		redirect('district/admin/district/index');	
		}
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
