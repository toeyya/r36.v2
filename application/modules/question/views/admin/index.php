<h1>คำถามที่พบบ่อย</h1>
<div class="search">
<form action="question/admin/question/index" method="get" name="form1" >
ประเภทคำถาม <?php echo form_dropdown('question_id',get_option('id','name','n_question'),@$_GET['question_id'],'','--โปรดเลือก--') ?>
<input  class="btn" type="submit" value="ค้นหา">	 
</form>
</div>

<table  class="list">
	<tr>
		<th>ลำดับ</th>
		<th>ประเภท</th>
		<th>จำนวนคำถาม</th>
		<th>โดย</th>
		<th width="90">
			<?php if(permission('questions', 'act_create')): ?>
			<a href="question/admin/question/form" class="btn" title="เพิ่ม" name="btn_add">เพิ่มรายการ</a>
			<?php endif; ?>
		</th>
	</tr>
	<?php foreach($result as $key=>$item): ?>
	<tr>		
		<td width="70"><input type="checkbox"  class="list_check" name="active" value="<?php echo $item['id'] ?>" <?php echo ($item['active']=="1")?'checked="checked"':'' ?>  /></td>
		<td><a href="question/admin/question_detail/index/<?php echo $item['id']; ?>"><?php echo $item['name'] ?></a></td>
		<td><?php echo $item['cnt'] ?></td>
		<td><?php echo $item['userfirstname'] ?> <?php echo $item['usersurname'] ?></td>
		<td><?php if(permission('questions', 'act_update')): ?>
			<a href="question/admin/question/form/<?php echo $item['id'] ?>"   class="btn" title="แก้ไข">แก้ไข</a>
			<?php endif; ?>
			<?php if(permission('questions', 'act_delete')): ?>
			<a href="question/admin/question/delete/<?php echo $item['id'] ?>" class="btn" title="ลบ" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">ลบ</a></td>
			<?php endif; ?>
	</tr>
	<?php endforeach; ?>
</table>


