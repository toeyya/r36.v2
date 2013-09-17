<script type="text/javascript">
$(document).ready(function(){

 $('input[name=add]').click(function(){
 	var place = $(this).closest('td'); 	
 	place.append($(this).next().clone()); 	 		
 	$(this).closest('td').children('p:last').append('<input type="button" name="dels" value="ลบ"  class="dels">');
 });
 $('.dels').live('click',function(){
 	$(this).closest('p').remove();
 })
});	
</script>
<h1>ข้อมูลอำเภอ(เพิ่ม/แก้ไข)</h1>
<form action="amphur/save" method="post" id="formm">
<table  class="form">
<tr><th width="20%">โค้ดอำเภอ</th>
	
	<td><input type="text" name="amphur_id" value="<?php echo @$rs['amphur_id']; ?>" readonly="readonly"></td>
</tr>	
<tr><th>จังหวัด</th>
	<td><?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['province_id'],'id="province_id"','-โปรดเลือก-') ?></td>
</tr>
<tr>
	<th>อำเภอ</th>
	<td><input type="text" name="amphur_name" value="<?php echo @$rs['amphur_name'] ?>"></td>
</tr>
<tr>
	<th>จำนวนประชากร <br/><span class="alertred">กรุณาระบุเฉพาะตัวเลข</span> </th>
	<td><input type="button" name="add" class="btn" value="เพิ่ม"> 
		<?php if(!empty($people)): ?>
		<?php foreach($people as $key=>$p):?>
		<p> 
			<?php echo form_dropdown('years[]',get_year_option(),$p['years']); ?>
			<input type="text" 	 name="people[]"class="input_box_patient"  value="<?php echo  $p['people']?>"> 
			<?php if($key>0): ?>
			<input type="button" name="dels" value="ลบ"  class="dels">
			<?php endif; ?>			
		</p>	
		<?php endforeach; ?>
		<?php else: ?>
		<p>
			<?php echo form_dropdown('years[]',get_year_option()); ?>
			<input type="text" 	 name="people[]"class="input_box_patient"  value="">			
		</p>
		<?php endif; ?>
			
	</td>
</tr>
<tr><th></th>
	<td><input  class="btn" type="submit" value="ตกลง"></td>
</tr>

</table>

<?php echo (@$rs['amp_pro_id']) ? form_hidden('updated',date('Y-m-d H:i:s')) : form_hidden('created',date('Y-m-d H:i:s'));
			echo form_hidden('year',date('Y'));
			echo form_hidden('amp_pro_id',@$rs['amp_pro_id']);
?>
</form>