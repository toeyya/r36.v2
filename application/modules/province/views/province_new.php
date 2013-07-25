<script type="text/javascript">
$(document).ready(function(){
var province_id;
$("select[name=province_id]").change(function(){
	province_id=$("select[name=province_id] option:selected").val();	
	$('#input_amphur').html('<img src="media/images/loader.gif" width="16px" height="11px"/>');	
	$.ajax({
		url:'<?php echo base_url() ?>district/getAmphur',
		data:'name=amphur_id&ref1='+province_id,
		success:function(data){
			$('#input_amphur').html(data);
						
		}
	});	
})
$("select[name=amphur_id]").live('change',function(){
	$('input[name=province_name]').val($('select[name=amphur_id] option:selected').text());
	var amphur_id = $('select[name=amphur_id] option:selected').val();
	$.ajax({
		url:'<?php echo base_url() ?>province/getHospital',
		data:'name=hospital&province_id='+province_id+'&amphur_id='+amphur_id,
		success:function(data){
			$('#input_hospital').html(data);						
		}
	});
});

$("select[name=province_new_id]").change(function(){
	province_id=$("select[name=province_new_id] option:selected").val();
	$('#input_amphur_new').html('<img src="media/images/loader.gif" width="16px" height="11px"/>');	
	$.ajax({
		url:'<?php echo base_url() ?>province/getAmphurNew',
		data:'province_id='+province_id,
		success:function(data){
			$('#input_amphur_new').html(data);			
		}
	});	
})





		

})
</script>
<h1>เพิ่มจังหวัดใหม่</h1>
<form action="province/save_province_new" method="post" id="formm">
<table  class="form">
<tr><th  width="20%">วันที่ cutoff ข้อมูล</th>
	<td><input type="text" name="date_cutoff" value="" class="datepicker"></td>
</tr>	
<tr><th>จังหวัดใหม่</th>
<td><p><?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['province_id'],'class="styled-select" id="province_id"','-โปรดเลือกจังหวัด-') ?></p>
	<p id="input_amphur" style="margin:10px 0px;"><select name="amphur_id" class="styled-select"><option value="">-โปรดเลือกอำเภอ-</option></select></p>
</td>
</tr>
<tr>
	<th>อำเภอใหม่</th>
	<td>
		<p><?php echo form_dropdown('province_new_id',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['province_id'],'class="styled-select" id="province_id"','-โปรดเลือกจังหวัด-') ?></p>
		<p id="input_amphur_new" style="margin:10px 0px;"></p>		
	</td>
</tr>
<tr>
	<th>สถานบริการที่ย้ายไป</th>
	<td id="input_hospital"></td>
</tr>
<tr><th>รูปแบบเขตความรับผิดชอบ</th>
	<td>
		<?php foreach($area as $item): ?>
			<p style="margin:10px 0px;"><input type="checkbox" name="area_id[]" value="<?php echo $item['id'] ?>"> <?php echo $item['name'] ?> 
			<span>
				
				<?php echo form_dropdown("level[".$item['id']."]",getLevel($item['id'],$item['total']),'','') ?></span></p>
		<?php endforeach; ?>
	</td>
</tr>
<tr>
	<th></th>
	<td>  <input type="submit" class="btn" value="ตกลง" name="btn_submit"></td>
</tr>
</table>
<input type="hidden" value="" name="province_name">
<?php echo (@$rs['id']) ? form_hidden('updated',time()) : form_hidden('created',time());
			echo form_hidden('year',date('Y'));
?>
     
</form>