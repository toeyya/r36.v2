<script type="text/javascript">
$(document).ready(function(){
var ref1,ref2,ref3,province_id;
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
		$.ajax({url:'<?php echo base_url(); ?>district/getDistrict',type:'get',data:'name=h_district&ref1='+ref1+'&ref2='+ref2,success:function(data){$("#input_district").html(data);}});	
	});			
	$('#h_district').live('change',function(){
		ref3=$("#h_district option:selected").val();
		$.ajax({url:'<?php echo base_url(); ?>hospital/getHospital',type:'get',data:'name=userhospital&ref1='+ref1+'&ref2='+ref2+'&ref3='+ref3,success:function(data){$("#input_hospital").html(data);}});	
	});	
	$('#userprovince').change(function(){
		province_id=$('#userprovince option:selected').val();
		var txt = $("#userprovince option:selected").text();
		$('.agency_name').html('');$('input[name=agency]').val('');		
		$('.agency_name').html('สำนักงานสาธารณสุขจังหวัด'+txt);
		$('input[name=agency]').val('สำนักงานสาธารณสุขจังหวัด'+txt);
		$.ajax({
			url:'<?php echo base_url(); ?>district/getAmphur',
			type:'get',
			data:'name=useramphur&ref1='+province_id,
			success:function(data){
				$('#user_amphur').html(data);
				
			}
		})
	});
	$('#useramphur').live('change',function(){
		var amphur_id = $("#useramphur option:selected").val();
		var txt = $("#useramphur option:selected").text();
		$('.agency_name').html('');$('input[name=agency]').val('');
		$('.agency_name').html('สำนักงานสาธารณสุขอำเภอ'+txt);$('input[name=agency]').val('สำนักงานสาธารณสุขอำเภอ'+txt);
		$.ajax({
			url:'<?php echo base_url(); ?>district/getDistrict',
			type:'get',
			data:'name=userdistrict&ref1='+province_id+'&ref2='+amphur_id,
			success:function(data){
				$("#user_district").html(data);
				
			}
		});	
	});
	$('#userdistrict').live('change',function(){
		var txt = $('#userdistrict option:selected').text();
		$('.agency_name').html('');$('input[name=agency]').val('');
		$('.agency_name').html('สำนักงานสาธารณสุขตำบล'+txt);
		$('input[name=agency]').val('สำนักงานสาธารณสุขตำบล'+txt);
	})

	
    function u_position(){  
    	$('#admin_province,#user_amphur,#user_district,#hospital,#agency,#level').hide(); 	
				var value=$('select[name=userposition] option:selected').val();
				if(value=="05"){
					$("#hospital").show();
					$('#admin_province,#user_amphur,#user_district,#agency,#level').hide();
				}else if(value=="02"){//จังหวัด
					$('#admin_province,#agency').show();
					$('#hospital,#user_amphur,#user_district,#level').hide();
										
				}else if(value =="03"){//อำเภอ
					$('#admin_province,#user_amphur,#agency').show();
					$('#hospital,#level,#user_district').hide();						
													
				}else if(value=="04"){// ตำบล
					$('#hospital,#level').hide();
					$('#admin_province,#user_amphur,#user_district,#agency').show();
						
				}else if(value=="00" || value=="01"){// กรมและเขต
					$('#admin_province,#user_amphur,#user_district,#hospital,#agency,#level').hide();
					if(value=="01"){
						$('#level').show();
					}
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
				          uid:function(){return $('#uid').val();}
				        }
		 			}		 		
		 		}			 					
				,userfirstname:"required",usersurname:"required"
				,userprovince:{ required: {depends: function(element) {return $('select[name=userposition] option:selected').val() =='02' }}}
				,userlevel:{required:{depends:function(element){return $('select[name=userposition] option:selected').val()=="01"}}}
				,useramphur:{required:{depends:function(element){return $('select[name=userposition] option:selected').val()=="03"}}}
				,userdistrict:{required:{depends:function(element){return $('select[name=userposition] option:selected').val()=="04"}}}
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
			    telephone:{required:"กรุณาระบุค่ะ",number:"กรุณาระบุเฉพาะตัวเลขค่ะ",rangelength:"ระบุความยาวอักษร 6-9 ตัวอักษรเท่านั้นค่ะ"}
			    ,mobile:{required:"กรุณาระบุค่ะ",number:"กรุณาระบุเฉพาะตัวเลขค่ะ",rangelength:"ระบุความยาวอักษร 6-9 ตัวอักษรเท่านั้นค่ะ"}
				,cardW0:{required:" กรุณาระบุค่ะ",number: " กรุณาระบุเป็นตัวเลขค่ะ"}
		 		,cardW1:{required:" กรุณาระบุค่ะ",number: " กรุณาระบุเป็นตัวเลขค่ะ"}
		 		,cardW2:{required:" กรุณาระบุค่ะ",number: " กรุณาระบุเป็นตัวเลขค่ะ"}
		 		,cardW3:{required:" กรุณาระบุค่ะ",number: " กรุณาระบุเป็นตัวเลขค่ะ"}
		 		,cardW4:{required:" กรุณาระบุค่ะ",number: " กรุณาระบุเป็นตัวเลขค่ะ",remote :" มีในระบบแล้วหรือระบุไม่ถูกต้อง"}	
				,userfirstname:" กรุณาระบุด้วยค่ะ",usersurname:" กรุณาระบุด้วยค่ะ"
				,userlevel:" กรุณาระบุด้วยค่ะ",userprovince:" กรุณาระบุด้วยค่ะ",useramphur:" กรุณาระบุด้วยค่ะ",userdistrict:" กรุณาระบุด้วยค่ะ"
				,usermail:{required:" กรุณาระบุด้วยค่ะ",email:" ระบุไม่ถูกต้องค่ะ",remote:"มีอีเมล์นี้แล้วในระบบ"}
				,h_province:" กรุณาระบุด้วยค่ะ",h_amphur:" กรุณาระบุด้วยค่ะ",h_district:"กรุณาระบุด้วยค่ะ",userhospital:" กรุณาระบุด้วยค่ะ"
				,userpassword:" กรุณาระบุด้วยค่ะ"
				,repassword:{required:" กรุณาระบุด้วยค่ะ",equalTo: " ระบุ password ไม่ถูกต้องค่ะ"}
		},
		errorPlacement: function(error, element){							    
        		 if (element.attr("name") == "cardW0"  || element.attr("name") == "cardW1" 	|| element.attr('name') == "cardW2" || element.attr('name')=="cardW3" || element.attr('name')=="cardW4") error.insertAfter("#cardW4");       		 
        		 else error.insertAfter(element);
		}						
	});
		
	
});// document
</script>
<h1>ผู้ใช้ระบบ</h1>
<form name="form1" id="form1" action="users/admin/users/save/<?php echo $profile ?>" enctype="multipart/form-data" method="post" >
<input name="uid" id="uid" type="hidden" value="<?php echo @$rs['uid']?>" />	
		
