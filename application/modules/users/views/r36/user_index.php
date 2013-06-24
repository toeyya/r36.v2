<script type="text/javascript">
$(document).ready(function(){
var ref1,ref2,ref3;
	$("#h_province").change(function(){	
		 ref1=$("#h_province option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',data:'name=h_amphur&ref1='+ref1,
			success:function(data)
			{
				$("#input_amphur").html(data);
				$("#hosptal option[value='']").attr('selected','selected');
			}
		});
	});
	$("#h_amphur").live('change',function(){	
	 	ref2=$("#h_amphur option:selected").val();
		$.ajax({url:'<?php echo base_url(); ?>district/getDistrict',data:'name=h_district&ref1='+ref1+'&ref2='+ref2,success:function(data){$("#input_district").html(data);}});	
	});			
	$('#h_district').live('change',function(){
		ref3=$("#h_district option:selected").val();
		$.ajax({url:'<?php echo base_url(); ?>hospital/getHospital',data:'name=userhospital&ref1='+ref1+'&ref2='+ref2+'&ref3='+ref3,success:function(data){$("#input_hospital").html(data);}});	
	});
	$('#userprovince2').change(function(){
		id=$('#userprovince2 option:selected').val();
		$.ajax({url:'<?php echo base_url(); ?>district/getAmphur',data:'name=useramphur&ref1='+id,success:function(data){$('#useramphur').replaceWith(data);}})
	});

	$("#hospital").hide();
	$('#admin_province').hide();
    function u_position(){   	
				var value=$('select[name=userposition] option:selected').val();
				if(value=="05"){
					$("#hospital").show();
				}else if(value=="02"){
					$('#admin_province').show();
					$('#hospital').hide();
				}else{
					$('#hospital').hide();
				}
	}	
	u_position();
	$('select[name=userposition]').change(u_position).click(u_position);
	

	$("#form1").validate({
		 groups: {
    			groupidcard:"cardW0 cardW1 cardW2 cardW3 cardW4"   		   
  		},		
		rules:{
				telephone:{required:true,number:true, rangelength: [6, 9]}
				,mobile:{required:true,number:true, rangelength: [9, 10]}
	 			,cardW0:{ required: true, number:true},cardW1:{ required: true, number:true},cardW2:{ required: true, number:true},cardW3:{ required: true, number:true}
		 		,cardW4:{ required: true, number:true,		
		 			remote:{
		 				url:'<?php echo base_url(); ?>users/chkidcard',
				        data: {
				          idcard: function() { return $('#cardW0').val()+$('#cardW1').val()+$('#cardW2').val()+$('#cardW3').val()+$('#cardW4').val(); },
				          digit_last:function(){return $('#cardW4').val();}, 
				          uid:function(){return $('#uid').val()}
				        }
		 			}		 		
		 		}			 					
				,userfirstname:"required",usersurname:"required"
				,userprovince:{ required: {depends: function(element) {return $('select[name=userposition] option:selected').val() =='02' }}}
				//,userprovince2:{required:{depends:function(element){return $('input[name=userposition]:checked').val()=="03"}}}
				//,useramphur:{required:{depends:function(element){return $('input[name=userposition]:checked').val()=="03"}}}
				,h_province:{required:{depends:function(element){return $('select[name=userposition] option:selected').val()=="05";}}}
				,h_amphur:{required:{depends:function(element){return $('select[name=userposition] option:selected').val()=="05";}}}
				,h_district:{required:{depends:function(element){return $('select[name=userposition] option:selected').val()=="05";}}}
				,userhospital:{required:{depends:function(element){return $('select[name=userposition] option:selected').val()=="05";}}}
				,usermail:{
					required:true,email:true,
					remote:{url:'<?php echo base_url() ?>users/checkEmail',data:{uid:function(){return $('#uid').val()}}}					
				}
				,userpassword:"required"
				,repassword:{required:true, equalTo: "#userpassword"}
	
		},
		messages:{
			    telephone:{required:"กรุณาระบุ",number:"กรุณาระบุเฉพาะตัวเลข",rangelength:"ระบุความยาวอักษร 6-9 ตัวอักษรเท่านั้น"}
			    ,mobile:{required:"กรุณาระบุ",number:"กรุณาระบุเฉพาะตัวเลข",rangelength:"ระบุความยาวอักษร 9-10 ตัวอักษรเท่านั้น"}
				,cardW0:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข"}
		 		,cardW1:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข"}
		 		,cardW2:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข"}
		 		,cardW3:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข"}
		 		,cardW4:{required:" กรุณาระบุ",number: " กรุณาระบุเป็นตัวเลข",remote :" ระบุไม่ถูกต้อง หรือมีอีเมล์นี้แล้วในระบบ"}	
				,userfirstname:" กรุณาระบุ",usersurname:" กรุณาระบุด้วย"
				,userprovince:" กรุณาระบุ"
				//,useramphur:" กรุณาระบุด้วยค่ะ",userdistrict:" กรุณาระบุด้วยค่ะ"
				//,userprovince2:" กรุณาระบุด้วยค่ะ"
				,usermail:{required:" กรุณาระบุ",email:" ระบุไม่ถูกต้อง",remote:"มีอีเมล์นี้แล้วในระบบ"}
				,h_province:" กรุณาระบุ",h_amphur:" กรุณาระบุ",h_district:"กรุณาระบุ",userhospital:" กรุณาระบุ"
				,userpassword:" กรุณาระบุ"
				,repassword:{required:" กรุณาระบุ",equalTo: " ระบุ password ไม่ถูกต้อง"}
		},
		errorPlacement: function(error, element){							    
        		 if (element.attr("name") == "cardW0"  || element.attr("name") == "cardW1" 	|| element.attr('name') == "cardW2" || element.attr('name')=="cardW3" || element.attr('name')=="cardW4") error.insertAfter("#cardW4");       		 
        		 else error.insertAfter(element);
		}						
	});

	
});// document
</script>
<div id="title">ประวัติส่วนตัว</div>
<form name="form1" id="form1" action="users/r36/users/save" enctype="multipart/form-data" method="post" >
<input name="uid" id="uid" type="hidden" value="<?php echo @$rs['uid']?>" />			
<table  class="tbform">
  <tr>
    <th valign="top">สิทธิืการใช้งาน</th>
    <td><?php echo form_dropdown('userposition',get_option('level_code','level_name','n_level_user'),@$rs['userposition'],'class="input_box_patient"','--โปรดเลือก--') ?></td> 
  </tr>  
  <tr>
    <th width="96" height="20"class="topic">ชื่อ <span class="alertred" >*</span></th>
    <td width="339" height="20"><input name="userfirstname" type="text" value="<?php echo @$rs['userfirstname'];?>" class="input_box_patient " /></td>
  </tr>
  <tr>
    <th height="20" >นามสกุล  <span class="alertred">*</span></th>
    <td height="20"><input name="usersurname" type="text" value="<?php echo @$rs['usersurname'];?>" class="input_box_patient " /></td>
  </tr>
  <tr>
  	<th>เลขที่บัตรประชาชน  <span class="alertred">*</span></th>
  	<td><span id="Show_idcard">
  			<input type="text" name="cardW0"   id="cardW0"   value="<?php echo $cardW0 ?>"  size="1" maxlength="1" class="input_box_patient" style="width:20px;"> -
  			<input type="text"  name="cardW1"  id="cardW1"   value="<?php echo $cardW1 ?>"  size="4" maxlength="4" class="input_box_patient" style="width:80px;margin-left:0px;"> -
  			<input type="text"  name="cardW2"  id="cardW2"   value="<?php echo $cardW2 ?>"  size="5" maxlength="5"  class="input_box_patient" style="width:100px;margin-left:0px;"> -
  			<input type="text"  name="cardW3"  id="cardW3"  value="<?php echo $cardW3 ?>"  size="2" maxlength="2" class="input_box_patient" style="width:40px;margin-left:0px;"> -
  			<input type="text"  name="cardW4"  id="cardW4"  value="<?php echo $cardW4 ?>"  size="1" maxlength="1" class="input_box_patient" style="width:20px;margin-left:0px;"> 	
  			</span>					
  	</td>
  </tr>
  <tr>
    <th>อีเมล์ <span class="alertred">*</span></th>
    <td><input name="usermail" type="text" class="input_box_patient " id="usermail" value="<?php echo @$rs['usermail'];?>" size="50" style="width:230px"></td>
  </tr>
  <tr>
  	<th>โทรศัพท์สำนักงาน<span class="alertred">*</span></th>
  	<td><input type="text" name="telephone" value="<?php echo @$rs['telephone'] ?>" class="input_box_patient"> ต่อ<input type="text" name="telephone_extend" value="<?php echo @$rs['telephone_extend'] ?>" class="input_box_patient auto" size="5"> <small>ตัวอย่าง 02526666</small>
  	</td>
  </tr>
  <tr>
  	<th>โทรศัพท์มือถือ <span class="alertred">*</span></th>
  	<td><input type="text" name="mobile" value="<?php echo @$rs['mobile'] ?>" class="input_box_patient"> <small>ตัวอย่าง 0811234567</small></td>
  </tr>
  <tr>
  	<th>โทรสาร</th>
  	<td><input type="text" name="fax"  value="<?php echo $rs['fax'] ?>"  class="input_box_patient"> <small>ตัวอย่าง 021234567</small></td>
  </tr>
   <tr>
  	 <th>ตำแหน่ง </th>
  	<td><?php echo form_dropdown('position',get_option('id','name','n_position'),@$rs['position'],'class="styled-select"','--กรุณาระบุ--') ?></td>
  </tr>
  <tr id="admin_province">
	<th>จังหวัด <span class="alertred">*</span></th>
	<td><?php echo form_dropdown('userprovince',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['userprovince'],'class="styled-select"','-โปรดเลือก-')?></td>  	
  </tr>    
  <tr  id="hospital">
    <th valign="top"  >สถานพยาบาล </th>
    <td>
		<ul class="sublist">
			<li><label>จังหวัด <span class="alertred">*</span> </label>
				<?php
					echo form_dropdown('h_province',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['hospital_province_id'],'class="styled-select" id="h_province"','-โปรดเลือก-')
				?>       
			</li>
			<li><label>อำเภอ <span class="alertred">*</span> </label>
					<span id="input_amphur">
	              <?php
		              	$wh=(!empty($rs['hospital_province_id']))? " and province_id='".$rs['hospital_province_id']."'":'';
						if($wh)
						{
							echo form_dropdown('h_amphur',get_option('amphur_id','amphur_name',"n_amphur where  amphur_id<>'' $wh  order by amphur_name asc"),@$rs['hospital_amphur_id'],'class="styled-select" id="h_amphur"','-โปรดเลือก-');
						}else{				
					?>
						<select name="h_amphur" id="h_amphur" ><option value="">-โปรดเลือก-</option></select>
           			<?php }?>
          			</span> 
			</li>
			<li><label>ตำบล <span class="alertred">*</span> </label>
				<span id="input_district">
  					<?php 
		              	$wh=(!empty($rs['hospital_province_id']))? " and province_id='".$rs['hospital_province_id']."' and amphur_id='".$rs['hospital_amphur_id']."' order by district_name asc":'';
						if($wh)
						{
							echo form_dropdown('h_district',get_option('district_id','district_name',"n_district where  district_id<>'' $wh "),@$rs['hospital_district_id'],'class="styled-select" id="h_district"','-โปรดเลือก-');
						}else{				
					?>
						<select name="h_district" id="h_district" ><option value="">-โปรดเลือก-</option></select>
           			<?php }?>
          			</span> 				
				</span>
			</li>
			<li><label>สถานพยาบาล <span class="alertred">*</span> </label>
					<span id="input_hospital">
		              <?php 
		              	$class='class="styled-select" id="userhospital"';
						$wh=(@$rs['hospital_amphur_id']!="")?" where hospital_province_id='".$rs['hospital_province_id']."' and hospital_amphur_id='".$rs['hospital_amphur_id']."' and hospital_district_id='".$rs['hospital_district_id']."'":'';									
						if($wh){
							echo form_dropdown('userhospital',get_option('hospital_code','hospital_name',"n_hospital_1 $wh order by hospital_name asc"),@$rs['userhospital'],$class,'-โปรดเลือก-');
						}else{
					?>
						<select name="hospital" id="hospital" ><option value="">-โปรดเลือก-</option></select>
           			<?php } ?>
          		  </span> 
			</li>
		</ul>
     </td>
  </tr>
	<?php $gen_pass=generate_password();	?> 
  <tr>
    <th >รหัสผ่าน </th>
    <td><span style="margin-left:20px;"><?php echo (empty($rs['userpassword']))? $gen_pass:$rs['userpassword']?></span></td>
  </tr>
  <tr>
    <th >สร้าง / เปลี่ยน รหัสผ่าน <span class="alertred">*</span></th>
    <td><input type="password" id="userpassword" name="userpassword" class="input_box_patient " value="<?php echo (empty($rs['userpassword']))?$gen_pass: @$rs['userpassword'];?>">
        </td>
  </tr> 
  <tr>
    <th>ยืนยันรหัสผ่าน  <span class="alertred">*</span></th>
    <td><input type="password" name="repassword" class="input_box_patient " value="<?php echo (empty($rs['userpassword']))?$gen_pass: @$rs['userpassword'];?>">
       <input type="hidden" name="uid" value="<?php echo $rs['uid'] ?>">
       <input type="hidden" name="updated" value="<?php echo date('Y-m-d H:i:s') ?>">
    </td>
  </tr>
</table>
 <div class="btn_inline"><ul><li><button class="btn_save" name="btn_save" type="submit"></button></li></ul></div>   
</form>
