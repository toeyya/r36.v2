<h1>สถานที่ชันสูตรตรวจโรคพิษสุนัขบ้า</h1>
<form action="identify/admin/identify_detail/save" method="post" id="formm">
<table  class="form">
<tr>
	<th>ประเภท</th>
	<td><?php echo form_dropdown('identify_id',get_option('id','name','n_identify'),$identify_id,'','--โปรดเลือก--') ?></td>
</tr>
<tr>
	<th>ส่วนราชการ</th>
<td><input type="text" name="name" value="<?php echo $rs['name'] ?>"></td>
</tr>
<tr>
	<th>โทรศัพท์</th>
	<td><textarea  name="telephone"  cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['telephone'] ?></textarea></td>
</tr>
<tr>
	<th>โทรสาร</th>
	<td><textarea name="fax" cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['fax'] ?></textarea></td>
</tr>
<tr>
	<th>อีเมล์</th>
	<td><textarea name="email" cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['email'] ?></textarea></td>
</tr>
<tr>
	<th>ที่อยู่</th>
	<td><textarea name="address" cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['address'] ?></textarea></td>
</tr>

<tr>
	<th></th>
	<td><input class="btn" type="submit" value="ตกลง"></td>
</tr>
</table>

<?php echo ($rs['id']) ? form_hidden('updated',time()) : form_hidden('created',time());
			echo form_hidden('user_id',@$rs['user_id']);
			echo form_hidden('id',$rs['id']);
?>
</form>


