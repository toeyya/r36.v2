<script type="text/javascript">
$(document).ready(function(){
	var ref1;
	$('select[name=province_id]').change(function(){
		ref1=$('select[name=province_id] option:selected').val();
		$.ajax({
			type:'get',
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'ref1='+ref1,
			success:function(data)
			{
				$("#input_amphur").html(data);
				$('#input_district').html('<select name="district_id" class="input_box_patient" id="distrcit_id"><option value="">-ทั้งหมด-</option></select>');
			}
		});
	});	//select name=province
	$('select[name=amphur_id]').live('change',function(){
		var ref2=$('select[name=amphur_id] option:selected').val();
		$.ajax({
			url:'<?php echo base_url()?>district/getDistrict',
			data:'ref1='+ref1+'&ref2='+ref2,
			success:function(data){
				$('#input_district').html(data);
			}
		})
	});// select  name=amphur_id
});//document
</script>
<div id="title">ค้นหาข้อมูลสถานพยาบาล</div>
<div id="search">
<form  action="hospital/index" method="get" name="form1">
		<input name="process" type="hidden" value="" />
		<input name="hospital_id" value="" type="hidden" />
		<input name="hospital_code" value="" type="hidden" />
		<table width="70%"   class="tb_patient1">
		  <tr>
			<th width="13%">จังหวัด :</th>
			<td>
				<?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province ORDER BY province_name ASC'),@$_GET['province_id'],'class="input_box_patient" id="province_id"','-ทั้งหมด-') ?>
			</td>
			<th>อำเภอ :</th>
			<td>
		 	 <span id="input_amphur">
			  <?php 
			  $class='class="input_box_patient" id="amphur_id"';
			  echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name',"n_amphur WHERE province_id='".@$_GET['province_id']."' ORDER BY amphur_name ASC"),@$_GET['amphur_id'],$class,'-ทั้งหมด-'); ?>
			</span>
			</td>
         					  
		  </tr>

		  <tr>
		  	<th>ตำบล :</th>
                  <td>
				  <span id="input_district">
						<?php 
						$class='class="input_box_patient" id="district_id"';
						$wh=" WHERE province_id='".@$_GET['province_id']."' and amphur_id='".@$_GET['amphur_id']."' ORDER BY district_name ASC";
						echo form_dropdown('district_id',get_option('district_id','district_name',"n_district $wh"),@$_GET['district_id'],$class,'-ทั้งหมด-'); ?>						
					</span>
			</td>	
			<th>สถานพยาบาล :</th>
			<td><input name="hospital_name" type="text" id="hospital_name" size="30" maxlength="300"  class="input_box_patient"  value="<?php echo @$_GET['hospital_name']?>" /></td>
		  </tr>
		 <tr>
		 		<th>โค้ดสถานพยาบาล :</th>
				<td colspan="3"><input name="hospital_code_healthoffice" type="text" id="hospital_code_healthoffice" size="20" maxlength="10"  class="input_box_patient"  value="<?php echo @$_GET['hospital_code_healthoffice']?>" /></td>		  
		 </tr>
	  </table>
<div class="btn_inline">
      <ul>
      	<li><button class="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div>	  
</form>
</div>
<div id="boxAdd"><a href="hospital/form" class="btn_add" title="เพิ่ม" name="btn_add"></a></div>
	<?php if($wh!=''): ?>
		<table  class="tb_search_Rabies1">
		  <tr>
			<th width="25%">ชื่อสถานพยาบาล</th>
			<th width="12%">โค้ดสถานพยาบาล</th>
			<th width="15%">ตำบล</th>
			<th width="15%">อำเภอ</th>
			<th width="18%">จังหวัด</th>
			<th width="14%">การกระทำ</th>
		  </tr>
		   
			 <?php foreach($result as $item): ?>
			 <?php 	$rs=$this->db->Execute("SELECT id FROM n_information WHERE hospitalcode ='".$item['hospital_code']."'");
			 				$chk_del=$rs->RecordCount();
							$sql="select district_name from n_district where province_id= ? and amphur_id = ? and district_id= ? ";
        					$district_name=$this->db->GetOne($sql,array($item['hospital_province_id'],$item['hospital_amphur_id'],$item['hospital_district_id']))
							//echo $chk_del;
			  ?>
			  	<tr>
					<td><?php echo $item['hospital_name'];?></td>
					<td><?php echo $item['hospital_code_healthoffice'] ?></td>
					<td><?php echo $district_name; ?>	</td>
					<td><?php echo  $item['amphur_name']?>	</td>
					<td><?php echo $item['province_name'] ?>	</td>			
					<td>
					<a href="hospital/index/<?php echo $item['hospital_id'] ?>" class="btn_view" title="ดู"></a> 
					<?php  if($this->session->userdata('R36_LEVEL')=='00' || $this->session->userdata('R36_LEVEL')=='02'){?>
					<a href="hospital/form/<?php echo $item['hospital_id'] ?>" class="btn_edit" title="แก้ไข"></a> 
					<?php  }?> 
					<?php  if($this->session->userdata('R36_LEVEL')=='00'){?>
					 
					<?php  if($chk_del==0){?>
							<a href="hospital/delete/<?php echo $item['hospital_id'] ?>"  title="ลบ" class="btn_delete" onClick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"></a>
					<?php  }else{?>
							<a href="javascript:void(0);" class="btn_delete" onClick="alert('ไม่สามารถลบข้อมูลได้ เนื่องจากมีคนไข้อยู่ในสถานพยาบาลนี้');"></a>
					<?php  }?>
					
					<?php  }?>
					</td>
				
			  </tr>
			  <?php endforeach; ?>
			<?php if(count($result)==0): ?>
			  <tr>
				<td colspan="5"  align="center" class="alertred">ไม่พบข้อมูลที่ค้นหา</td>
			  </tr>				  
			 <?php endif; ?>
	  </table>
	<?php echo  $pagination; ?>
<?php endif; ?>