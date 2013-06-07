<h1>งานศึกษาวิจัย</h1>
<form action="research/admin/research_detail/save" method="post" id="formm"  enctype="multipart/form-data">
<table  class="form">
<tr>
	<th>ประเภท</th>
	<td><?php echo form_dropdown('research_id',get_option('id','name','n_question'),$research_id,'','--โปรดเลือก--') ?></td>
</tr>
<tr>
	<th>ชื่อเรื่อง</th>
<td><input type="text" name="title" value="<?php echo $rs['title'] ?>"></td>
</tr>
<tr>
	<th>ชื่อผู้วิจัย</th>
	<td><textarea  name="researcher_name"  cols="30"  rows="3" style="width:619px;"><?php echo $rs['researcher_name'] ?></textarea></td>
</tr>
<tr>
	<th>หน่วยงาน</th>
	<td><textarea name="answer" cols="30"  rows="3" style="width:619px;"><?php echo $rs['answer'] ?></textarea></td>
</tr>
<tr>
	<th>วัตถุประสงค์</th>
	<td><textarea name="answer" cols="30"  rows="3" style="width:619px;"><?php echo $rs['answer'] ?></textarea></td>
</tr>
<tr>
	<th>วัสดุและวิธีการ</th>
	<td><textarea name="answer" cols="30"  rows="3" style="width:619px;"><?php echo $rs['answer'] ?></textarea></td>
</tr>
<tr>
	<th>ผลการศึกษา</th>
	<td><textarea name="answer" cols="30"  rows="3" style="width:619px;"><?php echo $rs['answer'] ?></textarea></td>
</tr>
<tr>
	<th>สรุป</th>
	<td><textarea name="answer" cols="30"  rows="3" style="width:619px;"><?php echo $rs['answer'] ?></textarea></td>
</tr>
<tr>
	<th>ชื่อเอกสาร</th>
	<input type="text" name="file_title" value="<?php echo $rs['file_title'] ?>">
</tr>
<tr>
	<th>เอกสาร</th>
	<td>
		<?php if(!empty($rs['file'])): ?>
			<span><a href="uploads/research/<?php echo $rs['file'] ?>"><?php echo $rs['file_title'] ?></a></span>
		<?php endif; ?>
		<input type="file" name="file" >
	</td>

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


