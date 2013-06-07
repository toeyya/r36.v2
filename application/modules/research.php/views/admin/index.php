<h1>คำถามที่พบบ่อย</h1>
<div class="search">
<form action="research/index" method="get" name="form1" >
ประเภทคำถาม <input type="text" name="name" value="<?php echo @$_GET['name'] ?>" class="input_box_patient">
<input  class="btn" type="submit" value="ค้นหา">	 
</form>
</div>

<table  class="list">
	<tr>
		<th>ลำดับ</th>
		<th>ประเภท</th>
		<th>โดย</th>
		<th width="90"><a href="research/admin/research/form" class="btn" title="เพิ่ม" name="btn_add">เพิ่มรายการ</a></th>
	</tr>
	<?php foreach($result as $key=>$item): ?>
	<tr>		
		<td width="70"><input type="checkbox"  class="list_check" name="active" value="<?php echo $item['id'] ?>" <?php echo ($item['active']=="1")?'checked="checked"':'' ?>  /></td>
		<td><a href="research/admin/research_detail/index/<?php echo $item['id']; ?>"><?php echo $item['name'] ?></a></td>
		<td><?php echo $item['userfirstname'] ?> <?php echo $item['usersurname'] ?></td>
		<td><a href="research/admin/research/form/<?php echo $item['id'] ?>" class="btn" title="แก้ไข">แก้ไข</a>
				 <a href="research/admin/research/delete/<?php echo $item['id'] ?>" class="btn" title="ลบ">ลบ</a></td>
	</tr>
	<?php endforeach; ?>
</table>
