
<script type="text/javascript">
$(document).ready(function(){
	 $('#multiAccordion').multiAccordion({
            heightStyle: "content",
        	 active: 'none' 
        });
	$(document).ready(function(){
	$("select[name=provinceidplace]").change(function(){
		$("#input_amphur_place").html('<img src="images/loader.gif" width="16" height="11">');
		var ref1=$("select[name=provinceidplace] option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=amphuridplace&ref1='+ref1,
			success:function(data){
				$("#input_amphur_place").html(data);
			}		
		});
	});
	$("select[name=amphuridplace]").live('change',function(){
		var ref2=$("select[name=amphuridplace] option:selected").val();
		var ref1=$("select[name=provinceidplace] option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=districtidplace&ref1='+ref1+'&ref2='+ref2,
			success:function(data){
				$("#input_district_place").html(data);
			}		
		});
	});
	
	
	$("select[name=province_id]").change(function(){
		$("#input_amphur").html('<img src="images/loader.gif" width="16" height="11">');
		var ref1=$("select[name=province_id] option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'ref1='+ref1,
			success:function(data){
				$("#input_amphur").html(data);
			}		
		});
	});
	$("select[name=amphur_id]").live('change',function(){
		var ref2=$("select[name=amphur_id] option:selected").val();
		var ref1=$("select[name=province_id] option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'ref1='+ref1+'&ref2='+ref2,
			success:function(data){
				$("#input_district").html(data);
			}		
		});
	});
	$("select[name=district_id]").live('change',function(){
		var ref2=$("select[name=amphur_id] option:selected").val();
		var ref1=$("select[name=province_id] option:selected").val();
		var ref3=$('select[name=district_id] option:selected').val();
		$.ajax({
			url:'<?php echo base_url() ?>hospital/getHospital',
			data:'ref1='+ref1+'&ref2='+ref2+'&ref3='+ref3,
			success:function(data){
				$("#input_hospital").html(data);
			}		
		});
	});
	$('.btn_delete').click(function(){
		var c=confirm('คุณแน่ใจแล้วที่จะลบรายการนี้');
		var information_id=$(this).next().val();
		var historyid=$(this).next().next().val();
		if(c){								
				$.ajax({
					url:'<?php echo base_url() ?>inform/delete',
					data:'id='+information_id+'&historyid='+historyid,
					success:function(){
						location.reload();
						
					}
				})
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
		groups:{
				groupidcard:"cardW0 cardW1 cardW2 cardW3 cardW4",
				groupname:"firstname surname",
		},
		rules:{
			firstname:"required",surname:"required",
			age:{required:true,number:true},
			province_id:"required",
			//amphur_id:"required",
			//district_id:"required",
			provinceidplace:"required",
			//amphuridplace:"required",
			//districtidplace:"required",
		     enddate:"required",
			 reportname:"required",
			 positionname:"required",
			 nohome:"required",
			 telname:{
     		 		required: true,
     			 	number: true,
					minlength:6,
					maxlength:10
			 },
			 idcard:  { required: {depends: function(element) {		return $('#statusid option:selected').val() == '2' }}, number:true},   
		 		cardW0:{ required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true},
		 		cardW1:{ required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true},
		 		cardW2:{ required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true},
		 		cardW3:{ required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true},
		 		cardW4:{
		 			required: {depends: function(element) {	return $('#statusid option:selected').val() == '1' }}, number:true,	 		
		 			remote:{
		 				url:'<?php echo base_url(); ?>users/chkidcard/patient',
				        data:{ idcard: function() { return $('#cardW0').val()+$('#cardW1').val()+$('#cardW2').val()+$('#cardW3').val()+$('#cardW4').val(); },
				          	   digit_last:function(){return $('#cardW4').val(); }				          
				        }
		 			}		 		
		 		} 			
		},
		messages:{
			firstname:"ระบุชื่อ",
			surname:"ระบุนามสกุล",
			province_id:"ระบุจังหวัด",
			age:{required:"กรุณาระบุ",number:"ระบุตัวเลขเท่านั้น"},	
			//amphur_id:"ระบุอำเภอ",
			//district_id:"ระบุตำบล",
			provinceidplace:"ระบุจังหวัด",
			//amphuridplace:"ระบุอำเภอ",
			//districtidplace:"ระบุตำบล",
			enddate:"ระบุวันถึงแก่กรรม",
			 reportname:"ระบุชื่อผู้รายงาน",
			 positionname:"ระบุตำแหน่ง",
			 nohome:"ระบุเลขที่่",
			 idcard:"กรุณาระบุ",
		 	cardW0:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข"},
		 	cardW1:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข"},
		 	cardW2:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข"},
		  	cardW3:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข"},
		 	cardW4:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข",remote :" ระบุไม่ถูกต้อง"},		 		
		 
			 telname:{
			 	required:"ระบุเบอร์โทรศัพท์",
				number:"ระบุเป็นตัวเลข",
				minlength:"ระบุอย่างน้อย 6 หลัก",
				maxlength:"ระบุไม่เกิน 10 หลัก"
			 }

		},
			errorPlacement: function(error, element){							
				if((element.attr('name')=='firstname') || (element.attr('name')=='surname')){					
					error.insertAfter("#surname");				
				}else if (element.attr("name") == "cardW0"  || element.attr("name") == "cardW1" 	|| element.attr('name') == "cardW2" || element.attr('name')=="cardW3" || element.attr('name')=="cardW4")
		      { error.insertAfter("#cardW4");}
				else {
					error.appendTo(element.parent());
				}
						
			}	
	});	
});
function show(id) {
if(id == '1') { // ถ้าเลือก radio button 1 ให้โชว์ table 1 และ ซ่อน table 2
$('#notwash').show();
$('#n_afterwash').hide();
} else if(id == '3') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1
$('#notwash').hide();
$('#n_afterwash').show();
}
else if(id == '2'){
$('#notwash').hide();
$('#n_afterwash').hide();
}
}
function show2(id) {
if(id == '3'){
	$('#otherwashing').show();}
 else if(id == '1'){
 	$('#otherwashing').hide();}
 else if(id == '2'){
 	$('#otherwashing').hide();}
}

function show3(id) {
if(id == '2'){
	$('#n_drugs').show();}
else if(id == '1'){
	$('#n_drugs').hide();}
}
function show4(id) {
if(id == '1'){
	$('#sub').show();}
else if(id == '2'){
	$('#sub').hide();}
}
function show5(id) {
if(id == '3'){
	$('#h_sub').show();}
else if(id == '2'){
	$('#h_sub').hide();}
	else if(id == '3'){
	$('#h_sub').hide();}
}

