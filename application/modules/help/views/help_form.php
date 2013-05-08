<form name="form1" action="help/save">
	<table class="tbform">
		<tr>
			<th>ชื่อ</th>
			<td><input type="text" name="name" value="<?php echo $rs['name'] ?>" class="input_box_patient"></td>
		</tr>
		<tr>
			<th>ไฟล์</th>
			<td><input type="file" name="file"></td>
		</tr>
	</table>
	 <div class="btn_inline">
	 	<input type="hidden" name="id" value="<?php echo $rs['id'] ?>" class="input_box_patient">
      <ul>
      	<li><button class="btn_save" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="reset">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div> 
</form>
