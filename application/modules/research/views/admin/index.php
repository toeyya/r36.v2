<h1>งานศึกษาวิจัย</h1>
<div class="search">
<form action="research/admin/research/index" method="get" name="form1" >
	<?php  {?>
ประเภทงานศึกษาวิจัย  <?php echo form_dropdown('research_id',get_option('id','name','n_research'),@$_GET['research_id'],'' ,'--โปรดเลือก--') ?>
	<?}?>
<input  class="btn" type="submit" value="ค้นหา">	 
</form>
</div>

<table  class="list">
	<tr>
		<th></th>
		<th>ประเภท</th>
		<th>จำนวนเรื่อง</th>
		<th>โดย</th>
		<th width="90">
			<?php if(permission('researchs', 'act_create')): ?>	
			<a href="research/admin/research/form" class="btn" title="เพิ่ม" name="btn_add">เพิ่มรายการ</a>
			<?php endif; ?>
		</th>
	</tr>
	<?php foreach($result as $key=>$item): ?>
	<tr>		
		<td width="70"><input type="checkbox"  class="list_check" name="active" value="<?php echo $item['id'] ?>" <?php echo ($item['active']=="1")?'checked="checked"':'' ?>  /></td>
		<td><a href="research/admin/research_detail/index/<?php echo $item['id']; ?>"><?php echo $item['name'] ?></a></td>
		<td><?php echo $item['cnt'] ?></td>		
		<td><?php echo $item['userfirstname'] ?> <?php echo $item['usersurname'] ?></td>
		<td><?php if(permission('researchs', 'act_update')): ?>	
			<a href="research/admin/research/form/<?php echo $item['id'] ?>" class="btn" title="แก้ไข">แก้ไข</a>
			<?php endif; ?>
			<?php if(permission('researchs', 'act_delete')): ?>	
			<a href="research/admin/research/delete/<?php echo $item['id'] ?>" class="btn" title="ลบ" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">ลบ</a></td>
			<?php endif; ?>
	</tr>
	<?php endforeach; ?>
</table>
