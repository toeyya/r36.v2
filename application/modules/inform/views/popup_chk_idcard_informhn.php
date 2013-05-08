<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<script type="text/javascript">
$(document).ready(function(){
var ref1=$("#hospitalprovince option:selected").val();
var ref2=$('#hospitalamphur option:selected').val();
<?php if($this->session->userdata('R36_HOSPITAL')==''): ?>
	$("#hospitalprovince").change(function(){
		ref1=$("#hospitalprovince option:selected").val();
		$.ajax({		
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=hospitalamphur&ref1='+ref1,
			success:function(data){
				$("#input_Hamphur").html(data);	
				$('#input_Hospital').html('<select name="hospital" class="textbox" id="hospital"><option value="">-โปรดเลือก-</option></select>');		
			}	
		});				
	});
	
	$("#hospitalamphur").change(function(){
		ref2=$('#hospitalamphur option:selected').val();
		$.ajax({
			url:'<?php echo base_url() ?>hospital/getHospital',
			data:'name=hospital&ref1='+ref1+'&ref2='+ref2,
			success:function(data){
				$("#input_Hospital").html(data);	
			}
		})
	});
	<?php endif;?>
	$("#ReInputId").click(function(){
			parent.$('#cardW0').val('');
			parent.$('#cardW1').val('');
			parent.$('#cardW2').val('');
			parent.$('#cardW3').val('');
			parent.$('#cardW4').val('');
			parent.$.colorbox.close();
	});

});
</script>
</head>
<body>
<?php 
$number1='';$number2='';$number3='';$number4='';$number5=''; 
$r36_level=$this->session->userdata('R36_LEVEL')
?>
<table width="100%">
  <tr>
    <td>	
	<table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><h4><?php echo $show_title ?></h4></td>
        </tr>
        <tr>
          <td align="center">
		  <table width="450" border="0" cellpadding="1" cellspacing="1" bgcolor="#000066" align="center">
		  	
		  	
		  <? if($num_chk){  $number1='Y';
		 		 	if($add_inform!=''){
		 		 		foreach($add_inform as $item){
		  ?>
					  		<tr bgcolor="#FFFFFF">
								<td colspan="5" align="left">
									<a href="inform/form/<?php echo $item['id'] ?>/<?php echo $item['historyid'] ?>/<?php echo  $in_out;?>/addnew" target="_top">
										<img src="images/add2.gif"  align="absmiddle" border="0" />เพิ่มข้อมูลการสัมผัสของรหัส <?php echo $idcard ?> รหัส <?php echo $item['hn']?>-<?php echo $item['hn_no'] ?>
									</a>
								</td>
							</tr>
		<?			} 
				 }				 
			}
			?>
              <tr align="center" bgcolor="#0099CC"> 
                <td>ลำดับ</td>
                <td>HN</td>
                <td>ชื่อ - นามสกุล</td>
                <td>โรงพยาบาล</td>
                <td>แก้ไข</td>
              </tr>
			  <? 
			  	if($num_chk){
			  		$this->hospital->primary_key("hospital_code"); 
			  		foreach($result as $i=>$rec){				
			  			$rec_hospitalname=($rec['hospitalcode'])?$this->hospital->get_one("hospital_code", $rec['hospitalcode']):'';
			  ?>
					  <tr bgcolor="#D5F4FF"> 
						<td align="center"><?php echo ++$i?></td>
						<td align="left"><?php echo $rec['hospitalcode'].'/'.$rec['hn'].'-'.$rec['hn_no'];?></td>
						<td align="left"><?php echo $rec['firstname'].' '.$rec['surname'];?></td>
						<td align="left"><?php echo $rec_hospitalname['hospital_name']?></td>
						<td align="left">
						<?  if($r36_level=='00' || ($r36_level=='02' && ($this->session->userdata('R36_PROVINCE')==$rec['hospitalprovince']))){
								$number4='Y'; ?>								
								<a href="inform/form/<?php echo $rec['id'] ?>/<?php echo $rec['historyid'];	 ?>/<?php echo $in_out; ?>" target="_top">แก้ไข</a>
						<?  }else if($r36_level=='02' && ($this->session->userdata('R36_PROVINCE')!=$rec['hospitalprovince'])){
								$number3='Y'; ?>						
									<a href="inform/form/<?php echo $rec['id'] ?>/<?php echo $rec['historyid'];	 ?>/<?php echo $in_out; ?>/vaccine">เพิ่มข้อมูลการฉีด</a>
						<? }else if(($r36_level=='05' || $r36_level=='03') && $this->session->userdata('R36_FROMEDIT')=='Y' && ($this->session->userdata('R36_HOSPITAL')==$rec['hospitalcode'])){
								$number4='Y'; ?>							
									<a href="inform/form/<?php echo $rec['id'] ?>/<?php echo $rec['historyid'];	 ?>/<?php echo $in_out; ?>" target="_top">แก้ไข</a>
						<?  }else if(($r36_level=='05' || $r36_level=='03')&& $this->session->userdata('R36_FROMEDIT')=='Y' && ($this->session->userdata('R36_HOSPITAL')!=$rec['hospitalcode'])){
							   	$number3='Y';  ?>
									 <a href="inform/form/<?php echo $rec['id'] ?>/<?php echo $rec['historyid'] ?>/<?php echo $in_out; ?>/vaccine" target="_top">เพิ่มข้อมูลการฉีด</a> 
						<?  } ?>
						</td>
					  </tr>
				<? 
						//$historyid='';$rec['id']='';
						} // Loop While 
					} else { 
				?>
              <tr align="center" bgcolor="#D5F4FF"> 
                <td colspan="5"> -- ไม่พบข้อมูล --</td>
              </tr>
			 <? } ?>
            </table>
			<?
			if($num_chk){
				$number5='Y';
			}else{
				$number2='Y';
			}
			?>
			<form name="form1"  id="fom1">
				<input name="in_out" id="in_out"  		type="hidden" value="<?php echo $in_out ?>"/>
				<input name="idcard" id="idcard" 		type="hidden" value="<?php echo $idcard?>"/>
				<input name="statusid" id="statusid"   type="hidden" value="<?php echo $statusid ?>"/>
				<table width="80%" border="0">
				  <tr>
						<td width="49%">จังหวัด
									<?
									if($this->session->userdata('R36_PROVINCE')!='' && $this->session->userdata('R36_LEVEL')=='02'){
										$wh="AND province_id='".$this->session->userdata('R36_PROVINCE')."'";
										$hospitalprovince=$this->session->userdata('R36_PROVINCE');
									}else if($this->session->userdata('R36_HOSPITAL_PROVINCE')!=''){
										$wh="AND province_id='".$this->session->userdata('R36_HOSPITAL_PROVINCE')."'";
										$hospitalprovince=$this->session->userdata('R36_HOSPITAL_PROVINCE');
									}									
										$class='class="textbox" id="hospitalprovince"';
										echo form_dropdown('hospitalprovince',get_option('province_id','province_name',"n_province where province_id!=''".$wh." ORDER BY province_name ASC"),$hospitalprovince,$class,'-โปรดเลือก-')
									?>								
					 </td>
						<td width="51%">อำเภอ
								<span id="input_Hamphur">																		
											<?
											 if($this->session->userdata('R36_HOSPITAL_AMPHUR')!=''){
													$whamphur="AND amphur_id ='".$this->session->userdata('R36_HOSPITAL_AMPHUR')."' AND province_id='".$this->session->userdata('R36_HOSPITAL_PROVINCE')."' ";
													$hospitalamphur=$this->session->userdata('R36_HOSPITAL_AMPHUR');
											}else if($hospitalprovince){
													$whamphur="AND province_id ='".$hospitalprovince."'";
											}
											if($whamphur!=''){												
												$class='class="textbox" id="hospitalamphur"';
												echo form_dropdown('hospitalamphur',get_option('amphur_id','amphur_name',"n_amphur WHERE amphur_id<>'' ".$whamphur." ORDER BY amphur_name ASC"),$hospitalamphur,$class,'-โปรดเลือก-');
											 }else{	?> 	
												<select name="hospitalamphur" id="hospitalamphur" class="textbox">
													<option value="">-โปรดเลือก-</option>
												</select>
								<?php  }?>								
						  </span> 
					</td>
				  </tr>
				  <tr>
						<td colspan="2"> โรงพยาบาล
								<span id="input_Hospital">
											<?
												if($this->session->userdata('R36_HOSPITAL')!=''){
														$whhospital="AND hospital_code ='".$this->session->userdata('R36_HOSPITAL')."'";
														$hospital=$this->session->userdata('R36_HOSPITAL');
												}else if($hospitalamphur){
														$whhospital="AND hospital_province_id='".$hospitalprovince."' AND hospital_amphur_id ='".$hospitalamphur."'  ";
												}
												if($whhospital!=''){
													$class='class="textbox" id="hospital"';
													echo form_dropdown('hospital',get_option('hospital_code','hospital_name'," n_hospital where hospital_id <>'' ".$whhospital." ORDER BY hospital_name ASC"),$hospital,$class,'-โปรดเลือก-');	
												}else{ ?>												
												<select name="hospital" class="textbox" id="hospital">
													<option value="">-โปรดเลือก-</option>	
												</select>
												<?php } ?>
								</span> 
							</td>
				  </tr>
				  <tr>
						<?php if($num_chk): ?>
						<td colspan="2">
								<input name="link" type="button" class="Submit" value="กรอกรหัส ID ใหม่" id="ReInputId">
						 </td>
						 <?php else: ?>
						 <td colspan="2">						 	
								<strong>กรอก HN </strong>
						  		<input type="text" name="hn"  value="" /> 
						  		<a href="javascript:void(0)" name="check_hn" id="checkerHN" class="Submit" onclick="chkhn(document.form1)" target="_top">ทำขั้นต่อไป</a>
						 </td>
						 <?php endif; ?>
				  </tr>
				</table>							
			</form>
			<br /><br />
			<table width="80%" border="0" cellpadding="2" cellspacing="0" align="left">
			 <?php  if($number1=='Y'){ ?>
			  		<tr><td class="alertred" nowrap="nowrap"><div align="left">* เพิ่มข้อมูลการสัมผัสของรหัส <?=$idcard;?> คือ เพิ่มข้อมูลการสัมผัสโรคพิษสุนัขบ้าครั้งใหม่</div></td></tr>
			 <?php }if($number4=='Y'){ ?>
			  		<tr><td class="alertred" nowrap="nowrap"><div align="left">* แก้ไข คือ การแก้ไขข้อมูลต่างๆในการถูกสัมผัสในครั้งที่เลือก</div></td></tr>
			 <?php }if($number5=='Y'){ ?>
			  		<tr><td class="alertred" align="left"  nowrap="nowrap"><div align="left">* กรอกรหัส ID ใหม่ คือ การกลับไปกรอกและตรวจสอบรหัส ID ใหม่</div></td></tr>
			 <?php }if($number2=='Y'){ ?>
				  <tr><td class="alertred" nowrap="nowrap"><div align="left">* ใช้งานรหัส <?=$idcard?> คือ การเลือกใช้งานรหัสที่กำลังตรวจสอบ</div></td></tr>
			 <?php }if($number3=='Y'){ ?>
			  		<tr><td class="alertred" nowrap="nowrap"><div align="left">* เพิ่มข้อมูลการฉีด คือ การเพิ่มวัคซีนให้กับผู้ป่วยในการถูกสัมผัสในครั้งที่เลือก</div></td></tr>
			  <?}?>
			</table>

		  </td>
        </tr>
      </table>
	</td>
  </tr>
</table>
</body>
</html>