<h1>จังหวัด</h1>
<div class="search">
<form action="province/index" method="get" name="form1" >
จังหวัด<?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$_GET['province_id'],'class="styled-select"','-ทั้งหมด-')?>			
ชื่อเขตความรับผิดชอบ <?php echo form_dropdown('area_id',get_option('id','name','n_area order by id'),@$_GET['area_id'],'class="styled-select"','-ทั้งหมด-') ?>
เขตความรับผิดชอบ <?php echo form_dropdown('level',array_combine(range(0,$total),range(0,$total)),@$_GET['level'],'class="styled-select"','-ทั้งหมด-') ?>
<input class="btn" type="submit" value="ตกลง">

</form>
</div>
 	 
<table  class="list">
	  <tr>
		<th width="27%" >จังหวัด</th>
		<th>รูปแบบเขตความรับผิดชอบ</th>
		<th width="20%" >เขตความรับผิดชอบ</th>
		<th>ปี</th>
		<th width="14%" ><a href="province/form" class="btn_add" title="เพิ่ม" name="btn_add"></a></th>
	  </tr>
	  <?php foreach($result as $key=>$item): ?>
	  <tr>
	  	<td><?php echo $item['province_name'] ?></td>
	  	<td><?php echo $item['area_name'] ?></td>
	  	<td><?php echo $item['level'] ?></td>
	  	<td></td>
	  	<td><a title="แก้ไข" href="province/form/<?php echo $item['province_id'] ?>/<?php echo $item['area_id'] ?>" class="btn">แก้ไข</a>
	  			 <a title="ลบ"  href="province/form/<?php echo $item['province_id']?>/<?php echo $item['area_id'] ?>" class="btn">ลบ</a>
	  	</td>	  	
	  </tr>
	  <?php endforeach; ?>
	 </table>
	 <?php echo $pagination; ?>