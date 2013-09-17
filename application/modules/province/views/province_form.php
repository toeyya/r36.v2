<script type="text/javascript">
$(document).ready(function(){

 $('input[name=add]').click(function(){
 	var place = $(this).closest('td'); 	
 	place.append($(this).next().clone());	
 	place.children('p:last').append('<input type="button" name="dels" value="ลบ"  class="dels">');
 });
 $('.dels').live('click',function(){
 	$(this).closest('p').remove();
 })
});	
</script>
<h1>จังหวัด(แก้ไข)</h1>
<form action="province/save" method="post" id="formm">
<table  class="form">
<tr>
	<th width="30%" >โค้ดจังหวัด</th>
	<td><input type="text" name="province_id" value="<?php echo @$rs['province_id']; ?>" readonly="readonly"></td>
</tr>
<tr><th>จังหวัด</th>
	<td><input type="text" name="province_name" value="<?php echo ThaiToUtf8($rs['province_name']) ?>"></td>
</tr>
<tr><th>รูปแบบเขตความรับผิดชอบ</th>
	<td><?php echo form_dropdown('area_id',get_option('id','name','n_area order by created desc'),@$rs['area_id'],'','-โปรดเลือก-'); ?></td>
</tr>
<tr><th>เขตความรับผิดชอบ</th>
	<td><?php echo form_dropdown('level',getLevel($rs['area_id'],$rs['total']),$rs['level'],'','-โปรดเลือก-'); ?></td>
</tr>
<tr>
	<th>จำนวนประชากร  <br/><span class="alertred">กรุณาระบุเฉพาะตัวเลข</span></th>
	<td><input type="button" name="add" class="btn" value="เพิ่ม"> 
		<?php if(!empty($people)): ?>		
		<?php foreach($people as $key =>$item): ?>
		<p>	<?php echo form_dropdown('years[]',get_year_option(),$item['years']); ?>
		<input type="text" 	 name="people[]"class="input_box_patient"  value="<?php echo $item['people'] ?>"> 
			<?php if($key>0): ?>
			<input type="button" name="dels" value="ลบ"  class="dels">
			<?php endif; ?>
		</p>			
		<?php endforeach; ?>
		<?php else: ?>	
		<p>	<?php echo form_dropdown('years[]',get_year_option()); ?>
			<input type="text" 	 name="people[]"class="input_box_patient"  value=""> 
		</p>		
		<?php endif; ?>
		
	</td>
</tr>

<tr>
	<th></th>
	<td>  <input type="submit" class="btn" value="ตกลง" name="btn_submit"></td>
</tr>
</table>
<?php 
echo (@$rs['id']) ? form_hidden('updated',date('Y-m-d H:i:s')) : form_hidden('created',date('Y-m-d H:i:s'));
echo form_hidden('year',date('Y'));
echo form_hidden('id',@$rs['detail_id']);
?>
     
</form>