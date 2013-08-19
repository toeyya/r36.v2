<script type="text/javascript">
$(document).ready(function(){
	$('.option a[rel=del]').live('click',function(){
		var id =$('input[name=id]').val();				
		var url = 'research/admin/research/delete_file/' + id;
		if(confirm('ยืนยันการลบข้อมูล')){
			$.post(url,{'id':id},function(data){
				$('.option').hide();
			})
		}
		return false;
	});
	$( "#formm" ).validate({
  			rules: {
    		research_id:"required",
    		title:"required",
    		researcher:"required",
    		agency:"required",
    		objective:"required",
			method:"required",
			result:"required",
			conclusion:"required",
    	},
    		messages:{
			research_id:"กรุณาระบุประเภท",
			title:"กรุณาระบุชื่อเรื่อง",
    		researcher:"กรุณาระบุผู้วิจัย",
    		agency:"กรุณาระบุหน่วยงาน",
    		bjective:"กรุณาระบุวัตถุประสงค์",
			method:"กรุณาระบุวัสดุเเละวิธีการ",
			result:"กรุณาระบุผลการศึกษา",
			conclusion:"กรุณาระบุสรุป",
					}
  		});
	
})
</script>
<h1>งานศึกษาวิจัย</h1>
<form action="research/admin/research_detail/save" method="post" id="formm"  enctype="multipart/form-data">
<table  class="form">
<tr>
	<th>ประเภท</th>
	<td><?php echo form_dropdown('research_id',get_option('id','name','n_research'),$research_id,'','--โปรดเลือก--') ?></td>
</tr>
<tr>
	<th>ชื่อเรื่อง</th>
<td><input type="text" name="title" value="<?php echo $rs['title'] ?>"></td>
</tr>
<tr>
	<th>ชื่อผู้วิจัย</th>
	<td><textarea  name="researcher"  cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['researcher'] ?></textarea></td>
</tr>
<tr>
	<th>หน่วยงาน</th>
	<td><textarea name="agency" cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['agency'] ?></textarea></td>
</tr>
<tr>
	<th>วัตถุประสงค์</th>
	<td><textarea name="objective" cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['objective'] ?></textarea></td>
</tr>
<tr>
	<th>วัสดุและวิธีการ</th>
	<td><textarea name="method" cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['method'] ?></textarea></td>
</tr>
<tr>
	<th>ผลการศึกษา</th>
	<td><textarea name="result" cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['result'] ?></textarea></td>
</tr>
<tr>
	<th>สรุป</th>
	<td><textarea name="conclusion" cols="30"  rows="3" style="width:619px;height:60px;"><?php echo $rs['conclusion'] ?></textarea></td>
</tr>
<tr>
	<th>ชื่อเอกสาร</th>
	<td><input type="text" name="file_title" value="<?php echo $rs['file_title'] ?>"></td>
</tr>
<tr><th>ไฟล์เอกสาร </th>
<td>
	<small>อนุญาติเฉพาะ  pdf, xls, xlsx, doc, docx, ppt, pptx, rar และ zip</small>
	<br /><input type="file" name="file" />
	<?php if(!empty($rs['file'])): ?>
	 <span class="option">
	 	<a href="research/admin/research/download/<?php echo $rs['id'] ?>">ดาวน์โหลด</a> 
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

<?php echo ($rs['id']) ? form_hidden('updated',date('Y-m-d H:i:s')) : form_hidden('created',date('Y-m-d H:i:s'));
			echo form_hidden('user_id',@$rs['user_id']);
			echo form_hidden('id',$rs['id']);
?>
</form>


