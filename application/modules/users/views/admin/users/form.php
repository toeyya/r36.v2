<script type="text/javascript">
$(document).ready(function(){
var ref1,ref2,ref3;
	$("#h_province").change(function(){	
		 ref1=$("#h_province option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',data:'name=h_amphur&ref1='+ref1,
			success:function(data)
			{
				$("#input_Hamphur").html(data);
				$("#hosptal option[value='']").attr('selected','selected');
			}
		});
	});
	$("#h_amphur").live('change',function(){	
	 	ref2=$("#h_amphur option:selected").val();
		$.ajax({url:'<?php echo base_url(); ?>district/getDistrict',data:'name=h_district&ref1='+ref1+'&ref2='+ref2,success:function(data){$("#input_District").html(data);}});	
	});			
	$('#h_district').live('change',function(){
		ref3=$("#h_district option:selected").val();
		$.ajax({url:'<?php echo base_url(); ?>hospital/getHospital',data:'ref1='+ref1+'&ref2='+ref2+'&ref3='+ref3,success:function(data){$("#input_Hospital").html(data);}});	
	});
	$('#userprovince2').change(function(){
		id=$('#userprovince2 option:selected').val();
		$.ajax({url:'<?php echo base_url(); ?>district/getAmphur',data:'name=useramphur&ref1='+id,success:function(data){$('#useramphur').replaceWith(data);}})
	});

	
		 $('#Show_idcard').children().bind('keydown',function(e){											
				if(e.keyCode != 46 && e.keyCode!=8){														
					var txtBox=$('#Show_idcard').children();
					var key=$(this).index();
						if(key==0 || key==4)l=1;
						if(key==1)l=4;
						if(key==2)l=5;
						if(key==3)l=2;															
						if(txtBox.eq(key).val().length==l){			
							txtBox.eq(key+1).val('');
							txtBox.eq(key+1).focus();			
						}																					
					}							
		});
		
	
});// document
</script>
<h1>ผู้ใช้ระบบ</h1>
<form name="form1" id="form1" action="users/r36/users/save" enctype="multipart/form-data" method="post" >
<input name="uid" id="uid" type="hidden" value="<?php echo @$rs['uid']?>" />			
<table  class="form">
  <tr>
  	<th>สิทธิ์การใช้งาน</th>
  	<td><?php echo form_dropdown('userpostion',get_option("level_code",'level_name','n_level_user'),$rs['userposition'],'',''); ?></td>
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
  	<td><span style="margin-left:15px;" id="Show_idcard">
  			<input type="text" name="cardW0"   id="cardW0"   value=""  size="1" maxlength="1">-
  			<input type="text"  name="cardW1"  id="cardW1"   value=""  size="4" maxlength="4">-
  			<input type="text"  name="cardW2"  id="cardW2"   value=""  size="5" maxlength="5">-
  			<input type="text"  name="cardW3"  id="cardW3"  value=""  size="2" maxlength="2">-
  			<input type="text"  name="cardW4"  id="cardW4"  value=""  size="1" maxlength="1"> 	
  			</span>					
  	</td>
  </tr>
  <tr>
    <th>อีเมล์ <span class="alertred">*</span></th>
    <td><input name="usermail" type="text" class="input_box_patient " id="usermail" value="<?php echo @$rs['usermail'];?>" size="50" style="width:230px"></td>
  </tr>
  <tr>
  	<th>เบอร์ออฟฟิต <span class="alertred">*</span></th>
  	<td><input type="text" name="telephone" value="<?php echo @$rs['tel'] ?>" class="input_box_patient"> <small>ตัวอย่าง 02526666</small>
  	</td>
  </tr>
  <tr>
  	 <th>เบอร์ต่อ </th>
  	<td><input type="text" name="telphone_extend" value="<?php echo @$rs['tel_extend'] ?>" class="input_box_patient"></td>
  </tr>
  <tr>
  	<th>เบอร์มือถือ <span class="alertred">*</span></th>
  	<td><input type="text" name="mobile" value="<?php echo @$rs['mobile'] ?>" class="input_box_patient"> <small>ตัวอย่าง 0811234567</small></td>
  </tr>  		
  	<tr  id="hospital_level05" style="display:<? if(@@$rs['userposition']!='05' && @@$rs['userposition']!='03' ){echo 'none';}?>">
    <th valign="top"  >สถานพยาบาล </th>
    <td>
		<ul class="sublist">
			<li><label>จังหวัด <span class="alertred">*</span> </label>
				<?php
					echo form_dropdown('h_province',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['province_id2'],'class="styled-select" id="h_province"','-โปรดเลือก-')
				?>       
			</li>
			<li><label>อำเภอ <span class="alertred">*</span> </label>
					<span id="input_Hamphur">
	              <?php
		              	$wh=(@$rs['province_id2'])? " and province_id='".$rs['province_id2']."'":'';
						if($wh)
						{
							echo form_dropdown('h_amphur',get_option('amphur_id','amphur_name',"n_amphur where  amphur_id<>'' $wh  order by amphur_name asc"),@$rs['amphur_id'],'class="styled-select"  id="h_amphur"','-โปรดเลือก-');
						}else{				
					?>
						<select name="h_amphur" id="h_amphur" class="styled-select "><option value="">-โปรดเลือก-</option></select>
           			<?php }?>
          			</span> 
			</li>
			<li><label>ตำบล <span class="alertred">*</span> </label>
				<span id="input_District">
  					<?php
		              	$wh=(@$rs['province_id2'])? " and province_id='".$rs['province_id2']."' and amphur_id='".$rs['amphur_id']."' order by district_name asc":'';
						if($wh)
						{
							echo form_dropdown('h_district',get_option('district_id','district_name',"n_district where  district_id<>'' $wh "),@$rs['district_id'],'class="styled-select"  id="h_district"','-โปรดเลือก-');
						}else{				
					?>
						<select name="h_district" id="h_district" class="styled-select "><option value="">-โปรดเลือก-</option></select>
           			<?php }?>
          			</span> 				
				</span>
			</li>
			<li><label>สถานพยาบาล <span class="alertred">*</span> </label>
					<span id="input_Hospital">
		              <?php 
		              	$class='class="styled-select" id="userhospital"';
						$wh=(@$rs['amphur_id']!="")?"where hospital_province_id='".$rs['province_id2']."' and hospital_amphur_id='".$rs['amphur_id']."' and hospital_district_id='".$rs['district_id']."'":'';									
						if($wh){
							echo form_dropdown('userhospital',get_option('hospital_code','hospital_name',"n_hospital_1 $wh order by hospital_name asc"),@$rs['userhospital'],$class,'-โปรดเลือก-');
						}else{
					?>
						<select name="hospital" id="hospital" class="styled-select"><option value="">-โปรดเลือก-</option></select>
           			<?php } ?>
          		  </span> 
			</li>
		</ul>
     </td>
  </tr>
  <tr>
    <th>ชื่อผู้ใช้  <span class="alertred">*</span></th>
    <td><input type="text" name="username" class="input_box_patient " value="<?php echo @$rs['username'];?>" />
       </td>
  </tr>
	<?php $gen_pass=generate_password();	?> 
  <tr>
    <th >รหัสผ่าน </th>
    <td><span><?php echo (empty($rs['userpassword']))? $gen_pass:$rs['userpassword']?></span></td>
  </tr>
  <tr>
    <th >สร้าง / เปลี่ยน รหัสผ่าน <span class="alertred">*</span></th>
    <td><input type="password" id="userpassword" name="userpassword" class="input_box_patient " value="<?php echo (empty($rs['userpassword']))?$gen_pass: @$rs['userpassword'];?>">
        </td>
  </tr> 
  <tr>
    <th>ยืนยันรหัสผ่าน  <span class="alertred">*</span></th>
    <td><input type="password" name="repassword" class="input_box_patient " value="<?php echo (empty($rs['userpassword']))?$gen_pass: @$rs['userpassword'];?>">
       
        <input  id="position" name="position" value="<?php echo @$rs['userposition']?>" type="hidden" />
        </td>
  </tr>
  <tr>
  	<th></th>
  	<td><input type="submit" class="btn"  name="btn_sumbit" value="ตกลง"></td>
  </tr>
</table> 	
</form>
