<script type="text/javascript">
$(document).ready(function(){
	$("select[name=provinceidplace]").change(function(){
		$("#input_amphur_place").html('<img src="images/loader.gif" width="16" height="11">');
		var ref1=$("select[name=provinceidplace] option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=amphuridplace&ref1='+ref1,
			success:function(data){
				$("#input_amphur_place").html(data);
			}		
		});
	});
	$("select[name=amphuridplace]").live('change',function(){
		var ref2=$("select[name=amphuridplace] option:selected").val();
		var ref1=$("select[name=provinceidplace] option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=districtidplace&ref1='+ref1+'&ref2='+ref2,
			success:function(data){
				$("#input_district_place").html(data);
			}		
		});
	});
	
	$("select[name=province_id]").change(function(){
		$("#input_amphur").html('<img src="images/loader.gif" width="16" height="11">');
		var ref1=$("select[name=province_id] option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'ref1='+ref1,
			success:function(data){
				$("#input_amphur").html(data);
			}		
		});
	});
	$("select[name=amphur_id]").live('change',function(){
		var ref2=$("select[name=amphur_id] option:selected").val();
		var ref1=$("select[name=province_id] option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'ref1='+ref1+'&ref2='+ref2,
			success:function(data){
				$("#input_district").html(data);
			}		
		});
	});
	$("select[name=district_id]").live('change',function(){
		var ref2=$("select[name=amphur_id] option:selected").val();
		var ref1=$("select[name=province_id] option:selected").val();
		var ref3=$('select[name=district_id] option:selected').val();
		$.ajax({
			url:'<?php echo base_url() ?>hospital/getHospital',
			data:'ref1='+ref1+'&ref2='+ref2+'&ref3='+ref3,
			success:function(data){
				$("#input_hospital").html(data);
			}		
		});
	});
	$('.btn_delete').click(function(){
		var c=confirm('คุณแน่ใจแล้วที่จะลบรายการนี้');
		var information_id=$(this).next().val();
		var historyid=$(this).next().next().val();
		if(c){								
				$.ajax({
					url:'<?php echo base_url() ?>inform/delete',
					data:'id='+information_id+'&historyid='+historyid,
					success:function(){
						location.reload();
						
					}
				})
		}
	})
	
});
</script>
<form name="form1"  method="get">		
	<table width="95%"  class="tbform">				
			<input name="process" type="hidden" value="view" />
			<tr > 
			  	<th height="20" colspan="4"  class="headtable thhead">ค้นหาข้อมูลคนไข้ที่เสียชีวิต</th>
			</tr>
			<tr > 
				 <th width="90" height="20"   class="topic" >เขตพื้นที่รับเชื้อ :</th>
				  <td width="240" height="20" colspan="4"><p>
						จังหวัด <?php echo form_dropdown('provinceidplace',get_option('province_id','province_name',"n_province where province_id <>'' order by province_name asc"),@$_GET['province_id'],'class="textbox" id="provinceidplace"','-โปรดเลือก-') ?>
						อำเภอ <span id="input_amphur_place">
							<?php 
							$whamphur="";
							 if(@$_GET['province_id']){
									$whamphur="AND province_id ='".@$_GET['province_id']."'";
								 	$amphur_id="amphur_id <>'' ";	
								 										
							 }else{
							 	 	$amphur_id="amphur_id ='' ";
							 }
							 echo form_dropdown('amphuridplace',get_option('amphur_id','amphur_name',"n_amphur where $amphur_id $whamphur  order by amphur_name asc"),@$_GET['amphur_id'],'class="textbox"','-โปรดเลือก-');
							?>
					</span>
					ตำบล <span id="input_district_place">
							<?php
							$wh="";
							 if(@$_GET['province_id']){
									$wh="AND province_id ='".@$_GET['province_id']."' AND amphur_id='".$_GET['amphur_id']."'";	
								 	$whdistrict="  district_id<>''";							 										
							 }else{
							 		$whdistrict="  district_id=''";
							 }	
							 echo form_dropdown('districtidplace',get_option('district_id','district_name',"n_district where $whdistrict $wh  order by district_name asc"),@$_GET['district_id'],'class="textbox"','-โปรดเลือก-');
							?>
					 </span>
 					</p>
				  </td>
			</tr>

			<tr> 
				  <th class="topic">สถานพยาบาล :</th>
				  <td width="240" height="20" colspan="4" ><p>
						จังหวัด <?php echo form_dropdown('province_id',get_option('province_id','province_name',"n_province where province_id <>'' order by province_name asc"),@$_GET['province_id'],'class="textbox" id="province"','-โปรดเลือก-') ?>
						อำเภอ <span id="input_amphur">
							<?php 
							$whamphur="";
							 if(@$_GET['province_id']){
									$whamphur="AND province_id ='".@$_GET['province_id']."'";
								 	$amphur_id="amphur_id <>'' ";	
								 										
							 }else{
							 	 	$amphur_id="amphur_id ='' ";
							 }
							 echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name',"n_amphur where $amphur_id $whamphur  order by amphur_name asc"),@$_GET['amphur_id'],'class="textbox"','-โปรดเลือก-');
							?>
					</span>
					
					ตำบล <span id="input_district">
							<?php
							$wh="";
							 if(@$_GET['province_id']){
									$wh="AND province_id ='".@$_GET['province_id']."' AND amphur_id='".$_GET['amphur_id']."'";	
								 	$whdistrict="  district_id<>''";							 										
							 }else{
							 		$whdistrict="  district_id=''";
							 }	
							 echo form_dropdown('district_id',get_option('district_id','district_name',"n_district where $whdistrict $wh  order by district_name asc"),@$_GET['district_id'],'class="textbox"','-โปรดเลือก-');
							?>
					</span>
					</p>		
					<p>		  	
					สถานพยาบาล <span id="input_hospital">											
								<? //$this->db->debug=TRUE;
								$whhospital="";
								 if(@$_GET['amphur_id']){
										$whhospital="AND hospital_amphur_id ='".@$_GET['amphur_id']."' AND hospital_district_id ='".@$_GET['district_id']."' ";
										echo form_dropdown('hospital',get_option('hospital_code','hospital_name',"n_hospital where hospital_id<>'' $whhospital ORDER BY hospital_name ASC"),@$_GET['hospital'],'class="textbox"','-โปรดเลือก-');
								 }else{								 										 
							 ?>
					 		 <select name="hospital" id="hospital" class="textbox">
					 		 	<option value="">-โปรดเลือก-</option>
					 		 </select>
					 <?php } ?>
					</span> 
					</p>
				  </td>

			</tr>
			<tr>
				  <th class="topic">เลขที่บัตรประชาชน/เลขที่ Passport :</th>
				  <td colspan="4"><input name="idcard" type="text" id="idcard" size="30" maxlength="300"  class="textbox" value="<?php echo @$_GET['idcard']?>"></td>
			</tr>

			<tr> 
				  <th  class="topic">ชื่อ :</th>
				  <td><input name="name" type="text" id="firstname" size="30" maxlength="300"  class="textbox" value="<?php echo @$_GET['firstname'] ?>"></td>
				  <th class="topic">นามสกุล :</th>
				  <td><input name="surname" type="text" id="surname" size="30" maxlength="300"  class="textbox" value="<?php echo @$_GET['surname'] ?>"></td>

			</tr>

			<tr> 
				  <th height="20" class="topic">วันเริ่มต้น :</th>
				  <td><input type="text" name="startdate" size="10" class="textbox datepicker" readonly="" value="<?php echo @$_GET['startdate'] ?>" /></td>
				  <th height="20"  class="topic">วันสิ้นสุด : </th>
				  <td><input type="text" name="enddate" size="10" class="textbox datepicker" readonly="" value="<?php echo @$_GET['enddate']; ?>" /> </td>				  
			</tr>
			
			<tr align="center" > 
				  <td height="20" colspan="4">
					  <input type="submit" name="ok" value="ตกลง" class="Submit"> &nbsp; 
					  <input type="reset" name="reset" value="ยกเลิก"  class="Submit">
				  </td>
			</tr>				
	  </table>
