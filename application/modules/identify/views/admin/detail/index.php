<h1>สถานที่ชันสูตรตรวจโรคพิษสุนัขบ้า</h1>
<div class="search">
<form action="identify/admin/identify_detail/index" method="get" name="form1" >
ประเภท <?php echo form_dropdown('identify_id',get_option('id','name','n_identify'),@$_GET['identify_id'],'','--โปรดเลือก--') ?>
ชื่อเรื่อง<input type="text" name="name" value="<?php echo @$_GET['title'] ?>" class="input_box_patient"/>
<input  class="btn" type="submit" value="ค้นหา">	 
</form>
</div>

<table  class="list">
	<tr>
		<th>แสดง</th>
		<th>ประเภท</th>
		<th>ชื่อเรื่อง</th>
		<th>โดย</th>
		<th width="90">
			<?php if(permission('identify_places', 'act_create')): ?>
			<a href="identify/admin/identify_detail/form/<?php echo $identify_id ?>" class="btn" title="เพิ่ม" name="btn_add">เพิ่มรายการ</a>
			<?php endif; ?>
		</th>
	</tr>
	<?php foreach($result as $key=>$item): ?>
	<tr>		
		<td width="70"><input type="checkbox"  class="list_check" name="active" value="<?php echo $item['id'] ?>" <?php echo ($item['active']=="1")?'checked="checked"':'' ?>  /></td>
		<td><?php echo $item['identify_name'] ?></td>
		<td><?php echo $item['name'] ?></td>
		<td><?php echo $item['userfirstname'] ?> <?php echo $item['usersurname'] ?></td>
		<td><?php if(permission('identify_places', 'act_update')): ?>
			<a href="identify/admin/identify_detail/form/<?php echo $identify_id ?>/<?php echo $item['id'] ?>" class="btn" title="แก้ไข">แก้ไข</a>
			<?php endif; ?>
			<?php if(permission('identify_places', 'act_delete')): ?>
			<a href="identify/admin/identify_detail/delete/<?php echo $item['id'] ?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')" class="btn" title="ลบ">ลบ</a>
			<?php endif; ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
