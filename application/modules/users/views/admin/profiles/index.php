<h1>ข้อมูลส่วนตัว</h1>
<form method="post" action="users/admin/profiles/save" enctype="multipart/form-data">
<table class="form">

	<tr>
		<th width="150">Level</th>
		<td><?php echo form_dropdown('userposition',get_option('level_code', 'level_name', 'n_level_user'),$rs['userposition'])?></td>
	</tr>
		<tr>
		<th>อีเมล์</th>
		<td>
			<input type="text" name="usermail" value="<?php echo $rs['usermail'] ?>"></td>
	</tr>
	<tr>
		<th class="top">Password</th>
		<td><input type="password" name="userpassword" value="<?php echo $rs['userpassword']?>" size="30" /></td>
	</tr>
	<tr>
		<th>ยืนยันรหัสผ่าน</th>
		<td><input type="password" name="_password" value="<?php echo $rs['userpassword']?>" size="30" /></td>
	</tr>
	<tr>
		<th width="150">ชื่อ</th>
		<td><input type="text" name="userfirstname" value="<?php echo $rs['userfirstname']?>" size="30" /></td>
	</tr>
	<tr>
		<th width="150">นามสกุล</th>
		<td><input type="text" name="usersurname" value="<?php echo $rs['usersurname']?>" size="30" /></td>
	</tr>
	<tr>
		<th width="150">เบอร์โทรศัพท์</th>
		<td><input type="text" name="telephone" value="<?php echo $rs['telephone']?>" size="30" /></td>
	</tr>
	<tr>
		<th></th>
		<td><input type="submit" value="<?php echo BTN_SUBMIT?>" /></td>
	</tr>
</table>
<input type="hidden" name="uid" value="<?php echo $rs['uid']?>" />
<?php echo ($rs['uid']) ? form_hidden('modified',date('Y-m-d H:i:s')) : form_hidden('created',date('Y-m-d H:i:s'))?>
</form>






<script type="text/javascript" src="js/jquery.validate.min.js"></script>
		<script language="javascript">
			$(function(){
				$("#form1").validate({
				rules: {
					firstname: { 
						required: true,
						minlength: 5,
						//remote: "check-display-name.php"
						},
					lastname: { 
						required: true,
						minlength: 5,
						//remote: "check-display-name.php"
						},
					username: {
						required: true,
						minlength: 5,
						remote: "user/admin/user/check_username"
						},
					password: {
						required: true,
						minlength: 5
						},
					email: {
						required: true,
						email: true
					 	}
					},
					messages: {
						firstname: { 
						required: "กรุณากรอกชื่อ",
						remote: "ชื่อนี้มีผู้ใช้แล้ว"
						},
						lastname: { 
						required: "กรุณากรอกชื่อ",
						remote: "ชื่อนี้มีผู้ใช้แล้ว"
						},
						display_name: { 
						required: "กรุณากรอกชื่อ",
						minlength: "กรุณากรอกชื่ออย่างน้อย 5 ตัวอักษร",
						remote: "ชื่อนี้มีผู้ใช้แล้ว"
						},
					username: {
						required: "กรุณากรอกชื่อในการล็อกอิน",
						minlength: "กรุณากรอกชื่อในการล็อกอินอย่างน้อย 5 ตัวอักษร",
						remote: "ชื่อล็อกอินนี้มีผู้ใช้แล้ว"
						},
					password: {
						required: "กรุณากรอกรหัสผ่าน",
						minlength: "กรุณากรอกผ่านอย่างน้อย 5 ตัวอักษร"
						},
					email: {
						required: "กรุณากรอกอีเมล์",
						email: "กรุณากรอกอีเมล์ให้ถููกต้อง"
					 	}
				}
				});
			});
		</script>