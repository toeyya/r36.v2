<h1>งานศึกษาวิจัย</h1>
<div class="search">
<form action="research/admin/research_detail/index" method="get" name="form1" >
ประเภทงานศึกษาวิจัย <?php echo form_dropdown('research_id',get_option('id','name','n_research'),@$_GET['research_id'],'','--โปรดเลือก--') ?>
ชื่อเรื่อง<input type="text" name="name" value="<?php echo @$_GET['title'] ?>" class="input_box_patient"/>
<input  class="btn" type="submit" value="ค้นหา">	 
</form>
</div>

<table  class="list">
	<tr>
		<th>แสดง</th>
		<th>ประเภทงานวิจัย</th>
		<th>ชื่อเรื่อง</th>
		<th>โดย</th>
		<th width="90">
			<?php if(permission('researchs', 'act_create')): ?>	
			<a href="research/admin/research_detail/form/<?php echo $research_id ?>" class="btn" title="เพิ่ม" name="btn_add">เพิ่มรายการ</a>
			<?php endif; ?>
		</th>
	</tr>
	<?php foreach($result as $key=>$item): ?>
	<tr>		
		<td width="70"><input type="checkbox"  class="list_check" name="active" value="<?php echo $item['id'] ?>" <?php echo ($item['active']=="1")?'checked="checked"':'' ?>  /></td>
		<td><?php echo $item['name'] ?></td>
		<td><?php echo $item['title'] ?></td>
		<td><?php echo $item['userfirstname'] ?> <?php echo $item['usersurname'] ?></td>
		<td><?php if(permission('researchs', 'act_update')): ?>
			<a href="research/admin/research_detail/form/<?php echo $research_id ?>/<?php echo $item['id'] ?>" class="btn" title="แก้ไข">แก้ไข</a>
			<?php endif; ?>
			<?php if(permission('researchs', 'act_delete')): ?>
			<a href="research/admin/research_detail/delete/<?php echo $item['id'] ?>" class="btn" title="ลบ">ลบ</a></td>
			<?php endif; ?>
	</tr>
	<?php endforeach; ?>
</table>
