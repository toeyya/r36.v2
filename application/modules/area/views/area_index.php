<h1>เขตตรวจราชการ</h1>
<div class="search">
<form action="area/index" method="get" name="form1" >
เขตตรวจราชการ <input type="text" name="name" value="<?php echo @$_GET['name'] ?>" class="input_box_patient">
<input  class="btn" type="submit" value="ค้นหา">	 
</form>
</div>

<table  class="list">
	<tr>
		<th>ลำดับ</th>
		<th>เขตความรับผิดชอบ</th>
		<th>จำนวนเขต</th>
		<th><a href="area/form" class="btn_add" title="เพิ่ม" name="btn_add"></a></th>
	</tr>
	<?php foreach($result as $key=>$item): ?>
	<tr>
		
		<td><?php echo ++$key ?></td>
		<td><?php echo $item['name'] ?></td>
		<td><?php echo  $item['total']?></td>
		<td><a href="area/form/<?php echo $item['id'] ?>" class="btn" title="แก้ไข">แก้ไข</a>
				  <a href="area/delete/<?php echo $item['id'] ?>" class="btn" title="ลบ">ลบ</a></td>
	</tr>
	<?php endforeach; ?>
</table>
