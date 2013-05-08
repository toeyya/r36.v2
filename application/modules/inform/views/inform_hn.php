<script type="text/javascript">
$(document).ready(function(){
var province_id;	
	$("select[name=hospitalprovince]").change(function(){
		 province_id=$("select[name=hospitalprovince] option:selected").val();
		$.ajax({
		type:'get',
		url:'<?php echo base_url() ?>district/getAmphur',
		data:'ref1='+province_id,
		success:function(data){
			$('#input_Hamphur').html(data);
			$('#input_Hospital').html('<select name="hospital" class="textbox" id="hospital"><option value="">-โปรดเลือก-</option></select>');
		}
		});
	});



	$("select[name=hospitalamphur]").live('change',function(){
		var id=$("select[name=hospitalamphur] option:selected").val();
		$.ajax({
			type:'get',
				url:'<?php echo base_url() ?>district/getHospital',
			data:'ref1='+province_id+'&ref2='+id,
			success:function(data){
				$("#input_Hospital").html(data);
			}
		});
	});
	$('#checkerID').click(function(){	
		if(chkid(document.form1))
		{									
				//alert("yoo hoo");			
				if(FChkCardID(document.form1))
				{
					//alert('yoo hoo1');
					var hospital_code=$('select[name=hospital] option:selected').val();
					var province_id=$("select[name=hospitalprovince] option:selected").val();
					var amphur_id=$('select[name=hospitalamphur] option:selected').val();
					var in_out=$("input[name=in_out]").val();		
					var statusid=$("select[name=statusid] option:selected").val();
					//var cardW0=$("input[name=cardW0]").val();
					//var cardW1=$('input[name=cardW1]').val();
					//var cardW2=$("input[name=cardW2]").val();
					//var cardW3=$("input[name=cardW3]").val();
					//var cardW4=$("input[name=cardW4]").val();
					var idcard=$("input[name=cardW0]").val()+$("input[name=cardW1]").val()+$("input[name=cardW2]").val()+$("input[name=cardW3]").val()+$("input[name=cardW4]").val();
					var idpassport=$("input[name=idpassport]").val();			
					$(this).attr('href','inform/chk_idcard_informhn?statusid='+statusid+'&idcard='+idcard+'&idpassport'+idpassport
					+'&hospital_code='+hospital_code+'&hospitalprovince='+province_id+'&hospitalamphur='+amphur_id+'&in_out='+in_out);
					$(this).colorbox({iframe:true, innerWidth:700, innerHeight:700});			
				}
		}
	});

});
 
