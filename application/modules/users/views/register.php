<script type="text/javascript">
$(document).ready(function(){	
	$('input[name=userhospital]').next().addClass('alertred').html('');	
	
	$('#form1').validate({
	 	submitHandler:function(){
				alert("ddd");
		 	 	
		 },
		groups:{
			groupname:'firstname surname',
			groupidcard:'cardW0 cardW1 cardW2 cardW3 cardW4',
			grouptel:'tel0 tel1 tel2',
			groupmobile:'mobile0 mobile1 mobile2'
		},
		rules:{
			firstname:"required",surname:"required",
			tel0:"required",tel1:"required",tel2:"required",
			mobile0:"required",mobile1:"required",mobile2:"required",
			cardW0:"required",cardW1:"required",cardW2:"required",cardW3:"required",
			cardW4:{
				required:true,
				remote:{
		 				url:'<?php echo base_url(); ?>inform/chkidcard',		 				
				        data: {
				          idcard: function() { return $('#cardW0').val()+$('#cardW1').val()+$('#cardW2').val()+$('#cardW3').val()+$('#cardW4').val(); },
				          digit_last:function(){return $('#cardW4').val(); }
				        }
		 			}		 		
			},
			userhospital:{
				required:true,
				remote:{
					url:'<?php echo base_url(); ?>users/chkHospitalcode',
					type:'get',
					dataType:'json',					
					dataFilter:function(data){
						var json=JSON.parse(data);
						if(json.status=="true"){
							  $('input[name=userhospital]').next().removeClass('alertred').html(json.texts); 
							   return "true";
						}else{
							 $('input[name=userhospital]').next().addClass('alertred').html('');
							return "false";
						}						
					}	
				}
			},
			usermail:{
				required:true,
				email:true
			},
			password:"required",
			repassword:{
				equalTo: "#password"
			}
		},
		messages:{
			mobile0:"กรุณาระบุ",mobile1:"กรุณาระบุ",mobile2:"กรุณาระบุ",
			tel0:"กรุณาระบุ",tel1:"กรุณาระบุ",tel2:"กรุณาระบุ",
			firstname:"กรุณาระบุ",surname:"กรุณาระบุ",			
			cardW0:"กรุณาระบุ",	cardW1:"กรุณาระบุ",	cardW2:"กรุณาระบุ",	cardW3:"กรุณาระบุ",
			cardW4:{
				required:"กรุณาระบุ",
				remote:"กรุณาระบุให้ถูกต้อง"
			},
			userhospital:{
				required:'กรุณาระบุ',
				remote:'กรุณาระบุให้ถูกต้อง'
			},
			usermail:{
				required:"กรุณาระบุ",
				email:{
					required:"กรุณาระบุ",
					email:"กรุณาระบุให้ถูกต้อง"
				}
			},
			password:"กรุณาระบุ",
			repassword:"กรุณาระบุให้ตรงกัน"
		},
	 	errorPlacement: function(error, element) {
			if (element.attr("name") == "firstname" || element.attr("name") == "surname" ) {
				error.insertAfter("#surname");
			}else if(element.attr("name")=="cardW0" || element.attr("name")=="cardW1" || element.attr("name")=="cardW2" || element.attr("name")=="cardW3" || element.attr("name")=="cardW4"){
					error.insertAfter("#cardW4");
			}else if(element.attr('name')=="tel0" || element.attr('name')=="tel1" || element.attr('name')=="tel2"){
				error.insertAfter("#tel2");
			}else if(element.attr('name')=="mobile0" || element.attr('name')=="mobile1" || element.attr('name')=="mobile2"){
				error.insertAfter("#mobile2");
			}			
			else {
				error.insertAfter(element);
			}
		}
	});

});
</script>
<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li>ลงทะเบียน</li>
</ul>	
<div id="register">
<div id="span9">
<div class="row">
		<form action="users/signup" method="post" class="form-horizontal" id="form1">
 			<div class="control-group">
 				<label class="control-label" for="inputEmail">รหัสหน่วยงาน 9 หลัก<label class="alertred">*</label></label>
				<div class="controls">
					<input type="text" class="input-medium" placeholder="รหัสหน่วยงาน 9 หลัก" name="userhospital"  maxlength="9">
						
							
				</div>	
					
 				<label class="control-label" for="inputEmail">อีเมล์<label class="alertred">*</label></label>
				<div class="controls">
					<input type="text"  placeholder="อีเมล์" name="usermail" class="input-large"> 
				</div>
 				<label class="control-label" for="inputEmail">รหัสผ่าน<label class="alertred">*</label></label>
				<div class="controls">
					<input type="password"  placeholder="รหัสผ่าน" class="input-large"  name="password" id="password" class="input-large">
				</div>
 				<label class="control-label" for="inputEmail">ยืนยันรหัสผ่าน<label class="alertred">*</label></label> 
				<div class="controls">
					<input type="password"  placeholder="ยืนยันรหัสผ่าน" class="input-large"  name="repassword" class="input-large">
				</div>		
 			</div>
 			<hr class="hr1">
 			<div class="control-group">
				<label class="control-label" for="idcard">เลขประจำตัวประชาชน<label class="alertred">*</label></label>
				<div class="controls" id="Show_idcard">
					<input type="text" id="cardW0"  name="cardW0" style="width:10px;" size="1" maxlength="1">
					<input type="text" id="cardW1"  name="cardW1" style="width:30px;" size="4" maxlength="4">
					<input type="text" id="cardW2"  name="cardW2" style="width:40px;" size="5" maxlength="5">
					<input type="text" id="cardW3"  name="cardW3" style="width:20px;" size="2" maxlength="2">
					<input type="text" id="cardW4"  name="cardW4" style="width:10px;" size="1" maxlength="1">					
				
				</div>			
				<label class="control-label" for="inputFirstame">ชื่อ -นามสกุล<label class="alertred">*</label></label>
				<div class="controls">
					<input type="text" id="firstname" class="input-medium" placeholder="ชื่อ" name="fisrtname">
					<input type="text" id="surname" class="input-medium" placeholder="นามสกุล" name="surname"> 
				</div>				
				<br/>
				<label class="control-label" for="inputPostion">ตำแหน่ง</label>
				<div class="controls">					
					<?php echo form_dropdown('position',get_option('id','name','n_position'),'','','--กรุณาระบุ--') ?>
				</div>

				<label class="control-label" for="inputEmail">โทรศัพท์มือถือ<label class="alertred">*</label></label>
				<div class="controls">
					<input type="text" name="mobile0"  maxlength="3"  style="width:40px;" placeholder="08x" > -<input type="text" name="mobile1"  maxlength="3"  style="width:50px;"> -<input type="text" name="mobile2"  id="mobile2"  maxlength="4"  style="width:60px;">					
					
				</div>
				<label class="control-label" for="inputEmail">โทรศัพท์สำนักงาน<label class="alertred">*</label></label>
				<div class="controls">
					<input type="text" name="tel0" maxlength="1"  style="width:15px;"> -<input type="text" name="tel1" maxlength="4" style="width:60px;"> -<input type="text" name="tel2" id="tel2" maxlength="4" style="width:60px;"> 				
					
					 ต่อ <input type="text" name="telephone_extend" style="width:30px;"> 
				</div>
				<label class="control-label" for="inputEmail">โทรสาร</label>
				<div class="controls">
					<input type="text" name="fax0" maxlength="1"  style="width:15px;"> -<input type="text" name="fax1" maxlength="4" style="width:60px;"> -<input type="text" name="fax2" id="fax2" maxlength="4" style="width:60px;"> 					
				</div>
				<div id="boxAdd"><button class="btn btn-primary" type="submit">ลงทะเบียน</button></div>
			</div>	
			<hr class="hr1">
			<small><label class="alertred">*</label>รายการที่ต้องกรอก</small>
		</form>
</div>
</div>
</div><!-- register -->

