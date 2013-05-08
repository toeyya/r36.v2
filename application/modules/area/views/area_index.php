<div id="title">ค้นหาข้อมูลเขตตรวจราชการ</div>
<div id="search">
<form action="area/index" method="get" name="form1" >
	<table   class="tb_patient1">
		 <tr>
		 	<th>เขตตรวจราชการ</th>
		 	<td><input type="text" name="name" value="<?php echo @$_GET['name'] ?>" class="input_box_patient"></td>
		 </tr>
	 </table>
<div class="btn_inline">
      <ul><li><button class="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="button">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div>	 	 
</form>
</div>
<div id="boxAdd"><a href="area/form" class="btn_add" title="เพิ่ม" name="btn_add"></a></div>
<table  class="tb_search_Rabies1">
	<tr>
		<th>ลำดับ</th>
		<th>เขตความรับผิดชอบ</th>
		<th>จำนวนเขต</th>
		<th>การกระทำ</th>
	</tr>
	<?php foreach($result as $key=>$item): ?>
	<tr>
		
		<td><?php echo ++$key ?></td>
		<td><?php echo $item['name'] ?></td>
		<td><?php echo  $item['total']?></td>
		<td><a href="area/form/<?php echo $item['id'] ?>" class="btn_edit" title="แก้ไข"></a>
				  <a href="area/delete/<?php echo $item['id'] ?>" class="btn_delete" title="ลบ"></a></td>
	</tr>
	<?php endforeach; ?>
</table>
