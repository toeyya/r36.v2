<script type="text/javascript">
$('#form1').validate({
	rule:{
		
	}
})
</script>
<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li>ลงทะเบียน</li>
</ul>
<div id="register">
<div class="row">
		<form action="users/signup" method="post" class="form-horizontal" id="form1">
 			<div class="control-group">
 				<label class="control-label" for="inputEmail">รหัสหน่วยงาน</label>
				<div class="controls">
					<input type="text"  placeholder="รหัสหน่วยงาน" name="userhospitalcode" class="input-large">
					<label class="alertred">*</label>
				</div>
								
 				<label class="control-label" for="inputEmail">อีเมล์</label>
				<div class="controls">
					<input type="text"  placeholder="อีเมล์" name="usermail" class="input-large"> <label class="alertred">*</label>
				</div>
 				<label class="control-label" for="inputEmail">รหัสผ่าน</label>
				<div class="controls">
					<input type="text"  placeholder="รหัสผ่าน" name="password" class="input-large"> <label class="alertred">*</label>
				</div>
 				<label class="control-label" for="inputEmail">ยืนยันรหัสผ่าน</label> 
				<div class="controls">
					<input type="text"  placeholder="อีเมล์" name="re-password" class="input-large"> <label class="alertred">*</label>
				</div>		
 			</div>
 			<hr class="hr1">
 			<div class="control-group">
				<label class="control-label" for="idcard">เลขประจำตัวประชาชน</label>
				<div class="controls">
					<input type="text" id="cardW0"  name="cardW0" style="width:10px;" size="1" maxlength="1">
					<input type="text" id="cardW1"  name="cardW1" style="width:30px;" size="4" maxlength="4">
					<input type="text" id="cardW1"  name="cardW1" style="width:40px;" size="5" maxlength="5">
					<input type="text" id="cardW1"  name="cardW1" style="width:20px;" size="2" maxlength="2">
					<input type="text" id="cardW1"  name="cardW1" style="width:10px;" size="1" maxlength="1">					
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
					<input type="text" name="mobile"  maxlength="3"  style="width:40px;"> -<input type="text" name="mobile"  maxlength="3"  style="width:50px;"> -<input type="text" name="mobile"  maxlength="4"  style="width:60px;">					
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
				<div id="boxAdd"><button class="btn btn-primary" type="button">ลงทะเบียน</button></div>
			</div>			
		</form>
</div>
</div><!-- register -->

