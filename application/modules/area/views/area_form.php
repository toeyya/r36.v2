<h1>เขตตรวจราชการ(เพิ่ม/แก้ไข)</h1>
<form action="area/save" method="post" id="formm">
<table  class="form">
<tr>
	<th>ชื่อ</th>
	<td><input type="text" name="name" value="<?php echo @$rs['name'] ?>"></td>
</tr>
<tr>
	<th>จำนวนเขต</th>
	<td><input type="text" name="total" value="<?php echo @$rs['total'] ?>"></td>
</tr>
<tr>
	<th></th>
	<td><input class="btn" type="submit" value="ตกลง"></td>
</tr>
</table>

<?php echo ($rs['id']) ? form_hidden('updated',time()) : form_hidden('created',time());
	  echo form_hidden('year',date('Y'));
	  echo form_hidden('id',$rs['id']);
?>
</form>