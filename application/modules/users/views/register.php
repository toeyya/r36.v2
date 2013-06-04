<script type="text/javascript">
$(document).ready(function(){	
	$('input[name=userhospital]').next().addClass('alertred').html('');	
	$('#form1').validate({
		rules:{
			userhospital:{
				required:true,
				remote:{
					url:'<?php echo base_url(); ?>users/chkHospitalcode',
					type:'get',
					complete: function(data){
					     if (data.responseText == "false") $('input[name=userhospital]').next().addClass('alertred').html('');
					     else $('input[name=userhospital]').next().removeClass('alertred').html(data.responseText); 
					      	 					    
					}				
				}
			},
			usermail:{
				required:true,email:true
			},
			password:"required",
			repassword:{
				equalTo: "#password"
			}
		},
		messages:{
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
		}
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
 				<label class="control-label" for="inputEmail">รหัสหน่วยงาน 9 หลัก</label>
				<div class="controls">
					<input type="text" class="input-medium" placeholder="รหัสหน่วยงาน 9 หลัก" name="userhospital"  maxlength="9">
					<label class="alertred">*</label>		
							
				</div>	
					
 				<label class="control-label" for="inputEmail">อีเมล์</label>
				<div class="controls">
					<input type="text"  placeholder="อีเมล์" name="usermail" class="input-large"> <label class="alertred">*</label>
				</div>
 				<label class="control-label" for="inputEmail">รหัสผ่าน</label>
				<div class="controls">
					<input type="text"  placeholder="รหัสผ่าน" class="input-medium"  name="password" id="password" class="input-large"> <label class="alertred">*</label>
				</div>
 				<label class="control-label" for="inputEmail">ยืนยันรหัสผ่าน</label> 
				<div class="controls">
					<input type="text"  placeholder="ยืนยันรหัสผ่าน" class="input-medium"  name="repassword" class="input-large"> <label class="alertred">*</label>
				</div>		
 			</div>
				<div id="boxAdd"><button class="btn btn-primary" type="submit">ลงทะเบียน</button></div>
			</div>	
			<hr class="hr1">		
		</form>
</div>
</div>
</div><!-- register -->

