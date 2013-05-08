<div id="title">ค้นหาข้อมูลอำเภอ</div>
<div id="search">
<form action="province/index" method="get" name="form1" >
	<table   class="tb_patient1">
		<tr>
			<th>จังหวัด</th>
			<td><?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$_GET['province_id'],'class="styled-select"','-ทั้งหมด-')?></td>
			<th>อำเภอ</th>
			<td><input type="text" class="input_box_patient" name="amphur_name" value="<?php echo @$_GET['amphur_name']?>"></td>
		</tr>
	</table>
</form>
<div class="btn_inline">
      <ul><li><button class="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li><li><button class="btn_cancel" type="button">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div>	 	 
</form>
</div>
<div id="boxAdd"><a href="amphur/form" class="btn_add" title="เพิ่ม" name="btn_add"></a></div>
<table  class="tb_search_Rabies1">
	  <tr>
		<th width="27%" >จังหวัด</th>
		<th>โค้ดอำเภอ</th>
		<th width="20%" >อำเภอ</th>
		<th>ปี</th>
		<th width="14%" >การกระทำ</th>
	  </tr>
	  <?php foreach($result as $key=>$item): ?>
	  <tr>
	  	<td><?php echo $item['province_name'] ?></td>
	  	<td><?php echo $item['amphur_id'] ?></td>
	  	<td><?php echo $item['amphur_name'] ?></td>
	  	<td></td>
	  	<td><a title="แก้ไข" href="amphur/form/<?php echo $item['amp_pro_id']?>" class="btn_edit"></a>
	  			 <a title="ลบ"  href="amphur/form/<?php echo $item['amp_pro_id']?>" class="btn_delete"></a>
	  	</td>	  	
	  </tr>
	  <?php endforeach; ?>
	 </table>
	 <?php echo $pagination; ?>