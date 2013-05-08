<div id="title">ค้นหาข้อมูลเมนู help</div>
<div id="search">
<form action="help/index" name="form1" id="form1">
	<table class="tb_patient1">
		<tr>
			<th>ชื่อ</th>
			<td><input type="text" name="name" value="<?php echo @$_GET['name'] ?>" class="input_box_patient"></td>
		</tr>		
	</table>
	 <div class="btn_inline">
      <ul>
      	<li><button class="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="reset">&nbsp;&nbsp;&nbsp;</button></li></ul>
	</div> 
</form>
</div>
<div id="boxAdd">
	<a href="help/form/" class="btn_add" title="เพิ่มข้อมูล"></a>
</div>

 <table class="tb_search_Rabies1" >
 	<tr>
 		<th>แสดง</th>
 		<th>ลำดับ</th>
 		<th>ชื่อ</th>
 		<th>การกระทำ</th>
 	</tr>
 	<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 10)-10)+1:1;?>
 	<?php foreach($result as $key=>$item): ?>
 	<tr>
 		<td><input type="checkbox" name="status" value="<?php echo $item['id'] ?>" <?php echo ($item['status']=="approve")?'checked="checked"':'' ?>  /></td>
 		<td><input  type="hidden"  name="queueid[]" value="<?php echo $item['id'] ?>">
  				<input type="text" name="queuelist[]" value="<?php echo $item['queue'] ?>" size="2"></td>
 		<td><?php echo $item['name'] ?></td>
 		<td>
 			<a href="help/form/<?php echo $item['id'] ?>" title="แก้ไข" class="btn_edit"></a>
 			<a href="help/delete/<?php echo $item['id'] ?>" title="ลบ" class="btn_delete"></a>			
 		</td>
 	</tr>
 	<?php endforeach; ?>	
 	<tr>
	<td style="border-bottom: none"></td>
	<td style="border-bottom: none"><input type="submit" name="btn_save" value="บันทึก"></td>
</tr>
 </table>	
 <?php echo $pagination; ?>