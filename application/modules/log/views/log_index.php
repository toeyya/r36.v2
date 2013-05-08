<script type="text/javascript">
$(document).ready(function(){
   $('.datepicker').datepick({format: 'Y-m-d', showOn: 'both', buttonImageOnly: true, buttonImage: 'js/jquery/jquery.datepick/calendar.gif' },$.datepick.regional['th']);
   var ref1,ref2;
   $('select[name=province_id]').change(function(){
		$('#amphur_id option[value=""]').attr("selected",true);
		$('#district_id option[value=""]').attr("selected",true);
		$('#hospital option[value=""]').attr("selected",true);
		ref1=$('select[name=province_id] option:selected').val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'ref1='+ref1,
			success:function(data)
			{
				$("#input_amphur").html(data);
			}
		});
	});	//select name=province
	$("select[name=amphur_id]").live('change',function(){
		ref2=$('select[name=amphur_id] option:selected').val();
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'ref1='+ref1+'&ref2='+ref2,
			success:function(data)
			{
				$("#input_district").html(data);
			}
		});
	});

	$('select[name=district_id]').live('change',function(){
		ref3=$('select[name=district_id] option:selected').val();
		$.ajax({
			url:'<?php echo base_url() ?>hospital/getHospital',
			data:'ref1='+ref1+'&ref2='+ref2+'&ref3='+ref3,
			success:function(data){
				$('#input_hospital').html(data);
			}
		})
	});
	$('.input_box_patient').css('width','140px');
 });// document
  </script>
 
<div id="title">ประวัติเข้าใช้ระบบ</div>
<div id="search">
<form name="formm" method="get" action="log/index">
			<table class="tb_patient1">
				<tr>
					<th width="10%">ชื่อผู้ใช้</th>
					<td widht="40"><input type="text" value="<?php echo  @$_GET['fullname']?>" name="fullname"  class="input_box_patient " /></td>
					<th>การะทำ</th>
					<td>
							<select name="action" class="styled-select">
							<option value="" selected="selected">-ทั้งหมด-</option>
							<option value="เพิ่ม" <?php echo (@$_GET['action']=="เพิ่ม")? " selected= 'selected' ":""; ?>>เพิ่ม</option>
							<option value="แก้ไข" <?php echo (@$_GET['action']=="แก้ไข")? "  selected='selected' ":"" ;?>>แก้ไข</option>
							<option value="ลบ" <?php echo (@$_GET['action']=="ลบ")? " selected= 'selected' ":"";?>>ลบ</option>
							<option value="ดู" <?php echo (@$_GET['action']=="ดู")? " selected= 'selected' ":""; ?>>ดู</option>
							<option value="เข้าใช้ระบบ" <?php echo (@$_GET['action']=="เข้าใช้ระบบ")? " selected= 'selected' ":""; ?>>เข้าใช้ระบบ</option>
							<option value="ออกจากระบบ" <?php echo (@$_GET['action']=="ออกจากระบบ")? " selected= 'selected' ":""; ?>>ออกจากระบบ</option>						
							</select>
					</td>

							<th>ตัังวันที่ </th><td><input type="text" class="datepicker input_box_patient"  size="10" name="firstDate" value="<?php echo @$_GET['firstDate'];?>"/></td> 
							<th>ถึงวันที่ </th><td><input type="text" class="datepicker input_box_patient"  size="10" name="lastDate" value="<?php echo @$_GET['lastDate'];?>"/></td> 	
				</tr>
				<tr>													
							<th>จังหวัด </th>
							<td><?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$_GET['province_id'],'class="styled-select" id="province_id"','-ทั้งหมด-'); ?>
									<?php $wh=(@$_GET['province_id'])?" where province_id='".$_GET['province_id']."'":'';  
												$class='class="styled-select" id="amphur_id"';?>
							</td>
							<th>อำเภอ</th>
							<td><span id="input_amphur"><?php echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name',"n_amphur".$wh),@$_GET['amphur'],$class,'-ทั้งหมด-'); ?></span>
									<?php $wh=(@$_GET['province_id']!='' && $_GET['amphur_id']!='')? " WHERE hospital_province_id='".@$_GET['province_id']."' and hospital_amphur_id='".@$_GET['amphur_id']."'":""; 
												$class='class="styled-select" id="district" ';?>	
							</td>
							<th>ตำบล</th>
							<td><span id="input_district"><?php echo form_dropdown('district',get_option('district_id','district_name','n_district'),@$_GET['district'],$class,'-ทั้งหมด-') ?></span>
									<?php if(@$_GET['province_id']!='' && $_GET['amphur_id']!='' && $_GET['hospital']){
													$wh=" WHERE hospital_province_id='".@$_GET['province_id']."' and hospital_amphur_id='".@$_GET['amphur_id']."' and hospital_district_id='".$_GET['district_id']."' ";
												}else{$wh="";}
												$class='class="styled-select" id="hospital" style="width:130px;"';?>	
							</td>								
							<th>โรงพยาบาล</th>
							<td><span id="input_hospital"><?php echo form_dropdown('hospital',get_option('hospital_code','hospital_name','n_hospital_1'.$wh),@$_GET['hospital'],$class,'-ทั้งหมด-'); ?></span></td>				 							 
				</tr>
				<tr><th>สิทธิืการใช้งาน</th>
					<td>
						<?php 
						$position=array('00'=>'ผู้ดูแลระบบระดับกรม(สำนักโรคติดต่อทั่วไป)','01'=>'ผู้ดูแลระบบระดับเขต','02'=>'ผู้ดูแลระบบระดับจังหวัด'
													,'03'=>'ผู้ดูแลระบบระดับอำเภอ','04'=>'ผู้ดูแลระบบระดับตำบล','05'=>'Staff','06'=>'ผู้ใช้ระบบทั่วไป');
						echo form_dropdown('userposition',$position,@$_GET['position'],'class="styled-select"','-ทั้งหมด-'); ?>
					</td>
				</tr>
			</table>	
<div class="btn_inline">
      <ul>
      	<li><button class="btn_submit" type="submit" name="btn_submit">&nbsp;&nbsp;&nbsp;</button></li>
      	<li><button class="btn_cancel" type="reset" name="btn_cancel">&nbsp;&nbsp;&nbsp;</button></li></ul>
</div>					
</form>
</div>				
<table class="tb_search_Rabies1">
		  <tr>
			<th width="5%" >ลำดับ</th>
			<th width="12%">การกระทำ</th>
		    <th width="30%">รายละเอียด</th>
			<th width="18%">โดย</th>
			<th width="17%">สิทธิืการใช้งาน</th>
			<th width="10%">IP address</th>
			<th width="18%">วันที่</th>
		  </tr>
	 	<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;?>
	 	<?php foreach($result as $key =>$item): ?>		 
				  <tr>			 
				  <td><?php echo $i ?></td>
				  <td><?php echo $item['action'] ?> </td>
				  <td><?php echo $item['detail'] ?></td>
				  <td><?php echo $item['fullname'] ?> </td>
				  <td><?php echo (!empty($item['userposition']))? $position[$item['userposition']]:"";?></td>
				  <td><?php echo  $item['ipaddress']?></td>
				  <td><?php echo  DB2date($item['created'],true) ?>
				  <input type="hidden" name="uid"  value="<?php echo $item['uid']  ?>"/></td>
				  </tr>
		<?php $i++; endforeach;?>
		 </table>
<?php  echo $pagination;?>