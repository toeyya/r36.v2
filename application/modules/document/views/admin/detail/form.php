<script type="text/javascript">
$(document).ready(function(){
	$('.option a[rel=del]').live('click',function(){
		var id =$('input[name=id]').val();				
		var url = 'document/admin/document/delete_file/';
		if(confirm('ยืนยันการลบข้อมูล')){
			$.post(url,{'id':id},function(data){
				$('.option').hide();
			})
		}
		return false;
	})
})
</script>
<h1>เอกสารเผยแพร่</h1>
<form action="document/admin/document_detail/save" method="post" id="formm"  enctype="multipart/form-data">
<table  class="form">
<tr><th>ประเภท</th>
	<td><?php echo form_dropdown('document_id',get_option('id','name','n_document'),$document_id,'','--โปรดเลือก--') ?></td>
</tr>
<tr><th>ชื่อเรื่อง</th>
<td><input type="text" name="title" value="<?php echo $rs['title'] ?>"></td>
</tr>
<tr><th>บทนำ</th>
	<td><textarea cols="30" rows="20" name="intro"><? echo $rs['intro'] ?></textarea></td>
</tr>
<?php if(is_file('uploads/document/thumbnail/'.$rs['image'])): ?>
<tr><th></th><td><img class="img" src="<?php echo 'uploads/document/thumbnail/'.$rs['image'] ?>"  /></td></tr>
<?php endif ?>
<tr><th>รูปภาพ </th>		
	<td>
		<small>อนุญาติเฉพาะ .gif .jpg .jpeg</small></br>
		<input type="file" name="image" />
	</td>
	</tr>

<tr><th>ชื่อเอกสาร</th>
	<td><input type="text" name="file_title" value="<?php echo $rs['file_title'] ?>"></td>
</tr>
<tr><th>ไฟล์เอกสาร </th>
<td>
	<small>อนุญาติเฉพาะ  pdf, xls, xlsx, doc, docx, ppt, pptx, rar และ zip</small>
	<br /><input type="file" name="file" />
	<?php if($rs['file']): ?>
	 <span class="option">
	 	<a href="document/download/<?php echo $rs['id'] ?>">ดาวน์โหลด</a> 
	 	<a href="#" rel="del">ลบไฟล์</a>
	 </span>
	 <?php endif; ?>
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