function show6(id) {
if(id == '5'){
	$('#subimprison').show();}
else if(id == '1'){
	$('#subimprison').hide();}
	else if(id == '3'){
	$('#subimprison').hide();}
	else if(id == '2'){
	$('#subimprison').hide();}
	else if(id == '4'){
	$('#subimprison').hide();}
	else {$('#subimprison').hide();}
}
function show7(id) {
if(id == '2'){
	$('#subcause_bite').show();}
else if(id == '1'){
	$('#subcause_bite').hide();}
}
function show8(id) {
if(id == '3'){
	$('#subimmunization_history').show();}
else if(id == '1'){
	$('#subimmunization_history').hide();}
	else if(id == '2'){
	$('#subimmunization_history').hide();}
}
function show9(id) {
if(id == '2'){
	$('#subspecimen').show();}
else if(id == '1'){
	$('#subspecimen').hide();}
}
function show10(id) {
if(id == '1'){
	$('#brain_tumor_lo').show();
	$('#brain_tumor_po_ne').show();
	$('#brain_tumor').show();}
else if(id == '2'){
	$('#brain_tumor').hide();
	$('#brain_tumor_lo').hide();
	$('#brain_tumor_po_ne').hide();}
	}
	function show11(id) {
if(id == '1'){
	$('#saliva_headache_lo').show();
	$('#saliva_headache_po_ne').show();
	$('#saliva_headache').show();}
else if(id == '2'){
	$('#saliva_headache').hide();
	$('#saliva_headache_lo').hide();
	$('#saliva_headache_po_ne').hide();}
	}
	function show12(id) {
if(id == '1'){
	$('#csf_lo').show();
	$('#csf_po_ne').show();
	$('#csf').show();}
else if(id == '2'){
	$('#csf_lo').hide();
	$('#csf_po_ne').hide();
	$('#csf').hide();}
	}
	function show13(id) {
if(id == '1'){
	$('#piss_lo').show();
	$('#piss_po_ne').show();
	$('#piss').show();}
else if(id == '2'){
	$('#piss_lo').hide();
	$('#piss_po_ne').hide();
	$('#piss').hide();}
	}
	function show14(id) {
if(id == '1'){
	$('#root_lo').show();
	$('#root_po_ne').show();
	$('#root').show();}
else if(id == '2'){
	$('#root_lo').hide();
	$('#root_po_ne').hide();
	$('#root').hide();}
	}
	function show15(id) {
if(id == '1'){
	$('#occipital_skin_lo').show();
	$('#occipital_skin_po_ne').show();
	$('#occipital_skin').show();}
else if(id == '2'){
	$('#occipital_skin_lo').hide();
	$('#occipital_skin_po_ne').hide();
	$('#occipital_skin').hide();}
	}
	function show16(id) {
if(id == '1'){
	$('#corneal_cells_lo').show();
	$('#corneal_cells_po_ne').show();
	$('#corneal_cells').show();}
else if(id == '2'){
	$('#corneal_cells_lo').hide();
	$('#corneal_cells_po_ne').hide();
	$('#corneal_cells').hide();}
	}
	function show17(id) {
if(id == '6'){
	$('animalother').show();}
else {
	$('#animalother').hide();}
}
</script>
<? error_reporting(E_ALL ^ E_NOTICE); ?>
<div id="title">แบบฟอร์มผู้เสียชีวิตด้วยโรคพิษสุนัขบ้า</div>
<form id="form1" name="form1" method="post"  action="inform/dead/save" > 
<div id="multiAccordion">
	<h3><a href="javascript:void(0)">ส่วนที่ 1 ข้อมูลทั่วไป</a></h3>
	<div id="section1">
		<table class="tbdead">
		<tr>
				<th rowspan="3">1.</th>
				<td><span class="topic">คำนำหน้า</span> <select name="prefix_name" class="styled-select ">
					<option value="">- โปรดเลือก -</option>
					<option value="นาย" <?php  echo (@$rs['prefix_name']=='นาย')? "selected='selected'":"" ?>>นาย</option>
					<option value="นาง" <?php  echo (@$rs['prefix_name']=='นาง')? "selected='selected'":"" ?>>นาง</option>
					<option value="นางสาว" <?php  echo (@$rs['prefix_name']=='นางสาว')? "selected='selected'":"" ?>>นางสาว</option>
					<option value="ด.ช." <?php  echo (@$rs['prefix_name']=='ด.ช.')? "selected='selected'":"" ?>>ด.ช.</option>
					<option value="ด.ญ." <?php  echo (@$rs['prefix_name']=='ด.ญ.')? "selected='selected'":"" ?>>ด.ญ.</option>							
				    </select></td>
				<td><span class="topic radio">เพศ </span>
						<input name="gender" type="radio"  value="1" <? if(@$rs['gender']=='1'){ echo "checked";}?>> ชาย
						<input name="gender" type="radio" value="2" <? if(@$rs['gender']=='2'){ echo "checked";}?>> หญิง</td>	

		
			</tr>
			<tr>
				
					<td><span class="topic">ชื่อ<span class="alertred">*</span></span>
							<input name="firstname" id="firstname" type="text" class="input_box_patient" id="firstname" value="<?php 

echo $rs['firstname'];?>" size="20" />
					</td>
					<td><span class="topic">นามสกุล <span class="alertred">*</span></span>
							  <input name="surname"  id="surname" type="text" value="<?php echo $rs['surname'];?>" size="20"  

class="input_box_patient ">
					</td>	
					<td><span class="topic">บัตรประชาชน</span>
						<span id="Show_idcard"> 
						<input name="cardW0" id="cardW0" type="text" class="input_box_patient nowidth" size="1" maxlength="1" value="<?php echo @$cardW0?>" />
				 	 - <input name="cardW1"  id="cardW1" type="text" class="input_box_patient nowidth" size="4" maxlength="4"  value="<?php echo @$cardW1?>" />
					- <input name="cardW2"  id="cardW2" type="text" class="input_box_patient nowidth" size="5" maxlength="5"   value="<?php echo @$cardW2?>"/>
					 - <input name="cardW3" id="cardW3" type="text" class="input_box_patient nowidth" size="2" maxlength="2"  value="<?php echo @$cardW3?>" />
					 -<input name="cardW4" id="cardW4" type="text" class="input_box_patient nowidth" size="1" maxlength="1"  value="<?php echo @$cardW4?>"  />				
				
					</td>					
			</tr>
			<tr>				
				<td><span class="topic">อายุ<span class="alertred">*</span></span>
                            <input name="age" id="age"  type="text" size="2" maxlength="2" value=" " class="input_box_patient auto"  onKeyUp="chk_than15(this.value);"></td>
				<td><span class="topic">ผู้ปกครอง</span> <input name="parentname" type="text" class="input_box_patient " id="parentname" 

value="<?php echo $rs['parentname'];?>" size="50" style="width:300px;"/>
		    	<td colspan="3"><small>(กรณีผู้ป่วยอายุต่ำกว่า 15 ปี กรุณากรอกชื่อ-นามสกุล ผู้ปกครอง)</small></td>						

	    			
			</tr>
			<tr>
				<th>2. </th>
				<td><span class="topic radio">เชื้อชาติ</span>
											<input name="nationality" type="radio" value="1" 

<? if(@$rs['nationalityname']=='1'){ echo "checked";}?> onClick="show_hide_nationality(document.form1);"> ไทย&nbsp;&nbsp;
						<input name="nationality" type="radio" value="2" <? if(@$rs['nationalityname']=='2'){ echo "checked";}?> 

onClick="show_hide_nationality(document.form1);"> อื่นๆ 
						<span id="nationality_tr1" <? if(@$rs['nationalityname']!='2'){ print 'style = "display:none"';}?>>
						สัญชาติ :&nbsp; 
							<select name="nationalityname"  class="styled-select " 

onChange="show_hide_clear_nationality_text(this)">
								<option value="0" <? if(@$rs['nationalityname']=='0'){echo "selected";}?>>เลือก

สัญชาติ</option>
								<option value="2" <? if(@$rs['nationalityname']=='2'){echo "selected";}?>>

จีน/ฮ่องกง/ใต้หวัน</option>
								<option value="3" <? if(@$rs['nationalityname']=='3'){echo "selected";}?>>

พม่า</option>
								<option value="4" <? if(@$rs['nationalityname']=='4'){echo "selected";}?>>

มาเลเซีย</option>
								<option value="5" <? if(@$rs['nationalityname']=='5'){echo "selected";}?>>

กัมพูชา</option>
								<option value="6" <? if(@$rs['nationalityname']=='6'){echo "selected";}?>>

ลาว</option>
								<option value="7" <? if(@$rs['nationalityname']=='7'){echo "selected";}?>>

เวียดนาม</option>
								<option value="8" <? if(@$rs['nationalityname']=='8'){echo "selected";}?>>

ยุโรป</option>
								<option value="9" <? if(@$rs['nationalityname']=='9'){echo "selected";}?>>

อเมริกา</option>
								<option value="10" <? if(@$rs['nationalityname']=='10'){echo "selected";}?>>ไม่ทราบ

สัญชาติ</option>
								<option value="11" <? if(@$rs['nationalityname']=='11'){echo "selected";}?>>

อื่นๆ</option>
                          </select>&nbsp;
							<span id="nationality_div" <? if(@$rs['nationalityname']!='11'){ print 'style = "display:none"';}?>>
								  <span class="alertred">(โปรดระบุ)</span>&nbsp;
								  <input name="othernationalityname" id="othernationalityname" type="text" 

value="<?php echo @$rs['othernationalityname'];?>" class="input_box_patient " size="20">
						  </span>
						</span>
				</td>
				<td><span class="topic radio">ศาสนา</span>
					<input type="radio" value="1" name="religion">พุทธ
					<input type="radio" value="2" name="religion">คริสต์
					<input type="radio" value="3" name="religion">อิสลาม
					<input type="radio" value="4" name="religion">อื่นๆ
				</td>
				<td colspan="7">อาชีพผู้ปกครอง : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <?php 
                              	if(@$rs['age']>15){ $disabled='disabled="disabled"';}else{$disabled='';}

                             	$class=' id="occparentsname" class="styled-select " onChange="show_hide_clear_otheroccparentsname(this);"'.$disabled;
                              	echo form_dropdown('occparentsname',get_option('id','name','n_occupations'),@$rs['occparentsname'],$class,'-โปรดเลือก-') ?>
							  <span id="otheroccparentsname_tr"  <? if(@$rs['otheroccparentsname']!='19'){ print 'style = "display:none"';}?>>
							  <span class="alertred">(โปรดระบุ)</span>
                              	<input name="otheroccparentsname" id="otheroccparentsname" type="text" class="input_box_patient " size="10" value="<?php echo @$rs['otheroccparentsname'];?>" />
							  </span>
							  </td>
			</tr>	
			
		<tr>
			<th rowspan="4">3.</th>
			<td><span class="topic radio">สถานที่สัมผัสโรค</span></td>
		</tr>
		<tr>
			<td><span class="topic">เลขที่</span><input type="text"  class="input_box_patient "name="nohome" value="<?php echo $rs['no_home'] ?>">					</td>
			<td><span class="topic">หมู่ที่</span><input type="text" class="input_box_patient " name="moo" value="<?php echo $rs['moo'] ?>"></td>
			<td> <span class="topic">หมู่บ้าน</span><input type="text"  class="input_box_patient "name="villege" value="<?php echo $rs['villege'] ?>"></td>
		</tr>
		<tr>
			<td>	<span class="topic">ชุมชน</span><input type="text"  class="input_box_patient "name="community" value="<?php echo $rs