<table  class="form">
  <tr>
  	<th>สิทธิ์การใช้งาน</th>
  	<?php if($profile): ?>
  	<td><?php echo $rs['level_name']; ?>
  		<input type="hidden" name="userposition" value="<?php echo @$rs['userposition'] ?>">
  	</td>
  	<?php else: ?>
  	<td><?php echo form_dropdown('userposition',get_option("level_code",'level_name','n_level_user'),@$rs['userposition'],$disabled,''); ?></td>
  	<?php endif; ?>
  </tr>
  <tr id="level"><th>เขต <span class="alertred" >*</span></th>
  	<td><?php echo form_dropdown('userlevel',getLevel('2','12'),@$rs['userlevel'],'','-โปรดเลือก-'); ?></td>
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
  	<td><span  id="Show_idcard">
  			<input type="text" name="cardW0"  id="cardW0"  value="<?php echo @$cardW0; ?>"  size="1" maxlength="1" style="width:15px;">-
  			<input type="text" name="cardW1"  id="cardW1"  value="<?php echo @$cardW1; ?>"  size="4" maxlength="4" style="width:30px;">-
  			<input type="text" name="cardW2"  id="cardW2"  value="<?php echo @$cardW2?>"  size="5" maxlength="5" style="width:40px;">-
  			<input type="text" name="cardW3"  id="cardW3"  value="<?php echo @$cardW3 ?>"  size="2" maxlength="2" style="width:20px;">-
  			<input type="text" name="cardW4"  id="cardW4"  value="<?php echo @$cardW4?>"  size="1" maxlength="1" style="width:15px;"> 	
  			</span>	
  						
  	</td>
  </tr>
  <tr>
    <th>อีเมล์ <span class="alertred">*</span></th>
    <td><input name="usermail" type="text"  id="usermail" value="<?php echo @$rs['usermail'];?>" size="50" style="width:230px"></td>
  </tr>
  <tr>
  	<th>โทรศัพท์สำนักงาน <span class="alertred">*</span></th>
  	<td><input type="text" name="telephone" value="<?php echo @$rs['telephone'] ?>"> ต่อ <input type="text" name="telphone_extend" value="<?php echo @$rs['tel_extend'] ?>" class="input_box_patient" style="width:30px;"></td>
  </tr>
  <tr>
  	<th>โทรศัพท์มือถือ <span class="alertred">*</span></th>
  	<td><input type="text" name="mobile" value="<?php echo @$rs['mobile'] ?>"> </td>
  </tr> 
  <tr>
  	<th>โทรสาร </th>
  	<td><input type="text" name="fax" value="<?php echo @$rs['fax'] ?>"> </td>
  </tr> 
   <tr>
  	 <th>ตำแหน่ง </th>
  	<td><?php echo form_dropdown('position',get_option('id','name','n_position'),@$rs['position'],'','--กรุณาระบุ--') ?></td>
  </tr>
  <tr id="admin_province">
	<th>หน่วยงาน (จังหวัด / อำเภอ / ตำบล)  <span class="alertred">*</span></th>
	<td><?php echo form_dropdown('userprovince',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['userprovince'],'id="userprovince"','-โปรดเลือก-')?>
      <p id="user_amphur" style="margin:7px 0px;">
      <?php
          	$wh=(!empty($rs['userprovince']))? " and province_id='".$rs['userprovince']."'":'';
			if($wh)
			{
				echo form_dropdown('useramphur',get_option('amphur_id','amphur_name',"n_amphur where  amphur_id<>'' $wh  order by amphur_name asc"),@$rs['useramphur'],' id="useramphur"','-โปรดเลือก-');
			}else{				
		?>		
		<select name="useramphur"><option value="">-โปรดเลือก-</option></select>
		<?php } ?></p>
		<p id="user_district">
		<?php
          	$wh=(!empty($rs['useramphur']))? " and province_id='".$rs['userprovince']."' and amphur_id='".$rs['useramphur']."' order by district_name asc":'';
			if($wh)
			{
				echo form_dropdown('userdistrict',get_option('district_id','district_name',"n_district where  district_id<>'' $wh "),@$rs['userdistrict'],' id="userdistrict"','-โปรดเลือก-');
			}else{				
		?>									
			<select name="userdistrict"><option value="">-โปรดเลือก-</option></select>
		<?php } ?></p>
		<p id="agency" style="margin:7px 0px;font-weight: bold">
			<span class="agency_name"><?php echo @$rs['agency']; ?></span>
		</p>
		<input type="hidden" name="agency" value="<? echo @$rs['agency'] ?>">
	</td> 	
  </tr>
  	<tr  id="hospital">
    <th valign="top">สถานพยาบาล <span class="alertred">*</span></th>
    <td>
		<ul class="sublist">
			<li><label>จังหวัด  </label>
				<?php
					echo form_dropdown('h_province',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['province_id2'],'id="h_province"','-โปรดเลือก-')
				?>       
			</li>
			<li><label>อำเภอ </label>
					<span id="input_amphur">
	              <?php
		              	$wh=(!empty($rs['province_id2']))? " and province_id='".$rs['province_id2']."'":'';
						if($wh)
						{
							echo form_dropdown('h_amphur',get_option('amphur_id','amphur_name',"n_amphur where  amphur_id<>'' $wh  order by amphur_name asc"),@$rs['hospital_amphur_id'],' id="h_amphur"','-โปรดเลือก-');
						}else{				
					?>
						<select name="h_amphur" id="h_amphur" class="styled-select "><option value="">-โปรดเลือก-</option></select>
           			<?php }?>
          			</span> 
			</li>
			<li><label>ตำบล </label>
				<span id="input_district">
  					<?php
		              	$wh=(!empty($rs['province_id2']))? " and province_id='".$rs['province_id2']."' and amphur_id='".$rs['hospital_amphur_id']."' order by district_name asc":'';
						if($wh)
						{
							echo form_dropdown('h_district',get_option('district_id','district_name',"n_district where  district_id<>'' $wh "),@$rs['hospital_district_id'],' id="h_district"','-โปรดเลือก-');
						}else{				
					?>
						<select name="h_district" id="h_district" class="styled-select "><option value="">-โปรดเลือก-</option></select>
           			<?php }?>
          			</span> 				
				</span>
			</li>
			<li><label>สถานพยาบาล </label>
					<span id="input_hospital">
		              <?php 
		              	$class=' id="userhospital"';
						$wh=(!empty($rs['hospital_amphur_id']))?"where hospital_province_id='".$rs['province_id2']."' and hospital_amphur_id='".$rs['hospital_amphur_id']."' and hospital_district_id='".$rs['hospital_district_id']."'":'';									
						if($wh){
							echo form_dropdown('userhospital',get_option('hospital_code','hospital_name',"n_hospital_1 $wh order by hospital_name asc"),$rs['userhospital'],$class,'-โปรดเลือก-');
						}else{
					?>
						<select name="hospital" id="hospital" class="styled-select"><option value="">-โปรดเลือก-</option></select>
           			<?php } ?>
          		  </span> 
			</li>
		</ul>
     </td>
  </tr>

	<?php //$gen_pass=generate_password();	?> 
  <!--<tr>
    <th >รหัสผ่าน </th>
    <td><span><?php echo (empty($rs['userpassword']))? $gen_pass:$rs['userpassword']?></span></td>
  </tr>-->
  <tr>
    <th >รหัสผ่าน <span class="alertred">*</span></th>
    <td><input type="password" id="userpassword" name="userpassword" class="input_box_patient " value="<?php echo (empty($rs['userpassword']))?$gen_pass: @$rs['userpassword'];?>">
        <input type="hidden" name="pp" value="<?php echo @$rs['userpassword']; ?>"> 
        </td>
  </tr> 
  <tr>
    <th>ยืนยันรหัสผ่าน  <span class="alertred">*</span></th>
    <td><input type="password" name="repassword" class="input_box_patient " value="<?php echo (empty($rs['userpassword']))?$gen_pass: @$rs['userpassword'];?>"></td>
  </tr>

  <?php if(!$profile): ?>
  <?php if($this->session->userdata('R36_LEVEL')=="00" || $this->session->userdata('R36_LEVEL')=="02"): ?>
   <tr><th>การอนุมัติของผู้ดูแลระดับจังหวัด</th>
  	<td><input type="checkbox" name="confirm_province" value="1"  <?php echo(!empty($rs['confirm_province']))?'checked="checked"':''; ?>></td>  	
  </tr>
   <?php if($this->session->userdata('R36_LEVEL')=="00"): ?> 
  
  <tr><th>การอนุมัติของผู้ดูแลระดับกรม</th>
  	<td><input type="checkbox" name="confirm_admin"  value="1"  <?php echo(!empty($rs['confirm_admin']))?'checked="checked"':''; ?>></td>
  </tr>
  <tr><th>การเข้าใช้ระบบสารสนเทศ ฯ(GIS)</th>
  	<td><input type="checkbox" name="login_gis" value="1"></td>
  </tr>
  <tr><th>การยืนยันอีเมล์</th><td><?php echo (!empty($rs['confirm_email']))? img(array('src'=>'media/images/checkmark.png','width'=>'16px','height'=>'16px')):img(array('src'=>'media/images/crossmark.png','width'=>'16px','height'=>'16px')); ?></td></tr>
  <tr><th>ส่งอีเมล์แจ้งอนุมัติ</th>
  	<td><input type="checkbox" name="send_mail" value="1"></td>
  </tr>
  <?php endif ?>
<?php endif; ?>
<? endif; //profile ?>
  <tr>
  	<th></th>
  	<td><input type="submit" class="btn"  name="btn_sumbit" value="ตกลง">
  		<?php echo form_back('btn_back'); ?>
  	</td>
  </tr>
</table> 	
</form>