</form>
<?php if(!empty($result)): ?>
			<table width="100%" class="tbform">
			  <tr><th colspan="8"  class="headtable thhead">รายชื่อคนไข้ที่เสียชีวิต</th></tr>
			  <tr>
			  <tr>
					<th width="5%" ><div align="center" class="topic">ลำดับ</div></th>
					<th width="10%" ><div align="center" class="topic"> เลขประจำตัวประชาชน<br />/ เลขที่ passport </div></th>
					<th width="18%" ><div align="center" class="topic">ชื่อ - นามสกุล</div></th>
					<th width="14%" ><div align="center" class="topic">สถานพยาบาล</div></th>
					<th width="10%" ><div align="center" class="topic">ตำบล</div></th>
					<th width="10%" ><div align="center" class="topic">อำเภอ</div></th>
					<th width="9%" ><div align="center" class="topic">จังหวัด</div></th>
					<th width="14%" ><div align="center" class="topic">การกระทำ</div></th>				
			 </tr>
			 <?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;?>
			 <?php foreach($result as $item): ?>
			 <tr>
			 	<td><?php echo $i;?></td>
			 	<td><?php echo $item['idcard']; ?></td>
			 	<td><?php echo $item['firstname'] ?> <?php echo $item['surname'] ?></td>
			 	<td></td>
			 	<td></td>
			 	<td></td>
			 	<td></td>
			 	<td><a href="" target="_blank">ดู</a>/<a href="" target="_blank">แก้ไข</a></td>
			 </tr>
			 <?php ++$i;endforeach; ?>
			  <tr><td colspan="10" ><?php echo $pagination; ?></td></tr>	
<?php endif; ?>