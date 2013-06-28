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
<div id="title">ค้นหาข้อมูลคนไข้ที่เสียชีวิต</div>
<div id="search">
<form name="form1"  method="get" action="inform/dead/index">		
	<table class="tb_patient1">				
			<input name="process" type="hidden" value="view" />
			<tr> 
				 <th>เขตพื้นที่รับเชื้อ :</th>
				  <td colspan="4"><p>
						จังหวัด <?php echo form_dropdown('provinceidplace',get_option('province_id','province_name',"n_province where province_id <>'' order by province_name asc"),@$_GET['provinceidplace'],'class="styled-select " id="provinceidplace"','-โปรดเลือก-') ?>
						อำเภอ <span id="input_amphur_place">
							<?php //$this->db->debug=TRUE;
							$whamphur="";
							 if(@$_GET['provinceidplace']){
									$whamphur="AND province_id ='".@$_GET['provinceidplace']."'";
								 	$amphur_id="amphur_id <>'' ";	
								 										
							 }else{
							 	 	$amphur_id="amphur_id ='' ";
							 }
							 echo form_dropdown('amphuridplace',get_option('amphur_id','amphur_name',"n_amphur where $amphur_id $whamphur  order by amphur_name asc"),@$_GET['amphuridplace'],'class="styled-select "','-โปรดเลือก-');
							?>
					</span>
					ตำบล <span id="input_district_place">
							<?php
							$wh="";
							 if(@$_GET['provinceidplace']){
									$wh="AND province_id ='".@$_GET['provinceidplace']."' AND amphur_id='".$_GET['amphuridplace']."'";	
								 	$whdistrict="  district_id<>''";							 										
							 }else{
							 		$whdistrict="  district_id=''";
							 }	
							 echo form_dropdown('districtidplace',get_option('district_id','district_name',"n_district where $whdistrict $wh  order by district_name asc"),@$_GET['districtidplace'],'class="styled-select "','-โปรดเลือก-');
							?>
					 </span>
 					</p>
				  </td>
			</tr>

			<tr> 
				  <th>สถานพยาบาล :</th>
				  <td height="20" colspan="4" ><p>
						จังหวัด <?php echo form_dropdown('province_id',get_option('province_id','province_name',"n_province where province_id <>'' order by province_name asc"),@$_GET['province_id'],'class="styled-select " id="province"','-โปรดเลือก-') ?>
						อำเภอ <span id="input_amphur">
							<?php 
							$whamphur="";
							 if(@$_GET['province_id']){
									$whamphur="AND province_id ='".@$_GET['province_id']."'";
								 	$amphur_id="amphur_id <>'' ";	
								 										
							 }else{
							 	 	$amphur_id="amphur_id ='' ";
							 }
							 echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name',"n_amphur where $amphur_id $whamphur  order by amphur_name asc"),@$_GET['amphur_id'],'class="styled-select "','-โปรดเลือก-');
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
							 echo form_dropdown('district_id',get_option('district_id','district_name',"n_district where $whdistrict $wh  order by district_name asc"),@$_GET['district_id'],'class="styled-select "','-โปรดเลือก-');
							?>
					</span>
										สถานพยาบาล <span id="input_hospital">											
								<? //$this->db->debug=TRUE;
								$whhospital="";
								 if(@$_GET['amphur_id']){
										$whhospital="AND hospital_amphur_id ='".@$_GET['amphur_id']."' AND hospital_district_id ='".@$_GET['district_id']."' ";
										echo form_dropdown('hospital',get_option('hospital_code','hospital_name',"n_hospital where hospital_id<>'' $whhospital ORDER BY hospital_name ASC"),@$_GET['hospital'],'class="styled-select "','-โปรดเลือก-');
								 }else{								 										 
							 ?>
					 		 <select name="hospital" id="hospital" class="styled-select ">
					 		 	<option value="">-โปรดเลือก-</option>
					 		 </select>
					 <?php } ?>
					</span> 
					</p>		
				  </td>

			</tr>
			<tr>
				  <th>ชื่อ/สกุล/เลขที่บัตรประชาชน/เลขที่ Passport :</th>
				  <td colspan="4"><input name="name" type="text" id="name" size="30" maxlength="300"  class="input_box_patient " value="<?php echo @$_GET['idcard']?>"></td>
			</tr>

			<tr> 
				  <th height="20">วันเริ่มต้น :</th>
				  <td><input type="text" name="startdate" size="10" class="input_box_patient  datepicker" readonly="" value="<?php echo @$_GET['startdate'] ?>" /></td>
				  <th height="20" >วันสิ้นสุด : </th>
				  <td><input type="text" name="enddate" size="10" class="input_box_patient  datepicker" readonly="" value="<?php echo @$_GET['enddate']; ?>" /> </td>				  
			</tr>					
	  </table>
<div class="btn_inline">
      <ul><li><input class="btn_save" type="submit" name="btn_save" value=""/></li>
      	<li><button class="btn_cancel" type="reset" value="reset">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div>	  
</form>
</div>
<div id="boxAdd"><a href="inform/dead/form" class="btn_add1" title="เพิ่มข้อมูล"></a></div>
<?php if(!empty($result)): ?>
			<table width="70%" class="tb_search_Rabies1">
			  <tr>
			  <tr>
					<th width="5%" >ลำดับ</th>
					<th width="15%" >เลขประจำตัวประชาชน</th>
					<th width="18%" >ชื่อ - นามสกุล</th>
					<th width="14%" >สถานพยาบาล</th>
					<th width="10%" >ตำบล</th>
					<th width="10%" >อำเภอ</th>
					<th width="9%" >จังหวัด</th>
					<th width="14%" >การกระทำ</th>				
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
			 	<td>
			 		<a href="inform/form_dead/<?php echo $item['id'] ?>" target="_blank" class="btn_view" name="btn_view" title="ดู"></a>
			 		<a href="inform/form_dead/<?php echo $item['id']?>" target="_blank" class="btn_edit" title="แก้ไข" name="btn_edit"></a>
			 	</td>
			 </tr>
			 <?php ++$i;endforeach; ?>
			 </table>
			 <?php echo $pagination; ?>			 
<?php endif; ?>