<script type="text/javascript">
$(document).ready(function(){
var ref1,ref2,ref3;
	$("#h_province").change(function(){	
		 ref1=$("#h_province option:selected").val();
		 $('#input_amphur').html('<img src="media/images/loader.gif" width="16px" height="11px"/>');
		$.ajax({
			url:'<?php echo base_url() ?>users/getAmphur',data:'name=h_amphur&ref1='+ref1,
			success:function(data)
			{
				$("#input_amphur").html(data);
				$("#hosptal option[value='']").attr('selected','selected');
			}
		});
	});
	$("#h_amphur").live('change',function(){	
	 	ref2=$("#h_amphur option:selected").val();
	 	$('#input_district').html('<img src="media/images/loader.gif" width="16px" height="11px"/>');
		$.ajax({url:'<?php echo base_url(); ?>users/getDistrict',data:'name=h_district&ref1='+ref1+'&ref2='+ref2,success:function(data){$("#input_district").html(data);}});	
	});			
	$('#h_district').live('change',function(){
		ref3=$("#h_district option:selected").val();
		$('#input_hospital').html('<img src="media/images/loader.gif" width="16px" height="11px"/>');
		$.ajax({url:'<?php echo base_url(); ?>users/getHospital',data:'name=userhospital&ref1='+ref1+'&ref2='+ref2+'&ref3='+ref3,success:function(data){$("#input_hospital").html(data);}});	
	});	
		
	 $.validator.setDefaults({
	 	submitHandler:function(){
	 	 document.form1.submit();	 	 			 				 	
	 	}
	 });

	$('#form1').validate({
		groups:{
			groupname:'userfirstname usersurname',
			groupidcard:'cardW0 cardW1 cardW2 cardW3 cardW4',
			grouptel:'tel0 tel1 tel2',
			groupmobile:'mobile0 mobile1 mobile2'
		},
		rules:{
			userhospital:"required",
			userfirstname:"required",usersurname:"required",
			tel0:{required:true,number:true},tel1:{required:true,number:true,minlength:3},tel2:{required:true,number:true,minlength: 4},
			mobile0:{required:true,number:true,minlength:3},mobile1:{required:true,number:true,minlength:3},mobile2:{required:true,number:true,minlength: 4},
			cardW0:{required:true,number:true},cardW1:{required:true,number:true,minlength:4},
			cardW2:{required:true,number:true,minlength:5},cardW3:{required:true,number:true,minlength:2},
		 	cardW4:{required:true,number:true,	 		
		 			remote:{
		 				url:'<?php echo base_url(); ?>users/chkidcard/register',
		 				type:'get',
				        data: {
				          
				          idcard: function() { return $('#cardW0').val()+$('#cardW1').val()+$('#cardW2').val()+$('#cardW3').val()+$('#cardW4').val(); },
				          digit_last:function(){return $('#cardW4').val(); }
				        }
		 			}		 		
		 	},   
						
			usermail:{required:true,email:true,
				remote:{url:'<?php echo base_url()?>users/checkEmail'}
			},
			userpassword:"required",
			repassword:{equalTo: "#userpassword"},
	        captcha:{required: true,remote: "users/check_captcha"}			
		},
		messages:{
			userhospital:"กรุณาระบุ",
			mobile0:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข",minlength:"กรุณาระบุให้ครบถ้วน"},mobile1:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข",minlength: "กรุณาระบุให้ครบถ้วน"},mobile2:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข",minlength: "กรุณาระบุให้ครบถ้วน"},
			tel0:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข"},tel1:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข",minlength:"กรุณาระบุให้ครบถ้วน"},tel2:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข",minlength: "กรุณาระบุให้ครบถ้วน"},
			userfirstname:"กรุณาระบุ",usersurname:"กรุณาระบุ",			
			cardW0:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข"},cardW1:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข",minlength:"กรุณาระบุให้ครบถ้วน"},	
			cardW2:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข",minlength:"กรุณาระบุให้ครบถ้วน"},cardW3:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข",minlength:"กรุณาระบุให้ครบถ้วน"},
			cardW4:{required:"กรุณาระบุ",number:"กรุณาระบุด้วยตัวเลข",remote:"กรุณาระบุให้ถูกต้อง หรือมีอยู่แล้วในระบบ"},
			userhospital:'กรุณาระบุ',
			usermail:{required:"กรุณาระบุ",email:"กรุณาระบุให้ถูกต้อง",remote:'มีอีเมล์นี้แล้ว'},
			userpassword:"กรุณาระบุ",
			repassword:"กรุณาระบุให้ตรงกัน",
        	captcha:{required: "กรุณากรอกตัวอักษรตัวที่เห็นในภาพ",remote: "กรุณากรอกตัวอักษรให้ตรงกับภาพ"}
		},
	 	errorPlacement: function(error, element) {
			if (element.attr("name") == "userfirstname" || element.attr("name") == "usersurname" ) {
				error.insertAfter("#usersurname");
			}else if(element.attr("name")=="cardW0" || element.attr("name")=="cardW1" || element.attr("name")=="cardW2" || element.attr("name")=="cardW3" || element.attr("name")=="cardW4"){
					error.insertAfter("#cardW4");
			}else if(element.attr('name')=="tel0" || element.attr('name')=="tel1" || element.attr('name')=="tel2"){
				error.insertAfter("#tel2");
			}else if(element.attr('name')=="mobile0" || element.attr('name')=="mobile1" || element.attr('name')=="mobile2"){
				error.insertAfter("#mobile2");
			}			
			else {
				error.insertAfter(element);
				$('.shw-name').html('');
			}
		}
	});

 	$('#mobile').children().bind('keydown',function(e){											
		if(e.keyCode != 46 && e.keyCode!=8){														
			var txtBox=$('#mobile').children();
			var key=$(this).index();
				if(key==0 || key==1)l=3;
				if(key==2)l=4;														
				if(txtBox.eq(key).val().length==l){			
					txtBox.eq(key+1).val('');
					txtBox.eq(key+1).focus();			
				}																					
			}							
	});
 	$('#tel').children().bind('keydown',function(e){											
		if(e.keyCode != 46 && e.keyCode!=8){														
			var txtBox=$('#tel').children();
			var key=$(this).index();
				if(key==0)l=1;
				if(key==1)l=4;
				if(key==2)l=4;															
				if(txtBox.eq(key).val().length==l){			
					txtBox.eq(key+1).val('');
					txtBox.eq(key+1).focus();			
				}																					
			}							
	});
 	$('#fax').children().bind('keydown',function(e){											
		if(e.keyCode != 46 && e.keyCode!=8){														
			var txtBox=$('#fax').children();
			var key=$(this).index();
				if(key==0)l=1;
				if(key==1)l=4;
				if(key==2)l=4;															
				if(txtBox.eq(key).val().length==l){			
					txtBox.eq(key+1).val('');
					txtBox.eq(key+1).focus();			
				}																					
			}							
	});
});
</script>
<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li>ลงทะเบียน</li>
</ul>
<h1>ลงทะเบียน</h1>	
<div id="register">
<div class="alert alert-info"><strong>ประกาศ !! </strong>เมื่อลงทะเบียนแล้ว กรุณายืนยันการลงทะเบียนจากลิงค์ในอีเมล์ และรอการตรวจสอบก่อน จึงจะใช้งานได้</div>
<div id="span9">
<div class="row">
		<form action="users/signup"  method="post"  class="form-horizontal" id="form1">
 			<div class="control-group">
 				<label class="control-label" for="inputEmail">สถานบริการ<label class="alertred">*</label></label>
				<div class="controls">
				 <?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),'','id="h_province"','--กรุณาเลือกจังหวัด--'); ?>								 											
				</div>
				<label class="control-label" for="inputEmail">&nbsp;</label>
				<div class="controls">
					 <span id="input_amphur"><select name="amphur_id"><option value="">--กรุณาเลือกอำเภอ--</option></select></span>	
				</div>
				<label class="control-label" for="inputEmail">&nbsp;</label>
				<div class="controls">
					 <span id="input_district"><select name="district_id"><option value="">--กรุณาเลือกตำบล--</option></select></span>
				</div>
				<label class="control-label" for="inputEmail">&nbsp;</label>
				<div class="controls">
					 <span id="input_hospital"><select name="userhospital"><option value="">--กรุณาเลือกสถานบริการ--</option></select></span>
				</div>								
 				<label class="control-label" for="inputEmail">อีเมล์<label class="alertred">*</label></label>				
				<div class="controls">
					<input type="text"  placeholder="อีเมล์" name="usermail" class="input-large" value=""> 
				</div>
 				<label class="control-label" for="inputEmail">รหัสผ่าน<label class="alertred">*</label></label>
				<div class="controls">
					<input type="password"  placeholder="รหัสผ่าน" class="input-large"  name="userpassword" id="userpassword" class="input-large" value="">
				</div>
 				<label class="control-label" for="inputEmail">ยืนยันรหัสผ่าน<label class="alertred">*</label></label> 
				<div class="controls">
					<input type="password"  placeholder="ยืนยันรหัสผ่าน" class="input-large"  name="repassword" class="input-large" value="">
				</div>		
 			</div>
 			<hr class="hr1">
 			<div class="control-group">
				<label class="control-label" for="idcard">เลขประจำตัวประชาชน<label class="alertred">*</label></label>
				<div class="controls" id="Show_idcard">
					<input type="text" id="cardW0"  name="cardW0" style="width:10px;" size="1" maxlength="1" value="">
					<input type="text" id="cardW1"  name="cardW1" style="width:30px;" size="4" maxlength="4" value="">
					<input type="text" id="cardW2"  name="cardW2" style="width:40px;" size="5" maxlength="5" value="">
					<input type="text" id="cardW3"  name="cardW3" style="width:20px;" size="2" maxlength="2" value="">
					<input type="text" id="cardW4"  name="cardW4" style="width:10px;" size="1" maxlength="1" value="">					
				
				</div>			
				<label class="control-label" for="inputFirstame">ชื่อ -นามสกุล<label class="alertred">*</label></label>
				<div class="controls">
					<input type="text" id="userfirstname" class="input-medium" placeholder="ชื่อ" name="userfirstname" value="">
					<input type="text" id="usersurname" class="input-medium" placeholder="นามสกุล" name="usersurname" value=""> 
				</div>				
				<br/>
				<label class="control-label" for="inputPostion">ตำแหน่ง</label>
				<div class="controls">					
					<?php echo form_dropdown('position',get_option('id','name','n_position'),'','','--กรุณาระบุ--') ?>
				</div>

				<label class="control-label" for="inputEmail">โทรศัพท์มือถือ<label class="alertred">*</label></label>
				<div class="controls">
					<span id="mobile">
					<input type="text" name="mobile0"  maxlength="3"  style="width:40px;" placeholder="08x"> -<input type="text" name="mobile1"  maxlength="3"  style="width:50px;"> -<input type="text" name="mobile2"  id="mobile2"  maxlength="4"  style="width:60px;">										
					</span>
				</div>
				<label class="control-label" for="inputEmail">โทรศัพท์สำนักงาน<label class="alertred">*</label></label>
				<div class="controls">
					<span id="tel">
					<input type="text" name="tel0" maxlength="1"  style="width:15px;"> -<input type="text" name="tel1" maxlength="4" style="width:60px;"> -<input type="text" name="tel2" id="tel2" maxlength="4" style="width:60px;"> 				
					</span>
					 ต่อ <input type="text" name="telephone_extend" style="width:30px;"> 
				</div>
				<label class="control-label" for="inputEmail">โทรสาร</label>
				<div class="controls">
					<span id="fax">
					<input type="text" name="fax0" maxlength="1"  style="width:15px;"> -<input type="text" name="fax1" maxlength="4" style="width:60px;"> -<input type="text" name="fax2" id="fax2" maxlength="4" style="width:60px;"> 					
					</span>
				</div>
            <div class="control-group">
 
              <label class="control-label" for="inputCaptcha">รหัสลับ <span class="alertred">*</span></label>
                <div class="controls">
                  <img src="users/captcha" /><Br>
                  <input class="input-small" type="text" name="captcha" id="inputCaptcha" placeholder="รหัสลับ">
                </div>
            </div>
				
             <label class="control-label" for="inputCaptcha"></label>
                <div class="controls">
 				<?php echo form_hidden('created',date('Y-m-d H:i:s')); ?>
				<button class="btn btn-primary" type="submit">ลงทะเบียน</button></div>
			</div>	
			<hr class="hr1">
			<small><label class="alertred">*</label>รายการที่ต้องกรอก</small>
		</form>
</div>
</div>
</div><!-- register -->

