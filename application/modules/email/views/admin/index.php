<!-- Load TinyMCE -->
<script type="text/javascript" src="media/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="media/tiny_mce/config.js"></script>
<script type="text/javascript">
	tiny('message');
</script>
<h1>อีเมล์แจ้งข่าวสาร</h1>
<form method="post" action="email/admin/email/save/">
<table class="form">	
	<tr>
		<th width="150">เรื่อง / หัวข้อ</th>
		<td><input type="text" name="subject" value="" class="full" /></td>
	</tr>	
	<tr>
		<th class="top">รายละเอียด</th>
		<td><textarea name="message" class=" tinymce"></textarea></td>		
	</tr>
	<tr><th>จังหวัด</th>
		<td><?php if($this->session->userdata('R36_LEVEL')=="02"){
			echo $this->province->get_one('province_name','province_id',$this->session->userdata('R36_PROVINCE'));
			
		}else{
			echo form_dropdown('userprovince',get_option("province_id",'province_name','n_province order by province_name asc'),'','','-โปรดเลือก-');
		}?>				
		</td>
	</tr>		
	<tr>
		<th></th>
		<td><input type="submit" value="<?php echo BTN_SUBMIT?>" />
			
		</td>
	</tr>
</table>

</form>







