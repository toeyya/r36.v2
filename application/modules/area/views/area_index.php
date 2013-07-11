<h1>เขตตรวจราชการ</h1>
<div class="search">
<form action="area/index" method="get" name="form1" >
เขตตรวจราชการ <? echo form_dropdown('area_id',get_option('id','name','n_area'),@$_GET['area_id'],'','-- ทั้งหมด --'); ?>
 <input  class="btn" type="submit" value="ค้นหา">	 
</form>
</div>

<table  class="list">
	<tr>
		<th>ลำดับ</th>
		<th>เขตความรับผิดชอบ</th>
		<th>จำนวนเขต</th>
		<th width="90"><a href="area/form" class="btn" title="เพิ่ม" name="btn_add">เพิ่มรายการ</a></th>
	</tr>
	<?php foreach($result as $key=>$item): ?>
	<tr>
		
		<td><?php echo ++$key ?></td>
		<td><?php echo $item['name'] ?></td>
		<td><?php echo  $item['total']?></td>
		<td><a href="area/form/<?php echo $item['id'] ?>" 	class="btn" title="แก้ไข">แก้ไข</a>
			<a href="area/delete/<?php echo $item['id'] ?>" class="btn" title="ลบ" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">ลบ</a></td>
	</tr>
	<?php endforeach; ?>
</table>
