<script type="text/javascript">
$(document).ready(function(){
	$("select[name=province]").change(function(){
		$("#amphurlist").html('<img src="images/loader.gif" width="16" height="11">');
		var ref1=$("select[name=province] option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=amphur&ref1='+ref1,
			success:function(data){
				$("#amphurlist").html(data);
			}		
		});
	});
	$("select[name=amphur]").live('change',function(){
		$("#districtlist").html('<img src="images/loader.gif" width="16" height="11">');
		var ref2=$("select[name=amphur] option:selected").val();
		var ref1=$("select[name=province] option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=district&ref1='+ref1+'&ref2='+ref2,
			success:function(data){
				$("#districtlist").html(data);
			}		
		});
	});
	$("select[name=district]").live('change',function(){
		$("#hospitallist").html('<img src="images/loader.gif" width="16" height="11">');
		var ref2=$("select[name=amphur] option:selected").val();
		var ref1=$("select[name=province] option:selected").val();
		var ref3=$('select[name=district] option:selected').val();
		$.ajax({
			url:'<?php echo base_url() ?>hospital/getHospital',
			data:'ref1='+ref1+'&ref2='+ref2+'&ref3='+ref3,
			success:function(data){
				$("#hospitallist").html(data);
			}		
		});
	});
	$('#fomr1').validate({
		groups:{
			ddate :" s_date e_date"
		}, 
		rules:{
			s_date:"required",e_date:"required",hospital:"required"			
		},
		messages:{
			s_date:"กรุณาระบุ",e_date:"กรุณาระบุ",hospital:"กรุณาระบุ"
		}
	})
});
</script>
<div id="title">ส่งออก - ข้อมูลผู้สัมผัสโรคพิษสุนัขบ้า</div>
<div id="search">
<form action="report/index/export/information" method="get" name="formreport" id="form1">
	<table  class="tb_patient1">
	  <tr>
		<th>จังหวัด</th>
			<td>
			<span id="provincelist">				 
				<?php echo form_dropdown('province',get_option('province_id','province_name','n_province'.$wh_province),$this->session->userdata('R36_HOSPITAL_PROVINCE'),'class="styled-select id="province"','โปรดเลือก') ?>								
			</span>
			</td>			
	  </tr>
	  <tr>
		<th>อำเภอ</th>
		<td>
			<span id="amphurlist">
				<?php if(!empty($wh_amphur)): ?>
					<?php echo form_dropdown('amphur',get_option('amphur_id','amphur_name','n_amphur'.$wh_amphur),$this->session->userdata('R36_HOSPITAL_AMPHUR'),'class="styled-select id="amphur"','โปรดเลือก'); ?>			
				<?php else: ?>
					<select name="amphur" class="styled-select">
						<option value="">ทั้งหมด</option>
					</select>
				<?php endif; ?>
			</span></td>
		</tr>
		<tr>
		<th>ตำบล</th>
			<td>
				<span id="districtlist">
					<?php if(!empty($wh_district)): ?>
						<?php echo form_dropdown('district',get_option('district_id','district_name','n_district'.$wh_district),$this->session->userdata('R36_HOSPITAL_DISTRICT'),'class="styled-select id="district"','โปรดเลือก'); ?>
					<?php else: ?>
					<select name="district" class="styled-select" id="district">
						<option value="">ทั้งหมด</option>
					</select>
					<?php endif; ?>					
				</span>
			</td>
		</tr>
		<tr>
			<th>สถานพยาบาล <span class="alertred">*</span></td>
			<td>
				<span id="hospitallist">
					<?php if(!empty($wh_hospital)): ?>
						<?php echo form_dropdown('hospital',get_option('hospital_code','hospital_name','n_hospital_1'.$wh_hospital),$this->session->userdata('R36_HOSPITAL'),'class="styled-select id="hospital"','โปรดเลือก'); ?>
					<?php else: ?>					
					<select name="hospital" class="styled-select" id="hospital">
						<option value="">ทั้งหมด</option>
					</select>
					<?php endif; ?>
				</span></td>			
	  </tr>
	  <tr>
	    <th>วันที่สัมผัสโรค <span class="alertred">*</span></th>
	    <td>
	    	<input type="text" class="datepicker input_box_patient " name="s_date">  ถึง   <input type="text" class="datepicker input_box_patient " name="e_date"></td>		
      </tr>   
	<tr>
	    <th>ประเภทไฟล์</th>	    
		<td><?php echo form_radio('fileType','txt',true);?> text file
			<?php echo form_radio('fileType','execel');?> excel file</td>	
						
      </tr>  
	
  </table>
 
 <div class="btn_inline"><ul><li><button class="btnSubmit" value="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li></ul></div>	
</form>

</div>
