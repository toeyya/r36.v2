<!-- Load TinyMCE -->
<script type="text/javascript" src="media/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="media/tiny_mce/config.js"></script>
<script type="text/javascript">
	tiny('answer');
</script>
<h1>คำถามที่พบบ่อย</h1>
<form action="question/admin/question_detail/save" method="post" id="formm">
<table  class="form">
<tr>
	<th>ประเภท</th>
	<td><?php echo form_dropdown('question_id',get_option('id','name','n_question'),$question_id,'','--โปรดเลือก--') ?></td>
</tr>
<tr>
	<th>ข้อที่</th>
<td><input type="text" name="no" value="<?php echo $rs['no'] ?>"></td>
</tr>
<tr>
	<th>คำถาม</th>
	<td><textarea  name="question"  cols="30"  rows="3" style="width:619px;"><?php echo $rs['question'] ?></textarea></td>
</tr>
<tr>
	<th>คำตอบ</th>
	<td><textarea name="answer" class=" tinymce"><?php echo $rs['answer'] ?></textarea></td>
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


