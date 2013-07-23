<!-- Load TinyMCE -->
<script type="text/javascript" src="media/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="media/tiny_mce/config.js"></script>
<script type="text/javascript">
	tiny('detail');
	$(function(){
		$('.preview').click(function(){
			tinyMCE.triggerSave();
		})
				
			$('select').after(' <span class="option"><a rel="edit" href="#" >แก้ไข</a> <a rel="add" href="#" >เพิ่ม</a> <a rel="del" href="#" >ลบ</a></span>');
			
			$('.option a[rel=edit]').live('click',function(){
				var select = $(this).parent().prev();
				select.before('<span class="option_edit"><input rel="'+ select.find('option:selected').val() +'" type="text" name="name" value="'+ select.find('option:selected').text() + '" /> \
				<a rel="save" href="#" >แก้ไข</a> <a rel="cancel" href="#" >ยกเลิก</a></span>').hide();
				$('span.option').hide();
				return false;
			})
			
			$('.option a[rel=add]').live('click',function(){
				var select = $(this).parent().prev();
				select.before('<span class="option_edit"><input type="text" name="name" value="" /> \
				<a rel="save" href="#" >เพิ่ม</a> <a rel="cancel" href="#" >ยกเลิก</a></span>').hide();
				$('span.option').hide();
				return false;
			})
			
			$('.option a[rel=del]').live('click',function(){
				var id =$('input[name=id]').val();				
				var url = 'content/admin/content/delete_file/' + id;
				if(confirm('ยืนยันการลบข้อมูล')){
					$.post(url,{'id':id},function(data){
						$('.option').hide();
					})
				}
				return false;
			})
			
			$('.option_edit a[rel=cancel]').live('click',function(){
				var select = $(this).parent().parent().find('select');
				select.show().prev().remove();
				$('span.option').show();
				return false;
			})
			
			$('.option_edit a[rel=save]').live('click',function(){
			var input = $(this).parent().find('input[name=name]');
			var select = $(this).parent().parent().find('select');
			var url = 'contents/admin/contents/ddl/' + select.attr('name');
			var id = input.attr('rel');
			var value = input.val();
			
			if (typeof id !== 'undefined' && id !== false) {
				json = {'id':id,'name':value};
			}else{
				json = {'name':value};
			}
			
			
			
			$.post(url,json,function(data){
				select.before(data).remove();
				$('span.option_edit').remove();
				$('span.option').show();
			})
			return false;
		})
			$("input[name=tag]").tagEditor({
				<?php if($rs['tag']):?>
				items: '<?php echo $rs['tag']?>'.split(","),
				<?php endif; ?>
				continuousOutputBuild:true
			});	

	})
</script>
<h1><?php echo $category_name; ?></h1>
<form method="post" action="content/admin/content/save/" enctype="multipart/form-data">
<table class="form">	
	<?php if(is_file('uploads/content/thumbnail/'.$rs['image'])): ?>
	<tr><th></th><td><img class="img" src="<?php echo 'uploads/content/thumbnail/'.$rs['image'] ?>"  /></td></tr>
	<?php endif ?>
	<tr><th>รูปภาพ </th>		
		<td>
			<small>อนุญาติเฉพาะ .gif .jpg .jpeg</small></br>
			<input type="file" name="image" />
		</td>
		</tr>
	<tr>
		<th width="100">เริ่มวันที่</th>
		<td><input type="text" name="start_date" value="<?php echo ($rs['start_date']!="0000-00-00") ? DB2Date($rs['start_date'],false) : ''?>" class="datepicker" style="width:100px;" /></td>
	</tr>
	<tr>
		<th width="100">สิ้นสุดวันที่</th>
		<td><input type="text" name="end_date" value="<?php echo ($rs['end_date']!='0000-00-00') ? DB2Date($rs['end_date']) : ''?>" class="datepicker" style="width:100px;" /></td>
	</tr>
	<tr><th>แท็ก </th><td><small>กด Enter เพื่อเพิ่มแท็ก</small><br /><input type="text" name="tag" value="" /></td></tr>	
		<tr>
		<th>URL </th>
		<td>
			<small>กรณีใส่ URL แล้วเมื่อกดข่าวนี้จะลิงค์ไปยัง URL ที่ใส่ทันที</small></br>
			<input type="text" name="url" value="<?php echo $rs['url']?>" class="full" />
		</td>
	</tr>
	<tr>
		<th width="150">หัวข้อ</th>
		<td><input type="text" name="title" value="<?php echo $rs['title']?>" class="full" /></td>
	</tr>
	<tr><th>ไฟล์เอกสาร </th>
		<td>
			<small>อนุญาติเฉพาะ  pdf, xls, xlsx, doc, docx, ppt, pptx, rar และ zip</small>
			<br /><input type="file" name="file" />
			<?php if($rs['file']): ?>
			 <span class="option">
			 	<a href="content/admin/content/download/<?php echo $rs['id'] ?>">ดาวน์โหลด</a> 
			 	<a href="#" rel="del">ลบไฟล์</a>
			 </span>
			 <?php endif; ?>
		</td>
	</tr>	
	<tr><th>ชื่อไฟล์เอกสาร</th>
		<td><input type="text" name="doc" value="<?php echo $rs['doc'] ?>" class="full"></td>
	</tr>
	<tr>
		<th class="top">บทคัดย่อ</th>
		<td><textarea name="intro"  cols="100%" rows="10"><?php echo $rs['intro'] ?></textarea></td>
		
	</tr>	
	<tr>
		<th class="top">รายละเอียด</th>
		<td><textarea name="detail" class=" tinymce"><?php echo $rs['detail'] ?></textarea></td>		
	</tr>		
	<tr>
		<th></th>
		<td><input type="submit" value="<?php echo BTN_SUBMIT?>" /></td>
	</tr>
</table>
<input type="hidden" name="id" value="<?php echo $rs['id']?>" />
<input type="hidden" name="user_id" value="<?php echo $rs['user_id'] ?>">
<input type="hidden" name="category_id" value="<?php echo $category_id ?>">
<?php echo ($rs['id']) ? form_hidden('modified',time()) : form_hidden('created',time())?>
</form>







