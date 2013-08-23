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
  	<?php if(!empty($rs['province_id'])){  		
  		echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$rs['province_id'],'id="province_id"','-โปรดเลือก-');
  	}else{?>
  		<select name="province_id"><option>-โปรดเลือก-</option></select>
 <?php } ?>
  	
  </td>
</tr>
<tr> 
  <th>อำเภอ</th>
  <td>
  <span id="input_amphur">	
	<?php	
	if($rs['province_id'] && $rs['amphur_id']){											
		echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name',"n_amphur",'amphur_name ASC',"province_id='".@$rs['province_id']."' and amphur_id='".@$rs['amphur_id'] ."'"),@$rs['amphur_id'],'id="amphur_id"','-โปรดเลือก-'); 							
	}
	?>	
				
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
	<th></th>
	<td><input type="submit" name="btn_save" class="btn" value="ตกลง"></td>
</tr>
</table>
</form>