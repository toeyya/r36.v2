<script type="text/javascript">
$(document).ready(function(){
	 $('#multiAccordion').multiAccordion({
            //heightStyle: "content",
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
	$('#hospitaldistrict').live('change',function(){
		var ref7=$("#hospitaldistrict option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>hospital/getHospital',
			data:'name=hospitalcode&ref1='+ref5+'&ref2='+ref6+'&ref3='+ref7,
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
			provinceid:"ระบุจังหวัด",
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
<div id="title">แบบฟอร์มผู้เสียชีวิตด้วยโรคพิษสุนัขบ้า</div>
<form id="form1" name="form1" method="post"  action="inform/save_dead" > 
<div id="multiAccordion">
	<h3><a href="javascript:void(0)">ส่วนที่ 1 ข้อมูลทั่วไป</a></h3>
	<div id="section1">
		<table class="tbdead">
		<tr>
				<th rowspan="3">1.</th>
				<td>	<span class="topic">คำนำหน้า</span> <select name="prefix_name" class="styled-select ">
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
							<input name="firstname" type="text" class="input_box_patient" id="firstname" value="<?php echo $rs['firstname'];?>" size="20" />
					</td>
					<td><span class="topic">นามสกุล <span class="alertred">*</span></span>
							  <input name="surname" type="text" value="<?php echo $rs['surname'];?>" size="20"  class="input_box_patient ">
					</td>	
					<td><span class="topic">บัตรประชาชน</span>
						<span id="Show_idcard"> 
						<input name="cardW0" id="cardW0" type="text" class="input_box_patient nowidth" size="1" maxlength="1" value="<?php echo @$cardW0?>" />
						  -
						  <input name="cardW1"  id="cardW1" type="text" class="input_box_patient nowidth" size="4" maxlength="4"  value="<?php echo @$cardW1?>" />
						  -
						  <input name="cardW2"  id="cardW2" type="text" class="input_box_patient nowidth" size="5" maxlength="5"   value="<?php echo @$cardW2?>"/>
						  -
						  <input name="cardW3" id="cardW3" type="text" class="input_box_patient nowidth" size="2" maxlength="2"  value="<?php echo @$cardW3?>" />
						  -
						<input name="cardW4" id="cardW4" type="text" class="input_box_patient nowidth" size="1" maxlength="1"  value="<?php echo @$cardW4?>"  />				
				
					</td>					
			</tr>
			<tr>				
				<td><span class="topic">อายุ<span class="alertred">*</span></span>
                            <input name="age" id="age"  type="text" size="2" maxlength="2" value="<?php echo @$rs['age'];?>" class="input_box_patient auto"  onKeyUp="chk_than15(this.value);"></td>
				<td><span class="topic">ผู้ปกครอง</span> <input name="parentname" type="text" class="input_box_patient " id="parentname" value="<?php echo $rs['parentname'];?>" size="50" style="width:300px;"/>
		    	<td colspan="3"><small>(กรณีผู้ป่วยอายุต่ำกว่า 15 ปี กรุณากรอกชื่อ-นามสกุล ผู้ปกครอง)</small></td>							    			
			</tr>
			<tr>
				<th>2. </th>
				<td><span class="topic radio">เชื้อชาติ</span>
											<input name="nationality" type="radio" value="1" <? if(@$rs['nationalityname']=='1'){ echo "checked";}?> onClick="show_hide_nationality(document.form1);"> ไทย&nbsp;&nbsp;
						<input name="nationality" type="radio" value="2" <? if(@$rs['nationalityname']=='2'){ echo "checked";}?> onClick="show_hide_nationality(document.form1);"> อื่นๆ 
						<span id="nationality_tr1" <? if(@$rs['nationalityname']!='2'){ print 'style = "display:none"';}?>>
						สัญชาติ :&nbsp; 
							<select name="nationalityname"  class="styled-select " onChange="show_hide_clear_nationality_text(this)">
								<option value="0" <? if(@$rs['nationalityname']=='0'){echo "selected";}?>>เลือกสัญชาติ</option>
								<option value="2" <? if(@$rs['nationalityname']=='2'){echo "selected";}?>>จีน/ฮ่องกง/ใต้หวัน</option>
								<option value="3" <? if(@$rs['nationalityname']=='3'){echo "selected";}?>>พม่า</option>
								<option value="4" <? if(@$rs['nationalityname']=='4'){echo "selected";}?>>มาเลเซีย</option>
								<option value="5" <? if(@$rs['nationalityname']=='5'){echo "selected";}?>>กัมพูชา</option>
								<option value="6" <? if(@$rs['nationalityname']=='6'){echo "selected";}?>>ลาว</option>
								<option value="7" <? if(@$rs['nationalityname']=='7'){echo "selected";}?>>เวียดนาม</option>
								<option value="8" <? if(@$rs['nationalityname']=='8'){echo "selected";}?>>ยุโรป</option>
								<option value="9" <? if(@$rs['nationalityname']=='9'){echo "selected";}?>>อเมริกา</option>
								<option value="10" <? if(@$rs['nationalityname']=='10'){echo "selected";}?>>ไม่ทราบสัญชาติ</option>
								<option value="11" <? if(@$rs['nationalityname']=='11'){echo "selected";}?>>อื่นๆ</option>
                          </select>&nbsp;
							<span id="nationality_div" <? if(@$rs['nationalityname']!='11'){ print 'style = "display:none"';}?>>
								  <span class="alertred">(โปรดระบุ)</span>&nbsp;
								  <input name="othernationalityname" id="othernationalityname" type="text" value="<?php echo @$rs['othernationalityname'];?>" class="input_box_patient " size="20">
						  </span>
						</span>
				</td>
				<td><span class="topic radio">ศาสนา</span>
					<input type="radio" value="1" name="religion">พุทธ
					<input type="radio" value="2" name="religion">คริสต์
					<input type="radio" value="3" name="religion">อิสลาม
					<input type="radio" value="4" name="religion">อื่นๆ
				</td>
				<td><span class="topic">อาชีพ</span>
							<?php echo form_dropdown('occupationname',get_option('id','name','n_occupations'),@$rs['occupationname'],'class="styled-select " onChange="return show_hide_clear_otheroccupationname(this);" id="occupation_than15"','- กรุณาเลือกอาชีพ-'); ?>
							<?php 
							$class='class="styled-select" onChange="return show_hide_clear_otheroccupationname(this);" id="occupation_less15"';
							echo form_dropdown('occupationname_b',get_option('id','name','n_occupations where id in(1,2,3)'),@$rs['occupationname'],$class,'- กรุณาเลือกอาชีพ-'); ?>
						<? if(@$rs['age']>15){ 
										echo	"<script>document.getElementById ('occupation_less15').style.display='none'</script>";
								}else{ 
										echo	"<script>document.getElementById ('occupation_than15').style.display='none'</script>";
								}
						?>
							<span  id="otheroccupationname_tr" <? if(@$rs['occupationname']!='20'){ print 'style = "display:none"'; }?>>
							<span class="alertred">(โปรดระบุ)&nbsp;
						<input name="otheroccupationname" id="otheroccupationname"  type="text" class="input_box_patient " size="10" value="<?php echo @$rs['otheroccupationname'];?>" /></span>
						</span>
				</td>
			</tr>	
			<tr>
				<th rowspan="3">3. </th>
				<td>ที่อยู่ขณะป่วย เลขที่<input type="text"  class="input_box_patient "name="no_home" value="<?php echo $rs['no_home'] ?>">					</td>
				<td><span class="topic">หมู่ที่</span><input type="text" class="input_box_patient " name="moo" value="<?php echo $rs['moo'] ?>"></td>
				<td><span class="topic">หมู่บ้าน</span><input type="text"  class="input_box_patient "name="villege" value="<?php echo $rs['villege'] ?>"></td>
			</tr>
			<tr>
				<td>	<span class="topic">ชุมชน</span><input type="text"  class="input_box_patient "name="community" value="<?php echo $rs['community'] ?>"></td>
				<td><span class="topic">ซอย</span><input name="soi" type="text" class="input_box_patient " size="20" value="<?php echo $rs['soi'];?>" /></td>
                <td><span class="topic">ถนน</span><input name="road" type="text" class="input_box_patient " id="road" value="<?php echo $rs['road'];?>" size="20" /></td>			
			</tr>
			<tr>
               <td><span class="topic">จังหวัด<span class="alertred">*</span></span>	
                	<?php $class='class="input_box_patient " id="provinceid"';
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
								echo form_dropdown('amphurid',get_option('amphur_id','amphur_name',"n_amphur WHERE amphur_id!=''".$whamp."  ORDER BY amphur_name ASC"),@$rs['amphurid'],'class="input_box_patient " id="amphurid"','-โปรดเลือก-');
							}else{									
							?>
								<select name="amphurid" id="amphurid" class="input_box_patient ">
									<option value="">-โปรดเลือก-</option>
								</select>
							<?php } ?>
						</span></td>						
                  <td><span class="topic">ตำบล/แขวง <span class="alertred">*</span></span>
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
								<select name="districtid" id="districtid" class="input_box_patient ">
									<option value="">-โปรดเลือก-</option>
								</select>
							<?php } ?></span>
				</td>
		</tr>
		<tr>
			<th rowspan="4">4.</th>
			<td><span class="topic radio">ภูมิลำเนา</span>
					<input type="radio" value="1" name="addr_same">ที่อยู่ขณะป่วย
					<input type="radio" value="2" name="addr_same">คนละที่</td>
		</tr>
		<tr>
			<td><span class="topic">เลขที่</span><input type="text"  class="input_box_patient "name="no_home" value="<?php echo $rs['no_home'] ?>">					</td>
			<td><span class="topic">หมู่ที่</span><input type="text" class="input_box_patient " name="moo" value="<?php echo $rs['moo'] ?>"></td>
			<td> <span class="topic">หมู่บ้าน</span><input type="text"  class="input_box_patient "name="villege" value="<?php echo $rs['villege'] ?>"></td>
		</tr>
		<tr>
			<td>	<span class="topic">ชุมชน</span><input type="text"  class="input_box_patient "name="community" value="<?php echo $rs['community'] ?>"></td>
			<td><span class="topic">ซอย</span><input name="soi" type="text" class="input_box_patient " size="20" value="<?php echo $rs['soi'];?>" /></td>
            <td><span class="topic">ถนน</span><input name="road" type="text" class="input_box_patient " id="road" value="<?php echo $rs['road'];?>" size="20" /></td>			
		</tr>
			<tr>
               <td><span class="topic">จังหวัด<span class="alertred">*</span></span>	
                	<?php $class='class="input_box_patient " id="provinceid"';
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
								echo form_dropdown('amphurid',get_option('amphur_id','amphur_name',"n_amphur WHERE amphur_id!=''".$whamp."  ORDER BY amphur_name ASC"),@$rs['amphurid'],'class="input_box_patient " id="amphurid"','-โปรดเลือก-');
							}else{									
							?><select name="amphurid" id="amphurid" class="input_box_patient "><option value="">-โปรดเลือก-</option></select>
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
										echo  form_dropdown('district_id',get_option('district_id','district_name'," n_district WHERE district_id!='' ". $whdis." ORDER BY district_name ASC"),@$rs['districtid'],'class="input_box_patient " id="districtid"','-โปรดเลือก-');
								}else{
							?> <select name="districtid" id="districtid" class="input_box_patient"><option value="">-โปรดเลือก-</option> </select>
						<?php } ?></span>
				</td>	
		</tr>
		<tr>
			<th>5.</th>
			<td colspan="2">เบอร์โทรศัพท์ของญาติ / เพื่อนบ้าน / ผู้นำส่ง ที่สามารถติดต่อได้ <input type="text" class="input_box_patient" name="telephone" value="<?php echo $rs['telephone']  ?>"></td>
		</tr>
		</table>
	</div><!--section1 -->
	<h3><a href="javascript:void(0)">ส่วนที่ 2 อาการและอาการแสดง</a></h3>
	<div id="section2">
		<table class="tbdead">
			<tr>
				<th>1. </th>
				<td><span class="topic">วันเริ่มอาการ</span><input type="text" name="" class="input_box_patient datepicker  auto" size="10"></td>
				<td><span class="topic">รักษาที่</span><input type="text" name="hospitalcode" class="input_box_patient"></td>
				<td><span class="topic">วันที่</span><input type="text" name="" class="input_box_patient datepicker  auto" size="10"></td>
			</tr>
			<tr>
				<th>2. </th>
				<td><span class="topic radio">ประเภทผู้ป่วย</span>
					<input type="radio" name="patient_type" value="in">ผู้ป่วยนอก
					<input type="radio" name="patient_type" value="out">ผู้ป่วยใน
				</td>
				<td colspan="2"><span class="topic radio">ผลการรักษา</span>
						
						<input type="radio" name="patient_type" value="in">กำลังรักษา <input type="text" name="" value="" class="input_box_patient">
						
						<input type="radio" name="patient_type" value="out">เสียชีวิต วันที่ <input type="text" name="" class="input_box_patient datepicker  auto" size="10">
						
				</td>
			<tr>
				<th>3.</th>
				<td colspan="3"><span class="topic" style="width:140px;">อาการและอาการแสดง</span>
					<hr class="hr1">
					<ul>
						<li class="topic">ไข้</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
						<li class="topic">ปวดศีรษะ</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
						<li class="topic">ตื่นเต้นกระวนกระวายต่อสิ่งเร้า /แสง /เสียง</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
						<li class="topic">อาละวาดผุดลุกผุดนั่ง</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
						<li class="topic">กลืนลำบาก</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
						<li class="topic">ซึม ไม่รู้สึกตัว</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
						<li class="topic">ถ่มน้ำลายตลอดเวลา</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
						<li class="topic">ถอนหายใจเป็นพักๆ</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
						<li class="topic">กลัวลม</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
						<li class="topic">ขนลุกบางส่วนหรือทั้งตัว</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
						<li class="topic">กลัวน้ำ</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
						<li class="topic">สูญเสียความทรงจำชั่วคราว</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
						<li class="topic">รูม่านตาไม่ตอบสนองต่อแสง</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
						<li class="topic">แขนขาอ่อนแรง</li><li><?php echo form_checkbox('','1','') ?>มี</li><li><?php echo form_checkbox('','2','') ?>ไม่มี</li><li><?php echo form_checkbox('','3','') ?>ไม่ทราบ</li>
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
				<td>	<span class="topic radio">เนื้องสมอง</span>	
				<td><?php echo form_checkbox('','1','') ?>ไม่ได้ส่ง <?php echo form_checkbox('','2','') ?>ส่ง</td>	
				<td>วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" size="10"></td>	
				<td>สถานที่ส่งตรวจ <input type="text" class="input_box_patient"></td>
				<td><?php echo form_checkbox('','3','') ?>Positive<?php echo form_checkbox('','3','') ?>Negative</td>
			</tr>
			<tr>
				<th>2.</th>
				<td>	<span class="topic radio">น้ำลายปวดศีรษะ</span>	
				<td><?php echo form_checkbox('','1','') ?>ไม่ได้ส่ง <?php echo form_checkbox('','2','') ?>ส่ง</td>	
				<td>วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" size="10"></td>	
				<td>สถานที่ส่งตรวจ <input type="text" class="input_box_patient"></td>
				<td><?php echo form_checkbox('','3','') ?>Positive<?php echo form_checkbox('','3','') ?>Negative</td>
			</tr>
			<tr>
				<th>3.</th>
				<td>	<span class="topic radio">น้ำไขสันหลัง</span>	
				<td><?php echo form_checkbox('','1','') ?>ไม่ได้ส่ง <?php echo form_checkbox('','2','') ?>ส่ง</td>	
				<td>วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" size="10"></td>	
				<td>สถานที่ส่งตรวจ <input type="text" class="input_box_patient"></td>
				<td><?php echo form_checkbox('','3','') ?>Positive<?php echo form_checkbox('','3','') ?>Negative</td>
			</tr>
			<tr>
				<th>4.</th>
				<td>	<span class="topic radio">ปัสสาวะ</span>	
				<td><?php echo form_checkbox('','1','') ?>ไม่ได้ส่ง <?php echo form_checkbox('','2','') ?>ส่ง</td>	
				<td>วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" size="10"></td>	
				<td>สถานที่ส่งตรวจ <input type="text" class="input_box_patient"></td>
				<td><?php echo form_checkbox('','3','') ?>Positive<?php echo form_checkbox('','3','') ?>Negative</td>
			</tr>
			<tr>
				<th>5.</th>
				<td>	<span class="topic radio">ปมรากผล</span>	
				<td><?php echo form_checkbox('','1','') ?>ไม่ได้ส่ง <?php echo form_checkbox('','2','') ?>ส่ง</td>	
				<td>วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" size="10"></td>	
				<td>สถานที่ส่งตรวจ <input type="text" class="input_box_patient"></td>
				<td><?php echo form_checkbox('','3','') ?>Positive<?php echo form_checkbox('','3','') ?>Negative</td>
			</tr>
			<tr>
				<th>6.</th>
				<td>	<span class="topic radio">ผิวหนังท้ายทอย</span>	
				<td><?php echo form_checkbox('','1','') ?>ไม่ได้ส่ง <?php echo form_checkbox('','2','') ?>ส่ง</td>	
				<td>วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" size="10"></td>	
				<td>สถานที่ส่งตรวจ <input type="text" class="input_box_patient"></td>
				<td><?php echo form_checkbox('','3','') ?>Positive<?php echo form_checkbox('','3','') ?>Negative</td>
			</tr>
			<tr>
				<th>7.</th>
				<td>	<span class="topic radio">เซลล์กระจกตา</span>	
				<td><?php echo form_checkbox('','1','') ?>ไม่ได้ส่ง <?php echo form_checkbox('','2','') ?>ส่ง</td>	
				<td>วันที่ส่งตรวจ <input type="text" class="input_box_patient datepicker  auto" size="10"></td>	
				<td>สถานที่ส่งตรวจ <input type="text" class="input_box_patient"></td>
				<td><?php echo form_checkbox('','3','') ?>Positive<?php echo form_checkbox('','3','') ?>Negative</td>
			</tr>
		</table>		
	</div><!-- section3 -->
	<h3><a href="javascript:void(0)">ส่วนที่ 4 ประวัติการสัมผัสโรค</a></h3>
	<div id="section4">
		<table class="tbdead">
			<tr><th>1.</th>
				<td><span class="topic">ชนิดของสัตว์</span>
					<?php $animal=array(1=>'สุนัข',2=>'แมว',3=>'ลิง',4=>'ชะนี',5=>'หนู',6=>'อื่นๆ ระบุ');echo form_dropdown('animal',$animal,@$rs['aniaml'],'class="styled-select"');?>
					<span class="other"><input type="text" class="input_box_patient"></span>
				</td> 			
			</tr>
			<tr>
				<th>2.</th>
				<td><span class="topic">วันที่สัมผัส</span><input type="text" class="datepicker  auto input_box_patient" size="10"> เวลา <input type="text" class="input_box_patient"><small>(ถ้าไม่ทราบวันที่ สามารถระบุเป็นช่วงเวลาได้)</small></td>
			</tr>
			<tr>
				<th>3.</th>
				<td><span class="topic">สถานที่ถูกกัด/ข่วน</span>
					<?php echo form_radio('','1','') ?>ในบ้าน
					<?php echo form_radio('','1','') ?>นอกบ้าน 
						<span>
							<select><option>จังหวัด</option></select>
							<select><option>อำเภอ</option></select>
							<select><option>ตำบล</option></select>
							สถานที่ <input type="text" class="input_box_patient">
						</span>
					<?php echo form_radio('','1','') ?>ต่างประเทศ ระบุ <input type="text" class="input_box_patient">
				</td>
			</tr>
			<tr>
				<th>4.</th>
				<td><span class="topic">ลักษณะสถานที่</span>	<?php echo form_radio('','1','') ?>ชุมชนเมือง
					<?php echo form_radio('','1','') ?>ชานเมือง 	<?php echo form_radio('','1','') ?>ชนบท </td>
			</tr>
				<tr>
				<th>5.</th>
				<td><span class="topic">การได้รับเชื้อ</span>	<?php echo form_checkbox('','1','') ?>ไม่ทราบ
					<?php echo form_checkbox('','1','') ?>ถูกน้ำลาย 	<?php echo form_checkbox('','1','') ?>คลุกคลีใกล้ชิดสัตว์ 
					<?php echo form_checkbox('','1','') ?>ถูกข่วน 	<?php echo form_checkbox('','1','') ?>ถูกกัด</td>
			</tr>
			<tr>
				<th rowspan="3">6.</th>
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
						<tr><td>ศีรษะ</td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
						</tr>
						<tr><td>หน้า</td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>							
						</tr>
						<tr><td>ลำคอ</td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>							
						</tr>
						<tr>
							<td>2</td>
							<td>มือ</td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>	
						</tr>
						<tr>
							<td>3</td>
							<td>แขน</td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>	
						</tr>
						<tr>
							<td>4</td>
							<td>ลำตัว</td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>	
						</tr>
						<tr>
							<td>5</td>
							<td>ขา</td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>	
						</tr>
						<tr>
							<td>6</td>
							<td>เท้า</td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>
							<td><?php echo form_checkbox('','1',false); ?></td>	
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
		<table class="tbdead">
			<tr>
				<th rowspan="2">1.</th>
				<td><span class="topic radio">ความสะอาดบาดแผล</span>
					<?php echo form_radio('','1','') ?>ไม่ได้ล้าง เพราะ <input type="text" name="" class="input_box_patient">
					<?php echo form_radio('','1','') ?>ล้างทันทีที่ถูกกัด
					<?php echo form_radio('','1','') ?>ล้างหลังจากถูกกัดแล้ว<input type="text" name="" class="input_box_patient auto" size="2"> ชั่วโมง/วัน 
				</td>
			</tr>
			<tr><td colspan="3"><span class="topic radio">วิธีล้างดังนี้</span>
				<?php echo form_radio('','1','') ?>ล้างด้วยน้ำเปล่า
				<?php echo form_radio('','1','') ?>สบู่/ผงซักฟอก
				<?php echo form_radio('','1','') ?>อื่นๆ ระบุ <input type="text" class="input_box_patient">
			</td></tr>
			<tr>
				<th>2.</th>
				<td><span class="topic radio">การใช้ยาใส่แผล </span><?php echo form_radio('','1','') ?>ไม่ได้ใช้<?php echo form_radio('','2','') ?>ใช้ ระบุชนิด <input type="text" class="input_box_patient"></td>
			</tr>
			<tr>
				<th>3.</th>
				<td><span class="topic radio">การเย็บแผล </span><?php echo form_radio('','1','') ?>ไม่ได้เย็บแผล<?php echo form_radio('','2','') ?>เย็บแผลที่ รพ./รพ.สต./คลีนิก <input type="text" class="input_box_patient"></td>
			</tr>
		</table>
	</div><!--section5-->	
	<h3><a href="javascript:void(0)">ส่วนที่ 6 ประวัติการได้รับวัคซีน/อิมมูโนโกบุลิน/อาการแทรกซ้อนหลังการฉีดของผู้เสียชีวิต</a></h3>
	<div id="section6">
		<table class="tbdead">
			<tr>
				<th>1.</th>
				<td><span class="topic radio">ฉีดอิมมูโนโกบุลิน</span>					
						<?php echo form_radio('','1','') ?>ไม่ได้ฉีด 
						<?php echo form_radio('','1','') ?>ฉีด 									
							<ul class="sub">
							<li><?php echo form_radio('','1','') ?>ERIG<?php echo form_radio('','1','') ?>HRIG	เมื่อวันที่<input type="text" class="input_box_patient datepicker  auto" size="10"></li>
							<li>จำนวน <input type="text" class="input_box_patient"> หน่วยสากล (IU) </li>
							<li>Lot.No <input type="text" class="input_box_patient"> </li>
							<li>วันหมดอายุ <input type="text" class="input_box_patient datepicker  auto" size="10"></li></ul>
					</td>
			</tr>
			<tr>
				<th>2.</th>
				<td class="topic"><span class="topic radio">ประวัติการฉีดวัคซีนป้องกันโรค</span>
						<?php echo form_radio('','1','') ?>ไม่ทราบ
						<?php echo form_radio('','1','') ?>ไม่ฉีด 	
						<?php echo form_radio('','1','') ?>ฉีด
						<ul class="sub">
							<li>ชนิดของวัคซีน ระบุ <?php $vaccine_type =array(1=>'HDCV',2=>'PCEC',3=>'PVRV',4=>'CPRV',5=>'PDEV');
								echo form_dropdown('vaccine_type',$vaccine_type,'','class="styled-select"');
							 ?>								
							</li>
							<li> วันที่เริ่มฉีด <input type="text" class="input_box_patient auto datepicker" size="10"> จำนวน <input type="text" class="input_box_patient auto" size="3">ซีซี</li>
							<li> Lot. No. <input type="text" class="input_box_patient auto" size="5">วันที่หมดอายุ <input type="text" class="input_box_patient auto datepicker" size="10"></li>
						</ul> 	
				</td>
			</tr>
			<tr>
				<th>3.</th>
				<td><span class="topic radio">อาการแทรกซ้อนหลังฉีดวัคซีน</span>	<?php echo form_radio('','1','') ?>ไม่มี
						<?php echo form_radio('','1','') ?>มี ระบุ
						<ul class="sub">
							<li><?php echo form_checkbox('','1','') ?>บวมบริเวณฉีด</li>	
							<li><?php echo form_checkbox('','1','') ?>ปวดศีรษะ</li>	
							<li><?php echo form_checkbox('','1','') ?>ไข้สูง</li>	
							<li><?php echo form_checkbox('','1','') ?>ปัสสาวะลำบาก</li>	
							<li><?php echo form_checkbox('','1','') ?>อัมพาต</li>	
							<li><?php echo form_checkbox('','1','') ?>เสียชีวิต</li>	
							<li><?php echo form_checkbox('','1','') ?>อื่นๆ ระบุ <input type="text" class="input_box_patient"></li>	
						</ul>	</td>
				
			</tr>
		</table>
	</div><!-- section 6-->	
	<h3><a href="javascript:void(0)">ส่วนที่ 7 ประวัติของสัตว์ที่กัด</a></h3>
	<div id="section7">
		<table class="tbdead">
			<tr>
				<th>1.</th>
				<td><span class="topic">อายุของสัตว์</span>
					<?php $age=array(1=>'น้อยกว่า 3 เดือน',2=>'3-6 เดือน',3=>'6-12 เดือน',4=>'มากกว่า 1 ปี',5=>'ไม่ทราบ'); ?>
					<?php echo  form_dropdown('age_animal',$age,@$rs['age_animal'],'class="styled-select"');?>
				</td>

			</tr>
			<tr>
				<th>2.</th>
				<td><span class="topic radio">สถานภาพสัตว์</span>
					<?php echo form_radio('','1','') ?>มีเจ้าของ
					<?php echo form_radio('','1','') ?>ไม่มีเจ้าของ
					<?php echo form_radio('','1','') ?>ไม่ทราบ
				</td>
			</tr>
			<tr>
				<th>3.</th>
				<td valign="top"><span class="topic radio">การกักขังติดตาม</span>
					<?php echo form_checkbox('','1','') ?>ไม่ได้กักขัง
					<?php echo form_checkbox('','1','') ?>ได้กักขัง/ติดตามพบ
					<?php echo form_checkbox('','1','') ?>ไม่ตายภายใน 10 วัน
					<?php echo form_checkbox('','1','') ?>ตายเองภายใน 10 วัน
					<?php echo form_checkbox('','1','') ?>ถูกฆ่าตาย
					<?php echo form_checkbox('','1','') ?>สัตว์หายไปติดตามไม่ได้
				</td>
			</tr>
			<tr>
				<th>4.</th>
				<td colspan="3"><span class="topic radio">สาเหตุที่ถูกกัด</span>
					<?php echo form_radio('','1','') ?>ถูกกัดโดยไม่มีสาเหตุโน้นำ
					<?php echo form_radio('','1','') ?>ถูกกัดโดยมีสาเหตุโน้มนำ เนื่องจาก
					 <ul class="sub">
					 	<li><?php echo form_checkbox('','1','') ?>ทำร้าย หรือแกล้งสัตว์</li>
					 	<li><?php echo form_checkbox('','1','') ?>พยายามแยกสัตว์ที่กำลังต่อสู้กัน</li>
					 	<li><?php echo form_checkbox('','1','') ?>เข้าใกล้สัตว์แม่ลูกอ่อน</li>
					 	<li><?php echo form_checkbox('','1','') ?>รบกวนสัตว์ขณะกินอาหาร</li>
					 	<li><?php echo form_checkbox('','1','') ?>อื่นๆ ระบุ <input type="text" class="input_box_patient"></li>					 	
					 </ul>
				</td>
			</tr>
			<tr>
				<th>5.</th>
				<td colspan="3"><span class="topic radio">การส่งหัวตรวจ</span>
						<?php echo form_radio('','1','') ?>ไม่ได้ส่งตรวจเนื่องจาก
						<?php echo form_radio('','1','') ?>ส่งตรวจเนื่อง ระบุสถานที่ 					  		<?php 
					  			$class=' id="headanimalplace" class="input_box_patient " onChange="show_hide_clear_otherheadanimalplace(this);"';
					  		 	echo form_dropdown('headanimalplace',get_option('id','name','n_animalplaces'),@$rs['headanimalplace'],$class,'-โปรดเลือก-'); ?>
						<ul class="sub">
							<li>ผลการตรวจ <?php echo form_radio('','1','') ?>พบเชื้อ
												<?php echo form_radio('','1','') ?>ไม่พบเชื้อ</li></ul>
				</td>
			</tr>
		</table>
	</div><!-- section 7-->	
	<h3><a href="javascript:void(0)">ส่วนที่ 8 ผู้สัมผัสโรครายอื่น</a></h3>
	<div id="section8">
		<table class="tbdead8">	
			<tr>
				<th rowspan="4">1.</th>
				<td style="padding:10px;">ผู้สัมผัสโรค<span style="text-decoration: underline"><strong>จากสัตว์ตัวเดียวกัน</strong></span></td>
			</tr>
			<tr>
				<td><span class="topic">มีผู้ถูกกัดจำนวน</span><input type="text" class="input_box_patient"> คน</td>
				<td><span class="pad-left">ได้รับการฉีดวัคซีนป้องกันโรคนี้แล้ว</span><input type="text" class="input_box_patient"> คน</td>				
			</tr>
				<tr>
				<td><span class="topic">มีผู้สัมผัสน้ำลายจำนวน</span><input type="text" class="input_box_patient"> คน</td>
				<td><span class="pad-left">ได้รับการฉีดวัคซีนป้องกันโรคนี้แล้ว</span><input type="text" class="input_box_patient"> คน</td>
			</tr>
			<tr>
				<td colspan="2"><span class="pad-left">จำนวนผู้ถึงแก่กรรมจากสัตว์ตัวเดียวกันนี้กัด</span>
					<?php echo form_radio('','1','') ?>ไม่มี
					<?php echo form_radio('','1','') ?>มี	<span class="">ชื่อ-สกุล <input type="text" class="input_box_patient"> เบอร์โทรศัพท์ญาติ/ผู้เกี่ยวข้อง <input type="text" class="input_box_patient"></span>
				</td>	
			</tr>		
			</tr>
			<tr>
				<th rowspan="3">2.</th>
				<td style="padding:10px;">ผู้สัมผัสโรค<span style="text-decoration: underline"><strong>จากผู้ป่วยรายนี้</strong></span></td>
				<tr>
					<td><span class="topic">สัมผัสน้ำลายโดยไม่มีแผล</span><input type="text" class="input_box_patient"> คน</td>
					<td><span class="pad-left">ได้รับการฉีดวัคซีนป้องกันโรคนี้แล้ว</span><input type="text" class="input_box_patient"> คน</td>
				</tr>
				<tr>
					<td><span class="topic">สัมผัสน้ำลายโดยมีแผล / ถูกผู้ป่วยกัน</span><input type="text" class="input_box_patient"> คน</td>
					<td><span class="pad-left">ได้รับการฉีดวัคซีนป้องกันโรคนี้แล้ว</span><input type="text" class="input_box_patient"> คน</td>
				</tr>
			</tr>
		</table>

	</div><!-- section 8 -->
	
</div><!-- cordion -->
		<table class="tbform">
			<tr>
				<th>ชื่อผู้ให้สัมภาษณ์</th><td><input type="text" class="input_box_patient"></td>
				<th>ความสัมพันธ์กับผู้ป่วย</th><td><input type="text" class="input_box_patient"></td>
				
			</tr>
			<tr>
				<th>ชื่อ-สกุล</th><td><input type="text" class="input_box_patient"></td>
				<th>ผู้สอบสวนตำแหน่ง</th><td><input type="text" class="input_box_patient"></td>
		   </tr>
		   <tr>
				<th>สถานที่ปฏิบัติงาน</th><td><input type="text" class="input_box_patient"></td>
				<th>โทรศัพท์</th><td><input type="text" class="input_box_patient"></td></tr>
		 <tr><th>อีเมล์</th><td><input type="text" class="input_box_patient"></td>
				<th>วันที่สอบสวนโรค</th><td><input type="text" class="input_box_patient datepicker  auto" size="10"></td>
		</tr>

		</table>
<small><strong>หมายเหตุ :</strong>ระยะฟักตัวของโรค (Incubation period) ที่เชื่อถือได้สั้นที่สุด 7 วัน ยาวนานที่สุด 3 ปี (โดยเฉลี่ย 30-90 วัน)</small>









 <div class="btn_inline">
      <ul>
      	<li><button class="btn_save" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="reset">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div> 
	</form>