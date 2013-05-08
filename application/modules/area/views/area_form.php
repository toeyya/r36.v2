<div id="title">ข้อมูลตำบล(เพิ่ม/แก้ไข)</div>
<form action="area/save" method="post" id="formm">
<table  class="tbform">
<tr>
	<th width="20%">ชื่อรูปแบบเขตตรวจราชการ</th>
	<td><input type="text" name="name" value="<?php echo @$rs['name'] ?>" class="input_box_patient"><span class="alertred">*</span></td>
</tr>
<tr>
	<th>จำนวนเขต</th>
	<td><input type="text" name="total" value="<?php echo @$rs['total'] ?>" class="input_box_patient"><span class="alertred">*</span></td>
</tr>
</table>
<div class="btn_inline">
<?php echo ($rs['id']) ? form_hidden('updated',time()) : form_hidden('created',time());
			echo form_hidden('year',date('Y'));
?>
      <ul>
      	<li><button class="btn_save" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="button">&nbsp;&nbsp;&nbsp;</button></li>
      </ul>
</div>
</form>