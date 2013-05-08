<div id="title">ค้นหาข้อมูลจังหวัด</div>
<div id="search">
<form action="province/index" method="get" name="form1" >
	<table   class="tb_patient1">
		<tr>
			<th>จังหวัด</th>
			<td><?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$_GET['province_id'],'class="styled-select"','-ทั้งหมด-')?></td>
			<th>ชื่อเขตความรับผิดชอบ</th>
			<td><?php echo form_dropdown('area_id',get_option('id','name','n_area order by id'),@$_GET['area_id'],'class="styled-select"','-ทั้งหมด-') ?></td>
			<th>เขตความรับผิดชอบ</th>
			<td><?php echo form_dropdown('level',array_combine(range(0,$total),range(0,$total)),@$_GET['level'],'class="styled-select"','-ทั้งหมด-') ?></td>
		</tr>
	</table>
	<div class="btn_inline">
      <ul>
      	<li><button class="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="button">&nbsp;&nbsp;&nbsp;</button></li></ul>
	</div>	
</form>
</div>
 	 
<div id="boxAdd"><a href="province/form" class="btn_add" title="เพิ่ม" name="btn_add"></a></div>
<table  class="tb_search_Rabies1">
	  <tr>
		<th width="27%" >จังหวัด</th>
		<th>รูปแบบเขตความรับผิดชอบ</th>
		<th width="20%" >เขตความรับผิดชอบ</th>
		<th>ปี</th>
		<th width="14%" >การกระทำ</th>
	  </tr>
	  <?php foreach($result as $key=>$item): ?>
	  <tr>
	  	<td><?php echo $item['province_name'] ?></td>
	  	<td><?php echo $item['area_name'] ?></td>
	  	<td><?php echo $item['level'] ?></td>
	  	<td></td>
	  	<td><a title="แก้ไข" href="province/form/<?php echo $item['province_id'] ?>/<?php echo $item['area_id'] ?>" class="btn_edit"></a>
	  			 <a title="ลบ"  href="province/form/<?php echo $item['province_id']?>/<?php echo $item['area_id'] ?>" class="btn_delete"></a>
	  	</td>	  	
	  </tr>
	  <?php endforeach; ?>
	 </table>
	 <?php echo $pagination; ?>