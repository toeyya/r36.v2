<script type="text/javascript">
$(document).ready(function(){
	$("#province_id").change(function(){
			var id=$("select[name=province_id] option:selected").val();
			$.ajax({
				type:'GET',
				url:'<?php echo base_url() ?>district/getAmphur',
				data:'ref1='+id,
				success:function(data)
				{$("#input_amphur").html(data);}
			});
	});
	$('#formm').validate({
			rules:{
				province_id:"required",
				amphur_id:"required",
				district_name:{
					required:true,	
					remote:{
						url :"<?php echo base_url(); ?>district/distrctExists",
						type:"get",
						data: {
							province_id: function () {return $('#province_id').val();},
							amphur_id: function () {return $('#amphur_id').val();},								
					   }//close data			
					}//remote  
				}//hospital_name						
			},
			messages:{
				province_id:"กรุณาเลือกจังหวัด",
				amphur_id:"กรุณาเลือกอำเภอ",
			    district_name:{
					required:"กรุณากรอกชื่อตำบล",
					remote:"ชื่อตำบลซ้ำ"
				}		
			},
			errorPlacement: function(error, element){
				error.appendTo(element.parent());		
				if(element.attr('name')=="amphur_id")
				{
					error.appendTo(element.parent().parent());
				}				
			}					
		});


});
</script>
<div id="title">ข้อมูลตำบล(เพิ่ม/แก้ไข)</div>
<form action="district/save" method="post" id="formm">
<table  class="tbform">
<tr>
	<th width="20%">รูปแบบเขตความรับผิดชอบ</th>
	<td><?php echo form_dropdown('area_id',get_option('id','name','n_area order by created desc'),@$rs['area_id'],'class="styled-select"','-โปรดเลือก-'); ?><span class="alertred">*</span></td>
</tr>
<tr> 
  <th>จังหวัด</th>
  <td>
  	<?php if($rs['area_id'] && $rs['province_id']){  		
  		echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['province_id'],'class="styled-select" id="province_id"','-โปรดเลือก-');
  	}else{?>
  		<select name="province_id" class="styled-select"><option>-โปรดเลือก-</option></select>
 <?php } ?>
  	<span class="alertred">*</span>
  </td>
</tr>
<tr> 
  <th>อำเภอ</th>
  <td>
  <span id="input_amphur">	
	<?php	
		if($rs['province_id'] && $rs['amphur_id']){											
		echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name',"n_amphur",'amphur_name ASC',"province_id='".@$rs['province_id']."' and amphur_id='".@$rs['amphur_id'] ."'"),@$rs['amphur_id'],'class="input_box_patient " id="amphur_id"','-โปรดเลือก-'); 							
		}else{
	?>	
	<?php } ?>			
	</span> <span class="alertred">*</span>
  </td>
</tr>
<tr> 
  <th>โค้ดตำบล</th>
  <td><input type="text" class="input_box_patient" name="code" value="<?php echo $rs['code'] ?>" size="2" maxlength="2"><span class="alertred">*</span></td>
</tr>
<tr> 
  <th>ตำบล</th>
  <td>
  	<input name="district_name" type="text" id="district_name" size="30" maxlength="300"  class="input_box_patient "  value="<?php echo $rs['district_name']?>"> 
  	<span class="alertred">*</span>
  	  <input type="hidden" name="tam_amp_id"  value="<?php echo $rs['tam_amp_id'] ?>"/>
  <input type="hidden" name="district_id"      value="<?php echo $rs['district_id']?>" />
  <?php echo ($rs['tam_amp_id']) ? form_hidden('updated',time()) : form_hidden('created',time())?>	
  </td>
</tr>
</table>
<div class="btn_inline">
      <ul>
      	<li><button class="btn_save" type="submit" name="btn_save">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="button" name="btn_cancel">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div>
</form>