</script>
<form name="form1"  method="get" >		
	<table width="95%"class="tbform">				
			<input name="process" type="hidden" value="view" />
			<tr> 
			  	<th height="20" colspan="4"  class="headtable thhead">ค้นหาข้อมูลผู้สัมผัส หรือสงสัยว่าสัมผัสโรคพิษสุนัขบ้า</th>
			</tr>
			<tr> 
				  <th width="90" height="20"  class="topic">จังหวัด :</th>
				  <td width="240" height="20">
						<?php echo form_dropdown('province_id',get_option('province_id','province_name',"n_province where province_id <>'' order by province_name asc"),@$_GET['province_id'],'class="textbox" id="province"','-โปรดเลือก-') ?>
				  </td>
				  <th height="20"  class="topic">อำเภอ :</th>
				  <td height="20">
						<span id="input_amphur">
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
				  </td>
			</tr>

			<tr> 
				  <th height="20"  class="topic">ตำบล :</th>
				  <td height="20">
						<span id="input_district">
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
				  </td>
				   <th class="topic">สถานพยาบาล :</th>
				  <td> 
						<span id="input_hospital">											
								<?
							
								$whhospital="";
								 if(@$_GET['amphur_id']){
										$whhospital=" hospital_id<>'' AND hospital_amphur_id ='".@$_GET['amphur']."' AND hospital_district_id ='".@$_GET['district_id']."' ";
										
								 }else{								 										 
									  $whhospital=" hospital_id=''";
								 }
										echo form_dropdown('hospital',get_option('hospital_code','hospital_name',"n_hospital where $whhospital ORDER BY hospital_name ASC"),@$_GET['hospital'],'class="textbox"','-โปรดเลือก-');
					  			 ?>
						</span> 
				  </td>
			</tr>

			<tr> 
				  <th class="topic">รหัส HN :</th>
				  <td><input name="hn" type="text" id="hn" size="30" maxlength="300"  class="textbox" value="<?php echo @$_GET['hn'] ?>"></td>
				  <th class="topic">เลขที่บัตรประชาชน/เลขที่ Passport :</th>
				  <td><input name="idcard" type="text" id="idcard" size="30" maxlength="300"  class="textbox" value="<?php echo @$_GET['idcard']?>"></td>
			
			</tr>
			<tr> 
				  <th class="topic">ชื่อ :</th>
				  <td><input name="name" type="text" id="name" size="30" maxlength="300"  class="textbox" value="<?php echo @$_GET['name'] ?>"></td>
				  <th  class="topic">นามสกุล :</th>
				  <td><input name="surname" type="text" id="surname" size="30" maxlength="300"  class="textbox" value="<?php echo @$_GET['surname'] ?>"></td>
			</tr>

			<tr> 
				  <th height="20"   class="topic">วันเริ่มต้น :</th>
				  <td><input type="text" name="startdate" size="10" class="textbox datepicker" readonly="" value="<?php echo @$_GET['startdate'] ?>" /></td>
				  <th height="20"   class="topic">วันสิ้นสุด : </th>
				  <td><input type="text" name="enddate" size="10" class="textbox datepicker" readonly="" value="<?php echo @$_GET['enddate']; ?>" /> </td>				  
			</tr>
			<tr>
				<th class="topic">ประเภทผู้สัมผัสโรค</th>
				<td colspan="2"><input type="radio" name="statusid" value="1">ในเขต<input type="radio" value="2" name="statusid">นอกเขต</td>
			</tr>
			<tr>
				  <th height="20"   class="topic" >จำนวนวัคซีน :</th>
				  <td colspan="3">					
							<ul class="list">
								<li><input type="checkbox" name="total_vaccine[]" value="0" <?php if(@$_GET['total_vaccine']){if(in_array('0',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
									<img src="images/0vaccine.gif" border="0"/> ปิด Case ไม่สมบูรณ์</li>
								<li><input type="checkbox" name="total_vaccine[]" value="1"<?php if(@$_GET['total_vaccine']){if(in_array('1',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
									<img src="images/1vaccine.gif" border="0" /> ปิด Case ฉีด 1 เข็ม</li>
								<li><input type="checkbox" name="total_vaccine[]" value="2"<?php if(@$_GET['total_vaccine']){if(in_array('2',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
								<img src="images/5vaccine.gif" border="0" /> ปิด Case ฉีด 2 เข็ม</li>
							</ul>
							<ul class="list">
							<li><input type="checkbox" name="total_vaccine[]" value="3"<?php if(@$_GET['total_vaccine']){if(in_array('3',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
								<img src="images/2vaccine.gif" border="0" /> ปิด Case ฉีด 3 เข็ม</li>
							<li><input type="checkbox" name="total_vaccine[]" value="4"<?php if(@$_GET['total_vaccine']){if(in_array('4',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
								<img src="images/3vaccine.gif" border="0" /> ปิด Case ฉีด 4 เข็ม</li>
							<li><input type="checkbox" name="total_vaccine[]" value="5"<?php if(@$_GET['total_vaccine']){if(in_array('5',$_GET['total_vaccine'])){ echo 'checked="checked"';}} ?>>
								<img src="images/4vaccine.gif" border="0" /> ปิด Case ฉีด 5 เข็ม</li>
							</ul>
							
					</td>						
			</tr>
			<tr align="center" > 
				  <td height="20" colspan="4">
					  <input type="submit" name="ok" value="ตกลง" class="Submit"> &nbsp; 
					  <input type="reset" name="reset" value="ยกเลิก"  class="Submit">
				  </td>
			</tr>				
	  </table>
</form>
	
