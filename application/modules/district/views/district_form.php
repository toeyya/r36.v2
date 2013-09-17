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

	var ref1;
	$('select[name=province_id]').change(function(){
		ref1=$('select[name=province_id] option:selected').val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=amphur_id&ref1='+ref1,
			success:function(data){$("#input_amphur").html(data);}
		});
	});	//select name=province
	$("select[name=amphur_id]").live('change',function(){
		var ref2=$('select[name=amphur_id] option:selected').val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=district_id&ref1='+ref1+'&ref2='+ref2,
			success:function(data){$("#input_district").html(data);}
		})
	});
});	
</script>
<h1>ข้อมูลตำบล(แก้ไข)</h1>
<form action="district/admin/district/save" method="post" id="formm">
<table  class="form">
<tr> 
  <th>โค้ดตำบล</th>
  <td><input type="text"  name="district_id" value="<?php echo @$rs['district_id'] ?>" readonly="readonly"></td>
</tr>
<tr> 
  <th>จังหวัด</th>
  <td>  	  		
  		<?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['province_id'],'id="province_id"','-โปรดเลือก-'); ?>  	  	
  </td>
</tr>
<tr> 
  <th>อำเภอ</th>
  <td>
  <span id="input_amphur">	
	<?php	
	if($rs['province_id'] && $rs['amphur_id']){											
		echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name',"n_amphur",'amphur_name ASC',"province_id='".@$rs['province_id']."' and amphur_id='".@$rs['amphur_id'] ."'"),@$rs['amphur_id'],'','-โปรดเลือก-'); 							
	}else{ ?>
		<select name="amphur_id"><option value="">--โปรดเลือก--</option></select>		
	<?php } ?>					
	</span> 
  </td>
</tr>

<tr> 
  <th>ตำบล</th>
  <td>
  	<input name="district_name" type="text" id="district_name" size="30" maxlength="300"   value="<?php echo ThaiToUtf8($rs['district_name'])?>"> 
  	<input type="hidden" name="tam_amp_id"  value="<?php echo $rs['tam_amp_id'] ?>"/>
    <input type="hidden" name="district_id"      value="<?php echo $rs['district_id']?>" />
   <?php echo ($rs['tam_amp_id']) ? form_hidden('updated',time()) : form_hidden('created',time())?>	
  </td>
</tr>
<tr>
	<th>จำนวนประชากร <br/><span class="alertred">กรุณาระบุเฉพาะตัวเลข</span></th>
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
			<input type="text" 	 name="people[]"class="input_box_patient"  value=""> </p>			
		<?php endif; ?>				
	</td>
</tr>
<tr>
	<th></th>
	<td><input type="submit" name="btn_save" class="btn" value="ตกลง"></td>
</tr>
</table>
</form>