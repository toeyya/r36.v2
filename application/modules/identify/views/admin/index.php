<h1>สถานที่ชันสูตรตรวจโรคพิษสุนัขบ้า</h1>
<div class="search">
<form action="identify/admin/identify/index" method="get" name="form1" >
ประเภท <?php echo form_dropdown('identify_id',get_option('id','name',"n_identify where active='1'"),@$_GET['identify_id'],'','--โปรดเลือก--') ?>
<input  class="btn" type="submit" value="ค้นหา">	 
</form>
</div>

<table  class="list">
	<tr>
		<th>ลำดับ</th>
		<th>ประเภท</th>
		<th>จำนวนเรื่อง</th>
		<th>โดย</th>
		<th width="90">
			<?php if(permission('identify_places', 'act_create')): ?>
			<a href="identify/admin/identify/form" class="btn" title="เพิ่ม" name="btn_add">เพิ่มรายการ</a>
			<?php endif; ?>
		</th>
	</tr>
	<?php foreach($result as $key=>$item): ?>
	<tr>		
		<td width="70"><input type="checkbox"  class="list_check" name="active" value="<?php echo $item['id'] ?>" <?php echo ($item['active']=="1")?'checked="checked"':'' ?>  /></td>
		<td><a href="identify/admin/identify_detail/index/<?php echo $item['id']; ?>"><?php echo $item['name'] ?></a></td>
		<td><?php echo $item['cnt'] ?></td>		
		<td><?php echo $item['userfirstname'] ?> <?php echo $item['usersurname'] ?></td>
		<td><?php if(permission('identify_places', 'act_update')): ?>
			<a href="identify/admin/identify/form/<?php echo $item['id'] ?>" class="btn" title="แก้ไข">แก้ไข</a>
			<?php endif; ?>
			<?php if(permission('identify_places', 'act_delete')): ?>
			<a href="identify/admin/identify/delete/<?php echo $item['id'] ?>" class="btn" title="ลบ" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">ลบ</a>
			<?php endif; ?>	
		</td>
	</tr>
	<?php endforeach; ?>
</table>
