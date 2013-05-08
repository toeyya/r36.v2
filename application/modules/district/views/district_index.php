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
<div id="title">ค้นหาข้อมูลตำบล</div>
<div id="search">
<form action="district/index" method="get" name="form1" >
	<table   class="tb_patient1">
		  <tr>
			<th>จังหวัด :</th>
			<td><?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province ORDER BY province_name ASC'),@$_GET['province_id'],'class="input_box_patient " id="province_id"','-ทั้งหมด-') ?></td>
			<th >อำเภอ :</th>
			<td>
		 	 <span id="input_amphur">
					<?php echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name',"n_amphur WHERE province_id='".@$_GET['province_id']."' ORDER BY amphur_name ASC"),@$_GET['amphur_id'],'class="input_box_patient " id="amphur_id"','-ทั้งหมด-'); ?>
			</span>
			</td>		  
			<th >ตำบล :</th>
			<td><input name="district_name" type="text" id="district_name" size="30" maxlength="300"  class="input_box_patient "  value="<?php echo @$_GET['district_name'];?>" /></td>
		  </tr>
	 </table>
<div class="btn_inline">
      <ul><li><button class="btn_submit" type="submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="button">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div>	 	 
</form>
</div>
<div id="boxAdd"><a href="district/form" class="btn_add" title="เพิ่ม" name="btn_add"></a></div>


<table  class="tb_search_Rabies1">
	  <tr>
		<th width="18%">จังหวัด</th>
		<th width="27%" >ตำบล</th>
		<th width="20%" >อำเภอ</th>
		<? if($this->session->userdata('R36_LEVEL')=='00'){?>
		<th width="14%" >การกระทำ</th>
		<?}?>
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
	  		<td><?php echo $recamphur_name; ?></td>
			<td><?php echo $recprovince_name; ?></td>
			<td><?php echo $item['district_name']?></td>
			<td>
			<!--<a href="district/view/<?php echo $item['district_name']; ?>/<?php echo $recamphur_name; ?>/<?php echo $recprovince_name; ?>" alt="ดู" class="btn_view"></a>-->
		
			<? if($this->session->userdata('R36_LEVEL')=='00'){?>			
				 <a href="district/form/<?php echo $item['tam_amp_id']?>" class="btn_edit" title="แก้ไข"></a> 
				<? if($chk_history==0 && $chk_information==0  ){?>
					<a class="btn_delete" title="ลบ" href="district/delete/<?php echo $item['tam_amp_id']?>/<?php echo $province_id ?>/<?php echo $amphur_id ?>"  onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')" ></a>
					<? }else{?>
					<a class="btn_delete" title="ลบ" href="javascript:void(0);" onClick="alert('ไม่สามารถลบข้อมูลได้ เนื่องจากมีการใช้ข้อมูลตำบลนี้');"></a>
				<? }?>
			<? }?>
				
			</td>
	  </tr>
	  <? 
	  }
	  if(count($result)==0){
	  ?>
		  <tr>
			<td colspan="5" align="center" class="alertred">ไม่พบข้อมูลที่ค้นหา</td>
		  </tr>
	  <?  } ?>
</table>
<? echo $pagination?>

			