 <?php echo modules::run('content/inc_footer',4); ?>
<div class="view contact">
	<?php //echo $content->detail?>
	<div class="contact_form">
		<form method="post" action="contents/send/<?php //echo $content->id; ?>" id="frm-contact">
			<table class="tbcontact">
				<tr>
					<th>ชื่อ-นามสกุล<span class="require"> *</span></th>
					<td><input type="text" class="text" value="" name="name" size="60"></td>
				</tr>
				<tr>
					<th>อีเมล์<span class="require"> *</span></th>
					<td><input type="text" class="text" value="" name="email" size="60"></td>
				</tr>
				<tr>
					<th>เรื่องที่ติดต่อ<span class="require"> *</span></th>
					<td><input type="text" class="text" value="" name="title" size="60"></td>
				</tr>
				<tr>
					<th valign="top">รายละเอียด<span class="require"> *</span></th>
					<td><textarea rows="5" cols="51" class="text" name="detail"></textarea></td>
				</tr>
				<tr>
					<th>Captcha</th>
					<td><?php echo img('content/captcha').br().form_input('captcha', NULL, 'size="14"'); ?></td>
				</tr>
				<tr>
					<th></th>
					<td><input type="submit" value="ส่งข้อความ"></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script src="media/js/jquery.rsv.js" type="text/javascript" charset="utf-8"></script>
<script>
	$(function(){
		$('#frm-contact').RSV({
    		onCompleteHandler: function(){ return true; },
    		rules: [
		    	"required,name,Please enter your name.",
                "required,email,Please enter your email address.",
                "valid_email,email,Please enter a valid email address.",
				"required,title,Please enter your subject.",
				"required,detail,Please enter a detail.",
				"required,captcha,Please enter your captcha."
		    	]
		});
	});
</script>