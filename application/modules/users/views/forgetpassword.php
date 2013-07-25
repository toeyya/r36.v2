<script language="javascript">
$(function(){
    $("#forget").validate({
    rules: 
    {
        email: 
        { 
            required: true,
            email: true
            //remote: "users/check_email"
        },
        captcha:
        {
            required: true,
            remote: "users/check_captcha"
        }
    },
    messages:
    {
        email: 
        { 
            required: "กรุณากรอกอีเมล์",
            email: "กรุณากรอกอีเมล์ให้ถูกต้อง"
            //remote: "อีเมล์นี้ไม่สามารถใช้งานได้"
        },
        captcha:
        {
            required: "กรุณากรอกตัวอักษรตัวที่เห็นในภาพ",
            remote: "กรุณากรอกตัวอักษรให้ตรงกับภาพ"
        }
    }
    });
});
</script>
<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> <span class="divider">/</span></li>
    <li>ลืมรหัสผ่าน</li>
</ul>
<h1>ลืมรหัสผ่าน</h1>
<div id="register">
	<div class="row">
	<div class="span9">
	<form action="users/sendmail" method="post" id="forget" class="form-horizontal">
            
                <label class="control-label" for="inputEmail">อีเมล์</label>
                <div class="controls">
                  <input type="text" name="usermail" id="inputEmail" placeholder="อีเมล์">
                </div>

                <label class="control-label" for="inputCaptcha">รหัสลับ</label>
                <div class="controls">
                  <img src="users/captcha" /><br/>
                  <input type="text" name="captcha" id="inputCaptcha" placeholder="รหัสลับ">
                </div>
				<label class="control-label" for="inputCaptcha">&nbsp;</label>
				<label class="control-label" for="inputCaptcha">&nbsp;</label>
	            <div class="control-group">
                <div class="controls">
                		<button type="submit" class="btn btn-small btn-primary" style="margin-bottom:10px;">ตกลง</button>
                </div>
               </div>

	</form>
</div></div></div>