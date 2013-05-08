<script type="text/javascript">
$(document).ready(function(){
	var ref1,ref3,ref5,ref6;	
	$("#provinceid").change(function(){
		ref1=$("#provinceid option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=amphurid&ref1='+ref1,
			success:function(data){
				$("#Input_amphur").html(data);
				$("#districtid option[value='']").attr('selected','selected');
			}
		});
	});;

	$("#amphurid").live('change',function(){	
		var ref2=$("#amphurid option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=districtid&ref1='+ref1+'&ref2='+ref2,
			success:function(data){
				$("#Input_district").html(data);
			}
		})
	});
	$("#provinceidplace").change(function(){
	  ref3=$("#provinceidplace option:selected").val();
		 $.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=amphuridplace&ref1='+ref3,
			success:function(data){
				$("#input_place_amphur").html(data);
				$("#districtidplace option[value='']").attr('selected','selected');
			}
		 });
	});
	$("#amphuridplace").live('change',function(){
		var ref4=$("#amphuridplace option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=districtidplace&ref1='+ref3+'&ref2='+ref4,
			success:function(data){
				$("#input_place_district").html(data);
				$("#districtidplace option[value='']").attr('selected','selected');
			}	
		});		
	});
	
	$("#hospitalprovince").change(function(){
	  ref5=$("#hospitalprovince option:selected").val();
		 $.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=hospitalamphur&ref1='+ref5,
			success:function(data){
				$("#hospital_amphur").html(data);
				$("#hospitaldistrict option[value='']").attr('selected','selected');
			}
		 });
	});
	$("#hospitalamphur").live('change',function(){
		ref6=$("#hospitalamphur option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=hospitaldistrict&ref1='+ref5+'&ref2='+ref6,
			success:function(data){
				$("#hospital_district").html(data);			
			}	
		});		
	});
	$('#hospitaldistrict').live('change',function(){
		var ref7=$("#hospitaldistrict option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>hospital/getHospital',
			data:'ref1='+ref5+'&ref2='+ref6+'&ref3='+ref7,
			success:function(data){
				$('#input_hospital').html(data);
			}
		})
	});
	/***********  prevent double submit  ***********/
	$("input[name=submit]").attr('disabled',false);
	$.validator.setDefaults({
		   	  submitHandler: function() {	
			  	$("input[name=submit]").attr('disabled',true);
					document.form1.submit();			
			  }
	});	
	$("#form1").validate({
		rules:{
			firstname:"required",
			surname:"required",
			provinceid:"required",
			amphurid:"required",
			districtid:"required",
			provinceidplace:"required",
			amphuridplace:"required",
			districtidplace:"required",
		     enddate:"required",
			 reportname:"required",
			 positionname:"required",
			 nohome:"required",
			 telname:{
     		 		required: true,
     			 	number: true,
					minlength:6,
					maxlength:10
			 }			
		},
		messages:{
			firstname:"ระบุชื่อ",
			surname:"ระบุนามสกุล",
			provinceid:"ระบุจังหวัดะ",
			amphurid:"ระบุอำเภอ",
			districtid:"ระบุตำบล",
			provinceidplace:"ระบุจังหวัด",
			amphuridplace:"ระบุอำเภอ",
			districtidplace:"ระบุตำบล",
			enddate:"ระบุวันถึงแก่กรรม",
			 reportname:"ระบุชื่อผู้รายงาน",
			 positionname:"ระบุตำแหน่ง",
			 nohome:"ระบุเลขที่่",
			 telname:{
			 	required:"ระบุเบอร์โทรศัพท์",
				number:"ระบุเป็นตัวเลข",
				minlength:"ระบุอย่างน้อย 6 หลัก",
				maxlength:"ระบุไม่เกิน 10 หลัก"
			 }

		},
			errorPlacement: function(error, element){							
				if((element.attr('name')=='firstname') || (element.attr('name')=='surname'))
				{					
					element.next().html(error);				
				}else{
					error.appendTo(element.parent());
				}
						
			}	
	});
});
</script>
<div id="title">แบบฟอร์มคนไข้ที่เสียชีวิต</div>
<form id="form1" name="form1" method="post"  action="inform/save_dead" > 
<table class="tbform">
	<tr>
		<th>1</th>
		<td>
		<div class="partial">
			<label>ชื่อ <span class="alertred">*</span></label>
			<input name="firstname" type="text" class="input_box_patient " id="firstname" value="<?php echo $rs['firstname'];?>" size="20" /><span></span>
			<label> นามสกุล <span class="alertred">*</span></label>
			<input name="surname" type="text" value="<?php echo $rs['surname'];?>" size="20"  class="input_box_patient ">
			<label>อายุ</label>
			<input name="age" type="text" size="2" value="<?php $rs['age'];?>" onKeyPress="return NumberOnly();" class="input_box_patient "> ปี
			<label>เพศ</label>
					<input name="gender" type="radio" value="1" <? if($rs['gender']=='1'){ print "checked";}?>> ชาย&nbsp;&nbsp;
					<input name="gender" type="radio" value="2" <? if($rs['gender']=='2'){ print "checked";}?>> หญิง
		</div>
		<p class="partial title">ที่อยู่ปัจจุบัน</p>
		<div class="partial">		
			<label>เลขที่	</label><span class="alertred">*</span><input name="nohome" type="text" class="input_box_patient " size="20" value="<?php echo $rs['nohome'];?>">
			<label>หมู่ที่	</label><span class="alertred">*</span><input name="moo" type="text" class="input_box_patient " size="20" value="<?php echo $rs['moo'];?>" />
			<label>หมู่บ้าน</label><span class="alertred">*</span><input name="villege" type="text" class="input_box_patient " size="20" value="<?php echo $rs['villege'];?>">
			<label>ซอย</label><span class="alertred">*</span><input name="soi" type="text" class="input_box_patient " size="20" value="<?php echo $rs['soi'];?>" />
			<label>ถนน</label><span class="alertred">*</span><input name="road" type="text" class="input_box_patient " id="road" value="<?php echo $rs['road'];?>" size="20" />
		</div>
		<div class="partial">
			<label>จังหวัด</label><span class="alertred">*</span>
        	<?php 
        		$class='class="input_box_patient " id="provinceid"';
        		echo form_dropdown('provinceid',get_option('province_id','province_name','n_province ORDER BY province_name ASC'),@$rs['provinceid'],$class,'-โปรดเลือก-');
			 ?>	
			 <label>อำเภอ</label>	<span class="alertred">*</span>	
			 	<span id="Input_amphur">
					<? if($rs['provinceid']!=''){
								if($rs['amphurid']!=''){
									$whamp="AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
								}else{
									$whamp="AND province_id='".$rs['provinceid']."'";
								}																				 
							echo form_dropdown('amphurid',get_option('amphur_id','amphur_name',"n_amphur WHERE amphur_id!=''".$whamp."  ORDER BY amphur_name ASC"),@$rs['amphurid'],'class="input_box_patient " id="amphurid"','-โปรดเลือก-');
						}else{									
						?>
							<select name="amphurid" id="amphurid" class="input_box_patient ">
								<option value="">-โปรดเลือก-</option>
							</select>
						<?php } ?>
 				</span>		
 				<label>ตำบล</label><span class="alertred">*</span>
				<span id="Input_district">
					<?
					if($rs['amphurid']!=''){
							if($rs['districtid']!=''){
								$whdis="AND district_id ='".$rs['districtid']."' AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
							}else{
								$whdis="AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
							}	
															
							echo  form_dropdown('district_id',get_option('district_id','district_name'," n_district WHERE district_id!='' ". $whdis." ORDER BY district_name ASC"),@$rs['districtid'],'class="input_box_patient " id="districtid"','-โปรดเลือก-');
						}else{
					?>     
						<select name="districtid" id="districtid" class="styled-select ">
							<option value="">-โปรดเลือก-</option>
						</select>
					<?php } ?>              
				</span>			
		</div>
		</td>		
	</tr>
</table>	
 <div class="btn_inline">
      <ul>
      	<li><button class="btn_save" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="reset">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div> 	
	</form>