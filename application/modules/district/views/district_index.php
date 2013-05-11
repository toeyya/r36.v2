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
	
});
</script>
<h1>ตำบล</h1>
<div class="search">
<form action="district/index" method="get" name="form1" >
จังหวัด <?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province ORDER BY province_name ASC'),@$_GET['province_id'],'class="input_box_patient " id="province_id"','-ทั้งหมด-') ?></td>
อำเภอ  <span id="input_amphur"><?php echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name',"n_amphur WHERE province_id='".@$_GET['province_id']."' ORDER BY amphur_name ASC"),@$_GET['amphur_id'],'class="input_box_patient " id="amphur_id"','-ทั้งหมด-'); ?></span>
ตำบล <input name="district_name" type="text" id="district_name" size="30" maxlength="300"  class="input_box_patient "  value="<?php echo @$_GET['district_name'];?>" /></td>
<input class="btn" type="submit" value="ค้นหา">
</form>
</div>
<table  class="list">
	  <tr>
		<th width="18%">จังหวัด</th>
		<th width="20%" >อำเภอ</th>	
		<th width="27%" >ตำบล</th>		
		<th width="14%" ><a href="district/form" class="btn" title="เพิ่ม" name="btn_add">เพิ่มรายการ</a></th>	
	  </tr>
	  <?
			foreach($result as $key=>$item){
				 $province_id=$item['province_id'];
				 $amphur_id=$item['amphur_id'];
				 $district_id=$item['district_id'];
				$recprovince_name = $this->province->get_one("province_name","province_id",$province_id);
				$recamphur_name =$this->db->getOne("SELECT amphur_name FROM n_amphur WHERE amphur_id='".$amphur_id."' AND province_id='".$province_id."'");
	 			
	 			$countRow=$this->db->Execute("SELECT historyid FROM n_history WHERE provinceid='".$province_id."' AND amphurid='".$amphur_id."' AND districtid='".$district_id."'");
				$chk_history=$countRow->RecordCount();
				
				$countRow=$this->db->Execute("SELECT provinceidplace,amphuridplace,districtidplace  FROM n_information WHERE provinceidplace='".$province_id."' AND amphuridplace='".$amphur_id."' AND districtidplace='".$district_id."'");
				$chk_information=$countRow->RecordCount();
	  ?>
	  	<tr>
	  		<td><?php echo $recprovince_name; ?></td>
	  		<td><?php echo $recamphur_name; ?></td>			
			<td><?php echo $item['district_name']?></td>
			<td>		
	
				 <a href="district/form/<?php echo $item['tam_amp_id']?>" class="btn" title="แก้ไข">แก้ไข</a> 
				<? if($chk_history==0 && $chk_information==0  ){?>
					<a class="btn" title="ลบ" href="district/delete/<?php echo $item['tam_amp_id']?>/<?php echo $province_id ?>/<?php echo $amphur_id ?>"  onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')" >ลบ</a>
					<? }else{?>
					<a class="btn" title="ลบ" href="javascript:void(0);" onClick="alert('ไม่สามารถลบข้อมูลได้ เนื่องจากมีการใช้ข้อมูลตำบลนี้');">ลบ</a>
				<? }?>
			
			</td>
	  </tr>
	  <? 
	  }	 
	  ?>
</table>
<? echo $pagination?>

			