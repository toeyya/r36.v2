<script type="text/javascript">
$(document).ready(function(){

})
</script>
<div id="title">ข้อมูลจังหวัด(เพิ่ม/แก้ไข)</div>
<form action="province/save" method="post" id="formm">
<table  class="tbform">
<tr><th width="20%">จังหวัด</th>
		<td><?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['province_id'],'class="styled-select" id="province_id"','-โปรดเลือก-') ?><span class="alertred">*</span></td>
</tr>
<tr><th>จังหวัดใหม่</th>
		<td><select name="amphur_id" class="styled-select"><option>-โปรดเลือก-</option></select><span class="alertred">*</span></td>
</tr>
<tr><th>โค้ดจังหวัด</th>
		<td><input type="text" name="province_id" value="<?php echo @$rs['province_id'] ?>" class="input_box_patient"><span class="alertred">*</span></td>
</tr>
<tr><th>รูปแบบเขตความรับผิดชอบ</th>
		<td><?php echo form_dropdown('area_id',get_option('id','name','n_area order by created desc'),@$rs['area_id'],'class="styled-select"','-โปรดเลือก-'); ?><span class="alertred">*</span></td>
</tr>
<tr><th>เขตความรับผิดชอบ</th>
		<td><select name="level" class="styled-select"><option value="">-โปรดเลือก-</option></select><span class="alertred">*</span></td>
</tr>
<tr>
	<th>จำนวนประชากร</th>
	<td><input type="text" class="input_box_patient" name="provincepeople" value="<?php echo @$rs['provincepeople'] ?>"><span class="alertred">*</span></td>
</tr>
</table>
<div class="btn_inline">
<?php echo (@$rs['id']) ? form_hidden('updated',time()) : form_hidden('created',time());
			echo form_hidden('year',date('Y'));
?>
      <ul>
      	<li><button class="btn_save" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="button">&nbsp;&nbsp;&nbsp;</button></li>
      </ul>
</div>
</form>