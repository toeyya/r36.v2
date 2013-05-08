<script type="text/javascript">
$(document).ready(function(){

})
</script>
<div id="title">ข้อมูลอำเภอ(เพิ่ม/แก้ไข)</div>
<form action="amphur/save" method="post" id="formm">
<table  class="tbform">
<tr>
	<th>รูปแบบเขตความรับผิดชอบ</th>
	<td><?php echo form_dropdown('area_id',get_option('id','name','n_area order by created desc'),@$rs['area_id'],'class="styled-select" id="area_id"','-โปรดเลือก-'); ?><span class="alertred">*</span></td>
</tr>	
<tr><th width="20%">จังหวัด</th>
		<td><?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['province_id'],'class="styled-select" id="province_id"','-โปรดเลือก-') ?><span class="alertred">*</span></td>
</tr>
<tr><th>อำเภอเดิม</th>
		<td>
			<span id="amphur">
				<select name='amphur_id' class="input_box_patient"><option value="">-โปรดเลือก-</option></select>
			</span>
			<span class="alertred">*</span>
		</td>
</tr>
<tr>
	<th>โค้ดอำเภอ</th>
	<td><input type="text" name="amphur_id" class="input_box_patient" size="2" maxlength="2" value="<?php echo @$rs['amphur_id'] ?>"><span class="alertred">*</span></td>
</tr>
<tr>
	<th>อำเภอ</th>
	<td><input type="text" name="amphur_name" class="input_box_patient" value="<?php echo @$rs['amphur_name'] ?>"><span class="alertred">*</span></td>
</tr>
</table>
<div class="btn_inline">
<?php echo (@$rs['amp_pro_id']) ? form_hidden('updated',time()) : form_hidden('created',time());
			echo form_hidden('year',date('Y'));
?>
      <ul>
      	<li><button class="btn_save" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="button">&nbsp;&nbsp;&nbsp;</button></li>
      </ul>
</div>
</form>