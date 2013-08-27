<script type="text/javascript">
$(document).ready(function(){

 $('input[name=add]').click(function(){
 	var place = $(this).closest('td'); 	
 	place.append($(this).next().clone());
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
	<td><?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['province_id'],'id="province_id"','-โปรดเลือก-') ?></td>
</tr>
<tr><th>รูปแบบเขตความรับผิดชอบ</th>
	<td><?php echo form_dropdown('area_id',get_option('id','name','n_area order by created desc'),@$rs['area_id'],'','-โปรดเลือก-'); ?></td>
</tr>
<tr><th>เขตความรับผิดชอบ</th>
	<td><?php echo form_dropdown('level',getLevel($rs['area_id'],$rs['total']),$rs['level'],'','-โปรดเลือก-'); ?></td>
</tr>
<tr>
	<th>จำนวนประชากร</th>
	<td><input type="button" name="add" class="btn" value="เพิ่ม">
		<p><?php echo form_dropdown('year[]',get_year_option(),@$rs['year']); ?>
			<input type="text" 	 name="people[]"class="input_box_patient"  value=""> 
			<input type="button" name="dels" value="ลบ"  class="dels">
		</p>		
	</td>
</tr>

<tr>
	<th></th>
	<td>  <input type="submit" class="btn" value="ตกลง" name="btn_submit"></td>
</tr>
</table>
<?php 
echo (@$rs['id']) ? form_hidden('updated',time()) : form_hidden('created',time());
echo form_hidden('year',date('Y'));
echo form_hidden('id',@$rs['detail_id']);
?>
     
</form>