['community'] ?>"></td>
			<td><span class="topic">ซอย</span><input name="soi" type="text" class="input_box_patient " size="20" value="<?php echo $rs['soi'];?>" 

/></td>
            <td><span class="topic">ถนน</span><input name="road" type="text" class="input_box_patient " id="road" value="<?php echo $rs['road'];?>" size="20" /></td>		

	
		</tr>
			<tr> 
				 
				  <td colspan="4"><p>
						จังหวัด <span class="alertred">*</span><?php echo form_dropdown('provinceidplace',get_option('province_id','province_name',"n_province where province_id <>'' order by province_name asc"),@$_GET['provinceidplace'],'class="styled-select " id="provinceidplace"','-โปรดเลือก-') ?>
						อำเภอ<span id="input_amphur_place">
							<?php //$this->db->debug=TRUE;
							$whamphur="";
							 if(@$_GET['provinceidplace']){
									$whamphur="AND province_id ='".@$_GET['provinceidplace']."'";
								 	$amphur_id="amphur_id <>'' ";	
								 										
							 }else{
							 	 	$amphur_id="amphur_id ='' ";
							 }
							 echo form_dropdown('amphuridplace',get_option('amphur_id','amphur_name',"n_amphur where $amphur_id $whamphur  order by amphur_name asc"),@$_GET['amphuridplace'],'class="styled-select "','-โปรดเลือก-');
							?>
					</span>
					ตำบล <span id="input_district_place">
							<?php
							$wh="";
							 if(@$_GET['provinceidplace']){
									$wh="AND province_id ='".@$_GET['provinceidplace']."' AND amphur_id='".$_GET['amphuridplace']."'";	
								 	$whdistrict="  district_id<>''";							 										
							 }else{
							 		$whdistrict="  district_id=''";
							 }	
							 echo form_dropdown('districtidplace',get_option('district_id','district_name',"n_district where $whdistrict $wh  order by district_name asc"),@$_GET['districtidplace'],'class="styled-select "','-โปรดเลือก-');
							?>
					 </span>
 					</p>
				  </td>
			</tr>

			
			<th>5.</th>
			<?php $area=array(1=>'เขตกทม.',2=>'เขตเมืองพัทยา',3=>'เขตเทศบาล',4=>'เขต อบต.'); ?>
			<td><span class="topic">พื้นที่</span><?php echo form_dropdown('area_id',$area,$rs['area_id'],'class="input_box_patient"','-โปรดเลือก-') ?></td>
		</tr>
		</table>
	</div><!--section1 -->
	<h3><a href="javascript:void(0)">ส่วนที่ 2 อาการและอาการแสดง</a></h3>
	<div id="section2">
		<table class="tbdead">
			<tr>
				<th>1. </th>
				<td><span class="topic">วันเริ่มอาการ</span><input type="text" name="startdate" class="input_box_patient datepicker  auto" 

size="10"></td>
				<td><span class="topic">วันที่รักษา</span><input type="text" name="treatdate" class="input_box_patient datepicker  auto" 

