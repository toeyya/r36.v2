  <tr>
	<th>เขตความรับผิดชอบ</th>
	<td><?php echo form_dropdown('area',get_option('id','name','n_area'),@$_GET['area'],'class="styled-select widthselect"  id="area"','ทั้งหมด','all');?>	</td>
	<th>เขต</th>
	<td>
	<span id="grouplist">
	<?php if(!empty($_GET['area']) && $_GET['area']!="all"){ ?>
	<?
		$total = $this->area->get_one("total","id",$_GET['area']);			
		echo form_dropdown('group',getLevel($_GET['area'],$total),$_GET['group'],'class="styled-select" id="group"','ทั้งหมด'); 	
	}else{ ?>
	<select name="group" class="styled-select widthselect" id="group"><option value="">ทั้งหมด</option></select>
	<?php }; ?>
	</span>
	</td>
	<th>จังหวัด</th>
	<td><span id="provincelist">			
		<?php if(!empty($_GET['province'])){
		echo form_dropdown('province',get_option('province_id','province_name','n_province'),$_GET['province'],'class="styled-select" id="province"','ทั้งหมด');
		}else{ ?>
		<select name="province" class="styled-select widthselect"><option value="">ทั้งหมด</option></select>
		<? } ?></span>					
	</td>
  </tr>
  
  <tr>
	<th>อำเภอ</th>
	<td><span id="amphurlist">
		<?php if(empty($_GET['amphur'])){ ?>
		<select name="amphur" class="styled-select"><option value="">ทั้งหมด</option></select>
		<?php }else{
			$wh="";
			if(!empty($_GET['province'])){
				$wh =" and province_id=".$_GET['province'];
			}
			echo form_dropdown('amphur',get_option('amphur_id','amphur_name','n_amphur where 1=1'.$wh),$_GET['amphur'],'class="styled-select" id="amphur"','ทั้งหมด');	
		} ?>
		</span></td>
	<th>ตำบล</th>
	<td><span id="districtlist">
		<?php if(empty($_GET['district'])){ ?>
		<select name="district" class="styled-select" id="district"><option value="">ทั้งหมด</option></select>
		<?php }else{ 
			$wh="";
			if(!empty($_GET['amphur']) && !empty($_GET['province'])){
				$wh =" and province_id=".$_GET['province']." and amphur_id =".$_GET['amphur'];
			}
			echo form_dropdown('district',get_option('district_id','district_name','n_district where 1=1'.$wh),$_GET['district'],'class="styled-select" id="district"','ทั้งหมด');				
		 } ?>
	</span></td>
	<th>สถานบริการ</th>
	<td><span id="hospitallist">
		<?php if(empty($_GET['hospital'])){ ?>
		<select name="hospital" class="styled-select widthselect"><option value="">ทั้งหมด</option></select>
		<?php }else{
			$wh="";
			if(!empty($_GET['amphur']) && !empty($_GET['province'])){
				$wh =" and hospital_province_id=".$_GET['province']." and hospital_amphur_id =".$_GET['amphur'] ." and hospital_district_id=".$_GET['district'];
			}
		  	echo form_dropdown('hospital',get_option('hospital_code','hospital_name','n_hospital_1 where 1=1 '.$wh),$_GET['hospital'],'class="styled-select" id="hospital"','ทั้งหมด');				
		} ?>
	</span></td>
	</tr>