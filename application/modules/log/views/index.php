<h1>ประวัติเข้าใช้ระบบ</h1>
<div class="search">
<form name="formm" method="get" action="log/admin/log/index">
			<table class="form">
				<tr>
					<th>ชื่อผู้ใช้</th>
					<td><input type="text" value="<?php echo  @$_GET['fullname']?>" name="fullname"  /></td>
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

							<th>ตัังวันที่ </th><td><input type="text" class="datepicker"  size="10" name="firstDate" value="<?php echo @$_GET['firstDate'];?>" style='width:100px;'/></td> 
							<th>ถึงวันที่ </th><td><input type="text" class="datepicker"  size="10" name="lastDate" value="<?php echo @$_GET['lastDate'];?>" style='width:100px;'/></td> 	
				</tr>
				<tr>													
							<th>จังหวัด </th>
							<td>
								
								<?php echo form_dropdown('province_id',get_option('province_id','province_name','n_province order by province_name asc'),@$_GET['province_id'],'class="styled-select" id="province_id"','-ทั้งหมด-'); ?>
									<?php $wh=(!empty($_GET['province_id']) && !empty($_GET['amphur_id']))? " WHERE province_id='".@$_GET['province_id']."' and amphur_id='".@$_GET['amphur_id']."'":""; 
												$class='id="amphur_id"';?>
												
							</td>
							<th>อำเภอ</th>
							<td><span id="input_amphur"><?php echo form_dropdown('amphur_id',get_option('amphur_id','amphur_name',"n_amphur".$wh),@$_GET['amphur_id'],$class,'-ทั้งหมด-'); ?></span>
									<?php $wh=(!empty($_GET['province_id']) && !empty($_GET['amphur_id']))? " WHERE province_id='".@$_GET['province_id']."' and amphur_id='".@$_GET['amphur_id']."' ":""; 
												$class='id="district"';?>	
							</td>
							<th>ตำบล</th>
							<td><span id="input_district"><?php echo form_dropdown('district_id',get_option('district_id','district_name','n_district'.$wh),@$_GET['district_id'],$class,'-ทั้งหมด-') ?></span>
									<?php if(!empty($_GET['district_id'])){
													$wh=" WHERE hospital_province_id='".@$_GET['province_id']."' and hospital_amphur_id='".@$_GET['amphur_id']."' and hospital_district_id='".@$_GET['district_id']."' ";
												}else{$wh="";}
												$class=' id="hospital" style="width:130px;"';?>	
							</td>								
							<th>โรงพยาบาล</th>
							<td><span id="input_hospital"><? if(!empty($_GET['userhospital'])){
										$wh=" WHERE hospital_province_id='".@$_GET['province_id']."' AND   hospital_amphur_id='".@$_GET['amphur_id']."' 
											  AND hospital_district_id='".@$_GET['district_id']."' AND hospital_code='".$_GET['userhospital']."'";
									}else{$wh="";}
							    ?>
							    <?php if($wh){ ?>
								<?php echo form_dropdown('userhospital',get_option('hospital_code','hospital_name','n_hospital_1'.$wh),@$_GET['userhospital'],'','-ทั้งหมด-'); ?>
								<?php }else{ ?>
							   	<select name="userhospital"><option value="">-ทั้งหมด-</option></select>
							    <?php } ?>
								</span></td>				 							 
				</tr>
				<tr><th>สิทธิ์การใช้งาน</th>
					<td>
						<?php 

						echo form_dropdown('userposition',$position,@$_GET['userposition'],'class="styled-select"','-ทั้งหมด-'); ?>
					</td>
				</tr>
				<tr><th></th><td  colspan="7" style="text-align:center;">
					<button class="btn" type="submit" name="btn_submit">ค้นหา</button>
					<a href="log/admin/log/index<?php echo '?'.$_SERVER['QUERY_STRING'].'&act=preview' ?>" class="btn" target="_blank">พิมพ์รายงาน</a>
				</td></tr>
			</table>					
</form>
</div>				
<table class="list">
		  <tr>
			<th width="5%" >ลำดับ</th>
			<th width="12%">การกระทำ</th>
		    <th width="30%">รายละเอียด</th>
			<th width="18%">โดย</th>
			<th width="17%">สิทธิ์การใช้งาน</th>
			<th width="10%">IP address</th>
			<th width="18%">วันที่</th>
		  </tr>
	 	<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 15)-15)+1:1;?>
	 	
	 	<?php 
	 	
	 	foreach($result as $key =>$item): ?>		 
				  <tr>			 
				  <td><?php echo $i ?></td>
				  <td><?php echo $item['action'] ?> </td>
				  <td><?php echo $item['detail'] ?></td>
				  <td><?php echo $item['userfirstname'].' '.$item['usersurname'] ?> </td>
				  <td><?php echo (!empty($item['userposition']))? $position[$item['userposition']]:"";?></td>
				  <td><?php echo $item['ipaddress']?></td>
				  <td><?php echo DB2date($item['created'],true) ?>
				  <input type="hidden" name="uid"  value="<?php echo $item['uid']  ?>"/></td>
				  </tr>
		<?php $i++; endforeach;
		?>
</table>
<?php  echo $pagination;?>

<script type="text/javascript">
$(document).ready(function(){
   var ref1,ref2;
   function change_prv(){
		$('#amphur_id option[value=""]').attr("selected",true);
		$('#district_id option[value=""]').attr("selected",true);
		$('#hospital option[value=""]').attr("selected",true);
		ref1=$('select[name=province_id] option:selected').val();
		$('#input_amphur').html('<img src="media/images/loader.gif" width="16px" height="11px">');
		$.ajax({
			url:'<?php echo base_url() ?>district/getAmphur',
			data:'name=amphur_id&ref1='+ref1,
			success:function(data)
			{
				$("#input_amphur").html(data);
			}
		});   	
   }
   function change_amphur(){
		ref2=$('select[name=amphur_id] option:selected').val();
		$("#input_district").html('<img src="media/images/loader.gif" width="16px" height="11px">');
		$.ajax({
			url:'<?php echo base_url() ?>district/getDistrict',
			data:'name=district_id&ref1='+ref1+'&ref2='+ref2,			
			success:function(data)
			{
				$("#input_district").html(data);
			}
		});   	
   }
   function change_district(){
		ref3=$('select[name=district_id] option:selected').val();
			$("#input_hospital").html('<img src="media/images/loader.gif" width="16px" height="11px">');
		$.ajax({
			url:'<?php echo base_url() ?>hospital/getHospital',
			data:'name=userhospital&ref1='+ref1+'&ref2='+ref2+'&ref3='+ref3,		
			success:function(data){
				$('#input_hospital').html(data);
			}
		})   	
   }
	 $('.input_box_patient').css('width','140px');
 	 $('select[name=province_id]').change(change_prv).click(change_prv);
 	 $("select[name=amphur_id]").live('change',change_amphur).click(change_amphur);
 	 $('select[name=district_id]').live('change',change_district).click(change_district);
 
 
 });// document
</script>