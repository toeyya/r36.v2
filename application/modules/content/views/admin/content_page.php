<!-- Load TinyMCE -->
<script type="text/javascript" src="media/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="media/tiny_mce/config.js"></script>
<script type="text/javascript">
	tiny('detail');
	
</script>
<h1><?php echo $category['name']; ?></h1>
<form action="content/admin/content/save/" method="post" enctype="multipart/form-data" >
<table class="form">
	<tr>
		<th>รายละเอียด </th>
		<td>
			<textarea name="detail" class="full tinymce"><?php echo @$content['detail']?></textarea></div>
		</td>
	</tr>
	<tr>
		<th></th>
		<td>
			<?php echo form_hidden('category_id',$category_id)?>
			<?php echo form_hidden('id',@$content['id'])?>
			<?php echo form_hidden('user_id',@$content['user_id'])?>
			<?php echo form_submit('','ตกลง','class="button"')?>
		</td></tr>
</table>
</form>