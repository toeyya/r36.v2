<script type="text/javascript">
$(document).ready(function(){
	$('input[name=link]').click(function(){
		parent.$('#cardW0','#cardW1','#cardW2','#cardW3','#cardW4').val('');
		parent.$.colorbox.close();
	});
	$('#addContactTime').click(function(){
		var idcard=$(this).prev().val();		
		$.ajax({
			type:'get',
			data:'idcard='+idcard,
			url:'<?php echo base_url() ?>inform/addContactTime',
			dataType:'json',
			success:function(data){
				parent.$('input[name=hn_no]').val(data.hn_no);
				parent.$("input[name=firstname]").val(data.firstname);
				parent.$('input[name=age]').val(data.age);
				if(data.age>15){
					parent.$('select[name=occupationname_b]').filter(function(){
						return $(this).val()==data.occupationname;
					}).attr('selected',true);
					if(data.occupationname=="21"){$('input[name=otheroccupationname]').val(data.otheroccupationname);}
					parent.$('select[name=occparentsname]').attr('disabled',true);
				}
				parent.$('input[name=surname]').val(data.surname);	
				
				parent.$("input[name=nohome]").val(data.nohome);
				parent.$("input[name=moo]").val(data.moo);
				parent.$('input[name=villege]').val(data.villege);
				parent.$('input[name=soi]').val(data.soi);
				parent.$('input[name=road]').val(data.road);				
			
				parent.$("select[name=provinceid] option").filter(function(){return $(this).val() == data.provinceid; }).attr('selected', true);
				parent.$('input[name=gender]').filter(function(){return $(this).val()==data.gender;}).attr('checked',true);
				parent.$('input[name=marryname]').filter(function(){return $(this).val()==data.marryname;}).attr('checked',true);
				parent.$('input[name=nationality]').filter(function(){return $(this).val()==data.nationalityname;}).attr('checked',true);	
			
				parent.$('input[name=othernationality]').val(data.othernationalityname);
				parent.$('input[name=typeforeign]').filter(function(){return $(this).val()==data.typeforeign;}).attr('selected',true);
				
				parent.$('#amphurid').append($("<option></option>") .attr({value:data.amphurid,selected:true}).text(data.amphur_name));
				parent.$('#districtid').append($("<option></option>") .attr({value:data.districtid,selected:true}).text(data.district_name));
				parent.$("input[name=telephone]").val(data.telephone);
				parent.$('input[name=process]').val('addnew');
				parent.$.colorbox.close();
			}
		})	
	})
	$('input[name=close]').click(function(){
		parent.$.colorbox.close();
	})
}); // end document
</script>
<?php 
$number1='';$number2='';$number3='';$number4='';$number5=''; 
$r36_level=$this->session->userdata('R36_LEVEL')
?>
<table width="100%">
  <tr>
    <td>	
	<table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><h4><strong><?=$show_title ?></strong></h4></td>
        </tr>
        <tr>
          <td align="center">
		  <table width="450" border="0" cellpadding="1" cellspacing="1" bgcolor="#000066" align="center">
		  <? if($num_chk){  $number1='Y';
		  ?>
					  		<tr bgcolor="#FFFFFF">
								<td colspan="5" align="left">
									<input type="hidden" name="idcard" value="<?php echo $idcard ?>">
									<a href="javascript:void(0);"  title="เพิ่มข้อมูลการสัมผัสโรค"  name="addContactTime" id="addContactTime">
										<img src="images/add2.gif"  align="absmiddle" border="0" />เพิ่มข้อมูลการสัมผัสของรหัส <?php echo $idcard ?>
									</a>										
							</tr>
		<?							 			 
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
			  		foreach($result as $i=>$rec){					
			  			$rec_hospitalname=$this->hospital->get_row("hospital_code", $rec['hospitalcode']);			  
			  ?>
					  <tr bgcolor="#D5F4FF"> 
						<td align="center"><?=++$i?></td>
						<td align="left"><? echo $rec['hospitalcode'].'/'.$rec['hn'].'-'.$rec['hn_no'];?></td>
						<td align="left"><?=$rec['firstname'].' '.$rec['surname'];?></td>
						<td align="left"><?=$rec_hospitalname['hospital_name']?></td>
						<td align="left">
						<? if($r36_level=='00' || ($r36_level=='02' && ($this->session->userdata('R36_PROVINCE')==$rec['hospitalprovince']))){
							  		$number4='Y';
						?>
								<a href="inform/form/<?php echo $rec['id'] ?>/<?php echo $rec['historyid'];	 ?>/<?php echo $in_out; ?>" target="_top">แก้ไข</a>
							
							<? 
							  }else if($r36_level=='02' && ($this->session->userdata('R36_PROVINCE')!=$rec['hospitalprovince']) ){
							  		$number3='Y';
							?>
									<a href="inform/form/<?php echo $rec['id'] ?>/<?php echo $rec['historyid'];	 ?>/<?php echo $in_out; ?>/vaccine">เพิ่มข้อมูลการฉีด</a> 
							<? 
							   }else if(($r36_level=='05' || $r36_level=='03') && $this->session->userdata('R36_FROMEDIT')=='Y' && ($this->session->userdata('R36_HOSPITAL')==$rec['hospitalcode'])){
									$number4='Y';
							?>
									<a href="inform/form/<?php echo $rec['id'] ?>/<?php echo $rec['historyid'];	 ?>/<?php echo $in_out; ?>" target="_top">แก้ไข</a>
							<? 
							   }else if(($r36_level=='05' || $r36_level=='03')&& $this->session->userdata('R36_FROMEDIT')=='Y' && ($this->session->userdata('R36_HOSPITAL')!=$rec['hospitalcode'])){
							   		$number3='Y';
							   ?>
									 <a href="inform/form/<?php echo $rec['id'] ?>/<?php echo $rec['historyid'];	 ?>/<?php echo $in_out; ?>/vaccine">เพิ่มข้อมูลการฉีด</a>
							<? 
							   }
							?>
						</td>
					  </tr>
				<? $historyid='';$rechn['id']='';
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
			?>
				<input name="link" type="button" class="Submit" value="กรอกรหัส ID ใหม่">			
			<? 
			}else{
				$number2='Y';
			?>
				<input name="close" type="button" class="Submit" onClick="window.close();" value="ใช้งานรหัส<?=$idcard;?>"/>
			<? 
			}
			?>
			<br /><br />
			<table width="80%" border="0" cellpadding="2" cellspacing="0" align="left">
			 <?
			  if($number1=='Y'){
			  ?>
			  <tr>
				<td class="alertred" nowrap="nowrap"><div align="left">* เพิ่มข้อมูลการสัมผัสของรหัส <?=$idcard;?> คือ เพิ่มข้อมูลการสัมผัสโรคพิษสุนัขบ้าครั้งใหม่</div></td>
			  </tr>
			  <?
			  }
			  if($number4=='Y'){
			  ?>
			  <tr>
				<td class="alertred" nowrap="nowrap"><div align="left">* แก้ไข คือ การแก้ไขข้อมูลต่างๆในการถูกสัมผัสในครั้งที่เลือก</div></td>
			  </tr>
			  <?
			  }
			  if($number5=='Y'){
			  ?>
			  <tr>
				<td class="alertred" align="left"  nowrap="nowrap"><div align="left">* กรอกรหัส ID ใหม่ คือ การกลับไปกรอกและตรวจสอบรหัส ID ใหม่</div></td>
			  </tr>
			 <?
			 }
			  if($number2=='Y'){
			  ?>
				  <tr>
					<td class="alertred" nowrap="nowrap"><div align="left">* ใช้งานรหัส <?=$idcard?> คือ การเลือกใช้งานรหัสที่กำลังตรวจสอบ</div></td>
				  </tr>
			  <?
			  }
			  if($number3=='Y'){
			  ?>
			  <tr>
				<td class="alertred" nowrap="nowrap"><div align="left">* เพิ่มข้อมูลการฉีด คือ การเพิ่มวัคซีนให้กับผู้ป่วยในการถูกสัมผัสในครั้งที่เลือก</div></td>
			  </tr>
			  <?
			  }
			  ?>
			</table>

		  </td>
        </tr>
      </table>
	</td>
  </tr>
</table>