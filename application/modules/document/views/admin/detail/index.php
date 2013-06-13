<h1>เอกสารเผยแพร่</h1>
<div class="search">
<form action="document/admin/document_detail/index" method="get" name="form1" >
ประเภท <?php echo form_dropdown('document_id',get_option('id','name','n_document'),@$_GET['document_id'],'','--โปรดเลือก--') ?>
ชื่อเรื่อง<input type="text" name="name" value="<?php echo @$_GET['title'] ?>" class="input_box_patient"/>
<input  class="btn" type="submit" value="ค้นหา">	 
</form>
</div>

<table  class="list">
	<tr>
		<th>แสดง</th>
		<th>ประเภทเอกสารเผยแพร่</th>
		<th>ชื่อเรื่อง</th>
		<th>โดย</th>
		<th width="90"><a href="document/admin/document_detail/form/<?php echo $document_id ?>" class="btn" title="เพิ่ม" name="btn_add">เพิ่มรายการ</a></th>
	</tr>
	<?php foreach($result as $key=>$item): ?>
	<tr>		
		<td width="70"><input type="checkbox"  class="list_check" name="active" value="<?php echo $item['id'] ?>" <?php echo ($item['active']=="1")?'checked="checked"':'' ?>  /></td>
		<td><?php echo $item['name'] ?></td>
		<td><?php echo $item['title'] ?></td>
		<td><?php echo $item['userfirstname'] ?> <?php echo $item['usersurname'] ?></td>
		<td><a href="document/admin/document_detail/form/<?php echo $document_id ?>/<?php echo $item['id'] ?>" class="btn" title="แก้ไข">แก้ไข</a>
				 <a href="document/admin/document_detail/delete/<?php echo $item['id'] ?>" class="btn" title="ลบ">ลบ</a></td>
	</tr>
	<?php endforeach; ?>
</table>
