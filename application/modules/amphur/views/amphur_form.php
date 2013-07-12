<script type="text/javascript">
$(document).ready(function(){

})
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
<tr><th></th>
	<td><input  class="btn" type="submit" value="ตกลง"></td>
</tr>

</table>

<?php echo (@$rs['amp_pro_id']) ? form_hidden('updated',time()) : form_hidden('created',time());
			echo form_hidden('year',date('Y'));
			echo form_hidden('amp_pro_id',@$rs['amp_pro_id']);
?>
</form>