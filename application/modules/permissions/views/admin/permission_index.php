<h1>สิทธิ์การใช้งาน</h1>
<table class="list">
	<tr>
		<th>ลำดับ</th>
		<th>สิทธิ์การใช้งาน</th>
		<th width="100">
			<?php if(permission('permissions', 'act_create')):?>
				<?php echo anchor('permissions/admin/permissions/form','เพิ่มรายการ','class="btn"')?>
			<?php endif;?>
		</th>
	</tr>
	<?php foreach($level as $key=>$level):?>
	<tr <?php echo cycle($key)?>>
		<td><?php echo $key+1?></td>
		<td><?php echo $level['level_name']?></td>
		<td>
			<?php if(permission('permissions', 'act_update')):?>
			<?php echo anchor('permissions/admin/permissions/form/'.$level['lid'],'แก้ไข','class="btn"')?>
			<?php endif;?>
			<?php if(permission('permissions', 'act_delete')):?>
				<?php if(in_array($level['level_code'],$chk_delete)==FALSE): ?>
			<?php echo anchor('permissions/admin/permissions/delete/'.$level['lid'],'ลบ','class="btn" onclick="return confirm(\''.NOTICE_CONFIRM_DELETE.'\')"')?>
				<?php endif;?>
			<?php endif;?>
		</td>
	</tr>
	<?php endforeach?>
</table>
<?php echo $pagination;?>
