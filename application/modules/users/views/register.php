<script type="text/javascript">
$(document).ready(function(){
	alert("ddd");
	$('#form1').validate({
		debug:true,
		groups:{
			groupname:'firstname surname',
			groupidcard:'cardW0 cardW1 cardW2 cardW3 cardW4'
		},
		rules:{
			firstname:"required",surname:"required",
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
					url:'<?php echo base_url(); ?>users/chkHospitalcode'
				}
			},
			email:{
				require:true,
				email:true
			},
			password:"required",
			repassword:{
				equalTo: "#password"
			}
		},
		messages:{
			firstname:"กรุณาระบุด้วยค่ะ",surname:"กรุณาระบุด้วยค่ะ",			
			cardW0:"กรุณาระบุให้ครบถ้วนค่ะ",	cardW1:"กรุณาระบุให้ครบถ้วนค่ะ",	cardW2:"กรุณาระบุให้ครบถ้วนค่ะ",	cardW3:"กรุณาระบุให้ครบถ้วนค่ะ",
			cardW4:{
				required:"กรุณาระบุให้ครบถ้วนค่ะ",
				remote:"กรุณาระบุให้ถูกต้องค่ะ"
			},
			userhospital:{
				required:'กรุณาระบุด้วยค่ะ',
				remote:'กรุณาให้ถูกต้องค่ะ'
			},
			email:{
				required:"กรุณาระบุอีเมล์ด้วยค่ะ",
				email:{
					required:"กรุณาระบุด้วยค่ะ",
					email:"กรุณาระบุให้ถูกต้องค่ะ"
				}
			},
			password:"กรุณาระบุด้วยค่ะ",
		},
	 	errorPlacement: function(error, element) {
			if (element.attr("name") == "firstname" || element.attr("name") == "surname" ) {
				error.insertAfter("#surname");
			}else if(element.attr("name")=="cardW0" || element.attr("name")=="cardW1" || element.attr("name")=="cardW2" || element.attr("name")=="cardW3" || element.attr("name")=="cardW4"){
					error.insertAfter("#cardW4");
			}else {
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
<div class="row">
		<form action="users/signup" method="post" class="form-horizontal" id="form1">
 			<div class="control-group">
 				<label class="control-label" for="inputEmail">รหัสหน่วยงาน 9 หลัก</label>
				<div class="controls">
					<input type="text"  placeholder="รหัสหน่วยงาน 9 หลัก" name="userhospital" class="input-large" maxlength="9">
					<label class="alertred">*</label>	
					<label class="alertred"></label>			
				</div>
								
 				<label class="control-label" for="inputEmail">อีเมล์</label>
				<div class="controls">
					<input type="text"  placeholder="อีเมล์" name="usermail" class="input-large"> <label class="alertred">*</label>
				</div>
 				<label class="control-label" for="inputEmail">รหัสผ่าน</label>
				<div class="controls">
					<input type="text"  placeholder="รหัสผ่าน" name="password" id="password" class="input-large"> <label class="alertred">*</label>
				</div>
 				<label class="control-label" for="inputEmail">ยืนยันรหัสผ่าน</label> 
				<div class="controls">
					<input type="text"  placeholder="อีเมล์" name="repassword" class="input-large"> <label class="alertred">*</label>
				</div>		
 			</div>
 			<hr class="hr1">
 			<div class="control-group">
				<label class="control-label" for="idcard">เลขประจำตัวประชาชน</label>
				<div class="controls">
					<input type="text" id="cardW0"  name="cardW0" style="width:10px;" size="1" maxlength="1">
					<input type="text" id="cardW1"  name="cardW1" style="width:30px;" size="4" maxlength="4">
					<input type="text" id="cardW2"  name="cardW2" style="width:40px;" size="5" maxlength="5">
					<input type="text" id="cardW3"  name="cardW3" style="width:20px;" size="2" maxlength="2">
					<input type="text" id="cardW4"  name="cardW4" style="width:10px;" size="1" maxlength="1">					
				<label class="alertred">*</label>
				</div>			
				<label class="control-label" for="inputFirstame">ชื่อ -นามสกุล</label>
				<div class="controls">
					<input type="text" id="firstname" placeholder="ชื่อ" name="fisrtname"> <label class="alertred">*</label>
					<input type="text" id="surname" placeholder="นามสกุล" name="surname"> <label class="alertred">*</label>
				</div>				

				<label class="control-label" for="inputPostion">ตำแหน่ง</label>
				<div class="controls">
					<input type="text" id="surname" placeholder="ตำแหน่ง-ระดับ" name="position">
				</div>

				<label class="control-label" for="inputEmail">โทรศัพท์มือถือ</label>
				<div class="controls">
					<input type="text" name="mobile"  maxlength="3"  style="width:40px;" placeholder="08x" > -<input type="text" name="mobile"  maxlength="3"  style="width:50px;"> -<input type="text" name="mobile"  maxlength="4"  style="width:60px;">					
					 <label class="alertred">*</label>
				</div>
				<label class="control-label" for="inputEmail">โทรศัทพ์สำนักงาน</label>
				<div class="controls">
					<input type="text" name="telephone" maxlength="1"  style="width:15px;"> -<input type="text" name="telephone" maxlength="4" style="width:60px;"> -<input type="text" name="telephone" maxlength="4" style="width:60px;"> 				
					
					<label class="alertred">*</label> ต่อ <input type="text" name="telephone_extend" style="width:30px;"> 
				</div>
				<label class="control-label" for="inputEmail">โทรสาร</label>
				<div class="controls">
					<input type="text" name="fax" maxlength="1"  style="width:15px;"> -<input type="text" name="fax" maxlength="4" style="width:60px;"> -<input type="text" name="fax" maxlength="4" style="width:60px;"> 					
				</div>
				<div id="boxAdd"><button class="btn btn-primary" type="submit">ลงทะเบียน</button></div>
			</div>			
		</form>
</div>
</div><!-- register -->

