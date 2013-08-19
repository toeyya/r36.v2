<script type="text/javascript">
$(document).ready(function(){
	 $('#multiAccordion').multiAccordion({
            heightStyle: "content",
        	 active: 'none' 
        });
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
	$("#prtovinceidplace").change(function(){
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
	
	
	$('select[name=hospital_district_id]').live('change',function(){
		district_id =$('select[name=hospital_district_id] option:selected').val();
		$('#input_hospital').html('<img src="media/images/loader.gif" width="16px" height="11px"/>');	
		$.ajax({
			url:'<?php echo base_url()?>hospital/getHospital',
			data:'name=hospitalcode&ref1='+province_id+'&ref2='+amphur_id+'&ref3='+district_id,
			success:function(data){
					$('#input_hospital').html(data);
			}
		});
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
			 }			
		},
		messages:{
			firstname:"ระบุชื่อ",
			surname:"ระบุนามสกุล",
			provinceid:"ระบุจังหวัด",
			amphurid:"ระบุอำเภอ",
			districtid:"ระบุตำบล",
			//provinceidplace:"ระบุจังหวัด",
			amphuridplace:"ระบุอำเภอ",
			//districtidplace:"ระบุตำบล",
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
function show(id) {
if(id == 'ไม่ได้ล้าง') { // ถ้าเลือก radio button 1 ให้โชว์ table 1 และ ซ่อน table 2
$('#notwash').show();
$('#n_afterwash').hide();
} else if(id == 'ล้างหลังจากถูกกัดแล้ว') { // ถ้าเลือก radio button 2 ให้โชว์ table 2 และ ซ่อน table 1
$('#notwash').hide();
$('#n_afterwash').show();
}
else if(id == 'ล้างทันทีที่ถูกกัด'){
$('#notwash').hide();
$('#n_afterwash').hide();
}
}
function show2(id) {
if(id == 'อื่นๆ'){
	$('#otherwashing').show();}
 else if(id == 'สบู่/ผงซักฟอก'){
 	$('#otherwashing').hide();}
 else if(id == 'ล้างด้วยน้ำเปล่า'){
 	$('#otherwashing').hide();}
}

function show3(id) {
if(id == 'ใช้'){
	$('#n_drugs').show();}
else if(id == 'ไม่ได้ใช้'){
	$('#n_drugs').hide();}
}
function show4(id) {
if(id == 'ฉีด'){
	$('#sub').show();}
else if(id == 'ไม่ได้ฉีด'){
	$('#sub').hide();}
}
function show5(id) {
if(id == 'ฉีด'){
	$('#h_sub').show();}
else if(id == 'ไม่ทราบ'){
	$('#h_sub').hide();}
	else if(id == 'ไม่ได้ฉีด'){
	$('#h_sub').hide();}
}

function show6(id) {
if(id == 'ได้กักขัง/ติดตามพบ'){
	$('#subimprison').show();}
else if(id == 'ไม่ทราบ'){
	$('#subimprison').hide();}
	else if(id == 'ถูกฆ่า/รถทับตาย'){
	$('#subimprison').hide();}
	else if(id == 'สัตว์หนีหายไปติดตามไม่ได้'){
	$('#subimprison').hide();}
	else if(id == 'ไม่ได้กักขัง'){
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
if(id == 'ส่งเนื้องอกสมองไปตรวจ'){
	$('#brain_tumor_lo').show();
	$('#brain_tumor_po_ne').show();
	$('#brain_tumor').show();}
else if(id == 'ไม่ได้ส่งเนื้องอกสมองไปตรวจ'){
	$('#brain_tumor').hide();
	$('#brain_tumor_lo').hide();
	$('#brain_tumor_po_ne').hide();}
	}
	function show11(id) {
if(id == 'ส่งน้ำลายปวดศีรษะไปตรวจ'){
	$('#saliva_headache_lo').show();
	$('#saliva_headache_po_ne').show();
	$('#saliva_headache').show();}
else if(id == 'ไม่ได้ส่งน้ำลายปวดศีรษะไปตรวจ'){
	$('#saliva_headache').hide();
	$('#saliva_headache_lo').hide();
	$('#saliva_headache_po_ne').hide();}
	}
	function show12(id) {
if(id == 'ส่งน้ำไขสันหลังไปตรวจ'){
	$('#csf_lo').show();
	$('#csf_po_ne').show();
	$('#csf').show();}
else if(id == 'ไม่ได้ส่งน้ำไขสันหลังไปตรวจ'){
	$('#csf_lo').hide();
	$('#csf_po_ne').hide();
	$('#csf').hide();}
	}
	function show13(id) {
if(id == 'ส่งปัสสาวะไปตรวจ'){
	$('#piss_lo').show();
	$('#piss_po_ne').show();
	$('#piss').show();}
else if(id == 'ไม่ได้ส่งปัสสาวะไปตรวจ'){
	$('#piss_lo').hide();
	$('#piss_po_ne').hide();
	$('#piss').hide();}
	}
	function show14(id) {
if(id == 'ส่งปมรากผลไปตรวจ'){
	$('#root_lo').show();
	$('#root_po_ne').show();
	$('#root').show();}
else if(id == 'ไม่ได้ส่งปมรากผลไปตรวจ'){
	$('#root_lo').hide();
	$('#root_po_ne').hide();
	$('#root').hide();}
	}
	function show15(id) {
if(id == 'ส่งผิวหนังท้ายทอยไปตรวจ'){
	$('#occipital_skin_lo').show();
	$('#occipital_skin_po_ne').show();
	$('#occipital_skin').show();}
else if(id == 'ไม่ได้ส่งผิวหนังท้ายทอยไปตรวจ'){
	$('#occipital_skin_lo').hide();
	$('#occipital_skin_po_ne').hide();
	$('#occipital_skin').hide();}
	}
	function show16(id) {
if(id == 'ส่งเซลล์กระจกตาไปตรวจ'){
	$('#corneal_cells_lo').show();
	$('#corneal_cells_po_ne').show();
	$('#corneal_cells').show();}
else if(id == 'ไม่ได้ส่งเซลล์กระจกตาไปตรวจ'){
	$('#corneal_cells_lo').hide();
	$('#corneal_cells_po_ne').hide();
	$('#corneal_cells').hide();}
	}

</script>
<? error_reporting(E_ALL ^ E_NOTICE); ?>
<div id="title">แบบฟอร์มผู้เสียชีวิตด้วยโรคพิษสุนัขบ้า</div>
<form id="form1" name="form1" method="post"  action="inform/dead/save" > 
	<?php error_reporting(E_ERROR); 
			@$rs['exp_userig'] =($rs['exp_userig'] =='0000-00-00')?'': cld_my2date(@$rs['exp_userig']);
			@$rs['exp_vaccine']	=(@$rs['exp_vaccine']=='0000-00-00')?'':cld_my2date(@$rs['exp_vaccine']);
			@$rs['datetouch'] = (@$rs['datetouch'] =='0000-00-00')? '':cld_my2date(@$rs['datetouch']);	
			@$rs['brain_tumordate']=($rs['brain_tumordate']=='0000-00-00')?'': cld_my2date($rs['brain_tumordate']);
			@$rs['csfdate'] =($rs['csfdate'] =='0000-00-00')?'': cld_my2date(@$rs['csfdate']);
			@$rs['pissdate']	=(@$rs['pissdate']=='0000-00-00')?'':cld_my2date(@$rs['pissdate']);
			@$rs['rootdate'] = (@$rs['rootdate'] =='0000-00-00')? '':cld_my2date(@$rs['rootdate']);	
			@$rs['occipital_skindate']=($rs['occipital_skindate']=='0000-00-00')?'': cld_my2date($rs['occipital_skindate']);
			@$rs['corneal_cellsdate'] =($rs['corneal_cellsdate'] =='0000-00-00')?'': cld_my2date(@$rs['corneal_cellsdate']);
			@$rs['hr_date']	=(@$rs['hr_date']=='0000-00-00')?'':cld_my2date(@$rs['hr_date']);
			@$rs['treatdate'] = (@$rs['treatdate'] =='0000-00-00')? '':cld_my2date(@$rs['treatdate']);	
			@$rs['endate']=($rs['endate']=='0000-00-00')?'': cld_my2date($rs['endate']);
			@$rs['vaccine_date'] =($rs['vaccine_date'] =='0000-00-00')?'': cld_my2date(@$rs['vaccine_date']);
			@$rs['startdate']	=(@$rs['startdate']=='0000-00-00')?'':cld_my2date(@$rs['startdate']);
			@$rs['reportdate'] = (@$rs['reportdate'] =='0000-00-00')? '':cld_my2date(@$rs['reportdate']);	
			
			//$datetoday=date('Y')+543;
			//$datetoday=$datetoday.'-'.date('m-d H:i:s');
			$datetoday=date('Y-m-d H:i:s');
			echo (!empty($rs['id'])) ? form_hidden('updatetime',$datetoday) : form_hidden('created',$datetoday);
						
	?>
<div id="multiAccordion">
	<h3><a href="javascript:void(0)">ส่วนที่ 1 ข้อมูลทั่วไป</a></h3>
	<div id="section1">
		<table class="tbdead">
		<tr>
				<th rowspan="3">1.</th>
				<td>	<span class="topic">คำนำหน้า</span> <select name="prefix_name" class="styled-select " disabled="disabled" >
							 	<option value="">- โปรดเลือก -</option>
								<option value="นาย" <?php  echo (@$rs['prefix_name']=='นาย')? "selected='selected'":"" ?> disabled="disabled">นาย</option>
								<option value="นาง" <?php  echo (@$rs['prefix_name']=='นาง')? "selected='selected'":"" ?> disabled="disabled">นาง</option>
								<option value="นางสาว" <?php  echo (@$rs['prefix_name']=='นางสาว')? "selected='selected'":"" ?> disabled="disabled">นางสาว</option>
								<option value="ด.ช." <?php  echo (@$rs['prefix_name']=='ด.ช.')? "selected='selected'":"" ?> disabled="disabled">ด.ช.</option>
								<option value="ด.ญ." <?php  echo (@$rs['prefix_name']=='ด.ญ.')? "selected='selected'":"" ?>disabled="disabled">ด.ญ.</option>							
							 </select></td>
				<td><span class="topic radio">เพศ </span>
						<input name="gender" type="radio"  value="1" <? if(@$rs['gender']=='1'){ echo "checked";}?> disabled="disabled"> ชาย
						<input name="gender" type="radio" value="2" <? if(@$rs['gender']=='2'){ echo "checked";}?> disabled="disabled"> หญิง</td>			
			</tr>
			<tr>
				
					<td><span class="topic">ชื่อ<span class="alertred">*</span></span>
							<input name="firstname" type="text" class="input_box_patient" id="firstname" value="<?php echo $rs['firstname'];?>" size="20" disabled="disabled"/>
					</td>
					<td><span class="topic">นามสกุล <span class="alertred">*</span></span>
							  <input name="surname" type="text" value="<?php echo $rs['surname'];?>" size="20"  class="input_box_patient "disabled="disabled">
					</td>	
					<td><span class="topic">บัตรประชาชน</span>
						<span id="Show_idcard"> 
						<input name="cardW0" id="cardW0" type="text" class="input_box_patient nowidth" size="1" maxlength="1" value="<?php echo @$cardW0?>"disabled="disabled" />
						  -
						  <input name="cardW1"  id="cardW1" type="text" class="input_box_patient nowidth" size="4" maxlength="4"  value="<?php echo @$cardW1?>" disabled="disabled"/>
						  -
						  <input name="cardW2"  id="cardW2" type="text" class="input_box_patient nowidth" size="5" maxlength="5"   value="<?php echo @$cardW2?>"disabled="disabled"/>
						  -
						  <input name="cardW3" id="cardW3" type="text" class="input_box_patient nowidth" size="2" maxlength="2"  value="<?php echo @$cardW3?>" disabled="disabled"/>
						  -
						<input name="cardW4" id="cardW4" type="text" class="input_box_patient nowidth" size="1" maxlength="1"  value="<?php echo @$cardW4?>"  disabled="disabled"/>				
				
					</td>					
			</tr>
			<tr>				
				<td><span class="topic">อายุ<span class="alertred">*</span></span>
                            <input name="age" id="age"  type="text" size="2" maxlength="2" value="<?php echo @$rs['age'];?>" class="input_box_patient auto"  onKeyUp="chk_than15(this.value);" disabled="disabled"></td>
				<td><span class="topic">ผู้ปกครอง</span> <input name="parentname" type="text" class="input_box_patient " id="parentname" value="<?php echo $rs['parentname'];?>" size="50" style="width:300px;" disabled="disabled"/>
		    	<td colspan="3"><small>(กรณีผู้ป่วยอายุต่ำกว่า 15 ปี กรุณากรอกชื่อ-นามสกุล ผู้ปกครอง)</small></td>							    			
			</tr>
			<tr>
				<th>2. </th>
				<td><span class="topic radio">เชื้อชาติ</span>
											<input name="nationality" type="radio" value="1" <? if(@$rs['nationalityname']=='1'){ echo "checked";}?> onClick="show_hide_nationality(document.form1);" disabled="disabled"> ไทย&nbsp;&nbsp;
						<input name="nationality" type="radio" value="2" <? if(@$rs['nationalityname']=='2'){ echo "checked";}?> onClick="show_hide_nationality(document.form1);" disabled="disabled"> อื่นๆ 
						<span id="nationality_tr1" <? if(@$rs['nationalityname']!='2'){ print 'style = "display:none"';}?>>
						สัญชาติ :&nbsp; 
							<select name="nationalityname"  class="styled-select " onChange="show_hide_clear_nationality_text(this)" disabled="disabled">
								<option value="0" <? if(@$rs['nationalityname']=='0'){echo "selected";}?> disabled="disabled">เลือกสัญชาติ</option>
								<option value="2" <? if(@$rs['nationalityname']=='2'){echo "selected";}?>disabled="disabled">จีน/ฮ่องกง/ใต้หวัน</option>
								<option value="3" <? if(@$rs['nationalityname']=='3'){echo "selected";}?>disabled="disabled">พม่า</option>
								<option value="4" <? if(@$rs['nationalityname']=='4'){echo "selected";}?>disabled="disabled">มาเลเซีย</option>
								<option value="5" <? if(@$rs['nationalityname']=='5'){echo "selected";}?>disabled="disabled">กัมพูชา</option>
								<option value="6" <? if(@$rs['nationalityname']=='6'){echo "selected";}?>disabled="disabled">ลาว</option>
								<option value="7" <? if(@$rs['nationalityname']=='7'){echo "selected";}?>disabled="disabled">เวียดนาม</option>
								<option value="8" <? if(@$rs['nationalityname']=='8'){echo "selected";}?>disabled="disabled">ยุโรป</option>
								<option value="9" <? if(@$rs['nationalityname']=='9'){echo "selected";}?>disabled="disabled">อเมริกา</option>
								<option value="10" <? if(@$rs['nationalityname']=='10'){echo "selected";}?>disabled="disabled">ไม่ทราบสัญชาติ</option>
								<option value="11" <? if(@$rs['nationalityname']=='11'){echo "selected";}?>disabled="disabled">อื่นๆ</option>
                          </select>&nbsp;
							<span id="nationality_div" <? if(@$rs['nationalityname']!='11'){ print 'style = "display:none"';}?>>
								  <span class="alertred">(โปรดระบุ)</span>&nbsp;
								  <input name="othernationalityname" id="othernationalityname" type="text" value="<?php echo @$rs['othernationalityname'];?>" class="input_box_patient " size="20" disabled="disabled">
						  </span>
						</span>
				</td>
				<td><span class="topic radio">ศาสนา</span>
					<input type="radio" value="1" name="religion" disabled="disabled">พุทธ
					<input type="radio" value="2" name="religion"disabled="disabled">คริสต์
					<input type="radio" value="3" name="religion"disabled="disabled">อิสลาม
					<input type="radio" value="4" name="religion"disabled="disabled">อื่นๆ
				</td>
				<td><span class="topic">อาชีพ</span>
							<?php echo form_dropdown('occupationname',get_option('id','name','n_occupations'),@$rs['occupationname'],'class="styled-select " onChange="return show_hide_clear_otheroccupationname(this);" id="occupation_than15;" disabled="disabled"','- กรุณาเลือกอาชีพ-'); ?>
							<?php 
							$class='class="styled-select" onChange="return show_hide_clear_otheroccupationname(this);" id="occupation_less15" disabled="disabled"';
							echo form_dropdown('occupationname_b',get_option('id','name','n_occupations where id in(1,2,3)'),@$rs['occupationname'],$class,'- กรุณาเลือกอาชีพ-','disabled="disabled"'); ?>
						<? if(@$rs['age']>15){ 
										echo	"<script>document.getElementById ('occupation_less15').style.display='none'</script>";
								}else{ 
										echo	"<script>document.getElementById ('occupation_than15').style.display='none'</script>";
								}
						?>
							<span  id="otheroccupationname_tr" <? if(@$rs['occupationname']!='20'){ print 'style = "display:none"'; }?>>
							<span class="alertred">(โปรดระบุ)&nbsp;
						<input name="otheroccupationname" id="otheroccupationname"  type="text" class="input_box_patient " size="10" value="<?php echo @$rs['otheroccupationname'];?>" disabled="disabled" /></span>
						</span>
				</td>
			</tr>	
			
		<tr>
			<th rowspan="4">3.</th>
			<td><span class="topic radio">สถานที่สัมผัสโรค</span></td>
		</tr>
		<tr>
			<td><span class="topic">เลขที่</span><input type="text"  class="input_box_patient "name="nohome" value="<?php echo $rs['nohome'] ?>" disabled="disabled"></td>
			<td><span class="topic">หมู่ที่</span><input type="text" class="input_box_patient " name="moo" value="<?php echo $rs['moo'] ?>" disabled="disabled"></td>
			<td> <span class="topic">หมู่บ้าน</span><input type="text"  class="input_box_patient "name="villege" value="<?php echo $rs['villege'] ?>" disabled="disabled"></td>
		</tr>
		<tr>
			<td>	<span class="topic">ชุมชน</span><input type="text"  class="input_box_patient "name="community" value="<?php echo $rs['community'] ?>" disabled="disabled"></td>
			<td><span class="topic">ซอย</span><input name="soi" type="text" class="input_box_patient " size="20" value="<?php echo $rs['soi'];?>"  disabled="disabled"/></td>
            <td><span class="topic">ถนน</span><input name="road" type="text" class="input_box_patient " id="road" value="<?php echo $rs['road'];?>" size="20"  disabled="disabled"/></td>			
		</tr>
			<tr>
               <td><span class="topic">จังหวัด<span class="alertred">*</span></span>	
                	<?php $class='class="input_box_patient " id="provinceid" disabled="disabled"';
                		echo form_dropdown('provinceid',get_option('province_id','province_name','n_province ORDER BY province_name ASC'),@$rs['provinceid'],$class,'-โปรดเลือก-');?>
				</td>
                 <td><span class="topic">อำเภอ/เขต<span class="alertred">*</span></span>
						<span id="Input_amphur">						
							<?								
							if($rs['provinceid']!=''){
									if($rs['amphurid']!=''){
										$whamp="AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
									}else{
										$whamp="AND province_id='".$rs['provinceid']."'";
									}																				 
								echo form_dropdown('amphurid',get_option('amphur_id','amphur_name',"n_amphur WHERE amphur_id!=''".$whamp."  ORDER BY amphur_name ASC"),@$rs['amphurid'],'class="input_box_patient " id="amphurid" disabled="disabled"','-โปรดเลือก-');
							}else{									
							?><select name="amphurid" id="amphurid" class="input_box_patient " disabled="disabled"><option value="">-โปรดเลือก-</option></select>
						<?php } ?>
						</span></td>						
                  <td><span class="topic">ตำบล/แขวง <span class="alertred">*</span></span>
						<span id="Input_district">
							<?
							if($rs['amphurid']!=''){
									if($rs['districtid']!=''){
										$whdis="AND district_id ='".$rs['districtid']."' AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
									}else{
										$whdis="AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";}																		
										echo  form_dropdown('district_id',get_option('district_id','district_name'," n_district WHERE district_id!='' ". $whdis." ORDER BY district_name ASC"),@$rs['districtid'],'class="input_box_patient " id="districtid" disabled="disabled"','-โปรดเลือก-');
								}else{
							?> <select name="districtid" id="districtid" class="input_box_patient" disabled="disabled"><option value="" disabled="disabled">-โปรดเลือก-</option> </select>
						<?php } ?></span>
				</td>	
				<td>สถานพยาบาล <span id="input_hospital">											
								<? //$this->db->debug=TRUE;
								$whhospital="";
								 if(@$_GET['amphur_id']){
										$whhospital="AND hospital_amphur_id ='".@$_GET['amphur_id']."' AND hospital_district_id ='".@$_GET['district_id']."' ";
										echo form_dropdown('hospital',get_option('hospital_code','hospital_name',"n_hospital where hospital_id<>'' $whhospital ORDER BY hospital_name ASC"),@$_GET['hospital'],'class="styled-select " disabled="disabled"','-โปรดเลือก-');
								 }else{								 										 
							 ?>
					 		 <select name="hospital" id="hospital" class="styled-select " disabled="disabled">
					 		 	<option value="">-โปรดเลือก-</option>
					 		 </select>
					 <?php } ?>
					</span> </td>
				
				
		</tr>
		<tr>
			<th>5.</th>
			<?php $area=array(1=>'เขตกทม.',2=>'เขตเมืองพัทยา',3=>'เขตเทศบาล',4=>'เขต อบต.'); ?>
			<td><span class="topic">พื้นที่</span><?php echo form_dropdown('area_id',$area,$rs['area_id'],'class="input_box_patient" disabled="disabled"','-โปรดเลือก-') ?></td>
		</tr>
		</table>
	</div><!--section1 -->
	<h3><a href="javascript:void(0)">ส่วนที่ 2 อาการและอาการแสดง</a></h3>
	<div id="section2">
		<table class="tbdead">
			<tr>
				<th>1. </th>
				<td><span class="topic">วันเริ่มอาการ</span><input type="text" name="startdate" class="input_box_patient datepicker  auto" size="10" disabled="disabled" value="<?php echo $rs['startdate'] ?>"></td>
				<td><span class="topic">วันที่รักษา</span><input type="text" name="treatdate" class="input_box_patient datepicker  auto" size="10" disabled="disabled" value="<?php echo $rs['treatdate'] ?>"></td>
				<td><span class="topic">สถานที่รักษา</span><input type="text" name="hospital" class="input_box_patient" disabled="disabled" value="<?php echo $rs['hospital'] ?>"></td>
				
			</tr>
			<tr>
				<th>2. </th>
				<td><span class="topic">วันที่เสียชีวิต</span>
					 <input type="text" name="endate" class="input_box_patient datepicker  auto" size="10" disabled="disabled" value="<?php echo $rs['hospital'] ?>">					
				</td>
			<tr>
				<th>3.</th>
				<td colspan="3"><span class="topic" style="width:140px;">อาการและอาการแสดง</span>
					<hr class="hr1">
					<ul>
						<li class="topic">ไข้</li><li><?php echo form_radio('sick','มีไข้','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('sick','ไม่มีไข้','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('sick','ไม่ทราบว่ามีไข้','','disabled="disabled"') ?>ไม่ทราบ</li>
						<li class="topic">ปวดศีรษะ</li><li><?php echo form_radio('headache','ปวดศีรษะ','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('headache','ไม่ปวดศีรษะ','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('headache','ไม่ทราบว่าปวดศีรษะ','','disabled="disabled"') ?>ไม่ทราบ</li>
						<li class="topic">ตื่นเต้นกระวนกระวายต่อสิ่งเร้า /แสง /เสียง</li><li><?php echo form_radio('excited_stimuli','ไม่ตื่นเต้นกระวนกระวายต่อสิ่งเร้า /แสง /เสียง','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('excited_stimuli','ไม่ทราบว่ามีอาการตื่นเต้นกระวนกระวายต่อสิ่งเร้า /แสง /เสียง','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('excited_stimuli','ตื่นเต้นกระวนกระวายต่อสิ่งเร้า /แสง /เสียง','','disabled="disabled"') ?>ไม่ทราบ</li>
						<li class="topic">อาละวาดผุดลุกผุดนั่ง</li><li><?php echo form_radio('rampant','อาละวาดผุดลุกผุดนั่ง','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('rampant','ไม่อาละวาดผุดลุกผุดนั่ง','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('rampant','ไม่ทราบว่ามีอาการอาละวาดผุดลุกผุดนั่ง','','disabled="disabled"') ?>ไม่ทราบ</li>
						<li class="topic">กลืนลำบาก</li><li><?php echo form_radio('dysphagia','กลืนลำบาก','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('dysphagia','ไม่กลืนลำบาก','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('dysphagia','ไม่ทราบว่ามีอาการกลืนลำบาก','','disabled="disabled"') ?>ไม่ทราบ</li>
						<li class="topic">ซึม ไม่รู้สึกตัว</li><li><?php echo form_radio('depress','ซึม ไม่รู้สึกตัว','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('depress','ไม่ซึม ไม่รู้สึกตัว','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('depress','ไม่ทราบว่ามีอาการซึม ไม่รู้สึกตัว','','disabled="disabled"') ?>ไม่ทราบ</li>
						<li class="topic">ถ่มน้ำลายตลอดเวลา</li><li><?php echo form_radio('spit_the_time','ถ่มน้ำลายตลอดเวลา','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('spit_the_time','ไม่ถ่มน้ำลายตลอดเวลา','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('spit_the_time','ไม่ทราบว่ามีอาการถ่มน้ำลายตลอดเวลา','','disabled="disabled"') ?>ไม่ทราบ</li>
						<li class="topic">ถอนหายใจเป็นพักๆ</li><li><?php echo form_radio('sigh_frequently','ถอนหายใจเป็นพักๆ','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('sigh_frequently','ไม่ถอนหายใจเป็นพักๆ','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('sigh_frequently','ไม่ทราบว่ามีอาการถอนหายใจเป็นพักๆ','','disabled="disabled"') ?>ไม่ทราบ</li>
						<li class="topic">กลัวลม</li><li><?php echo form_radio('fear_wind','กลัวลม','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('fear_wind','ไม่กลัวลม','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('fear_wind','ไม่ทราบว่ามีอาการกลัวลม','','disabled="disabled"') ?>ไม่ทราบ</li>
						<li class="topic">ขนลุกบางส่วนหรือทั้งตัว</li><li><?php echo form_radio('all_the_burmps','ขนลุกบางส่วนหรือทั้งตัว','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('all_the_burmps','ไม่ขนลุกบางส่วนหรือทั้งตัว','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('all_the_burmps','ไม่ทราบว่ามีอาการขนลุกบางส่วนหรือทั้งตัว','','disabled="disabled"') ?>ไม่ทราบ</li>
						<li class="topic">กลัวน้ำ</li><li><?php echo form_radio('fear_water','กลัวน้ำ','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('fear_water','ไม่กลัวน้ำ','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('fear_water','ไม่ทราบว่ามีอาการกลัวน้ำ','','disabled="disabled"') ?>ไม่ทราบ</li>
						<li class="topic">สูญเสียความทรงจำชั่วคราว</li><li><?php echo form_radio('loss_of_memory','สูญเสียความทรงจำชั่วคราว','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('loss_of_memory','ไม่สูญเสียความทรงจำชั่วคราว','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('loss_of_memory','ไม่ทราบว่ามีอาการสูญเสียความทรงจำชั่วคราว','','disabled="disabled"') ?>ไม่ทราบ</li>
						<li class="topic">รูม่านตาไม่ตอบสนองต่อแสง</li><li><?php echo form_radio('respond_light','รูม่านตาไม่ตอบสนองต่อแสง','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('respond_light','รูม่านตาไม่ตอบสนองต่อแสง','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('respond_light','ไม่ทราบว่ามีอาการรูม่านตาไม่ตอบสนองต่อแสง','','disabled="disabled"') ?>ไม่ทราบ</li>
						<li class="topic">แขนขาอ่อนแรง</li><li><?php echo form_radio('arm_leg_feeble','แขนขาอ่อนแรง','','disabled="disabled"') ?>มี</li><li><?php echo form_radio('arm_leg_feeble','แขนขาไม่อ่อนแรง','','disabled="disabled"') ?>ไม่มี</li><li><?php echo form_radio('arm_leg_feeble','ไม่ทราบว่ามีอาการแขนขาอ่อนแรง','','disabled="disabled"') ?>ไม่ทราบ</li>
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
					
					<td><input name="brain_tumor" type="radio" value="ไม่ได้ส่งเนื้องอกสมองไปตรวจ" onclick="show12(this.value);" <? if(@$rs['brain_tumor']=='ส่งเนื้องอกสมองไปตรวจ'){ print "checked";}?>disabled="disabled">ไม่ได้ส่ง 
					<input name="brain_tumor" type="radio" value="ส่งเนื้องอกสมองไปตรวจ"<? if(@$rs['brain_tumor']=='ส่งน้ำไขสันหลังไปตรวจ'){ print "checked";}?> onclick="show12(this.value);" disabled="disabled">ส่ง</td>	
				<td><span id="brain_tumor" <? if(@$rs['brain_tumor']!='ส่งเนื้องอกสมองไปตรวจ'){print 'style = "display:none"';  }?>>วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" name="brain_tumordate" size="10" disabled="disabled" value="<?php echo $rs['brain_tumordate'] ?>"></span></td>	
				<td><span id="brain_tumor_lo"<? if(@$rs['brain_tumor']!='ส่งเนื้องอกสมองไปตรวจ'){print 'style = "display:none"';  }?>>สถานที่ส่งตรวจ <input type="text" class="input_box_patient" name="brain_tumor_lo" disabled="disabled" value="<?php echo $rs['brain_tumor_lo'] ?>"></span></td>
				<td><span id="brain_tumor_po_ne"<? if(@$rs['brain_tumor']!='ส่งเนื้องอกสมองไปตรวจ'){print 'style = "display:none"';  }?>><?php echo form_radio('brain_tumor_po_ne','Positive','','disabled="disabled"') ?>Positive<?php echo form_radio('brain_tumor_po_ne','Negative','','disabled="disabled"') ?>Negative</span></td>
				</tr>
			<tr>
				<th>2.</th>
				<td>	<span class="topic radio">น้ำลายปวดศีรษะ</span>	
				<td><input name="saliva_headache" type="radio" value="ไม่ได้ส่งน้ำลายปวดศีรษะไปตรวจ" onclick="show11(this.value);"<? if(@$rs['saliva_headache']=='ไม่ได้ส่งน้ำลายปวดศีรษะไปตรวจ'){ print "checked";}?> disabled="disabled">ไม่ได้ส่ง <input name="saliva_headache" type="radio" value="ส่งน้ำลายปวดศีรษะไปตรวจ" onclick="show11(this.value);" <? if(@$rs['saliva_headache']=='ส่งน้ำลายปวดศีรษะไปตรวจ'){ print "checked";}?> disabled="disabled">ส่ง</td>	
				<td><span id="saliva_headache" <? if(@$rs['saliva_headache']!='ส่งน้ำลายปวดศีรษะไปตรวจ'){print 'style = "display:none"';  }?>>วันที่ส่งตรวจ <input type="text" name="saliva_headachedate" class="input_box_patient datepicker auto" value="<?php echo $rs['saliva_headachedate'] ?>" size="10" disabled="disabled"></span></td>	
				<td><span id="saliva_headache_lo" <? if(@$rs['saliva_headache']!='ส่งน้ำลายปวดศีรษะไปตรวจ'){print 'style = "display:none"';  }?>>สถานที่ส่งตรวจ <input type="text" class="input_box_patient" value="<?php echo $rs['saliva_headache_lo'] ?>"  name="saliva_headache_lo"disabled="disabled"></span></td>
				<td><span id="saliva_headache_po_ne" <? if(@$rs['saliva_headache']!='ส่งน้ำลายปวดศีรษะไปตรวจ'){print 'style = "display:none"';  }?>><?php echo form_radio('saliva_headache_po_ne','Positive','','disabled="disabled"') ?>Positive<?php echo form_radio('saliva_headache_po_ne','Negative','','disabled="disabled"') ?>Negative</span></td>
			</tr>
			<tr>
				<th>3.</th>
				<td>	<span class="topic radio">น้ำไขสันหลัง</span>	
				<td><input name="csf" type="radio" value="ไม่ได้ส่งน้ำไขสันหลังไปตรวจ" onclick="show12(this.value);" <? if(@$rs['csf']=='ไม่ได้ส่งน้ำไขสันหลังไปตรวจ'){ print "checked";}?>disabled="disabled">ไม่ได้ส่ง 
					<input name="csf" type="radio" value="ส่งน้ำไขสันหลังไปตรวจ"<? if(@$rs['csf']=='ส่งน้ำไขสันหลังไปตรวจ'){ print "checked";}?> onclick="show12(this.value);" disabled="disabled">ส่ง</td>	
				<td><span id="csf" <? if(@$rs['csf']!='ส่งน้ำไขสันหลังไปตรวจ'){print 'style = "display:none"';  }?>>วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" name="csfdate" size="10" disabled="disabled" value="<?php echo $rs['csfdate'] ?>"></span></td>	
				<td><span id="csf_lo"<? if(@$rs['csf']!='ส่งน้ำไขสันหลังไปตรวจ'){print 'style = "display:none"';  }?>>สถานที่ส่งตรวจ <input type="text" class="input_box_patient" name="csf_lo" disabled="disabled" value="<?php echo $rs['csf_lo'] ?>"></span></td>
				<td><span id="csf_po_ne"<? if(@$rs['csf']!='ส่งน้ำไขสันหลังไปตรวจ'){print 'style = "display:none"';  }?>><?php echo form_radio('csf_po_ne','Positive','','disabled="disabled"') ?>Positive<?php echo form_radio('csf_po_ne','Negative','','disabled="disabled"') ?>Negative</span></td>
				</tr>
			<tr>
				<th>4.</th>
				<td>	<span class="topic radio">ปัสสาวะ</span>	
				<td><input name="piss" type="radio" value="ไม่ได้ส่งปัสสาวะไปตรวจ" <? if(@$rs['piss']=='ไม่ได้ส่งปัสสาวะไปตรวจ'){ print "checked";}?>onclick="show13(this.value);" disabled="disabled">ไม่ได้ส่ง <input name="piss" type="radio" value="ส่งปัสสาวะไปตรวจ" <? if(@$rs['piss']=='ส่งปัสสาวะไปตรวจ'){ print "checked";}?> onclick="show13(this.value);" disabled="disabled">ส่ง</td>	
				<td><span id="piss" <? if(@$rs['piss']!='ส่งปัสสาวะไปตรวจ'){print 'style = "display:none"';  }?>>วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" name="pissdate" size="10"disabled="disabled" value="<?php echo $rs['pissdate'] ?>"></span></td>	
				<td><span id="piss_lo" <? if(@$rs['piss']!='ส่งปัสสาวะไปตรวจ'){print 'style = "display:none"';  }?>> สถานที่ส่งตรวจ <input type="text" class="input_box_patient" name="piss_lo"disabled="disabled" value="<?php echo $rs['piss_lo'] ?>"></span></td>
				<td><span id="piss_po_ne"<? if(@$rs['piss']!='ส่งปัสสาวะไปตรวจ'){print 'style = "display:none"';  }?>><?php echo form_radio('piss_po_ne','Positive','','disabled="disabled"') ?>Positive<?php echo form_radio('piss_po_ne','Negative','','disabled="disabled"') ?>Negative</span></td>
			</tr>
			<tr>
				<th>5.</th>
				<td>	<span class="topic radio">ปมรากผล</span>	
				<td><input name="root" type="radio" value="ไม่ได้ส่งปมรากผลไปตรวจ"<? if(@$rs['root']=='ไม่ได้ส่งปมรากผลไปตรวจ'){ print "checked";}?> onclick="show14(this.value);" disabled="disabled">ไม่ได้ส่ง <input name="root" type="radio" value="ส่งปมรากผลไปตรวจ"<? if(@$rs['root']=='ส่งปมรากผลไปตรวจ'){ print "checked";}?> onclick="show14(this.value);" disabled="disabled">ส่ง</td>	
				<td><span id="root" <? if(@$rs['root']!='ส่งปมรากผลไปตรวจ'){print 'style = "display:none"';  }?>>วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" name="rootdate" value="<?php echo $rs['rootdate'] ?>"size="10" disabled="disabled"></span></td>	
				<td><span id="root_lo" <? if(@$rs['root']!='ส่งปมรากผลไปตรวจ'){print 'style = "display:none"';  }?>>สถานที่ส่งตรวจ <input type="text" class="input_box_patient" name="root_lo" disabled="disabled" value="<?php echo $rs['root_lo'] ?>"></td></span>
				<td><span id="root_po_ne" <? if(@$rs['root']!='ส่งปมรากผลไปตรวจ'){print 'style = "display:none"';  }?>><?php echo form_radio('root_po_ne','Positive','','disabled="disabled"') ?>Positive<?php echo form_radio('root_po_ne','Negative','','disabled="disabled"') ?>Negative</span></td>
			</tr>
			<tr>
				<th>6.</th>
				<td>	<span class="topic radio">ผิวหนังท้ายทอย</span>	
				<td><input name="occipital_skin" type="radio" value="ไม่ได้ส่งผิวหนังท้ายทอยไปตรวจ" <? if(@$rs['occipital_skin']=='ไม่ได้ส่งผิวหนังท้ายทอยไปตรวจ'){ print "checked";}?>onclick="show15(this.value);" disabled="disabled">ไม่ได้ส่ง <input name="occipital_skin" type="radio" value="ส่งผิวหนังท้ายทอยไปตรวจ"<? if(@$rs['occipital_skin']=='ส่งผิวหนังท้ายทอยไปตรวจ'){ print "checked";}?> onclick="show15(this.value);" disabled="disabled">ส่ง</td>	
				<td><span id="occipital_skin" <? if(@$rs['occipital_skin']!='ส่งผิวหนังท้ายทอยไปตรวจ'){print 'style = "display:none"';  }?>>วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" name="occipital_skindate"  value="<?php echo $rs['occipital_skindate'] ?>"size="10" disabled="disabled"></span></td>	
				<td><span id="occipital_skin_lo" <? if(@$rs['occipital_skin']!='ส่งผิวหนังท้ายทอยไปตรวจ'){print 'style = "display:none"';  }?>>สถานที่ส่งตรวจ <input type="text" class="input_box_patient" name="occipital_skin_lo" value="<?php echo $rs['occipital_skin_lo'] ?>" disabled="disabled"></td></span>
				<td><span id="occipital_skin_po_ne" <? if(@$rs['occipital_skin']!='ส่งผิวหนังท้ายทอยไปตรวจ'){print 'style = "display:none"';  }?>><?php echo form_radio('occipital_skin_po_ne','Positive','','disabled="disabled"') ?>Positive<?php echo form_radio('occipital_skin_po_ne','Negative','','disabled="disabled"') ?>Negative</span></td>
			</tr>
			<tr>
				<th>7.</th>
				<td>	<span class="topic radio">เซลล์กระจกตา</span>	
				<td><input name="corneal_cells" type="radio" value="ไม่ได้ส่งเซลล์กระจกตาไปตรวจ"<? if(@$rs['corneal_cells']=='ไม่ได้ส่งเซลล์กระจกตาไปตรวจ'){ print "checked";}?> onclick="show16(this.value);" disabled="disabled">ไม่ได้ส่ง <input name="corneal_cells" type="radio" value="ส่งเซลล์กระจกตาไปตรวจ" <? if(@$rs['corneal_cells']=='ส่งเซลล์กระจกตาไปตรวจ'){ print "checked";}?> onclick="show16(this.value);" disabled="disabled">ส่ง</td>	
				<td><span id="corneal_cells" <? if(@$rs['corneal_cells']!='ส่งเซลล์กระจกตาไปตรวจ'){print 'style = "display:none"';  }?>>วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" name="corneal_cellsdate" size="10" value="<?php echo $rs['corneal_cellsdate'] ?>" disabled="disabled"></span></td>	
				<td><span id="corneal_cells_lo" <? if(@$rs['corneal_cells']!='ส่งเซลล์กระจกตาไปตรวจ'){print 'style = "display:none"';  }?>>สถานที่ส่งตรวจ <input type="text" class="input_box_patient" name="corneal_cells_lo" value="<?php echo $rs['corneal_cells_lo'] ?>" disabled="disabled"></td></span>
				<td><span id="corneal_cells_po_ne" <? if(@$rs['corneal_cells']!='ส่งเซลล์กระจกตาไปตรวจ'){print 'style = "display:none"';  }?>><?php echo form_radio('corneal_cells_po_ne','Positive','','disabled="disabled"') ?>Positive<?php echo form_radio('corneal_cells_po_ne','Negative','','disabled="disabled"') ?>Negative</span></td>
			</tr>
		</table>		
	</div><!-- section3 -->
	<h3><a href="javascript:void(0)">ส่วนที่ 4 ประวัติการสัมผัสโรค</a></h3>
	<div id="section4">
		<table class="tbdead">
			<tr><th>1.</th>
					<td><span class="topic">วันที่สัมผัส</span><input type="text" name="datetouch" class="datepicker auto input_box_patient" value="<?php echo $rs['datetouch'] ?>" size="10" disabled="disabled"> </td>
			</tr>
			<tr>
				<th rowspan="3">3.</th>
				<td style="padding:10px;">บริเวณที่ถูกสัมผัสและความรุนแรง</td>
			</tr>
			<tr>
				<td><strong>โปรดทำเครื่อง x ลงบนภาพร่ายกาย บริเวณที่ถูกกัด/ข่วน/ถูกน้ำลาย/ถูกเลีย ให้ชัดเจน</strong></td>
			</tr>
			<tr>
				<td rowspan="4">
					<div style="width:994px;height:409px;clear: both;position:relative;">
					<div  style="position:absolute;width:222px;height:264px;background:url(images/body_man1.gif);float:left; "  id="body_man">
										<div id="markhead" style="position:absolute; left:160px; top:15px; width:12px; height:12px; z-index:8;"></div>
										<div id="markface" style="position:absolute; left:57px; top:24px; width:12px; height:12px; z-index:1;"></div>
										<div id="markneck" style="position:absolute; left:57px; top:45px; width:12px; height:12px; z-index:2;"></div>
										<div id="markbody" style="position:absolute; left:57px; top:72px; width:12px; height:12px; z-index:3;"></div>
										<div id="markarm" style="position:absolute; left:25px; top:92px; width:12px; height:12px; z-index:4;"></div>
										<div id="markhand" style="position:absolute; left:22px; top:135px; width:12px; height:12px; z-index:5;"></div>
										<div id="markleg" style="position:absolute; left:47px; top:192px; width:12px; height:12px; z-index:6;"></div>								
										<div id="markfeet" style="position:absolute; left:49px; top:232px; width:12px; height:12px; z-index:7;"></div>									
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
                         <td align="center" bgcolor="#E60000"><input name="head_bite_blood" id="head_bite_blood" disabled="disabled" type="radio" value="ถูกกัดที่ศีรษะมีเลือดออก" <? if(!empty($rs['head_bite_blood'])){ echo 'checked';}?> onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td align="center" bgcolor="#FF777A"><input name="head_bite_blood" id="head_bite_noblood"  disabled="disabled"type="radio" value="ถูกกัดที่ศีรษะมีเลือดไม่ออก" <? if(!empty($rs['head_bite_noblood'])){ echo 'checked';}?> onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td align="center" bgcolor="#669966"> <input name="head_claw_blood"  id="head_claw_blood" disabled="disabled" type="radio" <? if(!empty($rs['head_claw_blood'])){ echo 'checked';}?> 	value="ถูกข่วนที่ศีรษะมีเลือดออก" 	
                        	onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="head_claw_blood" id="head_claw_noblood"  disabled="disabled"type="radio" <? if(!empty($rs['head_claw_noblood'])){ echo 'checked';}?>  value="ถูกข่วนที่ศีรษะไม่มีเลือดออก" 
                        	onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="head_lick_blood"   id="head_lick_blood" disabled="disabled"type="radio" <? if(!empty($rs['head_lick_blood'])){ echo 'checked';}?> 	value="ถูกเลีย/ถูกน้ำลายที่ศีรษะที่มีแผล" 	
                        	onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="head_lick_blood" id="head_lick_noblood" disabled="disabled"type="radio" <? if(!empty($rs['head_lick_noblood'])){ echo 'checked';}?> value="ถูกเลีย/ถูกน้ำลายที่ศีรษะที่ไม่มีแผล" 
                        	onClick="show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'))"></td>
                      </tr>
                      <tr>
                        <td align="center">หน้า</td>
                        <td align="center" bgcolor="#E60000"> <input name="face_bite_blood" id="face_bite_blood"  disabled="disabled"class="one_required" <? if(!empty($rs['face_bite_blood'])){ echo 'checked';}?> type="radio" value="ถูกกัดที่หน้ามีเลือดออก" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td align="center" bgcolor="#FF777A"> <input name="face_bite_blood"  id="face_bite_noblood" disabled="disabled"class="one_required"  <? if(!empty($rs['face_bite_noblood'])){ echo 'checked';}?> type="radio" value="ถูกกัดที่หน้าไม่มีเลือดออก" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td align="center" bgcolor="#669966"> <input name="face_claw_blood" id="face_claw_blood" disabled="disabled"class="one_required"  <? if(!empty($rs['face_claw_blood'])){ echo 'checked';}?> type="radio" value="ถูกข่วนที่หน้ามีเลือดออก" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td align="center" bgcolor="#36CF74"> <input name="face_claw_noblood" id="face_claw_noblood" disabled="disabled"class="one_required" <? if(!empty($rs['face_claw_noblood'])){ echo 'checked';}?> type="radio"value="ถูกข่วนที่หน้าไม่มีเลือดออก" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td align="center" bgcolor="#6394bd"> <input name="face_lick_blood"  id="face_lick_blood"disabled="disabled" class="one_required" <? if(!empty($rs['face_lick_blood'])){ echo 'checked';}?> type="radio" value="ถูกเลีย/ถูกน้ำลายที่หน้าที่มีแผล" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                        <td align="center" bgcolor="#35ADF4"> <input name="face_lick_blood"  id="face_lick_noblood" disabled="disabled"class="one_required"  <? if(!empty($rs['face_lick_noblood'])){ echo 'checked';}?> type="radio" value="ถูกเลีย/ถูกน้ำลายที่หน้าที่ไม่มีแผล" onClick="show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'))"></td>
                      </tr>
                      <tr> 
                      
                        <td align="center">ลำคอ</td>
                       
                        <td align="center" bgcolor="#E60000"> <input name="neck_bite_blood"  id="neck_bite_blood" class="one_required"  <? if(!empty($rs['neck_bite_blood'])){ echo 'checked';}?> type="radio" disabled="disabled"value="ถูกกัดที่ลำคอมีเลือดออก" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                   
                        <td align="center" bgcolor="#FF777A"> <input name="neck_bite_blood"  id="neck_bite_noblood"class="one_required"  <? if(!empty($rs['neck_bite_noblood'])){ echo 'checked';}?> type="radio"  disabled="disabled"value="ถูกกัดที่ลำคอไม่มีเลือดออก" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        
                        <td align="center" bgcolor="#669966"> <input name="neck_claw_blood"  id="neck_claw_blood"class="one_required"  <? if(!empty($rs['neck_claw_blood'])){ echo 'checked';}?> type="radio" disabled="disabled"  value="'ถูกข่วนที่ลำคอมีเลือดออก" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                       
                        <td align="center" bgcolor="#36CF74"> <input name="neck_claw_blood" id="neck_claw_noblood"class="one_required"  <? if(!empty($rs['neck_claw_noblood'])){ echo 'checked';}?> type="radio" disabled="disabled" value="ถูกข่วนที่ลำคอไม่มีเลือดออก" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        
                        <td align="center" bgcolor="#6394bd"> <input name="neck_lick_blood" id="neck_lick_blood"class="one_required"  <? if(!empty($rs['neck_lick_blood'])){ echo 'checked';}?> type="radio" disabled="disabled" value="ถูกเลีย/ถูกน้ำลายที่ลำคอที่มีแผล" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        
                        <td align="center" bgcolor="#35ADF4"> <input name="neck_lick_blood" id="neck_lick_noblood" class="one_required" <? if(!empty($rs['neck_lick_noblood'])){ echo 'checked';}?> type="radio" disabled="disabled" value="ถูกเลีย/ถูกน้ำลายที่ลำคอที่ไม่มีแผล" onClick="show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'))"></td>
                        
                      </tr>
                      <tr> 
                       
                        <td align="center">2</td>
                
                        <td align="center">มือ</td>
                        
                        <td align="center" bgcolor="#E60000"> <input name="hand_bite_blood" id="hand_bite_blood"class="one_required"  disabled="disabled" <? if(!empty($rs['hand_bite_blood'])){ echo 'checked';}?> type="radio"  value="ถูกกัดที่มือมีเลือดออก" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        
                        <td align="center" bgcolor="#FF777A"> <input name="hand_bite_blood" id="hand_bite_noblood"class="one_required"  disabled="disabled" <? if(!empty($rs['hand_bite_noblood'])){ echo 'checked';}?> type="radio"  value="ถูกกัดที่มือไม่มีเลือดออก" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        
                        <td align="center" bgcolor="#669966"> <input name="hand_claw_blood" id="hand_claw_blood"class="one_required"  disabled="disabled" <? if(!empty($rs['hand_claw_blood'])){ echo 'checked';}?> type="radio"  value="ถูกข่วนที่มือมีเลือดออก" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        
                        <td align="center" bgcolor="#36CF74"> <input name="hand_claw_blood"  id="hand_claw_noblood"class="one_required" disabled="disabled"  <? if(!empty($rs['hand_claw_noblood'])){ echo 'checked';}?> type="radio"  value="ถูกข่วนที่มือไม่มีเลือดออก" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        
                        <td align="center" bgcolor="#6394bd"> <input name="hand_lick_blood"  id="hand_lick_blood"class="one_required"  disabled="disabled" <? if(!empty($rs['hand_lick_blood'])){ echo 'checked';}?>  type="radio" value="ถูกเลีย/ถูกน้ำลายที่มือที่มีแผล" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        
                        <td align="center" bgcolor="#35ADF4"> <input name="hand_lick_blood" id="hand_lick_noblood"class="one_required"  disabled="disabled" <? if(!empty($rs['hand_lick_noblood'])){ echo 'checked';}?> type="radio" value="ถูกเลีย/ถูกน้ำลายที่มือที่ไม่มีแผล" onClick="show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'))"></td>
                        
                      </tr>
                      <tr> 
                        
                        <td align="center">3</td>
                        
                        <td align="center">แขน</td>
                       
                        <td align="center" bgcolor="#E60000"> <input name="arm_bite_blood" id="arm_bite_blood"class="one_required"  disabled="disabled" <? if(!empty($rs['arm_bite_blood'])){ echo 'checked';}?> type="radio" value="ถูกกัดที่แขนมีเลือดออก" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                       
                        <td align="center" bgcolor="#FF777A"> <input name="arm_bite_blood"  id="arm_bite_noblood"class="one_required"  disabled="disabled" <? if(!empty($rs['arm_bite_noblood'])){ echo 'checked';}?> type="radio"  value="ถูกกัดที่แขนไม่มีเลือดออก" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        
                        <td align="center" bgcolor="#669966"> <input name="arm_claw_blood" id="arm_claw_blood" class="one_required" disabled="disabled"  <? if(!empty($rs['arm_claw_blood'])){ echo 'checked';}?> type="radio"  value="ถูกข่วนที่แขนมีเลือดออก" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        
                        <td align="center" bgcolor="#36CF74"> <input name="arm_claw_blood" id="arm_claw_noblood"class="one_required" disabled="disabled"   <? if(!empty($rs['arm_claw_noblood'])){ echo 'checked';}?>  type="radio" value="ถูกข่วนที่แขนไม่มีเลือดออก" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                       
                        <td align="center" bgcolor="#6394bd"> <input name="arm_lick_blood" id="arm_lick_blood"class="one_required"  disabled="disabled" <? if(!empty($rs['arm_lick_blood'])){ echo 'checked';}?> type="radio"  value="ถูกเลีย/ถูกน้ำลายที่แขนที่มีแผล" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        
                        <td align="center" bgcolor="#35ADF4"> <input name="arm_lick_blood" id="arm_lick_noblood"class="one_required"  disabled="disabled" <? if(!empty($rs['arm_lick_noblood'])){ echo 'checked';}?> type="radio" value="ถูกเลีย/ถูกน้ำลายที่แขนที่ไม่มีแผล" onClick="show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'))"></td>
                        
                      </tr>
                      <tr> 
                        
                        <td align="center">4</td>
                       
                        <td align="center">ลำตัว</td>
                        
                        <td align="center" bgcolor="#E60000"> <input name="body_bite_blood" id="body_bite_blood"class="one_required"  disabled="disabled" <? if(!empty($rs['body_bite_blood'])){ echo 'checked';}?> type="radio"  value="ถูกกัดที่ลำตัวมีเลือดออก" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                       
                        <td align="center" bgcolor="#FF777A"> <input name="body_bite_blood" id="body_bite_blood"class="one_required" disabled="disabled" <? if(!empty($rs['body_bite_noblood'])){ echo 'checked';}?> type="radio"  value="ถูกกัดที่ลำตัวไม่มีเลือดออก" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        
                        <td align="center" bgcolor="#669966"> <input name="body_claw_blood" id="body_claw_blood"class="one_required"  disabled="disabled" <? if(!empty($rs['body_claw_blood'])){ echo 'checked';}?> type="radio"  value="ถูกข่วนที่ลำตัวมีเลือดออก" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        
                        <td align="center" bgcolor="#36CF74"> <input name="body_claw_blood" id="body_claw_blood"class="one_required" disabled="disabled"  <? if(!empty($rs['body_claw_noblood'])){ echo 'checked';}?> type="radio"  value="ถูกข่วนที่ลำตัวไม่มีเลือดออก" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        
                        <td align="center" bgcolor="#6394bd"> <input name="body_lick_blood" id="body_lick_blood"class="one_required" disabled="disabled" <? if(!empty($rs['body_lick_blood'])){ echo 'checked';}?> type="radio"  value="ถูกเลีย/ถูกน้ำลายที่ลำตัวที่มีแผล" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                        
                        <td align="center" bgcolor="#35ADF4"> <input name="body_lick_blood"  id="body_lick_blood" class="one_required"disabled="disabled" <? if(!empty($rs['body_lick_noblood'])){ echo 'checked';}?> type="radio" value="ถูกเลีย/ถูกน้ำลายที่ลำตัวที่ไม่มีแผล" onClick="show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'))"></td>
                       
                      </tr>
                      <tr> 
                        
                        <td align="center">5</td>
                        
                        <td align="center">ขา</td>
                        
                        <td align="center" bgcolor="#E60000"> 
                        	<input name="leg_bite_blood"  id="leg_bite_blood" class="one_required" disabled="disabled"  <? if(!empty($rs['leg_bite_blood'])){ echo 'checked';}?> type="radio" value="ถูกกัดที่ขามีเลือดออก" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                        
                        <td align="center" bgcolor="#FF777A"> 
                        	<input name="leg_bite_blood"  id="leg_bite_noblood"class="one_required" disabled="disabled" <? if(!empty($rs['leg_bite_noblood'])){ echo 'checked';}?> type="radio"  value="ถูกกัดที่ขาไม่มีเลือดออก" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                        
                        <td align="center" bgcolor="#669966"> 
                        	<input name="leg_claw_blood" id="leg_claw_blood"class="one_required" disabled="disabled" <? if(!empty($rs['leg_claw_blood'])){ echo 'checked';}?> type="radio" value="'ถูกข่วนที่ขามีเลือดออก" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                        
                        <td align="center" bgcolor="#36CF74"> 
                        	<input name="leg_claw_blood" id="leg_claw_noblood"class="one_required" disabled="disabled"  <? if(!empty($rs['leg_claw_noblood'])){ echo 'checked';}?> type="radio" value="ถูกข่วนที่ขาไม่มีเลือดออก" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                        
                        <td align="center" bgcolor="#6394bd"> 
                        	<input name="leg_lick_blood"  id="leg_lick_blood"class="one_required" disabled="disabled" <? if(!empty($rs['leg_lick_blood'])){ echo 'checked';}?> type="radio"  value="'ถูกเลีย/ถูกน้ำลายที่ขาที่มีแผล" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        </td>
                        
                        <td align="center" bgcolor="#35ADF4"> 
                        	<input name="leg_lick_blood"  id="leg_lick_noblood"class="one_required" disabled="disabled" <? if(!empty($rs['leg_lick_noblood'])){ echo 'checked';}?> type="radio" value="ถูกเลีย/ถูกน้ำลายที่ขาที่ไม่มีแผล" onClick="show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'))">
                        	</td>
                       
                      </tr>
                      <tr> 
                        
                        <td align="center">6</td>
                       
                        <td align="center">เท้า</td>
                        
                        <td align="center" bgcolor="#E60000"> 
                        	<input name="feet_bite_blood"  id="feet_bite_blood" class="one_required" disabled="disabled"<? if(!empty($rs['feet_bite_blood'])){ echo 'checked';}?> type="radio" value="ถูกกัดที่เท้ามีเลือดออก" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'))">
                        </td>
                        
                        <td align="center" bgcolor="#FF777A"> 
                        	<input name="feet_bite_blood"class="one_required" disabled="disabled" <? if(!empty($rs['feet_bite_noblood'])){ echo 'checked';}?> type="radio" id="feet_bite_noblood" value="ถูกกัดที่เท้าไม่มีเลือดออก" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'))">
                        </td>
                        
                        <td align="center" bgcolor="#669966"> 
                        	<input name="feet_claw_blood" class="one_required" disabled="disabled" <? if(!empty($rs['feet_claw_blood'])){ echo 'checked';}?> type="radio" id="feet_claw_blood" value="ถูกข่วนที่เท้ามีเลือดออก" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'))">
                        </td>
                        
                        <td align="center" bgcolor="#36CF74"> 
                        	<input name="feet_claw_blood"class="one_required" disabled="disabled" <? if(!empty($rs['feet_claw_noblood'])){ echo 'checked';}?> type="radio" id="feet_claw_noblood" value="ถูกข่วนที่เท้าไม่มีเลือดออก" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'))">
                        </td>
                        
                        <td align="center" bgcolor="#6394bd"> 
                        	<input name="feet_lick_blood" class="one_required" disabled="disabled"<? if(!empty($rs['feet_lick_blood'])){ echo 'checked';}?> type="radio" id="feet_lick_blood" value="ถูกเลีย/ถูกน้ำลายที่เท้าที่มีแผล" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'))">
                        </td>
                        
                        <td align="center" bgcolor="#35ADF4">
                        	 <input name="feet_lick_blood" class="one_required" disabled="disabled" <? if(!empty($rs['feet_lick_noblood'])){ echo 'checked';}?> type="radio" id="feet_lick_noblood" value="ถูกเลีย/ถูกน้ำลายที่เท้าที่ไม่มีแผล" onClick="show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'))">                     	
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
					<input name="wash" type="radio" value="ไม่ได้ล้าง"<? if(@$rs['wash']=='ไม่ได้ล้าง'){ print "checked";}?> disabled="disabled" onclick="show(this.value);">ไม่ได้ล้าง<span class="n_afterwash" id ="notwash"<? if(@$rs['wash']!='ไม่ได้ล้าง'){print 'style = "display:none"';  }?>> เพราะ <input type="text" name="notwash" class="input_box_patient" id="notwash" disabled="disabled" ></span>
					<input name="wash" type="radio" value="ล้างทันทีที่ถูกกัด"<? if(@$rs['wash']=='ล้างทันทีที่ถูกกัด'){ print "checked";}?> disabled="disabled" onclick="show(this.value);">ล้างทันทีที่ถูกกัด
					<input name="wash" type="radio" value="ล้างหลังจากถูกกัดแล้ว" <? if(@$rs['wash']=='ล้างหลังจากถูกกัดแล้ว'){ print "checked";}?> disabled="disabled"onclick="show(this.value);">ล้างหลังจากถูกกัดแล้ว
					<span class="n_afterwash" id ="n_afterwash" <? if(@$rs['wash']!='ล้างหลังจากถูกกัดแล้ว'){print 'style = "display:none"';  }?>><input type="text" name="afterwash" class="input_box_patient auto" id="afterwash" size="2" disabled="disabled"> ชั่วโมง/วัน </span>
				</td>
			</tr>
			<tr><td colspan="3"><span class="topic radio">วิธีล้างดังนี้</span>
				<input name="washing" type="radio" value="ล้างด้วยน้ำเปล่า" <? if(@$rs['washing']=='ล้างด้วยน้ำเปล่า'){ print "checked";}?>onclick="show2(this.value);"disabled="disabled">ล้างด้วยน้ำเปล่า
				<input name="washing" type="radio" value="สบู่/ผงซักฟอก" <? if(@$rs['washing']=='สบู่/ผงซักฟอก'){ print "checked";}?>onclick="show2(this.value);"disabled="disabled">สบู่/ผงซักฟอก
				<input name="washing" type="radio" value="อื่นๆ" <? if(@$rs['washing']=='อื่นๆ'){ print "checked";}?>onclick="show2(this.value);"disabled="disabled">อื่นๆ <span id="otherwashing" <? if(@$rs['washing']!='อื่นๆ'){print 'style = "display:none"';  }?>>ระบุ <input type="text"  name="otherwashing" id="washing" class="input_box_patient" disabled="disabled"></span>
			</td></tr>
			<tr>
				<th>2.</th>
				<td><span class="topic radio">การใช้ยาใส่แผล </span>
					<input name="drugs" type="radio" value="ไม่ได้ใช้"<? if(@$rs['drugs']=='ไม่ได้ใช้'){ print "checked";}?> onclick="show3(this.value);" disabled="disabled">ไม่ได้ใช้
					<input name="drugs" type="radio" value="ใช้ "<? if(@$rs['drugs']=='ใช้'){ print "checked";}?> onclick="show3(this.value);" disabled="disabled">ใช้ 
					<span class="n_drugs" id ="n_drugs"<? if(@$rs['drugs']!=='ใช้ '){print 'style = "display:none"'; }?>>ระบุชนิด <input type="text" class="input_box_patient" name="usedrugs" id="drugs" disabled="disabled"></span></td>
			</tr>
		</table>
	</div><!--section5-->	
	<h3><a href="javascript:void(0)">ส่วนที่ 6 ประวัติการได้รับวัคซีน/อิมมูโนโกบุลิน/อาการแทรกซ้อนหลังการฉีดของผู้เสียชีวิต</a></h3>
	<div id="section6">
		<table class="tbdead">
			<tr>
				<th>1.</th>
				<td><span class="topic radio">ฉีดอิมมูโนโกบุลิน</span>					
						<input name="use_rig" type="radio" value="ไม่ได้ฉีด" <? if(@$rs['use_rig']=='ไม่ได้ฉีด'){ print "checked";}?> onclick="show4(this.value);" disabled="disabled">ไม่ได้ฉีด 
						<input name="use_rig" type="radio" value="ฉีด" <? if(@$rs['use_rig']=='ฉีด'){ print "checked";}?> onclick="show4(this.value);" disabled="disabled">ฉีด 									
							<ul class="sub"><span id="sub" <? if(@$rs['use_rig']!=='ฉีด'){print 'style = "display:none"'; }?>>
							<li><?php echo form_radio('inject1_e','ERIG','','disabled="disabled"') ?>ERIG<?php echo form_radio('inject1_e','HRIG','','disabled="disabled"') ?>HRIG	เมื่อวันที่<input type="text" class="input_box_patient datepicker  auto" value="<?php echo $rs['hr_date'] ?>" name="hr_date" size="10" disabled="disabled"></li>
							<li>จำนวน <input type="text"name="n_userig" class="input_box_patient" disabled="disabled" value="<?php echo $rs['logno_userig'] ?>">  IU/kg </li>
							<li>Lot.No <input type="text"  name="logno_userig"class="input_box_patient" disabled="disabled" value="<?php echo $rs['logno_userig'] ?>"> </li>
							<li>วันหมดอายุ <input type="text" name="exp_userig" class="input_box_patient datepicker  auto" size="10" disabled="disabled" value="<?php echo $rs['exp_userig'] ?>"></li></span></ul>
					</td>
			</tr>
			<tr>
				<th>2.</th>
				<td class="topic"><span class="topic radio">ประวัติการฉีดวัคซีนป้องกันโรค</span>
						<input name="vaccine_text" type="radio" value="ไม่ทราบ"<? if(@$rs['vaccine_text']=='ไม่ทราบ'){ print "checked";}?> onclick="show5(this.value);" disabled="disabled">ไม่ทราบ
						<input name="vaccine_text" type="radio" value="ไม่ได้ฉีด" <? if(@$rs['vaccine_text']=='ไม่ได้ฉีด'){ print "checked";}?>onclick="show5(this.value);" disabled="disabled">ไม่ได้ฉีด 
						<input name="vaccine_text" type="radio" value="ฉีด"<? if(@$rs['vaccine_text']=='ฉีด'){ print "checked";}?> onclick="show5(this.value);" disabled="disabled">ฉีด 									
							<ul class="sub" id ="h_sub"<? if(@$rs['vaccine_text']!=='ฉีด'){print 'style = "display:none"'; }?> >
							<li>ชนิดของวัคซีน ระบุ <?php $vaccine_type =array(1=>'HDCV',2=>'PCEC',3=>'PVRV',4=>'CPRV',5=>'PDEV');
								echo form_dropdown('vaccine_type',$vaccine_type,'','class="styled-select" disabled="disabled"');
							 ?>								
							</li>
							<li> วันที่เริ่มฉีด <input type="text"  name="vaccine_date"  value="<?echo @$rs['vaccine_date'] ;?>" class="input_box_patient auto datepicker" size="10" disabled="disabled" > จำนวน <input type="text" disabled="disabled"class="input_box_patient auto" size="3" name ="sum_vaccine" value="<?echo @$rs['sum_vaccine'] ;?>">ซีซี</li>
							<li> Lot. No. <input type="text" name="vaccine_lotno" disabled="disabled"class="input_box_patient auto" size="5" value="<?echo @$rs['vaccine_lotno'] ;?>">วันที่หมดอายุ <input type="text" class="input_box_patient auto datepicker" value="<?echo @$rs['exp_vaccine'] ;?>" name="exp_vaccine" size="10" disabled="disabled"></li>
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
					<?php $animal=array(1=>'สุนัข',2=>'แมว',3=>'ลิง',4=>'ชะนี',5=>'หนู',6=>'อื่นๆ ระบุ');echo form_dropdown('animal',$animal,@$rs['aniaml'],'class="styled-select" disabled="disabled"');?>
					<span class="other"><input type="text" name="animal_other" class="input_box_patient" disabled="disabled"></span>
				</td> 			
				
			</tr>
			<tr>
				<th>2.</th>
				<td><span class="topic">อายุของสัตว์</span>
					<?php $age=array(1=>'น้อยกว่า 3 เดือน',2=>'3-6 เดือน',3=>'6-12 เดือน',4=>'มากกว่า 1 ปี',5=>'ไม่ทราบ'); ?>
					<?php echo  form_dropdown('age_animal',$age,@$rs['age_animal'],'class="styled-select" disabled="disabled"');?>
				</td>

			</tr>
			<tr>
				<th>3.</th>
				<td><span class="topic radio">สถานภาพสัตว์</span>
					<?php echo form_radio('statusanimal','1','','disabled="disabled"')?>มีเจ้าของ
					<?php echo form_radio('statusanimal','2','','disabled="disabled"') ?>ไม่มีเจ้าของ
					<?php echo form_radio('statusanimal','3','','disabled="disabled"') ?>ไม่ทราบ
				</td>
			</tr>
			<tr>
				<th>4.</th>
				<td valign="top"><span class="topic radio">การกักขังติดตาม</span>
					<input name="detain" type="radio" value="ไม่ทราบ"  <? if(@$rs['detain']=='ไม่ทราบ'){ echo "checked";}?>onclick="show6(this.value);"disabled="disabled">ไม่ทราบ
					<input name="detain" type="radio" value="สัตว์หนีหายไปติดตามไม่ได้"  <? if(@$rs['detain']=='สัตว์หนีหายไปติดตามไม่ได้'){ echo "checked";}?>onclick="show6(this.value);"disabled="disabled">สัตว์หนีหายไปติดตามไม่ได้
					<input name="detain" type="radio" value="ถูกฆ่า/รถทับตาย"  <? if(@$rs['detain']=='ถูกฆ่า/รถทับตาย'){ echo "checked";}?>onclick="show6(this.value);"disabled="disabled">ถูกฆ่า/รถทับตาย							
					<input name="detain" type="radio" value="ไม่ได้กักขัง" <? if(@$rs['detain']=='ไม่ได้กักขัง'){ echo "checked";}?>onclick="show6(this.value);"disabled="disabled">ไม่ได้กักขัง
					<input name="detain" type="radio" value="ได้กักขัง/ติดตามพบ" <? if(@$rs['detain']=='ได้กักขัง/ติดตามพบ'){ echo "checked";}?> onclick="show6(this.value);"disabled="disabled">ได้กักขัง/ติดตามพบ
					<span id="subimprison" ><ul class="sub" style="margin-right:24%;"><!-- 17%-->
						<li><?php echo form_radio('deaddetain','ไม่ตายภายใน 10 วัน','','disabled="disabled"') ?>ไม่ตายภายใน 10 วัน</li>
						<li><?php echo form_radio('deaddetain','ตายเองภายใน 10 วัน','','disabled="disabled"') ?>ตายเองภายใน 10 วัน</li>
					</ul>	</span>									
				</td>
			</tr>
			<tr>
				<th>5.</th>
				<td colspan="3"><span class="topic radio">สาเหตุที่ถูกกัด</span>
					<input name="reasonbite" type="radio" value="1" <? if(@$rs['reasonbite']=='1'){ echo "checked";}?>onclick="show7(this.value);" disabled="disabled">ถูกกัดโดยไม่มีสาเหตุโน้นำ
					<input name="reasonbite" type="radio" value="2" <? if(@$rs['reasonbite']=='2'){ echo "checked";}?> onclick="show7(this.value);" disabled="disabled">ถูกกัดโดยมีสาเหตุโน้มนำ <span id="subcause_bite" style = "display:none">เนื่องจาก
					 <ul class="sub" >
					 	<li><?php echo form_radio('n_reasonbite','1','','disabled="disabled"') ?>ทำร้าย หรือแกล้งสัตว์</li>
					 	<li><?php echo form_radio('n_reasonbite','2','','disabled="disabled"') ?>พยายามแยกสัตว์ที่กำลังต่อสู้กัน</li>
					 	<li><?php echo form_radio('n_reasonbite','3','','disabled="disabled"') ?>เข้าใกล้สัตว์แม่ลูกอ่อน</li>
					 	<li><?php echo form_radio('n_reasonbite','4','','disabled="disabled"') ?>รบกวนสัตว์ขณะกินอาหาร</li>
					 	<li><?php echo form_radio('n_reasonbite','5',' ','disabled="disabled"') ?>อื่นๆ ระบุ <input type="text" name="other_reasonbite"class="input_box_patient"disabled="disabled"></li>					 	
					 </ul>
				</td>
			</tr>
			<tr>
				<th>6.</th>
				<td colspan="3"><span class="topic radio">ประวัติการรับวัคซีนของสัตว์นำโรค</span>
					<input name="historyvacine" type="radio" value="1" <? if(@$rs['historyvacine']=='1'){ print "checked";}?> onclick="show8(this.value);" disabled="disabled">ไม่ทราบ
					<input name="historyvacine" type="radio" value="2" <? if(@$rs['historyvacine']=='2'){ print "checked";}?> onclick="show8(this.value);" disabled="disabled">ไม่ได้รับ
					<input name="historyvacine" type="radio" value="3"  <? if(@$rs['historyvacine']=='3'){ print "checked";}?>onclick="show8(this.value);" disabled="disabled">ได้รับ <span id="subimmunization_history"><input type="text" class="input_box_patient auto" name="n_historyvacine" size="2" disabled="disabled" value="<?php echo @$rs['n_historyvacine'];?>"> ครั้ง 
					ครั้งสุดท้าย 	<?php echo form_radio('no1_historyvacine','ภายใน 1 ปี','','disabled="disabled"') ?>ภายใน 1 ปี<?php echo form_radio('no1_historyvacine','เกิน 1 ปี ','','disabled="disabled"') ?>เกิน 1 ปี <?php echo form_radio('no1_historyvacine','จำไม่ได้','','disabled="disabled"') ?>จำไม่ได้</span> 
				</td>
				
			</tr>
			<tr>
				<th>7.</th>
				<td colspan="3"><span class="topic radio">การส่งหัวตรวจ</span>
						<input name="headanimal" type="radio" value="1" <? if(@$rs['headanimal']=='1'){ echo "checked";}?> onclick="show9(this.value);" disabled="disabled">ไม่ได้ส่งตรวจเนื่องจาก
						<input name="headanimal" type="radio" value="2" <? if(@$rs['headanimal']=='2'){ echo "checked";}?> onclick="show9(this.value);" disabled="disabled">ส่งตรวจเนื่อง <span id="subspecimen">สถานที่ 					  		
						<?php 
					  			$class=' id="headanimalplace" class="input_box_patient " onChange="show_hide_clear_otherheadanimalplace(this);" disabled="disabled"';
					  		 	echo form_dropdown('headanimalplace',get_option('id','name','n_animalplaces'),@$rs['headanimalplace'],$class,'-โปรดเลือก-'); ?>
						<ul class="sub">
							<li>ผลการตรวจ <?php echo form_radio('resultanimal','พบเชื้อ','','disabled="disabled"') ?>พบเชื้อ
												<?php echo form_radio('resultanimal','ไม่พบเชื้อ','','disabled="disabled"') ?>ไม่พบเชื้อ</li></ul></span>
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
					<td>ผู้สัมผัสโรค<span style="text-decoration: underline"><strong>จากสัตว์ตัวเดียวกัน</strong></span> จำนวน <input type="text"name="same_kind_human" class="input_box_patient"disabled="disabled" value="<?php echo @$rs['same_kind_human'];?>">คน</td>
					<td style="padding-left:10px;">สัตว์ตัวอื่นที่สัมผัสโรค<span style="text-decoration: underline"><strong>จากสัตว์ตัวเดียวกัน</strong></span> 
					จำนวน<input type="text" class="input_box_patient" name="same_kind_animal" disabled="disabled" value="<?php echo @$rs['same_kind_animal'];?>">ตัว</td>
				</tr>
			</tr>
		<tr>
				<th rowspan="2">2.</th>				
		</tr>
				<tr>
					<td>ผู้สัมผัสโรค<span style="text-decoration: underline"><strong>จากผู้ป่วยรายนี้</strong></span> 	<span style="padding-left:24px;">จำนวน</span> <input type="text"name="same_kind_patient" class="input_box_patient"disabled="disabled" value="<?php echo @$rs['same_kind_patient'];?>">คน</td>
					
				</tr>
			</tr>			
		</table>

	</div><!-- section 8 -->
	
</div><!-- cordion -->
		<table class="tbform">
			<tr>
				<th>ชื่อ-สกุลผู้รายงาน</th><td><input type="text" class="input_box_patient" name="reportname" disabled="disabled" value="<?php echo @$rs['reportname'];?>"></td>
				<th>ตำแหน่ง</th><td><input type="text" class="input_box_patient" name="positionname" disabled="disabled" value="<?php echo @$rs['positionname'];?>"></td>
		   </tr>
		   <tr>
				<th>สถานที่ปฏิบัติงาน</th><td><input type="text" class="input_box_patient" name="reportlocation" disabled="disabled" value="<?php echo @$rs['reportlocation'];?>"></td>
				<th>วันบันทึกรายงาน</th>
				<td>
					<?
						$Ydate=date('Y')+543;
						$datedeflaut=date("-m-d");
						$reportdate=cld_my2date($Ydate.$datedeflaut);
					?>
			        <input name="reportdate" type="text" size="10" class="input_box_patient " disabled="disabled"readonly="readonly" value="<?php echo (@$rs['reportdate'])? cld_my2date(@$rs['reportdate']):$reportdate;?>"> 

				    </td>
			</tr>
		</table>
<small><strong>หมายเหตุ :</strong>ระยะฟักตัวของโรค (Incubation period) ที่เชื่อถือได้สั้นที่สุด 7 วัน ยาวนานที่สุด 3 ปี (โดยเฉลี่ย 30-90 วัน)</small>









 <div class="btn_inline">
      <ul>
      	<li><button class="btn_save" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="reset">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div> 
	</form>
	


<? if(!empty($rs['head_bite_blood'])){ echo "<script language='javascript'>show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(!empty($rs['head_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(!empty($rs['head_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(!empty($rs['head_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(!empty($rs['head_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(!empty($rs['head_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('head_bite_blood').checked,document.getElementById('head_bite_noblood').checked,document.getElementById('head_claw_blood').checked,document.getElementById('head_claw_noblood').checked,document.getElementById('head_lick_blood').checked,document.getElementById('head_lick_noblood').checked,document.getElementById('markhead'));</script>";}?>
<? if(!empty($rs['face_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(!empty($rs['face_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(!empty($rs['face_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(!empty($rs['face_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(!empty($rs['face_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(!empty($rs['face_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('face_bite_blood').checked,document.getElementById('face_bite_noblood').checked,document.getElementById('face_claw_blood').checked,document.getElementById('face_claw_noblood').checked,document.getElementById('face_lick_blood').checked,document.getElementById('face_lick_noblood').checked,document.getElementById('markface'));</script>";}?>
<? if(!empty($rs['neck_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(!empty($rs['neck_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(!empty($rs['neck_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(!empty($rs['neck_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(!empty($rs['neck_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(!empty($rs['neck_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('neck_bite_blood').checked,document.getElementById('neck_bite_noblood').checked,document.getElementById('neck_claw_blood').checked,document.getElementById('neck_claw_noblood').checked,document.getElementById('neck_lick_blood').checked,document.getElementById('neck_lick_noblood').checked,document.getElementById('markneck'));</script>";}?>
<? if(!empty($rs['hand_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(!empty($rs['hand_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(!empty($rs['hand_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(!empty($rs['hand_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(!empty($rs['hand_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(!empty($rs['hand_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('hand_bite_blood').checked,document.getElementById('hand_bite_noblood').checked,document.getElementById('hand_claw_blood').checked,document.getElementById('hand_claw_noblood').checked,document.getElementById('hand_lick_blood').checked,document.getElementById('hand_lick_noblood').checked,document.getElementById('markhand'));</script>";}?>
<? if(!empty($rs['arm_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if(!empty($rs['arm_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if(!empty($rs['arm_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if(!empty($rs['arm_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if(!empty($rs['arm_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if(!empty($rs['arm_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('arm_bite_blood').checked,document.getElementById('arm_bite_noblood').checked,document.getElementById('arm_claw_blood').checked,document.getElementById('arm_claw_noblood').checked,document.getElementById('arm_lick_blood').checked,document.getElementById('arm_lick_noblood').checked,document.getElementById('markarm'));</script>";}?>
<? if(!empty($rs['body_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(!empty($rs['body_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(!empty($rs['body_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(!empty($rs['body_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(!empty($rs['body_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(!empty($rs['body_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('body_bite_blood').checked,document.getElementById('body_bite_noblood').checked,document.getElementById('body_claw_blood').checked,document.getElementById('body_claw_noblood').checked,document.getElementById('body_lick_blood').checked,document.getElementById('body_lick_noblood').checked,document.getElementById('markbody'));</script>";}?>
<? if(!empty($rs['leg_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(!empty($rs['leg_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(!empty($rs['leg_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(!empty($rs['leg_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(!empty($rs['leg_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(!empty($rs['leg_lick_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('leg_bite_blood').checked,document.getElementById('leg_bite_noblood').checked,document.getElementById('leg_claw_blood').checked,document.getElementById('leg_claw_noblood').checked,document.getElementById('leg_lick_blood').checked,document.getElementById('leg_lick_noblood').checked,document.getElementById('markleg'));</script>";}?>
<? if(!empty($rs['feet_bite_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'));</script>";}?>
<? if(!empty($rs['feet_bite_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'));</script>";}?>
<? if(!empty($rs['feet_claw_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'));</script>";}?>
<? if(!empty($rs['feet_claw_noblood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'));</script>";}?>
<? if(!empty($rs['feet_lick_blood'])){ echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'));</script>";}?>
<? if(!empty($rs['feet_lick_noblood'])){echo "<script language=\"javascript\">show_mark(document.getElementById('feet_bite_blood').checked,document.getElementById('feet_bite_noblood').checked,document.getElementById('feet_claw_blood').checked,document.getElementById('feet_claw_noblood').checked,document.getElementById('feet_lick_blood').checked,document.getElementById('feet_lick_noblood').checked,document.getElementById('markfeet'));</script>";}?>
