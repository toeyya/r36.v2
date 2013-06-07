<!-- Load TinyMCE -->
<script type="text/javascript" src="media/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="media/tiny_mce/config.js"></script>
<script type="text/javascript">
	tiny('answer');
</script>
<h1>คำถามที่พบบ่อย</h1>
<form action="question/admin/question/save" method="post" id="formm">
<table  class="form">
	<th>ประเภท</th>
	<td><input type="text" name="name" value="<? echo $rs['name'] ?>"></td>
</tr>
<tr>
	<th></th>
	<td><input class="btn" type="submit" value="ตกลง"></td>
</tr>
</table>

<?php echo ($rs['id']) ? form_hidden('updated',time()) : form_hidden('created',time());
		echo form_hidden('id',$rs['id']);
		echo form_hidden('user_id',@$rs['user_id']);	
?>
</form>


