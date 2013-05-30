<script type="text/javascript">
$(document).ready(function(){
	var ref1,ref3,ref5,ref6;	
	$("#provinceid").change(function(){
		ref1=$("#provinceid option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=amphurid&ref1='+ref1,
			success:function(data){
				$("#Input_amphur").html(data);
				$("#districtid option[value='']").attr('selected','selected');
			}
		});
	});;

	$("#amphurid").live('change',function(){	
		var ref2=$("#amphurid option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=districtid&ref1='+ref1+'&ref2='+ref2,
			success:function(data){
				$("#Input_district").html(data);
			}
		})
	});
	$("#provinceidplace").change(function(){
	  ref3=$("#provinceidplace option:selected").val();
		 $.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=amphuridplace&ref1='+ref3,
			success:function(data){
				$("#input_place_amphur").html(data);
				$("#districtidplace option[value='']").attr('selected','selected');
			}
		 });
	});
	$("#amphuridplace").live('change',function(){
		var ref4=$("#amphuridplace option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=districtidplace&ref1='+ref3+'&ref2='+ref4,
			success:function(data){
				$("#input_place_district").html(data);
				$("#districtidplace option[value='']").attr('selected','selected');
			}	
		});		
	});
	
	$("#hospitalprovince").change(function(){
	  ref5=$("#hospitalprovince option:selected").val();
		 $.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=hospitalamphur&ref1='+ref5,
			success:function(data){
				$("#hospital_amphur").html(data);
				$("#hospitaldistrict option[value='']").attr('selected','selected');
			}
		 });
	});
	$("#hospitalamphur").live('change',function(){
		ref6=$("#hospitalamphur option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=hospitaldistrict&ref1='+ref5+'&ref2='+ref6,
			success:function(data){
				$("#hospital_district").html(data);			
			}	
		});		
	});
	$('#hospitaldistrict').live('change',function(){
		var ref7=$("#hospitaldistrict option:selected").val();
		$.ajax({
			url:'<?php echo base_url() ?>hospital/getHospital',
			data:'name=hospitalcode&ref1='+ref5+'&ref2='+ref6+'&ref3='+ref7,
			success:function(data){
				$('#input_hospital').html(data);
			}
		})
	});
	/***********  prevent double submit  ***********/
	$("input[name=submit]").attr('disabled',false);
	$.validator.setDefaults({
		   	  submitHandler: function() {	
			  	$("input[name=submit]").attr('disabled',true);
					document.form1.submit();			
			  }
	});	
	$("#form1").validate({
		rules:{
			firstname:"required",
			surname:"required",
			provinceid:"required",
			amphurid:"required",
			districtid:"required",
			provinceidplace:"required",
			amphuridplace:"required",
			districtidplace:"required",
		     enddate:"required",
			 reportname:"required",
			 positionname:"required",
			 nohome:"required",
			 telname:{
     		 		required: true,
     			 	number: true,
					minlength:6,
					maxlength:10
			 }			
		},
		messages:{
			firstname:"ระบุชื่อ",
			surname:"ระบุนามสกุล",
			provinceid:"ระบุจังหวัดะ",
			amphurid:"ระบุอำเภอ",
			districtid:"ระบุตำบล",
			provinceidplace:"ระบุจังหวัด",
			amphuridplace:"ระบุอำเภอ",
			districtidplace:"ระบุตำบล",
			enddate:"ระบุวันถึงแก่กรรม",
			 reportname:"ระบุชื่อผู้รายงาน",
			 positionname:"ระบุตำแหน่ง",
			 nohome:"ระบุเลขที่่",
			 telname:{
			 	required:"ระบุเบอร์โทรศัพท์",
				number:"ระบุเป็นตัวเลข",
				minlength:"ระบุอย่างน้อย 6 หลัก",
				maxlength:"ระบุไม่เกิน 10 หลัก"
			 }

		},
			errorPlacement: function(error, element){							
				if((element.attr('name')=='firstname') || (element.attr('name')=='surname'))
				{					
					element.next().html(error);				
				}else{
					error.appendTo(element.parent());
				}
						
			}	
	});
});
</script>
<div id="title">แบบฟอร์มคนไข้ที่เสียชีวิต</div>
<form id="form1" name="form1" method="post"  action="inform/save_dead" > 
		<table class="tbchild" width="100%">
		  <tr>
			<td>
				<table width="100%" class="noborder" cellpadding="5" cellspacing="10">
				  <tr>
					<td width="3%" valign="top">1</td>
					<td width="100%" valign="top"><table width="100%" class="noborder">
                      <tr>
                        <td valign="top">
                        		ชื่อ<span class="alertred">*</span> : 
							   <input name="firstname" type="text" class="input_box_patient " id="firstname" value="<?php echo $rs['firstname'];?>" size="20" /><span></span>&nbsp;&nbsp;
							  นามสกุล<span class="alertred">*</span> :
							  <input name="surname" type="text" value="<?php echo $rs['surname'];?>" size="20"  class="input_box_patient "><span></span>&nbsp;&nbsp;
								อายุ : <input name="age" type="text" size="2" value="<?php $rs['age'];?>" onKeyPress="return NumberOnly();" class="input_box_patient auto "> ปี 
								เพศ : <input name="gender" type="radio" value="1" <? if($rs['gender']=='1'){ print "checked";}?>> ชาย&nbsp;&nbsp;
									 	  <input name="gender" type="radio" value="2" <? if($rs['gender']=='2'){ print "checked";}?>> หญิง</td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr>
                            <td width="10%">ที่อยู่ปัจจุบัน</td>
                            <td width="8%"><div align="right">เลขที่ <span class="alertred">*</span>  :</div></td>
                            <td width="19%"><input name="nohome" type="text" class="input_box_patient " size="20" value="<?php echo $rs['nohome'];?>"></td>
                            <td width="12%"><div align="right">หมู่ที่ : </div></td>
                            <td width="19%"><input name="moo" type="text" class="input_box_patient " size="20" value="<?php echo $rs['moo'];?>" /></td>
                            <td width="12%"><div align="right">หมู่บ้าน : </div></td>
                            <td width="20%"><input name="villege" type="text" class="input_box_patient " size="20" value="<?php echo $rs['villege'];?>"></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><div align="right">ซอย : </div></td>
                            <td><input name="soi" type="text" class="input_box_patient " size="20" value="<?php echo $rs['soi'];?>" /></td>
                            <td><div align="right">ถนน : </div></td>
                            <td><input name="road" type="text" class="input_box_patient " id="road" value="<?php echo $rs['road'];?>" size="20" /></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><div align="right">จังหวัด<span class="alertred">*</span>  :</div></td>
                            <td>
                            	<?php 
                            		$class='class="input_box_patient " id="provinceid"';
                            		echo form_dropdown('provinceid',get_option('province_id','province_name','n_province ORDER BY province_name ASC'),@$rs['provinceid'],$class,'-โปรดเลือก-');
								 ?>
                            </td>
                            <td><div align="right">อำเภอ/เขต<span class="alertred">*</span>  : </div></td>
                            <td>
							<span id="Input_amphur">						
								<?
								
								if($rs['provinceid']!=''){
										if($rs['amphurid']!=''){
											$whamp="AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
										}else{
											$whamp="AND province_id='".$rs['provinceid']."'";
										}																				 
									echo form_dropdown('amphurid',get_option('amphur_id','amphur_name',"n_amphur WHERE amphur_id!=''".$whamp."  ORDER BY amphur_name ASC"),@$rs['amphurid'],'class="input_box_patient " id="amphurid"','-โปรดเลือก-');
								}else{									
								?>
									<select name="amphurid" id="amphurid" class="input_box_patient ">
										<option value="">-โปรดเลือก-</option>
									</select>
								<?php } ?>
 							</span>							</td>
                            <td><div align="right">ตำบล/แขวง <span class="alertred">*</span> : </div></td>
                            <td>
							<span id="Input_district">
								<?
								if($rs['amphurid']!=''){
										if($rs['districtid']!=''){
											$whdis="AND district_id ='".$rs['districtid']."' AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
										}else{
											$whdis="AND amphur_id ='".$rs['amphurid']."' AND province_id='".$rs['provinceid']."'";
										}	
																		
										echo  form_dropdown('district_id',get_option('district_id','district_name'," n_district WHERE district_id!='' ". $whdis." ORDER BY district_name ASC"),@$rs['districtid'],'class="input_box_patient " id="districtid"','-โปรดเลือก-');
									}else{
								?>     
									<select name="districtid" id="districtid" class="input_box_patient ">
										<option value="">-โปรดเลือก-</option>
									</select>
								<?php } ?>              
							</span></td>
                          </tr>
                          </table> </td>
                      </tr>
                    </table></td>
				  </tr>
				  <tr>
					<td valign="top">2</td>
					<td><table width="100%" border="0" cellspacing="0" cellpadding="2" class="noborder">
                      <tr>
                        <td valign="top" colspan="2">สถานที่ได้รับเชื้อ(ถูกกัด)  </td>
                      </tr>
                      <tr>
                        <td width="10%">&nbsp;</td>
                        <td width="90%"><table width="65%" border="0" cellspacing="12" cellpadding="2">
                            <tr>
                              <td width="13%"><div align="right">สถานที่ : </div></td>
                              <td colspan="5">
							  			<input name="detail_bite" type="radio" value="1" <?php if($rs['detail_bite']=='1'){ echo 'checked';}?> />ตลาด &nbsp;
										<input name="detail_bite" type="radio" value="2" <?php if($rs['detail_bite']=='2'){ echo 'checked';}?>/>วัด &nbsp;
										<input name="detail_bite" type="radio" value="3" <?php if($rs['detail_bite']=='3'){ echo 'checked';}?>/>โรงเรียน &nbsp;
										<input name="detail_bite" type="radio" value="4" <?php if($rs['detail_bite']=='4'){ echo 'checked';}?>/>บ้านพัก &nbsp;
										<input name="detail_bite" type="radio" value="5" <?php if($rs['detail_bite']=='5'){ echo 'checked';}?> />ที่สาธารณะ &nbsp;
							</td>
                            </tr>
                            <tr>
                              <td><div align="right">จังหวัด <span class="alertred">*</span> : </div></td>
                              <td width="14%">
							 <span id="input_place_province">								
									<?php									
										$class='class="input_box_patient "  id="provinceidplace"';										
										echo form_dropdown('provinceidplace',get_option('province_id','province_name'," n_province WHERE province_id !='' ORDER BY province_name ASC"),$rs['provinceidplace'],$class,'-โปรดเลือก-'); 
									?>
	                          
	                    
							</span></td>
                              <td width="14%"><div align="right">อำเภอ/เขต <span class="alertred">*</span> : </div></td>
                              <td width="16%">
							  <span id="input_place_amphur">								  
									  <?																
											if($rs['provinceidplace']!='')
											{
												$class='class="input_box_patient " id="amphuridplace"';		
																													  
												echo form_dropdown('amphuridplace',get_option("amphur_id","amphur_name"," n_amphur WHERE province_id='".$rs['provinceidplace']."' ORDER BY amphur_name ASC"),$rs['amphuridplace'],$class,'-โปรดเลือก-'); 
											}
											else{
									  ?>	 
									  	 <select name="amphuridplace" id="amphuridplace" class="input_box_patient ">
									  	 	<option value="">-โปรดเลือก-</option>
									  	 </select> 
									  <?php } ?>                      
							  </span> </td>
                              <td width="16%"><div align="right">ตำบล/แขวง <span class="alertred">*</span> : </div></td>
                              <td width="27%">
							  <span id="input_place_district">							                            
                             	<?php 
	                             	if($rs['amphuridplace']!='')
									{
		                             	$cond="n_district WHERE amphur_id ='".$rs['amphuridplace']."' AND  province_id ='". $rs['provinceidplace']."' ORDER BY district_name ASC";
		                             	 echo form_dropdown('districtidplace',get_option('district_id','district_name',$cond),$rs['districtidplace'],'class="input_box_patient " id="districtidplace"','-โปรดเลือก-'); 											
									}else{
								?>
									<select name="districtidplace" id="districtidplace" class="input_box_patient ">
										<option value="">-โปรดเลือก-</option>
									</select>
								<?php } ?>
							  </span>  </td>
                            </tr>
                        </table></td>
                      </tr>
                    </table></td>
				  </tr><!-- ข้อ 2 -->
				  <tr>
					<td valign="top">3</td>
					<td><table width="100%" border="0" cellspacing="0" cellpadding="2" class="noborder">
                      <tr>
                        <td valign="top" colspan="2">สถานพยาบาลที่รักษา  </td>
                      </tr>
                      
                      <tr>
                        <td width="10%">&nbsp;</td>
                        <td width="90%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                            <tr>
                              <td><div align="right">จังหวัด <span class="alertred">*</span> : </div></td>
                              <td width="12%">
							 <span id="input_place_province">								
									<?php									
										$class='class="input_box_patient "  id="hospitalprovince"';										
										echo form_dropdown('hospitalprovince',get_option('province_id','province_name'," n_province WHERE province_id !='' ORDER BY province_name ASC"),@$rs['hospitalprovince'],$class,'-โปรดเลือก-'); 
									?>	                          	                    
							</span></td>
                              <td width="14%"><div align="right">อำเภอ/เขต <span class="alertred">*</span> : </div></td>
                              <td width="14%">
							  <span id="hospital_amphur">								  
									  <?																
											if(!empty($rs['hospitalprovince']))
											{
												$class='class="input_box_patient " id="hospitalamphur"';		
																													  
												echo form_dropdown('hospitalamphur',get_option("amphur_id","amphur_name"," n_amphur WHERE province_id='".$rs['hospitalprovince']."' ORDER BY amphur_name ASC"),@$rs['hospitalamphur'],$class,'-โปรดเลือก-'); 
											}
											else{
									  ?>	 
									  	 <select name="hospitalamphur" id="hospitalamphur" class="input_box_patient ">
									  	 	<option value="">-โปรดเลือก-</option>
									  	 </select> 
									  <?php } ?>                      
							  </span> </td>
                              <td width="14%"><div align="right">ตำบล/แขวง <span class="alertred">*</span> : </div></td>
                              <td width="14%">
							  <span id="hospital_district">							                            
                             	<?php 
	                             	if(!empty($rs['hospitalamphur']))
									{
		                             	$cond="n_district WHERE amphur_id ='".$rs['hospitalamphur']."' AND  province_id ='". $rs['hospitalprovince']."' ORDER BY district_name ASC";
		                             	 echo form_dropdown('hospitaldistrict',get_option('district_id','district_name',$cond),$rs['hospitaldistrict'],'class="input_box_patient " id="hospitaldistrict"','-โปรดเลือก-'); 											
									}else{
								?>
									<select name="hospitaldistrict" id="hospitaldistrict" class="input_box_patient ">
										<option value="">-โปรดเลือก-</option>
									</select>
								<?php } ?>
							  </span> 						  
							  </td>
							<td width="8%"> สถานพยาบาล <span class="alertred">*</span> :</td>
                          	<td>							 
							  	<span id="input_hospital">
							  		<?php $cond="";
							  		if(!empty($rs['hospitalcode']) && !empty($rs['hospitalamphur']) && !empty($rs['hospitalprovince'])){
							  			$cond="WHERE hospital_province_id='".$rs['hospital']."' and hospital_amphur_id='".$rs['hospitalamphur']."' and hospital_district_id='".$rs['hospitaldistrict']."'";
							  			echo form_dropdown('hospitalcode',get_option('hospital_id','hospital_name','n_hospital $cond'),$rs['hospitalcode'],'class="input_box_patient " id="hospital"','-โปรดเลือก-');
									}else{									 	
							  		 ?>
										<select name="hospital" id="hospital" class="input_box_patient ">
											<option value="">-โปรดเลือก-</option>
										</select>
							  		 <?php } ?>
							  	</span></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
				  </tr><!-- ข้อ 2 -->				  
				  <tr>
				    <td >4</td>
				    <td >ชนิดสัตว์ที่กัด : <input name="statusanimal_text" type="text" size="40"  class="input_box_patient " value="<?php echo $rs['statusanimal']?>"/>
					</td>
			      </tr>
				  <tr>
				    <td valign="top">5</td>
				    <td>
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
							  <tr>
									<td colspan="2">สถานภาพสัตว์</td>
							  </tr>
							  <tr>
								<td width="12%"><input name="statusanimal" type="radio" value="1" <? if($rs['statusanimal']=='1'){ echo 'checked';}?> onClick="show_hide_clear_status(document.form1);"/> มีเจ้าของ</td>
									<td width="88%">
									<table width="100%" border="0" cellpadding="0" cellspacing="0" id="statusanimal_table"  <? if($rs['statusanimal']!='2'){echo 'style="display:none"';}?>>
										  <tr>
											<td width="22%"><input name="statusanimal_detail" type="radio" value="3" <? if($rs['statusanimal_detail']=='3'){ echo 'checked';}?>/> ของผู้อื่น</td>
												<td width="78%"><input name="statusanimal_detail" type="radio" value="4" <? if($rs['statusanimal_detail']=='4'){ echo 'checked';}?> /> ของตนเอง</td>
										  </tr>
									</table>
								</td>
							  </tr>
							  <tr>
									<td  width="20%"><input name="statusanimal" type="radio" value="2" <? if($rs['statusanimal']=='2'){ echo 'checked';}?> onClick="show_hide_clear_status(document.form1);"/> ไม่มีเจ้าของ</td>
									<td>&nbsp;</td>
							  </tr>
						</table>
					</td>
			      </tr>
				  <tr>
				    <td valign="top" >6</td>
				    <td >
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td colspan="2">อายุของสัตว์ : </td>
						  </tr>
						  <tr>
							<td width="8%">&nbsp;</td>
							<td width="92%"><input name="ageanimal" type="radio" value="1"<? if($rs['ageanimal']=='1'){ echo "checked";}?>/> ต่ำกว่า 3 เดือน</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td><input name="ageanimal" type="radio" value="2" <? if($rs['ageanimal']=='2'){ echo "checked";}?>/> 3 ถึง 6 เดือน</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td><input name="ageanimal" type="radio" value="3" <? if($rs['ageanimal']=='3'){ echo "checked";}?>/>3 ถึง 12 เดือน</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td><input name="ageanimal" type="radio" value="4" <? if($rs['ageanimal']=='4'){ echo "checked";}?>/> มากกว่าปี</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td><input name="ageanimal" type="radio" value="5" <? if($rs['ageanimal']=='5'){ echo "checked";}?>> ไม่ทราบ</td>
						  </tr>
						</table>
					</td>
			      </tr>
				  <tr>
				    <td valign="top">7</td>
				    <td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" >
					  <tr>
						<td colspan="2">การมีชีวีต : </td>
					  </tr>
					  <tr>
						<td width="8%">&nbsp;</td>
						<td width="92%"><input name="lifeanimal" type="radio" value="1" <? if($rs['lifeanimal']=='1'){ echo "checked";}?>> ตายเอง</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td><input name="lifeanimal" type="radio" value="2" <? if($rs['lifeanimal']=='2'){ echo "checked";}?>> ถูกฆ่าตาย</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td><input name="lifeanimal" type="radio" value="3" <? if($rs['lifeanimal']=='3'){ echo "checked";}?>> ตายจากอุบัติเหตุ</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td><input name="lifeanimal" type="radio" value="4" <? if($rs['lifeanimal']=='4'){ echo "checked";}?>> หนีหาย</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td><input name="lifeanimal" type="radio" value="5" <? if($rs['lifeanimal']=='5'){ echo "checked";}?>> ไม่ทราบ</td>
					  </tr>
					  <tr>
						<td colspan="2">หลังกัดผู้ป่วย <input type="text" value="<?php echo $rs['afterbitday']?>"  name="afterbitday" size="3" onKeyUp="chkFormatNam (this.value,this.name);"  class="input_box_patient "/> วัน</td>
					  </tr>
					</table>
			      </tr>
				  <tr>
				    <td valign="top">8</td>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" >
					  <tr>
						<td colspan="3">การส่งตรวจ:  </td>
					  </tr>
					  <tr>
						<td width="10%">&nbsp;</td>
						<td colspan="2"><input name="headsend" type="radio" value="ๅ" <? if($rs['headsend']=='1'){ echo "checked";}?> onClick="show_hide_clear_batteria(document.form1);"> ไม่ส่ง</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td width="14%"><input name="headsend" type="radio" value="2" <? if($rs['headsend']=='2'){ echo "checked";}?> onClick="show_hide_clear_batteria(document.form1);"> ส่ง</td>
						<td width="76%">
								<table width="100%" border="0" cellpadding="0" cellspacing="0" id="batteria_table" class="noborder" <? if($rs['headsend']!='2'){echo 'style="display:none"';}?>>
									  <tr>
											<td width="22%"><input name="batteria" type="radio" value="1" <? if($rs['batteria']=='1'){ echo 'checked';}?>/> พบเชื้อ</td>
											<td width="78%"><input name="batteria" type="radio" value="2" <? if($rs['batteria']=='2'){ echo 'checked';}?> /> ไม่พบเชื้อ</td>
									  </tr>
								</table>						
						</td>
					  </tr>
					</table>
			      </tr>
				  <tr>
				    <td>9</td>
				    <td>วันที่สัมผัส(หรือประมาณ): <input name="dateanimal" type="text" size="40"  class="input_box_patient " value="<?php echo $rs['dateanimal']?>"/>
			      </tr>
				  <tr>
				    <td >10</td>
				    <td >ตำแหน่งที่รับเชื้อ : <input name="touchme" type="text" size="40"  class="input_box_patient " value="<?php echo $rs['touchme']?>"/>
					</td>
			      </tr>
				  <tr>
				    <td  valign="top">11</td>
				    <td >
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr>
							<td colspan="2">การฉีด Rabies Vaccine :</td>
						  </tr>
						  <tr>
							<td width="9%" height="25"><input name="vaccine" type="radio" value="1" <? if($rs['vaccine']=='1'){echo 'checked';}?>  onclick="show_hide_clear_vaccinedead(document.form1);"/>ฉีด</td>
							<td width="91%">
								<table width="100%" border="0" cellpadding="0" cellspacing="0" id="vaccine_1" <? if($rs['vaccine']!='1'){echo 'style="display:none"';}?>>
									  <tr>
											<td width="9%"><input type="text" name="vaccine_text" value="<?php echo $rs['vaccine_text']?>" class="input_box_patient "  size="2" maxlength="2"   onKeyUp="chkFormatNam (this.value,this.name);" /> เข็ม</td>
											<td width="91%"><input name="vaccine_date" type="text" size="10" class="input_box_patient auto  datepicker" readonly="" value="<?php echo $rs['vaccine_date'];?>" /></td>
									  </tr>
								</table>							
							</td>
						  </tr>
						  <tr>
							<td  height="25"><input name="vaccine" type="radio" value="2"  <? if($rs['vaccine']=='2'){echo 'checked';}?>  onclick="show_hide_clear_vaccinedead(document.form1);"/>ไม่ฉีด</td>
							<td></td>
						  </tr>
					  </table>
					</td>
			      </tr>
				  <tr>
				    <td  valign="top">12</td>
				    <td >
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						  <tr>
							<td colspan="2">การฉีดอิมมูโนโกลบูลิน :</td>
						  </tr>
						  <tr>
							<td width="9%" height="25"><input name="vaccine_h" type="radio" value="1" <? if($rs['vaccine_h']=='1'){echo 'checked';}?>  onclick="show_hide_clear_vaccine_h(document.form1);"/>ฉีด</td>
							<td width="91%">
								<table width="100%" border="0" cellpadding="0" cellspacing="0" id="vaccine_table" <? if($rs['vaccine_h']!='1'){echo 'style="display:none"';}?>>
									  <tr>
										<td width="9%"><input name="erig_hrig" type="radio" value="1" <? if($rs['erig_hrig']=='1'){ print "checked";}?>> ERIG</td>
											<td width="91%"><input name="erig_hrig" type="radio" value="2" <? if($rs['erig_hrig']=='2'){ print "checked";}?>> HRIG</td>
									  </tr>
								</table>							
							</td>
						  </tr>
						  <tr>
							<td  height="25"><input name="vaccine_h" type="radio" value="2"  <? if($rs['vaccine_h']=='2'){echo 'checked';}?>  onclick="show_hide_clear_vaccine_h(document.form1);"/>ไม่ฉีด</td>
							<td></td>
						  </tr>
					  </table>
					</td>
			      </tr>
				  <tr>
				    <td >13</td>
				    <td >วันที่เริ่มป่วย : 
					 <input name="startdate" type="text" size="10" class="input_box_patient auto datepicker" readonly="" value="<?php echo (empty($rs['startdate']))?  $rs['startdate']: cld_my2date($rs['startdate']);?>"  />
					 </td>
			      </tr>
				  <tr>
				    <td >14</td>
				    <td >วันที่ถึงแก่กรรม<span class="alertred">*</span> : 
					<input name="enddate" type="text" size="10" class="input_box_patient auto datepicker"  id="enddate" readonly="" value="<?php echo (empty($rs['enddate']))? $rs['endate']:cld_my2date($rs['enddate']);?>"  />
					 </td>
			      </tr>
				  <tr>
				    <td  valign="top">15</td>
				    <td>
					<table width="100%">
					  <tr>
						<td  width="6%"valign="top">ลักษณะอาการ : </td>
						<td width="83%"><textarea name="remark"   cols="30" rows="3" class='input_box_patient'><?php echo $rs['remark']?></textarea></td>
					  </tr>
					</table>
				     </td>
			      </tr>
				  <tr>
				    <td  valign="top">16</td>
				    <td >				
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td colspan="2">การตรวจวินิจฉันยืนยัน : </td>
						  </tr>
						  <tr>
							<td width="9%">&nbsp;</td>
							<td width="91%">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td width="19%" valign="top">1.ตัวอย่างที่ส่งตรวจเป็น</td>
								<td width="81%">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td><input name="detailexample1" type="radio" value="1"  <? if($rs['detailexample1']=='1'){ echo 'checked';}?>/> น้ำปัสสาวะ</td>
								  </tr>
								  <tr>
									<td><input name="detailexample1" type="radio" value="2" <? if($rs['detailexample1']=='2'){ echo 'checked';}?> /> น้ำลาย</td>
								  </tr>
								  <tr>
									<td><input name="detailexample1" type="radio" value="3"  <? if($rs['detailexample1']=='3'){ echo 'checked';}?>/> น้ำไขสันหลัง</td>
								  </tr>
								  <tr>
									<td><input name="detailexample1" type="radio" value="4"  <? if($rs['detailexample1']=='4'){ echo 'checked';}?>/> เนื้อสมอง</td>
								  </tr>
								</table>
								</td>
							  </tr>
							  <tr>
								<td>2.สถานที่ส่งตรวจที่ </td>
								<td><input type="text" name="sendhospital" value="<?php echo $rs['sendhospital']; ?>"  class="input_box_patient "/></td>
							  </tr>
							  <tr>
								<td valign="top">3.ผลการตรวจวินิจฉัย</td>
								<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td><input name="ans" type="radio" value="1" <? if($rs['ans']=='1'){echo 'checked';}?>  onClick="show_hide_clear_ans_exam(document.form1);"/> Positive</td>
									<td><div id="ans_exam" <? if($rs['ans']!='1'){echo 'style = "display:none"';}?>>ระบุตัวอย่าง <input type="text" name="exam" value="<?php echo $rs['exam']?>" class="input_box_patient " /></div></td>
								  </tr>
								  <tr>
									<td colspan="2"><input name="ans" type="radio" value="2" <? if($rs['ans']=='2'){echo 'checked';}?>  onClick="show_hide_clear_ans_exam(document.form1);"/> Negative</td>
								  </tr>
								</table>
								</td>
							  </tr>
							</table>							
							</td>
						  </tr>
					  </table></td>
			      </tr>
				  <tr>
				    <td colspan="2">
					<table width="100%" border="0" cellspacing="2" cellpadding="0">
					  <tr>
						<td width="50%">&nbsp;</td>
						<td><table width="100%" border="0" cellspacing="2" cellpadding="2">
						  <tr>
							<td width="29%" align="right">ชื่อผู้รายงาน<span class="alertred">*</span>&nbsp;:</td>
							<td width="71%"><input type="text" name="reportname" value="<?php echo $rs['reportname']?>"  class="input_box_patient "/></td>
						  </tr>
						  <tr>
							<td align="right">ตำแหน่ง<span class="alertred">*</span>&nbsp;:</td>
							<td><input type="text" name="positionname" value="<?php echo $rs['positionname']?>"  class="input_box_patient "/></td>
						  </tr>
						  <tr>
							<td align="right">เบอร์โทรศัพท์<span class="alertred">*</span>&nbsp;:</td>
							<td><input type="text" name="telname" value="<?php echo $rs['telname']?>"  class="input_box_patient "/></td>
						  </tr>
						  <tr>
							<td align="right">วันที่บันทึก </td>
							<td>
							<?
									$Ydate=date('Y')+543;
									$datedeflaut=date("-m-d");
									$reportdate=cld_my2date($Ydate.$datedeflaut);
							?>
			        				<input name="reportdate" type="text" size="10" class="input_box_patient " readonly  value="<?php echo (@$rs['reportdate'])? cld_my2date(@$rs['reportdate']):$reportdate;?>"> 							
							</td>
						  </tr>
						</table>
						</td>
					  </tr>
					</table>
					</td>
				</table>
				</td>
		  </tr>
		</table>
 <div class="btn_inline">
      <ul>
      	<li><button class="btn_save" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="reset">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div> 
	</form>