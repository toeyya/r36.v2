<h1>สถานพยาบาล</h1>
<div class="search">
<form  action="hospital/admin/hospital/index" method="get" name="form1">
จังหวัด <?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province ORDER BY province_name ASC'),@$_GET['province_id'],'id="province_id"','-ทั้งหมด-') ?>
อำเภอ  <span id="input_amphur">
<?php  $class=' id="amphur_id"';
			 echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name',"n_amphur WHERE province_id='".@$_GET['province_id']."' ORDER BY amphur_name ASC"),@$_GET['amphur_id'],$class,'-ทั้งหมด-'); ?>
</span>
ตำบล  <span id="input_district">
<?php $class='id="district_id"';
			$wh=" WHERE province_id='".@$_GET['province_id']."' and amphur_id='".@$_GET['amphur_id']."' ORDER BY district_name ASC";
			echo form_dropdown('district_id',get_option('district_id','district_name',"n_district $wh"),@$_GET['district_id'],$class,'-ทั้งหมด-'); ?>						
		</span>
สถานพยาบาล 
						<span id="input_hospital">											
								<?php	 //$this->db->debug=true;			
								$whhospital="";
								 if(!empty($_GET['amphur_id'])){
										$whhospital=" hospital_id<>'' AND hospital_province_id='".@$_GET['province_id']."' AND   hospital_amphur_id ='".@$_GET['amphur_id']."' AND hospital_district_id ='".@$_GET['district_id']."' ";										
								 }else{								 										 
									  $whhospital=" hospital_id=''";
								 }
										echo form_dropdown('hospitalcode',get_option('hospital_code','hospital_name',"n_hospital_1 where $whhospital ORDER BY hospital_name ASC"),@$_GET['hospitalcode'],'id="hospitalcode"','-โปรดเลือก-');
					  			 ?>
						</span> 
โค้ด /ชื่อ  สถานพยาบาล <input name="hospital" type="text" id="hospital" size="20"   class="input_box_patient"  value="<?php echo @$_GET['hospital']?>" />

<button class="btn" type="submit">ค้นหา</button>
<a href="hospital/admin/hospital/index<?php echo '?'.$_SERVER['QUERY_STRING'].'&act=preview' ?>" class="btn" target="_blank">พิมพ์รายงาน</a>
</form>
</div>	  
<div id="boxAdd"></div>
		<table  class="list">
		  <tr>
			<th width="25%">ชื่อสถานพยาบาล</th>
			<th width="12%">โค้ดสถานพยาบาล</th>
			<th width="15%">ตำบล</th>
			<th width="15%">อำเภอ</th>
			<th width="18%">จังหวัด</th>
			<th width="14%">
				<?php if(permission('settings', 'act_create')): ?>
				<a href="hospital/admin/hospital/form" class="btn" title="เพิ่ม" name="btn_add">เพิ่มรายการ</a>
				<?php endif; ?>
			</th>
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
					<td><?php echo ThaiToUtf8($district_name); ?>	</td>
					<td><?php echo  $item['amphur_name']?>	</td>
					<td><?php echo $item['province_name'] ?>	</td>			
					<td>
					<?php if(permission('settings', 'act_update')): ?> 
					<a href="hospital/admin/hospital/form/<?php echo $item['hospital_id'] ?>" class="btn" title="แก้ไข">แก้ไข</a> 
					<?php endif; ?>
					<?php if(permission('settings', 'act_delete')): ?>
					<?php  if($this->session->userdata('R36_LEVEL')=='00'){?>					 
					<?php  if($chk_del==0){?>
							<a href="hospital/admin/hospital/delete/<?php echo $item['hospital_id'] ?>"  title="ลบ" class="btn" onClick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">ลบ</a>
					<?php  }else{?>
							<a href="javascript:void(0);" class="btn" onClick="alert('ไม่สามารถลบข้อมูลได้ เนื่องจากมีคนไข้อยู่ในสถานพยาบาลนี้');">ลบ</a>
					<?php  }?>
					
					<?php  }?>
					<?php endif; ?>
					</td>
				
			  </tr>
			  <?php endforeach; ?>
	  </table>
	<?php echo  $pagination; ?>
<script type="text/javascript">
$(document).ready(function(){
	var ref1,ref2;
	$('select[name=province_id]').change(function(){
		ref1=$('select[name=province_id] option:selected').val();
		$.ajax({
			type:'get',
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'ref1='+ref1,
			success:function(data)
			{
				$("#input_amphur").html(data);
				$('#input_district').html('<select name="district_id" id="distrcit_id"><option value="">-ทั้งหมด-</option></select>');
				$('#input_hospital').html('<select name="hospitalcode" id="hospitalcode"><option value="">-ทั้งหมด-</option></select>');
			}
		});
	});	//select name=province
	$('select[name=amphur_id]').live('change',function(){
		ref2=$('select[name=amphur_id] option:selected').val();
		$.ajax({
			url:'<?php echo base_url()?>district/getDistrict',
			data:'ref1='+ref1+'&ref2='+ref2,
			success:function(data){
				$('#input_district').html(data);
			}
		})
	});// select  name=amphur_id
	$('select[name=district_id]').live('change',function(){
		district_id =$('select[name=district_id] option:selected').val();
		$.ajax({
			url:'<?php echo base_url()?>hospital/getHospital',
			data:'name=hospitalcode&ref1='+ref1+'&ref2='+ref2+'&ref3='+district_id,
			success:function(data){
					$('#input_hospital').html(data);
			}
		});
	});
});//document
</script>