size="10"></td>
<td height="20" colspan="4" ><p>
						จังหวัด <?php echo form_dropdown('province_id',get_option('province_id','province_name',"n_province where province_id <>'' order by province_name asc"),@$_GET['province_id'],'class="styled-select " id="province"','-โปรดเลือก-') ?>
						อำเภอ <span id="input_amphur">
							<?php 
							$whamphur="";
							 if(@$_GET['province_id']){
									$whamphur="AND province_id ='".@$_GET['province_id']."'";
								 	$amphur_id="amphur_id <>'' ";	
								 										
							 }else{
							 	 	$amphur_id="amphur_id ='' ";
							 }
							 echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name',"n_amphur where $amphur_id $whamphur  order by amphur_name asc"),@$_GET['amphur_id'],'class="styled-select "','-โปรดเลือก-');
							?>
					</span>
					
					ตำบล <span id="input_district">
							<?php
							$wh="";
							 if(@$_GET['province_id']){
									$wh="AND province_id ='".@$_GET['province_id']."' AND amphur_id='".$_GET['amphur_id']."'";	
								 	$whdistrict="  district_id<>''";							 										
							 }else{
							 		$whdistrict="  district_id=''";
							 }	
							 echo form_dropdown('district_id',get_option('district_id','district_name',"n_district where $whdistrict $wh  order by district_name asc"),@$_GET['district_id'],'class="styled-select "','-โปรดเลือก-');
							?>
					</span>
										สถานพยาบาล <span id="input_hospital">											
								<? //$this->db->debug=TRUE;
								$whhospital="";
								 if(@$_GET['amphur_id']){
										$whhospital="AND hospital_amphur_id ='".@$_GET['amphur_id']."' AND hospital_district_id ='".@$_GET['district_id']."' ";
										echo form_dropdown('hospital',get_option('hospital_code','hospital_name',"n_hospital where hospital_id<>'' $whhospital ORDER BY hospital_name ASC"),@$_GET['hospital'],'class="styled-select "','-โปรดเลือก-');
								 }else{								 										 
							 ?>
					 		 <select name="hospital" id="hospital" class="styled-select ">
					 		 	<option value="">-โปรดเลือก-</option>
					 		 </select>
					 <?php } ?>
					</span> 
					</p>		
				  </td></tr>
			
			<tr>
				<th>2. </th>
				<td><span class="topic">วันที่เสียชีวิต</span>
					 <input type="text" name="endate" class="input_box_patient datepicker  auto" size="10">			

		
				</td>
			<tr>
				<th>3.</th>
				<td colspan="3"><span class="topic" style="width:140px;">อาการและอาการแสดง</span>
					<hr class="hr1">
					<ul>
						<li class="topic">ไข้</li>
						<li><?php echo form_radio('sick','1','') ?>มี</li>
						<li><?php echo form_radio('sick','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('sick','3','') ?>ไม่ทราบ</li>
						<li class="topic">ปวดศีรษะ</li>
						<li><?php echo form_radio('headache','1','') ?>มี</li>
						<li><?php echo form_radio('headache','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('headache','3','') ?>ไม่ทราบ</li>
						<li class="topic">ตื่นเต้นกระวนกระวายต่อสิ่งเร้า /แสง /เสียง</li>
						<li><?php echo form_radio('excited_stimuli','1','') ?>มี</li>
						<li><?php echo form_radio('excited_stimuli','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('excited_stimuli','3','') ?>ไม่ทราบ</li>
						<li class="topic">อาละวาดผุดลุกผุดนั่ง</li>
						<li><?php echo form_radio('rampant','1','') ?>มี</li>
						<li><?php echo form_radio('rampant','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('rampant','3','') ?>ไม่ทราบ</li>
						<li class="topic">กลืนลำบาก</li>
						<li><?php echo form_radio('dysphagia','1','') ?>มี</li>
						<li><?php echo form_radio('dysphagia','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('dysphagia','3','') ?>ไม่ทราบ</li>
						<li class="topic">ซึม ไม่รู้สึกตัว</li>
						<li><?php echo form_radio('depress','1','') ?>มี</li>
						<li><?php echo form_radio('depress','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('depress','3','') ?>ไม่ทราบ</li>
						<li class="topic">ถ่มน้ำลายตลอดเวลา</li>
						<li><?php echo form_radio('spit_the_time','1','') ?>มี</li>
						<li><?php echo form_radio('spit_the_time','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('spit_the_time','3','') ?>ไม่ทราบ</li>
						<li class="topic">ถอนหายใจเป็นพักๆ</li>
						<li><?php echo form_radio('sigh_frequently','1','') ?>มี</li>
						<li><?php echo form_radio('sigh_frequently','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('sigh_frequently','3','') ?>ไม่ทราบ</li>
						<li class="topic">กลัวลม</li>
						<li><?php echo form_radio('fear_wind','1','') ?>มี</li>
						<li><?php echo form_radio('fear_wind','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('fear_wind','3','') ?>ไม่ทราบ</li>
						<li class="topic">ขนลุกบางส่วนหรือทั้งตัว</li>
						<li><?php echo form_radio('all_the_burmps','1','') ?>มี</li>
						<li><?php echo form_radio('all_the_burmps','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('all_the_burmps','3','') ?>ไม่ทราบ</li>
						<li class="topic">กลัวน้ำ</li>
						<li><?php echo form_radio('fear_water','1','') ?>มี</li>
						<li><?php echo form_radio('fear_water','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('fear_water','3','') ?>ไม่ทราบ</li>
						<li class="topic">สูญเสียความทรงจำชั่วคราว</li>
						<li><?php echo form_radio('loss_of_memory','1','') ?>มี</li>
						<li><?php echo form_radio('loss_of_memory','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('loss_of_memory','3','') ?>ไม่ทราบ</li>
						<li class="topic">รูม่านตาไม่ตอบสนองต่อแสง</li>
						<li><?php echo form_radio('respond_light','1','') ?>มี</li>
						<li><?php echo form_radio('respond_light','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('respond_light','3','') ?>ไม่ทราบ</li>
						<li class="topic">แขนขาอ่อนแรง</li>
						<li><?php echo form_radio('arm_leg_feeble','1','') ?>มี</li>
						<li><?php echo form_radio('arm_leg_feeble','2','') ?>ไม่มี</li>
						<li><?php echo form_radio('arm_leg_feeble','3','') ?>ไม่ทราบ</li>
					</ul>
				</td>
			</tr>

		</table>
	</div><!--section2-->
	<h3><a href="javascript:void(0)">ส่วนที่ 3 ผลตรวจทางห้องปฏิบัติการในคน</a></h3>
	<div id="section3">
		<table class="tbdead">
			<tr>
				<th>1.</th>
				<td>	<span class="topic radio">เนื้องอกสมอง</span>	
				<td><input name="brain_tumor" type="radio" value="2" onclick="show10(this.value);">ไม่ได้ส่ง <input 

name="brain_tumor" type="radio" value="1" onclick="show10(this.value);">ส่ง</td>	
				<td><span id="brain_tumor"style = "display:none">วันที่ส่งตรวจ <input type="text"name="brain_tumordate" 

class="input_box_patient datepicker  auto" size="10"></span></td>	
				<td><span id="brain_tumor_lo" style = "display:none">สถานที่ส่งตรวจ 
					<?php 
					  			$class=' id="brain_tumor_lo" class="input_box_patient " 

onChange="show_hide_clear_otherheadanimalplace(this);"';
					  		 	echo form_dropdown('brain_tumor_lo',get_option('id','name','n_humanplaces'),@

$rs['brain_tumor_lo'],$class,'-โปรดเลือก-'); ?>
		</td></span>
				<td><span id="brain_tumor_po_ne" style = "display:none"><?php echo form_radio('brain_tumor_po_ne','1','') ?>Positive<?php 

echo form_radio('brain_tumor_po_ne','2','') ?>Negative</span></td>
			</tr>
			<tr>
				<th>2.</th>
				<td>	<span class="topic radio">น้ำลายปวดศีรษะ</span>	
				<td><input name="saliva_headache" type="radio" value="2" onclick="show11(this.value);">ไม่ได้ส่ง 

<input name="saliva_headache" type="radio" value="1" onclick="show11(this.value);">ส่ง</td>	
				<td><span id="saliva_headache" style = "display:none">วันที่ส่งตรวจ <input type="text" name="saliva_headachedate" 

class="input_box_patient datepicker  auto" size="10"></span></td>	
				<td><span id="saliva_headache_lo" style = "display:none">สถานที่ส่งตรวจ
					<?php 
					  			$class=' id="saliva_headache_lo" class="input_box_patient " 

onChange="show_hide_clear_otherheadanimalplace(this);"';
					  		 	echo form_dropdown('saliva_headache_lo',get_option

('id','name','n_humanplaces'),@$rs['saliva_headache_lo'],$class,'-โปรดเลือก-'); ?> 
					  		 	</td></span>
				<td><span id="saliva_headache_po_ne" style = "display:none"><?php echo form_radio('saliva_headache_po_ne','1','') ?>Positive<?php echo form_radio('saliva_headache_po_ne','2','') ?>Negative</span></td>
			</tr>
			<tr>
				<th>3.</th>
				<td>	<span class="topic radio">น้ำไขสันหลัง</span>	
				<td><input name="csf" type="radio" value="2" onclick="show12(this.value);">ไม่ได้ส่ง <input name="csf" 

type="radio" value="1" onclick="show12(this.value);">ส่ง</td>	
				<td><span id="csf" style = "display:none">วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" 

name="csfdate" size="10"></span></td>	
				<td><span id="csf_lo" style = "display:none">สถานที่ส่งตรวจ 
					<?php 
					  			$class=' id="csf_lo" class="input_box_patient " 

onChange="show_hide_clear_otherheadanimalplace(this);"';
					  		 	echo form_dropdown('csf_lo',get_option('id','name','n_humanplaces'),@$rs

['csf_lo'],$class,'-โปรดเลือก-'); ?>
					  		 	</td></span>
				<td><span id="csf_po_ne" style = "display:none"><?php echo form_radio('csf_po_ne','1','') ?>Positive<?php echo form_radio

('csf_po_ne','2','') ?>Negative</span></td>
				</tr>
			<tr>
				<th>4.</th>
				<td>	<span class="topic radio">ปัสสาวะ</span>	
				<td><input name="piss" type="radio" value="2" onclick="show13(this.value);">ไม่ได้ส่ง <input name="piss" 

type="radio" value="1" onclick="show13(this.value);">ส่ง</td>	
				<td><span id="piss" style = "display:none">วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" 

name="pissdate" size="10"></span></td>	
				<td><span id="piss_lo" style = "display:none">สถานที่ส่งตรวจ 
					<?php 
					  			$class=' id="piss_lo" class="input_box_patient " 

onChange="show_hide_clear_otherheadanimalplace(this);"';
					  		 	echo form_dropdown('piss_lo',get_option('id','name','n_humanplaces'),@$rs

['piss_lo'],$class,'-โปรดเลือก-'); ?>
					  		 	</td></span>
				<td><span id="piss_po_ne" style = "display:none"><?php echo form_radio('piss_po_ne','1','') ?>Positive<?php echo 

form_radio('piss_po_ne','2','') ?>Negative</span></td>
			</tr>
			<tr>
				<th>5.</th>
				<td>	<span class="topic radio">ปมรากผล</span>	
				<td><input name="root" type="radio" value="2" onclick="show14(this.value);">ไม่ได้ส่ง <input name="root" 

type="radio" value="1" onclick="show14(this.value);">ส่ง</td>	
				<td><span id="root" style = "display:none">วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" 

name="rootdate" size="10"></span></td>	
				<td><span id="root_lo" style = "display:none">สถานที่ส่งตรวจ 
					<?php 
					  			$class=' id="root_lo" class="input_box_patient " 

onChange="show_hide_clear_otherheadanimalplace(this);"';
					  		 	echo form_dropdown('root_lo',get_option('id','name','n_humanplaces'),@$rs

['root_lo'],$class,'-โปรดเลือก-'); ?>
					  		 	</td></span>
				<td><span id="root_po_ne" style = "display:none"><?php echo form_radio('root_po_ne','1','') ?>Positive<?php echo form_radio

('root_po_ne','2','') ?>Negative</span></td>
			</tr>
			<tr>
				<th>6.</th>
				<td>	<span class="topic radio">ผิวหนังท้ายทอย</span>	
				<td><input name="occipital_skin" type="radio" value="2" onclick="show15(this.value);">ไม่ได้ส่ง <input 

name="occipital_skin" type="radio" value="1" onclick="show15(this.value);">ส่ง</td>	
				<td><span id="occipital_skin" style = "display:none">วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" 

name="occipital_skindate" size="10"></span></td>	
				<td><span id="occipital_skin_lo" style = "display:none">สถานที่ส่งตรวจ 
					<?php 
					  			$class=' id="occipital_skin_lo" class="input_box_patient " 

onChange="show_hide_clear_otherheadanimalplace(this);"';
					  		 	echo form_dropdown('occipital_skin_lo',get_option

('id','name','n_humanplaces'),@$rs['occipital_skin_lo'],$class,'-โปรดเลือก-'); ?>
					  		 	</td></span>
				<td><span id="occipital_skin_po_ne" style = "display:none"><?php echo form_radio('occipital_skin_po_ne','1','') ?>Positive<?php echo form_radio('occipital_skin_po_ne','2','') ?>Negative</span></td>
			</tr>
			<tr>
				<th>7.</th>
				<td>	<span class="topic radio">เซลล์กระจกตา</span>	
				<td><input name="corneal_cells" type="radio" value="2" onclick="show16(this.value);">ไม่ได้ส่ง <input 

name="corneal_cells" type="radio" value="1" onclick="show16(this.value);">ส่ง</td>	
				<td><span id="corneal_cells" style = "display:none">วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" 

name="corneal_cellsdate" size="10"></span></td>	
				<td><span id="corneal_cells_lo" style = "display:none">สถานที่ส่งตรวจ 
					<?php 
					  			$class=' id="corneal_cells_lo" class="input_box_patient " 

onChange="show_hide_clear_otherheadanimalplace(this);"';
					  		 	echo form_dropdown('corneal_cells_lo',get_option

('id','name','n_humanplaces'),@$rs['corneal_cells_lo'],$class,'-โปรดเลือก-'); ?>
					  		 	</td></span>
				<td><span id="corneal_cells_po_ne" style = "display:none"><?php echo form_radio('corneal_cells_po_ne','1','') ?>Positive<?php echo form_radio('corneal_cells_po_ne','2','') ?>Negative</span></td>
			</tr>
		</table>		
	</div><!-- section3 -->
	<h3><a href="javascript:void(0)">ส่วนที่ 4 ประวัติการสัมผัสโรค</a></h3>
	<div id="section4">
		<table class="tbdead">
			<tr><th>1.</th>
					<td><span class="topic">วันที่สัมผัส</span><input type="text" name="datetouch" class="datepicker  auto 

input_box_patient" size="10"> </td>
			</tr>
			<tr>
				<th rowspan="3">2.</th>
				<td style="padding:10px;">บริเวณที่ถูกสัมผัสและความรุนแรง</td>
			</tr>
			<tr>
				<td><strong>โปรดทำเครื่อง x ลงบนภาพร่ายกาย บริเวณที่ถูกกัด/ข่วน/ถูกน้ำลาย/ถูกเลีย ให้ชัดเจน</strong></td>
			</tr>
			<tr>
				<td rowspan="4">
					<div style="width:994px;height:409px;clear: both;position:relative;">
					<div  style="position:absolute;width:222px;height:264px;background:url(images/body_man1.gif);float:left; "  

id="body_man">
										<div id="markhead" style="position:absolute; left:160px; 

top:15px; width:12px; height:12px; z-index:8;"></div>
										<div id="markface" style="position:absolute; left:57px; 

top:24px; width:12px; height:12px; z-index:1;"></div>
										<div id="markneck" style="position:absolute; left:57px; 

top:45px; width:12px; height:12px; z-index:2;"></div>
										<div id="markbody" style="position:absolute; left:57px; 

top:72px; width:12px; height:12px; z-index:3;"></div>
										<div id="markarm" style="position:absolute; left:25px; 

top:92px; width:12px; height:12px; z-index:4;"></div>
										<div id="markhand" style="position:absolute; left:22px; 

top:135px; width:12px; height:12px; z-index:5;"></div>
										<div id="markleg" style="position:absolute; left:47px; 

top:192px; width:12px; height:12px; z-index:6;"></div>								
										<div id="markfeet" style="position:absolute; left:49px; 

top:232px; width:12px; height:12px; z-index:7;"></div>									
						</div>		
					<div class="wrap_table" style="width:772px;height:300px;float:right;">
					
					<table class="tbreport1" style="width:70%">						
						<tr>
							<td rowspan="3">ลำดับที่</td>
							<td  rowspan="3">อวัยวะที่ได้รับการสัมผัส</td>
							<td colspan="6">ลักษณะการสัมผัส</td>
						</tr>
						<tr>
							<td colspan="2">ถูกกัด</td>
							<td colspan="2">ถูกข่วน</td>
							<td colspan="2">ถูกเลีย/ถูกน้ำลาย</td>
						</tr>
						<tr>
							<td>มีเลือดออก</td>
							<td>ไม่มีเลือดออก</td>
							<td>มีเลือดออก</td>
							<td>ไม่มีเลือดออก</td>
							<td>ที่มีแผล</td>
							<td>ที่ไม่มีแผล</td>								

									
						</tr>
						<tr>
							<td rowspan="4">1</td>
						</tr>
						  <tr> 
                     
                        <td align="center">ศีรษะ</td>
                         <td align="center" bgcolor="#E60000"><input name="head_bite_blood" id="head_bite_blood" type="radio"  <? if(!empty($rs['head_bite_blood'])){ echo 

'checked';}?>  value="1" onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById

('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById

('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById

('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td align="center" bgcolor="#FF777A"><input name="head_bite_blood" id="head_bite_noblood" type="radio"  <? if(!empty($rs['head_bite_noblood'])){ echo 

'checked';}?> value="2" onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById

('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById

('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById

('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td align="center" bgcolor="#669966"> <input name="head_claw_blood"  id="head_claw_blood" type="radio" <? if(!empty($rs['head_claw_blood'])){ echo 

'checked';}?> 	value="1" 	
                        	onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById

('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById

('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById

('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="head_claw_blood" id="head_claw_noblood" type="radio" <? if(!empty($rs['head_claw_noblood'])){ echo 

'checked';}?>  value="2" 
                        	onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById

('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById

('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById

('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="head_lick_blood"   id="head_lick_blood"type="radio" <? if(!empty($rs['head_lick_blood'])){ echo 

'checked';}?> 	value="1" 	
                        	onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById

('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById

('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById

('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="head_lick_blood" id="head_lick_noblood"type="radio" <? if(!empty($rs['head_lick_noblood'])){ echo 

'checked';}?> value="2" 
                        	onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById

('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById

('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById

('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                      </tr>
                      <tr>
                        <td align="center">หน้า</td>
                    
                        <td align="center" bgcolor="#E60000"> <input name="face_bite_blood"  id="face_bite_blood" class="one_required" <? if(!empty($rs['face_bite_blood'])){ echo 

'checked';}?> type="radio" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById

('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById

('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById

('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="face_bite_blood"  id="face_bite_noblood"class="one_required"  <? if(!empty($rs['face_bite_noblood'])){ 

echo 'checked';}?> type="radio" value="2" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById

('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById

('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById

('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td align="center" bgcolor="#669966"> <input name="face_claw_blood" id="face_claw_blood"class="one_required"  <? if(!empty($rs['face_claw_blood'])){ 

echo 'checked';}?> type="radio" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById

('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById

('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById

('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="face_claw_blood" id="face_claw_noblood" class="one_required" <? if(!empty($rs

['face_claw_noblood'])){ echo 'checked';}?> type="radio"value="2" onClick="show_mark(document.getElementById

('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById

('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById

('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="face_lick_blood"  id="face_lick_blood" class="one_required" <? if(!empty($rs['face_lick_blood'])){ echo 

'checked';}?> type="radio" value="1" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById

('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById

('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById

('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="face_lick_blood"  id="face_lick_noblood"class="one_required"  <? if(!empty($rs['face_lick_noblood'])){ 

echo 'checked';}?> type="radio" value="2" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById

('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById

('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById

('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                      </tr>
                      <tr> 
                      
                        <td align="center">ลำคอ</td>
                       
                        <td align="center" bgcolor="#E60000"> <input name="neck_bite_blood"  id="neck_bite_blood" class="one_required"  <? if(!empty($rs['neck_bite_blood'])){ 

echo 'checked';}?> type="radio"value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById

('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById

('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById

('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                   
                        <td align="center" bgcolor="#FF777A"> <input name="neck_bite_blood"  id="neck_bite_noblood"class="one_required"  <? if(!empty($rs

['neck_bite_noblood'])){ echo 'checked';}?> type="radio" value="2" onClick="show_mark(document.getElementById

('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById

('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById

('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        
                        <td align="center" bgcolor="#669966"> <input name="neck_claw_blood"  id="neck_claw_blood"class="one_required"  <? if(!empty($rs['neck_claw_blood'])){ 

echo 'checked';}?> type="radio"  value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById

('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById

('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById

('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                       
                        <td align="center" bgcolor="#36CF74"> <input name="neck_claw_blood" id="neck_claw_noblood"class="one_required"  <? if(!empty($rs

['neck_claw_noblood'])){ echo 'checked';}?> type="radio" value="2" onClick="show_mark(document.getElementById

('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById

('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById

('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        
                        <td align="center" bgcolor="#6394bd"> <input name="neck_lick_blood" id="neck_lick_blood"class="one_required"  <? if(!empty($rs['neck_lick_blood'])){ echo 

'checked';}?> type="radio" value="1" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById

('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById

('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById

('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        
                        <td align="center" bgcolor="#35ADF4"> <input name="neck_lick_blood" id="neck_lick_noblood" class="one_required" <? if(!empty($rs['neck_lick_noblood'])){ 

echo 'checked';}?> type="radio" value="2" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById

('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById

('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById

('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        
                      </tr>
                      <tr> 
                       
                        <td align="center">2</td>
                
                        <td align="center">มือ</td>
                        
                        <td align="center" bgcolor="#E60000"> <input name="hand_bite_blood" id="hand_bite_blood"class="one_required"  <? if(!empty($rs['hand_bite_blood'])){ 

echo 'checked';}?> type="radio"  value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById

('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById

('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById

('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        
                        <td align="center" bgcolor="#FF777A"> <input name="hand_bite_blood" id="hand_bite_noblood"class="one_required"  <? if(!empty($rs

['hand_bite_noblood'])){ echo 'checked';}?> type="radio"  value="2" onClick="show_mark(document.getElementById

('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById

('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById

('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        
                        <td align="center" bgcolor="#669966"> <input name="hand_claw_blood" id="hand_claw_blood"class="one_required"  <? if(!empty($rs['hand_claw_blood'])){ 

echo 'checked';}?> type="radio"  value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById

('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById

('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById

('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        
                        <td align="center" bgcolor="#36CF74"> <input name="hand_claw_blood"  id="hand_claw_noblood"class="one_required"  <? if(!empty($rs

['hand_claw_noblood'])){ echo 'checked';}?> type="radio"  value="2" onClick="show_mark(document.getElementById

('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById

('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById

('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        
                        <td align="center" bgcolor="#6394bd"> <input name="hand_lick_blood"  id="hand_lick_blood"class="one_required"  <? if(!empty($rs['hand_lick_blood'])){ 

echo 'checked';}?>  type="radio" value="1" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById

('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById

('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById

('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        
                        <td align="center" bgcolor="#35ADF4"> <input name="hand_lick_blood" id="hand_lick_noblood"class="one_required"  <? if(!empty($rs['hand_lick_noblood'])){ 

echo 'checked';}?> type="radio" value="2" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById

('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById

('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById

('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        
                      </tr>
                      <tr> 
                        
                        <td align="center">3</td>
                        
                        <td align="center">แขน</td>
                       
                        <td align="center" bgcolor="#E60000"> <input name="arm_bite_blood" id="arm_bite_blood"class="one_required"  <? if(!empty($rs['arm_bite_blood'])){ echo 

'checked';}?> type="radio" value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById

('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById

('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById

('markarm'))"></td>
                       
                        <td align="center" bgcolor="#FF777A"> <input name="arm_bite_blood"  id="arm_bite_noblood"class="one_required"  <? if(!empty($rs['arm_bite_noblood'])){ 

echo 'checked';}?> type="radio"  value="2" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById

('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById

('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById

('markarm'))"></td>
                        
                        <td align="center" bgcolor="#669966"> <input name="arm_claw_blood" id="arm_claw_blood" class="one_required"  <? if(!empty($rs['arm_claw_blood'])){ echo 

'checked';}?> type="radio"  value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById

('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById

('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById

('markarm'))"></td>
                        
                        <td align="center" bgcolor="#36CF74"> <input name="arm_claw_blood" id="arm_claw_noblood"class="one_required"   <? if(!empty($rs['arm_claw_noblood'])){ 

echo 'checked';}?>  type="radio" value="2" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById

('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById

('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById

('markarm'))"></td>
                       
                        <td align="center" bgcolor="#6394bd"> <input name="arm_lick_blood" id="arm_lick_blood"class="one_required"  <? if(!empty($rs['arm_lick_blood'])){ echo 

'checked';}?> type="radio"  value="1" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById

('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById

('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById

('markarm'))"></td>
                        
                        <td align="center" bgcolor="#35ADF4"> <input name="arm_lick_blood" id="arm_lick_noblood"class="one_required"  <? if(!empty($rs['arm_lick_noblood'])){ 

echo 'checked';}?> type="radio" value="2" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById

('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById

('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById

('markarm'))"></td>
                        
                      </tr>
                      <tr> 
                        
                        <td align="center">4</td>
                       
                        <td align="center">ลำตัว</td>
                        
                        <td align="center" bgcolor="#E60000"> <input name="body_bite_blood" id="body_bite_blood"class="one_required"  <? if(!empty($rs['body_bite_blood'])){ 

echo 'checked';}?> type="radio"  value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById

('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById

('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById

('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                       
                        <td align="center" bgcolor="#FF777A"> <input name="body_bite_blood" id="body_bite_blood"class="one_required"  <? if(!empty($rs['body_bite_noblood'])){ 

echo 'checked';}?> type="radio"  value="2" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById

('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById

('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById

('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        
                        <td align="center" bgcolor="#669966"> <input name="body_claw_blood" id="body_claw_blood"class="one_required"  <? if(!empty($rs['body_claw_blood'])){ 

echo 'checked';}?> type="radio"  value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById

('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById

('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById

('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        
                        <td align="center" bgcolor="#36CF74"> <input name="body_claw_blood" id="body_claw_blood"class="one_required"   <? if(!empty($rs

['body_claw_noblood'])){ echo 'checked';}?> type="radio"  value="2" onClick="show_mark(document.getElementById

('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById

('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById

('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        
                        <td align="center" bgcolor="#6394bd"> <input name="body_lick_blood" id="body_lick_blood"class="one_required"  <? if(!empty($rs['body_lick_blood'])){ 

echo 'checked';}?> type="radio"  value="1" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById

('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById

('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById

('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        
                        <td align="center" bgcolor="#35ADF4"> <input name="body_lick_blood"  id="body_lick_blood" class="one_required" <? if(!empty($rs['body_lick_noblood'])){ 

echo 'checked';}?> type="radio" value="2" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById

('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById

('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById

('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                       
                      </tr>
                      <tr> 
                        
                        <td align="center">5</td>
                        
                        <td align="center">ขา</td>
                        
                        <td align="center" bgcolor="#E60000"> 
                        	<input name="leg_bite_blood"  id="leg_bite_blood" class="one_required"  <? if(!empty($rs['leg_bite_blood'])){ echo 'checked';}?> type="radio" 

value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById

('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById

('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                        
                        <td align="center" bgcolor="#FF777A"> 
                        	<input name="leg_bite_blood"  id="leg_bite_noblood"class="one_required"  <? if(!empty($rs['leg_bite_noblood'])){ echo 'checked';}?> type="radio"  

value="2" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById

('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById

('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                        
                        <td align="center" bgcolor="#669966"> 
                        	<input name="leg_claw_blood" id="leg_claw_blood"class="one_required"  <? if(!empty($rs['leg_claw_blood'])){ echo 'checked';}?> type="radio" 

value="1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById

('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById

('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                        
                        <td align="center" bgcolor="#36CF74"> 
                        	<input name="leg_claw_blood" id="leg_claw_noblood"class="one_required"   <? if(!empty($rs['leg_claw_noblood'])){ echo 'checked';}?> 

type="radio" value="2" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById

('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById

('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                        
                        <td align="center" bgcolor="#6394bd"> 
                        	<input name="leg_lick_blood"  id="leg_lick_blood"class="one_required"  <? if(!empty($rs['leg_lick_blood'])){ echo 'checked';}?> type="radio"  

value="'1" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById

('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById

('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        </td>
                        
                        <td align="center" bgcolor="#35ADF4"> 
                        	<input name="leg_lick_blood"  id="leg_lick_noblood"class="one_required"  <? if(!empty($rs['leg_lick_noblood'])){ echo 'checked';}?> type="radio" 

value="2" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById

('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById

('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                       
                      </tr>
                      <tr> 
                        
                        <td align="center">6</td>
                       
                        <td align="center">เท้า</td>
                        
                        <td align="center" bgcolor="#E60000"> 
                        	<input name="feet_bite_blood"  id="feet_bite_blood" class="one_required" <? if(!empty($rs['feet_bite_blood'])){ echo 'checked';}?> type="radio" 

value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById

('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById

('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById

('markfeet'))">
                        </td>
                        
                        <td align="center" bgcolor="#FF777A"> 
                        	<input name="feet_bite_blood"class="one_required"  <? if(!empty($rs['feet_bite_noblood'])){ echo 'checked';}?> type="radio" id="feet_bite_noblood" 

value="2" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById

('feet_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById

('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById

('markfeet'))">
                        </td>
                        
                        <td align="center" bgcolor="#669966"> 
                        	<input name="feet_claw_blood" class="one_required"  <? if(!empty($rs['feet_claw_blood'])){ echo 'checked';}?> type="radio" id="feet_claw_blood" 

value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById

('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById

('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById

('markfeet'))">
                        </td>
                        
                        <td align="center" bgcolor="#36CF74"> 
                        	<input name="feet_claw_blood"class="one_required"  <? if(!empty($rs['feet_claw_noblood'])){ echo 'checked';}?> type="radio" 

id="feet_claw_noblood" value="2" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById

('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById

('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById

('markfeet'))">
                        </td>
                        
                        <td align="center" bgcolor="#6394bd"> 
                        	<input name="feet_lick_blood" class="one_required" <? if(!empty($rs['feet_lick_blood'])){ echo 'checked';}?> type="radio" id="feet_lick_blood" 

value="1" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById

('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById

('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById

('markfeet'))">
                        </td>
                        
                        <td align="center" bgcolor="#35ADF4">
                        	 <input name="feet_lick_blood" class="one_required" <? if(!empty($rs['feet_lick_noblood'])){ echo 'checked';}?> type="radio" id="feet_lick_noblood" 

value="2" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById

('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById

('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById

('markfeet'))">                     	
                        </td>
                        
                      </tr>
                     
                      
						
					</table>
					</div><!-- wrap_table-->
				</div>
				</td>
			</tr>
	
		</table>
	</div><!--section4 -->	
	<h3><a href="javascript:void(0)">ส่วนที่ 5 การปฏิบัติเมื่อถูกกัด/ข่วน/ถูกน้ำลาย/ถูกเลีย</a></h3>
	<div id="section5">
		<table class="tbdead" name="b" id="tbdead5">
			<tr>
				<th rowspan="2">1.</th>
				<td class="cn1" id="cn1"><span class="topic radio">ความสะอาดบาดแผล</span>
					<input name="wash" type="radio" value="1" onclick="show(this.value);">ไม่ได้ล้าง
					<span class="n_afterwash" id ="notwash" style = "display:none">
						 เพราะ <input type="text" name="notwash" class="input_box_patient" id="notwash" ></span>
					<input name="wash" type="radio" value="2" onclick="show(this.value);">ล้างทันทีที่ถูกกัด
					<input name="wash" type="radio" value="3" onclick="show(this.value);">ล้างหลังจากถูกกัดแล้ว
					<span class="n_afterwash" id ="n_afterwash" style = "display:none"><input type="text" name="afterwash" 

class="input_box_patient auto" id="afterwash" size="2"> ชั่วโมง/วัน </span>
				</td>
			</tr>
			<tr><td colspan="3"><span class="topic radio">วิธีล้างดังนี้</span>
				<input name="washing" type="radio" value="1" onclick="show2(this.value);">ล้างด้วยน้ำเปล่า
				<input name="washing" type="radio" value="2" onclick="show2(this.value);">สบู่/ผงซักฟอก
				<input name="washing" type="radio" value="3" onclick="show2(this.value);">อื่นๆ 
				<span id="otherwashing" <? if(@$rs['washing']!='3'){print 'style = "display:none"';  }?>>ระบุ 
					<input type="text"  name="otherwashing" id="washing" class="input_box_patient"></span>
			</td></tr>
			<tr>
				<th>2.</th>
				<td><span class="topic radio">การใช้ยาใส่แผล </span>
					<input name="drugs" type="radio" value="1" onclick="show3(this.value);">ไม่ได้ใช้
					<input name="drugs" type="radio" value="2" onclick="show3(this.value);">ใช้ 
					<span class="n_drugs" id ="n_drugs" <? if(@$rs['drugs']!='2'){print 'style = "display:none"';  }?>>ระบุชนิด <input 

type="text" class="input_box_patient" name="usedrugs" id="drugs"></span></td>
			</tr>
		</table>
	</div><!--section5-->	
	<h3><a href="javascript:void(0)">ส่วนที่ 6 ประวัติการได้รับวัคซีน/อิมมูโนโกบุลิน/อาการแทรกซ้อนหลังการฉีดของผู้เสียชีวิต</a></h3>
	<div id="section6">
		<table class="tbdead">
			<tr>
				<th>1.</th>
				<td><span class="topic radio">ฉีดอิมมูโนโกบุลิน</span>					
						<input name="use_rig" type="radio" value="2" onclick="show4(this.value);">ไม่ได้ฉีด 
						<input name="use_rig" type="radio" value="1" onclick="show4(this.value);">ฉีด 			

						
							<ul class="sub"><span id="sub" style = "display:none">
							<li><?php echo form_radio('inject1_e','ERIG','') ?>ERIG<?php echo form_radio

('inject1_e','HRIG','') ?>HRIG	เมื่อวันที่<input type="text" class="input_box_patient datepicker  auto"  name="hr_date" size="10"></li>
							<li>จำนวน <input type="text"name="n_userig" class="input_box_patient">  IU/kg </li>
							<li>Lot.No <input type="text"  name="logno_userig"class="input_box_patient"> </li>
							<li>วันหมดอายุ <input type="text" name="exp_userig" class="input_box_patient datepicker  auto" 

size="10"></li></span></ul>
					</td>
			</tr>
			<tr>
				<th>2.</th>
				<td class="topic"><span class="topic radio">ประวัติการฉีดวัคซีนป้องกันโรค</span>
						<input name="vaccine_text" type="radio" value="1" onclick="show5(this.value);">ไม่ทราบ
						<input name="vaccine_text" type="radio" value="2" onclick="show5(this.value);">ไม่ได้ฉีด 
						<input name="vaccine_text" type="radio" value="3" onclick="show5(this.value);">ฉีด 			

						
							<ul class="sub" id ="h_sub" style = "display:none" >
							<li>ชนิดของวัคซีน ระบุ <?php $vaccine_type =array

(1=>'HDCV',2=>'PCEC',3=>'PVRV',4=>'CPRV',5=>'PDEV');
								echo form_dropdown('vaccine_type',$vaccine_type,'','class="styled-select"');
							 ?>								
							</li>
							<li> วันที่เริ่มฉีด <input type="text"  name="vaccine_date" class="input_box_patient auto 

datepicker" size="10"> จำนวน <input type="text" class="input_box_patient auto" size="3" name ="sum_vaccine">ซีซี</li>
							<li> Lot. No. <input type="text" name="vaccine_lotno" class="input_box_patient auto" 

size="5">วันที่หมดอายุ <input type="text" class="input_box_patient auto datepicker"  name="exp_vaccine" size="10"></li>
						</ul> 	
				</td>
			</tr>
		</table>
	</div><!-- section 6-->	
	<h3><a href="javascript:void(0)">ส่วนที่ 7 ประวัติของสัตว์ที่กัด</a></h3>
	<div id="section7">
		<table class="tbdead">
			<tr>
				<th>1.</th>
				<td>
					<span class="topic">ชนิดของสัตว์</span>
					<?php $animal=array(1=>'สุนัข',2=>'แมว',3=>'ลิง',4=>'ชะนี',5=>'หนู',6=>'อื่นๆ ระบุ');echo form_dropdown('animal',

$animal,@$rs['animal'],'class="styled-select"');?>
					<span class="other">
						<input type="text" name="animal_other" class="input_box_patient" value="<? echo $rs['animal_other'] ?>"></span>
				</td> 			
				
			</tr>
			<tr>
				<th>2.</th>
				<td><span class="topic">อายุของสัตว์</span>
					<?php $age=array(1=>'น้อยกว่า 3 เดือน',2=>'3-6 เดือน',3=>'6-12 เดือน',4=>'มากกว่า 1 ปี',5=>'ไม่ทราบ'); ?>
					<?php echo  form_dropdown('age_animal',$age,@$rs['age_animal'],'class="styled-select"');?>
				</td>

			</tr>
			<tr>
				<th>3.</th>
				<td><span class="topic radio">สถานภาพสัตว์</span>
					<?php echo form_radio('statusanimal','1','') ?>มีเจ้าของ
					<?php echo form_radio('statusanimal','2','') ?>ไม่มีเจ้าของ
					<?php echo form_radio('statusanimal','3','') ?>ไม่ทราบ
				</td>
			</tr>
			<tr>
				<th>4.</th>
				<td valign="top"><span class="topic radio">การกักขังติดตาม</span>
					<input name="detain" type="radio" value="1"  <? if(@$rs['detain']=='1'){ echo "checked";}?>onclick="show6(this.value);">ไม่ทราบ
					<input name="detain" type="radio" value="2"  <? if(@$rs['detain']=='2'){ echo "checked";}?>onclick="show6(this.value);">สัตว์หนีหายไปติดตามไม่ได้
					<input name="detain" type="radio" value="3"  <? if(@$rs['detain']=='3'){ echo "checked";}?>onclick="show6(this.value);">ถูกฆ่า/รถทับตาย							
					<input name="detain" type="radio" value="4" <? if(@$rs['detain']=='4'){ echo "checked";}?>onclick="show6(this.value);">ไม่ได้กักขัง
					<input name="detain" type="radio" value="5" <? if(@$rs['detain']=='5'){ echo "checked";}?> onclick="show6(this.value);">ได้กักขัง/ติดตามพบ
					<span id="subimprison" <? if(@$rs['detain']!=='5'){print 'style = "display:none"'; }?>><ul class="sub" style="margin-right:24%;"><!-- 17%-->
						<li><input name="deaddetain" type="radio" value="1" <? if(@$rs['deaddetain']=='1'){ echo "checked";}?>>ไม่ตายภายใน 10 วัน</li>
						<li><input name="deaddetain" type="radio" value="2" <? if(@$rs['deaddetain']=='2'){ echo "checked";}?> >ตายเองภายใน 10 วัน</li>
					</ul>	</span>									
				</td>
			</tr>
			<tr>
				<th>5.</th>
				<td colspan="3"><span class="topic radio">สาเหตุที่ถูกกัด</span>
					<input name="reasonbite" type="radio" value="1" onclick="show7(this.value);">ถูกกัดโดยไม่มีสาเหตุโน้นำ
					<input name="reasonbite" type="radio" value="2" onclick="show7(this.value);">ถูกกัดโดยมีสาเหตุโน้มนำ 
					<span id="subcause_bite" style = "display:none" <? if(@$rs['reasonbite']!=='2'){print 'style = "display:none"'; }?>>เนื่องจาก
					 <ul class="sub" >
					 	<li><?php echo form_radio('n_reasonbite','1','') ?>ทำร้าย หรือแกล้งสัตว์</li>
					 	<li><?php echo form_radio('n_reasonbite','2','') ?>พยายามแยกสัตว์ที่กำลังต่อสู้กัน</li>
					 	<li><?php echo form_radio('n_reasonbite','3','') ?>เข้าใกล้สัตว์แม่ลูกอ่อน</li>
					 	<li><?php echo form_radio('n_reasonbite','4','') ?>รบกวนสัตว์ขณะกินอาหาร</li>
					 	<li><?php echo form_radio('n_reasonbite','5',' ') ?>อื่นๆ ระบุ <input type="text" 

name="other_reasonbite"class="input_box_patient"></li>					 	
					 </ul>
				</td>
			</tr>
			<tr>
				<th>6.</th>
				<td colspan="3"><span class="topic radio">ประวัติการรับวัคซีนของสัตว์นำโรค</span>
					<input name="historyvacine" type="radio" value="1" onclick="show8(this.value);">ไม่ทราบ
					<input name="historyvacine" type="radio" value="2" onclick="show8(this.value);">ไม่ได้รับ
					<input name="historyvacine" type="radio" value="3" onclick="show8(this.value);">ได้รับ 
					<span id="subimmunization_history"style = "display:none"><input type="text" class="input_box_patient auto" 

name="n_historyvacine" size="2"> ครั้ง 
					ครั้งสุดท้าย 	<?php echo form_radio('no1_historyvacine','ภายใน 1 ปี','') ?>ภายใน 1 ปี<?php echo form_radio

('no1_historyvacine','เกิน 1 ปี ','') ?>เกิน 1 ปี <?php echo form_radio('no1_historyvacine','1','จำไม่ได้') ?>จำไม่ได้</span> 
				</td>
				
			</tr>
			<tr>
				<th>7.</th>
				<td colspan="3"><span class="topic radio">การส่งหัวตรวจ</span>
						<input name="headanimal" type="radio" value="1" onclick="show9(this.value);">ไม่ได้ส่งตรวจเนื่องจาก
						<input name="headanimal" type="radio" value="2" onclick="show9(this.value);">ส่งตรวจเนื่อง <span 

id="subspecimen" style = "display:none">สถานที่ 					  		
						<?php 
					  			$class=' id="headanimalplace" class="input_box_patient " 

onChange="show_hide_clear_otherheadanimalplace(this);"';
					  		 	echo form_dropdown('headanimalplace',get_option

('id','name','n_animalplaces'),@$rs['headanimalplace'],$class,'-โปรดเลือก-'); ?>
						<ul class="sub">
							<li>ผลการตรวจ <?php echo form_radio('resultanimal','พบเชื้อ','') ?>พบเชื้อ
												<?php echo form_radio('resultanimal','

ไม่พบเชื้อ','') ?>ไม่พบเชื้อ</li></ul></span>
				</td>
			</tr>

		</table>
	</div><!-- section 7-->	
	<h3><a href="javascript:void(0)">ส่วนที่ 8 ผู้สัมผัสโรครายอื่น</a></h3>
	<div id="section8">
		<table class="tbdead8">			
		<tr>
				<th rowspan="2">1.</th>				
		</tr>
				<tr>
					<td>ผู้สัมผัสโรค<span style="text-decoration: underline"><strong>จากสัตว์ตัวเดียวกัน</strong></span> จำนวน <input 

type="text"name="same_kind_human" class="input_box_patient">คน</td>
					<td style="padding-left:10px;">สัตว์ตัวอื่นที่สัมผัสโรค<span style="text-decoration: underline"><strong>จากสัตว์ตัวเดียว

กัน</strong></span> 
					จำนวน<input type="text" class="input_box_patient" name="same_kind_animal">ตัว</td>
				</tr>
			</tr>
		<tr>
				<th rowspan="2">2.</th>				
		</tr>
				<tr>
					<td>ผู้สัมผัสโรค<span style="text-decoration: underline"><strong>จากผู้ป่วยรายนี้</strong></span> 	<span 

style="padding-left:24px;">จำนวน</span> <input type="text"name="same_kind_patient" class="input_box_patient">คน</td>
					
				</tr>
			</tr>			
		</table>

	</div><!-- section 8 -->
	
</div><!-- cordion -->
		<table class="tbform" style="width:70%;margin-left: 15%;margin-right: 15%">
			<tr>
				<th>ชื่อ-สกุลผู้รายงาน</th><td><input type="text" class="input_box_patient" name="reportname"></td>
				<th>ตำแหน่ง</th><td><input type="text" class="input_box_patient" name="positionname"></td>
		   </tr>
		   <tr>
				<th>สถานที่ปฏิบัติงาน</th><td><input type="text" class="input_box_patient" name="reportlocation"></td>
				<th>วันบันทึกรายงาน</th>
				<td>
					<?
						$Ydate=date('Y')+543;
						$datedeflaut=date("-m-d");
						$reportdate=cld_my2date($Ydate.$datedeflaut);
					?>
			        <input name="reportdate" type="text" size="10" class="input_box_patient " readonly="readonly" value="<?php echo (@$rs

['reportdate'])? cld_my2date(@$rs['reportdate']):$reportdate;?>"> 

				    </td>
			</tr>
			<tr><td colspan="3" style="border:none;"><small><strong>หมายเหตุ :</strong>ระยะฟักตัวของโรค (Incubation period) ที่เชื่อถือได้สั้นที่สุด 7 วัน ยาวนานที่สุด 3 ปี (โดยเฉลี่ย 30-90 วัน)</small></td></tr>
		</table>


 <div class="btn_inline">
      <ul>
      	<li><button class="btn_save" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="reset">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div> 
</form>
	


<? if(!empty($rs['head_bite_blood'])){ echo "<script language='javascript'>show_mark(document.getElementById('head_bite_blood').checked,document.getElementById

('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById

('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById

('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(!empty($rs['head_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById

('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById

('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(!empty($rs['head_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById

('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById

('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(!empty($rs['head_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById

('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById

('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(!empty($rs['head_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById

('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById

('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(!empty($rs['head_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById

('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById

('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(!empty($rs['face_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById

('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById

('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById

('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(!empty($rs['face_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById

('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById

('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(!empty($rs['face_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById

('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById

('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(!empty($rs['face_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById

('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById

('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(!empty($rs['face_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById

('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById

('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById

('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(!empty($rs['face_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById

('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById

('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(!empty($rs['neck_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById

('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById

('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(!empty($rs['neck_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById

('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById

('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(!empty($rs['neck_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById

('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById

('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(!empty($rs['neck_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById

('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById

('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(!empty($rs['neck_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById

('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById

('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(!empty($rs['neck_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById

('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById

('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(!empty($rs['hand_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById

('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById

('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(!empty($rs['hand_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById

('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById

('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(!empty($rs['hand_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById

('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById

('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(!empty($rs['hand_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById

('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById

('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(!empty($rs['hand_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById

('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById

('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(!empty($rs['hand_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById

('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById

('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(!empty($rs['arm_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById

('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById

('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById

('markarm'));</script>";}?>
<? if(!empty($rs['arm_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById

('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById

('markarm'));</script>";}?>
<? if(!empty($rs['arm_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById

('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById

('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById

('markarm'));</script>";}?>
<? if(!empty($rs['arm_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById

('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById

('markarm'));</script>";}?>
<? if(!empty($rs['arm_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById

('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById

('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById

('markarm'));</script>";}?>
<? if(!empty($rs['arm_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById

('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById

('markarm'));</script>";}?>
<? if(!empty($rs['body_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById

('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById

('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(!empty($rs['body_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById

('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById

('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(!empty($rs['body_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById

('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById

('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(!empty($rs['body_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById

('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById

('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(!empty($rs['body_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById

('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById

('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(!empty($rs['body_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById

('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById

('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(!empty($rs['leg_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById

('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById

('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(!empty($rs['leg_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById

('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById

('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(!empty($rs['leg_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById

('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById

('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(!empty($rs['leg_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById

('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById

('markleg'));</script>";}?>
<? if(!empty($rs['leg_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById

('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById

('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(!empty($rs['leg_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById

('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById

('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(!empty($rs['feet_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById

('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById

('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById

('markfeet'));</script>";}?>
<? if(!empty($rs['feet_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById

('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById

('markfeet'));</script>";}?>
<? if(!empty($rs['feet_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById

('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById

('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById

('markfeet'));</script>";}?>
<? if(!empty($rs['feet_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById

('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById

('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById

('markfeet'));</script>";}?>
<? if(!empty($rs['feet_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById

('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById

('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById

('markfeet'));</script>";}?>
<? if(!empty($rs['feet_lick_noblood'])){echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById

('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById

('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById

('markfeet'));</script>";}?>
