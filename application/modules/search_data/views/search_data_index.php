<script type="text/javascript">
$(document).ready(function(){

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
				   <th class="topic">สถานพยาบาล:</th>
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
	<?php if(isset($result)){  ?>
			<table width="100%" class="tbform">
			  <tr>
				<th colspan="8"  class="headtable thhead">
				<div align="center">รายชื่อผู้สัมผัส หรือสงสัยว่าสัมผัสโรคพิษสุนัขบ้า</div></th>
			  </tr>
			  <tr>
			 <tr>
					<th width="5%" class="topic">ลำดับ</th>
					<th width="9%" class="topic"> HN</th>
					<th width="10%" class="topic"> เลขประจำตัวประชาชน<br />/ เลขที่ passport</th>
					<th width="18%" class="topic">ชื่อ - นามสกุล</th>
					<th width="7%" class="topic">วันที่สัมผัสโรค</th>
					<th width="14%" class="topic">สถานพยาบาล</th>
					<th width="10%" class="topic">ตำบล</th>
					<th width="10%" class="topic">อำเภอ</th>
					<th width="9%" class="topic">จังหวัด</th>
					<th width="14%" class="topic">การกระทำ</th>				
			 </tr>
			<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;?>
			 <?php	
			 foreach($result as $key=>$item): 
			 			if($item['closecase']=='2'){
								if($item['total_vaccine']=='5'){
									$bgcolor= 'style="background-color:#82EC92"';
								}else if($item['total_vaccine']=='4'){
									$bgcolor= 'style="background-color:#FFD24A"';
								}else if($item['total_vaccine']=='3'){
									$bgcolor= 'style="background-color:#FF9E5E"';
								}else if($item['total_vaccine']=='2'){
									$bgcolor= 'style="background-color:#B87EB5"';
								}else if($item['total_vaccine']=='1'){
									$bgcolor= 'style="background-color:#FF5B5B"';
								}else{ 
									$bgcolor= 'style="background-color:#ACACAC" ';
								}
						}else{ 
							$bgcolor= 'style="background-color:#FFFFFF" ';
						}

			  			$rechospital_id=$this->db->GetRow("SELECT hospitalprovince,hospitalamphur,hospitalcode,hn,hn_no FROM n_information WHERE id= ?  ORDER BY id DESC",$item['id']);
			  			$hospital_name=$this->db->GetOne("SELECT hospital_name FROM n_hospital WHERE hospital_code= ? ",$rechospital_id['hospitalcode']);
						$amphur_name=$this->db->GetOne("SELECT amphur_name FROM n_amphur WHERE amphur_id= ?  AND  province_id = ? ",array($rechospital_id['hospitalamphur'],$rechospital_id['hospitalprovince']));
						$province_name=$this->db->GetOne("SELECT province_name FROM n_province WHERE   province_id = ? ",$rechospital_id['hospitalprovince']);
						$district_name =$this->db->GetOne("SELECT district_name FROM n_district WHERE amphur_id = ? and province_id= ? and district_id= ? ",array($rechospital_id['hospitalamphur'],$rechospital_id['hospitalprovince'],''));
			  ?>
			  	<tr>
					<td align="center" valign="top" <?php echo $bgcolor?>><?php echo $i?>.</td>
					<td valign="top" nowrap="nowrap" <?php echo $bgcolor?>><?php echo $rechospital_id['hn']; if($rechospital_id['hn_no']!=0){ echo '-'.$item['hn_no'];}?></td>
					<td valign="top" align="center" <?php echo $bgcolor?>><? if($item['idcard']){ echo $item['idcard'];}else{ echo '-';}?></td>
					<td valign="top" <?php echo $bgcolor?>><?php echo $item['firstname'].' '.$item['surname'];?></td>
					<td valign="top" <?php echo $bgcolor?>><?php echo cld_my2date($item['datetouch']) ?></td>
					<td valign="top" <?php echo $bgcolor?>><?php echo $hospital_name  ?></td>
					<td valign="top" <?php echo $bgcolor?>><?php echo $district_name  ?></td>
					<td valign="top" <?php echo $bgcolor?>><?php echo $amphur_name ?></td>
					<td valign="top"<?php echo $bgcolor?>><?php echo $province_name ?></td>
					<td align="center" valign="top" <?php echo $bgcolor?>> 
						<a href="inform/form/<?php echo $item['id'] ?>/<?php echo $item['historyid'] ?>/<?php echo $item['in_out'] ?>/view" target="_blank">ดู</a> 
					<? if(($this->session->userdata('R36_LEVEL')=='00' ) || ($this->session->userdata['R36_LEVEL']=='02' && ($this->session->userdata('R36_PROVINCE')==$rechospital_id['hospitalprovince'])&&$item['closecase']!='2')){?>
					/ <a href="inform/form/<?php echo $item['id'] ?>/<?php echo $item['historyid'] ?>/<?php echo $item['in_out'] ?>" target="_blank">แก้ไข</a>
					/ <a href="javascript:void(0)" class="btn_delete"  >ลบ</a> 
					<input type="hidden" name="information_id" value="<?php echo $item['id'] ?>">
					<input type="hidden" name="historyid" value="<?php echo  $item['historyid'] ?>">
					<? }else if($_SESSION['R36_LEVEL']=='02' && ($this->session->userdata('R36_PROVINCE')!=$rechospital_id['hospitalprovince']) &&$item['closecase']!='2'){?>
					/  <a href="#" onclick="forceopeneraddvaccine('<?=$item['id']?>','<?=$item['historyid']?>');">เพิ่มข้อมูลการฉีด</a> 
					<? }else if((($this->session->userdata('R36_LEVEL')=='05' && $this->session->userdata('R36_FROMEDIT')=='Y'&& ($this->session->userdata('R36_HOSPITAL')==$rechospital_id['hospitalcode'] )&&$item['closecase']!='2') || ($this->session->userdata('R36_LEVEL')=='03' && $this->session->userdata('R36_FROMEDIT')=='Y'&& ($this->session->userdata('R36_HOSPITAL')==$rechospital_id['hospitalcode'] )&&$item['closecase']!='2') )){?>
					/ <a href="inform/form/<?php echo $item['id'] ?>/<?php echo $item['historyid'] ?>/<?php echo $item['in_out'] ?>" target="_blank">แก้ไข</a> 
					<? }else if(($this->session->userdata('R36_LEVEL')=='05' || $this->session->userdata('R36_LEVEL')=='03') && $this->session->userdata('R36_FROMEDIT')=='Y' && ($this->session->userdata('R36_HOSPITAL')!=$rechospital_id['hospitalcode'])&&$item['closecase']!='2'){?>
					/ <a href="#" onclick="forceopeneraddvaccine('<?=$item['id']?>','<?=$item['historyid']?>');">เพิ่มข้อมูลการฉีด</a> 
					<? }?></td>
			   </tr>
			 <?php $i++;endforeach; 
			 }
			 ?>	
			 <tr><td colspan="10"><?php echo $pagination; ?></td></tr>				 	
			</table>
			